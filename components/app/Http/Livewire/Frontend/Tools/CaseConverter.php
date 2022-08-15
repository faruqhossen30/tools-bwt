<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\CaseConverterClass;
use DateTime;

class CaseConverter extends Component
{

    public $text;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.case-converter');
    }

    public function onSentenceCase()
    {
        $this->validate([
            'text'   => 'required'
        ]);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'sentenceCase' );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Case Converter';
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

    public function onLowerCase()
    {
        $this->validate([
            'text'   => 'required'
        ]);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'lowerCase' );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Case Converter';
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

    public function onUpperCase()
    {
        $this->validate([
            'text'   => 'required'
        ]);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'upperCase' );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Case Converter';
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

    public function onCapitalizedCase()
    {
        $this->validate([
            'text'   => 'required'
        ]);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'capitalizedCase' );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Case Converter';
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
