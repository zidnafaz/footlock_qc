<?php

namespace App\Http\Controllers;

use App\Models\AuditParameter;
use Illuminate\Http\Request;

class AuditParameterController extends Controller
{
    // Menampilkan daftar parameter
    public function index()
    {
        $parameters = AuditParameter::orderBy('aspect')->orderBy('parameter_name')->paginate(20);
        return view('parameters.index', compact('parameters'));
    }

    // Form untuk membuat parameter baru
    public function create()
    {
        return view('parameters.create');
    }

    // Menyimpan parameter baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parameter_name' => 'required|string|max:100',
            'sub_parameter' => 'required|string|max:100',
            'aspect' => 'required|in:Visual,Dimensional,Packaging',
            'is_active' => 'required|in:Yes,No',
        ]);

        AuditParameter::create($validated);

        return redirect()->route('parameters.index')
            ->with('success', 'Parameter berhasil ditambahkan!');
    }

    // Form untuk edit parameter
    public function edit($id)
    {
        $parameter = AuditParameter::findOrFail($id);
        return view('parameters.edit', compact('parameter'));
    }

    // Update parameter
    public function update(Request $request, $id)
    {
        $parameter = AuditParameter::findOrFail($id);

        $validated = $request->validate([
            'parameter_name' => 'required|string|max:100',
            'sub_parameter' => 'required|string|max:100',
            'aspect' => 'required|in:Visual,Dimensional,Packaging',
            'is_active' => 'required|in:Yes,No',
        ]);

        $parameter->update($validated);

        return redirect()->route('parameters.index')
            ->with('success', 'Parameter berhasil diupdate!');
    }

    // Hapus parameter
    public function destroy($id)
    {
        $parameter = AuditParameter::findOrFail($id);
        $parameter->delete();

        return redirect()->route('parameters.index')
            ->with('success', 'Parameter berhasil dihapus!');
    }
}
