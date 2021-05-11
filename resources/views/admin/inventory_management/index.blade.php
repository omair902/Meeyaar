@extends('admin.layout.master')
@section('title','Meeyaar | Inventory Management')
@push('plugin-styles')
 
@endpush
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
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if(session('added'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('added')}}
          </div>
        @endif
        @if(session('reduced'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('reduced')}}
          </div>
        @endif
        @if(session('empty'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('empty')}}
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
                <th>Stock Available</th>
                <th>Stock Sold</th>
                <th>Stock Cancelled</th>
                <th>Actions</th>
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
                    <td >{{$product->stock->current}}</td>
                    <td >{{$product->stock->sold}}</td>
                    <td >{{$product->stock->cancelled}}</td>
                    <td>
                      <a href="" role="button" class="btn btn-success add" data-url="{{route('admin.inventory_management.add_stock',$product->id)}}" data-toggle="modal" data-target="#AddModal">Add Stock</a>
                      <a href="#" role="button" class="btn btn-warning reduce" data-max="{{$product->stock->current}}" @if($product->stock->current > 0) data-url="{{route('admin.inventory_management.reduce_stock',$product->id)}}" data-toggle="modal" data-target="#ReduceModal" @else title="Stock is empty" @endif>Reduce Stock</a>
                      <a href="" data-url="{{route('admin.inventory_management.out_of_stock',$product->id)}}" data-id="{{$product->id}}" data-toggle="modal" data-target="#Modal" role="button" class="btn btn-danger remove">Out Of Stock</a>
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
<form method="POST" class="addForm">
  @csrf
      <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Stock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="NoOfStock" class="col-sm-3">No of stock</label>
                    <div class="col-sm-9">
                      <input type="number" name="no_of_stock" class="form-control" min="1" placeholder="No of stock you want to add" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
          </div>
        </div>
      </div>
</form>
<!-- Modal -->
<form method="POST" class="reduceForm">
  @csrf
      <div class="modal fade" id="ReduceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Reduce Stock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="NoOfStock" class="col-sm-3">No of stock</label>
                    <div class="col-sm-9">
                      <input type="number" name="no_of_stock" min="1" class="form-control reduce_stock" placeholder="No of stock you want to reduce" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-warning">Reduce</button>
            </div>
          </div>
        </div>
      </div>
</form>
<!-- Modal -->
<form method="POST" class="form">
  @csrf
      <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Out Of Stock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure,you want to empty stock of this product ?
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
<!-- Plugin js for this page -->
<script src="{{asset('admin/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/assets/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js')}}"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="{{asset('admin/assets/js/shared/data-table.js')}}"></script>
<!-- End custom js for this page -->
<script>
    $(document).ready(function()
    {
        $('.add').on('click',function()
        {
            var url=$(this).attr('data-url');
            $('.addForm').attr('action',url);
        });
        $('.reduce').on('click',function()
        {
            var url=$(this).attr('data-url');
            var max=$(this).attr('data-max');
            $('.reduceForm').attr('action',url);
            $('.reduce_stock').attr('max',max);
        });
    });
</script>
@endsection
