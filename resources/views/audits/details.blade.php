@extends('layouts.app')

@section('title', 'Input Detail Audit')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-clipboard-data"></i> Input Detail Audit</h2>
    <p class="text-muted">Langkah 2 dari 3: Detail Pemeriksaan Parameter</p>
</div>

<!-- Info Audit Header -->
<div class="card mb-4 border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Audit</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p><strong>Kode Audit:</strong> {{ $header->audit_code }}</p>
                <p><strong>Tanggal:</strong> {{ $header->audit_date->format('d/m/Y') }}</p>
                <p><strong>Auditor:</strong> {{ $header->auditor_name }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Produk:</strong> {{ $header->product_name }}</p>
                <p><strong>Kode Produk:</strong> {{ $header->product_code }}</p>
                <p><strong>Supplier:</strong> {{ $header->supplier_name }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Department:</strong> <span class="badge bg-secondary">{{ $header->department }}</span></p>
                <p><strong>Shift:</strong> <span class="badge bg-info">{{ $header->shift }}</span></p>
                <p><strong>Total Sample:</strong> {{ $header->total_sample }} unit</p>
            </div>
        </div>
    </div>
</div>

<!-- Form Detail -->
<form action="{{ route('audits.details.store', $header->id) }}" method="POST">
    @csrf

    @php
        $paramsByAspect = $parameters->groupBy('aspect');
    @endphp

    @foreach($paramsByAspect as $aspect => $params)
        <div class="card mb-4">
            <div class="card-header" style="background: {{ $aspect == 'Visual' ? '#3b82f6' : ($aspect == 'Dimensional' ? '#10b981' : '#f59e0b') }}; color: white;">
                <h5 class="mb-0">
                    <i class="bi bi-{{ $aspect == 'Visual' ? 'eye' : ($aspect == 'Dimensional' ? 'rulers' : 'box-seam') }}"></i>
                    Aspek {{ $aspect }}
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="30%">Parameter</th>
                                <th width="35%">Sub Parameter</th>
                                <th width="15%">Hasil <span class="text-danger">*</span></th>
                                <th width="20%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($params as $param)
                            <tr>
                                <td><strong>{{ $param->parameter_name }}</strong></td>
                                <td>{{ $param->sub_parameter }}</td>
                                <td>
                                    <input type="hidden" name="parameter_id[]" value="{{ $param->id }}">
                                    <select name="value[]" class="form-select form-select-sm" required>
                                        <option value="">Pilih</option>
                                        <option value="OK">✓ OK</option>
                                        <option value="NG">✗ NG (No Good)</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="note[]" class="form-control form-control-sm"
                                           placeholder="Opsional...">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('audits.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary">
            Selanjutnya: Input Summary <i class="bi bi-arrow-right"></i>
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto fill note when NG selected
    document.querySelectorAll('select[name="value[]"]').forEach((select, index) => {
        select.addEventListener('change', function() {
            const noteInput = document.querySelectorAll('input[name="note[]"]')[index];
            if (this.value === 'NG' && !noteInput.value) {
                noteInput.focus();
            }
        });
    });
</script>
@endpush
