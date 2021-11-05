<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForigenKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropForeign('systems_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('systems_records', function (Blueprint $table) {
            $table->dropForeign('systems_records_system_id_foreign');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
        });
        Schema::table('systems_temp_records', function (Blueprint $table) {
            $table->dropForeign('systems_temp_records_system_id_foreign');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
