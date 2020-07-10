<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'document', 'email', 'emails_extra', 'phone1', 'phone2', 'phone3', 'phones_extra', 'firstname', 'lastname',
    ];
}
