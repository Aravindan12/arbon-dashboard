<?php

namespace App\Service;

use App\Repository\Eloquent\UserRepository;


class AdminUserService
{
    public $userRepository;

    /**
     * AdminUserService constructor
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param $request
     * @return array
     */
    public function getUserPagination($request)
    {
        $data = $this->userRepository->getPagination($request);

        $offset = $request->iDisplayStart;
        $results = $data['results'];
        $totalCount = $data['totalCount'];
        $column = array();

        foreach ($results as $list) {
            $col['checkbox'] = '<input type="checkbox" name="user_checkbox[]" value="'.$list->id.'">';
            $col['id'] = $offset + 1;
            $col['name'] = $list->name;
            $col['email'] = $list->email;

            array_push($column, $col);
            $offset++;
        }
        $data['sEcho'] = $request->sEcho;
        $data['aaData'] = $column;
        $data['iTotalRecords'] = $totalCount;
        $data['iTotalDisplayRecords'] = $totalCount;

        return $data;
    }
}
