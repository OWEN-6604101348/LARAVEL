<?php

namespace App\Models;

// ใช้ Model ของ Laravel เพื่อให้สามารถทำงานร่วมกับฐานข้อมูล และกำหนดความสัมพันธ์
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{

     //กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้ (Mass Assignable)
     //เพื่อป้องกันการโจมตีแบบ Mass Assignment โดยอนุญาตเฉพาะฟิลด์ 'message' เท่านั้น
     
    protected $fillable = [
        'message',
    ];

    
     // กำหนดความสัมพันธ์กับโมเดล User
     //หมายถึง Chirp แต่ละรายการจะเชื่อมโยงกับ User เพียงหนึ่งคน

    public function user(): BelongsTo
    {
        // ใช้ belongsTo เพื่อบอกว่า Chirp นี้เป็นของ User
        return $this->belongsTo(User::class);
    }
}
