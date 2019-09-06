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
		<a href="{{ route('show.all.joma',['manager_id'=>$manager->id]) }}" class="btn btn-success">Joma</a>
		
		<a href="{{ route('show.bazar.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Bazar</a>
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Extra</a>
		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-outline-primary">Summary</a>
	</div>


	<hr>
	@if(count($members)>0)
	<ol>
		@foreach($members as $member)
		<li>
			<div class="row">
				<div class="col-md-3">
					{{ $member->name }}
				</div>
				<div class="col-md-9">
					<a href="#" class="btn btn-secondary joma-btn">+</a>
					<div class="add-balance d-none">
						<form action="{{ route('add.balance') }}" method="post" class="float-left">
							<input type="number" name="ammount" placeholder="add tk">
							<button type="submit" class="btn btn-primary add-balance-submit">Add</button>
							<input type="hidden" name="_token" value="{{ Session::token()}}">
							<input type="hidden" name="member_id" value="{{ $member->id }}">
							<input type="hidden" name="manager_id" value="{{ $manager->id}}">
						</form>
						<button class="btn btn-danger add-balance-close">X</button>
					</div>

					<div class="show-taka-single-member">
						<?php $flag = false; $sum = 0?>
						@foreach($member->takajoma as $takajoma)
							@if($flag==true) + 
							@endif
							<?php 
								$flag = true;
								if($takajoma->delete_st==0){
									$sum += $takajoma->ammount;
								}
							?>

							@if($takajoma->delete_st==0)
								<a href="#" class="single-taka-ammount" data-trigger="focus"
		      						data-content="<a href='{{ route('delete.balance',['takajoma_id'=>$takajoma->id]) }}' class='btn btn-danger'>delete</a>"
								>{{ $takajoma->ammount }}</a>
								
							@else
								<s>{{ $takajoma->ammount }}</s>
							@endif
						@endforeach

						@if($sum!=0)
							= {{ $sum }}
						@endif
					</div>

				</div>
			</div>
			 <br>
		</li>
		@endforeach
	</ol>
	@endif
	
@endsection
