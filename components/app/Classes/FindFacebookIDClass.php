<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\ApiKeys;
use App\Models\Admin\Proxy;

class FindFacebookIDClass {

	public function get_data($link)
	{
        $api_key = ApiKeys::findOrFail(1);

        if ( !empty($api_key->facebook_cookies) ) {

            $get_source = $this->fb_get_contents($link, $api_key->facebook_cookies);

            preg_match('/"entity_id":"(.*?)"/', $get_source, $matchID);

            preg_match('/"userID":"(.*?)"/', $get_source, $matchUserID);

            if ( !empty($matchID[1]) ) {

                $data['thumbnail'] = 'https://graph.facebook.com/'.$matchID[1].'/picture?width=500';

                $data['id'] = $matchID[1];
                
                return $data;
     
            }
            else if ( !empty($matchUserID[1]) ) {

                $data['thumbnail'] = 'https://graph.facebook.com/'.$matchUserID[1].'/picture?type=large&width=500&height=500&access_token=6628568379%7Cc1e620fa708a1d5696fb991c1bde5662';

                $data['id'] = $matchUserID[1];
                
                return $data;
     
            }
            else {

                $data['thumbnail'] = url('assets/img/no-thumb.jpg');

                $data['id'] = 'N/a';

                return $data;
     
            }

        } else{

            session()->flash('status', 'error');
            session()->flash('message', 'Invalid Cookies!');
            return;
        }

	}

    function fb_get_contents($link, $cookie)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'authority: www.facebook.com',
            'cache-control: max-age=0',
            'sec-ch-ua: "Google Chrome";v="89", "Chromium";v="89", ";Not A Brand";v="99"',
            'sec-ch-ua-mobile: ?0',
            'upgrade-insecure-requests: 1',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'sec-fetch-site: none',
            'sec-fetch-mode: navigate',
            'sec-fetch-user: ?1',
            'sec-fetch-dest: document',
            'accept-language: en-GB,en;q=0.9,tr-TR;q=0.8,tr;q=0.7,en-US;q=0.6',
            'cookie: ' . $cookie
        ));

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
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
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