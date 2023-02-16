@extends('dashboard.layout.layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@section('body')
    <div class="page-body">


    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        </button>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Error') }}</strong>
        </button>
    </div>
    @endif


        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>أقسام المنتجات
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">

                            </form>

                            <button type="button" class="btn btn-primary mt-md-0 mt-2" data-bs-toggle="modal"
                                data-original-title="test" data-bs-target="#exampleModal">إضافة قسم جديد</button>



                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="table-responsive table-desi">

                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الصورة</th>
                                        <th scope="col">القسم الرئيسي</th>
                                        <th scope="col">العمليات</th>

                                      </tr>
                                    </thead>
                                    <tbody>

                                        <?php  $i = 1 ; ?>
                                       @foreach ( $Categories as $Categorie )
                                       <tr>
                                        <th scope="row">{{ $i++}}</th>
                                        <td>{{ $Categorie->name }}</td>
                                        <td>
                                            @if (isset($Categorie->image))
                                            <img width="100px" height="150px" src="{{asset('dashboard/Categories'  . '/' . $Categorie->image )}}" alt=""> 
                                            @endif

                                         </td>
                                        <td>{{ $Categorie->MainCategories->name }}</td>

                                        <td>

                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $Categorie->id}}"
                                                title="تعديل"><i class="fa fa-edit"></i></button>
        

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{$Categorie->id}}"
                                                title="حذف"><i
                                                class="fa fa-trash"></i></button>

        
                                        </td>
                                      </tr>

                        <!-- Modal -->

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{$Categorie->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                تعديل القسم
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- edit_form -->

                                            <form action="{{ route('Category.update' , 'Update') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('PUT') }}
                                                @csrf

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name"
                                                            class="mr-sm-2">اسم القسم
                                                            :</label>
                                                        <input id="name" type="text" name="name"
                                                            class="form-control"
                                                            value="{{ $Categorie->name }}"
                                                            required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $Categorie->id }}">
                                                    </div>
                                                </div>


                                                <br> <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="inputName"
                                                                class="control-label">القسم الرئيسي</label>
                                                        <select name="parent_id"
                                                    class="custom-select">

                                                    <!--placeholder-->
                                                    <option hidden
                                                    value="{{ $Categorie->MainCategories->id }}">
                                                    {{ $Categorie->MainCategories->name }} 

                                                    @foreach ( $MainCategories as $MainCategorie )
                                                    <option value="{{ $MainCategorie->id }}">
                                                    {{$MainCategorie->name }}
                                                </option> 
                                                    @endforeach

                                                    </select>
                                                </div>
                                             </div>


                                                <br><br>
                                                <div class="row">
                                                <div class="col">
                                                    <label class="col-form-label ">الصورة المصغرة</label>
                                                    <input  type="file" class="form-control dropify"   name="photo"  data-default-file="{{asset('dashboard/Categories'  . '/' . $Categorie->image )}}">
                                                    <input type="file" name="photo"  class="form-control ">
                                                </div>

                                                </div>


                                                  

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">اغلاق</button>
                                                    <button type="submit"
                                                        class="btn btn-success">تعديل</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{$Categorie->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                حذف القسم
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Category.destroy' , 'test') }}" method="post">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                هل انت متأكد من عملية الحذف
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $Categorie->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">اغلاق</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                                       @endforeach 
                                    </tbody>

                                  </table>

                                  <br>

                                  {{ $Categories->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <form action="{{route('Category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">اضافة قسم جديد </h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="form">
                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">الإسم :</label>
                                    <input class="form-control" id="validationCustom01" type="text" name="name">
                                </div>


                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">القسم الرئيسي </label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="" hidden>قسم رئيسي</option>
                                        @foreach ($MainCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="validationCustom02" class="mb-1">الصورة :</label>
                                    <input class="form-control dropify" id="validationCustom02" type="file"
                                        name="photo">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">حفظ</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                        </div>
                    </form>

                    </div>

            </div>
        </div>
    </div>

    </div>





@endsection


