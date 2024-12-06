import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/css/index.css',
                'resources/css/global.css',
                'resources/css/bootstrap.min.css'],
            refresh: true,
        }),
    ],
});
