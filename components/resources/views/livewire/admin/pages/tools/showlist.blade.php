<div>

		<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Tool') }}</button>

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
							<th>{{ __('Tool Name') }}</th>
							<th>{{ __('Tool Slug') }}</th>
							<th>{{ __('Category') }}</th>
							<th>{{ __('Default Language') }}</th>
							<th>{{ __('Translation Progress') }}</th>
							<th>{{ __('Latest updates') }}</th>
							<th>{{ __('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@if ( $tools->isNotEmpty() )

							@foreach ($tools as $tool)
								<tr>
									<td>{{ $tool->tool_name }}</td>
									<td>
										<div class="d-flex px-2 py-1">
											<div>
												<img src="{{ ($tool->icon_image) ? $tool->icon_image : asset('assets/img/no-thumb.svg') }}" class="avatar avatar-sm bg-transparent me-3">
											</div>
											<div class="d-flex align-items-center">{{ $tool->slug }}</div>
										</div>
									</td>
									<td>
										@if ( !empty($tool->category_id) )
											<span>{{ \App\Models\Admin\PageCategory::where('id', $tool->category_id)->first()->title }}</span>
										@endif
									</td>
									<td>
										<img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-menu mx-auto"> 
									</td>
									<td>
										@foreach ($translation_progress as $value)

											@if ($value['page_id'] == $tool->id)

												@if ($value['progress'] == $total_lang)
													<span class="badge bg-success">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@else
													<span class="badge bg-secondary">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@endif
											@endif
										@endforeach
									</td>

									<td>
										<span>{{ $tool->updated_at }}</span>
									</td>
									<td class="w-25">
										<a href="{{ route('page-translations', $tool->id ) }}" class="btn btn-primary" title="{{ __('Translations') }}"><i class="fas fa-language icon"></i> Translations</a>
										<a wire:click="onShowEditPageModal( {{ $tool->id }} )" class="btn btn-info" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
										<a wire:click="onDeleteConfirmPage( {{ $tool->id }} )" class="btn btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
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
				{{ $tools->links() }}
				<!-- begin:pagination -->
			</div>
		</div>

	    <!-- Begin::Add New Page -->
	    <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Tool') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.tools.create')

	        </div>
	      </div>
	    </div>
	    <!-- End::Add New Page -->

	    <!-- Begin::Edit Page -->
	    <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editPageModalLabel">{{ __('Edit Tool') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.tools.edit')
	          
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
			$('#' + event.detail.id).modal('hide');
		});

		window.addEventListener('showModal', event => {
			$('#' + event.detail.id).modal('show');
		});
			
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>