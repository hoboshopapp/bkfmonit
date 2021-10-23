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

        foreach (range(1, 2) as $type_num) {
            DB::table('user_type')->insert([
                'id' => $type_num,
                'name' => $type_num == 1 ? 'admin' : 'user'
            ]);
        }
        foreach (range(1, 2) as $system_type) {
            DB::table('system_type')->insert([
                'id' => $system_type,
                'name' =>  $system_type == 1 ? 'setter' : 'hatcher'
            ]);
        }

        foreach (range(1, 5) as $num) {
            $user_id=DB::table('users')->insertGetId(
                [
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
                $system_type = rand(1,2);
                $sys_id = DB::table('systems')->insertGetId([
                    'system_type' => $system_type,
                    'serial' => $faker->macAddress(),
                    'name' => "system $sys_num",
                    'user_id' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                foreach (range(1, 20) as $rec_num) {
                    DB::table('systems_records')->insert([
                        'system_type' => $system_type,
                        'system_id' =>$sys_id,
                        'system_read' => rand(0, 1),
                        'temp1' => rand(70.00, 99.99),
                        'temp2' => rand(70.00, 99.99),
                        'hum' => rand(70.00, 99.99),
                        'set_temp1' => rand(70.00, 99.99),
                        'set_temp2' => rand(70.00, 99.99),
                        'set_hum' => rand(70.00, 99.99),
                        'fan_control' => rand(0, 1),
                        's_error' => $faker->sentence(10),
                        'fan' => rand(70.00, 99.99),
                        'pressure' => rand(70.00, 99.99),
                        'co2' => rand(70.00, 99.99),

                        'egg_turn' => rand(0, 1),
                        'dumper' => rand(0, 1),
                        'high_temp' => rand(0, 1),
                        'low_temp' => rand(0, 1),
                        'high_hum' => rand(0, 1),
                        'low_hum' => rand(0, 1),
                        'door_open' => rand(0, 1),
                        'fan_failure' => rand(0, 1),
                        'dry_wick' => rand(0, 1),
                        'error_program' => rand(0, 1),
                        'heater' => rand(0, 1),
                        'spray' => rand(0, 1),
                        'damper_opening' => rand(0, 1),
                        'damper_open' => rand(0, 1),
                        'auxlary_heater' => rand(0, 1),
                        'damper_closing' => rand(0, 1),
                        'damper_closed' => rand(0, 1),
                        'egg_left' => rand(0, 1),
                        'egg_right' => rand(0, 1),
                        'turning' => rand(0, 1),
                        'egg_failure' => rand(0, 1),
                        'blower' => rand(0, 1),
                        'auxlary_damper' => rand(0, 1),
                        'error' => rand(0, 1),

                        'date' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach (range(1, 20) as $rec_num) {
                    DB::table('systems_temp_records')->insert([
                        'system_type' => $system_type,
                        'system_id' => $sys_id,
                        'system_read' => rand(0, 1),
                        'temp1' => rand(70.00, 99.99),
                        'temp2' => rand(70.00, 99.99),
                        'hum' => rand(70.00, 99.99),
                        'set_temp1' => rand(70.00, 99.99),
                        'set_temp2' => rand(70.00, 99.99),
                        'set_hum' => rand(70.00, 99.99),
                        'fan_control' => rand(0, 1),
                        's_error' => $faker->sentence(10),
                        'fan' => rand(70.00, 99.99),
                        'pressure' => rand(70.00, 99.99),
                        'co2' => rand(70.00, 99.99),

                        'egg_turn' => rand(0, 1),
                        'dumper' => rand(0, 1),
                        'high_temp' => rand(0, 1),
                        'low_temp' => rand(0, 1),
                        'high_hum' => rand(0, 1),
                        'low_hum' => rand(0, 1),
                        'door_open' => rand(0, 1),
                        'fan_failure' => rand(0, 1),
                        'dry_wick' => rand(0, 1),
                        'error_program' => rand(0, 1),
                        'heater' => rand(0, 1),
                        'spray' => rand(0, 1),
                        'damper_opening' => rand(0, 1),
                        'damper_open' => rand(0, 1),
                        'auxlary_heater' => rand(0, 1),
                        'damper_closing' => rand(0, 1),
                        'damper_closed' => rand(0, 1),
                        'egg_left' => rand(0, 1),
                        'egg_right' => rand(0, 1),
                        'turning' => rand(0, 1),
                        'egg_failure' => rand(0, 1),
                        'blower' => rand(0, 1),
                        'auxlary_damper' => rand(0, 1),
                        'error' => rand(0, 1),

                        'date' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
