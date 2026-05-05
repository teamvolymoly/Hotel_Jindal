<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serifDisplay: ["Gilda Display", "serif"],
                        body: ["42dot Sans", "sans-serif"]
                    },
                    colors: {
                        brand: {
                            50: '#f1f1f1',
                            100: '#e7e7e7',
                            500: '#3c3c3c',
                            600: '#2f2f2f',
                        },
                        shell: '#f1f1f1',
                        ink: '#1f1f1f',
                        muted: '#6f6a64',
                        line: '#d6d0c8',
                    }
                }
            }
        };
    </script>
    <style>
        @font-face {
            font-family: "Gilda Display";
            src: url("{{ asset('assets/fonts/GildaDisplay-Regular.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 400;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsanswght.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 300 800;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-light.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 300;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-regular.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 400;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-medium.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 500;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-bold.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 700;
            font-display: swap;
        }

        @font-face {
            font-family: "42dot Sans";
            src: url("{{ asset('assets/fonts/42dotsans-extrabold.ttf') }}") format("truetype");
            font-style: normal;
            font-weight: 800;
            font-display: swap;
        }

        body,
        button,
        input {
            font-family: "42dot Sans", sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-black font-body text-white antialiased">
    <main class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(0,0,0,0.46)_0%,rgba(0,0,0,0.38)_45%,rgba(0,0,0,0.72)_100%),url('{{ asset('assets/bg/hero-bg.jpg') }}')] bg-cover bg-center"></div>

        <div class="relative z-10 flex min-h-screen flex-col">
            <header class="mx-auto flex w-full items-center justify-center px-5 py-7 md:px-10 lg:px-16 xl:px-20 2xl:px-24">
                <a href="{{ route('home') }}" class="text-center font-serifDisplay text-[31px] leading-[1] tracking-[0.03em] md:text-[32px]">
                    <span class="block">HOTEL</span>
                    <span class="block">JINDAL</span>
                </a>
            </header>

            <section class="flex flex-1 items-center justify-center px-5 pb-12 pt-6">
                <div class="w-full max-w-md border border-gray-500 bg-black/42 p-7 shadow-2xl shadow-black/20 backdrop-blur-md md:p-8">
                    <p class="text-xs uppercase text-white/72">Admin Login</p>
                    <h1 class="mt-4 font-serifDisplay text-4xl font-normal leading-none md:text-5xl">Welcome back</h1>
                    <p class="mt-4 text-sm leading-6 text-white/78">Use your admin credentials to continue.</p>

                    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-white/90">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                   class="w-full border border-white/24 bg-white/92 px-4 py-3.5 text-black outline-none transition focus:border-white focus:ring-2 focus:ring-white/30">
                            @error('email')
                                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-white/90">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password"
                                       class="w-full border border-white/24 bg-white/92 px-4 py-3.5 pr-12 text-black outline-none transition focus:border-white focus:ring-2 focus:ring-white/30">
                                <button type="button" data-password-toggle data-show-label="Show password" data-hide-label="Hide password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-black/65 transition hover:text-black focus:outline-none">
                                    <svg data-eye-open xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                                    </svg>
                                    <svg data-eye-closed xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.584 10.587A2.25 2.25 0 0 0 12 14.25a2.25 2.25 0 0 0 2.25-2.25c0-.519-.175-.997-.47-1.378m-3.196-.035A9.718 9.718 0 0 1 12 10.5c4.478 0 8.268 2.943 9.542 7a9.76 9.76 0 0 1-4.174 5.145M6.228 6.228A9.756 9.756 0 0 0 2.458 12c1.274 4.057 5.065 7 9.542 7 1.563 0 3.056-.36 4.386-1.004M6.228 6.228 3 3m3.228 3.228A9.71 9.71 0 0 1 12 4.5c4.477 0 8.268 2.943 9.542 7a9.721 9.721 0 0 1-1.189 2.447" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-3 text-sm text-white/75">
                            <input type="checkbox" name="remember" class="h-4 w-4 border-white/40 bg-transparent text-brand-500 focus:ring-white/30">
                            Keep me signed in
                        </label>

                        <button type="submit" class="w-full bg-white px-5 py-4 text-base font-semibold uppercase tracking-[0.04em] text-black transition hover:bg-[#ececec]">
                            Sign In
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const wrapper = button.parentElement;
                const input = wrapper.querySelector('input');
                const eyeOpen = button.querySelector('[data-eye-open]');
                const eyeClosed = button.querySelector('[data-eye-closed]');
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';
                button.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
                button.setAttribute('aria-label', isHidden ? button.dataset.hideLabel : button.dataset.showLabel);
                eyeOpen.classList.toggle('hidden', isHidden);
                eyeClosed.classList.toggle('hidden', !isHidden);
            });
        });
    </script>
</body>
</html>
