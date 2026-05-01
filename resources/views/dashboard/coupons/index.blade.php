@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold"> <i data-feather="tag" class="mr-2"></i> {{ __('admin.coupons') ?? 'Coupons' }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('admin.coupons') ?? 'Coupons' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark">{{ __('admin.coupons_list') ?? 'Coupons List' }}</h5>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-4" data-toggle="modal" data-target="#addCouponModal">
                                <i data-feather="plus-circle" class="mr-1"></i> {{ __('admin.add_coupon') ?? 'Add Coupon' }}
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.code') ?? 'Code' }}</th>
                                            <th>{{ __('admin.type') ?? 'Type' }}</th>
                                            <th>{{ __('admin.value') ?? 'Value' }}</th>
                                            <th>{{ __('admin.expiry_date') ?? 'Expiry Date' }}</th>
                                            <th>{{ __('admin.usage') ?? 'Usage' }}</th>
                                            <th>{{ __('admin.status') }}</th>
                                            <th class="text-center">{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($coupons as $coupon)
                                            <tr>
                                                <td class="font-weight-bold">#{{ $coupon->id }}</td>
                                                <td><code class="px-2 py-1 bg-light text-primary rounded font-weight-bold">{{ $coupon->code }}</code></td>
                                                <td>
                                                    <span class="badge badge-outline-info rounded-pill px-3">
                                                        {{ $coupon->type === 'percent' ? '%' : 'Fixed' }}
                                                    </span>
                                                </td>
                                                <td class="font-weight-bold text-dark">{{ number_format($coupon->value, 2) }}</td>
                                                <td>
                                                    <span class="{{ $coupon->expiry_date->isPast() ? 'text-danger' : 'text-muted' }}">
                                                        {{ $coupon->expiry_date->format('Y-m-d') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small class="text-muted">{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</small>
                                                        <div class="progress mt-1" style="height: 4px; width: 60px;">
                                                            @php
                                                                $percent = $coupon->usage_limit ? ($coupon->used_count / $coupon->usage_limit) * 100 : 0;
                                                            @endphp
                                                            <div class="progress-bar" style="width: {{ $percent }}%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $coupon->isValid() ? 'badge-success' : 'badge-danger' }} rounded-pill px-3">
                                                        {{ $coupon->isValid() ? __('admin.active') : __('admin.inactive') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-primary rounded-circle mr-1 shadow-sm" data-toggle="modal" data-target="#editCouponModal{{ $coupon->id }}">
                                                            <i data-feather="edit-2" style="width: 14px;"></i>
                                                        </button>
                                                        <form action="{{ route('Coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger rounded-circle shadow-sm show_confirm">
                                                                <i data-feather="trash-2" style="width: 14px;"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i data-feather="tag" style="width: 50px; height: 50px;" class="mb-3 d-block mx-auto opacity-25"></i>
                                                    {{ __('admin.no_coupons_found') ?? 'No coupons found' }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $coupons->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Coupon Modal -->
    <div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">{{ __('admin.add_new_coupon') ?? 'Add New Coupon' }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('Coupons.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-4">
                        <div class="form-group mb-3">
                            <label class="form-label font-weight-bold">{{ __('admin.code') }} <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control shadow-sm" required placeholder="SUMMER2024">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">{{ __('admin.type') }}</label>
                                    <select name="type" class="form-control shadow-sm" required>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="percent">Percentage (%)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">{{ __('admin.value') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="value" class="form-control shadow-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">{{ __('admin.expiry_date') }} <span class="text-danger">*</span></label>
                                    <input type="date" name="expiry_date" class="form-control shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">{{ __('admin.usage_limit') }}</label>
                                    <input type="number" name="usage_limit" class="form-control shadow-sm" placeholder="Optional">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-link text-muted" data-dismiss="modal">{{ __('admin.cancel') }}</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">{{ __('admin.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
