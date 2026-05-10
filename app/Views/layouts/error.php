<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Error'; ?> | SIMPELMAS</title>
    <link rel="shortcut icon" href="<?= base_url('/public/assets/img'); ?>" id="dynamic-favicon" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/output.css') ?>">
</head>

<body class="smooth-scroll antialiased relative bg-background">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-16">
        <?php view()::stack('content'); ?>
    </div>

    <script>
        const theme = localStorage.getItem("theme") || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");

        if (theme === "dark") {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }

        const favicon = document.getElementById("dynamic-favicon");
        const faviconHref = favicon.getAttribute("href");
        favicon.href = faviconHref + (theme === "light" ? "/simpelmas-dark.svg" : "/simpelmas-light.svg");
    </script>
</body>

</html>