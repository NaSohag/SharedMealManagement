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
		
		<a href="{{ route('show.bazar.expend',['manager_id'=>$manager->id]) }}" class="btn btn-danger">Bazar</a>
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Extra</a>

		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-outline-primary">Summary</a>
	</div>



	<hr>
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('add.bazar.expend') }}" method="post">
				<div class="row">
					<div class="col-md-3">
						<input type="number" name="manual_date" class="form-control" placeholder="Date" value="{{ date('d') }}">
					</div>
					<div class="col-md-3">
						<input type="number" name="ammount" class="form-control" placeholder="Ammount">
					</div>
					<div class="col-md-6">

						<select name="member_id" class="form-control">
						  @foreach($members as $member)
							<option value="{{ $member->id }}">{{ $member->name }}</option>
						  @endforeach
						</select>

					</div>
				</div>
				<button type="submit" class="btn btn-primary">Add</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
				<input type="hidden" name="manager_id" value="{{ $manager->id }}">
			</form>
		</div>
	</div>


	<hr>
	@if(count($bazarexps)>0)
	<ol>
		@foreach($bazarexps as $bazarexp)
		<li>
			@if($bazarexp->delete_st==0)
			<div class="row">
				<div class="col-sm-8">

					<div class="row">
						<div class="col-md-5">
							<a href="#" class="bazar-expend-item" data-trigger="focus" data-content="@foreach($bazarexp->edits as $edited) {{$edited->edit_data}}<br> @endforeach">{{ $bazarexp->manual_date }} :--- {{ $bazarexp->member->name }} :--- {{ $bazarexp->ammount }} /-</a>
						</div>
						<div class="col-md-5">

							<a href="#" class="btn btn-primary edit-bazar-btn">Edit</a>
							<div class="bazar-editor d-none">
								<form action="{{ route('edit.bazar.expend') }}" method="post" class="float-left">
									<input type="number" name="ammount" value="{{$bazarexp->ammount}}" placeholder="edit expend">
									<button type="submit" class="btn btn-success edit-bazar-submit">Save</button>
									<input type="hidden" name="_token" value="{{ Session::token()}}">
									<input type="hidden" name="bazarexp_id" value="{{ $bazarexp->id }}">
								</form>
								<button class="btn btn-dark edit-bazar-close">X</button>
							</div>

						</div>
						<div class="col-md-2">
							<a href="{{ route('delete.bazar.expend',['bazarexp_id'=>$bazarexp->id]) }}" class="btn btn-danger">delete</a>
						</div>
					</div>

				</div>
			</div>
			@else
				<s>{{ $bazarexp->manual_date }} :--- {{ $bazarexp->member->name }} :--- {{ $bazarexp->ammount }} /-</s>
			@endif
		</li><br>
		@endforeach
	</ol>
	@endif



	<div class="modal delete-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Are you sure?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>You can't Undo this.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger">Delete</button>
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>

	
	
@endsection