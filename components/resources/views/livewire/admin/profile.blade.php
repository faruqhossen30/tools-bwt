<div>

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

					      <div class="card card-body blur shadow-blur">
					        <div class="row gx-4">

					          @livewire('admin.profile.avatar')

					        </div>
					      </div>

					      <div class="row py-4">
					        <div class="col-12">

					        	<div class="tab-content">

					        		@livewire('admin.profile.overview')

					        		@livewire('admin.profile.update-profile')

					        		@livewire('admin.profile.change-password')

							    </div>

					        </div>
						  </div>

                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";
	
    document.addEventListener('livewire:load', function () {

		jQuery('.edit-avatar').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#avatar').change(function() { 
			window.livewire.emit('onSetAvatar', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	
    });

})( jQuery );
</script>