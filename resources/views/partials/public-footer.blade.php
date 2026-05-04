<footer class="bg-black py-8 text-white md:py-10">
    <div class="mx-auto w-full px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
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

        <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-[1.2fr_0.6fr_1.4fr]">
            <div>
                <p class="mt-4 text-sm text-white/90 md:text-[16px]">Fawwara Chowk, Neemuch (M.P.)</p>
                <p class="mt-3 text-sm text-white/90 md:text-[16px]">
                    <a href="tel:9111684157">Tel. +91 91116 84157</a>
                </p>
                <p class="mt-1 text-sm text-white/90 md:text-[16px]">
                    <a href="mailto:info@hoteljindal.com">info@hoteljindal.com</a>
                </p>
            </div>

            <div class="space-y-2 text-sm md:text-[15px]">
                <a href="{{ route('rooms') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Rooms</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>

                <a href="{{ route('eatdrink') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Eat &amp; Drink</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>

                <a href="{{ route('experiences') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Experience</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>

                <a href="{{ route('gallery') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Gallery</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>

                <a href="{{ route('about') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">About</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>

                <a href="{{ route('contact') }}" class="group flex items-center gap-4 transition hover:opacity-75">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Contact</span>
                    <svg class="h-2 w-2 opacity-0 -translate-x-1 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                        viewBox="0 0 12 12">
                        <rect x="5.65674" width="8" height="8" transform="rotate(45 5.65674 0)" fill="currentColor" />
                    </svg>
                </a>
            </div>

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

        <div class="mt-8 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-wrap items-center gap-4 text-[11px] text-white/90 md:text-[15px]">
                <a href="#" class="hover:underline">Cookies policy</a>
                <a href="#" class="hover:underline">Privacy policy</a>
                <a href="#" class="hover:underline">Terms of service</a>
            </div>

            <button id="backToTop"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white p-3 text-black transition hover:bg-[#ececec]"
                aria-label="Back to top">
                <svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.707 13L12.707 1L0.707031 13" stroke="black" stroke-width="3" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="mt-4 border-t border-white/20"></div>

        <div class="mt-6 flex flex-col gap-3 text-[12px] text-white/90 md:flex-row md:items-center md:justify-between md:text-[14px]">
            <p>Hotel Jindal , &copy; 2026</p>
            <a href="https://www.volymoly.com/" class="inline-flex items-center gap-5">
                <span>created by volymoly</span>
                <img src="{{ asset('assets/svg/volymoly.svg') }}" alt="volymoly" class="h-auto w-[6rem] md:h-4" />
            </a>
        </div>
    </div>
</footer>
