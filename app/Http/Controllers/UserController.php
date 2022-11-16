<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use Carbon\Carbon;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{      
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('back.users.index')->with('users', $users)->with('roles', $roles);
    }

    public function authProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('back.users.show')->with('user', $user);
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('back.users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('back.users.edit')->with('user', $user)->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
        ]);

        $admin = User::find($id);

        $admin->name = $request->input('name');
        $admin->email =  $request->input('email');

        if (empty($request->password)) {
            
        }else{
            $admin->password =  bcrypt($request->input('password'));
        }
        
        // Guardar primero el admin
        $admin->save();
        
        return redirect()->route('usuarios.index');
    }

    public function register()
    {
        return view('back.users.register');
    }

    public function changeColor()
    {
        $user = User::find(Auth::user()->id);

        if ($user->color_mode == 0) {
            $user->color_mode = 1;
        }else{
            $user->color_mode = 0;
        }
        $user->save();

        return redirect()->back();
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4',
        ]);

        $admin = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $rol = Role::findByName($request->rol);

        // Guardar primero el admin
        $admin->save();

        // Asignar el Rol
        $admin->assignRole($rol->name);

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if($user->id == Auth::user()->id){
            Session::flash('error', 'No puedes borrar el usuario que está actualmente conectado.');
            return redirect()->back();
        }else{
            $user->delete();

            Session::flash('exito', 'El Usuario ha sido borrado exitosamente.');

            return redirect()->route('usuarios.index');
        }        
    }
}
