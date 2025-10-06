(() => {
  // src/js/main.js
  console.log("WTF Alpha theme loaded!");
  document.addEventListener("DOMContentLoaded", () => {
    const mobileMenu = document.querySelector(".mobile-menu");
    if (mobileMenu) {
      const menuItemsWithChildren = mobileMenu.querySelectorAll(
        ".menu-item-has-children"
      );
      menuItemsWithChildren.forEach((menuItem) => {
        const link = menuItem.querySelector("a");
        const caret = link.querySelector("svg");
        if (link && caret) {
          link.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            menuItem.classList.toggle("menu-open");
            caret.classList.toggle("rotate-180");
          });
        }
      });
    }
    const menuToggle = document.querySelector(".menu-toggle");
    if (menuToggle) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.attributeName === "aria-expanded") {
            const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";
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
})();
