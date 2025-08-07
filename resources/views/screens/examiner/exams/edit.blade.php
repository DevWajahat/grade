@extends('layouts.examiner.app')
@section('content')
    <style>
        /* Your CSS remains the same */
        :root {
            --primary: #009CFF;
            --secondary: #6610f2;
            --dark: #191C24;
            --light: #F3F6F9;
        }
        .form-label { font-weight: 600; }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background-color: #0d6efd; border-color: #0d6efd; }
        .btn-secondary { background-color: var(--secondary); border-color: var(--secondary); }
        .btn-secondary:hover { background-color: #5c0cdb; border-color: #5c0cdb; }
        .btn-danger { background-color: #dc3545; border-color: #dc3545; }
        .option-container .input-group-text { background-color: #ffffff; }
        .form-control.is-invalid, .form-select.is-invalid, .was-validated .form-control:invalid, .was-validated .form-select:invalid { border-color: #dc3545 !important; }
        .invalid-feedback { display: none; width: 100%; margin-top: 0.25rem; font-size: 0.875em; color: #dc3545; }
        .is-invalid~.invalid-feedback { display: block !important; }
        .form-control{ color:#000 !important; }
        .form-select{ color:#000 }
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="card p-4">
            <h5 class="mb-4">Edit Examination</h5>
            <form id="examinationForm" method="post" action="{{ route('examiner.exams.update', $exam->id) }}" data-exam-id="{{ $exam->id }}" novalidate>
                @csrf
                @method('PUT')
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="examHall" class="form-label">Examination Hall</label>
                        <select class="form-select" id="examHall" name="exam_hall" aria-label="Examination Hall">
                            <option value="">Select a Hall</option>
                            @forelse ($halls as $hall)
                                <option value="{{ $hall->id }}" {{ $hall->id == $exam->hall_id ? 'selected' : '' }}>{{ $hall->title }}</option>
                            @empty
                            @endforelse
                        </select>
                        <div class="invalid-feedback">Please select a hall.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="examTitle" class="form-label">Exam Title</label>
                        <input type="text" class="form-control" value="{{ $exam->title }}" id="examTitle" name="exam_title" placeholder="e.g., Midterm Exam - Q1 2025">
                        <div class="invalid-feedback">Please enter an exam title.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="examDuration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control" value="{{ $exam->duration_minutes }}" id="examDuration" name="exam_duration" placeholder="e.g., 90">
                        <div class="invalid-feedback">Please enter a valid duration.</div>
                    </div>
                </div>

                <div id="sectionsContainer">
                    {{-- Sections will be populated here by the AJAX call --}}
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="button" class="btn btn-success add-section-btn"><i class="ri-add-line me-1"></i>Add Section</button>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>Update Examination</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            const examinationForm = $('#examinationForm');
            const sectionsContainer = $('#sectionsContainer');
            const addSectionBtn = examinationForm.find('.add-section-btn');

            const createOptionInput = (sIndex, qIndex, oIndex, option = {}) => {
                const isCorrect = option.is_correct ? 'checked' : '';
                return `
                    <div class="input-group mb-2 option-item">
                        <span class="input-group-text">
                            <input class="form-check-input mt-0" type="radio" name="sections[${sIndex}][questions][${qIndex}][correct_option]" value="${oIndex}" ${isCorrect}>
                        </span>
                        <input type="text" class="form-control option-text-input" name="sections[${sIndex}][questions][${qIndex}][options][${oIndex}][text]" placeholder="Enter option text..." value="${option.option_text ?? ''}">
                        <button type="button" class="btn btn-outline-danger remove-option-btn"><i class="ri-close-line"></i></button>
                        <div class="invalid-feedback">Option text is required.</div>
                    </div>
                `;
            };

            const createQuestionCardHtml = (sIndex, qIndex, question = {}) => {
                const questionTypeHtml = `
                    <option value="">Select Type</option>
                    <option value="multiple-choice" ${question.type === 'multiple-choice' ? 'selected' : ''}>Multiple Choice</option>
                    <option value="short-answer" ${question.type === 'short-answer' ? 'selected' : ''}>Short Answer</option>
                    <option value="essay" ${question.type === 'essay' ? 'selected' : ''}>Essay</option>
                `;
                return `
                    <div class="question-card card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Question ${qIndex + 1}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-question-btn"><i class="ri-delete-bin-line"></i></button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Question Text</label>
                                <textarea class="form-control" name="sections[${sIndex}][questions][${qIndex}][text]" rows="3" placeholder="Enter the question here...">${question.question_text ?? ''}</textarea>
                                <div class="invalid-feedback">Question text is required.</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Question Type</label>
                                    <select class="form-select question-type-select" name="sections[${sIndex}][questions][${qIndex}][type]">
                                        ${questionTypeHtml}
                                    </select>
                                    <div class="invalid-feedback">Please select a question type.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Total Marks</label>
                                    <input type="number" class="form-control question-marks-input" name="sections[${sIndex}][questions][${qIndex}][marks]" placeholder="e.g., 10" value="${question.marks ?? ''}">
                                    <div class="invalid-feedback">Marks are required.</div>
                                </div>
                            </div>
                            <div class="options-container mt-3"></div>
                        </div>
                    </div>
                `;
            };

            const createSectionCardHtml = (sIndex, section = {}) => {
                const sectionTitleHtml = section.title ? `<input type="hidden" name="sections[${sIndex}][title]" value="${section.title}">` : '';
                return `
                    <div class="section-card card mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Section ${sIndex + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-section-btn"><i class="ri-delete-bin-line"></i></button>
                        </div>
                        <div class="card-body">
                            ${sectionTitleHtml}
                            <div class="questions-container"></div>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-sm btn-secondary add-question-btn"><i class="ri-add-line me-1"></i>Add Question</button>
                            </div>
                        </div>
                    </div>
                `;
            };

            const addOption = (questionCard, option = {}) => {
                const sIndex = questionCard.closest('.section-card').index();
                const qIndex = questionCard.index();
                const optionsContainer = questionCard.find('.options-container');
                let optionInputsContainer = optionsContainer.find('.option-inputs');

                if (optionInputsContainer.length === 0) {
                    optionsContainer.html(`
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Options</h6>
                            <button type="button" class="btn btn-sm btn-secondary add-option-btn"><i class="ri-add-line me-1"></i>Add Option</button>
                        </div>
                        <div class="option-inputs"></div>
                    `);
                    optionInputsContainer = optionsContainer.find('.option-inputs');
                }
                const oIndex = optionInputsContainer.find('.option-item').length;
                optionInputsContainer.append(createOptionInput(sIndex, qIndex, oIndex, option));
                reIndexForm();
            };


            const addQuestion = (sectionCard, question = {}) => {
                const sIndex = sectionCard.index();
                const questionsContainer = sectionCard.find('.questions-container');
                const qIndex = questionsContainer.find('.question-card').length;

                questionsContainer.append(createQuestionCardHtml(sIndex, qIndex, question));

                const newQuestionCard = questionsContainer.find('.question-card').last();

                if (question.type === 'multiple-choice') {
                    if (question.options && question.options.length > 0) {
                        $.each(question.options, (oIndex, option) => addOption(newQuestionCard, option));
                    } else {
                        addOption(newQuestionCard);
                    }
                }
                reIndexForm();
            };

            const addSection = (section = {}) => {
                const sIndex = sectionsContainer.find('.section-card').length;
                const newSectionCard = $(createSectionCardHtml(sIndex, section));
                sectionsContainer.append(newSectionCard);
                if (section.questions && section.questions.length > 0) {
                    $.each(section.questions, (qIndex, question) => addQuestion(newSectionCard, question));
                } else {
                    addQuestion(newSectionCard);
                }
                reIndexForm();
            };

            const populateMainExamDetails = (examData) => {
                $('#examHall').val(examData.exam_hall_id);
                $('#examTitle').val(examData.title);
                $('#examDuration').val(examData.duration_minutes);
            };

            const reIndexForm = () => {
                examinationForm.find('.section-card').each((sIndex, sectionCard) => {
                    const $sectionCard = $(sectionCard);
                    $sectionCard.find('.card-header h6').text(`Section ${sIndex + 1}`);
                    $sectionCard.find('.remove-section-btn').toggle(sectionsContainer.find('.section-card').length > 1);

                    $sectionCard.find('.question-card').each((qIndex, questionCard) => {
                        const $questionCard = $(questionCard);
                        $questionCard.find('.card-body .d-flex h6').text(`Question ${qIndex + 1}`);
                        $questionCard.find('.remove-question-btn').toggle($questionCard.closest('.questions-container').find('.question-card').length > 1);

                        $questionCard.find('textarea.form-control').attr('name', `sections[${sIndex}][questions][${qIndex}][text]`);
                        $questionCard.find('select.question-type-select').attr('name', `sections[${sIndex}][questions][${qIndex}][type]`);
                        $questionCard.find('input.question-marks-input').attr('name', `sections[${sIndex}][questions][${qIndex}][marks]`);

                        $questionCard.find('.option-item').each((oIndex, optionItem) => {
                            const $optionItem = $(optionItem);
                            $optionItem.find('input[type="radio"]').attr({
                                'name': `sections[${sIndex}][questions][${qIndex}][correct_option]`,
                                'value': oIndex
                            });
                            $optionItem.find('input[type="text"]').attr('name', `sections[${sIndex}][questions][${qIndex}][options][${oIndex}][text]`);
                            $optionItem.find('.remove-option-btn').toggle($optionItem.closest('.option-inputs').find('.option-item').length > 1);
                        });
                    });
                });
            };

            // ----------------------------------------------------------------------
            // Validation Logic
            // ----------------------------------------------------------------------

            const validateForm = () => {
                let isValid = true;
                $('.is-invalid').removeClass('is-invalid');

                // Validate main exam details
                const examHall = $('#examHall');
                const examTitle = $('#examTitle');
                const examDuration = $('#examDuration');

                if (!examHall.val()) {
                    examHall.addClass('is-invalid');
                    isValid = false;
                }
                if (!examTitle.val().trim()) {
                    examTitle.addClass('is-invalid');
                    isValid = false;
                }
                if (!examDuration.val() || isNaN(examDuration.val()) || parseInt(examDuration.val()) <= 0) {
                    examDuration.addClass('is-invalid');
                    isValid = false;
                }

                // Validate dynamic content
                sectionsContainer.find('.section-card').each(function() {
                    const sectionCard = $(this);

                    sectionCard.find('.question-card').each(function() {
                        const questionCard = $(this);
                        const questionTextarea = questionCard.find('textarea.form-control');
                        const questionTypeSelect = questionCard.find('select.question-type-select');
                        const questionMarksInput = questionCard.find('input.question-marks-input');

                        if (!questionTextarea.val().trim()) {
                            questionTextarea.addClass('is-invalid');
                            isValid = false;
                        }
                        if (!questionTypeSelect.val()) {
                            questionTypeSelect.addClass('is-invalid');
                            isValid = false;
                        }
                        if (!questionMarksInput.val() || isNaN(questionMarksInput.val()) || parseInt(questionMarksInput.val()) <= 0) {
                            questionMarksInput.addClass('is-invalid');
                            isValid = false;
                        }

                        // Validate options for multiple-choice questions
                        if (questionTypeSelect.val() === 'multiple-choice') {
                            const optionItems = questionCard.find('.option-item');

                            if (optionItems.length < 2) {
                                // You can add a custom alert or feedback for this if needed
                                isValid = false;
                            }

                            optionItems.each(function() {
                                const optionTextInput = $(this).find('.option-text-input');
                                if (!optionTextInput.val().trim()) {
                                    optionTextInput.addClass('is-invalid');
                                    isValid = false;
                                }
                            });
                        }
                    });
                });

                return isValid;
            };

            // Attach the validation function to the form's submit event
            examinationForm.on('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Stop the form from submitting
                    alert('Please fix the errors in the form.');
                    // Optionally scroll to the first invalid field
                    $('html, body').animate({
                        scrollTop: $('.is-invalid:first').offset().top - 100
                    }, 500);
                }
            });

            // ----------------------------------------------------------------------
            // Initial Form Population with AJAX
            // ----------------------------------------------------------------------
            const examId = examinationForm.data('exam-id');
            if (examId) {
                $.ajax({
                    url: `/examiner/exams/${examId}/data`,
                    method: 'GET',
                    success: function(examData) {
                        populateMainExamDetails(examData);
                        if (examData.sections && examData.sections.length > 0) {
                            $.each(examData.sections, (sIndex, section) => addSection(section));
                        } else {
                            addSection();
                        }
                    },
                    error: function(error) {
                        console.error('Failed to load exam data:', error);
                        alert('Failed to load examination data.');
                        addSection();
                    }
                });
            } else {
                addSection();
            }

        });
    </script>
@endpush
