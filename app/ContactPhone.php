<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{

    public function setPhoneAttribute($value)
    {
        $value = str_replace('.','',$value);
        $value = str_replace('-','',$value);
        $value = str_replace('(','',$value);
        $value = str_replace(')','',$value);
        $value = str_replace(' ','',$value);

        $dd = substr($value,0,2);

        $this->attributes['Phone'] = '(' . $dd . ')' . substr($value,2);
    }

    public function relContact()
    {
        return $this->hasMany(Contact::class,'id','contact_id');
    }
}
