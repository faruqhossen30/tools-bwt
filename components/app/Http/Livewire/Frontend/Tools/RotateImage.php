<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DateTime;
use App\Models\Admin\General;
use File;

class RotateImage extends Component
{

    protected $listeners = ['onRotateImage'];
    public $convertType = 'localPhoto';
    public $remote_url;

    public function render()
    {
        return view('livewire.frontend.tools.rotate-image');
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    public function onAddRemoteURL()
    {
        $this->validate([
            'remote_url' => 'required|url'
        ]);
        
        try {

            $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

            $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

            Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
   
            $temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);

            $fileType = File::mimeType( storage_path('app/livewire-tmp/') . $fileNameTemp );

            $this->dispatchBrowserEvent('onSetRemoteURL', ['url' => $temp_url, 'fileName' => $fileName, 'fileType' => $fileType ]);

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }
    }

    public function onRotateImage( $blobURL, $fileName ){

        try {
            
             $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'blobURL' => $blobURL, 'fileName' => General::first()->prefix . $fileName ]);

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Rotate Image';
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
