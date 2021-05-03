<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Models\Role;
use App\Models\Gender;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserChangePasswordRequest;

class userController extends BaseController
{

    public function registerForm()
    {
        if (Auth::check()) {
            if (Gate::denies('create')){
                return redirect()->back()->with('create-auth', 'Não tem permissão para registar dados');
            }
            $roles = Role::all();
            $genders = Gender::all();
            return view('painel.users.register', compact('roles', 'genders'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function editForm($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            if (Gate::denies('edit')){
                return redirect()->route('user.list')->with('edit-auth', 'Não tem permissão para actualizar dados');
            }
            $roles = Role::all();
            $user = User::find($id);
            $roles_users = RoleUser::all();
            $genders = Gender::all();

            return view('painel.users.edit', compact('roles', 'user', 'roles_users', 'genders'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function edit(UserUpdateRequest $request, $id)
    {
        try {

            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'gender_id' => $request->input('gender'),
            ];

            \DB::table('users')
                ->where('id', $request->user_id)
                ->update($user);

            \DB::table('role_users')
                ->where('user_id', $request->user_id)
                ->delete();

            foreach ($request->input('role') as $value) {
                $roleUser = new RoleUser();
                $role_id = Role::where('type', $value)->first()->id;
                $roleUser->user_id = $request->user_id;
                $roleUser->role_id = $role_id;
                $roleUser->save();
            }

            return redirect()->route('user.list')->with('updated', 'Usuário actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
            //return redirect()->back()->withInput($request->all());
        }
    }
    public function changePassword(UserChangePasswordRequest $request)
    {
        try {
            $id = User::where('email', $request->email)
            ->where('status', 1)
            ->first()->id;

            if (Auth::user()->id == $id) {
                if (Gate::denies('update-password')){
                    return redirect()->back()->with('update-auth', 'Não tem permissão para alterar senha');
                }
                /* Não pode mudar a senha do User logado */
                return redirect()->back()->with('warning','Acção não autorizada ao usuário logada');
            }

            if ($id) {
                if ($request->input('password') == $request->input('password-same')){
                    $user = [
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                    ];
    
                    \DB::table('users')
                        ->where('id', $id)
                        ->update($user);
    
                    return redirect()->back()->with('password-changed', 'Senha alterada com sucesso');
                }
                return redirect()->back()->with('password-different', 'Senhas não coencidem');

            }

            return redirect()->back()->with('user-not-found', 'Usuário não encontrado');

        } catch (\Exception $e) {
            if( "Trying to get property 'id' of non-object" == $e->getMessage() ){
                return redirect()->back()->with('error', 'Usuário não encontrado');
            }
            return redirect()->back()->with('error-exception', 'Ocorreu algum erro, verifica os dados e tenta novamente');
        }
    }

    public function list()
    {
        if (Auth::check()) {
            $function = new User();
            $users = $function->users();
            
            return view('painel.users.list', compact('users'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function remover(Request $request)
    {
        if (Auth::check()) {
            if (Gate::denies('delete')){
                return redirect()->route('user.list')->with('delete-auth', 'Não tem permissão para remover dados');
            }
            $user = User::find($request->input('element'));
            $user->status = 0;
            $user->save();
            return redirect()->route('user.list')->with('deleted', 'Usuário removido com sucesso');
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }

    public function register(UserRegisterRequest $request)
    {
        try {
            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'gender_id' => $request->input('gender'),
                'photo' => 'default.png',
                'password' => Hash::make($request->input('password'))
            ];

            $result = User::create($user);

            foreach ($request->input('role') as $value) {
                $roleUser = new RoleUser();
                $role_id = Role::where('type', $value)->first()->id;
                $roleUser->user_id = $result->id;
                $roleUser->role_id = $role_id;
                $roleUser->save();
            }
            return redirect()->route('user.register.form')->with('created', 'Usuário registado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
            //return redirect()->back()->withInput($request->all());
        }
    }
}
