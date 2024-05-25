@extends('layouts.app')
@section('content')

<div class="col-lg-12" style="margin: 20rem">

    <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" srcset="">

    <h1>{{ $user->name }}</h1>
    <p>Age: {{ $user->age }}</p>
    <p>Religion: {{ $user->religion }}</p>
    <p>City: {{ $user->residing_state }}</p>
</div>

@endsection
