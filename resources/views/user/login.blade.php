@extends('index')
@section('title', 'Login')

@section('sidebar')
    @parent
 
    <p>This is appended to the master sidebar.</p>
@endsection
 
@section('content')
    <x-user::login />

    <pre>
    <?php
        print_r($session);
    ?>
    </pre>
@endsection