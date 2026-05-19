<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo; // penting

class TodoController extends Controller
{
    public function index()
    {

        $max_data = 5;
        if(request('search')){
            $data = Todo::where('task','like', '%'.request('search').'%')->paginate($max_data)->withQueryString();
        }else{
             $data = Todo::orderBy('task','asc')->paginate($max_data);

        }
        
        //dd($data);
        return view("todo.app",compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required' => 'Task harus diisi',
            'task.min' => 'Task minimal 3 karakter',
            'task.max' => 'Task maksimal 25 karakter'
        ]);

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);


        return redirect()->route('todo')->with('success', 'Berhasil simpan data');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {
     $request->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required' => 'Task harus diisi',
            'task.min' => 'Task minimal 3 karakter',
            'task.max' => 'Task maksimal 25 karakter'
        ]);

         $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        Todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success','Berhasil  menyimpan perbaikan data');


        $data = [
            'task' => $request->input('task')
        ];

    }
    


    public function destroy(string $id) {
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success','Berhasil menghapus data');
    }


    //bagian disini ditambah 
    
}
