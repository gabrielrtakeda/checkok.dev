<?php

namespace Database\Driver\Interfaces;

interface DriverInterface
{
    public function insert(array $saveEntity);
    public function update(array $saveEntity);
    public function select($expression);
    public function delete($id);
}
