<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 400px; /* Lebar maksimal card */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan card */
        }
        .form-group label {
            font-weight: bold; /* Label tebal */
        }
        .btn-primary {
            width: 100%; /* Tombol lebar penuh */
        }
        .footer-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h5 class="card-title text-center">Reset Password</h5>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
        <div class="footer-link">
            <small>Remembered your password? <a href="{{ route('login') }}">Login</a></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
