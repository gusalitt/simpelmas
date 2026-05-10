<header class="fixed top-0 z-40 left-0 lg:left-64 right-0 border-b bg-background/95 backdrop-blur supports-backdrop-filter:bg-background/60 py-1">
    <div class="w-full flex h-full justify-between items-center px-4">
        <button id="mobile-menu-toggle" class="btn btn-ghost p-2 lg:hidden!" aria-expanded="false">
            <svg class="w-5 h-5 menu-icon" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
            </svg>
            <svg class="w-5 h-5 close-icon hidden" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
            </svg>
        </button>

        <?php
        $labels = [
            'worker' => [
                'text' => 'Petugas',
                'class' => 'bg-green-500/30 text-green-800 dark:text-green-300'
            ],
            'admin' => [
                'text' => 'Admin',
                'class' => 'bg-purple-500/30 text-purple-800 dark:text-purple-300'
            ],
        ];
        $label = $labels[auth()->user()['role']];
        ?>

        <div class="mr-4 md:flex">
            <div class="mr-6 flex items-center space-x-3">
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
                <span class="font-bold lg:inline-block text-lg"><?= auth()->user()['username']; ?></span>
                <span class="w-1.5 h-1.5 rounded-full bg-foreground"></span>
                <span class="<?= $label['class']; ?> text-[11px] px-2 py-0.5 rounded-full">
                    <?= $label['text']; ?>
                </span>
            </div>
        </div>

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
</header>