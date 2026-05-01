<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use App\DTOs\CouponDTO;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(
        protected CouponService $couponService
    ) {}

    public function index()
    {
        $coupons = $this->couponService->getAllCoupons(10);
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'expiry_date' => 'required|date',
            'usage_limit' => 'nullable|integer',
        ]);

        try {
            $couponDTO = CouponDTO::fromRequest($validated);
            $this->couponService->storeCoupon($couponDTO);
            return redirect()->back()->with('success', __('admin.coupon_added'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'expiry_date' => 'required|date',
            'usage_limit' => 'nullable|integer',
        ]);

        try {
            $couponDTO = CouponDTO::fromRequest($validated);
            $this->couponService->updateCoupon($id, $couponDTO);
            return redirect()->back()->with('success', __('admin.coupon_updated'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->couponService->deleteCoupon($id);
            return redirect()->back()->with('success', __('admin.coupon_deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
