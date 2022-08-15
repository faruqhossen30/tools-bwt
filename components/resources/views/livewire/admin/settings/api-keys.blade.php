<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateAPIKeys" class="row">

        <!-- Begin:Facebook -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">{{ __('Facebook') }} (<a href="https://docs.themeluxury.com/sumowebtools/getting-started/how-to-get-facebook-cookies/" target="_blank" class="text-white">{{ __('How to get Facebook Cookies') }}</a>)</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table table-vcenter card-table settings">
                            <tr>
                                <td class="align-middle"><label for="facebook_cookies" class="form-label">{{ __('Cookies') }}</label></td>
                                <td class="align-middle">
                                    <textarea class="form-control" wire:model="facebook_cookies" rows="5"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Facebook -->

        <div class="form-group">
            <button class="btn btn-primary float-end">
                <span>
                    <div wire:loading wire:target="onUpdateAPIKeys">
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