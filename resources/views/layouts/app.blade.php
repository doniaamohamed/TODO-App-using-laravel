<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TodoApp - @yield("page title")</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            background-color: #ffffff !important;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
            letter-spacing: -0.5px;
        }
        .container {
            max-width: 1100px;
        }
        .form-control:focus {
            box-shadow: none;      
            outline: 0 none;      
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top mb-4">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('tasks.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check2-square me-2" viewBox="0 0 16 16">
                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                </svg>
                TODO APP
            </a>

            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Content -->
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active fw-semibold' : '' }}" href="{{ route('tasks.index') }}">All Tasks</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex me-3" role="search">
                    <div class="input-group">
                        <input class="form-control form-control-sm border-end-0" type="search" placeholder="Search tasks..." aria-label="Search">
                        <button class="btn btn-sm btn-outline-secondary border-start-0" type="submit">
                            <i class="bi bi-search"></i> 🔍
                        </button>
                    </div>
                </form>

                <!-- Action Button -->
                <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary px-3 shadow-sm rounded-pill">
                    + Create Task
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="container py-2">
        @yield("content")
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>