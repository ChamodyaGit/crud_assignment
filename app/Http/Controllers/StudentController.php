<?php

namespace App\Http\Controllers;

use domain\Facades\StudentFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        return Inertia::render('Student/index');
    }

    public function store(Request $request)
    {
        return StudentFacade::store($request->all());
    }

    public function list()
    {
        $students = StudentFacade::all();
        return response()->json($students);
    }

    public function get($student_id)
    {
        $student = StudentFacade::get($student_id);
        return response()->json($student);
    }

    public function delete($student_id)
    {
        return StudentFacade::delete($student_id);
    }

    public function status($student_id)
    {
        return StudentFacade::status($student_id);
    }
}
