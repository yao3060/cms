<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $users = User::orderBy('id', 'desc')->paginate(2);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::orderBy('name')->get();
        return view('manage.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users'
        ]);

        if (!empty($request->password)) {
            $password = trim($request->password);
        }else{
            $password = '123456';
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);

        if($user->save()){

            if($request->roles && !empty($request->roles)){

                $user->syncRoles(explode(',', $request->roles));

            }

            return redirect()->route('users.show', $user->id);
        }else{
            Session::flash('danger', 'Sorry a problem occurred while creating this user.');
            return redirect()->route('users.create');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        return view('manage.users.show')
            ->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::orderby('name')->get();
        return view('manage.users.edit')
            ->withUser($user)
            ->withRoles($roles);
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
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' .$id
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password_option == 'auto') {
            //            $password = '123456';
            $user->password = Hash::make('123456');
        }else{

            if($request->password_option == 'manual'){
                $user->password = Hash::make(trim($request->password));
            }
        }

        if($user->save()){

            if($request->roles && !empty($request->roles)){

                $user->syncRoles(explode(',', $request->roles));

            }

            return redirect()->route('users.show', $user->id);
        }else{
            Session::flash('danger', 'Sorry a problem occurred while update this user.');
            return redirect()->route('users.edit', $user->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
