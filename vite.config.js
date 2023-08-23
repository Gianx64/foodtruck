import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';
import path from 'path'

export default defineConfig({
    server: {
        host: '10.2.139.30'
    },
    plugins: [
        laravel([
            'resources/js/app.js',
            {refresh: true,}
        ]),
        livewire({
            refresh: ['resources/css/app.css'],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});