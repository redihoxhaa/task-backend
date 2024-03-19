<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Funzione per ottenere le task dell'utente loggato
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $tasks = Task::where('user_id', $user->id)->get();

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Funzione per salvare la task dell'utente attualmente loggato
     */
    public function store(StoreTaskRequest $request)
    {

        $data = $request->validated();

        $user = User::find(Auth::id());
        $task = new Task();
        $task->user_id = $user->id;
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->end_date = $data['end_date'];
        $task->status = $data['status'];
        $task->save();

        return response()->json($task, 201);
    }

    /**
     * Funzione per mostrare una task specifica dell'utente loggato
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        $task = $user->tasks()->findOrFail($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Funzione per modificare una task specifica dell'utente loggato
     */
    public function update(UpdateTaskRequest $request, $id)
    {

        $user = User::find(Auth::id());
        $task = $user->tasks()->findOrFail($id);
        $task->update($request->validated());

        return response()->json($task);
    }

    /**
     * Funzione per eliminare una task specifica dell'utente loggato
     */
    public function destroy($id)
    {
        $user = User::find(Auth::id());
        $task = $user->tasks()->findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
