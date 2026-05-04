@extends('layouts.app')

@section('title', 'About - Hotel Jindal')
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
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.36) 0%, rgba(0, 0, 0, 0.48) 100%);
        }
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR (reuse your existing one) ================= -->

    @include('partials.public-header')

    <!-- ================= HERO ================= -->

    <section class="relative min-h-screen flex items-center justify-center text-center">

        <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 px-5 sm:mt-16">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                ABOUT US
            </h1>

            <a href="{{ route('menu') }}"
                class="mt-10 sm:mt-16 inline-flex items-center gap-3 text-[18px] bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
                View Menu
            </a>
        </div>

    </section>

    <!-- ================= INTRO ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 px-5 text-center">
        <div class="mx-auto max-w-[900px]">

            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                Home &gt; About
            </p>

            <h2 class="mt-6 font-serifDisplay text-4xl md:text-6xl leading-[1.1]">
                LUXURY & COMFORT<br />IN THE HEART OF NIMACH
            </h2>

            <p class="mt-6 text-[16px] md:text-[18px] leading-[1.7] text-[#4a4a4a]">
                Hotel Jindal offers a refined stay experience combining modern comfort with warm hospitality.
                Located in Neemuch, we provide the perfect balance of convenience, elegance, and relaxation.
            </p>

        </div>
    </section>

    <!-- ================= STORY SECTION ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20">

        <div
            class="mx-auto px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 max-w-[1200px] grid md:grid-cols-2 gap-16 items-center">

            <!-- IMAGE -->
            <div>
                <img src="{{ asset('assets/rooms/family.png') }}" class="w-full object-cover" />
            </div>

            <!-- TEXT -->
            <div>
                <h2 class="font-serifDisplay text-4xl md:text-5xl">
                    OUR STORY
                </h2>

                <p class="mt-6 text-[#4a4a4a] leading-[1.7]">
                    Built with a vision to offer high-quality hospitality in Neemuch, Hotel Jindal has become
                    a trusted destination for travelers seeking comfort and value.
                </p>

                <p class="mt-4 text-[#4a4a4a] leading-[1.7]">
                    Whether you are here for business or leisure, our rooms, dining, and service are designed
                    to make your stay memorable.
                </p>
            </div>

        </div>

    </section>

    <!-- ================= FEATURES ================= -->

    <section class="bg-[#f1f1f1] text-[#1f1f1f] pb-20">

        <div class="mx-auto px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 max-w-[1200px]">

            <h2 class="font-serifDisplay text-4xl md:text-5xl text-center">
                WHY CHOOSE US
            </h2>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 text-center">

                <div>
                    <h3 class="font-serifDisplay text-xl">Comfortable Rooms</h3>
                    <p class="mt-3 text-sm text-[#555]">Well-designed rooms with modern amenities.</p>
                </div>

                <div>
                    <h3 class="font-serifDisplay text-xl">Prime Location</h3>
                    <p class="mt-3 text-sm text-[#555]">Located in the heart of Neemuch.</p>
                </div>

                <div>
                    <h3 class="font-serifDisplay text-xl">Quality Dining</h3>
                    <p class="mt-3 text-sm text-[#555]">Delicious veg meals and snacks available.</p>
                </div>

                <div>
                    <h3 class="font-serifDisplay text-xl">Family Friendly</h3>
                    <p class="mt-3 text-sm text-[#555]">Spacious rooms for families.</p>
                </div>

                <div>
                    <h3 class="font-serifDisplay text-xl">Affordable Luxury</h3>
                    <p class="mt-3 text-sm text-[#555]">Premium experience at reasonable pricing.</p>
                </div>

                <div>
                    <h3 class="font-serifDisplay text-xl">24/7 Support</h3>
                    <p class="mt-3 text-sm text-[#555]">Always ready to assist guests.</p>
                </div>

            </div>

        </div>

    </section>

    <!-- ================= CTA ================= -->

    <section class="bg-[#e7e7e7] text-center py-20 text-[#1f1f1f]">
        <h2 class="font-serifDisplay text-4xl md:text-5xl">
            PLAN YOUR STAY TODAY
        </h2>

        <a href="{{ route('contact') }}"
            class="mt-6 inline-flex bg-[#3c3c3c] text-white px-8 py-4 uppercase text-sm hover:bg-black transition">
            Book Now
        </a>
    </section>

    <!-- ================= FOOTER ================= -->

    <footer class="bg-black py-8 text-white md:py-10">
        <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">

            <!-- Top Section -->
            <div class="flex flex-col items-center gap-5 text-center md:flex-row md:justify-between md:text-left">
                <img src="{{ asset('assets/logo/Logo-2.png') }}" alt="Hotel Jindal Logo" class="h-12 w-auto md:h-14" />
                <div class="font-serifDisplay text-2xl leading-none md:text-[34px]">HOTEL JINDAL</div>

                <div class="flex items-center gap-6">
                    <a href="#" aria-label="Instagram" class="opacity-95 transition hover:opacity-70">
                        <img src="{{ asset('assets/svg/instagram.svg') }}" alt="" class="h-6 w-6" />
                    </a>
                    <a href="#" aria-label="Facebook" class="opacity-95 transition hover:opacity-70">
                        <img src="{{ asset('assets/svg/facebook.svg') }}" alt="" class="h-6 w-6" />
                    </a>
                    <a href="#" aria-label="LinkedIn" class="opacity-95 transition hover:opacity-70">
                        <img src="{{ asset('assets/svg/linkedin.svg') }}" alt="" class="h-6 w-6" />
                    </a>
                </div>
            </div>

            <div class="mt-6 border-t border-white/20"></div>

            <!-- Middle Section -->
            <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-[1.2fr_0.6fr_1.4fr]">

                <!-- Info -->
                <div>
                    <!-- <h3 class="font-serifDisplay text-2xl md:text-[34px]">HOTEL JINDAL</h3> -->
                    <p class="mt-4 text-sm text-white/90 md:text-[16px]">Fawwara Chowk, Neemuch (M.P.)</p>
                    <p class="mt-3 text-sm text-white/90 md:text-[16px]">
                        <a href=" tel:9111684157">Tel. +91 91116 84157</a>
                    </p>
                    <p class="mt-1 text-sm text-white/90 md:text-[16px]">
                        <a href=" mailto:info@hoteljindal.com">
                            info@hoteljindal.com</a>
                    </p>
                </div>

                <!-- Links -->
                <div class="text-sm md:text-[15px] space-y-2">

                    <!-- Reusable Link -->
                    <a href="{{ route('rooms') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Rooms</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('eatdrink') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Eat & Drink</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('experiences') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Experience</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('gallery') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Gallery</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('about') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">About</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ route('contact') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">Contact</span>
                        <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                            viewBox="0 0 12 12">
                            <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                fill="currentColor" />
                        </svg>
                    </a>

                </div>

                <!-- CTA -->
                <div>
                    <p class="max-w-[560px] text-sm text-white/90 md:text-[16px]">
                        Book your stay today and discover seaside luxury, breathtaking views, and unforgettable moments.
                    </p>
                    <a href="{{ route('contact') }}"
                        class="mt-6 inline-flex bg-white px-5 py-3 text-sm uppercase tracking-[0.02em] text-black transition hover:bg-[#ececec] md:text-[16px]">
                        Book Your Stay
                    </a>
                </div>
            </div>

            <!-- Bottom -->
            <div class="mt-8 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap items-center gap-4 text-[11px] text-white/90 md:text-[15px]">
                    <a href="#" class="hover:underline">Cookies policy</a>
                    <a href="#" class="hover:underline">Privacy policy</a>
                    <a href="#" class="hover:underline">Terms of service</a>
                </div>

                <button id="backToTop"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-black transition hover:bg-[#ececec] p-3"
                    aria-label="Back to top">
                    <svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.707 13L12.707 1L0.707031 13" stroke="black" stroke-width="3"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div class="mt-4 border-t border-white/20"></div>

            <!-- Copyright -->
            <div
                class="mt-6 flex flex-col gap-3 text-[12px] text-white/90 md:flex-row md:items-center md:justify-between md:text-[14px]">
                <p>Hotel Jindal , &copy; 2026</p>
                <a href="https://www.volymoly.com/" class="inline-flex items-center gap-5">
                    <span>created by volymoly</span>
                    <img src="{{ asset('assets/svg/volymoly.svg') }}" alt="volymoly" class="h-auto w-[6rem] md:h-4" />
                </a>
            </div>

        </div>
    </footer>
@endsection

@section('scripts')
<script>
        @include('partials.public-header-scripts')
        backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>
@endsection

