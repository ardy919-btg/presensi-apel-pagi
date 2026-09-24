/*
|--------------------------------------------------------------------------
| Toast & Confirm Modal Global Store
|--------------------------------------------------------------------------
|
| Pengganti alert()/confirm() bawaan browser dengan komponen modern.
| Dipasang sebagai Alpine store supaya bisa dipakai dari mana saja lewat
| window.toast.success(...) / window.confirmDialog(...).
|
*/

export function registerToastStore(Alpine) {

    let idCounter = 0;

    Alpine.store('toast', {

        items: [],

        push(type, message, duration = 4500) {

            const id = ++idCounter;

            this.items.push({
                id,
                type,
                message,
                duration,
            });

            if (duration > 0) {

                setTimeout(() => {
                    this.remove(id);
                }, duration);
            }

            return id;
        },

        remove(id) {

            this.items = this.items.filter(
                (item) => item.id !== id
            );
        },

        success(message, duration) {
            return this.push('success', message, duration);
        },

        error(message, duration) {
            return this.push('error', message, duration);
        },

        warning(message, duration) {
            return this.push('warning', message, duration);
        },

        info(message, duration) {
            return this.push('info', message, duration);
        },
    });

    window.toast = {
        success: (message, duration) => Alpine.store('toast').success(message, duration),
        error: (message, duration) => Alpine.store('toast').error(message, duration),
        warning: (message, duration) => Alpine.store('toast').warning(message, duration),
        info: (message, duration) => Alpine.store('toast').info(message, duration),
    };
}

export function registerConfirmModalStore(Alpine) {

    Alpine.store('confirmModal', {

        open: false,
        title: 'Konfirmasi',
        message: '',
        confirmText: 'Ya, Lanjutkan',
        cancelText: 'Batal',
        variant: 'default',
        resolver: null,

        show(options) {

            this.title = options.title || 'Konfirmasi';
            this.message = options.message || '';
            this.confirmText = options.confirmText || 'Ya, Lanjutkan';
            this.cancelText = options.cancelText || 'Batal';
            this.variant = options.variant || 'default';
            this.open = true;

            return new Promise((resolve) => {
                this.resolver = resolve;
            });
        },

        confirm() {

            this.open = false;

            if (this.resolver) {
                this.resolver(true);
                this.resolver = null;
            }
        },

        cancel() {

            this.open = false;

            if (this.resolver) {
                this.resolver(false);
                this.resolver = null;
            }
        },
    });

    window.confirmDialog = (options) => Alpine.store('confirmModal').show(options);

    /*
    |--------------------------------------------------------------------------
    | Intersep Form dengan atribut data-confirm
    |--------------------------------------------------------------------------
    |
    | Pengganti onsubmit="return confirm('...')". Pakai:
    | <form data-confirm="Yakin ingin menghapus?" data-confirm-variant="danger">
    |
    */

    document.addEventListener('submit', function (event) {

        const form = event.target;

        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        if (!form.hasAttribute('data-confirm')) {
            return;
        }

        if (form.dataset.confirmed === 'true') {
            return;
        }

        event.preventDefault();

        window.confirmDialog({
            title: form.dataset.confirmTitle || 'Konfirmasi',
            message: form.dataset.confirm,
            confirmText: form.dataset.confirmText || 'Ya, Lanjutkan',
            cancelText: form.dataset.confirmCancelText || 'Batal',
            variant: form.dataset.confirmVariant || 'default',
        }).then((ok) => {

            if (ok) {
                form.dataset.confirmed = 'true';
                form.submit();
            }
        });

    }, true);
}
