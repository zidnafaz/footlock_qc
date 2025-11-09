@extends('layouts.app')

@section('title', 'Detail Audit - ' . $audit->audit_code)

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-clipboard-data"></i> Detail Audit</h2>
        <a href="{{ route('audits.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- Header Info -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Audit</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="200"><strong>Kode Audit</strong></td>
                        <td>: {{ $audit->audit_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Audit</strong></td>
                        <td>: {{ $audit->audit_date->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Auditor</strong></td>
                        <td>: {{ $audit->auditor_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Department</strong></td>
                        <td>: <span class="badge bg-secondary">{{ $audit->department }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Shift</strong></td>
                        <td>: <span class="badge bg-info">{{ $audit->shift }}</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="200"><strong>Nama Produk</strong></td>
                        <td>: {{ $audit->product_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kode Produk</strong></td>
                        <td>: {{ $audit->product_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Supplier</strong></td>
                        <td>: {{ $audit->supplier_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori</strong></td>
                        <td>: <span class="badge bg-warning">{{ $audit->category }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Total Sample</strong></td>
                        <td>: {{ $audit->total_sample }} unit</td>
                    </tr>
                    <tr>
                        <td><strong>Metode Audit</strong></td>
                        <td>: {{ $audit->method }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Pemeriksaan -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-list-check"></i> Detail Pemeriksaan Parameter</h5>
    </div>
    <div class="card-body">
        @php
            $detailsByAspect = $audit->details->groupBy(function($detail) {
                return $detail->parameter->aspect;
            });
        @endphp

        @foreach($detailsByAspect as $aspect => $details)
        <h6 class="mt-3 mb-3">
            <span class="badge badge-aspect-{{ strtolower($aspect) }}">{{ $aspect }}</span>
        </h6>
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Parameter</th>
                        <th>Sub Parameter</th>
                        <th width="10%">Hasil</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                    <tr>
                        <td><strong>{{ $detail->parameter->parameter_name }}</strong></td>
                        <td>{{ $detail->parameter->sub_parameter }}</td>
                        <td>
                            @if($detail->value == 'OK')
                                <span class="badge bg-success">✓ OK</span>
                            @else
                                <span class="badge bg-danger">✗ NG</span>
                            @endif
                        </td>
                        <td>{{ $detail->note ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>

<!-- Summary -->
@if($audit->summary)
<div class="card mb-4">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Summary Audit</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3 text-center">
                <div class="p-3 bg-light rounded">
                    <h3 class="text-danger">{{ $audit->summary->total_defects }}</h3>
                    <p class="mb-0">Total Defects</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3 bg-light rounded">
                    <h3 class="text-primary">{{ number_format($audit->summary->defect_percentage, 2) }}%</h3>
                    <p class="mb-0">Persentase Cacat</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3 bg-light rounded">
                    @if($audit->summary->conclusion == 'Lulus')
                        <h3 class="text-success"><i class="bi bi-check-circle-fill"></i></h3>
                        <p class="mb-0 text-success"><strong>LULUS</strong></p>
                    @else
                        <h3 class="text-danger"><i class="bi bi-x-circle-fill"></i></h3>
                        <p class="mb-0 text-danger"><strong>TIDAK LULUS</strong></p>
                    @endif
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-3 bg-light rounded">
                    <h6>
                        @if($audit->summary->followup_status == 'Selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($audit->summary->followup_status == 'Proses')
                            <span class="badge bg-warning">Proses</span>
                        @else
                            <span class="badge bg-secondary">Belum</span>
                        @endif
                    </h6>
                    <p class="mb-0">Status Followup</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h6><strong>Tindakan Korektif:</strong></h6>
                <p class="bg-light p-3 rounded">{{ $audit->summary->corrective_action }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Penanggung Jawab:</strong> {{ $audit->summary->responsible_person }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Batas Waktu:</strong> {{ $audit->summary->followup_due_date->format('d F Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endif

<div class="text-center">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="bi bi-printer"></i> Print Laporan
    </button>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .sidebar, .btn, nav { display: none !important; }
        .col-md-9, .col-lg-10 { width: 100% !important; max-width: 100% !important; }
    }
</style>
@endpush
