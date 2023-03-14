<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
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
        $this->model = new User();
    }

    /**
     * @param $sort
     * @return mixed
     */
    public function all($sort = "ASC")
    {
        return $this->model->orderBy('sort', $sort)->get();
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
     * @param $request
     * @return array
     */
    public function getPagination($request)
    {
        $query = $this->model;
        if (!empty($request->date)) {
            $startEndDate = explode("to", $request->date);
            $start = Carbon::parse($startEndDate[0])->toDateString();
            $end = Carbon::parse($startEndDate[1])->toDateString();

            $query = $query->where(function ($queryFilter) use ($start, $end) {
                $queryFilter->whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end);
            });
        }
        if ($request->sSearch != '') {
            $keyword = $request->sSearch;

            $query = $query->when($keyword != '', function ($q) use ($keyword) {
                return $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
        }
        //Sort of datatable in coloumnwise
        $columnIndex = $request['iSortCol_0'];
        $order = $request['sSortDir_0'];
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'name',
            3 => 'email',
        );
        $columnName = $columns[$columnIndex];
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;

        $totalCount = $query->count();

        //check limit and offset
        $query = $query->when(
            ($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        $results = $query->orderBy($columnName, $order)->get();

        return array("results" => $results, "totalCount" => $totalCount);
    }


    /**
     * @param $ids
     * @return mixed
     */
    public function getByUserIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }
}
