<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Examination Window</title>
    <!-- Bootstrap CSS CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Inter Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- Remixicon CDN for icons -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
   

    <main class="container py-4">
      <div class="exam-header-info">
        <h1 class="exam-title-display">Mathematics Practice Exam</h1>
        <div class="timer-display">
          <i class="ri-time-line"></i>
          <span id="examTimer">00:30:00</span>
        </div>
      </div>

      <form id="examForm">
        <!-- Section A: Multiple Choice Questions -->
        <div class="question-section-card">
          <h2 class="section-heading">Section A: Multiple Choice</h2>

          <!-- Question 1 -->
          <div class="question-card">
            <p class="question-number">
              Question 1 <span class="float-end text-muted">Marks: 2</span>
            </p>
            <p class="question-text">
              What is the derivative of f(x) = x² + 2x?
            </p>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q1"
                id="q1_option1"
                value="2x+2"
              />
              <label class="form-check-label" for="q1_option1"> 2x + 2 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q1"
                id="q1_option2"
                value="x+2"
              />
              <label class="form-check-label" for="q1_option2"> x + 2 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q1"
                id="q1_option3"
                value="x^2+2"
              />
              <label class="form-check-label" for="q1_option3"> x² + 2 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q1"
                id="q1_option4"
                value="2x"
              />
              <label class="form-check-label" for="q1_option4"> 2x </label>
            </div>
          </div>

          <!-- Question 2 -->
          <div class="question-card">
            <p class="question-number">
              Question 2 <span class="float-end text-muted">Marks: 1</span>
            </p>
            <p class="question-text">What is 5 + 3?</p>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q2"
                id="q2_option1"
                value="7"
              />
              <label class="form-check-label" for="q2_option1"> 7 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q2"
                id="q2_option2"
                value="8"
              />
              <label class="form-check-label" for="q2_option2"> 8 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q2"
                id="q2_option3"
                value="9"
              />
              <label class="form-check-label" for="q2_option3"> 9 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="q2"
                id="q2_option4"
                value="10"
              />
              <label class="form-check-label" for="q2_option4"> 10 </label>
            </div>
          </div>
        </div>

        <!-- Section B: Short Answer Questions -->
        <div class="question-section-card">
          <h2 class="section-heading">Section B: Short Answer</h2>

          <!-- Question 3 -->
          <div class="question-card">
            <p class="question-number">
              Question 3 <span class="float-end text-muted">Marks: 5</span>
            </p>
            <p class="question-text">Define the Pythagorean theorem.</p>
            <div class="mb-3">
              <textarea
                class="form-control"
                name="q3"
                id="q3_answer"
                rows="3"
                placeholder="Type your answer here..."
              ></textarea>
              <a
                href="camera.html"
                class="btn btn-outline-primary btn-sm capture-btn mt-2"
                data-target-textarea="q3_answer"
              >
                <i class="ri-camera-line me-2"></i> Capture Handwritten Answer
              </a>
            </div>
          </div>
        </div>

        <!-- Section C: Long Answer Questions -->
        <div class="question-section-card">
          <h2 class="section-heading">Section C: Long Answer</h2>

          <!-- Question 4 -->
          <div class="question-card">
            <p class="question-number">
              Question 4 <span class="float-end text-muted">Marks: 10</span>
            </p>
            <p class="question-text">
              Explain the concept of calculus and its applications in real life.
            </p>
            <div class="mb-3">
              <textarea
                class="form-control"
                name="q4"
                id="q4_answer"
                rows="6"
                placeholder="Type your detailed answer here..."
              ></textarea>
              <button
                type="button"
                class="btn btn-outline-primary btn-sm capture-btn mt-2"
                data-target-textarea="q4_answer"
              >
                <i class="ri-camera-line me-2"></i> Capture Handwritten Answer
              </button>
            </div>
          </div>
        </div>
      </form>
    </main>

    <footer class="exam-footer">
      <button type="button" class="btn btn-secondary" id="prevSectionBtn">
        <i class="ri-arrow-left-line me-2"></i> Previous Section
      </button>
      <button type="button" class="btn btn-primary" id="nextSectionBtn">
        Next Section <i class="ri-arrow-right-line ms-2"></i>
      </button>
      <button
        type="button"
        class="btn btn-success"
        id="submitExamBtn"
        data-bs-toggle="modal"
        data-bs-target="#submitConfirmModal"
      >
        Submit Exam <i class="ri-check-line ms-2"></i>
      </button>
    </footer>

    <!-- Submit Confirmation Modal -->
    <div
      class="modal fade"
      id="submitConfirmModal"
      tabindex="-1"
      aria-labelledby="submitConfirmModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="submitConfirmModalLabel">
              Confirm Submission
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            Are you sure you want to submit your exam? You will not be able to
            make changes after submission.
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
            <button type="button" class="btn btn-success" id="confirmSubmitBtn">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const examDuration = 30 * 60; // 30 minutes in seconds
        let timeRemaining = examDuration;
        const timerDisplay = document.getElementById("examTimer");
        const sections = document.querySelectorAll(".question-section-card");
        let currentSectionIndex = 0;

        const prevSectionBtn = document.getElementById("prevSectionBtn");
        const nextSectionBtn = document.getElementById("nextSectionBtn");
        const submitExamBtn = document.getElementById("submitExamBtn");
        const confirmSubmitBtn = document.getElementById("confirmSubmitBtn");
        const captureButtons = document.querySelectorAll(".capture-btn");

        function updateTimer() {
          const minutes = Math.floor(timeRemaining / 60);
          const seconds = timeRemaining % 60;
          timerDisplay.textContent = `${String(minutes).padStart(
            2,
            "0"
          )}:${String(seconds).padStart(2, "0")}`;

          if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            alert("Time's up! Your exam has been automatically submitted.");
            submitExam();
          } else {
            timeRemaining--;
          }
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // Initial call to display timer immediately

        function showSection(index) {
          sections.forEach((section, i) => {
            section.style.display = i === index ? "block" : "none";
          });
          updateNavigationButtons();
        }

        function updateNavigationButtons() {
          prevSectionBtn.disabled = currentSectionIndex === 0;
          nextSectionBtn.disabled = currentSectionIndex === sections.length - 1;
          submitExamBtn.style.display =
            currentSectionIndex === sections.length - 1 ? "block" : "none";
        }

        prevSectionBtn.addEventListener("click", function () {
          if (currentSectionIndex > 0) {
            currentSectionIndex--;
            showSection(currentSectionIndex);
          }
        });

        nextSectionBtn.addEventListener("click", function () {
          if (currentSectionIndex < sections.length - 1) {
            currentSectionIndex++;
            showSection(currentSectionIndex);
          }
        });

        confirmSubmitBtn.addEventListener("click", function () {
          submitExam();
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("submitConfirmModal")
          );
          modal.hide();
        });

        function submitExam() {
          clearInterval(timerInterval);
          // In a real application, you would collect all answers from the form
          // and send them to a server for grading.
          console.log("Exam submitted!");
          alert("Your exam has been submitted successfully!");
        }

        // Open camera app in a new window/tab
        captureButtons.forEach((button) => {
          button.addEventListener("click", function () {
            const targetTextareaId = this.dataset.targetTextarea;
            // Pass the target textarea ID to the camera app via URL parameter
            window.open(
              `camera.html?targetTextareaId=${targetTextareaId}`,
              "_blank",
              "width=800,height=600,resizable,scrollbars"
            );
          });
        });

        // Listen for messages from the camera app
        window.addEventListener("message", function (event) {
          // Ensure the message is from a trusted origin in a real application
          // if (event.origin !== 'YOUR_APP_ORIGIN') return;

          if (event.data && event.data.type === "ocrResult") {
            const { targetId, text } = event.data;
            const targetTextarea = document.getElementById(targetId);
            if (targetTextarea) {
              targetTextarea.value = text;
            }
          }
        });

        // Initially show the first section
        showSection(currentSectionIndex);
      });
    </script>
  </body>
</html>
