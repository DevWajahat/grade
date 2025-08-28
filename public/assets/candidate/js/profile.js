// Profile Page JavaScript
document.addEventListener("DOMContentLoaded", () => {
  // Initialize profile page
  initializeProfile()

  // Handle avatar upload
  handleAvatarUpload()

  // Handle form validation
  setupFormValidation()
})

function initializeProfile() {
  // Animate progress bars
  setTimeout(() => {
    const progressBars = document.querySelectorAll(".progress-bar")
    progressBars.forEach((bar) => {
      const width = bar.style.width
      bar.style.width = "0%"
      setTimeout(() => {
        bar.style.width = width
      }, 100)
    })
  }, 500)

  // Add loading animation
  document.body.classList.add("loading")
}

function toggleEdit(formType) {
  const form = document.getElementById(formType + "Form")
  const inputs = form.querySelectorAll("input, select")
  const actions = form.querySelector(".form-actions")
  const editBtn = form.closest(".profile-card").querySelector(".btn-outline-primary")

  const isReadonly = inputs[0].hasAttribute("readonly") || inputs[0].hasAttribute("disabled")

  if (isReadonly) {
    // Enable editing
    inputs.forEach((input) => {
      input.removeAttribute("readonly")
      input.removeAttribute("disabled")
      input.classList.add("form-control-editable")
    })
    actions.style.display = "block"
    editBtn.innerHTML = '<i class="fas fa-times"></i> Cancel'
    editBtn.classList.remove("btn-outline-primary")
    editBtn.classList.add("btn-outline-danger")
  } else {
    // Cancel editing
    cancelEdit(formType)
  }
}

function cancelEdit(formType) {
  const form = document.getElementById(formType + "Form")
  const inputs = form.querySelectorAll("input, select")
  const actions = form.querySelector(".form-actions")
  const editBtn = form.closest(".profile-card").querySelector(".btn-outline-danger, .btn-outline-primary")

  // Disable editing
  inputs.forEach((input) => {
    input.setAttribute("readonly", "")
    if (input.tagName === "SELECT") {
      input.setAttribute("disabled", "")
    }
    input.classList.remove("form-control-editable")
  })
  actions.style.display = "none"
  editBtn.innerHTML = '<i class="fas fa-edit"></i> Edit'
  editBtn.classList.remove("btn-outline-danger")
  editBtn.classList.add("btn-outline-primary")

  // Reset form values (in real app, fetch from server)
  resetFormValues(formType)
}

function saveForm(formType) {
  const form = document.getElementById(formType + "Form")

  // Validate form
  if (!validateForm(form)) {
    return
  }

  // Show loading state
  const saveBtn = form.querySelector(".btn-primary")
  const originalText = saveBtn.innerHTML
  saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...'
  saveBtn.disabled = true

  // Simulate API call
  setTimeout(() => {
    // Success feedback
    showNotification("Profile updated successfully!", "success")

    // Disable editing
    cancelEdit(formType)

    // Reset button
    saveBtn.innerHTML = originalText
    saveBtn.disabled = false
  }, 1500)
}

function resetFormValues(formType) {
  // In a real application, this would fetch the original values from the server
  // For demo purposes, we'll keep the current values
  console.log(`[v0] Resetting ${formType} form values`)
}

function validateForm(form) {
  const inputs = form.querySelectorAll("input[required], select[required]")
  let isValid = true

  inputs.forEach((input) => {
    if (!input.value.trim()) {
      input.classList.add("is-invalid")
      isValid = false
    } else {
      input.classList.remove("is-invalid")
    }
  })

  if (!isValid) {
    showNotification("Please fill in all required fields.", "error")
  }

  return isValid
}

function handleAvatarUpload() {
  const avatarInput = document.getElementById("avatarInput")
  const avatarPreview = document.querySelector(".avatar-preview")

  avatarInput.addEventListener("change", (e) => {
    const file = e.target.files[0]
    if (file) {
      const reader = new FileReader()
      reader.onload = (e) => {
        avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
      }
      reader.readAsDataURL(file)
    }
  })
}

function setupFormValidation() {
  // Real-time validation
  const forms = document.querySelectorAll("form")
  forms.forEach((form) => {
    const inputs = form.querySelectorAll("input, select")
    inputs.forEach((input) => {
      input.addEventListener("blur", function () {
        validateField(this)
      })

      input.addEventListener("input", function () {
        if (this.classList.contains("is-invalid")) {
          validateField(this)
        }
      })
    })
  })
}

function validateField(field) {
  const value = field.value.trim()
  let isValid = true
  let errorMessage = ""

  // Required field validation
  if (field.hasAttribute("required") && !value) {
    isValid = false
    errorMessage = "This field is required."
  }

  // Email validation
  if (field.type === "email" && value) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(value)) {
      isValid = false
      errorMessage = "Please enter a valid email address."
    }
  }

  // Phone validation
  if (field.type === "tel" && value) {
    const phoneRegex = /^[+]?[1-9][\d]{0,15}$/
    if (!phoneRegex.test(value.replace(/[\s\-$$$$]/g, ""))) {
      isValid = false
      errorMessage = "Please enter a valid phone number."
    }
  }

  // Update field state
  if (isValid) {
    field.classList.remove("is-invalid")
    field.classList.add("is-valid")
  } else {
    field.classList.remove("is-valid")
    field.classList.add("is-invalid")
  }

  // Show/hide error message
  let errorDiv = field.parentNode.querySelector(".invalid-feedback")
  if (!errorDiv && !isValid) {
    errorDiv = document.createElement("div")
    errorDiv.className = "invalid-feedback"
    field.parentNode.appendChild(errorDiv)
  }

  if (errorDiv) {
    errorDiv.textContent = errorMessage
    errorDiv.style.display = isValid ? "none" : "block"
  }
}

function showNotification(message, type = "info") {
  // Create notification element
  const notification = document.createElement("div")
  notification.className = `alert alert-${type === "error" ? "danger" : type} alert-dismissible fade show position-fixed`
  notification.style.cssText = "top: 100px; right: 20px; z-index: 1050; min-width: 300px;"
  notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `

  // Add to page
  document.body.appendChild(notification)

  // Auto remove after 5 seconds
  setTimeout(() => {
    if (notification.parentNode) {
      notification.remove()
    }
  }, 5000)
}

// Handle settings toggles
document.addEventListener("change", (e) => {
  if (e.target.type === "checkbox" && e.target.closest(".setting-item")) {
    const settingName = e.target.closest(".setting-item").querySelector(".setting-label").textContent
    const isEnabled = e.target.checked

    console.log(`[v0] Setting "${settingName}" ${isEnabled ? "enabled" : "disabled"}`)
    showNotification(`${settingName} ${isEnabled ? "enabled" : "disabled"}`, "info")
  }
})

