<?php 

namespace App\Classes;

class CssBeautifierClass {

	public function get_data($code)
	{
		$code = explode('}', $code);
		$format_css = '';
		$br = "<br>";
		$tab = "\t";
		$new_line = "\n";
		$reg = '/\*.*?\*/';
		if(count($code)){
			foreach ($code as $key => $block_css) {
				if(!empty($block_css)){
					// $block_css = $block_css.'}';
					$block_css 	= trim($block_css);
					$seg 		= explode('{', $block_css);
					$classes 	= 	isset($seg[0]) ? $seg[0] :'';
					$properties =	isset($seg[1]) ? $seg[1] : '';
					$prop = '';
					if(!empty($properties)){
						
						$prop_ary = explode(';', $properties);
						if(!empty($prop_ary)){
							foreach ($prop_ary as $key => $prop_line) {
								$prop_line = trim($prop_line);
								if(!empty($prop_line)){

									$class_property = '';
									$prop_line_ary = explode(':', $prop_line);


									if(!empty($prop_line_ary)){
										$sub_prop_lt = isset($prop_line_ary[0]) ? trim($prop_line_ary[0]) : '';
										$sub_prop_rt = isset($prop_line_ary[1]) ? trim($prop_line_ary[1]) : '';
										$class_property .= ($sub_prop_lt != '' && $sub_prop_rt != '') ? $sub_prop_lt.': '.$sub_prop_rt.';' : '';
										
									}
									#prop

									$prop .= (!empty($class_property)) ? $new_line.$tab.$class_property : '';
								}
							}
						}
					}
					
					$format_css .= $new_line;
					$format_css .= $classes.' {';
					$format_css .= $prop;
					$format_css .= $new_line.' }'.$new_line;
				}
				
			}
		}

		$data['code'] = $format_css;
		
        return $data;
	}
}