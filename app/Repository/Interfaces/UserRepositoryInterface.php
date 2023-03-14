<?php


namespace App\Repository\Interfaces;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $attributes);

    public function find($id);

    public function update($id, array $attributes);

    public function delete($id);

}
