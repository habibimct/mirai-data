
@extends('layouts.app')

@section('title', 'Profile | LPK Mirai Gresik')

@section('content')

<div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="mb-6">

        <div class="mb-1 flex items-center gap-2 text-xs text-slate-400">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Administration</span>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <span class="font-medium text-slate-600">Profile</span>
        </div>

        <h2 class="text-2xl font-bold tracking-tight text-slate-900">
            Profile
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Kelola informasi akun dan keamanan akun Anda.
        </p>

    </div>


    <!-- ==========================================
         PROFILE GRID
    =========================================== -->

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

        <!-- ======================================
             PROFILE INFORMATION
        ======================================= -->

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <!-- CARD HEADER -->
            <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-person-vcard-fill text-xl"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Informasi Profile
                    </h3>

                    <p class="text-xs text-slate-400">
                        Informasi identitas akun Anda.
                    </p>
                </div>

            </div>


            <div class="p-5 sm:p-6">

                <!-- USER IDENTITY -->
                <div class="mb-6 flex flex-col items-center gap-3 rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-5 text-center sm:flex-row sm:text-left">

                    <!-- AVATAR -->
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-2xl font-bold text-white shadow-sm">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                    <!-- USER INFORMATION -->
                    <div class="min-w-0 flex-1">

                        <h4 class="break-words text-base font-bold text-slate-900">
                            {{ auth()->user()->name }}
                        </h4>

                        <p class="mt-0.5 break-all text-sm text-slate-500">
                            {{ auth()->user()->email }}
                        </p>

                        @if (auth()->user()->role)

                            <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-blue-700 ring-1 ring-blue-200">

                                <i class="bi bi-shield-check"></i>

                                {{ auth()->user()->role }}

                            </span>

                        @endif

                    </div>

                </div>


                <!-- PROFILE FORM -->
                @include('profile.partials.update-profile-information-form')

            </div>

        </div>


        <!-- ======================================
             RIGHT COLUMN
        ======================================= -->

        <div class="space-y-5">


            <!-- ==================================
                 UPDATE PASSWORD
            =================================== -->

            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <!-- CARD HEADER -->
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="bi bi-shield-lock-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Update Password
                        </h3>

                        <p class="text-xs text-slate-400">
                            Perbarui password untuk menjaga keamanan akun.
                        </p>
                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    @include('profile.partials.update-password-form')

                </div>

            </div>


            <!-- ==================================
                 DELETE ACCOUNT
            =================================== -->

            <div class="overflow-hidden rounded-xl border border-red-200 bg-white shadow-sm">

                <!-- CARD HEADER -->
                <div class="flex items-center gap-3 border-b border-red-100 bg-red-50/50 px-5 py-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="bi bi-person-x-fill text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-red-700">
                            Hapus Akun
                        </h3>

                        <p class="text-xs text-slate-500">
                            Penghapusan akun secara permanen.
                        </p>
                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    <!-- WARNING -->
                    <div class="mb-5 flex items-start gap-3 rounded-lg border border-amber-200 bg-amber-50 p-3.5">

                        <i class="bi bi-exclamation-triangle-fill mt-0.5 text-amber-600"></i>

                        <div>
                            <p class="text-xs font-bold text-amber-800">
                                Perhatian
                            </p>

                            <p class="mt-1 text-xs leading-relaxed text-amber-700">
                                Akun yang dihapus tidak dapat dikembalikan. Pastikan Anda benar-benar ingin menghapus akun ini sebelum melanjutkan.
                            </p>
                        </div>

                    </div>


                    <!-- DELETE ACCOUNT FORM -->
                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
