<?php

namespace App\Repository\Eloquent;

use App\Models\Hero;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class HeroRepository implements UserRepositoryInterface
{

    /**
     * @var $model
     */
    protected $model;

    /**
     * OfferRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Hero();
    }

    /**
     * @param $sort
     * @return mixed
     */
    public function all($sort = "ASC")
    {
        return $this->model->orderBy('created_at', $sort)->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        $modelValue = $this->model->findOrFail($id);
        $modelValue->update($attributes);

        return $modelValue;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getByUserIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchByName($name)
    {
        return $this->model->where('name', 'like','%'.$name.'%')->get();
    }
}
