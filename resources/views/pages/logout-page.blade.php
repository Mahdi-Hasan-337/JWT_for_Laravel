@extends('layout.app')

@section('content')
    <a href="{{ url('/logout') }}" class="center btn btn-outline-success bold"
        style="margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
        Logout
    </a>
@endsection
