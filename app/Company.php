<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function path(){
        return "/companies/{$this->id}";
    }
}
