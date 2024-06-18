@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('description')
    {{ __('You are not authorized to access this page. The requested URL :url requires proper authentication or permission.', ['url' => Request::path()]) }}
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))


