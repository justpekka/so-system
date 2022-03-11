@extends('layouts.dashboard')

@section('sidebar')
@endsection

@section('content')
  <x-item::item-list :titles="$result[0]" :items="$result" />
  
@endsection