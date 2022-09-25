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
                'resources/js/kuber/datatables/datatables.js',
            ],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    }
});
