<section id="how-it-works">
    <!-- Header -->
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-foreground mb-3">Cara Kerja SIMPELMAS</h2>
        <p class="text-muted-foreground max-w-2xl mx-auto">
            Sistem pengaduan masyarakat yang transparan dan efisien dalam 4 langkah
        </p>
    </div>

    <!-- Steps Container -->
    <div class="mx-auto">
        <!-- Step Connector -->
        <?php view()::include('pages.landing.components.step_indicator');  ?>

        <!-- Steps Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 Card -->
            <div class="bg-card rounded-3xl p-8 border border-border hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-6">
                        <svg class="size-7 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5 20v-2a7 7 0 0 1 14 0v2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19 3 L22 3 M20.5 1.5 L20.5 4.5" stroke="currentColor" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm text-muted-foreground font-medium">Langkah 1</span>
                        <h3 class="text-xl font-bold text-foreground mt-2">Registrasi Akun</h3>
                    </div>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Warga melakukan pendaftaran akun terlebih dahulu melalui aplikasi SIMPELMAS dengan mengisi data diri (nama, email, nomor telepon dan password) untuk dapat mengakses layanan pengaduan.
                    </p>
                </div>
            </div>

            <!-- Step 2 Card -->
            <div class="bg-card rounded-3xl p-8 border border-border hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-6">
                        <svg class="size-7 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 4h8l6 6v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 4v6h6" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <line x1="8" y1="12" x2="16" y2="12" stroke="currentColor" stroke-linecap="round" />
                            <line x1="8" y1="16" x2="14" y2="16" stroke="currentColor" stroke-linecap="round" />
                            <path d="M19 2 L22 5 M20.5 3.5 L22 2" stroke="currentColor" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm text-muted-foreground font-medium">Langkah 2</span>
                        <h3 class="text-xl font-bold text-foreground mt-2">Buat Laporan</h3>
                    </div>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Warga mengisi laporan dengan deskripsi lengkap, melampirkan foto bukti, dan menandai lokasi kejadian melalui aplikasi SIMPELMAS.
                    </p>
                </div>
            </div>

            <!-- Step 3 Card -->
            <div class="bg-card rounded-3xl p-8 border border-border hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-6">
                        <svg class="size-7 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2L3 6v6c0 5.5 9 10 9 10s9-4.5 9-10V6l-9-4z" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm text-muted-foreground font-medium">Langkah 3</span>
                        <h3 class="text-xl font-bold text-foreground mt-2">Verifikasi & Respon Petugas</h3>
                    </div>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Laporan diverifikasi oleh petugas berwenang untuk memastikan kelengkapan data dan validitas informasi. Petugas kemudian memberikan respon awal dan menindaklanjuti laporan sesuai prosedur.
                    </p>
                </div>
            </div>

            <!-- Step 4 Card -->
            <div class="bg-card rounded-3xl p-8 border border-border hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-6">
                        <svg class="size-7 text-muted-foreground" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
                        </svg>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm text-muted-foreground font-medium">Langkah 4</span>
                        <h3 class="text-xl font-bold text-foreground mt-2">Pantau Status & Perkembangan</h3>
                    </div>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Warga dapat memantau progres penanganan laporan secara real-time melalui dashboard aplikasi kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>