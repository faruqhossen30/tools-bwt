<div>

      <form wire:submit.prevent="onRgbToHex">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>{{ __('Red color (R):') }}</td>
                        <td><input type="number" class="form-control" wire:model="red_color"></td>
                        <td><div id="slider" class="w-100" wire:ignore></div><input type="range" class="form-range d-flex align-items-center" wire:change="onSetRedColor($event.target.value)" value="{{ !empty($red_color) ? $red_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>

                    <tr>
                        <td>{{ __('Green color (G):') }}</td>
                        <td><input type="number" class="form-control" wire:model="green_color"></td>
                        <td><input type="range" class="form-range d-flex align-items-center" wire:change="onSetGreenColor($event.target.value)" value="{{ !empty($green_color) ? $green_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>

                    <tr>
                        <td>{{ __('Blue color (B):') }}</td>
                        <td><input type="number" class="form-control" wire:model="blue_color"></td>
                        <td><input type="range" class="form-range d-flex align-items-center" wire:change="onSetBlueColor($event.target.value)" value="{{ !empty($blue_color) ? $blue_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group my-3 text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onRgbToHex">
                  <x-loading />
                </div>
                <span wire:target="onRgbToHex">{{ __('Convert') }}</span>
              </span>
            </button>

            <button class="btn btn-lime" wire:click.prevent="onSample" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSample">
                  <x-loading />
                </div>
                <span wire:target="onSample">{{ __('Sample') }}</span>
              </span>
            </button>

            <button class="btn btn-warning" wire:click.prevent="onReset" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onReset">
                  <x-loading />
                </div>
                <span wire:target="onReset">{{ __('Reset') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
            <div class="table-responsive" wire:loading.remove wire:target="onRgbToHex">
                <table class="table table-vcenter card-table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>{{ __('Color preview:') }}</td>
                            <td><textarea class="form-control preview" readonly></textarea></td>
                        </tr>
                        <tr>
                            <td>{{ __('Hex color code:') }}</td>
                            <td>
                                <input type="text" class="form-control" wire:model="hex_color" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

      </form>
</div>

<script>
(function( $ ) {
  "use strict";

    document.addEventListener('livewire:load', function () {

        window.addEventListener('showPreview', event => {
            jQuery('.preview').css('background', event.detail.preview_color);
        });

    });

})( jQuery );
</script>