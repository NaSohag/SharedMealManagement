@extends('layouts.app')

@section('title')
	Admin Loged in
@endsection


@section('content')
	<h1>Welcome to <strong>ADMIN</strong> Dashboard</h1>
	<a href="{{ route('show.all.manager') }}" class="btn btn-primary">All Managers</a>
@endsection 