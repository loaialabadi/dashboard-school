
@extends('layouts.index')

@section('content')
<div class="container">
<h2>قائمة الطلاب الخاصة بـ </h2>

    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">إضافة طالب</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>المعلم</th>
                <th>المادة</th>
                <th>ولي الأمر</th>
                <th>  رقم ولي الأمر</th>
                
                <th> حذف الطالب</th>

            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->teacher->name }}</td>
                    <td>{{ $student->teacher->subject->name }}</td>
                    <td>{{ $student->parent->name }}</td>
                    <td>{{ $student->parent->phone }}</td>

                    <td>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
                    </td>
                   

                </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection