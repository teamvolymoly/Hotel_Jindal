@extends('layouts.app')

@section('title', 'Gallery - Hotel Jindal')
@section('body_class', 'bg-[#111] font-body text-white')

@section('head')
<script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serifDisplay: ["Gilda Display", "serif"],
                        body: ["Raleway", "sans-serif"]
                    }
                }
            }
        };
    </script>

    <style>
        @font-face {
            font-family: "Gilda Display";
            src: url("{{ asset('assets/fonts/GildaDisplay-Regular.ttf') }}");
        }

        @font-face {
            font-family: "Raleway";
            src: url("{{ asset('assets/fonts/Raleway-VariableFont_wght.ttf') }}");
        }

        .hero-overlay {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0.55) 100%);
        }

        /* hover effect */
        .gallery-card img {
            transition: transform 0.5s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.08);
        }
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR (reuse your original) ================= -->
    @include('partials.public-header')

    <!-- ================= HERO ================= -->
    <section class="relative min-h-screen flex items-center justify-center text-center">

        <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 px-5">
            <h1 class="font-serifDisplay text-4xl sm:text-5xl lg:text-6xl 2xl:text-7xl">
                GALLERY
            </h1>
        </div>

    </section>

    <!-- ================= INTRO ================= -->
    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 px-5 text-center">

        <div class="mx-auto max-w-[900px]">

            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                Home &gt; Gallery
            </p>

            <h2 class="mt-6 font-serifDisplay text-4xl md:text-6xl leading-[1.1]">
                MOMENTS AT HOTEL JINDAL
            </h2>

            <p class="mt-6 text-[16px] md:text-[18px] leading-[1.7] text-[#4a4a4a]">
                Explore the ambiance, comfort, and experiences that define your stay at Hotel Jindal.
            </p>

        </div>

    </section>

    <!-- ================= GALLERY GRID ================= -->
    <section class="bg-[#f1f1f1] text-[#1f1f1f] pb-20">

        <div class="mx-auto px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 max-w-[1200px]">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- CARD -->
                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/rooms/deluxe.png') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Rooms</span>
                    </div>
                </div>

                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/rooms/family.png') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Family Room</span>
                    </div>
                </div>

                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Dining</span>
                    </div>
                </div>

                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Restaurant</span>
                    </div>
                </div>

                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/rooms/executive.png') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Executive</span>
                    </div>
                </div>

                <div class="gallery-card relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="w-full h-[300px] object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-sm uppercase tracking-wide">Experience</span>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ================= CTA ================= -->
    <section class="bg-[#e7e7e7] text-center py-20 text-[#1f1f1f]">

        <h2 class="font-serifDisplay text-4xl md:text-5xl">
            EXPERIENCE IT YOURSELF
        </h2>

        <a href="{{ route('contact') }}"
            class="mt-6 inline-flex bg-[#3c3c3c] text-white px-8 py-4 uppercase text-sm hover:bg-black transition">
            Book Your Stay
        </a>

    </section>

    <!-- ================= FOOTER ================= -->
    @include('partials.public-footer')
@endsection

@section('scripts')
<script>
        @include('partials.public-header-scripts')
        @include('partials.public-footer-scripts')
    </script>
@endsection

