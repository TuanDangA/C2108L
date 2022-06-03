@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Contact US')

@section('css-body')
    {{ asset('css/user/contact_us.css') }}
@stop

@section('content')
<div class="preview">
    <div class="background" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')"></div>
    <div class="container">
        <h1>We’d Love<br>to Hear from You</h1>
    </div>
</div>
<div class="body container">
    <div class="content">

        {{ Breadcrumbs::render('contact_us',$accounts->confirmation_code) }}    

        <h3>Contact Us</h3><hr>
        <div>
            <span><strong>Telephone: </strong><a href="tel:0388888888">(+84) 8888 8888</a></span>
        </div>
        <div>
            <span><strong>Fax: </strong>+84 (8) 8888 8888</span>
        </div>
        <div>
            <span><strong>Email: </strong><a href="mailto:nexusaquarium@esds.co.in">nexusaquarium@esds.co.in</a></span>
        </div>
        <div>
            <span><strong>Address: </strong>Washington D.C, USA</span>
        </div>
        <div>
            <span><strong>Fanpage: </strong><a href="https://www.facebook.com/nexus_aquarium" target="_blank">facebook.com/nexus_aquarium</a></span>
        </div>
        <div>
            <span><strong>Instagram: </strong><a href="https://www.instagram.com/nexusaquarium" target="_blank">instagram.com/nexusaquarium</a></span>
        </div>
        <div>
            <span><strong>Twitter: </strong><a href="https://www.twitter.com/nexus_aquarium" target="_blank">twitter.com/nexus_aquarium</a></span>
        </div> 
        <div>   
            <span><strong>Pinterest: </strong><a href="https://www.pinterest.com/nexus_aquarium" target="_blank">pinterest.com/nexus_aquarium</a></span>
        </div>
    </div>
    <div class="contact-map">
        <img src="{{ asset('storage/images/contact_us/contact-map.jpeg') }}" alt="Nexus Aquarium Map" width="500" height="500">
    </div>
</div>
@endsection