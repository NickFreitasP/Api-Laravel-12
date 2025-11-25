<?php
 namespace App\Services\Closeds;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

 class UserService{


    private $user;

    // Instance user model
    public function __construct(User $user)
    {

        $this->user = $user;
    }

    // Get all users
    public function get(): Collection
    {
        return $this->user->all();
    }


    // Get a user by id
    public function show(int $id) : ?User
    {
        $user = $this->user->findOrFail($id);
        return $user;
    }

    // Create a new user
    public function store(array $data) : ?User
    {

        return $this->user->create($data);
    }

    // Update data user
    public function update(int $id , array $data) : ?User
    {
        // Find the user
        $user = $this->show($id);

        // Update data user
        $user->update($data);

        return $user->fresh();

    }

    public function delete( int $id) : bool
    {

        // Find User
        $user = $this->show($id);

        return $user->delete();


    }

 };
