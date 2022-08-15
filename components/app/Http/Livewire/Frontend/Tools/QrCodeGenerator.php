<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\QrCodeGeneratorClass;
use Livewire\WithFileUploads;
use DateTime;

class QrCodeGenerator extends Component
{
    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $text;
    public $image_size = 300;
    public $custom_logo = false;
    public $remote_url;
    public $local_image;
    public $logo_size = 50;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.qr-code-generator');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }
    
    // QR Code with Logo
    private function qrCodeWithLogo(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'text'       => 'required',
                'remote_url' => 'required|url',
                'logo_size'  => 'required|numeric|min:10|max:1000',
                'image_size' => 'required|numeric|min:50|max:6000'
            ]); 
        }
        else {
            $this->validate([
                'text'       => 'required',
                'local_image' => 'required|image|max:5120',
                'logo_size'  => 'required|numeric|min:10|max:1000',
                'image_size' => 'required|numeric|min:50|max:6000'
            ]);
        }

        $this->data = null;

        try {

            $output = new QrCodeGeneratorClass();

            if ( $this->convertType == 'remoteURL') {
                $this->logo_url = $this->remote_url;
            }
            else {
                $temp_path = $this->local_image->store('livewire-tmp');
                $this->logo_url = asset('components/storage/app/' . $temp_path);
            }
            
            $this->data = $output->get_data( $this->text, $this->image_size, $this->logo_size, $this->logo_url );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

    }

    // QR Code with Logo
    private function qrCodeWithoutLogo(){

        $this->validate([
            'text'       => 'required',
            'image_size' => 'required|numeric|min:50|max:6000'
        ]);

        $this->data = null;

        try {

            $output = new QrCodeGeneratorClass();

            $this->data = $output->get_data( $this->text, $this->image_size, $this->logo_size = '', $this->logo_url = '' );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

    }

    //QR Code
    public function onQrCodeGenerator(){


        if ( $this->custom_logo == true ) $this->qrCodeWithLogo();
        else $this->qrCodeWithoutLogo();

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'QR Code Generator';
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
