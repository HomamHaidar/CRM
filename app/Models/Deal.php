<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable=['title','description','user_id','expected_time',
        'client_id','quantity','tax','total','start','end','status','reason',
        'journey_id','stage_id','product_id'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function activities()
    {
        return $this->belongsTo(Activity::class);
    }
    public function journey()
    {
        return $this->belongsTo(Journey::class);
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
