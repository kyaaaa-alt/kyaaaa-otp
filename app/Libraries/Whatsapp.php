<?php namespace App\Libraries;

class Whatsapp {
    public function __construct() {
        $this->token = '7tD2qLhX3W1Y4ZVKoPE8F9GJrBM5Na6C';
        $this->wa_server = 'http://192.168.0.210:8300';
        $this->qr = $this->wa_server . "/qr?token={$this->token}";
        $this->send = $this->wa_server . "/send-message?token={$this->token}";
        $this->group_send = $this->wa_server . "/group-message?token={$this->token}";
//        $this->qr = "http://localhost:8000/qr?token={$this->token}";
//        $this->send = "http://localhost:8000/send-message?token={$this->token}";
//        $this->group_send = "http://localhost:8000/group-message?token={$this->token}";
    }
    public function get_qr() {
        if (empty($this->token) || is_null($this->token)) {
            $response = new \stdClass();
            $response->message = 'Token not found';
            return $response;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $this->qr,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        return json_decode($response);
    }
    public function send_message($number, $message) {
        if (empty($this->token) || is_null($this->token)) {
            $response = new \stdClass();
            $response->message = 'Token not found';
            return $response;
        }

        $data = [
            'number' => $number,
            'message' => $message
        ];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $this->send,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        return json_decode($response);
    }
    public function group_message($group, $message) {
        if (empty($this->token) || is_null($this->token)) {
            $response = new \stdClass();
            $response->message = 'Token not found';
            return $response;
        }

        $data = [
            'number' => $group,
            'message' => $message
        ];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $this->group_send,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        return json_decode($response);
    }
}