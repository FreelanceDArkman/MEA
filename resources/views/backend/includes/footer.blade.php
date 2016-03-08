<!--[if lt IE 9]>
<script src="{{ asset('backend/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{ asset('backend/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('backend/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>





<!-- END CORE PLUGINS -->

<script>
    jQuery(document).ready(function($) {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
    });
</script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
@if(Request::is('admin'))

@endif

@if(Request::is('admin/userGroup') || Request::is('admin/users'))
    <script src="{{ asset('backend/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/userGroup/add') || Request::is('admin/userGroup/edit/*'))
    <script src="{{ asset('backend/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/jstree/dist/jstree.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/users/add'))
    <script src="{{ asset('backend/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
@endif
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('backend/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@if(Request::is('admin'))

@endif

@if(Request::is('admin/userGroup'))
    <script src="{{ asset('backend/assets/pages/scripts/user-group.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/userGroup/add'))
    <script src="{{ asset('backend/assets/pages/scripts/form-wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/pages/scripts/ui-tree.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/userGroup/edit/*'))
    <script src="{{ asset('backend/assets/pages/scripts/form-edit-user-group.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/pages/scripts/ui-tree.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/users'))
        <script src="{{ asset('backend/assets/pages/scripts/users.min.js') }}" type="text/javascript"></script>
@endif

@if(Request::is('admin/users/add'))
    <script src="{{ asset('backend/assets/pages/scripts/add-user.js') }}" type="text/javascript"></script>
@endif


<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('backend/assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>

<!-- END THEME LAYOUT SCRIPTS -->