document.addEventListener("DOMContentLoaded", () => {
    const SAVING_MESSAGE = "Saving...";
    const SAVED_MESSAGE = "All changes saved";
    const statusElement = document.getElementById("autosave-status");

    // Function to load saved data from sessionStorage
    const loadFormData = () => {
        const savedData = sessionStorage.getItem("formData");
        if (savedData) {
            try {
                const formData = JSON.parse(savedData);
                document.querySelectorAll("input, textarea").forEach(field => {
                    const name = field.getAttribute("data-question");
                    if (formData[name] !== undefined) {
                        if (field.type === "radio") {
                            console.log(field.value,formData[name]);

                            if (field.value === formData[name]) {
                                field.checked = true;
                            }
                        } else if (field.type === "checkbox") {
                            field.checked = formData[name];
                        } else {
                            field.value = formData[name];
                        }
                    }
                });
                if (statusElement) {
                    statusElement.textContent = SAVED_MESSAGE;
                }
            } catch (e) {
                console.error("Could not parse saved data:", e);
            }
        }
    };

    // Function to save all form data to sessionStorage
    const saveFormData = () => {
        if (statusElement) {
            statusElement.textContent = SAVING_MESSAGE;
        }

        const formObject = {};
        document.querySelectorAll("input, textarea").forEach(field => {
            const name = field.getAttribute("data-question");
            if (name) {
                if (field.type === "radio") {
                    if (field.checked) {
                        formObject[name] = field.value;
                    }
                } else if (field.type === "checkbox") {
                    formObject[name] = field.checked;
                } else {
                    formObject[name] = field.value;
                }
            }
        });

        sessionStorage.setItem("formData", JSON.stringify(formObject));

        if (statusElement) {
            setTimeout(() => {
                statusElement.textContent = SAVED_MESSAGE;
            }, 1000);
        }
    };

    // Load data on page load
    loadFormData();

    // Attach a single input event listener to the container to handle all inputs
    document.querySelector(".container").addEventListener("input", (e) => {
        if (e.target.matches("input, textarea")) {
            saveFormData();
        }
    });
});
