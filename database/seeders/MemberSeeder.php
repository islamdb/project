<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            'R',
            'K',
            'U'
        ];

        foreach ($members as $member) {
            $data[] = [
                'user_id' => 1,
                'name' => $member,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('members')->insert($data);
    }
}
