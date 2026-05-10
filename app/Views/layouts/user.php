<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPELMAS - Sistem Pengaduan & Laporan Masyarakat</title>
    <link rel="shortcut icon" href="<?= base_url('/public/assets/img'); ?>" id="dynamic-favicon" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/output.css') ?>">

    <?php view()::stack('styles'); ?>
</head>

<body class="smooth-scroll antialiased">
    <!-- Navbar -->
    <?php view()::include('pages.user.components.navbar'); ?>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-4rem)] md:min-h-[calc(100vh-4.5rem)]">
        <div class="container mx-auto pt-24 pb-20 px-6 sm:px-6 lg:px-20">
            <?php view()::stack('content'); ?>
        </div>
    </main>

    <!-- Footer -->
    <?php view()::include('pages.user.components.footer'); ?>

    <!-- Alert -->
    <?= alert(); ?>

    <script src="<?= base_url('/public/assets/js/navbar.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/helper.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/data-table.js') ?>"></script>
    <?php view()::stack('scripts'); ?>
    <script>
        function setActiveNavLink() {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.replace('btn-ghost', 'btn-primary');
                } else {
                    link.classList.replace('btn-primary', 'btn-ghost');
                }
            });
        }
        setActiveNavLink();
    </script>
</body>

</html>