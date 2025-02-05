<?php

//extends \Kernel\Controller\AbstractController

class RandomController
{
    // Service
    private $generator;

    // DataStorage
    private $storage;

    public function __construct($generator, $storage) {
        $this->generator = $generator;
        $this->storage = $storage;
    }

    public function random(): void
    {
        $number = $this->generator->generate();
        $id = uniqid();

        $this->storage->save($id, $number);

        $this->json(['id' => $id, 'number' => $number]);
    }

    public function get(array $params): void
    {
        if (!isset($params['id'])) {
            $this->json(['error' => 'id is required'], 400);
        }

        $id = $params['id'];
        $number = $this->storage->get($id);

        if ($number === null) {
            $this->json(['error' => 'Number not found'], 404);
        }

        $this->json(['id' => $id, 'number' => $number]);
    }

    // Должно быть в AbstractController
    private function json(array $data, int $status = 200): never
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}