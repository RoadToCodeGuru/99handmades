
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
                                <h4 class="card-title">Order</h4>
                                <h6 class="card-subtitle">order lists</h6>
                                <a href="javascript:void(0)" id="create-new-order" class="btn btn-outline-success btn-rounded float-right" data-toggle="modal" data-target="#create-order" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Create Order</a>
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
                
                <div class="modal fade" id="ajax-order-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="orderCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action='/order_box' id="orderForm" name="orderForm" class="form-horizontal">
                                    <input type="hidden" name="ordering_customer" id="ordering_customer">
                                    <input type="hidden" name="order_id" id="order_id">
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="ajax-od_box-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="od_boxCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/create_order" method="POST" id="od_boxForm" name="od_boxForm" class="form-horizontal">
                                @csrf
                                    <input type="hidden" name="od_box_id" id="od_box_id">

                                    <div class="form-group">
                                        <label for="item_id" class="col-sm-4 control-label">Customer</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="customer_id" id="customer_id" style="width: 100%">
                                                @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{ $customer->customer_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-tags customer_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                   
                                    <a href="javascript:void(0)" id="btn-od_box" class="btn btn-primary" >Create Order</a>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
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
          url: SITEURL + "/order",
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
 
 /*  When order click add order button */
    $('#btn-od_box').click(function () {
        let c_id = $('#customer_id').val()

        error_reset.html('');
        $('#ordering_customer').val(c_id);
        $('#order_id').val('');
        $('#ajax-od_box-modal').modal('hide');
        $('#orderForm').submit();
    });

    $('#create-new-order').click(function () {
        error_reset.html('');
        $('#btn-od_box').text("Create Order");
        $('#od_boxForm').trigger("reset");
        $('#od_box_id').val('');
        $('#customer_id').val('').change();
        $('#total_discount').val('0');  
        $('#od_boxCrudModal').text("New Order");
        $('#ajax-od_box-modal').modal('show');
    });
  
   /* When click edit customer */
    $('body').on('click', '#edit-order', function () {
      var _id = $(this).data('id');
      var _cid = $(this).data('id2');
      $('#ordering_customer').val(_cid);
      $('#order_id').val(_id);
      $('#orderForm').submit();
   });
});
  
if ($("#customerForm").length > 0) {
      $("#customerForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#customerForm').serialize(),
          url: SITEURL + "/create_customers",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#customerForm').trigger("reset");
              $('#ajax-customer-modal').modal('hide');        
              $('#btn-customer').html('Save');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.customer_name-error').html(e.customer_name);
              $('.phone_number-error').html(e.phone_number);
              $('.address-error').html(e.address);
              
              $('#btn-save').html('Save Changes');
          }
          
      });
    }
  });
}

</script>
@endsection