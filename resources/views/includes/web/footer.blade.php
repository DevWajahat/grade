 <!-- ======================== footer section starts ===================== -->

 <footer class="footer footer-style-4 ">
     <div class="container">
         <div class="widget-wrapper">
             <div class="row">
                 <div class="col-xl-3 col-lg-4 col-md-6">
                     <div class="footer-widget">
                         <div class="logo">
                             <a href="#0">
                                 <img src="assets/img/logo/logo.svg" alt="" />
                             </a>
                         </div>
                         <p class="desc">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                             Facilisis nulla placerat amet amet congue.
                         </p>
                         <ul class="socials">
                             <li>
                                 <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                             </li>
                             <li>
                                 <a href="#0"> <i class="lni lni-twitter-filled"></i> </a>
                             </li>
                             <li>
                                 <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                             </li>
                             <li>
                                 <a href="#0"> <i class="lni lni-linkedin-original"></i> </a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6 col-sm-6">
                     <div class="footer-widget">
                         <h6>Quick Link</h6>
                         <ul class="links">
                             <li><a href="#0">Home</a></li>
                             <li><a href="#0">About</a></li>
                             <li><a href="#0">Service</a></li>
                             <li><a href="#0">Testimonial</a></li>
                             <li><a href="#0">Contact</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="footer-widget">
                         <h6>Services</h6>
                         <ul class="links">
                             <li><a href="#0">Web Design</a></li>
                             <li><a href="#0">Web Development</a></li>
                             <li><a href="#0">Seo Optimization</a></li>
                             <li><a href="#0">Blog Writing</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-3 col-md-6">
                     <div class="footer-widget">
                         <h6>Download App</h6>
                         <ul class="download-app">
                             <li>
                                 <a href="#0">
                                     <span class="icon"><i class="lni lni-apple"></i></span>
                                     <span class="text">Download on the <b>App Store</b>
                                     </span>
                                 </a>
                             </li>
                             <li>
                                 <a href="#0">
                                     <span class="icon"><i class="lni lni-play-store"></i></span>
                                     <span class="text">GET IT ON <b>Play Store</b> </span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="copyright-wrapper">
             <p>
                 Design and Developed by
                 <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a>
             </p>
         </div>
     </div>
 </footer>

 <!-- ======================== footer section ends ======================= -->

 <!-- ========================= JS here ========================= -->
 <script src="{{ asset('assets/web/js/bootstrap.5.0.0.alpha-2-min.js') }}"></script>
 <script src="{{ asset('assets/web/js/tiny-slider.js') }}"></script>
 <script src="{{ asset('assets/web/js/count-up.min.js') }}"></script>
 <script src="{{ asset('assets/web/js/imagesloaded.min.js') }}"></script>
 <script src="{{ asset('assets/web/js/isotope.min.js') }}"></script>
 <script src="{{ asset('assets/web/js/glightbox.min.js') }}"></script>
 <script src="{{ asset('assets/web/js/wow.min.js') }}"></script>
 <script src="{{ asset('assets/web/js/main.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
 </script>
 @stack('scripts')

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
 </body>

 </html>
