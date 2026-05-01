@extends('dashboard.layout.layout')

@section('body')
      <!-- Container-fluid starts-->
      <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>{{ __('admin.dashboard') }}
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('admin.dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards shadow-sm border-0">
                    <div class="warning-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="dollar-sign" class="font-warning"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0 text-muted font-weight-bold">{{ __('admin.earnings') ?? 'Total Earnings' }}</span>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ number_format($stats['total_earnings'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards shadow-sm border-0">
                    <div class="secondary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="box" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0 text-muted font-weight-bold">{{ __('admin.products') }}</span>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $stats['total_products'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards shadow-sm border-0">
                    <div class="primary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="shopping-cart" class="font-primary"></i></div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0 text-muted font-weight-bold">{{ __('admin.orders') }}</span>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $stats['total_orders'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards shadow-sm border-0">
                    <div class="danger-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0 text-muted font-weight-bold">{{ __('admin.customers') ?? 'Customers' }}</span>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $stats['total_customers'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 xl-100">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 font-weight-bold text-dark">{{ __('admin.latest_orders') ?? 'Latest Orders' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>{{ __('admin.order_id') ?? 'Order ID' }}</th>
                                        <th>{{ __('admin.customer') }}</th>
                                        <th>{{ __('admin.total') ?? 'Total' }}</th>
                                        <th>{{ __('admin.status') }}</th>
                                        <th>{{ __('admin.date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stats['latest_orders'] as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td class="font-weight-bold text-primary">{{ number_format($order->total_price, 2) }}</td>
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
                                            <span class="badge {{ $statusClass }} rounded-pill py-2 px-3">{{ \App\Enums\OrderStatus::label($order->status) }}</span>
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">{{ __('admin.no_orders_found') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-4">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">{{ __('admin.view_all_orders') ?? 'View All Orders' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head1" title=""
                                data-original-title="Copy"><i
                                    class="icofont icofont-copy-alt"></i></button>
                            <pre class=" language-html"><code class=" language-html" id="example-head1">
&lt;div class="user-status table-responsive latest-order-table"&gt;
&lt;table class="table table-bordernone"&gt;
&lt;thead&gt;
&lt;tr&gt;
    &lt;th scope="col"&gt;Order ID&lt;/th&gt;
    &lt;th scope="col"&gt;Order Total&lt;/th&gt;
    &lt;th scope="col"&gt;Payment Method&lt;/th&gt;
    &lt;th scope="col"&gt;Status&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
&lt;tr&gt;
    &lt;td&gt;1&lt;/td&gt;
    &lt;td class="digits"&gt;$120.00&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Bank Transfers&lt;/td&gt;
    &lt;td class="digits"&gt;Delivered&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;2&lt;/td&gt;
    &lt;td class="digits"&gt;$90.00&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Ewallets&lt;/td&gt;
    &lt;td class="digits"&gt;Delivered&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;3&lt;/td&gt;
    &lt;td class="digits"&gt;$240.00&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Cash&lt;/td&gt;
    &lt;td class="digits"&gt;Delivered&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;4&lt;/td&gt;
    &lt;td class="digits"&gt;$120.00&lt;/td&gt;
    &lt;td class="font-primary"&gt;Direct Deposit&lt;/td&gt;
    &lt;td class="digits"&gt;Delivered&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;5&lt;/td&gt;
    &lt;td class="digits"&gt;$50.00&lt;/td&gt;
    &lt;td class="font-primary"&gt;Bank Transfers&lt;/td&gt;
    &lt;td class="digits"&gt;Delivered&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
                        </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 font-weight-bold text-dark">Revenue (Last 7 Days)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="150"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 font-weight-bold text-dark">Order Status Distribution</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" height="150"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Buy / Sell</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body sell-graph">
                        <canvas id="myGraph"></canvas>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head3" title=""
                                data-original-title="Copy"><i
                                    class="icofont icofont-copy-alt"></i></button>
                            <pre class=" language-html"><code class=" language-html" id="example-head3">&lt;div class="card-body sell-graph"&gt;
&lt;canvas id="myGraph"&gt;&lt;/canvas&gt;
&lt;/div&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>Goods return</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive products-table">
                            <table class="table table-bordernone mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Details</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Simply dummy text of the printing</td>
                                        <td class="digits">1</td>
                                        <td class="font-primary">Pending</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>Long established</td>
                                        <td class="digits">5</td>
                                        <td class="font-secondary">Cancle</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>sometimes by accident</td>
                                        <td class="digits">10</td>
                                        <td class="font-secondary">Cancle</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>Classical Latin literature</td>
                                        <td class="digits">9</td>
                                        <td class="font-primary">Return</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>keep the site on the Internet</td>
                                        <td class="digits">8</td>
                                        <td class="font-primary">Pending</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>Molestiae consequatur</td>
                                        <td class="digits">3</td>
                                        <td class="font-secondary">Cancle</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                    <tr>
                                        <td>Pain can procure</td>
                                        <td class="digits">8</td>
                                        <td class="font-primary">Return</td>
                                        <td class="digits">$6523</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head4" title=""
                                data-original-title="Copy"><i
                                    class="icofont icofont-copy-alt"></i></button>
                            <pre class=" language-html"><code class=" language-html" id="example-head4">
&lt;div class="user-status table-responsive products-table"&gt;
&lt;table class="table table-bordernone mb-0"&gt;
&lt;thead&gt;
&lt;tr&gt;
    &lt;th scope="col"&gt;Details&lt;/th&gt;
    &lt;th scope="col"&gt;Quantity&lt;/th&gt;
    &lt;th scope="col"&gt;Status&lt;/th&gt;
    &lt;th scope="col"&gt;Price&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
&lt;tr&gt;
    &lt;td&gt;Simply dummy text of the printing&lt;/td&gt;
    &lt;td class="digits"&gt;1&lt;/td&gt;
    &lt;td class="font-primary"&gt;Pending&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;Long established&lt;/td&gt;
    &lt;td class="digits"&gt;5&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Cancle&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;sometimes by accident&lt;/td&gt;
    &lt;td class="digits"&gt;10&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Cancle&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;Classical Latin literature&lt;/td&gt;
    &lt;td class="digits"&gt;9&lt;/td&gt;
    &lt;td class="font-primary"&gt;Return&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;keep the site on the Internet&lt;/td&gt;
    &lt;td class="digits"&gt;8&lt;/td&gt;
    &lt;td class="font-primary"&gt;Pending&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;Molestiae consequatur&lt;/td&gt;
    &lt;td class="digits"&gt;3&lt;/td&gt;
    &lt;td class="font-secondary"&gt;Cancle&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td&gt;Pain can procure&lt;/td&gt;
    &lt;td class="digits"&gt;8&lt;/td&gt;
    &lt;td class="font-primary"&gt;Return&lt;/td&gt;
    &lt;td class="digits"&gt;$6523&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
                        </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>Empolyee Status</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive products-table">
                            <table class="table table-bordernone mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Skill Level</th>
                                        <th scope="col">Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size"><img
                                                    class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded"
                                                    src="assets/images/dashboard/user2.jpg" alt=""
                                                    data-original-title="" title="">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-0">John Deo <span
                                                            class="text-muted digits">(14+
                                                            Online)</span></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Designer</td>
                                        <td>
                                            <div class="progress-showcase">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 30%" aria-valuenow="50"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="digits">2 Year</td>
                                    </tr>
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size"><img
                                                    class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded"
                                                    src="assets/images/dashboard/user1.jpg" alt=""
                                                    data-original-title="" title="">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-0">Holio Mako <span
                                                            class="text-muted digits">(250+ Online)</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Developer</td>
                                        <td>
                                            <div class="progress-showcase">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-secondary"
                                                        role="progressbar" style="width: 70%"
                                                        aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="digits">3 Year</td>
                                    </tr>
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size"><img
                                                    class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded"
                                                    src="assets/images/dashboard/user3.jpg" alt=""
                                                    data-original-title="" title="">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-0">Mohsib lara<span
                                                            class="text-muted digits">(99+ Online)</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Tester</td>
                                        <td>
                                            <div class="progress-showcase">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 60%" aria-valuenow="50"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="digits">5 Month</td>
                                    </tr>
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size"><img
                                                    class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded"
                                                    src="assets/images/dashboard/user.jpg" alt=""
                                                    data-original-title="" title="">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-0">Hileri Soli <span
                                                            class="text-muted digits">(150+ Online)</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Designer</td>
                                        <td>
                                            <div class="progress-showcase">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-secondary"
                                                        role="progressbar" style="width: 30%"
                                                        aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="digits">3 Month</td>
                                    </tr>
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size"><img
                                                    class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded"
                                                    src="assets/images/dashboard/designer.jpg" alt=""
                                                    data-original-title="" title="">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-0">Pusiz bia <span
                                                            class="text-muted digits">(14+ Online)</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Designer</td>
                                        <td>
                                            <div class="progress-showcase">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 90%" aria-valuenow="50"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="digits">5 Year</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head5" title=""
                                data-original-title="Copy"><i
                                    class="icofont icofont-copy-alt"></i></button>
                            <pre class=" language-html"><code class=" language-html" id="example-head5">
&lt;div class="user-status table-responsive products-table"&gt;
&lt;table class="table table-bordernone mb-0"&gt;
&lt;thead&gt;
&lt;tr&gt;
    &lt;th scope="col"&gt;Name&lt;/th&gt;
    &lt;th scope="col"&gt;Designation&lt;/th&gt;
    &lt;th scope="col"&gt;Skill Level&lt;/th&gt;
    &lt;th scope="col"&gt;Experience&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
    &lt;tr&gt;
        &lt;td class="bd-t-none u-s-tb"&gt;
            &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user2.jpg" alt="" data-original-title="" title=""&gt;
            &lt;div class="d-inline-block"&gt;
            &lt;h6&gt;John Deo &lt;span class="text-muted digits"&gt;(14+ Online)&lt;/span&gt;&lt;/h6&gt;
            &lt;/div&gt;
            &lt;/div&gt;
        &lt;/td&gt;
        &lt;td&gt;Designer&lt;/td&gt;
        &lt;td&gt;
            &lt;div class="progress-showcase"&gt;
            &lt;div class="progress" style="height: 8px;"&gt;
            &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
            &lt;/div&gt;
            &lt;/div&gt;
        &lt;/td&gt;
        &lt;td class="digits"&gt;2 Year&lt;/td&gt;
    &lt;/tr&gt;
&lt;tr&gt;
    &lt;td class="bd-t-none u-s-tb"&gt;
        &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user1.jpg" alt="" data-original-title="" title=""&gt;
        &lt;div class="d-inline-block"&gt;
        &lt;h6&gt;Holio Mako &lt;span class="text-muted digits"&gt;(250+ Online)&lt;/span&gt;&lt;/h6&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td&gt;Developer&lt;/td&gt;
    &lt;td&gt;
        &lt;div class="progress-showcase"&gt;
        &lt;div class="progress" style="height: 8px;"&gt;
        &lt;div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td class="digits"&gt;3 Year&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td class="bd-t-none u-s-tb"&gt;
        &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user3.jpg" alt="" data-original-title="" title=""&gt;
        &lt;div class="d-inline-block"&gt;
        &lt;h6&gt;Mohsib lara&lt;span class="text-muted digits"&gt;(99+ Online)&lt;/span&gt;&lt;/h6&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td&gt;Tester&lt;/td&gt;
    &lt;td&gt;
        &lt;div class="progress-showcase"&gt;
        &lt;div class="progress" style="height: 8px;"&gt;
        &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td class="digits"&gt;5 Month&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td class="bd-t-none u-s-tb"&gt;
        &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user.jpg" alt="" data-original-title="" title=""&gt;
        &lt;div class="d-inline-block"&gt;
        &lt;h6&gt;Hileri Soli &lt;span class="text-muted digits"&gt;(150+ Online)&lt;/span&gt;&lt;/h6&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td&gt;Designer&lt;/td&gt;
    &lt;td&gt;
        &lt;div class="progress-showcase"&gt;
        &lt;div class="progress" style="height: 8px;"&gt;
        &lt;div class="progress-bar bg-secondary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td class="digits"&gt;3 Month&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
    &lt;td class="bd-t-none u-s-tb"&gt;
        &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/designer.jpg" alt="" data-original-title="" title=""&gt;
        &lt;div class="d-inline-block"&gt;
        &lt;h6&gt;Pusiz bia &lt;span class="text-muted digits"&gt;(14+ Online)&lt;/span&gt;&lt;/h6&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td&gt;Designer&lt;/td&gt;
    &lt;td&gt;
        &lt;div class="progress-showcase"&gt;
        &lt;div class="progress" style="height: 8px;"&gt;
        &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
    &lt;/td&gt;
    &lt;td class="digits"&gt;5 Year&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
                        </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Sales Status</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 xl-50">
                                <div class="order-graph">
                                    <h6>Orders By Location</h6>
                                    <div class="chart-block chart-vertical-center">
                                        <canvas id="myDoughnutGraph"></canvas>
                                    </div>
                                    <div class="order-graph-bottom">
                                        <div class="media">
                                            <div class="order-color-primary"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0">Saint Lucia <span
                                                        class="pull-right">$157</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-color-secondary"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0">Kenya <span
                                                        class="pull-right">$347</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-color-danger"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0">Liberia<span
                                                        class="pull-right">$468</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-color-warning"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0">Christmas Island<span
                                                        class="pull-right">$742</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-color-success"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0">Saint Helena <span
                                                        class="pull-right">$647</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 xl-50">
                                <div class="order-graph sm-order-space">
                                    <h6>Sales By Location</h6>
                                    <div class="peity-chart-dashboard text-center">
                                        <span class="pie-colours-1">4,7,6,5</span>
                                    </div>
                                    <div class="order-graph-bottom sales-location">
                                        <div class="media">
                                            <div class="order-shape-primary"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0 me-0">Germany <span
                                                        class="pull-right">25%</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-shape-secondary"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0 me-0">Brasil <span
                                                        class="pull-right">10%</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-shape-danger"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0 me-0">United Kingdom<span
                                                        class="pull-right">34%</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-shape-warning"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0 me-0">Australia<span
                                                        class="pull-right">5%</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="order-shape-success"></div>
                                            <div class="media-body">
                                                <h6 class="mb-0 me-0">Canada <span
                                                        class="pull-right">25%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="order-graph xl-space">
                                    <h6>Revenue for last month</h6>
                                    <div class="ct-4 flot-chart-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head2" title="" data-original-title="Copy">
                                <i class="icofont icofont-copy-alt"></i>
                            </button>
                            <pre class=" language-html">
                                <code class=" language-html" id="example-head2">&lt;div class="row"&gt;
&lt;div class="col-xl-3 col-sm-6 xl-50"&gt;
&lt;div class="order-graph"&gt;
&lt;h6&gt;Orders By Location&lt;/h6&gt;
&lt;div class="chart-block chart-vertical-center"&gt;
&lt;canvas id="myDoughnutGraph"&gt;&lt;/canvas&gt;
&lt;/div&gt;
&lt;div class="order-graph-bottom"&gt;
&lt;div class="media"&gt;
   &lt;div class="order-color-primary"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0"&gt;Saint Lucia &lt;span class="pull-right"&gt;$157&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-color-secondary"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0"&gt;Kenya &lt;span class="pull-right"&gt;$347&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-color-danger"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0"&gt;Liberia&lt;span class="pull-right"&gt;$468&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-color-warning"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0"&gt;Christmas Island&lt;span class="pull-right"&gt;$742&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-color-success"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0"&gt;Saint Helena &lt;span class="pull-right"&gt;$647&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="col-xl-3 col-sm-6 xl-50"&gt;
&lt;div class="order-graph sm-order-space"&gt;
&lt;h6&gt;Sales By Location&lt;/h6&gt;
&lt;div class="peity-chart-dashboard text-center"&gt;
&lt;span class="pie-colours-1"&gt;4,7,6,5&lt;/span&gt;
&lt;/div&gt;
&lt;div class="order-graph-bottom sales-location"&gt;
&lt;div class="media"&gt;
   &lt;div class="order-shape-primary"&gt;&lt;/div&gt;
      &lt;div class="media-body"&gt;
         &lt;h6 class="mb-0 me-0"&gt;Germany &lt;span class="pull-right"&gt;25%&lt;/span&gt;&lt;/h6&gt;
      &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-shape-secondary"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0 me-0"&gt;Brasil &lt;span class="pull-right"&gt;10%&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-shape-danger"&gt;&lt;/div&gt;
      &lt;div class="media-body"&gt;
         &lt;h6 class="mb-0 me-0"&gt;United Kingdom&lt;span class="pull-right"&gt;34%&lt;/span&gt;&lt;/h6&gt;
      &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-shape-warning"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0 me-0"&gt;Australia&lt;span class="pull-right"&gt;5%&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;div class="media"&gt;
   &lt;div class="order-shape-success"&gt;&lt;/div&gt;
   &lt;div class="media-body"&gt;
      &lt;h6 class="mb-0 me-0"&gt;Canada &lt;span class="pull-right"&gt;25%&lt;/span&gt;&lt;/h6&gt;
   &lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="col-xl-6 xl-100"&gt;
&lt;div class="order-graph xl-space"&gt;
&lt;h6&gt;Revenue for last month&lt;/h6&gt;
&lt;div class="ct-4 flot-chart-container"&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
@push('javascripts')
<script>
    window.dashboardData = {
        salesData: {!! json_encode($salesData) !!},
        statusData: {!! json_encode($statusData) !!}
    };
</script>
@endpush
@endsection