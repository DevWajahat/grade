<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1" />
  <title>Capture Handwritten Answer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Inter Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Remixicon CDN for icons -->
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
      width: 80px;
      height: 80px;
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

    /* Landscape orientation styles */
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
    <!-- Captured images will be appended here -->
  </div>

  <div class="action-buttons-bottom">
    <button id="clearAllButton" class="btn btn-outline-danger">
      <i class="ri-delete-bin-line me-2"></i> Clear All
    </button>
    <button id="sendToExamButton" class="btn btn-primary">
      <i class="ri-send-plane-line me-2"></i> Send to Exam
    </button>
  </div>

  <!-- Bootstrap JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const video = document.getElementById("video");
    const photoCanvas = document.getElementById("photo-canvas");
    const takePhotoButton = document.getElementById("takePhotoButton");
    const switchCameraButton = document.getElementById("switchCameraButton");
    const flashButton = document.getElementById("flashButton"); // New flashlight button
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
    let facingMode = "environment"; // 'user' for front camera, 'environment' for rear
    let capturedImages = []; // Stores { base64: string, ocrText: string }
    let targetTextareaId = null; // To store the ID of the textarea to update in the parent window
    let track = null; // To store the video track for flashlight control

    // Get targetTextareaId from URL query parameter
    const urlParams = new URLSearchParams(window.location.search);
    targetTextareaId = urlParams.get("targetTextareaId");

    // Function to show/hide loading overlay
    function showLoading(message = "Processing image...") {
      loadingOverlay.querySelector("span").textContent = message;
      loadingOverlay.style.display = "flex";
    }

    function hideLoading() {
      loadingOverlay.style.display = "none";
    }

    // Function to start camera stream
    async function startCamera(facing) {
      if (currentStream) {
        currentStream.getTracks().forEach((track) => track.stop());
      }
      overlayMessage.textContent = "Loading camera...";
      captureOverlay.style.display = "flex";
      flashButton.style.display = "none"; // Hide flashlight button until capabilities are checked

      const preferredFacingMode = facing || facingMode; // Use passed facing or current facingMode

      const potentialConstraints = [
        { video: { facingMode: preferredFacingMode } }, // Try preferred mode first
        {
          video: {
            facingMode:
              preferredFacingMode === "environment" ? "user" : "environment",
          },
        }, // Then try the other mode
        { video: true }, // Finally, try any camera
      ];

      for (const constraints of potentialConstraints) {
        try {
          currentStream = await navigator.mediaDevices.getUserMedia(
            constraints
          );
          video.srcObject = currentStream;
          await video.play(); // Wait for video to start playing
          captureOverlay.style.display = "none";
          // Determine the actual facingMode that worked
          const videoTrack = currentStream.getVideoTracks()[0];
          const settings = videoTrack.getSettings();
          facingMode =
            settings.facingMode || constraints.video.facingMode || "user"; // Fallback if settings.facingMode is undefined

          switchCameraButton.setAttribute(
            "aria-pressed",
            facingMode === "user" ? "true" : "false"
          );
          video.style.transform =
            facingMode === "user" ? "scaleX(-1)" : "scaleX(1)"; // Mirror front camera

          // Check for torch capability
          track = currentStream.getVideoTracks()[0];
          if (track && "torch" in track.getCapabilities()) {
            flashButton.style.display = "flex"; // Show flashlight button
          } else {
            flashButton.style.display = "none"; // Hide if not supported
          }
          return; // Camera started successfully
        } catch (err) {
          console.warn(
            `Attempt with constraints ${JSON.stringify(constraints)} failed:`,
            err
          );
          // Continue to next set of constraints
        }
      }

      // If all attempts fail
      console.error("Error accessing camera: All attempts failed.");
      overlayMessage.textContent = "Camera access denied or not available.";
      alert(
        "Could not access camera. Please ensure camera permissions are granted and a camera is connected."
      );
    }

    // Initialize camera
    startCamera(facingMode);

    // Switch camera button functionality
    switchCameraButton.addEventListener("click", () => {
      facingMode = facingMode === "environment" ? "user" : "environment";
      startCamera(facingMode);
    });

    // Flashlight button functionality
    flashButton.addEventListener("click", async () => {
      if (track) {
        const isTorchOn = flashButton.getAttribute("aria-pressed") === "true";
        try {
          await track.applyConstraints({
            advanced: [{ torch: !isTorchOn }],
          });
          flashButton.setAttribute("aria-pressed", !isTorchOn);
        } catch (err) {
          console.error("Error toggling flashlight: ", err);
          alert("Could not toggle flashlight.");
        }
      }
    });

    // Take photo button functionality
    takePhotoButton.addEventListener("click", async () => {
      if (!currentStream) {
        alert("Camera not active. Please allow camera access.");
        return;
      }

      photoCanvas.width = video.videoWidth;
      photoCanvas.height = video.videoHeight;
      const context = photoCanvas.getContext("2d");

      // Draw the video frame onto the canvas, mirroring if front camera
      if (facingMode === "user") {
        context.translate(photoCanvas.width, 0);
        context.scale(-1, 1);
      }
      context.drawImage(video, 0, 0, photoCanvas.width, photoCanvas.height);
      if (facingMode === "user") {
        // Reset transformations for subsequent draws
        context.setTransform(1, 0, 0, 1, 0, 0);
      }

      const imageDataUrl = photoCanvas.toDataURL("image/png");
      const base64Data = imageDataUrl.split(",")[1]; // Get base64 part

      showLoading("Extracting text...");

      try {
        const prompt =
          "Extract all text from this image. Provide the text as a continuous string without formatting.";
        const payload = {
          contents: [
            {
              role: "user",
              parts: [
                { text: prompt },
                {
                  inlineData: {
                    mimeType: "image/png",
                    data: base64Data,
                  },
                },
              ],
            },
          ],
          generationConfig: {
            responseMimeType: "text/plain",
          },
        };

        const apiKey = ""; // Canvas will automatically provide this
        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

        const response = await fetch(apiUrl, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload),
        });

        const result = await response.json();
        let ocrText = "Could not extract text.";
        if (
          result.candidates &&
          result.candidates.length > 0 &&
          result.candidates[0].content &&
          result.candidates[0].content.parts &&
          result.candidates[0].content.parts.length > 0
        ) {
          ocrText = result.candidates[0].content.parts[0].text;
        } else {
          console.error("OCR API response structure unexpected:", result);
        }

        const newImage = { base64: imageDataUrl, ocrText: ocrText };
        capturedImages.push(newImage);
        renderCapturedImages();
      } catch (error) {
        console.error("Error during OCR:", error);
        alert(
          "Error processing image for text extraction. Please try again."
        );
        const newImage = {
          base64: imageDataUrl,
          ocrText: "Error: Could not extract text.",
        };
        capturedImages.push(newImage);
        renderCapturedImages();
      } finally {
        hideLoading();
      }
    });

    // Render captured images in the preview area
    function renderCapturedImages() {
      capturedImagesPreview.innerHTML = "";
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

    // Remove a captured image
    function removeCapturedImage(indexToRemove) {
      capturedImages.splice(indexToRemove, 1);
      renderCapturedImages();
    }

    // Clear all captured images
    clearAllButton.addEventListener("click", () => {
      if (
        confirm(
          "Are you sure you want to clear all captured images and extracted text?"
        )
      ) {
        capturedImages = [];
        renderCapturedImages();
      }
    });

    // Send all extracted text to the parent window
    sendToExamButton.addEventListener("click", () => {
      if (!targetTextareaId) {
        alert("Error: Target textarea not identified. Cannot send text.");
        return;
      }

      const combinedText = capturedImages
        .map((img) => img.ocrText)
        .join("\n\n");

      if (window.opener) {
        window.opener.postMessage(
          {
            type: "ocrResult",
            targetId: targetTextareaId,
            text: combinedText,
          },
          "*"
        ); // '*' for any origin, consider specifying origin in production
        window.close(); // Close the camera window
      } else {
        alert("Could not send text: Parent window not found.");
      }
    });

    // Fullscreen functionality (optional, might not work in all iframe contexts)
    toggleFullScreenButton.addEventListener("click", () => {
      if (document.fullscreenElement) {
        document.exitFullscreen();
        toggleFullScreenButton.setAttribute("aria-pressed", "false");
      } else {
        document.documentElement.requestFullscreen();
        toggleFullScreenButton.setAttribute("aria-pressed", "true");
      }
    });

    // Check for multiple cameras and torch capability on device change
    navigator.mediaDevices.enumerateDevices().then((devices) => {
      const videoInputDevices = devices.filter(
        (device) => device.kind === "videoinput"
      );
      if (videoInputDevices.length > 1) {
        switchCameraButton.style.display = "flex"; // Show switch camera button
      }
    });

    // Hide overlay once video loads
    video.addEventListener("loadeddata", () => {
      captureOverlay.style.display = "none";
    });

    // Handle window closing
    window.addEventListener("beforeunload", () => {
      if (currentStream) {
        currentStream.getTracks().forEach((track) => track.stop());
      }
    });
  </script>
</body>

</html>