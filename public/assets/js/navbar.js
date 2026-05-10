document.addEventListener("DOMContentLoaded", function () {
	const navbarWrapper = document.getElementById("navbar-wrapper");
	const navbar = document.getElementById("navbar");
	const navbarContent = document.getElementById("navbar-content");

	const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
	const mobileMenu = document.getElementById("mobile-menu");
	const menuIcon = document.getElementById("menu-icon");
	const closeIcon = document.getElementById("close-icon");

	window.addEventListener("scroll", function () {
		if (window.scrollY > 0) {
			navbarWrapper.classList.remove("top-0");
			navbarWrapper.classList.add("top-4");
			navbar.classList.remove("max-w-full", "shadow-none", "rounded-none");
			navbar.classList.add("max-w-full", "md:max-w-3xl", "lg:max-w-5xl", "shadow", "rounded-full");
			navbarContent.classList.replace("lg:px-20", "md:px-5");

			mobileMenu?.classList.replace("rounded-none", "rounded-4xl");
		} else {
			navbarWrapper.classList.remove("top-4");
			navbarWrapper.classList.add("top-0");
			navbar.classList.remove("max-w-full", "md:max-w-3xl", "lg:max-w-5xl", "shadow", "rounded-full");
			navbar.classList.add("max-w-full", "shadow-none", "rounded-none");
			navbarContent.classList.replace("md:px-5", "lg:px-20");

			mobileMenu?.classList.replace("rounded-4xl", "rounded-none");
		}
	});

	mobileMenuToggle.addEventListener("click", function () {
		const isOpen = mobileMenu.classList.contains("opacity-100");

		if (isOpen) {
			mobileMenu.classList.remove("opacity-100", "translate-x-0");
			mobileMenu.classList.add("opacity-0", "-translate-x-[200%]");
			menuIcon.classList.remove("hidden");
			closeIcon.classList.add("hidden");
		} else {
			mobileMenu.classList.remove("opacity-0", "-translate-x-[200%]");
			mobileMenu.classList.add("opacity-100", "translate-x-0");
			menuIcon.classList.add("hidden");
			closeIcon.classList.remove("hidden");
		}
	});

	mobileMenu?.querySelectorAll("a").forEach((link) => {
		link.addEventListener("click", () => {
			mobileMenu.classList.remove("opacity-100", "translate-x-0");
			mobileMenu.classList.add("opacity-0", "-translate-x-[200%]");
			menuIcon.classList.remove("hidden");
			closeIcon.classList.add("hidden");
		});
	});
});