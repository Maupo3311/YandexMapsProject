<?php

namespace App\Services;

class ApiRosreestrService
{
    /**
     * @var string
     */
    protected $token;

    /**
     * ApiRosreestrService constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getDataByCadNumber(string $cadNumber)
    {
        $headers = [
            "Token: {$this->token}",
            'Content-Type: application/json',
            'Host: apirosreestr.ru',
            'POST /api/cadaster/search HTTP/1.1',
        ];
        $query =

        $url = 'https://apirosreestr.ru/api/cadaster/search';
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "query={$cadNumber}&mode=normal&grouped=0");
        $returned = curl_exec($ch);
        curl_close($ch);

        return $returned;
    }
}