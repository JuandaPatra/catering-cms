<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function tableProduct(Request $request)
    {
        if ($request->ajax()) {
            $datas = Product::get();
        }

        return Datatables::of($datas)
            ->addIndexColumn()
            ->editColumn('price', function ($row) {
                return number_format($row->price, 0, ',', '.');
            })
            ->addColumn('action', function ($user) {

                $deleteUrl = route('product.destroy', $user->id);

                return '
                <a href="' . route('product.edit', $user->slug) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                
                
                 <form action="' . $deleteUrl . '" method="POST" style="display:inline-block">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button type="submit" class="btn btn-xs btn-danger show_confirm_delete">
                <i class="fa fa-trash"></i> Delete
            </button>   
                ';
            })
            ->rawColumns(['action'])
            ->make(true)
        ;
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'stok' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Silahkan lengkapi semua data ');
            return redirect('/product/create')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $input = Product::create([
                'name' => $request->name,
                'slug'  => Str::slug($request->name),
                'price' => $request->price,
                'stok'  => $request->stok
            ]);
        } catch (\throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all());
            Alert::error('Error', 'Silahkan lengkapi semua data ');
        } finally {
            DB::commit();
        }

        Alert::success('Success ', 'Berhasil menambahkan product');

        return redirect()->route('product.index');
    }

    public function edit($slug)
    {
        $product = Product::where('slug', '=', $slug)->first();

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $slug)
    {

        try {
            $product = Product::where('slug', '=', $slug);
            $product->update([
                'name'  => $request->name,
                'stok'  => $request->stok,
                'price' => $request->price
            ]);
            return redirect()->route('product.index');
        } catch (\throwable $th) {
            // Alert::error('Delete Product', 'error' . $th->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $product = Product::whereId($id);
            $product->delete();
        } catch (\throwable $th) {
            return redirect()->back();
        }

        return redirect()->back();
    }
}
