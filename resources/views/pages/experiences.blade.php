@extends('layouts.app')

@section('title', 'Experiences - Hotel Jindal')
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
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR ================= -->
    <header class="absolute inset-x-0 top-0 z-30">
        <div id="navBg" class="transition-colors duration-200">
            <div id="navShell"
                class="mx-auto flex w-full items-center justify-between px-5 py-6 text-white transition-colors duration-200 md:px-10 lg:px-16 xl:px-20 2xl:px-24 md:py-7">

                <button id="menuButton"
                    class="inline-flex items-center justify-center rounded border border-white/40 px-2 py-1 text-xs uppercase tracking-[0.15em] md:hidden">
                    Menu
                </button>

                <nav class="hidden flex-1 items-start gap-8 pt-1 md:flex lg:gap-12 2xl:gap-16">
                    <button id="roomsToggle" type="button"
                        class="group -mb-4 inline-flex flex-col items-center pb-4 leading-none text-left"
                        aria-label="Rooms menu" aria-expanded="false">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Rooms
                            <span class="ml-1 inline-flex align-middle" aria-hidden="true">
                                <svg width="13" height="7" viewBox="0 0 13 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </button>
                    <a href="{{ route('eatdrink') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Eat
                            &amp; Drink</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </a>
                    <a href="{{ route('experiences') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Experiences</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px]" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </a>
                </nav>

                <a href="{{ route('home') }}"
                    class="shrink-0 px-2 text-center font-serifDisplay text-[31px] leading-[1] tracking-[0.03em] md:px-6 md:text-[32px] 2xl:text-[40px]">
                    <span class="block">HOTEL</span>
                    <span class="block">JINDAL</span>
                </a>

                <nav class="hidden flex-1 items-start justify-end gap-8 pt-1 md:flex lg:gap-10">
                    <a href="{{ route('gallery') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Gallery</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </a>
                    <a href="{{ route('about') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">About</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="group inline-flex flex-col items-center leading-none">
                        <span
                            class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Contact</span>
                        <span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>
                    </a>
                </nav>

                <div class="w-[56px] md:hidden"></div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden border-t border-white/20 bg-black/55 backdrop-blur-sm md:hidden">
            <div class="mx-auto flex w-full flex-col gap-4 px-5 py-5 text-center">
                <a href="{{ route('rooms') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Rooms</a>
                <a href="{{ route('eatdrink') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Eat &amp; Drink</a>
                <a href="{{ route('experiences') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Experiences</a>
                <a href="{{ route('gallery') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Gallery</a>
                <a href="{{ route('about') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">About</a>
                <a href="{{ route('contact') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Contact</a>
            </div>
        </div>

        <!-- Rooms dropdown -->
        <div id="roomsMenu" class="hidden bg-[#f1f1f1] text-[#1f1f1f]">
            <div class="mx-auto w-full px-5 py-10 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
                <div class="grid grid-cols-3 gap-4">
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room" class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Deluxe</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Room" class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Family</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('rooms') }}" class="group block">
                        <img src="{{ asset('assets/rooms/executive.png') }}" alt="Executive Room"
                            class="h-[200px] w-full object-cover" />
                        <span
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                            <span class="uppercase">Executive</span>
                            <span
                                class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="5.65674" y="0.707107" width="7" height="7"
                                        transform="rotate(45 5.65674 0.707107)" stroke="black" />
                                </svg>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    <main class="relative min-h-screen overflow-hidden text-white">
        <div
            class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(0,0,0,0.30)_0%,rgba(0,0,0,0.18)_40%,rgba(0,0,0,0.42)_100%),url('{{ asset('assets/rooms/deluxe.png') }}')] bg-cover bg-center bg-no-repeat">
        </div>

        <div
            class="relative z-10 flex min-h-screen flex-col items-center justify-center px-5 pb-14 pt-24 text-center sm:mt-16">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                EXPERIENCES
            </h1>
            <a href="{{ route('contact') }}"
                class="mt-10 sm:mt-16 inline-flex text-[18px] items-center gap-3 bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
                Book Now
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 15H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M15 7.5L22.5 15L15 22.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </main>

    <!-- ================= INTRO ================= -->
    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 px-5 text-center">
        <div class="mx-auto max-w-[900px]">

            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                Home &nbsp; &gt; &nbsp; Experiences
            </p>

            <h2
                class="mt-6 font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                MUST-SEE NEARBY<br />WONDERS
            </h2>

            <p class="mt-6 text-[16px] md:text-[18px] leading-[1.7] text-[#4a4a4a]">
                Nimach is more than just a city — it is an experience waiting to be discovered. From centuries-old
                temples and historic landmarks to breathtaking natural scenery, there is something here for every kind
                of traveler.
            </p>

        </div>
    </section>

    <!-- ================= CARDS GRID ================= -->
    <section class="bg-[#f1f1f1] pb-20 px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 text-[#1f1f1f]">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            <!-- CARD -->
            <div>
                <img src="{{ asset('assets/places/new-img-pashupatinath-temple.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Pashupatinath Temple</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Located by the banks of Shivna River, this unique temple depicts Lord Shiva in eight forms.
                </p>
                <a href="https://maps.app.goo.gl/Ex9qVdebMbAJmiWo7" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/buddhist caves.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Buddhist Caves</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Dating back to the 5th century AD, these caves are a prominent historical attraction.
                </p>
                <a href="https://maps.app.goo.gl/BE9DbCfZuF2yXCGR7" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Gandhisagar-Sanctuary.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Gandhisagar Sanctuary</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    Spread across vast land, a must-visit destination for nature lovers and wildlife enthusiasts.
                </p>
                <a href="https://maps.app.goo.gl/4NtbL7wbySHTy9Bv5" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Mandsaur-Fort.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Mandsaur Fort</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    A historic fort reflecting the rich heritage of the region.
                </p>
                <a href="https://maps.app.goo.gl/4VXWRvdDiMJEV79E6" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/Neemuch-img-1.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Neemuch</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    A beautiful cantonment city known for scenic views and calm surroundings.
                </p>
                <a href="https://maps.app.goo.gl/GTbxJX4E5hjypkDj9" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

            <div>
                <img src="{{ asset('assets/places/gandhisagar-dam.webp') }}" class="h-[200px] w-full object-cover" />
                <h3 class="mt-4 font-serifDisplay text-[26px] leading-[1.2]">Gandhisagar Dam</h3>
                <p class="text-[14px] leading-[1.4] 2xl:text-[16px] mt-1">24km</p>
                <p class="mt-3 text-[14px] leading-[1.4] 2xl:text-[16px] text-[#555]">
                    One of the largest dams offering scenic views and peaceful surroundings.
                </p>
                <a href="https://maps.app.goo.gl/MwQ831VVCTHFtbi86" target="_blank"
                    class="mt-3 inline-block text-[14px] leading-[1.4] 2xl:text-[16px] underline">View on Google
                    Maps</a>
            </div>

        </div>

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
        /* ── Nav: mobile menu toggle ── */
        const menuButton = document.getElementById("menuButton");
        const mobileMenu = document.getElementById("mobileMenu");
        menuButton.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));

        /* ── Nav: rooms dropdown ── */
        const navBg = document.getElementById("navBg");
        const navShell = document.getElementById("navShell");
        const roomsToggle = document.getElementById("roomsToggle");
        const roomsMenu = document.getElementById("roomsMenu");

        const setRoomsNavTheme = (isOpen) => {
            navBg.classList.toggle("bg-[#f1f1f1]", isOpen);
            navShell.classList.toggle("text-black", isOpen);
            navShell.classList.toggle("text-white", !isOpen);
        };
        const openRoomsMenu = () => { roomsMenu.classList.remove("hidden"); roomsToggle.setAttribute("aria-expanded", "true"); setRoomsNavTheme(true); };
        const closeRoomsMenu = () => { roomsMenu.classList.add("hidden"); roomsToggle.setAttribute("aria-expanded", "false"); setRoomsNavTheme(false); };

        let roomsCloseTimer;
        const clearTimer = () => { if (roomsCloseTimer) { clearTimeout(roomsCloseTimer); roomsCloseTimer = null; } };
        const scheduleClose = () => { clearTimer(); roomsCloseTimer = setTimeout(closeRoomsMenu, 220); };

        roomsToggle.addEventListener("mouseenter", () => { clearTimer(); openRoomsMenu(); });
        roomsToggle.addEventListener("mouseleave", scheduleClose);
        roomsMenu.addEventListener("mouseenter", () => { clearTimer(); openRoomsMenu(); });
        roomsMenu.addEventListener("mouseleave", scheduleClose);
        document.addEventListener("click", closeRoomsMenu);
        document.addEventListener("keydown", (e) => { if (e.key === "Escape") closeRoomsMenu(); });

        /* ── Room image Swiper ── */
        const total = 4;
        const currentEl = document.getElementById("slideCurrentNum");
        const totalEl = document.getElementById("slideTotalNum");
        totalEl.textContent = String(total).padStart(2, "0");

        const roomSwiper = new Swiper(".room-swiper", {
            loop: true,
            speed: 700,
            navigation: {
                nextEl: "#roomNext",
                prevEl: "#roomPrev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            on: {
                slideChange() {
                    const real = ((this.realIndex) % total) + 1;
                    currentEl.textContent = String(real).padStart(2, "0");
                }
            }
        });

        /* ── Back to top ── */
        document.getElementById("backToTop").addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

        /* ── Scroll reveal ── */
        const revealEls = document.querySelectorAll(".reveal");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach((el) => observer.observe(el));
    </script>
@endsection
