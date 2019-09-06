@extends('layouts.app')

@section('title')
	You are now Loged in
@endsection


@section('content')
	<h1>Welcome to Dashboard</h1>
	<a href="{{ route('show.all.manager') }}" class="btn btn-primary">All Managers</a>
@endsection 