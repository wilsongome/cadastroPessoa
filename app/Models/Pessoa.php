<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    protected $fillable = ['cpf','nome', 'sobrenome', 'data_nascimento', 'email','genero'];
    public $timestamps = false;
}
