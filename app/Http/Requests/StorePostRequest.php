<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'title' => ['required', "min:3", "max:30", "unique:tasks,title", "string"],
           'description' => ['required', "min:10", "string"],
           'due_date' =>['required',"date","after:today"],
            'priority' =>['required',"in:Low,Medium,High"],
           'status' =>['required',"in:Pending,Completed,in_progress"],
           'user_id'  =>['required',"exists:users,id"],
           'assignee_id' => ['required','exists:users,id' ]
        ];
    }
    public function messages(): array
    {
        return [
            "title.required" => "please enter title, Title is required",
            "title.min" => "title must be at least 3 characters",
            "title.unique" =>"title must be unique,title already exists before",
            "description.required" => "please enter description, Description is required",
            "description.min" => "description must be at least 10 characters",
            "due_date.required" => "please enter due date, Due date is required",
            "due_date.date" => "please enter valid date, Due date must be a valid date",
            "due_date.after" => "please enter future date, Due date must be after today",
            "priority.required" => "please enter priority, Priority is required",
            "priority.in" => "please enter valid priority, Priority must be low, medium or high",
            "status.required" => "please enter status, Status is required",
            "status.in" => "please enter valid status, Status must be pending, completed or in_progress",
            "user_id.required" => "please select user, User is required",
            "user_id.exists" => "please select valid user, User must exist in users table",
            "assignee_id.required" => "please select assignee, assignee is required",
            "assignee_id.exists" => "please select valid assignee,assignee must exist in assignees table",
        ];
    }
}
