<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\UserRepository;
use App\Service\AdminUserService;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\AdminAddUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var AdminUserService
     */
    protected $adminUserService;
    
    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param AdminUserService $adminUserService
     */
    public function __construct(UserRepository $userRepository, AdminUserService $adminUserService)
    {
        $this->userRepository = $userRepository;
        $this->adminUserService = $adminUserService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.list_user');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pagination(Request $request)
    {
        $data =  $this->adminUserService->getUserPagination($request);

        return json_encode($data);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|string|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function usersListDownload(Request $request)
    {
        try {
            $data = $this->userRepository->getByUserIds($request->user_ids);
            foreach ($data as $list) {
                $result[] = array(
                    'Name' => $list->name,
                    'Email' => $list->email,
                );
            }
            $fileName = "users" . date("mdY");
            return (new FastExcel(collect($result)))->download($fileName.".xlsx");
        } catch (\Exception $e) {
            Log::error("downloadusers:" . $e);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addUser()
    {
        return view('admin.add_user');
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|string|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function storeUser(AdminAddUserRequest $request)
    {
        try {
            $attributes = $request->validated();
            $this->userRepository->create($attributes);
            return redirect(route('admin.users'))->with('success', 'user added succesfully.');
        } catch (\Exception $e) {
            Log::error("downloadusers:" . $e);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data = $this->userRepository->find($id);
        return view('admin.edit_user', compact('data'));
    }

    /**
     * @param CreateRoleRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AdminUpdateUserRequest $request)
    {
        try {
            $attributes = $request->validated();
            $this->userRepository->update($attributes['id'], $attributes);
            return redirect(route('admin.users'))->with('success', 'user updated succesfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return redirect(route('admin.users'))->with('success', 'user deleted succesfully.');
        } catch (\Exception $e) {
            Log::error("role_destroy:", [$e->getMessage()]);
            return back()->with('error', $e->getMessage());
        }
    }

}
