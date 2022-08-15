<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\Md5GeneratorClass;
use DateTime;

class Md5Generator extends Component
{
    public $text;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.md5-generator');
    }

    public function onMd5Generator(){

        $this->validate([
            'text'        => 'required'
        ]);

        $this->data = null;

        try {

            $output = new Md5GeneratorClass();

            $this->data = $output->get_data( $this->text );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'MD5 Generator';
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
