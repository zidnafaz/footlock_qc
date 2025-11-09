@extends('layouts.app')

@section('title', 'Daftar Audit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-check"></i> Daftar Audit</h2>
    <a href="{{ route('audits.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Audit Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode Audit</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Supplier</th>
                        <th>Department</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audits as $audit)
                    <tr>
                        <td><strong>{{ $audit->audit_code }}</strong></td>
                        <td>{{ $audit->audit_date->format('d/m/Y') }}</td>
                        <td>
                            {{ $audit->product_name }}<br>
                            <small class="text-muted">{{ $audit->product_code }}</small>
                        </td>
                        <td>{{ $audit->supplier_name }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $audit->department }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $audit->category }}</span>
                        </td>
                        <td>
                            @if($audit->summary)
                                @if($audit->summary->conclusion == 'Lulus')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Lulus
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Tidak Lulus
                                    </span>
                                @endif
                            @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-hourglass-split"></i> Proses
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('audits.show', $audit->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada data audit</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $audits->links() }}
        </div>
    </div>
</div>
@endsection
