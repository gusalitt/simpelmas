<?php view()::extend('layouts.manage'); ?>

<?php view()::push('content'); ?>
<div class="space-y-6">
    <div class="no-print">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Cetak Laporan Pengaduan</h1>
                <p class="text-muted-foreground mt-1">Pilih tipe pengaduan yang ingin dicetak dengan filter yang tersedia</p>
            </div>
        </div>
    </div>

    <div class="bg-card border border-border rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-border bg-linear-to-r from-primary/5 to-transparent">
            <h3 class="font-semibold flex items-center gap-2">
                <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Pengaduan
            </h3>
        </div>

        <form id="filterForm" action="<?= base_url('/manage/print/complaint') ?>" method="post" target="_blank" class="p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                <div>
                    <label class="text-sm font-medium text-foreground mb-1 block">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="filter-start-date" onclick="event.target?.showPicker()" class="input pl-4! w-full">
                </div>
                <div>
                    <label class="text-sm font-medium text-foreground mb-1 block">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="filter-end-date" onclick="event.target?.showPicker()" class="input pl-4! w-full">
                </div>
                <div>
                    <label class="text-sm font-medium text-foreground mb-1 block">Status</label>
                    <select name="status" id="filter-status" class="input pl-4! w-full">
                        <option value="">Semua Status</option>
                        <option value="new">Baru</option>
                        <option value="processed">Diproses</option>
                        <option value="done">Selesai</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-border pt-4 mb-4">
                <h3 class="text-sm font-semibold text-foreground mb-3">Opsi Cetak</h3>
                <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="print_option" value="complaint-only" checked class="w-4 h-4 text-primary">
                        <span class="text-base text-foreground">Cetak Pengaduan Saja</span>
                        <span class="text-sm text-muted-foreground">(Tanpa tanggapan)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="print_option" value="full" class="w-4 h-4 text-primary">
                        <span class="text-base text-foreground">Cetak Pengaduan + Tanggapan</span>
                        <span class="text-sm text-muted-foreground">(Dengan riwayat tanggapan)</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-border">
                <button type="submit" class="btn btn-primary gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Laporan
                </button>
                <button type="button" onclick="resetFilters()" class="btn btn-outline gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset Filter
                </button>
            </div>
        </form>
    </div>
</div>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    function resetFilters() {
        document.getElementById('filter-start-date').value = '';
        document.getElementById('filter-end-date').value = '';
        document.getElementById('filter-status').value = '';
        document.getElementById('preview-container').style.display = 'none';
    }
</script>
<?php view()::endPush('scripts'); ?>