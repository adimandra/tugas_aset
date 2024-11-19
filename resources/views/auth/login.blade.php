<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@300&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #fff;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff; /* Mengubah latar belakang menjadi putih */
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h3 {
            font-family: 'Poppins', sans-serif;
            color: #333; /* Warna teks lebih gelap untuk kontras */
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.2rem;
        }
        h1 {
            font-family: 'Poppins', sans-serif;
            color: #0072ff; /* Warna teks solid */
            font-size: 2.1rem;
            margin-bottom: 1.5rem;
        }
        .form-group {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333; /* Warna teks label */
            text-align: left;
        }
        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.9);
        }
        button {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #fff;
            border: none;
            padding: 0.8rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        button:hover {
            background: linear-gradient(to right, #0072ff, #00c6ff);
        }
        .icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
            font-size: 18px;
        }
        .input-group input {
            padding-right: 30px;
        }
        .forgot-password a {
            color: #0072ff;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .register-link p {
            color: #333; /* Warna teks registrasi */
        }
        .register-link a {
            color: #00c6ff;
            text-decoration: none;
            font-weight: bold;
        }
        .register-link a:hover {
            color: #0072ff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Welcome</h3>
        <h1>DISKOMINFO BADUNG</h1>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" class="form-control" required autofocus>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="forgot-password">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
        </div>

        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</body>
</html>
