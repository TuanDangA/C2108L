@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Frequently Asked Questions')

@section('css-body')
    {{ asset('css/user/faqs.css') }}
@stop

@section('content')
    <!-- PHAN 2: BODY -->
    <div class="preview">
        <div class="background" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')"></div>
        <div class="container">
            <h1>Frequently Asked<br>Questions</h1>
        </div>
    </div>
    <div class="content-end container">

        @if (!is_null($accounts))
            {{ Breadcrumbs::render('faqs', $accounts->confirmation_code) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('faqs', "guest") }}        
        @endif

        <div class="content-box">
            <button type="button" id="box1" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>Where is Nexus Aquarium?</span>
            <p id="pbox1" style="display: none;">Nexus Aquarium is located in Washington D.C, USA</p>
        </div>

        <div class="content-box">
            <button type="button" id="box2" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>Where can I park?</span>
            <p id="pbox2" style="display: none;">The official Nexus Aquarium parking deck operates 1,600 safe, secure and well-lit spaces attached to Nexus Aquarium. Covered and rooftop parking is available. You can pay for parking in advance online; just print and bring your pre-paid parking ticket with you to enter the parking deck. You’ll be asked to re-scan your ticket in order to exit the parking deck after your visit. There is no re-entry allowed on pre-paid parking.<br><span><strong>Please note: </strong></span>After you have parked, follow the signage onsite to the main entrance.  You will see overhead sings and painted markings on the ground leading you the elevators to the main entrance.</p>
        </div>

        <div class="content-box">
            <button type="button" id="box3" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>What is Nexus Aquarium doing to help guests and staff stay healthy?</span>
            <p id="pbox3" style="display: none;">Nexus Aquarium has several sanitization and cleanliness procedures, many of which have been enhanced given the awareness of COVID-19. Our Environmental Operations team continually cleans and disinfects frequently touched places like handles, elevators, faucets, counters, and more. We have placed additional hand sanitizer units in gallery entrances and exits and additional signage in our restrooms indicating proper handwashing techniques. For staff, disinfectant wipes, hand sanitizer, and gloves are available for all employees and volunteers.</p>
        </div>

        <div class="content-box">
            <button type="button" id="box4" class="btn">
                <i class="fas fa-angle-double-down"></i>          
            </button>
            <span>What can I wear to the aquarium?</span>
            <p id="pbox4" style="display: none;">All visitors are expected to ensure their clothing and accessories are appropriate for a family environment. For example, visitors and staff should not wear items during their visit that may be considered offensive, contain nudity, profanity, sexual innuendo/suggestions, promote negative ethnic or racial commentary, or hatred/violence in any form.</p>
        </div>
    </div>
@endsection


