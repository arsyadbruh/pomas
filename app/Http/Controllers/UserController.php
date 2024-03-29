<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pageTitle = 'profile';
        $userProfile = User::find(Auth::user()->id);
        return view('dashboard.profile.index', compact('pageTitle', 'userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->id == $id) {
            $user = User::find($id);
            $pageTitle = 'editProfile';

            return view('dashboard.profile.edit', compact('user', 'pageTitle'));
        }

        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing password user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        //
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            $pageTitle = 'editPassword';
            if($user) {
                return view('dashboard.profile.editpassw', compact('pageTitle'));
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        // jika email user masih sama
        if($user->email === $request->email || $user->username === $request->username){
            $request->validate([
                'name' => 'required',
                'username' => 'required|alpha_dash',
                'email' => 'required|email'
            ]);
        } else { // jika email user tidak sama maka cek unique
            $request->validate([
                'name' => 'required',
                'username' => 'required|alpha_dash|unique:users,username',
                'email' => 'required|email|unique:users,email'
            ]);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profile.index')->with('profileSuccess', 'profile updated');

    }

    /**
     * Update the password user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validate = $request->validate([
            'oldPassword'=>'required',
            'password'=>'required|required_with:password_confirmation|confirmed'
        ]);

        $user = User::find(Auth::user()->id);
        if($user){
            if(Hash::check($request->oldPassword, $user->password) && $validate){
                $user->password = Hash::make($request->get('password'));
                $user->save();
                return redirect()->route('profile.index')->with('passwordSuccess', 'Password updated');
            }else{
                return redirect()->back()->with('error', 'Current Password doesnt match');
            }
        }

    }

}
