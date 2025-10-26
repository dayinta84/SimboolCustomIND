<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator</title>

  {{-- Import AdminLTE & Bootstrap via Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Font Awesome untuk icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="hold-transition login-page" style="background-color: #f4f6f9;">
  <div class="login-box">
    <!-- Logo -->
    <div class="login-logo">
      <a href="#" class="fw-bold" style="color:#343a40; text-decoration:none;">
        <i class="fa-solid fa-user-shield me-2"></i> <b>Admin</b>LTE
      </a>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-body login-card-body">
        <p class="login-box-msg text-secondary fw-semibold mb-4">
          Silakan login untuk melanjutkan
        </p>

        {{-- Pesan error --}}
        @if ($errors->any())
          <div class="alert alert-danger py-2 mb-3">{{ $errors->first() }}</div>
        @endif

        {{-- Pesan sukses --}}
        @if (session('success'))
          <div class="alert alert-success py-2 mb-3">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('administrator-login.submit') }}">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block w-100 fw-bold">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
    &copy; {{ date('Y') }} Company Profile • All Rights Reserved
  </footer>
</body>
</html>
