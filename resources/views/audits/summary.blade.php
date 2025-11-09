@extends('layouts.app')

@section('title', 'Summary Audit')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-clipboard-check"></i> Summary Audit</h2>
    <p class="text-muted">Langkah 3 dari 3: Ringkasan & Tindak Lanjut</p>
</div>

<!-- Info Audit Header -->
<div class="card mb-4 border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Audit</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Kode Audit:</strong> {{ $header->audit_code }}</p>
                <p><strong>Produk:</strong> {{ $header->product_name }} ({{ $header->product_code }})</p>
                <p><strong>Total Sample:</strong> {{ $header->total_sample }} unit</p>
            </div>
            <div class="col-md-6">
                <p><strong>Auditor:</strong> {{ $header->auditor_name }}</p>
                <p><strong>Department:</strong> {{ $header->department }}</p>
                <p><strong>Tanggal:</strong> {{ $header->audit_date->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Hasil Pemeriksaan -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Hasil Pemeriksaan</h5>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded">
                    <h3 class="text-success">{{ $header->details->where('value', 'OK')->count() }}</h3>
                    <p class="mb-0">Parameter OK</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded">
                    <h3 class="text-danger">{{ $totalDefects }}</h3>
                    <p class="mb-0">Parameter NG</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded">
                    <h3 class="text-primary">{{ number_format($defectPercentage, 2) }}%</h3>
                    <p class="mb-0">Persentase Cacat</p>
                </div>
            </div>
        </div>

        <!-- Detail NG -->
        @if($header->details->where('value', 'NG')->count() > 0)
        <div class="mt-4">
            <h6 class="text-danger"><i class="bi bi-exclamation-triangle"></i> Parameter dengan Temuan NG:</h6>
            <ul class="list-group">
                @foreach($header->details->where('value', 'NG') as $detail)
                <li class="list-group-item">
                    <strong>{{ $detail->parameter->parameter_name }}</strong>: {{ $detail->parameter->sub_parameter }}
                    @if($detail->note)
                        <br><small class="text-muted">Catatan: {{ $detail->note }}</small>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<!-- Form Summary -->
<form action="{{ route('audits.summary.store', $header->id) }}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header bg-warning">
            <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Isi Summary & Tindak Lanjut</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Total Defects <span class="text-danger">*</span></label>
                        <input type="number" name="total_defects" class="form-control @error('total_defects') is-invalid @enderror"
                               value="{{ old('total_defects', $totalDefects) }}" required readonly>
                        @error('total_defects')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Persentase Cacat (%) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="defect_percentage"
                               class="form-control @error('defect_percentage') is-invalid @enderror"
                               value="{{ old('defect_percentage', $defectPercentage) }}" required readonly>
                        @error('defect_percentage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Kesimpulan <span class="text-danger">*</span></label>
                        <select name="conclusion" class="form-select @error('conclusion') is-invalid @enderror" required>
                            <option value="">Pilih Kesimpulan</option>
                            <option value="Lulus" {{ old('conclusion') == 'Lulus' ? 'selected' : '' }}>✓ Lulus</option>
                            <option value="Tidak Lulus" {{ old('conclusion') == 'Tidak Lulus' ? 'selected' : '' }}>✗ Tidak Lulus</option>
                        </select>
                        @error('conclusion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Tindakan Korektif <span class="text-danger">*</span></label>
                        <textarea name="corrective_action" rows="4"
                                  class="form-control @error('corrective_action') is-invalid @enderror"
                                  placeholder="Jelaskan tindakan perbaikan yang diperlukan..."
                                  required>{{ old('corrective_action') }}</textarea>
                        @error('corrective_action')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                        <input type="text" name="responsible_person"
                               class="form-control @error('responsible_person') is-invalid @enderror"
                               value="{{ old('responsible_person') }}"
                               placeholder="Nama / Jabatan PIC"
                               required>
                        @error('responsible_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Status Tindak Lanjut <span class="text-danger">*</span></label>
                        <select name="followup_status" class="form-select @error('followup_status') is-invalid @enderror" required>
                            <option value="">Pilih Status</option>
                            <option value="Belum" {{ old('followup_status') == 'Belum' ? 'selected' : '' }}>Belum</option>
                            <option value="Proses" {{ old('followup_status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ old('followup_status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('followup_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Batas Waktu <span class="text-danger">*</span></label>
                        <input type="date" name="followup_due_date"
                               class="form-control @error('followup_due_date') is-invalid @enderror"
                               value="{{ old('followup_due_date') }}" required>
                        @error('followup_due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Selesaikan Audit
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
