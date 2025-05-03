<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Hospital Records</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('img/Logo.png') }}" alt="Hospital Logo">
    <h2>Hospital Records</h2>
  </div>

  <!-- Login Form -->
  <div class="form-container">
    <div class="login-box">
      <h2 class="text-center mb-4">Login</h2>

      <!-- Display Error Message -->
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
      </form>

    </div>
  </div>

</body>
</html>
