<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #E43DAF, #CA5DA7, #230808);
      background-size: 300% 300%;
      animation: gradientShift 8s ease infinite;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      color: white;
    }
    @keyframes gradientShift {
      0%,100%{background-position:0% 50%;}
      50%{background-position:100% 50%;}
    }

    .card {
      background: rgba(255,255,255,0.08);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      border: 1px solid rgba(255,255,255,0.25);
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
      width: 380px;
      padding: 35px 30px;
      text-align: center;
      animation: fadeInUp 1s ease;
    }
    @keyframes fadeInUp {
      from {opacity:0;transform:translateY(30px);}
      to {opacity:1;transform:translateY(0);}
    }

    .login-logo img { width:110px; margin-bottom:10px; }

    .form-control, .input-group-text {
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.3);
      color: #fff;
      border-radius: 10px;
      height: 45px;
    }
    .form-control::placeholder { color: rgba(255,255,255,0.8); }

    .btn-primary {
      background: linear-gradient(90deg, #E43DAF, #CA5DA7);
      border: none;
      border-radius: 10px;
      height: 45px;
      font-weight: bold;
      transition: 0.3s;
      margin-top: 5px;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(228,61,175,0.6);
    }

    footer {
      color: #fff;
      font-size: 0.9rem;
      position: absolute;
      bottom: 15px;
      width: 100%;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="login-logo">
      <img src="{{ asset('images/logo_simbool.png') }}" alt="Logo SIMBOOL">
    </div>
    <h5 class="fw-bold text-black mb-3">Login Administrator</h5>

    @if ($errors->any())
      <div class="alert alert-danger py-2 mb-3 text-center">{{ $errors->first() }}</div>
    @endif
    @if (session('success'))
      <div class="alert alert-success py-2 mb-3 text-center">{{ session('success') }}</div>
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
      <button type="submit" class="btn btn-primary w-100">
        <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk
      </button>
    </form>
  </div>

  <footer>
    &copy; {{ date('Y') }} <b>Simbool Custom</b> • All Rights Reserved
  </footer>
</body>
</html>
