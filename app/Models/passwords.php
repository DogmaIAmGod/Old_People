<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passwords extends Model
{
    protected $fillable = [
    'individualID',
    'password'
    ];
}
