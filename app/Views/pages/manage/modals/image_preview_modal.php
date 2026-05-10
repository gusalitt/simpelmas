<div id="image-preview-modal" class="fixed inset-0 z-50 overflow-y-auto transition-all duration-100 flex items-center justify-center m-0 p-0 hidden">
    <div id="image-preview-modal-backdrop" class="fixed inset-0 -z-40 bg-background/80 transition-opacity hidden" onclick="closeModal('image-preview-modal')"></div>

    <div class="bg-card border-2 border-border rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full z-50 m-5 max-h-[90vh] flex flex-col">
        <div class="px-5 py-4 border-b border-border bg-linear-to-r from-primary/5 via-primary/5 to-transparent flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-2 rounded-full bg-primary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold tracking-tight">Preview Lampiran Foto</h3>
                    <p id="modal-image-title" class="text-xs text-muted-foreground mt-0.5">nama_file.jpg</p>
                </div>
            </div>
            <button onclick="closeModal('image-preview-modal')" class="p-2 hover:bg-accent rounded-full transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


        <!-- Body Modal - Image Preview (scrollable area) -->
        <div class="flex-1 overflow-y-auto p-5 bg-muted/20">
            <div class="flex items-center justify-center min-h-50">
                <img id="modal-preview-image" src="" alt="Preview" class="max-w-full h-auto object-contain rounded-lg">
            </div>
        </div>

        <div class="px-5 py-3 border-t border-border bg-muted/10 flex justify-end gap-2 shrink-0">
            <button onclick="closeModal('image-preview-modal')" class="btn btn-outline w-full">
                Tutup
            </button>
            <button id="modal-download-btn" class="btn btn-primary w-full gap-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download
            </button>
        </div>
    </div>
</div>