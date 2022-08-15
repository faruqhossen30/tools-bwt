<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\UrlEncodeClass;
use DateTime;

class UrlEncode extends Component
{

    public $url;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.url-encode');
    }

    public function onUrlEncode(){

        $this->validate([
            'url' => 'required|url'
        ]);

        $this->data = null;

        try {

            $output = new UrlEncodeClass();

            $this->data = $output->get_data( $this->url );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'URL Encode';
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
