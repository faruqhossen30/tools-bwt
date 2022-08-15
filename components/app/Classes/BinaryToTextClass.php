<?php 

namespace App\Classes;

class BinaryToTextClass {

	public function get_data($binary)
	{

        try {
            
            $binaries = explode(' ', $binary);
         
            $string = null;
            foreach ($binaries as $binary) {
                $string .= pack('H*', dechex(bindec($binary)));
            }

            $data['text'] = $string;

            return $data;

        } catch (\Exception $e) {
            
        }


	}
}