
@extends('layouts.index')

@section('content')
<div class="container">
    <h2>إضافة طالب جديد</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        {{-- بيانات الطالب --}}
        <div class="mb-3">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label> رقم الهاتف</label>
            <input type="number" name="phone" class="form-control" required>
<<<<<<< HEAD
            
    <div class="form-group">
    <label for="academic_stage">المرحلة الدراسية</label>
    <select name="academic_stage" class="form-control" required>
        @foreach ($stages as $stage)
            <option value="{{ $stage }}" {{ old('academic_stage', $student->academic_stage ?? '') == $stage ? 'selected' : '' }}>
                {{ $stage }}
            </option>
        @endforeach
    </select>
</div>

=======
        </div>
        <div class="mb-3">
            <label>الصف الدراسي</label>
            <select name="grade" class="form-control" required>
                <option value="أولى ابتدائي">أولى ابتدائي</option>
                <option value="ثانية ابتدائي">ثانية ابتدائي</option>
                <option value="ثالثة ابتدائي">ثالثة ابتدائي</option>
                <option value="رابعة ابتدائي">رابعة ابتدائي</option>
                <option value="خامسة ابتدائي">خامسة ابتدائي</option>
                <option value="سادسة ابتدائي">سادسة ابتدائي</option>
                <option value="أولى إعدادي">أولى إعدادي</option>
                <option value="ثانية إعدادي">ثانية إعدادي</option>  
                <option value="ثالثة إعدادي">ثالثة إعدادي</option>
                <option value="أولى ثانوي">أولى ثانوي</option>  
                <option value="ثانية ثانوي">ثانية ثانوي</option>
                <option value="ثالثة ثانوي">ثالثة ثانوي</option>
            </select>
</div>
</div>
>>>>>>> 9bc6eba291411c5a942f787a29c23fac27225125

        {{-- اختيار الصف الدراسي --}}
        {{-- اختيار المعلم --}}
        <div class="mb-3">
            <label>اختر المعلم</label>
            <select name="teacher_id" class="form-control" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->subject->name }})</option>
                @endforeach
            </select>
        </div>

        {{-- اختيار أو إضافة ولي أمر --}}
        <div class="mb-3">
            <label>هل تريد إضافة ولي أمر جديد؟</label>
            <select id="createParentToggle" name="createParentToggle" class="form-control">
                <option value="0">اختر من الموجودين</option>
                <option value="1">إنشاء ولي أمر جديد</option>
            </select>
        </div>

        {{-- اختيار ولي أمر موجود --}}
        <div id="existingParentSection" class="mb-3">
            <label>اختر ولي الأمر</label>
            <select name="parent_id" class="form-control">
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }} - {{ $parent->phone }}</option>
                @endforeach
            </select>
        </div>

        {{-- إدخال ولي أمر جديد --}}
        <div id="newParentSection" style="display: none;">
            <h5>بيانات ولي الأمر الجديد</h5>

            <div class="mb-3">
                <label>اسم ولي الأمر</label>
                <input type="text" name="parent_name" class="form-control">
            </div>



            <div class="mb-3">
                <label>رقم الهاتف</label>
                <input type="text" name="parent_phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>كلمة المرور</label>
            <input type="password" name="parent_password" class="form-control">
            </div>
        </div>

        {{-- زر الحفظ --}}
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

{{-- JavaScript لتبديل الواجهة --}}
<script>
    document.getElementById('createParentToggle').addEventListener('change', function () {
        if (this.value == '1') {
            document.getElementById('existingParentSection').style.display = 'none';
            document.getElementById('newParentSection').style.display = 'block';
        } else {
            document.getElementById('existingParentSection').style.display = 'block';
            document.getElementById('newParentSection').style.display = 'none';
        }
    });
</script>
@endsection