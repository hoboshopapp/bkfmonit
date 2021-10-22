<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->count(10)->create();
        $faker = Factory::create();

        foreach (range(1,2) as $type_num){
            DB::table('user_type')->insert([
                'id' => $type_num,
                'name' => "type $type_num"
            ]);
        }
        foreach (range(1,2) as $type_num){
            DB::table('system_type')->insert([
                'id' => $type_num,
                'name' => "type $type_num"
            ]);
        }

        foreach (range(1, 5) as $num) {
            DB::table('users')->insert(
                [
                    'id' => $num,
                    'user_type' => rand(1, 2),
                    'username' => $faker->userName(),
                    'name' => $faker->name(),
                    'password' => $faker->password(4, 8),
                    'api_key' => Str::random(50),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
            foreach (range(1, 10) as $sys_num) {
                DB::table('systems')->insert([
                    'system_type'=> rand(1,2),
                    'serial'=> $faker->macAddress(),
                    'name' => "sys $sys_num",
                    'user_id' => $num,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                foreach (range(1,20) as $rec_num){
                    DB::table('systems_records')->insert([
                        
                    ]);
                }
            }
        }
    }
}
