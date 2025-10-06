/**
 * WTF Alpha Theme Custom JavaScript
 * Alpine.js is loaded via CDN in functions.php
 */

console.log("WTF Alpha theme loaded!");

// Mobile menu dropdown functionality
document.addEventListener("DOMContentLoaded", () => {
  // Handle mobile menu dropdowns - make them clickable instead of hover
  const mobileMenu = document.querySelector(".mobile-menu");

  if (mobileMenu) {
    const menuItemsWithChildren = mobileMenu.querySelectorAll(
      ".menu-item-has-children"
    );

    menuItemsWithChildren.forEach((menuItem) => {
      const link = menuItem.querySelector("a");
      const caret = link.querySelector("svg");

      if (link && caret) {
        // Prevent default link action if it has children
        link.addEventListener("click", (e) => {
          e.preventDefault();
          e.stopPropagation();

          // Toggle the submenu
          menuItem.classList.toggle("menu-open");

          // Rotate the caret
          caret.classList.toggle("rotate-180");
        });
      }
    });
  }

  // Prevent body scroll when mobile menu is open
  const menuToggle = document.querySelector(".menu-toggle");
  if (menuToggle) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.attributeName === "aria-expanded") {
          const isExpanded =
            menuToggle.getAttribute("aria-expanded") === "true";
          if (isExpanded) {
            document.body.classList.add("mobile-menu-open");
          } else {
            document.body.classList.remove("mobile-menu-open");
          }
        }
      });
    });

    observer.observe(menuToggle, { attributes: true });
  }
});
