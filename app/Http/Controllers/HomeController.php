<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function profile_update(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make( $request->password );

        $user_id = Auth::user()->id;

        $user = User::find($user_id);
        $user->name = $name;
        $user->email = $email;
        if ($user->password == null)
        {
            $user->password = Auth::user()->password;
        }
        else{
            $user->password = $password;
        }

        $user->save();

        return back()->with('success', 'successfully updated');
    }

}
