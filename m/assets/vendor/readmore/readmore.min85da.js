/**
 * Minified by jsDelivr using Terser v3.14.1.
 * Original file: /npm/readmore-js@3.0.0-beta-1/dist/readmore.js
 * 
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define("Readmore",[],t):"object"==typeof exports?exports.Readmore=t():e.Readmore=t()}(window,function(){return function(e){var t={};function o(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}return o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)o.d(n,r,function(t){return e[t]}.bind(null,r));return n},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=0)}({"./node_modules/@babel/runtime/helpers/classCallCheck.js":function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}},"./node_modules/@babel/runtime/helpers/createClass.js":function(e,t){function o(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}e.exports=function(e,t,n){return t&&o(e.prototype,t),n&&o(e,n),e}},"./node_modules/@babel/runtime/helpers/typeof.js":function(e,t){function o(e){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function n(t){return"function"==typeof Symbol&&"symbol"===o(Symbol.iterator)?e.exports=n=function(e){return o(e)}:e.exports=n=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":o(e)},n(t)}e.exports=n},"./src/readmore.js":function(e,t,o){"use strict";o.r(t);var n=o("./node_modules/@babel/runtime/helpers/classCallCheck.js"),r=o.n(n),i=o("./node_modules/@babel/runtime/helpers/createClass.js"),a=o.n(i),l=o("./node_modules/@babel/runtime/helpers/typeof.js"),s=o.n(l),c=0,d=[];function u(e,t,o){for(var n=0;n<e.length;n+=1)t.call(o,e[n],n)}function f(){return"rmjs-".concat(c+=1)}function p(e){e.style.height="auto";var t=parseInt(e.getBoundingClientRect().height,10),o=parseInt(window.getComputedStyle(e).maxHeight,10),n=parseInt(e.readmore.defaultHeight,10);e.readmore.expandedHeight=t,e.readmore.maxHeight=o,e.readmore.collapsedHeight=o||e.readmore.collapsedHeight||n,e.style.maxHeight="none"}function m(e,t){if(!d[e]){var o="";t.embedCSS&&""!==t.blockCSS&&(o+="".concat(e," + [data-readmore-toggle], ").concat(e,"[data-readmore] {\n        ").concat(t.blockCSS,"\n      }")),o+="".concat(e,"[data-readmore] {\n      transition: height ").concat(t.speed,"ms;\n      overflow: hidden;\n    }"),n=document,r=o,(i=n.createElement("style")).type="text/css",i.styleSheet?i.styleSheet.cssText=r:i.appendChild(n.createTextNode(r)),n.getElementsByTagName("head")[0].appendChild(i),d[e]=!0}var n,r,i}function h(e,t,o){var n=e;"function"==typeof e&&(n=e(t));var r,i,a=(r=n,(i=document.createElement("div")).innerHTML=r,i.firstChild);return a.setAttribute("data-readmore-toggle",t.id),a.setAttribute("aria-controls",t.id),a.addEventListener("click",function(e){this.toggle(t,e)}.bind(o)),a}[Element.prototype,CharacterData.prototype,DocumentType.prototype].forEach(function(e){Object.prototype.hasOwnProperty.call(e,"remove")||Object.defineProperty(e,"remove",{configurable:!0,enumerable:!0,writable:!0,value:function(){null!==this.parentNode&&this.parentNode.removeChild(this)}})});var y,g,b,v,S=(y=function(){u(document.querySelectorAll("[data-readmore]"),function(e){var t="true"===e.getAttribute("aria-expanded");p(e),e.style.height="".concat(t?e.readmore.expandedHeight:e.readmore.collapsedHeight,"px")})},g=100,function(){for(var e=this,t=arguments.length,o=new Array(t),n=0;n<t;n++)o[n]=arguments[n];var r=b&&!v;clearTimeout(v),v=setTimeout(function(){v=null,b||y.apply(e,o)},g),r&&y.apply(this,o)}),x={speed:100,collapsedHeight:200,heightMargin:16,moreLink:'<a href="#">Read More</a>',lessLink:'<a href="#">Close</a>',embedCSS:!0,blockCSS:"display: block; width: 100%;",startOpen:!1,sourceOrder:"after",blockProcessed:function(){},beforeToggle:function(){},afterToggle:function(){}},j=function(){function e(){var t=this;if(r()(this,e),"undefined"!=typeof window&&"undefined"!=typeof document&&document.querySelectorAll&&window.addEventListener){for(var o=arguments.length,n=new Array(o),i=0;i<o;i++)n[i]=arguments[i];var a,l=n[0],c=n[1];(a="string"==typeof l?document.querySelectorAll(l):l.nodeName?[l]:l).length&&(this.options=function e(){for(var t=arguments.length,o=new Array(t),n=0;n<t;n++)o[n]=arguments[n];var r={}.hasOwnProperty,i=o[0],a=o[1];if(o.length>2){var l=[];for(Object.keys(o).forEach(function(e){l.push(o[e])});l.length>2;){var c=l.shift(),d=l.shift();l.unshift(e(c,d))}i=l.shift(),a=l.shift()}return a&&Object.keys(a).forEach(function(t){r.call(a,t)&&("object"===s()(a[t])?(i[t]=i[t]||{},i[t]=e(i[t],a[t])):i[t]=a[t])}),i}({},x,c),"string"==typeof l?m(l,this.options):(this.instanceSelector=".".concat(f()),m(this.instanceSelector,this.options)),window.addEventListener("load",S),window.addEventListener("resize",S),this.elements=[],u(a,function(e){t.instanceSelector&&e.classList.add(t.instanceSelector.substr(1));var o=t.options.startOpen;e.readmore={defaultHeight:t.options.collapsedHeight,heightMargin:t.options.heightMargin},p(e);var n=e.readmore.heightMargin;if(e.getBoundingClientRect().height<=e.readmore.collapsedHeight+n)"function"==typeof t.options.blockProcessed&&t.options.blockProcessed(e,!1);else{e.setAttribute("data-readmore",""),e.setAttribute("aria-expanded",o),e.id=e.id||f();var r=h(o?t.options.lessLink:t.options.moreLink,e,t);e.parentNode.insertBefore(r,"before"===t.options.sourceOrder?e:e.nextSibling),e.style.height="".concat(o?e.readmore.expandedHeight:e.readmore.collapsedHeight,"px"),"function"==typeof t.options.blockProcessed&&t.options.blockProcessed(e,!0),t.elements.push(e)}}))}}return a()(e,[{key:"toggle",value:function(){var e=this,t=arguments.length<=0?void 0:arguments[0],o=function(t){var o=document.querySelector('[aria-controls="'.concat(t.id,'"]')),n=t.getBoundingClientRect().height<=t.readmore.collapsedHeight,r=n?t.readmore.expandedHeight:t.readmore.collapsedHeight;if("function"==typeof e.options.beforeToggle&&!1===e.options.beforeToggle(o,t,!n))return;t.style.height="".concat(r,"px");var i=function r(i){"function"==typeof e.options.afterToggle&&e.options.afterToggle(o,t,n),i.stopPropagation(),t.setAttribute("aria-expanded",n),t.removeEventListener("transitionend",r,!1)};t.addEventListener("transitionend",i,!1),e.options.speed<1&&i.call(e,{target:t});var a=n?e.options.lessLink:e.options.moreLink;a?o&&o.parentNode&&o.parentNode.replaceChild(h(a,t,e),o):o.remove()};if("string"==typeof t&&(t=document.querySelectorAll(t)),!t)throw new Error("Element MUST be either an HTML node or querySelector string");var n=arguments.length<=1?void 0:arguments[1];n&&(n.preventDefault(),n.stopPropagation()),"object"!==s()(t)||t.nodeName?o(t):u(t,o)}},{key:"destroy",value:function(e){var t=this;u(e?"string"==typeof e?document.querySelectorAll(e):e.nodeName?[e]:e:this.elements,function(e){if(-1!==t.elements.indexOf(e)){t.elements=t.elements.filter(function(t){return t!==e}),t.instanceSelector&&e.classList.remove(t.instanceSelector.substr(1)),delete e.readmore,e.style.height="initial",e.style.maxHeight="initial",e.removeAttribute("data-readmore"),e.removeAttribute("aria-expanded");var o=document.querySelector('[aria-controls="'.concat(e.id,'"]'));o&&o.remove(),-1!==e.id.indexOf("rmjs-")&&e.removeAttribute("id")}})}}]),e}();j.VERSION="3.0.0-beta-1",t.default=j},0:function(e,t,o){e.exports=o("./src/readmore.js")}}).default});
//# sourceMappingURL=/sm/869b46c91f030f78985a7c419178dceff7277c7d0f207a03f4ca6b37154e8d35.map