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
            $col['action'] = $this->getAction($list);

            array_push($column, $col);
            $offset++;
        }
        $data['sEcho'] = $request->sEcho;
        $data['aaData'] = $column;
        $data['iTotalRecords'] = $totalCount;
        $data['iTotalDisplayRecords'] = $totalCount;

        return $data;
    }

        /**
     * @param $list
     * @return string
     */
    public function getAction($list)
    {
        $response = ' <div class="dropdown actions">
                            <a href="#" data-toggle="dropdown" class="btn btn-floating"
                            aria-haspopup="true" aria-expanded="false">
                                ...
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.route('admin.users.edit', $list->id).'" class="dropdown-item">Edit</a>
                                <button class="dropdown-item" data-toggle="modal"
                                data-target="#delete_'.$list->id.'">Delete</button>
                            </div>
                        </div>';
        //dialog box
        $response .= ' <div class="modal margin_top_negative_100" id="delete_'.$list->id.'" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form method="GET" action="'.route('admin.users.delete', $list->id).'">
                                        <div class="modal-body">
                                            <span> Are you sure to Delete this role: '.$list->name.' ? </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close</button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
        return $response;
    }
}
