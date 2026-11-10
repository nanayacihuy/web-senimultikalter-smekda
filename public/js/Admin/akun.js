document.addEventListener('alpine:init', () => {
    Alpine.data('akunApp', () => ({
        sidebarOpen: false,
        showPassword: false,

        togglePassword() {
            this.showPassword = !this.showPassword;
        }
    }));
});
