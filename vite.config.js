import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/Handsontable-edit.js",
                "resources/js/toast.js",
                "resources/js/toast-error.js",
            ],
            refresh: true,
        }),
    ],
});
