<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\Base64ToImageClass;
use Illuminate\Support\Facades\Storage;
use DateTime;

class Base64ToImage extends Component
{

    public $base64_string;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.base64-to-image');
    }

    public function onBase64ToImage(){


        $this->validate([
            'base64_string' => 'required'
        ]); 

        $this->data = null;

        try {

            $output = new Base64ToImageClass();
            
            $this->data = $output->get_data( $this->base64_string );            

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Base64 To Image';
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
}
