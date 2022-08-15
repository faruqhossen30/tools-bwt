<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\IpAddressLookupClass;
use DateTime;

class IpAddressLookup extends Component
{
    public $ip;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.ip-address-lookup');
    }

    public function onIpAddressLookup(){

        $this->validate([
            'ip' => 'required'
        ]);

        $this->data = null;

        try {

            $output = new IpAddressLookupClass();

            $this->data = $output->get_data( $this->ip );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'IP Address Lookup';
            $history->client_ip  = request()->ip();

            $response = Http::get('http://ip-api.com/json/'.request()->ip().'?fields=status,country,countryCode,query');

            if ( $response['status'] == 'success' ) {
                $history->flag       = strtolower( $response['countryCode'] );
                $history->country    = $response['country'];
            }

            $history->created_at = new DateTime();
            $history->save();
        }

    }
    //
}
