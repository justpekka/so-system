@extends('layouts.dashboard')

@section('sidebar')
@endsection

@section('content')
  <x-item::item-list :titles="$result[0]" items="$result" />
  
  <pre>
    <?php
      print_r(json_decode($result));
    ?>
  </pre>
@endsection