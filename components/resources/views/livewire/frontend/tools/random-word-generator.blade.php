<div>

      <form wire:submit.prevent="onRandomWordGenerator">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
        <div class="form-group mb-3">
            <div class="form-label">{{ __('Enter the number of words') }}</div>
            <input type="number" class="form-control" wire:model="number">
        </div>

        <div class="form-group mb-3">
          <label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="word_type" value="all_words" wire:model="word_type">
            <span class="form-check-label">{{ __('Words (All)') }}</span>
          </label>

          <label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="word_type" value="verbs" wire:model="word_type">
            <span class="form-check-label">{{ __('Verbs only') }}</span>
          </label>

          <label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="word_type" value="nouns" wire:model="word_type">
            <span class="form-check-label">{{ __('Nouns only') }}</span>
          </label>

          <label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="word_type" value="adjectives" wire:model="word_type">
            <span class="form-check-label">{{ __('Adjectives only') }}</span>
          </label>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onRandomWordGenerator">
                  <x-loading />
                </div>
                <span wire:target="onRandomWordGenerator">{{ __('Generate') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($temp_data) )
            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label class="form-label">{{ __('Click on a word you like if you want to temporarily store it in the box below.') }}</label>
                    <div class="form-selectgroup">
                        @foreach ($temp_data as $value)
                            <label class="form-selectgroup-item" wire:click.prevent="onSetInList('{{ $value }}')">
                                <input type="checkbox" name="name" value="{{ $value }}" class="form-selectgroup-input" />
                                <span class="form-selectgroup-label">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </fieldset>
        @endif

        @if ( !empty($data) )
            <fieldset class="form-fieldset">
                <div class="form-group mb-3">
                  <label class="form-label">{{ __('Your word list') }}</label>
                  <textarea id="text" class="form-control" rows="10">
@foreach ($data as $value)
{{ $value }}
@endforeach</textarea>
                </div>

                <div class="form-group">
                    <a class="btn btn-lime" value="copy" onclick="copyToClipboard()">{{ __('Copy selected words') }}</a>
                    <a class="btn btn-warning" wire:click.prevent="onClearInList">{{ __('Clear selected words') }}</a>
                </div>
            </fieldset>
        @endif

      </form>
</div>