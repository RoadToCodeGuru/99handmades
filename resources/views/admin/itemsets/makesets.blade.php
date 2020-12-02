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
                                <h4 class="card-title">Make Item Set</h4>
                                <h6 class="card-subtitle">item-set items list</h6>
                                <a href="javascript:void(0)" id="create-new-makeset" class="btn mb-3 btn-outline-success btn-rounded float-right" data-toggle="modal" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Add Set Item</a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Sale-P</th>
                                                <th>Amount</th>
                                                <th>Total-P</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <a href="javascript:void(0)" id="approve_set" class="btn btn-sm mb-2 btn-warning btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Create</a>
                                            <a href="javascript:void(0)" id="import_set" class="btn btn-sm mb-2 btn-success btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Import</a>
                                            <a href="javascript:void(0)" id="update_set" class="btn btn-sm mb-2 btn-info btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Edit</a>
                                            <a href="javascript:void(0)" id="empty_set" class="btn btn-sm mb-2 btn-danger btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Empty</a>
                                            <a href="/itemset" class="btn btn-sm mb-2 btn-secondary btn-rounded">Item Sets List</a>
                                            <h5 class="mt-4" id="sub_total"></h5>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ajax-makeset-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="makesetCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="makesetForm" name="makesetForm" class="form-horizontal">

                                    <input type="hidden" name="makeset_id" id="makeset_id">

                                    <div class="form-group">
                                        <label for="item_id" class="col-sm-4 control-label">Items</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="item_id" id="item_id" style="width: 100%">
                                                @foreach($items as $item)
                                                <option value="{{$item->item_id}}">{{$item->item_id}} / {{ $item->item_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-tags item_id-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Amount</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="amount" name="amount"  value="" maxlength="50">
                                            <span class="text-danger error-tags amount-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                                    </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="ajax-approveset-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="approvesetCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="approvesetForm" name="approvesetForm" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Item Set Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="item_set_name" name="item_set_name"  value="" maxlength="50">
                                            <span class="text-danger error-tags item_set_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-approveset" value="create">Save changes
                                    </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ajax-itemset-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="itemsetCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="itemsetForm" name="itemsetForm" class="form-horizontal">
                                    <input type="hidden" name="ie_set" id="ie_set">

                                    <div class="form-group">
                                        <label for="item_set_ie_name" class="col-sm-4 control-label">Item Set Name</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="item_set_ie_name" id="item_set_ie_name" style="width: 100%">
                                                @foreach($item_sets as $set)
                                                <option value="{{$set->id}}">{{ $set->item_set_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-tags item_set_ie_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-itemset" value="create">Save changes
                                    </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ajax-invoice-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="invoiceCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/invoice" id="invoiceForm" name="invoiceForm" class="form-horizontal">

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

                                    <div class="form-group">
                                        <label for="date" class="col-sm-4 control-label">Delivery</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="delivery" name="delivery"  value="0" maxlength="50">
                                            <span class="text-danger error-tags date-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date" class="col-sm-4 control-label">Date</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="date" name="date"  value="" maxlength="50">
                                            <span class="text-danger error-tags date-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-invoice" value="create">Save changes
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
<script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>
<script>
function sum_subtotal(){
    var sum = $('#laravel_datatable').DataTable().column(5).data().sum();
    $('#sub_total').text("Sub Total : "+sum);
}

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
          url: SITEURL + "/makeset",
          type: 'GET',
         },
         drawCallback: function(){
            sum_subtotal();
         },
         columns: [
                  {data: 'item.item_id' , name: 'item.item_id'},
                  {data: 'item.item_name' , name: 'item.item_name'},
                  {data: 'item.item_image' , name: 'item.item_image'},
                  {data: 'item.sale_price' , name: 'item.sale_price'},
                  {data: 'amount' , name: 'amount'},
                  {data: 'total_price' , name: 'total_price'},
                  {data: 'action', name: 'action', orderable: false},
         ],
         "columnDefs": 
        [
             {
                "mData": "IMAGE", 
                "aTargets": [2],
                "render": function (data) {
                            return '<img src="../images/' +data+ '"  style="width:40px" class="mr-1"/>';
                }
            }
        ],
        order: [[0, 'desc']],
       
    });
 
    $('#create-new-makeset').click(function () {
        error_reset.html('');
        $('#btn-save').text("Create");
        $('#makeset_id').val('');
        $('#makesetForm').trigger("reset");
        $('#item_id').val('').change(); 
        $('#makesetCrudModal').text("Add Set Item");
        $('#ajax-makeset-modal').modal('show');
    });
  
  
    $('body').on('click', '#edit-makeset', function () {
      var _id = $(this).data('id');
      $.get('/makeset/' + _id , function (data) {
         error_reset.html('');
         $('#makesetCrudModal').text("Edit Set Item");
          $('#btn-save').text("Edit");
          $('#makeset_id').val(data.id);
          $('#amount').val(data.amount);
          $('#item_id').val(data.item_id).change();
          $('#ajax-makeset-modal').modal('show');
      })
   });


 
   $('body').on('click', '#delete-makeset', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_makeset",
                data: { id: id},
                dataType: 'json',
                drawCallback: function(){
                    sum_subtotal();
                },
                success: function(res){
                var oTable = $('#laravel_datatable').dataTable();
                oTable.fnDraw(false);
                }
            });
        }
    });


    $('#approve_set').click(function () {
        error_reset.html('');
        $('#btn-approveset').text("Create");
        $('#makesetForm').trigger("reset");
        $('#approvesetCrudModal').text("Add Set Item");
        $('#ajax-approveset-modal').modal('show');
    });

    $('#import_set').click(function () {
        error_reset.html('');
        $('#btn-itemset').text("Import");
        $('#itemsetForm').trigger("reset");
        $('#ie_set').val('i');
        $('#item_set_ie_name').val('').change(); 
        $('#itemsetCrudModal').text("Choose Set To Import");
        $('#ajax-itemset-modal').modal('show');
    });

    $('#update_set').click(function () {
        error_reset.html('');
        $('#btn-itemset').text("Update");
        $('#itemsetForm').trigger("reset");
        $('#ie_set').val('e');
        $('#item_set_ie_name').val('').change(); 
        $('#itemsetCrudModal').text("Choose Set To Update");
        $('#ajax-itemset-modal').modal('show');
    });

    $('#invoice').click(function () {
        error_reset.html('');
        $('#btn-invoice').text("Print");
        $('#invoiceForm').trigger("reset");
        $('#invoiceCrudModal').text("Choose Set To Update");
        $('#ajax-invoice-modal').modal('show');
    });

    $('body').on('click', '#empty_set', function () {
        if (confirm("Empty Set Table?") == true) {
            $.ajax({
                type:"POST",
                url: SITEURL + "/empty_itemset",
                dataType: 'json',
                drawCallback: function(){
                    $('#sub_total').text("Sub Total : 0");
                },
                success: function(res){
                var oTable = $('#laravel_datatable').dataTable();
                oTable.fnDraw(false);
                }
            });
        }
    });
});
  
