<?php

namespace App\Actions\Coupons;

use App\DTOs\CouponDTO;
use App\Repositories\Interfaces\CouponRepositoryInterface;

class UpdateCouponAction
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository
    ) {}

    public function execute(int|string $id, CouponDTO $couponDTO): bool
    {
        return $this->couponRepository->update($couponDTO->toArray(), $id);
    }
}
