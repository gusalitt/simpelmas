<footer class="border-t border-border bg-background pb-8!">
    <!-- Top Content -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

        <!-- Brand -->
        <div>
            <h3 class="text-3xl font-bold text-foreground mb-3">SIMPELMAS</h3>
            <p class="text-muted-foreground max-w-2xl mx-auto text-sm">Sistem Informasi Pelaporan Masyarakat yang membantu menyampaikanlaporan secara aman, transparan, dan terpantau.</p>
        </div>

        <!-- Produk -->
        <div>
            <h4 class="text-sm font-semibold text-foreground mb-4">Produk</h4>
            <ul class="space-y-3 text-sm">
                <li>
                    <a href="<?= base_url('/about') ?>" class="text-muted-foreground hover:text-foreground transition">Tentang SIMPELMAS</a>
                </li>
                <li>
                    <a href="<?= base_url('/') ?>#how-it-works" class="text-muted-foreground hover:text-foreground transition">Cara Kerja</a>
                </li>
                <li>
                    <a href="<?= base_url('/') ?>" class="text-muted-foreground hover:text-foreground transition">Fitur Utama</a>
                </li>
            </ul>
        </div>

        <!-- Bantuan -->
        <div>
            <h4 class="text-sm font-semibold text-foreground mb-4">Bantuan</h4>
            <ul class="space-y-3 text-sm">
                <li>
                    <a href="<?= base_url('/') ?>#faq" class="text-muted-foreground hover:text-foreground transition">FAQ</a>
                </li>
                <li>
                    <a href="<?= base_url('/') ?>" class="text-muted-foreground hover:text-foreground transition">Panduan Penggunaan</a>
                </li>
                <li>
                    <a href="<?= base_url('/') ?>" class="text-muted-foreground hover:text-foreground transition">Hubungi Kami</a>
                </li>
            </ul>
        </div>

        <!-- Legal -->
        <div>
            <h4 class="text-sm font-semibold text-foreground mb-4">Legal</h4>
            <ul class="space-y-3 text-sm">
                <li>
                    <a href="<?= base_url('/') ?>" class="text-muted-foreground hover:text-foreground transition">Kebijakan Privasi</a>
                </li>
                <li>
                    <a href="<?= base_url('/') ?>" class="text-muted-foreground hover:text-foreground transition">Syarat & Ketentuan</a>
                </li>
            </ul>
        </div>

    </div>

    <!-- Bottom -->
    <div class="mt-14 pt-6 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-muted-foreground">
        <p>© <?= date('Y'); ?> SIMPELMAS. Seluruh hak cipta dilindungi.</p>
        <p>Mendukung transparansi dan pelayanan publik.</p>
    </div>

</footer>