@extends('layouts.app')

@section('title', 'Menu - Hotel Jindal')
@section('body_class', 'bg-[#f1f1f1] text-[#1f1f1f]')

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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<style>
    @font-face {
        font-family: "Gilda Display";
        src: url("{{ asset('assets/fonts/GildaDisplay-Regular.ttf') }}");
    }

    @font-face {
        font-family: "Raleway";
        src: url("{{ asset('assets/fonts/Raleway-VariableFont_wght.ttf') }}");
    }

    .menu-container {
        max-width: 480px;
        margin: auto;
    }

    .category {
        padding: 6px 12px;
        white-space: nowrap;
        color: #777;
        cursor: pointer;
    }

    .category.active {
        color: #000;
        font-weight: 600;
    }

    .slick-slide {
        width: auto !important;
    }

    .slick-prev,
    .slick-next {
        display: none !important;
    }

    .menu-empty {
        color: #777;
        font-size: 14px;
    }

    .hidden-button {
        visibility: hidden;
        pointer-events: none;
    }

    .search-shell {
        border-bottom: 1px solid #ddd;
        background: #f1f1f1;
    }

    .search-shell.hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<header class="menu-container flex items-center justify-between border-b px-5 py-4">
    <button id="searchToggleBtn" type="button" aria-label="Search"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M20.9999 21.0004L16.6499 16.6504" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
    <a href="{{ route('home') }}">
        <h1 class="text-xl font-serif">HOTEL JINDAL</h1>
    </a>
    <button id="profileBtn" type="button" aria-label="Profile">&#128100;</button>
</header>

<div id="menuSearchShell" class="menu-container search-shell hidden px-5 py-3">
    <input
        id="menuSearchInput"
        type="text"
        placeholder="Search menu items"
        class="w-full border px-3 py-2 text-sm outline-none"
    >
</div>

<div class="menu-container sticky top-0 bg-[#f1f1f1]">
    <div id="categorySlider" class="px-5 py-4 text-sm">
    </div>
</div>

<div id="menuContent" class="menu-container px-5 py-6"></div>

<div class="menu-container fixed bottom-5 left-1/2 -translate-x-1/2 px-5">
    <button id="cartBtn"
        class="w-full bg-[#3c3c3c]/90 px-8 py-4 text-[18px] text-sm font-medium uppercase tracking-[0.08em] text-white transition hover:bg-black hover:text-white">
        View Cart (<span id="cartCount">0</span>)
    </button>
</div>

<div id="userModal" class="fixed inset-0 flex items-center justify-center bg-black/50">
    <div class="w-[90%] max-w-sm bg-white p-6">
        <h2 class="mb-4 text-lg">Enter Details</h2>

        <input id="guestName" placeholder="Name" class="mb-3 w-full border p-2">
        <input id="guestRoomNo" placeholder="Room No." class="mb-3 w-full border p-2">
        <input id="guestPhone" placeholder="Phone" class="mb-4 w-full border p-2">

        <button id="guestSubmitBtn" type="button" class="hidden-button w-full bg-black py-2 text-white">
            Submit
        </button>
    </div>
</div>

