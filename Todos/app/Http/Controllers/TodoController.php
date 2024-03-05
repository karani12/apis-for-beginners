<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Transformers\TodoTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class TodoController extends Controller
{
    // docs for scribe
    /**
     * @group Todo
     * @authenticated
     * Get all todos
     * @transformer \App\Transformers\TodoTransformer
     * 
     */
 
    public function index(TodoTransformer $transformer)
    {

        $todos = auth()->user()->todos;
        $data = fractal($todos, $transformer);
        return response()->json($data, 200);
    }


    //docs for scribe
    /**
     * @group Todo
     * @authenticated
     * Create a new todo
     * @bodyParam title string required The title of the todo.
     * @bodyParam description string required The description of the todo.
     * @bodyParam priority string required The priority of the todo.
     * @bodyParam category string required The category of the todo.
     * @bodyParam recurring boolean required The recurring status of the todo.
     * @bodyParam interval nullable The interval of the todo.
     * @bodyParam archived boolean nullable The archived status of the todo.
     * @bodyParam completed boolean nullable The completed status of the todo.
     * @bodyParam completed_at date nullable The completed date of the todo.
     * @bodyParam due_date timestamp nullable The due date of the todo.
     * @transformer \App\Transformers\TodoTransformer
     * @status 201
     */
    public function store(StoreTodoRequest $request, TodoTransformer $transformer)
    {
        $request->validated();
        $request['user_id'] = auth()->user()->id;
        $todo = Todo::create($request->all());
        $data = fractal($todo, $transformer);
        return response()->json($data, 201);
    }

    /**
     * @group Todo
     * @authenticated
     * Get a single todo
     * @urlParam todo required The ID of the todo
     * @transformer \App\Transformers\TodoTransformer
     * @status 200
     */
    public function show(Todo $todo)
    {
        return response()->json(
            fractal($todo, new TodoTransformer())->toArray(),
            200
        );
    }
    // docs for scribe
    /**
     * @group Todo
     * @authenticated
     * Update a todo
     * @urlParam todo required The ID of the todo
     * @bodyParam title string required The title of the todo.
     * @bodyParam description string required The description of the todo.
     * @bodyParam priority string required The priority of the todo.
     * @bodyParam category string required The category of the todo.
     * @bodyParam recurring boolean required The recurring status of the todo.
     * @bodyParam interval nullable The interval of the todo.
     * @bodyParam archived boolean nullable The archived status of the todo.
     * @bodyParam completed boolean nullable The completed status of the todo.
     * @bodyParam completed_at date nullable The completed date of the todo.
     * @bodyParam due_date timestamp nullable The due date of the todo.
     * @transformer \App\Transformers\TodoTransformer
     * @status 200
     */

    public function update(UpdateTodoRequest $request, Todo $todo, TodoTransformer $transformer)
    {
        $request->validated();
        $todo->update($request->all());
        $data = fractal($todo, $transformer);
        return response()->json($data, 200);
    }
  
    // docs for scribe
    /**
     * @group Todo
     * @authenticated
     * Delete a todo
     * @urlParam todo required The ID of the todo
     * @status 204
     */

    public function destroy(Todo $todo)
    {
      
        $todo->delete();
        return response()->json(null, 204);
    }


}
