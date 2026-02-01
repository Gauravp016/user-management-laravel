@extends('layouts.app')

@section('content')

<a href="{{ route('users.create') }}">➕ Create User</a>

<table border="1" width="100%" cellpadding="10" style="margin-top:15px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">✏ Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">No users found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
