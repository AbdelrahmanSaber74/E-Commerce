@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <!-- Container-fluid starts-->

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            </button>
        </div>
        @endif
    
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            </button>
        </div>
        @endif

        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> {{ __('admin.products') }}
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Digital</li>
                            <li class="breadcrumb-item active">Sub Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('admin.add_new') }} {{ __('admin.products') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <form action="{{ route('Products.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12">



                                        <div class="form-group">
                                            <label for="validationCustomtitle" class="col-form-label pt-0">{{ __('admin.category') }}</label>
                                            <select name="category_id" id="" class="form-control" required>
                                                <option hidden value="">{{ __('admin.select_category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="validationCustom05" class="col-form-label pt-0">
                                                {{ __('admin.product_image') }}</label>
                                            <input class="form-control dropify" id="validationCustom05" type="file"
                                                name="image">
                                        </div>


                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0">
                                                {{ __('admin.name') }}</label>
                                            <input class="form-control" id="validationCustom01" type="text"
                                                name="name" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-form-label">{{ __('admin.description') }}</label>
                                            <textarea rows="5" cols="12" name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                {{ __('admin.price') }} </label>
                                            <input class="form-control" id="validationCustom02" type="text"
                                                name="price">
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                {{ __('admin.discount_price') }} </label>
                                            <input class="form-control" id="validationCustom02" type="text"
                                                name="discount_price">
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                {{ __('admin.available_colors') }} </label>
                                            <select class="form-control colors" multiple="multiple" name="colors[]">
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                {{ __('admin.available_sizes') }} </label>
                                            <select class="form-control colors" multiple="multiple" name="sizes[]">
                                            </select>
                                        </div>

                                        

                                        <div class="form-group">
                                            <label for="validationCustom05" class="col-form-label pt-0">
                                               {{ __('admin.product_images') }}</label>
                                            <input class="form-control dropify" id="validationCustom05" type="file"
                                                name="images[]" multiple>
                                        </div>

                                    </div>
                            </div>



                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{ __('admin.save') }}</button>
                            </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->

    </div>
    </div>
@endsection


@push('javascripts')
    <script>
        $(".colors").select2({
            tags: true
        });
    </script>

@endpush
