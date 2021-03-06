@extends('admin.layout.master')
@section('title','Meeyaar | Manage Products')
@push('plugin-styles')
 
@endpush
@section('styles')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 21px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 17px;
  width: 17px;
  left: 4px;
  bottom: 2px;
  
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net-fixedcolumns-bs4/fixedColumns.bootstrap4.min.css')}}">
<!-- End Plugin css for this page -->

<!-- inject:css -->
<link rel="stylesheet" href="{{asset('admin/assets/css/shared/style.css')}}">
<!-- endinject -->
@endsection
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
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
        <h3><b> Products </b></h3>
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                <th> # </th>
                <th> Title </th>
                <th colspan="4" class="text-center"> About </th>
                <th> Category </th>
                <th> Type </th>
                <th> Description </th>
                <th>Actions</th>
                <th>Is Trending</th>
                <th>Is Best Seller</th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th> Who </th>
                <th> What </th>
                <th> When </th>
                <th>Price</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->who}}</td>
                    <td>{{$product->subcategory[0]->name}}</td>
                    <td>{{$product->when}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{App\Models\Category::find($product->category_id)->name}}</td>
                    <td>{{$product->type}}</td>
                    <td >{{$product->description}}</td>
                    <td>
                      <a href="{{route('admin.product.edit',$product->id)}}" role="button" class="btn btn-success">Edit</a>
                      <a href="" data-url="{{route('admin.product.destroy',$product->id)}}" data-id="{{$product->id}}" data-toggle="modal" data-target="#Modal" role="button" class="btn btn-danger remove">Delete</a>
                    </td>
                    <td>
                      <label class="switch">
                        <input type="checkbox" class="switch" data-id="{{$product->id}}" @if($product->is_trending) checked @endif>
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td>
                      <label class="switch">
                        <input type="checkbox" class="switch1" data-id="{{$product->id}}" @if($product->is_best_seller) checked @endif>  
                        <span class="slider round"></span>
                      </label>
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
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Delete Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure,you want to delete this product ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-danger">Delete</button>
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
    $('.switch').on('change',function()
    {
      var id=$(this).attr('data-id')
      $.ajax({
        type: 'PATCH',
        url: '/admin/products/change_trending_option/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
            id: id
        },
        success: function(data){
          if(data == '200')
          {
            location.reload();
          }
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
      });
    });

    $('.switch1').on('change',function()
    {
      var id=$(this).attr('data-id')
      $.ajax({
        type: 'PATCH',
        url: '/admin/products/change_seller_option/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
            id: id
        },
        success: function(data){
          if(data == '200')
          {
            location.reload();
          }
        },
        error: function(xhr){
            console.log(xhr.responseText);
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
