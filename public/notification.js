let firebaseConfig = {
    apiKey: "{{ config('app.api_key') }}",
    authDomain: "arbon-dashboard.firebaseapp.com",
    projectId: "arbon-dashboard",
    storageBucket: "arbon-dashboard.appspot.com",
    messagingSenderId: "104420075033",
    appId: "1:104420075033:web:3f460445218cb1ef1aec88",
    measurementId: "G-8MBD6MTT7F"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
function startFCM() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function (response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("store.token") }}',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
                success: function (response) {
                    alert('Token stored.');
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }).catch(function (error) {
            console.log(error);
        });
}
messaging.onMessage(function (payload) {
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(title, options);
});