<?php

class DataStorage
{
    private string $file;

    public function __construct($file = APP_PATH.'/storage/data.json')
    {
        $this->file = $file;

        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function save(string $id, int $number): void
    {
        $data = json_decode(file_get_contents($this->file), true);
        $data[$id] = $number;
        file_put_contents($this->file, json_encode($data));
    }

    public function get(string $id): ?int
    {
        $data = json_decode(file_get_contents($this->file), true);
        return $data[$id] ?? null;
    }
}