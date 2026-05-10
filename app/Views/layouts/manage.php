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

<body class="smooth-scroll antialiased relative">
    <!-- Sidebar -->
    <?php view()::include('pages.manage.components.sidebar'); ?>

    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Header -->
        <?php view()::include('pages.manage.components.header'); ?>

        <div class="absolute left-0 lg:left-64 top-15 right-0 p-5 lg:p-7">
            <?php view()::stack('content'); ?>
        </div>
    </main>

    <!-- Alert -->
    <?= alert(); ?>

    <script src="<?= base_url('/public/assets/js/helper.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/data-table.js') ?>"></script>
    <?php view()::stack('scripts'); ?>
    <script>
        const isShowModal = <?= json_encode(session()->getFlash('show_modal')); ?>;
        const modal = <?= json_encode(session()->getFlash('modal')) ?? ''; ?>;

        if (isShowModal && modal) {
            showModal(modal);
        }
    </script>
</body>

</html>