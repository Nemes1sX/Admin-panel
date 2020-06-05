<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user')->get();//
        return response()->json(
            [
                'status' => 'success',
                'tasks' => $tasks->toArray()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $users = User::all();

        $v = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required|min:20',
            'taskdate' => 'required',
       ]);//
       if($v->fails())
       {
        return response()->json([
            'status' => 'error',
            'errors' => $v->errors()
        ], 422);
       }
       $task = new Task;
       $task->name = $request->name;
       $task->description = $request->description;
       $task->taskdate = $request->taskdate;
       $task->status = $request->status;
       $task->user_id = $request->user_id;
       $task->save();
       return response()->json(['status' => 'success'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::find($id)->users;//
        return response()->json(
            [
                'status' => 'success',
                'tasks' => $tasks->toArray()
            ], 200);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = Task::find($id)->users;//
        return response()->json(
            [
                'status' => 'success',
                'task' => $tasks->toArray()
            ], 200);//

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $task =  Task::find($id)->users;
      $task->update($request->all());
    
      return response()->json(['status' => 'Update success'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();
        return response()->json([
            'status' => 'success',
            'msg' => 'Deleted Successfully.'
        ], 200);
    }
}
