<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'document','email','alternative_email','phone1','phone2','phone3','phone4','phone5','firstname','lastname','ecommerce_id',
    ];
}
