@extends('admin.layouts.app')

@section('title', 'Admin Profile')

@section('head')
    <script>
        window.adminProfileShowApiUrl = '{{ route('api.admin.profile.show') }}';
        window.adminProfileUpdateApiUrl = '{{ route('api.admin.profile.update') }}';
        window.adminProfilePasswordApiUrl = '{{ route('api.admin.profile.update-password') }}';
    </script>
@endsection

@section('content')
    <div class="grid gap-6 xl:grid-cols-2">
        <section class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold">Login Details</h2>
                <p class="mt-2 text-sm text-muted">This email is used as your admin login id.</p>
            </div>

            <div id="profileFormFeedback" class="hidden rounded-2xl px-5 py-4 text-sm"></div>

            <form id="profileForm" class="mt-5 space-y-5">
                <div>
                    <label for="profileName" class="mb-2 block text-sm font-medium">Name</label>
                    <input id="profileName" name="name" type="text"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                </div>

                <div>
                    <label for="profileEmail" class="mb-2 block text-sm font-medium">Email / Login Id</label>
                    <input id="profileEmail" name="email" type="email"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                </div>

                <button id="profileSubmitButton" type="submit" class="rounded-2xl bg-brand-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-600">
                    Save Changes
                </button>
            </form>
        </section>

        <section class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold">Change Password</h2>
                <p class="mt-2 text-sm text-muted">For safety, enter your current password before setting a new one.</p>
            </div>

            <div id="passwordFormFeedback" class="hidden rounded-2xl px-5 py-4 text-sm"></div>

            <form id="passwordForm" class="mt-5 space-y-5">
                <div>
                    <label for="currentPassword" class="mb-2 block text-sm font-medium">Current Password</label>
                    <input id="currentPassword" name="current_password" type="password"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                </div>

                <div>
                    <label for="newPassword" class="mb-2 block text-sm font-medium">New Password</label>
                    <input id="newPassword" name="password" type="password"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                </div>

                <div>
                    <label for="newPasswordConfirmation" class="mb-2 block text-sm font-medium">Confirm New Password</label>
                    <input id="newPasswordConfirmation" name="password_confirmation" type="password"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                </div>

                <button id="passwordSubmitButton" type="submit" class="rounded-2xl bg-brand-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-600">
                    Update Password
                </button>
            </form>
        </section>
    </div>

    <script>
        const profileForm = document.getElementById('profileForm');
        const passwordForm = document.getElementById('passwordForm');
        const profileNameInput = document.getElementById('profileName');
        const profileEmailInput = document.getElementById('profileEmail');
        const profileSubmitButton = document.getElementById('profileSubmitButton');
        const passwordSubmitButton = document.getElementById('passwordSubmitButton');
        const profileFormFeedback = document.getElementById('profileFormFeedback');
        const passwordFormFeedback = document.getElementById('passwordFormFeedback');

        const feedbackClassMap = {
            success: ['bg-brand-50', 'text-brand-700', 'border', 'border-brand-100'],
            error: ['bg-red-50', 'text-red-700', 'border', 'border-red-100'],
        };

        const setFeedback = (element, message, type) => {
            element.textContent = message;
            element.classList.remove('hidden', 'bg-brand-50', 'text-brand-700', 'border', 'border-brand-100', 'bg-red-50', 'text-red-700', 'border-red-100');
            element.classList.add(...feedbackClassMap[type]);
        };

        const getErrorMessage = async (response) => {
            const payload = await response.json().catch(() => ({}));
            return payload.message || Object.values(payload.errors || {}).flat()[0] || 'Request failed.';
        };

        const loadProfile = async () => {
            try {
                const response = await fetch(window.adminProfileShowApiUrl, {
                    headers: { Accept: 'application/json' }
                });

                if (!response.ok) {
                    throw new Error('Profile could not be loaded.');
                }

                const payload = await response.json();
                const user = payload.data || {};
                profileNameInput.value = user.name || '';
                profileEmailInput.value = user.email || '';
            } catch (error) {
                setFeedback(profileFormFeedback, error.message || 'Profile could not be loaded.', 'error');
            }
        };

        profileForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            profileSubmitButton.disabled = true;
            profileSubmitButton.textContent = 'Saving...';

            try {
                const response = await fetch(window.adminProfileUpdateApiUrl, {
                    method: 'PATCH',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        name: profileNameInput.value.trim(),
                        email: profileEmailInput.value.trim(),
                    }),
                });

                if (!response.ok) {
                    throw new Error(await getErrorMessage(response));
                }

                const payload = await response.json();
                setFeedback(profileFormFeedback, payload.message || 'Profile updated successfully.', 'success');
                await loadProfile();
            } catch (error) {
                setFeedback(profileFormFeedback, error.message || 'Profile update failed.', 'error');
            } finally {
                profileSubmitButton.disabled = false;
                profileSubmitButton.textContent = 'Save Changes';
            }
        });

        passwordForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            passwordSubmitButton.disabled = true;
            passwordSubmitButton.textContent = 'Updating...';

            const formData = new FormData(passwordForm);

            try {
                const response = await fetch(window.adminProfilePasswordApiUrl, {
                    method: 'PATCH',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(Object.fromEntries(formData.entries())),
                });

                if (!response.ok) {
                    throw new Error(await getErrorMessage(response));
                }

                const payload = await response.json();
                passwordForm.reset();
                setFeedback(passwordFormFeedback, payload.message || 'Password updated successfully.', 'success');
            } catch (error) {
                setFeedback(passwordFormFeedback, error.message || 'Password update failed.', 'error');
            } finally {
                passwordSubmitButton.disabled = false;
                passwordSubmitButton.textContent = 'Update Password';
            }
        });

        loadProfile();
    </script>
@endsection
