<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\LoremIpsumGeneratorClass;
use DateTime;

class LoremIpsumGenerator extends Component
{

    public $type = 'paragraphs';
    public $number = 5;
    public $html_markup = 'no';

    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.lorem-ipsum-generator');
    }

    public function onLoremIpsumGenerator(){

        $this->validate([
            'type'        => 'required',
            'number'      => 'required|numeric',
            'html_markup' => 'required'

        ]);

        $this->data = null;

        try {

            $output = new LoremIpsumGeneratorClass();

            $this->data = $output->get_data( $this->type, $this->number, $this->html_markup );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Lorem Ipsum Generator';
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
