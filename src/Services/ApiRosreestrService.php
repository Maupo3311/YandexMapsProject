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
     * @param string $token User token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param array $cadNumbers Array cad numbers.
     * @return array
     */
    public function getDataByCadNumbers(array $cadNumbers)
    {
        $data = [];
        foreach ($cadNumbers as $cadNumber) {
            $data[] = $this->getDataByCadNumber($cadNumber);
        }

        return $data;
    }

    /**
     * @param string $cadNumber Cad number.
     * @return bool|string
     */
    public function getDataByCadNumber(string $cadNumber)
    {
        $headers = [
            "Token: {$this->token}",
            'content-type: application/x-www-form-urlencoded',
            'Host: apirosreestr.ru',
            'POST /api/cadaster/search HTTP/1.1',
        ];

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