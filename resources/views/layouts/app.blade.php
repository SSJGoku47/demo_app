<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</head>
<body>
    <header>
        <x-navbar /> <!-- Navbar component -->
    </header>

    <!-- Main component -->
    <div class="main-view d-flex flex-column container-fluid align-items-center vh-100 bg-white position-relative">
        <x-toaster/> <!-- Toaster component -->
        
        <!-- Dynamic content -->
        <main class="dynamic-content container-fluid d-flex justify-content-center overflow-auto">
            @yield('content') <!-- Dynamic content section -->
        </main>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <x-footer/> <!-- Footer component -->
    </footer>
</body>
</html>


