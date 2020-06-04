<?php

class MainApi
{
    public function get_state($postcode){
        $curl = curl_init();

        $data = [
            'postcode' => $postcode
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => URLROOT . 'api/get_state',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Api-Key: " . API_TOKEN,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($curl);

        return $response;
    }

    public function get_state_list(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => URLROOT . 'api/get_state_list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "Api-Key: " . API_TOKEN,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($curl);

        return $response;
    }
}