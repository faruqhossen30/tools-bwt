<?php 

namespace App\Classes;

class WordCounterClass {

	public function get_data($text)
	{

        $data['words']                  = str_word_count($text);
        $data['characters']             = strlen( preg_replace('/\s+/', '', $text) );
        $data['characters_with_spaces'] = strlen($text);
        $data['paragraphs']             = substr_count(preg_replace("/\n+/", "\n", $text), "\n") + 1;
        
        return $data;

	}
}