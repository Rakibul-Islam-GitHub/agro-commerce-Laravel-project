@extends('seller.layout')
@section('title', 'Category')

@section('Dashboard', 'Category')
@section('content')



<div class="container">
    @foreach ($var as $d)
    <ul>
        <li>{{$d->name}}</li>


    </ul>

    @endforeach
</div>



@endsection