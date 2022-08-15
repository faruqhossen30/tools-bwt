<div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>{{ __('Page Name') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Latest updates') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $auth_pages->isNotEmpty() )

                            @foreach ($auth_pages as $auth_page)

                                <tr>
                                    <td>{{ $auth_page->name }}</td>
                                    <td>
                                        @if ($auth_page->status == true)
                                            <span class="badge bg-success"><i class="fas fa-check"></i></span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-ban"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $auth_page->updated_at }}</td>
                                    <td class="w-25">
                                        <a wire:click="onEnablePage( {{ $auth_page->id }} )" class="btn btn-success" title="{{ __('Enable') }}">
                                            <i class="fas fa-check icon"></i>
                                            {{ __('Enable') }}
                                        </a>

                                        <a wire:click="onDisablePage( {{ $auth_page->id }} )" class="btn btn-danger" title="{{ __('Disable') }}">
                                            <i class="fas fa-ban icon"></i>
                                            {{ __('Disable') }}
                                        </a>
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
        </div>

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