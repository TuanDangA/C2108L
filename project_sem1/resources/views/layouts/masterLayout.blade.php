<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/user_animal/user_animal_logo_1.jpeg') }}">
    <title>@yield('header')</title>
    <!-- Bootrap and Jqurey -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="@yield('css-body')" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/header-footer.css') }}" type="text/css">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body class="container">
    <!-- PHAN 1: HEADER -->
    <div class="header">
        <!-- HEADER: Dong 1 -->
        <div class="welcome">

            <div class="clock">
                <div class="container">
                    <span id="clo_vn_time"></span>
                </div>
            </div>

            <div class="search-engine">
                @if (!is_null($accounts))
                    <form method="post" action="{{ route('search',['confirmation_code'=>$accounts->confirmation_code]) }}">
                        @csrf
                        <input type="text" name="search" placeholder="Search"
                            @if(isset($search_general)) value="{{ $search_general }}" @endif
                        >
                        <button type="submit"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button>
                    </form>
                @endif
                @if (is_null($accounts))
                    <form method="post" action="{{ route('search',['confirmation_code'=>"guest"]) }}">
                        @csrf
                        <input type="search" name="search" placeholder="Search" 
                            @if(isset($search_general)) value="{{ $search_general }}" @endif
                        >
                        <button type="submit"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button>
                    </form>
                @endif
            </div>

            @if(!is_null($accounts))
                <div class="profile">
                    @if (isset($accounts->image))
                        <img src="{{ asset('storage/images/user_avatar/'.$accounts->image) }}" width="36" height="36">
                    @endif
                    <span>Hi, {{ $accounts->fullname }}</span> 
                    <ul>
                        <li>
                            <a href="{{ route('profile-view',['confirmation_code'=>$accounts->confirmation_code]) }}">View profile</a>
                        </li>
                        <li>
                            <a href="{{ route('profile-edit', $accounts->confirmation_code) }}">Edit Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('user_booking_list',['confirmation_code'=>$accounts->confirmation_code]) }}">My Bookings</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            @endif

            @if(is_null($accounts))
                <span class="login"><a href="{{ route('login-page') }}">Login</a></span>
                <div class="register"><a href="{{ route('register-page') }}">Register</a></div>
            @endif

            <div class="opentime">9AM - 6PM</div>
        </div>
        <!-- HEADER: Dong 2 -->
        <div class="panel-bg"></div>

        <div class="panel container">

            <div class="logo">
                @if(!is_null($accounts))
                    <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}"><label>NEXUS</label><div class="logo-icon" style="background-image: url('{{ asset('storage/images/user_animal/user_animal_logo_1.jpeg') }}')"></div><label>AQUARIUM</label></a>
                @endif
                @if(is_null($accounts))
                    <a href="{{ route('home',['confirmation_code'=>"guest"]) }}"><label>NEXUS</label><div class="logo-icon" style="background-image: url('{{ asset('storage/images/user_animal/user_animal_logo_1.jpeg') }}')"></div><label>AQUARIUM</label></a>
                @endif
            </div>

            <div class="navigation">
                <ul>
                    <li>
                        @if(!is_null($accounts))
                            <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}">HOME</a>
                        @endif
                        @if (is_null($accounts))
                            <a href="{{ route('home',['confirmation_code'=>"guest"]) }}">HOME</a>
                        @endif
                    </li>
                    <li>
                        @if(!is_null($accounts))
                            <a href="{{ route('user_animal_list',['confirmation_code'=>$accounts->confirmation_code]) }}">ANIMALS</a>
                        @endif
                        @if (is_null($accounts))
                            <a href="{{ route('user_animal_list',['confirmation_code'=>"guest"]) }}">ANIMALS</a>
                        @endif
                    </li>
                    <li>
                        @if(!is_null($accounts))
                            <a href="{{ route('user_post_list',['confirmation_code'=>$accounts->confirmation_code]) }}">NEWS</a>
                        @endif
                        @if (is_null($accounts))
                            <a href="{{ route('user_post_list',['confirmation_code'=>"guest"]) }}">NEWS</a>
                        @endif
                    </li>
                    <li>
                        @if(!is_null($accounts))
                            <a href="{{ route('event-view',['confirmation_code'=>$accounts->confirmation_code]) }}">EVENTS</a>
                        @endif
                        @if (is_null($accounts))
                            <a href="{{ route('event-view',['confirmation_code'=>"guest"]) }}">EVENTS</a>
                        @endif
                    </li>
                    <li>
                        SUPPORT
                        <ul class="sp-table">
                            <li>
                                @if(!is_null($accounts))
                                    <a href="{{ route('about_us',['confirmation_code'=>$accounts->confirmation_code]) }}">About Us</a>
                                @endif
                                @if (is_null($accounts))
                                    <a href="{{ route('about_us',['confirmation_code'=>"guest"]) }}">About Us</a>
                                @endif
                            </li>
                            <li>
                                @if(!is_null($accounts))
                                    <a href="{{ route('contact_us',['confirmation_code'=>$accounts->confirmation_code]) }}">Contact Us</a>
                                @endif
                                @if (is_null($accounts))
                                    <a href="{{ route('contact_us',['confirmation_code'=>"guest"]) }}">Contact Us</a>
                                @endif
                            </li>
                            <li>
                                @if (!is_null($accounts))
                                    <a href="{{ route('user_feedback_add',['confirmation_code'=>$accounts->confirmation_code]) }}">Feedback</a>
                                @endif
                                @if (is_null($accounts))
                                    <a href="{{ route('login-page') }}">Feedback</a>
                                @endif
                            </li>
                            <li>
                                @if (!is_null($accounts))
                                    <a href="{{ route('faqs',['confirmation_code'=>$accounts->confirmation_code]) }}">FAQS</a>
                                @endif
                                @if (is_null($accounts))
                                    <a href="{{ route('faqs',['confirmation_code'=>"guest"]) }}">FAQS</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        @if (!is_null($accounts))
                            <a href="{{ route('user_visit_booking_details',['confirmation_code'=>$accounts->confirmation_code]) }}">VISIT</a>           
                        @endif
                        @if (is_null($accounts))
                            <a href="{{ route('user_visit_booking_details',['confirmation_code'=>"guest"]) }}">VISIT</a>           
                        @endif         
                    </li>
                    <li>
                        @if (!is_null($accounts) && $accounts->id_rule_user == 1)
                            <a href="{{ route('home_admin',['confirmation_code'=>$accounts->confirmation_code]) }}">ADMIN</a>  
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- PHAN 2: BODY -->
    @yield('content')
    <!-- PHAN 3: FOOTER -->
    <div class="footer">
        <div class="partners">
            <div class="container">
                <h3>Nexus Aquarium Partners</h3>
                <div class="partners-logo">
                    <ul>
                        <li>
                            <img src="{{ asset('storage/images/partners/partner1.jpeg') }}">
                        </li>
                        <li>
                            <img src="{{ asset('storage/images/partners/partner2.jpeg') }}">
                        </li>
                        <li>
                            <img src="{{ asset('storage/images/partners/partner3.jpeg') }}">
                        </li>
                        <li>
                            <img src="{{ asset('storage/images/partners/partner4.jpeg') }}">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="info row">
                <div class="social-media col-4">
                    <div class="logo-footer" style="background-image: url('{{ asset('storage/images/user_animal/user_animal_logo_2.jpeg') }}')"></div>
                    <div class="social-media-link row">
                        <div class="facebook col-3">
                            <a href="https://www.facebook.com/nexus_aquarium" target="_blank"><img draggable="false" src="{{ asset('storage/images/social_media/facebook.jpeg') }}"></a>
                        </div>
                        <div class="instagram col-3">
                            <a href="https://www.instagram.com/nexusaquarium" target="_blank"><img draggable="false" src="{{ asset('storage/images/social_media/instagram.jpeg') }}"></a>
                        </div>
                        <div class="twitter col-3">
                            <a href="https://www.twitter.com/nexus_aquarium" target="_blank"><img draggable="false" src="{{ asset('storage/images/social_media/twitter.jpeg') }}"></a>
                        </div>
                        <div class="pinterest col-3">
                            <a href="https://www.pinterest.com/nexus_aquarium" target="_blank"><img draggable="false" src="{{ asset('storage/images/social_media/pinterest.jpeg') }}"></a>
                        </div>
                    </div>
                    <div class="contact-info">
                        <span><i class="fas fa-phone"></i><a href="tel:0388888888" style="color: white;"> (+84) 8888 8888</a></span></br>
                        <span><i class="fas fa-envelope"></i><a href="mailto:nexusaquarium@esds.co.in" style="color: white;"> nexusaquarium@esds.co.in</a></span></br>
                        <span><i class="fas fa-map-marker"></i><a href="https://goo.gl/maps/GzPxcYXVvrREbBQq9" target="_blank" style="color: white;"> Washington D.C, USA</a></span>
                    </div>
                </div>
                <div class="about">
                    @if (!is_null($accounts))
                        <a href="{{ route('ticket_price',['confirmation_code'=>$accounts->confirmation_code]) }}">Ticket Price</a>
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('ticket_price',['confirmation_code'=>"guest"]) }}">Ticket Price</a>
                    @endif

                    @if(!is_null($accounts))
                        <a href="{{ route('about_us',['confirmation_code'=>$accounts->confirmation_code]) }}">About Us</a>
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('about_us',['confirmation_code'=>"guest"]) }}">About Us</a>
                    @endif

                    @if (!is_null($accounts))
                        <a href="{{ route('user_feedback_add',['confirmation_code'=>$accounts->confirmation_code]) }}">Feedback</a>
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('login-page') }}">Feedback</a>
                    @endif

                    @if(!is_null($accounts))
                        <a href="{{ route('contact_us',['confirmation_code'=>$accounts->confirmation_code]) }}">Contact Us</a>
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('contact_us',['confirmation_code'=>"guest"]) }}">Contact Us</a>
                    @endif

                    @if (!is_null($accounts))
                        <a href="{{ route('faqs',['confirmation_code'=>$accounts->confirmation_code]) }}">FAQS</a>
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('faqs',['confirmation_code'=>"guest"]) }}">FAQS</a>
                    @endif

                    <a href="">CAREERS</a>
                    <a href="">MOBILE APP</a>
                    <a href="">VOLUNTEERS</a>
                    <a href="">NEWSLETTER</a>
                    <a href="">VISITOR INFO</a>
                </div>

                <div class="disclaime">
                    <p>Nexus Aquarium is a nonprofit committed to inspiring awareness and preservation of our ocean and aquatic animals worldwide.</p>
                    <div class="accreditation">
                        <h6>Accredited By:</h6>
                        <p>Association of Zoos & Aquariums (AZA)</p>
                        <p>Alliance of Marine Mammals Parks & Aquariums (AMMPA)</p>
                        <p>International Marine Animal Trainer's Association (IMATA)</p>
                        <p>Humane Certified by American Humane</p>
                    </div>
                </div>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99370.29950629387!2d-77.01457599999999!3d38.8937545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7b9d77863eb63%3A0x60faf9c5954e6d8b!2sNationals%20Park!5e0!3m2!1svi!2s!4v1653054316715!5m2!1svi!2s" width="260" height="260" style="margin:30px 0px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- PHAN 4: SCRIPT JS -->
    @yield('js')
</body>
</html>