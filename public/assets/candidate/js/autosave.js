document.addEventListener("DOMContentLoaded", () => {
    const SAVING_MESSAGE = "Saving...";
    const SAVED_MESSAGE = "All changes saved";
    const statusElement = document.getElementById("autosave-status");

    const saveStateToSession = (time, sectionIndex) => {
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

        sessionStorage.setItem("examState", JSON.stringify({
            formData: formObject,
            timeRemaining: time,
            currentSectionIndex: sectionIndex
        }));

        if (statusElement) {
            statusElement.textContent = SAVED_MESSAGE;
            setTimeout(() => statusElement.textContent = "", 2000);
        }
    };

    const loadStateFromSession = () => {
        const savedState = sessionStorage.getItem("examState");
        if (savedState) {
            try {
                const state = JSON.parse(savedState);
                // Load form data
                document.querySelectorAll("input, textarea").forEach(field => {
                    const name = field.getAttribute("data-question");
                    if (state.formData[name] !== undefined) {
                        if (field.type === "radio") {
                            if (field.value === state.formData[name]) {
                                field.checked = true;
                            }
                        } else {
                            field.value = state.formData[name];
                        }
                    }
                });
                return state;
            } catch (e) {
                console.error("Could not parse saved data:", e);
                return null;
            }
        }
        return null;
    };

    const handleInput = () => {
        if (statusElement) statusElement.textContent = SAVING_MESSAGE;
        saveStateToSession(window.timeRemaining, window.currentSectionIndex);
    };

    loadStateFromSession();
    document.querySelector("form").addEventListener("input", handleInput);

    window.saveStateBeforeRedirect = saveStateToSession;
});
