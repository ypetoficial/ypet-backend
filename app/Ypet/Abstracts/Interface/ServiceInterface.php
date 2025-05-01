<?php

namespace App\Ypet\Abstracts\Interface;

interface ServiceInterface
{
    public function all();

    public function find($id);

    public function save(array $data);

    public function firstOrCreate(array $params);

    public function update($id, array $data);

    public function updateOrCreate(array $data);

    public function delete($id);
}
