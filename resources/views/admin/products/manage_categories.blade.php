@extends('admin.layout.master')
@section('title','Meeyaar | Manage Categories')
@section('styles')
 <!-- Plugin css for this page -->
 <link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
 <link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net-fixedcolumns-bs4/fixedColumns.bootstrap4.min.css')}}">
 <!-- End Plugin css for this page -->

 <!-- inject:css -->
 <link rel="stylesheet" href="{{asset('admin/assets/css/shared/style.css')}}">
 <!-- endinject -->
@endsection
@section('content')
@if(session('created'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('created')}}
    </div>
@endif
@if(session('updated'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('updated')}}
    </div>
@endif
@if(session('deleted'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('deleted')}}
    </div>
@endif
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3><b> Create New Category </b></h3>
        <form action="{{route('admin.store_category')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                <div class="form-group row">
                    <label for="Name" class="col-sm-1">Name</label>
                    <div class="col-sm-6">
                    <input type="text" name="category_name" class="form-control 
                    @error('category_name') is-invalid @enderror
                    @if(session('already_exist'))
                    is-invalid
                    @endif
                    " placeholder="Enter name of category"
                    value="{{ old('category_name')}}" required>
                    @error('category_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if(session('already_exist'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ session('already_exist') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-primary btn-md" type="submit">Create Category</button>
                </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3><b> Existing Categories </b></h3>
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                <th> # </th>
                <th> Name </th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="#" class="mr-2 edit-category" title="Edit Category" data-id="{{$category->id}}"
                        data-toggle="modal" data-target="#EditCategoryModal" data-url="{{route('admin.update_category',$category->id)}}"><i class="fa fa-edit text-success"></i></a>
                        <a href="#" title="Delete Category" class="remove" data-id="{{$category->id}}"
                            data-toggle="modal" data-target="#Modal" data-url="{{route('admin.delete_category',$category->id)}}"><i class="fa fa-trash text-danger"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3><b> Create Sub Category </b></h3>
        <form action="{{route('admin.store_sub_category')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                <div class="form-group row">
                    <label for="Name" class="col-sm-1">Name</label>
                    <div class="col-sm-6">
                    <input type="text" name="sub_category_name" class="form-control 
                    @error('sub_category_name') is-invalid @enderror
                    @if(session('sub_already_exist'))
                        is-invalid
                    @endif
                    " placeholder="Enter name of subcategory" required>
                    @error('sub_category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    @if(session('sub_already_exist'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ session('sub_already_exist') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="form-group row">
                    <label for="select" class="col-sm-1">Select Category</label>
                    <div class="col-sm-6">
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror pt-0 pb-0" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-primary btn-md" type="submit">Create Sub Category</button>
                </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3><b> Existing Sub Categories </b></h3>
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                <th> # </th>
                <th> Name </th>
                <th> Parent Category</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($sub_categories as $sub)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sub->name}}</td>
                    <td>{{$sub->category->name}}</td>
                    <td>
                        <a href="#" class="mr-2 edit-subcategory" title="Edit Subcategory" data-id="{{$sub->id}}"
                        data-toggle="modal" data-target="#EditSubCategoryModal" data-url="{{route('admin.update_sub_category',$sub->id)}}"><i class="fa fa-edit text-success"></i></a>
                        <a href="#" title="Delete Subcategory" class="remove" data-id="{{$sub->id}}"
                            data-toggle="modal" data-target="#Modal" data-url="{{route('admin.delete_sub_category',$sub->id)}}"><i class="fa fa-trash text-danger"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
    <!-- Modal -->
    <form method="POST" class="form">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Are you sure,you want to delete this?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
            </div>
        </div>
    </form>
    
    <!--Edit Category Modal -->
    <form method="POST" class="edit_category_form">
        @csrf
        @method('PATCH')
        <div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="edit_category" name="category_name" class="form-control" placeholder="Enter name of category" required>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
            </div>
        </div>
    </form>

    <!--Edit Subcategory Modal -->
    <form method="POST" class="edit_subcategory_form">
        @csrf
        @method('PATCH')
        <div class="modal fade" id="EditSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Subcategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="edit_subcategory" name="sub_category_name" class="form-control" placeholder="Enter name of category" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="select" class="col-sm-2">Select Category</label>
                            <div class="col-sm-6">
                                <select name="category" id="edit_select_category" class="form-control @error('category') is-invalid @enderror pt-0 pb-0" required>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
  $(document).ready(function()
  {
    $('.edit-category').on('click',function()
    {
        var id=$(this).attr('data-id');
        var url=$(this).attr('data-url');
        $.ajax({
            type:'GET',
            url:'/admin/manage_categories/category/edit/'+id,
            data:{

            },
            success:function(data)
            {
                $('#edit_category').val(data['name']);
                $('.edit_category_form').attr('action',url);
            },
            error:function()
            {

            }
        });
    });
    $('.edit-subcategory').on('click',function()
    {
        var id=$(this).attr('data-id');
        var url=$(this).attr('data-url');
        $.ajax({
            type:'GET',
            url:'/admin/manage_categories/sub_category/edit/'+id,
            data:{

            },
            success:function(data)
            {
                var selected_category=data[0]['sub_category']['category']['name'];
                var categories=data[0]['categories'];
                $('#edit_select_category').children().remove();
                for(var i=0;i<categories.length;i++)
                {
                    
                    if(categories[i]['name'] == selected_category)
                    {
                        $('#edit_select_category').append('<option value="'+categories[i]["id"]+'" selected>'+categories[i]["name"]+'</option>');
                    }
                    else
                    {
                        $('#edit_select_category').append('<option value="'+categories[i]["id"]+'">'+categories[i]["name"]+'</option>');
                    }
                }
                $('#edit_subcategory').val(data[0]['sub_category']['name']);
                $('.edit_subcategory_form').attr('action',url);
            },
            error:function()
            {

            }
        });
    });
  });
</script>
<!-- Plugin js for this page -->
<script src="{{asset('admin/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/assets/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js')}}"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="{{asset('admin/assets/js/shared/data-table.js')}}"></script>
<!-- End custom js for this page -->
@endsection
