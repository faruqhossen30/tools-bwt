<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\HexToRgbClass;
use DateTime;

class HexToRgb extends Component
{

    public $hex_color;
    public $red_color;
    public $green_color;
    public $blue_color;
    public $css_color;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.hex-to-rgb');
    }

    public function onHexToRgb(){

        $this->validate([
            'hex_color'        => 'required'
        ]);

        $this->data = null;

        try {

            $output = new HexToRgbClass();

            $this->data = $output->get_data( $this->hex_color );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $this->red_color   = $this->data['red'];
            $this->green_color = $this->data['green'];
            $this->blue_color  = $this->data['blue'];
            $this->css_color   = 'rgb('.$this->data['red'].', '.$this->data['green'].', '.$this->data['blue'].')';

            $this->dispatchBrowserEvent('showPreview', ['css_color' => $this->css_color ]);

            $history             = new History;
            $history->tool_name  = 'HEX to RGB';
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
        $this->hex_color = '#FF0000';
    }

    public function onReset()
    {
        $this->hex_color = null;
        $this->data      = null;
    }

}
