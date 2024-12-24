 <!-- BEGIN VENDOR JS-->
 <script src="{{ asset('assets/dashboard') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
 <!-- BEGIN VENDOR JS-->
 <!-- BEGIN PAGE VENDOR JS-->
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript">
 </script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/morris.min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/timeline/horizontal-timeline.js" type="text/javascript">
 </script>
 <!-- END PAGE VENDOR JS-->
 <!-- BEGIN MODERN JS-->
 <script src="{{ asset('assets/dashboard') }}/js/core/app-menu.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/js/core/app.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/js/scripts/customizer.js" type="text/javascript"></script>
 <!-- END MODERN JS-->
 <!-- BEGIN PAGE LEVEL JS-->
 <script src="{{ asset('assets/dashboard') }}/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
 <!-- END PAGE LEVEL JS-->

 {{-- sweet Alert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
      let title = "{{ __('dashboard.are_you_sure') }}";
      let text = "{{ __('dashboard.revert') }}";
      let deleted = "{{ __('dashboard.deleted') }}";
      let deleted_file = "{{ __('dashboard.deleted_file') }}";
     //  let success = {{ __('dashboard.success') }};
    //   let cancelled = {{ __('dashboard.cancelled') }};
     //  let safe = {{ __('dashboard.safe') }};
     //  let error = {{ __('dashboard.error') }};

     $(document).on('click', '.delete_confirm', function(e) {
         e.preventDefault();

         form = $(this).closest('form');

         const swalWithBootstrapButtons = Swal.mixin({
             customClass: {
                 confirmButton: "btn btn-success",
                 cancelButton: "btn btn-danger"
             },
             buttonsStyling: true
         });
         swalWithBootstrapButtons.fire({
             title: title,
             text: text,
             icon: "warning",
             showCancelButton: true,
             confirmButtonText: "Yes, delete it!",
             cancelButtonText: "No, cancel!",
             reverseButtons: true
         }).then((result) => {
             if (result.isConfirmed) {
                 form.submit();
                 swalWithBootstrapButtons.fire({
                     title: deleted,
                     text: deleted_file,
                     icon: "success"
                 });
             } else if (
                 /* Read more about handling dismissals below */
                 result.dismiss === Swal.DismissReason.cancel
             ) {
                 swalWithBootstrapButtons.fire({
                     title: "Cancelled",
                     text: "Your imaginary file is safe :)",
                     icon: "error"
                 });
             }
         });
     });
 </script>
 {{-- End sweet Alert --}}

 {{-- DataTables CDN --}}
   {{-- bootStrap DataTables --}}
   <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

   <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js" type="text/javascript"></script>
   
   {{-- colreorder DataTables --}}
   <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/colreorder/2.0.4/js/colReorder.bootstrap5.min.js" type="text/javascript"></script>
   {{-- Rowreorder DataTables --}}
   <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap5.min.js" type="text/javascript"></script>
   {{-- select DataTable CDN --}}
   <script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/select/2.1.0/js/select.bootstrap5.min.js" type="text/javascript"></script>
   {{-- fixed Header DataTable CDN --}}
   <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap5.min.js" type="text/javascript"></script>


   <script src="{{ asset('assets/datatables/excel/jszip.min.js') }}"></script>
   <script src="{{ asset('assets/datatables/pdf/pdfmake.min.js') }}"></script>
   <script src="{{ asset('assets/datatables/pdf/vfs_fonts.js') }}"></script>

   {{-- End DataTables CDN --}}

   {{-- File Input --}}
   <script src="{{ asset('vendor/file-input/js/fileinput.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script>
  <script src="{{ asset('vendor/file-input/themes/fa5/theme.min.js') }}"></script>

  @if(Config::get('app.locale') == 'ar')
    <script src="{{ asset('vendor/file-input/js/locales/LANG.js') }}"></script>
    <script src="{{ asset('vendor/file-input/js/locales/ar.js') }}"></script>
  @endif

   <script>
    var lang = "{{ app()->getLocale() }}";
    $(function(){

        $('#single-image').fileinput({
            theme: 'fa5',
            language: lang,
            allowFileType: ['image'],
            maxFileCount: 1,
            enableResumablesUpload: false,
            showUpload: false,
        });
    });
   </script>
  {{-- End File Input --}}
