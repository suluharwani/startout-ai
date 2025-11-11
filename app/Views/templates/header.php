<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Startout AI' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --msq-black: #000000;
            --msq-primary: #007bff;
            --msq-light: #f8f9fa;
            --msq-dark: #343a40;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }

        .section {
            padding: 80px 0;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .service-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .btn-primaryMenu {
            background-color: var(--msq-primary);
            border-color: var(--msq-primary);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-primaryMenu:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .footer {
            background-color: var(--msq-dark);
            color: white;
            padding: 50px 0 20px;
        }

        .dummy-img {
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-weight: 500;
        }

        .dummy-img-lg {
            height: 400px;
            border-radius: 10px;
        }

        .dummy-img-sm {
            height: 80px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <header class="header d-flex justify-content-between align-items-center py-3 px-4 bg-white shadow-sm">
        <div>
            <a class="navbar-brand d-flex align-items-center text-decoration-none" href="<?= base_url() ?>">
                <div class="logo-image me-2">
                    <img src="<?= base_url('images/logo-startout-ai.png') ?>" alt="Startout AI Logo" style="height: 40px;">
                </div>
                <div class="logo-text fw-bold text-dark fs-4">Startout AI</div>
            </a>
        </div>
        <nav class="d-none d-lg-flex align-items-center">
            <ul class="d-flex align-items-center list-unstyled mb-0">
                <li class="mx-3"><a href="<?= base_url('services') ?>" class="text-dark text-decoration-none fw-medium">Services</a></li>
                <li class="mx-3"><a href="<?= base_url('industries') ?>" class="text-dark text-decoration-none fw-medium">Industries</a></li>
                <li class="mx-3"><a href="<?= base_url('about') ?>" class="text-dark text-decoration-none fw-medium">About</a></li>
                <li class="mx-3"><a href="<?= base_url('careers') ?>" class="text-dark text-decoration-none fw-medium">Careers</a></li>
                <li class="mx-3"><a href="<?= base_url('join') ?>" class="text-dark text-decoration-none fw-medium">Join Us</a></li>
                <li class="mx-3"><a href="<?= base_url('contact') ?>" class="text-dark text-decoration-none fw-medium">Contact</a></li>
            </ul>
        </nav>
        <div class="d-flex align-items-center gap-3">
    <a href="<?= base_url('join') ?>" class="d-none d-md-block">
        <button class="btn btn-outline-dark">Join the Startout</button>
    </a>
    <a href="<?= base_url('contact') ?>" class="d-none d-md-block">
        <button class="btn btn-primaryMenu">Contact us</button>
    </a>
    <button class="d-block d-lg-none btn btn-link p-0" type="button">
        <i class="fas fa-bars fa-lg" style="color: var(--msq-black);"></i>
    </button>
</div>
    </header>