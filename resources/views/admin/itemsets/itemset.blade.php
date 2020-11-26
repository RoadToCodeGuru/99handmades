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
                                <h4 class="card-title">Item Sets List</h4>
                                <h6 class="card-subtitle">item sets list</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="laravel_datatable" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Set Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <a href="/makeset" class="btn btn-sm mb-2 btn-secondary btn-rounded">Prepare Set</a>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="ajax-editset-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="editsetCrudModal"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editsetForm" name="editsetForm" class="form-horizontal">

                                    <input type="hidden" name="item_set_id" id="item_set_id">

                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Item Set Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="item_set_name" name="item_set_name"  value="" maxlength="50">
                                            <span class="text-danger error-tags item_set_name-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-editset" value="create">Save changes
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
          url: SITEURL + "/itemset",
          type: 'GET',
         },
         columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'item_set_name' , name: 'item_set_name'},
                {data: 'action', name: 'action', orderable: false},
         ],
        order: [[0, 'desc']],
       
    });
  
  
    $('body').on('click', '#edit-itemset', function () {
      var _id = $(this).data('id');
      $.get('/itemset/' + _id , function (data) {
         error_reset.html('');
         $('#editsetCrudModal').text("Edit Set Name");
          $('#btn-editset').text("Edit");
          $('#item_set_id').val(data.id);
          $('#item_set_name').val(data.item_set_name);
          $('#ajax-editset-modal').modal('show');
      })
   });


 
   $('body').on('click', '#delete-itemset', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type:"POST",
                url: SITEURL + "/delete_itemset",
                data: { id: id},
                dataType: 'json',
                success: function(res){
                var oTable = $('#laravel_datatable').dataTable();
                oTable.fnDraw(false);
                }
            });
        }
    });

    // $('body').on('click', '#approve_set', function () {
    //         // ajax
    //         $.ajax({
    //             type:"POST",
    //             url: SITEURL + "/",
    //             data: { id: id},
    //             dataType: 'json',
    //             drawCallback: function(){
    //                 sum_subtotal();
    //             },
    //             success: function(res){
    //             var oTable = $('#laravel_datatable').dataTable();
    //             oTable.fnDraw(false);
    //             }
    //         });
    // });
});
  

if ($("#editsetForm").length > 0) {
      $("#editsetForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-editset').val();
      $('#btn-editset').html('Sending..');
       
      $.ajax({
          data: $('#editsetForm').serialize(),
          url: SITEURL + "/edit_itemset",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#editsetForm').trigger("reset");
              $('#ajax-editset-modal').modal('hide');        
              $('#btn-editset').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              error_reset.html('');

              var e = data.responseJSON.errors;
              $('.item_set_name-error').html(e.item_set_name);
              $('#btn-editset').html('Save Changes');
          }
          
      });
    }
  });
}

</script>
@endsection