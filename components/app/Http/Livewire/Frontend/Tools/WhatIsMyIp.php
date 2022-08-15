<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\WhatIsMyIpClass;
use DateTime;

class WhatIsMyIp extends Component
{
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.what-is-my-ip');
    }

    public function onWhatIsMyIp(){

        $this->data = null;

        try {

            $output = new WhatIsMyIpClass();

            $this->data = $output->get_data( request()->ip() );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'What Is My IP';
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
