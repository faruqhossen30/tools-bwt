<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RemoveLineBreaksClass;
use DateTime;

class RemoveLineBreaks extends Component
{
    public $text;
    public $para_option = 'no_paragraphs';
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.remove-line-breaks');
    }

    public function onRemoveLineBreaks(){

        $this->validate([
            'text'        => 'required',
            'para_option' => 'required'
        ]);

        $this->data = null;

        try {

            $output = new RemoveLineBreaksClass();

            $this->data = $output->get_data( $this->text, $this->para_option );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Remove Line Breaks';
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
