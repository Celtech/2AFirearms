require('../css/app.scss');

const $ = require('jquery');

require('bootstrap');

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});