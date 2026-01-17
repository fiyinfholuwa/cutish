<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('available_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('duration');
            $table->decimal('price', 8, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

          DB::table('available_services')->insert([
            [
                'name' => 'Wig Installation',
                'description' => 'Professional glueless, closure, frontal & 360 wig installations for a flawless, natural look.',
                'duration' => '2-3 hours',
                'price' => 120.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silk Press',
                'description' => 'Transform your natural hair with our lightweight, bouncy silk press.',
                'duration' => '2 hours',
                'price' => 90.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bridal Styling',
                'description' => 'Custom hair looks for brides on their special day.',
                'duration' => '2-3 hours',
                'price' => 200.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sew-In Weaves',
                'description' => 'Flawless sew-in installations with seamless blending.',
                'duration' => '3-4 hours',
                'price' => 150.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
        
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_services');
    }
};
