<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Classes\IcoToPngClass;
use Livewire\WithFileUploads;
use DateTime;
use App\Classes\VttToSrtClass;
use App\Models\Admin\General;

class VttToSrt extends Component
{
    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localFile';
    public $remote_url;
    public $local_file;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.vtt-to-srt');
    }

    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    public function onVttToSrt(){

        if ( $this->convertType == 'remoteURL') {
            $this->validate([
                'remote_url' => 'required|url'
            ]); 
        }
        else {
            $this->validate([
                'local_file' => 'required|max:5120', 
            ]);
        }

        $this->data = null;

        try {

            $output = new VttToSrtClass();

            if ( $this->convertType == 'remoteURL') {

                $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

                $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

                Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
       
                $temp_path = storage_path('app/livewire-tmp/') . $fileNameTemp;

                $temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
            }
            else {
                
                $fileNameTemp = $this->local_file->store('livewire-tmp');

                $renamed = str_replace('.txt', '.vtt', storage_path('app') . '/' . $fileNameTemp );

                rename( storage_path('app') . '/' . $fileNameTemp, $renamed);

                $temp_path = $renamed;

                $temp_url = str_replace('.txt', '.vtt', asset('components/storage/app') . '/' . $fileNameTemp );
            }
            
            //
            if ( pathinfo( $temp_url, PATHINFO_EXTENSION) == 'vtt') {

                $this->data = $output->get_data( $temp_path );

                $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadFile', 'url' => $this->data['url'], 'fileName' => General::first()->prefix . $this->data['fileName'] ]);

            } else {

                $this->addError('error', __('The image must be a file of type: vtt.'));

            }

        } catch (\Exception $e) {

            $this->addError('error', __($e));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'VTT to SRT';
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
