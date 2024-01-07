<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    //for the timestamps not automatically in into the database
    public $timestamps = false;

    protected $fillable = ['nama', 'no_hp'];
    
    //for the table name not change to 'anggotas' by default
    public $table = "anggota";
}
