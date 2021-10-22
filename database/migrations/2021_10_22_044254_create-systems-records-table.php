<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('system_type');
            $table->foreign('system_type')->references('id')->on('system_type');
            $table->unsignedBigInteger('system_id');
            $table->foreign('system_id')->references('id')->on('systems');

            $table->tinyInteger('system_read');
            $table->float('temp1' , 4 , 2);
            $table->float('temp2' , 4 , 2);
            $table->float('hum' , 4 , 2);
            $table->float('set_temp1' , 4 , 2);
            $table->float('set_temp2' , 4 , 2);
            $table->float('set_hum' , 4 , 2);

            $table->tinyInteger('fan_control');
            $table->text('s_error');
            $table->float('fan' , 4 , 2);
            $table->float('pressure' , 4 , 2);
            $table->float('co2' , 4 , 2);

            $table->tinyInteger('egg_turn');
            $table->tinyInteger('dumper');
            $table->tinyInteger('high_temp');
            $table->tinyInteger('low_temp');
            $table->tinyInteger('high_hum');
            $table->tinyInteger('low_hum');
            $table->tinyInteger('door_open');
            $table->tinyInteger('fan_failure');
            $table->tinyInteger('dry_wick');

            $table->tinyInteger('error_program');
            $table->tinyInteger('heater');
            $table->tinyInteger('spray');
            $table->tinyInteger('damper_opening');
            $table->tinyInteger('damper_open');
            $table->tinyInteger('auxlary_heater');
            $table->tinyInteger('damper_closing');
            $table->tinyInteger('damper_closed');
            $table->tinyInteger('egg_left')->default(0);
            $table->tinyInteger('egg_right')->default(0);
            $table->tinyInteger('turning')->default(0);
            $table->tinyInteger('egg_failure')->default(0);
            $table->tinyInteger('blower');
            $table->tinyInteger('auxlary_damper');
            $table->tinyInteger('error');

            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems_records');
    }
}
