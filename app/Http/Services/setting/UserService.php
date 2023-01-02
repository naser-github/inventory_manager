<?php

namespace App\Http\Services\setting;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return User::query()->with(['profile'])->orderBy('name', 'ASC')->get();
    }

    /**
     * @return object|null
     */
    public function findByAuthId(): object|null
    {
        return User::query()->where('id', Auth::id())->first();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return User::query()
            ->where('id', $payload)
            ->first();
    }

    /**
     * @param $payload
     * @return object|null
     * WPR means with profile & role table
     */
    public function findByIdWPR($payload): object|null
    {
        return User::query()
            ->with(['profile', 'roles'])
            ->where('id', $payload)
            ->first();
    }

    /**
     * @param $payload
     * @param $password
     * @return User
     */
    public function store($payload): User
    {
        $user = new User();
        $user->name = $payload['first_name'] . " " . $payload['last_name'];
        $user->email = $payload['email'];
        $user->password = Hash::make($payload['password']);
        $user->status = $payload['status'];
        $user->save();

        return $user;
    }

    /**
     * @param $userId
     * @param $userPhone
     * @return void
     */
    public function storeProfile($userId, $userPhone): void
    {
        $profile = new UserProfile();
        $profile->user_id = $userId;
        $profile->phone = $userPhone;
        $profile->save();
    }

    /**
     * @param $user
     * @param $payload
     * @return void
     */
    public function update($user, $payload): void
    {
        $user->name = $payload['name'];
        $user->email = $payload['email'];
        if ($payload['password'] != null)
            $user->password = $payload['password'];
        $user->status = $payload['status'];
        $user->save();
    }


    public function updateProfile($userId, $payload): void
    {
        $profile = UserProfile::query()->where('user_id', $userId)->first();

        $profile->phone = $payload;
        $profile->save();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function userData($payload): object|null
    {
        return User::query()->with(['profile', 'roles'])->where('id', $payload)->first();
    }

}
