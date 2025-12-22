<?php
 namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BaseService{

    use ApiResponses;

    protected ?Model $model;
    protected bool $enablePaginate = true;
    protected int $perPage = 50;
    // Get all users
    public function get(): LengthAwarePaginator |  Collection
    {
        if(!$this->enablePaginate){
           return $this->model->all();
        }
        return $this->model->paginate($this->setNumberPages());
    }

    // Get a user by id
    public function show(int $id,string $message = "User not found") : Model

    {
       return $this->findlWithMessage($this->model,$id,$message);
    }

    // Create a new user
    public function store() : Model
    {
        // dd($this->validate());
        return $this->model->create($this->validate());
    }

    // Update data user
    public function update(int $id ) : Model
    {
        // Find the user


        $message =  'Não foi possível atualizar: usuário não encontrado';

        $user = $this->show($id,$message);

        // Update data user
        $user->update($this->validate());

        return $user->refresh();

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

    private function validate( Object | String  $requestClass = "" ) : array
    {

        if($requestClass == "" ){

          $requestClass =  $this->defineBindValueRequest();
        }

        return app($requestClass)->validated();

    }


    private function defineBindValueRequest() : string
    {

        $action = Request()->route()->getActionMethod();

        $requestPrefixes = ["App","Http" ,"Requests"];

       foreach(explode("\\",static::class) as $prefix){

        if($prefix !== "App" and $prefix !== "Services" and $prefix !== class_basename(static::class) ){

            $requestPrefixes[] =  $prefix;

        }
       }

       $requestPrefixes[] = Str::replace("Service","",class_basename(static::class));
       $requestPrefixes[] = Str::ucfirst($action) . "Request";

       $class = implode("\\",$requestPrefixes);

       if(!class_exists($class)){

        throw new Exception("This request class $class not exist");

       }

    //    dd($class);
       return $class;
    }

    public function desablePagination() :  bool
    {
      return  $this->enablePaginate = false;

    }
    protected function setNumberPages() : int
    {
        if(request()->get("per_page")){
            $perPage = request()->get("per_page");
        }

        if($perPage >= 1 && $perPage <= 1000){

            return  $this->perPage = $perPage ;

        }

        return $this->perPage;

    }



 };
