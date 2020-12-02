
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
                                <h4 class="card-title">Customer</h4>
                                <h6 class="card-subtitle">customer lists</h6>
                                <a href="javascript:void(0)" id="create-new-customer" class="btn btn-outline-success btn-rounded float-right" data-toggle="modal" data-target="#create-customer" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Create Customer</a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ajax-customer-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="customerCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="customerForm" name="customerForm" class="form-horizontal">

                                    <input type="hidden" name="customer_id" id="customer_id">

                                    <div class="form-group">
                                        <label for="customer_name" class="col-sm-4 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="customer_name" name="customer_name"  value="" maxlength="50">
                                            <span class="text-danger error-tags customer_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_number" class="col-sm-4 control-label">Phone Number</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"  value="" maxlength="50">
                                            <span class="text-danger error-tags phone_number-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-sm-4 control-label">Address</label>
                                        <div class="col-sm-12">
                                            <textarea name="address" id="address" class="form-control" cols="30" rows="3"></textarea>
                                            <span class="text-danger error-tags address-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-customer" value="create">Save
                                    </button>
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
          url: SITEURL + "/customers",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'customer_name' , name: 'customer_name'},
                  {data: 'phone_number' , name: 'phone_number'},
                  {data: 'customer_address' , name: 'customer_address'},
                  {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
       
    });
 
 /*  When customer click add customer button */
    $('#create-new-customer').click(function () {
        error_reset.html('');
        $('#btn-save').text("Create");
        $('#customer_id').val('');
        $('#customerForm').trigger("reset");
        $('#customerCrudModal').text("Create Item Customer");
        $('#btn-customer').html('Create');
        $('#address').html('');
        $('#ajax-customer-modal').modal('show');
    });
  
   /* When click edit customer */
    $('body').on('click', '#edit-customer', function () {
      var _id = $(this).data('id');
      $.get('/customers/' + _id , function (data) {
         error_reset.html('');
         $('#customerCrudModal').text("Edit Customer");
          $('#btn-customer').text("Update");
          $('#ajax-customer-modal').modal('show');
          $('#customer_id').val(data.id);
          $('#customer_name').val(data.customer_name);
          $('#phone_number').val(data.phone_number);
          $('#address').html(data.customer_address);
      })
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