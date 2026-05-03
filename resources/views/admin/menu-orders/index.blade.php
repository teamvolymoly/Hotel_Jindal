@extends('admin.layouts.app')

@section('title', 'Menu Orders')

@section('head')
    <script>
        window.adminOrdersIndexApiUrl = '{{ route('api.admin.menu-orders.index') }}';
        window.adminOrdersStatusApiTemplate = '{{ route('api.admin.menu-orders.update-status', ['menuOrder' => '__ORDER_ID__']) }}';
        window.adminOrdersShowApiTemplate = '{{ route('api.admin.menu-orders.show', ['menuOrder' => '__ORDER_ID__']) }}';
        window.adminOrderItemQuantityApiTemplate = '{{ route('api.admin.menu-order-items.update-quantity', ['menuOrderItem' => '__ITEM_ID__']) }}';
    </script>
@endsection

@section('content')
    <div class="border border-line bg-white p-5 shadow-panel">
        <div class="grid gap-4 lg:grid-cols-[minmax(0,1.4fr)_240px_auto]">
            <div>
                <label for="ordersSearch" class="mb-2 block text-sm font-medium">Search</label>
                <input id="ordersSearch" type="text" placeholder="Search by order id, guest, room, or phone"
                       class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
            </div>

            <div>
                <label for="ordersStatusFilter" class="mb-2 block text-sm font-medium">Status</label>
                <select id="ordersStatusFilter" class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="in_process">In Process</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="button" id="ordersApplyFilters" class="rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-600">Apply</button>
                <button type="button" id="ordersResetFilters" class="rounded-xl border border-line px-5 py-3 text-sm font-semibold transition hover:bg-shell">Reset</button>
            </div>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-[2rem] border border-line bg-white shadow-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-shell">
                    <tr class="text-left text-sm uppercase tracking-[0.18em] text-muted">
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4">Guest</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Placed</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody" class="divide-y divide-line">
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-muted">Loading orders...</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="ordersPagination" class="flex flex-col gap-3 border-t border-line px-6 py-4 text-sm text-muted md:flex-row md:items-center md:justify-between">
            <p>Loading pagination...</p>
        </div>
    </div>

    <div id="orderDetailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
        <div class="w-full max-w-2xl rounded-[1.5rem] bg-white shadow-panel">
            <div class="flex items-center justify-between border-b border-line px-6 py-5">
                <h2 class="text-2xl font-semibold">Order Details</h2>
                <button type="button" onclick="closeOrderDetailModal()" class="text-2xl text-muted"><svg width="25" height="25" viewBox="0 0 148 148" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M111 37L37 111" stroke="black" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M37 37L111 111" stroke="black" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div id="orderDetailContent" class="px-6 py-5 text-muted">
                Loading...
            </div>
        </div>
    </div>

    <script>
        const ordersTableBody = document.getElementById('ordersTableBody');
        const orderDetailModal = document.getElementById('orderDetailModal');
        const orderDetailContent = document.getElementById('orderDetailContent');
        const ordersPagination = document.getElementById('ordersPagination');
        const ordersSearchInput = document.getElementById('ordersSearch');
        const ordersStatusFilter = document.getElementById('ordersStatusFilter');
        const ordersApplyFiltersButton = document.getElementById('ordersApplyFilters');
        const ordersResetFiltersButton = document.getElementById('ordersResetFilters');
        const buildItemQuantityRoute = (itemId) => window.adminOrderItemQuantityApiTemplate.replace('__ITEM_ID__', itemId);
        let activeOrderId = null;

        const statusClassMap = {
            pending: 'bg-amber-100 text-amber-700',
            in_process: 'bg-sky-100 text-sky-700',
            completed: 'bg-brand-100 text-brand-700',
            cancelled: 'bg-red-100 text-red-700',
        };

        const formatStatus = (status) => status.replaceAll('_', ' ').replace(/\b\w/g, (char) => char.toUpperCase());
        const formatCurrency = (value) => `Rs. ${Number(value || 0).toFixed(2)}`;
        const formatDateTime = (value) => value ? new Date(value).toLocaleString() : '-';
        const statusOptions = ['pending', 'in_process', 'completed', 'cancelled'];

        const buildStatusRoute = (orderId) => window.adminOrdersStatusApiTemplate.replace('__ORDER_ID__', orderId);
        const buildShowRoute = (orderId) => window.adminOrdersShowApiTemplate.replace('__ORDER_ID__', orderId);
        let currentOrdersFilters = {
            q: '',
            status: '',
            page: 1,
        };

        const renderOrders = (orders) => {
            if (!orders.length) {
                ordersTableBody.innerHTML = '<tr><td colspan="8" class="px-6 py-10 text-center text-muted">No orders found.</td></tr>';
                return;
            }

            ordersTableBody.innerHTML = orders.map((order) => `
                <tr class="align-middle">
                    <td class="px-6 py-5 font-semibold">#${order.id}</td>
                    <td class="px-6 py-5">
                        <div>${escapeHtml(order.guest_name)}</div>
                        <div class="mt-1 text-sm text-muted">Room ${escapeHtml(order.room_no)}</div>
                    </td>
                    <td class="px-6 py-5 text-muted">${escapeHtml(order.phone)}</td>
                    <td class="px-6 py-5 text-muted">${order.items_count ?? 0}</td>
                    <td class="px-6 py-5 text-muted">${formatCurrency(order.total_amount)}</td>
                    <td class="px-6 py-5">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold ${statusClassMap[order.status] || 'bg-white text-muted border border-line'}">
                            ${formatStatus(order.status)}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-muted">${formatDateTime(order.created_at)}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-end gap-3">
                            <button type="button" onclick="showOrderDetails(${order.id})" class="rounded-xl border border-line px-4 py-2 text-sm font-semibold transition hover:bg-shell">View</button>
                            <select onchange="updateOrderStatus(${order.id}, this.value)" class="rounded-xl border border-line bg-white px-3 py-2 text-sm outline-none">
                                ${statusOptions.map((status) => `
                                    <option value="${status}" ${order.status === status ? 'selected' : ''}>${formatStatus(status)}</option>
                                `).join('')}
                            </select>
                        </div>
                    </td>
                </tr>
            `).join('');
        };

        const readOrdersFilters = () => ({
            q: ordersSearchInput.value.trim(),
            status: ordersStatusFilter.value,
            page: 1,
        });

        const renderPagination = (meta = {}) => {
            const currentPage = Number(meta.current_page || 1);
            const lastPage = Number(meta.last_page || 1);
            const from = meta.from ?? 0;
            const to = meta.to ?? 0;
            const total = meta.total ?? 0;

            if (total === 0) {
                ordersPagination.innerHTML = '<p>No orders to paginate.</p>';
                return;
            }

            const pages = [];
            for (let page = 1; page <= lastPage; page += 1) {
                if (
                    page === 1 ||
                    page === lastPage ||
                    Math.abs(page - currentPage) <= 1
                ) {
                    pages.push(page);
                    continue;
                }

                if (pages[pages.length - 1] !== '...') {
                    pages.push('...');
                }
            }

            ordersPagination.innerHTML = `
                <p>Showing ${from} to ${to} of ${total} orders</p>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="goToOrdersPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''} class="rounded-lg border border-line px-3 py-2 transition hover:bg-shell disabled:cursor-not-allowed disabled:opacity-50">Previous</button>
                    ${pages.map((page) => page === '...'
                        ? '<span class="px-2">...</span>'
                        : `<button type="button" onclick="goToOrdersPage(${page})" class="rounded-lg border px-3 py-2 transition ${page === currentPage ? 'border-brand-500 bg-brand-500 text-white' : 'border-line hover:bg-shell'}">${page}</button>`
                    ).join('')}
                    <button type="button" onclick="goToOrdersPage(${currentPage + 1})" ${currentPage >= lastPage ? 'disabled' : ''} class="rounded-lg border border-line px-3 py-2 transition hover:bg-shell disabled:cursor-not-allowed disabled:opacity-50">Next</button>
                </div>
            `;
        };

        const loadOrders = async (filters = currentOrdersFilters) => {
            try {
                const query = new URLSearchParams();

                currentOrdersFilters = {
                    q: filters.q ?? '',
                    status: filters.status ?? '',
                    page: Math.max(1, Number(filters.page || 1)),
                };

                if (currentOrdersFilters.q) {
                    query.set('q', currentOrdersFilters.q);
                }

                if (currentOrdersFilters.status) {
                    query.set('status', currentOrdersFilters.status);
                }

                query.set('page', currentOrdersFilters.page);

                const response = await fetch(`${window.adminOrdersIndexApiUrl}${query.toString() ? `?${query.toString()}` : ''}`, {
                    headers: {
                        'Accept': 'application/json'
                    },
                    cache: 'no-store',
                });

                if (!response.ok) {
                    throw new Error('Failed to load orders.');
                }

                const payload = await response.json();
                currentOrdersFilters.page = Number(payload.meta?.current_page || currentOrdersFilters.page || 1);
                renderOrders(payload.data ?? []);
                renderPagination(payload.meta ?? {});
            } catch (error) {
                ordersTableBody.innerHTML = '<tr><td colspan="8" class="px-6 py-10 text-center text-muted">Orders could not be loaded.</td></tr>';
                ordersPagination.innerHTML = '<p>Pagination could not be loaded.</p>';
            }
        };

        window.addEventListener('admin:new-order', () => {
            loadOrders();
        });

        const applyOrderFilters = () => {
            loadOrders(readOrdersFilters());
        };

        function goToOrdersPage(page) {
            loadOrders({
                ...currentOrdersFilters,
                page: Math.max(1, page),
            });
        }

        const updateOrderStatus = async (orderId, status) => {
            try {
                const response = await fetch(buildStatusRoute(orderId), {
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

                loadOrders();
            } catch (error) {
                alert(error.message || 'Status update failed.');
                loadOrders();
            }
        };

        const showOrderDetails = async (orderId) => {
            activeOrderId = orderId;
            orderDetailModal.classList.remove('hidden');
            orderDetailModal.classList.add('flex');
            orderDetailContent.innerHTML = 'Loading...';

            try {
                const response = await fetch(buildShowRoute(orderId), {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load order details.');
                }

                const payload = await response.json();
                const order = payload.data;

                orderDetailContent.innerHTML = `
                    <div class="space-y-5">
                        <div class="grid gap-3 md:grid-cols-2">
                            <div><span class="font-semibold text-ink">Guest:</span> ${escapeHtml(order.guest_name)}</div>
                            <div><span class="font-semibold text-ink">Room:</span> ${escapeHtml(order.room_no)}</div>
                            <div><span class="font-semibold text-ink">Phone:</span> ${escapeHtml(order.phone)}</div>
                            <div><span class="font-semibold text-ink">Status:</span> ${formatStatus(order.status)}</div>
                        </div>
                        <div class="rounded-2xl border border-line">
                            ${(order.items ?? []).map((item) => `
                                <div class="flex items-center justify-between border-b border-line px-4 py-3 last:border-b-0">
                                    <div>
                                        <p class="font-medium text-ink">${escapeHtml(item.item_name)}</p>
                                        <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-muted">
                                            <span>Qty:</span>
                                            <div class="inline-flex items-center gap-1">
                                                <button type="button" onclick="changeItemQuantity(${item.id}, -1)" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line bg-white text-base font-semibold text-ink transition hover:bg-shell">-</button>
                                                <input id="order-item-qty-${item.id}" type="number" min="0" value="${item.quantity}" data-item-price="${Number(item.item_price || 0)}" oninput="recalculateOrderPreview()" class="h-9 w-12 rounded-lg border border-line px-1 text-center text-ink outline-none">
                                                <button type="button" onclick="changeItemQuantity(${item.id}, 1)" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line bg-white text-base font-semibold text-ink transition hover:bg-shell">+</button>
                                            </div>
                                            <button type="button" onclick="saveItemQuantity(${item.id})" class="ml-1 rounded-lg bg-brand-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-brand-600">Save</button>
                                        </div>
                                    </div>
                                    <p id="order-item-total-${item.id}" class="font-medium text-ink">${formatCurrency(item.line_total)}</p>
                                </div>
                            `).join('')}
                        </div>
                        <div id="order-detail-total" class="text-right text-lg font-semibold text-ink">Total: ${formatCurrency(order.total_amount)}</div>
                    </div>
                `;
            } catch (error) {
                orderDetailContent.innerHTML = 'Order details could not be loaded.';
            }
        };

        function closeOrderDetailModal() {
            activeOrderId = null;
            orderDetailModal.classList.add('hidden');
            orderDetailModal.classList.remove('flex');
        }

        function changeItemQuantity(itemId, delta) {
            const input = document.getElementById(`order-item-qty-${itemId}`);

            if (!input) {
                return;
            }

            const nextValue = Math.max(0, Number(input.value || 0) + delta);
            input.value = nextValue;
            recalculateOrderPreview();
        }

        async function saveItemQuantity(itemId) {
            const input = document.getElementById(`order-item-qty-${itemId}`);

            if (!input) {
                return;
            }

            const quantity = Math.max(0, Number(input.value || 0));
            input.value = quantity;

            try {
                const response = await fetch(buildItemQuantityRoute(itemId), {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ quantity }),
                });

                if (!response.ok) {
                    throw new Error('Quantity update failed.');
                }

                await loadOrders();
                if (activeOrderId) {
                    await showOrderDetails(activeOrderId);
                }
                window.dispatchEvent(new CustomEvent('admin:new-order'));
            } catch (error) {
                alert(error.message || 'Quantity update failed.');
            }
        }

        function recalculateOrderPreview() {
            const quantityInputs = orderDetailContent.querySelectorAll('input[id^="order-item-qty-"]');
            let orderTotal = 0;

            quantityInputs.forEach((input) => {
                const itemId = input.id.replace('order-item-qty-', '');
                const quantity = Math.max(0, Number(input.value || 0));
                const itemPrice = Number(input.dataset.itemPrice || 0);
                const lineTotal = itemPrice * quantity;
                const lineTotalElement = document.getElementById(`order-item-total-${itemId}`);

                input.value = quantity;
                orderTotal += lineTotal;

                if (lineTotalElement) {
                    lineTotalElement.textContent = formatCurrency(lineTotal);
                }
            });

            const orderTotalElement = document.getElementById('order-detail-total');
            if (orderTotalElement) {
                orderTotalElement.textContent = `Total: ${formatCurrency(orderTotal)}`;
            }
        }

        function escapeHtml(value) {
            return String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        ordersApplyFiltersButton.addEventListener('click', applyOrderFilters);
        ordersResetFiltersButton.addEventListener('click', () => {
            ordersSearchInput.value = '';
            ordersStatusFilter.value = '';
            loadOrders({ q: '', status: '', page: 1 });
        });
        ordersSearchInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                applyOrderFilters();
            }
        });
        ordersStatusFilter.addEventListener('change', applyOrderFilters);

        setInterval(loadOrders, 3000);
        loadOrders(readOrdersFilters());
    </script>
@endsection
