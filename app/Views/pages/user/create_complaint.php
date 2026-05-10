<?php view()::extend('layouts.user'); ?>

<?php view()::push('styles'); ?>
<style>
    .animate-in {
        animation: animateIn 0.3s ease-out;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    .slide-in-from-top-2 {
        animation: slideInFromTop 0.3s ease-out;
    }

    @keyframes animateIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideInFromTop {
        from {
            transform: translateY(-15px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
<?php view()::endPush('styles'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Page Title & Subtitle -->
    <div class="mb-8 text-center">
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Kirim Pengaduan</h1>
        <p class="text-muted-foreground mt-2 max-w-xl mx-auto">Laporkan masalah atau keluhan Anda kepada pihak berwenang untuk ditindaklanjuti</p>
    </div>

    <!-- Main Form Card -->
    <div class="bg-card border border-border rounded-3xl shadow-xl overflow-hidden backdrop-blur-sm">
        <!-- Card Header -->
        <div class="px-6 py-5 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-[1.2rem] bg-primary/10">
                    <svg class="h-5.5 w-5.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Formulir Pengaduan</h2>
                </div>
            </div>
        </div>

        <!-- Alert -->
        <div class="p-6">
            <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-3xl p-4">
                <div class="flex items-start gap-3">
                    <div class="p-1.5 rounded-full bg-yellow-500/20 shrink-0">
                        <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-sm font-semibold text-yellow-600 dark:text-yellow-400">Perhatian!</h5>
                        <p class="text-sm text-muted-foreground mt-0.5">Pastikan semua data yang Anda isi sudah benar. Laporan yang sudah dikirim <span class="font-semibold">tidak dapat diedit</span> kembali.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <form id="complaint-form" action="<?= base_url('/complaint/create'); ?>" method="post" class="p-6 space-y-6 pt-0" enctype="multipart/form-data">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="space-y-2.5">
                    <label for="title" class="text-sm font-medium flex items-center gap-1.5">
                        <span class="text-red-500">*</span>
                        Judul Laporan
                        <span class="text-xs text-muted-foreground font-normal">(min. 10 karakter)</span>
                    </label>
                    <div class="relative group mb-0">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Contoh: Jalan Rusak di Jl. Merdeka"
                            class="input"
                            required
                            minlength="10"
                            value="<?= old('title') ?? ''; ?>" />
                    </div>
                    <p class="text-destructive text-sm"><?= error('title') ?></p>
                </div>

                <!-- Category Field -->
                <div class="space-y-2.5">
                    <label for="category" class="text-sm font-medium flex items-center gap-1.5">
                        <span class="text-red-500">*</span>
                        Kategori
                    </label>
                    <select name="category" id="category" class="input pl-4!" required>
                        <option value="">Pilih kategori</option>
                        <?php foreach ($data as $category) : ?>
                            <option value="<?= $category['id'] ?>" <?= old('category') == $category['id'] ? 'selected' : '' ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-destructive text-sm"><?= error('category') ?></p>
                </div>
            </div>

            <!-- Location Field -->
            <div class="space-y-2.5">
                <label class="text-sm font-medium flex items-center gap-1.5">
                    <span class="text-red-500">*</span>
                    Lokasi Kejadian
                </label>
                <div class="relative group mb-0">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground group-focus-within:text-primary transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        placeholder="Alamat lengkap atau koordinat lokasi"
                        class="input"
                        required
                        value="<?= old('location') ?? ''; ?>" />
                </div>
                <p class="text-destructive text-sm"><?= error('location') ?></p>
            </div>

            <!-- Description Field -->
            <div class="space-y-2.5">
                <label class="text-sm font-medium flex items-center gap-1.5">
                    <span class="text-red-500">*</span>
                    Deskripsi Detail
                    <span class="text-xs text-muted-foreground font-normal">(min. 20 karakter)</span>
                </label>
                <div class="relative">
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Jelaskan masalah secara rinci... Contoh: Kondisi jalan berlubang dengan kedalaman 10cm, berlokasi tepat di depan gerbang sekolah, sudah berlangsung selama 2 minggu..."
                        class="input pl-4! resize-none"
                        required
                        minlength="20"
                        name="description"
                        oninput="updateCharCount();"><?= old('description') ?? ''; ?></textarea>
                    <div class="absolute bottom-5 right-3 text-xs text-muted-foreground bg-background/80 px-2 py-1 rounded-md">
                        <span id="char-count">0</span>/500
                    </div>
                    <p class="text-destructive text-sm"><?= error('description') ?></p>
                </div>
            </div>

            <!-- File Upload Area (Single Image) -->
            <div class="space-y-2.5">
                <label class="text-sm font-medium flex items-center gap-1.5">
                    Upload Bukti (Opsional)
                    <span class="text-xs text-muted-foreground font-normal">Maks. 2MB (PNG, JPG, JPEG)</span>
                </label>

                <!-- Drop Zone -->
                <div
                    id="drop-zone"
                    class="relative border-2 border-dashed border-border rounded-xl p-6 text-center cursor-pointer hover:border-primary/50 hover:bg-accent/30 transition-all group"
                    onclick="document.getElementById('file-input').click()"
                    ondragover="handleDragOver(event)"
                    ondragleave="handleDragLeave(event)"
                    ondrop="handleDrop(event)">
                    <input
                        type="file"
                        id="file-input"
                        class="hidden"
                        name="image"
                        accept="image/png, image/jpg, image/jpeg"
                        onchange="handleFileSelect(this.files[0])" />

                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/5 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="h-14 w-14 mx-auto text-muted-foreground group-hover:text-primary transition-colors relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>

                    <h4 class="font-semibold text-base mt-3 group-hover:text-primary transition-colors">Klik atau drag file ke sini</h4>
                    <p class="text-sm text-muted-foreground mt-1">Upload 1 file gambar sebagai bukti</p>
                </div>
                <p class="text-destructive text-sm"><?= error('image') ?></p>

                <!-- Image Preview -->
                <div id="image-preview-container" class="hidden mt-4">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs font-medium text-muted-foreground flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Preview Gambar
                        </p>
                        <button type="button" onclick="removeImage()" class="text-xs text-red-500 hover:text-red-600 hover:underline">
                            Hapus
                        </button>
                    </div>
                    <div class="relative rounded-xl overflow-hidden border border-border bg-accent/20 p-2">
                        <img id="image-preview" src="#" alt="Preview" class="max-h-64 mx-auto object-contain rounded-lg" />
                    </div>
                </div>

                <p id="file-error" class="text-xs text-destructive hidden mt-1.5 flex items-center gap-1">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ukuran file terlalu besar (maks. 2MB)
                </p>
                <p id="file-error-ext" class="text-xs text-destructive hidden mt-1.5 flex items-center gap-1">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ekstensi file tidak didukung. Hanya file PNG, JPG, JPEG yang diperbolehkan.
                </p>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-border">
                <button type="button" onclick="history.back()" class="btn btn-outline w-full gap-2 py-5!">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary w-full gap-2 h-full py-5!">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    // Global variables
    let selectedFile = null;

    // Character Counter
    function updateCharCount() {
        const description = document.getElementById('description');
        const count = description.value.length;
        document.getElementById('char-count').textContent = count;

        if (count > 500) {
            description.value = description.value.slice(0, 500);
            document.getElementById('char-count').textContent = 500;
        }
    }

    // File Upload Functions
    function handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('drop-zone').classList.add('border-primary', 'bg-primary/5');
    }

    function handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('drop-zone').classList.remove('border-primary', 'bg-primary/5');
    }

    async function handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('drop-zone').classList.remove('border-primary', 'bg-primary/5');

        let fileToProcess = null;

        if (e.dataTransfer.files.length > 0) {
            fileToProcess = e.dataTransfer.files[0];
        } else {
            const htmlData = e.dataTransfer.getData('text/html');
            const container = document.createElement('div');
            container.innerHTML = htmlData;
            const imgTag = container.querySelector('img');

            if (imgTag && imgTag.src) {
                try {
                    const response = await fetch(imgTag.src);
                    const blob = await response.blob();
                    fileToProcess = new File([blob], "downloaded_image.jpg", { type: blob.type });
                } catch (error) {
                    console.error("Error fetching image:", error);
                }
            }
        }

        handleFileSelect(fileToProcess);
    }

    function handleFileSelect(file) {
        if (!validateFile(file)) return;

        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');

        selectedFile = file;
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        const fileInput = document.getElementById('file-input');
        fileInput.files = dataTransfer.files;

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function validateFile(file) {
        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const maxSizeInMB = 2;
        const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

        const fileError = document.getElementById('file-error');
        const fileErrorExt = document.getElementById('file-error-ext');
        fileError.classList.add('hidden');
        fileErrorExt.classList.add('hidden');

        const fileName = file.name.toLowerCase();
        const extension = fileName.split('.').pop();

        if (!allowedExtensions.includes(extension)) {
            fileErrorExt.classList.remove('hidden');
            return false;
        }

        if (file.size > maxSizeInBytes) {
            fileError.classList.remove('hidden');
            return false;
        }

        return true;
    }

    function removeImage() {
        selectedFile = null;
        document.getElementById('image-preview-container').classList.add('hidden');
        document.getElementById('file-input').value = ''; // Reset file input
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('description').addEventListener('input', updateCharCount);
    });
</script>
<?php view()::endPush('scripts'); ?>