<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $fillable=['title','description','user_id','expected_time',
        'client_id','tax','total','start','end','status','reason'];
}
