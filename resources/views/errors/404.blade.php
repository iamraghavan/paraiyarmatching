@extends('errors::minimal')

@section('title', __('Not Found'))

@section('code', '404')

@section('description')
    {{ __('The page you are looking for could not be found. The requested URL /:url was not found on this server.', ['url' => Request::path()]) }}
@endsection

@section('message', __('Not Found'))
