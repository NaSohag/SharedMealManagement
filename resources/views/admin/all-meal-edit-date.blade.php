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



	<br><br>
	<div class="table-responsive-sm tableFixHead">
		<table class="table table-striped table-bordered">

		<form action="{{ route('add.meal.by.date') }}" method="post">
		<?php $frm_cntr = 1;?>

		  <thead>
		    <tr>
		      <th class="bg-dark text-white" scope="col">#</th>

		      <?php
		      	for($i=1;$i<=31;$i++)
		      	{
		      	?>
		      	  <th class="bg-dark" scope="col"><button type="button" class="meal-date rounded-circle" data-trigger="focus"
		      		data-content="<a href='{{route('show.all.meal.edit.date',['manager_id'=>$manager->id,'edit_date'=>$i])}}'
		      			class='btn btn-primary add-meal-date' data-dateBtn='{{$i}}'>add</a>"
		      		><?php echo $i ?></button>

		      		@if($i==$edit_date)
			      		<button type="submit" class="btn btn-success">Save</button>
			      		<a href="{{ route('show.all.meal',['manager_id'=>$manager->id]) }}" class="btn btn-warning">X</a>
		      		@endif

		      	  </th>
		      	<?php
		      	}
		      ?>

		    </tr>
		  </thead>



		  <tbody>
		  	
		  	@foreach($members as $member)
		    <tr>

		      <th class="bg-dark text-white" scope="row">{{ $member->name }}</th>

		      	<?php $date_cntr = 1;?>
		        @foreach($member->meals as $meal)
		        	<?php	
		        		while($date_cntr != $meal->manual_date) //--- middle empty meal
		        		{?>
		        			@if($date_cntr==$edit_date)
		        				<td>
		        					<input type="number" name="{{ $frm_cntr }}">
		        					<input type="hidden" name="id{{ $frm_cntr }}" value="{{ $member->id }}">
		        				</td>
		        				<?php $frm_cntr++;?>
		        			@else
		        				<td></td>
		        			@endif
		        			
		        		<?php
		        		$date_cntr++;
		        		}
		        	?>
		        	@if($date_cntr==$edit_date)
		        		<td>
		        			<input type="number" name="{{ $frm_cntr }}" value="{{ $meal->ammount }}">
		        			<input type="hidden" name="id{{ $frm_cntr }}" value="{{ $member->id }}">
		        		</td>
		        		<?php $frm_cntr++;?>
		        	@else
		        		<td>{{ $meal->ammount }}</td>
		        	@endif
		        	
		        	<?php $date_cntr++;?>
		        @endforeach

		        <?php	
		        	while($date_cntr <= 31) //------ last empty meal
		        	{?>
		        		@if($date_cntr==$edit_date)
		        			<td>
		        				<input type="number" name="{{ $frm_cntr }}">
		        				<input type="hidden" name="id{{ $frm_cntr }}" value="{{ $member->id }}">
		        			</td>
		        			<?php $frm_cntr++;?>
		        		@else
		        			<td></td>
		        		@endif
		        		
		        	<?php
		        	$date_cntr++;
		        	}
		        ?>

		    </tr>
		    @endforeach
			
		  </tbody>

		  <input type="hidden" name="_token" value="{{ Session::token() }}">
		  <input type="hidden" name="lastnum" value="{{ $frm_cntr }}">
		  <input type="hidden" name="manual_date" value="{{ $edit_date }}">
		  <input type="hidden" name="manager_id" value="{{ $manager->id }}">
		  </form>

		</table>
	</div>

	

@endsection