<?php view()::extend('layouts.user'); ?>

<?php view()::push('content'); ?>
<?php
$categoryColors = [
    'bg-blue-500',
    'bg-green-500',
    'bg-purple-500',
    'bg-yellow-500',
    'bg-pink-500',
    'bg-indigo-500',
    'bg-red-500',
    'bg-teal-500',
    'bg-orange-500',
    'bg-cyan-500'
];
$statusColor = [
    'new' => [
        'text' => "Baru",
        'color' => "bg-yellow-500/30 text-yellow-800 dark:text-yellow-300"
    ],
    'processed' => [
        'text' => "Diproses",
        'color' => "bg-blue-500/30 text-blue-800 dark:text-blue-300"
    ],
    'done' => [
        'text' => "Selesai",
        'color' => "bg-green-500/30 text-green-800 dark:text-green-300"
    ],
];
?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-muted-foreground mt-2">Kelola pengaduan Anda dengan mudah</p>
        </div>

        <div class="flex items-center gap-3 mt-4 md:mt-0">
            <a href="<?= base_url('/complaint/create'); ?>" class="btn btn-primary gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pengaduan
            </a>
            <a href="<?= base_url('/history'); ?>" class="btn btn-outline gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Lihat Riwayat
            </a>
        </div>
    </div>

    <!-- Quick Stats Accordion -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <button onclick="toggleAccordion('stats-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
            <div class="flex items-center gap-3 py-1">
                <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="font-semibold text-lg">Statistik</span>
            </div>

            <svg id="stats-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="stats-accordion-content" class="px-6 pb-6 pt-2">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-1">
                <!-- Complaint Total -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-primary/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Total Laporan</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($data['stats']['complaint_count'] ?? 0) ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-primary/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2H5v14h14V5h-4V3h6v16H3V3h6z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Waiting Complaint -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-yellow-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Baru</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($data['stats']['complaint_new_count'] ?? 0) ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-yellow-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Processing Complaint -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-blue-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Diproses</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($data['stats']['complaint_processed_count'] ?? 0) ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Finished Complaint -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-green-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Selesai</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($data['stats']['complaint_done_count'] ?? 0) ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-green-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <button onclick="toggleAccordion('complaints-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
            <div class="flex items-center gap-3 py-1">
                <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="font-semibold text-lg">Aktivitas Terbaru</span>
            </div>

            <svg id="complaints-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="complaints-accordion-content" class="px-6 pb-6 pt-2">
            <div class="space-y-3">
                <?php if (!empty($data['recentComplaints'])) : ?>
                    <?php
                    foreach ($data['recentComplaints'] as $complaint) :
                        $categoryColor = $categoryColors[array_rand($categoryColors)];
                    ?>
                        <div class="flex items-center justify-between px-4 py-3 border border-border rounded-[1.2rem] hover:bg-accent/50 transition-all hover:border-muted-500/30 group">
                            <div class="flex items-center gap-3">
                                <div>
                                    <h3 class="font-medium"><?= htmlspecialchars($complaint['title']) ?></h3>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <p class="text-sm text-muted-foreground flex items-center gap-1.5 mt-1">
                                            <span class="inline-block h-1.5 w-1.5 rounded-full <?= $categoryColor ?>"></span>
                                            <?= htmlspecialchars($complaint['category_name']) ?>
                                        </p>
                                        <span class="text-xs text-muted-foreground">• <?= htmlspecialchars($complaint['created_at']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-2.5 py-1.5 text-xs font-medium rounded-full border <?= $statusColor[$complaint['status']]['color']; ?>"><?= $statusColor[$complaint['status']]['text']; ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted-foreground">Tidak ada aktivitas terbaru</div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    function toggleAccordion(id) {
        const content = document.getElementById(`${id}-content`);
        const icon = document.getElementById(`${id}-icon`);

        if (content.classList.contains("hidden")) {
            content.classList.remove("hidden");
            icon.classList.add("rotate-180");
        } else {
            content.classList.add("hidden");
            icon.classList.remove("rotate-180");
        }
    }
</script>
<?php view()::endPush('scripts'); ?>