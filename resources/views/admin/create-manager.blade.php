@extends('layouts.app')

@section('title')
	Hello Manager!
@endsection

<?php 
	$month_array = ['January','February','March','April','May','June','July','Augest','September','October','November','December'];
 ?>

@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('manager.create.post') }}" method="post">

				<div class="form-group">
					<label for="name">New Manager Name</label>
					<input type="text" name="name" class="form-control">
				</div>

				<div class="row">
					<div class="col-sm-6">
						<select name="month" class="form-control">
							<?php
							$cur_month = date('m');
							for($i=0;$i<12;$i++)
							{
								if($i+1==$cur_month)
									echo'<option value="'.$month_array[$i].'" selected>'.$month_array[$i].'</option>';
								else
									echo'<option value="'.$month_array[$i].'">'.$month_array[$i].'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-sm-6">
						<select name="year" class="form-control">
						<?php
							$cur_year = date('y');
							for($i=0;$i<=50;$i++)
							{
								if($i==$cur_year)
									echo '<option value="'.$i.'" selected>'.(2000 + $i).'</option>';
								else
									echo '<option value="'.$i.'">'.(2000 + $i).'</option>';
							}
						?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="old_password">Old Password</label>
					<input type="password" name="old_password" class="form-control">
				</div>
				<div class="form-group">
					<label for="old_password">New Password</label>
					<input type="password" name="new_password" class="form-control">
				</div>
				<div class="form-group">
					<label for="old_password">Again New Password</label>
					<input type="password" name="again_password" class="form-control">
				</div>

				<br><button type="submit" class="btn btn-primary">Create new Manager</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>


@endsection