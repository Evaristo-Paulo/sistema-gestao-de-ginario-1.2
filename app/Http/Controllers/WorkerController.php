<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Models\Hood;
use App\Models\Role;
use App\Models\Gender;
use App\Models\Worker;
use App\Models\Province;
use App\Models\RoleUser;
use App\Models\Ocupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WorkerUpdateRequest;
use App\Http\Requests\WorkerRegisterRequest;
use App\Http\Requests\WorkerChangePhotoRequest;

class workerController extends BaseController
{
    public function list()
    {
        if (Auth::check()) {
            $function = new Worker();
            $workers = $function->workers();
            return view('painel.workers.list', compact('workers'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function remover(Request $request)
    {
        if (Auth::check()) {
            if (Gate::denies('delete')) {
                return redirect()->route('user.list')->with('delete-auth', 'Não tem permissão para remover dados');
            }
            $user = User::find($request->input('element'));
            $user->status = 0;
            $user->save();
            return redirect()->route('worker.list')->with('deleted', 'Funcionário removido com sucesso');
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function editForm($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            if (Gate::denies('edit')) {
                return redirect()->route('worker.list')->with('edit-auth', 'Não tem permissão para actualizar dados');
            }
            $function = new Worker();
            $worker = $function->worker($id);

            $worker = $worker[0];
            //dd( $worker );
            $genders = Gender::all();
            $provinces = Province::all();
            $ocupations = Ocupation::all();
            return view('painel.workers.edit', compact('genders', 'provinces', 'ocupations', 'worker'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function edit(WorkerUpdateRequest $request, $id)
    {
        try {
            $old_user = User::where('id', $id)->first();
            $old_worker = Worker::where('user_id', $id)->first();

            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'photo' => $old_user->photo,
                'gender_id' => $request->input('gender'),
            ];

            \DB::table('users')
                ->where('id', $id)
                ->update($user);

            $hood = [
                'name' => $request->input('hood'),
                'street' => $request->input('street'),
                'municipe_id' => $request->input('municipe'),
            ];

            \DB::table('hoods')
                ->where('id', $old_worker->hood_id)
                ->update($hood);

            $new_worker = [
                'birthday' => $request->input('birthday'),
                'bi' => $request->input('bi'),
                'phone' => $request->input('phone'),
                'user_id' => $id,
                'ocupation_id' => $request->input('ocupation'),
                'hood_id' => $old_worker->hood_id,
            ];
            \DB::table('workers')
                ->where('id', $old_worker->id)
                ->update($new_worker);

            return redirect()->route('worker.list')->with('updated', 'Funcionário actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
            //return redirect()->back()->withInput($request->all());
        }
    }
    public function changePhoto(WorkerChangePhotoRequest $request)
    {
        try {
            if (Auth::check()) {
                $id = User::where('email', $request->email)
                    ->where('status', 1)
                    ->first();

                if ($id) {
                    $id = $id->id;
                    $old_user = User::where('id', $id)->first();

                    

                    $nameFile = null;

                    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                        $name = uniqid(date('HisYmd'));
                        $extension = $request->photo->extension();
                        $nameFile = "{$name}.{$extension}";
                        $upload = $request->photo->storeAs('funcionarios', $nameFile);

                        if (!$upload) {
                            dd('Não conseguimos gravar a foto');
                        }
                    }
                    $user = [
                        'name' => $old_user->name,
                        'email' => $old_user->email,
                        'photo' => $nameFile,
                        'gender_id' => $old_user->gender_id,
                    ];
                    \DB::table('users')
                        ->where('id', $old_user->id)
                        ->update($user);

                    return redirect()->back()->with('password-changed', 'Fotografia alterada com sucesso');
                }

                return redirect()->back()->with('user-not-found', 'Funcionário não encontrado');
            }
            return redirect()->route('login.form')->with('erro-login', 'Faça login!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error-exception', 'Ocorreu algum erro, verifica os dados e tenta novamente');
        }
    }
    public function registerForm()
    {
        if (Auth::check()) {
            if (Gate::denies('create')) {
                return redirect()->back()->with('create-auth', 'Não tem permissão para registar dados');
            }
            $genders = Gender::all();
            $provinces = Province::all();
            $ocupations = Ocupation::all();
            return view('painel.workers.register', compact('genders', 'provinces', 'ocupations'));
        }
        return redirect()->route('login.form')->with('erro-login', 'Faça login!');
    }
    public function register(WorkerRegisterRequest $request)
    {

        try {

            /* Registar fotografia */
            $nameFile = 'default.png';

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension = $request->photo->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->photo->storeAs('funcionarios', $nameFile);

                if (!$upload) {
                    dd('Não conseguimos gravar a foto');
                }
            }
            /* Registar user */
            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'photo' => $nameFile,
                'gender_id' => $request->input('gender'),
                'password' => Hash::make('user')
            ];

            $result = User::create($user);
            /* Registar role_user */
            $roleUser = new RoleUser();
            $role_id = Role::where('type', 'User')->first()->id;
            $roleUser->user_id = $result->id;
            $roleUser->role_id = $role_id;
            $roleUser->save();

            /* Registar bairro */
            $hood = [
                'name' => $request->input('hood'),
                'street' => $request->input('street'),
                'municipe_id' => $request->input('municipe'),
            ];
            $result_hood = Hood::create($hood);

            /* Registar funcionário */
            $worker = new Worker();
            $worker->birthday = $request->input('birthday');
            $worker->bi = $request->input('bi');
            $worker->phone = $request->input('phone');
            $worker->user_id = $result->id;
            $worker->ocupation_id = $request->input('ocupation');;
            $worker->hood_id = $result_hood->id;
            $worker->save();
            return redirect()->route('worker.register.form')->with('created', 'Funcionário registado com sucesso');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
