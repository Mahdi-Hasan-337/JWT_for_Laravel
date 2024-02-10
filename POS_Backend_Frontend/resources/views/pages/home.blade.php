@extends('layout.app')

@section('content')

    @include('Components.home.nav')
    {{-- @include('components.home.error') --}}
    {{-- @include('components.home.uppercarousel') --}}
    @include('components.home.introduction')
    @include('components.home.advertisement')
    @include('components.home.aboutus')
    {{-- @include('components.home.lowercarousel') --}}
    @include('Components.home.footer')
@endsection
