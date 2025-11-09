@extends('layouts.app')

@section('title', 'Tambah Parameter Baru')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-plus-circle"></i> Tambah Parameter Baru</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('parameters.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Aspect <span class="text-danger">*</span></label>
                <select name="aspect" class="form-select @error('aspect') is-invalid @enderror" required>
                    <option value="">Pilih Aspect</option>
                    <option value="Visual" {{ old('aspect') == 'Visual' ? 'selected' : '' }}>Visual</option>
                    <option value="Dimensional" {{ old('aspect') == 'Dimensional' ? 'selected' : '' }}>Dimensional</option>
                    <option value="Packaging" {{ old('aspect') == 'Packaging' ? 'selected' : '' }}>Packaging</option>
                </select>
                @error('aspect')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Parameter Name <span class="text-danger">*</span></label>
                <input type="text" name="parameter_name" class="form-control @error('parameter_name') is-invalid @enderror"
                       value="{{ old('parameter_name') }}"
                       placeholder="Contoh: Kualitas Kulit"
                       required>
                @error('parameter_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Sub Parameter <span class="text-danger">*</span></label>
                <input type="text" name="sub_parameter" class="form-control @error('sub_parameter') is-invalid @enderror"
                       value="{{ old('sub_parameter') }}"
                       placeholder="Contoh: Tekstur kulit halus dan rata"
                       required>
                @error('sub_parameter')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                    <option value="Yes" {{ old('is_active', 'Yes') == 'Yes' ? 'selected' : '' }}>Aktif</option>
                    <option value="No" {{ old('is_active') == 'No' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('parameters.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Parameter
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
