import { defineConfig } from "@playwright/test";
export default defineConfig({
    testDir: "tests/browser",
    fullyParallel: false,
    workers: 1,
    reporter: "list",
    use: {
        baseURL: "http://127.0.0.1:8000",
        channel: process.env.PLAYWRIGHT_CHANNEL || undefined,
        headless: true,
        viewport: { width: 1440, height: 1000 },
        trace: "retain-on-failure",
    },
    webServer: {
        command: "php artisan serve --host=127.0.0.1 --port=8000",
        url: "http://127.0.0.1:8000/login",
        reuseExistingServer: true,
        timeout: 60000,
    },
});
