<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()                  //show all records for index
    {
        $role = Auth::user()->role_id;

        if ($role == 1 || $role == 2) {         //Admin  
            $users = User::where('role_id', '>' , 1)->orWhereNull('role_id',)->get();      
            return view('admin/adminIndex', [
                'users' => $users,
            ]);
        } else if ($role == 3) {                //HoO    
            $users = User::where('role_id', '>' , 2)->orWhereNull('role_id')->get();
            return view('headOrg/headOrgIndex', [
                'users' => $users,
            ]);
        } else if ($role == 4) {            //Manager
            $users = User::where('role_id', '>' , 3)->orWhereNull('role_id')->get();
            return view('manager/managerIndex', [
                'users' => $users,
            ]);
        }

        // $users = \App\Models\User::with('organization')->get();
        // return view('test/adminHome',  compact('users'));

        // $users = \App\Models\User::with('role')->get();
        // return view('test/adminHome',  compact('users'));
    }

    public function alterPass(Request $request)
    {

        $rules = [
            'currentpassword' => 'required',
            'newpassword' => 'required | max:255',
            'newpassword' => 'min:6|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword' => 'min:6 | max:255|same:newpassword',

        ];

        $messages = [
            "newpassword.same" => "Passwords must match",
            "confirmpassword.same" => "Passwords must match",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Hash::check($request->currentpassword, Auth::user()->password, [])) {
            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => bcrypt($request->newpassword),
            ]);
                return redirect('/user/index')->with('message', 'Password Successfully Changed');
        } else
            return redirect('/user/index')->with('danger', 'Current Password is Incorrect');
    }
}
