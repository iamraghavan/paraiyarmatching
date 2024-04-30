@extends('layouts.app')
@section('content')

<div style="margin: 30rem">
@if($user)
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Phone: {{ $user->phone }}</p>
    <p>Gender: {{ $user->gender }}</p>
    <!-- Add more <p> tags for other user attributes as needed -->
@else
    <p>User not found.</p>
@endif

</div>

@endsection
