<?php
$complaint = $data['complaint'];
$responses = $data['responses'];
$response_count = $data['response_count'];
?>
<div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
    <!-- Header Timeline -->
    <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl bg-primary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold tracking-tight">Riwayat Penanganan</h2>
                    <p class="text-xs text-muted-foreground">Semua tanggapan dan update dari para petugas</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs bg-muted px-3 py-1 rounded-full text-muted-foreground">
                    <span id="timeline-count"><?= htmlspecialchars($response_count) ?? 0; ?> tanggapan</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Timeline Content -->
    <div class="max-h-[calc(100vh-200px)] overflow-y-auto p-5 bg-muted/5">
        <div class="relative flex flex-col gap-5">
            <?php if ($responses === null || count($responses) === 0): ?>
                <div class="hidden text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-muted flex items-center justify-center mx-auto mb-3">
                        <svg class="h-8 w-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="text-sm text-muted-foreground">Belum ada tanggapan dari petugas</p>
                    <p class="text-xs text-muted-foreground mt-1">Jadilah yang pertama memberikan tanggapan</p>
                </div>
            <?php else: ?>
                <?php foreach ($responses as $response): ?>
                    <?php
                    $labels = [
                        'self' => [
                            'text' => 'Anda',
                            'class' => 'bg-blue-500/30 text-blue-800 dark:text-blue-300'
                        ],
                        'worker' => [
                            'text' => 'Petugas',
                            'class' => 'bg-green-500/30 text-green-800 dark:text-green-300'
                        ],
                        'admin' => [
                            'text' => 'Admin',
                            'class' => 'bg-purple-500/30 text-purple-800 dark:text-purple-300'
                        ],
                        'default' => [
                            'text' => '',
                            'class' => 'bg-gray-500/30 text-gray-800 dark:text-gray-300'
                        ]
                    ];

                    $key = 'default';
                    if ($response['worker_id'] === auth()->id()) {
                        $key = 'self';
                    } elseif (isset($labels[$response['role']])) {
                        $key = $response['role'];
                    }

                    $label = $labels[$key];
                    ?>
                    <div class="relative flex gap-4 group">
                        <div class="relative shrink-0 w-9 h-9 rounded-full">
                            <?php if (!empty($response['avatar'])): ?>
                                <img id="profile-avatar" src="<?= upload_url('avatars', htmlspecialchars($response['avatar'])) ?>"
                                    alt="Profile" class="w-full h-full object-cover rounded-full">
                            <?php else: ?>
                                <div id="avatar-placeholder" class="w-full h-full rounded-full bg-primary/15 flex items-center justify-center">
                                    <span class="text-xs font-bold text-primary"><?= getInitials(htmlspecialchars($response['worker_name'])); ?></span>
                                </div>
                                <img id="profile-avatar" src="" alt="Profile" class="w-full h-full object-cover rounded-full hidden">
                            <?php endif; ?>
                        </div>

                        <div class="flex-1 bg-linear-to-r from-primary/5 to-transparent rounded-2xl p-4 border border-border transition-all">
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-foreground"><?= htmlspecialchars($response['worker_name']); ?></span>
                                    <span class="text-[11px] text-muted-foreground"><?= formatDate($response['created_at']); ?></span>
                                </div>
                                <div class="<?= $label['class']; ?> text-[11px] px-2 py-0.5 rounded-full">
                                    <?= htmlspecialchars($label['text']); ?>
                                </div>
                            </div>
                            <p class="text-sm text-foreground/80 leading-relaxed ml-0.5">
                                <?= htmlspecialchars($response['message']); ?>
                            </p>

                            <?php if (!empty($response['image_url'])): ?>
                                <!-- Preview Image Area -->
                                <img
                                    src="<?= upload_url('responses', htmlspecialchars($response['image_url'])); ?>"
                                    data-filename=""
                                    alt="Preview"
                                    class="w-24 h-24 rounded-lg object-cover border border-border shadow-sm mt-2"
                                    onclick="openImagePreviewModal('<?= upload_url('responses', htmlspecialchars($response['image_url'])); ?>', '<?= htmlspecialchars($response['image_url']); ?>')">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Complaint Status -->
    <?php if ($complaint['status'] === 'done'): ?>
        <div class="flex justify-center py-4">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800 rounded-full">
                <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs text-green-700 dark:text-green-300 font-medium">Pengaduan selesai ditangani pada <?= formatDate($complaint['completed_at']); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($complaint['status'] === 'processed'): ?>
        <!-- Form Add Response -->
        <div class="border-t border-border p-4 bg-card">
            <div class="flex gap-3">
                <div class="flex-1">
                    <form method="POST" action="<?= base_url('/manage/complaint/response') ?>" enctype="multipart/form-data" class="space-y-3">
                        <input type="hidden" name="id" value="<?= $complaint['id']; ?>">
                        <!-- Preview Image Area -->
                        <div id="image-preview-container" class="hidden" onclick="openImagePreviewModal(this.querySelector('img').src, this.querySelector('img').getAttribute('data-filename'))">
                            <div class="relative inline-block group">
                                <img id="image-preview" src="" data-filename="" alt="Preview" class="w-24 h-24 rounded-lg object-cover border border-border shadow-sm">
                                <button type="button" onclick="event.stopPropagation(); removeImage()" class="absolute top-0 right-0 p-1 bg-red-500 hover:bg-red-600 rounded-full text-white shadow-md transition-all opacity-0 group-hover:opacity-100">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-muted-foreground mt-1" id="image-filename"></p>
                        </div>
                        <p class="text-destructive text-sm"><?= error('image'); ?></p>

                        <textarea
                            name="message"
                            rows="2"
                            class="input pl-4! mb-0!"
                            required
                            placeholder="Tulis tanggapan Anda tentang penanganan pengaduan ini..."><?= old('message'); ?></textarea>
                        <p class="text-destructive text-sm my-0"><?= error('message'); ?></p>

                        <div class="flex flex-wrap items-center justify-between gap-3 mt-1">
                                <div class="flex-col justify-center items-center gap-2">
                                    <!-- Upload Image -->
                                    <label for="image-input" class="flex items-center gap-2 text-sm text-muted-foreground cursor-pointer hover:text-primary transition-colors group">
                                        <div class="p-1.5 rounded-lg border border-border group-hover:border-primary/50 group-hover:bg-primary/5 transition-all">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Lampirkan foto</span>
                                        <input type="file" name="image" id="image-input" accept="image/png, image/jpg, image/jpeg" class="hidden" onchange="previewImage(this)">
                                    </label>
    
                                    <div class="text-xs text-muted-foreground mt-2">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Maks. 2MB (PNG, JPG, JPEG)
                                        </span>
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary gap-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Kirim Tanggapan
                            </button>
                        </div>
                    </form>
                    <p class="text-xs text-muted-foreground mt-4">Tanggapan akan terlihat oleh semua petugas dan admin. Pelapor bisa melihat seluruh tanggapan.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Image Preview Modal -->
    <?php view()::include('pages.manage.modals.image_preview_modal'); ?>
