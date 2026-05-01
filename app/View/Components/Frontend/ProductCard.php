<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use App\Models\Product;

class ProductCard extends Component
{
    public function __construct(
        public Product $product
    ) {}

    public function render()
    {
        return view('components.frontend.product-card');
    }
}
