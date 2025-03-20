<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request; // bring the info of the request

//all new controllers extends the original controller
class BackendController extends Controller
{

    //array of names
    private $names = [
        1 => ['name' => 'Mateo', 'age' => 20],
        2 => ['name' => 'Lucas', 'age' => 25],
        3 => ['name' => 'John', 'age' => 18],
    ];

    //return all names in a json
    public function getAll(){
        return response()->json($this->names);
    }

    //send $id parameter. Id = 0 by default for optional parameter
    public function get(int $id = 0){
        if(isset($this->names[$id])){
            return response()->json($this->names[$id]);
        }

        return response()->json(["error" => "Person not found"], Response::HTTP_NOT_FOUND);
    }

    //bring the info of the request
    public function create(Request $request){
        $person = [
            "id" => count($this->names) + 1,
            "name" => $request->input("name"),
            "age" => $request->input("age")
        ];

        $this->names[$person["id"]] = $person; //new space to store the new person

        //return 201 created
        return response()->json(["message" => "Person created", "person" => $person], Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id){
        if (isset($this->names[$id])){
            $this->names[$id]["name"] = $request->input("name", $this->names[$id]["name"]);
            $this->names[$id]["age"] = $request->input("age", $this->names[$id]["age"]);

            return response()->json(["message" => "Person updated", "person" => $this->names[$id]]);
        }

        return response()->json(["error" => "Person not found"], Response::HTTP_NOT_FOUND);
    }

    public function delete(int $id){
        if (isset($this->names[$id])){
            
            unset($this->names[$id]);

            return response()->json(["message" => "Person deleted"]);

        }

        return response()->json(["error" => "Person not found"], Response::HTTP_NOT_FOUND);
    }


}
