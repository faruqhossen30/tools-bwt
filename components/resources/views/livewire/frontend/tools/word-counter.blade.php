<div>

    <form wire:submit.prevent="onWordCounter">

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
            <textarea class="form-control" rows="15" id="textbox" placeholder="{{ __('Paste your text here...') }}" required></textarea>
        </div>


</form>
</div>
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/store2/2.14.2/store2.min.js" integrity="sha512-gHhItnn0aQI81iXNqAX0aCojzcfd1b4E+FnPhP1w0wJu3OB0TmsGJP7pntKiulIZiq1a6XXd/t8wcTkr9XGEkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/word-counter.js')}}"></script>
@endpush
