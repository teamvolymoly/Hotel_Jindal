@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('head')
    <script>
        window.adminDashboardApiUrl = '{{ route('api.admin.dashboard') }}';
    </script>
@endsection
 
@section('content')
    <div id="dashboardStats" class="grid gap-4 xl:grid-cols-4 md:grid-cols-2">
        <div class="border border-line bg-white p-5">
            <div class="flex items-center justify-between gap-4 border-b border-line pb-3">
                <h2>Total Orders</h2>
               <a href="{{ route('admin.menu-orders.index') }}" class="inline-block">
                    <img src="{{ asset('assets/icons/arrow_13911670.png') }}" 
                        alt="View" 
                        class="w-4 h-4 inline transition hover:scale-110">
                </a>
            </div>
            <p class="mt-4 font-number" data-stat="total_orders">0</p>
            <p class="mt-2 text-muted">All food orders placed from the menu.</p>
        </div>

        <div class="border border-line bg-white p-5">
            <div class="flex items-center justify-between gap-4 border-b border-line pb-3">
                <h2>This Month Revenue</h2>
                <a href="{{ route('admin.menu-orders.index') }}" class="inline-block">
                    <img src="{{ asset('assets/icons/arrow_13911670.png') }}" 
                        alt="View" 
                        class="w-4 h-4 inline transition hover:scale-110">
                </a>
            </div>
            <p class="mt-4 font-number" data-stat="total_revenue">Rs. 0</p>
            <p class="mt-2 text-muted">Current month completed orders revenue only.</p>
        </div>

        <div class="border border-line bg-white p-5">
            <div class="flex items-center justify-between gap-4 border-b border-line pb-3">
                <h2>Weekly Inquiries</h2>
                <a href="{{ route('admin.contact-inquiries.index') }}" class="inline-block">
                    <img src="{{ asset('assets/icons/arrow_13911670.png') }}" 
                        alt="View" 
                        class="w-4 h-4 inline transition hover:scale-110">
                </a>
            </div>
            <p class="mt-4 font-number" data-stat="weekly_inquiries">0</p>
            <p class="mt-2 text-muted">Booking inquiries received in the last 7 days.</p>
        </div>

        <div class="border border-line bg-white p-5">
            <div class="flex items-center justify-between gap-4 border-b border-line pb-3">
                <h2>Menu Items</h2>
                <a href="{{ route('admin.menu-items.index') }}" class="inline-block">
                    <img src="{{ asset('assets/icons/arrow_13911670.png') }}" 
                        alt="View" 
                        class="w-4 h-4 inline transition hover:scale-110">
                </a>
            </div>
            <p class="mt-4 font-number" data-stat="total_menu_items">0</p>
            <p class="mt-2 text-muted">Number of menu items available in admin.</p>
        </div>
    </div>

    <div class="mt-6">
        <section class="border border-line bg-white p-5">
            <div class="flex flex-col gap-3 border-b border-line pb-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2>Recent Orders</h2>
                    <p class="mt-1 text-muted">Latest room orders coming in from the menu page.</p>
                </div>
                <a href="{{ route('admin.menu-orders.index') }}" class="bg-brand-500 px-4 py-2.5 font-semibold text-white transition hover:bg-brand-600">
                    View Orders
                </a>
            </div>

            <div id="recentOrders" class="mt-5 space-y-0 border border-line">
                <div class="bg-shell p-6 text-muted">
                    Loading recent orders...
                </div>
            </div>
            <div id="recentOrdersPagination" class="mt-4 flex flex-col gap-3 text-sm text-muted md:flex-row md:items-center md:justify-between">
                <p>Loading pagination...</p>
            </div>
        </section>
    </div>

    <script>
        const statsContainer = document.getElementById('dashboardStats');
        const recentOrdersContainer = document.getElementById('recentOrders');
        const recentOrdersPagination = document.getElementById('recentOrdersPagination');
        const dashboardOrderStatusApiTemplate = '{{ route('api.admin.menu-orders.update-status', ['menuOrder' => '__ORDER_ID__']) }}';
        let currentRecentOrdersPage = 1;

        const formatCurrency = (value) => `Rs. ${Number(value || 0).toFixed(2)}`;
        const formatDateTime = (value) => value ? new Date(value).toLocaleString() : '-';
        const statusOptions = ['pending', 'in_process', 'completed', 'cancelled'];
        const buildDashboardStatusRoute = (orderId) => dashboardOrderStatusApiTemplate.replace('__ORDER_ID__', orderId);

        const renderRecentOrders = (orders) => {
            if (!orders.length) {
                recentOrdersContainer.innerHTML = `
                    <div class="bg-shell p-6 text-muted">
                        No orders yet.
                    </div>
                `;
                return;
            }

            recentOrdersContainer.innerHTML = orders.map((order) => `
                <div class="border-b border-line bg-white p-4 last:border-b-0">
                    <div class="grid gap-4 md:grid-cols-[minmax(0,1.4fr)_140px_150px_170px] md:items-center">
                        <div>
                            <h3 class="font-semibold">Order #${order.id} - ${order.guest_name}</h3>
                            <p class="mt-1 text-muted">Room ${order.room_no} | ${order.phone}</p>
                            <p class="mt-1 text-muted">${order.items_count ?? 0} item(s) | ${formatDateTime(order.created_at)}</p>
                        </div>
                        <div>
                            <span class="inline-flex px-3 py-1 text-xs font-semibold ${statusClass(order.status)}">
                                ${formatStatus(order.status)}
                            </span>
                        </div>
                        <p class="font-number font-semibold md:text-right">${formatCurrency(order.total_amount)}</p>
                        <div>
                            <select onchange="updateDashboardOrderStatus(${order.id}, this.value)" class="border border-line bg-white px-3 py-2 outline-none">
                                ${statusOptions.map((status) => `
                                    <option value="${status}" ${order.status === status ? 'selected' : ''}>${formatStatus(status)}</option>
                                `).join('')}
                            </select>
                        </div>
                    </div>
                </div>
            `).join('');
        };

        const formatStatus = (status) => status.replaceAll('_', ' ').replace(/\b\w/g, (char) => char.toUpperCase());
        const statusClass = (status) => ({
            pending: 'bg-amber-100 text-amber-700',
            in_process: 'bg-sky-100 text-sky-700',
            completed: 'bg-brand-100 text-brand-700',
            cancelled: 'bg-red-100 text-red-700'
        }[status] || 'bg-white text-muted border border-line');

        const renderRecentOrdersPagination = (meta = {}) => {
            const currentPage = Number(meta.current_page || 1);
            const lastPage = Number(meta.last_page || 1);
            const from = meta.from ?? 0;
            const to = meta.to ?? 0;
            const total = meta.total ?? 0;

            if (total === 0) {
                recentOrdersPagination.innerHTML = '<p>No orders to paginate.</p>';
                return;
            }

            const pages = [];
            for (let page = 1; page <= lastPage; page += 1) {
                if (page === 1 || page === lastPage || Math.abs(page - currentPage) <= 1) {
                    pages.push(page);
                    continue;
                }

                if (pages[pages.length - 1] !== '...') {
                    pages.push('...');
                }
            }

            recentOrdersPagination.innerHTML = `
                <p>Showing ${from} to ${to} of ${total} recent orders</p>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="goToRecentOrdersPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''} class="rounded-lg border border-line px-3 py-2 transition hover:bg-shell disabled:cursor-not-allowed disabled:opacity-50">Previous</button>
                    ${pages.map((page) => page === '...'
                        ? '<span class="px-2">...</span>'
                        : `<button type="button" onclick="goToRecentOrdersPage(${page})" class="rounded-lg border px-3 py-2 transition ${page === currentPage ? 'border-brand-500 bg-brand-500 text-white' : 'border-line hover:bg-shell'}">${page}</button>`
                    ).join('')}
                    <button type="button" onclick="goToRecentOrdersPage(${currentPage + 1})" ${currentPage >= lastPage ? 'disabled' : ''} class="rounded-lg border border-line px-3 py-2 transition hover:bg-shell disabled:cursor-not-allowed disabled:opacity-50">Next</button>
                </div>
            `;
        };

        const loadDashboard = async (page = currentRecentOrdersPage) => {
            try {
                const query = new URLSearchParams({
                    recent_orders_page: Math.max(1, Number(page || 1)),
                });

                const response = await fetch(`${window.adminDashboardApiUrl}?${query.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load dashboard.');
                }

                const payload = await response.json();
                const stats = payload.data?.stats ?? {};
                const recentOrdersPayload = payload.data?.recent_orders ?? {};
                const recentOrders = recentOrdersPayload.data ?? [];
                const recentOrdersMeta = recentOrdersPayload.meta ?? {};
                currentRecentOrdersPage = Number(recentOrdersMeta.current_page || 1);

                statsContainer.querySelector('[data-stat="total_orders"]').textContent = Number(stats.total_orders || 0).toLocaleString();
                statsContainer.querySelector('[data-stat="total_revenue"]').textContent = formatCurrency(stats.total_revenue);
                statsContainer.querySelector('[data-stat="weekly_inquiries"]').textContent = Number(stats.weekly_inquiries || 0).toLocaleString();
                statsContainer.querySelector('[data-stat="total_menu_items"]').textContent = Number(stats.total_menu_items || 0).toLocaleString();

                renderRecentOrders(recentOrders);
                renderRecentOrdersPagination(recentOrdersMeta);
            } catch (error) {
                recentOrdersContainer.innerHTML = `
                    <div class="bg-shell p-6 text-muted">
                        Dashboard data could not be loaded right now.
                    </div>
                `;
                recentOrdersPagination.innerHTML = '<p>Pagination could not be loaded.</p>';
            }
        };

        function goToRecentOrdersPage(page) {
            loadDashboard(Math.max(1, page));
        }

        window.addEventListener('admin:new-order', () => {
            loadDashboard();
        });

        const updateDashboardOrderStatus = async (orderId, status) => {
            try {
                const response = await fetch(buildDashboardStatusRoute(orderId), {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ status }),
                });

                if (!response.ok) {
                    throw new Error('Status update failed.');
                }

                loadDashboard();
            } catch (error) {
                alert(error.message || 'Status update failed.');
                loadDashboard();
            }
        };

        setInterval(loadDashboard, 3000);
        loadDashboard();
    </script>
@endsection
