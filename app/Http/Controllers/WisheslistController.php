<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WisheslistService;
use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use Auth;
use Redirect;
use DebugBar;
use DB;

class WisheslistController extends Controller
{
    /**
     * @var WishlistService
     */
    private $wisheslistService;

    /**
     * WisheslistController constructor.
     * @param WisheslistService $wisheslistService
     */
    public function __construct(WisheslistService $wisheslistService)
    {
        $this->wisheslistService = $wisheslistService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @param $userId
     */
    public function wishesListUser()
    {
        return view('wishes.list', [
            'appliances' => DB::table('appliances as ap')
            ->select('ap.*', 'w.appliance_id as isWish')
            ->join('wisheslist as w',  function ($join) {
                      $join->on('w.appliance_id', '=', 'ap.id')
                        ->on('w.user_id', '=', DB::raw(Auth::user()->id));
                     })->paginate(5)
        ]);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addRemoveAppliance(Request $request, $userId)
    {
        if ($userId != Auth::user()->id) {
            abort(403, 'You can only add appliances to your own wishlist');
        }

        $applianceId = $request->input('applianceId');
        //DebugBar::info('pulsado');
        switch($request->submitButton) {
            case 'add': 
                //DebugBar::info('pulsado add');

                $this->wisheslistService->addApplianceToUserWishlist($userId, $applianceId);
            break;

            case 'remove': 
                //DebugBar::info('pulsado remove');
                $this->wisheslistService->removeApplianceFromUserWishlist($userId, $applianceId);
            break;
        }

        //return redirect()->route('frontend.wishlist', ['userId' => $userId]);
        return Redirect::back();
    }

    public function removeAppliance(Request $request, $userId)
    {
        if ($userId != Auth::user()->id) {
            abort(403, 'You can only remove appliances to your own wishlist');
        }

        $applianceId = $request->input('applianceId');

        $this->wisheslistService->removeApplianceFromUserWishlist($userId, $applianceId);

        //return redirect()->route('frontend.wishlist', ['userId' => $userId]);
       return Redirect::back();
    }
}