<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\IcoToPngClass;
use Livewire\WithFileUploads;
use DateTime;

class IcoToPng extends Component
{
    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.ico-to-png');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    public function onIcoToPng(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'remote_url' => 'required|url'
            ]); 
        }
        else {
            $this->validate([
                'local_image' => 'required|mimes:ico|max:5120', 
            ]);
        }

        $this->data = null;

        try {

            $output = new IcoToPngClass();

            if ( $this->convertType == 'remoteURL') {
                $temp_url = $this->remote_url;
            }
            else {
                $temp_path = $this->local_image->store('livewire-tmp');
                $temp_url = asset('components/storage/app/' . $temp_path);
            }
            
            if ( pathinfo( $temp_url, PATHINFO_EXTENSION) == 'ico') {

                $this->data = $output->get_data( $temp_url );

            } else {

                $this->addError('error', __('The image must be a file of type: ico.'));

            }

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'ICO to PNG';
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
