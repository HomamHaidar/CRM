<?php

namespace App\Http\Controllers\UsersAndRole;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions','users')->get();


        $users=User::all();

        return view('Role.index', compact('roles','users',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('Role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);
       if ($request->permissions) {
           foreach ($request->permissions as $pn) {
               $role->givePermissionTo($pn);
           }
       }


        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.', 'اضافة');

        return redirect('role');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);

        return view('Role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('Role.edit', compact('role', 'permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $role->update([
            'name' => $request->name
        ]);


       $role->syncPermissions($request->input('permissions'));
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');

        return redirect('role');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.', 'حذف');

        return redirect('role');

    }

}
