@extends('layouts.app')

@section('content')

<h3>Edit User</h3>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf

    <p>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
    </p>

    <p>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
    </p>

    <button type="submit">Update</button>
    <a href="{{ route('users.index') }}">Cancel</a>
</form>


@endsection
