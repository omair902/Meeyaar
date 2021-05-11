@extends('admin.layout.master')
@section('title','Meeyaar | Shipping | Completed Orders')
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
        <h3><b>Completed Orders </b></h3>
        <div class="table-responsive">
            <table class="table order-listing">
                <thead>
                  <tr>
                    <th> # </th>
                    <th colspan="2" class="text-center"> Order By </th>
                    <th> Phone </th>
                    <th> Country </th>
                    <th> State </th>
                    <th>Address</th>
                    <th>Zipcode</th>
                    <th>View Product</th>
                  </tr>
                  <tr>
                    <th></th>
                    <th> Name </th>
                    <th> Email </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->user->first_name}}</td>
                        <td>{{$order->user->email}}</td>
                        <td>{{$order->user->phone}}</td>
                        <td>{{$order->user->country}}</td>
                        <td>{{$order->user->state}}</td>
                        <td>{{$order->user->address}}</td>
                        <td>{{$order->user->zipcode}}</td>
                        <td>
                            <a href="{{route('admin.manage_orders.new.view_product',$order->order_product[0]->product_id)}}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
              </table>
        </div>
      </div>
    </div>
</div>
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
@endsection
