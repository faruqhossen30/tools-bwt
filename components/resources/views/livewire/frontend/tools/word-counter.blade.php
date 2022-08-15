<div>

      <form wire:submit.prevent="onWordCounter">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <div class="form-group mb-3">
                <button type="button" class="btn">
                    <span>{{ __('Words') }}</span> 
                    <span class="badge bg-warning ms-2">{{ ( $data ) ? $data['words'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Characters') }}</span>
                    <span class="badge bg-success ms-2">{{ ( $data ) ? $data['characters'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Characters (with spaces)') }}</span>
                    <span class="badge bg-primary ms-2">{{ ( $data ) ? $data['characters_with_spaces'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Paragraphs') }}</span>
                    <span class="badge bg-danger ms-2">{{ ( $data ) ? $data['paragraphs'] : 0 }}</span>
                </button>
            </div>

            <div class="form-group mb-3">
                <textarea class="form-control" wire:model="text" rows="10" placeholder="{{ __('Paste your text here...') }}" required></textarea>
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-info mx-auto d-block">
                  <span>
                    <div wire:loading.inline wire:target="onWordCounter">
                      <x-loading />
                    </div>
                    <span wire:target="onWordCounter">{{ __('Count') }}</span>
                  </span>
                </button>
            </div>

      </form>
</div>