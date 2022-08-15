<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\Base64EncodeClass;
use DateTime;

class Base64Encode extends Component
{

    public $text;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.base64-encode');
    }

    public function onBase64Encode(){

        $this->validate([
            'text' => 'required'
        ]);

        $this->data = null;

        try {

            $output = new Base64EncodeClass();

            $this->data = $output->get_data( $this->text );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Base64 Encode';
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
