<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1" />
    <title>Capture Handwritten Answer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
            /* Prevent body scroll */
        }

        #camera-container {
            flex-grow: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000;
            overflow: hidden;
        }

        #video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Cover the container */
            transform: scaleX(-1);
            /* Mirror for front camera */
        }

        #capture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,
                    0,
                    0,
                    0.5);
            /* Dim background when not active */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.2rem;
            z-index: 10;
        }

        #gui-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(17, 17, 17, 0.8);
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            z-index: 20;
        }

        .control-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .control-button:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        #takePhotoButton {
            width: 70px;
            height: 70px;
            font-size: 2rem;
            border: 3px solid #fff;
            background-color: #0d6efd;
            /* Primary blue for main action */
        }

        #takePhotoButton:hover {
            background-color: #0b5ed7;
        }

        #captured-images-preview {
            background-color: #ffffff;
            padding: 15px;
            border-top: 1px solid #e9ecef;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            max-height: 150px;
            /* Limit height for scrollability */
            overflow-y: auto;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .thumbnail-container {
            position: relative;
            width: 55px;
            height: 55px;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eee;
        }

        .thumbnail-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-container .remove-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background-color: rgba(220, 53, 69, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.8rem;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .action-buttons-bottom {
            background-color: #ffffff;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-around;
            gap: 10px;
            position: sticky;
            bottom: 0;
            z-index: 100;
        }

        .preview-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            z-index: 10;
            background: linear-gradient(to bottom,
                    rgba(255, 255, 255, 0.9),
                    rgba(255, 255, 255, 0));
        }

        .top-action-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s;
        }

        .top-action-button:hover {
            transform: scale(1.1);
        }

        #captured-images-preview {
            background-color: #ffffff;
            padding-top: 50px;
            border-top: 1px solid #e9ecef;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            max-height: 150px;
            overflow-y: auto;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .action-buttons-bottom {
            display: none;
        }

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-size: 1.2rem;
            display: none;
            /* Hidden by default */
        }

        #loading-overlay .spinner-border {
            margin-bottom: 15px;
        }

        @media screen and (orientation: landscape) {
            body {
                flex-direction: row;
            }

            #camera-container {
                width: 70%;
                /* Adjust as needed */
                height: 100vh;
            }

            #gui-controls {
                flex-direction: column;
                width: 100px;
                /* Adjust as needed */
                height: 100%;
                right: 0;
                left: auto;
                padding: 20px 0;
            }

            #captured-images-preview {
                width: 30%;
                /* Adjust as needed */
                height: 100vh;
                flex-direction: column;
                overflow-y: auto;
                border-left: 1px solid #e9ecef;
                border-top: none;
            }

            .action-buttons-bottom {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                flex-direction: row;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div id="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span>Processing image...</span>
    </div>

    <div id="camera-container">
        <video id="video" autoplay playsinline></video>
        <canvas id="photo-canvas" style="display: none"></canvas>
        <div id="capture-overlay">
            <span id="overlay-message">Loading camera...</span>
        </div>

        <div id="gui-controls">
            <button id="switchCameraButton" class="control-button" type="button" aria-pressed="false">
                <i class="ri-camera-switch-line"></i>
            </button>
            <button id="takePhotoButton" class="control-button" type="button">
                <i class="ri-camera-fill"></i>
            </button>
            <button id="flashButton" class="control-button" type="button" aria-pressed="false" style="display: none">
                <i class="ri-flashlight-fill"></i>
            </button>
            <button id="toggleFullScreenButton" class="control-button" type="button" aria-pressed="false"
                style="display: none">
                <i class="ri-fullscreen-line"></i>
            </button>
        </div>
    </div>

    <div id="captured-images-preview">
        <div class="preview-header">
            <button id="clearAllButton" class="top-action-button text-danger" type="button" title="Clear all">
                <i class="ri-delete-bin-line"></i>
            </button>
            <button id="sendToExamButton" class="top-action-button text-success" type="button" title="Send to exam">
                <i class="ri-check-line"></i>
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    const video = document.getElementById("video");
    const photoCanvas = document.getElementById("photo-canvas");
    const takePhotoButton = document.getElementById("takePhotoButton");
    const switchCameraButton = document.getElementById("switchCameraButton");
    const flashButton = document.getElementById("flashButton");
    const toggleFullScreenButton = document.getElementById(
        "toggleFullScreenButton"
    );
    const capturedImagesPreview = document.getElementById(
        "captured-images-preview"
    );
    const clearAllButton = document.getElementById("clearAllButton");
    const sendToExamButton = document.getElementById("sendToExamButton");
    const captureOverlay = document.getElementById("capture-overlay");
    const overlayMessage = document.getElementById("overlay-message");
    const loadingOverlay = document.getElementById("loading-overlay");

    let currentStream = null;
    let facingMode = "environment";
    let capturedImages = [];
    let images = [];
    let targetTextareaId = null;
    let track = null;

    const urlParams = new URLSearchParams(window.location.search);
    targetTextareaId = {{ $index }};

    function showLoading(message = "Processing image...") {
        loadingOverlay.querySelector("span").textContent = message;
        loadingOverlay.style.display = "flex";
    }

    function hideLoading() {
        loadingOverlay.style.display = "none";
    }

    async function startCamera(facing) {
        if (currentStream) {
            currentStream.getTracks().forEach((track) => track.stop());
        }
        overlayMessage.textContent = "Loading camera...";
        captureOverlay.style.display = "flex";
        flashButton.style.display = "none";

        const preferredFacingMode = facing || facingMode;

        const potentialConstraints = [{
            video: {
                facingMode: preferredFacingMode
            }
        }, {
            video: {
                facingMode: preferredFacingMode === "environment" ? "user" : "environment",
            },
        }, {
            video: true
        }, ];

        for (const constraints of potentialConstraints) {
            try {
                currentStream = await navigator.mediaDevices.getUserMedia(
                    constraints
                );
                video.srcObject = currentStream;
                await video.play();
                captureOverlay.style.display = "none";
                const videoTrack = currentStream.getVideoTracks()[0];
                const settings = videoTrack.getSettings();
                facingMode =
                    settings.facingMode || constraints.video.facingMode || "user";

                switchCameraButton.setAttribute(
                    "aria-pressed",
                    facingMode === "user" ? "true" : "false"
                );
                video.style.transform =
                    facingMode === "user" ? "scaleX(-1)" : "scaleX(1)";

                track = currentStream.getVideoTracks()[0];
                if (track && "torch" in track.getCapabilities()) {
                    flashButton.style.display = "flex";
                } else {
                    flashButton.style.display = "none";
                }
                return;
            } catch (err) {
                console.warn(
                    `Attempt with constraints ${JSON.stringify(constraints)} failed:`,
                    err
                );
            }
        }

        console.error("Error accessing camera: All attempts failed.");
        overlayMessage.textContent = "Camera access denied or not available.";
        swal({
            title: "Error",
            text: "Could not access camera. Please ensure camera permissions are granted and a camera is connected.",
            icon: "error",
        });
    }

    startCamera(facingMode);

    switchCameraButton.addEventListener("click", () => {
        facingMode = facingMode === "environment" ? "user" : "environment";
        startCamera(facingMode);
    });

    flashButton.addEventListener("click", async () => {
        if (track) {
            const isTorchOn = flashButton.getAttribute("aria-pressed") === "true";
            try {
                await track.applyConstraints({
                    advanced: [{
                        torch: !isTorchOn
                    }],
                });
                flashButton.setAttribute("aria-pressed", !isTorchOn);
            } catch (err) {
                console.error("Error toggling flashlight: ", err);
                swal({
                    title: "Error",
                    text: "Could not toggle flashlight.",
                    icon: "error",
                });
            }
        }
    });

    takePhotoButton.addEventListener("click", async () => {
        if (!currentStream) {
            swal({
                title: "Error",
                text: "Camera not active. Please allow camera access.",
                icon: "error",
            });
            return;
        }

        photoCanvas.width = video.videoWidth;
        photoCanvas.height = video.videoHeight;
        const context = photoCanvas.getContext("2d");

        if (facingMode === "user") {
            context.translate(photoCanvas.width, 0);
            context.scale(-1, 1);
        }
        context.drawImage(video, 0, 0, photoCanvas.width, photoCanvas.height);
        if (facingMode === "user") {
            context.setTransform(1, 0, 0, 1, 0, 0);
        }

        const imageDataUrl = photoCanvas.toDataURL("image/png");
        const base64Data = imageDataUrl.split(",")[1];
        images.push(imageDataUrl)

        // showLoading("Extracting text...");
        hideLoading()

        console.log(images)
        renderCapturedImages();

        const newImage = {
            base64: imageDataUrl,
        };

        capturedImages.push(newImage);

        renderCapturedImages();
        hideLoading();
    });

    function renderCapturedImages() {
        const imageContainer = document.createElement('div');
        imageContainer.id = 'image-thumbnails-container';
        capturedImagesPreview.querySelectorAll('.thumbnail-container').forEach(el => el.remove());

        capturedImages.forEach((imgData, index) => {
            const container = document.createElement("div");
            container.classList.add("thumbnail-container");
            container.dataset.index = index;

            const img = document.createElement("img");
            img.src = imgData.base64;
            img.alt = `Captured Image ${index + 1}`;

            const removeBtn = document.createElement("button");
            removeBtn.classList.add("remove-btn");
            removeBtn.innerHTML = '<i class="ri-close-line"></i>';
            removeBtn.addEventListener("click", () => removeCapturedImage(index));

            container.appendChild(img);
            container.appendChild(removeBtn);
            capturedImagesPreview.appendChild(container);
        });
    }

    function removeCapturedImage(indexToRemove) {
        capturedImages.splice(indexToRemove, 1);
        images.splice(indexToRemove, 1);
        renderCapturedImages();
    }

    clearAllButton.addEventListener("click", () => {
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to clear all captured images and extracted text?",
            icon: "warning",
            buttons: ["Cancel", "Yes, clear it!"],
            dangerMode: true,
        }).then((willClear) => {
            if (willClear) {
                capturedImages = [];
                images = [];
                renderCapturedImages();
                swal("Poof! Your captured images have been cleared!", {
                    icon: "success",
                });
            }
        });
    });

    sendToExamButton.addEventListener("click", () => {
        if (capturedImages.length === 0) {
            swal({
                title: "No Images",
                text: "Please capture at least one image before submitting.",
                icon: "warning",
            });
            return;
        }

        const base64Images = capturedImages.map(img => img.base64);

        showLoading("Sending images to server...");

        $.ajax({
            type: 'POST',
            url: "{{ route('candidate.ocr', ['index' => $index, 'id' => $id]) }}",
            data: {
                _token: "{{ csrf_token() }}",
                images: base64Images
            },
            success: function(response) {
                hideLoading();
                console.log(response);
                console.log(response.value)
                var index = JSON.parse(response.value).index
                var extractedText = JSON.parse(response.value).extracted_text

                swal({
                    title: "Success",
                    text: "Images submitted successfully!",
                    icon: "success",
                });

                var value = JSON.stringify([index, extractedText])

                sessionStorage.setItem('ocrquestion', value);

                window.location.href = "{{ route('candidate.exam.index', $id) }}";

            },
            error: function(xhr, status, error) {
                hideLoading();
                console.error("Error submitting images:", error);
                swal({
                    title: "Error",
                    text: "An error occurred while submitting images. Please try again.",
                    icon: "error",
                });
            }
        });
    });

    toggleFullScreenButton.addEventListener("click", () => {
        if (document.fullscreenElement) {
            document.exitFullscreen();
            toggleFullScreenButton.setAttribute("aria-pressed", "false");
        } else {
            document.documentElement.requestFullscreen();
            toggleFullScreenButton.setAttribute("aria-pressed", "true");
        }
    });

    navigator.mediaDevices.enumerateDevices().then((devices) => {
        const videoInputDevices = devices.filter(
            (device) => device.kind === "videoinput"
        );
        if (videoInputDevices.length > 1) {
            switchCameraButton.style.display = "flex";
        }
    });

    video.addEventListener("loadeddata", () => {
        captureOverlay.style.display = "none";
    });

    window.addEventListener("beforeunload", () => {
        if (currentStream) {
            currentStream.getTracks().forEach((track) => track.stop());
        }
    });
</script>
</body>

</html>
