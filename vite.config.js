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
                'resources/js/kuber/datatables/datatables.js',
                'resources/js/kuber/admin/administrators/changePassword.js',
                'resources/js/kuber/admin/profile.js',
                'resources/js/kuber/admin/dashboard.js',

                'resources/sass/kuber/datatables/datatables.scss',
                'resources/sass/kuber/adminlte/page.scss',
                'resources/sass/kuber/admin/profile.scss',
            ],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    }
});
