<?php

namespace App\Imports;

use App\Contact;
use App\ContactPhone;
use App\Helpers\Strings;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeadsImportRule implements ToCollection
{

    public function collection(Collection $rows)
    {
        for ($i=1 ; $i <= $rows->count() -1 ;$i++) {
            $contact = Contact::withTrashed()->where('document', 'LIKE', $rows[$i][0])->first();

            if (isset($contact)){

                Contact::withTrashed()->where('id',$contact->id)->update([
                    'document' => $rows[$i][0],
                    'email' => $rows[$i][1],
                    'emails_extra' => $rows[$i][2],
                    'firstname' => $rows[$i][6],
                    'lastname' => $rows[$i][7],
                    'deleted_at' => NULL
                ]);

                $phones = NULL;
                $phones = $contact->relContactPhone()->get()->where('phone','LIKE',Strings::phone($rows[$i][3]));

                if (count($phones) == 0){
                    if (!empty($rows[$i][3])){
                        $contact_phones = new ContactPhone();
                        $contact_phones->phone = $rows[$i][3];
                        $contact_phones->contact_id = $contact->id;
                        $contact_phones->save();
                    }
                }

                $phones = NULL;
                $phones = $contact->relContactPhone()->get()->where('phone','LIKE',Strings::phone($rows[$i][4]));

                if (count($phones) == 0){
                    if (!empty($rows[$i][3])){
                        $contact_phones = new ContactPhone();
                        $contact_phones->phone = $rows[$i][4];
                        $contact_phones->contact_id = $contact->id;
                        $contact_phones->save();
                    }
                }

                $phones = NULL;
                $phones = $contact->relContactPhone()->get()->where('phone','LIKE',Strings::phone($rows[$i][5]));

                if (count($phones) == 0){
                    if (!empty($rows[$i][3])){
                        $contact_phones = new ContactPhone();
                        $contact_phones->phone = $rows[$i][5];
                        $contact_phones->contact_id = $contact->id;
                        $contact_phones->save();
                    }
                }

                $phones = NULL;

//                $phones = $contact->relContactPhone()->get();
//
//                foreach ($phones as $phone){
//                    ContactPhone::where('id',$phone->id)->update([
//                        'phone' => $rows[$i][3]
//                    ]);
//                    dump($phone);
//                }
//                die();

            }else {
                $contact = new Contact();

                $contact->document = $rows[$i][0];
                $contact->email = $rows[$i][1];
                $contact->emails_extra = $rows[$i][2];
                $contact->firstname = $rows[$i][6];
                $contact->lastname = $rows[$i][7];

                $contact->save();

                if (!empty($rows[$i][3])){
                    $contact_phones = new ContactPhone();
                    $contact_phones->phone = $rows[$i][3];
                    $contact_phones->contact_id = $contact->id;
                    $contact_phones->save();
                }
                if (!empty($rows[$i][4])){
                    $contact_phones = new ContactPhone();
                    $contact_phones->phone = $rows[$i][4];
                    $contact_phones->contact_id = $contact->id;
                    $contact_phones->save();
                }
                if (!empty($rows[$i][5])){
                    $contact_phones = new ContactPhone();
                    $contact_phones->phone = $rows[$i][5];
                    $contact_phones->contact_id = $contact->id;
                    $contact_phones->save();
                }
            }
        }

        return redirect()->route('lead.index');

    }
}
