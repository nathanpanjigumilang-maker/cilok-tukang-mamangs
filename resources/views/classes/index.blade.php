@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Kelas</h2>
    <a href="{{ route('classes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Kelas
    </a>
</div>

<div class="row">
    @foreach($classes as $class)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $class->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Kelas {{ $class->grade }}</h6>
                <p class="card-text">{{ $class->description }}</p>
                <p class="card-text">
                    <small class="text-muted">{{ $class->students_count }} Siswa</small>
                </p>
                <div class="btn-group">
                    <a href="{{ route('classes.show', $class) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                onclick="return confirm('Hapus kelas ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection