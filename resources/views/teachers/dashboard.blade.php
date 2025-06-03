@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mb-4">لوحة المعلم: {{ $teacher->name }}</h2>

    <div class="mb-4">
        <a href="{{ route('students.create', $teacher->id) }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> إضافة طالب
        </a>

        <a href="{{ route('students.index', ['teacher_id' => $teacher->id]) }}" class="btn btn-info">
            <i class="fas fa-users"></i> عرض الطلاب
        </a>

        <a href="{{ route('attendance.show', ['classId' => 1]) }}" class="btn btn-warning">
            <i class="fas fa-calendar-check"></i> تسجيل الحصص
        </a>

            <!-- زر إضافة جدول المواعيد -->
    <a href="{{ route('appointments.index', $teacher->id) }}" class="btn btn-primary">
        <i class="fas fa-calendar-plus"></i> إضافة جدول مواعيد 6 شهور
    </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم الطالب</th>
                <th>الصف</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teacher->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class->name ?? '-' }}</td>
                    <td>
                        <!-- زر مراجعة الحضور -->
                        <a href="{{ route('attendance.monthly_summary', $student->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-calendar-alt"></i> مراجعة الحضور
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
