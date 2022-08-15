<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\WordCounterClass;
use DateTime;

class WordCounter extends Component
{

    public $text;
    public $words, $characters, $characters_with_spaces , $paragraphs;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.word-counter');
    }


    public function onWordCounter(){

        $this->validate([
            'text'        => 'required'
        ]);

        $this->data = null;

        try {

            $output = new WordCounterClass();

            $this->data = $output->get_data( $this->text );

        } catch (\Exception $e) {
            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Word Counter';
            $history->client_ip  = request()->ip();

            $response = Http::get('http://ip-api.com/json/'.request()->ip().'?fields=status,country,countryCode,query');

            if ( $response['status'] == 'success' ) {
                $history->flag       = strtolower( $response['countryCode'] );
                $history->country    = $response['country'];
            }

            $history->created_at = new DateTime();
            $history->save();
        }
        //

    }

}
