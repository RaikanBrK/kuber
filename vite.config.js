import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Sass
                'resources/sass/welcome.scss',

                // JavaScript
                'resources/js/app.js',
                'resources/js/welcome.js',
                
                // Kuber
                'resources/js/kuber/appAdminlte.js',
                'resources/js/kuber/popover.js',
                'resources/js/admin/datatables/datatables.js',
                'resources/js/admin/administrators/changePassword.js',
                'resources/js/admin/profile.js',
                'resources/js/admin/dashboard.js',

                'resources/sass/admin/datatables/datatables.scss',
                'resources/sass/adminlte/page.scss',
                'resources/sass/admin/profile.scss',
            ],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    }
});
