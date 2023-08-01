<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Registration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('registrations')
            ->orderBy('registrations_count', 'desc')
            ->take(4)
            ->get();

        $departmentRegistrations = [];
        foreach ($departments as $department) {
            $departmentRegistrations[] = [
                'department' => $department,
                'registrations' => Registration::where('department_id', $department->id)
                    ->with('department', 'room', 'doctor', 'treatment')
                    ->take(3)
                    ->get(),
            ];
        }

        return view('home.index')
            ->with([
                'departmentRegistrations' => $departmentRegistrations,
            ]);
    }
}
