<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>@yield('title', 'Pengaduan Masyarakat')</title> -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
        }

        .landing-page {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            background-color: #3D5300;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            text-align: center;
        }

        .left-section h1 {
            font-weight: bold;
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: fadeIn 1.2s ease-in-out;
        }

        .left-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-top: 1rem;
            animation: fadeIn 1.5s ease-in-out;
        }

        .left-section .btn {
            margin-top: 2rem;
            padding: 0.8rem 2.5rem;
            font-size: 1.2rem;
            border-radius: 25px;
            font-weight: bold;
            background-color: #FFE31A;
            color: white;
            border: none;
            transition: all 0.3s;
            animation: fadeIn 2s ease-in-out;
        }

        .left-section .btn:hover {
            background-color: #daa520;
            transform: scale(1.05);
        }

        .right-section {
            flex: 1;
            position: relative;
            background: linear-gradient(to bottom, white, white);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .right-section img {
            max-width: 80%;
            height: auto;
            border-radius: 15px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
        }

        .side-icons {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .side-icons a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #555;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            font-size: 1.5rem;
            transition: background-color 0.3s;
        }

        .side-icons a:hover {
            background-color: #777;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .landing-page {
                flex-direction: column;
            }

            .right-section {
                min-height: 50vh;
            }
        }
    </style>
</head>
<body>
    @yield('report')

        <div class="side-icons">
            <a href="{{route('report.pengaduan')}}"><i class="bi bi-person"></i></a>
            <a href="#"><i class="bi bi-exclamation-circle"></i></a>
            <a href="{{route('report.create')}}"><i class="bi bi-pencil"></i></a>
        </div>

    <stack>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </stack>
</body>
</html>
