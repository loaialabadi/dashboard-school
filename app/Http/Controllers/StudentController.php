<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\ParentModel;
use App\Models\Student;  // تأكد من إضافة هذا السطر
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
public function index()
{
    $students = Student::with('teacher.subject', 'parent')->paginate(10); // عرض 10 طلاب في كل صفحة

    return view('students.index', compact('students'));
}



// public function index(Request $request)
// {
//     $teacherId = $request->input('teacher_id'); // جلب teacher_id من الرابط

//     $students = Student::with('teacher', 'parent','subjects')
//                        ->where('teacher_id', $teacherId)
//                        ->get();

//     return view('students.index', compact('students', 'teacherId'));
// }

    public function create()
    {
        $teachers = Teacher::all();
        $parents = ParentModel::all();
        return view('students.create', compact('teachers', 'parents'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|unique:students,phone',
        'teacher_id' => 'required|exists:teachers,id', // تأكد من وجود المعلم
        'parent_id' => 'nullable|exists:parent_models,id', // تأكد من وجود ولي الأمر إذا تم اختياره
        'parent_name' => 'nullable|string|max:255',
        'parent_phone' => 'nullable|string|max:255',
    ]);

    // إضافة ولي الأمر جديد إذا تم اختياره
    if ($request->input('createParentToggle') == '1') {
        $parent = ParentModel::create([
            'name' => $request->input('parent_name'),
            'phone' => $request->input('parent_phone'),
            'password' => bcrypt($request->input('parent_password')), // تأكد من تشفير كلمة المرور
        ]);
    } else {
        $parent = ParentModel::find($request->input('parent_id'));
    }

    // إضافة الطالب
    $student = Student::create([
        'name' => $request->input('name'),
        'phone' => $request->input('phone'),
        'teacher_id' => $request->input('teacher_id'),
        'parent_id' => $parent->id, // ربط الطالب بولي الأمر
    ]);

return back()->with('success', 'تم إضافة الطالب بنجاح');
}

public function edit(Student $student)
{
    $teachers = Teacher::all();
    $parents = ParentModel::all();
    return view('students.edit', compact('student', 'teachers', 'parents'));
}


public function destroy($id)
{
    $student = Student::find($id);

    if (!$student) {
        return back()->withErrors(['error' => 'الطالب غير موجود في قاعدة البيانات.']);
    }

    try {
        $student->delete();
        return back()->with('success', 'تم حذف الطالب بنجاح.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'حدث خطأ أثناء الحذف: ' . $e->getMessage()]);
    }
}

public function update(Request $request, Student $student)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255|unique:students,phone,' . $student->id,
        'teacher_id' => 'required|exists:teachers,id',
        'parent_id' => 'required|exists:parent_models,id',
    ]);

    $student->update([
        'name' => $request->input('name'),
        'phone' => $request->input('phone'),
        'teacher_id' => $request->input('teacher_id'),
        'parent_id' => $request->input('parent_id'),
    ]);

    return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب بنجاح.');
}


}

    