</div>
<script>
    function openImagePreviewModal(imageUrl, filename = 'foto') {
        if (!imageUrl || imageUrl === '#' || imageUrl === '' || imageUrl === window.location.href) {
            console.warn('Invalid image URL, preview aborted');
            return;
        }

        const modalPreviewImage = document.getElementById('modal-preview-image');
        const modalTitle = document.getElementById('modal-image-title');
        const downloadBtn = document.getElementById('modal-download-btn');

        modalPreviewImage.src = imageUrl;
        modalTitle.textContent = filename;

        downloadBtn.onclick = function() {
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        showModal('image-preview-modal');
    }

    function previewImage(input) {
        const previewContainer = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        const filenameSpan = document.getElementById('image-filename');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileSize = file.size / 1024 / 1024; // Convert to MB
            const fileExt = file.name.split('.').pop().toLowerCase();

            // Check file size limit (maks 2MB)
            if (fileSize > 2) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                input.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            if (!['jpg', 'jpeg', 'png'].includes(fileExt)) {
                alert('Hanya file gambar yang diperbolehkan!');
                input.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            // Validation file type
            if (!file.type.startsWith('image/')) {
                alert('Hanya file gambar yang diperbolehkan!');
                input.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.setAttribute('data-filename', file.name);
                filenameSpan.textContent = file.name;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            preview.src = '#';
            preview.setAttribute('data-filename', '');
            filenameSpan.textContent = '';
        }
    }

    function removeImage() {
        const fileInput = document.querySelector('input[name="image"]');
        const previewContainer = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        const modalPreviewImage = document.getElementById('modal-preview-image');
        const modalTitle = document.getElementById('modal-image-title');
        const filenameSpan = document.getElementById('image-filename');

        fileInput.value = '';
        preview.src = '#';
        modalPreviewImage.src = '#';
        modalTitle.textContent = '';
        filenameSpan.textContent = '';
        previewContainer.classList.add('hidden');
    }
</script>