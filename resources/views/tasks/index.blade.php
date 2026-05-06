@extends("layouts.app")

@section("page title") Tasks @endsection

@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Task List</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary px-4 shadow-sm">Create New Task</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Title</th>
                            <th>Creator</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $task['id'] }}</td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $task['title'] }}</span>
                            </td>
                            <td>{{ $task['creator'] }}</td>
                            <td>
                                <span class="badge {{ $task['priority'] == 'High' ? 'bg-danger' : ($task['priority'] == 'Medium' ? 'bg-warning text-dark' : 'bg-info') }}">
                                    {{ $task['priority'] }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $task['status'] == 'Completed' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $task['status'] }}
                                </span>
                            </td>
                            <td>{{ $task['due_date'] }}</td>
                            <td class="text-center">
                                <div class="btn-group gap-2">
                                    <a href="{{ route('tasks.show', ['task' => $task['id']]) }}" class="btn btn-sm btn-outline-success rounded">View</a>
                                    <a href="{{ route('tasks.edit', ['task' => $task['id']]) }}" class="btn btn-sm btn-outline-warning rounded">Edit</a>
                                    
                                    {{-- Delete Form --}}
                                    <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <!-- <button type="submit" class="btn btn-sm btn-outline-danger rounded" onclick="return confirm('Are you sure?')">Delete</button> -->
                                         <x-button type="danger">Delete</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection