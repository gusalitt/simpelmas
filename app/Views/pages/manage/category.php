<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Kelola Kategori</h1>
            <p class="text-muted-foreground mt-2">Daftar kategori pengaduan yang tersedia</p>
        </div>
        <button onclick="openAddModal()" class="btn btn-primary gap-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-card border border-border rounded-3xl p-4 shadow-sm">
        <div class="flex flex-1 w-full gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari kategori..."
                    class="input pl-9!" />
            </div>
        </div>

        <!-- Sort Button -->
        <button id="sort-btn" class="btn btn-secondary rounded-2xl! gap-2 w-full md:w-max">
            <span id="sort-icon"></span>
            <span id="sort-text"></span>
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Pengaduan</th>
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
                            d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0l6.172-6.172a2 2 0 000-2.828L12 3H5a2 2 0 00-2 2v6z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-foreground mb-2">Tidak Ada Kategori</h3>
            <p class="text-sm text-muted-foreground max-w-sm mx-auto">
                Belum ada data kategori. Klik tombol "Tambah Kategori" untuk menambahkan.
            </p>
        </div>

        <!-- Table Footer -->
        <div id="table-footer"></div>
    </div>
</div>

<!-- Add / Edit Category Modal -->
<?php view()::include('pages.manage.modals.category_modal'); ?>

<!-- Delete Category Modal -->
<?php view()::include('pages.manage.modals.category_delete_modal'); ?>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    const categories = <?= json_encode($categories) ?? []; ?> ?? [];
    const dataMap = Object.fromEntries(categories.map(category => [category.id, category]));

    new DataTable({
        data: categories,
        tableBody: "#table-body",
        searchInput: "#search-input",
        sortButton: "#sort-btn",

        tableFooter: "#table-footer",
        emptyState: "#empty-state",
        rowTemplate: (category, index) => {
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <span class="text-sm font-medium text-foreground">${escapeHtml(category.name)}</span>
                    </td>
                    <td>
                        <p class="text-sm text-muted-foreground">${escapeHtml(category.description)}</p>
                    </td>
                    <td>
                        <span class="text-sm text-foreground">${escapeHtml(category.complaint_count)}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <button onclick="openEditModal('${escapeHtml(category.id)}')" class="p-2 hover:bg-accent rounded-xl transition-colors cursor-pointer" title="Edit">
                                <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal('${escapeHtml(category.id)}')" class="p-2 hover:bg-accent rounded-xl transition-colors cursor-pointer" title="Hapus">
                                <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }
    });

    function openAddModal() {
        const form = document.querySelector('#category-form');
        form.action = `<?= base_url('/manage/category/create'); ?>`;

        document.getElementById('id').value = '';
        document.getElementById('modal-title').textContent = 'Tambah Kategori Baru';
        document.getElementById('category-name').value = '';
        document.getElementById('category-description').value = '';

        showModal('category-modal');
    }

    function openEditModal(id) {
        const category = dataMap[id];
        const form = document.querySelector('#category-form');
        form.action = `<?= base_url('/manage/category/update'); ?>`;

        fillForm(form, category);
        document.getElementById('modal-title').innerText = 'Edit Kategori';
        document.getElementById('id').value = id;
        showModal('category-modal');
    }

    function openDeleteModal(id) {
        const category = dataMap[id];
        const form = document.querySelector('#category-delete-form');

        fillForm(form, category);
        showModal('delete-modal');
    }
</script>
<?php view()::endPush('scripts'); ?>