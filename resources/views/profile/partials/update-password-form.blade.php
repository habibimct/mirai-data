
<section class="space-y-4">

    <!-- DESCRIPTION -->
    <div class="mb-5">

        <p class="text-xs leading-relaxed text-slate-500">
            Gunakan password yang kuat dan sulit ditebak untuk menjaga keamanan akun Anda.
        </p>

    </div>


    <!-- ==========================================
         UPDATE PASSWORD FORM
    =========================================== -->

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-4"
    >

        @csrf
        @method('PUT')


        <!-- CURRENT PASSWORD -->
        <div>

            <label
                for="current_password"
                class="mb-1.5 block text-xs font-semibold text-slate-700"
            >
                Password Saat Ini
            </label>

            <div class="relative">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="bi bi-lock text-base"></i>
                </div>

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="Masukkan password saat ini"
                    class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >

            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />

        </div>


        <!-- NEW PASSWORD -->
        <div>

            <label
                for="password"
                class="mb-1.5 block text-xs font-semibold text-slate-700"
            >
                Password Baru
            </label>

            <div class="relative">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="bi bi-shield-lock text-base"></i>
                </div>

                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Masukkan password baru"
                    class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >

            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />

        </div>


        <!-- CONFIRM PASSWORD -->
        <div>

            <label
                for="password_confirmation"
                class="mb-1.5 block text-xs font-semibold text-slate-700"
            >
                Konfirmasi Password Baru
            </label>

            <div class="relative">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="bi bi-shield-check text-base"></i>
                </div>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Ulangi password baru"
                    class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >

            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        <!-- FORM ACTIONS -->
        <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-4">

            <button
                type="submit"
                class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-100"
            >
                <i class="bi bi-shield-check"></i>
                Update Password
            </button>


            <!-- SUCCESS MESSAGE -->
            @if (session('status') === 'password-updated')

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.opacity
                    x-init="setTimeout(() => show = false, 3000)"
                    class="inline-flex items-center gap-2 rounded-lg bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-700"
                >
                    <i class="bi bi-check-circle-fill"></i>
                    Password berhasil diperbarui.
                </div>

            @endif

        </div>

    </form>

</section>
