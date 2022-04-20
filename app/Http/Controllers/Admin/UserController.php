<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view_user()
    {
        $user = User::all();
        $i = 1;
        return view('admin/view_user')->with('user', $user)->with('i', $i);
    }

    public function delete(Request $request)
    {

        $id = $request->id;

        $user = User::find($id);
        $post = Post::where('user_id', $id);
        if ($post->count() > 0){
            $post->delete();
        }
        $user->delete();


        return back('msg', 'deleted successfully');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $dt = new DateTime();
        $new_date = $dt->format('Y-m-d H:i:s');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->email_verified_at = $new_date;
        $user->save();

        return back()->with('msg', 'successfully registered');
    }
}
