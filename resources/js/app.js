import "./bootstrap";
import "flowbite";
// import './sidebar';
// import './sidebar';
// import './charts';
import ApexCharts from "apexcharts";
import swal from "sweetalert2";
window.Swal = swal;
window.ApexCharts = ApexCharts;

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);
window.gsap = gsap;

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import "flatpickr/dist/themes/dark.css";


window.flatpickr = flatpickr;

// Skin theme helper (runtime swappable via `themes.css` + `tt-theme` class)
function getSkinColor(opacity = 1) {
    const raw = getComputedStyle(document.documentElement)
        .getPropertyValue('--color-base')
        .trim();

    if (!raw) return `rgba(0,0,0,${opacity})`;
    return `rgba(${raw}, ${opacity})`;
}
window.getSkinColor = getSkinColor;


// import './dark-mode';

// Check localStorage immediately to set initial state
if (localStorage.getItem("menu-collapsed") === "true") {
    // Add a class to body or html to handle initial state
    document.documentElement.classList.add('menu-collapsed');
}

document.addEventListener("livewire:navigating", () => {
    // Mutate the HTML before the page is navigated away...
    initFlowbite();
});

document.addEventListener('DOMContentLoaded', () => {
    initializeThemeToggle();
});

document.addEventListener('livewire:load', () => {
    initializeThemeToggle();
});

