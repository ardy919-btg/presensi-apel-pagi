{{--
    Kontainer Toast Global.
    Sertakan sekali di layout utama. Otomatis menampilkan flash message
    session (success/error/warning/info) dan bisa dipicu manual lewat
    window.toast.success('pesan') / .error() / .warning() / .info().

    Gaya mengikuti ToastStack project "Dashboard Anggaran": toast sukses
    memakai gradasi biru-indigo (bukan hijau) supaya senada dengan
    identitas visual aplikasi, bukan warna sukses generik.
--}}

<div
    x-data
    x-init="
        const flash = @js([
            'success' => session('success'),
            'error' => session('error'),
            'warning' => session('warning'),
            'info' => session('info'),
        ]);

        Object.keys(flash).forEach((type) => {
            if (flash[type]) {
                $store.toast.push(type, flash[type]);
            }
        });
    "
    class="
        fixed
        top-4
        inset-x-4
        sm:inset-x-auto
        sm:right-4
        z-[100]
        flex
        flex-col
        gap-3
        w-auto
        sm:w-96
        pointer-events-none
    "
>

    <template
        x-for="item in $store.toast.items"
        :key="item.id"
    >

        <div
            x-show="true"
            x-transition:enter="transition duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-6"
            style="transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);"
            class="pointer-events-auto rounded-xl border-2 p-3.5 shadow-lg flex items-start gap-3"
            :class="{
                'bg-gradient-to-r from-blue-800 via-blue-700 to-indigo-800 border-transparent text-white shadow-blue-400/50': item.type === 'success',
                'bg-red-50 border-red-300 shadow-red-200/60 dark:bg-red-900/30 dark:border-red-800': item.type === 'error',
                'bg-amber-50 border-amber-300 shadow-amber-200/60 dark:bg-amber-900/30 dark:border-amber-800': item.type === 'warning',
                'bg-indigo-50 border-indigo-300 shadow-indigo-200/60 dark:bg-indigo-900/30 dark:border-indigo-800': item.type === 'info',
            }"
        >

            {{-- IKON --}}
            <div
                class="shrink-0 h-7 w-7 rounded-full flex items-center justify-center"
                :class="{
                    'bg-white/20 text-white': item.type === 'success',
                    'bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-300': item.type === 'error',
                    'bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-300': item.type === 'warning',
                    'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-300': item.type === 'info',
                }"
            >

                <svg
                    x-show="item.type === 'success'"
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <polyline points="20 6 9 17 4 12" />
                </svg>

                <svg
                    x-show="item.type === 'error'"
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

                <svg
                    x-show="item.type === 'warning'"
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM10.29 3.86L1.82 18a1.5 1.5 0 001.3 2.25h17.76a1.5 1.5 0 001.3-2.25L13.71 3.86a1.5 1.5 0 00-2.42 0z"
                    />
                </svg>

                <svg
                    x-show="item.type === 'info'"
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <circle cx="12" cy="12" r="9" />
                    <line x1="12" y1="10.5" x2="12" y2="16" />
                    <circle cx="12" cy="7.5" r="0.75" fill="currentColor" stroke="none" />
                </svg>

            </div>


            {{-- PESAN --}}
            <p
                class="flex-1 text-sm leading-snug pt-0.5"
                :class="item.type === 'success' ? 'text-white' : 'text-slate-700 dark:text-slate-200'"
                x-text="item.message"
            ></p>


            {{-- TOMBOL TUTUP --}}
            <button
                type="button"
                @click="$store.toast.remove(item.id)"
                class="shrink-0 h-6 w-6 rounded-full flex items-center justify-center transition"
                :class="item.type === 'success'
                    ? 'text-white/70 hover:bg-white/10 hover:text-white'
                    : 'text-slate-400 hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-700'"
            >

                <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>

    </template>

</div>
