// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    const target = document.querySelector(this.getAttribute("href"))
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      })
    }
  })
})

// Navbar background change on scroll
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".custom-navbar")
  if (window.scrollY > 50) {
    navbar.style.background = "rgba(255, 255, 255, 0.98)"
    navbar.style.boxShadow = "0 4px 20px rgba(0, 0, 0, 0.1)"
  } else {
    navbar.style.background = "rgba(255, 255, 255, 0.95)"
    navbar.style.boxShadow = "0 4px 6px -1px rgba(0, 0, 0, 0.1)"
  }
})

// Animate progress bars when in view
function animateProgressBars() {
  const progressBars = document.querySelectorAll(".progress-bar, .metric-fill")

  progressBars.forEach((bar) => {
    const rect = bar.getBoundingClientRect()
    const isVisible = rect.top < window.innerHeight && rect.bottom > 0

    if (isVisible && !bar.classList.contains("animated")) {
      bar.classList.add("animated")
      const width = bar.style.width || bar.getAttribute("data-width") || "0%"
      bar.style.width = "0%"
      setTimeout(() => {
        bar.style.width = width
      }, 100)
    }
  })
}

// Scroll animations
function handleScrollAnimations() {
  const elements = document.querySelectorAll(".service-card, .feature-item-large, .pricing-card, .contact-info")

  elements.forEach((element) => {
    const rect = element.getBoundingClientRect()
    const isVisible = rect.top < window.innerHeight - 100

    if (isVisible && !element.classList.contains("scroll-animate")) {
      element.classList.add("scroll-animate")
      setTimeout(() => {
        element.classList.add("animate")
      }, 100)
    }
  })
}

// Animate statistics counter
function animateCounters() {
  const counters = document.querySelectorAll(".stat-number")

  counters.forEach((counter) => {
    const rect = counter.getBoundingClientRect()
    const isVisible = rect.top < window.innerHeight && rect.bottom > 0

    if (isVisible && !counter.classList.contains("counted")) {
      counter.classList.add("counted")
      const target = Number.parseInt(counter.textContent.replace(/\D/g, ""))
      const suffix = counter.textContent.replace(/\d/g, "")
      let current = 0
      const increment = target / 50

      const timer = setInterval(() => {
        current += increment
        if (current >= target) {
          current = target
          clearInterval(timer)
        }
        counter.textContent = Math.floor(current) + suffix
      }, 30)
    }
  })
}

// Grading progress animation
function animateGradingProgress() {
  const progressPercent = document.querySelector(".progress-percent")
  const progressBar = document.querySelector(".progress-bar")

  if (progressPercent && progressBar) {
    let progress = 0
    const target = 87
    const timer = setInterval(() => {
      progress += 2
      if (progress >= target) {
        progress = target
        clearInterval(timer)
      }
      progressPercent.textContent = progress + "%"
      progressBar.style.width = progress + "%"
    }, 50)
  }
}

// Form submission handling
document.querySelector(".contact-form")?.addEventListener("submit", function (e) {
  e.preventDefault()

  // Show success message
  const button = this.querySelector('button[type="submit"]')
  const originalText = button.textContent

  button.textContent = "Sending..."
  button.disabled = true

  // Simulate form submission
  setTimeout(() => {
    button.textContent = "Message Sent!"
    button.classList.remove("btn-primary")
    button.classList.add("btn-success")

    setTimeout(() => {
      button.textContent = originalText
      button.disabled = false
      button.classList.remove("btn-success")
      button.classList.add("btn-primary")
      this.reset()
    }, 2000)
  }, 1500)
})

// Modal form handling
document.querySelectorAll(".modal form").forEach((form) => {
  form.addEventListener("submit", function (e) {
    e.preventDefault()

    const button = this.querySelector('button[type="submit"]')
    const originalText = button.textContent

    button.textContent = "Processing..."
    button.disabled = true

    setTimeout(() => {
      button.textContent = "Success!"
      button.classList.remove("btn-primary")
      button.classList.add("btn-success")

      setTimeout(() => {
        const modal = window.bootstrap.Modal.getInstance(this.closest(".modal"))
        modal.hide()

        button.textContent = originalText
        button.disabled = false
        button.classList.remove("btn-success")
        button.classList.add("btn-primary")
        this.reset()
      }, 1500)
    }, 1000)
  })
})

// Pricing card hover effects
document.querySelectorAll(".pricing-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = this.classList.contains("featured") ? "scale(1.05) translateY(-10px)" : "translateY(-10px)"
  })

  card.addEventListener("mouseleave", function () {
    this.style.transform = this.classList.contains("featured") ? "scale(1.05)" : "none"
  })
})

// Service card rotation reset on hover
document.querySelectorAll(".service-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-10px) rotate(0deg)"
  })

  card.addEventListener("mouseleave", function () {
    const isEven = Array.from(this.parentNode.children).indexOf(this) % 2 === 1
    this.style.transform = isEven ? "rotate(2deg)" : "rotate(-2deg)"
  })
})

// Initialize animations on scroll
window.addEventListener("scroll", () => {
  animateProgressBars()
  handleScrollAnimations()
  animateCounters()
})

// Initialize animations on load
window.addEventListener("load", () => {
  document.body.classList.add("loading")
  animateGradingProgress()

  // Trigger initial scroll animations
  setTimeout(() => {
    handleScrollAnimations()
    animateCounters()
  }, 500)
})

// Smooth reveal animation for sections
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1"
      entry.target.style.transform = "translateY(0)"
    }
  })
}, observerOptions)

// Observe all sections
document.querySelectorAll("section").forEach((section) => {
  section.style.opacity = "0"
  section.style.transform = "translateY(30px)"
  section.style.transition = "all 0.6s ease"
  observer.observe(section)
})

// Add active class to navigation links based on scroll position
window.addEventListener("scroll", () => {
  const sections = document.querySelectorAll("section[id]")
  const navLinks = document.querySelectorAll(".nav-link")

  let current = ""
  sections.forEach((section) => {
    const sectionTop = section.offsetTop
    const sectionHeight = section.clientHeight
    if (scrollY >= sectionTop - 200) {
      current = section.getAttribute("id")
    }
  })

  navLinks.forEach((link) => {
    link.classList.remove("active")
    if (link.getAttribute("href") === "#" + current) {
      link.classList.add("active")
    }
  })
})

// Particle effect for hero section (optional enhancement)
function createParticles() {
  const heroSection = document.querySelector(".hero-section")
  const particleCount = 20

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div")
    particle.className = "particle"
    particle.style.cssText = `
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(8, 145, 178, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: float ${3 + Math.random() * 4}s ease-in-out infinite;
            left: ${Math.random() * 100}%;
            top: ${Math.random() * 100}%;
            animation-delay: ${Math.random() * 2}s;
        `
    heroSection.appendChild(particle)
  }
}

// Initialize particles on load
window.addEventListener("load", createParticles)

// Add CSS for particles animation
const style = document.createElement("style")
style.textContent = `
    .particle {
        animation: particleFloat 6s ease-in-out infinite;
    }

    @keyframes particleFloat {
        0%, 100% {
            transform: translateY(0px) translateX(0px);
            opacity: 0.3;
        }
        25% {
            transform: translateY(-20px) translateX(10px);
            opacity: 0.6;
        }
        50% {
            transform: translateY(-40px) translateX(-10px);
            opacity: 0.3;
        }
        75% {
            transform: translateY(-20px) translateX(5px);
            opacity: 0.6;
        }
    }
`
document.head.appendChild(style)
