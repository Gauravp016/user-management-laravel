@extends('layouts.app')

@section('content')

<h3>Create User</h3>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <p>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </p>

    <p>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password">
    </p>

    <button type="submit">Save</button>
    <a href="{{ route('users.index') }}">Cancel</a>
</form>

@endsection
