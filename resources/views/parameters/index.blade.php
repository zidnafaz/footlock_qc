@extends('layouts.app')

@section('title', 'Master Parameter Audit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-gear"></i> Master Parameter Audit</h2>
    <a href="{{ route('parameters.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Parameter
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Aspect</th>
                        <th width="25%">Parameter</th>
                        <th width="35%">Sub Parameter</th>
                        <th width="10%">Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parameters as $index => $param)
                    <tr>
                        <td>{{ $parameters->firstItem() + $index }}</td>
                        <td>
                            @if($param->aspect == 'Visual')
                                <span class="badge badge-aspect-visual">Visual</span>
                            @elseif($param->aspect == 'Dimensional')
                                <span class="badge badge-aspect-dimensional">Dimensional</span>
                            @else
                                <span class="badge badge-aspect-packaging">Packaging</span>
                            @endif
                        </td>
                        <td><strong>{{ $param->parameter_name }}</strong></td>
                        <td>{{ $param->sub_parameter }}</td>
                        <td>
                            @if($param->is_active == 'Yes')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('parameters.edit', $param->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('parameters.destroy', $param->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus parameter ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada parameter</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $parameters->links() }}
        </div>
    </div>
</div>
@endsection
