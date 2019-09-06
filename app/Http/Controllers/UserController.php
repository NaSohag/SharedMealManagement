<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function loginForm()
	{
		if(Auth::guard('web')->user()){
			return view('dashboard');
			//return redirect()->route('dashboard');
		}
		else
			return view('welcome');
	}

	public function dahsboardView()
	{
		return view('dashboard');
	}

	public function signUp(Request $request)
	{
		$this->validate($request,[
			'name' => 'required',
			'email' => 'required',
			'password' => 'required|min:4'
		]);

		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->save();

		Auth::guard('web')->login($user);

		return redirect()->route('dashboard');
	}

	public function logIn(Request $request)
	{
		$this->validate($request,[
			'email' => 'required',
			'password' => 'required|min:4'
		]);

		if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password]))
		{
			return redirect()->route('dashboard');
		}

		return redirect()->back();
	}

	public function logOut()
	{
		Auth::guard('web')->logout();
		Auth::guard('admin')->logout();
		return redirect()->route('root');
	}
}