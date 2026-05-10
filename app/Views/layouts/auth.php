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

<body class="smooth-scroll antialiased relative bg-background">
    <div class="absolute top-2 left-4">
        <div class="flex items-center space-x-4 h-full p-2.5">
            <div class="w-full flex-1/2 lg:w-auto lg:flex-none">
                <div class="flex items-center h-full lg:justify-normal space-x-4">
                    <a href="<?= base_url('/'); ?>" class="btn btn-ghost btn-icon hidden sm:inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>

                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex min-h-screen">
        <?php view()::stack('content'); ?>
    </div>

    <div class="absolute top-2 right-4">
        <div class="flex items-center space-x-4 h-full p-2.5">
            <div class="w-full flex-1/2 lg:w-auto lg:flex-none">
                <div class="flex items-center h-full lg:justify-normal space-x-4">
                    <button id="theme-toggle" class="btn btn-ghost btn-icon hidden sm:inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4.5">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 3l0 18"></path>
                            <path d="M12 9l4.65 -4.65"></path>
                            <path d="M12 14.3l7.37 -7.37"></path>
                            <path d="M12 19.6l8.85 -8.85"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Alert -->
    <?= alert(); ?>

    <script src="<?= base_url('/public/assets/js/helper.js') ?>"></script>
</body>

</html>