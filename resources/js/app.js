import './bootstrap';
import '../css/app.css';
import "../../node_modules/select2/dist/css/select2.css";

import _ from 'lodash';
window._ = _;

$('.select-genres-multiple').select2({
    'width': '100%'
});

$('.select-author').select2({
    'width': '100%'
});

$('.select-type').select2({
    'width': '100%'
});
