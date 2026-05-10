<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Profil Saya</h1>
        <p class="text-muted-foreground mt-1">Kelola informasi akun dan keamanan Anda</p>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Update Information -->
        <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
                <h3 class="font-semibold flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Informasi Akun
                </h3>
            </div>

            <form action="<?= base_url('/manage/profile'); ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-5">
                <!-- Avatar Section -->
                <div class="flex items-center gap-4 pb-4 border-b border-border/50">
                    <div class="flex justify-center">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden shadow-xl">
                                <div class="w-full h-full bg-card overflow-hidden relative">

                                    <?php if (!empty($data['avatar'])): ?>
                                        <img id="profile-avatar" src="<?= upload_url('avatars', htmlspecialchars($data['avatar'])); ?>"
                                            alt="Profile" class="w-full h-full object-cover rounded-full">
                                    <?php else: ?>
                                        <div id="avatar-placeholder" class="w-full h-full rounded-full bg-primary flex items-center justify-center">
                                            <span class="text-xl font-bold text-background"><?= getInitials(htmlspecialchars($data['username'])); ?></span>
                                        </div>
                                        <img id="profile-avatar" src="" alt="Profile" class="w-full h-full object-cover rounded-full hidden">
                                    <?php endif; ?>

                                    <!-- Edit Avatar Overlay (only visible in edit mode) -->
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('avatar-input').click()">
                                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden File Input -->
                            <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/png, image/jpg, image/jpeg" onchange="handleAvatarChange(this.files)">

                            <!-- Pencil Icon for Edit Mode -->
                            <div class="absolute -bottom-1 -right-1 bg-primary border border-muted-foreground text-primary-foreground p-2 rounded-full shadow-lg" onclick="document.getElementById('avatar-input').click()">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Foto Profil</p>
                        <p class="text-xs text-muted-foreground">JPG, JPEG, and PNG (Maks. 2MB)</p>
                    </div>
                </div>
                <p class="text-destructive text-sm"><?= error('avatar'); ?></p>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="username" value="<?= htmlspecialchars(old('username') ?? $data['username']); ?>" class="input pl-4! w-full" required>
                        <p class="text-destructive text-sm"><?= error('username'); ?></p>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars(old('email') ?? $data['email']); ?>" class="input pl-4! w-full" required>
                        <p class="text-destructive text-sm"><?= error('email'); ?></p>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">No. Telepon</label>
                        <input type="tel" name="phone" value="<?= htmlspecialchars(old('phone') ?? $data['phone']); ?>" class="input pl-4! w-full" required>
                        <p class="text-destructive text-sm"><?= error('phone'); ?></p>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">Alamat</label>
                        <textarea name="address" rows="2" class="input pl-4! w-full resize-none"><?= htmlspecialchars(old('address') ?? $data['address'] ?? ''); ?></textarea>
                        <p class="text-destructive text-sm"><?= error('address'); ?></p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t border-border/50">
                    <button type="submit" class="btn btn-primary px-6">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
                <h3 class="font-semibold flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Update Password
                </h3>
            </div>

            <form action="<?= base_url('/manage/profile/update-password'); ?>" method="post" class="p-6 space-y-5">
                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-foreground">Password Saat Ini</label>
                    <div class="relative password-wrapper">
                        <input type="password" name="password" placeholder="Masukkan password saat ini" class="input pl-4! pr-10 w-full password-input" required>

                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                            <svg class="eye-open h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg class="eye-closed h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                        </button>
                    </div>
                    <p class="text-destructive text-xs"><?= error('password'); ?></p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-foreground">Password Baru</label>
                    <div class="relative password-wrapper">
                        <input type="password" name="new_password" placeholder="Masukkan password baru" class="input pl-4! pr-10 w-full password-input" required>

                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                            <svg class="eye-open h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg class="eye-closed h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                        </button>
                    </div>
                    <p class="text-destructive text-xs"><?= error('new_password'); ?></p>
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-foreground">Konfirmasi Password Baru</label>
                    <div class="relative password-wrapper">
                        <input type="password" name="new_password_confirmation" placeholder="Masukkan ulang password baru" class="input pl-4! pr-10 w-full password-input" required>

                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                            <svg class="eye-open h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg class="eye-closed h-4 w-4 text-muted-foreground hover:text-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                        </button>
                    </div>
                    <p class="text-destructive text-xs"><?= error('new_password_confirmation'); ?></p>
                </div>

                <!-- Password Hint -->
                <div class="bg-muted/30 rounded-lg p-3">
                    <p class="text-xs text-muted-foreground flex items-center gap-1">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Gunakan minimal 8 karakter dengan kombinasi huruf dan angka
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t border-border/50">
                    <button type="submit" class="btn btn-primary px-6">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    function handleAvatarChange(files) {
        if (files.length === 0) return;
        const file = files[0];

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            return;
        }

        const ext = file.name.split('.').pop().toLowerCase();
        if (!['jpg', 'jpeg', 'png'].includes(ext)) {
            alert('Format file tidak didukung. Gunakan JPG atau PNG.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('profile-avatar');
            document.getElementById('avatar-placeholder')?.classList.add('hidden');

            img.classList.remove('hidden');
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
<?php view()::endPush('scripts'); ?>