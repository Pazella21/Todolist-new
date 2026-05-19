<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //untuk menghubungkan model Todo dengan tabel todolist_1 di database
    protected $table="todolist_1";
    protected $fillable = ['task','is_done'];
}
