<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateNotice">

		<!-- Begin:GDPR Privacy Notice -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">

					<div class="form-group mb-3">
						
						<div class="d-flex">
							<label for="ads-area-1" class="form-label">{{ __('GDPR Privacy Notice') }}</label>
							<div class="form-check form-switch ps-3">
								<input class="form-check-input ms-auto" type="checkbox" wire:model="status">
							</div>
						</div>

						<div class="col">
							<textarea class="form-control" id="ads-area-1" rows="8" wire:model="notice"></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="input-group">

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
									<select name="align" class="form-control ps-3" wire:model="align">
										<option value="text-start">{{ __('Left') }}</option>
										<option value="text-end">{{ __('Right') }}</option>
										<option value="text-center">{{ __('Center') }}</option>
									</select>
								</div>
							</div>

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Background Color') }}</button>
									<select class="form-control ps-3" wire:model="background">
										<option value="bg-white">{{ __('White') }}</option>
										<option value="bg-primary">{{ __('Primary') }}</option>
										<option value="bg-secondary">{{ __('Secondary') }}</option>
										<option value="bg-info">{{ __('Info') }}</option>
										<option value="bg-success">{{ __('Success') }}</option>
										<option value="bg-danger">{{ __('Danger') }}</option>
										<option value="bg-warning">{{ __('Warning') }}</option>
									</select>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Enable Button') }}</button>
									<select class="form-control ps-3" wire:model="button">
										<option value="1">{{ __('Yes') }}</option>
										<option value="0">{{ __('No') }}</option>
									</select>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End:GDPR Privacy Notice -->

		<div class="form-group mt-3">
			<button class="btn btn-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdateNotice">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>

<script>
(function( $ ) {
	"use strict";

	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
		
	});

})( jQuery );
</script>