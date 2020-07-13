@extends('user.layouts.master')

@section('title', 'CPB Food')


@section('page-css')
     <!--  Vegas Slider CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('all-assets/user/assets/vegas/vegas.min.css') }}">
    <!-- Text Animated CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Modak">
    <link href="{{ asset('all-assets/user/assets/textAnimate/animate.css') }}" rel="stylesheet">
@endsection

@section('page-js')
    <!-- Vegas Slider Js -->
    <script src="{{ asset('all-assets/user/assets/vegas/vegas.min.js') }}"></script>
    <!-- Animated Text JS -->
    <script src="{{ asset('all-assets/user/assets/textAnimate/jquery.lettering.js') }}"></script>
    <script src="{{ asset('all-assets/user/assets/textAnimate/jquery.textillate.js') }}"></script>
    <script src="{{ asset('all-assets/user/assets/textAnimate/animateOptions.js') }}"></script>


@endsection

{{-- Main Content --}}
@section('content')

 <h1>Indexxxxxxxxxxxxxxx</h1>



@endsection

