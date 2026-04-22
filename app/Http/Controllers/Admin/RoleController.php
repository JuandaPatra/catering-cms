<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $datas = Role::get();
        }
        return Datatables::of($datas)
            ->addIndexColumn()
             ->addColumn('action', function ($user) {

                $deleteUrl = route('roles.destroy', $user->id);

                return '
                <a href="' .route('roles.edit', $user->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                
                
                <form action="' . $deleteUrl . '" method="POST" style="display:inline-block">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-xs btn-danger show_confirm_delete">
                    <i class="fa fa-trash"></i> Delete
                </button>   
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new role
         $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Silahkan lengkapi semua data ');
            return redirect('/roles/create')
                ->withErrors($validator)
                ->withInput();
        }
         DB::beginTransaction();
        try {
            $input = Role::create([
                'name' => $request->name,
            ]);
        } catch (\throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all());
            Alert::error('Error', 'Silahkan lengkapi semua data ');
        } finally {
            DB::commit();
        }

        Alert::success('Success ', 'Berhasil menambahkan Role');

        return redirect()->route('roles.index');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }
    public function update(Request $request, $id)
    {
       try {
            $role = Role::findOrFail($id);

             if ($role->name === 'super-admin') {
                Alert::error('Delete Role', 'tidak boleh diganti' );
                abort(403, 'Role super-admin tidak boleh diganti');
            }
            $role->update([
                'name'  => $request->name,
                
            ]);
            return redirect()->route('roles.index');
        } catch (\throwable $th) {
            Alert::error('Update Role', 'error' . $th->getMessage());
            return redirect()->back();
        }

        return redirect()->back();

    }
    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
            $role = Role::findOrFail($id);

            if ($role->name === 'super-admin') {
                abort(403, 'Role super-admin tidak boleh dihapus');
            }

            $role->permissions()->detach();
            $role->users()->detach();
            $role->delete();
        });
        }
         catch (\throwable $th) {
            return redirect()->back();
        }
         

        return redirect()->back();
    }
}
