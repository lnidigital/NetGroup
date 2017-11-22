<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('members')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Michael Reyes',
                'email' => 'michael.p.reyes@ml.com ',
                'primary_number' => '703-663-2909',
                'secondary_number' => '',
                'address' => '8300 Greensboro Drive, 1st Floor',
                'zipcode' => '22102',
                'city' => 'McLean',
                'state' => 'VA',
                'company_name' => 'Merrill Lynch',
                'group_id' => 1,
                'user_id' => 1,
                'industry_id' => 1,
                'created_at' => '2016-06-04 13:51:10',
                'updated_at' => '2016-06-04 13:51:10',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Seong Bae',
                'email' => 'seong@lnidigital.com',
                'primary_number' => '703-955-6819',
                'secondary_number' => '',
                'address' => '42466 Legacy Park Drive',
                'zipcode' => '20148',
                'city' => 'Ashburn',
                'state' => 'VA',
                'company_name' => 'LNI Digital Marketing',
                'group_id' => 1,
                'user_id' => 1,
                'industry_id' => 1,
                'created_at' => '2016-06-04 13:51:10',
                'updated_at' => '2016-06-04 13:51:10',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Sunny Luk',
                'email' => 'Lukfinancialgroup@gmail.com',
                'primary_number' => '240-386-9508',
                'secondary_number' => '',
                'address' => '6608 Green Ash ct',
                'zipcode' => '22152',
                'city' => 'Springfield',
                'state' => 'VA',
                'company_name' => 'Luk Financial Group',
                'group_id' => 1,
                'user_id' => 1,
                'industry_id' => 1,
                'created_at' => '2016-06-04 13:51:10',
                'updated_at' => '2016-06-04 13:51:10',
            ),
        ));
    }
}