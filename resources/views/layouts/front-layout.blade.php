<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    {{ $styles ?? '' }}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-blue-300">
        <nav class="navbar navbar-expand-lg navbar-light bg-blue-300 px-2">
            <div class="container-fluid">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="#">Navbar</a>
                </div>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible Content -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Middle Section -->
                    <div class="mx-auto">
                        <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
                            <li class="nav-item">
                                <x-nav-link route="/">Home</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link route="/about">About Us</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link route="/about">Contact Us</x-nav-link>
                            </li>

                        </ul>
                    </div>

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <div class="email px-3">
                            <img width="24" height="24" src="https://img.icons8.com/ultraviolet/40/new-post.png"
                                alt="new-post" />
                            <a href="mailto:support@farebuddies.com" class="text-decoration-none"
                                @style([ 'font-size: 12px' ])>support@farebuddies.com</a>
                        </div>
                        <div class="phone">
                            <img width="24" height="24" src="https://img.icons8.com/flat-round/64/phone.png"
                                alt="phone" />
                            <a href="tel:+1-877-847-4278" class="text-decoration-none" @style([ 'font-size: 12px'
                                ])>+1-877-847-4278</a>

                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- Left Section (About) -->
                <div class="col-md-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3" style="max-width: 180px;">
                    <p>
                        A peek behind the curtain. We started our company so we could share our love of travel and make
                        it
                        easier for folks to get to wherever they want to go.
                        Being an experienced travel company, we know what travelers want and what excites their mood.
                        <a href="#" class="text-primary">Read More</a>
                    </p>
                </div>

                <!-- Middle Section (Quick Links & Need Help) -->
                <div class="col-md-4">
                    <h5 class="text-warning">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none bi bi-dot">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none bi bi-dot">Contact</a></li>
                        <li><a href="#" class="text-white text-decoration-none bi bi-dot">Privacy Policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none bi bi-dot">Terms & Conditions</a></li>
                    </ul>

                    <div class="border p-3 my-3">
                        <h6 class="text-warning">NEED HELP</h6>
                        <p>Got Questions? Call us 24/7</p>
                        <p class="fw-bold text-warning">Call Us: +1-877-847-4278</p>
                    </div>
                </div>

                <!-- Right Section (Contact Info & Social Icons) -->
                <div class="col-md-4">
                    <h5 class="text-warning">CONTACT INFO</h5>
                    <p><i class="fas fa-envelope"></i> Email: support@example.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Address: 20 S CHARLES ST STE 403 #1480, BALTIMORE, MD 21201
                    </p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Section -->
            <div class="text-center mt-4 border-top pt-3">
                <p class="mb-0">© example.com 2025 - All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{ $scripts ?? '' }}

</body>

</html>
