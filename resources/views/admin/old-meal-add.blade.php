@extends('layouts.app')

@section('title')
	Hello Mess-Member!!!
@endsection

@section('content')
	<br><h3> {{ $manager->name }} :--- {{ $manager->manager_month }}</h3>
	<div class="my-btn-set">
		<a href="{{ route('show.all.manager') }}" class="btn btn-outline-success">All Manager</a>
		<a href="{{ route('show.all.member',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">All Member</a>
		<a href="{{ route('show.all.meal',['manager_id'=>$manager->id]) }}" class="btn btn-success">Meal</a>
		<a href="{{ route('show.all.joma',['manager_id'=>$manager->id]) }}" class="btn btn-outline-success">Joma</a>
		
		<a href="{{ route('show.bazar.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Bazar</a>
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Extra</a>

		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-outline-primary">Summary</a>
	</div>


	<br>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Add Daily Meal
	</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Meal</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form action="{{ route('meal.add') }}" method="post">
			  <?php $i = 0; ?>
		      <div class="modal-body">
		        @if(count($members)>0)
		        <div class="row">
		        	<div class="col-md-4">
		        		Date of Meal
		        	</div>
		        	<div class="col-md-8">
		        		<input type="number" name="date" class="form-control">
		        	</div>
		        </div>
		    	<hr>
	        	<ol>
	        		
		        	@foreach($members as $member)
		        	<?php $i += 1; ?>
		        	<li>
		        		<div class="row">
			        		<div class="col-md-6">
			        			{{ $member->name }}
			        		</div>
			        		<div class="col-md-6">
			        			<input type="number" name="{{ $i }}" class="form-control">
			        			<input type="hidden" name="id{{ $i }}" value="{{ $member->id }}">
			        		</div>
		        		</div><br>
		        	</li>
		        	@endforeach
	        	</ol>
		        @endif
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		      </div>

		      <input type="hidden" name="_token" value="{{ Session::token() }}">
		      <input type="hidden" name="lastnum" value="{{ $i }}">
		      <input type="hidden" name="managerid" value="{{ $manager->id }}">
	  		</form>

	    </div>
	  </div>
	</div>






	<br><br>
	<div class="table-responsive-lg">
		<table class="table table-striped table-bordered">


		  <thead>
		    <tr>
		      <th scope="col">#</th>

		      <?php
		      	for($i=1;$i<=31;$i++)
		      	{
		      	?>
		      		<th scope="col"><button class="meal-date rounded-circle" data-trigger="focus"
		      		data-content="<button class='btn btn-primary'>add</button>"
		      		><?php echo $i ?></button></th>
		      	<?php
		      	}
		      ?>

		    </tr>
		  </thead>



		  <tbody>
		  	@foreach($members as $member)
		    <tr>

		      <th scope="row">{{ $member->name }}</th>

		      	<?php $date_cntr = 1;?>
		        @foreach($member->meals as $meal)
		        	<?php	
		        		while($date_cntr != $meal->manual_date) //--- empty meal traversing
		        		{?>
		        			<td class="mmbr-{{$member->id}} date-{{$date_cntr}}"></td>
		        		<?php
		        		$date_cntr++;
		        		}
		        	?>
		        	<td class="mmbr-{{$member->id}} date-{{$date_cntr}}">{{ $meal->ammount }} </td>
		        	<?php $date_cntr++;?>
		        @endforeach

		    </tr>
		    @endforeach
		  </tbody>


		</table>
	</div>

	

@endsection