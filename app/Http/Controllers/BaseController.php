<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Month;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $function = new Payment();
        $payments = $function->getAllClients();

        $cont_debt_clients = 0;
        foreach ($payments as $payment) {
            if($payment->debt > 0 ){
                $cont_debt_clients ++;
            }
        }
        View::share('cont_debt_clients', $cont_debt_clients);
    }
}
