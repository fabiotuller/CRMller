<?php

use Illuminate\Database\Seeder;

class ContactStageOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'label' => '1 - Lead',
        ],[
            'label' => '2 - Buyer1',
        ],[
            'label' => '3 - Buyer2',
        ],[
            'label' => '4 - Buyer3',
        ],[
            'label' => '5 - Buyer4',
        ],[
            'label' => '6 - Customer',
        ],[
            'label' => '7 - Recurring_Customer',
        ],[
            'label' => '8 - Best_Customer',
        ]];

        DB::table('contact_stage_option')->insert($data);
    }
}
