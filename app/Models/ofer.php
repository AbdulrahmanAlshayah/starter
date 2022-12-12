<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ofer extends Model
{
    use HasFactory;

    protected $table = "ofers";
    protected $fillable = ['name_ar','name_en','price','photo','details_ar','details_en','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
    //public $timestamps = true;
}
