<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        return view('auth.profile', compact('user'));
    }

    public function change_password(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'new_password' => 'required|min:6',
    		'conf_password' => 'required|same:new_password'
    		]);
        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old_password])) {
            // Authentication passed...
            Auth::user()->update(['password' => bcrypt($request->new_password)]);
            return redirect('/home')->with('message','Password Successfully changed! Enter new password in the next login');
        }
        else {
            return redirect('/change-password')->with('message','Wrong password entered!');
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
            ]);
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/edit-users')->with('message','User '.$user->name.' successfully added!!!');
    }
    public function edit_type(Request $request)
    {
        $user = User::find($request->id);
        if ($user->id != Auth::user()->id) {
            $user->type = $request->type;
            $user->save();
        }
        return back();
    }
    public function delete_user(User $user)
    {
        if ($user->type != 'superadmin') {
            $user->delete();
            return back()->with('message','Successfully deleted user:'.$user->name);
        }
        else {
            return back()->with('error', 'Cannot delete a Superadmin');
        }
    }
    public function change_user_password(Request $request)
    {
        if (Auth::user()->id == $request->id) {
            return back()->with('error', 'Cannot change password by this method for own account');
        }
        else {
            $user = User::find($request->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', 'Successfully changed password for user:'.$user->name.' to:'.$request->password.'');
        }
    }
    public function restore_user(Request $request)
    {
        $user = User::onlyTrashed()->find($request->id);
        $user->restore();
        return back()->with('success','User '.$user->name.' successfully restored');
    }
    public function permanently_delete_user(Request $request)
    {
        $user = User::onlyTrashed()->find($request->id);
        $user->forceDelete();
        return back()->with('message','Permenantly deleted user:'.$user->name);
    }
}
