<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            'Technology',
            'Health',
            'Science',
            'Sport',
            'Politics',
            'Entertainment',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insertOrIgnore([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: Delete the seeded categories.
        // In practice for a seed migration, we might leave them or delete specifically.
        // Since this is a "fix" migration, I'll leave down empty or delete specifically if strict.
        // Let's delete them to be clean.
        $categories = [
            'Technology',
            'Health',
            'Science',
            'Sport',
            'Politics',
            'Entertainment',
        ];
        
        DB::table('categories')->whereIn('name', $categories)->delete();
    }
};
