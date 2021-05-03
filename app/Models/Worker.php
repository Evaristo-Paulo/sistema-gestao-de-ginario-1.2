<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'birthday',
        'bi',
        'phone',
        'user_id',
        'ocupation_id',
        'hood_id',
    ];

    /* All workers */
    public function workers()
    {
        return \DB::select('Select u.id, u.name, u.email, w.phone, oc.name as ocupation, g.type as gender, h.name as hood, h.street, m.name as municipe, pr.name as province from hoods h, provinces pr, municipes m, workers w, users u, roles r, role_users rs, ocupations oc, genders g where w.user_id = u.id and oc.id = w.ocupation_id and g.id = u.gender_id and h.id = w.hood_id and h.municipe_id = m.id and pr.id = m.province_id and u.status = 1 and rs.user_id = u.id and r.id = rs.role_id and r.type != "Client"');
    }

    /* get worker */
    public function worker($id)
    {
        return \DB::select('
        Select u.id, u.name, w.phone, u.photo, w.bi, w.birthday, u.email, oc.name as ocupation, g.type as gender, h.name as hood, h.street, m.name as municipe, pr.name as province from hoods h, provinces pr, municipes m, workers w, users u, roles r, role_users rs, ocupations oc, genders g where w.user_id = u.id and u.id = ? and oc.id = w.ocupation_id and g.id = u.gender_id and h.id = w.hood_id and h.municipe_id = m.id and pr.id = m.province_id and u.status = 1 and rs.user_id = u.id and r.id = rs.role_id and r.type != "Client"', [$id]);
    }
}
