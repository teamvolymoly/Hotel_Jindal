@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')

@section('head')
    <script>
        window.adminContactInquiriesIndexApiUrl = '{{ route('api.admin.contact-inquiries.index') }}';
        window.adminContactInquiriesShowApiTemplate = '{{ route('api.admin.contact-inquiries.show', ['contactInquiry' => '__INQUIRY_ID__']) }}';
    </script>
@endsection

@section('content')
    <div class="border border-line bg-white p-5">
        <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_auto]">
            <div>
                <label for="contactInquiriesSearch" class="mb-2 block text-xs font-medium uppercase tracking-[0.08em] text-muted">Search</label>
                <input id="contactInquiriesSearch" type="text" placeholder="Search by name, email, or phone"
                       class="w-full border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
            </div>

            <div class="flex items-end gap-3">
                <button type="button" id="contactInquiriesApplyFilters" class="bg-brand-500 px-5 py-3 font-semibold text-white transition hover:bg-brand-600">Apply</button>
                <button type="button" id="contactInquiriesResetFilters" class="border border-line px-5 py-3 font-semibold transition hover:bg-shell">Reset</button>
            </div>
        </div>
    </div>

    <div class="mt-8 overflow-hidden border border-line bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-shell">
                    <tr class="text-left text-sm uppercase tracking-[0.18em] text-muted">
                        <th class="px-6 py-4">Guest</th>
                        <th class="px-6 py-4">Stay</th>
                        <th class="px-6 py-4">Guests</th>
                        <th class="px-6 py-4">Room</th>
                        <th class="px-6 py-4">Submitted</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="contactInquiriesTableBody" class="divide-y divide-line">
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-muted">Loading inquiries...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="contactInquiryDetailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4 py-6">
        <div class="flex max-h-[88vh] w-full max-w-3xl flex-col bg-white shadow-panel">
            <div class="flex items-center justify-between border-b border-line px-6 py-5">
                <h2>Inquiry Details</h2>
                <button type="button" onclick="closeContactInquiryDetailModal()" class="grid h-11 w-11 place-items-center text-4xl leading-none text-muted transition hover:bg-shell hover:text-ink" aria-label="Close inquiry details">&times;</button>
            </div>
            <div id="contactInquiryDetailContent" class="overflow-y-auto px-6 py-5 text-muted">
                Loading...
            </div>
        </div>
    </div>

    <script>
        const contactInquiriesTableBody = document.getElementById('contactInquiriesTableBody');
        const contactInquiryDetailModal = document.getElementById('contactInquiryDetailModal');
        const contactInquiryDetailContent = document.getElementById('contactInquiryDetailContent');
        const contactInquiriesSearchInput = document.getElementById('contactInquiriesSearch');
        const contactInquiriesApplyFiltersButton = document.getElementById('contactInquiriesApplyFilters');
        const contactInquiriesResetFiltersButton = document.getElementById('contactInquiriesResetFilters');

        let currentContactInquiryFilters = {
            q: '',
        };

        const buildContactInquiryShowRoute = (inquiryId) => window.adminContactInquiriesShowApiTemplate.replace('__INQUIRY_ID__', inquiryId);
        const formatDate = (value) => value ? new Date(value).toLocaleDateString() : '-';
        const formatDateTime = (value) => value ? new Date(value).toLocaleString() : '-';

        const escapeHtml = (value) => String(value ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

        const renderContactInquiries = (inquiries) => {
            if (!inquiries.length) {
                contactInquiriesTableBody.innerHTML = '<tr><td colspan="6" class="px-6 py-10 text-center text-muted">No inquiries found.</td></tr>';
                return;
            }

            contactInquiriesTableBody.innerHTML = inquiries.map((inquiry) => `
                <tr>
                    <td class="px-6 py-5">
                        <div class="font-number text-xs text-muted">#${inquiry.id}</div>
                        <div class="mt-1 font-semibold">${escapeHtml(inquiry.name)}</div>
                        <div class="mt-1 text-muted">${escapeHtml(inquiry.email)}</div>
                        <div class="mt-1 text-muted">${escapeHtml(inquiry.phone)}</div>
                    </td>
                    <td class="px-6 py-5 text-muted">
                        <div class="grid grid-cols-[80px_1fr] gap-2"><span>Arrival</span><strong class="font-number font-medium text-ink">${formatDate(inquiry.arrival_date)}</strong></div>
                        <div class="mt-1 grid grid-cols-[80px_1fr] gap-2"><span>Departure</span><strong class="font-number font-medium text-ink">${formatDate(inquiry.departure_date)}</strong></div>
                    </td>
                    <td class="px-6 py-5 text-muted">
                        <div class="grid grid-cols-[70px_1fr] gap-2"><span>Adults</span><strong class="font-number font-medium text-ink">${inquiry.adults}</strong></div>
                        <div class="mt-1 grid grid-cols-[70px_1fr] gap-2"><span>Children</span><strong class="font-number font-medium text-ink">${inquiry.children}</strong></div>
                    </td>
                    <td class="px-6 py-5 text-muted">${escapeHtml(inquiry.room_category)}</td>
                    <td class="px-6 py-5 font-number text-muted">${formatDateTime(inquiry.created_at)}</td>
                    <td class="px-6 py-5 text-right">
                        <button type="button" onclick="showContactInquiryDetails(${inquiry.id})" class="border border-line px-4 py-2 font-semibold transition hover:bg-shell">View</button>
                    </td>
                </tr>
            `).join('');
        };

        const loadContactInquiries = async () => {
            try {
                const query = new URLSearchParams();

                if (currentContactInquiryFilters.q) {
                    query.set('q', currentContactInquiryFilters.q);
                }

                const response = await fetch(`${window.adminContactInquiriesIndexApiUrl}${query.toString() ? `?${query.toString()}` : ''}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load inquiries.');
                }

                const payload = await response.json();
                renderContactInquiries(payload.data ?? []);
            } catch (error) {
                contactInquiriesTableBody.innerHTML = '<tr><td colspan="6" class="px-6 py-10 text-center text-muted">Inquiries could not be loaded.</td></tr>';
            }
        };

        const applyContactInquiryFilters = () => {
            currentContactInquiryFilters = {
                q: contactInquiriesSearchInput.value.trim(),
            };

            loadContactInquiries();
        };

        const showContactInquiryDetails = async (inquiryId) => {
            contactInquiryDetailModal.classList.remove('hidden');
            contactInquiryDetailModal.classList.add('flex');
            contactInquiryDetailContent.innerHTML = 'Loading...';

            try {
                const response = await fetch(buildContactInquiryShowRoute(inquiryId), {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load inquiry details.');
                }

                const payload = await response.json();
                const inquiry = payload.data;

                contactInquiryDetailContent.innerHTML = `
                    <div class="space-y-6">
                        <div class="grid border border-line md:grid-cols-2">
                            ${[
                                ['Name', escapeHtml(inquiry.name)],
                                ['Phone', escapeHtml(inquiry.phone)],
                                ['Email', escapeHtml(inquiry.email)],
                                ['Room Category', escapeHtml(inquiry.room_category)],
                                ['Arrival', formatDate(inquiry.arrival_date)],
                                ['Departure', formatDate(inquiry.departure_date)],
                                ['Adults', inquiry.adults],
                                ['Children', inquiry.children],
                                ['Terms Accepted', inquiry.agreed_to_terms ? 'Yes' : 'No'],
                                ['Submitted', formatDateTime(inquiry.created_at)]
                            ].map(([label, value]) => `
                                <div class="border-b border-line px-4 py-3 md:border-r md:even:border-r-0">
                                    <p class="text-xs uppercase tracking-[0.08em] text-muted">${label}</p>
                                    <p class="mt-1 font-medium text-ink">${value}</p>
                                </div>
                            `).join('')}
                        </div>
                        <div class="border border-line bg-shell px-5 py-4">
                            <p class="mb-2 font-semibold text-ink">Message</p>
                            <p class="whitespace-pre-line text-sm leading-7 text-muted">${escapeHtml(inquiry.message || 'No message added.')}</p>
                        </div>
                    </div>
                `;
            } catch (error) {
                contactInquiryDetailContent.innerHTML = 'Inquiry details could not be loaded.';
            }
        };

        function closeContactInquiryDetailModal() {
            contactInquiryDetailModal.classList.add('hidden');
            contactInquiryDetailModal.classList.remove('flex');
        }

        contactInquiriesApplyFiltersButton.addEventListener('click', applyContactInquiryFilters);
        contactInquiriesResetFiltersButton.addEventListener('click', () => {
            contactInquiriesSearchInput.value = '';
            currentContactInquiryFilters = { q: '' };
            loadContactInquiries();
        });
        contactInquiriesSearchInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                applyContactInquiryFilters();
            }
        });

        loadContactInquiries();
    </script>
@endsection
