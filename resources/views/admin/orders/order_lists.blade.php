
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
                                    <input type="hidden" name="order_id" id="order_id">
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
    $('#create-new-order').click(function () {
        error_reset.html('');
        $('#order_id').val('');
        $('#orderForm').submit();
    });
  
   /* When click edit customer */
    $('body').on('click', '#edit-order', function () {
      var _id = $(this).data('id');
      $('#order_id').val(_id);
      $('#orderForm').submit();
   });


 
   $('body').on('click', '#delete-customer', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_customers",
                data: { id: id},
                dataType: 'json',
                success: function(res){
                var oTable = $('#laravel_datatable').dataTable();
                oTable.fnDraw(false);
                }
            });
        }
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