<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent {

    protected $table = "users"; // table name

    protected $fillable = [
        'ip_adress',
        'username',
        'password',
        'email',
        'first_name',
        'last_name'
    ];

}
