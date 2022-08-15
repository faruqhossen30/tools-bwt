<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\General;

class Base64ToImageClass {

	public function get_data( $base64_string )
	{

		$imageType = explode('/', mime_content_type($base64_string))[1];

		if( $imageType == 'jpeg' ) $imageType = 'jpg';
		
		$fileName = General::first()->prefix . time() . '.' . $imageType;

		if (preg_match('/^data:image\/(\w+);base64,/', $base64_string)) {

		    $base64_data = substr($base64_string, strpos($base64_string, ',') + 1);

		    $base64_data = base64_decode($base64_data);

	        Storage::disk('local')->put('livewire-tmp/' . $fileName, $base64_data);

	        $temp_url = asset('components/storage/app/livewire-tmp/' . $fileName);

			$data['fileName'] = $fileName;

			$data['url']      = $temp_url;

	        return $data;
		}

	}
}