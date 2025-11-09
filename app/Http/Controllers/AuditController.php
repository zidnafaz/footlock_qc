<?php

namespace App\Http\Controllers;

use App\Models\AuditHeader;
use App\Models\AuditParameter;
use App\Models\AuditDetail;
use App\Models\AuditSummary;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    // Menampilkan daftar audit
    public function index()
    {
        $audits = AuditHeader::with('summary')->latest()->paginate(10);
        return view('audits.index', compact('audits'));
    }

    // Form untuk membuat audit baru
    public function create()
    {
        $parameters = AuditParameter::active()->orderBy('aspect')->orderBy('parameter_name')->get();
        return view('audits.create', compact('parameters'));
    }

    // Menyimpan audit baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'audit_code' => 'required|string|max:50|unique:audit_headers',
            'audit_date' => 'required|date',
            'auditor_name' => 'required|string|max:100',
            'department' => 'required|in:Cutting,Stitching,Assembling,Finishing',
            'shift' => 'required|in:Shift 1,Shift 2,Shift 3',
            'product_name' => 'required|string|max:100',
            'product_code' => 'required|string|max:50',
            'supplier_name' => 'required|string|max:100',
            'category' => 'required|in:Rutin,Pre-shipment,Penerimaan Supplier',
            'total_sample' => 'required|integer|min:1',
            'method' => 'required|in:Visual,Dimensional,Fungsi,Sampling',
        ]);

        // Simpan header
        $header = AuditHeader::create($validated);

        // Redirect ke halaman input detail
        return redirect()->route('audits.details.create', $header->id)
            ->with('success', 'Data audit berhasil dibuat. Silakan isi detail audit.');
    }

    // Form untuk input detail audit
    public function createDetails($id)
    {
        $header = AuditHeader::findOrFail($id);
        $parameters = AuditParameter::active()->orderBy('aspect')->orderBy('parameter_name')->get();

        return view('audits.details', compact('header', 'parameters'));
    }

    // Menyimpan detail audit
    public function storeDetails(Request $request, $id)
    {
        $header = AuditHeader::findOrFail($id);

        // Validasi detail
        $validated = $request->validate([
            'parameter_id' => 'required|array',
            'parameter_id.*' => 'exists:audit_parameters,id',
            'value' => 'required|array',
            'value.*' => 'required|string|max:50',
            'note' => 'nullable|array',
            'note.*' => 'nullable|string',
        ]);

        // Simpan detail
        foreach ($validated['parameter_id'] as $index => $parameterId) {
            AuditDetail::create([
                'audit_header_id' => $header->id,
                'parameter_id' => $parameterId,
                'value' => $validated['value'][$index],
                'note' => $validated['note'][$index] ?? null,
            ]);
        }

        // Redirect ke halaman summary
        return redirect()->route('audits.summary.create', $header->id)
            ->with('success', 'Detail audit berhasil disimpan. Silakan isi summary audit.');
    }

    // Form untuk input summary
    public function createSummary($id)
    {
        $header = AuditHeader::with('details.parameter')->findOrFail($id);

        // Hitung total defects otomatis
        $totalDefects = $header->details->where('value', 'NG')->count();
        $defectPercentage = $header->total_sample > 0
            ? round(($totalDefects / $header->total_sample) * 100, 2)
            : 0;

        return view('audits.summary', compact('header', 'totalDefects', 'defectPercentage'));
    }

    // Menyimpan summary
    public function storeSummary(Request $request, $id)
    {
        $header = AuditHeader::findOrFail($id);

        $validated = $request->validate([
            'total_defects' => 'required|integer|min:0',
            'defect_percentage' => 'required|numeric|min:0|max:100',
            'conclusion' => 'required|in:Lulus,Tidak Lulus',
            'corrective_action' => 'required|string',
            'responsible_person' => 'required|string|max:100',
            'followup_status' => 'required|in:Belum,Proses,Selesai',
            'followup_due_date' => 'required|date',
        ]);

        AuditSummary::create([
            'audit_header_id' => $header->id,
            ...$validated
        ]);

        return redirect()->route('audits.show', $header->id)
            ->with('success', 'Audit berhasil diselesaikan!');
    }

    // Menampilkan detail audit lengkap
    public function show($id)
    {
        $audit = AuditHeader::with(['details.parameter', 'summary'])->findOrFail($id);
        return view('audits.show', compact('audit'));
    }

    // Menampilkan laporan
    public function report()
    {
        $audits = AuditHeader::with('summary')->latest()->get();
        return view('audits.report', compact('audits'));
    }

    // Form simple (all-in-one page)
    public function createSimple()
    {
        $parameters = AuditParameter::active()->orderBy('aspect')->orderBy('parameter_name')->get();
        return view('audits.create-simple', compact('parameters'));
    }

    // Store simple (AJAX)
    public function storeSimple(Request $request)
    {
        try {
            // Validasi
            $validated = $request->validate([
                'audit_code' => 'required|string|max:50|unique:audit_headers',
                'audit_date' => 'required|date',
                'auditor_name' => 'required|string|max:100',
                'department' => 'required|in:Cutting,Stitching,Assembling,Finishing',
                'shift' => 'required|in:Shift 1,Shift 2,Shift 3',
                'product_name' => 'required|string|max:100',
                'product_code' => 'required|string|max:50',
                'supplier_name' => 'required|string|max:100',
                'category' => 'required|in:Rutin,Pre-shipment,Penerimaan Supplier',
                'total_sample' => 'required|integer|min:1',
                'method' => 'required|in:Visual,Dimensional,Fungsi,Sampling',
                'parameter_id' => 'required|array',
                'parameter_id.*' => 'exists:audit_parameters,id',
                'value' => 'required|array',
                'value.*' => 'required|string|max:50',
                'note' => 'nullable|array',
                'note.*' => 'nullable|string',
                'total_defects' => 'required|integer|min:0',
                'defect_percentage' => 'required|numeric|min:0|max:100',
                'conclusion' => 'required|in:Lulus,Tidak Lulus',
                'corrective_action' => 'required|string',
                'responsible_person' => 'required|string|max:100',
                'followup_status' => 'required|in:Belum,Proses,Selesai',
                'followup_due_date' => 'required|date',
            ]);

            // Simpan Header
            $header = AuditHeader::create([
                'audit_code' => $validated['audit_code'],
                'audit_date' => $validated['audit_date'],
                'auditor_name' => $validated['auditor_name'],
                'department' => $validated['department'],
                'shift' => $validated['shift'],
                'product_name' => $validated['product_name'],
                'product_code' => $validated['product_code'],
                'supplier_name' => $validated['supplier_name'],
                'category' => $validated['category'],
                'total_sample' => $validated['total_sample'],
                'method' => $validated['method'],
            ]);

            // Simpan Details
            foreach ($validated['parameter_id'] as $index => $parameterId) {
                AuditDetail::create([
                    'audit_header_id' => $header->id,
                    'parameter_id' => $parameterId,
                    'value' => $validated['value'][$index],
                    'note' => $validated['note'][$index] ?? null,
                ]);
            }

            // Simpan Summary
            AuditSummary::create([
                'audit_header_id' => $header->id,
                'total_defects' => $validated['total_defects'],
                'defect_percentage' => $validated['defect_percentage'],
                'conclusion' => $validated['conclusion'],
                'corrective_action' => $validated['corrective_action'],
                'responsible_person' => $validated['responsible_person'],
                'followup_status' => $validated['followup_status'],
                'followup_due_date' => $validated['followup_due_date'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Audit berhasil disimpan! Kode Audit: ' . $header->audit_code,
                'audit_id' => $header->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan audit: ' . $e->getMessage()
            ], 422);
        }
    }
}

