// ----------------------------------------------------------------------------
// Theme
// ----------------------------------------------------------------------------
let activeTheme = "dark";
const favicon = document.getElementById("dynamic-favicon");
const faviconHref = favicon.getAttribute("href");

document.getElementById("theme-toggle").addEventListener("click", function () {
	applyTheme(activeTheme === "light" ? "dark" : "light");
});

function applyTheme(forceTheme = null) {
	const savedTheme = forceTheme || localStorage.getItem("theme") || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");

	if (savedTheme === "dark") {
		document.documentElement.classList.add("dark");
	} else {
		document.documentElement.classList.remove("dark");
	}

	activeTheme = savedTheme;
	favicon.href = faviconHref + (savedTheme === "light" ? "/simpelmas-dark.svg" : "/simpelmas-light.svg");
	updateAllLogos(savedTheme);

	localStorage.setItem("theme", savedTheme);
}

const logos = document.querySelectorAll(".dynamic-logo");
function updateAllLogos(theme) {
	logos.forEach((logo) => {
		const baseSrc = logo.dataset.srcBase;
		if (baseSrc) {
			logo.src = baseSrc + (theme === "light" ? "/simpelmas-dark.svg" : "/simpelmas-light.svg");
		}
	});
}
applyTheme();



// ----------------------------------------------------------------------------
// Modal
// ----------------------------------------------------------------------------
let currentModal = null;
function showModal(modalId) {
	const backdrop = document.getElementById(`${modalId}-backdrop`);
	const modal = document.getElementById(modalId);

	backdrop.classList.remove("hidden");
	modal.classList.remove("hidden");
	currentModal = modalId;

	// Trigger animation
	setTimeout(() => {
		backdrop.classList.add("opacity-100");
		modal.classList.remove("scale-95", "opacity-0");
		modal.classList.add("scale-100", "opacity-100");
	}, 10);
}
function closeModal(modalId) {
	if (!modalId) return;

	const backdrop = document.getElementById(`${modalId}-backdrop`);
	const modal = document.getElementById(modalId);

	// Reverse animation
	backdrop.classList.remove("opacity-100");
	backdrop.classList.add("hidden");
	modal.classList.remove("scale-100", "opacity-100");
	modal.classList.add("scale-95", "opacity-0");

	// Hide after animation
	setTimeout(() => {
		modal.classList.add("hidden");
	}, 100);
}
document.addEventListener("keydown", function (e) {
	if (e.key === "Escape" && currentModal) {
		closeModal(currentModal);
	}
});



// ----------------------------------------------------------------------------
// Name
// ----------------------------------------------------------------------------
function getInitials(name) {
	if (!name) return "";

	const words = name.trim().split(/\s+/);

	if (words.length > 1) {
		return (words[0][0] + words[1][0]).toUpperCase();
	}

	return words[0].substring(0, 2).toUpperCase();
}

function fillForm(form, data) {
	Object.entries(data).forEach(([key, value]) => {
		const input = form.querySelector(`[name="${key}"]`);
		if (!input) return;

		if (input.type === "checkbox") {
			input.checked = !!value;
		} else if (input.tagName === "SELECT") {
			input.value = escapeHtml(value);
		} else {
			input.value = escapeHtml(value ?? "");
		}
	});
}



// ----------------------------------------------------------------------------
// Alert
// ----------------------------------------------------------------------------
const alertDiv = document.getElementById("alertDiv");
setTimeout(() => {
	if (alertDiv) {
		alertDiv.classList.add("opacity-0", "translate-x-full");
		setTimeout(() => {
			if (alertDiv.parentNode) alertDiv.remove();
		}, 300);
	}
}, 5000);



// ----------------------------------------------------------------------------
// Format
// ----------------------------------------------------------------------------
function formatDate(datetime) {
	const date = new Date(datetime);

	return date.toLocaleDateString("id-ID", {
		day: "2-digit",
		month: "long",
		year: "numeric",
	});
}

function escapeHtml(input) {
	if (input === null || input === undefined) {
		return "";
	}

	let str = String(input);

	if (str.length === 0) {
		return "";
	}

	const htmlEntities = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		'"': "&quot;",
		"'": "&#39;",
		"/": "&#x2F;",
		"`": "&#x60;",
		"=": "&#x3D;",
	};

	return str.replace(/[&<>"'/`=]/g, (char) => htmlEntities[char]);
}



// ----------------------------------------------------------------------------
// Password
// ----------------------------------------------------------------------------
function initPasswordToggle() {
	const passwordContainers = document.querySelectorAll(".password-wrapper");

	passwordContainers?.forEach((container) => {
		const passwordInput = container.querySelector(".password-input");
		const toggleButton = container.querySelector(".toggle-password");

		if (!passwordInput || !toggleButton) return;

		updateIcon(toggleButton, passwordInput.type === "text");

		toggleButton.addEventListener('click', () => {
			const isVisible = passwordInput.type === "text";

			if (isVisible) {
				passwordInput.type = "password";
				updateIcon(toggleButton, false);
			} else {
				passwordInput.type = "text";
				updateIcon(toggleButton, true);
			}
		});
	});
}

function updateIcon(button, isVisible) {
	const iconOpen = button.querySelector(".eye-open");
	const iconClosed = button.querySelector(".eye-closed");

	if (iconOpen && iconClosed) {
		if (isVisible) {
			iconOpen.style.display = 'none';
			iconClosed.style.display = 'inline';
		} else {
			iconOpen.style.display = 'inline';
			iconClosed.style.display = 'none';
		}
	}
}
initPasswordToggle();