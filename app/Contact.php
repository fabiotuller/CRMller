<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'document', 'email', 'emails_extra', 'phone1', 'phone2', 'phone3', 'phones_extra', 'firstname', 'lastname',
    ];

    public function relReceitaws()
    {
        return $this->hasOne(Receitaws::class,'id','receitaws_id');
    }

    public function relContactPhone()
    {
        return $this->hasMany(ContactPhone::class,'contact_id','id');
    }

}
