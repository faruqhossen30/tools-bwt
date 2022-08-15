<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;

class IpAddressLookupClass {

	public function get_data($ip)
	{
        $response = Http::get('http://ip-api.com/json/'.$ip.'?fields=status,message,country,countryCode,regionName,city,zip,lat,lon,timezone,currency,isp,org,as,query');

        if ( $response['status'] == 'success' ) {

			$data['country']     = $response['country'];
			$data['countryCode'] = $response['countryCode'];
			$data['regionName']  = $response['regionName'];
			$data['city']        = $response['city'];
			$data['zip']         = $response['zip'];
			$data['lat']         = $response['lat'];
			$data['lon']         = $response['lon'];
			$data['timezone']    = $response['timezone'];
			$data['currency']    = $response['currency'];
			$data['isp']         = $response['isp'];
			$data['as']          = $response['as'];
			$data['query']       = $response['query'];

        } else $data = null;

        return $data;

	}
}