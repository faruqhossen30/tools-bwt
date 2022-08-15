<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RgbToHexClass;
use DateTime;

class RgbToHex extends Component
{

    public $hex_color;
    public $red_color;
    public $green_color;
    public $blue_color;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.rgb-to-hex');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onRgbToHex
     * -------------------------------------------------------------------------------
    **/
    public function onRgbToHex(){

        $this->validate([
            'red_color'   => 'required|numeric',
            'green_color' => 'required|numeric',
            'blue_color'  => 'required|numeric'
        ]);

        $this->data = null;

        try {

            $output = new RgbToHexClass();

            $this->data = $output->get_data( $this->red_color, $this->green_color, $this->blue_color );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $this->hex_color = $this->data['hex_color'];
            $this->dispatchBrowserEvent('showPreview', ['preview_color' => $this->data['hex_color'] ]);

            $history             = new History;
            $history->tool_name  = 'RGB to HEX';
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

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->red_color   = '255';
        $this->green_color = '0';
        $this->blue_color  = '0';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->red_color   = null;
        $this->green_color = null;
        $this->blue_color  = null;
        $this->data        = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetRedColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetRedColor($value)
    {
        $this->red_color = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetGreenColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetGreenColor($value)
    {
        $this->green_color = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetBlueColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetBlueColor($value)
    {
        $this->blue_color = $value;
    }
}
