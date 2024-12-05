<?php

namespace App\Http\Controllers; 

// ใช้ namespaces และ dependencies ที่จำเป็น
use Illuminate\Support\Facades\Gate;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{

     // แสดงรายการทั้งหมดของ resource
     // ใช้ Inertia ในการ render หน้าแสดงรายการตามลำดับ(Index)

    public function index(): Response 
    {
        // ดึงข้อมูล chirps พร้อมข้อมูล user (เฉพาะ id และ name) เรียงจากล่าสุด
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }


     // แสดงฟอร์มสำหรับสร้าง resource ใหม่
    public function create()
    {
    }

    //เก็บ resource ใหม่ในฐานข้อมูล
    public function store(Request $request): RedirectResponse
    {
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมา
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        // สร้าง Chirp ใหม่ที่เชื่อมกับ user ที่กำลังล็อกอินอยู่
        $request->user()->chirps()->create($validated);
 
        // ส่งUser กลับไปยังหน้ารายการ chirps
        return redirect(route('chirps.index'));
    }

    //แสดง resource ที่ระบุ

    public function show(Chirp $chirp)
    {
    }


//แสดงฟอร์มสำหรับแก้ไข resource ที่ระบุ
    public function edit(Chirp $chirp)
    {
    }

      //อัปเดต resource ที่ระบุในฐานข้อมูล

    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        // ตรวจสอบสิทธิ์การแก้ไข
        Gate::authorize('update', $chirp);
 
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมา
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        // อัปเดตข้อมูลของ chirp
        $chirp->update($validated);
 
        // Redirect กลับไปยังหน้ารายการ chirps
        return redirect(route('chirps.index'));
    }

    /**
     * ลบ resource ที่ระบุออกจากฐานข้อมูล
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        // ตรวจสอบสิทธิ์การลบ
        Gate::authorize('delete', $chirp);
 
        // ลบ chirp
        $chirp->delete();
 
        //ส่งกลับไปยังหน้ารายการ chirps
        return redirect(route('chirps.index')); 
    }
}
