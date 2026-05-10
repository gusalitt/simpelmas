<div id="delete-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center m-0 p-0 hidden">
    <div id="delete-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('delete-modal')"></div>

    <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-50 p-5 m-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 rounded-full bg-destructive/10">
                <svg class="h-5 w-5 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-foreground">Hapus Kategori</h3>
        </div>

        <p class="text-sm text-muted-foreground mb-6">
            Kategori yang dihapus tidak dapat dikembalikan. Semua pengaduan yang terkait dengan kategori ini akan dipindahkan sebagai arsip.
        </p>

        <form id="category-delete-form" action="<?= base_url('/manage/category/delete') ?>" method="post">
            <div class="flex gap-3">
                <input type="hidden" name="id">
                <button onclick="closeModal('delete-modal')" class="btn btn-outline w-full">
                    Batal
                </button>
                <button type="submit" onclick="confirmDelete()" class="btn btn-destructive w-full">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>