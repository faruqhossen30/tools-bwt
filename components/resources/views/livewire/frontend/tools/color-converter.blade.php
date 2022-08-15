<div>

      <form wire:submit.prevent="onColorConverter">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Enter your Color') }}</label>
                    <input type="text" class="form-control" wire:model="color" />
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn btn-white btn-icon">{{ __('RGB') }}</a>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ ($data) ? $data['rgb'] : '' }}" readonly />
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn btn-white btn-icon">{{ __('HEX') }}</a>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ ($data) ? $data['hex'] : '' }}" readonly />
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn btn-white btn-icon">{{ __('HLS') }}</a>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ ($data) ? $data['hls'] : '' }}" readonly />
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn btn-white btn-icon">{{ __('HSV') }}</a>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ ($data) ? $data['hsv'] : '' }}" readonly />
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn btn-white btn-icon">{{ __('CMYK') }}</a>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ ($data) ? $data['cmyk'] : '' }}" readonly />
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">
                <div class="border" style="height: 325px; background-color: {{ ($data) ? $data['rgb'] : '' }};"></div>
            </div>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-info mx-auto d-block">
              <span>
                <div wire:loading.inline wire:target="onColorConverter">
                  <x-loading />
                </div>
                <span wire:target="onColorConverter">{{ __('Convert') }}</span>
              </span>
            </button>
        </div>       

      </form>
</div>
