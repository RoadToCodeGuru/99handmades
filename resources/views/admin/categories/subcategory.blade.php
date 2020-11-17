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
                                <h4 class="card-title">Sub-Category</h4>
                                <h6 class="card-subtitle">sub-category lists</h6>
                                <a href="javascript:void(0)" id="create-new-subcategory" class="btn btn-outline-success btn-rounded float-right" data-toggle="modal" data-target="#create-subcategory" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Create Sub-Category</a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sub-Categroy</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ajax-subcategory-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="subcategoryCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="subcategoryForm" name="subcategoryForm" class="form-horizontal">

                                    <input type="hidden" name="subcategory_id" id="subcategory_id">

                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-4 control-label">Categories</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="category_id" id="category_id" style="width: 100%">
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-tags category-error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="subcategory_name" class="col-sm-4 control-label">Enter Sub-Category Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"  value="" maxlength="50">
                                            <span class="text-danger error-tags name-error"></span>
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
          url: SITEURL + "/subcategory",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'sub_category_name' , name: 'sub_category_name'},
                  {data: 'category.category_name' , name: 'category.category_name'},
                  {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
       
    });
 
    $('#create-new-subcategory').click(function () {
        error_reset.html('');
        $('#btn-save').text("Create");
        $('#subcategory_id').val('');
        $('#subcategoryForm').trigger("reset");
        $('#subcategoryCrudModal').text("Create Item Sub-Category");
        $('#ajax-subcategory-modal').modal('show');
    });
  
  
    $('body').on('click', '#edit-subcategory', function () {
      var _id = $(this).data('id');
      $.get('/subcategory/' + _id , function (data) {
         error_reset.html('');
         $('#subcategoryCrudModal').text("Edit Sub-Category");
          $('#btn-save').text("Edit");
          $('#subcategory_id').val(data.id);
          $('#subcategory_name').val(data.sub_category_name);
          $('#category_id').val(data.category_id).change();
          $('#ajax-subcategory-modal').modal('show');
      })
   });


 
   $('body').on('click', '#delete-subcategory', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_subcategory",
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
  
if ($("#subcategoryForm").length > 0) {
      $("#subcategoryForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#subcategoryForm').serialize(),
          url: SITEURL + "/create_subcategory",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#subcategoryForm').trigger("reset");
              $('#ajax-subcategory-modal').modal('hide');        
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.name-error').html(e.subcategory_name);
              $('.category-error').html(e.category_id);
              $('#btn-save').html('Save Changes');
          }
          
      });
    }
  });
}

</script>
@endsection