@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ABOUT US')

@section('css-body')
    {{ asset('css/user/about_us.css') }}
@stop

@section('content')
    <div class="preview">
        <div class="background" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')"></div>
        <div class="container">
            <h1>We are<br>Nexus Aquarium</h1>
        </div>
    </div>
    <div class="body container">
        <div class="content">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('about_us', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('about_us', "guest") }}        
            @endif
            <h3>Inspiring awareness & preservation of our ocean and aquatic animals worldwide</h3>
            <p>Nexus Aquarium, located in Hanoi, Vietnam, is a 501(c)(3) non-profit organization that contains more than 11 million gallons of water. Nexus Aquarium is a scientific institution that entertains and educates, features exhibits and programs of the highest standards, and offers engaging and exciting guest experiences that promote the conservation of aquatic biodiversity throughout the world. As a leader in aquatic research and exceptional animal care, we are dedicated to fostering a deeper appreciation for our ocean and the animals that call it home.<br>Alongside other accredited facilities, our team conducts crucial research by working with animals both in human care and in their natural habitats to improve husbandry methods, develop innovative and exciting new exhibits, contribute to the understanding of the underwater world and apply new discoveries to the conservation of aquatic life. Every day, researchers in the Aquarium’s exhibits and labs are learning more about marine life in order to develop new methods of animal care and veterinary medicine. By combining field research with the study of on-site animals in a controlled environment, the Aquarium is contributing to the advancement of human knowledge in the area of animal science.</p>
        </div>
    </div>
@endsection
