@extends("layouts.app")

@section("page title", "Task Details")

@section("content")
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}" class="text-decoration-none">Tasks</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <h1 class="fw-bold text-primary">Task Details</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Information</h5>
                    <span class="badge rounded-pill {{ $task['status'] == 'Completed' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $task['status'] }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <h3 class="card-title fw-bold mb-3">{{ $task['title'] }}</h3>
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        {{ $task['description'] }}
                    </p>
                    
                    <hr class="text-muted opacity-25">
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <p class="mb-1 text-muted small uppercase">Creator</p>
                            <p class="fw-semibold">{{ $task['creator'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1 text-muted small uppercase">Due Date</p>
                            <p class="fw-semibold text-danger">{{ $task['due_date'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light p-3 d-flex gap-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">Back to List</a>
                    <a href="{{ route('tasks.edit', $task['id']) }}" class="btn btn-outline-warning px-4">Edit Task</a>
                    
                    <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" class="ms-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger px-4" onclick="return confirm('Are you sure?')">Delete Task</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar for Task Metadata -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Task Meta</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Task ID:</span>
                        <span class="fw-bold">#{{ $task['id'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Priority:</span>
                        <span class="badge {{ $task['priority'] == 'High' ? 'bg-danger' : 'bg-info' }}">
                            {{ $task['priority'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection