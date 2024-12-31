import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

import Alpine from 'alpinejs';
import.meta.glob([
    '../images/**',
]);

window.Alpine = Alpine;

Alpine.start();
