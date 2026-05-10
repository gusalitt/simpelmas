<?php view()::extend('layouts.error'); ?>

<?php view()::push('content'); ?>
<div class="relative">
    <h1 class="text-8xl md:text-9xl lg:text-[12rem] font-bold tracking-tighter text-red-500/20 select-none">
        500
    </h1>
    <div class="absolute inset-0 flex items-center justify-center">
        <svg class="h-20 w-20 md:h-28 md:w-28 text-red-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </div>
</div>

<div class="mt-6 text-center space-y-3">
    <h2 class="text-2xl md:text-3xl font-bold text-foreground">Terjadi Kesalahan Server</h2>
    <p class="text-muted-foreground max-w-md mx-auto">
        Maaf, terjadi kesalahan pada server kami. Silakan coba lagi beberapa saat.
    </p>
</div>

<div class="mt-8 flex flex-col sm:flex-row gap-4">
    <button onclick="location.reload()" class="btn btn-primary gap-2">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        Coba Lagi
    </button>
    <a href="<?= base_url('/'); ?>" class="btn btn-outline gap-2">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Kembali ke Beranda
    </a>
</div>

<p class="mt-8 text-sm text-muted-foreground text-center">
    Jika masalah berlanjut, silakan hubungi administrator.
</p>
<?php view()::endPush('content'); ?>