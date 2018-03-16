<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appliance;
use App\Repositories\ApplianceRepository;
use Illuminate\Support\Facades\DB;
use Auth;

class ApplianceController extends Controller
{
    
    CONST DISHWASHER = 'dishwasher';
    CONST SMALL_APPLIANCE = 'small_appliance';

    public function index() {
    	return Appliance::all();
    }

    public function show($id) {
        return Appliance::find($id);
    }
/*
    public function store(Request $request) {
        return Appliance::create($request->all());
    }

    public function update(Request $request, $id)  {
        $appliance = Appliance::findOrFail($id);
        $appliance->update($request->all());
        return $appliance;
    } 
    public function show(Appliance $appliance) {
    	return $appliance;
    }*/

    public function store(Request $request) {
    	$appliance = Appliance::create($request->all());
    	return reponse()->json($appliance, 201);
    }

    public function update(Request $request, Appliance $appliance)  {
    	$appliance->update($request->all());
    	return $appliance;
    } 

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dishwashers()
    {
        if(Auth::user()) {
             return self::appliancesUserByCategory('dishwashers');
        } else {
            return view('appliances.list', [
                'appliances' => DB::table('appliances')->where('category', 'dishwasher')->paginate(5), 'category' => 'dishwashers'
            ]);
        }
    }

    public function smallAppliances()
    {
        if(Auth::user()) {
             return self::appliancesUserByCategory('small-appliances');
        } else {
            return view('appliances.list', [
                'appliances' => DB::table('appliances')->where('category', 'smallAppliance')->simplePaginate(), 'category' => 'small-appliances'
            ]);
        }
    }
    
    public function appliancesUserByCategory($category)
    {
        return view('appliances.list', [
            'appliances' => DB::table('appliances as ap')
            ->select('ap.*', 'w.appliance_id as isWish')
            ->leftJoin('wisheslist as w',  function ($join) {
                      $join->on('w.appliance_id', '=', 'ap.id')
                        ->on('w.user_id', '=', DB::raw(Auth::user()->id));
                     })
            ->where('category', $category)->simplePaginate()
        , 'category' => $category]);
    }

    
    

/*
    public function show($id) {
    	return Appliance::find($id);
    }

    public function store(Request $request) {
    	return Appliance::create($request->all());
    }

    public function update(Request $request, $id)  {
    	$appliance = Appliance::findOrFail($id);
    	$appliance->update($request->all());
    	return $appliance;
    } 
*/

}
