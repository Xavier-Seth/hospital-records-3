<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Records')</title>


     <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- ✅ Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

{{-- 
  <style>
    body {
    margin: 0;
    font-family: "Segoe UI", sans-serif;
    background-color: #dde9ea;
    height: 100vh;
    overflow: hidden;
}

.sidebar {
    width: 300px;
    background-color: #0a66c2;
    color: white;
    height: 100%;
    position: fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 30px;
    box-shadow: 3px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.sidebar h5 {
    margin-bottom: 30px;
}

.nav-link {
    color: white;
    width: 100%;
    text-align: left;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover,
.nav-link.active {
    background-color: #e1ecf7;
    color: #0a66c2;
    border-radius: 20px;
}

.logout {
    margin-top: auto;
    margin-bottom: 20px;
}

.main-content {
    margin-left: 300px;
    padding: 20px;
}

  </style> --}}

</head>
<body>


    <div class="d-flex">

        <!-- Sidebar -->
        @include('layouts.sidebar')
    
        <!-- Content -->
        <div class="main-content w-100 p-4">
            @yield('content')
        </div>
    
    </div>
    


</body>
</html>

