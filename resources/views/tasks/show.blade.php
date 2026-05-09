@extends("layouts.app")

@section("page title", "Task Details")

@section("content")
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}" class="text-decoration-none">Tasks</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{ $task->id }} Details</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-bold text-primary mb-0">Task Details</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning px-4 shadow-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 shadow-sm" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h2 class="fw-bold mb-0">{{ $task->title }}</h2>
                        <span class="badge rounded-pill p-2 px-3 {{ $task->status == 'completed' ? 'bg-success' : 'bg-info text-dark' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>
                    
                    <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                        {{ $task->description }}
                    </p>

                    <div class="row border-top pt-4 g-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold text-uppercase d-block">Due Date</label>
                            <span class="fw-semibold text-danger">
                                <i class="bi bi-calendar-event me-1"></i> {{ $task->due_date }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold text-uppercase d-block">Creator</label>
                            <span class="fw-semibold text-dark">
                                <i class="bi bi-person-circle me-1"></i> {{ $task->creator->name }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold text-uppercase d-block">Created At</label>
                            <span class="text-muted small">
                                <i class="bi bi-clock me-1"></i> {{ $task->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-chat-left-text me-2"></i>Comments 
                        <span class="badge bg-secondary ms-1">{{ $task->comments->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        @forelse($task->comments as $comment)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold mb-0">{{ $comment->user->name }}</h6>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0 text-secondary">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-chat-dots text-muted display-4"></i>
                                <p class="text-muted mt-2">No comments yet. Be the first to comment!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="bg-light p-3 rounded">
                        <h6 class="fw-bold mb-3">Add a Comment</h6>
                        <form action="{{ route('comments.store', $task->id) }}" method="POST">
                            @csrf
                            <textarea name="body" class="form-control mb-2" rows="3" placeholder="What's on your mind?" required></textarea>
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-send me-1"></i> Post Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Task Meta</h6>
                    <div class="mb-3">
                        <label class="text-muted small d-block">Priority Level</label>
                        @php
                            $priorityColor = [
                                'high' => 'bg-danger',
                                'medium' => 'bg-warning text-dark',
                                'low' => 'bg-success'
                            ][$task->priority] ?? 'bg-info';
                        @endphp
                        <span class="badge {{ $priorityColor }} w-100 py-2 fs-6">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-left"></i> Back to Tasks
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-primary text-white border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-info-circle me-1"></i> Did you know?</h6>
                    <p class="small mb-0 opacity-75">
                        You can update the task status to "Completed" to clear it from your active list.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection