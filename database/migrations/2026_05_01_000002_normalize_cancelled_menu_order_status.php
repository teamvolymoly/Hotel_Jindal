<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('menu_orders')
            ->where('status', 'cancel')
            ->update(['status' => 'cancelled']);
    }

    public function down(): void
    {
        DB::table('menu_orders')
            ->where('status', 'cancelled')
            ->update(['status' => 'cancel']);
    }
};
