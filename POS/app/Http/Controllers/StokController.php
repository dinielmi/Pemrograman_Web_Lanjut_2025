<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok Barang',
            'list' => ['Home', 'Stok']
        ];
    
        $page = (object) [
            'title' => 'Data Stok Barang'
        ];
    
        $activeMenu = 'stok';
    
        $stok = StokModel::all();
        $barang = BarangModel::all(); // Tambahkan baris ini untuk ambil data barang
    
        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'stok' => $stok,
            'barang' => $barang // Kirim variabel ke view
        ]);
    }    

    

    // public function list(Request $request)
    // {
    //     $query = \App\Models\StokModel::query();
    
    //     if ($request->barang) {
    //         $query->where('barang_id', $request->barang);
    //     }
    
    //     return DataTables::of($query)
    //         ->addColumn('aksi', function ($row) {
    //             $btn = '<a href="' . route('stok.show', $row->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . route('stok.edit', $row->stok_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form action="' . route('stok.destroy', $row->stok_id) . '" method="POST" style="display:inline;">
    //                         ' . csrf_field() . method_field('DELETE') . '
    //                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
    //                      </form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) 
    //         ->addIndexColumn()     
    //         ->make(true);
    // }


    public function list(Request $request)
{
    $data = StokModel::with('barang', 'supplier'); // relasi barang & supplier

    if ($request->barang_id) {
        $data->where('barang_id', $request->barang_id);
    }

    return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row) {
            return '
            <a href="' . url("stok/$row->stok_id") . '" class="btn btn-info btn-sm mr-1">Detail</a>
            <button onclick="modalAction(\'' . url("stok/$row->stok_id/show_ajax") . '\')" class="btn btn-outline-info btn-sm mr-1" title="Detail">
                <i class="fa fa-eye"></i>
            </button>

            <a href="' . url("stok/$row->stok_id/edit") . '" class="btn btn-warning btn-sm mr-1">Edit</a>
            <button onclick="modalAction(\'' . url("stok/$row->stok_id/edit_ajax") . '\')" class="btn btn-outline-warning btn-sm mr-1" title="Edit">
                <i class="fa fa-edit"></i>
            </button>

            <form method="POST" action="' . url("stok/$row->stok_id") . '" style="display:inline;" onsubmit="return confirm(\'Yakin hapus data?\')">
                ' . csrf_field() . method_field('DELETE') . '
                <button class="btn btn-danger btn-sm mr-1">Delete</button>
            </form>

            <button onclick="modalAction(\'' . url("stok/$row->stok_id/delete_ajax") . '\')" class="btn btn-outline-danger btn-sm" title="Delete">
                <i class="fa fa-trash"></i>
            </button>
        ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Stok'
        ];

        $barang = BarangModel::all();
        $supplier = SupplierModel::all();
        $activeMenu = 'stok';

        return view('stok.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'stok_jumlah' => 'required|numeric',
            'stok_tanggal' => 'required|date',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        StokModel::create([
            'stok_jumlah' => $request->stok_jumlah,
            'stok_tanggal' => $request->stok_tanggal,
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function show(string $id)
    {
        $stok = StokModel::with(['barang', 'supplier'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok Barang',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Stok Barang'
        ];

        $activeMenu = 'stok';

        return view('stok.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $supplier = SupplierModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'barang' => $barang,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'stok_jumlah' => 'required|numeric',
            'stok_tanggal' => 'required|date',
            'barang_id' => 'required',
            'supplier_id' => 'required',
        ]);

        StokModel::find($id)->update([
            'stok_jumlah' => $request->stok_jumlah,
            'stok_tanggal' => $request->stok_tanggal,
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena terkait dengan data lain');
        }
    }

    public function create_ajax() {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        return view('stok.create_ajax')
            ->with('barang', $barang)
            ->with('supplier', $supplier);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'supplier_id' => 'required|integer',
                'stok_jumlah' => 'required|integer|min:1',
                'stok_tanggal' => 'required|date',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            StokModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan',
            ]);
        }
        return redirect('/');
    }
    public function show_ajax($id)
    {
        $stok = StokModel::with(['barang', 'supplier'])->find($id);
        return view('stok.show_ajax', compact('stok'));
    }

    public function edit_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        return view('stok.edit_ajax', ['stok' => $stok, 'barang' => $barang, 'supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'supplier_id' => 'required|integer',
                'stok_jumlah' => 'required|integer|min:1',
                'stok_tanggal' => 'required|date',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            $stok = StokModel::find($id);
            if ($stok) {
                $stok->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data stok tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                $stok->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data stok tidak ditemukan',
                ]);
            }
        }

        return redirect('/') ;
    }

    public function import()
{
    return view('stok.import');
}

public function import_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = ['file_stok' => ['required', 'mimes:xlsx', 'max:1024']];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validasi Gagal',
                'msgField'  => $validator->errors()
            ]);
        }

        $file = $request->file('file_stok');
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, false, true, true);
        $insert = [];

        if (count($data) > 1) {
            foreach ($data as $baris => $value) {
                if ($baris > 1) {
                    $insert[] = [
                        'stok_jumlah' => $value['A'],
                        'stok_tanggal'=> $value['B'],
                        'barang_id'   => $value['C'],
                        'supplier_id' => $value['D'],
                        'user_id'     => auth()->id(),
                        'created_at'  => now()
                    ];
                }
            }

            if (count($insert) > 0) {
                StokModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Data Stok berhasil diimport'
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Tidak ada data yang diimport'
            ]);
        }
    }

    return redirect('/');
}

public function export_excel()
{
    $data = StokModel::with('barang', 'supplier')->orderBy('stok_tanggal')->get();
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Jumlah');
    $sheet->setCellValue('B1', 'Tanggal');
    $sheet->setCellValue('C1', 'Barang');
    $sheet->setCellValue('D1', 'Supplier');
    $sheet->getStyle('A1:D1')->getFont()->setBold(true);

    $row = 2;
    foreach ($data as $value) {
        $sheet->setCellValue('A' . $row, $value->stok_jumlah);
        $sheet->setCellValue('B' . $row, $value->stok_tanggal);
        $sheet->setCellValue('C' . $row, $value->barang->barang_nama);
        $sheet->setCellValue('D' . $row, $value->supplier->supplier_nama);
        $row++;
    }

    foreach (range('A', 'D') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $sheet->setTitle('Stok Barang');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Stok Barang ' . date('Y-m-d H:i:s') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer->save('php://output');
    exit;
}

public function export_pdf()
{
    $stok = StokModel::orderBy('stok_id')->get(); // Ambil data stok barang
    $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);
    $pdf->setPaper('a4', 'portrait');
    $pdf->setOption("isRemoteEnabled", true);
    $pdf->render();

    return $pdf->stream('Data Stok Barang ' . date('Y-m-d H:i:s') . '.pdf');
}


}
