<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public function roles (){
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender_id', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasAnyRoles( $roles ){
        if ( $this->roles()->whereIn('type', $roles)->first()){
            return true;
        }

        return false;
    }

    
    public function hasRole( $role ){
        if ( $this->roles()->where('type', $role)->first()){
            return true;
        }

        return false;
    }

    public function array_first_occurence(array $arr)
    {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }

    public function users(){
        $dados = \DB::select('select u.id, u.name, u.email, g.type as gender, r.type as role from users u, role_users rs, roles r, genders g where u.id = rs.user_id and u.status = 1 and rs.role_id = r.id and u.gender_id = g.id and r.type != "Client"');
    
        $main = [];
        foreach( $dados as $dado ){
            $aux = [];
            foreach($dados as $copy ){
                if ( $dado->id == $copy->id ){
                    array_push( $aux, $copy->role );
                }
            }
            $user = [
                'id' => $dado->id,
                'name' => $dado->name,
                'gender' => $dado->gender,
                'email' => $dado->email,
                'role' => $aux,
            ];
            array_push( $main, $user );
        }

        $users = array();

        if (count($main) == 0) {
            return $users ;
        }

        do {
            $primeiroElemento = $main [$this->array_first_occurence($main)];

            foreach ($main as $key => $dado) {
                if ($primeiroElemento != null) {
                    if ($primeiroElemento['id'] == $dado['id']) {
                        unset($main[$key]);
                    }
                }
            }

            Array_push($users, $primeiroElemento);
        } while (count($main) > 0);

        return $users;
    }

    public function user($email){
        return \DB::select('select u.id, u.name, u.email, g.type as gender, r.type as role from users u, role_users rs, roles r, genders g where u.id = rs.user_id and u.status = 1 and u.email = ? and rs.role_id = r.id and u.gender_id = g.id and r.type != "Client"', [$email]);
    }
}
