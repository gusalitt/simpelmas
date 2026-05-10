<header id="navbar-wrapper" class="fixed w-full top-0 z-50 transition-all duration-500">
    <nav id="navbar" class="bg-background mx-auto backdrop-blur supports-backdrop-filter:bg-background/50 border border-border transition-all duration-500 w-full rounded-none shadow-none relative">
        <div id="navbar-content" class="container px-5 lg:px-20 py-3 md:py-2 flex items-center justify-between">
            <!-- LOGO -->
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-2">
                <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-8 h-8 mr-2">
                <span class="text-xl font-bold">SIMPELMAS</span>
            </a>

            <!-- MENU DESKTOP & TABLET -->
            <div class="hidden md:flex items-center space-x-2">
                <a href="<?= base_url('/dashboard'); ?>" class="nav-link btn btn-ghost px-4 py-2">Dashboard</a>
                <a href="<?= base_url('/complaint/create'); ?>" class="nav-link btn btn-ghost px-4 py-2">Buat Pengaduan</a>
                <a href="<?= base_url('/history'); ?>" class="nav-link btn btn-ghost px-4 py-2">Riwayat</a>
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

                <div class="hidden md:flex items-center gap-2">
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button onclick="toggleProfileDropdown(this)" class="profile-dropdown-trigger flex items-center gap-2 p-2 rounded-full hover:bg-accent transition-colors">
                            <div class="w-10 h-10 rounded-full overflow-hidden border border-muted">
                                <?php if (!empty(auth()->user()['avatar'])): ?>
                                    <img src="<?= upload_url('avatars', auth()->user()['avatar']) ?>"
                                        alt="Profile" class="w-full h-full object-cover rounded-full">
                                <?php else: ?>
                                    <div class="w-full h-full rounded-full bg-primary flex items-center justify-center">
                                        <span class="text-xs font-bold text-background"><?= getInitials(auth()->user()['username']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <span class="hidden md:inline text-sm font-medium"><?= htmlspecialchars(auth()->user()['username']); ?></span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div class="profile-dropdown absolute right-0 mt-2 w-48 rounded-2xl border border-border bg-popover shadow-lg z-50 hidden overflow-hidden">
                            <div class="px-4 py-2 border-b border-border">
                                <p class="text-sm font-medium"><?= htmlspecialchars(auth()->user()['username']); ?></p>
                                <p class="text-xs text-muted-foreground"><?= htmlspecialchars(auth()->user()['email']); ?></p>
                            </div>
                            <a href="<?= base_url('/profile'); ?>" class="flex items-center px-4 py-2 text-sm hover:bg-accent transition-colors">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil Saya
                            </a>
                            <form action="<?= base_url('/auth/logout'); ?>" method="post">
                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="flex items-center w-full px-4 py-2 text-sm hover:bg-accent text-destructive transition-colors">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
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
                    <a href="<?= base_url('/dashboard'); ?>" class="nav-link btn btn-ghost px-4 py-2">Dashboard</a>
                    <a href="<?= base_url('/complaint/create'); ?>" class="nav-link btn btn-ghost px-4 py-2">Buat Pengaduan</a>
                    <a href="<?= base_url('/history'); ?>" class="nav-link btn btn-ghost px-4 py-2">Riwayat</a>

                    <div class="pt-6 border-t border-border flex flex-col items-center justify-center space-y-3 px-5">
                        <div class="flex items-center gap-2">
                            <!-- Profile Dropdown -->
                            <div class="relative">
                                <button onclick="toggleProfileDropdown(this)" class="profile-dropdown-trigger flex items-center gap-2 p-2 rounded-full hover:bg-accent transition-colors">
                                    <div class="w-10 h-10 rounded-full overflow-hidden border border-muted">
                                        <?php if (!empty(auth()->user()['avatar'])): ?>
                                            <img src="<?= upload_url('avatars', auth()->user()['avatar']) ?>"
                                                alt="Profile" class="w-full h-full object-cover rounded-full">
                                        <?php else: ?>
                                            <div class="w-full h-full rounded-full bg-primary flex items-center justify-center">
                                                <span class="text-xs font-bold text-background"><?= getInitials(auth()->user()['username']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <span class="inline text-sm font-medium"><?= htmlspecialchars(auth()->user()['username']); ?></span>
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Profile Dropdown Menu -->
                                <div class="profile-dropdown absolute right-1/2 transform translate-x-1/2 mt-2 w-48 rounded-2xl border border-border bg-popover shadow-lg z-50 hidden overflow-hidden">
                                    <div class="px-4 py-2 border-b border-border">
                                        <p class="text-sm font-medium"><?= htmlspecialchars(auth()->user()['username']); ?></p>
                                        <p class="text-xs text-muted-foreground"><?= htmlspecialchars(auth()->user()['email']); ?></p>
                                    </div>
                                    <a href="<?= base_url('/profile'); ?>" class="flex items-center px-4 py-2 text-sm hover:bg-accent transition-colors">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>
                                    <form action="<?= base_url('/auth/logout'); ?>" method="post">
                                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="flex items-center w-full px-4 py-2 text-sm hover:bg-accent text-destructive transition-colors">
                                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleProfileDropdown(button) {
        const allDropdowns = document.querySelectorAll('.profile-dropdown');
        const currentDropdown = button.nextElementSibling;

        allDropdowns.forEach(dropdown => {
            if (dropdown !== currentDropdown) {
                dropdown.classList.add('hidden');
            }
        });

        currentDropdown.classList.toggle('hidden');
    }

    function closeProfileDropdown() {
        document.querySelectorAll('.profile-dropdown').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }

    // Close modals when clicking outside
    document.addEventListener("click", (e) => {
        if (!e.target.closest('.profile-dropdown') && !e.target.closest('.profile-dropdown-trigger')) {
            closeProfileDropdown();
        }
    });
</script>