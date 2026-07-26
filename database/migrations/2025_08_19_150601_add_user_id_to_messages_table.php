<?php


use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;


return new class extends Migration {

    public function up(): void

    {

        Schema::table('messages', function (Blueprint $t) {

            if (!Schema::hasColumn('messages', 'user_id')) {

                $t->unsignedBigInteger('user_id')->nullable()->index()->after('id');

            }

        });

    }


    public function down(): void

    {

        Schema::table('messages', function (Blueprint $t) {

            if (Schema::hasColumn('messages', 'user_id')) {

                $t->dropColumn('user_id');

            }

        });

    }

};
