<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع حجز السفر</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* إعدادات عامة */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* الهيدر */
        header {
            background-color: rgba(240, 240, 255, 0.9);
            position: relative;
            width: 100%;
            z-index: 100;
            padding: 15px 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
        }

        .logo {
            color: #4444ff;
            font-weight: bold;
            font-size: 24px;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
        }

        .nav-menu a {
            color: #333;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: #4444ff;
        }

        .contact-info {
            display: flex;
            align-items: center;
            color: #4444ff;
        }

        .contact-info i {
            margin-right: 10px;
        }

        /* بانر الصفحة الرئيسية */
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url('https://via.placeholder.com/1920x1080');
            background-size: cover;
            background-position: center;
            height: 600px;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
        }

        .hero-content {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .hero-text {
            width: 50%;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        /* نموذج البحث */
        .search-form {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .search-form h3 {
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .trip-type {
            display: flex;
            gap: 20px;
            margin: 15px 0;
        }

        .trip-type-option {
            display: flex;
            align-items: center;
        }

        .trip-type-option input {
            margin-right: 5px;
        }

        .search-btn {
            background-color: #4444ff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #3333cc;
        }

        /* قسم المراجعات */
        .reviews {
            background-color: white;
            padding: 30px 0;
            margin-top: -50px;
            position: relative;
        }

        .reviews-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            scrollbar-width: none;
        }

        .reviews-container::-webkit-scrollbar {
            display: none;
        }

        .review-card {
            min-width: 200px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .review-stars {
            color: #FFD700;
            margin-bottom: 5px;
        }

        .review-title {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 5px;
        }

        .review-info {
            font-size: 0.8rem;
            color: #777;
        }

        .scroll-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 10;
        }

        .scroll-left {
            left: 10px;
        }

        .scroll-right {
            right: 10px;
        }

        /* قسم المميزات */
        .features {
            padding: 60px 0;
            text-align: center;
        }

        .section-title {
            margin-bottom: 40px;
            font-size: 2rem;
            color: #333;
        }

        .section-title span {
            color: #4444ff;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .features-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 30px;
        }

        .feature-card {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s;
            flex: 1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: #4444ff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 0 auto 20px;
            font-size: 24px;
        }

        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #333;
        }

        .feature-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* قسم الأماكن */
        .places {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .places-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .places-header h2 {
            font-size: 2rem;
            color: #333;
        }

        .places-header h2 span {
            color: #4444ff;
        }

        .see-all {
            color: #4444ff;
            display: flex;
            align-items: center;
        }

        .see-all i {
            margin-left: 5px;
        }

        .places-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .place-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .place-card:hover {
            transform: translateY(-10px);
        }

        .place-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .place-info {
            padding: 20px;
        }

        .place-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .place-title span {
            color: #4444ff;
        }

        .place-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .explore-more {
            display: block;
            width: 200px;
            margin: 40px auto 0;
            padding: 12px 20px;
            background-color: #4444ff;
            color: white;
            text-align: center;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .explore-more:hover {
            background-color: #3333cc;
        }

        /* قسم المستخدمين */
        .testimonials {
            padding: 60px 0;
        }

        .testimonials-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2rem;
            color: #333;
        }

        .testimonials-title span {
            color: #4444ff;
        }

        .testimonials-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .user-details h4 {
            color: #333;
            margin-bottom: 5px;
        }

        .user-details p {
            color: #666;
            font-size: 0.8rem;
        }

        .user-rating {
            color: #FFD700;
            margin-bottom: 10px;
        }

        .user-comment {
            color: #333;
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .read-more {
            color: #4444ff;
            font-size: 0.9rem;
            margin-top: 10px;
            display: inline-block;
        }

        /* التجاوب مع الشاشات */
        @media (max-width: 1024px) {
            .hero-text h1 {
                font-size: 2.5rem;
            }

            .places-container,
            .testimonials-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-wrap: wrap;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                margin-top: 20px;
                justify-content: center;
            }

            .hero-content {
                flex-direction: column;
                align-items: center;
            }

            .hero-text {
                width: 100%;
                text-align: center;
                margin-bottom: 30px;
            }

            .search-form {
                width: 100%;
            }

            .features-container {
                flex-direction: column;
            }

            .places-container,
            .testimonials-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .nav-menu {
                gap: 15px;
            }

            .form-row {
                flex-direction: column;
            }

            .hero-text h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo">LOGO</div>
            <ul class="nav-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <div class="contact-info">
                <i class="fas fa-phone-alt"></i>
                <span>+1-111-111-1111</span>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Transforming Travel,<br>One Trip at a Time</h1>
            </div>
            <div class="search-form">
                <h3>Find your ticket Now</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-plane-departure"></i> From</label>
                        <select class="form-control">
                            <option>Germany</option>
                            <option>USA</option>
                            <option>UK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-plane-arrival"></i> To</label>
                        <select class="form-control">
                            <option>Australia</option>
                            <option>France</option>
                            <option>Italy</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="far fa-calendar-alt"></i> Check-In</label>
                        <input type="text" class="form-control" value="01 JUN 2023" readonly>
                    </div>
                    <div class="form-group">
                        <label><i class="far fa-calendar-alt"></i> Check-Out</label>
                        <input type="text" class="form-control" value="10 JUN 2023" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Tickets</label>
                        <input type="number" class="form-control" value="02" min="1">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-ticket-alt"></i> Class</label>
                        <select class="form-control">
                            <option>Economy</option>
                            <option>Business</option>
                            <option>First Class</option>
                        </select>
                    </div>
                </div>
                <div class="trip-type">
                    <div class="trip-type-option">
                        <input type="radio" id="one-way" name="trip-type">
                        <label for="one-way">ONE WAY</label>
                    </div>
                    <div class="trip-type-option">
                        <input type="radio" id="round-trip" name="trip-type" checked>
                        <label for="round-trip">ROUND WAY</label>
                    </div>
                </div>
                <button class="search-btn">Book Now</button>
            </div>
        </div>
    </section><!-- hero -->

    <!-- قسم المراجعات -->
    <section class="reviews">
        <div class="container">
            <div class="reviews-container">
                <div class="review-card">
                    <img src="https://via.placeholder.com/100x30" alt="Google">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-title">Instant Feedback</p>
                    <p class="review-info">Based on 1,200 Reviews</p>
                </div>
                <div class="review-card">
                    <img src="https://via.placeholder.com/100x30" alt="Google">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-title">Instant Feedback</p>
                    <p class="review-info">Based on 1,200 Reviews</p>
                </div>
                <div class="review-card">
                    <img src="https://via.placeholder.com/100x30" alt="Google">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-title">Instant Feedback</p>
                    <p class="review-info">Based on 1,200 Reviews</p>
                </div>
                <div class="review-card">
                    <img src="https://via.placeholder.com/100x30" alt="Google">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-title">Instant Feedback</p>
                    <p class="review-info">Based on 1,200 Reviews</p>
                </div>
                <div class="review-card">
                    <img src="https://via.placeholder.com/100x30" alt="Google">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-title">Instant Feedback</p>
                    <p class="review-info">Based on 1,200 Reviews</p>
                </div>
            </div>
            <div class="scroll-arrow scroll-right">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </section><!-- reviews -->

    <!-- قسم المميزات -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Discover Why Choose <span>Us</span> for Your Flight Booking?</h2>
            <p class="subtitle">Hassle-free Flight Booking with Us.</p>
            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">Seamless Booking Experience</h3>
                    <p class="feature-desc">offering unparalleled choices for your travel needs</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h3 class="feature-title">Best Pricing and Deals</h3>
                    <p class="feature-desc">offering unparalleled choices for your travel needs</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="feature-title">Personalized Travel Recommendations</h3>
                    <p class="feature-desc">offering unparalleled choices for your travel needs</p>
                </div>
            </div>
        </div>
    </section><!-- features -->

    <!-- قسم الأماكن -->
    <section class="places">
        <div class="container">
            <div class="places-header">
                <h2>Explore unique <span>places to stay</span></h2>
                <a href="#" class="see-all">All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="places-container">
                <div class="place-card">
                    <img src="https://via.placeholder.com/400x250" alt="Maldives" class="place-img">
                    <div class="place-info">
                        <h3 class="place-title">Stay among the atolls in <span>Maldives</span></h3>
                        <p class="place-desc">From the Sanskrit 'AD,' the islands were known as the 'Money Isles' due to
                            the abundance of cowry shells, a currency of the early ages.</p>
                    </div>
                </div>
                <div class="place-card">
                    <img src="https://via.placeholder.com/400x250" alt="Morocco" class="place-img">
                    <div class="place-info">
                        <h3 class="place-title">Experience the Ourika Valley in <span>Morocco</span></h3>
                        <p class="place-desc">Morocco's Moorish architecture blends influences from Berber culture,
                            Spain, and contemporary artistic currents in the Middle East.</p>
                    </div>
                </div>
                <div class="place-card">
                    <img src="https://via.placeholder.com/400x250" alt="Mongolia" class="place-img">
                    <div class="place-info">
                        <h3 class="place-title">Live traditionally in <span>Mongolia</span></h3>
                        <p class="place-desc">Traditional Mongolian yurts consists of an angled latticework of wood or
                            bamboo for walls, ribs, and a wheel.</p>
                    </div>
                </div>
            </div>
            <a href="#" class="explore-more">Explore more stays</a>
        </div>
    </section><!-- places -->

    <!-- قسم المستخدمين -->
    <section class="testimonials">
        <div class="container">
            <h2 class="testimonials-title">What <span>Our</span> users are saying</h2>
            <div class="testimonials-container">
                <div class="testimonial-card">
                    <div class="user-info">
                        <img src="https://via.placeholder.com/50" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>Yifei Chen</h4>
                            <p>Seoul, South Korea | April 2019</p>
                        </div>
                    </div>
                    <div class="user-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="user-comment">What a great experience using Tripma! I booked all of my flights for my gap
                        year through Tripma and never had any issues. Their customer service team was always very quick
                        to respond when I had questions. I highly recommend Tripma!</p>
                    <a href="#" class="read-more">read more...</a>
                </div>
                <div class="testimonial-card">
                    <div class="user-info">
                        <img src="https://via.placeholder.com/50" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>Kaori Yamaguchi</h4>
                            <p>Honolulu, Hawaii | February 2017</p>
                        </div>
                    </div>
                    <div class="user-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p class="user-comment">My family and I visit Hawaii every year, and we usually book our flights
                        separately. This year we used Tripma to book our flights and it was so much easier. We got a
                        great deal!</p>
                    <a href="#" class="read-more">read more...</a>
                </div>
                <div class="testimonial-card">
                    <div class="user-info">
                        <img src="https://via.placeholder.com/50" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>Anthony Lewis</h4>
                            <p>Berlin, Germany | April 2019</p>
                        </div>
                    </div>
                    <div class="user-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="user-comment">When I was looking to book my flight to Berlin from LA, Tripma had the best
                        prices by far. I checked a few other services that I've used in the past, but I'll be using
                        Tripma from now on!</p>
                    <a href="#" class="read-more">read more...</a>
                </div>
            </div><!-- testimonials-container -->
        </div>
    </section><!-- testimonials -->


    <section class="questions">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p class="question"><strong>Find Cheap Flights & Travel Deals at Cheapflightsfares</strong></p>
                    <p class="answer">
                        Looking for the cheapest flights to your dream destination? You've come to the right place!
                        At Cheapflightsfares, we specialize in finding you the best travel deals on airline tickets
                        to destinations across the globe...
                    </p>
                </div>
                <div class="col-6">
                    <p class="question"><strong>Find Cheap Flights & Travel Deals at Cheapflightsfares</strong></p>
                    <p class="answer p-5">
                        Looking for the cheapest flights to your dream destination? You've come to the right place!
                        At Cheapflightsfares, we specialize in finding you the best travel deals on airline tickets
                        to destinations across the globe...
                    </p>
                </div>
            </div>
        </div>
    </section><!-- questions -->
    <!-- jQuery -->

    <script>
        $(document).ready(function() {

        });

    </script>
</body>

</html>
