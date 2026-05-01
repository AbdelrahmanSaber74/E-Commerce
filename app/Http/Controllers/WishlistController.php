<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $wishlist = $this->wishlistService->getWishlist();
        return view('frontend.wishlist.index', compact('wishlist'));
    }

    public function toggle($productId)
    {
        $response = $this->wishlistService->toggle($productId);
        return redirect()->back()->with('success', $response['message']);
    }
}
