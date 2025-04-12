<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // public function list(Request $request)
    // {
    //     $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'alamat');

    //     return DataTables::of($suppliers)
    //         // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' .
    //                 url('/supplier/' . $supplier->supplier_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                 '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    //         ->make(true);
    // }

    public function list(Request $request)
    {
        $data = SupplierModel::query();

        if ($request->has('filter_kode') && $request->filter_kode) {
            $data->where('supplier_kode', 'like', '%' . $request->filter_kode . '%');
        }

        if ($request->has('filter_nama') && $request->filter_nama) {
            $data->where('supplier_nama', 'like', '%' . $request->filter_nama . '%');
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($supplier) {
                return '
                    <a href="' . url("supplier/$supplier->supplier_id") . '" class="btn btn-info btn-sm mr-1">Detail</a>
                    <button onclick="modalAction(\'' . url("supplier/$supplier->supplier_id/show_ajax") . '\')" class="btn btn-outline-info btn-sm mr-1" title="Detail">
                        <i class="fa fa-eye"></i>
                    </button>

                    <a href="' . url("supplier/$supplier->supplier_id/edit") . '" class="btn btn-warning btn-sm mr-1">Edit</a>
                    <button onclick="modalAction(\'' . url("supplier/$supplier->supplier_id/edit_ajax") . '\')" class="btn btn-outline-warning btn-sm mr-1" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="POST" action="' . url("supplier/$supplier->supplier_id") . '" style="display:inline;" onsubmit="return confirm(\'Yakin hapus data?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-danger btn-sm mr-1">Delete</button>
                    </form>

                    <button onclick="modalAction(\'' . url("supplier/$supplier->supplier_id/delete_ajax") . '\')" class="btn btn-outline-danger btn-sm" title="Delete">
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
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif

        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_id',
            'supplier_nama'     => 'required|string|max:100',
            'alamat'   => 'required|string',
        ]);

        SupplierModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama'     => $request->supplier_nama,
            'alamat'   => $request->alamat,
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }
    public function show(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail supplier',
            'list'  => ['Home', 'supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail supplier'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif

        return view('supplier.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'supplier'   => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }
    public function edit(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit supplier',
            'list'  => ['Home', 'supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit supplier'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif

        return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama'     => 'required|string|max:100',
            'alamat'   => 'required|string',
        ]);

        SupplierModel::find($id)->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama'     => $request->supplier_nama,
            'alamat'   => $request->alamat,
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
    }
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id); // Hapus data supplier

            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
     {
         // cek apakah request berupa ajax
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'supplier_kode'   => 'required|string|max:10|unique:m_supplier,supplier_kode',
                 'supplier_nama'   => 'required|string|max:100',
                 'alamat' => 'required|string|max:255',
             ];
             // use Illuminate\Support\Facades\Validator;
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false, // response status, false: error/gagal, true: berhasil
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(), // pesan error validasi
                 ]);
             }
 
             SupplierModel::create($request->all());
             return response()->json([
                 'status' => true,
                 'message' => 'Data supplier berhasil disimpan',
             ]);
         }
         return redirect('/');
     }

     public function edit_ajax(string $id)
     {
         $supplier = SupplierModel::find($id);
         return view('supplier.edit_ajax', compact('supplier'));
     }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode'   => 'required|string|max:10',
                'supplier_nama'   => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = SupplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data supplier berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data supplier tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    public function show_ajax($id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.show_ajax', compact('supplier'));
    }

    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);

            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
 
    public function import()
{
    return view('supplier.import');
}

public function import_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = ['file_supplier' => ['required', 'mimes:xlsx', 'max:1024']];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validasi Gagal',
                'msgField'  => $validator->errors()
            ]);
        }

        $file = $request->file('file_supplier');
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
                        'supplier_nama'   => $value['A'],
                        'supplier_alamat' => $value['B'],
                        'created_at'      => now()
                    ];
                }
            }

            if (count($insert) > 0) {
                SupplierModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Data Supplier berhasil diimport'
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
    $data = SupplierModel::select('supplier_kode', 'supplier_nama', 'supplier_telp', 'supplier_alamat')->orderBy('supplier_nama')->get();

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Kode');
    $sheet->setCellValue('C1', 'Nama Supplier');
    $sheet->setCellValue('D1', 'Telepon');
    $sheet->setCellValue('E1', 'Alamat');
    $sheet->getStyle('A1:E1')->getFont()->setBold(true);

    $no = 1;
    $baris = 2;
    foreach ($data as $value) {
        $sheet->setCellValue('A' . $baris, $no++);
        $sheet->setCellValue('B' . $baris, $value->supplier_kode);
        $sheet->setCellValue('C' . $baris, $value->supplier_nama);
        $sheet->setCellValue('D' . $baris, $value->supplier_telp);
        $sheet->setCellValue('E' . $baris, $value->supplier_alamat);
        $baris++;
    }

    foreach (range('A', 'E') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $sheet->setTitle('Data Supplier');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Data Supplier ' . date('Y-m-d H-i-s') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $writer->save('php://output');
    exit;
}


}