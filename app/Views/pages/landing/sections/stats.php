<div class="bg-secondary w-full" id="stats">
    <section class="py-20! my-20">
        <div class="flex flex-col md:flex-row items-center justify-center md:justify-between gap-20 w-full mx-auto">
            <!-- Header Minimal -->
            <div class="text-center md:text-left w-full">
                <h2 class="text-3xl font-bold text-foreground">Statistik SIMPELMAS</h2>
                <p class="text-muted-foreground">Transparansi dalam pelayanan masyarakat</p>
            </div>

            <!-- Single Row Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 w-full">

                <div class="text-center">
                    <div class="text-3xl font-bold text-foreground mb-1"><?= htmlspecialchars($stats['complaint_count']) ?></div>
                    <div class="text-sm text-muted-foreground">Total Laporan</div>
                </div>

                <div class="text-center">
                    <div class="text-3xl font-bold text-foreground mb-1"><?= htmlspecialchars($stats['complaint_new_count']) ?></div>
                    <div class="text-sm text-muted-foreground">Laporan Terbaru</div>
                </div>

                <div class="text-center">
                    <div class="text-3xl font-bold text-foreground mb-1"><?= htmlspecialchars($stats['complaint_processed_count']) ?></div>
                    <div class="text-sm text-muted-foreground">Sedang Ditangani</div>
                </div>

                <div class="text-center">
                    <div class="text-3xl font-bold text-foreground mb-1"><?= htmlspecialchars($stats['complaint_done_count']) ?></div>
                    <div class="text-sm text-muted-foreground">Laporan Selesai</div>
                </div>

            </div>
        </div>
    </section>
</div>