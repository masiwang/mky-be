window.OneSignal = window.OneSignal || [];
OneSignal.push(function () {
    OneSignal.init({
        appId: "3dc20e45-d2a6-4113-9e0f-c80b8ec33ed6",
        notifyButton: {
            enable: false,

        },
        promptOptions: {
            slidedown: {
                enabled: true,
                autoPrompt: true,
                timeDelay: 1,
                pageViews: 1,
                actionMessage: "Kami akan memberikan notifikasi pembukaan pendanaan terbaru untuk Anda.",
                acceptButtonText: "IZINKAN",
                cancelButtonText: "TIDAK TERIMAKASIH",
            }
        }
    });
});