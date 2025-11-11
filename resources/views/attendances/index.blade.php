@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Absensi Harian</h2>
    <div>
        <form method="GET" class="d-flex gap-2">
            <input type="date" name="date" value="{{ $selectedDate }}" class="form-control">
            <select name="class_id" class="form-select">
                <option value="">Semua Kelas</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

@if($students->count() > 0)
<form action="{{ route('attendances.store') }}" method="POST">
    @csrf
    <input type="hidden" name="date" value="{{ $selectedDate }}">
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                @php
                    $attendance = $student->attendances->first();
                @endphp
                <tr>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>
                        <select name="status[{{ $student->id }}]" class="form-select form-select-sm">
                            <option value="present" {{ $attendance && $attendance->status == 'present' ? 'selected' : '' }}>Hadir</option>
                            <option value="absent" {{ $attendance && $attendance->status == 'absent' ? 'selected' : '' }}>Alpha</option>
                            <option value="sick" {{ $attendance && $attendance->status == 'sick' ? 'selected' : '' }}>Sakit</option>
                            <option value="permission" {{ $attendance && $attendance->status == 'permission' ? 'selected' : '' }}>Izin</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="note[{{ $student->id }}]" 
                               value="{{ $attendance ? $attendance->note : '' }}" 
                               class="form-control form-control-sm" 
                               placeholder="Keterangan">
                    </td>
                    <td>
                        <input type="hidden" name="student_id[{{ $student->id }}]" value="{{ $student->id }}">
                        <button type="submit" name="submit_type" value="{{ $student->id }}" 
                                class="btn btn-sm btn-success">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
@else
<div class="alert alert-info">
    Tidak ada siswa ditemukan untuk filter yang dipilih.
</div>
@endif
@endsection