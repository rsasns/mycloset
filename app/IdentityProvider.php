<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityProvider extends Model
{
    protected $primaryKey = ['provider_name', 'provider_id'];
    public $incrementing = false;
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
