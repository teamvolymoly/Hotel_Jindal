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
                    <div class="relative">
                        <input id="currentPassword" name="current_password" type="password"
                               class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 pr-12 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        <button type="button" data-password-toggle data-show-label="Show password" data-hide-label="Hide password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-muted transition hover:text-ink focus:outline-none">
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
                </div>

                <div>
                    <label for="newPassword" class="mb-2 block text-sm font-medium">New Password</label>
                    <div class="relative">
                        <input id="newPassword" name="password" type="password"
                               class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 pr-12 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        <button type="button" data-password-toggle data-show-label="Show password" data-hide-label="Hide password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-muted transition hover:text-ink focus:outline-none">
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
                </div>

                <div>
                    <label for="newPasswordConfirmation" class="mb-2 block text-sm font-medium">Confirm New Password</label>
                    <div class="relative">
                        <input id="newPasswordConfirmation" name="password_confirmation" type="password"
                               class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 pr-12 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        <button type="button" data-password-toggle data-show-label="Show password" data-hide-label="Hide password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-muted transition hover:text-ink focus:outline-none">
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
