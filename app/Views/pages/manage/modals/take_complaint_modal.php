<div id="take-complaint-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center m-0 p-0 hidden">
    <div id="take-complaint-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('take-complaint-modal')"></div>

    <!-- Form Take Complaint -->
    <form id="take-complaint-form" action="<?= base_url('/manage/complaint/take') ?>" method="post">
        <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full z-50 m-5 max-h-[90vh] flex flex-col">
            <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent flex items-center justify-between shrink-0">
                <div class="flex items-center gap-4">
                    <div class="p-2 rounded-full bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold tracking-tight" id="modal-title">Ambil & Proses Pengaduan</h3>
                        <?php $oldComplaintCode = old('complaint_code') ?? ''; ?>
                        <p id="modal-subtitle" class="text-sm text-muted-foreground mt-0.5">Anda akan menjadi penanggung jawab utama pengaduan <span id="complaint-code" class="font-mono font-medium"><?= $oldComplaintCode ?></span></p>
                        <input type="hidden" name="complaint_code" value="<?= $oldComplaintCode; ?>">
                    </div>
                </div>
                <div onclick="closeModal('take-complaint-modal')" class="p-2 hover:bg-accent rounded-full transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <!-- Complaint Information -->
            <div class="flex-1 overflow-y-auto">
                <div class="px-5 pt-5 pb-4 space-y-3 border-b border-border/50">
                    <!-- Complaint Title -->
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <span>Judul Pengaduan</span>
                        </div>
                        <?php $oldComplaintTitle = old('complaint_title') ?? ''; ?>
                        <p id="complaint-title" class="text-sm font-semibold text-foreground"><?= $oldComplaintTitle; ?></p>
                        <input type="hidden" name="complaint_title" value="<?= $oldComplaintTitle; ?>">
                    </div>

                    <!-- Complaint Location -->
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Tempat Pengaduan</span>
                        </div>
                        <?php $oldComplaintLocation = old('complaint_location') ?? ''; ?>
                        <p id="complaint-location" class="text-sm text-foreground/80 leading-relaxed"><?= $oldComplaintLocation; ?></p>
                        <input type="hidden" name="complaint_location" value="<?= $oldComplaintLocation; ?>">
                    </div>

                    <!-- Complaint Content -->
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25h-9.75A2.25 2.25 0 0 1 3 18V6.75A2.25 2.25 0 0 1 5.25 4.5h4.5a2.25 2.25 0 0 1 2.25 2.25v.75Z" />
                            </svg>
                            <span>Isi Pengaduan</span>
                        </div>
                        <?php $oldComplaintContent = old('complaint_content') ?? ''; ?>
                        <p id="complaint-content" class="text-sm text-foreground/80 leading-relaxed"><?= $oldComplaintContent; ?></p>
                        <input type="hidden" name="complaint_content" value="<?= $oldComplaintContent; ?>">
                    </div>

                    <!-- Complaint Image (Preview) -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span>Lampiran Gambar</span>
                        </div>

                        <!-- Image Preview -->
                        <div id="complaint-image-container" class="relative">
                            <?php $oldComplaintImage = old('complaint_image') ?? ''; ?>
                            <img id="complaint-image" src="<?= upload_url('complaints', $oldComplaintImage); ?>" alt="Lampiran Pengaduan"
                                class="w-full max-w-md rounded-lg border border-border/50 object-cover">
                            <input type="hidden" name="complaint_image" value="<?= $oldComplaintImage; ?>">
                        </div>
                    </div>
                </div>

                <div class="space-y-4 p-5">
                    <input type="hidden" name="id" id="complaint-id" value="<?= old('id'); ?>">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-foreground mb-2 block">Catatan Awal</label>
                        <textarea
                            name="note"
                            rows="3"
                            placeholder="Tambahkan catatan untuk penanganan awal..."
                            class="input pl-4! resize-none"><?= old('note'); ?></textarea>
                        <p class="text-destructive text-sm"><?= error('note') ?></p>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-border">
                        <button type="button" onclick="closeModal('take-complaint-modal')" class="btn btn-outline w-full">Batal</button>
                        <button type="submit" class="btn btn-primary w-full">Ya, Ambil & Proses</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>