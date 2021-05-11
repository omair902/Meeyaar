@extends('admin.layout.master')
@section('title','Meeyaar | Shipping | Resolved Orders')
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
        <h3><b> Resolved Orders </b></h3>
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
                    <th>Complain</th>
                    <th>Order Status</th>
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
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($complains as $complain)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$complain->order->user->first_name}}</td>
                        <td>{{$complain->order->user->email}}</td>
                        <td>{{$complain->order->user->phone}}</td>
                        <td>{{$complain->order->user->country}}</td>
                        <td>{{$complain->order->user->state}}</td>
                        <td>{{$complain->order->user->address}}</td>
                        <td>{{$complain->order->user->zipcode}}</td>
                        <td>{{$complain->description}}</td>
                        <td>{{ucfirst($complain->order->status)}}</td>

                        <td>
                            <a href="{{route('admin.manage_orders.new.view_product',$complain->order->product)}}" class="btn btn-info">View</a>
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
<!-- End custom js for this page -->
@endsection
