<?php

namespace App\Actions\Coupons;

use App\DTOs\CouponDTO;
use App\Repositories\Interfaces\CouponRepositoryInterface;

class StoreCouponAction
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository
    ) {}

    public function execute(CouponDTO $couponDTO): mixed
    {
        return $this->couponRepository->create($couponDTO->toArray());
    }
}
