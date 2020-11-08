<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Hash;
use App\Http\Controllers\Auth;
use App\Http\Requests\UserRequest;

class AdministratorController extends Controller
{
    public function index()
    {

        $users = User::all();           //show all records for index

        return view('admin/adminIndex', [
            'users' => $users,
        ]);
        // $users = \App\Models\User::with('organization')->get();
        // return view('test/adminHome',  compact('users'));

        // $users = \App\Models\User::with('role')->get();
        // return view('test/adminHome',  compact('users'));
    }

    public function show($id)           //show one record for moreinfo button
    {
        $user = User::find($id);                
        return view('admin/adminShow', [
            'user' => $user,
        ]);
    }

    public function edit($id)           //to open the edit view
    {
        $user = User::find($id);
        return view('admin/adminEdit', [
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
            'organization_id' => $request->organization,
        ]);
        //ddd($request);
        return redirect ('/administrator/index')->with('message', 'User Updated Successfully');
    }

    public function updateprivilege(Request $request, $id)      //to update peivileges via update
    {
        $user = User::find($id);
        $user->update([
            'role_id' => $request->role,
        ]);
        //ddd($request);
        return redirect ('/administrator/index')->with('message', 'Privilege Updated Successfully');
    }

    public function destroy($id)            //to delete a record
    {
        $user = User::find($id);
        $user->delete();

        //return redirect ('/administrator/index')->with('message', 'User Deleted Successfully');
        return redirect()->back()->with('message','User Successfully Deleted');
    }

    public function privilege($id)          //to open the privileges   
    {
        $user = User::find($id);
        return view('admin/adminPrivilegeEdit', [
            'user' => $user,
        ]);
    }

    public function self()              //open the self registered users using Activate button
    {
        $users = User::where('status', 0)->get();
        return view('admin/selfRegistered', [
            'users' => $users,
        ]);
    }

    public function activate($id)       //open the activate button in self registered users
    {
        $user = User::find($id);
        return view('admin/activate', [
            'user' => $user,
        ]);
    }
    
    public function doActivate(Request $request, $id)       //open the activate button in self registered users
    {
        $user = User::find($id);
        $user->update([
            'status' => $request->status,
            'role_id' => $request->role,
            'designation_id' => $request->designation,
            'organization_id' => $request->organization,
        ]);
        return redirect ('/administrator/selfRegistered')->with('message', 'User Activated Successfully');
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
        return redirect('/administrator/index')->with('message','User Successfully created');
    }

    // public function passwordReset(Request $request){
    //     $oldformpass = $request('oldpassword');
    //     if (Hash::check($oldformpass, Auth::user()->password, []))
    //     {
    //         return redirect('/administrator/index')->with('message','User Successfully created');
    //     };
    // }
}
