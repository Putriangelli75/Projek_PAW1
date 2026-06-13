<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SPLJ')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <style>
        /* seluruh CSS dari header.php Anda */
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero-banner {
            background:
                linear-gradient(rgba(0,0,0,.45),
                rgba(0,0,0,.45)),
                url('{{ asset("assets/img/banner.jpg") }}');

            background-size: cover;
            background-position: center;
            min-height: 220px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 40px;
            color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,.15);
        }

        .sidebar {
            background: #198754;
            min-height: 100vh;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,.1);
        }

        .sidebar-logo {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,.2);
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }

        .sidebar-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
        }

        .sidebar-menu a.active {
            background: white;
            color: #198754;
            font-weight: 600;
            border-left: 4px solid #0d6efd;
            border-radius: 0 30px 30px 0;
        }

        .booking-card {
            border-radius: 20px;
            overflow: hidden;
        }

        .booking-card img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>

</head>

<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>