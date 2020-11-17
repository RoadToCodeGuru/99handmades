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
                                <h4 class="card-title">Category</h4>
                                <h6 class="card-subtitle">category lists</h6>
                                <a href="javascript:void(0)" id="create-new-category" class="btn btn-outline-success btn-rounded float-right" data-toggle="modal" data-target="#create-category" data-whatever="@mdo"><i class="ti-plus pr-1"></i>Create Category</a>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Categroy</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ajax-category-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="categoryCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="categoryForm" name="categoryForm" class="form-horizontal">

                                    <input type="hidden" name="category_id" id="category_id">

                                    <div class="form-group">
                                        <label for="category_name" class="col-sm-4 control-label">Enter Category Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="category_name" name="category_name"  value="" maxlength="50">
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
          url: SITEURL + "/category",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'category_name' , name: 'category_name'},
                  {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
       
    });
 
 /*  When category click add category button */
    $('#create-new-category').click(function () {
        error_reset.html('');
        $('#btn-save').text("Create");
        $('#category_id').val('');
        $('#categoryForm').trigger("reset");
        $('#categoryCrudModal').text("Create Item Category");
        $('#ajax-category-modal').modal('show');
    });
  
   /* When click edit category */
    $('body').on('click', '#edit-category', function () {
      var _id = $(this).data('id');
      $.get('/category/' + _id , function (data) {
         error_reset.html('');
         $('#categoryCrudModal').text("Edit Category");
          $('#btn-save').text("Edit");
          $('#ajax-category-modal').modal('show');
          $('#category_id').val(data.id);
          $('#category_name').val(data.category_name);
      })
   });


 
   $('body').on('click', '#delete-category', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_category",
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
  
if ($("#categoryForm").length > 0) {
      $("#categoryForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#categoryForm').serialize(),
          url: SITEURL + "/create_category",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#categoryForm').trigger("reset");
              $('#ajax-category-modal').modal('hide');        
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.name-error').html(e.category_name);
              
              $('#btn-save').html('Save Changes');
          }
          
      });
    }
  });
}

</script>
@endsection