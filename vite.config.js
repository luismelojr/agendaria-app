import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite';
import {PrimeVueResolver} from 'unplugin-vue-components/resolvers';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            resolvers: [
                PrimeVueResolver(),
                (name) => {
                    if (name === 'Head') {
                        return {
                            importName: 'Head',
                            path: '@inertiajs/vue3',
                        }
                    }

                    if (name === 'Link') {
                        return {
                            importName: 'Link',
                            path: '@inertiajs/vue3',
                        }
                    }
                }
            ]
        }),
        AutoImport({
            imports: [
                'vue',
                {
                    '@inertiajs/vue3': ['Link', 'Head', 'router'],
                },
                {
                    '@inertiajs/vue3': ['usePage', 'useForm'],
                },
            ]
        }),
    ],
});
