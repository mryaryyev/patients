<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Registration;
use App\Models\Room;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{public function index(Request $request)
{
    $request->validate([
        'departments' => 'nullable|array|min:0',
        'rooms' => 'nullable|array|min:0',
        'doctors' => 'nullable|array|min:0',
        'patient' => 'nullable|integer|min:0',
        'sort' => 'nullable|string|in:new-to-old,old-to-new,low-to-high,high-to-low',
        'page' => 'nullable|integer|min:1',
        'perPage' => 'nullable|integer|in:15,30,60,120',
    ]);

    $f_department = $request->has('department') ? $request->department : 0;
    $f_room = $request->has('room') ? $request->room : 0;
    $f_doctor = $request->has('doctor') ? $request->doctor : 0;
    $f_patient = $request->has('patient') ? $request->patient : 0;
    $f_sort = $request->has('sort') ? $request->sort : null;
    $f_page = $request->has('page') ? $request->page : 1;
    $f_perPage = $request->has('perPage') ? $request->perPage : 15;

    $registrations = Registration::when($f_department, function ($query) use ($f_department) {
        $query->where('brand_id', $f_department);
    })
        ->when($f_room, function ($query) use ($f_room) {
            $query->where('room_id', $f_room);
        })
        ->when($f_doctor, function ($query) use ($f_doctor) {
            $query->where('year_id', $f_doctor);
        })
        ->when($f_patient, function ($query) use ($f_patient) {
            $query->where('color_id', $f_patient);
        })
        ->with('department', 'room', 'doctor', 'patient')
        ->when(isset($f_sort), function ($query) use ($f_sort) {
            if ($f_sort == 'old-to-new') {
                $query->orderBy('id');
            } elseif ($f_sort == 'high-to-low') {
                $query->orderBy('price', 'desc');
            } elseif ($f_sort == 'low-to-high') {
                $query->orderBy('price');
            } else {
                $query->orderBy('id', 'desc');
            }
        }, function ($query) {
            $query->orderBy('id', 'desc');
        })
        ->paginate($f_perPage, ['*'], 'page', $f_page)
        ->withQueryString();

    $departments = Department::orderBy('name')
        ->get();
    $rooms = Room::orderBy('name')
        ->get();
    $doctors = Doctor::orderBy('name')
        ->get();
    $patients = Patient::orderBy('name')
        ->get();

    return view('patient.index')
        ->with([
            'registrations' => $registrations,
            'departments' => $departments,
            'rooms' => $rooms,
            'doctors' => $doctors,
            'patients' => $patients,
            'f_department' => $f_department,
            'f_room' => $f_room,
            'f_doctor' => $f_doctor,
            'f_patient' => $f_patient,
            'f_sort' => $f_sort,
            'f_perPage' => $f_perPage,
        ]);
}


    public function show($id)
    {
        $car = Registration::when(!auth()->check(), function ($query) {
            $query->where('active', 1);
        })
            ->with('department', 'room', 'doctor', 'patient')
            ->findOrFail($id);

        $similar = Registration::where('department_id', $registration->department->id)
            ->where('room_id', $registration->room->id)
            ->where('doctor_id', $car->year->id)
            ->with('department', 'room', 'doctor', 'patient')
            ->take(4)
            ->get();

        return view('patient.show')
            ->with([
                'registration' => $registration,
                'similar' => $similar,
            ]);
    }
}

