<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'docUsuario', 
        'nombreCompleto', 
        'user', 
        'password', 
        'email', 
        'celular', 
        'enLinea', 
        'estudiosUsuario', 
        'especialUsuario', 
        'estadoUsuario', 
        'fotoUsuario', 
        'idRol',
    ]; 
}
