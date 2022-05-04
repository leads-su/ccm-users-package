<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Identifier for user');
            $table->string('guid')->unique()->nullable()->comment('GUID for LDAP user');
            $table->string('domain')->nullable()->comment('Domain for LDAP user');
            $table->string('first_name', 32)->comment('First Name of user');
            $table->string('last_name', 32)->comment('Last Name of user');
            $table->string('username', 32)->unique()->comment('Username of user');
            $table->string('email', 128)->unique()->comment('E-Mail of user');
            $table->string('password')->comment('Hashed password of user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
