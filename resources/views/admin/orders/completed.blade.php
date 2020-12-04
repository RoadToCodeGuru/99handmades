
@extends('admin.layouts.app')

@section('head-content')
@endsection

@section('header-content')
@endsection

@section('menu-content')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Category</h3>
                    </div>
                </div> -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sale</h4>
                                <h6 class="card-subtitle">completed sale lists</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Note</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection

@section('footer-content')
<script>
var SITEURL = '{{URL::to('')}}';
var error_reset = $('.error-tags');

$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#laravel_datatable').DataTable({
         responsive: true,
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL + "/completed_sales",
          type: 'GET',
         },
         columns: [
                  {data: 'order_id', name: 'order_id'},
                  {data: 'customer.customer_name' , name: 'customer.customer_name'},
                  {data: 'customer.phone_number' , name: 'customer.phone_number'},
                  {data: 'note' , name: 'note'},
                  { data: 'status',
                    render: function (data) {
                        if(data == 0)
                        {
                            return '<div class="label label-danger">Drafted</div>'
                        }
                        else if(data == 1)
                        {
                            return '<div class="label label-info">Confirmed</div>'
                        }
                        else if(data == 2)
                        {
                            return '<div class="label label-success">Completed</div>'
                        }
                    } },
                  {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
    });
});
</script>
@endsection