<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"/>

<!-- Pace -->
<link rel="stylesheet" href="{{ asset('assets/css/pace-theme-default.min.css') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

@php
  $dir_mode = ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr';
@endphp
 <!-- Theme CSS -->
<link type="text/css" href="{{ asset('assets/css/main.'.$dir_mode.'.min.css') }}" rel="stylesheet">

<!-- Toastr -->
<link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">

<!-- Aweet Alert 2 -->
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">

<!-- Custom -->
<link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>   