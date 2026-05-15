@extends('layouts.app')

@section('title', 'Contact & Booking - Hotel Jindal')
@section('body_class', 'bg-[#111] font-body text-white')

@section('head')
<script src="https://cdn.tailwindcss.com"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

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

        /* Input styling */
        .input-field {
            width: 100%;
            border-bottom: 1px solid #ccc;
            padding: 12px 4px;
            background: transparent;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-field:focus {
            border-color: #1f1f1f;
        }

        .submit-disabled {
            cursor: not-allowed;
            opacity: 0.45;
        }

        .contact-toast {
            position: fixed;
            top: 12px;
            left: 50%;
            z-index: 80;
            width: min(460px, calc(100vw - 32px));
            transform: translate(-50%, -18px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.97);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.16);
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease, transform 180ms ease;
            backdrop-filter: blur(10px);
        }

        .contact-toast.is-visible {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        .contact-toast--success {
            border-left: 4px solid #1f1f1f;
        }

        .contact-toast--error {
            border-left: 4px solid #b42318;
        }
    </style>
@endsection

@section('content')
<!-- ================= NAVBAR ================= -->
    @include('partials.public-header')

    <!-- ================= HERO ================= -->
    <section class="relative min-h-screen flex items-center justify-center text-center">

        <img src="{{ asset('assets/bg/eat-drink.jpg') }}" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 px-5">
            <h1
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2]">
                CONTACT & BOOKINGS
            </h1>

            <!-- <a href="#book"
                class="mt-10 sm:mt-16 inline-flex items-center gap-3 text-[18px] bg-[#3c3c3c]/90 px-8 py-4 text-sm font-medium uppercase tracking-[0.08em] transition hover:bg-white hover:text-[#3c3c3c]">
                View Menu
            </a> -->
        </div>

    </section>

    <!-- ================= FORM SECTION ================= -->
    <section class="bg-[#f1f1f1] text-[#1f1f1f] py-20 px-5">

        <div class="max-w-[900px] mx-auto text-center">

            <h2 class="font-serifDisplay text-4xl md:text-5xl">
                PLAN YOUR STAY
            </h2>

            <p class="mt-6 text-[#444] leading-[1.7] max-w-[650px] mx-auto">
                Choose from our range of comfortable rooms and send us your booking request. Our team will confirm
                availability shortly.
            </p>

        </div>

        <!-- ================= ROOM TARIFF ================= -->
        <div class="max-w-[900px] mx-auto mt-16">

            <h3 class="font-serifDisplay text-[24px] text-center mb-8">
                ROOM TARIFF
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-[#ddd]">
                    <thead class="bg-[#e7e7e7] text-left">
                        <tr>
                            <th class="p-3 border">Room Type</th>
                            <th class="p-3 border">Single</th>
                            <th class="p-3 border">Double</th>
                            <th class="p-3 border">GST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3 border">AC Deluxe</td>
                            <td class="p-3 border">₹1850</td>
                            <td class="p-3 border">₹1850</td>
                            <td class="p-3 border">5%</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">AC Family</td>
                            <td class="p-3 border">₹1500</td>
                            <td class="p-3 border">₹1700</td>
                            <td class="p-3 border">5%</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">AC Executive</td>
                            <td class="p-3 border">₹1100</td>
                            <td class="p-3 border">₹1500</td>
                            <td class="p-3 border">5%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="mt-4 text-xs text-[#666] text-center">
                Extra person charge ₹300 (bed). GST 5% applicable.
            </p>

        </div>

        <!-- ================= FORM ================= -->
        <div class="max-w-[900px] mx-auto mt-16">

            <form id="contactInquiryForm" class="space-y-10">

                <!-- PERSONAL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="text-xs uppercase text-[#777]">Name</label>
                        <input type="text" name="name" placeholder="Your Name" class="input-field" />
                    </div>

                    <div>
                        <label class="text-xs uppercase text-[#777]">Email</label>
                        <input type="email" name="email" placeholder="Your Email" class="input-field" />
                    </div>

                    <div>
                        <label class="text-xs uppercase text-[#777]">Phone</label>
                        <input type="tel" name="phone" placeholder="Your Phone No." class="input-field" />
                    </div>
                </div>

                <!-- BOOKING -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>

                        <label class="text-xs uppercase text-[#777]">Arrival</label>
                        <input type="date" name="arrival_date" class="input-field" />
                    </div>
                    <div>
                        <label class="text-xs uppercase text-[#777]">Departure</label>
                        <input type="date" name="departure_date" class="input-field" />
                    </div>

                    <div>

                        <label class="text-xs uppercase text-[#777]">Adults</label>
                        <input type="number" name="adults" class="input-field" value="2" min="1" step="1" />
                    </div>
                    <div>
                        <label class="text-xs uppercase text-[#777]">Children</label>
                        <input type="number" name="children" class="input-field" value="0" min="0" step="1" />
                    </div>
                </div>

                <!-- ROOM -->
                <div>
                    <label class="text-xs uppercase text-[#777]">Room Category</label>
                    <select name="room_category" class="input-field mt-2">
                        <option value="AC Deluxe">AC Deluxe</option>
                        <option value="AC Family">AC Family</option>
                        <option value="AC Executive">AC Executive</option>
                    </select>
                </div>

                <!-- MESSAGE -->
                <div>
                    <textarea name="message" rows="4" placeholder="Your Message" class="input-field"></textarea>
                </div>

                <!-- TERMS -->
                <div class="flex items-start gap-2 text-sm text-[#555]">
                    <input id="contactInquiryTerms" name="agreed_to_terms" type="checkbox" value="1" />
                    <p>I agree to terms and conditions</p>
                </div>

                <div id="contactInquiryFeedback" class="hidden rounded-2xl px-5 py-4 text-sm"></div>

                <!-- CTA -->
                <div class="text-center">
                    <button id="contactInquirySubmitButton" type="submit" disabled class="submit-disabled bg-[#3c3c3c] px-10 py-4 text-sm uppercase text-white transition hover:bg-black">
                        Inquire Now
                    </button>
                </div>

            </form>

        </div>

        <!-- ================= CONTACT ================= -->
        <section class="bg-[#f1f1f1] text-[#1f1f1f] pt-20 text-center">
            <h2
                class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] uppercase">
                Contact</h2>
            <p class="mt-4">
                <a href="https://maps.app.goo.gl/QeYXXbVVUG7iEpG28"> Fawwara Chowk, Neemuch (M.P.)</a>
            </p>
            <p class="mt-3">
                <a href="tel:+919111684157"> Tel. +91 91116 84157</a>
            </p>
            <p class="mt-2">
                <a href="mailto:info@hoteljindal.com">info@hoteljindal.com</a>
            </p>
        </section>

    </section>

    <!-- ================= MAP ================= -->
    <section class="bg-[#f1f1f1] pb-16 text-[#1f1f1f] md:pb-20">
        <h2
            class="font-serifDisplay text-4xl font-normal sm:text-5xl lg:text-5xl 2xl:text-6xl lg:leading-[1.2] 2xl:leading-[1.2] uppercase text-center mb-10">
            Find Us</h2>

        <div
            class="mx-auto px-5 md:px-10 lg:px-16 xl:px-20 2xl:px-24 w-full h-[300px] md:h-[400px] lg:h-[500px] xl:h-[500px] 2xl:h-[600px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2159.515196484195!2d74.87335116676972!3d24.45574010395511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e58cc2eeb089%3A0x52bd798a1d843c1!2sHotel%20Jindal!5e0!3m2!1sen!2sin!4v1777188149897!5m2!1sen!2sin"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <div id="contactToast" class="contact-toast hidden" role="status" aria-live="polite">
        <div class="px-4 py-3">
            <p id="contactToastTitle" class="text-sm font-semibold text-[#1f1f1f]"></p>
            <p id="contactToastMessage" class="mt-1 text-sm leading-6 text-[#555]"></p>
        </div>
    </div>

    @include('partials.public-footer')
