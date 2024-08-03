<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'company_id', 'address', 'facebook', 'linkedin', 'instagram', 'islead', 'note','status','why_status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function activities()
    {
        return $this->hasmany(Activity::class);
    }
    public function deals()
    {
        return $this->hasmany(Deal::class);
    }
}

