@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold"> <i data-feather="package" class="mr-2"></i> {{ __('admin.products') }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('admin.products') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0">{{ __('admin.products_list') ?? 'Products List' }}</h5>
                            <a class="btn btn-primary btn-sm rounded-pill shadow-sm" href="{{route('Products.create') }}">
                                <i data-feather="plus-circle" class="mr-1"></i> {{ __('admin.add_new') }}
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="productsTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.image') ?? 'Image' }}</th>
                                            <th>{{ __('admin.name') }}</th>
                                            <th>{{ __('admin.category') }}</th>
                                            <th>{{ __('admin.price') }}</th>
                                            <th>{{ __('admin.status') ?? 'Status' }}</th>
                                            <th class="text-center">{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($product->image) }}" class="img-fluid blur-up lazyloaded rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark">{{ $product->name }}</div>
                                            <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary py-2 px-3 rounded-pill">{{ $product->category->name }}</span>
                                        </td>
                                        <td>
                                            @if($product->discount_price)
                                                <span class="text-primary font-weight-bold">{{ $product->discount_price }}</span>
                                                <del class="text-muted small ml-1">{{ $product->price }}</del>
                                            @else
                                                <span class="text-dark">{{ $product->price }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }} p-2">
                                                {{ $product->status ? __('admin.active') ?? 'Active' : __('admin.inactive') ?? 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('Products.edit', $product->id) }}" class="btn btn-sm btn-outline-info mr-2 rounded shadow-sm" title="{{ __('admin.edit') }}">
                                                    <i data-feather="edit-2" style="width: 14px;"></i>
                                                </a>
                                                <form action="{{ route('Products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('admin.confirm_delete') ?? 'Are you sure?' }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded shadow-sm" title="{{ __('admin.delete') }}">
                                                        <i data-feather="trash-2" style="width: 14px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i data-feather="box" style="width: 50px; height: 50px;" class="mb-3 d-block mx-auto"></i>
                                            {{ __('admin.no_products_found') ?? 'No products found' }}
                                        </td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


{{-- @push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.products.getall') }}",
                columns: [

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'discount_price',
                        name: 'discount_price'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                   
                ]
            });

        });

        $('#editableTable tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
@endpush --}}
