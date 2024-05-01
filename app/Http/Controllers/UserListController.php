<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserListRequest;
use App\Models\Phone;
use App\Models\UserList;
use Illuminate\Http\Request;


class UserListController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = UserList::query()->orderByDesc('id')->paginate(5);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserListRequest $request)
    {
        $data = $request->validated();

        $user = UserList::query()->create($data);

        $this->service->store($data, $user);

        return back()->with('status', 'Запис додано');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserList $userList)
    {
        return view('user.edit', compact('userList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserListRequest $request, UserList $userList)
    {
        $data = $request->validated();

        $this->service->update($data, $userList);

        $users = UserList::query()->orderBy('id', 'desc')->paginate(5);

        return view('user.index', compact('users'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserList $userList)
    {
        $data = UserList::query()->find($userList->id);
        $userList->phones()->delete();
        $data->delete();
        return back()->with('status', 'Запис видалено');
    }
}
