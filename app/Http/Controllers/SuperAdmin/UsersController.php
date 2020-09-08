<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('superadmin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){
            return redirect(route('superadmin.users.index'));
        }

        $roles = Role::all();

        return view('superadmin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            $request->session()->flash('success', $user->name. ' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }

         return redirect()->route('superadmin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('superadmin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('superadmin.users.index');
    }

    public function profile(){
        $courses = Course::where('author_id',Auth::id())->with('category:id,name')->get();
        $eCourses=Auth::user()->enrolledCourses;
        return view('profile', array('user' => Auth::user(),'courses'=>$courses,'enrolledCourses'=>$eCourses));
    }

    public function update_profile(Request $request){

        //Handle the user change of email, name, password and upload of avatar

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename) );

            $user->avatar = $filename;
        }

        $user->save();

        return view('profile', array('user' => Auth::user()));
    }

    public function password_change_view(Request $request){
        return view('auth.passwords.change');
    }

    public function password_update(Request $request){

        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('successMsg','Password is updated');
        }else{
            return redirect()->back()->with('errorMsg','Current Password is invalid');
        }
    }

}
