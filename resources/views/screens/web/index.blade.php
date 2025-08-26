@extends('layouts.web.app')
@section('content')
     <!-- Hero Section -->
    <section id="home" class="hero-section pt-5">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">AI Precision. Human Understanding. <span class="text-primary">Better Grades, Faster.</span></h1>
                        <p class="hero-subtitle">Grade Genius empowers educators with instant, reliable exam grading — saving time, reducing errors, and improving student feedback.</p>

                        <div class="hero-stats mb-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">98%</h3>
                                        <p class="stat-label">Accuracy</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">10x</h3>
                                        <p class="stat-label">Faster</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">500+</h3>
                                        <p class="stat-label">Schools</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hero-buttons">
                            <button class="btn btn-primary btn-lg me-3">Start Grading Smarter</button>
                            <button class="btn btn-outline-primary btn-lg">Book a Demo</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="grading-mockup">
                            <div class="mockup-header">
                                <div class="mockup-dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h6>Grade Genius Dashboard</h6>
                            </div>
                            <div class="mockup-content">
                                <div class="grading-progress">
                                    <div class="progress-header">
                                        <span>Grading in Progress...</span>
                                        <span class="progress-percent">87%</span>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar" style="width: 87%"></div>
                                    </div>
                                </div>
                                <div class="exam-preview">
                                    <div class="question-item">
                                        <span class="question-number">Q1</span>
                                        <span class="question-status correct">✓</span>
                                        <span class="question-score">5/5</span>
                                    </div>
                                    <div class="question-item">
                                        <span class="question-number">Q2</span>
                                        <span class="question-status correct">✓</span>
                                        <span class="question-score">3/3</span>
                                    </div>
                                    <div class="question-item">
                                        <span class="question-number">Q3</span>
                                        <span class="question-status partial">~</span>
                                        <span class="question-score">2/4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">About Grade Genius</h2>
                    <p class="section-subtitle">We combine advanced AI with educational expertise to make grading effortless and insightful.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h3>Revolutionizing Education Assessment</h3>
                        <p>Grade Genius was born from the understanding that educators spend countless hours on repetitive grading tasks, taking time away from what matters most - teaching and mentoring students.</p>
                        <p>Our AI-powered platform doesn't just grade exams; it provides intelligent insights that help educators understand student performance patterns and improve learning outcomes.</p>

                        <div class="about-features">
                            <div class="feature-item">
                                <i class="fas fa-brain text-primary"></i>
                                <div>
                                    <h5>&nbsp; AI-Powered Intelligence</h5>
                                    <p>&nbsp; Advanced machine learning algorithms ensure accurate and consistent grading.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shield-alt text-primary"></i>
                                <div>
                                    <h5>&nbsp; Secure & Reliable</h5>
                                    <p>&nbsp; Enterprise-grade security with 99.9% uptime guarantee.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-pencil-alt "></i>
                            </div>
                            <div class="timeline-content">
                                <h5>&nbsp; Traditional Grading</h5>
                                <p>&nbsp; Hours of manual work, prone to inconsistencies</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-robot"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>&nbsp; AI-Powered Grading</h5>
                                <p>&nbsp; Instant, accurate, and insightful assessment</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>&nbsp; Smart Analytics</h5>
                                <p>&nbsp; Detailed insights for improved learning outcomes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Our Services</h2>
                    <p class="section-subtitle">Comprehensive AI-powered solutions for modern education assessment</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4>Automated Exam Grading</h4>
                        <p>Instant grading for multiple choice, short answer, and essay questions with AI precision.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Performance Analytics</h4>
                        <p>Detailed insights into student performance patterns and learning gaps.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Plagiarism Detection</h4>
                        <p>Advanced AI algorithms to detect and prevent academic dishonesty.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4>Format Flexibility</h4>
                        <p>Support for various exam formats including PDFs, images, and digital forms.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Powerful Features</h2>
                    <p class="section-subtitle">Everything you need for efficient and accurate exam grading</p>
                </div>
            </div>

            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <div class="feature-list">
                        <div class="feature-item-large">
                            <div class="feature-icon-large">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div>
                                <h4>Lightning Fast Processing</h4>
                                <p>Grade hundreds of exams in minutes, not hours. Our AI processes exams 10x faster than traditional methods.</p>
                            </div>
                        </div>

                        <div class="feature-item-large">
                            <div class="feature-icon-large">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div>
                                <h4>Intelligent Insights</h4>
                                <p>Get detailed reports highlighting student strengths, weaknesses, and learning patterns.</p>
                            </div>
                        </div>

                        <div class="feature-item-large">
                            <div class="feature-icon-large">
                                <i class="fas fa-cloud"></i>
                            </div>
                            <div>
                                <h4>Secure Cloud Storage</h4>
                                <p>All results are securely stored in the cloud with enterprise-grade encryption and backup.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="feature-visual">
                        <div class="report-mockup">
                            <div class="report-header">
                                <h5>Student Performance Report</h5>
                                <span class="report-date">March 2024</span>
                            </div>
                            <div class="report-content">
                                <div class="performance-metric">
                                    <span class="metric-label">Overall Score</span>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 85%"></div>
                                    </div>
                                    <span class="metric-value">85%</span>
                                </div>
                                <div class="performance-metric">
                                    <span class="metric-label">Mathematics</span>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 92%"></div>
                                    </div>
                                    <span class="metric-value">92%</span>
                                </div>
                                <div class="performance-metric">
                                    <span class="metric-label">Science</span>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 78%"></div>
                                    </div>
                                    <span class="metric-value">78%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Simple, Transparent Pricing</h2>
                    <p class="section-subtitle">Choose the plan that fits your needs</p>
                </div>
            </div>

            <div class="row mt-5 justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h4>Educator</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">29</span>
                                <span class="period">/month</span>
                            </div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fas fa-check"></i> Up to 500 exams/month</li>
                                <li><i class="fas fa-check"></i> Basic analytics</li>
                                <li><i class="fas fa-check"></i> Email support</li>
                                <li><i class="fas fa-check"></i> Cloud storage</li>
                            </ul>
                        </div>
                        <button class="btn btn-outline-primary w-100">Get Started</button>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing-card featured">
                        <div class="pricing-badge">Most Popular</div>
                        <div class="pricing-header">
                            <h4>Institution</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">99</span>
                                <span class="period">/month</span>
                            </div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fas fa-check"></i> Unlimited exams</li>
                                <li><i class="fas fa-check"></i> Advanced analytics</li>
                                <li><i class="fas fa-check"></i> Priority support</li>
                                <li><i class="fas fa-check"></i> Team collaboration</li>
                                <li><i class="fas fa-check"></i> Custom integrations</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary w-100">Get Started</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Get in Touch</h2>
                    <p class="section-subtitle">Ready to transform your grading process? Let's talk!</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <form class="contact-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Institution Name">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Tell us about your grading needs..."></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 text-center">
                    <div class="contact-info">
                        <i class="fas fa-envelope"></i>
                        <h5>Email</h5>
                        <p>hello@gradegenius.com</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="contact-info">
                        <i class="fas fa-phone"></i>
                        <h5>Phone</h5>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="contact-info">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Office</h5>
                        <p>San Francisco, CA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
