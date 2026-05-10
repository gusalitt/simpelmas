<div id="sidebar-backdrop" class="fixed inset-0 z-20 bg-black/20 dark:bg-gray-700/20 hidden"></div>

<aside id="sidebar" class="fixed left-0 top-0 z-30 h-svh w-64 transform border-r bg-background transition-transform duration-200 ease-in-out -translate-x-full lg:translate-x-0">
    <div class="flex h-16 mt-16 lg:mt-0 items-center border-b px-3">
        <div class="rounded-2xl text-foreground flex items-center px-4 py-2 w-full">
            <img src="" data-src-base="<?= base_url('/public/assets/img'); ?>" alt="SIMPELMAS" class="dynamic-logo w-8 h-8 mr-2">
            <span class="font-bold">SIMPELMAS</span>
        </div>
    </div>

    <div class="space-y-4 py-4">
        <div class="px-3">
            <nav>
                <ul class="space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="<?= base_url('/manage'); ?>"
                            class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php if (auth()->user()['role'] == 'admin'):  ?>
                        <!-- Manage User -->
                        <li>
                            <a href="<?= base_url('/manage/user'); ?>"
                                class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>

                                <span>Kelola Pengguna</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Manage Category -->
                    <li>
                        <a href="<?= base_url('/manage/category'); ?>"
                            class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0l6.172-6.172a2 2 0 000-2.828L12 3H5a2 2 0 00-2 2v6z" />
                            </svg>
                            <span>Kelola Kategori</span>
                        </a>
                    </li>

                    <!-- Manage Complaint -->
                    <li>
                        <div>
                            <button id="dropdown-toggle" class="w-full flex items-center justify-between px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                                <div class="flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>

                                    <span>Kelola Pengaduan</span>
                                </div>

                                <!-- Arrow -->
                                <svg id="dropdown-arrow" class="w-4 h-4 transition-transform duration-300 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <?php

                            use App\Foundation\Database\DB;

                            $complaintToday = DB::query("SELECT COUNT(*) AS total FROM complaints WHERE DATE(created_at) = CURDATE() AND status = 'new'")
                                ->fetchOne()['total'];
                            ?>

                            <!-- Submenu -->
                            <ul id="dropdown-menu"
                                class="mt-1 ml-6 space-y-1 overflow-hidden transition-all duration-300 ease-in-out max-h-96 opacity-100">
                                <li>
                                    <a href="<?= base_url('/manage/complaint/new'); ?>" class="px-4 py-2 rounded-lg text-[0.9rem] text-secondary-foreground hover:bg-secondary transition-colors flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span>Baru</span>
                                        <span class="text-[0.7rem] text-background bg-foreground border border-muted-foreground rounded-full w-5 h-5 flex items-center justify-center ml-auto"><?= $complaintToday; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('/manage/complaint/processing'); ?>" class="px-4 py-2 rounded-lg text-[0.9rem] text-secondary-foreground hover:bg-secondary transition-colors flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>

                                        <span>Diproses</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('/manage/complaint/completed'); ?>" class="px-4 py-2 rounded-lg text-[0.9rem] text-secondary-foreground hover:bg-secondary transition-colors flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                        <span>Selesai</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Print Complaint -->
                    <li>
                        <a href="<?= base_url('/manage/print/complaint/preview'); ?>"
                            class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>

                            <span>Cetak Pengaduan</span>
                        </a>
                    </li>

                    <!-- Profile -->
                    <li>
                        <a href="<?= base_url('/manage/profile'); ?>"
                            class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                            <span>Profil</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="px-3">
            <div class="h-px bg-border" />
            <div class="pt-4">
                <form action="<?= base_url('/auth/logout'); ?>" method="post">
                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-red-600 hover:bg-red-100 dark:hover:bg-red-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>

                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>