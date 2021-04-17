@extends('master')

@section('meta')
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <p>This is my body content.</p>
    <p>Hello, {{ $name }}.</p>

@endsection
