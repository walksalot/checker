<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Url_log;
class CreateUrlLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');

            $table->string('url');
            $table->string('domain');
            $table->string('link_code');
            $table->string('target_url');
            $table->string('anchor_text');
            $table->integer('nofollow');
            $table->float('score');

            $table->integer('links_on_page');
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
        Schema::drop('url_logs');
    }
}
