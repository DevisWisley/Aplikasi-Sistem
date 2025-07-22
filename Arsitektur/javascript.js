// Smooth Scroll for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener("click", function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
    }
  });
});

// Toggle sidebar
function toggleSidebar() {
  const sidebar = document.getElementById("mySidebar");
  if (sidebar.classList.contains("w3-show")) {
    sidebar.classList.remove("w3-show");
    sidebar.classList.add("w3-hide");
  } else {
    sidebar.classList.remove("w3-hide");
    sidebar.classList.add("w3-show");
  }
}

function closeSidebar() {
  const sidebar = document.getElementById("mySidebar");
  sidebar.classList.remove("w3-show");
  sidebar.classList.add("w3-hide");
}
// Toggle Sidebar Mobile
function toggleSidebar() {
  const sidebar = document.getElementById("mySidebar");
  if (sidebar.classList.contains("w3-hide")) {
    sidebar.classList.remove("w3-hide");
    sidebar.classList.add("w3-show");
  } else {
    sidebar.classList.add("w3-hide");
    sidebar.classList.remove("w3-show");
  }
}

function closeSidebar() {
  document.getElementById("mySidebar").classList.add("w3-hide");
  document.getElementById("mySidebar").classList.remove("w3-show");
}

// Animate on Scroll
function animateOnScroll() {
  const elements = document.querySelectorAll('.animate-on-scroll');
  
  elements.forEach(element => {
    const elementPosition = element.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;
    
    if (elementPosition < screenPosition) {
      element.classList.add('animated');
    }
  });
}

// Add animate-on-scroll class to sections
document.addEventListener('DOMContentLoaded', function() {
  const sections = document.querySelectorAll('.w3-container[id], header');
  sections.forEach(section => {
    section.classList.add('animate-on-scroll');
  });
  
  // Initial check
  animateOnScroll();
});

// Event listener for scroll
window.addEventListener('scroll', animateOnScroll);

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    
    const targetId = this.getAttribute('href');
    const targetElement = document.querySelector(targetId);
    
    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 80,
        behavior: 'smooth'
      });
      
      // Close sidebar if open (for mobile)
      closeSidebar();
    }
  });
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.w3-bar');
  if (window.scrollY > 100) {
    navbar.style.padding = '10px 0';
    navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
  } else {
    navbar.style.padding = '16px 0';
    navbar.style.boxShadow = 'none';
  }
});