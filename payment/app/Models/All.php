<?php

namespace App\Models;

use App\Http\Traits\Haser;
use App\Interfaces\Hashing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class All extends Model implements Hashing
{
    use Haser;
    
}
