<?php
namespace App\Http\Controllers;

use App\Manager;
use App\Member;
use App\Meal;
use App\Bazarexp;
use App\Extraexp;
use App\Takajoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends controller
{
	public function showAllManager()
	{
		$managers = Manager::all();
		return view('admin.manager-all')->with(['managers'=>$managers]);
	}

	public function getCreateManager()
	{
		return view('admin.create-manager');
	}

	public function postCreateManager(Request $request)
	{
		$this->validate($request,[
			'name' => 'required',
			'month' => 'required'
		]);

		$manager = new Manager();
		$manager->name = $request->name;
		$manager->manager_month = $request->month;
		$manager->user_id = Auth::guard('web')->user()->id;
		$manager->admin_id = Auth::guard('admin')->user()->id;
		$manager->save();

		return redirect()->route('manager.show.all')->with(['message'=>'successfully created']);
	}

	public function showAllMember($manager_id)
	{
		$manager = Manager::find($manager_id);

		$members = Member::all();

		return view('admin.member-all')->with(['manager'=>$manager,'members'=>$members]);
	}

	public function showMembersMeal($manager_id)
	{
		$manager = Manager::find($manager_id);

		$members = Member::all();

		$bazarexps = Bazarexp::where('manager_id',$manager_id)->get();

		return view('admin.all-meal')->with(['manager'=>$manager,'members'=>$members,'bazarexps'=>$bazarexps]);
	}

	public function showMembersMealEditDate($manager_id,$edit_date)
	{
		$manager = Manager::find($manager_id);

		$members = Member::all();

		return view('admin.all-meal-edit-date')->with(['manager'=>$manager,'members'=>$members,'edit_date'=>$edit_date]);
	}


	public function showAllJoma($manager_id)
	{
		$manager = Manager::find($manager_id);

		$members = Member::all();

		return view('admin.all-joma')->with(['manager'=>$manager,'members'=>$members]);	
	}

	public function showBazarExpend($manager_id)
	{
		$manager = Manager::find($manager_id);
		$bazarexps = Bazarexp::all();
		$members = Member::where('manager_id',$manager_id)->get();

		return view('admin.bazar-expend')->with(['bazarexps'=>$bazarexps,'manager'=>$manager,'members'=>$members]);	
	}

	public function showExtraExpend($manager_id)
	{
		$manager = Manager::find($manager_id);

		$extraexps = Extraexp::all();

		return view('admin.extra-expend')->with(['extraexps'=>$extraexps,'manager'=>$manager]);	
	}

	public function addBazarExpend(Request $request)
	{
		$user_id = Auth::guard('web')->user()->id;
		$admin_id = Auth::guard('admin')->user()->id;

		$bazarexp = new Bazarexp();
		$bazarexp->manual_date = $request->manual_date;
		$bazarexp->ammount = $request->ammount;
		$bazarexp->member_id = $request->member_id;
		$bazarexp->manager_id = $request->manager_id;
		$bazarexp->user_id = $user_id;
		$bazarexp->admin_id = $admin_id;
		$bazarexp->save();

		return redirect()->back()->with(['message'=>'Successfully Added']);
	}

	public function addExtraExpend(Request $request)
	{
		$user_id = Auth::guard('web')->user()->id;
		$admin_id = Auth::guard('admin')->user()->id;

		$extraexp = new Extraexp();
		$extraexp->manual_date = $request->manual_date;
		$extraexp->title = $request->title;
		$extraexp->ammount = $request->ammount;
		$extraexp->manager_id = $request->manager_id;
		$extraexp->user_id = $user_id;
		$extraexp->admin_id = $admin_id;
		$extraexp->save();

		return redirect()->back()->with(['message'=>'Successfully Added']);
	}

	public function addBalance(Request $request)
	{
		$user_id = Auth::guard('web')->user()->id;
		$admin_id = Auth::guard('admin')->user()->id;

		$takajoma = new Takajoma();
		$takajoma->ammount = $request->ammount;
		if($request->ammount=='' or $request->ammount==0){
			return redirect()->back()->with(['message'=>'not added']);
		}
		$takajoma->member_id = $request->member_id;
		$takajoma->manager_id = $request->manager_id;
		$takajoma->user_id = $user_id;
		$takajoma->admin_id = $admin_id;
		
		if($takajoma->save()){
			return redirect()->back()->with(['message'=>'added Successfully']);
		}else{
			return redirect()->back()->with(['message'=>'not added']);
		}
	}

	public function editExtraExpend(Request $request)
	{
		$extraexp = Extraexp::find($request->extraexp_id);
		$extraexp->ammount = $request->ammount;
		if($request->ammount=='' or $request->ammount==0){
			return redirect()->back()->with(['message'=>'can not edit']);
		}
		
		if($extraexp->update()){
			return redirect()->back()->with(['message'=>'added Successfully']);
		}else{
			return redirect()->back()->with(['message'=>'can not edit']);
		}
	}

	public function editBazarExpend(Request $request)
	{
		$bazarexp = Bazarexp::find($request->bazarexp_id);
		$bazarexp->ammount = $request->ammount;
		if($request->ammount=='' or $request->ammount==0){
			return redirect()->back()->with(['message'=>'can not edit']);
		}
		
		if($bazarexp->update()){
			return redirect()->back()->with(['message'=>'added Successfully']);
		}else{
			return redirect()->back()->with(['message'=>'can not edit']);
		}
	}

	public function deleteBalance($takajoma_id)
	{
		$takajoma = Takajoma::find($takajoma_id);
		$takajoma->delete_st = 1;
		$takajoma->update();

		return redirect()->back();
	}

	public function deleteBazarExpend($bazarexp_id)
	{
		$bazarexp = Bazarexp::find($bazarexp_id);
		$bazarexp->delete_st = 1;
		$bazarexp->update();

		return redirect()->back();
	}

	public function deleteExtraExpend($extraexp_id)
	{
		$extraexp = Extraexp::find($extraexp_id);
		$extraexp->delete_st = 1;
		$extraexp->update();

		return redirect()->back();
	}


	public function addMember(Request $request)
	{
		$this->validate($request,[
			'name' => 'required'
		]);

		$member = new Member();
		$member->name = $request->name;
		$member->manager_id = $request->managerid;
		$member->user_id = Auth::guard('web')->user()->id;
		$member->admin_id = Auth::guard('admin')->user()->id;
		$member->save();

		$members = Member::all();
		return redirect()->back()->with(['members'=>$members,'message'=>'added Successfully']);
	}

	public function addMeal(Request $request)
	{
		$manual_date = $request->date;
		$manager_id = $request->managerid;


		$user_id = Auth::guard('web')->user()->id;
		$admin_id = Auth::guard('admin')->user()->id;
		
		$data = array();

		if($manual_date!="")
		{
			for($i = 1;$i<=$request->lastnum;$i++)
			{
				$id = 'id'.$i;
				$member_id = $request->$id;
				$meal_ammount = $request->$i;

				if($meal_ammount != "")
				{
					$arr = ['ammount'=>$meal_ammount,'manual_date'=>$manual_date,'member_id'=>$member_id,'user_id'=>$user_id,'admin_id'=>$admin_id,'manager_id'=>$manager_id];

					array_push($data,$arr);
				}
			}
		}

		if(count($data)>0)
		{
			Meal::insert($data);
			return redirect()->back()->with(['message'=>'Successfully added']);
		}
		else
		{
			return redirect()->back()->with(['message'=>'No data added']);
		}
	}

	public function addMealByDate(Request $request)
	{
		$manual_date = $request->manual_date;
		$manager_id = $request->manager_id;


		$user_id = Auth::guard('web')->user()->id;
		$admin_id = Auth::guard('admin')->user()->id;
		
		$data = array();


		for($i = 1;$i<=$request->lastnum;$i++)
		{
			$id = 'id'.$i;
			$member_id = $request->$id;
			$meal_ammount = $request->$i;

			if($meal_ammount != "" && $meal_ammount != 0)
			{
				$arr = ['ammount'=>$meal_ammount,'manual_date'=>$manual_date,'member_id'=>$member_id,'user_id'=>$user_id,'admin_id'=>$admin_id,'manager_id'=>$manager_id];

				array_push($data,$arr);
			}
		}


		if(count($data)>0)
		{
			Meal::insert($data);
			$members = Member::all();
			$manager = Manager::find($manager_id);

			return view('admin.all-meal')->with(['manager'=>$manager,'members'=>$members,'message'=>'Successfully added']);
		}
		else
		{
			return redirect()->back()->with(['message'=>'No data added']);
		}
	}
}