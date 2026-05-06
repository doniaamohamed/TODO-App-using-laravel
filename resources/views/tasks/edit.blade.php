@extends("layouts.app")

@section("page title", "Edit Task")

@section("content")
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}" class="text-decoration-none">Tasks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
        </ol>
    </nav>
    <h1 class="fw-bold text-primary">Edit Task: <span class="text-dark">{{ $task['title'] }}</span></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('tasks.update', $task['id']) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" name="title" id="title" 
                               placeholder="Enter task title" value="{{ $task['title'] }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" 
                                  placeholder="Enter task description">{{ $task['description'] }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="creator" class="form-label fw-semibold">Creator</label>
                            <input type="text" class="form-control" id="creator" name="creator" 
                                   value="{{ $task['creator'] }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label fw-semibold">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" 
                                   value="{{ $task['due_date'] }}">
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label fw-semibold">Priority</label>
                            <input type="text" class="form-control" id="priority" name="priority" 
                                   value="{{ $task['priority'] }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <input type="text" class="form-control" id="status" name="status" 
                                   value="{{ $task['status'] }}">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Help Sidebar -->
    <div class="col-lg-4">
        <div class="card bg-light border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">Tips</h5>
                <p class="text-muted small">
                    * Make sure the title is descriptive.<br>
                    * Set a realistic due date to track progress effectively.<br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection