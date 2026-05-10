<header id="navbar-wrapper" class="fixed w-full top-0 z-50 transition-all duration-500">
    <nav id="navbar" class="bg-background mx-auto backdrop-blur supports-backdrop-filter:bg-background/50 border border-border transition-all duration-500 w-full rounded-none shadow-none relative">
        <div id="navbar-content" class="container px-5 lg:px-20 py-3 flex items-center justify-between">
            <!-- LOGO -->
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-2">
                <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-8 h-8 mr-2">
                <span class="text-xl font-bold">SIMPELMAS</span>
            </a>

            <!-- MENU DESKTOP & TABLET -->
            <div class="hidden md:flex items-center space-x-2">
                <a href="<?= base_url('/') ?>#home" class="btn btn-ghost px-4 py-2">Beranda</a>
                <a href="<?= base_url('/') ?>#stats" class="btn btn-ghost px-4 py-2">Statistik</a>
                <a href="<?= base_url('/') ?>#solution" class="btn btn-ghost px-4 py-2">Solusi</a>
                <a href="<?= base_url('/') ?>#faq" class="btn btn-ghost px-4 py-2">FAQ</a>
            </div>

            <!-- ACTION BUTTONS & MOBILE MENU TOGGLE -->
            <div class="flex items-center gap-2">
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

                <!-- ACTION BUTTONS - DESKTOP/TABLET -->
                <div class="hidden md:flex items-center space-x-3">
                    <?php
                    $dashboardPath = [
                        'admin' => '/manage',
                        'worker' => '/manage',
                        'citizen' => '/dashboard',
                    ];
                    if (auth()->check()):
                    ?>
                        <a href="<?= base_url($dashboardPath[auth()->user()['role']]); ?>" class="btn btn-primary">Dashboard</a>
                    <?php else: ?>
                        <a href="<?= base_url('/auth/login'); ?>" class="btn btn-primary">Masuk</a>
                        <a href="<?= base_url('/auth/register'); ?>" class="btn btn-outline">Daftar</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Toggle -->
                <button id="mobile-menu-toggle" class="btn btn-ghost btn-icon md:hidden!">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- MOBILE MENU OVERLAY -->
            <div id="mobile-menu" class="absolute md:hidden top-[102%] left-0 right-0 w-full mx-auto bg-background border-t border-border shadow-lg transform -translate-x-[200%] opacity-0 transition-all duration-500 ease-in-out py-5 rounded-none px-4">
                <div class=" flex flex-col space-y-4">
                    <a href="<?= base_url('/') ?>#home" class="btn btn-ghost justify-start py-3 text-lg">Beranda</a>
                    <a href="<?= base_url('/') ?>#stats" class="btn btn-ghost justify-start py-3 text-lg">Statistik</a>
                    <a href="<?= base_url('/') ?>#solution" class="btn btn-ghost justify-start py-3 text-lg">Solusi</a>
                    <a href="<?= base_url('/') ?>#faq" class="btn btn-ghost justify-start py-3 text-lg">FAQ</a>

                    <div class="pt-6 border-t border-border flex flex-col space-y-3 px-5">
                        <?php
                        $dashboardPath = [
                            'admin' => '/manage',
                            'worker' => '/manage',
                            'citizen' => '/dashboard',
                        ];
                        if (auth()->check()):
                        ?>
                            <a href="<?= base_url($dashboardPath[auth()->user()['role']]); ?>" class="btn btn-primary w-full justify-center">Dashboard</a>
                        <?php else: ?>
                            <a href="<?= base_url('/auth/login'); ?>" class="btn btn-primary w-full justify-center">Masuk</a>
                            <a href="<?= base_url('/auth/register'); ?>" class="btn btn-outline w-full justify-center">Daftar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>