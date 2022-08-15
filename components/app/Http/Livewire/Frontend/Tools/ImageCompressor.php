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
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use ImageOptimizer;

class ImageCompressor extends Component
{

    use WithFileUploads;

    protected $listeners = ['onImageCropper'];
    public $convertType = 'localImage';
    public $remote_url;

    public function render()
    {
        return view('livewire.frontend.tools.image-compressor');
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
     *  Add Remote URL
     * -------------------------------------------------------------------------------
    **/
    public function onAddRemoteURL()
    {

        $this->validate([
            'remote_url' => 'required|url'
        ]);
        
        try {

            $fileName     = pathinfo($this->remote_url, PATHINFO_BASENAME);            

            $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

            Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
            
            $temp_url     = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);

            $fileType     = File::mimeType( storage_path('app/livewire-tmp/') . $fileNameTemp );

            $this->dispatchBrowserEvent('onSetRemoteURL', ['url' => $temp_url, 'fileName' => $fileName, 'fileType' => $fileType ]);

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  Format Size Units
     * -------------------------------------------------------------------------------
    **/
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    /**
     * -------------------------------------------------------------------------------
     *  Convert Base64 to Image
     * -------------------------------------------------------------------------------
    **/
    public function onImageCompressor(Request $request){

        try {

                $files = $request->file('file');

                foreach ($files as $file) {

                    $fileName = $file->getClientOriginalName();

                    $fileType = $file->getClientOriginalExtension();

                    //
                    $file->move(storage_path('app/livewire-tmp'), $fileName);

                    $oldFileSize = File::size( storage_path('app/livewire-tmp/') . $fileName );
                    
                    //
                    $newFileName = General::first()->prefix . time() . '.' . $fileType;

                    ImageOptimizer::optimize( storage_path('app/livewire-tmp/') . $fileName, storage_path('app/livewire-tmp/') . $newFileName);

                    $newFileSize = File::size( storage_path('app/livewire-tmp/') . $newFileName );

                    $saved = round( 100 - ($newFileSize / $oldFileSize * 100) );
                    
                    $data['success']  = true;
                    $data['status']   = 'Finished';
                    $data['old_size'] = $this->formatSizeUnits($oldFileSize);
                    $data['new_size'] = $this->formatSizeUnits($newFileSize);
                    $data['saved']    = $saved . '%';
                    $data['link']     = asset('components/storage/app/livewire-tmp/' . $newFileName);

                    return $data;

                }
                    
        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Image Compressor';
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
