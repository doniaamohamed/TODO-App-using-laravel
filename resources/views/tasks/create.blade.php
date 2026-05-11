<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm border-0 p-4">
        
        <table class="table">
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
                <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Task Title</label>
                        <input type="text" class="form-control px-3 @error('title') is-invalid @enderror" name="title" id="title" placeholder="e.g. Finish Laravel Project" >
                        <!-- lw tman elclass =form-control px-3 lw f error(moshkla f elvalidation) elclass =form-control px-3 is-invalid 
                         w lw f error ezhr elmessage btb2a mn laravel gahza -->
                        @error('title')
                          <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control px-3 @error('description') is-invalid @enderror" name="description" id="description" rows="4" placeholder="Describe what needs to be done..."></textarea>
                        @error('description')
                          <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Creator -->
                        <div class="col-md-6 mb-3">
                            <label for="creator" class="form-label fw-semibold"> Creator</label>
                            <!-- <input type="text" class="form-control" id="creator" name="creator" placeholder="Enter name"> -->
                             <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                      @foreach($users as $user)
                                           <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                     @error('user_id')
                             <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label fw-semibold">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                             @error('due_date')
                          <p>{{ $message }}</p>
                        @enderror
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
                            @error('priority')
                             <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="Pending">Pending</option>
                                <option value="in_progress">in_progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                             @error('status')
                             <p>{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div>
                        <!-- Assignee -->
                        <div class="col-md-6 mb-3">
                            <label for="assignee" class="form-label fw-semibold">Assignee</label>
                            <!-- <input type="text" class="form-control" id="assignee" name="assignee" placeholder="Enter name"> -->
                             <select name="assignee_id" class="form-control">
                                      @foreach($users as $user)
                                           <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                     @error('assignee_id')
                             <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            
                        <label for="images" class="form-label fw-semibold">Task Images</label>
                        <input type="file" name="images[]" multiple class="form-control" accept="image/png, image/jpeg">
                    </div>

</div>
                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <!-- <button type="reset" class="btn btn-light px-4">Reset</button>

                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Save Task</button> -->
                        < x-button type="light">Reset</ x-button>
                        < x-button type="primary">Save Task</ x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 </table>

    </div>
</x-app-layout>