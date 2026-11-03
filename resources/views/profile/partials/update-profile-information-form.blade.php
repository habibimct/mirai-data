
<section class="space-y-5">

    <!-- DESCRIPTION -->
    <div>
        <p class="text-xs leading-relaxed text-slate-500">
            Perbarui informasi identitas dan alamat email yang digunakan untuk akun Anda.
        </p>
    </div>


    <!-- ==========================================
         PROFILE INFORMATION FORM
    =========================================== -->

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>


    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="space-y-4"
    >

        @csrf
        @method('PATCH')


        <!-- NAME -->
        <div>

            <label
                for="name"
                class="mb-1.5 block text-xs font-semibold text-slate-700"
            >
                Nama Lengkap
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="bi bi-person text-base"></i>
                </div>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap"
                    class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >

            </div>

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />

        </div>


        <!-- EMAIL -->
        <div>

            <label
                for="email"
                class="mb-1.5 block text-xs font-semibold text-slate-700"
            >
                Alamat Email
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="bi bi-envelope text-base"></i>
                </div>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="nama@email.com"
                    class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />


            <!-- EMAIL VERIFICATION -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 p-3">

                    <div class="flex items-start gap-2">

                        <i class="bi bi-exclamation-circle-fill mt-0.5 text-amber-600"></i>

                        <div class="flex-1">

                            <p class="text-xs font-semibold text-amber-800">
                                Email Belum Terverifikasi
                            </p>

                            <p class="mt-1 text-xs leading-relaxed text-amber-700">
                                Alamat email Anda belum diverifikasi. Silakan kirim ulang tautan verifikasi untuk mengaktifkan status verifikasi email.
                            </p>

                            <button
                                type="submit"
                                form="send-verification"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 underline underline-offset-2 transition-colors hover:text-blue-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
                            >
                                <i class="bi bi-send"></i>
                                Kirim Ulang Email Verifikasi
                            </button>

                        </div>

                    </div>

                </div>


                @if (session('status') === 'verification-link-sent')

                    <div class="mt-3 flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-xs font-medium text-emerald-700">

                        <i class="bi bi-check-circle-fill"></i>

                        Tautan verifikasi baru berhasil dikirim ke email Anda.

                    </div>

                @endif

            @endif

        </div>


        <!-- ==========================================
             FORM ACTIONS
        =========================================== -->

        <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-4">

            <button
                type="submit"
                class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-100"
            >
                <i class="bi bi-check2-circle"></i>
                Simpan Perubahan
            </button>


            <!-- SUCCESS MESSAGE -->
            @if (session('status') === 'profile-updated')

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.opacity
                    x-init="setTimeout(() => show = false, 3000)"
                    class="inline-flex items-center gap-2 rounded-lg bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-700"
                >
                    <i class="bi bi-check-circle-fill"></i>
                    Profil berhasil diperbarui.
                </div>

            @endif

        </div>

    </form>

</section>