// Initialize theme toggle safely and idempotently
function initializeThemeToggle() {
    const themeToggleBtn = document.getElementById("theme-toggle");
    const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

    // Ensure html has correct theme class before manipulating icons
    if (localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // If required elements aren't present yet, do nothing
    if (!themeToggleBtn || !themeToggleDarkIcon || !themeToggleLightIcon) {
        return;
    }

    // Set initial icon visibility based on current theme
    if (document.documentElement.classList.contains('dark')) {
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleDarkIcon.classList.add('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
        themeToggleLightIcon.classList.add('hidden');
    }

    // Avoid attaching multiple listeners
    if (themeToggleBtn.dataset.initialized === 'true') {
        return;
    }
    themeToggleBtn.dataset.initialized = 'true';

    let event = new Event("dark-mode");
    themeToggleBtn.addEventListener("click", function () {
        // Toggle html class and persist
        if (localStorage.getItem("color-theme")) {
            if (localStorage.getItem("color-theme") === "light") {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            }
        } else {
            if (document.documentElement.classList.contains("dark")) {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            } else {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            }
        }

        // Sync icons
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
        }

        document.dispatchEvent(event);
    });
}

// Observe for the theme toggle button being (re)inserted by Livewire and init once
let themeToggleObserver = null;

function observeThemeToggleMount() {
    // Initialize now if present
    initializeThemeToggle();

    // Keep only one observer for the entire app lifecycle
    if (themeToggleObserver) {
        return;
    }

    themeToggleObserver = new MutationObserver(() => {
        const btn = document.getElementById('theme-toggle');
        if (btn && btn.dataset.initialized !== 'true') {
            initializeThemeToggle();
        }
    });

    const startObserving = () => {
        themeToggleObserver.observe(document.body, { childList: true, subtree: true });
    };

    if (document.body) {
        startObserving();
    } else {
        document.addEventListener('DOMContentLoaded', startObserving, { once: true });
    }
}

function addClickListenerOnce(element, key, handler) {
    if (!element) {
        return;
    }

    const dataKey = `listener${key}`;
    if (element.dataset[dataKey] === 'true') {
        return;
    }

    element.addEventListener('click', handler);
    element.dataset[dataKey] = 'true';
}

document.addEventListener("livewire:navigated", () => {
    // Ensure theme toggle initializes even if later blocks fail
    observeThemeToggleMount();

    // Check initial state on page load
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    // Initial state without transitions
    if (window.innerWidth >= 1024 && sidebar != null) { // Only apply on desktop (lg breakpoint)
        if (localStorage.getItem("menu-collapsed") === "true") {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('flex', 'lg:flex', 'translate-x-0');
            mainContent.classList.remove('ltr:lg:ml-56', 'rtl:lg:mr-56');
        } else {
            sidebar.classList.remove('hidden', '-translate-x-full');
            sidebar.classList.add('flex', 'lg:flex', 'translate-x-0');
            mainContent.classList.add('ltr:lg:ml-56', 'rtl:lg:mr-56');
        }
    }

    const openIcon = document.getElementById('toggle-sidebar-open');
    const closeIcon = document.getElementById('toggle-sidebar-close');

    // Initial state
    if (openIcon && closeIcon) {
        if (localStorage.getItem("menu-collapsed") === "true") {
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        } else {
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }
    }

    const toggleSidebar = document.getElementById('toggle-sidebar');
    if (toggleSidebar && openIcon && closeIcon && sidebar && mainContent) {
        addClickListenerOnce(toggleSidebar, 'ToggleSidebar', () => {
            // Toggle icons
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            // Add transition classes only during click events
            sidebar.classList.add('transition-transform', 'duration-300', 'ease-in-out');
            mainContent.classList.add('transition-all', 'duration-300', 'ease-in-out');

            if (localStorage.getItem("menu-collapsed") === "true") {
                localStorage.setItem("menu-collapsed", "false");
                sidebar.classList.remove('hidden');
                sidebar.classList.add('flex', 'lg:flex', 'translate-x-0');
                mainContent.classList.add('ltr:lg:ml-56', 'rtl:lg:mr-56');
            } else {
                localStorage.setItem("menu-collapsed", "true");
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                mainContent.classList.remove('ltr:lg:ml-56', 'rtl:lg:mr-56');

                sidebar.addEventListener('transitionend', function handler() {
                    if (localStorage.getItem("menu-collapsed") === "true") {
                        sidebar.classList.add('hidden');
                        sidebar.classList.remove('flex', 'lg:flex');
                        // Remove transition classes after animation
                        sidebar.classList.remove('transition-transform', 'duration-300', 'ease-in-out');
                        mainContent.classList.remove('transition-all', 'duration-300', 'ease-in-out');
                    }
                    sidebar.removeEventListener('transitionend', handler);
                });
            }
        });
    }

    if (sidebar) {
        const toggleSidebarMobile = (
            sidebar,
            sidebarBackdrop,
            toggleSidebarMobileHamburger,
            toggleSidebarMobileClose
        ) => {
            sidebar.classList.toggle("hidden");
            sidebarBackdrop.classList.toggle("hidden");
            toggleSidebarMobileHamburger.classList.toggle("hidden");
            toggleSidebarMobileClose.classList.toggle("hidden");
        };

        const toggleSidebarMobileEl = document.getElementById(
            "toggleSidebarMobile"
        );
        const sidebarBackdrop = document.getElementById("sidebarBackdrop");
        const toggleSidebarMobileHamburger = document.getElementById(
            "toggleSidebarMobileHamburger"
        );
        const toggleSidebarMobileClose = document.getElementById(
            "toggleSidebarMobileClose"
        );
        const toggleSidebarMobileSearch = document.getElementById(
            "toggleSidebarMobileSearch"
        );

        const toggleMobileSidebar = () => {
            toggleSidebarMobile(
                sidebar,
                sidebarBackdrop,
                toggleSidebarMobileHamburger,
                toggleSidebarMobileClose
            );
        };

        addClickListenerOnce(toggleSidebarMobileSearch, 'ToggleSidebarMobileSearch', toggleMobileSidebar);
        addClickListenerOnce(toggleSidebarMobileEl, 'ToggleSidebarMobileEl', toggleMobileSidebar);
        addClickListenerOnce(sidebarBackdrop, 'SidebarBackdrop', toggleMobileSidebar);
    }

    // Reinitialize Flowbite components
    initFlowbite();
});

let attrs = [
    "snapshot",
    "effects",
    // 'click',
    // 'id'
];

function snapKill() {
    document
        .querySelectorAll("div, nav, a, header")
        .forEach(function (element) {
            for (let i in attrs) {
                if (element.getAttribute(`wire:${attrs[i]}`) !== null) {
                    element.removeAttribute(`wire:${attrs[i]}`);
                }
            }
        });
}

window.addEventListener("load", (ev) => {
    snapKill();
});

function initPasswordToggles() {
    // Remove existing listeners to prevent duplicates
    document.removeEventListener('click', handlePasswordToggle);
    // Add single event listener on document
    document.addEventListener('click', handlePasswordToggle);
}

function handlePasswordToggle(event) {
    // Check if clicked element or its parent has toggle-password class
    const toggleButton = event.target.closest('.toggle-password');
    if (!toggleButton) return;

    // Find the closest parent div and get related elements
    const wrapper = toggleButton.closest('.relative');
    const passwordInput = wrapper.querySelector('.password');
    const eyeIcon = wrapper.querySelector('.eye-icon');
    const eyeSlashIcon = wrapper.querySelector('.eye-slash-icon');

    // Toggle password visibility
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";

    // Toggle the icons
    eyeIcon.classList.toggle("hidden", isPassword);
    eyeSlashIcon.classList.toggle("hidden", !isPassword);
}

initPasswordToggles();

// Re-initialize when Livewire updates the DOM
document.addEventListener('livewire:navigated', () => {
    initPasswordToggles();
});

