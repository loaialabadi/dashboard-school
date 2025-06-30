@extends('layouts.index')

@section('content')
<div class="container">
    <a href="{{ route('groups.create', $teacher->id) }}" class="btn btn-dark mb-3">
        <i class="fas fa-plus-circle"></i> إنشاء مجموعة جديدة
    </a>

    <h2>مجموعات المدرس: {{ $teacher->name }}</h2>

    @forelse ($groups as $group)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>اسم المجموعة:</strong> {{ $group->name }}
                <a href="{{ route('groups.show', ['teacher' => $teacher->id, 'group' => $group->id]) }}" class="btn btn-primary btn-sm">
                    عرض تفاصيل
                </a>
            </div>
        </div>
    @empty
        <p>لا توجد مجموعات لهذا المدرس.</p>
    @endforelse
</div>
@endsection
