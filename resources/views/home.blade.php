@extends('layouts.client')

@include('includes.client.header')

@section('content')
    <div class="p-5 bg-dark text-white text-center">
        <h1>Home</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('register') }}" type="button">Register</a>
    <a href="" type="button">Login</a>
@endsection
