<section id="home">
    <div class="flex flex-col items-center justify-center pt-5">
        <div class="relative rounded-full px-5 py-2 mb-4 bg-linear-to-r from-primary/10 via-primary/5 to-transparent backdrop-blur-sm">
            <div class="text-sm font-medium text-foreground/80 tracking-wide flex flex-col md:flex-row items-center justify-center">
                <div class="font-semibold text-foreground flex items-center gap-2">
                    <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-4 h-4">
                    <span class="text-primary">SIMPELMAS</span>
                </div>
                <span class="mx-2 opacity-50 text-xs md:text-sm">Sistem Pengaduan & Laporan Masyarakat</span>
            </div>
        </div>

        <div class="max-w-4xl flex flex-col items-center justify-center mb-[3.9rem]">
            <h1 class="text-center text-4xl md:text-[4rem] font-extrabold leading-tight mb-6 flex flex-col gap-2">
                <span>Pengaduan yang Mudah</span>
                <span>Proses yang Transparan</span>
            </h1>
            <p class="text-center text-muted-foreground mb-8 leading-relaxed max-w-4xl">
                Sistem pengaduan dan laporan masyarakat yang mudah digunakan dengan tracking lengkap. Lapor cepat, pantau jelas, selesai tuntas. SIMPELMAS memastikan setiap pengaduan Anda tercatat, terproses, dan tertangani dengan akuntabilitas penuh.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-max">
                <a href="<?= base_url('/complaint/create'); ?>" class="btn btn-primary h-10! gap-2">
                    <svg class="h-5 w-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    Buat Pengaduan
                </a>
                <a href="<?= base_url('/about') ?>" class="btn btn-outline h-10! gap-2">
                    <svg class="h-5 w-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"></path>
                    </svg>
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <!-- Marquee -->
        <div class="relative overflow-hidden container md:max-w-2xl mx-auto">
            <div class="flex w-fit animate-marquee hover:[animation-play-state:paused] space-x-8">
                <div class="flex gap-12 items-center whitespace-nowrap shrink-0">
                    <?php view()::include('pages.landing.components.feature_marquee'); ?>
                </div>
                <div class="flex gap-12 items-center whitespace-nowrap shrink-0">
                    <?php view()::include('pages.landing.components.feature_marquee'); ?>
                </div>
            </div>

            <!-- left fade -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-20 md:w-30
                bg-linear-to-r from-background to-transparent"></div>

            <!-- right fade -->
            <div class="pointer-events-none absolute inset-y-0 right-0 w-20 md:w-30
                bg-linear-to-l from-background to-transparent"></div>
        </div>
    </div>
</section>