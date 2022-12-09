<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;

class ApiController extends Controller
{
   
   public function createTodo(Request $request) {
        $data = ['error'=> ''];
        //Regras de validação
        $rules = [
            'title'=>'required|min:3'
        ];
        //Validando
        $validator = Validator::make($request->only(['title']), $rules);
        if($validator->fails()){
            $data['error'] = $validator->messages();
            return $data;
        }
        // Nao falhou pega informação
        $title = $request->input('title');

        //Gravando os dados
        $todo = new Todo();
        $todo->title = $title;
        $todo->save();
        return $data;
   }

   public function readAllTodos(){
        $data = ['error'=> ''];
        $data['list'] = Todo::all();
        return $data;
   }

   public function readTodo($id){
        $data = ['error'=> ''];
        $todo = Todo::find($id);
        if(!$todo){
            $data = ['error'=> 'Tarefa pesquisada '.$id.' não foi encontrada!']; 
            return $data;
        }
        $data['todo'] = $todo;
        return $data;
   }

   public function updateTodo($id, Request $request){
        
        $data = ['error'=> ''];
        //Regras de validação
        $rules = [
            'title'=>'min:3',
            'is_done'=>'boolean'
        ];
        //Validando
        $validator = Validator::make($request->only(['title']), $rules);
        if($validator->fails()){
            $data['error'] = $validator->messages();
            return $data;
        }
        // Nao falhou pega informação
        $title = $request->input('title');
        $is_done= $request->input('is_done');
        $todo = Todo::find($id);
        if(!$todo){
            $data = ['error'=> 'Tarefa pesquisada '.$id.' não foi encontrada!']; 
            return $data;
        }
        //Gravando os dados
        if($title){
            $todo->title = $title;
        }
        
        if($is_done !==NULL){
            $todo->is_done = $is_done;
        }
        $todo->save();
        return $data;

   }

   public function deleteTodo($id){
        $data = ['error'=> ''];
        $todo = Todo::find($id);
        if(!$todo){
            $data = ['error'=> 'Tarefa pesquisada '.$id.' não foi encontrada!']; 
            return $data;
        } 
        $data = ['error'=> 'Tarefa '.$id.' foi apagada com sucesso!']; 
        //Apaga os dados
        $todo->delete();
        return $data;

   }
}
