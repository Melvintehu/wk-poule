window._ = require('lodash');
import Dropzone from 'dropzone';
import Cropper from 'cropperjs';

window.Dropzone = Dropzone;

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;