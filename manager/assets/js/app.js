
import '../css/app.scss';
import 'bootstrap';
require('@coreui/coreui');

const Centrifuge = require('centrifuge');

document.addEventListener('DOMContentLoaded', function () {
    let url = document.querySelector('meta[name=centrifugo-url]').getAttribute('content');
    let centrifuge = new Centrifuge(url);
    centrifuge.subscribe('alerts', function (message) {
        console.log(message.data.message);
    });
    centrifuge.connect();
});
