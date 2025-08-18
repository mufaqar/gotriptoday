/*Sticky Sidebar */

document.addEventListener("DOMContentLoaded", function () {
  // Cache elements
  const sticky = document.querySelector(".sticky-sidebar");
  const spacer = document.querySelector(".sticky-spacer");
  const stickyOffset = sticky.getBoundingClientRect().top + window.pageYOffset;
  const stickyWidth = sticky.offsetWidth;

  // Handle scroll event
  window.addEventListener("scroll", function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const documentHeight = Math.max(
      document.body.scrollHeight,
      document.body.offsetHeight,
      document.documentElement.clientHeight,
      document.documentElement.scrollHeight,
      document.documentElement.offsetHeight
    );
    const windowHeight = window.innerHeight;
    const distanceFromBottom = documentHeight - (scrollTop + windowHeight);

    // Check if we're within 200px of the bottom
    if (distanceFromBottom < 200) {
      sticky.classList.remove("stuck");
      sticky.style.width = "";
      spacer.classList.remove("active");
      spacer.style.height = "0";
    }
    // Otherwise, apply the original sticky logic
    else if (scrollTop >= stickyOffset) {
      sticky.classList.add("stuck");
      sticky.style.width = `${stickyWidth}px`;
      spacer.classList.add("active");
      spacer.style.height = `${sticky.offsetHeight}px`;
    } else {
      sticky.classList.remove("stuck");
      sticky.style.width = "";
      spacer.classList.remove("active");
      spacer.style.height = "0";
    }
  });

  // Handle window resize to adjust width
  window.addEventListener("resize", function () {
    if (sticky.classList.contains("stuck")) {
      sticky.style.width = `${sticky.parentElement.offsetWidth}px`;
    }
  });
});
