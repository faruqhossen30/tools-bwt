<div>

		<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Post') }}</button>

		<!-- begin:Form Search -->
		<form id="formSearchPage">
			<div class="input-group mb-3">
				<input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
			</div>
		</form>
		<!-- end:Form Search -->

		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter card-table">
					<thead>
						<tr>
							<th>{{ __('Slug') }}</th>
							<th>{{ __('Page Type') }}</th>
							<th>{{ __('Default Language') }}</th>
							<th>{{ __('Translation Progress') }}</th>
							<th>{{ __('Latest updates') }}</th>
							<th>{{ __('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@if ( $pages->isNotEmpty() )

							@foreach ($pages as $page)

								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div>
												<img src="{{ ($page->featured_image) ? $page->featured_image : asset('assets/img/no-thumb.svg') }}" class="avatar avatar-sm me-3">
											</div>
											<div class="d-flex align-items-center">{{ $page->slug }}</div>
										</div>
									</td>
									<td>{{ $page->type }}</td>
									<td>
										<img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-menu mx-auto"> 
									</td>

									<td>
										@foreach ($translation_progress as $value)

											@if ($value['page_id'] == $page->id)

												@if ($value['progress'] == $total_lang)
													<span class="badge bg-success">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@else
													<span class="badge bg-secondary">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@endif
												
											@endif
										@endforeach
									</td>
									<td class="w-25">
										<a href="{{ route('page-translations', $page->id ) }}" class="btn btn-primary" title="{{ __('Translations') }}"><i class="fas fa-language icon"></i> Translations</a>
										<a wire:click="onShowEditPageModal( {{ $page->id }} )" class="btn btn-info" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
										<a wire:click="onDeleteConfirmPage( {{ $page->id }} )" class="btn btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
									</td>
								</tr>

							@endforeach

						@else

							<tr>
								<td>{{ __('No record found') }}</td>
							</tr>

						@endif

					</tbody>
				</table>
			</div>

			<div class="mx-auto mt-3">
				<!-- begin:pagination -->
				{{ $pages->links() }}
				<!-- begin:pagination -->
			</div>
		</div>

	    <!-- Begin::Add New Page -->
	    <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Page') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.posts.create')

	        </div>
	      </div>
	    </div>
	    <!-- End::Add New Page -->

	    <!-- Begin::Edit Page -->
	    <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editPageModalLabel">{{ __('Edit Page') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.posts.edit')
	          
	        </div>
	      </div>
	    </div>
	    <!-- End::Edit Page -->

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
			    window.livewire.emit('onDeletePage', event.detail.id)
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