@endsection

@section('scripts')
<script>
        const contactInquiryStoreUrl = '{{ route('api.contact-inquiries.store') }}';
        const contactInquiryForm = document.getElementById('contactInquiryForm');
        const contactInquiryTerms = document.getElementById('contactInquiryTerms');
        const contactInquirySubmitButton = document.getElementById('contactInquirySubmitButton');
        const contactInquiryFeedback = document.getElementById('contactInquiryFeedback');
        const contactToast = document.getElementById('contactToast');
        const contactToastTitle = document.getElementById('contactToastTitle');
        const contactToastMessage = document.getElementById('contactToastMessage');
        let contactToastTimer = null;
        @include('partials.public-header-scripts')
        @include('partials.public-footer-scripts')

        const syncContactInquirySubmitState = () => {
            const isChecked = contactInquiryTerms.checked;
            contactInquirySubmitButton.disabled = !isChecked;
            contactInquirySubmitButton.classList.toggle('submit-disabled', !isChecked);
        };
    </script>

<script>
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener("input", () => {
                if (input.value < input.min) {
                    input.value = input.min;
                }
            });
        });

        contactInquiryTerms.addEventListener('change', syncContactInquirySubmitState);
        syncContactInquirySubmitState();

        const setContactInquiryFeedback = (message, type) => {
            contactInquiryFeedback.textContent = message;
            contactInquiryFeedback.classList.remove('hidden', 'bg-brand-50', 'text-brand-700', 'border', 'border-brand-100', 'bg-red-50', 'text-red-700', 'border-red-100');
            if (type === 'success') {
                contactInquiryFeedback.classList.add('bg-brand-50', 'text-brand-700', 'border', 'border-brand-100');
            } else {
                contactInquiryFeedback.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-100');
            }
        };

        contactInquiryForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!contactInquiryTerms.checked) {
                syncContactInquirySubmitState();
                return;
            }

            contactInquirySubmitButton.disabled = true;
            contactInquirySubmitButton.classList.add('submit-disabled');
            contactInquirySubmitButton.textContent = 'Submitting...';
            contactInquiryFeedback.classList.add('hidden');

            const formData = new FormData(contactInquiryForm);
            const payload = Object.fromEntries(formData.entries());
            payload.agreed_to_terms = contactInquiryTerms.checked ? '1' : '0';
            payload.adults = payload.adults || '2';
            payload.children = payload.children || '0';

            try {
                const response = await fetch(contactInquiryStoreUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();

                if (!response.ok) {
                    const errorMessage = data.message || Object.values(data.errors || {}).flat()[0] || 'Inquiry submit failed.';
                    throw new Error(errorMessage);
                }

                contactInquiryForm.reset();
                contactInquiryFeedback.classList.add('hidden');
                const smsSent = Boolean(data?.data?.sms_sent);
                showContactToast({
                    type: 'success',
                    title: 'Inquiry Sent',
                    message: smsSent
                        ? 'Thank you for contacting Hotel Jindal. Your request has been saved and a confirmation SMS has been sent.'
                        : 'Thank you for contacting Hotel Jindal. Your request has been saved successfully. We will get in touch with you soon.',
                });
            } catch (error) {
                contactInquiryFeedback.classList.add('hidden');
                showContactToast({
                    type: 'error',
                    title: 'Submission Failed',
                    message: error.message || 'We could not submit your inquiry right now. Please try again or call +91 91116 84157.',
                });
            } finally {
                contactInquirySubmitButton.textContent = 'Inquire Now';
                syncContactInquirySubmitState();
            }
        });

        function showContactToast({ type = 'success', title = '', message = '' }) {
            if (!contactToast || !contactToastTitle || !contactToastMessage) {
                return;
            }

            if (contactToastTimer) {
                clearTimeout(contactToastTimer);
            }

            contactToast.classList.remove('hidden', 'contact-toast--success', 'contact-toast--error');
            contactToast.classList.add(type === 'error' ? 'contact-toast--error' : 'contact-toast--success');
            contactToastTitle.textContent = title;
            contactToastMessage.textContent = message;

            requestAnimationFrame(() => {
                contactToast.classList.add('is-visible');
            });

            contactToastTimer = setTimeout(() => {
                contactToast.classList.remove('is-visible');
                setTimeout(() => {
                    contactToast.classList.add('hidden');
                }, 180);
            }, 4200);
        }
    </script>
@endsection

