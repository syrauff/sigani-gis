<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .map-container {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }
        .section {
            padding: 80px 0;
        }
        .bg-light-gray {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MySite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#table">Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to Our Website</h1>
            <p class="lead">Discover amazing features and services</p>
            <a href="#profile" class="btn btn-light btn-lg mt-3">Learn More</a>
        </div>
    </header>

    <!-- Profile Section -->
    <section id="profile" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                    <img src="https://via.placeholder.com/300" alt="Profile Image" class="profile-img rounded-circle shadow">
                    <h3 class="mt-3">John Doe</h3>
                    <p class="text-muted">Web Developer</p>
                    <div class="social-icons">
                        <a href="#" class="text-dark mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="fab fa-github fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h2 class="mb-4">About Me</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim.</p>
                    <p>Phasellus ligula massa, congue ac vulputate non, dignissim at augue. Sed auctor fringilla quam quis porttitor. Praesent vitae diam non lacus malesuada vehicula.</p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Professional Design</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Responsive Layout</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> SEO Optimized</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Fast Loading</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Cross Browser</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Easy to Customize</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section id="map" class="section bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2>Our Location</h2>
                    <p class="lead">Find us easily with this interactive map</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="map-container">
                        <!-- Embedded Google Map (replace with your own embed code) -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215573813203!2d-73.98784492416495!3d40.74844097138962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1689874725833!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-4">Contact Information</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i> 123 Main Street, New York, NY 10001</li>
                        <li class="mb-3"><i class="fas fa-phone text-primary me-2"></i> (123) 456-7890</li>
                        <li class="mb-3"><i class="fas fa-envelope text-primary me-2"></i> info@example.com</li>
                        <li class="mb-3"><i class="fas fa-clock text-primary me-2"></i> Mon-Fri: 9:00 AM - 5:00 PM</li>
                    </ul>
                    <hr>
                    <h4 class="mt-4">Send us a message</h4>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Table Section -->
    <section id="table" class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2>Our Data</h2>
                    <p class="lead">Important information presented in a clear table format</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Join Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Smith</td>
                                    <td>Web Developer</td>
                                    <td>IT</td>
                                    <td>2020-05-15</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sarah Johnson</td>
                                    <td>Marketing Manager</td>
                                    <td>Marketing</td>
                                    <td>2019-08-22</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Michael Brown</td>
                                    <td>Sales Executive</td>
                                    <td>Sales</td>
                                    <td>2021-03-10</td>
                                    <td><span class="badge bg-warning text-dark">On Leave</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Emily Davis</td>
                                    <td>HR Specialist</td>
                                    <td>Human Resources</td>
                                    <td>2018-11-05</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Robert Wilson</td>
                                    <td>Finance Analyst</td>
                                    <td>Finance</td>
                                    <td>2022-01-18</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>About Us</h5>
                    <p>We are a creative team dedicated to building amazing web experiences for our clients.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#profile" class="text-white">Profile</a></li>
                        <li><a href="#map" class="text-white">Location</a></li>
                        <li><a href="#table" class="text-white">Data</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white"><i class="fab fa-facebook me-2"></i>Facebook</a></li>
                        <li><a href="#" class="text-white"><i class="fab fa-twitter me-2"></i>Twitter</a></li>
                        <li><a href="#" class="text-white"><i class="fab fa-instagram me-2"></i>Instagram</a></li>
                        <li><a href="#" class="text-white"><i class="fab fa-linkedin me-2"></i>LinkedIn</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2023 MySite. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>