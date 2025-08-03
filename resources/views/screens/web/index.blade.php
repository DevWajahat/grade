@extends('layouts.web.app')
@section('content')
      <!-- ========================= hero-4 start ========================= -->
      <div class="hero-section hero-style-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero-content-wrapper">
                <h2 class="mb-30">AI Powered Exam Grading</h2>
                <p class="mb-30">
                  Revolutionize your examination experience with intelligent
                  grading, instant feedback, and comprehensive performance
                  analysis
                </p>
                <a href="#0" class="button button-lg radius-50"
                  >Get Start
                  <i class="ri-arrow-right-s-line" style="font-size: 34px"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-6 align-self-end">
              <div class="hero-image">
                <img
                  src="{{ asset("assets/web/images/hero-images/hero.png") }}"
                  alt=""
                  style="width: 100%; height: 100%"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="shapes">
          <img
            src="{{ asset("assets/web/images/hero-images/shape-1.svg") }}"
            alt=""
            class="shape shape-1"
          />
          <img
            src="{{ asset("assets/web/images/hero-images/shape-2.svg") }}"
            alt=""
            class="shape shape-2"
          />
          <img
            src="{{ asset("assets/web/images/hero-images/shape-3.svg") }}"
            alt=""
            class="shape shape-3"
          />
        </div>
      </div>
      <!-- ========================= hero-4 end ========================= -->
    </section>
    <!-- ========================= hero-section-wrapper-4 end =========================== -->

    <!-- ========================= feature style-2 start ========================= -->
    <section id="feature" class="feature-section feature-style-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-xl-7 col-lg-10 col-md-9">
                <div class="section-title mb-60">
                  <h3 class="mb-15">The future of designing starts here</h3>
                  <p>
                    Stop wasting time and money designing and managing a website
                    that doesn’t get results. Happiness guaranteed!
                  </p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="single-feature">
                  <div class="icon">
                    <svg
                      width="80"
                      height="80"
                      viewBox="0 0 25 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      transform="rotate(0 0 0)"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M22.0234 11.183C22.0234 9.83305 21.4073 8.62719 20.4434 7.83114V7.80859C20.4434 5.84696 18.9372 4.23712 17.0182 4.07247C16.525 3.0707 15.4944 2.38086 14.3013 2.38086C13.3924 2.38086 12.5771 2.78142 12.0223 3.41562C11.4675 2.78294 10.6532 2.3835 9.74562 2.3835C8.55266 2.3835 7.52219 3.07315 7.02888 4.07469C5.10981 4.23925 3.60352 5.84913 3.60352 7.81083V7.83236C2.6396 8.62841 2.02344 9.83427 2.02344 11.1842C2.02344 12.5342 2.6396 13.7401 3.60352 14.5361V15.3749C3.60352 17.2431 4.96968 18.7923 6.75748 19.0778C6.98981 20.5187 8.2392 21.6191 9.74562 21.6191C10.6545 21.6191 11.4698 21.2186 12.0246 20.5844C12.5794 21.2171 13.3937 21.6165 14.3013 21.6165C15.8075 21.6165 17.0568 20.5163 17.2893 19.0756C19.0772 18.7901 20.4434 17.2409 20.4434 15.3727V14.5349C21.4073 13.7388 22.0234 12.533 22.0234 11.183ZM19.2725 8.82605C20.0289 9.33894 20.5234 10.2033 20.5234 11.183C20.5234 12.1627 20.0289 13.0271 19.2725 13.54C19.0666 13.6795 18.9434 13.9121 18.9434 14.1607V15.3727C18.9434 16.6153 17.936 17.6227 16.6934 17.6227H16.5781C16.3792 17.6227 16.1884 17.7017 16.0478 17.8423C15.9071 17.983 15.8281 18.1738 15.8281 18.3727V18.5896C15.8281 19.4329 15.1445 20.1165 14.3013 20.1165C13.458 20.1165 12.7744 19.4329 12.7744 18.5896V5.40773C12.7744 4.56446 13.458 3.88086 14.3013 3.88086C15.0044 3.88086 15.5983 4.35683 15.7748 5.00547C15.8636 5.33199 16.1601 5.55859 16.4985 5.55859H16.6934C17.936 5.55859 18.9434 6.56595 18.9434 7.80859V8.20528C18.9434 8.45397 19.0666 8.68649 19.2725 8.82605ZM4.7744 13.5412C4.01794 13.0283 3.52344 12.1639 3.52344 11.1842C3.52344 10.2046 4.01794 9.34016 4.7744 8.82727C4.98024 8.68771 5.10352 8.45519 5.10352 8.2065L5.10352 7.81083C5.10352 6.56819 6.11087 5.56083 7.35352 5.56083H7.54851C7.88685 5.56083 8.1833 5.3343 8.27217 5.00784C8.44872 4.35933 9.04256 3.8835 9.74562 3.8835C10.5889 3.8835 11.2725 4.5671 11.2725 5.41037V18.5923C11.2725 19.4355 10.5889 20.1191 9.74562 20.1191C8.90235 20.1191 8.21875 19.4355 8.21875 18.5923V18.3749C8.21875 17.9607 7.88296 17.6249 7.46875 17.6249H7.35352C6.11088 17.6249 5.10352 16.6175 5.10352 15.3749L5.10352 14.162C5.10352 13.9133 4.98024 13.6808 4.7744 13.5412Z"
                        fill="#fff"
                      ></path>
                    </svg>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">AI-Powered Grading</h5>
                    <p>
                      Advanced AI algorithms provide instant, accurate grading
                      with detailed feedback and performance insights.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature">
                  <div class="icon">
                    <svg
                      width="80"
                      height="80"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      transform="rotate(0 0 0)"
                    >
                      <path
                        d="M11.2499 6.5V11.7995L9.35063 15.0891C9.14353 15.4478 9.26643 15.9065 9.62515 16.1136C9.98387 16.3207 10.4426 16.1978 10.6497 15.8391L12.6497 12.375C12.7222 12.2493 12.7543 12.1114 12.7499 11.9763V6.5C12.7499 6.08579 12.4141 5.75 11.9999 5.75C11.5857 5.75 11.2499 6.08579 11.2499 6.5Z"
                        fill="#fff"
                      ></path>
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM3.5 12C3.5 7.30558 7.30558 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C7.30558 20.5 3.5 16.6944 3.5 12Z"
                        fill="#fff"
                      ></path>
                    </svg>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Real Time Results</h5>
                    <p>
                      Get instant feedback and results as soon as you complete
                      each section of your exam.
                    </p>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature">
                  <div class="icon">
                    <svg
                      width="80"
                      height="80"
                      viewBox="0 0 25 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      transform="rotate(0 0 0)"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.77185 7.75195C8.77185 5.95595 10.2278 4.5 12.0238 4.5C13.8198 4.5 15.2758 5.95595 15.2758 7.75195C15.2758 9.54796 13.8198 11.0039 12.0238 11.0039C10.2278 11.0039 8.77185 9.54796 8.77185 7.75195ZM12.0238 6C11.0562 6 10.2719 6.78438 10.2719 7.75195C10.2719 8.71953 11.0562 9.50391 12.0238 9.50391C12.9914 9.50391 13.7758 8.71953 13.7758 7.75195C13.7758 6.78438 12.9914 6 12.0238 6Z"
                        fill="#fff"
                      ></path>
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M6.18604 17.3393C6.18604 14.589 8.41563 12.3594 11.166 12.3594H12.8817C15.632 12.3594 17.8616 14.589 17.8616 17.3393C17.8616 18.5322 16.8945 19.4993 15.7016 19.4993H8.34601C7.15309 19.4993 6.18604 18.5322 6.18604 17.3393ZM11.166 13.8594C9.24406 13.8594 7.68604 15.4174 7.68604 17.3393C7.68604 17.7038 7.98152 17.9993 8.34601 17.9993H15.7016C16.0661 17.9993 16.3616 17.7038 16.3616 17.3393C16.3616 15.4174 14.8036 13.8594 12.8817 13.8594H11.166Z"
                        fill="#fff"
                      ></path>
                      <path
                        d="M7.35462 6.86169C7.29996 7.15007 7.27136 7.44767 7.27136 7.75195C7.27136 8.02945 7.29515 8.30139 7.34079 8.56584C7.15955 8.37151 6.90124 8.25 6.61454 8.25C6.06619 8.25 5.62166 8.69453 5.62166 9.24289C5.62166 9.79124 6.06619 10.2358 6.61454 10.2358C7.09065 10.2358 7.48848 9.90066 7.58506 9.45345C7.79173 9.9922 8.09367 10.4838 8.47026 10.9075C8.01388 11.4159 7.35156 11.7358 6.61454 11.7358C5.23776 11.7358 4.12166 10.6197 4.12166 9.24289C4.12166 7.8661 5.23776 6.75 6.61454 6.75C6.87224 6.75 7.1208 6.7891 7.35462 6.86169Z"
                        fill="#fff"
                      ></path>
                      <path
                        d="M15.5804 10.9029C16.0361 11.4098 16.6969 11.7285 17.4321 11.7285C18.8069 11.7285 19.9214 10.614 19.9214 9.23926C19.9214 7.86448 18.8069 6.75 17.4321 6.75C17.1744 6.75 16.9258 6.78916 16.692 6.86187C16.7467 7.15019 16.7753 7.44773 16.7753 7.75195C16.7753 8.0302 16.7514 8.30287 16.7055 8.568C16.8862 8.37245 17.1449 8.25 17.4321 8.25C17.9785 8.25 18.4214 8.69291 18.4214 9.23926C18.4214 9.78561 17.9785 10.2285 17.4321 10.2285C16.9566 10.2285 16.5595 9.89303 16.4645 9.44585C16.2585 9.98564 15.9569 10.4782 15.5804 10.9029Z"
                        fill="#fff"
                      ></path>
                      <path
                        d="M2.02344 16.2327C2.02344 14.1313 3.72698 12.4277 5.8284 12.4277H6.9385C6.43644 12.8602 6.00141 13.3683 5.65113 13.9345C4.46096 14.025 3.52344 15.0194 3.52344 16.2327C3.52344 16.3809 3.64357 16.501 3.79176 16.501H4.73927C4.70383 16.7754 4.68555 17.0552 4.68555 17.3393C4.68555 17.5652 4.70602 17.7864 4.74521 18.001H3.79176C2.81514 18.001 2.02344 17.2093 2.02344 16.2327Z"
                        fill="#fff"
                      ></path>
                      <path
                        d="M20.2549 18.001H19.3014C19.3406 17.7864 19.3611 17.5652 19.3611 17.3393C19.3611 17.0552 19.3428 16.7754 19.3074 16.501H20.2549C20.4031 16.501 20.5232 16.3809 20.5232 16.2327C20.5232 15.0194 19.5857 14.025 18.3955 13.9345C18.0452 13.3683 17.6102 12.8602 17.1082 12.4277H18.2182C20.3197 12.4277 22.0232 14.1313 22.0232 16.2327C22.0232 17.2093 21.2315 18.001 20.2549 18.001Z"
                        fill="#fff"
                      ></path>
                    </svg>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">User-Friendly</h5>
                    <p>
                      Intuitive design that reduces cognitive load and maximizes
                      focus during examinations.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature">
                  <div class="icon">
                    <svg
                      width="80"
                      height="80"
                      viewBox="0 0 24 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      transform="rotate(0 0 0)"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M11.9996 2.125C12.2851 2.125 12.5459 2.28707 12.6722 2.54308L15.3264 7.9211L21.2614 8.78351C21.5439 8.82456 21.7786 9.02244 21.8669 9.29395C21.9551 9.56546 21.8815 9.86351 21.6771 10.0628L17.3825 14.249L18.3963 20.16C18.4445 20.4414 18.3289 20.7257 18.0979 20.8936C17.867 21.0614 17.5608 21.0835 17.3081 20.9506L11.9996 18.1598L6.69122 20.9506C6.43853 21.0835 6.13233 21.0614 5.90137 20.8936C5.67041 20.7257 5.55475 20.4414 5.603 20.16L6.61682 14.249L2.32222 10.0628C2.11779 9.86351 2.04421 9.56546 2.13243 9.29395C2.22065 9.02244 2.45536 8.82456 2.73788 8.78351L8.67288 7.9211L11.3271 2.54308C11.4534 2.28707 11.7142 2.125 11.9996 2.125ZM11.9996 4.56966L9.84348 8.93853C9.73423 9.15989 9.52306 9.31331 9.27878 9.34881L4.45745 10.0494L7.94619 13.4501C8.12296 13.6224 8.20362 13.8706 8.16189 14.1139L7.33831 18.9158L11.6506 16.6487C11.8691 16.5338 12.1302 16.5338 12.3486 16.6487L16.661 18.9158L15.8374 14.1139C15.7957 13.8706 15.8763 13.6224 16.0531 13.4501L19.5418 10.0494L14.7205 9.34881C14.4762 9.31331 14.2651 9.15989 14.1558 8.93853L11.9996 4.56966Z"
                        fill="#fff"
                      ></path>
                    </svg>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Web Development</h5>
                    <p>
                      Comprehensive analysis with detailed insights into your
                      strengths and areas for improvement.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="feature-img">
        <img src="{{ asset("assets/web/images/features/features.png") }}" alt="" />
      </div>
    </section>
    <!-- ========================= feature style-2 end ========================= -->

    <!-- ========================= faqs section start ========================== -->
    <section class="faqs-section">
      <div class="container d-flex justify-content-center align-items-center">
        <h4 class="mb-15">
          Got questions? We've got <span class="text-success">answers!</span>
        </h4>
      </div>
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseOne"
              aria-expanded="false"
              aria-controls="flush-collapseOne"
            >
              <p class="font-weight-medium">
                How does the AI exam portal ensure real-time integrity and
                security during online exams conducted on our LMS?
              </p>
            </button>
          </h2>
          <div
            id="flush-collapseOne"
            class="accordion-collapse collapse"
            data-bs-parent="#accordionFlushExample"
          >
            <div class="accordion-body">
              <p class="font-weight-regular">
                Our AI exam portal leverages advanced machine learning
                algorithms and real-time monitoring to ensure the highest level
                of integrity. This includes continuous identity verification
                through facial recognition, detection of suspicious activities
                like unusual eye movements, presence of unauthorized individuals
                or objects, and abnormal sounds. The system actively flags any
                potential misconduct and can alert human proctors for immediate
                intervention, all while seamlessly integrating with your
                existing LMS.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseTwo"
              aria-expanded="false"
              aria-controls="flush-collapseTwo"
            >
              <p class="font-weight-medium">
                What happens if a candidate experiences technical issues (e.g.,
                internet disconnection) during a real-time AI-proctored exam?
              </p>
            </button>
          </h2>
          <div
            id="flush-collapseTwo"
            class="accordion-collapse collapse"
            data-bs-parent="#accordionFlushExample"
          >
            <div class="accordion-body">
              Our system is designed with robust fail-safe mechanisms. In case
              of an internet disconnection or other technical glitch, the exam
              clock can be paused, and the candidate's session details are
              securely saved. Upon reconnection, the candidate can resume the
              exam from where they left off, with the system maintaining full
              proctoring oversight. Our real-time support team is also available
              to assist candidates in resolving such issues promptly, minimizing
              disruption and ensuring fairness.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseThree"
              aria-expanded="false"
              aria-controls="flush-collapseThree"
            >
              <p class="font-weight-medium">
                What measures are in place to protect candidate privacy and data
                security during real-time proctoring?
              </p>
            </button>
          </h2>
          <div
            id="flush-collapseThree"
            class="accordion-collapse collapse"
            data-bs-parent="#accordionFlushExample"
          >
            <div class="accordion-body">
              <p class="font-weight-regular">
                We prioritize candidate privacy and data security. All data,
                including video and audio feeds, is encrypted and securely
                transmitted. The AI system focuses on behavioral analysis for
                proctoring purposes and does not store sensitive personal data
                unnecessarily. We adhere to stringent data protection
                regulations (e.g., GDPR, FERPA, ISO certifications) to ensure
                that all information is handled with the utmost confidentiality
                and is used solely for the purpose of maintaining exam
                integrity.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======================== faqs section end ============================ -->

    <!-- ======================== CTA section starts ========================== -->

    <section class="cta-section container-fluid ">
      <div class="row">
        <div
          class="col-12 d-flex flex-column justify-content-center align-items-center text-center"
        >
          <h3 class=" mb-20">
            Ready to Transform Your Exam Experience?
          </h3>
          <p class="font-weight-regular  mb-20">
            Join thousands of candidates and examiners who trust Grade Genius
            for their Examination needs.
          </p>
          <button class="btn btn-primary body-font-size">
            Join Now <i class="ri-arrow-right-line"></i>
          </button>
        </div>
      </div>
    </section>

    <!-- ======================== CTA section ends ========================== -->

@endsection
