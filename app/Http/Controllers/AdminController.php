<?php
namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	public function adminLoginForm()
	{
		if(Auth::guard('admin')->user()){
			return view('admin.dashboard');
			//return redirect()->route('admin.dashboard');
		}
		else{
			return view('admin.root');
		}
	}

	public function adminDahsboardView()
	{
		return view('admin.dashboard');
	}

	public function adminSignUp(Request $request)
	{
		$this->validate($request,[
			'email' => 'required',
			'password' => 'required|min:4'
		]);

		//----- creating admin for a mess
		$admin = new Admin();
		$admin->email = $request->email;
		$admin->password = bcrypt($request->password);
		$admin->save();

		
		//----- update mess-or-user table
		$user = Auth::guard('web')->user();
		$user->admin_id = $admin->id;
		$user->update();


		Auth::guard('admin')->login($admin);

		return redirect()->route('admin.dashboard');
	}

	public function adminLogIn(Request $request)
	{
		$this->validate($request,[
			'email' => 'required',
			'password' => 'required|min:4'
		]);

		if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
		{
			return redirect()->route('admin.dashboard');
		}

		return redirect()->back();
	}

	public function adminLogOut()
	{
		Auth::guard('admin')->logout();
		return redirect()->route('admin.root');
	}
}