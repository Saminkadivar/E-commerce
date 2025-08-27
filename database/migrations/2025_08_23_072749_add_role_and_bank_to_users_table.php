<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */

//     public function up(): void {
//     Schema::table('users', function (Blueprint $table) {
//         $table->enum('role', ['admin','vendor','user'])->default('user')->index();
//         $table->string('phone')->nullable();
//         $table->text('address')->nullable();
//         $table->string('bank_name')->nullable();
//         $table->string('account_number')->nullable();
//         $table->string('ifsc')->nullable();
//         });
//     }
  

// };



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin','vendor','user'])->default('user')->index()->after('password');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('bank_name')->nullable()->after('address');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('ifsc')->nullable()->after('account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'address',
                'bank_name',
                'account_number',
                'ifsc',
            ]);
        });
    }
};
