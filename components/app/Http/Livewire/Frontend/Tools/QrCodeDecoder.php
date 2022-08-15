<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\QrCodeDecoderClass;
use Livewire\WithFileUploads;
use DateTime;

class QrCodeDecoder extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.qr-code-decoder');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }
    
    public function onQrCodeDecoder(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'remote_url' => 'required|url'
            ]); 
        }
        else {
            $this->validate([
                'local_image' => 'required|image|max:5120', 
            ]);
        }

        $this->data = null;

        try {

            $output = new QrCodeDecoderClass();

            if ( $this->convertType == 'remoteURL') {
                $temp_url = $this->remote_url;
            }
            else {
                $temp_path = $this->local_image->store('livewire-tmp');
                $temp_url = asset('components/storage/app/' . $temp_path);
            }
            
            $this->data = $output->get_data( $temp_url );

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'QR Code Decoder';
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
