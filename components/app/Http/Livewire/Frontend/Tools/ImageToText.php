<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\ImageToTextClass;
use Livewire\WithFileUploads;
use DateTime;
use Illuminate\Support\Facades\Storage;

class ImageToText extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.image-to-text');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    public function onImageToText(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'remote_url' => 'required|url'
            ]); 
        }
        else {
            $this->validate([
                'local_image' => 'required|mimetypes:image/*|max:5120', 
            ]);
        }

        $this->data = null;

        try {

            $output = new ImageToTextClass();

            if ( $this->convertType == 'remoteURL') {

                $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

                $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

                Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
        
                $imagePath = storage_path('app/livewire-tmp/') . $fileNameTemp;

                $imageLink = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
            }
            else {

                $previewPath = $this->local_image->store('livewire-tmp');

                $imageLink = asset('components/storage/app/' . $previewPath);

                $imagePath = storage_path('app/') . $previewPath;
            }
            
            if ( pathinfo( $imageLink, PATHINFO_EXTENSION) == ('jpg'|| 'jpeg' || 'ico' || 'png' || 'webp' || 'bmp')) {

                $this->data = $output->get_data( $imagePath );

            } else {

                $this->addError('error', __('The image must be a file of type: jpg, jpeg, ico, png, webp, bmp.'));

            }

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Image to Text';
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
