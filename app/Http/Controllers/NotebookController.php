<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    //method GET
    public function index()
    {
        $notebooks = Notebook::get(['id', 'title', 'body', 'created_at']);
        return $this->succesMessage(200, 'succes', $notebooks);
    }
    //method POST
    public function store(Request $request)
    {
        $notebook = Notebook::create($request->all());
        return $this->succesMessage(201, 'created', $notebook);
    }
    //method GET By id
    public function show($id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if(!$notebook){
            return $this->errorMessage(404, 'Not Found');
        }
        return $this->succesMessage(200, 'succes', $notebook);
    }

    public function update(Request $request, $id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if(!$notebook){
            return $this->errorMessage(404, 'Not Found');
        }
        $notebook->update($request->all());
        return$this->succesMessage(200, "succes", $notebook);
    }
    public function destroy($id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if(!$notebook){
            return $this->errorMessage(404, 'Not Found');
        }
        $notebook->delete();
        return $this->succesMessage(200, 'succes', "Succes Delete Notebook");
    }

    //return Message
    public function errorMessage($status, $message)
    {
        return response([
            'status' => $status,
            'message' => $message
    
        ]);
    }
    public function succesMessage($status, $message, $data = [])
    {
        return response([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
