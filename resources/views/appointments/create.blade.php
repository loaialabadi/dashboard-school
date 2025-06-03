@extends('layouts.index')

@section('content')
<div class="container">
    <h2>إضافة مواعيد للمعلم: {{ $teacher->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('appointments.store', $teacher->id) }}">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">التاريخ</label>
            <input type="date" id="date" name="date" class="form-control" 
                min="{{ $startDate->toDateString() }}" 
                max="{{ $endDate->toDateString() }}"
                value="{{ old('date') }}" required>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">الوقت</label>
            <input type="time" id="time" name="time" class="form-control" value="{{ old('time') }}" required>
            @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">حفظ الموعد</button>
    </form>
</div>
@endsection
