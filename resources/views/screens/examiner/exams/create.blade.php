@extends('layouts.examiner.app')
@section('content')
    <style>
        :root {
            --primary: #009CFF;
            --secondary: #6610f2;
            --dark: #191C24;
            --light: #F3F6F9;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-secondary:hover {
            background-color: #5c0cdb;
            border-color: #5c0cdb;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .option-container .input-group-text {
            background-color: #ffffff;
        }

        .form-control.is-invalid,
        .form-select.is-invalid,
        .was-validated .form-control:invalid,
        .was-validated .form-select:invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .is-invalid~.invalid-feedback {
            display: block !important;
        }
        .form-control{
            color:#000 !important;
        }
        .form-select{
            color:#000
        }
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="card p-4">
            <h5 class="mb-4">Create New Examination</h5>
            <form id="examinationForm" method="post" action="{{ route('examiner.exams.store') }}" novalidate>
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="examHall" class="form-label">Examination Hall</label>
                        <select class="form-select" id="examHall" name="exam_hall" aria-label="Examination Hall">
                            @forelse ($halls as $hall)
                                <option  value="{{ $hall->id }}">{{ $hall->title }}</option>
                            @empty
                            @endforelse
                        </select>
                        <div class="invalid-feedback">Please select a hall.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="examTitle" class="form-label">Exam Title</label>
                        <input type="text" class="form-control" id="examTitle" name="exam_title"
                            placeholder="e.g., Midterm Exam - Q1 2025">
                        <div class="invalid-feedback">Please enter an exam title.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="examTitle" class="form-label">Exam Total Marks</label>
                        <input type="number" class="form-control" id="examTotalMarks" name="exam_total_marks"
                            placeholder="e.g., 100">
                        <div class="invalid-feedback">Give Total Marks</div>
                    </div>
                    <div class="col-md-4">
                        <label for="examDuration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control" id="examDuration" name="exam_duration"
                            placeholder="e.g., 90">
                        <div class="invalid-feedback">Please enter a valid duration.</div>
                    </div>
                </div>

                <div id="sectionsContainer">
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="button" class="btn btn-success add-section-btn"><i class="ri-add-line me-1"></i>Add
                        Section</button>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>Save
                        Examination</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sectionsContainer = document.getElementById('sectionsContainer');
            const examinationForm = document.getElementById('examinationForm');
            const addSectionBtn = document.querySelector('.add-section-btn');

            const reIndexForm = () => {
                const sectionCards = sectionsContainer.querySelectorAll('.section-card');
                sectionCards.forEach((sectionCard, sIndex) => {
                    sectionCard.querySelector('.card-header h6').textContent = `Section ${sIndex + 1}`;
                    const removeSectionBtn = sectionCard.querySelector('.remove-section-btn');
                    removeSectionBtn.style.display = sectionsContainer.querySelectorAll('.section-card')
                        .length > 1 ? 'block' : 'none';

                    const questionCards = sectionCard.querySelectorAll('.question-card');
                    questionCards.forEach((questionCard, qIndex) => {
                        questionCard.querySelector('.card-body .d-flex h6').textContent =
                            `Question ${qIndex + 1}`;
                        const removeQuestionBtn = questionCard.querySelector(
                            '.remove-question-btn');
                        removeQuestionBtn.style.display = questionCard.closest(
                                '.questions-container').querySelectorAll('.question-card')
                            .length > 1 ? 'block' : 'none';

                        questionCard.querySelector('textarea.form-control').name =
                            `sections[${sIndex}][questions][${qIndex}][text]`;
                        questionCard.querySelector('select.question-type-select').name =
                            `sections[${sIndex}][questions][${qIndex}][type]`;
                        questionCard.querySelector('input.question-marks-input').name =
                            `sections[${sIndex}][questions][${qIndex}][marks]`;

                        const optionInputs = questionCard.querySelectorAll('.option-item');
                        optionInputs.forEach((optionItem, oIndex) => {
                            const radioInput = optionItem.querySelector(
                                'input[type="radio"]');
                            const textInput = optionItem.querySelector(
                                'input[type="text"]');

                            radioInput.name =
                                `sections[${sIndex}][questions][${qIndex}][correct_option]`;
                            radioInput.value = `${oIndex}`;
                            textInput.name =
                                `sections[${sIndex}][questions][${qIndex}][options][${oIndex}][text]`;

                            const removeOptionBtn = optionItem.querySelector(
                                '.remove-option-btn');
                            removeOptionBtn.style.display = optionItem.closest(
                                    '.option-inputs').querySelectorAll('.option-item')
                                .length > 1 ? 'block' : 'none';
                        });
                    });
                });
            };

            const createOptionInput = (sIndex, qIndex) => {
                const oIndex = document.querySelectorAll(
                    `input[name^="sections[${sIndex}][questions][${qIndex}][options]"]`).length;
                return `
                <div class="input-group mb-2 option-item">
                    <span class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="sections[${sIndex}][questions][${qIndex}][correct_option]" value="${oIndex}">
                    </span>
                    <input type="text" class="form-control option-text-input" name="sections[${sIndex}][questions][${qIndex}][options][${oIndex}][text]" placeholder="Enter option text...">
                    <button type="button" class="btn btn-outline-danger remove-option-btn"><i class="ri-close-line"></i></button>
                    <div class="invalid-feedback">Option text is required.</div>
                </div>
            `;
            };

            const createQuestionCardHtml = (sIndex, qIndex) => {
                return `
                <div class="question-card card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Question ${qIndex + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-question-btn"><i class="ri-delete-bin-line"></i></button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Question Text</label>
                            <textarea class="form-control" name="sections[${sIndex}][questions][${qIndex}][text]" rows="3" placeholder="Enter the question here..."></textarea>
                            <div class="invalid-feedback">Question text is required.</div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Question Type</label>
                                <select class="form-select question-type-select" name="sections[${sIndex}][questions][${qIndex}][type]">
                                    <option selected value="">Select Type</option>
                                    <option value="multiple-choice">Multiple Choice</option>
                                    <option value="short-answer">Short Answer</option>
                                    <option value="long-answer">Long Answer</option>
                                </select>
                                <div class="invalid-feedback">Please select a question type.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Total Marks</label>
                                <input type="number" class="form-control question-marks-input" name="sections[${sIndex}][questions][${qIndex}][marks]" placeholder="e.g., 10">
                                <div class="invalid-feedback">Marks are required.</div>
                            </div>
                        </div>
                        <div class="options-container mt-3"></div>
                    </div>
                </div>
            `;
            };

            const addQuestion = (sectionCard) => {
                const questionsContainer = sectionCard.querySelector('.questions-container');
                const sIndex = Array.from(sectionsContainer.querySelectorAll('.section-card')).indexOf(
                    sectionCard);
                const qIndex = questionsContainer.querySelectorAll('.question-card').length;

                const newQuestionCard = document.createElement('div');
                newQuestionCard.innerHTML = createQuestionCardHtml(sIndex, qIndex);
                questionsContainer.appendChild(newQuestionCard.firstElementChild);
                reIndexForm();
            };

            const addSection = () => {
                const sIndex = sectionsContainer.querySelectorAll('.section-card').length;
                const newSectionCard = document.createElement('div');
                newSectionCard.className = 'section-card card mb-4';
                newSectionCard.innerHTML = `
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Section ${sIndex + 1}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-section-btn"><i class="ri-delete-bin-line"></i></button>
                </div>
                <div class="card-body">
                    <div class="questions-container"></div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-sm btn-secondary add-question-btn"><i class="ri-add-line me-1"></i>Add Question</button>
                    </div>
                </div>
            `;
                sectionsContainer.appendChild(newSectionCard);
                addQuestion(newSectionCard);
                reIndexForm();
            };

            const validateForm = () => {
                let isValid = true;
                examinationForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
                    'is-invalid'));
                examinationForm.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');

                // Validate Exam Details
                const examHall = document.getElementById('examHall');
                const examTitle = document.getElementById('examTitle');
                const examDuration = document.getElementById('examDuration');

                if (examHall.value.trim() === '') {
                    examHall.classList.add('is-invalid');
                    isValid = false;
                }
                if (examTitle.value.trim() === '') {
                    examTitle.classList.add('is-invalid');
                    isValid = false;
                }
                if (examDuration.value.trim() === '' || isNaN(examDuration.value) || parseInt(examDuration
                        .value) <= 0) {
                    examDuration.classList.add('is-invalid');
                    isValid = false;
                }

                // Validate Questions and Sections
                const sectionCards = sectionsContainer.querySelectorAll('.section-card');
                sectionCards.forEach(sectionCard => {
                    const questionCards = sectionCard.querySelectorAll('.question-card');
                    questionCards.forEach(questionCard => {
                        const questionText = questionCard.querySelector('textarea');
                        const questionType = questionCard.querySelector(
                            '.question-type-select');
                        const questionMarks = questionCard.querySelector(
                            '.question-marks-input');

                        if (questionText.value.trim() === '') {
                            questionText.classList.add('is-invalid');
                            isValid = false;
                        }
                        if (questionType.value.trim() === '') {
                            questionType.classList.add('is-invalid');
                            isValid = false;
                        }
                        if (questionMarks.value.trim() === '' || isNaN(questionMarks.value) ||
                            parseInt(questionMarks.value) <= 0) {
                            questionMarks.classList.add('is-invalid');
                            isValid = false;
                        }

                        if (questionType.value === 'multiple-choice') {
                            const optionsContainer = questionCard.querySelector(
                                '.options-container');
                            const optionInputs = optionsContainer.querySelectorAll(
                                '.option-item input[type="text"]');
                            const correctOptionRadios = optionsContainer.querySelectorAll(
                                '.option-item input[type="radio"]');

                            // Require at least one option if multiple-choice is selected
                            if (optionInputs.length === 0) {
                                // Find the correct feedback element or create one
                                let feedbackElement = optionsContainer.querySelector(
                                    '.invalid-feedback');
                                if (!feedbackElement) {
                                    feedbackElement = document.createElement('div');
                                    feedbackElement.className = 'invalid-feedback';
                                    feedbackElement.textContent =
                                        "At least one option is required.";
                                    optionsContainer.appendChild(feedbackElement);
                                }
                                feedbackElement.style.display = 'block';
                                isValid = false;
                            } else {
                                // Validate that all options have text
                                optionInputs.forEach(input => {
                                    if (input.value.trim() === '') {
                                        input.classList.add('is-invalid');
                                        isValid = false;
                                    }
                                });
                            }

                            // Do not require a correct answer if no options exist,
                            // otherwise, ensure one is checked.
                            if (optionInputs.length > 0) {
                                let hasCorrectAnswer = Array.from(correctOptionRadios).some(
                                    radio => radio.checked);
                                // if (!hasCorrectAnswer) {
                                //     const parentDiv = optionsContainer.querySelector('.add-option-btn')?.parentElement || optionsContainer;
                                //     let errorDiv = parentDiv.nextElementSibling;
                                //     if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                                //         errorDiv = document.createElement('div');
                                //         errorDiv.className = 'invalid-feedback text-center mt-2';
                                //         parentDiv.after(errorDiv);
                                //     }
                                //     errorDiv.textContent = "Please select a correct answer.";
                                //     errorDiv.style.display = 'block';
                                //     isValid = false;
                                // }
                            }
                        }
                    });
                });

                return isValid;
            };

            // Add event listeners for dynamic validation to hide errors on input
            examinationForm.addEventListener('input', (e) => {
                if (e.target.matches('.form-control, .form-select')) {
                    e.target.classList.remove('is-invalid');
                    const feedback = e.target.closest('.mb-3, .col-md-6, .option-item').querySelector(
                        '.invalid-feedback');
                    if (feedback) {
                        feedback.style.display = 'none';
                    }
                }
                if (e.target.closest('.options-container') && e.target.matches('input[type="text"]')) {
                    const feedback = e.target.closest('.option-item').querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.style.display = 'none';
                    }
                }
            });

            // Add event listeners for radios (correct answer)
            sectionsContainer.addEventListener('change', (e) => {
                if (e.target.matches('input[type="radio"]')) {
                    const optionsContainer = e.target.closest('.options-container');
                    const errorDiv = optionsContainer.querySelector('.invalid-feedback.text-center');
                    if (errorDiv) {
                        errorDiv.style.display = 'none';
                    }
                }
            });

            // Event Listeners for adding/removing elements
            addSectionBtn.addEventListener('click', addSection);

            sectionsContainer.addEventListener('click', (e) => {
                if (e.target.closest('.add-question-btn')) {
                    const sectionCard = e.target.closest('.section-card');
                    addQuestion(sectionCard);
                }

                if (e.target.closest('.remove-question-btn')) {
                    const questionCard = e.target.closest('.question-card');
                    const questionsContainer = questionCard.closest('.questions-container');
                    if (questionsContainer.querySelectorAll('.question-card').length > 1) {
                        questionCard.remove();
                        reIndexForm();
                    }
                }

                if (e.target.closest('.remove-section-btn')) {
                    const sectionCard = e.target.closest('.section-card');
                    if (sectionsContainer.querySelectorAll('.section-card').length > 1) {
                        sectionCard.remove();
                        reIndexForm();
                    }
                }

                if (e.target.closest('.add-option-btn')) {
                    const questionCard = e.target.closest('.question-card');
                    const optionInputsContainer = questionCard.querySelector('.option-inputs');
                    const sectionCard = questionCard.closest('.section-card');
                    const sIndex = Array.from(sectionsContainer.querySelectorAll('.section-card')).indexOf(
                        sectionCard);
                    const qIndex = Array.from(sectionCard.querySelectorAll('.question-card')).indexOf(
                        questionCard);

                    optionInputsContainer.insertAdjacentHTML('beforeend', createOptionInput(sIndex,
                        qIndex));
                    reIndexForm();
                }

                if (e.target.closest('.remove-option-btn')) {
                    const optionItem = e.target.closest('.option-item');
                    const optionsContainer = optionItem.closest('.option-inputs');
                    if (optionsContainer.querySelectorAll('.option-item').length > 1) {
                        optionItem.remove();
                        reIndexForm();
                    }
                }
            });

            sectionsContainer.addEventListener('change', (e) => {
                if (e.target.matches('.question-type-select')) {
                    const selectElement = e.target;
                    const questionCard = selectElement.closest('.question-card');
                    const optionsContainer = questionCard.querySelector('.options-container');
                    optionsContainer.innerHTML = '';

                    const sIndex = Array.from(sectionsContainer.querySelectorAll('.section-card')).indexOf(
                        questionCard.closest('.section-card'));
                    const qIndex = Array.from(questionCard.closest('.questions-container').querySelectorAll(
                        '.question-card')).indexOf(questionCard);

                    if (selectElement.value === 'multiple-choice') {
                        optionsContainer.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Options</h6>
                            <button type="button" class="btn btn-sm btn-secondary add-option-btn"><i class="ri-add-line me-1"></i>Add Option</button>
                        </div>
                        <div class="option-inputs"></div>
                    `;
                        const optionInputsContainer = optionsContainer.querySelector('.option-inputs');
                        optionInputsContainer.insertAdjacentHTML('beforeend', createOptionInput(sIndex,
                            qIndex));
                        reIndexForm();
                    }
                }
            });

            examinationForm.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                    alert('Please correct the errors in the form before submitting.');
                }
            });

            // Initial setup
            addSection();
        });
    </script>
@endpush
