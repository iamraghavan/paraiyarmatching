@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('description')
    {{ __('You are Unauthorized to access this page. The requested URL :url requires proper authentication or permission.', ['url' => Request::path()]) }}
@endsection
@section('message', __('Unauthorized'))
