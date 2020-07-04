<?php

namespace App\Imports;

use App\Lead;
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
        return new Lead([
            'document' => $row['document'],
            'email' => $row['email'],
            'alternative_email' => $row['alternative_email'],
            'phone1' => $row['phone1'],
            'phone2' => $row['phone2'],
            'phone3' => $row['phone3'],
            'phone4' => $row['phone4'],
            'phone5' => $row['phone5'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'ecommerce_id' => $row['ecommerce_id'],
        ]);
    }
}
