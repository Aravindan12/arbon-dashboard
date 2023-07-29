<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAddUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    protected $userRepository;
    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param AdminUserService $adminUserService
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|string|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function storeUser(AdminAddUserRequest $request)
    {
        try {
            $attributes = $request->validated();
            $user = $this->userRepository->create($attributes);
            return response()->json(['status' => true, 'data' => $user, 'message' => 'user added successfully']);
        } catch (\Exception $e) {
            Log::error("add users:" . $e);
            return response()->json(['status' => false, 'data' => [], 'message' => "can't add user"]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getUser($id)
    {
        $data = $this->userRepository->find($id);
        return response()->json(['status' => true, 'data' => $data, 'message' => 'user details']);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getUsers()
    {
        $data = $this->userRepository->all();
        return response()->json(['status' => true, 'data' => $data, 'message' => 'all user details']);
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
            $user = $this->userRepository->update($attributes['id'], $attributes);
            return response()->json(['status' => true, 'data' => $user, 'message' => 'user updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'data' => [], 'message' => "can't update user"]);
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
            return response()->json(['status' => true, 'data' => [], 'message' => 'user deleted successfully']);
        } catch (\Exception $e) {
            Log::error("role_destroy:", [$e->getMessage()]);
            return response()->json(['status' => false, 'data' => [], 'message' => "can't delete user"]);
        }
    }
}
