<script>


  @if(Session::has('success'))
  		toastr.error("dd");
  @endif


  @if(Session::has('info'))
  		toastr.info("{{ Session::get('info') }}");
  @endif


  @if(Session::has('warning'))
  		toastr.warning("{{ Session::get('warning') }}");
  @endif


  @if(Session::has('error'))
  		toastr.error("{{ Session::get('error') }}");
  @endif

  @if ($errors->any())
    toastr.error('{{($errors->first())}}', "", {"iconClass": 'customer-info'});
  @endif

</script>