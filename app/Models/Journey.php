<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    use HasFactory;

    protected $fillable=['name'];
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
