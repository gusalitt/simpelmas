<div id="user-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center w-full m-0 p-0 hidden">
    <div id="user-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('user-modal')"></div>

    <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle md:max-w-xl w-full z-50 m-5">
        <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-2 rounded-full bg-primary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold tracking-tight" id="modal-title"><?= old('id') ? 'Edit' : 'Tambah' ?> Pengguna</h3>
                </div>
            </div>
            <button onclick="closeModal('user-modal')" class="p-2 hover:bg-accent rounded-full transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="user-form" action="<?= old('id') ? base_url('/manage/user/update') : base_url('/manage/user/create') ?>" method="post" class="space-y-4 p-5">
            <input type="hidden" id="id" name="id" value="<?= old('id') ?? ''; ?>" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="user-username" class="text-sm font-medium text-foreground mb-2 block">Nama <span class="text-destructive">*</span></label>
                    <input type="text" id="user-username" name="username" placeholder="Masukkan nama" class="input pl-4!" value="<?= old('username') ?? ''; ?>">
                    <p class="text-destructive text-sm"><?= error('username'); ?></p>
                </div>

                <div class="space-y-2">
                    <label for="user-email" class="text-sm font-medium text-foreground mb-2 block">Email <span class="text-destructive">*</span></label>
                    <input type="email" id="user-email" name="email" placeholder="Masukkan email" class="input pl-4!" value="<?= old('email') ?? ''; ?>">
                    <p class="text-destructive text-sm"><?= error('email'); ?></p>
                </div>

                <div class="space-y-2 <?= old('id') ? 'hidden' : '' ?>" id="password-container">
                    <label for="user-password" class="text-sm font-medium text-foreground mb-2 block">Password <span class="text-destructive">*</span></label>
                    <input type="password" id="user-password" name="password" placeholder="Masukkan password" class="input pl-4!">
                    <p class="text-destructive text-sm"><?= error('password'); ?></p>
                </div>

                <div class="space-y-2">
                    <label for="user-phone" class="text-sm font-medium text-foreground mb-2 block">No. Telp <span class="text-destructive">*</span></label>
                    <input type="tel" id="user-phone" name="phone" placeholder="Masukkan no telp" class="input pl-4!" value="<?= old('phone') ?? ''; ?>">
                    <p class="text-destructive text-sm"><?= error('phone'); ?></p>
                </div>

                <div class="space-y-2">
                    <label for="user-role" class="text-sm font-medium text-foreground mb-2 block">Role <span class="text-destructive">*</span></label>
                    <?php $role = old('role'); ?>
                    <select id="user-role" name="role" class="input pl-4!">
                        <option value="">Pilih Role</option>
                        <option value="citizen" <?= $role === 'citizen' ? 'selected' : '' ?>>Masyarakat</option>
                        <option value="worker" <?= $role === 'worker' ? 'selected' : '' ?>>Petugas</option>
                    </select>
                    <p class="text-destructive text-sm"><?= error('role'); ?></p>
                </div>

                <div class="space-y-2">
                    <label for="user-address" class="text-sm font-medium text-foreground mb-2 block">Alamat</label>
                    <input type="text" id="user-address" name="address" placeholder="Masukkan alamat" class="input pl-4!" value="<?= old('address') ?? ''; ?>">
                    <p class="text-destructive text-sm"><?= error('address'); ?></p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-border">
                <button type="button" onclick="closeModal('user-modal')" class="btn btn-outline w-full">Batal</button>
                <button type="submit" class="btn btn-primary w-full">Simpan</button>
            </div>
        </form>
    </div>
</div>