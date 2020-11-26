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
                                <h4 class="card-title">Item</h4>
                                <h6 class="card-subtitle">items lists</h6>
                                <a href="javascript:void(0)" id="create-new-item" class="btn btn-outline-success btn-rounded float-right" data-toggle="modal" data-target="#create-item" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Create Item</a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Item Code</th>
                                                <th>Image</th>
                                                <th>S-Category</th>
                                                <th>Base P</th>
                                                <th>Sale P</th>
                                                <th>Stock Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ajax-item-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="itemCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="itemForm" name="itemForm" class="form-horizontal row" enctype="multipart/form-data">
                                <input type="hidden" value="" name="item_id" id="item_id">
                                    <div class="form-group col-md-12 ">
                                        <label for="item_name" class="col-sm-4 control-label">Item Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="item_name" name="item_name" value="" maxlength="150">
                                            <span class="text-danger error-tags item_name-error">                           
                                            </span>
                                        </div>
                                    
                                    </div> 
                                    <div class="form-group col-md-6 ">
                                        <label class="col-sm-4 control-label">Item Category</label>
                                        <div class="col-sm-12">
                                        <select id="category_id" name="category_id" class="form-control select2" style="width: 100%">
                                                    @foreach($category as $cat)
                                                    <option value="{{$cat->id}}">{{ $cat->category_name }}</option>
                                                    @endforeach
                                        </select>
                                        <span class="text-danger error-tags category_id-error"></span>
                                        </div>
                                    </div>    
                                    <div class="form-group col-md-6 ">
                                        <label class="col-sm-4 control-label">Item Sub-Category</label>
                                        <div class="col-sm-12">
                                        <select id="sub_category_id" name="sub_category_id" class="form-control select2" style="width: 100%">
                                                    @foreach($sub_category as $sub_cat)
                                                    <option value="{{$sub_cat->id}}" value1="{{ $sub_cat->category_id }}">{{ $sub_cat->sub_category_name }}</option>
                                                    @endforeach
                                        </select>
                                        <span class="text-danger error-tags sub_category_id-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="actual_price" class="col-sm-4 control-label">Base Price</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="actual_price" name="actual_price" value="" maxlength="50">
                                            <span class="text-danger error-tags actual_price-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="sale_price" class="col-sm-4 control-label">Sale Price</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="sale_price" name="sale_price" value="" maxlength="50">
                                            <span class="text-danger error-tags sale_price-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="item_image" class="col-sm-4 control-label">Image</label>
                                        <div class="col-sm-12">
                                        <input type="file" name="item_image" id="item_image" class="form-control" value="">
                                        <input type="hidden" name="hidden_img" value="" id="hiddenImage">
                                        <span class="text-danger error-tags item_image-error"></span>
                                        </div> 
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="stock_amount" class="col-sm-4 control-label">Stock Amount</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="stock_amount" name="stock_amount" value="" maxlength="50">
                                            <span class="text-danger error-tags stock_amount-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <div class="form-check">
                                            <input type="checkbox" id="instock" name="instock" value="0"/>
                                            <label for="instock">Out Of Stock</label>
                                        </div>                             
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10 ml-3">
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
          url: SITEURL + "/item",
          type: 'GET',
         },
         columns: [
                  {data: 'item_name' , name: 'item_name'},
                  {data: 'item_id' , name: 'item_id'},
                  {data: 'item_image' , name: 'item_image'},
                  {data: 'sub_category.sub_category_name' , name: 'sub_category.sub_category_name'},
                  {data: 'actual_price' , name: 'actual_price'},
                  {data: 'sale_price' , name: 'sale_price'},
                  {data: 'stock_amount' , name: 'stock_amount'},
                  {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
        "columnDefs": 
        [
             {
                "mData": "IMAGE", 
                "aTargets": [2],
                "render": function (data) {
                            return '<img src="../images/' +data+ '"  style="width:40px" class="mr-1"/>';
                }
            }
        ]
       
    });
 
 /*  When category click add category button */
    $('#create-new-item').click(function () {
        error_reset.html('');
        $("#item_image").addClass('dropify');
        $('.dropify').dropify();
        $(".dropify-clear").trigger("click");
        $('#btn-save').text("Create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#category_id').val('').change(); 
        $("#sub_category_id").val('').change();
        $('#itemCrudModal').text("Create Item");
        $('#ajax-item-modal').modal('show');
    });
  
   /* When click edit category */
    $('body').on('click', '#edit-item', function () {
      var _id = $(this).data('id');
      $.get('/item/' + _id , function (data) {
            error_reset.html('');
            $('#itemCrudModal').text("Edit Item");
            $('#btn-save').text("Edit");

            var drEvent = $('#item_image').dropify(
            {
                efaultFile: "../images/"+data.item_image
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = "../images/"+data.item_image;
            drEvent.destroy();
            drEvent.init();

            $('#item_id').val(data.item_id);
            $('#item_name').val(data.item_name);
            $('#category_id').val(data.category_id).change();
            $('#sub_category_id').val(data.subcategory_id).change();
            $('#actual_price').val(data.actual_price);
            $('#sale_price').val(data.sale_price);
            $('#stock_amount').val(data.stock_amount);
            $('#release').val(data.released_date);
            $("#item_image").addClass('dropify');
            $('.dropify').dropify();
            $('#instock').prop("checked", false);
            if(data.instock == 0){
                $('#instock').prop("checked", true);
            };

            $('#ajax-item-modal').modal('show');
      })
   });


 
   $('body').on('click', '#delete-item', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_item",
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
  
if ($("#itemForm").length > 0) {
      $("#itemForm").validate({
  
     submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      var formData = new FormData($('#itemForm')[0]);
       
      $.ajax({
          data: formData,
          url: SITEURL + "/create_item",
          method: "POST",
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
              $('#bookForm').trigger("reset");
              $(".dropify-clear").trigger("click");
              $('#ajax-item-modal').modal('hide');     
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');
              var e = data.responseJSON.errors;
              $('.item_name-error').html(e.item_name);
              $('.category_id-error').html(e.category_id);
              $('.sub_category_id-error').html(e.sub_category_id);
              $('.actual_price-error').html(e.actual_price);
              $('.sale_price-error').html(e.sale_price);
              $('.stock_amount-error').html(e.stock_amount);
              console.log(data.responseJSON.errors);
              $('#btn-save').html('Save Changes');
          }
          
      });
    }
  });
}

// add atwt select option //
$("#category_id").change(function() {
    if ($(this).data('options') == undefined) {
        $(this).data('options', $('#sub_category_id option').clone());
    }
    let filter,fil_option;

    var id = $(this).val();

    if( $(this).val() == ''){
        filter = $("#category_id :selected").val();
        $('#sub_category_id').prop('disabled', 'disabled');
    }else{
        filter = $("#category_id :selected").text()
        $('#sub_category_id').prop('disabled', false);
        fil_option = '[value1=' + id + ']';
    }

    var options = $(this).data('options').filter(fil_option);
    $('#sub_category_id').html(options);
});
</script>
@endsection