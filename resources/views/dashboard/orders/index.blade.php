@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold"> <i data-feather="shopping-cart" class="mr-2"></i> {{ __('admin.orders') }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('admin.orders') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-dark">{{ __('admin.orders_list') ?? 'Orders List' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.customer') }}</th>
                                            <th>{{ __('messages.total') }}</th>
                                            <th>{{ __('messages.status') }}</th>
                                            <th>{{ __('messages.date') }}</th>
                                            <th class="text-center">{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td class="font-weight-bold">#{{ $order->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-light rounded-circle p-2 mr-2">
                                                            <i data-feather="user" style="width: 14px;"></i>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bold">{{ $order->user->name }}</div>
                                                            <small class="text-muted">{{ $order->user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="text-primary font-weight-bold">{{ number_format($order->total_price, 2) }}</span></td>
                                                <td>
                                                    @php
                                                        $statusClass = match($order->status) {
                                                            \App\Enums\OrderStatus::PENDING => 'badge-warning',
                                                            \App\Enums\OrderStatus::PROCESSING => 'badge-info',
                                                            \App\Enums\OrderStatus::SHIPPED => 'badge-primary',
                                                            \App\Enums\OrderStatus::DELIVERED => 'badge-success',
                                                            \App\Enums\OrderStatus::CANCELLED => 'badge-danger',
                                                            default => 'badge-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $statusClass }} py-2 px-3 rounded-pill">
                                                        {{ \App\Enums\OrderStatus::label($order->status) }}
                                                    </span>
                                                </td>
                                                <td><span class="text-muted">{{ $order->created_at->diffForHumans() }}</span></td>
                                                <td class="text-center">
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 shadow-sm">
                                                        <i data-feather="eye" class="mr-1" style="width: 14px;"></i> {{ __('admin.view') ?? 'View' }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    <i data-feather="shopping-bag" style="width: 50px; height: 50px;" class="mb-3 d-block mx-auto"></i>
                                                    {{ __('admin.no_orders_found') ?? 'No orders found' }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
