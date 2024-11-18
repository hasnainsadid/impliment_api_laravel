@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Welcome to Child Project</h1>
        <button class="btn btn-primary" onclick="window.location.href='{{ route('student.create') }}'" >Add Student</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl. no</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students['data'] as $key => $student)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><img src="{{ asset('upload/images/'. $student['image']) }}" alt="{{ $student['name'] }}" width="50" height="50"></td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['email'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
