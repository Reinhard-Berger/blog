define(["jquery"],(function(e){return function(){"use strict";var t={273:function(t){t.exports=e}},n={};function o(e){var r=n[e];if(void 0!==r)return r.exports;var c=n[e]={exports:{}};return t[e](c,c.exports,o),c.exports}o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,{a:t}),t},o.d=function(e,t){for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})};var r={};return function(){o.r(r);var e=o(273),t=o.n(e),n={checkboxTriggerSelector:".t3js-check-multiple-selection",checkboxSelector:'.t3js-check-multiple-selection input[type="checkbox"]',actionButton:".t3js-check-multiple-action",initialize:function(){t()((function(){t()(document).on("click",n.checkboxTriggerSelector,(function(){n.updateButton()}))}))},updateButton:function(){var e=!1;t()(n.checkboxSelector).each((function(){t()(this).prop("checked")&&(e=!0)})),t()(n.actionButton).prop("disabled",!e)}};n.initialize()}(),r}()}));