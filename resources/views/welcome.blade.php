@extends('layouts.app')
@section('title') Home @endsection
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Welcome to the INEC Results Portal</h1>
    <p class="lead">This portal allows you to view and manage results from various polling units and local government areas in Delta State.</p>
    <hr class="my-4">
    <p>Use the navigation bar to access different functionalities:</p>
    <ul>
        <li><a href="{{route('new-polling-unit.create')}}">Add Polling Unit Results</a></li>
        <li><a href="{{route('lga.summary')}}">View LGA Results</a></li>
        <li><a href="{{route('show.pollingunit')}}">View Polling Unit Results</a></li>
    </ul>
</div>
@endsection
