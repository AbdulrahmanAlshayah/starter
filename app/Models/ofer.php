<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ofer extends Model
{
    use HasFactory;

    protected $table = "ofers";
    protected $fillable = ['name','price','photo','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
}