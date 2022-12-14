<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Translations - SumoWebTools') }}</title>

    <x-admin.headerAssets />

    @livewireStyles

</head>
<body class="antialiased {{ Cookie::get('theme_mode') }}">

    <div class="wrapper">
      <x-admin.sidebar />
      <div class="page-wrapper">
        
            <!-- Begin::Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg" id="navbarBlur" navbar-scroll="false">
             <div class="container-fluid">

                <x-admin.breadcrumbs />

                <x-admin.navright />

             </div>
            </nav>
            <!-- End::Navbar -->

            <div class="page-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col">

                        @if( Route::is('edit-translations') )
                            @livewire('admin.settings.translations.edit-translation', ['lang_id' => Route::current()->parameter('lang_id') ] )
                        @else
                            @livewire('admin.settings.translations')
                        @endif
                    
                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    @livewireScripts

    <script>
    (function( $ ) {
        "use strict";

        document.addEventListener('livewire:load', function () {

            window.addEventListener('swal:modal', event => {

                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                  buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: event.detail.title,
                  text: event.detail.text,
                  icon: event.detail.type,
                  showCancelButton: true,
                  confirmButtonText: "{{ __('Yes, delete it!') }}",
                  cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.livewire.emit('onDeleteLanguage', event.detail.id)
                  }
                });

            });
        
            window.addEventListener('closeModal', event => {
                jQuery('#' + event.detail.id).modal('hide');
            });

            window.addEventListener('showModal', event => {
                jQuery('#' + event.detail.id).modal('show');
            });

            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message);
            });

        });

    })( jQuery );
    </script>

    <script src="{{ asset('assets/js/choices.min.js') }}"></script>

</body>
</html>