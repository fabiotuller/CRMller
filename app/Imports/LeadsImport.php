<?php

namespace App\Imports;

use App\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'document' => $row['document'],
            'email' => $row['email'],
            'emails_extra' => $row['emails_extra'],
            'phone1' => $row['phone1'],
            'phone2' => $row['phone2'],
            'phone3' => $row['phone3'],
            'phones_extra' => $row['phones_extra'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
        ]);
    }
}
