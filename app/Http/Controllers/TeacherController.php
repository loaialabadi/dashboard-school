<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // عرض جميع المعلمين مع المادة الخاصة بهم
    public function index()
    {
        $teachers = Teacher::with('subject')->get();
        return view('teachers.index', compact('teachers'));
    }

    // عرض نموذج إضافة معلم جديد
    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    // تخزين معلم جديد مع التحقق من البيانات
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

    // عرض نموذج تعديل معلم محدد
    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    // تحديث بيانات معلم محدد مع التحقق من البيانات
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'      => 'nullable|string|max:20',
            'subject_id' => 'required|exists:subjects,id',  // أضفت تحقق للمادة هنا (مهم)
        ]);

        $teacher->update($request->only(['name', 'email', 'phone', 'subject_id']));

        return redirect()->route('teachers.index')->with('success', 'تم تحديث بيانات المعلم بنجاح.');
    }

    // حذف معلم محدد
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'تم حذف المعلم بنجاح');
    }

    // لوحة بيانات المعلم (لوحة تحكم خاصة)
    public function dashboard($id)
    {
        $teacher = Teacher::with('students')->findOrFail($id);

        return view('teachers.dashboard', compact('teacher'));
    }
}
