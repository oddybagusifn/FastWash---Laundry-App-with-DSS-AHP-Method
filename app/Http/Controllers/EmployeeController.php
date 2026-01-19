<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobDesk;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('detail.jobDesk')->paginate(5);
        $jobDesks = JobDesk::all();

        return view('pages.employees', compact('employees', 'jobDesks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:100',
            'job_desk_id' => 'required',
            'employment_type' => 'required',
            'salary' => 'required|numeric',
        ]);

        $employee = Employee::create([
            'employee_name' => $request->employee_name,
        ]);

        $employee->detail()->create([
            'job_desk_id' => $request->job_desk_id,
            'employment_type' => $request->employment_type,
            'salary' => $request->salary,
        ]);

        return back()->with('success', 'Employee created');
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update([
            'employee_name' => $request->employee_name,
        ]);

        $employee->detail()->update([
            'job_desk_id' => $request->job_desk_id,
            'employment_type' => $request->employment_type,
            'salary' => $request->salary,
        ]);

        return back()->with('success', 'Employee updated');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', 'Employee deleted');
    }
}
