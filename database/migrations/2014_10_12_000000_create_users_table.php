<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('role_id')->nullable();
            $table->string('password')->nullable();
            $table->string('multiple_locations')->nullable();
            $table->integer('profile_type_id')->nullable();
            $table->string('agency_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('print_marketing_version')->unique();
            $table->string('agency')->nullable();
            $table->string('agency2')->nullable();
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('toll_free_number')->nullable();
            $table->string('member_cst_number')->nullable();
            $table->string('direct_number')->nullable();
            $table->string('office_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('website')->nullable();
            //Add api_token field
            $table->string('api_token', 60)->unique();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
