<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::with('subject')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

 public function store(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|unique:teachers',
        'phone'      => 'nullable|string',
        'subject_id' => 'required|exists:subjects,id',
    ]);

    try {
        Teacher::create($request->only(['name', 'email', 'phone', 'subject_id']));
        return redirect()->route('teachers.index')->with('success', 'تم إضافة المعلم بنجاح');
    } catch (\Exception $e) {
        return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}

public function edit(Teacher $teacher)
{
    $subjects = Subject::all();
    return view('teachers.edit', compact('teacher', 'subjects'));
}


public function destroy(Teacher $teacher)
{
    $teacher->delete();

    return redirect()->route('teachers.index')->with('success', 'تم حذف المعلم بنجاح');
}

}