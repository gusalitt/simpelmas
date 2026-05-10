<div id="category-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center m-0 p-0 hidden">
    <div id="category-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('category-modal')"></div>

    <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full z-50 m-5">
        <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-2 rounded-full bg-primary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold tracking-tight" id="modal-title">Tambah Kategori Baru</h3>
                </div>
            </div>
            <button onclick="closeModal('category-modal')" class="p-2 hover:bg-accent rounded-full transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <?php $oldId = old('id') ?? ''; ?>
        <form id="category-form" action="<?= $oldId ? base_url('/manage/category/update') : base_url('/manage/category/create') ?>" method="post" class="space-y-4 p-5">
            <input type="hidden" id="id" name="id" value="<?= $oldId; ?>" />
            <div class="space-y-2">
                <label for="category-name" class="text-sm font-medium text-foreground mb-2 block">Nama Kategori <span class="text-destructive">*</span></label>
                <input
                    type="text"
                    id="category-name"
                    name="name"
                    placeholder="Contoh: Infrastruktur"
                    class="input pl-4!"
                    value="<?= old('name') ?? ''; ?>"
                    required />
                <p class="text-destructive text-sm"><?= error('name'); ?></p>
            </div>

            <div class="space-y-2">
                <label for="category-description" class="text-sm font-medium text-foreground mb-2 block">Deskripsi <span class="text-destructive">*</span></label>
                <textarea
                    id="category-description"
                    name="description"
                    rows="3"
                    placeholder="Jelaskan kategori ini..."
                    required
                    class="input pl-4! resize-none"><?= old('description') ?? ''; ?></textarea>
                <p class="text-destructive text-sm"><?= error('description'); ?></p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-border">
                <button type="button" onclick="closeModal('category-modal')" class="btn btn-outline w-full">Batal</button>
                <button type="submit" class="btn btn-primary w-full">Simpan</button>
            </div>
        </form>
    </div>
</div>