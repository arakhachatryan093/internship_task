<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name','assigned_to','description'];

    public function user_creator() {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function user_assigned() {
        return $this->hasOne(User::class,'id','assigned_to');
    }
}
