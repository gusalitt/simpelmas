<?php view()::extend('layouts.user'); ?>

<?php view()::push('content'); ?>
<?php
$complaint = $data['complaint'];
$responses = $data['responses'] ?? [];
$response_count = $data['response_count'] ?? 0;

$categoryColors = [
    'bg-blue-500',
    'bg-green-500',
    'bg-purple-500',
    'bg-yellow-500',
    'bg-pink-500',
    'bg-indigo-500',
    'bg-red-500',
    'bg-teal-500',
    'bg-orange-500',
    'bg-cyan-500'
];
$categoryColor = $categoryColors[array_rand($categoryColors)];
$statusColor = [
    'new' => [
        'text' => "Baru",
        'color' => "bg-yellow-500/30 text-yellow-800 dark:text-yellow-300"
    ],
    'processed' => [
        'text' => "Diproses",
        'color' => "bg-blue-500/30 text-blue-800 dark:text-blue-300"
    ],
    'done' => [
        'text' => "Selesai",
        'color' => "bg-green-500/30 text-green-800 dark:text-green-300"
    ],
];
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
?>

<!-- Header -->
<div class="mx-auto pr-4 py-4 flex items-center justify-between border-b">
    <div class="flex items-center gap-3">
        <button onclick="history.back()" class="p-2 hover:bg-accent rounded-full transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>
        <div>
            <h1 class="text-xl font-bold tracking-tight">Detail Pengaduan</h1>
            <p class="text-sm text-muted-foreground">Informasi lengkap dan tanggapan pengaduan</p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="mx-auto px-0 sm:px-4 py-6 space-y-6">
    <!-- Complaint Code & Status Tracking -->
    <div class="bg-card border border-border rounded-3xl p-4">
        <div class="flex items-center justify-between flex-wrap gap-2">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm text-muted-foreground">Kode Pengaduan:</span>
                <span id="complaint-id" class="font-mono text-sm font-medium"><?= htmlspecialchars($complaint['complaint_code']); ?></span>
            </div>
            <div class="flex items-center gap-3 text-xs text-muted-foreground">
                <span class="flex items-center gap-1">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Dibuat: <span id="complaint-created-at"><?= formatDate($complaint['created_at']); ?></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Grid 2 Column -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Complaint Information -->
        <div class="bg-card border border-border rounded-3xl overflow-hidden max-h-max">
            <div onclick="toggleAccordion('information-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex justify-between">
                <h3 class="font-semibold flex items-center gap-2">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Dasar
                </h3>

                <svg id="information-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="information-accordion-content" class="p-5 space-y-4">
                <div>
                    <p class="text-xs text-muted-foreground uppercase tracking-wide">Judul Pengaduan</p>
                    <p id="complaint-title" class="text-base font-semibold mt-1"><?= htmlspecialchars($complaint['title']); ?></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Kategori</p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="h-2 w-2 rounded-full <?= $categoryColor; ?>"></div>
                            <p id="complaint-category" class="text-sm font-medium"><?= htmlspecialchars($complaint['category_name']); ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground uppercase tracking-wide">Status</p>
                        <span
                            id="complaint-status-badge"
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium mt-1 
                            <?= $statusColor[$complaint['status']]['color'] ?? 'bg-gray-500/30 text-gray-800'; ?>">
                            <?= $statusColor[$complaint['status']]['text'] ?? ucfirst($complaint['status']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="bg-card border border-border rounded-3xl overflow-hidden max-h-max">
            <div onclick="toggleAccordion('location-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex justify-between">
                <h3 class="font-semibold flex items-center gap-2">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lokasi Kejadian
                </h3>

                <svg id="location-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="location-accordion-content" class="p-5">
                <p id="complaint-location" class="text-sm leading-relaxed"><?= htmlspecialchars($complaint['location'] ?? '-'); ?></p>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-card border border-border rounded-3xl overflow-hidden">
        <div onclick="toggleAccordion('description-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex justify-between">
            <h3 class="font-semibold flex items-center gap-2">
                <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Deskripsi Lengkap
            </h3>

            <svg id="description-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <div id="description-accordion-content" class="p-5">
            <p id="complaint-description" class="text-sm leading-relaxed text-foreground/80"><?= htmlspecialchars($complaint['content']); ?></p>
        </div>
    </div>

    <!-- Image -->
    <div class="bg-card border border-border rounded-3xl overflow-hidden">
        <div onclick="toggleAccordion('image-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex justify-between">
            <h3 class="font-semibold flex items-center gap-2">
                <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Lampiran Gambar
            </h3>

            <svg id="image-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <div id="image-accordion-content" class="p-5">
            <?php if (!empty($complaint['image_url']) && $complaint['image_url'] !== ''): ?>
                <img src="<?= upload_url('complaints', $complaint['image_url']) ?>" alt="Lampiran Pengaduan"
                    class="w-full max-w-md rounded-2xl border border-border/50 object-cover">
            <?php else: ?>
                <div class="flex flex-col items-center justify-center gap-2 py-6 px-4 bg-muted/30 rounded-2xl border border-border/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-muted-foreground/50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <p class="text-xs text-muted-foreground">Tidak ada lampiran gambar</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tracking Information -->
    <div class="bg-card border border-border rounded-3xl overflow-hidden">
        <div onclick="toggleAccordion('tracking-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex justify-between">
            <h3 class="font-semibold flex items-center gap-2">
                <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Informasi Penanganan
            </h3>

            <svg id="tracking-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <div id="tracking-accordion-content" class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Taken By -->
                <div class="flex items-start gap-3 p-3 bg-muted/20 rounded-2xl">
                    <div class="p-2 rounded-xl bg-blue-500/10 shrink-0">
                        <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Diambil Oleh</p>
                        <p class="text-sm font-medium text-foreground">
                            <?= !empty($complaint['taken_by_name']) ? htmlspecialchars($complaint['taken_by_name']) : '<span class="text-muted-foreground italic">Belum diambil</span>' ?>
                        </p>
                        <?php if (!empty($complaint['taken_at'])): ?>
                            <p class="text-xs text-muted-foreground mt-1"><?= formatDate($complaint['taken_at']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Completed By -->
                <div class="flex items-start gap-3 p-3 bg-muted/20 rounded-2xl">
                    <div class="p-2 rounded-xl bg-green-500/10 shrink-0">
                        <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Diselesaikan Oleh</p>
                        <p class="text-sm font-medium text-foreground">
                            <?= !empty($complaint['completed_by_name']) ? htmlspecialchars($complaint['completed_by_name']) : '<span class="text-muted-foreground italic">Belum selesai</span>' ?>
                        </p>
                        <?php if (!empty($complaint['completed_at'])): ?>
                            <p class="text-xs text-muted-foreground mt-1"><?= formatDate($complaint['completed_at']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="mt-5 pt-4 border-t border-border">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="flex items-center justify-between">
                                <!-- Step 1: Created -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center <?= !empty($complaint['created_at']) ? 'bg-green-500 text-white' : 'bg-muted text-muted-foreground' ?>">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-xs text-center mt-1 text-muted-foreground">Dilaporkan</span>
                                    <span class="text-[10px] text-muted-foreground"><?= formatDate($complaint['created_at']) ?></span>
                                </div>

                                <!-- Line 1 -->
                                <div class="flex-1 h-0.5 mx-2 <?= !empty($complaint['taken_at']) ? 'bg-green-500' : 'bg-muted' ?>"></div>

                                <!-- Step 2: Taken -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center <?= !empty($complaint['taken_at']) ? 'bg-blue-500 text-white' : 'bg-muted text-muted-foreground' ?>">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs text-center mt-1 text-muted-foreground">Diambil</span>
                                    <span class="text-[10px] text-muted-foreground"><?= !empty($complaint['taken_at']) ? formatDate($complaint['taken_at']) : '-' ?></span>
                                </div>

                                <!-- Line 2 -->
                                <div class="flex-1 h-0.5 mx-2 <?= !empty($complaint['completed_at']) ? 'bg-green-500' : 'bg-muted' ?>"></div>

                                <!-- Step 3: Completed -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center <?= !empty($complaint['completed_at']) ? 'bg-green-500 text-white' : 'bg-muted text-muted-foreground' ?>">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs text-center mt-1 text-muted-foreground">Selesai</span>
                                    <span class="text-[10px] text-muted-foreground"><?= !empty($complaint['completed_at']) ? formatDate($complaint['completed_at']) : '-' ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Response Timeline -->
    <div class="bg-card border border-border rounded-3xl overflow-hidden">
        <div onclick="toggleAccordion('response-accordion')" class="px-5 py-4 border-b border-border bg-muted/30 flex items-center justify-between">
            <h3 class="font-semibold flex items-center gap-2">
                <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Timeline Tanggapan
            </h3>
            <div class="flex gap-4">
                <span id="response-count" class="text-xs bg-muted px-2 py-1 rounded-full text-muted-foreground"><?= $response_count; ?> tanggapan</span>
                <svg id="response-accordion-icon" class="h-5 w-5 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <div id="response-accordion-content" class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto">
            <div class="space-y-4">
                <?php if (!empty($responses) && count($responses) > 0): ?>
                    <?php foreach ($responses as $response): ?>
                        <?php
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
                            <div class="flex-1 bg-muted/30 rounded-2xl p-4 border border-border">
                                <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold"><?= htmlspecialchars($response['worker_name']); ?></span>
                                        <span class="text-[11px] text-muted-foreground"><?= formatDate($response['created_at']); ?></span>
                                    </div>
                                    <div class="<?= $label['class']; ?> text-[11px] px-2 py-0.5 rounded-full">
                                        <?= $label['text']; ?>
                                    </div>
                                </div>
                                <p class="text-sm text-foreground/80 leading-relaxed"><?= htmlspecialchars($response['message']); ?></p>
                                <?php if (!empty($response['image_url'])): ?>
                                    <img
                                        src="<?= upload_url('responses', $response['image_url']) ?>"
                                        class="w-24 h-24 rounded-xl object-cover border border-border mt-2 cursor-pointer"
                                        onclick="openImagePreviewModal('<?= upload_url('responses', $response['image_url']); ?>', '<?= $response['image_url']; ?>')">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg class="h-12 w-12 mx-auto text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="text-sm text-muted-foreground mt-2">Belum ada tanggapan</p>
                        <p class="text-xs text-muted-foreground">Tanggapan akan muncul setelah petugas merespon</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<?php view()::include('pages.manage.modals.image_preview_modal'); ?>
<?php view()::endPush('content'); ?>

<?php view()::push('scripts'); ?>
<script>
    function toggleAccordion(id) {
        const content = document.getElementById(`${id}-content`);
        const icon = document.getElementById(`${id}-icon`);

        if (content.classList.contains("hidden")) {
            content.classList.remove("hidden");
            icon.classList.add("rotate-180");
        } else {
            content.classList.add("hidden");
            icon.classList.remove("rotate-180");
        }
    }

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
</script>
<?php view()::endPush('scripts'); ?>