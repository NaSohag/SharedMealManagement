@extends('layouts.app')

@section('title')
    Welcome to Admin Login
@endsection




@section('content')
    <br><br>
    <h3><strong>Admin</strong> Log in</h3>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.signup') }}" method="post">
              <div class="form-group">
                <label for="email">Your Email address</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
              <button type="submit" class="btn btn-primary">Sign Up</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{ route('admin.login') }}" method="post">
              <div class="form-group">
                <label for="email">Your Email address</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
              <button type="submit" class="btn btn-primary">Log In</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>

@endsection


            

           