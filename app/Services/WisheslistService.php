<?php

namespace App\Services;

use App\Exceptions\RemoveApplianceFromNotExistingWishlistException;
use App\Wisheslist;
use DB;
use DebugBar;

class WisheslistService
{
    const MODEL = Wisheslist::class;
    
    public function create(array $data, $provider = false)
    {
        $wishList = self::MODEL;
        $wishList = new $wishList();
        $wishList->user_id = $data['user_id'];
        $wishList->appliance_id = $data['appliance_id'];

        /** @noinspection PhpUndefinedMethodInspection */
        $wishList->save();

        return $wishList;
    }


    /**
     * @param $userId
     * @param $applianceId
     */
    public function addApplianceToUserWishlist($userId, $applianceId)
    {
        // Try to load existing wisheslist
        $wisheslist =  WishesList::where('user_id','=', DB::raw($userId))->where('appliance_id', '=', $applianceId)->first();
            Debugbar::info('buscada la lista');
         if (!$wisheslist) {
            $wisheslist = $this->create([
                'user_id' => $userId,
                'appliance_id' => $applianceId,
            ]);
        } else {
            Debugbar::info('lista encontrada');
        }

        return $wisheslist;
    }


    /**
     * @param $userId
     * @param $applianceId
     */
    public function removeApplianceFromUserWishlist($userId, $applianceId)
    {
        //$wishlist = DB::table('wisheslist')->where('user_id','=', DB::raw($userId))->where('appliance_id', '=', $applianceId)->first();
       $wishlist = WishesList::where('user_id','=', DB::raw($userId))->where('appliance_id', '=', $applianceId)->delete();
        if (!$wishlist) {
            return null;
        }

        //$wishlist->delete();

        return;
        /*if (!$wishlist) {
            throw new RemoveApplianceFromNotExistingWishlistException($userId);
        }*/

       // $wishlist->removeAppliance($applianceId);
       // $wishlist->save();
    }

}