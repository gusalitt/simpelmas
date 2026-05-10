<?php view()::extend('layouts.auth'); ?>

<?php view()::push('content'); ?>
<div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-10">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="mb-8">
            <div class="flex items-center gap-3">
                <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-10 h-10">
                <span class="text-xl font-bold text-foreground">SIMPELMAS</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-foreground mt-6">Masuk ke Akun</h1>
            <p class="text-sm text-muted-foreground mt-1">Silakan masukkan kredensial Anda</p>
        </div>

        <!-- Form -->
        <form method="POST" action="<?= base_url('/auth/login'); ?>" class="space-y-5">
            <!-- Email -->
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-foreground">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <input type="email" name="email" placeholder="Masukkan email" class="input pl-10 w-full" value="<?= old('email'); ?>" required>
                </div>
                <p class="text-destructive text-xs"><?= error('email'); ?></p>
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-foreground">Password</label>
                <div class="relative password-wrapper">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>

                    <input type="password" name="password" placeholder="Masukkan password" class="input pl-10 pr-10 w-full password-input" required>

                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                        <svg class="eye-open h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg class="eye-closed h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>

                    </button>
                </div>
                <p class="text-destructive text-xs"><?= error('password'); ?></p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full gap-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Masuk
            </button>

            <!-- Register Link -->
            <p class="text-center text-sm text-muted-foreground">
                Belum punya akun?
                <a href="<?= base_url('/auth/register'); ?>" class="text-primary font-medium hover:underline">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>

<div class="hidden lg:block lg:w-1/2 bg-linear-to-br from-primary/10 via-primary/5 to-transparent border-l border-border">
    <div class="h-full flex flex-col items-center justify-center p-10 text-center">
        <!-- Big Icon -->
        <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-24 h-24 mb-2">
        <h2 class="text-2xl font-bold tracking-tight text-foreground">SIMPELMAS</h2>
        <p class="text-sm text-muted-foreground mt-1">Sistem Pengaduan & Laporan Masyarakat</p>

        <div class="w-12 h-0.5 bg-primary/30 my-6"></div>

        <div class="space-y-4 text-left w-full max-w-sm">
            <!-- Feature 1 -->
            <div class="flex items-start gap-3">
                <div class="p-1.5 rounded-lg bg-primary/10 shrink-0">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-foreground">Laporkan dengan Mudah</p>
                    <p class="text-xs text-muted-foreground">Sampaikan pengaduan Anda dalam hitungan menit</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-start gap-3">
                <div class="p-1.5 rounded-lg bg-primary/10 shrink-0">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-foreground">Pantau Status</p>
                    <p class="text-xs text-muted-foreground">Lihat perkembangan pengaduan Anda secara real-time</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-start gap-3">
                <div class="p-1.5 rounded-lg bg-primary/10 shrink-0">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.746 3.746 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-foreground">Transparan & Akuntabel</p>
                    <p class="text-xs text-muted-foreground">Setiap laporan diproses sesuai standar pelayanan</p>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 p-4 bg-background/50 rounded-2xl border border-border w-full max-w-sm">
            <p class="text-xs text-center text-muted-foreground">
                <span class="font-semibold text-primary">24/7</span> Layanan Pengaduan Masyarakat
            </p>
        </div>
    </div>
</div>
<?php view()::endPush('content'); ?>