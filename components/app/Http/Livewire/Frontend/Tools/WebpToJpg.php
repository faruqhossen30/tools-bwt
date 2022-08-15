<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use DateTime;
use App\Models\Admin\General;
use File;
use Image;
use Illuminate\Support\Facades\Storage;

class WebpToJpg extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.webp-to-jpg');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    public function onWebpToJpg(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'remote_url' => 'required|url'
            ]); 
        }
        else {
            $this->validate([
                'local_image' => 'required|mimes:webp|max:5120', 
            ]);
        }

        $this->data = null;

        try {

            if ( $this->convertType == 'remoteURL') {

                $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

                $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

                Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
       
                $imageLink = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
            }
            else {
                
                $fileNameTemp = $this->local_image->store('livewire-tmp');

                $imageLink = asset('components/storage/app') . '/' . $fileNameTemp;
            }
            
            if ( pathinfo( $imageLink, PATHINFO_EXTENSION) == 'webp' ) {

                $img = Image::make( $imageLink )->encode('jpg');

                $fileName = time() . '.jpg';

                $img->save( storage_path('app/livewire-tmp/') . $fileName );

                $temp_url  = asset('components/storage/app/livewire-tmp/' . $fileName);

                $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'url' => $temp_url, 'fileName' => General::first()->prefix . $fileName ]);

            } else {

                $this->addError('error', __('The image must be a file of type: webp.'));

            }

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'WebP to JPG';
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
