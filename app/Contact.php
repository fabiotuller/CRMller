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

    public function relhistory()
    {
        return $this->hasMany(Contact_history::class,'contact_id','id');
    }

    public function relContactPhone()
    {
        return $this->hasMany(ContactPhone::class,'contact_id','id');
    }

    public function search(Array $data)
    {

        $sql = $this->where(function ($query) use($data) {
            if (isset($data['id']))
                $query->where('contacts.id',$data['id']);

            if (isset($data['document']))
                $query->where('contacts.document','LIKE','%'.$data['document'].'%');

            if (isset($data['email']))
                $query->where('contacts.email','LIKE','%'.$data['email'].'%');

//            if (isset($data['phone']))
//                $query->where('contact_phones.phone','LIKE','%'.$data['phone'].'%');

            if (isset($data['firstname']))
                $query->where('contacts.firstname','LIKE','%'.$data['firstname'].'%');

            if (isset($data['lastname']))
                $query->where('contacts.lastname','LIKE','%'.$data['lastname'].'%');

            if (isset($data['stage']))
                $query->where('contacts.stage','LIKE','%'.$data['stage'].'%');

        });//->toSql();dd($sql);

        return $sql;
    }

}
