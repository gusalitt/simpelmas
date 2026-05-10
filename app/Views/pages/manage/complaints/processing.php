<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Pengaduan Diproses</h1>
        <p class="text-muted-foreground mt-2">Pengaduan yang sedang dalam penanganan tim</p>
    </div>

    <!-- Action Bar -->
    <div class="bg-card border border-border rounded-3xl p-4 shadow-sm">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari kode pengaduan atau judul..."
                    class="input" />
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap gap-3">
                <select id="filter-category" class="input md:w-max! pl-3!">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?= $category['name']; ?>"><?= $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Sort Button -->
                <button id="sort-btn" class="btn btn-secondary rounded-2xl! gap-2 w-full md:w-max">
                    <span id="sort-icon"></span>
                    <span id="sort-text"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pengaduan</th>
                        <th>Pelapor</th>
                        <th>Judul / Ringkasan</th>
                        <th>Kategori</th>
                        <th>Diambil Oleh</th>
                        <th>Diambil Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data will be populated by JavaScript -->
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden py-16 text-center">
            <div class="flex justify-center mb-4">
                <div class="p-4 rounded-full bg-muted">
                    <svg class="h-8 w-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-foreground mb-2">Tidak Ada Pengaduan Yang Diproses</h3>
            <p class="text-sm text-muted-foreground max-w-sm mx-auto">Semua pengaduan yang diproses sudah ditangani. Istirahat sejenak atau cek halaman Pengaduan Selesai.</p>
        </div>

        <!-- Table Footer -->
        <div id="table-footer"></div>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    const complaints = <?= json_encode($data['complaints']) ?? []; ?> ?? [];
    const dataMap = Object.fromEntries(complaints.map(complaint => [complaint.id, complaint]));
    const viewLink = `<?= base_url('/manage/complaint/processing/detail/') ?>`;

    new DataTable({
        data: complaints,
        tableBody: "#table-body",
        searchInput: "#search-input",
        filterSelect: "#filter-category",
        filterKey: "category_name",
        sortButton: "#sort-btn",

        tableFooter: "#table-footer",
        emptyState: "#empty-state",
        rowTemplate: (complaint, index) => {
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td><span class="text-sm font-semibold text-foreground">${escapeHtml(complaint.complaint_code)}</span></td>
                    <td><span class="text-sm text-muted-foreground">${escapeHtml(complaint.created_by)}</span></td>
                    <td>
                        <p class="text-sm text-foreground font-medium">${escapeHtml(complaint.title)}</p>
                        <p class="text-xs text-muted-foreground mt-0.5 truncate max-w-xs">${escapeHtml(complaint.content)}</p>
                    </td>
                    <td><span class="text-sm text-muted-foreground">${escapeHtml(complaint.category_name)}</span></td>
                    <td><span class="text-sm text-foreground">${escapeHtml(complaint.taken_by_name)}</span></td>
                    <td><span class="text-sm text-foreground">${escapeHtml(formatDate(complaint.created_at))}</span></td>
                    <td>
                        <a href="${viewLink + escapeHtml(complaint.id)}"" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            `;
        }
    });
</script>
<?php view()::endPush('scripts'); ?>