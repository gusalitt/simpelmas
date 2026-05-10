<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<?php
$complaint = $data['complaint'];
$responses = $data['responses'];
$response_count = $data['response_count'];
?>

<div class="space-y-6">
    <div class="flex items-center gap-4">
        <button onclick="history.back()" class="p-2 hover:bg-accent rounded-full transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>
        <div>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Detail Pengaduan</h1>
            <p class="text-muted-foreground mt-1">Informasi lengkap dan riwayat penanganan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Complaint Information -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-card border border-border rounded-3xl overflow-hidden shadow-sm sticky top-20">
                <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h2 class="text-base font-bold tracking-tight">Informasi Pengaduan</h2>
                    </div>
                </div>

                <div class="p-5 space-y-4">
                    <!-- Code & Category -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-muted-foreground uppercase tracking-wide">Kode Pengaduan</p>
                            <p class="text-sm font-mono font-semibold text-foreground mt-1"><?= htmlspecialchars($complaint['complaint_code']); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-muted-foreground uppercase tracking-wide">Kategori</p>
                            <p class="text-sm text-foreground mt-1"><?= htmlspecialchars($complaint['category_name']); ?></p>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Judul Pengaduan</p>
                        <p class="text-sm font-medium text-foreground mt-1"><?= htmlspecialchars($complaint['title']); ?></p>
                    </div>

                    <!-- Location -->
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Tempat Pengaduan</p>
                        <p class="text-sm font-medium text-foreground mt-1"><?= htmlspecialchars($complaint['location']); ?></p>
                    </div>

                    <!-- Content -->
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Isi Pengaduan</p>
                        <div class="bg-muted/30 rounded-xl p-3 mt-1">
                            <p class="text-sm text-foreground/80 leading-relaxed"><?= htmlspecialchars($complaint['content']); ?></p>
                        </div>
                    </div>

                    <!-- Image -->
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Lampiran Gambar</p>
                        <div class="mt-2">
                            <?php if (!empty($complaint['image_url']) && $complaint['image_url'] !== ''): ?>
                                <img src="<?= upload_url('complaints', htmlspecialchars($complaint['image_url'])); ?>" alt="Lampiran Pengaduan"
                                    class="w-full max-w-sm rounded-xl border border-border/50 object-cover">
                            <?php else: ?>
                                <div class="flex flex-col items-center justify-center gap-2 py-6 px-4 bg-muted/30 rounded-xl border border-border/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-muted-foreground/50">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <p class="text-xs text-muted-foreground">Tidak ada lampiran gambar</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <div>
                            <p class="text-xs text-muted-foreground uppercase tracking-wide">Tanggal Masuk</p>
                            <p class="text-sm text-foreground mt-1"><?= formatDate($complaint['created_at']) ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-muted-foreground uppercase tracking-wide">Tanggal Diambil</p>
                            <p class="text-sm text-foreground mt-1"><?= formatDate($complaint['taken_at']) ?></p>
                        </div>
                    </div>

                    <!-- Taken By Name -->
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Diambil Oleh</p>
                        <div class="flex items-center gap-1.5 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <p class="text-sm text-foreground"><?= htmlspecialchars($complaint['taken_by_name']) ?? '-'; ?></p>
                        </div>
                    </div>

                    <!-- Information About Reporter -->
                    <div class="pt-2">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="p-1 rounded-lg bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-foreground uppercase tracking-wide">Informasi Pelapor</p>
                        </div>

                        <div class="space-y-2 bg-muted/20 rounded-xl p-3">
                            <div class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-muted-foreground mt-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-muted-foreground">Nama Pelapor</p>
                                    <p class="text-sm font-medium text-foreground"><?= htmlspecialchars($complaint['created_by_name']) ?? '-'; ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-muted-foreground mt-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                <div>
                                    <p class="text-xs text-muted-foreground">Email</p>
                                    <p class="text-sm text-foreground break-all"><?= htmlspecialchars($complaint['user_email']) ?? '-'; ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-muted-foreground mt-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.332l-.94.94a2.25 2.25 0 0 1-2.522.493 9.005 9.005 0 0 1-4.964-4.964 2.25 2.25 0 0 1 .493-2.522l.94-.94c.277-.27.443-.732.332-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-muted-foreground">No. Telepon</p>
                                    <p class="text-sm text-foreground"><?= htmlspecialchars($complaint['user_phone']) ?? '-'; ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 text-muted-foreground mt-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-muted-foreground">Alamat</p>
                                    <p class="text-sm text-foreground"><?= htmlspecialchars($complaint['user_address']) ?? '-'; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="pt-4 border-t border-border">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-muted-foreground uppercase tracking-wide">Status</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-600">Diproses</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <!-- Card Complete Complaint Button -->
            <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
                    <div class="flex items-center justify-center sm:justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-xl bg-green-100">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold tracking-tight">Selesaikan Pengaduan</h2>
                                <p class="text-xs text-muted-foreground">Tandai pengaduan ini sebagai selesai</p>
                            </div>
                        </div>

                        <button type="submit" onclick="showModal('complete-modal')" id="complete-btn" class="px-5 py-2 btn bg-green-600 hover:bg-green-700 shadow-md text-white gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Tandai Selesai
                        </button>
                    </div>
                </div>
            </div>

            <!-- Handling History -->
            <?php view()::include('pages.manage.components.handling_history', compact('data')); ?>
        </div>
    </div>

    <!-- MODAL -->
    <div id="complete-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center m-0 p-0 hidden">
        <div id="complete-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('complete-modal')"></div>

        <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full z-50 m-5">
            <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-2 rounded-full bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold tracking-tight" id="modal-title">Selesaikan Pengaduan?</h3>
                    </div>
                </div>
                <button onclick="closeModal('complete-modal')" class="p-2 hover:bg-accent rounded-full transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Complaint Information -->
            <div class="px-5 pt-5 space-y-3">
                <div class="bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <p class="text-lg text-red-700 dark:text-red-300 font-medium flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>

                        Peringatan Penting!
                    </p>
                    <ul class="mt-2 space-y-1 text-sm text-red-600 dark:text-red-400">
                        <li>• Setelah ditandai selesai, status pengaduan akan berubah menjadi "Selesai".</li>
                        <li>• Anda <span class="font-semibold">TIDAK BISA</span> mengubah status kembali.</li>
                        <li>• Anda <span class="font-semibold">TIDAK BISA</span> menambah catatan baru</li>
                        <li>• Pengaduan akan dipindahkan ke arsip</li>
                    </ul>
                </div>
                <p class="text-sm text-muted-foreground">Apakah Anda yakin pengaduan ini sudah selesai ditangani seluruhnya?</p>
            </div>

            <form action="<?= base_url('/manage/complaint/complete') ?>" method="post" class="space-y-4 p-5">
                <input type="hidden" name="id" value="<?= $complaint['id'] ?>">
                <div class="flex gap-3 pt-4 border-t border-border">
                    <button type="button" onclick="closeModal('complete-modal')" class="btn btn-outline w-full">Batal</button>
                    <button type="submit" class="btn bg-green-600 hover:bg-green-700 shadow-md text-white w-full">Ya, Selesaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php view()::endPush('content'); ?>