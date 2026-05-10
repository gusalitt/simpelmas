<?php view()::extend('layouts.user'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <!-- Page Title -->
    <div class="mb-8 text-center">
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Riwayat Pengaduan</h1>
        <p class="text-muted-foreground mt-2 max-w-xl mx-auto">Lihat dan lacak status pengaduan yang telah Anda kirimkan</p>
    </div>

    <!-- Filter & Search Card -->
    <div class="bg-card border border-border rounded-3xl shadow-xl overflow-hidden">
        <div class="p-5 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <svg class="h-5.5 w-5.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h2 class="text-xl font-semibold tracking-tight">Riwayat Pengaduan</h2>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Sort Button -->
                    <button id="sort-btn" class="btn btn-secondary rounded-2xl! gap-2 w-full md:w-max">
                        <span id="sort-icon"></span>
                        <span id="sort-text"></span>
                    </button>

                    <!-- Status Filter Select -->
                    <div class="relative">
                        <select id="status-filter" class="input pl-2!">
                            <option value="">Semua Status</option>
                            <option value="new">Baru</option>
                            <option value="processed">Diproses</option>
                            <option value="done">Selesai</option>
                        </select>
                    </div>
                    <div class="relative flex-1 sm:flex-initial">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2">
                            <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="search"
                            id="search-input"
                            placeholder="Cari pengaduan..."
                            class="input" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pengaduan</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden py-16 text-center">
            <div class="flex justify-center mb-4">
                <div class="p-4 rounded-full bg-muted">
                    <svg class="h-8 w-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-foreground mb-2">Belum Ada Riwayat Pengaduan</h3>
            <p class="text-sm text-muted-foreground max-w-sm mx-auto">
                Anda belum pernah membuat pengaduan. Klik tombol "Buat Pengaduan" untuk melaporkan masalah.
            </p>
            <div class="mt-6">
                <a href="<?= base_url('/complaint/create'); ?>" class="btn btn-primary gap-2 inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Pengaduan
                </a>
            </div>
        </div>

        <!-- Table Footer -->
        <div id="table-footer"></div>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    const complaints = <?= json_encode($complaints) ?? []; ?> ?? [];
    const viewLink = `<?= base_url('/complaint/detail/') ?>`;
    const categoryColors = [
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
    const statusColor = {
        new: {
            text: 'Baru',
            color: 'bg-yellow-500/30 text-yellow-800 dark:text-yellow-300',
        },
        processed: {
            text: 'Diproses',
            color: 'bg-blue-500/30 text-blue-800 dark:text-blue-300',
        },
        done: {
            text: 'Selesai',
            color: 'bg-green-500/30 text-green-800 dark:text-green-300',
        },
    }
    new DataTable({
        data: complaints,
        tableBody: "#table-body",
        searchInput: "#search-input",
        filterSelect: "#status-filter",
        filterKey: "status",
        sortButton: "#sort-btn",

        tableFooter: "#table-footer",
        emptyState: "#empty-state",
        rowTemplate: (complaint, index) => {
            const color = categoryColors[Math.floor(Math.random() * categoryColors.length)];
            return `
                <tr>
                    <td>
                        <span class="text-sm font-medium">${index + 1}</span>
                    </td>
                    <td>
                        <span class="font-mono text-sm font-medium">${escapeHtml(complaint.complaint_code)}</span>
                    </td>
                    <td>
                        <p class="font-medium">${escapeHtml(complaint.title)}</p>
                        <p class="text-sm text-muted-foreground flex items-center gap-1.5 mt-1">
                            <span class="inline-block h-1.5 w-1.5 rounded-full ${color}"></span>
                            ${escapeHtml(complaint.category_name)}
                        </p>
                    </td>
                    <td class="p-3 text-sm">${escapeHtml(formatDate(complaint.created_at))}</td>
                    <td>
                        <span class="px-2.5 py-1 ${statusColor[complaint.status].color} text-xs font-medium rounded-full">${escapeHtml(statusColor[complaint.status].text)}</span>
                    </td>
                    <td>
                        <a href="${viewLink + escapeHtml(complaint.id)}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            `;
        }
    });
</script>
<?php view()::endPush('scripts'); ?>