<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;

    public static function countWishlist($product_id)
    {
        if (Auth::check()){
            $user = Auth::user()->id;
        }

        $countWishlist = Wishlist::where(['user_id' => $user,
        'product_id' => $product_id])->count();
        return $countWishlist;
    }

    public static function totalCountWishlist()
    {
        if (Auth::check()){
            $user = Auth::user()->id;
        }

        $totalCountWishlist = Wishlist::where(['user_id' => $user])->count();
        return $totalCountWishlist;
    }
}