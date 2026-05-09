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
    <h1 class="fw-bold text-primary">Edit Task: <span class="text-dark">{{ $task->title }}</span></h1>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- الـ Action والـ Method -->
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               name="title" id="title" 
                               value="{{ old('title', $task->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" id="description" rows="4">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Creator (user_id) -->
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label fw-semibold">Creator</label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label fw-semibold">Due Date</label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                   id="due_date" name="due_date" 
                                   value="{{ old('due_date', $task->due_date) }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Priority -->
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label fw-semibold">Priority</label>
                            <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                                @foreach(['low', 'medium', 'high', 'urgent'] as $p)
                                    <option value="{{ $p }}" {{ old('priority', $task->priority) == $p ? 'selected' : '' }}>
                                        {{ ucfirst($p) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                @foreach(['pending', 'in_progress', 'completed'] as $s)
                                    <option value="{{ $s }}" {{ old('status', $task->status) == $s ? 'selected' : '' }}>
                                        {{ str_replace('_', ' ', ucfirst($s)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  <div class="col-md-6 mb-3">
                            <label for="assignee_id" class="form-label fw-semibold">Assignee</label>
                            <select name="assignee_id" id="assignee_id" class="form-select @error('assignee_id') is-invalid @enderror">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assignee_id', $task->assignee_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assignee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4">Update Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Tips -->
    <div class="col-lg-4">
        <div class="card bg-light border-0 shadow-sm mb-3">
            <div class="card-body">
                <h5 class="fw-bold"><i class="bi bi-lightbulb"></i> Tips</h5>
                <ul class="text-muted small ps-3">
                    <li>Make sure the title is descriptive.</li>
                    <li>Status "Done" will archive the task.</li>
                    <li>Updating the creator will notify the user.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection