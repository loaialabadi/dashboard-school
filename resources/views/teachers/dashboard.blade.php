@extends('layouts.index')

@section('content')
<div class="container my-4">

    <h2 class="mb-4">📘 لوحة المعلم: {{ $teacher->name }}</h2>

    <div class="d-flex flex-wrap gap-2 mb-4">

        <a href="{{ route('students.create', $teacher->id) }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> إضافة طالب
        </a>

        <!-- <a href="{{ route('teachers.appointments', $teacher->id) }}" class="btn btn-warning">
            <i class="fas fa-calendar-alt"></i> جدول الحصص
        </a> -->

        <a href="{{ route('teachers.showstudents', ['teacher' => $teacher->id]) }}" class="btn btn-info">
            <i class="fas fa-users"></i> عرض طلاب المعلم
        </a>



<a href="{{ route('teachers.showgroups', $teacher->id) }}" class="btn btn-success">
    <i class="fas fa-users"> عرض المجموعات</i>  
</a>


<a  href="{{ route('teachers.showattendance', $teacher->id) }}" class="btn btn-info">
    <i class="fas fa-check-circle"></i> عرض الالفصور الدراسيه

</a>
        <a href="{{ route('appointments.index', $teacher->id) }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> إنشاء جدول 6 شهور
        </a>

    </div>
<!-- 
    <h3 class="mb-3">📅 جدول الحصص</h3>

    @if($appointments->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>📆 التاريخ</th>
                        <th>⏰ الوقت</th>
                        <th>📁 المجموعة</th>
                        <th>📝 إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>
                                @if($appointment->group)
                                    <span class="badge bg-info">{{ $appointment->group->name }}</span>
                                @else
                                    <span class="text-muted">بدون مجموعة</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('attendance.mark', $appointment->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-check-circle"></i> تسجيل الحضور
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">لا توجد حصص مجدولة لهذا المعلم حتى الآن.</div>
    @endif -->

</div>
@endsection
