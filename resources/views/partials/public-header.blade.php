@php
    $isRooms = request()->routeIs('rooms');
    $isEatDrink = request()->routeIs('eatdrink');
    $isExperiences = request()->routeIs('experiences');
    $isGallery = request()->routeIs('gallery');
    $isAbout = request()->routeIs('about');
    $isContact = request()->routeIs('contact');
@endphp

@once
    @php
        $navIndicator = function (bool $active = false) {
            if (! $active) {
                return '<span class="mt-[6px] inline-flex h-[12px] w-[12px] opacity-0" aria-hidden="true"></span>';
            }

            return <<<'HTML'
<span class="mt-[6px] inline-flex h-[12px] w-[12px]" aria-hidden="true">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
    </svg>
</span>
HTML;
        };
    @endphp
@endonce

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
                    class="group -mb-4 inline-flex appearance-none flex-col items-center border-0 bg-transparent p-0 pb-4 leading-none text-left text-inherit shadow-none outline-none"
                    aria-label="Rooms menu" aria-expanded="false">
                    <span
                        class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Rooms
                        <span class="ml-1 inline-flex align-middle" aria-hidden="true">
                            <svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0942 0.625L6.35962 6.35962L0.625 0.625" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </span>
                    {!! $navIndicator($isRooms) !!}
                </button>
                <a href="{{ route('eatdrink') }}" class="group inline-flex flex-col items-center leading-none">
                    <span
                        class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Eat
                        &amp; Drink</span>
                    {!! $navIndicator($isEatDrink) !!}
                </a>
                <a href="{{ route('experiences') }}" class="group inline-flex flex-col items-center leading-none">
                    <span
                        class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Experiences</span>
                    {!! $navIndicator($isExperiences) !!}
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
                    {!! $navIndicator($isGallery) !!}
                </a>
                <a href="{{ route('about') }}" class="group inline-flex flex-col items-center leading-none">
                    <span
                        class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">About</span>
                    {!! $navIndicator($isAbout) !!}
                </a>
                <a href="{{ route('contact') }}" class="group inline-flex flex-col items-center leading-none">
                    <span
                        class="text-[12px] 2xl:text-[14px] uppercase tracking-[0.06em] text-current transition group-hover:opacity-75">Contact</span>
                    {!! $navIndicator($isContact) !!}
                </a>
            </nav>

            <div class="w-[56px] md:hidden"></div>
        </div>
    </div>

    <div id="mobileMenu" class="hidden border-t border-white/20 bg-black/55 backdrop-blur-sm md:hidden">
        <div class="mx-auto flex w-full flex-col gap-4 px-5 py-5 text-center md:px-10 lg:px-16 xl:px-20 2xl:px-24">
            <a href="{{ route('rooms') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Rooms</a>
            <a href="{{ route('eatdrink') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Eat &amp; Drink</a>
            <a href="{{ route('experiences') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Experiences</a>
            <a href="{{ route('gallery') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Gallery</a>
            <a href="{{ route('about') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">About</a>
            <a href="{{ route('contact') }}" class="text-xs uppercase tracking-[0.06em] text-white/95">Contact</a>
        </div>
    </div>

    <div id="roomsMenu" class="hidden bg-[#f1f1f1] text-[#1f1f1f]">
        <div class="mx-auto w-full px-5 py-10 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
            <div class="grid grid-cols-3 gap-4">
                <a href="{{ route('rooms') }}" class="group block">
                    <img src="{{ asset('assets/rooms/deluxe.png') }}" alt="Deluxe Room" class="h-[200px] w-full object-cover" />
                    <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                        <span class="uppercase">Deluxe</span>
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                    </span>
                </a>
                <a href="{{ route('rooms') }}" class="group block">
                    <img src="{{ asset('assets/rooms/family.png') }}" alt="Family Room" class="h-[200px] w-full object-cover" />
                    <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                        <span class="uppercase">Family</span>
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                    </span>
                </a>
                <a href="{{ route('rooms') }}" class="group block">
                    <img src="{{ asset('assets/rooms/executive.png') }}" alt="Executive Room"
                        class="h-[200px] w-full object-cover" />
                    <span class="mt-3 inline-flex w-full items-center justify-center gap-2 text-base text-[#1f1f1f]">
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                        <span class="uppercase">Executive</span>
                        <span class="inline-flex h-3 w-3 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                            aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.65674" y="0.707107" width="7" height="7" transform="rotate(45 5.65674 0.707107)"
                                    stroke="black" />
                            </svg>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
