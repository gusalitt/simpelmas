<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Kelola Pengguna</h1>
            <p class="text-muted-foreground mt-2">Daftar pengguna sistem (Petugas & Masyarakat)</p>
        </div>
        <button onclick="openAddModal()" class="btn btn-primary gap-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pengguna
        </button>
    </div>

    <!-- Action Bar -->
    <div class="bg-card border border-border rounded-3xl p-4 shadow-sm">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search Input -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari pengguna..."
                    class="input" />
            </div>

            <div class="flex flex-wrap gap-3">
                <select id="filter-role" class="input md:w-max! pl-3!">
                    <option value="">Semua Role</option>
                    <option value="worker">Petugas</option>
                    <option value="citizen">Masyarakat</option>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Role</th>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-foreground mb-2">Tidak Ada Pengguna</h3>
            <p class="text-sm text-muted-foreground max-w-sm mx-auto">Belum ada data pengguna. Klik tombol "Tambah Pengguna" untuk menambahkan.</p>
        </div>

        <!-- Table Footer -->
        <div id="table-footer"></div>
    </div>
</div>

<!-- Add / Edit User Modal -->
<?php view()::include('pages.manage.modals.user_modal'); ?>
<!-- Delete User Modal -->
<?php view()::include('pages.manage.modals.user_delete_modal'); ?>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    const users = <?= json_encode($users) ?? []; ?> ?? [];
    const dataMap = Object.fromEntries(users.map(user => [user.id, user]));

    new DataTable({
        data: users,
        tableBody: "#table-body",
        searchInput: "#search-input",
        filterSelect: "#filter-role",
        filterKey: "role",
        sortButton: "#sort-btn",

        tableFooter: "#table-footer",
        emptyState: "#empty-state",
        rowTemplate: (user, index) => {
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <span class="text-sm font-medium text-foreground">${escapeHtml(user.username)}</span>
                    </td>
                    <td>
                        <span class="text-sm text-muted-foreground">${escapeHtml(user.email)}</span>
                    </td>
                    <td>
                        <span class="text-sm text-muted-foreground">${escapeHtml(user.phone)}</span>
                    </td>
                    <td>
                        <span 
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border
                            ${escapeHtml(user.role) === 'worker' 
                                ? 'bg-blue-500/10 text-blue-600 border-blue-500/20' 
                                : 'bg-green-500/10 text-green-600 border-green-500/20'}
                        ">
                            ${escapeHtml(user.role) === 'worker' ? 'Petugas' : 'Masyarakat'}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <button onclick="openEditModal('${escapeHtml(user.id)}')" class="p-2 hover:bg-accent rounded-xl transition-colors cursor-pointer" title="Edit">
                                <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal('${escapeHtml(user.id)}')" class="p-2 hover:bg-accent rounded-xl transition-colors cursor-pointer" title="Hapus">
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
        const form = document.querySelector('#user-form');
        form.action = `<?= base_url('/manage/user/create'); ?>`;

        document.getElementById('id').value = '';
        document.getElementById('modal-title').innerText = 'Tambah Pengguna Baru';
        document.querySelector('#password-container').classList.remove('hidden');
        document.getElementById('user-form').reset();
        showModal('user-modal');
    }

    function openEditModal(id) {
        const user = dataMap[id];
        const form = document.querySelector('#user-form');
        form.action = `<?= base_url('/manage/user/update'); ?>`;

        document.getElementById('id').value = id;
        document.querySelector('#password-container').classList.add('hidden');

        fillForm(form, user);
        document.getElementById('modal-title').innerText = 'Edit Pengguna';
        showModal('user-modal');
    }

    function openDeleteModal(id) {
        const user = dataMap[id];
        const form = document.querySelector('#user-delete-form');

        fillForm(form, user);
        showModal('delete-modal');
    }
</script>
<?php view()::endPush('scripts'); ?>