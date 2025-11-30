<?php
 namespace App\Services\Closeds;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiResponses;

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
    public function show(int $id,string $message = "User not found") : User

    {
       return $this->findlWithMessage($this->user,$id,$message);
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
       $message =  'Não foi possível atualizar: usuário não encontrado';

        $user = $this->show($id,$message);

        // Update data user
        $user->update($data);

        return $user;

    }

    public function delete( int $id) : bool
    {
        // Find User

        $message = "Não foi possível deletar: usuário não encontrado";

        $user = $this->show($id,$message);

        return $user->delete();

    }

 };
