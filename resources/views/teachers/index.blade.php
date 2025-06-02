@extends('layouts.index')

@section('content')
<div class="container">
    <h2>قائمة المعلمين</h2>

    <a href="{{ route('teachers.create') }}" class="btn btn-success mb-3">إضافة معلم</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>المادة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->subject->name }}</td>

                    <td>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>


                 <td>
                        <form action="{{ route('students.create', $teacher->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-success">اضافه طلاب</button>
                        </form>
                    </td>


                         <td>
                   <a href="{{ route('students.index', ['teacher_id' => $teacher->id]) }}" class="btn btn-success">
                    عرض طلاب المدرس {{ $teacher->name }}
                              </a>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection