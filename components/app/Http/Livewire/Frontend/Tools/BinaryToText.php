<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\BinaryToTextClass;
use DateTime;

class BinaryToText extends Component
{

    public $binary;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.binary-to-text');
    }

    public function onBinaryToText(){

        $this->validate([
            'binary'        => 'required'
        ]);

        $this->data = null;

        try {

            $output = new BinaryToTextClass();

            $this->data = $output->get_data( $this->binary );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Binary to Text';
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

    public function onSample()
    {
        $this->binary = '1001000 1101001 101100 100000 1010011 1100001 1101101 1110000 1101100 1100101 100000 1010100 1100101 1111000 1110100 100001';
    }

    public function onReset()
    {
        $this->binary = null;
        $this->data = null;
    }
}
