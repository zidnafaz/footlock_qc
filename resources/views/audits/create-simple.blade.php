@extends('layouts.simple')

@section('title', 'Form Audit Baru')

@section('content')
<div class="paper-card">
    <!-- Header -->
    <div class="header-section text-center">
        <h2 class="mb-2">
            <i class="bi bi-clipboard-check"></i> FORM AUDIT KUALITAS PRODUK
        </h2>
        <p class="text-muted mb-0">Footlock Quality Control System</p>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="alert alert-success alert-dismissible fade" role="alert" style="display: none;">
        <i class="bi bi-check-circle"></i> <span id="successText"></span>
        <button type="button" class="btn-close" onclick="$('#successMessage').fadeOut()"></button>
    </div>

    <!-- Error Message -->
    <div id="errorMessage" class="alert alert-danger alert-dismissible fade" role="alert" style="display: none;">
        <i class="bi bi-exclamation-circle"></i> <span id="errorText"></span>
        <button type="button" class="btn-close" onclick="$('#errorMessage').fadeOut()"></button>
    </div>

    <form id="auditForm">
        @csrf

        <!-- SECTION 1: Informasi Audit -->
        <div class="section-title">
            <i class="bi bi-1-circle-fill"></i> Informasi Audit
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kode Audit <span class="text-danger">*</span></label>
                <input type="text" name="audit_code" class="form-control" placeholder="AUD-2025-XXX" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Audit <span class="text-danger">*</span></label>
                <input type="date" name="audit_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Auditor <span class="text-danger">*</span></label>
                <input type="text" name="auditor_name" class="form-control" placeholder="Nama lengkap auditor" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Department <span class="text-danger">*</span></label>
                <select name="department" class="form-select" required>
                    <option value="">Pilih Department</option>
                    <option value="Cutting">Cutting</option>
                    <option value="Stitching">Stitching</option>
                    <option value="Assembling">Assembling</option>
                    <option value="Finishing">Finishing</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Shift <span class="text-danger">*</span></label>
                <select name="shift" class="form-select" required>
                    <option value="">Pilih Shift</option>
                    <option value="Shift 1">Shift 1</option>
                    <option value="Shift 2">Shift 2</option>
                    <option value="Shift 3">Shift 3</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kategori Audit <span class="text-danger">*</span></label>
                <select name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Rutin">Rutin</option>
                    <option value="Pre-shipment">Pre-shipment</option>
                    <option value="Penerimaan Supplier">Penerimaan Supplier</option>
                </select>
            </div>
        </div>

        <!-- SECTION 2: Informasi Produk -->
        <div class="section-title">
            <i class="bi bi-2-circle-fill"></i> Informasi Produk
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" name="product_name" class="form-control" placeholder="Contoh: Sepatu Formal Oxford" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kode Produk <span class="text-danger">*</span></label>
                <input type="text" name="product_code" class="form-control" placeholder="Contoh: SFP-001-BLK" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Supplier <span class="text-danger">*</span></label>
                <input type="text" name="supplier_name" class="form-control" placeholder="Nama supplier" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Total Sample <span class="text-danger">*</span></label>
                <input type="number" name="total_sample" class="form-control" placeholder="100" min="1" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Metode Audit <span class="text-danger">*</span></label>
                <select name="method" class="form-select" required>
                    <option value="">Pilih Metode</option>
                    <option value="Visual">Visual</option>
                    <option value="Dimensional">Dimensional</option>
                    <option value="Fungsi">Fungsi</option>
                    <option value="Sampling">Sampling</option>
                </select>
            </div>
        </div>

        <!-- SECTION 3: Detail Pemeriksaan Parameter -->
        <div class="section-title">
            <i class="bi bi-3-circle-fill"></i> Detail Pemeriksaan Parameter
        </div>

        <div id="parametersSection">
            @php
                $paramsByAspect = $parameters->groupBy('aspect');
            @endphp

            @foreach($paramsByAspect as $aspect => $params)
                <div class="badge badge-aspect-{{ strtolower($aspect) }} w-100 text-start mt-4 mb-3" style="font-size: 1rem; font-weight: 600;">
                    <i class="bi bi-{{ $aspect == 'Visual' ? 'eye' : ($aspect == 'Dimensional' ? 'rulers' : 'box-seam') }}"></i>
                    {{ $aspect }}
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Parameter</th>
                                <th width="35%">Sub Parameter</th>
                                <th width="10%" class="text-center">OK</th>
                                <th width="10%" class="text-center">NG</th>
                                <th width="15%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($params as $index => $param)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><strong>{{ $param->parameter_name }}</strong></td>
                                    <td><small class="text-muted">{{ $param->sub_parameter }}</small></td>
                                    <td class="text-center">
                                        <input type="hidden" name="parameter_id[]" value="{{ $param->id }}">
                                        <input type="radio" name="value_{{ $param->id }}" value="OK" class="form-check-input result-radio" data-param="{{ $param->id }}" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="value_{{ $param->id }}" value="NG" class="form-check-input result-radio" data-param="{{ $param->id }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="note_{{ $param->id }}" class="form-control form-control-sm note-input" data-param="{{ $param->id }}" placeholder="Opsional">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

        <!-- SECTION 4: Summary & Tindak Lanjut -->
        <div class="section-title">
            <i class="bi bi-4-circle-fill"></i> Summary & Tindak Lanjut
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Total Defects</label>
                <input type="number" name="total_defects" id="total_defects" class="form-control" value="0" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Persentase Cacat (%)</label>
                <input type="number" step="0.01" name="defect_percentage" id="defect_percentage" class="form-control" value="0" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Kesimpulan <span class="text-danger">*</span></label>
                <select name="conclusion" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Lulus">✓ Lulus</option>
                    <option value="Tidak Lulus">✗ Tidak Lulus</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Tindakan Korektif <span class="text-danger">*</span></label>
                <textarea name="corrective_action" rows="3" class="form-control"
                          placeholder="Jelaskan tindakan perbaikan yang diperlukan..." required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                <input type="text" name="responsible_person" class="form-control" placeholder="Nama / Jabatan" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Status Followup <span class="text-danger">*</span></label>
                <select name="followup_status" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Belum">Belum</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Batas Waktu <span class="text-danger">*</span></label>
                <input type="date" name="followup_due_date" class="form-control" required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-submit">
                <i class="bi bi-send-fill"></i> Submit Audit
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto calculate defects when radio button changes
    $('.result-radio').on('change', function() {
        calculateDefects();

        // Focus on note if NG
        const paramId = $(this).data('param');
        if ($(this).val() === 'NG') {
            $('input[name="note_' + paramId + '"]').focus();
        }
    });

    // Auto calculate when sample changes
    $('input[name="total_sample"]').on('input', function() {
        calculateDefects();
    });

    function calculateDefects() {
        const totalNG = $('.result-radio:checked[value="NG"]').length;
        const totalSample = parseInt($('input[name="total_sample"]').val()) || 0;
        const percentage = totalSample > 0 ? ((totalNG / totalSample) * 100).toFixed(2) : 0;

        $('#total_defects').val(totalNG);
        $('#defect_percentage').val(percentage);
    }

    // AJAX Form Submit
    $('#auditForm').on('submit', function(e) {
        e.preventDefault();

        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Processing...');

        // Collect form data with proper array format
        const formData = new FormData(this);

        // Remove old format and prepare new format
        const parameterIds = [];
        const values = [];
        const notes = [];

        $('input[name="parameter_id[]"]').each(function() {
            const paramId = $(this).val();
            const value = $('input[name="value_' + paramId + '"]:checked').val();
            const note = $('input[name="note_' + paramId + '"]').val();

            parameterIds.push(paramId);
            values.push(value || '');
            notes.push(note || '');
        });

        // Clear old data
        formData.delete('parameter_id[]');

        // Append new data
        parameterIds.forEach((id, index) => {
            formData.append('parameter_id[]', id);
            formData.append('value[]', values[index]);
            formData.append('note[]', notes[index]);
        });

        $.ajax({
            url: '{{ route("audits.store.simple") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#successMessage').show().addClass('show');
                $('#successText').text(response.message);

                // Reset form
                $('#auditForm')[0].reset();
                calculateDefects();

                // Scroll to top
                $('html, body').animate({ scrollTop: 0 }, 500);

                submitBtn.prop('disabled', false).html('<i class="bi bi-send-fill"></i> Submit Audit');
            },
            error: function(xhr) {
                let errorMsg = 'Terjadi kesalahan saat menyimpan data.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorMsg = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                $('#errorMessage').show().addClass('show');
                $('#errorText').html(errorMsg);

                // Scroll to top
                $('html, body').animate({ scrollTop: 0 }, 500);

                submitBtn.prop('disabled', false).html('<i class="bi bi-send-fill"></i> Submit Audit');
            }
        });
    });
});
</script>
@endpush
