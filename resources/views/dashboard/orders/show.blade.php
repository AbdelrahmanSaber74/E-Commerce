@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold">
                                <i data-feather="package" class="mr-2"></i> {{ __('messages.order_details') ?? 'Order Details' }} #{{ $order->id }}
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('admin.orders') }}</a></li>
                            <li class="breadcrumb-item active">#{{ $order->id }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Order Summary & Customer Info -->
                <div class="col-xl-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-dark font-weight-bold">{{ __('messages.customer_info') ?? 'Customer Information' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="avatar-wrapper mb-3">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <i data-feather="user" class="text-primary" style="width: 40px; height: 40px;"></i>
                                    </div>
                                </div>
                                <h5 class="mb-1 font-weight-bold">{{ $order->user->name }}</h5>
                                <p class="text-muted small">{{ $order->user->email }}</p>
                            </div>
                            <hr class="my-4">
                            <div class="info-list">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">{{ __('messages.phone') }}:</span>
                                    <span class="font-weight-bold text-dark">{{ $order->phone }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">{{ __('messages.date') }}:</span>
                                    <span class="text-dark">{{ $order->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted d-block mb-2">{{ __('messages.shipping_address') }}:</span>
                                    <div class="p-3 bg-light rounded text-dark small border">
                                        {{ $order->shipping_address ?? $order->address }}
                                    </div>
                                </div>
                                @if($order->notes)
                                <div class="mb-3">
                                    <span class="text-muted d-block mb-2">{{ __('messages.notes') }}:</span>
                                    <div class="p-3 bg-light-warning rounded text-dark small border-warning">
                                        {{ $order->notes }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items & Status Update -->
                <div class="col-xl-8">
                    <!-- Status Cards -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 bg-light-primary border-left-primary">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3 p-2 bg-primary text-white rounded-circle">
                                            <i data-feather="truck" style="width: 20px;"></i>
                                        </div>
                                        <div>
                                            <small class="text-primary d-block font-weight-bold">{{ __('admin.order_status') }}</small>
                                            <h5 class="mb-0 text-dark font-weight-bold">{{ $order->status->label() }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 bg-light-success border-left-success">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3 p-2 bg-success text-white rounded-circle">
                                            <i data-feather="credit-card" style="width: 20px;"></i>
                                        </div>
                                        <div>
                                            <small class="text-success d-block font-weight-bold">{{ __('admin.payment_status') }}</small>
                                            <h5 class="mb-0 text-dark font-weight-bold">{{ $order->payment_status->label() ?? 'Pending' }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items Table -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white py-3 border-0">
                            <h5 class="mb-0 text-dark font-weight-bold">{{ __('admin.order_items') ?? 'Order Items' }}</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light text-muted small">
                                        <tr>
                                            <th class="px-4">{{ __('admin.product') }}</th>
                                            <th class="text-center">{{ __('admin.price') }}</th>
                                            <th class="text-center">{{ __('admin.quantity') }}</th>
                                            <th class="text-right px-4">{{ __('admin.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('dashboard/Images/' . $item->product->image) }}" class="rounded shadow-xs mr-3" style="width: 45px; height: 45px; object-fit: cover;">
                                                        <div>
                                                            <span class="d-block text-dark font-weight-bold">{{ $item->product->name }}</span>
                                                            <small class="text-muted">SKU: PROD-{{ $item->product->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center text-dark">{{ number_format($item->price, 2) }}</td>
                                                <td class="text-center font-weight-bold text-primary">x{{ $item->quantity }}</td>
                                                <td class="text-right px-4 font-weight-bold text-dark">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold py-3">{{ __('messages.subtotal') ?? 'Subtotal' }}:</td>
                                            <td class="text-right px-4 py-3 text-dark font-weight-bold">{{ number_format($order->total_price, 2) }} EGP</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold py-3 text-primary h5 mb-0">{{ __('messages.grand_total') ?? 'Grand Total' }}:</td>
                                            <td class="text-right px-4 py-3 text-primary h5 mb-0 font-weight-bold">{{ number_format($order->total_price, 2) }} EGP</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Actions & Status Update -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-dark font-weight-bold">{{ __('admin.update_order_status') ?? 'Update Order Status' }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="small font-weight-bold text-muted">{{ __('admin.select_status') }}</label>
                                            <select name="status" class="form-control custom-select shadow-sm">
                                                @foreach(\App\Enums\OrderStatus::cases() as $status)
                                                    <option value="{{ $status->value }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                        {{ $status->label() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <button type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm">
                                            <i data-feather="save" class="mr-2" style="width: 16px;"></i> {{ __('admin.save_changes') ?? 'Save Changes' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-light-primary { background-color: #f0f7ff !important; }
        .bg-light-success { background-color: #f0fff4 !important; }
        .bg-light-warning { background-color: #fffaf0 !important; }
        .border-left-primary { border-left: 4px solid #4e73df !important; }
        .border-left-success { border-left: 4px solid #1cc88a !important; }
        .border-warning { border: 1px solid #ffc107 !important; }
    </style>
@endsection
