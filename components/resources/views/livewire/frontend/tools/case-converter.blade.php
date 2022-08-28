<div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="form-group mb-3">
            <button type="button" class="btn">
                <span>{{ __('Characters') }}</span>
                <span class="badge bg-success ms-2" id="characterButton">0</span>
            </button>

            <button type="button" class="btn">
                <span>{{ __('Words') }}</span>
                <span class="badge bg-warning ms-2" id="wordsButton">0</span>
            </button>

            <button type="button" class="btn">
                <span>{{ __('Characters (without spaces)') }}</span>
                <span class="badge bg-primary ms-2" id="characters_with_spacesButton">0</span>
            </button>

            <button type="button" class="btn">
                <span>{{ __('Lines') }}</span>
                <span class="badge bg-danger ms-2" id="lineButton">0</span>
            </button>

            <button type="button" class="btn">
                <span>{{ __('Paragraphs') }}</span>
                <span class="badge bg-danger ms-2" id="paragraphButton">0</span>
            </button>
        </div>

        <div class="form-group mb-3">
            {{-- <textarea class="form-control" wire:model="text" rows="10" placeholder="{{ __('Paste your text here...') }}" required></textarea> --}}
            <textarea class="form-control" id="input-text" placeholder="Type or paste text here..." name="input-text" rows="12"></textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rem-multi-space" name="rem-multi-space" value="1" checked>
            <label class="form-check-label" for="rem-multi-space">Remove Multiple Spaces</label>
          </div>


          <div class="gorm-group mb-4">
            <button  class="btn btn-dark mb-3" id="sentence-case" >Sentence case</button>
            <button  class="btn btn-dark mb-3" id="title-case" >Title Case</button>
            <button class="btn btn-dark mb-3" id="capitalize-case" >Capitalize Case</button>
            <button class="btn btn-dark mb-3" id="lower-case" >lower Case</button>
            <button class="btn btn-dark mb-3" id="upper-case" >UPPER CASE</button>
            <button class="btn btn-dark mb-3" id="copy" >
                <span style="margin-right: .5rem"><i class="fas fa-copy"></i></span>
                 Copy</button>
            {{-- <button class="btn btn-dark mb-3" id="clear" >
                <span class="pr-2"><i class="fa fa-trash-alt"></i></span>
                <span style="margin-left: 5px">Clear</span>
            </button> --}}
          </div>

</div>

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/store2/2.14.2/store2.min.js" integrity="sha512-gHhItnn0aQI81iXNqAX0aCojzcfd1b4E+FnPhP1w0wJu3OB0TmsGJP7pntKiulIZiq1a6XXd/t8wcTkr9XGEkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/case-convert.js')}}"></script>
@endpush
