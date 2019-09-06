@extends('layouts.app')

@section('title')
	Hello Manager!
@endsection

<?php 
	$month_array = ['January','February','March','April','May','June','July','Augest','September','October','November','December'];
 ?>

@section('content')
	<br><br>
	@if(count($managers) > 0)
	<div class="row">
		
		@foreach($managers as $manager)
		<div class="col-md-7">
			<a href="{{ route('show.all.member',['manager_id'=>$manager->id]) }}" class="single-manager">
				<div class="row">
					<div class="col-xs-6 manager-month">
						{{ $manager->manager_month }} --- 
					</div>
					<div class="col-xs-6 manager-name">
						{{ $manager->name }}
					</div>
				</div>
			</a>
		</div>
		@endforeach
		
	</div>
	@endif

@endsection