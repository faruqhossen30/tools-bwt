<?php 

namespace App\Classes;
use App\Models\Admin\Proxy;
use App\Models\Admin\General;
use Illuminate\Support\Arr;

class YoutubeThumbnailDownloaderClass {

    public function get_the_video_thumbnail($resolutions, $videoID, &$data = array())
    {

        if ( !empty($resolutions[0]) ) {

            $url = "https://i.ytimg.com/vi/$videoID/$resolutions[0].jpg";            

            if ( $this->get_header_code($url) !== 200) {

                array_splice($resolutions, 0, 1);

                $this->get_the_video_thumbnail( $resolutions, $videoID, $data );

            } else {

                    $i = 5 - count($resolutions);
                    
                    $token['url']      = $url;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . $resolutions[0];
                    $token['type']     = 'jpg';
                    $dlLink            = url('/') . '/dl.php?token=' . $this->encode( json_encode($token) );

                    switch ( $resolutions[0] ) {

                        case 'maxresdefault':
                                $resolution = __('HD (1280x720)');
                            break;

                        case 'sddefault':
                                $resolution = __('SD (640x480)');
                            break;

                        case 'hqdefault':
                                $resolution = __('High (480x360)');
                            break;

                        case 'mqdefault':
                                $resolution = __('Medium (320x180)');
                            break;

                        case 'default':
                                $resolution = __('Default (120x90)');
                            break;

                        default:
                            break;
                    }

                    $data[$i]['url']        = $dlLink;
                    $data[$i]['resolution'] = $resolution;

                    array_splice($resolutions, 0, 1);

                    $this->get_the_video_thumbnail( $resolutions, $videoID, $data );
                }

        }

        return $data;

    }

	public function get_data($link)
	{

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $link, $videoID);

        $resolutions = array('maxresdefault', 'sddefault', 'hqdefault', 'mqdefault', 'default');
        
        return $this->get_the_video_thumbnail($resolutions, $videoID[1]);

	}

    function encode($pData)
    {
        $encryption_key = 'themeluxurydotcom';

        $encryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
          
        $encryption = openssl_encrypt($pData, $ciphering, $encryption_key, 0, $encryption_iv);

        return $encryption;
    }

    function get_header_code($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, $this->get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
        }
        //End::Proxy
        //
        $rt = curl_exec($ch);
        $info = curl_getinfo($ch);
        return $info["http_code"];
    }

    function get_proxy_type($type)
    {
        switch ($type) {
            case 'https':
                $type = CURLPROTO_HTTPS;
                break;
            case 'socks4':
                $type = CURLPROXY_SOCKS4;
                break;
            case 'socks5':
                $type = CURLPROXY_SOCKS5;
                break;
            default:
                $type = CURLPROXY_HTTP;
                break;
        }
        return $type;
    }

}