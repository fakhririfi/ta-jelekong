@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->


<div class="row justify-content-center">

    <div class="col-lg-8">
   
        <div class="card8 shadow mb-4">
 <h1 class="h3 mb-4 text-gray-800" style="padding: 1.5rem;"><b>{{ __('About') }}</b></h1>
            <div class="card-profile-image mt-4">
            <img class="rounded-circle" src="" alt="">
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12 mb-1">
                        <div class="text-center">
                            <h5 class="font-weight-bold">Jelekong</h5>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="font-weight-bold">Tentang Desa Jelekong</h5>
                        <p>Kelurahan Jelekong merupakan salah satu dewa wisata yang memiliki rumah adat dan seni lukis yang akan memukau Anda. Tempat ini terkenal sebagai gudangnya pedalang wayang golek, tukang lukis, dan makanan tradisional Sunda.</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="font-weight-bold">Event Desa Jelengkong</h5>
                        <p>Jelekong memiliki acara yang bervariasi dengan beberapa kategori diantaranya Tari, Pentas Musik, Teater, Pameran. Berikut contoh videonya</p></center>
                       <center> <iframe width="560" height="315" src="https://www.youtube.com/embed/N0OcmP1Ow9M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/J-M9HxskRgA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="font-weight-bold">Lukisan Jelekong</h5>
                        <p>Selain acara, jelekong juga memiliki banyak karya berupa lukisan.</p>
                        <div class="owl-carousel col-12">
                            <div class="relative pr-3">
                                <a href="{{ asset('img/1.jpeg') }}" data-lightbox="Gambar 1">
                                    <img src="{{ asset('img/1.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                            <div class="relative pr-3">
                                <a href="{{ asset('img/2.jpeg') }}" data-lightbox="Gambar 2">
                                    <img src="{{ asset('img/2.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                            <div class="relative pr-3">
                                <a href="{{ asset('img/3.jpeg') }}" data-lightbox="Gambar 3">
                                    <img src="{{ asset('img/3.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                            <div class="relative pr-3">
                                <a href="{{ asset('img/4.jpeg') }}" data-lightbox="Gambar 4">
                                    <img src="{{ asset('img/4.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                            <div class="relative pr-3">
                                <a href="{{ asset('img/5.jpeg') }}" data-lightbox="Gambar 5">
                                    <img src="{{ asset('img/5.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                            <div class="relative pr-3">
                                <a href="{{ asset('img/6.jpeg') }}" data-lightbox="Gambar 6">
                                    <img src="{{ asset('img/6.jpeg') }}" alt="" style="height: 200px;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="font-weight-bold">Contact Us</h5>
                    </div>
                    <div class="col-md-3 mb-1 text-center">
                        <a href="https://facebook.com/GalleryJelekong/" target="_blank" class="btn btn-facebook btn-circle btn-lg"><i class="fab fa-facebook-f fa-fw"></i></a>
                    </div>
                    <div class="col-md-3 mb-1 text-center">
                        <a href="https://instagram.com/lukisanjelekong" target="_blank" class="btn btn-danger btn-circle btn-lg"><i class="fab fa-instagram fa-fw"></i></a>
                    </div>
                    <div class="col-md-3 mb-1 text-center">
                        <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=jelekong@gmail.com" target="_blank" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-envelope fa-fw"></i></a>
                    </div>
                    <div class="col-md-3 mb-1 text-center">
                        <a href="https://wa.me/083823082819" target="_blank" class="btn btn-whatsapp btn-circle btn-lg"><i class="fab fa-whatsapp fa-fw"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endpush