@extends('layouts.app')

@section('title', 'Buat Audit Baru')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-plus-circle"></i> Buat Audit Baru</h2>
    <p class="text-muted">Langkah 1 dari 3: Identitas Audit</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('audits.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Kode Audit (Auto Generate)</label>
                        <input type="text" class="form-control" placeholder="{{ $nextAuditCode }}" disabled>
                        <small class="text-muted">Kode akan digenerate otomatis saat submit</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Audit <span class="text-danger">*</span></label>
                        <input type="date" name="audit_date" class="form-control @error('audit_date') is-invalid @enderror"
                               value="{{ old('audit_date', date('Y-m-d')) }}" required>
                        @error('audit_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Auditor <span class="text-danger">*</span></label>
                        <input type="text" name="auditor_name" class="form-control @error('auditor_name') is-invalid @enderror"
                               value="{{ old('auditor_name') }}" required>
                        @error('auditor_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <select name="department" class="form-select @error('department') is-invalid @enderror" required>
                            <option value="">Pilih Department</option>
                            <option value="Cutting" {{ old('department') == 'Cutting' ? 'selected' : '' }}>Cutting</option>
                            <option value="Stitching" {{ old('department') == 'Stitching' ? 'selected' : '' }}>Stitching</option>
                            <option value="Assembling" {{ old('department') == 'Assembling' ? 'selected' : '' }}>Assembling</option>
                            <option value="Finishing" {{ old('department') == 'Finishing' ? 'selected' : '' }}>Finishing</option>
                        </select>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Shift <span class="text-danger">*</span></label>
                        <select name="shift" class="form-select @error('shift') is-invalid @enderror" required>
                            <option value="">Pilih Shift</option>
                            <option value="Shift 1" {{ old('shift') == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
                            <option value="Shift 2" {{ old('shift') == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
                            <option value="Shift 3" {{ old('shift') == 'Shift 3' ? 'selected' : '' }}>Shift 3</option>
                        </select>
                        @error('shift')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror"
                               value="{{ old('product_name') }}" required>
                        @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Kode Produk <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" class="form-control @error('product_code') is-invalid @enderror"
                               value="{{ old('product_code') }}" required>
                        @error('product_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Supplier <span class="text-danger">*</span></label>
                        <input type="text" name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror"
                               value="{{ old('supplier_name') }}" required>
                        @error('supplier_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Kategori Audit <span class="text-danger">*</span></label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Rutin" {{ old('category') == 'Rutin' ? 'selected' : '' }}>Rutin</option>
                            <option value="Pre-shipment" {{ old('category') == 'Pre-shipment' ? 'selected' : '' }}>Pre-shipment</option>
                            <option value="Penerimaan Supplier" {{ old('category') == 'Penerimaan Supplier' ? 'selected' : '' }}>Penerimaan Supplier</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Total Sample <span class="text-danger">*</span></label>
                        <input type="number" name="total_sample" class="form-control @error('total_sample') is-invalid @enderror"
                               value="{{ old('total_sample') }}" min="1" required>
                        @error('total_sample')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Metode Audit <span class="text-danger">*</span></label>
                        <select name="method" class="form-select @error('method') is-invalid @enderror" required>
                            <option value="">Pilih Metode</option>
                            <option value="Visual" {{ old('method') == 'Visual' ? 'selected' : '' }}>Visual</option>
                            <option value="Dimensional" {{ old('method') == 'Dimensional' ? 'selected' : '' }}>Dimensional</option>
                            <option value="Fungsi" {{ old('method') == 'Fungsi' ? 'selected' : '' }}>Fungsi</option>
                            <option value="Sampling" {{ old('method') == 'Sampling' ? 'selected' : '' }}>Sampling</option>
                        </select>
                        @error('method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Selanjutnya: Input Detail <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
