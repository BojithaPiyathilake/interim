<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Hash;
use App\Http\Controllers\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;

class managerController extends Controller
{
    // public function index()
    // {

    //     $users = User::all();           //show all records for index

    //     return view('manager/managerIndex', [
    //         'users' => $users,
    //     ]);
    //     // $users = \App\Models\User::with('organization')->get();
    //     // return view('test/managerHome',  compact('users'));

    //     // $users = \App\Models\User::with('role')->get();
    //     // return view('test/managerHome',  compact('users'));
    // }

    public function show($id)           //show one record for moreinfo button
    {
        $user = User::find($id);                
        return view('manager/managerShow', [
            'user' => $user,
        ]);
    }

    public function edit($id)           //to open the edit view
    {
        $user = User::find($id);
        return view('manager/managerEdit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)       //to update the data via edit
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation_id' => $request->designation,
        ]);
        //ddd($request);
        return redirect ('/user/index')->with('message', 'User Updated Successfully');
    }


    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->organization_id = $request->organization;
        $user->role_id = $request->role;
        $user->designation_id = $request->designation;
        $user->created_by_user_id = $request->created_by;
        $user->status = $request->status;
        $user->password = bcrypt("password");
        $user->save();
        return redirect('/user/index')->with('message','User Successfully created');
    }

    // public function passwordReset(Request $request){
    //     $oldformpass = $request('oldpassword');
    //     if (Hash::check($oldformpass, Auth::user()->password, []))
    //     {
    //         return redirect('/manager/index')->with('message','User Successfully created');
    //     };
    // }
}
