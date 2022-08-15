<div>

      <form wire:submit.prevent="onWhatIsMyIp">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-bordered">
                <tbody>
                    <tr>
                        <td>{{ __('Your IP Address') }}</td>
                        <td class="text-danger font-weight-bold">{{ request()->ip() }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Location') }}</td>

                        @php
                            $response = \Illuminate\Support\Facades\Http::get('http://ip-api.com/json/'.request()->ip().'?fields=status,country,countryCode,city');
                        @endphp

                        @if ( $response['status'] == 'success' )
                           <td>{{ $response['country'] . ' (' . $response['countryCode'] .') ' . ', ' . $response['city'] }}</td>
                        @else
                            <td>{{ __('N/a') }}</td>
                        @endif
                        
                    </tr>

                    @if ( !empty($data) )
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
                    @endif

                </tbody>
            </table>
        </div>

        <div class="form-group my-3">
            <button class="btn btn-info d-block mx-auto">
              <span>
                <div wire:loading.inline wire:target="onWhatIsMyIp">
                  <x-loading />
                </div>
                <span wire:target="onWhatIsMyIp">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>