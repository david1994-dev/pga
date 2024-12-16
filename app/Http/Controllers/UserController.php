<?php
namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\FilterUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FilterUserRequest $request)
    {
        return new UserCollection($this->userService->index($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new UserResource($this->userService->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        return new UserResource($this->userService->update($id, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return new UserResource($this->userService->destroy($id));
    }
}
