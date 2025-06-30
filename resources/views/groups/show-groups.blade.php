@extends('layouts.index')

@section('content')

<div class="container">
    <a href="{{ route('groups.create', $teacher->id) }}" class="btn btn-dark">
    <i class="fas fa-plus-circle"></i> إنشاء مجموعة جديدة
</a>

        <a href="{{ route('appointments.create', $teacher->id) }}" class="btn btn-secondary">
            <i class="fas fa-plus"></i> إضافة حصة جديدة
        </a>
    <h2>مجموعات المدرس: {{ $teacher->name }}</h2>

    @forelse ($groups as $group)
        <div class="card mb-3">
            <div class="card-header">
                <strong>اسم المجموعة:</strong> {{ $group->name }}
            </div>
            <div class="card-body">
                <h5>الطلاب في المجموعة:</h5>
                <ul>
                    @foreach ($group->students as $student)
                        <li>{{ $student->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p>لا توجد مجموعات لهذا المدرس.</p>
    @endforelse
</div>
@endsection
