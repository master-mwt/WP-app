<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'create_post'],
            ['name' => 'delete_post'],

            ['name' => 'create_comment'],
            ['name' => 'delete_comment'],

            ['name' => 'create_channel'],
            ['name' => 'delete_channel'],
            ['name' => 'mod_channel_data'],

            ['name' => 'ban_user_from_channel'],    // soft ban
            ['name' => 'ban_user_from_platform'],   // hard ban

            ['name' => 'create_user'],
            ['name' => 'delete_user'],
            ['name' => 'mod_user_data'],

            ['name' => 'access_to_log'],
            ['name' => 'access_to_backend'],

            ['name' => 'silence_user_in_comment_section'],
            ['name' => 'report_user_in_channel'],
        ];

        foreach($services as $service) {
            App\Service::create($service);
        }
    }
}