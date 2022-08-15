<div>

      <form wire:submit.prevent="onIpAddressLookup">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row mb-3">
            <label class="form-label">{{ __('IP Address') }}</label>
            <div class="col">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model="ip" placeholder="{{ __('Enter IP Address here...') }}" required />
                    <span class="input-group-text bg-white">
                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                        </a>
                    </span>
                </div>
            </div>

            <div class="col-auto">
                <div class="form-group">
                    <button class="btn btn-info mx-auto d-block">
                        <span>
                            <div wire:loading.inline wire:target="onIpAddressLookup">
                                <x-loading />
                            </div>
                            <span wire:target="onIpAddressLookup">{{ __('Lookup') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        @if ( !empty($data) )
            <div class="table-responsive" wire:loading.remove wire:target="onIpAddressLookup">
                <table class="table table-vcenter card-table table-bordered">
                    <tbody>
                        <tr>
                            <td>{{ __('IP Address') }}</td>
                            <td class="text-danger font-weight-bold">{{ $data['query'] }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Location') }}</td>
                            <td>{{ $data['country'] . ' (' . $data['countryCode'] .') ' . ', ' . $data['city'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Region') }}</td>
                            <td>{{ $data['regionName'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('City') }}</td>
                            <td>{{ $data['city'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Latitude') }}</td>
                            <td>{{ $data['lat'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Longitude') }}</td>
                            <td>{{ $data['lon'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Time zone') }}</td>
                            <td>{{ $data['timezone'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Currency code') }}</td>
                            <td>{{ $data['currency'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Zip') }}</td>
                            <td>{{ ($data['zip']) ? $data['zip'] : __('N/a') }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('ISP') }}</td>
                            <td>{{ $data['isp'] . ' (' . $data['as'] . ')' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

      </form>
</div>