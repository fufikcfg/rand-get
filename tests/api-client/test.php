<?php

class ApiClient {
    private string $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    private function request($endpoint, $params = []): array
    {
        $url = sprintf(
            '%s%s?%s', $this->baseUrl, $endpoint, http_build_query($params)
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ['status' => $httpCode, 'response' => json_decode($response, true)];
    }

    public function random(): array
    {
        return $this->request('/random');
    }

    public function get($id): array
    {
        return $this->request('/get', ['id' => $id]);
    }
}

$client = new ApiClient('http://localhost:8000');
$response = $client->random();
print_r($response);

$getResponse = $client->get($response['response']['id']);
print_r($getResponse);