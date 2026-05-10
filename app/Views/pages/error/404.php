<?php view()::extend('layouts.error'); ?>

<?php view()::push('content'); ?>
<div class="relative">
    <h1 class="text-8xl md:text-9xl lg:text-[12rem] font-bold tracking-tighter text-primary/20 select-none">
        404
    </h1>
    <div class="absolute inset-0 flex items-center justify-center">
        <svg class="h-20 w-20 md:h-28 md:w-28 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
</div>

<div class="mt-6 text-center space-y-3">
    <h2 class="text-2xl md:text-3xl font-bold text-foreground">Halaman Tidak Ditemukan</h2>
    <p class="text-muted-foreground max-w-md mx-auto">
        Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
    </p>
</div>

<div class="mt-8 flex flex-col sm:flex-row gap-4">
    <button onclick="history.back()" class="btn btn-primary gap-2">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
    </button>
    <a href="<?= base_url('/'); ?>" class="btn btn-outline gap-2">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Kembali ke Beranda
    </a>
</div>

<p class="mt-8 text-sm text-muted-foreground text-center">
    Atau cek kembali URL yang Anda masukkan
</p>
<?php view()::endPush('content'); ?>