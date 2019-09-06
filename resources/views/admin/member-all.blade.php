@extends('layouts.app')

@section('title')
	Hello Mess-Member!!!
@endsection

@section('content')
	<br><h3> {{ $manager->name }} :--- {{ $manager->manager_month }}</h3>
	<div class="my-btn-set">
		<a href="{{ route('show.all.manager') }}" class="btn btn-outline-success">All Manager</a>
		<a href="{{ route('show.all.member',['manager_id'=>$manager->id]) }}" class="btn btn-success">All Member</a>
		<a href="{{ route('show.all.meal',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">Meal</a>
		<a href="{{ route('show.all.joma',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">Joma</a>
		
		<a href="{{ route('show.bazar.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Bazar</a>
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Extra</a>

		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-outline-primary">Summary</a>
	</div>


	<hr>
	@if(count($members)>0)
	<ol>
		@foreach($members as $member)
		<li>
			<a href="#">{{ $member->name }}</a>
		</li>
		@endforeach
	</ol>
	@endif


	<br><br><br><hr>
	<h3>Add new Member</h3>
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('member.add') }}" method="post">
				<input type="text" name="name" class="form-control">
				<input type="hidden" name="managerid" value="{{ $manager->id }}">
				<br><button type="submit" class="btn btn-primary">Add</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>

@endsection