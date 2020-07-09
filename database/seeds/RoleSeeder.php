<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
                'name' => 'Administrator',
                'label' => 'have all access system',
                'created_at' => date("Y-m-d H:i:s",time()),
                'updated_at' => date("Y-m-d H:i:s",time())
                ],[
                'name' => 'Lead_Manager',
                'label' => 'access all method Lead system',
                'created_at' => date("Y-m-d H:i:s",time()),
                'updated_at' => date("Y-m-d H:i:s",time())
                ]
        ];

        DB::table('roles')->insert($data);
    }
}
