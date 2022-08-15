<?php 

namespace App\Classes;

class TextToBinaryClass {

	public function get_data($text)
	{

                $characters = str_split($text);

                $binary = [];

                foreach ($characters as $character) {

                        $data = unpack('H*', $character);
                        
                        $binary[] = base_convert($data[1], 16, 2);
                }
                 
                $data['text'] = implode(' ', $binary);

                return $data;

	}
}