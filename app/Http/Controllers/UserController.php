<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role_id;

        if ($role == 1 || $role == 2) {
            $users = User::all();           //show all records for index
            return view('admin/adminIndex', [
                'users' => $users,
            ]);
        // } else if ($role == 2) {
        //     $users = User::all();
        //     return view('admin/adminIndex', [
        //         'users' => $users,
        //     ]);
        } else if ($role == 3) {
            dd("hoo view");
        } else if ($role == 3) {
            dd("manager view");
        } else if ($role == 3) {
            dd("hello");
        } else if ($role == 3) {
            dd("hello");
        }

        // $users = \App\Models\User::with('organization')->get();
        // return view('test/adminHome',  compact('users'));

        // $users = \App\Models\User::with('role')->get();
        // return view('test/adminHome',  compact('users'));
    }

    public function alterPass(Request $request)
    {
        $role = Auth::user()->role_id;

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
            if ($role == 1 || $role == 2) {
                return redirect('/administrator/index')->with('message', 'Password Successfully Changed');
            }
            if ($role == 3) {
                return redirect('/HEADOFORGANIZATION/index')->with('message', 'Password Successfully Changed');
            }
            if ($role == 3) {
                return redirect('/MANAGER/index')->with('message', 'Password Successfully Changed');
            }
        } else
        if ($role == 1 || $role == 2) {
            return redirect('/administrator/index')->with('danger', 'Current Password is Incorrect');
        }
        if ($role == 3) {
            return redirect('/HEADOFORGANIZATION/index')->with('danger', 'Current Password is Incorrect');
        }
        if ($role == 3) {
            return redirect('/MANAGER/index')->with('danger', 'Current Password is Incorrect');
        }
    }
}
