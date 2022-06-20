window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// quiz
// window.Echo.channel('triviaquiz').listen('PushQuiz', (event) => {
//     console.log('test push quiz ini mah');
//     console.log(event);
// });

// window.Laravel = {'csrfToken': '{{csrf_token()}}'}

// window.Echo.private('rooms.{{$room->id}}').listen('PushQuiz', (event) => {
//     console.log("It is working!");
//     console.log(event);
// });

// Echo.private('room.{{$room->id}}')
// .listen('PushQuiz', (e) => {
//      alert(e.room);
// });

window.Laravel = {'csrfToken': '{{csrf_token()}}'}
window.Echo.channel('room.{{Auth::guard("players")->user()->room_id}}')
.listen('room.stream', (e) => {
    console.log(e);
    console.log("It is working!");
});
