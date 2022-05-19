<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vlog extends Model
{
    use HasFactory;
    protected $table='vlogs';
    protected $fillable = [
        'name',
        'vlog1',
        'vlog2',
        'vlog3'
    ];
}
