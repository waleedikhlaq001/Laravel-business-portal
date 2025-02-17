<?php

    // Your function go here
    function currencyConverter($req){

        $details = json_decode(file_get_contents("http://ipinfo.io"),true);
        // echo $details->country;
        $ip = $details['ip'];
        $ip = $req->getClientIp();

        $geo = file_get_contents("https://api.timanetglobaltech.com/?ip=".$ip."&time=".date('H:i:s'));
        // print_r($geo);
        $geo_data = json_decode($geo, true);

        if($geo_data['country'] == false || $geo_data['country'] != 'Nigeria'){
            $data['currency_symbol'] = '$';
            $data['exchange_rate'] = '1';

            $geo_data = $data;
        }

        return $geo_data;
    }

?>
