const hamburgerMenu = document.querySelector(".hamburger-menu");
const mobileNavigation = document.querySelector(".cs-mobile-navigation");

hamburgerMenu.addEventListener("click", () => {
  const isOpened = hamburgerMenu.getAttribute("aria-expanded");

  if (isOpened === "false") {
    hamburgerMenu.setAttribute("aria-expanded", "true");
    mobileNavigation.setAttribute("data-visible", "true");
    document.body.classList.add("remove-scrolling");
  } else {
    hamburgerMenu.setAttribute("aria-expanded", "false");
    mobileNavigation.setAttribute("data-visible", "false");
    document.body.classList.remove("remove-scrolling");
  }
});
