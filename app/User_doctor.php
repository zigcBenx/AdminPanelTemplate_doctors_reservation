<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User_doctor extends Model
{


    protected $fillable = [
        'user_id',
        'doctor_id',
        'updated_at',
        'workspace',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
