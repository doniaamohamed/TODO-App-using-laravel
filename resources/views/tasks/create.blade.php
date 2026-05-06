@extends("layouts.app")

@section("page title", "Create New Task")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary">Create New Task</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
        </div>

        <!-- Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Task Title</label>
                        <input type="text" class="form-control px-3 @error('title') is-invalid @enderror" name="title" id="title" placeholder="e.g. Finish Laravel Project" >
                        <!-- lw tman elclass =form-control px-3 lw f error(moshkla f elvalidation) elclass =form-control px-3 is-invalid 
                         w lw f error ezhr elmessage btb2a mn laravel gahza -->
                        @error('title') 
                        {{ $message}}
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control px-3" name="description" id="description" rows="4" placeholder="Describe what needs to be done..."></textarea>
                    </div>

                    <div class="row">
                        <!-- Creator -->
                        <div class="col-md-6 mb-3">
                            <label for="creator" class="form-label fw-semibold">Assignee / Creator</label>
                            <input type="text" class="form-control" id="creator" name="creator" placeholder="Enter name">
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label fw-semibold">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Priority -->
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label fw-semibold">Priority</label>
                            <select class="form-select" name="priority" id="priority">
                                <option value="Low">Low</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-light px-4">Reset</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
