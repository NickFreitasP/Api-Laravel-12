<?php
 namespace App\Services\Closeds;

use App\Exceptions\ModelNotFoundException ;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Traits\ApiResponses;
use Symfony\Component\HttpFoundation\Response;

class UserService{

    use ApiResponses;

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
    public function show(int $id) : User

    {
       return $this->findlWithMessage($this->user,$id,"User not found");
    }

    // Create a new user
    public function store(array $data) : User
    {

        return $this->user->create($data);
    }

    // Update data user
    public function update(int $id , array $data) : User
    {
        // Find the user
        $user = $this->show($id);

        // Update data user
        $user->update($data);

        return $user;

    }

    public function delete( int $id) : bool
    {

        // Find User
        $user = $this->show($id);

        return $user->delete();


    }

 };
