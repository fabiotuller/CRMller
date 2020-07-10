<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeadsImportRule implements ToCollection
{

    public function collection(Collection $rows)
    {
        for ($i=1 ; $i <= $rows->count() -1 ;$i++) {
            $contact = Contact::where('document', 'LIKE', $rows[$i][0])->first();

            if (isset($contact)){
                Contact::where('id',$contact->id)->update([
                    'document' => $rows[$i][0],
                    'email' => $rows[$i][1],
                    'emails_extra' => $rows[$i][2],
                    'phone1' => $rows[$i][3],
                    'phone2' => $rows[$i][4],
                    'phone3' => $rows[$i][5],
                    'phones_extra' => $rows[$i][6],
                    'firstname' => $rows[$i][7],
                    'lastname' => $rows[$i][8],
                ]);
            } else {
                $contact = new Contact();

                $contact->document = $rows[$i][0];
                $contact->email = $rows[$i][1];
                $contact->emails_extra = $rows[$i][2];
                $contact->phone1 = $rows[$i][3];
                $contact->phone2 = $rows[$i][4];
                $contact->phone3 = $rows[$i][5];
                $contact->phones_extra = $rows[$i][6];
                $contact->firstname = $rows[$i][7];
                $contact->lastname = $rows[$i][8];

                $contact->save();
            }
        }

        return redirect()->route('lead.index')->with('message', 'Lead Atualizado!');

    }
}
