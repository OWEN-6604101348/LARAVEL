<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * สร้างตาราง `chirps` ในฐานข้อมูล.
     */
    public function up(): void
    {
        // ใช้ Schema::create เพื่อสร้างตาราง `chirps`
        Schema::create('chirps', function (Blueprint $table) {
            // สร้างคอลัมน์ `id` เป็น primary key และ auto-increment
            $table->id();
            
            // สร้างคอลัมน์ `user_id` เป็น foreign key อ้างอิงไปยังตาราง `users`
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // `constrained()` จะทำการเชื่อมโยงกับตาราง `users` โดยอัตโนมัติ
            // `cascadeOnDelete()` จะลบข้อมูลในตาราง `chirps` เมื่อผู้ใช้ที่เกี่ยวข้องถูกลบ

            // สร้างคอลัมน์ `message` เพื่อเก็บข้อความของ Chirp
            $table->string('message');

            // สร้างคอลัมน์ `created_at` และ `updated_at` เพื่อเก็บเวลาที่สร้างและอัปเดตข้อมูล
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * ลบตาราง `chirps` หากมีการย้อนกลับการอพยพ (rollback).
     */
    public function down(): void
    {
        // ลบตาราง `chirps` หากการย้อนกลับการอพยพเกิดขึ้น
        Schema::dropIfExists('chirps');
    }
};
