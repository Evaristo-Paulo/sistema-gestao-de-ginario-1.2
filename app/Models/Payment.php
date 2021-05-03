<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'month_id',
        'year',
        'status',
        'value',
    ];

    //Select Max(p.id) as payment_id, p.client_id from payments p GROUP by p.client_id
    public function getClient ($user_id){
        return \DB::select('SELECT u.name, c.id as client_id from users u, workers w, clients c where u.id = ? and w.user_id = u.id and c.worker_id = w.id', [$user_id]);
    }

    /* Clientes com e sem dívids */
    public function getAllClients(){
        return \DB::select('select u.name, m.name as month, (TIMESTAMPDIFF(MONTH, CONCAT_WS("-", p.year, p.month_id, 1), NOW())) as debt, p.year, m.id as month_id, c.id as client_id, w.phone, p.value, p.status, p.created_at as date from users u, payments p, clients c, months m, roles r, role_users rs, workers w where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and u.status = 1 and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and p.id IN (Select Max(p.id) as payment_id from payments p GROUP by p.client_id)');

    }
    public function payments (){
        return \DB::select('SELECT u.name, m.name as month, w.phone, p.value, p.year, p.status, p.created_at as date from users u, payments p, clients c, months m, workers w, roles r, role_users rs where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and u.status = 1 order by m.id');
    }

    public function getLastMonthPaymentUser(){
        return \DB::select('select u.name, m.name as month, m.id as month_id, c.id as client_id, w.phone, p.value, p.status, p.created_at as date from users u, payments p, clients c, months m, roles r, role_users rs, workers w where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and u.status = 1 and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and p.id IN (Select Max(p.id) as payment_id from payments p GROUP by p.client_id)');
    }

    public function getClientsByPaid(){
        return \DB::select('select u.name, m.name as month, TIMESTAMPDIFF(MONTH, CONCAT_WS("-", p.year, p.month_id, 1), NOW()) as debt, m.id as month_id, c.id as client_id, w.phone, p.value, p.status, p.created_at as date from users u, payments p, clients c, months m, roles r, role_users rs, workers w where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and u.status = 1 and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and p.id IN (Select Max(p.id) as payment_id from payments p GROUP by p.client_id) and TIMESTAMPDIFF(MONTH, CONCAT_WS("-", p.year, p.month_id, 1), NOW()) = 0');
    }
    public function getClientsByDebt(){
        return \DB::select('select u.name, m.name as month, TIMESTAMPDIFF(MONTH, CONCAT_WS("-", p.year, p.month_id, 1), NOW()) as debt, m.id as month_id, c.id as client_id, w.phone, p.value, p.status, p.created_at as date from users u, payments p, clients c, months m, roles r, role_users rs, workers w where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and u.status = 1 and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and p.id IN (Select Max(p.id) as payment_id from payments p GROUP by p.client_id) and TIMESTAMPDIFF(MONTH, CONCAT_WS("-", p.year, p.month_id, 1), NOW()) > 0');
    }

    public function getPaymentsByYear ( $year ){
        return \DB::select('SELECT u.name, m.name as month, w.phone, p.year,  p.value, p.status, p.created_at as date from users u, payments p, clients c, months m, workers w, roles r, role_users rs where p.month_id = m.id and c.id = p.client_id and w.id = c.worker_id and u.id = w.user_id and rs.user_id = u.id and rs.role_id = r.id and r.type = "Client" and u.status = 1 and p.year = ? order by u.name', [$year]);
    }
}
