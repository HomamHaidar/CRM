<?php

namespace App\Http\Controllers\UsersAndRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users= User::with('roles')->get();
        return view('User.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated(); // Validate the incoming request
        $user=User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'password'=>Hash::make($request->password),
            ]

        );
        $roleExists = Role::where('name', 'default')->exists();
    if ($roleExists)
    {
    $user->assignRole('default');
    }
        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $user=User::findOrFail($id) ;
            $roles=Role::all();
        return view('User.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
       $user= User::findOrFail($id);
        $request->validated();
        $user->Update(
             [
                 'name'=>$request->name,
                 'email'=>$request->email,
                 'address'=>$request->address,
                 'password'=>Hash::make($request->password),
             ]
         );
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
         return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');

        return redirect('user');

    }
}
