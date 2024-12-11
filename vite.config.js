import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/css/style.css',
                'resources/css/createproduct.css',
                'resources/css/details.css',
                'resources/css/welcome.css'
            ],
            refresh: true,
        }),
    ],
});
