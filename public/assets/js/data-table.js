class DataTable {
	constructor(options) {
		this.data = options.data;
		this.filtered = [...this.data];

		this.tableBody = document.querySelector(options.tableBody);
		this.searchInput = document.querySelector(options.searchInput);
		this.filterSelect = document.querySelector(options.filterSelect);
        this.filterKey = options.filterKey;
		this.sortButton = document.querySelector(options.sortButton);
        this.sortText = this.sortButton.querySelector('#sort-text');
        this.sortIcon = this.sortButton.querySelector('#sort-icon');
        
		this.tableFooter = document.querySelector(options.tableFooter);
		this.emptyState = document.querySelector(options.emptyState);
		this.rowTemplate = options.rowTemplate;

		this.currentPage = 1;
		this.perPage = 10;
		this.search = "";
		this.sortDirection = "desc";
		this.filterValue = "";

        this.sortIcons = {
            desc: `
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
            `,
            asc: `
                <svg class="h-4 w-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
            `
        };

		this.init();
	}

	init() {
        this.initFooter();
        this.bindEvents();
        this.updateSortUI();
        this.applyAll();
    }

	initFooter() {
		this.tableFooter.innerHTML = `
            <div class="px-6 py-4 border-t border-border flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex flex-col md:flex-row text-center md:text-left items-center gap-4">
                    <p id="table-info" class="text-sm text-muted-foreground">Menampilkan 0 dari 0 data</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-muted-foreground">Per halaman:</span>
                        <select id="per-page" class="px-2 py-1.5 border border-input rounded-lg bg-background text-sm focus:ring-2 focus:ring-ring">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button id="prev-page" class="btn btn-outline rounded-xl!" disabled>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div id="pagination-numbers" class="flex items-center gap-1">
                        <button class="btn btn-primary rounded-xl!">1</button>
                    </div>
                    <button id="next-page" class="btn btn-outline rounded-xl!" disabled>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        `;

        this.tableInfo = this.tableFooter.querySelector("#table-info");
		this.perPageSelect = this.tableFooter.querySelector("#per-page");
		this.prevBtn = this.tableFooter.querySelector("#prev-page");
		this.nextBtn = this.tableFooter.querySelector("#next-page");
		this.paginationNumbers = this.tableFooter.querySelector("#pagination-numbers");
	}

	bindEvents() {
		if (this.searchInput) {
			this.searchInput.addEventListener("input", (e) => {
				this.search = e.target.value.toLowerCase();
                this.currentPage = 1;
				this.applyAll();
			});
		}

        if (this.filterSelect) {
            this.filterSelect.addEventListener("change", (e) => {
                this.filterValue = e.target.value;
                this.currentPage = 1;
                this.applyAll();
            });
        }

		if (this.sortButton) {
			this.sortButton.addEventListener("click", () => {
				this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
                this.updateSortUI();
                this.currentPage = 1;
				this.applyAll();
			});
		}

		if (this.perPageSelect) {
			this.perPageSelect.addEventListener("change", (e) => {
				this.perPage = Math.max(5, parseInt(e.target.value));
				this.currentPage = 1;
				this.applyAll();
			});
		}

		if (this.prevBtn) {
			this.prevBtn.addEventListener("click", () => {
				if (this.currentPage > 1) {
					this.currentPage--;
					this.applyAll();
				}
			});
		}

		if (this.nextBtn) {
			this.nextBtn.addEventListener("click", () => {
				if (this.currentPage < this.getTotalPages()) {
					this.currentPage++;
					this.applyAll();
				}
			});
		}
	}

	applyAll() {
		this.filtered = this.data.filter((row) => {
			const matchesSearch = JSON.stringify(row).toLowerCase().includes(this.search);
			const matchesFilter = this.filterValue === "" || row[this.filterKey] === this.filterValue;

			return matchesSearch && matchesFilter;
		});

		this.filtered.sort((a, b) => {
			const dateA = new Date(a["created_at"]);
			const dateB = new Date(b["created_at"]);

			return this.sortDirection === "desc" ? dateB - dateA : dateA - dateB;
		});

		this.render();
	}

    render() {
        this.renderTable();
        this.renderTableInfo();
        this.renderPagination();
    }

	renderTable() {
        const start = (this.currentPage - 1) * this.perPage;
		const rows = this.filtered.slice(start, start + this.perPage);

		if (rows.length === 0) {
            this.tableBody.innerHTML = "";
            this.tableFooter.style.display = "none";
			this.emptyState.classList.replace("hidden", "block");
			return;
		}

        this.tableFooter.style.display = "";
		this.emptyState.classList.replace("block", "hidden");
		this.tableBody.innerHTML = rows.map((row, index) => {
            const finalIndex = start + index;
            return this.rowTemplate(row, finalIndex);
        }).join("");
	}

    renderTableInfo() {
        const total = this.filtered.length;

        if (total === 0) {
            this.tableInfo.innerText = "Tidak ada data";
            return;
        }

        const start = (this.currentPage - 1) * this.perPage + 1;
        const end = Math.min(start + this.perPage - 1, total);

        this.tableInfo.innerText = `Menampilkan ${start} - ${end} dari ${total} data`;
    }

	renderPagination() {
        const totalPages = this.getTotalPages();

        let html = '';

        for (let i = 1; i <= totalPages; i++) {
            html += `<button class="btn ${i === this.currentPage ? "btn-primary" : "btn-outline"} rounded-xl!" data-page="${i}">${i}</button>`;
        }

        this.paginationNumbers.innerHTML = html;

        this.paginationNumbers.querySelectorAll("button").forEach((button) => {
            button.addEventListener("click", () => {
                this.currentPage = parseInt(button.dataset.page);
                this.applyAll();
            });
        });

        this.prevBtn.disabled = this.currentPage === 1;
        this.nextBtn.disabled = this.currentPage === totalPages;
    }

    getTotalPages() {
        const total = this.filtered.length;
        return Math.ceil(total / this.perPage);
    }

    updateSortUI() {
        const isDesc = this.sortDirection === "desc";

        this.sortText.innerText = isDesc
            ? "Sort: Terbaru"
            : "Sort: Terlama";

        this.sortIcon.innerHTML = isDesc
            ? this.sortIcons.desc
            : this.sortIcons.asc;
    }
}
