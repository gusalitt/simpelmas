document.addEventListener("DOMContentLoaded", function () {
	const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
	const menuIcon = mobileMenuToggle.querySelector(".menu-icon");
	const closeIcon = mobileMenuToggle.querySelector(".close-icon");

	const sidebar = document.getElementById("sidebar");
	const sidebarBackdrop = document.getElementById("sidebar-backdrop");

	mobileMenuToggle.addEventListener("click", function () {
		const isOpen = sidebar.classList.toggle("-translate-x-full");

		mobileMenuToggle.setAttribute("aria-expanded", !isOpen);
		sidebarBackdrop.classList.toggle("hidden", isOpen);

		menuIcon.classList.toggle("hidden", !isOpen);
		closeIcon.classList.toggle("hidden", isOpen);
	});

	sidebarBackdrop.addEventListener("click", function () {
		sidebar.classList.add("-translate-x-full");
		mobileMenuToggle.setAttribute("aria-expanded", "false");
		sidebarBackdrop.classList.add("hidden");

		menuIcon.classList.remove("hidden");
		closeIcon.classList.add("hidden");
	});

	// Sidebar Dropdown
	const dropdownToggle = document.getElementById("dropdown-toggle");
	const dropdownMenu = document.getElementById("dropdown-menu");
	const dropdownArrow = document.getElementById("dropdown-arrow");

	let isOpen = true;
	dropdownToggle.addEventListener("click", function () {
		if (isOpen) {
			// CLOSE
			dropdownMenu.classList.remove("max-h-96", "opacity-100");
			dropdownMenu.classList.add("max-h-0", "opacity-0");

			dropdownArrow.classList.remove("rotate-180");
		} else {
			// OPEN
			dropdownMenu.classList.remove("max-h-0", "opacity-0");
			dropdownMenu.classList.add("max-h-96", "opacity-100");

			dropdownArrow.classList.add("rotate-180");
		}

		isOpen = !isOpen;
	});

	function setActiveMenuByPath() {
		const currentUrl = window.location.href.replace(/\/$/, "");
		const menuLinks = document.querySelectorAll("#sidebar nav a");

		menuLinks.forEach((link) => {
			if (link.getAttribute("href") === currentUrl) {
				link.className = "w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-background bg-primary";
			} else {
				link.className = "w-full flex items-center space-x-3 px-4 py-2 font-medium text-left rounded-2xl transition-colors text-secondary-foreground hover:bg-secondary";
			}
		});
	}
	setActiveMenuByPath();
});
