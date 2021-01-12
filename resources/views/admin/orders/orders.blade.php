
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
                                @if($type == 'create')
                                <h4 class="card-title">Creating the order of " {{$cus_info->customer_name}} "</h4>
                                <input type="hidden" value="0" name="action" id="action">
                                @elseif($type == 'edit')
                                <h4 class="card-title">Editing  " {{$cus_info->customer_name}} "s order</h4>
                                <input type="hidden" value="1" name="action" id="action">
                                @endif
                                <h6 class="card-subtitle">order items</h6>
                                <a href="javascript:void(0)" id="create-new-box" class="btn btn-outline-success btn-rounded" data-toggle="modal" data-target="#create-box" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Add Item</a>
                                <a href="/order" class="btn btn-sm  mb-2 btn-secondary btn-rounded float-right">Back To Order List >></a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Sale-P</th>
                                                <th>Quantity</th>
                                                <th>Discount</th>
                                                <th>Final-P</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            @if($type == 'create')
                                            <a href="javascript:void(0)" id="make_order" class="btn mb-2 btn-primary btn-rounded  float-right" data-toggle="modal" data-whatever="@mdo">Order Now</a>
                                            <!-- <a href="javascript:void(0)" id="import_set" class="btn btn-sm mt-4 mb-2 btn-success btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Clone Item Set</a> -->
                                            @elseif($type == 'edit')
                                            <a href="javascript:void(0)" id="update_order" class="btn mb-2 btn-info btn-rounded mr-2  float-right" data-id="{{ $o_id }}" data-toggle="modal" data-whatever="@mdo">Update Order</a>
                                            @endif
                                            <!-- <a href="javascript:void(0)" id="empty_set" class="btn btn-sm mt-4 mb-2 btn-danger btn-rounded mr-2" data-toggle="modal" data-whatever="@mdo">Empty</a> -->
                                            <h5 class="mt-4" id="sub_total"></h5>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="ajax-box-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="boxCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="boxForm" name="boxForm" class="form-horizontal">

                                    <input type="hidden" name="box_id" id="box_id">
                                    <input type="hidden" value="{{$cus_info->id}}" name="customer_o_id" id="customer_o_id">

                                    <div class="form-group">
                                        <label for="item_id" class="col-sm-4 control-label">Items</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="item_id" id="item_id" style="width: 100%">
                                                @foreach($items as $item)
                                                <option value="{{$item->item_id}}">{{$item->item_id}} / {{ $item->item_name }} / {{ $item->stock_amount }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-tags item_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Amount</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="amount" name="amount"  value="" maxlength="50">
                                            <span class="text-danger error-tags amount-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Discount</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="discount" name="discount"  value="" maxlength="50">
                                            <span class="text-danger error-tags discount-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-box" value="create">Save changes
                                    </button>
                                    </div>
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

                                    <input type="hidden" value="{{$cus_info->id}}" name="customer_id" id="customer_id">

                                    <div class="form-group">
                                        <label for="note" class="col-sm-4 control-label">Note</label>
                                        <div class="col-sm-12">
                                            <textarea name="note" id="note" class="form-control" cols="30" rows="3"></textarea>
                                            <span class="text-danger error-tags note-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Delivery Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="delivery_price" name="delivery_price"  value="" maxlength="50">
                                            <span class="text-danger error-tags deli_price-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Total Discount</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="total_discount" name="total_discount"  value="" maxlength="50">
                                            <span class="text-danger error-tags total_discount-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="item_id" class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="status" id="status" style="width: 100%">
                                                <option value="0">Draft</option>
                                                <option value="1">Confirm</option>
                                            </select>
                                            <span class="text-danger error-tags status-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-od_box" value="create">Save changes
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

                                    <div class="form-group">
                                        <label for="item_set_name" class="col-sm-4 control-label">Choose Item Set</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="item_set_name" id="item_set_name" style="width: 100%">
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
    var sum = $('#laravel_datatable').DataTable().column(6).data().sum();
    $('#sub_total').text("Sub Total : "+sum);
}

var SITEURL = '{{URL::to('')}}';
var error_reset = $('.error-tags');
let cus_id = $('#customer_id').val();

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
        data: {customer_id : cus_id},    
        url: SITEURL + "/order_box",
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
                {data: 'item_count' , name: 'item_count'},
                {data: 'discount' , name: 'discount'},
                {data: 'final_price' , name: 'final_price'},
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
 
 /*  When order click add order button */
    $('#create-new-box').click(function () {
        error_reset.html('');
        $('#btn-box').text("Add");
        $('#boxForm').trigger("reset");
        $('#box_id').val('');
        $('#item_id').val('').change();
        $('#discount').val('0');  
        $('#boxCrudModal').text("Add Item");
        $('#ajax-box-modal').modal('show');
    });

    $('#make_order').click(function () {
        error_reset.html('');
        $('#btn-od_box').text("Order");
        $('#od_boxForm').trigger("reset");
        $('#od_box_id').val('');
        $('#total_discount').val('0');  
        $('#od_boxCrudModal').text("New Order");
        $('#ajax-od_box-modal').modal('show');
    });

    $('#import_set').click(function () {
        error_reset.html('');
        $('#btn-itemset').text("Clone");
        $('#itemsetForm').trigger("reset");
        $('#item_set_name').val('').change(); 
        $('#itemsetCrudModal').text("Choose Set To Clone");
        $('#ajax-itemset-modal').modal('show');
    });
  
   /* When click edit customer */
    $('body').on('click', '#edit-box', function () {
      var _id = $(this).data('id');
      $.get('/order_box/' + _id , function (data) {
         error_reset.html('');
         $('#boxCrudModal').text("Edit Item");
          $('#btn-box').text("Update");
          $('#box_id').val(data.id);
          $('#item_id').val(data.item_id).change();
          $('#amount').val(data.item_count);
          $('#discount').val(data.discount);
          $('#ajax-box-modal').modal('show');
      })
   });

   $('body').on('click', '#update_order', function () {
      var _id = $(this).data('id');
      $.get('/order/' + _id , function (data) {
         error_reset.html('');
         $('#od_boxCrudModal').text("Edit Item");
          $('#btn-od_box').text("Update");
          $('#od_box_id').val(data.order_id);
          $('#customer_id').val(data.customer_id).change();
          $('#note').val(data.note);
          $('#delivery_price').val(data.deli_price);
          $('#total_discount').val(data.total_discount);
          $('#status').val(data.status).change();
          $('#ajax-od_box-modal').modal('show');
      })
   });


 
   $('body').on('click', '#delete-box', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_order_box",
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

    $('body').on('click', '#empty_set', function () {
        if (confirm("Empty Set Table?") == true) {
            $.ajax({
                type:"POST",
                url: SITEURL + "/empty_order_box",
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
  
if ($("#boxForm").length > 0) {
      $("#boxForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-box').val();
      $('#btn-box').html('Sending..');
       
      $.ajax({
          data: $('#boxForm').serialize(),
          url: SITEURL + "/create_order_box",
          type: "POST",
          dataType: 'json',
          drawCallback: function(){
            sum_subtotal();
          },
          success: function (data) {
              $('#boxForm').trigger("reset");
              $('#ajax-box-modal').modal('hide');        
              $('#btn-box').html('Save');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.item_name-error').html(e.item_id);
              $('.amount-error').html(e.amount);
              $('.discount-error').html(e.discount);
              
              $('#btn-save').html('Save Changes');
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
          url: SITEURL + "/import_order_box",
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
              $('.item_set_name-error').html(e.item_set_name);
              $('#btn-itemset').html('Save Changes');
          }
          
      });
    }
  });
}
</script>
@endsection