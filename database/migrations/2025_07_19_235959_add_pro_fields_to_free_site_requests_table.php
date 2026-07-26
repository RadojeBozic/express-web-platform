<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('free_site_requests', function (Blueprint $table) {
            $table->string('type')->default('basic')->after('offer_items');
            $table->string('pdf_file')->nullable()->after('type');
            $table->string('video_url')->nullable()->after('pdf_file');
            $table->string('address')->nullable()->after('video_url');
            $table->string('phone2')->nullable()->after('address');
            $table->string('phone3')->nullable()->after('phone2');
            $table->string('email2')->nullable()->after('phone3');
            $table->string('email3')->nullable()->after('email2');
        });
    }

    public function down(): void
    {
        Schema::table('free_site_requests', function (Blueprint $table) {
            $table->dropColumn([
                'type', 'pdf_file', 'video_url', 'address',
                'phone2', 'phone3', 'email2', 'email3'
            ]);
        });
    }
};
