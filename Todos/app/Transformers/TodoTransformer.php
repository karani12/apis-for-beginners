<?php

namespace App\Transformers;

use App\Models\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Todo $todo)
    {
        return [
            'id' => (int) $todo->id,
            'title' => (string) $todo->title,
            'description' => (string) $todo->description,
            'priority' => (string) $todo->priority,
            'category' => (string) $todo->category,
            'recurring' => (bool) $todo->recurring,
            'interval' => (bool) $todo->interval,
            'archived' => (bool) $todo->archived,
            'completed' => (bool) $todo->completed,
            'completed_at' => (string) $todo->completed_at,
            'due_date' => (string) $todo->due_date,
            'created_at' => (string) $todo->created_at,
            'updated_at' => (string) $todo->updated_at,
            'deleted_at' => isset($todo->deleted_at) ? (string) $todo->deleted_at : null,
            
        ];
    }
}
