<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show(User $user)
    {
    	echo 'Name: '.$user->name;
    	echo '<br/>Email: '.$user->email;
    	echo '<br/>Type: '.$user->type;
    	echo '<br/>Created On: '.$user->created_at;
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
}