<div id="cartModal" class="fixed inset-0 z-50 hidden items-end bg-black/50">
    <div class="menu-container flex max-h-[85vh] w-full flex-col bg-white">
        <div class="flex items-center justify-between border-b p-5">
            <h2 class="text-lg font-semibold">Your Cart</h2>
            <button type="button" onclick="closeCart()"><svg width="25" height="25" viewBox="0 0 148 148" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M111 37L37 111" stroke="black" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M37 37L111 111" stroke="black" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
        </div>

        <div id="cartItems" class="flex-1 space-y-3 overflow-y-auto p-5"></div>

        <div class="border-t p-5">
            <button id="checkoutBtn" class="w-full bg-black py-3 text-white">
                Checkout
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const menuApiUrl = '{{ route('api.menu') }}';
    const orderApiUrl = '{{ route('api.menu.orders.store') }}';
    const fallbackImageUrl = 'https://picsum.photos/seed/menu-item/100';
    const guestStorageKey = 'hotel_jindal_guest';
    const cartStorageKey = 'hotel_jindal_cart';
    let menuData = [];
    let activeCategorySlug = null;
    let isCheckingOut = false;
    let menuSearchTerm = '';

    $(document).ready(function () {
        initializeGuestState();
        loadCart();
        initializeMenu();
    });

    const userModal = document.getElementById('userModal');
    const profileBtn = document.getElementById('profileBtn');
    const searchToggleBtn = document.getElementById('searchToggleBtn');
    const menuSearchShell = document.getElementById('menuSearchShell');
    const menuSearchInput = document.getElementById('menuSearchInput');
    const cartModal = document.getElementById('cartModal');
    const cartBtn = document.getElementById('cartBtn');
    const menuContent = document.getElementById('menuContent');
    const guestNameInput = document.getElementById('guestName');
    const guestRoomNoInput = document.getElementById('guestRoomNo');
    const guestPhoneInput = document.getElementById('guestPhone');
    const guestSubmitBtn = document.getElementById('guestSubmitBtn');
    const checkoutBtn = document.getElementById('checkoutBtn');
    let cart = [];

    profileBtn.onclick = () => userModal.classList.remove('hidden');
    searchToggleBtn.onclick = toggleSearch;

    async function initializeMenu() {
        menuContent.innerHTML = '<p class="menu-empty">Loading menu...</p>';

        try {
            const response = await fetch(menuApiUrl, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Failed to load menu.');
            }

            const payload = await response.json();
            menuData = payload.data?.categories ?? [];
            activeCategorySlug = menuData[0]?.slug ?? null;

            renderCategories();
            renderMenu();
            initializeSearch();
        } catch (error) {
            menuContent.innerHTML = '<p class="menu-empty">Menu could not be loaded right now.</p>';
        }
    }

    function initializeSearch() {
        menuSearchInput.addEventListener('input', function () {
            menuSearchTerm = this.value.trim().toLowerCase();

            const visibleCategories = getVisibleCategories();
            activeCategorySlug = visibleCategories.some((category) => category.slug === activeCategorySlug)
                ? activeCategorySlug
                : (visibleCategories[0]?.slug ?? null);

            renderCategories();
            renderMenu();
        });
    }

    function toggleSearch() {
        menuSearchShell.classList.toggle('hidden');

        if (!menuSearchShell.classList.contains('hidden')) {
            menuSearchInput.focus();
            return;
        }

        if (menuSearchInput.value !== '') {
            menuSearchInput.value = '';
            menuSearchTerm = '';
            const visibleCategories = getVisibleCategories();
            activeCategorySlug = visibleCategories[0]?.slug ?? null;
            renderCategories();
            renderMenu();
        }
    }

    function getVisibleCategories() {
        if (!menuSearchTerm) {
            return menuData;
        }

        return menuData
            .map((category) => {
                const categoryMatches = matchesSearch(category.name);
                const filteredDirectItems = filterItems(category.items ?? []);
                const filteredSubcategories = (category.subcategories ?? [])
                    .map((subcategory) => {
                        const subcategoryMatches = matchesSearch(subcategory.name);
                        const filteredItems = filterItems(subcategory.items ?? []);

                        if (!subcategoryMatches && !filteredItems.length) {
                            return null;
                        }

                        return {
                            ...subcategory,
                            items: subcategoryMatches && !filteredItems.length
                                ? (subcategory.items ?? [])
                                : filteredItems,
                        };
                    })
                    .filter(Boolean);

                if (!categoryMatches && !filteredDirectItems.length && !filteredSubcategories.length) {
                    return null;
                }

                return {
                    ...category,
                    items: categoryMatches && !filteredDirectItems.length
                        ? (category.items ?? [])
                        : filteredDirectItems,
                    subcategories: filteredSubcategories,
                };
            })
            .filter(Boolean);
    }

    function filterItems(items) {
        return items.filter((item) => matchesSearch(item.name));
    }

    function matchesSearch(value) {
        return String(value ?? '').toLowerCase().includes(menuSearchTerm);
    }

    function renderCategories() {
        const slider = $('#categorySlider');
        const visibleCategories = getVisibleCategories();

        if (slider.hasClass('slick-initialized')) {
            slider.slick('unslick');
        }

        if (!visibleCategories.length) {
            slider.html('');
            return;
        }

        slider.html(
            visibleCategories.map((category) => `
                <div class="category ${category.slug === activeCategorySlug ? 'active' : ''}" data-category-slug="${category.slug}">
                    ${escapeHtml(category.name)}
                </div>
            `).join('')
        );

        slider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            arrows: false,
            dots: false,
            variableWidth: true,
            swipeToSlide: true
        });

        slider.off('click').on('click', '.category', function () {
            activeCategorySlug = this.dataset.categorySlug;
            renderCategories();
            renderMenu();
        });
    }

    function renderMenu() {
        const visibleCategories = getVisibleCategories();
        const activeCategory = visibleCategories.find((category) => category.slug === activeCategorySlug);

        if (!activeCategory) {
            menuContent.innerHTML = menuSearchTerm
                ? '<p class="menu-empty">No menu items matched your search.</p>'
                : '<p class="menu-empty">No categories available.</p>';
            return;
        }

        const sections = activeCategory.subcategories?.length
            ? activeCategory.subcategories
            : [{
                name: activeCategory.name,
                items: activeCategory.items ?? []
            }];

        const hasItems = sections.some((section) => (section.items ?? []).length > 0);

        if (!hasItems) {
            menuContent.innerHTML = `
                <h2 class="mb-4 text-lg font-semibold">${escapeHtml(activeCategory.name)}</h2>
                <p class="menu-empty">${menuSearchTerm ? 'No menu items matched your search in this category.' : 'No menu items available in this category.'}</p>
            `;
            return;
        }

        menuContent.innerHTML = sections.map((section) => `
            <section class="mb-10">
                <h2 class="mb-4 text-lg font-semibold">${escapeHtml(section.name)}</h2>
                ${(section.items ?? []).map((item) => `
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p>${escapeHtml(item.name)}</p>
                            <p class="text-sm text-gray-500">&#8377;${formatPrice(item.price)}</p>
                            <button onclick="addToCart(${Number(item.id)}, '${escapeJs(item.name)}', ${Number(item.price)})" class="mt-2 bg-black px-3 py-1 text-xs text-white">
                                ADD
                            </button>
                        </div>
                        <img src="${item.image_url || fallbackImageUrl}" class="h-20 w-20 rounded object-cover" alt="${escapeHtml(item.name)}">
                    </div>
                `).join('')}
            </section>
        `).join('');
    }

    function initializeGuestState() {
        const guest = getGuestDetails();

        guestNameInput.value = guest?.name ?? '';
        guestRoomNoInput.value = guest?.room_no ?? '';
        guestPhoneInput.value = guest?.phone ?? '';

        [guestNameInput, guestRoomNoInput, guestPhoneInput].forEach((input) => {
            input.addEventListener('input', syncGuestFormState);
        });

        guestSubmitBtn.addEventListener('click', saveGuestDetails);
        checkoutBtn.addEventListener('click', checkoutOrder);
        syncGuestFormState();

        if (!guest) {
            userModal.classList.remove('hidden');
        } else {
            userModal.classList.add('hidden');
        }
    }

    function syncGuestFormState() {
        const isValid = validateGuestForm();
        guestSubmitBtn.classList.toggle('hidden-button', !isValid);
    }

    function validateGuestForm() {
        return guestNameInput.value.trim() !== ''
            && guestRoomNoInput.value.trim() !== ''
            && guestPhoneInput.value.trim() !== '';
    }

    function saveGuestDetails() {
        if (!validateGuestForm()) {
            return;
        }

        const guest = {
            name: guestNameInput.value.trim(),
            room_no: guestRoomNoInput.value.trim(),
            phone: guestPhoneInput.value.trim(),
        };

        localStorage.setItem(guestStorageKey, JSON.stringify(guest));
        userModal.classList.add('hidden');
    }

    function getGuestDetails() {
        try {
            const rawGuest = localStorage.getItem(guestStorageKey);
            return rawGuest ? JSON.parse(rawGuest) : null;
        } catch (error) {
            return null;
        }
    }

    function addToCart(menuItemId, name, price) {
        if (!getGuestDetails()) {
            userModal.classList.remove('hidden');
            return;
        }

        const existingItem = cart.find((item) => item.menu_item_id === menuItemId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                menu_item_id: menuItemId,
                name,
                price: Number(price),
                quantity: 1,
            });
        }

        persistCart();
    }

    function loadCart() {
        try {
            const rawCart = localStorage.getItem(cartStorageKey);
            cart = rawCart ? JSON.parse(rawCart) : [];
        } catch (error) {
            cart = [];
        }

        updateCartCount();
    }

    function persistCart() {
        localStorage.setItem(cartStorageKey, JSON.stringify(cart));
        updateCartCount();
        renderCartItems();
    }

    function updateCartCount() {
        const totalQuantity = cart.reduce((sum, item) => sum + Number(item.quantity || 0), 0);
        document.getElementById('cartCount').innerText = totalQuantity;
    }

    cartBtn.onclick = () => {
        if (!getGuestDetails()) {
            userModal.classList.remove('hidden');
            return;
        }

        cartModal.classList.remove('hidden');
        cartModal.classList.add('flex');
        renderCartItems();
    };

    function renderCartItems() {
        const container = document.getElementById('cartItems');

        if (!container) {
            return;
        }

        if (!cart.length) {
            container.innerHTML = '<p class="menu-empty">Your cart is empty.</p>';
            return;
        }

        container.innerHTML = cart.map((item) => `
            <div class="flex items-center justify-between border-b pb-4">
                <div>
                    <span>${escapeHtml(item.name)}</span>
                    <p class="mt-1 text-sm text-gray-500">Qty: ${item.quantity}</p>
                </div>
                <span>&#8377;${formatPrice(Number(item.price) * Number(item.quantity))}</span>
            </div>
        `).join('');
    }

    function closeCart() {
        cartModal.classList.add('hidden');
        cartModal.classList.remove('flex');
    }

    async function checkoutOrder() {
        if (isCheckingOut || !cart.length) {
            return;
        }

        const guest = getGuestDetails();

        if (!guest) {
            closeCart();
            userModal.classList.remove('hidden');
            return;
        }

        isCheckingOut = true;
        checkoutBtn.textContent = 'Processing...';

        try {
            const response = await fetch(orderApiUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    guest,
                    items: cart.map((item) => ({
                        menu_item_id: item.menu_item_id,
                        quantity: item.quantity,
                    })),
                }),
            });

            const payload = await response.json();

            if (!response.ok) {
                throw new Error(payload.message || 'Checkout failed.');
            }

            cart = [];
            localStorage.setItem(cartStorageKey, JSON.stringify(cart));
            updateCartCount();
            renderCartItems();
            closeCart();

            alert(`Order placed successfully. Order ID: ${payload.data.order_id}`);
        } catch (error) {
            alert(error.message || 'Checkout failed.');
        } finally {
            isCheckingOut = false;
            checkoutBtn.textContent = 'Checkout';
        }
    }

    function formatPrice(price) {
        return Number(price).toFixed(0);
    }

    function escapeHtml(value) {
        return String(value ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function escapeJs(value) {
        return String(value ?? '')
            .replaceAll('\\', '\\\\')
            .replaceAll("'", "\\'");
    }
</script>
@endsection
