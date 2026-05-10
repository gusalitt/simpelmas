<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPELMAS - Sistem Pengaduan & Laporan Masyarakat</title>
    <link rel="shortcut icon" href="<?= base_url('/public/assets/img'); ?>" id="dynamic-favicon" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/output.css') ?>">
</head>

<body class="smooth-scroll antialiased">
    <!-- Navbar -->
    <?php view()::include('pages.landing.components.navbar'); ?>

    <!-- Main Content -->
    <main>
        <div>
            <?php view()::stack('content'); ?>
        </div>
    </main>

    <!-- Footer -->
    <?php view()::include('pages.landing.components.footer'); ?>

    <script src="<?= base_url('/public/assets/js/helper.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/navbar.js') ?>"></script>
</body>

</html>