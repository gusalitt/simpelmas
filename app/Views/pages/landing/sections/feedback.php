<section id="testimoni">
    <div class="mx-auto">
        <!-- Header -->
        <div class="max-w-2xl mb-10">
            <h2 class="text-3xl font-bold text-foreground mb-3">
                Didengar oleh Masyarakat
            </h2>
            <p class="text-muted-foreground max-w-2xl mx-auto">
                Pengalaman nyata dari masyarakat yang telah menggunakan SIMPELMAS
                dalam menyampaikan aspirasi dan pengaduan.
            </p>
        </div>

        <!-- Marquee Wrapper -->
        <div class=" relative overflow-hidden mx-auto">
            <div class="w-fit animate-marquee hover:[animation-play-state:paused] space-y-4">
                <div class="flex gap-4 w-max">
                    <?php view()::include('pages.landing.components.feedback_marquee1'); ?>
                    <?php view()::include('pages.landing.components.feedback_marquee1'); ?>
                </div>
                <div class="flex gap-4 w-max">
                    <?php view()::include('pages.landing.components.feedback_marquee2'); ?>
                    <?php view()::include('pages.landing.components.feedback_marquee2'); ?>
                </div>
                <div class="flex gap-4 w-max">
                    <?php view()::include('pages.landing.components.feedback_marquee3'); ?>
                    <?php view()::include('pages.landing.components.feedback_marquee3'); ?>
                </div>
            </div>

            <!-- left fade -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-15 md:w-24
                bg-linear-to-r from-background to-transparent"></div>

            <!-- right fade -->
            <div class="pointer-events-none absolute inset-y-0 right-0 w-15 md:w-24
                bg-linear-to-l from-background to-transparent"></div>
        </div>
    </div>
</section>