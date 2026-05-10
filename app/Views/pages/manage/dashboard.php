<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<?php
$stats = $data['stats'];
$categoryStats = $data['categoryStats'];
$overdueComplaints = $data['overdue'];
$monthlyStats = $data['monthlyStats'];
?>
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Dashboard <?= auth()->user()['role'] === 'admin' ? 'Admin' : 'Petugas' ?></h1>
        <p class="text-muted-foreground mt-2">
            Monitoring pengaduan dan <?= auth()->user()['role'] === 'admin' ? 'analisis kinerja pelayanan' : 'manajemen tugas harian' ?>
        </p>
    </div>

    <!-- Quick Stats -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <button onclick="toggleAccordion('stats-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
            <div class="flex items-center gap-3 py-1">
                <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="font-semibold text-lg">Status Pengaduan</span>
            </div>

            <svg id="stats-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="stats-accordion-content" class="px-6 pb-6 pt-2">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-1">
                <!-- Total Complaint -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-gray-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Total Pengaduan</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($stats['complaint_count'] ?? 0); ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-gray-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- New Complaint -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-yellow-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Pengaduan Baru</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($stats['complaint_new_count'] ?? 0); ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-yellow-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Processing -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-blue-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Diproses</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($stats['complaint_processed_count'] ?? 0); ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-blue-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-background border border-border rounded-[1.2rem] px-4 py-5 hover:border-green-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Selesai</p>
                            <p class="text-2xl font-bold mt-1"><?= htmlspecialchars($stats['complaint_done_count'] ?? 0); ?></p>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-green-500/10 flex items-center justify-center">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SLA -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <button onclick="toggleAccordion('sla-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
            <div class="flex items-center gap-3 py-1">
                <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold text-lg">Pengaduan Terlambat Penanganan</span>
            </div>

            <svg id="sla-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="sla-accordion-content" class="px-6 pb-6 pt-2">
            <div class="space-y-3">
                <!-- Looping data overdue complaints -->
                <?php foreach ($overdueComplaints as $complaint): ?>
                    <div class="bg-background hover:bg-accent/50 transition-all border border-border rounded-[1.2rem] p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <!-- Left Section -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-mono text-sm font-medium"><?= htmlspecialchars($complaint['complaint_code']) ?></span>
                                    <span class="text-xs px-2 py-0.5 rounded-full <?= $complaint['status'] === 'new' ? 'bg-yellow-500/10 text-yellow-600' : 'bg-blue-500/10 text-blue-600' ?>">
                                        <?= htmlspecialchars($complaint['status'] === 'new' ? 'Baru' : 'Diproses'); ?>
                                    </span>
                                    <span class="text-xs text-red-600 font-medium flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Terlambat <?= htmlspecialchars($complaint['overdue_days']); ?> Hari
                                    </span>
                                </div>

                                <p class="text-sm font-medium text-foreground mt-2 line-clamp-1">
                                    <?= htmlspecialchars($complaint['title']) ?>
                                </p>

                                <div class="flex items-center gap-3 mt-1.5 text-xs text-muted-foreground">
                                    <?php if ($complaint['status'] === 'new'): ?>
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Pelapor: <?= htmlspecialchars($complaint['created_by_name'] ?? '-') ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Masuk: <?= formatDate($complaint['created_at']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Petugas: <?= htmlspecialchars($complaint['taken_by_name'] ?? '-') ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Diambil: <?= formatDate($complaint['taken_at']) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Right Section - Badge -->
                            <div class="shrink-0">
                                <span class="text-xs px-3 py-1 rounded-full border 
                                    <?= $complaint['status'] === 'new'
                                        ? 'bg-yellow-500/30 text-yellow-800 dark:text-yellow-300 border-yellow-500/50'
                                        : 'bg-red-500/30 text-red-800 dark:text-red-300 border-red-500/50' ?>">
                                    <?= $complaint['status'] === 'new'
                                        ? 'Melebihi batas tanggap (3 hari)'
                                        : 'Melebihi batas selesai (7 hari)' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($overdueComplaints)): ?>
                    <div class="text-center py-8">
                        <svg class="h-12 w-12 mx-auto text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-muted-foreground mt-2">Semua pengaduan diproses tepat waktu</p>
                        <p class="text-xs text-muted-foreground">Tidak ada pengaduan yang melebihi batas penanganan</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Footer Info -->
            <div class="mt-3 pt-2 text-xs text-muted-foreground border-t border-border/50">
                <span class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-yellow-500"></span>
                    <span>Batas tanggap: 3 hari sejak masuk</span>
                    <span class="inline-block w-2 h-2 rounded-full bg-blue-500 ml-2"></span>
                    <span>Batas selesai: 7 hari sejak diambil</span>
                </span>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row justify-center gap-6">
        <!-- Monthly Chart -->
        <div class="lg:col-span-2 w-full max-h-max bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
            <button onclick="toggleAccordion('chart-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
                <div class="flex items-center gap-3 py-1">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="font-semibold text-lg">Grafik Bulanan</span>
                </div>

                <svg id="chart-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="chart-accordion-content" class="px-6 pb-6 pt-2">
                <div class="space-y-4">
                    <?php
                    function getBarColor($percentage, $color)
                    {
                        return $percentage > 0 ? $color : 'bg-muted';
                    }

                    foreach ($monthlyStats as $month):
                    ?>
                        <div>
                            <div class="flex justify-between text-sm text-muted-foreground mb-1">
                                <span><?= $month['month'] . ' ' . $month['year'] ?></span>
                                <span class="font-medium text-foreground">
                                    Baru <span class="text-yellow-500"> <?= $month['new'] ?> </span>•
                                    Diproses <span class="text-blue-500"> <?= $month['processed'] ?> </span>•
                                    Selesai <span class="text-green-500"> <?= $month['done'] ?> </span>
                                </span>
                            </div>
                            <div class="flex gap-1 h-8">
                                <div class="<?= getBarColor($month['percentages']['new'], 'bg-yellow-500') ?> rounded-l-lg" style="flex: <?= $month['percentages']['new'] ?: 1 ?>"></div>
                                <div class="<?= getBarColor($month['percentages']['processed'], 'bg-blue-500') ?>" style="flex: <?= $month['percentages']['processed'] ?: 1 ?>"></div>
                                <div class="<?= getBarColor($month['percentages']['done'], 'bg-green-500') ?> rounded-r-lg" style="flex: <?= $month['percentages']['done'] ?: 1 ?>"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="flex gap-4 text-xs text-muted-foreground pt-2">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 bg-yellow-500 rounded"></span> Pengaduan Baru</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 bg-blue-500 rounded"></span> Pengaduan Diproses</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 bg-green-500 rounded"></span> Pengaduan Selesai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Category -->
        <div class="bg-card w-full lg:w-[45%] max-h-max border border-border rounded-3xl shadow-sm overflow-hidden">
            <button onclick="toggleAccordion('category-accordion')" class="w-full px-6 py-4 flex items-center justify-between hover:bg-accent/50 transition-colors group">
                <div class="flex items-center gap-3 py-1">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                    </svg>
                    <span class="font-semibold text-lg">Top Kategori</span>
                </div>

                <svg id="category-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="category-accordion-content" class="px-6 pb-6 pt-2">
                <div class="space-y-4">
                    <?php
                    $colors = [
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

                    foreach ($categoryStats as $category):
                        $color = $colors[array_rand($colors)];
                    ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full <?= $color ?>"></div>
                                <span class="font-medium"><?= $category['name']; ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold"><?= $category['complaint_count']; ?></span>
                                <span class="text-xs text-muted-foreground">pengaduan</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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