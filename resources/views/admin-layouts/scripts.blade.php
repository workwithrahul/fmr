<!-- Bootstrap core JavaScript-->
<script src="{{ URL::asset('public/admin/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('public/admin/js/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/sb-admin-2.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ URL::asset('public/admin/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/datatables-custom/datatables.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/tokeninput/jquery.tokeninput.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ URL::asset('public/admin/js/custom.js') }}"></script>
<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>