@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mb-4">لوحة المعلم: {{ $teacher->name }}</h2>

    <div class="mb-4">
        <a href="{{ route('students.create', $teacher->id) }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> إضافة طالب
        </a>

        <a href="{{ route('teachers.appointments', $teacher->id) }}" class="btn btn-warning">
            <i class="fas fa-calendar-alt"></i> عرض جدول الحصص
        </a>

        <a href="{{ route('students.index', ['teacher_id' => $teacher->id]) }}" class="btn btn-info">
            <i class="fas fa-users"></i> عرض الطلاب
        </a>

        <a href="{{ route('appointments.create', $teacher->id) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-plus"></i> إضافة حصة جديدة
        </a>

        <a href="{{ route('appointments.index', $teacher->id) }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> إضافة جدول مواعيد 6 شهور
        </a>
    </div>

    <h3>جدول الحصص</h3>
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>تاريخ ووقت الحصة</th>
                <th>إجراء</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->scheduled_at ? $appointment->scheduled_at->format('Y-m-d H:i') : 'غير محدد' }}</td>
                    <td>
                        <a href="{{ route('attendance.mark', $appointment->id) }}" class="btn btn-primary">
                            تسجيل الحضور
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>طلاب المعلم</h3>
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
