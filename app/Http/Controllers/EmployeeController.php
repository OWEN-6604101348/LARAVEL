<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Inertia\Inertia;

class EmployeeController 
extends Controller { 
public function index()
{
    $employees = Employee::select('emp_no','first_name')->take(10)->get();

//$employees = DB::table('employees')->take(10)->get(); 
//$data = json_decode(json_encode($employees), true);
 // ใช้ json ในการแสดงผล array 
// Log::info($data); return response($data); 
    return inertia::render('Employee/Index',[
        'employees'=> $employees,
    ]); 
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
