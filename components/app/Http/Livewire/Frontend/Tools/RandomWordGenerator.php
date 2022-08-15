<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RandomWordGeneratorClass;
use DateTime;

class RandomWordGenerator extends Component
{
    protected $listeners = ['onSetInList', 'onClearInList'];
    public $word_type    = 'all_words';
    public $number       = 5;
    public $data         = [];
    public $temp_data    = [];

    public function render()
    {
        return view('livewire.frontend.tools.random-word-generator');
    }

    public function onSetInList($value)
    {
        array_push($this->data, $value);
    }

    public function onClearInList()
    {
        $this->data = [];
    }

    public function onRandomWordGenerator(){

        $this->temp_data = null;

        try {

            $output = new RandomWordGeneratorClass();

            $this->temp_data = $output->get_data( $this->word_type, $this->number );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Random Word Generator';
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
