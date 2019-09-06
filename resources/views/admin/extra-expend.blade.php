@extends('layouts.app')

@section('title')
	Hello Mess-Member!!!
@endsection

@section('content')
	<br><h3> {{ $manager->name }} :--- {{ $manager->manager_month }}</h3>
	<div class="my-btn-set">
		<a href="{{ route('show.all.manager') }}" class="btn btn-outline-success">All Manager</a>
		<a href="{{ route('show.all.member',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">All Member</a>
		<a href="{{ route('show.all.meal',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">Meal</a>
		<a href="{{ route('show.all.joma',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">Joma</a>
		
		<a href="{{ route('show.bazar.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Bazar</a>
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-danger">Extra</a>

		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-outline-primary">Summary</a>
	</div>



	<hr>
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('add.extra.expend') }}" method="post">
				<div class="row">
					<div class="col-md-3">
						<input type="number" name="manual_date" class="form-control" placeholder="Date" value="{{ date('d') }}">
					</div>
					<div class="col-md-6">
						<input type="text" name="title" class="form-control" placeholder="Title">
					</div>
					<div class="col-md-3">
						<input type="number" name="ammount" class="form-control" placeholder="Ammount">
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary">Add</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
				<input type="hidden" name="manager_id" value="{{ $manager->id }}">
			</form>
		</div>
	</div>


	<hr>
	@if(count($extraexps)>0)
	<ol>
		@foreach($extraexps as $extraexp)
		<li>
			@if($extraexp->delete_st==0)
			<div class="row">
				<div class="col-sm-8">

					<div class="row">
						<div class="col-md-5">
							<a href="#" class="extra-expend-item" data-trigger="focus" data-content="@foreach($extraexp->edits as $edited) {{$edited->edit_data}}<br> @endforeach">{{ $extraexp->manual_date }}:--- {{ $extraexp->title }} :--- {{ $extraexp->ammount }} /-</a>
						</div>
						<div class="col-md-5">

							<a href="#" class="btn btn-primary edit-extra-btn">Edit</a>
							<div class="extra-editor d-none">
								<form action="{{ route('edit.extra.expend') }}" method="post" class="float-left">
									<input type="number" name="ammount" value="{{$extraexp->ammount}}" placeholder="edit expend">
									<button type="submit" class="btn btn-success edit-extra-submit">Save</button>
									<input type="hidden" name="_token" value="{{ Session::token()}}">
									<input type="hidden" name="extraexp_id" value="{{ $extraexp->id }}">
								</form>
								<button class="btn btn-dark edit-extra-close">X</button>
							</div>

						</div>
						<div class="col-md-2">
							<a href="{{ route('delete.extra.expend',['extraexp_id'=>$extraexp->id]) }}" class="btn btn-danger">delete</a>
						</div>
					</div>

				</div>
			</div>
			@else
				<s>{{ $extraexp->manual_date }}:--- {{ $extraexp->title }} :--- {{ $extraexp->ammount }} /-</s>
			@endif
		</li><br>
		@endforeach
	</ol>
	@endif

	
@endsection