<div>
    <div class="card">
       <div class="table-responsive">
           <table class="table table-vcenter card-table">
               <thead>
                   <tr>
                       <th>{{ __('Tool name') }}</th>
                       <th>{{ __('Client IP') }}</th>
                       <th>{{ __('Country') }}</th>
                       <th>{{ __('Date') }}</th>
                   </tr>
               </thead>
               <tbody>
                    @if ( $histories->isNotEmpty() )

                        @foreach ($histories as $history)

                            <tr>
                                <td>{{ $history->tool_name }}</td>
                                <td>{{ $history->client_ip }}</td>
                                <td>

                                    @if ( !empty( $history->flag ) && !empty( $history->country ) )
                                        <img src="https://flagcdn.com/40x30/{{ $history->flag }}.png" class="lang-menu me-1 my-auto">
                                        {{ $history->country }}
                                    @else
                                        {{ __('Unknown') }}
                                    @endif

                                </td>
                                <td>{{ $history->created_at }}</td>
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

        <div class="mx-auto mt-3">
            {{ $histories->links() }}
        </div>
    </div>                      
</div>
