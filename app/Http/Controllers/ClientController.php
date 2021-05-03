<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use Carbon\Carbon;
use App\Models\Hood;
use App\Models\Role;
use App\Models\Month;
use App\Models\Client;
use App\Models\Gender;
use App\Models\Worker;
use App\Models\Payment;
use App\Models\Province;
use App\Models\RoleUser;
use App\Models\Ocupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\PaymentRegisterRequest;


class clientController extends BaseController
{
    public function list()
    {
        if (Auth::check()) {
            $function = new Client();
            $clients = $function->clients();
            return view('painel.clients.list', compact('clients'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function clientRelatories()
    {
        if (Auth::check()) {
            if (Gate::denies('edit')) {
                return redirect()->back()->with('edit-auth', 'Não tem permissão para gerar relatórios');
            }
            $function = new Client();
            $workers = $function->clients();
            return view('painel.clients.ClientRelatories', compact('workers'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function relatoryHome()
    {
        if (Auth::check()) {
            $function = new Client();
            $clients = $function->clients();
            $males = 0;
            $females = 0;

            foreach( $clients as $client ){
                if ( $client->gender == 'Feminino'){
                    $females ++;
                }else{
                    $males ++;
                }
            }
            $clients = count($clients);

            return view('painel.clients.relatoryHome', compact('clients', 'females', 'males'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function paymentRelatories()
    {
        if (Auth::check()) {
            if (Gate::denies('edit')) {
                return redirect()->back()->with('edit-auth', 'Não tem permissão para gerar relatórios');
            }
            $function = new Payment();
            $payments = $function->getLastMonthPaymentUser();
            $months = Month::all();
            $actual_date = Carbon::now()->month;

            $dividas = [];
            foreach($payments as $payment){
                array_push($dividas, ($actual_date - $payment->month_id));
            }

            return view('painel.clients.paymentRelatories', compact('payments', 'months', 'dividas'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function historicRelatories()
    {
        if (Auth::check()) {
            if (Gate::denies('edit')) {
                return redirect()->back()->with('edit-auth', 'Não tem permissão para gerar relatórios');
            }
            $function = new Payment();
            $payments = $function->payments();
            $payments = $payments;
            return view('painel.clients.historicRelatories', compact('payments'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function payments()
    {
        if (Auth::check()) {
            $function = new Payment();
            $payments = $function->getAllClients();
            $months = Month::all();

            return view('painel.payments.list', compact('payments', 'months'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }

    public function relatoryPaymentsByYear( Request $request )
    {
        if (Auth::check()) {
            $function = new Payment();
            $year = Carbon::now()->year;
            if ($request->input('year')){
                $year = $request->input('year');
            }

            $payments = $function->getPaymentsByYear($year);

            return view('painel.payments.getPaymentsByYear', compact('payments', 'year'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function relatoryGetClientsByPaid()
    {
        if (Auth::check()) {
            $function = new Payment();
            $payments = $function->getClientsByPaid();

            return view('painel.payments.getClientsByPaid', compact('payments'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function relatoryGetClientsByDebt()
    {
        if (Auth::check()) {
            $function = new Payment();
            $payments = $function->getClientsByDebt();

            return view('painel.payments.getClientsByDebt', compact('payments'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }

    public function historics()
    {
        if (Auth::check()) {
            $function = new Payment();
            $payments = $function->payments();
            $payments = $payments;
            return view('painel.payments.historic', compact('payments'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function paymentRegisterForm()
    {
        if (Auth::check()) {
            if (Gate::denies('edit')) {
                return redirect()->back()->with('edit-auth', 'Não tem permissão para registar pagamento');
            }
            $months = Month::all();
            $function = new Client();
            $clients = $function->clients();
            return view('painel.payments.register', compact('months', 'clients'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function paymentRegister(PaymentRegisterRequest $request)
    {
        try {
            $payment = new Payment();
            $client = $payment->getClient($request->input('client'));

            $payment->status = $request->input('status');
            $payment->year = $request->input('year');
            $payment->month_id = $request->input('month');
            $payment->value = $request->input('value');
            $payment->client_id = $client[0]->client_id;
            $payment->save();

            
            /* Criação de variáveis de sessão */
            $function = new Payment();
            $payments = $function->getLastMonthPaymentUser();
            $actual_date = Carbon::now()->month;

            /* Contar quantos clientes têm dívidas */
            $cont_debt_client = 0;
            foreach($payments as $payment){
                if ( ($actual_date - $payment->month_id) > 0 ){
                    $cont_debt_client ++;
                }
            }
            
            /* Criar uma variável sessão com estes dados */
            session()->put('cont_debt_clients', $cont_debt_client);

            return redirect()->route('payment.register.form')->with('created', 'Pagamento registado com sucesso');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function editForm($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            if (Gate::denies('edit')) {
                return redirect()->route('client.list')->with('edit-auth', 'Não tem permissão para actualizar dados');
            }
            $function = new Client();
            $client = $function->client($id);

            $client = $client[0];
            $genders = Gender::all();
            $provinces = Province::all();
            $ocupations = Ocupation::all();
            return view('painel.clients.edit', compact('genders', 'provinces', 'ocupations', 'client'));
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
    }
    public function edit(ClientUpdateRequest $request, $id)
    {
        try {
            $old_user = User::where('id', $id)->first();
            $old_worker = Worker::where('user_id', $id)->first();
            $old_client = Client::where('worker_id', $old_worker->id)->first();

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

            /* Registar funcionário */
            $worker = [
                'birthday' => $request->input('birthday'),
                'bi' => $request->input('bi'),
                'phone' => $request->input('phone'),
                'user_id' => $id,
                'ocupation_id' => 4,
                'hood_id' => $old_worker->hood_id,
            ];

            \DB::table('workers')
                ->where('id', $old_worker->id)
                ->update($worker);

            /* Registar cliente */
            $client = [
                'worker_id' => $old_worker->id
            ];

            \DB::table('clients')
                ->where('id', $old_client->id)
                ->update($client);

            return redirect()->route('client.list')->with('updated', 'Cliente actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
            //return redirect()->back()->withInput($request->all());
        }
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
            return redirect()->route('client.list')->with('deleted', 'Cliente removido com sucesso');
        }
        return redirect()->route('login.form')->with('errorMessage', 'Faça login!');
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
            return view('painel.clients.register', compact('genders', 'provinces', 'ocupations'));
        }
        return redirect()->route('login.form')->with('erro-login', 'Faça login!');
    }

    public function register(ClientRegisterRequest $request)
    {

        try {
            /* Registar fotografia */
            $nameFile = 'default.png';

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension = $request->photo->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->photo->storeAs('clientes', $nameFile);

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
            $role_id = Role::where('type', 'Client')->first()->id;
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
            $worker = [
                'birthday' => $request->input('birthday'),
                'bi' => $request->input('bi'),
                'phone' => $request->input('phone'),
                'user_id' => $result->id,
                'ocupation_id' => 4,
                'hood_id' => $result_hood->id,
            ];

            $result_worker = Worker::create($worker);

            /* Registar cliente */
            $client = [
                'worker_id' => $result_worker->id
            ];
            Client::create($client);
            return redirect()->route('client.register.form')->with('created', 'Cliente registado com sucesso');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
