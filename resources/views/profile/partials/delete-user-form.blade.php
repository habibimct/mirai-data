
<section class="space-y-4">

    <!-- ==========================================
         DELETE ACCOUNT WARNING
    =========================================== -->

    <div class="flex items-start gap-3 rounded-lg border border-red-100 bg-red-50/60 p-3.5">

        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <div>
            <h4 class="text-xs font-bold text-red-800">
                Penghapusan Akun Permanen
            </h4>

            <p class="mt-1 text-xs leading-relaxed text-red-700">
                Setelah akun dihapus, seluruh data dan sumber daya yang terkait dengan akun tersebut akan dihapus secara permanen.
                Pastikan Anda telah menyimpan informasi penting sebelum melanjutkan.
            </p>
        </div>

    </div>


    <!-- ==========================================
         DELETE ACCOUNT BUTTON
    =========================================== -->

    <div class="flex justify-end">

        <button
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-xs font-semibold text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 hover:text-red-700 hover:shadow-sm active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-red-100"
        >
            <i class="bi bi-trash3-fill"></i>
            Hapus Akun
        </button>

    </div>


    <!-- ==========================================
         CONFIRM DELETE MODAL
    =========================================== -->

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="p-5 sm:p-6"
        >

            @csrf
            @method('DELETE')


            <!-- MODAL HEADER -->
            <div class="mb-5 flex items-start gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <i class="bi bi-shield-exclamation text-xl"></i>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900">
                        Konfirmasi Penghapusan Akun
                    </h2>

                    <p class="mt-1 text-xs leading-relaxed text-slate-500">
                        Apakah Anda yakin ingin menghapus akun ini? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                    </p>
                </div>

            </div>


            <!-- WARNING -->
            <div class="mb-5 rounded-lg border border-amber-200 bg-amber-50 p-3">

                <div class="flex items-start gap-2">

                    <i class="bi bi-info-circle-fill mt-0.5 text-sm text-amber-600"></i>

                    <p class="text-xs leading-relaxed text-amber-700">
                        Untuk memastikan keamanan akun, masukkan password Anda sebelum melanjutkan penghapusan.
                    </p>

                </div>

            </div>


            <!-- PASSWORD INPUT -->
            <div>

                <label
                    for="delete_account_password"
                    class="mb-1.5 block text-xs font-semibold text-slate-700"
                >
                    Password Saat Ini
                </label>

                <input
                    id="delete_account_password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password Anda"
                    class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition-all placeholder:text-slate-400 hover:border-slate-400 focus:border-red-500 focus:ring-4 focus:ring-red-100"
                >

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>


            <!-- MODAL ACTIONS -->
            <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                <!-- CANCEL -->
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-50 active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-slate-100"
                >
                    <i class="bi bi-x-lg"></i>
                    Batalkan
                </button>


                <!-- CONFIRM DELETE -->
                <button
                    type="submit"
                    class="mobile-pressable inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-red-700 hover:shadow-md active:scale-[0.98] focus:outline-none focus-visible:ring-4 focus-visible:ring-red-100"
                >
                    <i class="bi bi-trash3-fill"></i>
                    Ya, Hapus Akun
                </button>

            </div>

        </form>

    </x-modal>

</section>
