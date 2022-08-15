<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DateTime;
use App\Models\Admin\General;
use File;
use Image;

class ImageResizer extends Component
{

   protected $listeners = ['onImageResizer', 'onSetPercentage', 'onSetImageWidthHeight', 'onImageCropper'];
    public $convertType = 'localImage';
    public $remote_url;
    public $percentage = 0;
    public $imageWidth; 
    public $imageHeight; 
    public $imageWidthFinal;
    public $imageHeightFinal;
    public $imageData;
    public $image_format = 'jpg';

    public function mount()
    {
        $this->imageWidth  = Image::make( asset('assets/img/preview-image.jpg') )->width();
        $this->imageHeight = Image::make( asset('assets/img/preview-image.jpg') )->height();
        $this->imageData   = asset('assets/img/preview-image.jpg');
    }

    public function render()
    {
        return view('livewire.frontend.tools.image-resizer');
    }

    /**
     * -------------------------------------------------------------------------------
     *  Convert Type
     * -------------------------------------------------------------------------------
    **/
    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    /**
     * -------------------------------------------------------------------------------
     *  Set Image Width x Height
     * -------------------------------------------------------------------------------
    **/
    public function onSetImageWidthHeight( $data ){
        $this->imageWidth       = Image::make( $data )->width();
        $this->imageHeight      = Image::make( $data )->height();
        $this->imageWidthFinal  = $this->imageWidth;
        $this->imageHeightFinal = $this->imageHeight;
        $this->imageData        = $data;
    }

    /**
     * -------------------------------------------------------------------------------
     *  Set Percentage
     * -------------------------------------------------------------------------------
    **/
    public function onSetPercentage($value)
    {
        $this->percentage       = $value;
        $this->imageWidthFinal  = round( $this->imageWidth * $value / 100 );
        $this->imageHeightFinal = round( $this->imageHeight * $value / 100 );
    }

    /**
     * -------------------------------------------------------------------------------
     *  Add Remote URL
     * -------------------------------------------------------------------------------
    **/
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

    /**
     * -------------------------------------------------------------------------------
     *  Image Resizer
     * -------------------------------------------------------------------------------
    **/
    public function onImageResizer($imageData){

        try {

            if (preg_match('/^data:image\/(\w+);base64,/', $imageData)) {

                $imageType = explode('/', mime_content_type($imageData))[1];

                if( $imageType == 'jpeg' ) $imageType = 'jpg';
                
                $fileName = time() . '.' . $imageType;

                $base64_data = substr($imageData, strpos($imageData, ',') + 1);

                $base64_data = base64_decode($base64_data);

                Storage::disk('local')->put('livewire-tmp/' . $fileName, $base64_data);

                $imageLink = asset('components/storage/app/livewire-tmp/' . $fileName);

            }

            $img = Image::make( $imageLink )->encode(''.$this->image_format.'', 100);

            $fileName = time() . '.' . $this->image_format;

            $img->save( storage_path('app/livewire-tmp/') . $fileName );

            $temp_url  = asset('components/storage/app/livewire-tmp/' . $fileName);

            $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'url' => $temp_url, 'fileName' => General::first()->prefix . $fileName ]);

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Image Resizer';
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
