@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h2>مواعيد الطلاب</h2>

    <!-- زر فتح مودال إضافة موعد -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
        إضافة موعد جديد
    </button>
 
    <!-- جدول عرض المواعيد -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم الطالب</th>
                <th>التاريخ والوقت</th>
                <th>ملاحظة</th>
            </tr>
        </thead>
        <tbody>
@foreach($appointments as $appointment)
<tr>
    <td colspan="1">كل الطلاب</td>
    <td>{{ $appointment->scheduled_at->format('Y-m-d H:i') }}</td>
    <td>{{ $appointment->note ?? '-' }}</td>
</tr>
@endforeach

        </tbody>
    </table>
</div>

<!-- مودال إضافة موعد -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentLabel" aria-hidden="true">
  <div class="modal-dialog">
<form action="{{ route('appointments.store', ['teacher' => $teacher->id]) }}" method="POST">
  @csrf
  <div class="modal-body">
    <div class="mb-3">
      <label for="scheduled_at" class="form-label">التاريخ والوقت</label>
      <input 
        type="datetime-local" 
        name="scheduled_at" 
        id="scheduled_at" 
        class="form-control" 
        required
        min="{{ now()->format('Y-m-d\TH:i') }}" 
        max="{{ now()->addMonths(6)->format('Y-m-d\TH:i') }}"
      />
    </div>

    <div class="mb-3">
      <label for="note" class="form-label">ملاحظة (اختياري)</label>
      <textarea name="note" id="note" class="form-control" rows="3"></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-success">حفظ الموعد</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
  </div>
</form>

@endsection
