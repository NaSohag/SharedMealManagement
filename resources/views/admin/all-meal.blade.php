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
	<div class="table-responsive-xl tableFixHead">
		<table class="table table-striped table-bordered">


		  <thead>
		    <tr>
		      <th class="bg-dark text-white" scope="col">Name</th>

		      <?php
		      	for($i=1;$i<=31;$i++)
		      	{
		      	?>
		      		<th class="bg-dark" scope="col"><button class="meal-date rounded-circle" data-trigger="focus"
		      		data-content="<a href='{{route('show.all.meal.edit.date',['manager_id'=>$manager->id,'edit_date'=>$i])}}'
		      			class='btn btn-primary'>add</a>"
		      		><?php echo $i ?></button></th>
		      	<?php
		      	}
		      ?>

		    </tr>
		  </thead>



		  <tbody>
		  	<?php
		  		$date_array = array();
		  		for($j = 1;$j<=31;$j++)$date_array[$j] = 0;
		  	?>
		  	@foreach($members as $member)
		    <tr>

		      <th class="bg-dark text-white" scope="row">{{ $member->name }} <br> <small>{{ $member->meals->sum('ammount') }}</small></th>

		      	<?php $date_cntr = 1;?>
		        @foreach($member->meals as $meal)
		        	<?php	
		        		while($date_cntr != $meal->manual_date) //--- middle empty meal
		        		{?>
		        			<td class="mmbr-{{$member->id}} date-{{$date_cntr}}"></td>
		        		<?php
		        		$date_cntr++;
		        		}
		        	?>
		        	<td class="mmbr-{{$member->id}} date-{{$date_cntr}}">{{ $meal->ammount }} </td>
		        	<?php 
		        		$date_array[$date_cntr] += $meal->ammount;
		        		$date_cntr++;
		        	?>
		        @endforeach

		        <?php	
		        	while($date_cntr <=31) //--- empty meal traversing
		        	{?>
		        		<td class="mmbr-{{$member->id}} date-{{$date_cntr}}"></td>
		        	<?php
		        	$date_cntr++;
		        	}
		        ?>

		    </tr>
		    @endforeach
		    <?php 
		    	$total_bazar_expend = 0;
		    	$total_meal = 0;
		    ?>
		    <tr class="bg-primary">
		    	<th class="bg-dark text-white">Total</th>
		    	<?php	//-------- total meal for date
		    		for($j=1;$j<=31;$j++)
		    		{
		    			$bzr_flag = false;
		    			$bazarexp = $bazarexps->where('manual_date',$j);
		    			foreach ($bazarexp as $bazar) {
		    				$bazarexp1 = $bazar;
		    				$bzr_flag = true;
		    				break; //---- get only first element
		    			}
		    					    			?>
		    			@if($date_array[$j]>0)
		    				<td> {{ $date_array[$j] }}
		    					@if($bzr_flag)
		    						<br>{{ $bazarexp1->member->name }} <br>{{ $bazarexp1->ammount }}Tk <br>R-{{  round(($bazarexp1->ammount) / ($date_array[$j]),2) }}
		    					@endif
		    				</td>

		    				<?php 
		    					if($bzr_flag){
		    						$total_meal += $date_array[$j];
		    						$total_bazar_expend += $bazarexp1->ammount;
		    					}
		    				?>
		    			@else
		    				<td></td>
		    			@endif
		    			<?php
		    		}
		    	?>
		    </tr>
		  </tbody>


		</table>
	</div>



	<hr>
	<div class="row">
		<div class="col-sm-6 text-center">
			<h4 class="bg-success">
				Total Meal: <strong><?php echo $total_meal; ?></strong>
				<br>Total Bazar expend: <strong><?php echo $total_bazar_expend; ?></strong>
				<br>Meal Rate: <strong><?php echo round($total_bazar_expend/$total_meal,2);?></strong>
			</h4>
		</div>
	</div>
	
	

@endsection