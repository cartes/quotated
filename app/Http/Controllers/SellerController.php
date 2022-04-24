<?php

namespace App\Http\Controllers;

use App\Seller;
use App\User;
//use http\Client\Curl\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function contactInfo($id) {
        if (\request()->ajax()) {

            $seller = Seller::whereId($id)->select('user_id')->first();
            $user = User::whereId($seller->user_id)->select(['email', 'phone'])->first();

            return response()->json(['seller' => $user]);
        }
        return abort(401, "No puedes estar en esta zona");
    }
}
