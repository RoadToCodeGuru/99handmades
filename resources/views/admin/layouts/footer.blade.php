 <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 99 Handmades and Accessories
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('theme/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('theme/assets/plugins/popper/popper.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('theme/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('theme/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('theme/js/sidebarmenu.js')}}"></script>
<!--stickey kit -->
<script src="{{asset('theme/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('theme/js/custom.min.js')}}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<!-- <script src="{{asset('theme/assets/plugins/jquery/jquery.min.js')}}../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> -->
<!-- This is data table -->
<script src="{{asset('theme/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/datatables/jquery.validate.min.js')}}"></script>


<script src="{{asset('theme/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('theme/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
<script>
$(document).ready(function() {
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });
    // For select 2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //Bootstrap-TouchSpin
    $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'ti-plus',
        verticaldownclass: 'ti-minus'
    });
    var vspinTrue = $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    if (vspinTrue) {
        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
    }
    $("input[name='tch1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
    $("input[name='tch2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: '$'
    });
    $("input[name='tch3']").TouchSpin();
    $("input[name='tch3_22']").TouchSpin({
        initval: 40
    });
    $("input[name='tch5']").TouchSpin({
        prefix: "pre",
        postfix: "post"
    });
    // For multiselect
    $('#pre-selected-options').multiSelect();
    $('#optgroup').multiSelect({
        selectableOptgroup: true
    });
    $('#public-methods').multiSelect();
    $('#select-all').click(function() {
        $('#public-methods').multiSelect('select_all');
        return false;
    });
    $('#deselect-all').click(function() {
        $('#public-methods').multiSelect('deselect_all');
        return false;
    });
    $('#refresh').on('click', function() {
        $('#public-methods').multiSelect('refresh');
        return false;
    });
    $('#add-option').on('click', function() {
        $('#public-methods').multiSelect('addOption', {
            value: 42,
            text: 'test 42',
            index: 0
        });
        return false;
    });
    $(".ajax").select2({
        ajax: {
            url: "https://api.github.com/search/repositories",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        // templateResult: formatRepo, // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });
});

// droppify

$('.dropify').dropify();

// Translated
$('.dropify-fr').dropify({
    messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
    }
});

// Used events
var drEvent = $('#input-file-events').dropify();


drEvent.on('dropify.beforeClear', function(event, element) {
    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
});

drEvent.on('dropify.afterClear', function(event, element) {
    alert('File deleted');
});

drEvent.on('dropify.errors', function(event, element) {
    console.log('Has Errors');
});

var drDestroy = $('#input-file-to-destroy').dropify();
drDestroy = drDestroy.data('dropify')
$('#toggleDropify').on('click', function(e) {
    e.preventDefault();
    if (drDestroy.isDropified()) {
        drDestroy.destroy();
    } else {
        drDestroy.init();
    }
})
</script>