if ($("#makesetForm").length > 0) {
      $("#makesetForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#makesetForm').serialize(),
          url: SITEURL + "/create_makeset",
          type: "POST",
          dataType: 'json',
          drawCallback: function(){
            sum_subtotal();
          },
          success: function (data) {
              $('#makesetForm').trigger("reset");
              $('#ajax-makeset-modal').modal('hide');        
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.item_id-error').html(e.item_id);
              $('.amount-error').html(e.amount);
              $('#btn-approveset').html('Save Changes');
          }
          
      });
    }
  });
}

if ($("#approvesetForm").length > 0) {
      $("#approvesetForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-approveset').val();
      $('#btn-approveset').html('Sending..');
       
      $.ajax({
          data: $('#approvesetForm').serialize(),
          url: SITEURL + "/create_itemset",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#approvesetForm').trigger("reset");
              $('#ajax-approveset-modal').modal('hide');        
              $('#btn-approveset').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.item_set_name-error').html(e.item_set_name);
              $('#btn-approveset').html('Save Changes');
          }
          
      });
    }
  });
}

if ($("#itemsetForm").length > 0) {
      $("#itemsetForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-itemset').val();
      $('#btn-itemset').html('Sending..');
       
      $.ajax({
          data: $('#itemsetForm').serialize(),
          url: SITEURL + "/import_itemset",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#itemsetForm').trigger("reset");
              $('#ajax-itemset-modal').modal('hide');        
              $('#btn-itemset').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.item_set_ie_name-error').html(e.item_set_ie_name);
              $('#btn-itemset').html('Save Changes');
          }
          
      });
    }
  });
}

</script>
@endsection