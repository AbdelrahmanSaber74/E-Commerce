<?php

namespace App\Services;

use App\Actions\Coupons\StoreCouponAction;
use App\Actions\Coupons\UpdateCouponAction;
use App\DTOs\CouponDTO;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CouponService
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository,
        protected StoreCouponAction $storeCouponAction,
        protected UpdateCouponAction $updateCouponAction
    ) {}

    public function getAllCoupons(int $perPage = 10): LengthAwarePaginator
    {
        return $this->couponRepository->paginate($perPage);
    }

    public function getCouponById(int|string $id): ?object
    {
        return $this->couponRepository->find($id);
    }

    public function storeCoupon(CouponDTO $couponDTO): mixed
    {
        return $this->storeCouponAction->execute($couponDTO);
    }

    public function updateCoupon(int|string $id, CouponDTO $couponDTO): bool
    {
        return $this->updateCouponAction->execute($id, $couponDTO);
    }

    public function deleteCoupon(int|string $id): bool
    {
        return $this->couponRepository->delete($id);
    }
}
