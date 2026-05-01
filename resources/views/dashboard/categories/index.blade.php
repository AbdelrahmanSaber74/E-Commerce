@section('body')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 class="font-weight-bold"> <i data-feather="grid" class="mr-2"></i> {{ __('admin.categories') }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('admin.categories') }}</li>
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
                            <h5 class="mb-0">{{ __('admin.categories_list') ?? 'Categories List' }}</h5>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i data-feather="plus-circle" class="mr-1"></i> {{ __('admin.add_new') }}
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.image') }}</th>
                                            <th>{{ __('admin.name') }}</th>
                                            <th>{{ __('admin.main_category') }}</th>
                                            <th class="text-center">{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($category->image)
                                                    <img src="{{ asset('dashboard/Categories/' . $category->image) }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                                        <i data-feather="image" class="text-muted" style="width: 20px;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td><span class="font-weight-bold text-dark">{{ $category->name }}</span></td>
                                            <td>
                                                <span class="badge badge-info py-2 px-3 rounded-pill">{{ $category->mainCategories->name }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-info mr-2 rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $category->id }}" title="{{ __('admin.edit') }}">
                                                        <i data-feather="edit-2" style="width: 14px;"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $category->id }}" title="{{ __('admin.delete') }}">
                                                        <i data-feather="trash-2" style="width: 14px;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <form action="{{ route('Category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title font-weight-bold">{{ __('admin.edit') }} {{ $category->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label font-weight-bold">{{ __('admin.name') }}</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required shadow-sm>
                                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label font-weight-bold">{{ __('admin.main_category') }}</label>
                                                                <select name="parent_id" class="form-control select2 shadow-sm">
                                                                    @foreach ($mainCategories as $mainCat)
                                                                        <option value="{{ $mainCat->id }}" {{ $category->parent_id == $mainCat->id ? 'selected' : '' }}>{{ $mainCat->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label font-weight-bold">{{ __('admin.image') }}</label>
                                                                <input type="file" name="photo" class="form-control dropify" data-default-file="{{ asset('dashboard/Categories/' . $category->image) }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light border-0">
                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">{{ __('admin.close') }}</button>
                                                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">{{ __('admin.save_changes') ?? 'Save Changes' }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-body text-center py-4">
                                                        <i data-feather="alert-triangle" class="text-danger mb-3" style="width: 50px; height: 50px;"></i>
                                                        <h5 class="mb-3">{{ __('admin.confirm_delete') }}</h5>
                                                        <p class="text-muted">{{ __('admin.delete_warning') ?? 'This action cannot be undone.' }}</p>
                                                        <form action="{{ route('Category.destroy', 'test') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                                            <button type="button" class="btn btn-secondary rounded-pill px-4 mr-2" data-bs-dismiss="modal">{{ __('admin.cancel') ?? 'Cancel' }}</button>
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4">{{ __('admin.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i data-feather="layers" style="width: 50px; height: 50px;" class="mb-3 d-block mx-auto"></i>
                                                {{ __('admin.no_categories_found') ?? 'No categories found' }}
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('Category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-light">
                        <h5 class="modal-title font-weight-bold">{{ __('admin.add_new') }} {{ __('admin.category') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label font-weight-bold">{{ __('admin.name') }}</label>
                            <input type="text" name="name" class="form-control shadow-sm" required placeholder="{{ __('admin.enter_name') ?? 'Enter name' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label font-weight-bold">{{ __('admin.main_category') }}</label>
                            <select name="parent_id" class="form-control select2 shadow-sm">
                                <option value="" hidden>{{ __('admin.select_category') }}</option>
                                @foreach ($mainCategories as $mainCat)
                                    <option value="{{ $mainCat->id }}">{{ $mainCat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold">{{ __('admin.image') }}</label>
                            <input type="file" name="photo" class="form-control dropify">
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">{{ __('admin.close') }}</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">{{ __('admin.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection





@endsection


