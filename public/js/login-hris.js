webpackJsonp([5],{"09dl":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{lisunImg:!1,lightColor:["bg-white","bg-grayLighter","bg-lightOrange"],bg:this.set_background(this.color()),hr:this.set_background(this.color()),usingLogo:!1}},methods:{toHome:function(){window.location=base_url("/home")},set_background:function(t){var e="fg-white";return"white"!=t&&"grayLighter"!=t||(e="fg-black"),"bg-"+t+" "+e},color:function(){return _.sample(["black","white","lime","green","emerald","teal","blue","cyan","cobalt","indigo","violet","pink","magenta","crimson","red","orange","amber","yellow","brown","olive","steel","mauve","taupe","gray","dark","darker","darkBrown","darkCrimson","darkMagenta","darkIndigo","darkCyan","darkCobalt","darkTeal","darkEmerald","darkGreen","darkOrange","darkRed","darkPink","darkViolet","darkBlue","lightBlue","lightRed","lightGreen","lighterBlue","lightTeal","lightOlive","lightOrange","lightPink","grayDark","grayDarker","grayLight","grayLighter"])},isLight:function(t){return _.includes(this.lightColor,t)},login:function(){var t;$(".cc").fadeOut("slow"),$(".loader").html('<div data-role="preloader" data-type="ring"></div>').append('<h3 class="margin50 no-margin-left no-margin-right no-margin-bottom fg-white">Login</h3>'),setInterval(function(){t=$(".loader").find("h3"),t.append("."),"Login......"==t.text()&&t.text("Login")},200),axios.post("api/hris/login",$("#login-form").serialize()).then(function(t){window.location=base_url("/hris/home")}).catch(function(t){500==t.response.status?$("#errorTxt").html("there is error in server"):$("#errorTxt").html(t.response.data.message),$(".cc").fadeIn("slow"),$(".loader").empty()})}},computed:{bgColor:function(){return this.bg?"fg-black":""}},mounted:function(){this.lisunImg=$('[name="logo"]').attr("content"),this.usingLogo=""!=$('[name="logo"]').attr("content"),$(document).ready(function(){$(".login-form").css({opacity:1,"-webkit-transform":"scale(1)",transform:"scale(1)"}),setTimeout(function(){$(".image-container").addClass("rounded bordered handing ani")},4e3)})}}},1:function(t,e,n){t.exports=n("cLgk")},"FZ+f":function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map(function(e){var n=function(t,e){var n=t[1]||"",r=t[3];if(!r)return n;if(e&&"function"==typeof btoa){var a=(i=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */"),o=r.sources.map(function(t){return"/*# sourceURL="+r.sourceRoot+t+" */"});return[n].concat(o).concat([a]).join("\n")}var i;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n}).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var r={},a=0;a<this.length;a++){var o=this[a][0];"number"==typeof o&&(r[o]=!0)}for(a=0;a<t.length;a++){var i=t[a];"number"==typeof i[0]&&r[i[0]]||(n&&!i[2]?i[2]=n:n&&(i[2]="("+i[2]+") and ("+n+")"),e.push(i))}},e}},GBBK:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"body[data-v-1ae63bf6]{overflow:hidden}@media screen and (min-width:320px){.login-form[data-v-1ae63bf6]{width:270px;height:260px;position:fixed;top:30%;left:50%;margin-left:-135px;opacity:0;-webkit-transform:scale(.8);transform:scale(.8);-webkit-transition:.5s;transition:.5s}h1[data-v-1ae63bf6]{font-size:22px}.logo-lisun[data-v-1ae63bf6]{top:30%;left:50%;position:fixed;width:120px;height:70px;margin-left:-60px;margin-top:-100px}.back-home[data-v-1ae63bf6]{position:fixed;top:10px;left:10px;font-size:17px;border:5px solid #fff;color:#fff;padding:5px 2px;border-radius:50%;width:30px;height:30px;cursor:pointer}}@media screen and (min-width:768px){.login-form[data-v-1ae63bf6]{width:25rem;height:18.75rem;position:fixed;top:55%;margin-top:-9.375rem;left:50%;margin-left:-12.5rem;opacity:0;-webkit-transform:scale(.8);transform:scale(.8);-webkit-transition:.5s;transition:.5s}.logo-lisun[data-v-1ae63bf6]{top:30%;left:50%;position:fixed;width:200px;height:100px;margin-left:-100px;margin-top:-100px}.back-home[data-v-1ae63bf6]{position:fixed;top:10px;left:10px;font-size:30px;border:5px solid #fff;color:#fff;padding:5px;border-radius:50%;width:50px;height:50px;cursor:pointer}}.loader[data-v-1ae63bf6]{width:100%;height:100%;top:40%;left:50%;position:fixed;margin-left:-50px;margin-top:-50px}@-moz-keyframes spin-data-v-1ae63bf6{0%{-moz-transform:rotate(0deg)}to{-moz-transform:rotate(1turn)}}@-webkit-keyframes spin-data-v-1ae63bf6{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}@keyframes spin-data-v-1ae63bf6{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}.nama-perusahaan[data-v-1ae63bf6]{width:200%;color:#fff;margin-left:-50%;font-size:30px;text-align:center}.bunder[data-v-1ae63bf6]{border-radius:20px}",""])},QI2r:function(t,e,n){var r=n("GBBK");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);n("rjj0")("67f76db9",r,!0,{})},"VU/8":function(t,e){t.exports=function(t,e,n,r,a,o){var i,s=t=t||{},d=typeof t.default;"object"!==d&&"function"!==d||(i=t,s=t.default);var l,c="function"==typeof s?s.options:s;if(e&&(c.render=e.render,c.staticRenderFns=e.staticRenderFns,c._compiled=!0),n&&(c.functional=!0),a&&(c._scopeId=a),o?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},c._ssrRegister=l):r&&(l=r),l){var f=c.functional,u=f?c.render:c.beforeCreate;f?(c._injectStyles=l,c.render=function(t,e){return l.call(e),u(t,e)}):c.beforeCreate=u?[].concat(u,l):[l]}return{esModule:i,exports:s,options:c}}},cLgk:function(t,e,n){var r=document.getElementById("base_url").content;window.base_url=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return r+t},window._=n("M4fF"),window.axios=n("mtWM"),window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",window.axios.defaults.baseURL=r;var a=document.head.querySelector('meta[name="csrf-token"]');a?window.axios.defaults.headers.common["X-CSRF-TOKEN"]=a.content:console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"),window.Vue=n("I3G/"),Vue.config.productionTip=!1,Vue.component("login-hris",n("lHk3"));new Vue({}).$mount("#login-hris")},lHk3:function(t,e,n){var r=n("VU/8")(n("09dl"),n("nHeO"),!1,function(t){n("QI2r")},"data-v-1ae63bf6",null);t.exports=r.exports},nHeO:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"loader"}),t._v(" "),n("div",{staticClass:"cc"},[n("div",{staticClass:"back-home",on:{click:t.toHome}},[n("span",{staticClass:"mif-arrow-left",staticStyle:{"margin-top":"-13px"}})]),t._v(" "),n("div",{staticClass:"logo-lisun animate2 animated fadeInDown"},[t.usingLogo?n("div",{staticClass:"image-container",staticStyle:{margin:"0 auto"}},[n("div",{staticClass:"frame"},[n("img",{attrs:{src:t.lisunImg}})])]):n("h1",{staticClass:"nama-perusahaan"},[t._v("Nama Perusahaan Anda")])]),t._v(" "),n("div",{class:["login-form","padding20","block-shadow","animate4","animated fadeInUp",t.bg,"bunder"]},[n("form",{attrs:{method:"post",id:"login-form"}},[n("h1",{class:["text-light align-center animate8 animated fadeIn",t.bg?"fg-black":"fg-white"]},[t._v("Login to service")]),t._v(" "),n("hr",{class:["thin animate10 animated rotateInDownLeft",t.hr]}),t._v(" "),n("br"),t._v(" "),n("div",{staticClass:"input-control text full-size animate10 animated fadeInLeft",attrs:{"data-role":"input"}},[n("label",{class:[t.bgColor],attrs:{for:"username"}},[t._v("Username:")]),t._v(" "),n("input",{staticClass:"rounded bunder",attrs:{required:"",type:"text",name:"username",id:"username"},on:{keydown:function(e){return"button"in e||!t._k(e.keyCode,"enter",13,e.key,"Enter")?(e.preventDefault(),t.login(e)):null}}}),t._v(" "),n("button",{staticClass:"button helper-button clear"},[n("span",{class:[t.bgColor,"mif-cross"]})]),t._v(" "),t._m(0)]),t._v(" "),n("br"),t._v(" "),n("br"),t._v(" "),n("div",{staticClass:"input-control password full-size animate12 animated fadeInRight",attrs:{"data-role":"input"}},[n("label",{class:[t.bgColor],attrs:{for:"password"}},[t._v("Password:")]),t._v(" "),n("input",{class:[t.bgColor,"bunder"],attrs:{required:"",type:"password",name:"password",id:"password"},on:{keydown:function(e){return"button"in e||!t._k(e.keyCode,"enter",13,e.key,"Enter")?(e.preventDefault(),t.login(e)):null}}}),t._v(" "),n("button",{staticClass:"button helper-button reveal"},[n("span",{class:[t.bgColor,"mif-looks"]})]),t._v(" "),t._m(1)]),t._v(" "),n("br"),t._v(" "),n("br"),t._v(" "),n("div",{staticClass:"form-actions"},[n("div",{staticClass:"animate16 animated bounce"},[n("button",{class:[t.hr,"bunder button full-size animate14 animated fadeIn"],attrs:{type:"submit"},on:{click:function(e){return e.preventDefault(),t.login(e)}}},[t._v("Login")])])])])])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"help-block margin20 no-margin-left no-margin-right"},[e("strong",{staticClass:"fg-red",attrs:{id:"errorTxt"}})])},function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"help-block"},[e("strong")])}]}},rjj0:function(t,e,n){var r="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!r)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var a=n("tTVk"),o={},i=r&&(document.head||document.getElementsByTagName("head")[0]),s=null,d=0,l=!1,c=function(){},f=null,u="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function g(t){for(var e=0;e<t.length;e++){var n=t[e],r=o[n.id];if(r){r.refs++;for(var a=0;a<r.parts.length;a++)r.parts[a](n.parts[a]);for(;a<n.parts.length;a++)r.parts.push(h(n.parts[a]));r.parts.length>n.parts.length&&(r.parts.length=n.parts.length)}else{var i=[];for(a=0;a<n.parts.length;a++)i.push(h(n.parts[a]));o[n.id]={id:n.id,refs:1,parts:i}}}}function m(){var t=document.createElement("style");return t.type="text/css",i.appendChild(t),t}function h(t){var e,n,r=document.querySelector("style["+u+'~="'+t.id+'"]');if(r){if(l)return c;r.parentNode.removeChild(r)}if(p){var a=d++;r=s||(s=m()),e=x.bind(null,r,a,!1),n=x.bind(null,r,a,!0)}else r=m(),e=function(t,e){var n=e.css,r=e.media,a=e.sourceMap;r&&t.setAttribute("media",r);f.ssrId&&t.setAttribute(u,e.id);a&&(n+="\n/*# sourceURL="+a.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */");if(t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}.bind(null,r),n=function(){r.parentNode.removeChild(r)};return e(t),function(r){if(r){if(r.css===t.css&&r.media===t.media&&r.sourceMap===t.sourceMap)return;e(t=r)}else n()}}t.exports=function(t,e,n,r){l=n,f=r||{};var i=a(t,e);return g(i),function(e){for(var n=[],r=0;r<i.length;r++){var s=i[r];(d=o[s.id]).refs--,n.push(d)}e?g(i=a(t,e)):i=[];for(r=0;r<n.length;r++){var d;if(0===(d=n[r]).refs){for(var l=0;l<d.parts.length;l++)d.parts[l]();delete o[d.id]}}}};var v,b=(v=[],function(t,e){return v[t]=e,v.filter(Boolean).join("\n")});function x(t,e,n,r){var a=n?"":r.css;if(t.styleSheet)t.styleSheet.cssText=b(e,a);else{var o=document.createTextNode(a),i=t.childNodes;i[e]&&t.removeChild(i[e]),i.length?t.insertBefore(o,i[e]):t.appendChild(o)}}},tTVk:function(t,e){t.exports=function(t,e){for(var n=[],r={},a=0;a<e.length;a++){var o=e[a],i=o[0],s={id:t+":"+a,css:o[1],media:o[2],sourceMap:o[3]};r[i]?r[i].parts.push(s):n.push(r[i]={id:i,parts:[s]})}return n}}},[1]);