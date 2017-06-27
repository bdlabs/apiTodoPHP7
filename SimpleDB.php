<?php

class SimpleDB
{
    private $filename;
    private $records;

    private function load(): bool
    {
        if (!file_exists($this->filename)) {

        }

        $this->records = json_decode(file_get_contents($this->filename), true);
        if (is_null($this->records)) {
            $this->records = array();
        }
        return true;
    }

    private function save(): bool
    {
        file_put_contents($this->filename, json_encode($this->records));
        return true;
    }

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->load();
    }

    public function insert(array $record): bool
    {
        $this->records[] = $record;
        $this->save();
        return true;
    }

    public function update(int $id, array $record): bool
    {
        $this->records[$id] = $record;
        $this->save();
        return true;
    }

    public function select(int $id = -1): array
    {
        if ($id != -1) {
            if (isset($this->records[$id])) {
                return $this->records[$id];
            }

            return array();
        }
        return $this->records;
    }

    public function delete(int $id): bool
    {
        unset($this->records[$id]);
        $this->save();
        return true;
    }

}
