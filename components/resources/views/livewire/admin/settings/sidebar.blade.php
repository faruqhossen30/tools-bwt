<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateSidebar">

        <div class="row">
 
            <div class="col-12">

                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">{{ __('Recent Posts') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="form-label">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="post_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label for="username" class="form-label">{{ __('Number of posts you want to display') }}</label></td>
                                    <td class="align-middle">
                                        <input type="text" class="form-control" wire:model="post_count">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Align') }}</label></td>
                                    <td class="align-middle">
                                        <select class="form-control" wire:model="post_align">
                                            <option value="start">{{ __('Left') }}</option>
                                            <option value="end">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Background') }}</label></td>
                                    <td class="align-middle">
                                        <select name="align" class="form-control" wire:model="post_background">
                                            <optgroup label="Base colors">
                                                <option value="bg-white">{{ __('White') }}</option>
                                                <option value="bg-blue">{{ __('Blue') }}</option>
                                                <option value="bg-azure">{{ __('Azure') }}</option>
                                                <option value="bg-indigo">{{ __('Indigo') }}</option>
                                                <option value="bg-purple">{{ __('Purple') }}</option>
                                                <option value="bg-pink">{{ __('Pink') }}</option>
                                                <option value="bg-red">{{ __('Red') }}</option>
                                                <option value="bg-orange">{{ __('Orange') }}</option>
                                                <option value="bg-yellow">{{ __('Yellow') }}</option>
                                                <option value="bg-lime">{{ __('Lime') }}</option>
                                                <option value="bg-green">{{ __('Green') }}</option>
                                                <option value="bg-teal">{{ __('Teal') }}</option>
                                                <option value="bg-cyan">{{ __('Cyan') }}</option>
                                            </optgroup>
                                            <optgroup label="Light colors">
                                                <option value="bg-blue-lt">{{ __('Blue') }}</option>
                                                <option value="bg-azure-lt">{{ __('Azure') }}</option>
                                                <option value="bg-indigo-lt">{{ __('Indigo') }}</option>
                                                <option value="bg-purple-lt">{{ __('Purple') }}</option>
                                                <option value="bg-pink-lt">{{ __('Pink') }}</option>
                                                <option value="bg-red-lt">{{ __('Red') }}</option>
                                                <option value="bg-orange-lt">{{ __('Orange') }}</option>
                                                <option value="bg-yellow-lt">{{ __('Yellow') }}</option>
                                                <option value="bg-lime-lt">{{ __('Lime') }}</option>
                                                <option value="bg-green-lt">{{ __('Green') }}</option>
                                                <option value="bg-teal-lt">{{ __('Teal') }}</option>
                                                <option value="bg-cyan-lt">{{ __('Cyan') }}</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">{{ __('Popular Tools') }}</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-vcenter card-table settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="form-label">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="tool_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Align') }}</label></td>
                                    <td class="align-middle">
                                        <select class="form-control" wire:model="tool_align">
                                            <option value="start">{{ __('Left') }}</option>
                                            <option value="end">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Background') }}</label></td>
                                    <td class="align-middle">
                                        <select name="align" class="form-control" wire:model="tool_background">
                                            <optgroup label="Base colors">
                                                <option value="bg-white">{{ __('White') }}</option>
                                                <option value="bg-blue">{{ __('Blue') }}</option>
                                                <option value="bg-azure">{{ __('Azure') }}</option>
                                                <option value="bg-indigo">{{ __('Indigo') }}</option>
                                                <option value="bg-purple">{{ __('Purple') }}</option>
                                                <option value="bg-pink">{{ __('Pink') }}</option>
                                                <option value="bg-red">{{ __('Red') }}</option>
                                                <option value="bg-orange">{{ __('Orange') }}</option>
                                                <option value="bg-yellow">{{ __('Yellow') }}</option>
                                                <option value="bg-lime">{{ __('Lime') }}</option>
                                                <option value="bg-green">{{ __('Green') }}</option>
                                                <option value="bg-teal">{{ __('Teal') }}</option>
                                                <option value="bg-cyan">{{ __('Cyan') }}</option>
                                            </optgroup>
                                            <optgroup label="Light colors">
                                                <option value="bg-blue-lt">{{ __('Blue') }}</option>
                                                <option value="bg-azure-lt">{{ __('Azure') }}</option>
                                                <option value="bg-indigo-lt">{{ __('Indigo') }}</option>
                                                <option value="bg-purple-lt">{{ __('Purple') }}</option>
                                                <option value="bg-pink-lt">{{ __('Pink') }}</option>
                                                <option value="bg-red-lt">{{ __('Red') }}</option>
                                                <option value="bg-orange-lt">{{ __('Orange') }}</option>
                                                <option value="bg-yellow-lt">{{ __('Yellow') }}</option>
                                                <option value="bg-lime-lt">{{ __('Lime') }}</option>
                                                <option value="bg-green-lt">{{ __('Green') }}</option>
                                                <option value="bg-teal-lt">{{ __('Teal') }}</option>
                                                <option value="bg-cyan-lt">{{ __('Cyan') }}</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>

                            </table>

                            <table class="table table-vcenter card-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Tool Name') }}</th>
                                        <th>{{ __('Tool Slug') }}</th>
                                        <th>{{ __('Page Type') }}</th>
                                        <th>{{ __('Popular') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pages as $index => $page)
                                        <tr>
                                            <td class="align-middle">{{ $page['tool_name'] }}</td>
                                            <td class="align-middle py-3">{{ $page['slug'] }}</td>
                                            <td class="align-middle">{{ $page['type'] }}</td>
                                            <td class="align-middle">
                                                <div class="form-check form-switch ps-0">
                                                    <input class="form-check-input ms-auto" type="checkbox" wire:model="pages.{{ $index }}.popular">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary float-end">
                    <span>
                        <div wire:loading wire:target="onUpdateSidebar">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>
            </div>

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