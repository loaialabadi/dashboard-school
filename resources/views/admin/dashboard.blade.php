@extends('layouts.index')

@section('content')


<div class="container">
    <h1>لوحة تحكم الأدمن</h1>
    <p>مرحباً، {{ Auth::user()->name }}!</p>
    <div class="row">
        <!-- يمكن وضع هنا كروت إحصائية أو روابط للإدارة -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">عدد المعلمين</h5>
                    <p class="card-text">سيتم إضافته لاحقاً</p>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('teachers.store') }}" class="btn btn-success">
عرض المدرسين</a>


@endsection
