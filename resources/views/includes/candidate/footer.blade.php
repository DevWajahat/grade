<!-- ========================= JS here ========================= -->
<script src="{{ asset('assets/candidate/js/bootstrap.5.0.0.alpha-2-min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/candidate/js/count-up.min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/imagesloaded.min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/candidate/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
</script>


<script>
    // ============= video popup
    GLightbox({
        href: "assets/video/video.mp4",
        type: "video",
        source: "local", //vimeo, youtube or local
        width: 900,
        autoplayVideos: true,
    });

    // header-2  toggler-icon
    let navbarToggler2 = document.querySelector(".header-2 .navbar-toggler");
    var navbarCollapse2 = document.querySelector(
        ".header-2 .navbar-collapse"
    );

    document.querySelectorAll(".header-2 .page-scroll").forEach((e) =>
        e.addEventListener("click", () => {
            navbarToggler2.classList.remove("active");
            navbarCollapse2.classList.remove("show");
        })
    );
    navbarToggler2.addEventListener("click", function() {
        navbarToggler2.classList.toggle("active");
    });

    // header-4  toggler-icon
    let navbarToggler4 = document.querySelector(".header-4 .navbar-toggler");
    var navbarCollapse4 = document.querySelector(
        ".header-4 .navbar-collapse"
    );

    document.querySelectorAll(".header-4 .page-scroll").forEach((e) =>
        e.addEventListener("click", () => {
            navbarToggler4.classList.remove("active");
            navbarCollapse4.classList.remove("show");
        })
    );
    navbarToggler4.addEventListener("click", function() {
        navbarToggler4.classList.toggle("active");
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openPopupBtn = document.getElementById('openPopupBtn');
        const closePopupBtn = document.getElementById('closePopupBtn');
        const customPopupWindow = document.getElementById('customPopupWindow');

        openPopupBtn.addEventListener('click', function() {
            customPopupWindow.style.display = 'flex'; // Use 'flex' for column layout
        });

        closePopupBtn.addEventListener('click', function() {
            customPopupWindow.style.display = 'none';
        });

        // Optional: Close popup when clicking outside of it
        document.addEventListener('click', function(event) {
            if (!customPopupWindow.contains(event.target) && !openPopupBtn.contains(event.target) &&
                customPopupWindow.style.display === 'flex') {
                customPopupWindow.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gradientClasses = [
            'gradient-0',
            'gradient-1',
            'gradient-2',
            'gradient-3',
            'gradient-4',
            'gradient-5',
            'gradient-6'
        ];

        const cardHeaders = document.querySelectorAll('.card-header-custom');

        cardHeaders.forEach(header => {
            const index = parseInt(header.dataset.gradientIndex, 10);
            if (!isNaN(index) && index >= 0 && index < gradientClasses.length) {
                header.classList.add(gradientClasses[index]);
            } else {
                // Fallback for invalid or missing index, e.g., apply a default gradient or the 'no exam' gradient
                header.classList.add('gradient-6'); // Default to gray for safety
            }
        });
    });
</script>
</body>

</html>
