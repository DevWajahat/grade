// Exam Detail Page JavaScript
document.addEventListener("DOMContentLoaded", () => {
  // Initialize page
  initializeExamDetail()
})

function initializeExamDetail() {
  // Setup section tabs
  setupSectionTabs()

  // Setup accordion functionality
  setupAccordions()

  // Setup sidebar
  setupSidebar()
}

// Section Tabs Functionality
function setupSectionTabs() {
  const tabButtons = document.querySelectorAll(".tab-btn")
  const sectionContents = document.querySelectorAll(".section-content")

  tabButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const targetSection = this.dataset.section

      // Remove active class from all tabs and sections
      tabButtons.forEach((btn) => btn.classList.remove("active"))
      sectionContents.forEach((section) => section.classList.remove("active"))

      // Add active class to clicked tab and corresponding section
      this.classList.add("active")
      document.getElementById(`${targetSection}-section`).classList.add("active")
    })
  })
}

// Accordion Functionality
function setupAccordions() {
  const accordionHeaders = document.querySelectorAll(".accordion-header")
  const nestedHeaders = document.querySelectorAll(".nested-header")

  // Main accordion headers
  accordionHeaders.forEach((header) => {
    header.addEventListener("click", function () {
      const target = this.dataset.bsTarget
      const targetElement = document.querySelector(target)
      const isExpanded = this.getAttribute("aria-expanded") === "true"

      // Toggle aria-expanded
      this.setAttribute("aria-expanded", !isExpanded)

      // Toggle collapse
      if (targetElement.classList.contains("show")) {
        targetElement.classList.remove("show")
      } else {
        targetElement.classList.add("show")
      }
    })
  })

  // Nested accordion headers
  nestedHeaders.forEach((header) => {
    header.addEventListener("click", function () {
      const target = this.dataset.bsTarget
      const targetElement = document.querySelector(target)
      const isExpanded = this.getAttribute("aria-expanded") === "true"

      // Toggle aria-expanded
      this.setAttribute("aria-expanded", !isExpanded)

      // Toggle collapse
      if (targetElement.classList.contains("show")) {
        targetElement.classList.remove("show")
      } else {
        targetElement.classList.add("show")
      }
    })
  })
}

// Sidebar Functionality
function setupSidebar() {
  const navItems = document.querySelectorAll(".nav-item")

  navItems.forEach((item) => {
    item.addEventListener("click", function (e) {
      if (this.textContent.trim().includes("Logout")) {
        e.preventDefault()
        handleLogout()
      }
    })
  })
}

// Handle logout
function handleLogout() {
  if (confirm("Are you sure you want to logout?")) {
    // Redirect to login page
    window.location.href = "login.html"
  }
}

// Utility function to calculate section scores
function calculateSectionScores() {
  const sections = document.querySelectorAll(".section-content")

  sections.forEach((section) => {
    const questions = section.querySelectorAll(".question-accordion")
    let totalScore = 0
    let maxScore = 0

    questions.forEach((question) => {
      const scoreText = question.querySelector(".question-score .score").textContent
      const [current, max] = scoreText.split("/").map((num) => Number.parseInt(num))
      totalScore += current
      maxScore += max
    })

    // Update section score display
    const sectionScoreElement = section.parentElement.querySelector(".section-score")
    if (sectionScoreElement) {
      sectionScoreElement.textContent = `${totalScore}/${maxScore}`
    }
  })
}

// Initialize score calculations
calculateSectionScores()
