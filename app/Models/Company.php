<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable=['name','field','address','phone','note'];

    public function clients(){
        return $this->hasMany(Client::class);
    }

}
