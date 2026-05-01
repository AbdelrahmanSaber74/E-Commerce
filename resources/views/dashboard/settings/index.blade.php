@extends('dashboard.layout.layout')

@section('body')
@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold"> <i data-feather="settings" class="mr-2"></i> {{ __('admin.settings') }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('admin.settings') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-dark">{{ __('admin.general_settings') ?? 'General Settings' }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $setting->id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label font-weight-bold">{{ __('admin.site_logo') }}</label>
                                            <input class="form-control dropify" type="file" name="logo" data-default-file="{{ asset('dashboard/setting/' . $setting->logo) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label font-weight-bold">{{ __('admin.favicon') }}</label>
                                            <input class="form-control dropify" type="file" name="favicon" data-default-file="{{ asset('dashboard/setting/' . $setting->favicon) }}">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold">{{ __('admin.site_name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control shadow-sm" type="text" name="name" value="{{ $setting->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold">{{ __('admin.email') }} <span class="text-danger">*</span></label>
                                            <input class="form-control shadow-sm" type="email" name="email" value="{{ $setting->email }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">{{ __('admin.site_description') }}</label>
                                    <textarea class="form-control shadow-sm" rows="4" name="description">{{ $setting->description }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold">{{ __('admin.phone') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="phone" value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold">{{ __('admin.address') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="address" value="{{ $setting->address }}">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3 text-primary"><i data-feather="share-2" class="mr-1"></i> {{ __('admin.social_links') ?? 'Social Links' }}</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label"><i class="fa fa-facebook-official text-primary mr-1"></i> {{ __('admin.facebook') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="facebook" value="{{ $setting->facebook }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label"><i class="fa fa-twitter text-info mr-1"></i> {{ __('admin.twitter') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="twitter" value="{{ $setting->twitter }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label"><i class="fa fa-instagram text-danger mr-1"></i> {{ __('admin.instagram') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="instagram" value="{{ $setting->instagram }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label"><i class="fa fa-youtube-play text-danger mr-1"></i> {{ __('admin.youtube') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="youtube" value="{{ $setting->youtube }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label"> {{ __('admin.tiktok') }}</label>
                                            <input class="form-control shadow-sm" type="text" name="tiktok" value="{{ $setting->tiktok }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" type="submit">
                                        <i data-feather="save" class="mr-1"></i> {{ __('admin.save_settings') ?? __('admin.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
