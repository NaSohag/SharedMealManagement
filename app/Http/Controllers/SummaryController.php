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

class SummaryController extends Controller
{
	public function showSummary($manager_id)
	{
		$manager = Manager::find($manager_id);

		$members = Member::where('manager_id',$manager_id)->get();

		$bazarexps = Bazarexp::where('manager_id',$manager_id)->whereNotIn('delete_st',[1])->get();
		$extraexps = Extraexp::where('manager_id',$manager_id)->whereNotIn('delete_st',[1])->get();

		$meals = Meal::where('manager_id',$manager_id)->get();

		return view('admin.show-summary')->with(['manager'=>$manager,'members'=>$members,'bazarexps'=>$bazarexps,'meals'=>$meals,'extraexps'=>$extraexps]);
	}
}