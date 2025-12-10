<?php
 namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\Model;


class BaseService{

    use ApiResponses;

    protected ?Model $model;

    // Get all users
    public function get(): Collection
    {
        return $this->model->all();
    }

    // Get a user by id
    public function show(int $id,string $message = "User not found") : Model

    {
       return $this->findlWithMessage($this->model,$id,$message);
    }

    // Create a new user
    public function store(array $data) : Model
    {

        return $this->model->create($data);
    }

    // Update data user
    public function update(int $id , array $data) : Model
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

    public function setModel( String | Model $model ) : self
    {

        $this->model = $model instanceof Model ? $model : new $model();

        return $this;

    }



 };
