<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable =
        ['name', 'phone', 'email', 'company_id', 'address', 'facebook','linkedin','instagram', 'islead','note'];

    public function company(){
        return $this->belongsTo(Company::class);
}

}
