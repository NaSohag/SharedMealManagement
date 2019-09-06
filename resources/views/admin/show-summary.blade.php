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
		<a href="{{ route('show.extra.expend',['manager_id'=>$manager->id]) }}" class="btn btn-outline-danger">Extra</a>
		<a href="{{ route('show.summary',['manager_id'=>$manager->id]) }}" class="btn btn-primary">Summary</a>
	</div>
	<br>


	<?php
		$total_bazar = $bazarexps->sum('ammount');
		$total_meal = $meals->sum('ammount');
		$meal_rate = round($total_bazar/$total_meal,2);


		$total_extra = $extraexps->sum('ammount');
		$total_member = $members->count();
		$extra_perhead = round($total_extra/$total_member,2);
	?>


	<div class="col-md-6 bg-info rounded">
		<h4><br>
			<small>Meal Rate</small> :-- {{ $meal_rate }}<br>
			<small>Bazar Expend</small> :-- {{ $total_bazar }}<hr>
			
			<small>Extra Expend</small> :-- {{ $total_extra }}<br>
			<small>Extra Per-head</small> :-- {{ $extra_perhead }}<br>
		</h4>
	</div>



	<br>
	<div class="table-responsive-xs tableFixHead">
		<table class="table table-striped table-bordered">


			<thead>
		    <tr class="bg-secondary rounded">
		      <th class="bg-dark text-white" scope="col">Name</th>
		      <th class="bg-dark text-white" scope="col">Joma</th>
		      <th class="bg-dark text-white" scope="col">Meal</th>
		      <th class="bg-dark text-white" scope="col">Meal Expend</th>
		      <th class="bg-dark text-white" scope="col">Total =<br>Meal + Extra</th>
		      <th class="bg-dark text-white" scope="col">Manager pabe</th>
		      <th class="bg-dark text-white" scope="col">boder pabe</th>
		    </tr>
			</thead>

			<tbody>
		  	@foreach($members as $member)

		    <tr>
		        <th class="bg-dark text-white" scope="row">{{ $member->name }}</th>
		        <td>{{ $member_joma = $member->takajoma->whereNotIn('delete_st',[1])->sum('ammount') }}</td>
		        <td>{{ $member_meal = $member->meals->sum('ammount') }}</td>
		        <td>{{ $member_meal_cost = $member_meal*$meal_rate }}</td>
		        <td>{{ $member_total_cost = $member_meal_cost+$extra_perhead }}</td>
		        <?php 
		        	$manager_pabe = $member_total_cost-$member_joma;
		        ?>
		        @if($manager_pabe>0)
		        	<td>{{ $manager_pabe }}</td>
		        	<td></td>
		        @else
		        	<td></td>
		        	<td>{{ $manager_pabe*(-1) }}</td>
		        @endif
		    </tr>

		    @endforeach
			</tbody>

		</table>
	</div><br><br>


	

@endsection