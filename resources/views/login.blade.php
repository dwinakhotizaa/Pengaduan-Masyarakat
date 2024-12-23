<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Masyarakat')</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* General Reset */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
        }

        /* Landing Page with full height */
        .landing-page {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Left Section with Fade-In Animation */
        .left-section {
            flex: 1;
            background-color: #3D5300;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;

            /* Applying animation */
            animation: fadeInLeft 1.5s ease-in-out;
        }

        /* Right Section */
        .right-section {
            flex: 1;
            background: linear-gradient(to bottom, white, white);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Image with opacity and sizing */
        .right-section img {
            width: 100%;
            height: 37em;
            max-width: 1000px;
            object-fit: cover;
            opacity: 0.7; /* Opacity applied */
            transition: opacity 0.5s ease;
        }

        .right-section img:hover {
            opacity: 1; /* Image returns to full opacity on hover */
        }

        /* Login Form with animation */
        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;

            animation: fadeInForm 1.5s ease-in-out;
        }

        /* Style for buttons with the updated background color */
        .btn-custom {
            background-color: #fcc200 !important;
            color: white !important;
            border: none !important;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #daa520 !important;
            transform: scale(1.05);
        }

        .left-section h1 {
            font-weight: bold;
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: fadeIn 1.2s ease-in-out;
            color: #43b2c8;
        }

        .alert-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050; /* Ensure it appears above other elements */
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .alert {
            max-width: 600px;
            text-align: center;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Keyframes for Left Section Animation */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Keyframes for the Login Form */
        @keyframes fadeInForm {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="alert-container">
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>

    <!-- Landing Page Structure -->
    <div class="landing-page">
        <!-- Left Section with Login Form -->
        <div class="left-section">
            <h1 style="color: white;">Pengaduan Masyarakat</h1>
            <p style="color: white;">Silahkan daftar atau login untuk bergabung dengan kami.</p>

            <!-- Integrated Login Form -->
            <form action="{{ route('login.form') }}" method="POST" class="login-form">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" name="action" value="login" class="btn btn-custom btn-block w-100 mb-3">Login</button>
                <button type="submit" name="action" value="register" class="btn btn-custom btn-block w-100 mb-3">Buat Akun</button>
            </form>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <img src="https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/09/12/4035589794.jpg" alt="">
        </div>
    </div>

    <!-- Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
