<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\PasswordGeneratorClass;
use DateTime;

class PasswordGenerator extends Component
{

    public $password_length = 6;
    public $uppercase = true;
    public $lowercase = true;
    public $numbers   = true;
    public $symbols   = true;

    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.password-generator');
    }

    public function onPasswordGenerator(){

        $this->data = null;

        try {

            $output = new PasswordGeneratorClass();

            $this->data = $output->get_data($this->password_length, $this->uppercase, $this->lowercase, $this->numbers, $this->symbols);

        } catch (\Exception $e) {
            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Password Generator';
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
