@extends('layouts.app')

@section('title', 'Laporan Audit')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-graph-up"></i> Laporan Audit</h2>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="bi bi-printer"></i> Print Laporan
        </button>
    </div>
</div>

<!-- Summary Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-primary">{{ $audits->count() }}</h3>
                <p class="mb-0">Total Audit</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-success">{{ $audits->filter(function($a) { return $a->summary && $a->summary->conclusion == 'Lulus'; })->count() }}</h3>
                <p class="mb-0">Lulus</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-danger">{{ $audits->filter(function($a) { return $a->summary && $a->summary->conclusion == 'Tidak Lulus'; })->count() }}</h3>
                <p class="mb-0">Tidak Lulus</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning">{{ $audits->filter(function($a) { return !$a->summary; })->count() }}</h3>
                <p class="mb-0">Proses</p>
            </div>
        </div>
    </div>
</div>

<!-- Audit List -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Audit</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Supplier</th>
                        <th>Dept</th>
                        <th>Sample</th>
                        <th>Defects</th>
                        <th>%</th>
                        <th>Hasil</th>
                        <th>Status FU</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audits as $index => $audit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $audit->audit_code }}</strong></td>
                        <td>{{ $audit->audit_date->format('d/m/Y') }}</td>
                        <td>
                            {{ $audit->product_name }}<br>
                            <small class="text-muted">{{ $audit->product_code }}</small>
                        </td>
                        <td>{{ $audit->supplier_name }}</td>
                        <td><span class="badge bg-secondary">{{ $audit->department }}</span></td>
                        <td>{{ $audit->total_sample }}</td>
                        <td>
                            @if($audit->summary)
                                <span class="badge bg-danger">{{ $audit->summary->total_defects }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($audit->summary)
                                {{ number_format($audit->summary->defect_percentage, 2) }}%
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($audit->summary)
                                @if($audit->summary->conclusion == 'Lulus')
                                    <span class="badge bg-success">✓ Lulus</span>
                                @else
                                    <span class="badge bg-danger">✗ Tidak Lulus</span>
                                @endif
                            @else
                                <span class="badge bg-warning">Proses</span>
                            @endif
                        </td>
                        <td>
                            @if($audit->summary)
                                @if($audit->summary->followup_status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($audit->summary->followup_status == 'Proses')
                                    <span class="badge bg-warning">Proses</span>
                                @else
                                    <span class="badge bg-secondary">Belum</span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .sidebar, .btn, nav, .alert { display: none !important; }
        .col-md-9, .col-lg-10 { width: 100% !important; max-width: 100% !important; }
        body { font-size: 12px; }
    }
</style>
@endpush
