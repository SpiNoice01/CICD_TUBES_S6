import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig(({ command }) => ({
    base: command === "serve" ? "" : "/build/",
    server: {
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,
        hmr: {
            host: "10.0.0.6",
        },
    },
    build: {
        manifest: true,
        outDir: "public/assets",
        emptyOutDir: true,
        rollupOptions: {
            input: ["resources/css/app.css", "resources/js/app.js"],
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
}));
