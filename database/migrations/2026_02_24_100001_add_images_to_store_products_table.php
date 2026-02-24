<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image_path');
        });

        // نقل الصور الحالية إلى مصفوفة images
        $products = DB::table('store_products')->whereNotNull('image_path')->get();
        foreach ($products as $row) {
            DB::table('store_products')->where('id', $row->id)->update([
                'images' => json_encode([$row->image_path]),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
