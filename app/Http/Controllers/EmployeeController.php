<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        // รับค่าคำค้นหาจาก request
        $query = $request->input('search');

        // ถ้ามีการค้นหา
        if ($query) {
            // กรองพนักงานตามชื่อ (first_name หรือ last_name) โดยใช้ LIKE
            $employees = Employee::where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->paginate(10); // ใช้ pagination แสดง 10 รายการต่อหน้า
        } else {
            // ถ้าไม่มีการค้นหา ให้แสดงพนักงานทั้งหมดในแบบ paginate 10 รายการต่อหน้า
            $employees = Employee::paginate(10);
        }

        // ส่งข้อมูลพนักงานและคำค้นหากลับไปที่ frontend ผ่าน Inertia
        return Inertia::render('Employee/Index', [
            'employees' => $employees,
            'query' => $query, // ส่งค่าคำค้นหากลับไปยัง frontend
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ส่งหน้า Create Form ไปยัง Frontend
        return Inertia::render('Employees/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate ข้อมูลที่ได้รับจากฟอร์มการสร้างพนักงาน
        $validated = $request->validate([
            'emp_no' => 'required|unique:employees|max:10',  // ตรวจสอบว่า emp_no ไม่ซ้ำกับพนักงานคนอื่นและมีความยาวไม่เกิน 10
            'first_name' => 'required|max:50',  // ตรวจสอบว่า first_name ไม่เกิน 50 ตัวอักษร
        ]);

        // บันทึกข้อมูลพนักงานใหม่ลงในฐานข้อมูล
        Employee::create($validated);

        // Redirect ไปยังหน้า index หลังจากบันทึกสำเร็จ และส่งข้อความ 'Employee created successfully.'
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    public function show(Employee $employee)
    {
        // ส่งข้อมูลพนักงานไปยังหน้ารายละเอียด (show)
        return Inertia::render('Employees/Show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // ส่งข้อมูลพนักงานไปยังหน้าจัดการแก้ไข
        return Inertia::render('Employees/Edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate ข้อมูลที่ได้รับจากฟอร์มการแก้ไขพนักงาน
        $validated = $request->validate([
            'emp_no' => 'required|max:10',  // ตรวจสอบว่า emp_no ต้องมีความยาวไม่เกิน 10
            'first_name' => 'required|max:50',  // ตรวจสอบว่า first_name ต้องไม่เกิน 50 ตัวอักษร
        ]);

        // อัปเดตข้อมูลพนักงานในฐานข้อมูล
        $employee->update($validated);

        // Redirect ไปยังหน้า index หลังจากอัปเดตสำเร็จ และส่งข้อความ 'Employee updated successfully.'
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // ลบข้อมูลพนักงานจากฐานข้อมูล
        $employee->delete();

        // Redirect ไปยังหน้า index หลังจากลบสำเร็จ และส่งข้อความ 'Employee deleted successfully.'
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}


