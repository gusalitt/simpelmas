<?php view()::extend('layouts.landing'); ?>

<?php view()::push('content'); ?>
<section class="pb-0 pt-50">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-foreground mb-6">Tentang <span class="text-primary">SIMPELMAS</span></h1>
        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
            Sistem Informasi Pengaduan Laporan Masyarakat yang hadir untuk memudahkan masyarakat dalam menyampaikan aspirasi dan pengaduan secara transparan, cepat, dan akuntabel.
        </p>
    </div>
</section>

<section>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-card overlay rounded-3xl p-8 border border-border">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Visi</h3>
                <p class="text-muted-foreground leading-relaxed">
                    Menjadi platform pengaduan masyarakat yang terpercaya, transparan, dan responsif dalam mewujudkan pelayanan publik yang prima serta mendorong terciptanya good governance di Indonesia.
                </p>
            </div>

            <div class="bg-card overlay rounded-3xl p-8 border border-border">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Misi</h3>
                <ul class="space-y-3 text-muted-foreground">
                    <li class="flex gap-2">• Menyediakan platform pengaduan yang mudah diakses oleh seluruh lapisan masyarakat.</li>
                    <li class="flex gap-2">• Memastikan setiap pengaduan diproses secara cepat, tepat, dan transparan.</li>
                    <li class="flex gap-2">• Menjaga kerahasiaan dan keamanan data pelapor.</li>
                    <li class="flex gap-2">• Mendorong akuntabilitas instansi pemerintah dalam menangani pengaduan masyarakat.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mb-10">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Fitur Unggulan</h2>
            <p class="text-muted-foreground">Berbagai kemudahan yang kami sediakan untuk Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-card overlay rounded-2xl p-6 border border-border text-center">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-2">Mudah Digunakan</h4>
                <p class="text-sm text-muted-foreground">Proses pelaporan sederhana, cepat, dan dapat dilakukan dari mana saja.</p>
            </div>

            <div class="bg-card overlay rounded-2xl p-6 border border-border text-center">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-2">Terpercaya & Aman</h4>
                <p class="text-sm text-muted-foreground">Data Anda terlindungi dengan sistem enkripsi yang aman.</p>
            </div>

            <div class="bg-card overlay rounded-2xl p-6 border border-border text-center">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-2">Responsif</h4>
                <p class="text-sm text-muted-foreground">Setiap laporan diproses cepat dan dapat dipantau statusnya secara real-time.</p>
            </div>

            <div class="bg-card overlay rounded-2xl p-6 border border-border text-center">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 10v8m12-8v8M5 6h14a1 1 0 011 1v1H4V7a1 1 0 011-1z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-2">Transparan</h4>
                <p class="text-sm text-muted-foreground">Seluruh proses penanganan laporan dapat diakses dan dipantau secara terbuka.</p>
            </div>
        </div>
    </div>
</section>

<div class="bg-secondary w-full">
    <section>
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Menyampaikan Pengaduan?</h2>
            <p class="text-muted-foreground mb-8 max-w-xl mx-auto">
                Bergabunglah dengan ribuan masyarakat lainnya yang sudah menggunakan SIMPELMAS.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="<?= base_url('/complaint/create') ?>" class="btn btn-primary gap-2">
                    <svg class="h-5 w-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    Buat Pengaduan Sekarang
                </a>
            </div>
        </div>
    </section>
</div>
<?php view()::endPush('content'); ?>