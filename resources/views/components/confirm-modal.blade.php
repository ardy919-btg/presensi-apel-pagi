{{--
    Modal Konfirmasi Global.
    Sertakan sekali di layout utama. Otomatis aktif untuk form dengan
    atribut data-confirm, atau dipicu manual lewat:
    window.confirmDialog({ title, message, confirmText, cancelText, variant })
        .then((ok) => { ... });

    Gaya mengikuti ConfirmDialog project "Dashboard Anggaran": header
    bergradasi warna sesuai variant/tone, ikon lingkaran putih transparan
    di sebelah judul.
--}}

<div
    x-data
    x-show="$store.confirmModal.open"
    x-cloak
    @keydown.escape.window="$store.confirmModal.cancel()"
    @keydown.enter.window="$store.confirmModal.open && $store.confirmModal.confirm()"
    class="fixed inset-0 z-[110] flex items-center justify-center p-4"
>

    {{-- OVERLAY --}}
    <div
        x-show="$store.confirmModal.open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px]"
        @click="$store.confirmModal.cancel()"
    ></div>


    {{-- PANEL --}}
    <div
        x-show="$store.confirmModal.open"
        x-transition:enter="transition duration-160"
        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-120"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        style="transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);"
        class="relative w-full max-w-sm rounded-2xl bg-white dark:bg-slate-800 shadow-2xl overflow-hidden"
    >

        {{-- HEADER BERGRADASI --}}
        <div
            class="px-5 py-4 flex items-center gap-3 text-white"
            :class="{
                'bg-gradient-to-r from-red-600 to-rose-600': $store.confirmModal.variant === 'danger',
                'bg-gradient-to-r from-amber-500 to-orange-600': $store.confirmModal.variant === 'warning',
                'bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600': $store.confirmModal.variant === 'default',
            }"
        >

            <div class="h-10 w-10 rounded-full bg-white/15 flex items-center justify-center shrink-0">

                {{-- Ikon Tempat Sampah (danger) --}}
                <svg
                    x-show="$store.confirmModal.variant === 'danger'"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                </svg>

                {{-- Ikon Segitiga Seru (warning) --}}
                <svg
                    x-show="$store.confirmModal.variant === 'warning'"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM10.29 3.86L1.82 18a1.5 1.5 0 001.3 2.25h17.76a1.5 1.5 0 001.3-2.25L13.71 3.86a1.5 1.5 0 00-2.42 0z"
                    />
                </svg>

                {{-- Ikon Info (default) --}}
                <svg
                    x-show="$store.confirmModal.variant === 'default'"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <circle cx="12" cy="12" r="9" />
                    <line x1="12" y1="10.5" x2="12" y2="16" />
                    <circle cx="12" cy="7.5" r="0.75" fill="currentColor" stroke="none" />
                </svg>

            </div>

            <h3
                class="text-base font-semibold"
                x-text="$store.confirmModal.title"
            ></h3>

        </div>


        {{-- BODY --}}
        <div class="px-5 py-4">

            <p
                class="text-sm text-slate-600 dark:text-slate-300"
                x-text="$store.confirmModal.message"
            ></p>

        </div>


        {{-- FOOTER --}}
        <div
            class="
                border-t border-slate-100 dark:border-slate-700
                bg-slate-50/60 dark:bg-slate-900/40
                px-5 py-3
                flex items-center justify-end gap-2
            "
        >

            <button
                type="button"
                @click="$store.confirmModal.cancel()"
                class="
                    rounded-md border border-slate-300 dark:border-slate-600
                    bg-white dark:bg-slate-800
                    px-3.5 py-1.5
                    text-sm font-medium
                    text-slate-600 dark:text-slate-300
                    hover:bg-slate-50 dark:hover:bg-slate-700
                    transition
                "
                x-text="$store.confirmModal.cancelText"
            ></button>

            <button
                type="button"
                @click="$store.confirmModal.confirm()"
                class="rounded-md px-3.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition"
                :class="{
                    'bg-gradient-to-r from-red-600 to-rose-600 shadow-red-300/50': $store.confirmModal.variant === 'danger',
                    'bg-gradient-to-r from-amber-500 to-orange-600 shadow-amber-300/50': $store.confirmModal.variant === 'warning',
                    'bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 shadow-indigo-300/50': $store.confirmModal.variant === 'default',
                }"
                x-text="$store.confirmModal.confirmText"
            ></button>

        </div>

    </div>

</div>
