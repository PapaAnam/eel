webpackJsonp([5],{"09dl":function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{lisunImg:!1,lightColor:["bg-white","bg-grayLighter","bg-lightOrange"],bg:this.set_background(this.color()),hr:this.set_background(this.color()),usingLogo:!1}},methods:{toHome:function(){window.location=base_url("/home")},set_background:function(e){var t="fg-white";return"white"!=e&&"grayLighter"!=e||(t="fg-black"),"bg-"+e+" "+t},color:function(){return _.sample(["black","white","lime","green","emerald","teal","blue","cyan","cobalt","indigo","violet","pink","magenta","crimson","red","orange","amber","yellow","brown","olive","steel","mauve","taupe","gray","dark","darker","darkBrown","darkCrimson","darkMagenta","darkIndigo","darkCyan","darkCobalt","darkTeal","darkEmerald","darkGreen","darkOrange","darkRed","darkPink","darkViolet","darkBlue","lightBlue","lightRed","lightGreen","lighterBlue","lightTeal","lightOlive","lightOrange","lightPink","grayDark","grayDarker","grayLight","grayLighter"])},isLight:function(e){return _.includes(this.lightColor,e)},login:function(){var e;$(".cc").fadeOut("slow"),$(".loader").html('<div data-role="preloader" data-type="ring"></div>').append('<h3 class="margin50 no-margin-left no-margin-right no-margin-bottom fg-white">Login</h3>'),setInterval(function(){e=$(".loader").find("h3"),e.append("."),"Login......"==e.text()&&e.text("Login")},200),axios.post("login",$("#login-form").serialize()).then(function(e){window.location=base_url("/hris/home")}).catch(function(e){500==e.response.status?$("#errorTxt").html("there is error in server"):$("#errorTxt").html(e.response.data.message),$(".cc").fadeIn("slow"),$(".loader").empty()})}},computed:{bgColor:function(){return this.bg?"fg-black":""}},mounted:function(){this.lisunImg=$('[name="logo"]').attr("content"),this.usingLogo=""!=$('[name="logo"]').attr("content"),$(document).ready(function(){$(".login-form").css({opacity:1,"-webkit-transform":"scale(1)",transform:"scale(1)"}),setTimeout(function(){$(".image-container").addClass("rounded bordered handing ani")},4e3)})}}},1:function(e,t,n){e.exports=n("cLgk")},"2gYJ":function(e,t,n){(e.exports=n("FZ+f")(!1)).push([e.i,"body[data-v-3e8ae172]{overflow:hidden}@media screen and (min-width:320px){.login-form[data-v-3e8ae172]{width:270px;height:260px;position:fixed;top:30%;left:50%;margin-left:-135px;opacity:0;-webkit-transform:scale(.8);transform:scale(.8);-webkit-transition:.5s;transition:.5s}h1[data-v-3e8ae172]{font-size:22px}.logo-lisun[data-v-3e8ae172]{top:30%;left:50%;position:fixed;width:120px;height:70px;margin-left:-60px;margin-top:-100px}.back-home[data-v-3e8ae172]{position:fixed;top:10px;left:10px;font-size:17px;border:5px solid #fff;color:#fff;padding:5px 2px;border-radius:50%;width:30px;height:30px;cursor:pointer}}@media screen and (min-width:768px){.login-form[data-v-3e8ae172]{width:25rem;height:18.75rem;position:fixed;top:55%;margin-top:-9.375rem;left:50%;margin-left:-12.5rem;opacity:0;-webkit-transform:scale(.8);transform:scale(.8);-webkit-transition:.5s;transition:.5s}.logo-lisun[data-v-3e8ae172]{top:30%;left:50%;position:fixed;width:200px;height:100px;margin-left:-100px;margin-top:-100px}.back-home[data-v-3e8ae172]{position:fixed;top:10px;left:10px;font-size:30px;border:5px solid #fff;color:#fff;padding:5px;border-radius:50%;width:50px;height:50px;cursor:pointer}}.loader[data-v-3e8ae172]{width:100%;height:100%;top:40%;left:50%;position:fixed;margin-left:-50px;margin-top:-50px}@-moz-keyframes spin-data-v-3e8ae172{0%{-moz-transform:rotate(0deg)}to{-moz-transform:rotate(1turn)}}@-webkit-keyframes spin-data-v-3e8ae172{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}@keyframes spin-data-v-3e8ae172{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}.nama-perusahaan[data-v-3e8ae172]{width:200%;color:#fff;margin-left:-50%;font-size:30px;text-align:center}.bunder[data-v-3e8ae172]{border-radius:20px}",""])},D27k:function(e,t,n){var r=n("2gYJ");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);n("rjj0")("23302317",r,!0,{})},"FZ+f":function(e,t){e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=function(e,t){var n=e[1]||"",r=e[3];if(!r)return n;if(t&&"function"==typeof btoa){var a=(i=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */"),o=r.sources.map(function(e){return"/*# sourceURL="+r.sourceRoot+e+" */"});return[n].concat(o).concat([a]).join("\n")}var i;return[n].join("\n")}(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var r={},a=0;a<this.length;a++){var o=this[a][0];"number"==typeof o&&(r[o]=!0)}for(a=0;a<e.length;a++){var i=e[a];"number"==typeof i[0]&&r[i[0]]||(n&&!i[2]?i[2]=n:n&&(i[2]="("+i[2]+") and ("+n+")"),t.push(i))}},t}},"VU/8":function(e,t){e.exports=function(e,t,n,r,a,o){var i,s=e=e||{},d=typeof e.default;"object"!==d&&"function"!==d||(i=e,s=e.default);var l,c="function"==typeof s?s.options:s;if(t&&(c.render=t.render,c.staticRenderFns=t.staticRenderFns,c._compiled=!0),n&&(c.functional=!0),a&&(c._scopeId=a),o?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(o)},c._ssrRegister=l):r&&(l=r),l){var u=c.functional,f=u?c.render:c.beforeCreate;u?(c._injectStyles=l,c.render=function(e,t){return l.call(t),f(e,t)}):c.beforeCreate=f?[].concat(f,l):[l]}return{esModule:i,exports:s,options:c}}},cLgk:function(e,t,n){var r=document.getElementById("base_url").content;window.base_url=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return r+e},window._=n("M4fF"),window.axios=n("mtWM"),window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",window.axios.defaults.baseURL=r;var a=document.head.querySelector('meta[name="csrf-token"]');a?window.axios.defaults.headers.common["X-CSRF-TOKEN"]=a.content:console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"),window.Vue=n("I3G/"),Vue.config.productionTip=!1,Vue.component("login-hris",n("lHk3"));new Vue({}).$mount("#login-hris")},lHk3:function(e,t,n){var r=n("VU/8")(n("09dl"),n("pQOe"),!1,function(e){n("D27k")},"data-v-3e8ae172",null);e.exports=r.exports},pQOe:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{staticClass:"loader"}),e._v(" "),n("div",{staticClass:"cc"},[n("div",{staticClass:"back-home",on:{click:e.toHome}},[n("span",{staticClass:"mif-arrow-left",staticStyle:{"margin-top":"-13px"}})]),e._v(" "),n("div",{staticClass:"logo-lisun animate2 animated fadeInDown"},[e.usingLogo?n("div",{staticClass:"image-container",staticStyle:{margin:"0 auto"}},[n("div",{staticClass:"frame"},[n("img",{attrs:{src:e.lisunImg}})])]):n("h1",{staticClass:"nama-perusahaan"},[e._v("Nama Perusahaan Anda")])]),e._v(" "),n("div",{class:["login-form","padding20","block-shadow","animate4","animated fadeInUp",e.bg,"bunder"]},[n("form",{attrs:{method:"post",id:"login-form"}},[n("h1",{class:["text-light align-center animate8 animated fadeIn",e.bg?"fg-black":"fg-white"]},[e._v("Login to service")]),e._v(" "),n("hr",{class:["thin animate10 animated rotateInDownLeft",e.hr]}),e._v(" "),n("br"),e._v(" "),n("div",{staticClass:"input-control text full-size animate10 animated fadeInLeft",attrs:{"data-role":"input"}},[n("label",{class:[e.bgColor],attrs:{for:"username"}},[e._v("Username:")]),e._v(" "),n("input",{staticClass:"rounded bunder",attrs:{required:"",type:"text",name:"username",id:"username"},on:{keydown:function(t){return"button"in t||!e._k(t.keyCode,"enter",13,t.key,"Enter")?(t.preventDefault(),e.login(t)):null}}}),e._v(" "),n("button",{staticClass:"button helper-button clear"},[n("span",{class:[e.bgColor,"mif-cross"]})]),e._v(" "),e._m(0)]),e._v(" "),n("br"),e._v(" "),n("br"),e._v(" "),n("div",{staticClass:"input-control password full-size animate12 animated fadeInRight",attrs:{"data-role":"input"}},[n("label",{class:[e.bgColor],attrs:{for:"password"}},[e._v("Password:")]),e._v(" "),n("input",{class:[e.bgColor,"bunder"],attrs:{required:"",type:"password",name:"password",id:"password"},on:{keydown:function(t){return"button"in t||!e._k(t.keyCode,"enter",13,t.key,"Enter")?(t.preventDefault(),e.login(t)):null}}}),e._v(" "),n("button",{staticClass:"button helper-button reveal"},[n("span",{class:[e.bgColor,"mif-looks"]})]),e._v(" "),e._m(1)]),e._v(" "),n("br"),e._v(" "),n("br"),e._v(" "),n("div",{staticClass:"form-actions"},[n("div",{staticClass:"animate16 animated bounce"},[n("button",{class:[e.hr,"bunder button full-size animate14 animated fadeIn"],attrs:{type:"submit"},on:{click:function(t){return t.preventDefault(),e.login(t)}}},[e._v("Login")])])])])])])])},staticRenderFns:[function(){var e=this.$createElement,t=this._self._c||e;return t("span",{staticClass:"help-block margin20 no-margin-left no-margin-right"},[t("strong",{staticClass:"fg-red",attrs:{id:"errorTxt"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("span",{staticClass:"help-block"},[t("strong")])}]}},rjj0:function(e,t,n){var r="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!r)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var a=n("tTVk"),o={},i=r&&(document.head||document.getElementsByTagName("head")[0]),s=null,d=0,l=!1,c=function(){},u=null,f="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function g(e){for(var t=0;t<e.length;t++){var n=e[t],r=o[n.id];if(r){r.refs++;for(var a=0;a<r.parts.length;a++)r.parts[a](n.parts[a]);for(;a<n.parts.length;a++)r.parts.push(h(n.parts[a]));r.parts.length>n.parts.length&&(r.parts.length=n.parts.length)}else{var i=[];for(a=0;a<n.parts.length;a++)i.push(h(n.parts[a]));o[n.id]={id:n.id,refs:1,parts:i}}}}function m(){var e=document.createElement("style");return e.type="text/css",i.appendChild(e),e}function h(e){var t,n,r=document.querySelector("style["+f+'~="'+e.id+'"]');if(r){if(l)return c;r.parentNode.removeChild(r)}if(p){var a=d++;r=s||(s=m()),t=x.bind(null,r,a,!1),n=x.bind(null,r,a,!0)}else r=m(),t=function(e,t){var n=t.css,r=t.media,a=t.sourceMap;r&&e.setAttribute("media",r);u.ssrId&&e.setAttribute(f,t.id);a&&(n+="\n/*# sourceURL="+a.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */");if(e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}.bind(null,r),n=function(){r.parentNode.removeChild(r)};return t(e),function(r){if(r){if(r.css===e.css&&r.media===e.media&&r.sourceMap===e.sourceMap)return;t(e=r)}else n()}}e.exports=function(e,t,n,r){l=n,u=r||{};var i=a(e,t);return g(i),function(t){for(var n=[],r=0;r<i.length;r++){var s=i[r];(d=o[s.id]).refs--,n.push(d)}t?g(i=a(e,t)):i=[];for(r=0;r<n.length;r++){var d;if(0===(d=n[r]).refs){for(var l=0;l<d.parts.length;l++)d.parts[l]();delete o[d.id]}}}};var v,b=(v=[],function(e,t){return v[e]=t,v.filter(Boolean).join("\n")});function x(e,t,n,r){var a=n?"":r.css;if(e.styleSheet)e.styleSheet.cssText=b(t,a);else{var o=document.createTextNode(a),i=e.childNodes;i[t]&&e.removeChild(i[t]),i.length?e.insertBefore(o,i[t]):e.appendChild(o)}}},tTVk:function(e,t){e.exports=function(e,t){for(var n=[],r={},a=0;a<t.length;a++){var o=t[a],i=o[0],s={id:e+":"+a,css:o[1],media:o[2],sourceMap:o[3]};r[i]?r[i].parts.push(s):n.push(r[i]={id:i,parts:[s]})}return n}}},[1]);