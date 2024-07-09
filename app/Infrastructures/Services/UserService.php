<?php

namespace App\Infrastructures\Services;

use App\Dictionaries\Users\UserTypeDictionary;
use Exception;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Infrastructures\Repositories\RoleRepository;
use App\Infrastructures\Repositories\UserRepository;
use App\Infrastructures\Repositories\CustomerRepository;

class UserService
{
    protected $userRepository;
    protected $roleRepository;
    protected $customerRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    public function getAll()
    {
        return $this->userRepository->all();
    }

    public function craete($request)
    {
        // Save photo profile
        $photoProfile = storeFileMedia($request['photo_profile_file'], 'users');
        $request['photo_profile'] = $photoProfile;

        // Create collection
        $collection = new Collection($request);

        // Create user
        $userDataArray = ['username', 'first_name', 'last_name', 'email', 'phone_number', 'photo_profile', 'user_type', 'password', 'is_active'];
        $userData = $collection->only($userDataArray)->toArray();
        $newUser = $this->userRepository->create($userData);

        // Assign user role
        $newUser->assignRole($newUser->user_type);

        return $newUser;
    }

    public function update(User $user, $request)
    {
        // Remove null data
        $request = arrayFilterNullData($request);

        // If photo profile exist
        if (array_key_exists('photo_profile_file', $request)) {
            $request['photo_profile'] = storeFileMedia($request['photo_profile_file'], 'users');
        }

        // Create collection
        $collection = new Collection($request);

        // Update user
        $userDataArray = ['username', 'first_name', 'last_name', 'email', 'phone_number', 'photo_profile', 'user_type', 'password', 'is_active'];
        $userData = $collection->only($userDataArray)->toArray();
        $updatedUser = $this->userRepository->updateById($user->id, $userData);

        // Assign user role
        $updatedUser->assignRole($updatedUser->user_type);

        return $updatedUser;
    }

    public function deactivate(User $user)
    {
        if (auth()->user()->can('user-deactivate')) {
            $this->userRepository->deactivate($user->id);
        } else {
            throw new Exception('You are not allowed deactivate user');
        }
    }

    public function activate(User $user)
    {
        if (auth()->user()->can('user-activate')) {
            $this->userRepository->activate($user->id);
        } else {
            throw new Exception('You are not allowed activate user');
        }
    }
}
