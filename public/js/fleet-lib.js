/*!
 * Metro UI CSS v3.0.17 (http://metroui.org.ua)
 * Copyright 2012-2017 Sergey Pimenov
 * Licensed under  ()
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(jQuery){"use strict";function keyHandler(a){if("string"==typeof a.data&&(a.data={keys:a.data}),a.data&&a.data.keys&&"string"==typeof a.data.keys){var b=a.handler,c=a.data.keys.toLowerCase().split(" ");a.handler=function(a){if(this===a.target||!($.hotkeys.options.filterInputAcceptingElements&&$.hotkeys.textInputTypes.test(a.target.nodeName)||$.hotkeys.options.filterContentEditable&&$(a.target).attr("contenteditable")||$.hotkeys.options.filterTextInputs&&$.inArray(a.target.type,$.hotkeys.textAcceptingInputTypes)>-1)){var d="keypress"!==a.type&&$.hotkeys.specialKeys[a.which],e=String.fromCharCode(a.which).toLowerCase(),f="",g={};$.each(["alt","ctrl","shift"],function(b,c){a[c+"Key"]&&d!==c&&(f+=c+"+")}),a.metaKey&&!a.ctrlKey&&"meta"!==d&&(f+="meta+"),a.metaKey&&"meta"!==d&&f.indexOf("alt+ctrl+shift+")>-1&&(f=f.replace("alt+ctrl+shift+","hyper+")),d?g[f+d]=!0:(g[f+e]=!0,g[f+$.hotkeys.shiftNums[e]]=!0,"shift+"===f&&(g[$.hotkeys.shiftNums[e]]=!0));for(var h=0,i=c.length;i>h;h++)if(g[c[h]])return b.apply(this,arguments)}}}}function handler(a){var b,c=a||window.event,d=[].slice.call(arguments,1),e=0,f=0,g=0,h=0,i=0;return a=$.event.fix(c),a.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta),c.detail&&(e=-1*c.detail),c.deltaY&&(g=-1*c.deltaY,e=g),c.deltaX&&(f=c.deltaX,e=-1*f),void 0!==c.wheelDeltaY&&(g=c.wheelDeltaY),void 0!==c.wheelDeltaX&&(f=-1*c.wheelDeltaX),h=Math.abs(e),(!lowestDelta||lowestDelta>h)&&(lowestDelta=h),i=Math.max(Math.abs(g),Math.abs(f)),(!lowestDeltaXY||lowestDeltaXY>i)&&(lowestDeltaXY=i),b=e>0?"floor":"ceil",e=Math[b](e/lowestDelta),f=Math[b](f/lowestDeltaXY),g=Math[b](g/lowestDeltaXY),d.unshift(a,e,f,g),($.event.dispatch||$.event.handle).apply(this,d)}function preCode(a){var b=Array.prototype.slice.call(document.querySelectorAll(a),0);b.forEach(function(a){var b=a.textContent.replace(/^[\r\n]+/,"").replace(/\s+$/g,"");if(/^\S/gm.test(b))return void(a.textContent=b);for(var c,d,e,f=/^[\t ]+/gm,g=1e3;c=f.exec(b);)e=c[0].length,g>e&&(g=e,d=c[0]);1e3!=g&&(a.textContent=b.replace(new RegExp("^"+d,"gm"),""))})}function touch2Mouse(a){var b,c=a.changedTouches[0];switch(a.type){case"touchstart":b="mousedown";break;case"touchend":b="mouseup";break;case"touchmove":b="mousemove";break;default:return}"mousedown"==b&&(eventTimer=(new Date).getTime(),startX=c.clientX,startY=c.clientY,mouseDown=!0),"mouseup"==b&&((new Date).getTime()-eventTimer<=500?b="click":(new Date).getTime()-eventTimer>1e3&&(b="longclick"),eventTimer=0,mouseDown=!1),"mousemove"==b&&mouseDown&&(deltaX=c.clientX-startX,deltaY=c.clientY-startY,moveDirection=deltaX>deltaY?"horizontal":"vertical");var d=document.createEvent("MouseEvent");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),c.target.dispatchEvent(d),a.preventDefault()}var $=jQuery;if(window.METRO_VERSION="3.0.17","undefined"==typeof jQuery)throw new Error("Metro's JavaScript requires jQuery");void 0===window.METRO_AUTO_REINIT&&(window.METRO_AUTO_REINIT=!0),void 0===window.METRO_LANGUAGE&&(window.METRO_LANGUAGE="en"),void 0===window.METRO_LOCALE&&(window.METRO_LOCALE="EN_en"),void 0===window.METRO_CURRENT_LOCALE&&(window.METRO_CURRENT_LOCALE="en"),void 0===window.METRO_SHOW_TYPE&&(window.METRO_SHOW_TYPE="slide"),void 0===window.METRO_DEBUG&&(window.METRO_DEBUG=!0),void 0===window.METRO_CALENDAR_WEEK_START&&(window.METRO_CALENDAR_WEEK_START=0),window.canObserveMutation="MutationObserver"in window,Number.prototype.format=function(a,b,c,d){var e="\\d(?=(\\d{"+(b||3)+"})+"+(a>0?"\\D":"$")+")",f=this.toFixed(Math.max(0,~~a));return(d?f.replace(".",d):f).replace(new RegExp(e,"g"),"$&"+(c||","))},Array.prototype.shuffle=function(){for(var a,b,c=this.length;0!==c;)b=Math.floor(Math.random()*c),c-=1,a=this[c],this[c]=this[b],this[b]=a;return this},Array.prototype.clone=function(){return this.slice(0)},Array.prototype.unique=function(){for(var a=this.concat(),b=0;b<a.length;++b)for(var c=b+1;c<a.length;++c)a[b]===a[c]&&a.splice(c--,1);return a},window.isTouchDevice=function(){return"ontouchstart"in window||navigator.MaxTouchPoints>0||navigator.msMaxTouchPoints>0},window.METRO_LOCALES={en:{months:["January","February","March","April","May","June","July","August","September","October","November","December","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Su","Mo","Tu","We","Th","Fr","Sa"],buttons:["Today","Clear","Cancel","Help","Prior","Next","Finish"]},fr:{months:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre","Jan","Fév","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc"],days:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Di","Lu","Ma","Me","Je","Ve","Sa"],buttons:["Aujourd'hui","Effacer","Annuler","Aide","Précedent","Suivant","Fin"]},nl:{months:["Januari","Februari","Maart","April","Mei","Juni","Juli","Augustus","September","Oktober","November","December","Jan","Feb","Mrt","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Dec"],days:["Zondag","Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag","Zaterdag","Zo","Ma","Di","Wo","Do","Vr","Za"],buttons:["Vandaag","Verwijderen","Annuleren","Hulp","Vorige","Volgende","Einde"]},ua:{months:["Січень","Лютий","Березень","Квітень","Травень","Червень","Липень","Серпень","Вересень","Жовтень","Листопад","Грудень","Січ","Лют","Бер","Кві","Тра","Чер","Лип","Сер","Вер","Жов","Лис","Гру"],days:["Неділя","Понеділок","Вівторок","Середа","Четвер","П’ятниця","Субота","Нд","Пн","Вт","Ср","Чт","Пт","Сб"],buttons:["Сьогодні","Очистити","Скасувати","Допомога","Назад","Вперед","Готово"]},ru:{months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь","Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"],days:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Вс","Пн","Вт","Ср","Чт","Пт","Сб"],buttons:["Сегодня","Очистить","Отменить","Помощь","Назад","Вперед","Готово"]},zhCN:{months:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月","一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],days:["星期日","星期一","星期二","星期三","星期四","星期五","星期六","日","一","二","三","四","五","六"],buttons:["今日","清除","Cancel","Help","Prior","Next","Finish"]},it:{months:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre","Gen"," Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic"],days:["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Dom","Lun","Mar","Mer","Gio","Ven","Sab"],buttons:["Oggi","Cancella","Cancel","Help","Prior","Next","Finish"]},de:{months:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember","Jan","Feb","Mrz","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"],days:["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","So","Mo","Di","Mi","Do","Fr","Sa"],buttons:["Heute","Zurücksetzen","Abbrechen","Hilfe","Früher","Später","Fertig"]},es:{months:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic"],days:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Do","Lu","Mar","Mié","Jue","Vi","Sáb"],buttons:["Hoy","Limpiar","Cancel","Help","Prior","Next","Finish"]},pt:{months:["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro","Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],days:["Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sabado","Dom","Seg","Ter","Qua","Qui","Sex","Sab"],buttons:["Hoje","Limpar","Cancelar","Ajuda","Anterior","Seguinte","Terminar"]},pl:{months:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień","Sty","Lut","Mar","Kwi","Maj","Cze","Lip","Sie","Wrz","Paź","Lis","Gru"],days:["Niedziela","Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota","Nd","Pon","Wt","Śr","Czw","Pt","Sob"],buttons:["Dzisiaj","Wyczyść","Anuluj","Pomoc","Poprzedni","Następny","Koniec"]},cs:{months:["Leden","Únor","Březen","Duben","Květen","Červen","Červenec","Srpen","Září","Říjen","Listopad","Prosinec","Led","Ún","Bř","Dub","Kvě","Če","Čer","Srp","Zá","Ří","Li","Pro"],days:["Neděle","Pondělí","Úterý","Středa","Čtvrtek","Pátek","Sobota","Ne","Po","Út","St","Čt","Pá","So"],buttons:["Dnes","Vyčistit","Zrušit","Pomoc","Předešlý","Další","Dokončit"]},th:{months:["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."],days:["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์","อา.","จ.","อ.","พ.","พฤ.","ศ.","ส."],buttons:["วันนี้","ล้าง","ยกเลิก","ช่วยเหลือ","กลับ","ต่อไป","เสร็จ"]},id:{months:["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec"],days:["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Mi","Se","Se","Ra","Ka","Ju","Sa"],buttons:["Hari Ini","Mengulang","Batalkan","Bantuan","Sebelumnya","Berikutnya","Selesai"]}};var dateFormat=function(){var a=/d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,b=/\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,c=/[^-+\dA-Z]/g,d=function(a,b){for(a=String(a),b=b||2;a.length<b;)a="0"+a;return a};return function(e,f,g){var h=dateFormat;1!==arguments.length||"[object String]"!==Object.prototype.toString.call(e)||/\d/.test(e)||(f=e,e=void 0),e=e?new Date(e):new Date,f=String(h.masks[f]||f||h.masks["default"]),"UTC:"===f.slice(0,4)&&(f=f.slice(4),g=!0);var i=window.METRO_CURRENT_LOCALE||"en",j=g?"getUTC":"get",k=e[j+"Date"](),l=e[j+"Day"](),m=e[j+"Month"](),n=e[j+"FullYear"](),o=e[j+"Hours"](),p=e[j+"Minutes"](),q=e[j+"Seconds"](),r=e[j+"Milliseconds"](),s=g?0:e.getTimezoneOffset(),t={d:k,dd:d(k),ddd:window.METRO_LOCALES[i].days[l],dddd:window.METRO_LOCALES[i].days[l+7],m:m+1,mm:d(m+1),mmm:window.METRO_LOCALES[i].months[m],mmmm:window.METRO_LOCALES[i].months[m+12],yy:String(n).slice(2),yyyy:n,h:o%12||12,hh:d(o%12||12),H:o,HH:d(o),M:p,MM:d(p),s:q,ss:d(q),l:d(r,3),L:d(r>99?Math.round(r/10):r),t:12>o?"a":"p",tt:12>o?"am":"pm",T:12>o?"A":"P",TT:12>o?"AM":"PM",Z:g?"UTC":(String(e).match(b)||[""]).pop().replace(c,""),o:(s>0?"-":"+")+d(100*Math.floor(Math.abs(s)/60)+Math.abs(s)%60,4),S:["th","st","nd","rd"][k%10>3?0:(k%100-k%10!==10)*k%10]};return f.replace(a,function(a){return a in t?t[a]:a.slice(1,a.length-1)})}}();dateFormat.masks={"default":"ddd mmm dd yyyy HH:MM:ss",shortDate:"m/d/yy",mediumDate:"mmm d, yyyy",longDate:"mmmm d, yyyy",fullDate:"dddd, mmmm d, yyyy",shortTime:"h:MM TT",mediumTime:"h:MM:ss TT",longTime:"h:MM:ss TT Z",isoDate:"yyyy-mm-dd",isoTime:"HH:MM:ss",isoDateTime:"yyyy-mm-dd'T'HH:MM:ss",isoUtcDateTime:"UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"},Date.prototype.format=function(a,b){return dateFormat(this,a,b)};var widget_uuid=0,widget_slice=Array.prototype.slice;$.cleanData=function(a){return function(b){var c,d,e;for(e=0;null!=(d=b[e]);e++)try{c=$._data(d,"events"),c&&c.remove&&$(d).triggerHandler("remove")}catch(f){}a(b)}}($.cleanData),$.widget=function(a,b,c){var d,e,f,g,h={},i=a.split(".")[0];return a=a.split(".")[1],d=i+"-"+a,c||(c=b,b=$.Widget),$.expr[":"][d.toLowerCase()]=function(a){return!!$.data(a,d)},$[i]=$[i]||{},e=$[i][a],f=$[i][a]=function(a,b){return this._createWidget?void(arguments.length&&this._createWidget(a,b)):new f(a,b)},$.extend(f,e,{version:c.version,_proto:$.extend({},c),_childConstructors:[]}),g=new b,g.options=$.widget.extend({},g.options),$.each(c,function(a,c){return $.isFunction(c)?void(h[a]=function(){var d=function(){return b.prototype[a].apply(this,arguments)},e=function(c){return b.prototype[a].apply(this,c)};return function(){var a,b=this._super,f=this._superApply;return this._super=d,this._superApply=e,a=c.apply(this,arguments),this._super=b,this._superApply=f,a}}()):void(h[a]=c)}),f.prototype=$.widget.extend(g,{widgetEventPrefix:e?g.widgetEventPrefix||a:a},h,{constructor:f,namespace:i,widgetName:a,widgetFullName:d}),e?($.each(e._childConstructors,function(a,b){var c=b.prototype;$.widget(c.namespace+"."+c.widgetName,f,b._proto)}),delete e._childConstructors):b._childConstructors.push(f),$.widget.bridge(a,f),f},$.widget.extend=function(a){for(var b,c,d=widget_slice.call(arguments,1),e=0,f=d.length;f>e;e++)for(b in d[e])c=d[e][b],d[e].hasOwnProperty(b)&&void 0!==c&&(a[b]=$.isPlainObject(c)?$.isPlainObject(a[b])?$.widget.extend({},a[b],c):$.widget.extend({},c):c);return a},$.widget.bridge=function(a,b){var c=b.prototype.widgetFullName||a;$.fn[a]=function(d){var e="string"==typeof d,f=widget_slice.call(arguments,1),g=this;return e?this.each(function(){var b,e=$.data(this,c);return"instance"===d?(g=e,!1):e?$.isFunction(e[d])&&"_"!==d.charAt(0)?(b=e[d].apply(e,f),b!==e&&void 0!==b?(g=b&&b.jquery?g.pushStack(b.get()):b,!1):void 0):$.error("no such method '"+d+"' for "+a+" widget instance"):$.error("cannot call methods on "+a+" prior to initialization; attempted to call method '"+d+"'")}):(f.length&&(d=$.widget.extend.apply(null,[d].concat(f))),this.each(function(){var a=$.data(this,c);a?(a.option(d||{}),a._init&&a._init()):$.data(this,c,new b(d,this))})),g}},$.Widget=function(){},$.Widget._childConstructors=[],$.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(a,b){b=$(b||this.defaultElement||this)[0],this.element=$(b),this.uuid=widget_uuid++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=$(),this.hoverable=$(),this.focusable=$(),b!==this&&($.data(b,this.widgetFullName,this),this._on(!0,this.element,{remove:function(a){a.target===b&&this.destroy()}}),this.document=$(b.style?b.ownerDocument:b.document||b),this.window=$(this.document[0].defaultView||this.document[0].parentWindow)),this.options=$.widget.extend({},this.options,this._getCreateOptions(),a),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:$.noop,_getCreateEventData:$.noop,_create:$.noop,_init:$.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData($.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:$.noop,widget:function(){return this.element},option:function(a,b){var c,d,e,f=a;if(0===arguments.length)return $.widget.extend({},this.options);if("string"==typeof a)if(f={},c=a.split("."),a=c.shift(),c.length){for(d=f[a]=$.widget.extend({},this.options[a]),e=0;e<c.length-1;e++)d[c[e]]=d[c[e]]||{},d=d[c[e]];if(a=c.pop(),1===arguments.length)return void 0===d[a]?null:d[a];d[a]=b}else{if(1===arguments.length)return void 0===this.options[a]?null:this.options[a];f[a]=b}return this._setOptions(f),this},_setOptions:function(a){var b;for(b in a)this._setOption(b,a[b]);return this},_setOption:function(a,b){return this.options[a]=b,"disabled"===a&&(this.widget().toggleClass(this.widgetFullName+"-disabled",!!b),b&&(this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus"))),this},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_on:function(a,b,c){var d,e=this;"boolean"!=typeof a&&(c=b,b=a,a=!1),c?(b=d=$(b),this.bindings=this.bindings.add(b)):(c=b,b=this.element,d=this.widget()),$.each(c,function(c,f){function g(){return a||e.options.disabled!==!0&&!$(this).hasClass("ui-state-disabled")?("string"==typeof f?e[f]:f).apply(e,arguments):void 0}"string"!=typeof f&&(g.guid=f.guid=f.guid||g.guid||$.guid++);var h=c.match(/^([\w:-]*)\s*(.*)$/),i=h[1]+e.eventNamespace,j=h[2];j?d.delegate(j,i,g):b.bind(i,g)})},_off:function(a,b){b=(b||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,a.unbind(b).undelegate(b),this.bindings=$(this.bindings.not(a).get()),this.focusable=$(this.focusable.not(a).get()),this.hoverable=$(this.hoverable.not(a).get())},_delay:function(a,b){function c(){return("string"==typeof a?d[a]:a).apply(d,arguments)}var d=this;return setTimeout(c,b||0)},_hoverable:function(a){this.hoverable=this.hoverable.add(a),this._on(a,{mouseenter:function(a){$(a.currentTarget).addClass("ui-state-hover")},mouseleave:function(a){$(a.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(a){this.focusable=this.focusable.add(a),this._on(a,{focusin:function(a){$(a.currentTarget).addClass("ui-state-focus")},focusout:function(a){$(a.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(a,b,c){var d,e,f=this.options[a];if(c=c||{},b=$.Event(b),b.type=(a===this.widgetEventPrefix?a:this.widgetEventPrefix+a).toLowerCase(),b.target=this.element[0],e=b.originalEvent)for(d in e)d in b||(b[d]=e[d]);return this.element.trigger(b,c),!($.isFunction(f)&&f.apply(this.element[0],[b].concat(c))===!1||b.isDefaultPrevented())}},$.each({show:"fadeIn",hide:"fadeOut"},function(a,b){$.Widget.prototype["_"+a]=function(c,d,e){"string"==typeof d&&(d={effect:d});var f,g=d?d===!0||"number"==typeof d?b:d.effect||b:a;d=d||{},"number"==typeof d&&(d={duration:d}),f=!$.isEmptyObject(d),d.complete=e,d.delay&&c.delay(d.delay),f&&$.effects&&$.effects.effect[g]?c[a](d):g!==a&&c[g]?c[g](d.duration,d.easing,e):c.queue(function(b){$(this)[a](),e&&e.call(c[0]),b()})}});var widget=$.widget;$.fn.reverse=Array.prototype.reverse,$.Metro={hotkeys:[],initWidgets:function(a){$.each(a,function(){var a=$(this),b=a.data("role").split(/\s*,\s*/);b.map(function(b){try{void 0!==$.fn[b]&&a.data(b+"-initiated")!==!0&&($.fn[b].call(a),a.data(b+"-initiated",!0))}catch(c){window.METRO_DEBUG&&console.log(c.message,c.stack)}})})},initHotkeys:function(a){$.each(a,function(){var a=$(this),b=a.data("hotkey").toLowerCase();a.data("hotKeyBonded")!==!0&&($.Metro.hotkeys.push(b),$(document).on("keyup",null,b,function(){return void 0!==a?("A"===a[0].tagName&&void 0!==a.attr("href")&&""!==a.attr("href").trim()&&"#"!==a.attr("href").trim()?document.location.href=a.attr("href"):a.click(),!1):void 0}),a.data("hotKeyBonded",!0))})},init:function(){var a=$("[data-role]"),b=$("[data-hotkey]");$.Metro.initHotkeys(b),$.Metro.initWidgets(a);var c,d,e;d={childList:!0,subtree:!0},e=function(a){a.map(function(a){if(a.addedNodes)for(var b,c,d,e,f=0,g=a.addedNodes.length;g>f;f++)b=$(a.addedNodes[f]),d=b.find("[data-role]"),e=b.find("[data-hotkey]"),$.Metro.initHotkeys(e),c=void 0!==b.data("role")?$.merge(d,b):d,c.length&&$.Metro.initWidgets(c)})},c=new MutationObserver(e),c.observe(document,d)}};var utils={isColor:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},isUrl:function(){return/^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(this)},secondsToFormattedString:function(a){var b,c,d;return b=parseInt(a/3600)%24,c=parseInt(a/60)%60,d=a%60,(b?b+":":"")+(10>c?"0"+c:c)+":"+(10>d?"0"+d:d)},uniqueId:function(){var a=(new Date).getTime(),b="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(b){var c=(a+16*Math.random())%16|0;return a=Math.floor(a/16),("x"==b?c:3&c|8).toString(16)});return b},isTouchDevice:function(){return"ontouchstart"in window||navigator.MaxTouchPoints>0||navigator.msMaxTouchPoints>0},arrayUnique:function(a){for(var b=a.concat(),c=0;c<b.length;++c)for(var d=c+1;d<b.length;++d)b[c]===b[d]&&b.splice(d--,1);return b},arrayClone:function(a){return a.slice(0)},arrayShuffle:function(a){for(var b,c,d=a.length;0!==d;)c=Math.floor(Math.random()*d),d-=1,b=a[d],a[d]=a[c],a[c]=b;return a},hex2rgba:function(a,b){var c;if(b=isNaN(b)?1:b,/^#([A-Fa-f0-9]{3}){1,2}$/.test(a))return c=a.substring(1).split(""),3==c.length&&(c=[c[0],c[0],c[1],c[1],c[2],c[2]]),c="0x"+c.join(""),"rgba("+[c>>16&255,c>>8&255,255&c].join(",")+","+b+")";throw new Error("Hex2rgba error. Bad Hex value")},random:function(a,b){return Math.floor(Math.random()*(b-a+1)+a)},isInt:function(a){return Number(a)===a&&a%1===0},isFloat:function(a){return Number(a)===a&&a%1!==0}};$.metroUtils=window.metroUtils=utils,$.easing.jswing=$.easing.swing,$.extend($.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return $.easing[$.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){return(b/=e/2)<1?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){return(b/=e/2)<1?d/2*b*b*b+c:d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){return(b/=e/2)<1?d/2*b*b*b*b+c:-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){return(b/=e/2)<1?d/2*b*b*b*b*b+c:d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return 0==b?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){return 0==b?c:b==e?c+d:(b/=e/2)<1?d/2*Math.pow(2,10*(b-1))+c:d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){return(b/=e/2)<1?-d/2*(Math.sqrt(1-b*b)-1)+c:d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;return 0==b?c:1==(b/=e)?c+d:(g||(g=.3*e),h<Math.abs(d)?(h=d,f=g/4):f=g/(2*Math.PI)*Math.asin(d/h),-(h*Math.pow(2,10*(b-=1))*Math.sin(2*(b*e-f)*Math.PI/g))+c)},easeOutElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;return 0==b?c:1==(b/=e)?c+d:(g||(g=.3*e),h<Math.abs(d)?(h=d,f=g/4):f=g/(2*Math.PI)*Math.asin(d/h),h*Math.pow(2,-10*b)*Math.sin(2*(b*e-f)*Math.PI/g)+d+c)},easeInOutElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;return 0==b?c:2==(b/=e/2)?c+d:(g||(g=.3*e*1.5),h<Math.abs(d)?(h=d,f=g/4):f=g/(2*Math.PI)*Math.asin(d/h),1>b?-.5*h*Math.pow(2,10*(b-=1))*Math.sin(2*(b*e-f)*Math.PI/g)+c:h*Math.pow(2,-10*(b-=1))*Math.sin(2*(b*e-f)*Math.PI/g)*.5+d+c)},easeInBack:function(a,b,c,d,e,f){return void 0==f&&(f=1.70158),d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){return void 0==f&&(f=1.70158),d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){return void 0==f&&(f=1.70158),(b/=e/2)<1?d/2*b*b*(((f*=1.525)+1)*b-f)+c:d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-$.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){return(b/=e)<1/2.75?7.5625*d*b*b+c:2/2.75>b?d*(7.5625*(b-=1.5/2.75)*b+.75)+c:2.5/2.75>b?d*(7.5625*(b-=2.25/2.75)*b+.9375)+c:d*(7.5625*(b-=2.625/2.75)*b+.984375)+c},easeInOutBounce:function(a,b,c,d,e){return e/2>b?.5*$.easing.easeInBounce(a,2*b,0,d,e)+c:.5*$.easing.easeOutBounce(a,2*b-e,0,d,e)+.5*d+c}}),$.hotkeys={version:"0.8",specialKeys:{8:"backspace",9:"tab",10:"return",13:"return",16:"shift",17:"ctrl",18:"alt",19:"pause",20:"capslock",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"del",59:";",61:"=",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9",106:"*",107:"+",109:"-",110:".",111:"/",112:"f1",113:"f2",114:"f3",115:"f4",116:"f5",117:"f6",118:"f7",119:"f8",120:"f9",121:"f10",122:"f11",123:"f12",144:"numlock",145:"scroll",173:"-",186:";",187:"=",188:",",189:"-",190:".",191:"/",192:"`",219:"[",220:"\\",221:"]",222:"'"},shiftNums:{"`":"~",1:"!",2:"@",3:"#",4:"$",5:"%",6:"^",7:"&",8:"*",9:"(",0:")","-":"_","=":"+",";":": ","'":'"',",":"<",".":">","/":"?","\\":"|"},textAcceptingInputTypes:["text","password","number","email","url","range","date","month","week","time","datetime","datetime-local","search","color","tel"],textInputTypes:/textarea|input|select/i,options:{filterInputAcceptingElements:!0,filterTextInputs:!0,filterContentEditable:!0}},$.each(["keydown","keyup","keypress"],function(){$.event.special[this]={add:keyHandler}});var toFix=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],toBind="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],lowestDelta,lowestDeltaXY;if($.event.fixHooks)for(var i=toFix.length;i;)$.event.fixHooks[toFix[--i]]=$.event.mouseHooks;$.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=toBind.length;a;)this.addEventListener(toBind[--a],handler,!1);else this.onmousewheel=handler},teardown:function(){if(this.removeEventListener)for(var a=toBind.length;a;)this.removeEventListener(toBind[--a],handler,!1);else this.onmousewheel=null}},$.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}}),document.addEventListener("DOMContentLoaded",function(){preCode("pre code, textarea")},!1);var hasTouch="ontouchend"in window,eventTimer,moveDirection="undefined",startX,startY,deltaX,deltaY,mouseDown=!1,addTouchEvents=function(a){hasTouch&&(a.addEventListener("touchstart",touch2Mouse,!0),a.addEventListener("touchmove",touch2Mouse,!0),a.addEventListener("touchend",touch2Mouse,!0))},TemplateEngine=function(a,b){for(var c,d,e=/<%(.+?)%>/g,f=/(^( )?(var|if|for|else|switch|case|break|{|}|;))(.*)?/g,g="with(obj) { var r=[];\n",h=0,i=function(a,b){return g+=b?a.match(f)?a+"\n":"r.push("+a+");\n":""!=a?'r.push("'+a.replace(/"/g,'\\"')+'");\n':"",i};d=e.exec(a);)i(a.slice(h,d.index))(d[1],!0),h=d.index+d[0].length;i(a.substr(h,a.length-h)),g=(g+'return r.join(""); }').replace(/[\r\t\n]/g," ");try{c=new Function("obj",g).apply(b,[b])}catch(j){console.error("'"+j.message+"'"," in \n\nCode:\n",g,"\n")}return c};window.metroTemplate=TemplateEngine,$.Template=TemplateEngine,$.widget("metro.accordion",{version:"3.0.0",options:{closeAny:!1,speed:"fast",onFrameOpen:function(){return!0},onFrameOpened:function(){},onFrameClose:function(){return!0},onFrameClosed:function(){}},init:function(){var a=this,b=this.element;b.on("click",".heading",function(b){var c=$(this).parent();return c.hasClass("disabled")?!1:(c.hasClass("active")?a._closeFrame(c):a._openFrame(c),b.preventDefault(),void b.stopPropagation())})},_closeAllFrames:function(){var a=this,b=this.element.children(".frame.active");$.each(b,function(){a._closeFrame($(this))})},_openFrame:function(frame){var o=this.options,content=frame.children(".content"),result;if("function"==typeof o.onFrameOpen){if(!o.onFrameOpen(frame))return!1}else if("function"==typeof window[o.onFrameOpen]){if(!window[o.onFrameOpen](frame))return!1}else if(result=eval("(function(){"+o.onFrameOpen+"})"),!result.call(frame))return!1;o.closeAny&&this._closeAllFrames(),content.slideDown(o.speed),frame.addClass("active"),"function"==typeof o.onFrameOpened?o.onFrameOpened(frame):"function"==typeof window[o.onFrameOpened]?window[o.onFrameOpened](frame):(result=eval("(function(){"+o.onFrameOpened+"})"),result.call(frame))},_closeFrame:function(frame){var o=this.options,content=frame.children(".content"),result;if("function"==typeof o.onFrameClose){if(!o.onFrameClose(frame))return!1}else if("function"==typeof window[o.onFrameClose]){if(!window[o.onFrameClose](frame))return!1}else if(result=eval("(function(){"+o.onFrameClose+"})"),!result.call(frame))return!1;content.slideUp(o.speed,function(){frame.removeClass("active")}),"function"==typeof o.onFrameClosed?o.onFrameClosed(frame):"function"==typeof window[o.onFrameClosed]?window[o.onFrameClosed](frame):(result=eval("(function(){"+o.onFrameClosed+"})"),result.call(frame))},_create:function(){var a=this,b=this.options,c=this.element;$.each(this.element.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),a.init(),c.data("accordion",this)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.appbar",{version:"3.0.0",options:{flexstyle:"app-bar-menu",flexclean:!1,flextolerance:3},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._initBar(),a.data("appbar",this)},_calculateFreeSpace:function(){var a,b,c=this,d=(this.element,this.options,0),e=0;d=$(c.menusParent).width(),a=$(c.menusParent).children(":visible").not(".app-bar-pullmenu");for(var f,g=[],h=[],i=[],j=0,k=a.length;k>j;j++)switch(f=$(a[j]).css("float")){case"left":g.push(a[j]);break;case"right":h.push(a[j]);break;default:i.push(a[j])}h.reverse(),a=new Array,a=g.concat(i,h),a=$(a),e+=parseInt($(a).first().css("margin-left"));for(var j=0,k=a.length-1;k>=j;j++)e+=$(a[j]).outerWidth(),j!==k&&(e+=Math.max(parseInt($(a[j]).css("margin-right")),parseInt($(a[j+1]).css("margin-left"))));return e+=parseInt($(a[k]).css("margin-right")),b=d-e,c.freeSpace=b,c.childrenWidth=e,c.menusParentWidth=d,b},_originIndexMove:function(a,b){var c=$(a).children().filter(function(){return parseInt($(this).attr("data-flexorderorigin"))<parseInt($(b).attr("data-flexorderorigin"))});c.length>0?$(c).last().after(b):(c=$(a).children().filter(function(){return parseInt($(this).attr("data-flexorderorigin"))>parseInt($(b).attr("data-flexorderorigin"))}),c.length>0?$(c).first().before(b):$(a).append(b))},_moveMenuEntry:function(a){{var b=this;this.element,this.options}if(a=a||"toPullMenu","toPullMenu"===a){var c=$(b.allMenuEntries).not(".app-bar-pullmenu-entry").last();if(0===c.length)return!1;var d=$(c).parent(),e=$(b.flexVisibles).index($(c).parent()),f=$(b.pullMenu).find(".app-bar-pullmenubar").eq(e);return b._originIndexMove(f,c),$(c).addClass("app-bar-pullmenu-entry"),$(f).removeClass("hidden").show(),0===$(d).children().length&&$(d).addClass("hidden"),$(b.pullButton).show(),c}if("fromPullMenu"===a){var g=$(b.allMenuEntries).filter(".app-bar-pullmenu-entry").first(),f=$(g).parent(),e=$(f).index(),d=$(b.flexVisibles).eq(e);return $(d).removeClass("hidden"),$(g).removeClass("app-bar-pullmenu-entry"),b._originIndexMove(d,g),0===$(f).children().length&&$(f).addClass("hidden").hide(),0===$(b.pullMenu).children(".app-bar-pullmenubar").not(".hidden").length&&($(b.pullMenu).hide().addClass("hidden"),$(b.pullButton).hide()),0===g.length?!1:g}},_checkMenuEntries:function(){for(var a=this,b=(this.element,this.options),c=!1,d=0,e=a.allMenuEntries.length;e>d;d++){a._calculateFreeSpace();var f=a.freeSpace;if(!(f<b.flextolerance||b.flexclean)){if(a._moveMenuEntry("fromPullMenu")){c=!0;continue}break}if(!a._moveMenuEntry("toPullMenu"))break;if(c)break}},resize:function(){{var a=this;this.element,this.options}a.initiatedAsFlex&&this._checkMenuEntries()},_initBar:function(){var a=this,b=this.element,c=this.options;a.lastFlexAction=void 0,a.pullButton=$(b).find(".app-bar-pullbutton");var d=$(b).find(".app-bar-menu");a.initiatedAsFlex=!1,c.flexclean=$(b).is("[data-flexclean='true']")||c.flexclean,c.flexstyle=$(b).attr("data-flexstyle")||c.flexstyle;var e,f;a.flexVisibles=$(),a.allMenuEntries=$(),a.menusParent=$(),a.pullMenu=$(),
d.length>0&&$(b).is(":not('.no-flexible')")&&(a.flexVisibles=$(d).not(".no-flexible"),a.flexVisibles.length>0&&(a.initiatedAsFlex=!0,a.flexVisibles.sort(function(a,b){var c=parseInt($(a).data("flexorder"))||$(a).index()+1,d=parseInt($(b).data("flexorder"))||$(b).index()+1;return c-d}),$(a.flexVisibles).each(function(){e=this,f=$(e).children(),$(f).each(function(){$(this).attr("data-flexorderorigin",$(this).index()),$(this).is("[data-flexorder]")||$(this).attr("data-flexorder",$(this).index()+1)}),f.sort(function(a,b){var c=parseInt($(a).data("flexorder")),d=parseInt($(b).data("flexorder"));return c-d}),$(e).is("[data-flexdirection='reverse']")&&f.reverse(),$.merge(a.allMenuEntries,$(f).not(".no-flexible"))}),a.menusParent=$(b).find(".app-bar-menu").first().parent(),a.pullButton.length>0||(a.pullButton=$('<div class="app-bar-pullbutton automatic"></div>'),$(a.menusParent).append(a.pullButton)),a.pullMenu=$('<nav class="app-bar-pullmenu hidden" />'),a.flexVisibles.each(function(){$(a.pullMenu).append($('<ul class="app-bar-pullmenubar hidden '+c.flexstyle+'" />'))}),$(a.menusParent).append($('<div class="clearfix" style="width: 0;">')),$(a.pullMenu).addClass("flexstyle-"+c.flexstyle),$(a.menusParent).append(a.pullMenu),a._checkMenuEntries(),$(a.pullButton).on("click",function(){a=$(this).closest("[data-role=appbar]").data("appbar"),$(a.pullMenu).is(":hidden")?($(a.pullMenu).show(),$(a.pullMenu).find(".app-bar-pullmenubar").hide().not(".hidden").slideDown("fast")):$(a.pullMenu).find(".app-bar-pullmenubar").not(".hidden").show().slideUp("fast",function(){$(a.pullMenu).hide()})})))},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$(window).on("resize",function(){$("[data-role=appbar]:not(.no-flexible)").each(function(){$(this).data("appbar").resize()})}),$(window).on("load",function(){$("[data-role=appbar]:not(.no-flexible)").each(function(){$(this).data("appbar").resize()})}),$("[data-role=appbar]:not(.no-flexible) [src]").on("load",function(){var a=$(this).closest("[data-role=appbar]").data("appbar");a.resize()}),$.widget("metro.audio",{version:"3.0.14",options:{src:!1,volume:.5,muted:!1,loop:!1,preload:!1,autoplay:!1,playList:!1,mode:"full",loopButton:"<span class='mif-loop'></span>",stopButton:"<span class='mif-stop'></span>",playButton:"<span class='mif-play'></span>",pauseButton:"<span class='mif-pause'></span>",muteButton:"<span class='mif-volume-mute2'></span>",shuffleButton:"<span class='mif-shuffle'></span>",nextButton:"<span class='mif-forward'></span>",prevButton:"<span class='mif-backward'></span>",randomButton:"<span class='mif-dice'></span>",playListButton:"<span class='mif-list2'></span>",volumeLowButton:"<span class='mif-volume-low'></span>",volumeMediumButton:"<span class='mif-volume-medium'></span>",volumeHighButton:"<span class='mif-volume-high'></span>"},_create:function(){{var a=this.element;this.options}this._setOptionsFromDOM(),this._createPlayer(),this._addControls(),this._addEvents(),this._addPlayList(),this._setControlsVisibility(),a.data("audio",this)},_setControlsVisibility:function(){{var a=this.element;this.options}0==a.find(".play-list").length&&(a.find(".controls .plist").hide(),a.find(".controls .next").hide(),a.find(".controls .prev").hide(),a.find(".controls .random").hide())},_addPlayList:function(){{var a,b,c,d,e,f,g=this,h=this.element,i=this.options;h.find("audio")}if(i.playList&&void 0!=window[i.playList]&&"function"==typeof window[i.playList]&&(a=window[i.playList](),b=a.items,c=$("<div>").addClass("play-list-wrapper").insertBefore(h.find("audio")),void 0!=a.title&&(e=$("<h1>").addClass("album-title").html(a.title).appendTo(c)),void 0!=a.poster&&(d=$("<div>").addClass("poster").html($("<img>").attr("src",a.poster)).appendTo(c)),void 0!=a.desc&&$("<div>").addClass("album-desc").html(a.desc).appendTo(d),f=$("<ul>").addClass("play-list").appendTo(c),void 0!=b&&$.each(a.items,function(){var a,b=this;a=$("<li>").appendTo(f),a.data("src",b.file),void 0!=b.type&&a.data("type",b.type),a.html(void 0!=b.title?b.title:b.file.replace(/^.*[\\\/]/,""))})),f=h.find("ul"),0==f.length)return this;f.addClass("play-list");var j=f.find("li");return 0==j.length?this:($.each(j,function(){{var a=$(this);$("<div>").addClass("progress-bar small no-margin-top").data("role","progress").appendTo(a).hide()}a.on("click",function(){j.removeClass("current"),j.find(".progress-bar").hide();var b=a.data("src"),c=a.data("type");a.addClass("current"),a.find(".progress-bar").show(),h.data("current",a),g.play(b,c)})}),$(j[0]).click(),this._stop(),void h.data("current",$(j[0])))},_createPlayer:function(){var a=this.element,b=this.options,c=a.find("audio");a.addClass("audio-player"),a.addClass(b.mode),0==c.length&&(c=$("<audio>").appendTo(a)),$.each(["autoplay","controls","muted","loop","preload"],function(){c.removeAttr(this)}),b.src&&c.attr(src,b.src),b.loop&&c.attr("loop","loop"),b.preload&&c.attr("preload","auto"),b.autoplay&&c.attr("autoplay","autoplay"),c[0].volume=b.volume,c[0].muted=b.muted,a.data("muted",!1),a.data("duration",0),a.data("played",!1),a.data("volume",c[0].volume),a.data("current",!1)},_addControls:function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o=this,p=this.element,q=this.options,r=p.find("audio"),s=r[0];a=$("<div>").addClass("controls").appendTo(p),q.playListButton!==!1&&(n=$("<button/>").addClass("square-button control-element plist").html(q.playListButton).appendTo(a),n.on("click",function(){var a=p.find(".play-list-wrapper");return 0==a.length?o:void a.toggleClass("not-visible")})),q.loopButton!==!1&&(c=$("<button/>").addClass("square-button control-element loop").html(q.loopButton).appendTo(a),c.on("click",function(){c.toggleClass("active"),c.hasClass("active")?r.attr("loop","loop"):r.removeAttr("loop")})),q.playButton!==!1&&(b=$("<button/>").addClass("square-button control-element play").html(q.playButton).appendTo(a),b.on("click",function(){o._play()})),q.prevButton!==!1&&(l=$("<button/>").addClass("square-button control-element prev").html(q.prevButton).appendTo(a),l.on("click",function(){o._playPrev()})),q.nextButton!==!1&&(k=$("<button/>").addClass("square-button control-element next").html(q.nextButton).appendTo(a),k.on("click",function(){o._playNext()})),q.randomButton!==!1&&(m=$("<button/>").addClass("square-button control-element random").html(q.randomButton).appendTo(a),m.on("click",function(){o._playRandom()})),q.stopButton!==!1&&(d=$("<button/>").addClass("square-button control-element stop").html(q.stopButton).appendTo(a),d.attr("disabled",!0),d.on("click",function(){o._stop()})),i=$("<div/>").addClass("control-element stream-wrapper").appendTo(a),g=$("<div/>").addClass("slider stream-slider").appendTo(i),g.slider({showHint:!0,animate:!1,markerColor:"bg-red",completeColor:"bg-cyan",onStartChange:function(){s.pause()},onChanged:function(a){s.seekable.length>0&&(s.currentTime=(p.data("duration")*a/100).toFixed(0)),p.data("played")&&s.currentTime>=0&&s.play()}}),g.data("slider").value(0),h=$("<div/>").addClass("control-element info-box").appendTo(a),h.html("00:00 / 00:00");var t=$("<div/>").addClass("place-right").appendTo(a);e=$("<button/>").addClass("square-button control-element volume").html(q.volumeLowButton).appendTo(t),e.on("click",function(){var a=p.find(".volume-slider").data("slider");p.data("muted",!p.data("muted")),p.data("muted")?(p.data("volume",s.volume),e.html(q.muteButton),a.value(0)):(s.volume=p.data("volume"),a.value(100*p.data("volume")),o._setupVolumeButton()),s.muted=p.data("muted")}),this._setupVolumeButton(),j=$("<div/>").addClass("control-element volume-wrapper").appendTo(t),f=$("<div/>").addClass("slider volume-slider").appendTo(j),f.slider({showHint:!0,animate:!1,markerColor:"bg-red",completeColor:"bg-green",onChange:function(a){s.volume=a/100,o._setupVolumeButton()}}),f.data("slider").value(100*s.volume)},_setupVolumeButton:function(){var a=this.element,b=this.options,c=a.find("audio"),d=c[0],e=a.find(".controls"),f=e.find(".volume"),g=d.volume;f.html(g>0&&.3>g?b.volumeLowButton:g>=.3&&.6>g?b.volumeMediumButton:g>=.6&&1>=g?b.volumeHighButton:b.muteButton)},_addEvents:function(){var a=this,b=this.element,c=(this.options,b.find("audio")),d=c[0],e=(b.find(".controls"),b.find(".info-box"));c.on("loadedmetadata",function(){b.data("duration",d.duration.toFixed(0)),e.html("00:00 / "+metroUtils.secondsToFormattedString(b.data("duration")))}),c.on("canplay",function(){var b=d.buffered.length?Math.round(Math.floor(d.buffered.end(0))/Math.floor(d.duration)*100):0;a._setBufferSize(b)}),c.on("progress",function(){var b=d.buffered.length?Math.round(Math.floor(d.buffered.end(0))/Math.floor(d.duration)*100):0;a._setBufferSize(b)}),c.on("timeupdate",function(){if(a._setInfoData(),a._setStreamSliderPosition(),b.data("current")){var c=b.data("current").find(".progress-bar").data("progress"),e=Math.round(100*d.currentTime/b.data("duration"));c.value(e)}}),c.on("waiting",function(){}),c.on("loadeddata",function(){}),c.on("ended",function(){a._stop(),b.find(".play-list li").length>0&&a._playNext()})},_setInfoData:function(){var a=this.element,b=(a[0],this.options,a.find("audio")),c=b[0],d=a.find(".controls .info-box"),e=Math.round(c.currentTime);d.html(metroUtils.secondsToFormattedString(e)+" / "+metroUtils.secondsToFormattedString(a.data("duration")))},_setStreamSliderPosition:function(){var a=this.element,b=(a[0],this.options,a.find("audio")),c=b[0],d=a.find(".stream-slider").data("slider"),e=Math.round(100*c.currentTime/a.data("duration"));d.value(e)},_setBufferSize:function(a){var b=this.element,c=(b[0],this.options,b.find("audio")),d=(c[0],b.find(".stream-slider").data("slider"));d.buffer(Math.round(a))},_play:function(){var a=this.element,b=(a[0],this.options),c=a.find("audio"),d=c[0],e=a.find(".controls .play"),f=a.find(".controls .stop");d.paused?(e.html(b.pauseButton),d.play(),f.removeAttr("disabled"),a.data("played",!0),a.trigger("play")):(e.html(b.playButton),d.pause(),a.data("played",!1),a.trigger("pause"))},_playRandom:function(){var a=this.element,b=(a[0],this.options,a.find("audio")),c=(b[0],a.find(".play-list")),d=a.find(".play-list li");if(0==d.length)return this;var e=Math.floor(Math.random()*d.length)+1,f=c.find("li:nth-child("+e+")");f.click()},_playNext:function(){var a=this.element,b=(a[0],this.options,a.find("audio")),c=(b[0],a.find(".play-list")),d=a.find(".play-list li");if(0==d.length)return this;var e=c.find(".current").next();0==e.length&&(e=c.find("li:nth-child(1)")),e.click()},_playPrev:function(){var a=this.element,b=(a[0],this.options,a.find("audio")),c=(b[0],a.find(".play-list")),d=a.find(".play-list li");if(0==d.length)return this;var e=c.find(".current").prev();0==e.length&&(e=c.find("li:last-child")),e.click()},_stop:function(){var a=this.element,b=(a[0],this.options),c=a.find("audio"),d=c[0],e=a.find(".controls .stop"),f=a.find(".controls .play");d.pause(),d.currentTime=0,f.html(b.playButton),e.attr("disabled","disabled"),a.data("played",!1),a.find(".stream-slider").data("slider").value(0),a.trigger("stop")},play:function(a,b){var c,d=this.element,e=(d[0],this.options,d.find("audio")),f=e[0];this._stop(),e.find("source").remove(),e.removeAttr("src"),c=$("<source>").attr("src",a),void 0!=b&&c.attr("type",b),f.load(),c.appendTo(e),this._play()},pause:function(){var a=this.element,b=(a[0],this.options),c=a.find("audio"),d=c[0],e=a.find(".play");e.html(b.playButton),d.pause(),a.data("played",!1),a.trigger("pause")},resume:function(){var a=this.element,b=(a[0],this.options),c=a.find("audio"),d=c[0],e=a.find(".play"),f=a.find(".stop");e.html(b.pauseButton),d.play(),f.removeAttr("disabled"),a.data("played",!0),a.trigger("play")},stop:function(){this._stop()},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.group",{version:"3.0.0",options:{groupType:"one-state",buttonStyle:!1,onChange:function(){return!0},onChanged:function(){}},_create:function(){var that=this,element=this.element,o=this.options,result;$.each(element.data(),function(a,b){if(a in o)try{o[a]=$.parseJSON(b)}catch(c){o[a]=b}}),element.hasClass("group-of-buttons")||element.addClass("group-of-buttons");for(var buttons=element.find(".button, .toolbar-button"),i=0;i<buttons.length;i++)$(buttons[i]).data("index",i);o.buttonStyle!==!1&&buttons.addClass(o.buttonStyle),element.on("click",".button, .toolbar-button",function(){var button=$(this),index=button.data("index");if("function"==typeof o.onChange){if(!o.onChange(index,button))return!1}else if("function"==typeof window[o.onChange]){if(!window[o.onChange](index,button))return!1}else if(result=eval("(function(){"+o.onChange+"})"),!result.call(index,button))return!1;"one-state"===o.groupType?(buttons.removeClass("active"),$(this).addClass("active")):$(this).toggleClass("active"),"function"==typeof o.onChanged?o.onChanged(index,button):"function"==typeof window[o.onChanged]?window[o.onChanged](index,button):(result=eval("(function(){"+o.onChanged+"})"),result.call(index,button))}),element.data("group",this)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.calendar",{version:"3.0.0",options:{format:"yyyy-mm-dd",multiSelect:!1,startMode:"day",weekStart:window.METRO_CALENDAR_WEEK_START,otherDays:!0,date:new Date,minDate:!1,maxDate:!1,preset:!1,exclude:!1,stored:!1,buttons:!0,buttonToday:!0,buttonClear:!0,syncCalenderToDateField:!0,locale:window.METRO_CURRENT_LOCALE,actions:!0,condensedGrid:!1,scheme:"default",getDates:function(){},dayClick:function(){}},_year:0,_month:0,_day:0,_today:new Date,_event:"",_mode:"day",_distance:0,_events:[],_create:function(){var a=this,b=this.element,c=this.options;$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),"string"==typeof c.date&&(c.date=new Date(c.date)),c.minDate!==!1&&"string"==typeof c.minDate&&(c.minDate=new Date(c.minDate+"T00:00:00Z")-864e5),c.maxDate!==!1&&"string"==typeof c.maxDate&&(c.maxDate=new Date(c.maxDate+"T00:00:00Z")),this.locales=window.METRO_LOCALES,this._year=c.date.getFullYear(),this._distance=c.date.getFullYear()-4,this._month=c.date.getMonth(),this._day=c.date.getDate(),this._mode=c.startMode,b.data("_storage",[]),b.data("_exclude",[]),b.data("_stored",[]),b.hasClass("calendar")||b.addClass("calendar");var d,e;c.preset&&(d=/\s*,\s*/,e=c.preset.split(d),$.each(e,function(){void 0!==new Date(this)&&a.setDate(this)})),c.exclude&&(d=/\s*,\s*/,e=c.exclude.split(d),$.each(e,function(){void 0!==new Date(this)&&a.setDateExclude(this)})),c.stored&&(d=/\s*,\s*/,e=c.stored.split(d),$.each(e,function(){void 0!==new Date(this)&&a.setDateStored(this)})),"default"!==c.scheme&&b.addClass(c.scheme),this._renderCalendar(),b.data("calendar",this)},_renderButtons:function(a){var b,c,d=this.options;if(this.options.buttons){var e=d.buttonToday?"<button class='button calendar-btn-today small-button success'>"+this.locales[d.locale].buttons[0]+"</button>":"",f=d.buttonClear?"<button class='button calendar-btn-clear small-button warning'>"+this.locales[d.locale].buttons[1]+"</button>":"";b=$("<div/>").addClass("calendar-row calendar-actions"),c=$("<div/>").addClass("align-center").html(e+f),c.appendTo(b),b.appendTo(a)}},_renderMonth:function(){var a=this.options,b=this._year,c=this._month,d=(this._day,this._event,28);1===c&&(b%100!==0&&b%4===0||b%400===0)&&(d=29);var e,f,g,h,i,j=[31,d,31,30,31,30,31,31,30,31,30,31],k=j[c],l=this._dateFromNumbers(b,c+1,1).getDay();this.element.html(""),e=$("<div/>").addClass("calendar-grid"),a.condensedGrid&&e.addClass("condensed no-border"),f=$("<div/>").addClass("calendar-row no-margin"),$("<div/>").addClass("calendar-cell align-center").html("<a class='btn-previous-year' href='#'>-</a>").appendTo(f),$("<div/>").addClass("calendar-cell align-center").html("<a class='btn-previous-month' href='#'>&#12296;</a>").appendTo(f),$("<div/>").addClass("calendar-cell sel-month align-center").html("<a class='btn-select-month' href='#'>"+this.locales[a.locale].months[c+12]+" "+b+"</a>").appendTo(f),$("<div/>").addClass("calendar-cell align-center").html("<a class='btn-next-month' href='#'>&#12297;</a>").appendTo(f),$("<div/>").addClass("calendar-cell align-center").html("<a class='btn-next-year' href='#'>+</a>").appendTo(f),f.addClass("calendar-header").appendTo(e);var m;for(f=$("<div/>").addClass("calendar-row week-days"),h=0;7>h;h++)a.weekStart?(m=h+1,7===m&&(m=0),g=$("<div/>").addClass("calendar-cell align-center day-of-week").appendTo(f),i=$("<div/>").html(this.locales[a.locale].days[m+7]).appendTo(g)):(g=$("<div/>").addClass("calendar-cell align-center day-of-week").appendTo(f),i=$("<div/>").html(this.locales[a.locale].days[h+7]).appendTo(g));f.addClass("calendar-subheader").appendTo(e);var n=this._month-1;0>n&&(n=11);var o=j[n],p=(a.weekStart?l+6:l)%7,q="";for(f=$("<div/>").addClass("calendar-row"),h=0;p>h;h++)a.otherDays&&(q=o-(p-h-1)),g=$("<div/>").addClass("calendar-cell empty").appendTo(f),i=$("<div/>").addClass("other-day").html(q).appendTo(g),a.otherDays||i.css("visibility","hidden");var r,s,t,u=(a.weekStart?l+6:l)%7;for(h=1;k>=h;h++)u%=7,0===u&&(f.appendTo(e),f=$("<div/>").addClass("calendar-row")),g=$("<div/>").addClass("calendar-cell align-center day"),i=$("<div/>").appendTo(g),a.minDate!==!1&&this._dateFromNumbers(b,c+1,h)<a.minDate||a.maxDate!==!1&&this._dateFromNumbers(b,c+1,h)>a.maxDate?(g.removeClass("day"),i.addClass("other-day"),t=h):t="<a href='#'>"+h+"</a>",i.html(t),b===this._today.getFullYear()&&c===this._today.getMonth()&&this._today.getDate()===h&&g.addClass("today"),r=this._dateNumberStringyFy(this._year,this._month+1,h),this.element.data("_storage").indexOf(r)>=0&&(s=g.find("a"),s.parent().parent().addClass("selected")),this.element.data("_exclude").indexOf(r)>=0&&(s=g.find("a"),s.parent().parent().addClass("exclude")),this.element.data("_stored").indexOf(r)>=0&&(s=g.find("a"),s.parent().parent().addClass("stored")),g.appendTo(f),u++;var v="";for(h=u+1;7>=h;h++)a.otherDays&&(v=h-u),g=$("<div/>").addClass("calendar-cell empty").appendTo(f),i=$("<div/>").addClass("other-day").html(v).appendTo(g),a.otherDays||i.css("visibility","hidden");f.appendTo(e),this._renderButtons(e),e.appendTo(this.element)},_renderMonths:function(){var a,b,c,d,e;for(this.element.html(""),a=$("<div/>").addClass("calendar-grid"),this.options.condensedGrid&&a.addClass("condensed no-border"),b=$("<div/>").addClass("calendar-row"),$("<div/>").addClass("calendar-cell sel-minus align-center").html("<a class='btn-previous-year' href='#'>-</a>").appendTo(b),$("<div/>").addClass("calendar-cell sel-year align-center").html("<a class='btn-select-year' href='#'>"+this._year+"</a>").appendTo(b),$("<div/>").addClass("calendar-cell sel-plus align-center").html("<a class='btn-next-year' href='#'>+</a>").appendTo(b),b.addClass("calendar-header").appendTo(a),b=$("<div/>").addClass("calendar-row"),e=0,d=0;12>d;d++)c=$("<div/>").addClass("calendar-cell month-cell align-center month").html("<a href='#' data-month='"+d+"'>"+this.locales[this.options.locale].months[d+12]+"</a>"),this._month===d&&(new Date).getFullYear()===this._year&&c.addClass("today"),c.appendTo(b),(e+1)%4===0&&(b.appendTo(a),b=$("<div/>").addClass("calendar-row")),e+=1;this._renderButtons(a),a.appendTo(this.element)},_renderYears:function(){var a,b,c,d,e;for(this.element.html(""),a=$("<div/>").addClass("calendar-grid"),this.options.condensedGrid&&a.addClass("condensed no-border"),b=$("<div/>").addClass("calendar-row cells4"),$("<div/>").addClass("calendar-cell sel-minus align-center").html("<a class='btn-previous-year' href='#'>-</a>").appendTo(b),$("<div/>").addClass("calendar-cell sel-year align-center").html("<a class='btn-none-btn'>"+this._distance+"-"+(this._distance+11)+"</a>").appendTo(b),$("<div/>").addClass("calendar-cell sel-plus align-center").html("<a class='btn-next-year' href='#'>+</a>").appendTo(b),b.addClass("calendar-header").appendTo(a),b=$("<div/>").addClass("calendar-row"),e=0,d=this._distance;d<this._distance+12;d++)c=$("<div/>").addClass("calendar-cell year-cell align-center year").html("<a href='#' data-year='"+d+"'>"+d+"</a>"),(new Date).getFullYear()===d&&c.addClass("today"),c.appendTo(b),(e+1)%4===0&&(b.appendTo(a),b=$("<div/>").addClass("calendar-row")),e+=1;this._renderButtons(a),a.appendTo(this.element)},_renderCalendar:function(){switch(this._mode){case"year":this._renderYears();break;case"month":this._renderMonths();break;default:this._renderMonth()}this._initButtons()},_initButtons:function(){var that=this,o=this.options,table=this.element.find(".calendar-grid");"day"===this._mode?(table.find(".btn-select-month").off("click").on("click",function(a){a.preventDefault(),a.stopPropagation(),that._mode="month",that._renderCalendar()}),table.find(".btn-previous-month").off("click").on("click",function(a){that._event="eventPrevious",a.preventDefault(),a.stopPropagation(),that._month-=1,that._month<0&&(that._year-=1,that._month=11),that._renderCalendar()}),table.find(".btn-next-month").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._month+=1,12===that._month&&(that._year+=1,that._month=0),that._renderCalendar()}),table.find(".btn-previous-year").off("click").on("click",function(a){that._event="eventPrevious",a.preventDefault(),a.stopPropagation(),that._year-=1,that._renderCalendar()}),table.find(".btn-next-year").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._year+=1,that._renderCalendar()}),table.find(".day a").on("click",function(e){if(e.preventDefault(),e.stopPropagation(),$(this).parent().parent().hasClass("exclude"))return!1;var d=new Date(that._paddy(that._year,4),that._paddy(that._month,2),that._paddy(parseInt($(this).html()),2)).format(that.options.format,null),d0=new Date(that._paddy(that._year,4),that._paddy(that._month,2),that._paddy(parseInt($(this).html()),2));if(that.options.multiSelect?($(this).parent().parent().toggleClass("selected"),$(this).parent().parent().hasClass("selected")?that._addDate(that._dateStringyFy(d0)):that._removeDate(that._dateStringyFy(d0))):(table.find(".day a").parent().parent().removeClass("selected"),$(this).parent().parent().addClass("selected"),that.element.data("_storage",[]),that._addDate(that._dateStringyFy(d0))),"function"==typeof o.dayClick)o.dayClick(d,d0);else if("function"==typeof window[o.dayClick])window[o.dayClick](d,d0);else{var result=eval("(function(){"+o.dayClick+"})");result.call(d,d0)}})):"month"===this._mode?(table.find(".month a").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._month=parseInt($(this).data("month")),that._mode="day",that._renderCalendar()}),table.find(".btn-previous-year").off("click").on("click",function(a){that._event="eventPrevious",a.preventDefault(),a.stopPropagation(),that._year-=1,that._renderCalendar()}),table.find(".btn-next-year").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._year+=1,that._renderCalendar()}),table.find(".btn-select-year").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._mode="year",that._renderCalendar()})):(table.find(".year a").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._year=parseInt($(this).data("year")),that._mode="month",that._renderCalendar()}),table.find(".btn-previous-year").off("click").on("click",function(a){that._event="eventPrevious",a.preventDefault(),a.stopPropagation(),that._distance-=10,that._renderCalendar()}),table.find(".btn-next-year").off("click").on("click",function(a){that._event="eventNext",a.preventDefault(),a.stopPropagation(),that._distance+=10,that._renderCalendar()})),table.find(".calendar-btn-today").off("click").on("click",function(a){a.preventDefault(),a.stopPropagation(),that._mode=that.options.startMode,that.options.date=new Date,that._year=that.options.date.getFullYear(),that._month=that.options.date.getMonth(),that._day=that.options.date.getDate(),that._renderCalendar()}),table.find(".calendar-btn-clear").off("click").on("click",function(a){a.preventDefault(),a.stopPropagation(),that.options.date=new Date,that._year=that.options.date.getFullYear(),that._month=that.options.date.getMonth(),that._day=that.options.date.getDate(),that.element.data("_storage",[]),that._renderCalendar()})},_addDate:function(a){var b=this.element.data("_storage").indexOf(a);0>b&&this.element.data("_storage").push(a)},_removeDate:function(a){var b=this.element.data("_storage").indexOf(a);this.element.data("_storage").splice(b,1)},_addDateExclude:function(a){var b=this.element.data("_exclude").indexOf(a);0>b&&this.element.data("_exclude").push(a)},_addDateStored:function(a){var b=this.element.data("_stored").indexOf(a);0>b&&this.element.data("_stored").push(a)},_removeDateExclude:function(a){var b=this.element.data("_exclude").indexOf(a);this.element.data("_exclude").splice(b,1)},_removeDateStored:function(a){var b=this.element.data("_stored").indexOf(a);this.element.data("_stored").splice(b,1)},_paddy:function(a,b,c){var d="undefined"!=typeof c?c:"0",e=new Array(1+b).join(d);return(e+a).slice(-e.length)},_dateFromNumbers:function(a,b,c){return new Date(this._paddy(a,4)+"/"+this._paddy(b,2)+"/"+this._paddy(c,2))},_dateNumberStringyFy:function(a,b,c){return this._dateFromNumbers(a,b,c).format("yyyy-mm-dd")},_dateStringyFy:function(a){return this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate())},setDate:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._addDate(b),this.options.syncCalenderToDateField&&(this._year=a.getFullYear(),this._month=a.getMonth(),this._day=a.getDate()),this._renderCalendar()},setDateExclude:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._addDateExclude(b),this._renderCalendar()},setDateStored:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._addDateStored(b),this._renderCalendar()},getDate:function(a){return new Date(void 0!==a?this.element.data("_storage")[a]:this.element.data("_storage")[0]).format(this.options.format)},getDates:function(){var a;return a=$.merge($.merge([],this.element.data("_storage")),this.element.data("_stored")),a.unique()},unsetDate:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._removeDate(b),this._renderCalendar()},unsetDateExclude:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._removeDateExclude(b),this._renderCalendar()},unsetDateStored:function(a){var b;a=new Date(a),b=this._dateNumberStringyFy(a.getFullYear(),a.getMonth()+1,a.getDate()),this._removeDateStored(b),this._renderCalendar()},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.carousel",{version:"3.0.0",options:{auto:!0,period:5e3,duration:1e3,effect:"slide",effectFunc:"linear",direction:"left",controls:!0,controlNext:!1,controlPrev:!1,markers:!0,stop:!0,width:"100%",height:!1,_slides:{},_currentIndex:0,_interval:0,_outPosition:0,_animating:!1},_create:function(){var a=this,b=this.options,c=this.element;$.each(c.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),b._slides=c.find(".slide");var d=0;$.each(b._slides,function(){var a,b=$(this);a=b.outerHeight(),a>d&&(d=a)}),c.css({width:b.width,height:b.height?b.height:d}),b._slides.length<=1||(b.markers&&this._markers(),b.controls&&this._controls(),b.stop&&c.on("mouseenter",function(){clearInterval(b._interval)}).on("mouseleave",function(){a.options.auto&&a._autoStart()}),c.find(".slide").hide(),c.find(".slide:nth-child(1)").show(),b.auto&&this._autoStart(),c.data("carousel",this))},_autoStart:function(){var a=this,b=this.options;b._interval=setInterval(function(){a._slideTo("left"===b.direction?"next":"prior")},b.period)},_slideTo:function(a){var b,c=this.element,d=this.options,e=d._slides[d._currentIndex];switch(void 0===a&&(a="next"),"prior"===a?(d._currentIndex-=1,d._currentIndex<0&&(d._currentIndex=d._slides.length-1),d._outPosition=this.element.width()):"next"===a&&(d._currentIndex+=1,d._currentIndex>=d._slides.length&&(d._currentIndex=0),d._outPosition=-this.element.width()),b=d._slides[d._currentIndex],this.options.effect){case"switch":this._effectSwitch(e,b);break;case"slowdown":this._effectSlowdown(e,b,this.options.duration);break;case"fade":this._effectFade(e,b,this.options.duration);break;default:this._effectSlide(e,b,this.options.duration)}c.find(".carousel-bullets a").each(function(){var a=$(this).data("num");a===d._currentIndex?$(this).addClass("bullet-on"):$(this).removeClass("bullet-on")})},_slideToSlide:function(a){var b=this.options,c=b._slides[b._currentIndex],d=b._slides[a];if(b._currentIndex===a)return!1;switch(b._outPosition=a>b._currentIndex?-this.element.width():this.element.width(),this.options.effect){case"switch":this._effectSwitch(c,d);break;case"slowdown":this._effectSlowdown(c,d);break;case"fade":this._effectFade(c,d);break;default:this._effectSlide(c,d)}b._currentIndex=a},_controls:function(){var a,b,c=this,d=this.element,e=this.options;a=$("<span/>").addClass("carousel-switch-next").html("&gt;"),b=$("<span/>").addClass("carousel-switch-prev").html("&lt;"),e.controlNext&&a.html(e.controlNext),e.controlPrev&&b.html(e.controlPrev),a.appendTo(d),b.appendTo(d),e._slides.length>1?(b.on("click",function(){e._animating===!1&&(c._slideTo("prior"),e._animating=!0,setTimeout(function(){e._animating=!1},e.duration))}),a.on("click",function(){e._animating===!1&&(c._slideTo("next"),e._animating=!0,setTimeout(function(){e._animating=!1},e.duration))})):(a.hide(),b.hide())},_markers:function(){var a,b,c,d=this,e=this.options;for(a=$('<div class="carousel-bullets" />'),c=0;c<e._slides.length;c++)b=$('<a class="carousel-bullet" href="javascript:void(0)" data-num="'+c+'"></a>'),0===c&&b.addClass("bullet-on"),b.appendTo(a);a.find("a").on("click",function(b){var c=$(this),f=c.data("num");return a.find("a").removeClass("bullet-on"),c.addClass("bullet-on"),f===e._currentIndex?!1:(d._slideToSlide(f),b.preventDefault(),void b.stopPropagation())}),a.appendTo(this.element)},_effectSwitch:function(a,b){$(a).hide(),$(b).css({left:0}).show(),this.element.css({height:$(b).outerHeight()})},_effectSlide:function(a,b){var c=this.options;$(a).animate({left:c._outPosition},c.duration,c.effectFunc),$(b).css("left",-1*c._outPosition).show(),this.element.css({height:$(b).outerHeight()}),$(b).animate({left:0},c.duration,c.effectFunc)},_effectSlowdown:function(a,b){var c=this.options,d={duration:c.duration,easing:"doubleSqrt"};$.easing.doubleSqrt=function(a){return Math.sqrt(Math.sqrt(a))},$(a).animate({left:c._outPosition},d),$(b).css("left",-1*c._outPosition).show(),this.element.css({height:$(b).outerHeight()}),$(b).animate({left:0},d)},_effectFade:function(a,b){var c=this.options;$(a).fadeOut(c.duration),$(b).css({left:0}).fadeIn(c.duration),this.element.css({height:$(b).outerHeight()})},slideTo:function(a){this._slideToSlide(a)},nextSlide:function(){this._slideTo("next")},priorSlide:function(){this._slideTo("prior")},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.charm",{version:"3.0.0",options:{position:"right",opacity:1,outside:!1,timeout:0,duration:400},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createCharm(),a.data("charm",this)},_createCharm:function(){var a=this,b=this.element,c=this.options;b.addClass("charm").addClass(c.position+"-side").css({opacity:c.opacity}).hide();var d=$("<span/>").addClass("charm-closer").appendTo(b);d.on("click",function(){
a.close()}),c.outside===!0&&b.on("mouseleave",function(){a.close()})},_showCharm:function(){var a,b=this,c=this.element,d=this.options;"left"===d.position||"right"===d.position?(a=c.outerWidth(),"left"===d.position?c.css({left:-a,right:"auto",top:0,bottom:0}).show().animate({left:0},d.duration,function(){c.data("displayed",!0)}):c.css({right:-a,left:"auto",top:0,bottom:0}).show().animate({right:0},d.duration,function(){c.data("displayed",!0)})):(a=c.outerHeight(),"top"===d.position?c.css({top:-a,bottom:"auto",left:0,right:0}).show().animate({top:0},d.duration,function(){c.data("displayed",!0)}):c.css({bottom:-a,top:"auto",left:0,right:0}).show().animate({bottom:0},d.duration,function(){c.data("displayed",!0)})),d.timeout>0&&(this._timeout_interval=setInterval(function(){c.is(":hover")||(b.close(),clearInterval(b._timeout_interval))},d.timeout))},_hideCharm:function(){var a,b=this.element,c=this.options;"left"===c.position||"right"===c.position?(a=b.outerWidth(),"left"===c.position?b.animate({left:-a},c.duration,function(){b.hide(),b.data("displayed",!1)}):b.animate({right:-a},c.duration,function(){b.hide(),b.data("displayed",!1)})):(a=b.outerHeight(),"top"===c.position?b.animate({top:-a},c.duration,function(){b.hide(),b.data("displayed",!1)}):b.animate({bottom:-a},c.duration,function(){b.hide(),b.data("displayed",!1)})),clearInterval(this._timeout_interval)},open:function(){{var a=this.element;this.options}a.data("opened")!==!0&&(a.data("opened",!0),this._showCharm())},close:function(){{var a=this.element;this.options}a.data("opened")!==!1&&(a.data("opened",!1),this._hideCharm())},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}});var metroCharm={isOpened:function(a){var b,c=$(a);return 0==c.length?(console.log("Charm "+a+" not found!"),!1):(b=c.data("charm"),void 0==b?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):b.element.data("opened")===!0)},show:function(a,b){var c,d=$(a);return 0==d.length?(console.log("Charm "+a+" not found!"),!1):(c=d.data("charm"),void 0==c?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):(void 0!=b&&(d.hide(),d.data("displayed",!1),d.data("opened",!1),c.options.position=b),c.open(),!1))},hide:function(a){var b,c=$(a);return 0==c.length?(console.log("Charm "+a+" not found!"),!1):(b=c.data("charm"),void 0==b?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):void b.close())},close:function(a){return this.show(a)},toggle:function(a,b){var c,d=$(a);return 0==d.length?(console.log("Charm "+a+" not found!"),!1):(c=d.data("charm"),void 0==c?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):void(c.element.data("opened")===!0?c.close():(void 0!=b&&(d.hide(),d.data("displayed",!1),d.data("opened",!1),c.options.position=b),c.open())))}};$.Charm=window.metroCharm=metroCharm,window.metroCharmIsOpened=function(a){var b,c=$(a);return 0==c.length?(console.log("Charm "+a+" not found!"),!1):(b=c.data("charm"),void 0==b?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):b.element.data("opened")===!0)},window.showMetroCharm=function(a,b){var c,d=$(a);return 0==d.length?(console.log("Charm "+a+" not found!"),!1):(c=d.data("charm"),void 0==c?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):(void 0!=b&&(d.hide(),d.data("displayed",!1),d.data("opened",!1),c.options.position=b),c.open(),!1))},window.hideMetroCharm=function(a){var b,c=$(a);return 0==c.length?(console.log("Charm "+a+" not found!"),!1):(b=c.data("charm"),void 0==b?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):void b.close())},window.toggleMetroCharm=function(a,b){var c,d=$(a);return 0==d.length?(console.log("Charm "+a+" not found!"),!1):(c=d.data("charm"),void 0==c?(console.log('Element not contain role charm! Please add attribute data-role="charm" to element '+a),!1):void(c.element.data("opened")===!0?c.close():(void 0!=b&&(d.hide(),d.data("displayed",!1),d.data("opened",!1),c.options.position=b),c.open())))},$.widget("metro.clock",{version:"1.0.0",options:{showTime:!0,showDate:!0,timeFormat:"24",dateFormat:"american",divider:"&nbsp;&nbsp;"},_create:function(){{var a=this,b=this.element;this.options}this._setOptionsFromDOM(),this._tick(),this._clockInterval=setInterval(function(){a._tick()},500),b.data("clock",this)},_addLeadingZero:function(a){return 10>a&&(a="0"+a),a},_tick:function(){var a=this.element,b=this.options,c=new Date,d=(c.getTime(),""),e=c.getHours(),f=c.getMinutes(),g=c.getSeconds(),h=c.getDate(),i=c.getMonth()+1,j=c.getFullYear(),k="";"12"==b.timeFormat&&(k=" AM",e>11&&(k=" PM"),e>12&&(e-=12),0==e&&(e=12)),e=this._addLeadingZero(e),f=this._addLeadingZero(f),g=this._addLeadingZero(g),i=this._addLeadingZero(i),h=this._addLeadingZero(h),b.showDate&&("american"==b.dateFormat?(d+="<span class='date-month'>"+i+"</span>",d+="<span class='date-divider'>-</span>",d+="<span class='date-day'>"+h+"</span>",d+="<span class='date-divider'>-</span>",d+="<span class='date-year'>"+j+"</span>"):(d+="<span class='date-day'>"+h+"</span>",d+="<span class='date-divider'>-</span>",d+="<span class='date-month'>"+i+"</span>",d+="<span class='date-divider'>-</span>",d+="<span class='date-year'>"+j+"</span>"),d+=b.divider),b.showTime&&(d+="<span class='clock-hour'>"+e+"</span>",d+="<span class='clock-divider'>:</span>",d+="<span class='clock-minute'>"+f+"</span>",d+="<span class='clock-divider'>:</span>",d+="<span class='clock-second'>"+g+"</span>"),a.html(d)},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){clearInterval(this._clockInterval)},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.countdown",{version:"3.0.0",options:{stop:!1,days:!1,hours:!1,minutes:!1,seconds:!1,backgroundColor:"bg-cyan",digitColor:"fg-white",dividerColor:"fg-dark",labelColor:"fg-grayLight",labels:{days:"days",hours:"hours",minutes:"mins",seconds:"secs"},onTick:function(){},onStop:function(){}},_interval:0,_interval2:0,_alarmOn:void 0,_create:function(){var a=this,b=this.element,c=this.options;$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),this._alarmOn=new Date,c.stop!==!1&&(this._alarmOn=new Date(c.stop));var d=864e5,e=36e5,f=6e4,g=1e3;c.days!==!1&&("object"==typeof this._alarmOn&&(this._alarmOn=this._alarmOn.getTime()),this._alarmOn=this._alarmOn+c.days*d),c.hours!==!1&&("object"==typeof this._alarmOn&&(this._alarmOn=this._alarmOn.getTime()),this._alarmOn=this._alarmOn+c.hours*e),c.minutes!==!1&&("object"==typeof this._alarmOn&&(this._alarmOn=this._alarmOn.getTime()),this._alarmOn=this._alarmOn+c.minutes*f),c.seconds!==!1&&("object"==typeof this._alarmOn&&(this._alarmOn=this._alarmOn.getTime()),this._alarmOn=this._alarmOn+c.seconds*g),this._createDigits(),b.find(".digit").text("0"),a._tick(),b.data("countdown",this)},_createDigits:function(){var a,b,c=this.element,d=this.options,e=["days","hours","minutes","seconds"];e.map(function(e){a=$("<div/>").addClass("part "+e).attr("data-day-text",d.labels[e]).appendTo(c),$("<div/>").addClass("digit").appendTo(a),$("<div/>").addClass("digit").appendTo(a),"days"===e&&($("<div/>").addClass("digit").appendTo(a),$("<div/>").addClass("digit").appendTo(a)),metroUtils.isColor(d.labelColor)?a.css({color:d.labelColor}):a.addClass(d.labelColor),metroUtils.isColor(d.backgroundColor)?a.find(".digit").css({background:d.backgroundColor}):a.find(".digit").addClass(d.backgroundColor),metroUtils.isColor(d.digitColor)?a.find(".digit").css({color:d.digitColor}):a.find(".digit").addClass(d.digitColor),"seconds"!==e&&(b=$("<div/>").addClass("divider").text(":").appendTo(c),metroUtils.isColor(d.dividerColor)?b.css({color:d.dividerColor}):b.addClass(d.dividerColor))})},_blink:function(){this.element.toggleClass("tick")},_tick:function(){var that=this,o=this.options,element=this.element,days=86400,hours=3600,minutes=60,left,d,h,m,s;this._interval2=setInterval(function(){that._blink()},500),this._interval=setInterval(function(){var result;left=Math.floor((that._alarmOn-new Date)/1e3),0>left&&(left=0),d=Math.floor(left/days),left-=d*days,that._update("days",d),0===d&&element.find(".part.days").addClass("disabled"),h=Math.floor(left/hours),left-=h*hours,that._update("hours",h),0===d&&0===h&&element.find(".part.hours").addClass("disabled"),m=Math.floor(left/minutes),left-=m*minutes,that._update("minutes",m),0===d&&0===h&&0===m&&element.find(".part.minutes").addClass("disabled"),s=left,that._update("seconds",s),"function"==typeof o.onTick?o.onTick(d,h,m,s):"function"==typeof window[o.onTick]?window[o.onTick](d,h,m,s):(result=eval("(function(){"+o.onTick+"})"),result.call(d,h,m,s)),0===d&&0===h&&0===m&&0===s&&(element.find(".part").addClass("disabled"),"function"==typeof o.onStop?o.onStop():"function"==typeof window[o.onStop]?window[o.onStop]():(result=eval("(function(){"+o.onStop+"})"),result.call()),that._stop("all"),that._trigger("alarm"),clearInterval(that._interval))},1e3)},_update:function(a,b){var c=this.element;if("days"==a){var d,e,f,g,h=Math.floor(b/1e3)%10,i=Math.floor(b/100)%10,j=Math.floor(b/10)%10,k=b%10;d=c.find("."+a+" .digit:eq(0)"),e=c.find("."+a+" .digit:eq(1)"),f=c.find("."+a+" .digit:eq(2)"),g=c.find("."+a+" .digit:eq(3)"),h!==parseInt(d.text())&&(d.toggleClass("scaleIn"),setTimeout(function(){d.text(h).toggleClass("scaleIn")},500)),i!==parseInt(e.text())&&(e.toggleClass("scaleIn"),setTimeout(function(){e.text(i).toggleClass("scaleIn")},500)),j!==parseInt(f.text())&&(f.toggleClass("scaleIn"),setTimeout(function(){f.text(j).toggleClass("scaleIn")},500)),k!==parseInt(g.text())&&(g.toggleClass("scaleIn"),setTimeout(function(){g.text(k).toggleClass("scaleIn")},500))}else{var l,m,n=Math.floor(b/10)%10,o=b%10;l=c.find("."+a+" .digit:eq(0)"),m=c.find("."+a+" .digit:eq(1)"),o!==parseInt(m.text())&&(m.toggleClass("scaleIn"),setTimeout(function(){m.text(o).toggleClass("scaleIn")},500)),n!==parseInt(l.text())&&(l.toggleClass("scaleIn"),setTimeout(function(){l.text(n).toggleClass("scaleIn")},500))}},_stop:function(){clearInterval(this._interval),clearInterval(this._interval2)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.datatable",{version:"3.0.0",options:{},_create:function(){var a=this.element,b=this.options;if($.each(a.data(),function(a,c){try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),$().dataTable)try{a.dataTable(b)}catch(c){}else alert("dataTable plugin required");a.data("datatable",this)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.datepicker",{version:"3.0.14",options:{format:"yyyy.mm.dd",preset:!1,minDate:!1,maxDate:!1,effect:"fade",position:"bottom",locale:window.METRO_CURRENT_LOCALE,weekStart:window.METRO_CALENDAR_WEEK_START,otherDays:!1,exclude:!1,stored:!1,buttons:!1,buttonToday:!0,buttonClear:!0,condensedGrid:!1,scheme:"default",onSelect:function(){}},_calendar:void 0,_create:function(){var a=this,b=this.element,c=this.options,d=b.children("input"),e=b.children("button");$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),this._createCalendar(),d.attr("readonly",!0),e.attr("type","button"),e.on("click",function(b){b.stopPropagation(),"none"===a._calendar.css("display")?a._show():a._hide()}),b.on("click",function(b){b.stopPropagation(),"none"===a._calendar.css("display")?a._show():a._hide()}),$("html").on("click",function(){$(".calendar-dropdown").hide()}),b.data("datepicker",this)},_createCalendar:function(){var _calendar,that=this,element=this.element,o=this.options;switch(_calendar=$("<div/>").css({position:"absolute",display:"none","max-width":220,"z-index":1e3}).addClass("calendar calendar-dropdown").appendTo(element),_calendar.calendar({multiSelect:!1,format:o.format,buttons:!1,buttonToday:!1,buttonClear:!1,locale:o.locale,otherDays:o.otherDays,weekStart:o.weekStart,condensedGrid:o.condensedGrid,exclude:o.exclude,stored:o.stored,date:o.preset?o.preset:new Date,minDate:o.minDate,maxDate:o.maxDate,scheme:o.scheme,dayClick:function(d,d0){if(_calendar.calendar("setDate",d0),that.element.children("input[type=text]").val(d),that.element.children("input[type=text]").trigger("change",d0),that.element.children("input[type=text]").blur(),that._hide(),"function"==typeof o.onSelect)o.onSelect(d,d0);else if("function"==typeof window[o.onSelect])window[o.onSelect](d,d0);else{var result=eval("(function(){"+o.onSelect+"})");result.call(d,d0)}}}),o.preset!==!1&&(_calendar.calendar("setDate",o.preset),element.find("input, .datepicker-output").val(_calendar.calendar("getDate"))),this.options.position){case"top":_calendar.css({top:0-_calendar.height(),left:0});break;default:_calendar.css({top:"100%",left:0})}this._calendar=_calendar},_show:function(){"slide"===this.options.effect?($(".calendar-dropdown").slideUp("fast"),this._calendar.slideDown("fast")):"fade"===this.options.effect?($(".calendar-dropdown").fadeOut("fast"),this._calendar.fadeIn("fast")):($(".calendar-dropdown").hide(),this._calendar.show())},_hide:function(){"slide"===this.options.effect?this._calendar.slideUp("fast"):"fade"===this.options.effect?this._calendar.fadeOut("fast"):this._calendar.hide()},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)},setDate:function(a){$.isArray(a);var b=this.element.find("input"),c=this._calendar.data("metro-calendar"),d=c.element;d.data("_storage",[]),this._calendar.calendar("setDate",a),a=this._calendar.calendar("getDate"),b.val(a)}}),$.widget("metro.dialog",{version:"3.0.14",options:{modal:!1,overlay:!1,overlayColor:"default",overlayClickClose:!1,type:"default",place:"center",position:"default",content:!1,hide:!1,width:"auto",height:"auto",background:"default",color:"default",closeButton:!1,windowsStyle:!1,show:!1,href:!1,contentType:"default",closeAction:!0,closeElement:".js-dialog-close",onDialogOpen:function(){},onDialogClose:function(){}},_create:function(){var a=this,b=this.element,c=this.options;$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),this._interval=void 0,this._overlay=void 0,c.overlay&&this._createOverlay(),this._createDialog(),c.closeAction===!0&&b.on("click",".js-dialog-close"+c.closeElement,function(){a.close()}),b.appendTo($("body")),b.data("dialog",this),c.show&&this.open()},_createOverlay:function(){var a=(this.element,this.options),b=$("body").find(".dialog-overlay");0===b.length&&(b=$("<div/>").addClass("dialog-overlay")),a.overlayColor&&(metroUtils.isColor(a.overlayColor)?b.css({background:a.overlayColor}):b.addClass(a.overlayColor)),this._overlay=b},_createDialog:function(){var a=this,b=this.element,c=this.options;b.addClass("dialog"),"default"!==c.type&&b.addClass(c.type),c.windowsStyle&&(c.width="auto",b.css({left:0,right:0})),"default"!==c.background&&(metroUtils.isColor(c.background)?b.css({background:c.background}):b.addClass(c.background)),"default"!==c.color&&(metroUtils.isColor(c.color)?b.css({color:c.color}):b.addClass(c.color)),b.css({width:c.width,height:c.height}),c.closeButton&&$("<span/>").addClass("dialog-close-button").appendTo(b).on("click",function(){a.close()}),this._hide()},_hide:function(){var a=this.element,b=this.options;a.css({visibility:"hidden"}),b.removeOnClose===!0&&a.remove()},_show:function(){{var a=this.element;this.options}this._setContent(),a.css({visibility:"visible"})},_setPosition:function(){var a=this.element,b=this.options,c=a.outerWidth(),d=a.outerHeight();switch(b.place){case"top-left":a.css({left:0,top:0});break;case"top-right":a.css({right:0,top:0});break;case"top-center":a.css({left:($(window).width()-c)/2,top:0});break;case"bottom-left":a.css({left:0,bottom:0});break;case"bottom-right":a.css({right:0,bottom:0});break;case"center-left":a.css({left:0,top:($(window).height()-d)/2});break;case"center-right":a.css({right:0,top:($(window).height()-d)/2});break;case"bottom-center":a.css({left:($(window).width()-c)/2,bottom:0});break;default:a.css({left:b.windowsStyle===!1?($(window).width()-c)/2:0,top:($(window).height()-d)/2})}},_setContent:function(){var a=this,b=this.element,c=this.options,d=$("<div>").addClass("set-dialog-content");return"video"===c.contentType&&d.addClass("video-container"),c.content===!1&&c.href===!1?!1:(b.children(":not(.dialog-close-button)").remove(),d.appendTo(b),c.content&&(c.content instanceof jQuery?c.content.appendTo(d):d.html(c.content),this._setPosition()),void(c.href&&$.get(c.href,function(b){d.html(b),a._setPosition()})))},setContent:function(a){this.options.contentType="default",this.options.href=!1,this.options.content=a,this._setContent()},setContentHref:function(a){this.options.contentType="href",this.options.content=!1,this.options.href=a,this._setContent()},setContentVideo:function(a){this.options.contentType="video",this.options.content=a,this.options.href=!1,this._setContent()},toggle:function(){var a=this.element;a.data("opened")?this.close():this.open()},open:function(){var that=this,element=this.element,o=this.options,overlay;if(this._setPosition(),element.data("opened",!0),o.overlay&&(overlay=this._overlay,overlay.appendTo("body").show(),o.overlayClickClose&&overlay.on("click",function(){that.close()})),this._show(),"function"==typeof o.onDialogOpen)o.onDialogOpen(element);else if("function"==typeof window[o.onDialogOpen])window[o.onDialogOpen](element);else{var result=eval("(function(){"+o.onDialogOpen+"})");result.call(element)}o.hide&&parseInt(o.hide)>0&&(this._interval=setTimeout(function(){that.close()},parseInt(o.hide)))},close:function(){var that=this,element=this.element,o=this.options;if(clearInterval(this._interval),o.overlay&&$("body").find(".dialog-overlay").remove(),element.data("opened",!1),this._hide(),"function"==typeof o.onDialogClose)o.onDialogClose(element);else if("function"==typeof window[o.onDialogClose])window[o.onDialogClose](element);else{var result=eval("(function(){"+o.onDialogClose+"})");result.call(element)}},reset:function(a){void 0!==a&&(this.options.place=a),this._setPosition()},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}});var dialog={open:function(a,b,c,d){var e,f=$(a);if(0==f.length)return console.log("Dialog "+a+" not found!"),!1;if(e=f.data("dialog"),void 0==e)return console.log('Element not contain role dialog! Please add attribute data-role="dialog" to element '+a),!1;if(void 0!=c)switch(d){case"href":e.setContentHref(c);break;case"video":e.setContentVideo(c);break;default:e.setContent(c)}void 0!==b&&(e.options.place=b),e.open()},close:function(a){var b,c=$(a);return 0==c.length?(console.log("Dialog "+a+" not found!"),!1):(b=c.data("dialog"),void 0==b?(console.log('Element not contain role dialog! Please add attribute data-role="dialog" to element '+a),!1):void b.close())},toggle:function(a,b,c,d){var e,f=$(a);if(0==f.length)return console.log("Dialog "+a+" not found!"),!1;if(e=f.data("dialog"),void 0==e)return console.log('Element not contain role dialog! Please add attribute data-role="dialog" to element '+a),!1;if(void 0!=c)switch(d){case"href":e.setContentHref(c);break;case"video":e.setContentVideo(c);break;default:e.setContent(c)}e.element.data("opened")===!0?e.close():(void 0!==b&&(e.options.place=b),e.open())},create:function(data){var dlg,id,html,buttons,button;id="dialog_id_"+(new Date).getTime(),dlg=$("<div id='"+id+"' class='dialog dialog-ex'></div>"),void 0!==data.title&&$("<div class='dialog-title'>"+data.title+"</div>").appendTo(dlg),void 0!==data.content&&$("<div class='dialog-content'>"+data.content+"</div>").appendTo(dlg),void 0!==data.actions&&"object"==typeof data.actions&&(buttons=$("<div class='dialog-actions'></div>").appendTo(dlg),$.each(data.actions,function(){var item=this;button=$("<button>").attr("type","button").addClass("button").html(item.title),void 0!==item.cls&&button.addClass(item.cls),button.appendTo(buttons),void 0!=item.onclick&&button[0].addEventListener("click",function(){if("function"==typeof item.onclick)item.onclick(dlg);else if("function"==typeof window[item.onclick])window[item.onclick](dlg);else{var result=eval("(function(){"+item.onclick+"})");result.call(dlg)}},!0)})),dlg.appendTo($("body"));var dlg_options=$.extend({},{show:!0,closeAction:!0,removeOnClose:!0},void 0!=data.options?data.options:{});return dlg.dialog(dlg_options)}};window.metroDialog=dialog,$.Dialog=function(a){return dialog.create(a)},$(window).on("resize",function(){var a=$(".dialog");$.each(a,function(){var a=$(this).data("dialog"),b=a.element;b.data("opened")===!0&&a.reset()})}),$.widget("metro.donut",{version:"1.0.0",options:{size:100,radius:50,value:0,background:"#ffffff",color:"",stroke:"#d1d8e7",fill:"#49649f",fontSize:24,hole:.8,total:100,cap:"%",animate:0},_create:function(){{var a=this.element;this.options}this._setOptionsFromDOM(),this._createDonut(),a.data("donut",this)},_createDonut:function(){var a=this.element,b=this.options,c="",d=b.radius*(1-(1-b.hole)/2),e=b.radius*(1-b.hole),f=2*Math.PI*d,g=(b.value*f/b.total+" "+f,"rotate(-90 "+b.radius+","+b.radius+")"),h=d*b.hole*.6;a.hasClass("donut")||a.addClass("donut"),a.css({width:b.size,height:b.size,background:b.background}),c+="<svg>",c+="   <circle class='donut-back' r='"+d+"px' cx='"+b.radius+"px' cy='"+b.radius+"px' transform='"+g+"' fill='none' stroke='"+b.stroke+"' stroke-width='"+e+"'/>",c+="   <circle class='donut-fill' r='"+d+"px' cx='"+b.radius+"px' cy='"+b.radius+"px' transform='"+g+"' fill='none' stroke='"+b.fill+"' stroke-width='"+e+"'/>",c+="   <text   class='donut-title' x='"+b.radius+"px' y='"+b.radius+"px' dy='"+h/3+"px' text-anchor='middle' fill='"+b.fill+"' font-size='"+h+"px'>0"+b.cap+"</text>",c+="</svg>",a.html(c),this.val(b.value)},_setValue:function(a){var b=this.element,c=this.options;c.value=a;var d=b.find(".donut-fill"),e=b.find(".donut-title"),f=c.radius*(1-(1-c.hole)/2),g=2*Math.PI*f,h=1e3*c.value/c.total/10+c.cap,i=c.value*g/c.total+" "+g;d.attr("stroke-dasharray",i),e.html(h)},val:function(a){var b=this,c=this.options;if(void 0===a)return c.value;if(c.animate>0){var d,e=0;d=setInterval(function(){b._setValue(++e),e==a&&clearInterval(d)},c.animate)}else this._setValue(a)},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.draggable",{version:"3.0.0",options:{dragElement:null,dragArea:null,zIndex:2e3,onDragStart:function(){},onDragStop:function(){},onDragMove:function(){}},drag:!1,oldCursor:null,oldZindex:null,oldPosition:null,_create:function(){{var a=this.element;this.options}this._setOptionsFromDOM(),this._createDraggable(),a.data("draggable",this)},_createDraggable:function(){var that=this,element=this.element,o=this.options,dragElement=o.dragElement?element.find(o.dragElement):element;addTouchEvents(element[0]),dragElement.on("mousedown",function(e){var result,el=$(this);that.drag=!0,"function"==typeof o.onDragStart?o.onDragStart(element):"function"==typeof window[o.onDragStart]?window[o.onDragStart](element):(result=eval("(function(){"+o.onDragStart+"})"),result.call(element)),that.oldCursor=el.css("cursor")?el.css("cursor"):"default",that.oldZindex=element.css("z-index"),dragElement.css({cursor:"move"}),element.css({"z-index":o.zIndex});var dragArea=$(o.dragArea?o.dragArea:window),os={left:o.dragArea?dragArea.offset().left:0,top:o.dragArea?dragArea.offset().top:0},drg_h=element.outerHeight(),drg_w=element.outerWidth(),pos_y=element.offset().top+drg_h-e.pageY,pos_x=element.offset().left+drg_w-e.pageX;dragArea.on("mousemove",function(e){var offset,pageX,pageY;if(!that.drag)return!1;pageX=e.pageX-os.left,pageY=e.pageY-os.top;var t=pageY>0?pageY+pos_y-drg_h:0,l=pageX>0?pageX+pos_x-drg_w:0,t_delta=dragArea.innerHeight()+dragArea.scrollTop()-element.outerHeight(),l_delta=dragArea.innerWidth()+dragArea.scrollLeft()-element.outerWidth();t>=0&&t_delta>=t&&element.offset({top:t+os.top}),l>=0&&l_delta>=l&&element.offset({left:l+os.left}),offset={left:l,top:t},"function"==typeof o.onDragMove?o.onDragMove(element,offset):"function"==typeof window[o.onDragMove]?window[o.onDragMove](element,offset):(result=eval("(function(){"+o.onDragMove+"})"),result.call(element,offset))})}),dragElement.on("mouseup",function(e){var result,el=$(this);that.drag=!1,dragElement.css({cursor:that.oldCursor}),element.css({"z-index":that.oldZindex,position:that.oldPosition}),"function"==typeof o.onDragStop?o.onDragStop(element):"function"==typeof window[o.onDragStop]?window[o.onDragStop](element):(result=eval("(function(){"+o.onDragStop+"})"),result.call(element))})},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.dropdown",{version:"3.0.0",options:{effect:window.METRO_SHOW_TYPE,toggleElement:!1,noClose:!1,onDrop:function(){},onUp:function(){}},_create:function(){var a,b=this,c=this.element,d=this.options,e=this.element,f=this.name,g=this.element.parent();$.each(c.data(),function(a,b){if(a in d)try{d[a]=$.parseJSON(b)}catch(c){d[a]=b}}),a=d.toggleElement?$(d.toggleElement):g.children(g.children(".dropdown-toggle").length>0?".dropdown-toggle":"a:nth-child(1)"),void 0!==METRO_SHOW_TYPE&&(this.options.effect=METRO_SHOW_TYPE),a.on("click."+f,function(a){if(g.siblings(g[0].tagName).removeClass("active-container"),$(".active-container").removeClass("active-container"),"block"!==e.css("display")||e.hasClass("keep-open")){if($("[data-role=dropdown]").each(function(a,c){e.parents("[data-role=dropdown]").is(c)||$(c).hasClass("keep-open")||"block"!==$(c).css("display")||b._close(c)}),e.hasClass("horizontal")){e.css({visibility:"hidden",display:"block"});var c=$(e.children("li")[0]).outerWidth();e.css({visibility:"visible",display:"none"});var d=e.children("li").length*c+(e.children("li").length-1);e.css("width",d)}b._open(e),g.addClass("active-container")}else b._close(e);a.preventDefault(),a.stopPropagation()}),d.noClose===!0&&c.on("click",function(a){a.stopPropagation()}),$(e).find("li.disabled a").on("click",function(a){a.preventDefault()}),c.data("dropdown",this)},_open:function(el){var parent=this.element.parent(),o=this.options,toggle=o.toggleElement?$(o.toggleElement):parent.children(parent.children(".dropdown-toggle").length>0?".dropdown-toggle":"a:nth-child(1)");switch(this.options.effect){case"fade":$(el).fadeIn("fast");break;case"slide":$(el).slideDown("fast");break;default:$(el).show()}if(this._trigger("onOpen",null,el),toggle.addClass("active-toggle"),"function"==typeof o.onDrop)o.onDrop(el);else if("function"==typeof window[o.onDrop])window[o.onDrop](el);else{var result=eval("(function(){"+o.onDrop+"})");result.call(el)}},_close:function(el){var parent=$(el).parent(),o=this.options,toggle=o.toggleElement?$(o.toggleElement):parent.children(parent.children(".dropdown-toggle").length>0?".dropdown-toggle":"a:nth-child(1)");switch(this.options.effect){case"fade":$(el).fadeOut("fast");break;case"slide":$(el).slideUp("fast");break;default:$(el).hide()}if(this._trigger("onClose",null,el),toggle.removeClass("active-toggle"),"function"==typeof o.onUp)o.onUp(el);else if("function"==typeof window[o.onUp])window[o.onUp](el);else{var result=eval("(function(){"+o.onUp+"})");result.call(el)}},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$(document).on("click",function(){$("[data-role=dropdown]").each(function(a,b){if(!$(b).hasClass("keep-open")&&"block"===$(b).css("display")){var c=$(b).data("dropdown");c._close(b)}})}),$.widget("metro.fitImage",{version:"3.0.0",options:{shadow:!1,overlay:!1,type:"default",frameColor:"default",format:"hd"},_create:function(){var a,b,c,d,e,f=this.element,g=this.options,h=f.parent(),i=f.attr("src");$.each(f.data(),function(a,b){if(a in g)try{g[a]=$.parseJSON(b)}catch(c){g[a]=b}}),$("<img/>").attr("src",i).on("load",function(){a=this.width,b=this.height}).remove();var j=$("<div/>").addClass("image-container").css("width","100%").appendTo(h),k=$("<div/>").addClass("frame").appendTo(j);switch(c=k.innerWidth(),d=k.innerHeight(),g.format){case"sd":d=3*c/4;break;case"square":d=c;break;case"cycle":d=c;break;case"fill-h":d="100%",j.css("height","100%");break;case"fill":d="100%",j.css("height","100%");break;default:d=9*c/16}if(e=$("<div/>").css({width:"100%",height:d,"background-image":"url("+i+")","background-size":"cover","background-repeat":"no-repeat","border-radius":"cycle"===g.format?"50%":"0"}),$(window).on("resize",function(){var a=k.innerWidth(),b=k.innerHeight();switch(g.format){case"sd":b=3*a/4;break;case"square":b=a;break;case"cycle":b=a;break;case"fill-h":b="100%",j.css("height","100%");break;case"fill":b="100%",j.css("height","100%");break;default:b=9*a/16}e.css({height:b})}),"default"!==g.frameColor&&(metroUtils.isColor(g.frameColor)?k.css("background-color",g.frameColor):k.addClass(g.frameColor)),g.overlay!==!1){$("<div/>").addClass("image-overlay").html(g.overlay).appendTo(j)}switch(g.shadow!==!1&&j.addClass("block-shadow"),e.appendTo(k),g.type){case"diamond":j.addClass("diamond"),e.addClass("image-replacer");break;case"bordered":j.addClass("bordered");break;case"polaroid":j.addClass("polaroid");break;case"handing":j.addClass("handing");break;case"handing-ani":j.addClass("handing ani");break;case"handing-ani-hover":j.addClass("handing ani-hover")}j.addClass("image-format-"+g.format),f.remove()},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.fluentmenu",{version:"3.0.0",options:{onSpecialClick:function(){},onTabClick:function(){},onTabChange:function(){}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createMenu(),a.data("fluentmenu",this)},_createMenu:function(){var that=this,element=this.element,o=this.options,active_tab=$(element.find(".tabs-holder > li.active")[0]);this.openTab(active_tab),element.on("click",".tabs-holder > li > a",function(e){var a=$(this),li=a.parent("li"),result;if(li.hasClass("special"))"function"==typeof o.onSpecialClick?o.onSpecialClick(a,li):"function"==typeof window[o.onSpecialClick]?window[o.onSpecialClick](a,li):(result=eval("(function(){"+o.onSpecialClick+"})"),result.call(a,li));else{var panel=$(a.attr("href"));that._hidePanels(),that._showPanel(panel),element.find(".tabs-holder > li").removeClass("active"),a.parent("li").addClass("active"),"function"==typeof o.onTabClick?o.onTabClick(a,li):"function"==typeof window[o.onTabClick]?window[o.onTabClick](a,li):(result=eval("(function(){"+o.onTabClick+"})"),result.call(a,li)),"function"==typeof o.onTabChange?o.onTabChange(a,li):"function"==typeof window[o.onTabChange]?window[o.onTabChange](a,li):(result=eval("(function(){"+o.onTabChange+"})"),result.call(a,li))}e.preventDefault()})},_hidePanels:function(){this.element.find(".tab-panel").hide()},_showPanel:function(a){void 0==a&&(a=this.element.find(".tabs-holder li.active a").attr("href")),$(a).show()},openTab:function(a){var b=this.element,c=(this.options,$(a.children("a").attr("href")));return 0===c.length?!1:(this._hidePanels(),this._showPanel(c),b.find(".tabs-holder > li").removeClass("active"),void a.addClass("active"))},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.grid",{version:"3.0.0",options:{equalHeight:!0},_create:function(){var a=this,b=this.element,c=this.options;$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),c.equalHeight&&(setTimeout(function(){a._setEqualHeight()},50),$(window).on("resize",function(){
a._setEqualHeight()})),b.data("grid",this)},_setEqualHeight:function(){var a=this.element,b=(this.options,a.find(".row"));$.each(b,function(){var a=$(this),b=a.children(".cell"),c=0;b.css("min-height","0"),$.each(b,function(){$(this).outerHeight()>c&&(c=$(this).outerHeight())}),b.css("min-height",c)})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.hint",{version:"3.0.0",options:{hintPosition:"auto",hintBackground:"#FFFCC0",hintColor:"#000000",hintMaxSize:200,hintMode:"default",hintShadow:!1,hintBorder:!0,hintTimeout:0,hintTimeDelay:0,_hint:void 0},_create:function(){var a=this,b=(this.element,this.options);this.element.on("mouseenter",function(c){$(".hint, .hint2").remove(),b.hintTimeDelay>0?setTimeout(function(){a.createHint(),b._hint.show()},b.hintTimeDelay):(a.createHint(),b._hint.show()),c.preventDefault()}),this.element.on("mouseleave",function(a){b._hint.length&&b._hint.hide().remove(),a.preventDefault()})},createHint:function(){var a,b=this.element,c=b.data("hint").split("|"),d=this.options;if($.each(b.data(),function(a,b){if(a in d)try{d[a]=$.parseJSON(b)}catch(c){d[a]=b}}),"TD"===b[0].tagName||"TH"===b[0].tagName){var e=$("<div/>").css("display","inline-block").html(b.html());b.html(e),b=e}var f=c.length>1?c[0]:!1,g=c.length>1?c[1]:c[0];a=$("<div/>").appendTo("body"),a.addClass(2===d.hintMode?"hint2":"hint"),d.hintBorder||a.addClass("no-border"),f&&$("<div/>").addClass("hint-title").html(f).appendTo(a),$("<div/>").addClass("hint-text").html(g).appendTo(a),a.addClass(d.position),d.hintShadow&&a.addClass("shadow"),d.hintBackground&&(metroUtils.isColor(d.hintBackground)?a.css("background-color",d.hintBackground):a.addClass(d.hintBackground)),d.hintColor&&(metroUtils.isColor(d.hintColor)?a.css("color",d.hintColor):a.addClass(d.hintColor)),d.hintMaxSize>0&&a.css({"max-width":d.hintMaxSize}),"top"===d.hintPosition?(a.addClass("top"),a.css({top:b.offset().top-$(window).scrollTop()-a.outerHeight()-20,left:2===d.hintMode?b.offset().left+b.outerWidth()/2-a.outerWidth()/2-$(window).scrollLeft():b.offset().left-$(window).scrollLeft()})):"right"===d.hintPosition?(a.addClass("right"),a.css({top:2===d.hintMode?b.offset().top+b.outerHeight()/2-a.outerHeight()/2-$(window).scrollTop()-10:b.offset().top-10-$(window).scrollTop(),left:b.offset().left+b.outerWidth()+15-$(window).scrollLeft()})):"left"===d.hintPosition?(a.addClass("left"),a.css({top:2===d.hintMode?b.offset().top+b.outerHeight()/2-a.outerHeight()/2-$(window).scrollTop()-10:b.offset().top-10-$(window).scrollTop(),left:b.offset().left-a.outerWidth()-10-$(window).scrollLeft()})):(a.addClass("bottom"),a.css({top:b.offset().top-$(window).scrollTop()+b.outerHeight(),left:2===d.hintMode?b.offset().left+b.outerWidth()/2-a.outerWidth()/2-$(window).scrollLeft():b.offset().left-$(window).scrollLeft()})),d._hint=a,d.hintTimeout>0&&setTimeout(function(){d._hint.length&&d._hint.hide().remove()},d.hintTimeout)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.input",{version:"3.0.0",options:{showLabelOnValue:!1,textAutoResize:!1,textMaxHeight:0},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),a.hasClass("file")&&this._createInputFile(),a.hasClass("text")&&this._createInputText(),a.hasClass("password")&&this._createInputText(),a.hasClass("select")&&this._createInputSelect(),a.hasClass("textarea")&&this._createInputTextarea(),a.hasClass("modern")&&this._createInputModern(),a.data("input",this)},_createInputModern:function(){var a=this.element,b=a.find("input"),c=a.find(".placeholder");""!==b.val()&&c.css({display:"none"}),b.on("blur",function(){c.css(""!==b.val()?{display:"none"}:{display:"block"})}),b.on("focus",function(){c.css(""!==b.val()?{display:"none"}:{display:"block"})})},_createInputFile:function(){var a,b,c,d=this.element;a=$("<input type='text' class='input-file-wrapper' readonly style='z-index: 1; cursor: default;'>"),b=d.children(".button"),c=d.children('input[type="file"]'),c.css("z-index",0),a.insertAfter(c),c.attr("tabindex","-1"),b.attr("type","button"),a.attr("placeholder",c.attr("placeholder")),c.on("change",function(){var b=$(this).val();""!==b&&(a.val(b.replace(/.+[\\\/]/,"")),a.attr("title",b.replace(/.+[\\\/]/,"")))}),d.on("click",".button, .input-file-wrapper",function(){c.trigger("click")})},_createInputText:function(){var a=this.element,b=a.find(".helper-button.clear"),c=a.find(".helper-button.reveal"),d=a.find("input"),e=a.find(".helper-button"),f=a.find(".button"),g=a.find(".input-state-error, .input-state-warning, .input-state-info, .input-state-success, .input-state-required"),h=0,i="rtl"===a.attr("dir")||a.parents("[dir='rtl']").length>0;$.each(f,function(){var a=$(this);h+=a.outerWidth()}),i?(d.css({"padding-left":h+5}),g.css({left:h+8})):(d.css({"padding-right":h+5}),g.css({right:h+8})),e.attr("tabindex",-1).attr("type","button"),b&&b.on("click",function(){d.val("").trigger("change").focus()}),c&&a.hasClass("password")&&c.on("mousedown",function(){d.attr("type","text")}).on("mouseup",function(){d.attr("type","password").focus()})},_createInputSelect:function(){},_createInputTextarea:function(){var a=this.element,b=this.options,c=a.find("textarea"),d=function(){c.css({resize:"none","overflow-y":"hidden"}),c[0].style.height=0;var a=c[0].scrollHeight;c[0].style.height=b.textMaxHeight>0?b.textMaxHeight>a?a+"px":b.textMaxHeight+"px":a+"px"};b.textAutoResize&&(c.on("keyup",d),c.on("keydown",d),c.on("change",d),c.on("focus",d),c.on("cut",d),c.on("paste",d),c.on("drop",d))},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.keypad",{version:"3.0.0",options:{target:!1,shuffle:!1,length:!1,keys:["1","2","3","4","5","6","7","8","9","0"],size:32,onKey:function(){},onChange:function(){}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),"string"==typeof b.keys&&(b.keys=b.keys.split(",")),b.target!==!1&&(b.target=$(b.target)),this._createKeypad(),a.data("keypad",this)},_shuffleKeys:function(){var a=(this.element,this.options),b=a.keys.slice(0),c=this._keypad,d=b.length+2;a.shuffle&&(b=b.shuffle()),c.html("").css({width:d/4*a.size+2*(d/4+1)+2}),b.map(function(a){$("<div/>").addClass("key").html(a).data("key",a).appendTo(c)}),$("<div/>").addClass("key").html("&larr;").data("key","&larr;").appendTo(c),$("<div/>").addClass("key").html("&times;").data("key","&times;").appendTo(c)},_createKeypad:function(){var that=this,element=this.element,o=this.options,keypad;element.hasClass("input-control")?(keypad=$("<div/>").addClass("keypad keypad-dropdown").css({position:"absolute","z-index":1e3,display:"none"}).appendTo(element),o.target=element.find("input"),element.on("click",function(a){"none"===keypad.css("display")?keypad.show():keypad.hide();var b=$(".keypad.keypad-dropdown");$.each(b,function(){$(this).is(keypad)||$(this).hide()}),a.stopPropagation()}),$("html").on("click",function(){$(".keypad.keypad-dropdown").hide()})):(keypad=element,keypad.addClass("keypad")),o.target!==!1&&$(o.target).attr("readonly",!0),"dropdown"===keypad.parent().data("role")&&keypad.parent().css({top:"100%"}),this._keypad=keypad,this._shuffleKeys(),keypad.on("click",".key",function(e){var key=$(this),result;if(o.target){if("&larr;"!==key.data("key")&&"&times;"!==key.data("key")){if(o.length&&$(o.target).val().length===o.length)return!1;$(o.target).val($(o.target).val()+""+key.data("key"))}else if("&times;"===key.data("key")&&$(o.target).val(""),"&larr;"===key.data("key")){var val=$(o.target).val();$(o.target).val(val.substring(0,val.length-1))}o.target.trigger("change")}"function"==typeof o.onKey?o.onKey(key):"function"==typeof window[o.onKey]?window[o.onKey](key):(result=eval("(function(){"+o.onKey+"})"),result.call(key)),"function"==typeof o.onChange?o.onChange(o.target.val()):"function"==typeof window[o.onChange]?window[o.onChange](o.target.val()):(result=eval("(function(){"+o.onChange+"})"),result.call({value:o.target.val()})),o.shuffle&&that._shuffleKeys(),e.preventDefault(),e.stopPropagation()})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.listview",{version:"3.0.0",options:{onExpand:function(){},onCollapse:function(){},onActivate:function(){},onListClick:function(){}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._initList(),this._createEvents(),a.data("listview",this)},_initList:function(){var a=this.element,b=(this.options,a.find(".list-group"));$.each(b,function(){var a=$(this);a.hasClass("collapsed")&&a.find(".list-group-content").hide()})},_createEvents:function(){var that=this,element=this.element,o=this.options;element.on("click",".list-group-toggle",function(e){var toggle=$(this),parent=toggle.parent(),result;toggle.parent().hasClass("keep-open")||(parent.toggleClass("collapsed"),parent.hasClass("collapsed")?(toggle.siblings(".list-group-content").slideUp("fast"),"function"==typeof o.onCollapse?o.onCollapse(parent):"function"==typeof window[o.onCollapse]?window[o.onCollapse](parent):(result=eval("(function(){"+o.onCollapse+"})"),result.call(parent))):(toggle.siblings(".list-group-content").slideDown("fast"),"function"==typeof o.onExpand?o.onExpand(parent):"function"==typeof window[o.onExpand]?window[o.onExpand](parent):(result=eval("(function(){"+o.onExpand+"})"),result.call(parent))),e.preventDefault(),e.stopPropagation())}),element.on("click",".list",function(e){var list=$(this),result;element.find(".list").removeClass("active"),list.addClass("active"),"function"==typeof o.onActivate?o.onActivate(list):"function"==typeof window[o.onActivate]?window[o.onActivate](list):(result=eval("(function(){"+o.onActivate+"})"),result.call(list)),"function"==typeof o.onListClick?o.onListClick(list):"function"==typeof window[o.onListClick]?window[o.onListClick](list):(result=eval("(function(){"+o.onListClick+"})"),result.call(list)),e.preventDefault(),e.stopPropagation()})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}});var _notify_container=!1,_notifies=[],Notify={_container:null,_notify:null,_timer:null,version:"3.0.0",options:{icon:"",caption:"",content:"",shadow:!0,width:"auto",height:"auto",style:!1,position:"right",timeout:3e3,keepOpen:!1,type:"default"},init:function(a){return this.options=$.extend({},this.options,a),this._build(),this},_build:function(){var a=this,b=this.options;if(this._container=_notify_container||$("<div/>").addClass("notify-container").appendTo("body"),_notify_container=this._container,""===b.content||void 0===b.content)return!1;if(this._notify=$("<div/>").addClass("notify"),"default"!==b.type&&this._notify.addClass(b.type),b.shadow&&this._notify.addClass("shadow"),b.style&&void 0!==b.style.background&&this._notify.css("background-color",b.style.background),b.style&&void 0!==b.style.color&&this._notify.css("color",b.style.color),""!==b.icon){$(b.icon).addClass("notify-icon").appendTo(this._notify)}""!==b.caption&&void 0!==b.caption&&$("<div/>").addClass("notify-title").html(b.caption).appendTo(this._notify),""!==b.content&&void 0!==b.content&&$("<div/>").addClass("notify-text").html(b.content).appendTo(this._notify);var c=$("<span/>").addClass("notify-closer").appendTo(this._notify);c.on("click",function(){a.close(0)}),"auto"!==b.width&&this._notify.css("min-width",b.width),"auto"!==b.height&&this._notify.css("min-height",b.height),this._notify.hide().appendTo(this._container).fadeIn("slow"),_notifies.push(this._notify),b.keepOpen||this.close(b.timeout)},close:function(a){var b=this;return void 0===a?this._hide():(setTimeout(function(){b._hide()},a),this)},_hide:function(){var a=this;return void 0!==this._notify?(this._notify.fadeOut("slow",function(){$(this).remove(),_notifies.splice(_notifies.indexOf(a._notify),1)}),this):!1},closeAll:function(){return _notifies.forEach(function(a){a.hide("slow",function(){a.remove(),_notifies.splice(_notifies.indexOf(a),1)})}),this}};return $.Notify=function(a){return Object.create(Notify).init(a)},$.Notify.show=function(a,b,c){return $.Notify({content:a,caption:b,icon:c})},$.widget("metro.panel",{version:"3.0.0",options:{onExpand:function(){},onCollapse:function(){}},_create:function(){var element=this.element,o=this.options;if($.each(element.data(),function(a,b){if(a in o)try{o[a]=$.parseJSON(b)}catch(c){o[a]=b}}),element.hasClass("collapsible")||element.addClass("collapsible"),element.hasClass("collapsible")){var toggle=element.children(".heading"),content=element.children(".content");toggle.on("click",function(){var result;element.hasClass("collapsed")?content.slideDown("fast",function(){element.removeClass("collapsed"),"function"==typeof o.onExpand?o.onExpand(element):"function"==typeof window[o.onExpand]?window[o.onExpand](element):(result=eval("(function(){"+o.onExpand+"})"),result.call(element))}):content.slideUp("fast",function(){element.addClass("collapsed"),"function"==typeof o.onCollapse?o.onCollapse(element):"function"==typeof window[o.onCollapse]?window[o.onCollapse](element):(result=eval("(function(){"+o.onCollapse+"})"),result.call(element))})})}element.data("panel",this)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.widget",{version:"1.0.0",options:{someValue:null},_create:function(){{var a=this.element;this.options}this._setOptionsFromDOM(),a.data("widget",this)},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.popover",{version:"3.0.0",options:{popoverText:"",popoverTimeout:3e3,popoverPosition:"top",popoverBackground:"bg-cyan",popoverColor:"fg-white",popoverMode:"none",popoverShadow:!0,onPopup:function(){}},popover:{},_create:function(){var a=this.element;this.createPopover(),a.data("popover",this)},createPopover:function(){var a,b=this,c=this.options;a=this.element,$.each(a.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}});var d,e;switch(d=$("<div/>").addClass("popover").appendTo("body").hide(),$("<div/>").appendTo(d),c.popoverShadow&&d.addClass("popover-shadow"),c.popoverBackground&&("#"===c.popoverBackground[0]?d.css("background-color",c.popoverBackground):d.addClass(c.popoverBackground)),c.popoverColor&&("#"===c.popoverColor[0]?d.css("color",c.popoverColor):d.addClass(c.popoverColor)),c.popoverPosition){case"left":e="marker-on-right";break;case"right":e="marker-on-left";break;case"bottom":e="marker-on-top";break;default:e="marker-on-bottom"}d.css({position:"fixed"}),d.addClass(e),this.popover=d,this.setText(c.popoverText),a.on(c.popoverMode,function(){d.data("visible")||b.show()}),$(window).scroll(function(){b.popover.data("visible")&&b.setPosition()})},setPosition:function(){var a=this.options,b=this.popover,c=this.element;return"top"===a.popoverPosition?b.css({top:c.offset().top-$(window).scrollTop()-b.outerHeight()-10,left:c.offset().left+c.outerWidth()/2-b.outerWidth()/2-$(window).scrollLeft()}):"bottom"===a.popoverPosition?b.css({top:c.offset().top-$(window).scrollTop()+c.outerHeight()+10,left:c.offset().left+c.outerWidth()/2-b.outerWidth()/2-$(window).scrollLeft()}):"right"===a.popoverPosition?b.css({top:c.offset().top+c.outerHeight()/2-b.outerHeight()/2-$(window).scrollTop(),left:c.offset().left+c.outerWidth()-$(window).scrollLeft()+10}):"left"===a.popoverPosition&&b.css({top:c.offset().top+c.outerHeight()/2-b.outerHeight()/2-$(window).scrollTop(),left:c.offset().left-b.outerWidth()-$(window).scrollLeft()-10}),this},setText:function(a){this.popover.children("div").html(a)},show:function(){var o=this.options,popover=this.popover;this.setPosition(),popover.fadeIn(function(){if(popover.data("visible",!0),"function"==typeof o.onPopup)o.onPopup(popover);else if("function"==typeof window[o.onPopup])window[o.onPopup](popover);else{var result=eval("(function(){"+o.onPopup+"})");result.call(popover)}setTimeout(function(){popover.fadeOut(function(){popover.data("visible",!1)})},o.popoverTimeout)})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.preloader",{version:"3.0.0",options:{type:"ring",style:"light"},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createStructure(),a.data("preloader",this)},_createRing:function(){{var a,b,c,d=this.element;this.options}for(a=0;5>a;a++)b=$("<div/>").addClass("wrap").appendTo(d),c=$("<div/>").addClass("circle").appendTo(b)},_createMetro:function(){{var a,b,c=this.element;this.options}for(a=0;5>a;a++)b=$("<div/>").addClass("circle").appendTo(c)},_createSquare:function(){{var a,b,c=this.element;this.options}for(a=0;4>a;a++)b=$("<div/>").addClass("square").appendTo(c)},_createCycle:function(){{var a,b=this.element;this.options}a=$("<div/>").addClass("cycle").appendTo(b)},_createStructure:function(){var a=this.element,b=this.options;switch(a.addClass("preloader-"+b.type),"light"!==b.style&&a.addClass(b.style+"-style"),a.html(""),b.type){case"ring":this._createRing();break;case"metro":this._createMetro();break;case"square":this._createSquare();break;case"cycle":this._createCycle()}},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.presenter",{version:"3.0.0",options:{height:"200",width:"100%",effect:"random",duration:1e3,timeout:2e3,sceneTimeout:2e3,easing:"swing"},_acts:void 0,_currentAct:0,_actDone:!0,_interval:void 0,_effects:["top","bottom","left","right"],_actor_positions:[],_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createPresenter(),this._showScene(),a.data("presenter",this)},_createPresenter:function(){var a=this.element,b=this.options,c=a.find(".act");c.hide(),this._acts=c,a.css({height:b.height,width:b.width})},_showScene:function(){{var a=this;this.element,this.options}this._interval=setInterval(function(){a._actDone&&(a._currentAct++,a._currentAct==a._acts.length&&(a._currentAct=0),a._showAct())},500)},_closeAct:function(){var a=this,b=(this.element,this.options),c=this._currentAct;setTimeout(function(){void 0!==a._acts[c]&&$(a._acts[c]).fadeOut(1e3,function(){a._actDone=!0})},b.sceneTimeout)},_showAct:function(){var a,b=this,c=this.element,d=this.options,e=$(this._acts[this._currentAct]),f=e.find(".actor");this._actDone=!1,e.fadeIn(1e3),f.css({opacity:0,position:"absolute",display:"none"}),a=0,$.each(f,function(){var e,g,h,i,j=$(this),k={top:j.data("position").split(",")[0],left:j.data("position").split(",")[1]};e=void 0!==j.data("effect")?j.data("effect"):d.effect,"random"===e&&(e=b._effects[Math.floor(Math.random()*b._effects.length)]),g=void 0!==j.data("duration")?j.data("duration"):d.duration,h=void 0!==j.data("timeout")?j.data("timeout"):d.timeout,i=void 0!==j.data("easing")?j.data("easing"):d.easing,"top"===e?setTimeout(function(){j.css({top:-c.height(),left:k.left,display:"block"}).animate({top:k.top,left:k.left,opacity:1},g,i,function(){j[0]==f[f.length-1]&&b._closeAct()})},a*h):"bottom"===e?setTimeout(function(){j.css({top:c.height(),left:k.left,display:"block"}).animate({top:k.top,left:k.left,opacity:1},g,i,function(){j[0]==f[f.length-1]&&b._closeAct()})},a*h):"left"===e?setTimeout(function(){j.css({left:-c.width(),top:k.top,display:"block"}).animate({top:k.top,left:k.left,opacity:1},g,i,function(){j[0]==f[f.length-1]&&b._closeAct()})},a*h):"right"===e?setTimeout(function(){j.css({left:c.width(),top:k.top,display:"block"}).animate({top:k.top,left:k.left,opacity:1},g,i,function(){j[0]==f[f.length-1]&&b._closeAct()})},a*h):setTimeout(function(){j.css({top:k.top,left:k.left,display:"block"}).animate({top:k.top,left:k.left,opacity:1},g,"swing",function(){j[0]==f[f.length-1]&&b._closeAct()})},a*h),a++})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.progress",{version:"3.0.0",options:{color:"default",colors:!1,value:0,animate:!1,onProgress:function(){}},colorsDim:{},_create:function(){var a=this,b=this.element,c=this.options,d=b.children(".bar:last-child");if(b.hasClass("progress")||b.addClass("progress"),$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),0===d.length&&(d=$("<div/>").addClass("bar").appendTo(b)),c.colors){var e=0;$.each(c.colors,function(b,c){a.colorsDim[b]=[e,c],e=c+1})}this.set(c.value),this.color(c.color),b.data("progress",this)},color:function(a){var b=this.element,c=this.options,d=b.children(".bar:last-child"),e=/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a);e?d.css({"background-color":a}):d.removeClass(function(a,b){return(b.match(/(^|\s)bg-\S+/g)||[]).join(" ")}).addClass(a),c.color=a},set:function(value){if(void 0===value)return this.options.value;var element=this.element,o=this.options,colors=this.colorsDim,bar=element.children(".bar:last-child"),that=this,gradient=[];if(!(parseInt(value)<0))if(o.colors&&$.each(colors,function(a,b){return value>=b[0]&&value<=b[1]?(that.color(a),!0):void 0}),o.value=value,o.animate!==!1){var ani_speed=isNaN(o.animate)?500:o.animate;bar.animate({width:o.value+"%"},ani_speed,function(){if("function"==typeof o.onProgress)o.onProgress(value);else if("function"==typeof window[o.onProgress])window[o.onProgress](value);else{var result=eval("(function(){"+o.onProgress+"})");result.call(value)}})}else if(bar.css({width:o.value+"%"}),"function"==typeof o.onProgress)o.onProgress(value);else if("function"==typeof window[o.onProgress])window[o.onProgress](value);else{var result=eval("(function(){"+o.onProgress+"})");result.call(value)}},value:function(a){return this.set(a)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.rating",{version:"3.0.0",options:{stars:5,value:0,half:!0,"static":!1,showScore:!0,scoreTitle:"Current: ",size:"default",colorRate:!1,onRate:function(){return!0},onRated:function(){}},_value:0,_values:[],_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._value=parseFloat(b.value),this._values[0]=Math.ceil(1*b.stars/3),this._values[1]=Math.ceil(2*b.stars/3),this._values[2]=b.stars,this._createRating(),this._createEvents(),this._setValue(this._value),this._setScore(this._value),a.data("rating",this)},_createRating:function(){var a,b,c,d=this.element,e=this.options;switch(d.hasClass("rating")||d.addClass("rating"),e.size){case"small":d.addClass("small");break;case"large":d.addClass("large")}for(e["static"]&&d.addClass("static"),a=0;a<e.stars;a++)b=$("<span/>").addClass("star").appendTo(d).data("star-value",a+1);e.showScore&&(c=$("<span/>").addClass("score").appendTo(d))},_createEvents:function(){var that=this,element=this.element,o=this.options,stars;stars=element.find(".star"),stars.on("click",function(e){if(o["static"]||element.hasClass("static")||element.data("static"))return!1;var result,value=$(this).data("star-value"),star=this,rating=that;if("function"==typeof o.onRate){if(!o.onRate(value,star,rating))return!1}else if("function"==typeof window[o.onRate]){if(!window[o.onRate](value,star,rating))return!1}else if(result=eval("(function(){"+o.onRate+"})"),!result.call(value,star,rating))return!1;"function"==typeof o.onRated?o.onRated(value,star,rating):"function"==typeof window[o.onRated]?window[o.onRated](value,star,rating):(result=eval("(function(){"+o.onRated+"})"),result.call(value,star,rating)),that._value=$(this).data("star-value"),that._setValue(),that._setScore(),e.preventDefault(),e.stopPropagation()})},_setValue:function(){var a,b=this.options,c=this.element;if(b.stars){a=c.find(".star").removeClass("on half");var d=Math.floor(this._value)-1,e=10*(this._value-Math.floor(this._value))>0;$(a[d]).addClass("on"),$(a[d]).prevAll().addClass("on"),e&&$(a[d]).next().addClass("on half")}b.colorRate&&(c.removeClass("poor regular good"),this._value<=this._values[0]?c.addClass("poor"):this._value>this._values[0]&&this._value<=this._values[1]?c.addClass("regular"):this._value>this._values[1]&&c.addClass("good"))},_setScore:function(){var a=this._value,b=this.element,c=this.options;void 0!==a&&b.find(".score").html(c.scoreTitle+a)},value:function(a){return void 0===a?this._value:(this._value=a,this._setValue(),this._setScore(),void 0)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.select",{version:"3.0.0",options:{},_create:function(){var a=this.element,b=this.options,c=["templateResult","templateSelection","matcher","initSelection","query"];if($.each(a.data(),function(a,c){try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),c.map(function(a){void 0!==b[a]&&(b[a]=window[b[a]])}),void 0!==b.dropdownParent&&(b.dropdownParent=$(b.dropdownParent)),$().select2)try{a.find("select").select2(b)}catch(d){}else console.log("You are trying to use support for Select2, but the plugin is not found!");a.data("select",this)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.slider",{version:"3.0.14",options:{position:0,buffer:0,accuracy:0,color:"default",completeColor:"default",bufferColor:"default",markerColor:"default",colors:!1,showHint:!1,permanentHint:!1,hintPosition:"top",vertical:!1,min:0,max:100,animate:!1,minValue:0,maxValue:100,currValue:0,returnType:"value",target:!1,onStartChange:function(){},onChange:function(){},onChanged:function(){},onBufferChange:function(){},_slider:{vertical:!1,offset:0,length:0,marker:0,ppp:0,start:0,stop:0}},_create:function(){var that=this,element=this.element,o=this.options,s=o._slider;$.each(element.data(),function(a,b){if(a in o)try{o[a]=$.parseJSON(b)}catch(c){o[a]=b}}),element.data("internal_id",metroUtils.uniqueId()),o.accuracy=o.accuracy<0?0:o.accuracy,o.min=o.min<0?0:o.min,o.min=o.min>o.max?o.max:o.min,o.max=o.max>100?100:o.max,o.max=o.max<o.min?o.min:o.max,o.position=this._correctValue(element.data("position")>o.min?element.data("position")>o.max?o.max:element.data("position"):o.min),o.buffer=this._correctValue(element.data("buffer")>o.min?element.data("buffer")>o.max?o.max:element.data("buffer"):o.min),o.colors=o.colors?o.colors.split(","):!1,s.vertical=o.vertical,o.vertical&&!element.hasClass("vertical")&&element.addClass("vertical"),o.permanentHint&&!element.hasClass("permanent-hint")&&element.addClass("permanent-hint"),o.vertical||"bottom"!==o.hintPosition||element.addClass("hint-bottom"),o.vertical&&"left"===o.hintPosition&&element.addClass("hint-left"),this._createSlider(),this._initPoints(),this._placeMarker(o.position),this._showBuffer(o.buffer);var event_down=isTouchDevice()?"touchstart":"mousedown";o.target&&"INPUT"==$(o.target)[0].tagName&&$(o.target).on("keyup",function(){var a=void 0!==this.value?this.value:0,b=Math.min(a,o.maxValue);that._placeMarker(that._realValueToValue(b))}),element.children(".marker").on(event_down,function(e){if(that._startMoveMarker(e),"function"==typeof o.onStartChange)o.onStartChange();else if("function"==typeof window[o.onStartChange])window[o.onStartChange]();else{var result=eval("(function(){"+o.onStartChange+"})");result.call()}e.preventDefault(),e.stopPropagation()}),element.on(event_down,function(a){a.preventDefault(),that._startMoveMarker(a)}),element.data("slider",this)},_startMoveMarker:function(e){var element=this.element,o=this.options,that=this,hint=element.children(".slider-hint"),returnedValue,event_move=isTouchDevice()?"touchmove":"mousemove",event_up=isTouchDevice()?"touchend":"mouseup mouseleave";$(document).on(event_move,function(a){that._movingMarker(a),element.hasClass("permanent-hint")||hint.css("display","block")}),$(document).on(event_up,function(){if($(document).off(event_move),$(document).off(event_up),element.data("value",o.position),element.trigger("changed",o.position),element.trigger("change",o.position),returnedValue="value"===o.returnType?that._valueToRealValue(o.position):o.position,element.hasClass("permanent-hint")||hint.css("display","none"),"function"==typeof o.onChanged)o.onChanged(returnedValue,element);else if("function"==typeof window[o.onChanged])window[o.onChanged](returnedValue,element);else{var result=eval("(function(){"+o.onChanged+"})");result.call(returnedValue,element)}}),this._initPoints(),this._movingMarker(e)},_movingMarker:function(ev){var element=this.element,o=this.options,cursorPos,percents,valuePix,vertical=o._slider.vertical,sliderOffset=o._slider.offset,sliderStart=o._slider.start,sliderEnd=o._slider.stop,sliderLength=o._slider.length,markerSize=o._slider.marker,event=isTouchDevice()?ev.originalEvent.touches[0]:ev.originalEvent;cursorPos=vertical?event.pageY-sliderOffset:event.pageX-sliderOffset,sliderStart>cursorPos?cursorPos=sliderStart:cursorPos>sliderEnd&&(cursorPos=sliderEnd),valuePix=vertical?sliderLength-cursorPos-markerSize/2:cursorPos-markerSize/2,percents=this._pixToPerc(valuePix),this._placeMarker(percents),o.currValue=this._valueToRealValue(percents),o.position=percents;var returnedValue="value"===o.returnType?this._valueToRealValue(o.position):o.position;if(o.target&&("INPUT"==$(o.target)[0].tagName?$(o.target).val(returnedValue):$(o.target).html(returnedValue),$(o.target).trigger("change",returnedValue)),"function"==typeof o.onChange)o.onChange(returnedValue,element);else if("function"==typeof window[o.onChange])window[o.onChange](returnedValue,element);else{var result=eval("(function(){"+o.onChange+"})");result.call(returnedValue,element)}},_placeMarker:function(a){var b,c,d,e,f,g=this.options,h=0,i=(this.element,this.element.children(".marker")),j=this.element.children(".complete"),k=this.element.children(".slider-hint"),l=this._percToPix(g.position);if(d=g.colors.length,e=g._slider.length/d,g._slider.vertical){var m=this._percToPix(g.position)+g._slider.marker,n=g._slider.length-m;b=this._percToPix(a)+g._slider.marker/2,c=g._slider.length-b,this._animate(i.css("top",n),{top:c}),this._animate(j.css("height",m),{height:b}),d&&(h=Math.round(b/e)-1,j.css("background-color",g.colors[0>h?0:h])),g.showHint&&(f=this._valueToRealValue(a),k.html(f).css("top",c-i.height()/2-k.height()/4))}else b=this._percToPix(a),this._animate(i.css("left",l),{left:b}),this._animate(j.css("width",l),{width:b}),d&&(h=Math.round(b/e)-1,j.css("background-color",g.colors[0>h?0:h])),g.showHint&&(f=this._valueToRealValue(a),k.html(f).css("left",b-i.width()/2))},_valueToRealValue:function(a){var b,c=this.options,d=(c.maxValue-c.minValue)/100;return b=a*d+c.minValue,Math.round(b)},_realValueToValue:function(a){var b,c=this.options,d=(c.maxValue-c.minValue)/100;return b=a/d+c.minValue,Math.round(b)},_animate:function(a,b){var c=this.options;c.animate?a.stop(!0).animate(b):a.css(b)},_pixToPerc:function(a){var b;return b=(0>a?0:a)*this.options._slider.ppp,Math.round(this._correctValue(b))},_percToPix:function(a){return 0===this.options._slider.ppp?0:Math.round(a/this.options._slider.ppp)},_correctValue:function(a){var b=this.options,c=b.accuracy,d=b.max,e=b.min;return 0===c?a:a===d?d:a===e?e:(a=Math.floor(a/c)*c+Math.round(a%c/c)*c,a>d?d:e>a?e:a)},_initPoints:function(){var a=this.options,b=a._slider,c=this.element;b.vertical?(b.offset=c.offset().top,b.length=c.height(),b.marker=c.children(".marker").height()):(b.offset=c.offset().left,b.length=c.width(),b.marker=c.children(".marker").width()),b.ppp=a.max/(b.length-b.marker),b.start=b.marker/2,b.stop=b.length-b.marker/2},_createSlider:function(){var a,b,c,d,e,f=this.element,g=this.options;f.html(""),e=$("<div/>").addClass("slider-backside").appendTo(f),a=$("<div/>").addClass("complete").appendTo(f),d=$("<div/>").addClass("buffer").appendTo(f),b=$("<a/>").addClass("marker").appendTo(f),g.showHint&&(c=$("<span/>").addClass("slider-hint").appendTo(f)),"default"!==g.color&&(metroUtils.isColor(g.color)?e.css("background-color",g.color):e.addClass(g.color)),
"default"!==g.completeColor&&(metroUtils.isColor(g.completeColor)?a.css("background-color",g.completeColor):a.addClass(g.completeColor)),"default"!==g.bufferColor&&(metroUtils.isColor(g.bufferColor)?d.css("background-color",g.bufferColor):d.addClass(g.bufferColor)),"default"!==g.markerColor&&(metroUtils.isColor(g.markerColor)?b.css("background-color",g.markerColor):b.addClass(g.markerColor))},value:function(value){var element=this.element,o=this.options,returnedValue;if("undefined"!=typeof value){if(value=value>o.max?o.max:value,value=value<o.min?o.min:value,this._placeMarker(parseInt(value)),o.position=parseInt(value),returnedValue="value"===o.returnType?this._valueToRealValue(o.position):o.position,o.target&&("INPUT"==$(o.target)[0].tagName?$(o.target).val(returnedValue):$(o.target).html(returnedValue),$(o.target).trigger("change",returnedValue)),"function"==typeof o.onChange)o.onChange(returnedValue,element);else if("function"==typeof window[o.onChange])window[o.onChange](returnedValue,element);else{var result=eval("(function(){"+o.onChange+"})");result.call(returnedValue,element)}return this}return returnedValue="value"===o.returnType?this._valueToRealValue(o.position):o.position},_showBuffer:function(a){var b,c,d=this.options,e=(this.element,this.element.children(".buffer"));c=d.buffer,b=100==a?99.9:a,d._slider.vertical?this._animate(e.css("height",c+"%"),{height:b+"%"}):this._animate(e.css("width",c+"%"),{width:b+"%"})},buffer:function(value){var element=this.element,o=this.options,returnedValue;if("undefined"!=typeof value){if(value=value>100?100:value,value=0>value?0:value,this._showBuffer(parseInt(value)),o.buffer=parseInt(value),returnedValue=o.buffer,"function"==typeof o.onBufferChange)o.onBufferChange(returnedValue,element);else if("function"==typeof window[o.onBufferChange])window[o.onBufferChange](returnedValue,element);else{var result=eval("(function(){"+o.onBufferChange+"})");result.call(returnedValue,element)}return this}return returnedValue=o.buffer},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.stepper",{version:"3.0.0",options:{steps:3,start:1,type:"default",clickable:!0,onStep:function(){},onStepClick:function(){}},_create:function(){var a=this.element,b=this.options,c=a.attr("id");$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),a.hasClass("stepper")||a.addClass("stepper"),void 0===c&&(c=metroUtils.uniqueId(this.widgetName+"_"),a.attr("id",c)),this._createStepper(),b.clickable&&this._createEvents(),this._positioningSteps(),this._stepTo(b.start),a.data("stepper",this)},_createEvents:function(){var that=this,element=this.element,o=this.options;element.on("click","li",function(e){var step=$(this).data("step");if("function"==typeof o.onStepClick)o.onStepClick(step-1,step);else if("function"==typeof window[o.onStepClick])window[o.onStepClick](step-1,step);else{var result=eval("(function(){"+o.onStepClick+"})");result.call(step-1,step)}element.trigger("stepclick",step)})},_createStepper:function(){var a,b,c,d=this.element,e=this.options;switch(b=$("<ul/>"),e.type){case"diamond":d.addClass("diamond");break;case"cycle":d.addClass("cycle")}for(a=0;a<e.steps;a++)c=$("<li/>").data("step",a+1).appendTo(b);b.appendTo(d)},_positioningSteps:function(){var a=this.element,b=(this.options,a.find("li")),c=a.width(),d=b.length-1,e=$(b[0]).width();$.each(b,function(a,b){var f=0===a?0:(c-e)/d*a;console.log(c),$(b).animate({left:f})})},_stepTo:function(step){var element=this.element,o=this.options,steps=element.find("li");steps.removeClass("current").removeClass("complete"),$.each(steps,function(i,s){if(step-1>i&&$(s).addClass("complete"),i===step-1)if($(s).addClass("current"),"function"==typeof o.onStep)o.onStep(i+1,s);else if("function"==typeof window[o.onStep])window[o.onStep](i+1,s);else{var result=eval("(function(){"+o.onStep+"})");result.call(i+1,s)}})},stepTo:function(a){this._stepTo(a)},first:function(){var a=this.options;a.start=1,this._stepTo(a.start)},last:function(){var a=this.element,b=this.options,c=a.find("li");b.start=c.length,this._stepTo(b.start)},next:function(){var a=this.element,b=this.options,c=a.find("li");b.start+1>c.length||(b.start++,this._stepTo(b.start))},prior:function(){var a=this.options;a.start-1!==0&&(a.start--,this._stepTo(a.start))},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.streamer",{version:"3.0.0",options:{scrollBar:!1,meterStart:9,meterStop:19,meterInterval:20,slideToTime:"default",slideSleep:1e3,slideSpeed:1e3,onClick:function(){}},_create:function(){var a=this.element,b=this.options,c=a.find(".stream"),d=a.find(".event"),e=a.find(".events"),f=a.find(".events-area"),g=a.find(".event-group"),h=a.find(".event-stream");$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),a.data("streamSelect",-1);var i,j,k,l=$("<ul/>").addClass("meter"),m=b.meterStart,n=b.meterStop,o=b.meterInterval,p=[];for(i=m;n>i;i++)for(j=0;60>j;j+=o)k=(10>i?"0"+i:i)+":"+(10>j?"0"+j:j),$("<li/>").addClass("js-interval-"+k.replace(":","-")).html("<em>"+k+"</em>").appendTo(l),p.push(k);a.data("intervals",p),l.insertBefore(a.find(".events-grid")),a.find(".event-stream").each(function(a,b){var d=0,e=$(b).find(".event");e.each(function(a,b){d+=$(b).outerWidth()+parseInt($(b).css("margin-left"))}),$(b).css({width:d+2*(e.length-1)+1}),$(b).find(".time").css("background-color",$(c[a]).css("background-color"))}),e.css({"overflow-x":b.scrollBar?"scroll":"hidden"}),a.css({height:a.find(".streams").outerHeight()+(b.scrollBar?20:0)});var q=0;g.each(function(a,b){q+=$(b).outerWidth()}),q+=2*(g.length-1)+10,f.css("width",q),d.each(function(a,b){addTouchEvents(b)}),a.mousewheel(function(a,b){var c=50*b;return e.scrollLeft(e.scrollLeft()-c),!1}),c.each(function(b,c){$(c).mousedown(function(){a.data("streamSelect")==b?(d.removeClass("event-disable"),a.data("streamSelect",-1)):(a.data("streamSelect",b),d.addClass("event-disable"),$(h[b]).find(".event").removeClass("event-disable"))})}),this._createEvents(),this.slideToTime(b.slideToTime,b.slideSleep,b.slideSpeed),a.data("streamer",this)},_createEvents:function(){var that=this,element=this.element,o=this.options,events=element.find(".event");events.on("click",function(e){var event=$(this);if(e.ctrlKey&&$(this).toggleClass("selected"),"function"==typeof o.onClick)o.onClick(event);else if("function"==typeof window[o.onClick])window[o.onClick](event);else{var result=eval("(function(){"+o.onClick+"})");result.call(event)}e.preventDefault()}),element.find(".js-go-previous-time").on("click",function(){var a=element.data("intervals").indexOf(element.data("current-time"));if(0!=a){a--;var b=element.data("intervals")[a];that.slideToTime(b,0,o.slideSpeed)}}),element.find(".js-go-next-time").on("click",function(){var a=element.data("intervals").indexOf(element.data("current-time"));if(a!=element.data("intervals").length-1){a++;var b=element.data("intervals")[a];that.slideToTime(b,0,o.slideSpeed)}}),element.find(".js-show-all-streams").on("click",function(a){element.find(".event").removeClass("event-disable"),element.data("streamSelect",-1),a.preventDefault()}),element.find(".js-schedule-mode").on("click",function(a){$(this).toggleClass("active"),element.data("schedule-mode",$(this).hasClass("inverse")),a.preventDefault()})},slideToTime:function(a,b,c){var d,e,f=this,g=this.element;"default"===a?(d=g.find(".meter li")[0],a=d.className.replace("js-interval-","").replace("-",":")):(e=a.split(":"),1===e[0].length&&(a="0"+a)),d=g.find(".meter li.js-interval-"+a.replace(":","-"))[0],setTimeout(function(){g.find(".events").animate({scrollLeft:d.offsetLeft-$(".streams").width()},c,function(){f._afterSlide()})},b),g.data("current-time",a)},_afterSlide:function(){},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.tabcontrol",{version:"3.0.0",options:{openTarget:!1,saveState:!1,onTabClick:function(){return!0},onTabChange:function(){},_current:{tab:!1,frame:!1}},_create:function(){{var a,b,c,d=this.element,e=this.options,f=d.children(".tabs").find("li").children("a");d.children(".frames").children("div")}if($.each(d.data(),function(a,b){if(a in e)try{e[a]=$.parseJSON(b)}catch(c){e[a]=b}}),e.saveState&&void 0!==d.attr("id")&&""!==d.attr("id").trim()){var g=window.localStorage.getItem(d.attr("id")+"-stored-tab");g&&"undefined"!==g&&(a=d.find("a[href='"+g+"']"),a&&(b=a.attr("href"),c=b&&metroUtils.isUrl(b)?!1:$(b),e._current.tab=a,e._current.frame=c))}if(e._current.tab||e.openTarget===!1||(a=d.find("a[href='"+e.openTarget+"']"),a&&(b=a.attr("href"),c=b&&metroUtils.isUrl(b)?!1:$(b),e._current.tab=a,e._current.frame=c)),e._current.tab||$.each(f,function(a,b){var c=$(b),d=c.attr("href"),f=metroUtils.isUrl(d)?!1:$(d);c.parent().hasClass("active")&&!c.parent().hasClass("disabled")&&f!==!1&&(e._current.tab=c,e._current.frame=f)}),!e._current.tab)for(var h=0;h<f.length;h++)if(!metroUtils.isUrl($(f[h]).attr("href"))&&!$(f[h]).parent().hasClass("disabled")){e._current.tab=$(f[h]),e._current.frame=$($(f[h]).attr("href"));break}this._createEvents(),this._openTab(),d.data("tabcontrol",this)},_hideTabs:function(){var a=this.element,b=a.outerWidth(),c=a.children(".tabs").find("li:not(.non-visible-tabs)"),d=a.children(".tabs").find(".non-visible-tabs").children(".d-menu");$.each(c,function(){var a=$(this),c=this;if(c.offsetLeft+c.offsetWidth+30>b){var e=a.clone(!0);e.appendTo(d),a.remove()}})},_openTab:function(){var a=this.element,b=this.options,c=a.children(".tabs").find("li").children("a"),d=a.children(".frames").children("div");c.parent().removeClass("active"),d.hide(),b._current.tab.parent().addClass("active"),b._current.frame.show(),b.saveState&&void 0!==a.attr("id")&&""!==a.attr("id").trim()&&window.localStorage.setItem(a.attr("id")+"-stored-tab",b._current.tab.attr("href"))},_createEvents:function(){var that=this,element=this.element,o=this.options,tabs=element.children(".tabs").find("li").children("a"),frames=element.children(".frames").children("div");element.on("click",".tabs > li > a",function(e){var result,tab=$(this),target=tab.attr("href"),frame=$(target);if(tab.parent().hasClass("disabled"))return!1;if("function"==typeof o.onTabClick){if(!o.onTabClick(tab))return!1}else if("function"==typeof window[o.onTabClick]){if(!window[o.onTabClick](tab))return!1}else if(result=eval("(function(){"+o.onTabClick+"})"),!result.call(tab))return!1;return metroUtils.isUrl(target)?(window.location.href=target,!0):(o._current.tab=tab,o._current.frame=frame,that._openTab(),"function"==typeof o.onTabChange?o.onTabChange(tab):"function"==typeof window[o.onTabChange]?window[o.onTabChange](tab):(result=eval("(function(){"+o.onTabChange+"})"),result.call(tab)),e.preventDefault(),void e.stopPropagation())})},hideTab:function(){},showTab:function(){},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.tile",{version:"3.0.0",options:{effect:"slideLeft",period:4e3,duration:700,easing:"doubleSqrt",onClick:function(){}},_frames:{},_currentIndex:0,_interval:0,_outPosition:0,_size:{},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createTransformTile(),this._createLiveTile(),this._createEvents(),a.data("tile",this)},_createEvents:function(){var that=this,element=this.element,o=this.options,event=isTouchDevice()?"touchstart":"click";element.on(event,function(e){if("A"===element[0].tagName);else if("function"==typeof o.onClick)o.onClick(element);else if("function"==typeof window[o.onClick])window[o.onClick](element);else{var result=eval("(function(){"+o.onClick+"})");result.call(element)}})},_createLiveTile:function(){var a=this,b=this.element,c=(this.options,isTouchDevice()?"touchstart":"mouseenter"),d=isTouchDevice()?"touchend":"mouseleave";return this._frames=b.find(".live-slide"),this._frames.length<=1?!1:($.easing.doubleSqrt=function(a){return Math.sqrt(Math.sqrt(a))},this._size={width:b.width(),height:b.height()},b.on(c,function(){a.stop()}),b.on(d,function(){a.start()}),void this.start())},start:function(){var a=this;this._interval=setInterval(function(){a._animate()},this.options.period)},stop:function(){clearInterval(this._interval)},_animate:function(){var a,b=this._frames[this._currentIndex];switch(this._currentIndex+=1,this._currentIndex>=this._frames.length&&(this._currentIndex=0),a=this._frames[this._currentIndex],this.options.effect){case"slideLeft":this._effectSlideLeft(b,a);break;case"slideRight":this._effectSlideRight(b,a);break;case"slideDown":this._effectSlideDown(b,a);break;case"slideUpDown":this._effectSlideUpDown(b,a);break;case"slideLeftRight":this._effectSlideLeftRight(b,a);break;default:this._effectSlideUp(b,a)}},_effectSlideLeftRight:function(a,b){this._currentIndex%2===0?this._effectSlideLeft(a,b):this._effectSlideRight(a,b)},_effectSlideUpDown:function(a,b){this._currentIndex%2===0?this._effectSlideUp(a,b):this._effectSlideDown(a,b)},_effectSlideUp:function(a,b){var c=this._size.height,d={duration:this.options.duration,easing:this.options.easing};$(a).animate({top:-c},d),$(b).css({top:c}).show().animate({top:0},d)},_effectSlideDown:function(a,b){var c=this._size.height,d={duration:this.options.duration,easing:this.options.easing};$(a).animate({top:c},d),$(b).css({top:-c}).show().animate({top:0},d)},_effectSlideLeft:function(a,b){var c=this._size.width,d={duration:this.options.duration,easing:this.options.easing};$(a).animate({left:-1*c},d),$(b).css({left:c}).show().animate({left:0},d)},_effectSlideRight:function(a,b){var c=this._size.width,d={duration:this.options.duration,easing:this.options.easing};$(a).animate({left:c},d),$(b).css({left:-c}).show().animate({left:0},d)},_createTransformTile:function(){var a=this.element,b=(this.options,{w:a.width(),h:a.height()}),c=isTouchDevice()?"touchstart":"mousedown",d=isTouchDevice()?"touchend":"mouseup",e=isTouchDevice()?"touchend":"mouseleave";a.on(c,function(c){var d=c.pageX-$(this).offset().left,e=c.pageY-$(this).offset().top,f="top";d<1*b.w/3&&(e<1*b.h/2||e>1*b.h/2)?f="left":d>2*b.w/3&&(e<1*b.h/2||e>1*b.h/2)?f="right":d>1*b.w/3&&d<2*b.w/3&&e>b.h/2&&(f="bottom"),$(this).addClass("tile-transform-"+f),"A"===a[0].tagName&&a.attr("href")&&setTimeout(function(){document.location.href=a.attr("href")},500)}),a.on(d,function(){$(this).removeClass("tile-transform-left").removeClass("tile-transform-right").removeClass("tile-transform-top").removeClass("tile-transform-bottom")}),a.on(e,function(){$(this).removeClass("tile-transform-left").removeClass("tile-transform-right").removeClass("tile-transform-top").removeClass("tile-transform-bottom")})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.treeview",{version:"3.0.0",options:{doubleClick:!0,onClick:function(){},onInputClick:function(){},onExpand:function(){},onCollapse:function(){}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._initTree(),this._createEvents(),a.data("treeview",this)},_createCheckbox:function(a,b){var c,d,e;c=$("<label/>").addClass("input-control checkbox small-check").insertBefore(a),d=$("<input/>").attr("type","checkbox").appendTo(c),e=$("<span/>").addClass("check").appendTo(c),void 0!==b.data("name")&&d.attr("name",b.data("name")),void 0!==b.data("id")&&d.attr("id",b.data("id")),void 0!==b.data("checked")&&d.prop("checked",b.data("checked")),void 0!==b.data("readonly")&&d.prop("disabled",b.data("readonly")),void 0!==b.data("disabled")&&(d.prop("disabled",b.data("disabled")),b.data("disabled")===!0&&b.addClass("disabled")),void 0!==b.data("value")&&d.val(b.data("value"))},_createRadio:function(a,b){var c,d,e;c=$("<label/>").addClass("input-control radio small-check").insertBefore(a),d=$("<input/>").attr("type","radio").appendTo(c),e=$("<span/>").addClass("check").appendTo(c),void 0!==b.data("name")&&d.attr("name",b.data("name")),void 0!==b.data("id")&&d.attr("id",b.data("id")),void 0!==b.data("checked")&&d.prop("checked",b.data("checked")),void 0!==b.data("readonly")&&d.prop("disabled",b.data("readonly")),void 0!==b.data("disabled")&&(d.prop("disabled",b.data("disabled")),b.data("disabled")===!0&&b.addClass("disabled")),void 0!==b.data("value")&&d.val(b.data("value"))},_initTree:function(){var a=this,b=this.element,c=(this.options,b.find(".leaf"));$.each(c,function(){{var b=$(this),c=b.parent("li"),d=b.siblings("ul");$(b.parents(".node")[0])}"checkbox"===c.data("mode")&&a._createCheckbox(b,c),"radio"===c.data("mode")&&a._createRadio(b,c),d.length>0&&(c.hasClass("node")||c.addClass("node")),c.hasClass("collapsed")&&d.hide()})},_renderChecks:function(a){var b=this.element,c=(this.options,a.is(":checked")),d=$(a.parent().parent()),e=d.children("ul").find('[type="checkbox"]');e.prop("checked",c).removeClass("indeterminate"),$.each(b.find(".node[data-mode=checkbox]").reverse(),function(){var a=$(this),b=a.children(".input-control").find('[type="checkbox"]'),c=a.children("ul").find('[type="checkbox"]'),d=a.children("ul").find('[type="checkbox"]:checked');b.removeClass("indeterminate"),0===d.length?(b.prop("checked",!1),b.removeClass("indeterminate")):d.length>0&&c.length>d.length&&(b.prop("checked",!0),b.addClass("indeterminate"))})},_createEvents:function(){var that=this,element=this.element,o=this.options;element.on("change","input:checkbox",function(){that._renderChecks($(this))}),element.on("click","input",function(){var leaf=$(this),node=$(leaf.parents(".node")[0]),parent=leaf.parent("li"),check=leaf.siblings(".input-control").find("input:checkbox"),radio=leaf.siblings(".input-control").find("input:radio"),new_check_state,check_disabled;if(check.length>0&&(new_check_state=!check.is(":checked"),check_disabled=check.is(":disabled"),check_disabled||check.prop("checked",new_check_state),that._renderChecks(check)),radio.length>0&&(check_disabled=radio.is(":disabled"),check_disabled||radio.prop("checked",!0)),"function"==typeof o.onInputClick)o.onInputClick(leaf,parent,node,that);else if("function"==typeof window[o.onInputClick])window[o.onInputClick](leaf,parent,node,that);else{var result=eval("(function(){"+o.onInputClick+"})");result.call(leaf,parent,node,that)}}),element.on("click",".leaf",function(){var leaf=$(this),node=$(leaf.parents(".node")[0]),parent=leaf.parent("li");if(element.find(".leaf").parent("li").removeClass("active"),parent.addClass("active"),"function"==typeof o.onClick)o.onClick(leaf,parent,node,that);else if("function"==typeof window[o.onClick])window[o.onClick](leaf,parent,node,that);else{var result=eval("(function(){"+o.onClick+"})");result.call(leaf,parent,node,that)}}),o.doubleClick&&element.on("dblclick",".leaf",function(e){var leaf=$(this),parent=leaf.parent("li"),node=$(leaf.parents(".node")[0]),result;return parent.hasClass("keep-open")?!1:(parent.toggleClass("collapsed"),parent.hasClass("collapsed")?(parent.children("ul").fadeOut("fast"),"function"==typeof o.onCollapse?o.onCollapse(parent,leaf,node,that):"function"==typeof window[o.onCollapse]?window[o.onCollapse](parent,leaf,node,that):(result=eval("(function(){"+o.onCollapse+"})"),result.call(parent,leaf,node,that))):(parent.children("ul").fadeIn("fast"),"function"==typeof o.onExpand?o.onExpand(parent,leaf,node,that):"function"==typeof window[o.onExpand]?window[o.onExpand](parent,leaf,node,that):(result=eval("(function(){"+o.onExpand+"})"),result.call(parent,leaf,node,that))),e.stopPropagation(),void e.preventDefault())}),element.on("click",".node-toggle",function(e){var leaf=$(this).siblings(".leaf"),parent=$(this).parent("li"),node=$(leaf.parents(".node")[0]),result;return parent.hasClass("keep-open")?!1:(parent.toggleClass("collapsed"),parent.hasClass("collapsed")?(parent.children("ul").fadeOut("fast"),"function"==typeof o.onCollapse?o.onCollapse(parent,leaf,node,that):"function"==typeof window[o.onCollapse]?window[o.onCollapse](parent,leaf,node,that):(result=eval("(function(){"+o.onCollapse+"})"),result.call(parent,leaf,node,that))):(parent.children("ul").fadeIn("fast"),"function"==typeof o.onExpand?o.onExpand(parent,leaf,node,that):"function"==typeof window[o.onExpand]?window[o.onExpand](parent,leaf,node,that):(result=eval("(function(){"+o.onExpand+"})"),result.call(parent,leaf,node,that))),e.stopPropagation(),void e.preventDefault())})},addLeaf:function(a,b,c){var d,e,f,g=this.element;if(a&&("LI"===a[0].tagName&&a.addClass("node"),0===a.children(".node-toggle").length&&$("<span/>").addClass("node-toggle").appendTo(a)),f=a?$(a).children("ul"):g.children("ul"),0===f.length&&(f=$("<ul/>").appendTo(a?a:g)),e=$("<li/>").appendTo(f),d=void 0!==c&&void 0!==c.tagName?$("<"+c.tagName+"/>").addClass("leaf").appendTo(e):$("<span/>").addClass("leaf").appendTo(e),d.html(b),void 0!==c&&($.each(c,function(a,b){e.attr("data-"+a,b)}),void 0!==c.mode))switch(c.mode){case"checkbox":this._createCheckbox(d,e);break;case"radio":this._createRadio(d,e)}return e},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.validator",{version:"1.0.0",options:{showErrorState:!0,showErrorHint:!0,showRequiredState:!0,showSuccessState:!0,hintSize:0,hintBackground:"#FFFCC0",hintColor:"#000000",hideError:2e3,hideHint:5e3,hintEasing:"easeInQuad",hintEasingTime:400,hintMode:"hint",hintPosition:"right",focusInput:!0,onBeforeSubmit:function(){return!0},onErrorInput:function(){},onSubmit:function(){return!0}},_scroll:0,funcs:{required:function(a){return""!==a.trim()},minlength:function(a,b){return void 0==b||isNaN(b)||0>=b?!1:a.trim().length>=b},maxlength:function(a,b){return void 0==b||isNaN(b)||0>=b?!1:a.trim().length<=b},min:function(a,b){return void 0==b||isNaN(b)?!1:this.number(a)?isNaN(a)?!1:Number(a)>=Number(b):!1},max:function(a,b){return void 0==b||isNaN(b)?!1:this.number(a)?isNaN(a)?!1:Number(a)<=Number(b):!1},email:function(a){return/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(a)},url:function(a){return/^(?:[a-z]+:)?\/\//i.test(a)},date:function(a){return!("Invalid Date"===new Date(a)||isNaN(new Date(a)))},number:function(a){return a-0==a&&(""+a).trim().length>0},digits:function(a){return/^\d+$/.test(a)},hexcolor:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},pattern:function(a,b){if(void 0==b)return!1;var c=new RegExp(b);return c.test(a)}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),"line"!==b.hintMode&&(b.hintMode="hint2"),this._scroll=$(window).scrollTop(),this._createValidator(),a.data("validator",this)},_createValidator:function(){var a=this,b=this.element,c=this.options,d=b.find("[data-validate-func]");b.attr("novalidate","novalidate"),c.showRequiredState&&$.each(d,function(){var a=$(this);a.parent().hasClass("input-control")?a.parent().addClass("required"):a.addClass("required")}),d.on("focus",function(){}),$(window).scroll(function(){var a=$(this).scrollTop(),b=isNaN(a-this._scroll)?0:a-this._scroll;$(".validator-hint.hint2:not(.line)").css({top:"-="+b}),this._scroll=a}),b[0].onsubmit?(this._onsubmit=b[0].onsubmit,b[0].onsubmit=null):this._onsubmit=null,b[0].onsubmit=function(){return a._submit()}},_submit:function(){var that=this,element=this.element,o=this.options,inputs=element.find("[data-validate-func]"),submit=element.find(":submit").attr("disabled","disabled").addClass("disabled"),result=0;if($(".validator-hint").hide(),inputs.removeClass("error success"),$.each(inputs,function(a,b){var c=$(b);c.parent().hasClass("input-control")&&c.parent().removeClass("error success")}),$.each(inputs,function(i,v){var this_result=!0,input=$(v),func=[],arg=[];func=void 0!=input.data("validateFunc")?String(input.data("validateFunc")).split(","):[],$.each(func,function(a){func[a]=String(func[a]).trim()}),-1!==func.indexOf("pattern")?arg.push(String(input.data("validateArg"))):arg=void 0!=input.data("validateArg")?String(input.data("validateArg")).split(","):[],$.each(func,function(a,b){if(this_result){var c=void 0!=arg[a]?arg[a]:!1;this_result=that.funcs[b.trim()](input.val(),c)}}),this_result||("function"==typeof o.onErrorInput?o.onErrorInput(input):"function"==typeof window[o.onErrorInput]?window[o.onErrorInput](input):(result=eval("(function(){"+o.onErrorInput+"})"),result.call(input))),!this_result&&o.showErrorState&&that._showError(input),!this_result&&o.showErrorHint&&setTimeout(function(){that._showErrorHint(input)},100*i),this_result&&o.showSuccessState&&that._showSuccess(input),!this_result&&0==i&&o.focusInput&&input.focus(),result+=this_result?0:1}),"function"==typeof o.onBeforeSubmit)result+=o.onBeforeSubmit(element,result)?0:1;else if("function"==typeof window[o.onBeforeSubmit])result+=window[o.onBeforeSubmit](element,result)?1:0;else{var f0=eval("(function(){"+o.onBeforeSubmit+"})");result+=f0.call(element,result)?1:0}if(0!==result)return submit.removeAttr("disabled").removeClass("disabled"),!1;if("function"==typeof o.onSubmit)result=o.onSubmit(element[0]);else if("function"==typeof window[o.onSubmit])result=window[o.onSubmit](element[0]);else{var f=eval("(function(){"+o.onSubmit+"})");result=f.call(element[0])}return submit.removeAttr("disabled").removeClass("disabled"),result},_showSuccess:function(a){a.parent().hasClass("input-control")?a.parent().addClass("success"):a.addClass("success")},_showError:function(a){var b=this.options;a.parent().hasClass("input-control")?a.parent().addClass("error"):a.addClass("error"),b.hideError&&b.hideError>0&&setTimeout(function(){a.parent().removeClass("error")},b.hideError)},_showErrorHint:function(a){var b,c,d,e=this.options,f=a.data("validateHint"),g=a.data("validateHintPosition")||e.hintPosition,h=a.data("validateHintMode")||e.hintMode,i=a.data("validateHintBackground")||e.hintBackground,j=a.data("validateHintColor")||e.hintColor;return void 0===f?!1:(b=$("<div/>").addClass(h+" validator-hint"),b.html(void 0!==f?this._format(f,a.val()):""),b.css({"min-width":e.hintSize}),metroUtils.isColor(i)?b.css("background-color",i):b.addClass(i),metroUtils.isColor(j)?b.css("color",j):b.addClass(j),void("line"===h?(b.addClass("hint2").addClass("line"),b.css({position:"relative",width:a.parent().hasClass("input-control")?a.parent().width():a.width(),"z-index":100}),b.appendTo(a.parent()),b.fadeIn(e.hintEasingTime,function(){setTimeout(function(){b.hide().remove()},e.hideHint)})):(b.appendTo("body"),"right"===g?(d=a.offset().left+a.outerWidth()+15-$(window).scrollLeft(),c=a.offset().top+a.outerHeight()/2-b.outerHeight()/2-$(window).scrollTop()-10,b.addClass(g),b.css({top:c,left:$(window).width()+100}),b.show().animate({left:d},e.hintEasingTime,e.hintEasing,function(){setTimeout(function(){b.hide().remove()},e.hideHint)})):"left"===g?(d=a.offset().left-b.outerWidth()-10-$(window).scrollLeft(),c=a.offset().top+a.outerHeight()/2-b.outerHeight()/2-$(window).scrollTop()-10,b.addClass(g),b.css({top:c,left:-a.offset().left-b.outerWidth()-10}),b.show().animate({left:d},e.hintEasingTime,e.hintEasing,function(){setTimeout(function(){b.hide().remove()},e.hideHint)})):"top"===g?(d=a.offset().left+a.outerWidth()/2-b.outerWidth()/2-$(window).scrollLeft(),c=a.offset().top-$(window).scrollTop()-b.outerHeight()-20,b.addClass(g),b.css({top:-b.outerHeight(),left:d}).show().animate({top:c},e.hintEasingTime,e.hintEasing,function(){setTimeout(function(){b.hide().remove()},e.hideHint)})):(d=a.offset().left+a.outerWidth()/2-b.outerWidth()/2-$(window).scrollLeft(),c=a.offset().top-$(window).scrollTop()+a.outerHeight(),b.addClass(g),b.css({top:$(window).height(),left:d}).show().animate({top:c},e.hintEasingTime,e.hintEasing,function(){setTimeout(function(){b.hide().remove()},e.hideHint)})))))},_format:function(a,b){return 1===arguments.length?function(){var b=$.makeArray(arguments);return b.unshift(a),$.validator.format.apply(this,b)}:(arguments.length>2&&b.constructor!==Array&&(b=$.makeArray(arguments).slice(1)),b.constructor!==Array&&(b=[b]),$.each(b,function(b,c){a=a.replace(new RegExp("\\{"+b+"\\}","g"),function(){return c})}),a)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.video",{version:"3.0.14",options:{width:"100%",videoSize:"hd",controls:!0,controlsPosition:"bottom",controlsModel:"full",loopButton:"<span class='mif-loop'></span>",stopButton:"<span class='mif-stop'></span>",playButton:"<span class='mif-play'></span>",pauseButton:"<span class='mif-pause'></span>",muteButton:"<span class='mif-volume-mute2'></span>",volumeLowButton:"<span class='mif-volume-low'></span>",volumeMediumButton:"<span class='mif-volume-medium'></span>",volumeHighButton:"<span class='mif-volume-high'></span>",screenMoreButton:"<span class='mif-enlarge'></span>",screenLessButton:"<span class='mif-shrink'></span>",fullScreenMode:"window",poster:!1,src:!1,loop:!1,preload:!1,autoplay:!1,muted:!1,volume:.5,logo:!1,controlsHide:1e3},_create:function(){{var a=this.element;this.options}this._setOptionsFromDOM(),this._createPlayer(),this._addControls(),this._addEvents(),a.data("video",this)},_createPlayer:function(){var a,b=this.element,c=this.options,d=b.width(),e=b.find("video");if("HD"==c.videoSize&&"hd"==c.videoSize?a=9*d/16:"SD"==c.videoSize&&"sd"==c.videoSize&&(a=3*d/4),b.addClass("video-player"),b.css({height:a}),0==e.length&&(e=$("<video/>").appendTo(b)),$.each(["muted","autoplay","controls","height","width","loop","poster","preload"],function(){e.removeAttr(this)}),c.poster&&e.attr("poster",c.poster),c.src)if(c.src.indexOf("youtube")>=0){var f=/v=[(\w)]+/gi;f.exec(c.src)[0].substring(2)}else e.attr("src",c.src);c.loop&&e.attr("loop","loop"),c.preload&&e.attr("preload","auto"),c.autoplay&&e.attr("autoplay","autoplay"),e[0].volume=c.volume,b.data("fullScreen",!1),b.data("muted",!1),b.data("duration",0),b.data("timeInterval",void 0),b.data("played",!1),b.data("volume",e[0].volume)},_addEvents:function(){var a=this,b=this.element,c=(b[0],this.options),d=b.find(".controls"),e=b.find(".video-preloader"),f=(d.find(".play"),d.find(".stop"),d.find(".volume"),d.find(".full"),d.find(".volume-slider"),d.find(".stream-slider"),d.find(".info-box")),g=b.find("video"),h=g[0];g.on("loadedmetadata",function(){b.data("duration",h.duration.toFixed(0)),f.html("00:00 / "+metroUtils.secondsToFormattedString(b.data("duration")))}),g.on("canplay",function(){d.fadeIn(),e.hide();var b=h.buffered.length?Math.round(Math.floor(h.buffered.end(0))/Math.floor(h.duration)*100):0;a._setBufferSize(b)}),g.on("progress",function(){var b=h.buffered.length?Math.round(Math.floor(h.buffered.end(0))/Math.floor(h.duration)*100):0;a._setBufferSize(b)}),g.on("timeupdate",function(){a._setInfoData(),a._setStreamSliderPosition()}),g.on("waiting",function(){e.show()}),g.on("loadeddata",function(){e.hide()}),g.on("ended",function(){a._stopVideo()}),b.on("play",function(){isTouchDevice()&&setTimeout(function(){d.fadeOut()},c.controlsHide)}),b.on("pause",function(){}),b.on("stop",function(){d.show()}),b.on("mouseenter",function(){setTimeout(function(){d.fadeIn()},c.controlsHide)}),b.on("mouseleave",function(){h.currentTime>0&&setTimeout(function(){d.fadeOut()},c.controlsHide)}),isTouchDevice()&&b.on("touchstart",function(){h.currentTime>0&&setTimeout(function(){"none"==d.css("display")?d.fadeIn():d.fadeOut()},c.controlsHide)})},_setInfoData:function(){var a=this.element,b=(a[0],this.options,a.find("video")),c=b[0],d=a.find(".controls .info-box"),e=Math.round(c.currentTime);d.html(metroUtils.secondsToFormattedString(e)+" / "+metroUtils.secondsToFormattedString(a.data("duration")))},_setStreamSliderPosition:function(){var a=this.element,b=(a[0],this.options,a.find("video")),c=b[0],d=a.find(".stream-slider").data("slider");d.value(Math.round(100*c.currentTime/a.data("duration")))},_setBufferSize:function(a){var b=this.element,c=(b[0],this.options,b.find("video")),d=(c[0],b.find(".stream-slider").data("slider"));d.buffer(Math.round(a))},_stop:function(){
var a=this.element,b=(a[0],this.options),c=a.find("video"),d=c[0],e=a.find(".controls .stop"),f=a.find(".controls .play");d.pause(),d.currentTime=0,f.html(b.playButton),e.attr("disabled","disabled"),a.data("played",!1),a.find(".stream-slider").data("slider").value(0),a.trigger("stop")},_play:function(){var a=this.element,b=(a[0],this.options),c=a.find("video"),d=c[0],e=a.find(".controls .play"),f=a.find(".controls .stop");d.paused?(e.html(b.pauseButton),d.play(),f.removeAttr("disabled"),a.data("played",!0),a.trigger("play")):(e.html(b.playButton),d.pause(),a.data("played",!1),a.trigger("pause"))},_addControls:function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n=this,o=this.element,p=o[0],q=this.options,r=o.find("video"),s=r[0];q.logo&&(b=$("<img/>").addClass("video-logo").appendTo(o),b.attr("src",q.logo)),a=$("<div/>").addClass("video-preloader").attr("data-role","preloader").attr("data-type","cycle").attr("data-style","color").appendTo(o),c=$("<div/>").addClass("controls").appendTo(o),c.addClass("position-"+q.controlsPosition),m=$("<div/>").addClass("stream-slider-wrapper").appendTo(c),j=$("<div/>").addClass("slider stream-slider").appendTo(m),j.slider({showHint:!0,animate:!1,markerColor:"bg-red",completeColor:"bg-cyan",onStartChange:function(){s.pause()},onChanged:function(a){s.seekable.length>0&&(s.currentTime=(o.data("duration")*a/100).toFixed(0)),o.data("played")&&s.currentTime>=0&&s.play()}}),j.data("slider").value(0),q.loopButton!==!1&&(d=$("<button/>").addClass("square-button small-button1 control-button loop no-phone").html(q.loopButton).appendTo(c),d.on("click",function(){d.toggleClass("active"),d.hasClass("active")?r.attr("loop","loop"):r.removeAttr("loop")})),q.playButton!==!1&&(e=$("<button/>").addClass("square-button small-button1 control-button play").html(q.playButton).appendTo(c),e.on("click",function(){n._play()})),q.stopButton!==!1&&(f=$("<button/>").addClass("square-button small-button1 control-button stop no-phone").html(q.stopButton).appendTo(c).attr("disabled","disabled"),f.on("click",function(){n._stop()})),k=$("<div/>").addClass("info-box no-small-phone").appendTo(c),k.html("00:00 / 00:00"),q.screenMoreButton!==!1&&(h=$("<button/>").addClass("square-button small-button1 control-button full").html(q.screenMoreButton).appendTo(c),h.on("click",function(){o.data("fullScreen",!o.data("fullScreen")),h.html(o.data("fullScreen")?q.screenLessButton:q.screenMoreButton),"window"===q.fullScreenMode?o.toggleClass("full-screen"):o.data("fullScreen")?p.requestFullscreen?p.requestFullscreen():p.msRequestFullscreen?p.msRequestFullscreen():p.mozRequestFullScreen?p.mozRequestFullScreen():p.webkitRequestFullscreen&&p.webkitRequestFullscreen():document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen(),o.data("fullScreen")?$(document).on("keyup.metro_video_player",function(a){27==a.keyCode&&(h.html(q.screenMoreButton),o.data("fullScreen",!1),o.hasClass("full-screen")&&o.removeClass("full-screen"))}):$(document).off("keyup.metro_video_player")})),l=$("<div/>").addClass("control-slider volume-slider-wrapper place-right").appendTo(c),i=$("<div/>").addClass("slider volume-slider").appendTo(l),i.slider({showHint:!0,animate:!1,markerColor:"bg-red",completeColor:"bg-green",onChange:function(a){s.volume=a/100,n._setupVolumeButton()}}),i.data("slider").value(100*s.volume),g=$("<button/>").addClass("square-button small-button1 control-button volume place-right").html(q.volumeLowButton).appendTo(c),g.on("click",function(){var a=o.find(".volume-slider").data("slider");o.data("muted",!o.data("muted")),o.data("muted")?(o.data("volume",s.volume),g.html(q.muteButton),a.value(0)):(s.volume=o.data("volume"),a.value(100*o.data("volume")),n._setupVolumeButton()),s.muted=o.data("muted")}),this._setupVolumeButton(),c.hide()},_setupVolumeButton:function(){var a=this.element,b=this.options,c=a.find("video"),d=c[0],e=a.find(".controls"),f=e.find(".volume"),g=d.volume;f.html(g>0&&.3>g?b.volumeLowButton:g>=.3&&.6>g?b.volumeMediumButton:g>=.6&&1>=g?b.volumeHighButton:b.muteButton)},_setOptionsFromDOM:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}})},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)},play:function(a,b){var c,d=this.element,e=(this.options,d.find("video")),f=e[0];this._stop(),e.find("source").remove(),e.removeAttr("src"),c=$("<source>").attr("src",a),void 0!=b&&c.attr("type",b),f.load(),c.appendTo(e),this._play()},stop:function(){this._stop()},pause:function(){var a=this.element,b=this.options,c=a.find("video"),d=c[0],e=a.find(".play");e.html(b.playButton),d.pause(),a.data("played",!1),a.trigger("pause")},resume:function(){var a=this.element,b=this.options,c=a.find("video"),d=c[0],e=a.find(".play"),f=a.find(".stop");e.html(b.pauseButton),d.play(),f.removeAttr("disabled"),a.data("played",!0),a.trigger("play")}}),$.widget("metro.window",{version:"3.0.0",options:{parent:"default",captionStyle:!1,contentStyle:!1,buttons:{btnMin:!1,btnMax:!1,btnClose:!1},title:!1,content:!1,icon:!1,type:"default",size:!1,onBtnMinClick:function(a){a.preventDefault()},onBtnMaxClick:function(a){a.preventDefault()},onBtnCloseClick:function(a){a.preventDefault()},onShow:function(a){a.preventDefault()},onHide:function(a){a.preventDefault()}},_create:function(){var a=this.element,b=this.options;$.each(a.data(),function(a,c){if(a in b)try{b[a]=$.parseJSON(c)}catch(d){b[a]=c}}),this._createWindow(),a.data("window",this)},_createWindow:function(){var a,b,c=this.element,d=this.options,e=c;e.addClass("window"),a=$("<div/>").addClass("window-caption"),b=$("<div/>").addClass("window-content"),(d.icon||d.title)&&a.appendTo(e),b.appendTo(e),"object"==typeof d.size&&$.each(d.size,function(a,c){b.css(a,c)}),d.captionStyle&&"object"==typeof d.captionStyle&&$.each(d.captionStyle,function(b,c){metroUtils.isColor(c)?a.css(b,c+" !important"):a.addClass(c)}),d.contentStyle&&"object"==typeof d.contentStyle&&$.each(d.contentStyle,function(a,c){metroUtils.isColor(c)?b.css(a,c+" !important"):b.addClass(c)}),e.appendTo("default"!==d.parent?d.parent:c.parent()),this.icon(),this.title(),this.buttons(),this.content()},icon:function(){var a=this.options,b=this.element.children(".window-caption"),c=b.find(".window-caption-icon");a.icon&&(0===c.length?$("<span/>").addClass("window-caption-icon").html(a.icon).appendTo(b):c.html(a.icon))},title:function(){var a=this.options,b=this.element.children(".window-caption"),c=b.find(".window-caption-title");a.title&&(0===c.length?$("<span/>").addClass("window-caption-title").html(a.title).appendTo(b):c.html(a.title))},buttons:function(){var a,b,c,d=this.options,f=this.element.children(".window-caption");if(0!==f.length&&d.buttons){var g=d.buttons.btnMin,h=d.buttons.btnMax,i=d.buttons.btnClose;if(g&&g!==!1)if(a=$("<span/>").addClass("btn-min").appendTo(f),"object"==typeof g&&a.css(g),"string"==typeof d.onBtnMinClick){var j=window[d.onBtnMinClick];a.on("click",j)}else a.on("click",d.onBtnMinClick(e));if(h&&h!==!1)if(b=$("<span/>").addClass("btn-max").appendTo(f),"object"==typeof h&&b.css(h),"string"==typeof d.onBtnMaxClick){var k=window[d.onBtnMaxClick];b.on("click",k)}else b.on("click",d.onBtnMaxClick(e));if(i&&i!==!1)if(c=$("<span/>").addClass("btn-close").appendTo(f),"object"==typeof i&&c.css(i),"string"==typeof d.onBtnCloseClick){var l=window[d.onBtnCloseClick];c.on("click",l)}else c.on("click",d.onBtnCloseClick(e))}},content:function(){var a=this.options,b=a.content,c=this.element.children(".window-content");if(b)if(metroUtils.isUrl(b)){if(b.indexOf("youtube")>-1){var d=$("<iframe>"),e=$("<div/>").addClass("video-container").appendTo(c);d.attr("src",b).attr("frameborder","0"),d.appendTo(e)}}else c.html(b)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.wizard",{version:"3.0.0",options:{stepper:!0,stepperType:"default",stepperClickable:!1,startPage:"default",finishStep:"default",locale:window.METRO_CURRENT_LOCALE,buttons:{cancel:!0,help:!0,prior:!0,next:!0,finish:!0},onCancel:function(){},onHelp:function(){},onPrior:function(){return!0},onNext:function(){return!0},onFinish:function(){},onPage:function(){},onStepClick:function(){}},_stepper:void 0,_currentStep:0,_steps:void 0,_create:function(){var that=this,element=this.element,o=this.options,steps=element.find(".step");$.each(element.data(),function(a,b){if(a in o)try{o[a]=$.parseJSON(b)}catch(c){o[a]=b}}),this._steps=steps,o.stepper&&(this._stepper=this._createStepper(steps.length).insertBefore(element.find(".steps")).stepper({clickable:o.stepperClickable}).on("stepclick",function(e,s){if(that.stepTo(s),"function"==typeof o.onStepClick)o.onStepClick(s);else if("function"==typeof window[o.onStepClick])window[o.onStepClick](s);else{var result=eval("(function(){"+o.onStepClick+"})");result.call(s)}})),void 0!==element.data("locale")&&(o.locale=element.data("locale")),this._createEvents();var sp="default"!==o.startPage&&parseInt(o.startPage)>1?o.startPage:1;this.stepTo(sp),"string"==typeof o.onPage?window[o.onPage](this._currentStep+1,element):o.onPage(this._currentStep+1,element),element.data("wizard",this)},_createStepper:function(a){var b,c=this.options;return b=$("<div/>").addClass("stepper").attr("data-role","stepper").attr("data-steps",a),"default"!==c.stepperType&&b.addClass(c.stepperType),b},_createEvents:function(){var that=this,element=this.element,o=this.options;if(o.buttons){var actions=$("<div/>").addClass("actions").appendTo(element),group_left=$("<div/>").addClass("group-left").appendTo(actions),group_right=$("<div/>").addClass("group-right").appendTo(actions),cancel_button,help_button,prior_button,next_button,finish_button;o.buttons.cancel&&(cancel_button=$("<button type='button'/>").addClass("btn-cancel").html(window.METRO_LOCALES[o.locale].buttons[2]),"boolean"==typeof o.buttons.cancel?cancel_button.appendTo(group_left):(o.buttons.cancel.title&&cancel_button.html(o.buttons.cancel.title),o.buttons.cancel.cls&&cancel_button.addClass(o.buttons.cancel.cls),cancel_button.appendTo(o.buttons.cancel.group&&"left"!==o.buttons.cancel.group?group_right:group_left)),cancel_button.on("click",function(){if("function"==typeof o.onCancel)o.onCancel(that._currentStep+1,element);else if("function"==typeof window[o.onCancel])window[o.onCancel](that._currentStep+1,element);else{var result=eval("(function(){"+o.onCancel+"})");result.call(that._currentStep+1,element)}})),o.buttons.help&&(help_button=$("<button type='button'/>").addClass("btn-help").html(window.METRO_LOCALES[o.locale].buttons[3]),"boolean"==typeof o.buttons.help?help_button.appendTo(group_right):(o.buttons.help.title&&help_button.html(o.buttons.help.title),o.buttons.help.cls&&help_button.addClass(o.buttons.help.cls),help_button.appendTo(o.buttons.help.group&&"left"!==o.buttons.help.group?group_right:group_left)),help_button.on("click",function(){if("function"==typeof o.onHelp)o.onHelp(that._currentStep+1,element);else if("function"==typeof window[o.onHelp])window[o.onHelp](that._currentStep+1,element);else{var result=eval("(function(){"+o.onHelp+"})");result.call(that._currentStep+1,element)}})),o.buttons.prior&&(prior_button=$("<button type='button'/>").addClass("btn-prior").html(window.METRO_LOCALES[o.locale].buttons[4]),"boolean"==typeof o.buttons.prior?prior_button.appendTo(group_right):(o.buttons.prior.title&&prior_button.html(o.buttons.prior.title),o.buttons.prior.cls&&prior_button.addClass(o.buttons.prior.cls),prior_button.appendTo(o.buttons.prior.group&&"left"!==o.buttons.prior.group?group_right:group_left)),prior_button.on("click",function(){if("function"==typeof o.onPrior)o.onPrior(that._currentStep+1,element)&&that.prior();else if("function"==typeof window[o.onPrior])window[o.onPrior](that._currentStep+1,element)&&that.prior();else{var result=eval("(function(){"+o.onPrior+"})");result.call(that._currentStep+1,element)&&that.prior()}})),o.buttons.next&&(next_button=$("<button type='button'/>").addClass("btn-next").html(window.METRO_LOCALES[o.locale].buttons[5]),"boolean"==typeof o.buttons.next?next_button.appendTo(group_right):(o.buttons.next.title&&next_button.html(o.buttons.next.title),o.buttons.next.cls&&next_button.addClass(o.buttons.next.cls),next_button.appendTo(o.buttons.next.group&&"left"!==o.buttons.next.group?group_right:group_left)),next_button.on("click",function(){if("function"==typeof o.onNext)o.onNext(that._currentStep+1,element)&&that.next();else if("function"==typeof window[o.onNext])window[o.onNext](that._currentStep+1,element)&&that.next();else{var result=eval("(function(){"+o.onNext+"})");result.call(that._currentStep+1,element)&&that.next()}})),o.buttons.finish&&(finish_button=$("<button type='button'/>").addClass("btn-finish").html(window.METRO_LOCALES[o.locale].buttons[6]),"boolean"==typeof o.buttons.finish?finish_button.appendTo(group_right):(o.buttons.finish.title&&finish_button.html(o.buttons.finish.title),o.buttons.finish.cls&&finish_button.addClass(o.buttons.finish.cls),finish_button.appendTo(o.buttons.finish.group&&"left"!==o.buttons.finish.group?group_right:group_left)),finish_button.on("click",function(){if("function"==typeof o.onFinish)o.onFinish(that._currentStep+1,element);else if("function"==typeof window[o.onFinish])window[o.onFinish](that._currentStep+1,element);else{var result=eval("(function(){"+o.onFinish+"})");result.call(that._currentStep+1,element)}}))}},next:function(){var element=this.element,that=this,o=this.options,new_step=this._currentStep+1;if(new_step===this._steps.length)return!1;if(this._currentStep=new_step,this._steps.hide(),$(this._steps[new_step]).show(),"function"==typeof o.onPage)o.onPage(that._currentStep+1,element);else if("function"==typeof window[o.onPage])window[o.onPage](that._currentStep+1,element);else{var result=eval("(function(){"+o.onPage+"})");result.call(that._currentStep+1,element)}void 0!==this._stepper&&this._stepper.stepper("stepTo",this._currentStep+1);var finish="default"===o.finishStep?this._steps.length-1:o.finishStep;return new_step===finish?this.element.find(".btn-finish").attr("disabled",!1):this.element.find(".btn-finish").attr("disabled",!0),new_step===this._steps.length-1?this.element.find(".btn-next").attr("disabled",!0):this.element.find(".btn-next").attr("disabled",!1),new_step>0&&this.element.find(".btn-prior").attr("disabled",!1),!0},prior:function(){var element=this.element,that=this,new_step=this._currentStep-1,o=this.options;if(0>new_step)return!1;if(this._currentStep=new_step,this._steps.hide(),$(this._steps[new_step]).show(),"function"==typeof o.onPage)o.onPage(that._currentStep+1,element);else if("function"==typeof window[o.onPage])window[o.onPage](that._currentStep+1,element);else{var result=eval("(function(){"+o.onPage+"})");result.call(that._currentStep+1,element)}void 0!==this._stepper&&this._stepper.stepper("stepTo",this._currentStep+1);var finish="default"===o.finishStep?this._steps.length-1:o.finishStep;return new_step===finish?this.element.find(".btn-finish").attr("disabled",!1):this.element.find(".btn-finish").attr("disabled",!0),0===new_step?this.element.find(".btn-prior").attr("disabled",!0):this.element.find(".btn-prior").attr("disabled",!1),finish>new_step&&this.element.find(".btn-next").attr("disabled",!1),!0},stepTo:function(step){var element=this.element,that=this,new_step=step-1,o=this.options;if(0>new_step)return!1;if(this._currentStep=new_step,this._steps.hide(),$(this._steps[new_step]).show(),"function"==typeof o.onPage)o.onPage(that._currentStep+1,element);else if("function"==typeof window[o.onPage])window[o.onPage](that._currentStep+1,element);else{var result=eval("(function(){"+o.onPage+"})");result.call(that._currentStep+1,element)}void 0!==this._stepper&&this._stepper.stepper("stepTo",step);var finish="default"===o.finishStep?this._steps.length-1:o.finishStep;return new_step===finish?this.element.find(".btn-finish").attr("disabled",!1):this.element.find(".btn-finish").attr("disabled",!0),this.element.find(".btn-next").attr("disabled",new_step>=finish),this.element.find(".btn-prior").attr("disabled",0>=new_step),!0},stepper:function(){return this._stepper},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.widget("metro.wizard2",{version:"3.0.0",options:{start:1,finish:"default",buttonLabels:{prev:"&lt;",next:"&gt;",finish:"OK",help:"?"},onPrior:function(){return!0},onNext:function(){return!0},onFinish:function(){},onHelp:function(){},onPage:function(){}},_step:1,_steps:void 0,_create:function(){var a=this,b=this.element,c=this.options;$.each(b.data(),function(a,b){if(a in c)try{c[a]=$.parseJSON(b)}catch(d){c[a]=b}}),this._step=c.start,this._steps=b.children(".step"),this._height=0,this._width=0,"default"===c.finish&&(c.finish=this._steps.length),$.each(this._steps,function(b,c){$(c).outerHeight()>a._height&&(a._height=$(c).outerHeight()),$(c).hasClass("active")&&(a._step=b+1)}),this._width=b.innerWidth()-(24*(this._steps.length-1)+this._steps.length),b.children(".step").css({height:this._height+48}),$(window).resize(function(){a._width=b.innerWidth()-(24*(a._steps.length-1)+a._steps.length),a.step(a._step)}),this._createActionBar(),this.step(c.start),this._placeActionBar(),b.data("wizard2",this)},_createActionBar:function(){var that=this,element=this.element,o=this.options,bar=$("<div/>").addClass("action-bar").appendTo(element),btn_prev,btn_next,btn_help,btn_finish;btn_help=$("<button/>").html(o.buttonLabels.help).addClass("button cycle-button medium-button wiz-btn-help place-left").appendTo(bar),btn_finish=$("<button/>").html(o.buttonLabels.finish).addClass("button cycle-button medium-button wiz-btn-finish place-right").appendTo(bar),btn_next=$("<button/>").html(o.buttonLabels.next).addClass("button cycle-button medium-button wiz-btn-next place-right").appendTo(bar),btn_prev=$("<button/>").html(o.buttonLabels.prev).addClass("button cycle-button medium-button wiz-btn-prev place-right").appendTo(bar),btn_help.on("click",function(){if("function"==typeof o.onHelp)o.onHelp(that._step,that);else if("function"==typeof window[o.onHelp])window[o.onHelp](that._step,that);else{var result=eval("(function(){"+o.onHelp+"})");result.call(that._step,that)}}),btn_finish.on("click",function(){if("function"==typeof o.onFinish)o.onFinish(that._step,that);else if("function"==typeof window[o.onFinish])window[o.onFinish](that._step,that);else{var result=eval("(function(){"+o.onFinish+"})");result.call(that._step,that)}}),btn_prev.on("click",function(){if("function"==typeof o.onPrior)o.onPrior(that._step,element)&&that.prior();else if("function"==typeof window[o.onPrior])window[o.onPrior](that._step,element)&&that.prior();else{var result=eval("(function(){"+o.onPrior+"})");result.call(that._step,element)&&that.prior()}}),btn_next.on("click",function(){if("function"==typeof o.onNext)o.onNext(that._step,element)&&that.next();else if("function"==typeof window[o.onNext])window[o.onNext](that._step,element)&&that.next();else{var result=eval("(function(){"+o.onNext+"})");result.call(that._step,element)&&that.next()}})},_placeActionBar:function(){var a=this.element,b=(this.options,a.find(".action-bar")),c=a.find(".step.active"),d=c.position().left,e=c.innerWidth();b.css({left:d,width:e})},step:function(a){var b=this.options;this.element.children(".step").removeClass("active prev next"),$(this.element.children(".step")[a-1]).addClass("active").css("width",this._width),this.element.children(".step.active").prevAll().addClass("prev").css("width",0),this.element.children(".step.active").nextAll().addClass("next").css("width",0),this._placeActionBar(),1===a?this.element.find(".wiz-btn-prev").hide():this.element.find(".wiz-btn-prev").show(),a===this._steps.length?this.element.find(".wiz-btn-next").hide():this.element.find(".wiz-btn-next").show(),a!==b.finish?this.element.find(".wiz-btn-finish").hide():this.element.find(".wiz-btn-finish").show()},prior:function(){var a=this._step-1;return 0>=a?!1:(this._step=a,this.step(a),!0)},next:function(){var a=this._step+1;return a>this._steps.length?!1:(this._step=a,this.step(a),!0)},_destroy:function(){},_setOption:function(a,b){this._super("_setOption",a,b)}}),$.Metro.init()});
/*! Select2 4.0.0-rc.2 | https://github.com/select2/select2/blob/master/LICENSE.md */!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b=function(){if(a&&a.fn&&a.fn.select2&&a.fn.select2.amd)var b=a.fn.select2.amd;var b;return function(){if(!b||!b.requirejs){b?c=b:b={};var a,c,d;!function(b){function e(a,b){return u.call(a,b)}function f(a,b){var c,d,e,f,g,h,i,j,k,l,m,n=b&&b.split("/"),o=s.map,p=o&&o["*"]||{};if(a&&"."===a.charAt(0))if(b){for(n=n.slice(0,n.length-1),a=a.split("/"),g=a.length-1,s.nodeIdCompat&&w.test(a[g])&&(a[g]=a[g].replace(w,"")),a=n.concat(a),k=0;k<a.length;k+=1)if(m=a[k],"."===m)a.splice(k,1),k-=1;else if(".."===m){if(1===k&&(".."===a[2]||".."===a[0]))break;k>0&&(a.splice(k-1,2),k-=2)}a=a.join("/")}else 0===a.indexOf("./")&&(a=a.substring(2));if((n||p)&&o){for(c=a.split("/"),k=c.length;k>0;k-=1){if(d=c.slice(0,k).join("/"),n)for(l=n.length;l>0;l-=1)if(e=o[n.slice(0,l).join("/")],e&&(e=e[d])){f=e,h=k;break}if(f)break;!i&&p&&p[d]&&(i=p[d],j=k)}!f&&i&&(f=i,h=j),f&&(c.splice(0,h,f),a=c.join("/"))}return a}function g(a,c){return function(){return n.apply(b,v.call(arguments,0).concat([a,c]))}}function h(a){return function(b){return f(b,a)}}function i(a){return function(b){q[a]=b}}function j(a){if(e(r,a)){var c=r[a];delete r[a],t[a]=!0,m.apply(b,c)}if(!e(q,a)&&!e(t,a))throw new Error("No "+a);return q[a]}function k(a){var b,c=a?a.indexOf("!"):-1;return c>-1&&(b=a.substring(0,c),a=a.substring(c+1,a.length)),[b,a]}function l(a){return function(){return s&&s.config&&s.config[a]||{}}}var m,n,o,p,q={},r={},s={},t={},u=Object.prototype.hasOwnProperty,v=[].slice,w=/\.js$/;o=function(a,b){var c,d=k(a),e=d[0];return a=d[1],e&&(e=f(e,b),c=j(e)),e?a=c&&c.normalize?c.normalize(a,h(b)):f(a,b):(a=f(a,b),d=k(a),e=d[0],a=d[1],e&&(c=j(e))),{f:e?e+"!"+a:a,n:a,pr:e,p:c}},p={require:function(a){return g(a)},exports:function(a){var b=q[a];return"undefined"!=typeof b?b:q[a]={}},module:function(a){return{id:a,uri:"",exports:q[a],config:l(a)}}},m=function(a,c,d,f){var h,k,l,m,n,s,u=[],v=typeof d;if(f=f||a,"undefined"===v||"function"===v){for(c=!c.length&&d.length?["require","exports","module"]:c,n=0;n<c.length;n+=1)if(m=o(c[n],f),k=m.f,"require"===k)u[n]=p.require(a);else if("exports"===k)u[n]=p.exports(a),s=!0;else if("module"===k)h=u[n]=p.module(a);else if(e(q,k)||e(r,k)||e(t,k))u[n]=j(k);else{if(!m.p)throw new Error(a+" missing "+k);m.p.load(m.n,g(f,!0),i(k),{}),u[n]=q[k]}l=d?d.apply(q[a],u):void 0,a&&(h&&h.exports!==b&&h.exports!==q[a]?q[a]=h.exports:l===b&&s||(q[a]=l))}else a&&(q[a]=d)},a=c=n=function(a,c,d,e,f){if("string"==typeof a)return p[a]?p[a](c):j(o(a,c).f);if(!a.splice){if(s=a,s.deps&&n(s.deps,s.callback),!c)return;c.splice?(a=c,c=d,d=null):a=b}return c=c||function(){},"function"==typeof d&&(d=e,e=f),e?m(b,a,c,d):setTimeout(function(){m(b,a,c,d)},4),n},n.config=function(a){return n(a)},a._defined=q,d=function(a,b,c){b.splice||(c=b,b=[]),e(q,a)||e(r,a)||(r[a]=[a,b,c])},d.amd={jQuery:!0}}(),b.requirejs=a,b.require=c,b.define=d}}(),b.define("almond",function(){}),b.define("jquery",[],function(){var b=a||$;return null==b&&console&&console.error&&console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."),b}),b.define("select2/utils",["jquery"],function(a){function b(a){var b=a.prototype,c=[];for(var d in b){var e=b[d];"function"==typeof e&&"constructor"!==d&&c.push(d)}return c}var c={};c.Extend=function(a,b){function c(){this.constructor=a}var d={}.hasOwnProperty;for(var e in b)d.call(b,e)&&(a[e]=b[e]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},c.Decorate=function(a,c){function d(){var b=Array.prototype.unshift,d=c.prototype.constructor.length,e=a.prototype.constructor;d>0&&(b.call(arguments,a.prototype.constructor),e=c.prototype.constructor),e.apply(this,arguments)}function e(){this.constructor=d}var f=b(c),g=b(a);c.displayName=a.displayName,d.prototype=new e;for(var h=0;h<g.length;h++){var i=g[h];d.prototype[i]=a.prototype[i]}for(var j=(function(a){var b=function(){};a in d.prototype&&(b=d.prototype[a]);var e=c.prototype[a];return function(){var a=Array.prototype.unshift;return a.call(arguments,b),e.apply(this,arguments)}}),k=0;k<f.length;k++){var l=f[k];d.prototype[l]=j(l)}return d};var d=function(){this.listeners={}};return d.prototype.on=function(a,b){this.listeners=this.listeners||{},a in this.listeners?this.listeners[a].push(b):this.listeners[a]=[b]},d.prototype.trigger=function(a){var b=Array.prototype.slice;this.listeners=this.listeners||{},a in this.listeners&&this.invoke(this.listeners[a],b.call(arguments,1)),"*"in this.listeners&&this.invoke(this.listeners["*"],arguments)},d.prototype.invoke=function(a,b){for(var c=0,d=a.length;d>c;c++)a[c].apply(this,b)},c.Observable=d,c.generateChars=function(a){for(var b="",c=0;a>c;c++){var d=Math.floor(36*Math.random());b+=d.toString(36)}return b},c.bind=function(a,b){return function(){a.apply(b,arguments)}},c._convertData=function(a){for(var b in a){var c=b.split("-"),d=a;if(1!==c.length){for(var e=0;e<c.length;e++){var f=c[e];f=f.substring(0,1).toLowerCase()+f.substring(1),f in d||(d[f]={}),e==c.length-1&&(d[f]=a[b]),d=d[f]}delete a[b]}}return a},c.hasScroll=function(b,c){var d=a(c),e=c.style.overflowX,f=c.style.overflowY;return e!==f||"hidden"!==f&&"visible"!==f?"scroll"===e||"scroll"===f?!0:d.innerHeight()<c.scrollHeight||d.innerWidth()<c.scrollWidth:!1},c.escapeMarkup=function(a){var b={"\\":"&#92;","&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#47;"};return"string"!=typeof a?a:String(a).replace(/[&<>"'\/\\]/g,function(a){return b[a]})},c}),b.define("select2/results",["jquery","./utils"],function(a,b){function c(a,b,d){this.$element=a,this.data=d,this.options=b,c.__super__.constructor.call(this)}return b.Extend(c,b.Observable),c.prototype.render=function(){var b=a('<ul class="select2-results__options" role="tree"></ul>');return this.options.get("multiple")&&b.attr("aria-multiselectable","true"),this.$results=b,b},c.prototype.clear=function(){this.$results.empty()},c.prototype.displayMessage=function(b){var c=this.options.get("escapeMarkup");this.clear(),this.hideLoading();var d=a('<li role="treeitem" class="select2-results__option"></li>'),e=this.options.get("translations").get(b.message);d.append(c(e(b.args))),this.$results.append(d)},c.prototype.append=function(a){this.hideLoading();var b=[];if(null==a.results||0===a.results.length)return void(0===this.$results.children().length&&this.trigger("results:message",{message:"noResults"}));a.results=this.sort(a.results);for(var c=0;c<a.results.length;c++){var d=a.results[c],e=this.option(d);b.push(e)}this.$results.append(b)},c.prototype.position=function(a,b){var c=b.find(".select2-results");c.append(a)},c.prototype.sort=function(a){var b=this.options.get("sorter");return b(a)},c.prototype.setClasses=function(){var b=this;this.data.current(function(c){var d=a.map(c,function(a){return a.id.toString()}),e=b.$results.find(".select2-results__option[aria-selected]");e.each(function(){var b=a(this),c=a.data(this,"data"),e=""+c.id;a.inArray(e,d)>-1?b.attr("aria-selected","true"):b.attr("aria-selected","false")});var f=e.filter("[aria-selected=true]");f.length>0?f.first().trigger("mouseenter"):e.first().trigger("mouseenter")})},c.prototype.showLoading=function(a){this.hideLoading();var b=this.options.get("translations").get("searching"),c={disabled:!0,loading:!0,text:b(a)},d=this.option(c);d.className+=" loading-results",this.$results.prepend(d)},c.prototype.hideLoading=function(){this.$results.find(".loading-results").remove()},c.prototype.option=function(b){var c=document.createElement("li");c.className="select2-results__option";var d={role:"treeitem","aria-selected":"false"};b.disabled&&(delete d["aria-selected"],d["aria-disabled"]="true"),null==b.id&&delete d["aria-selected"],null!=b._resultId&&(c.id=b._resultId),b.title&&(c.title=b.title),b.children&&(d.role="group",d["aria-label"]=b.text,delete d["aria-selected"]);for(var e in d){var f=d[e];c.setAttribute(e,f)}if(b.children){var g=a(c),h=document.createElement("strong");h.className="select2-results__group";{a(h)}this.template(b,h);for(var i=[],j=0;j<b.children.length;j++){var k=b.children[j],l=this.option(k);i.push(l)}var m=a("<ul></ul>",{"class":"select2-results__options select2-results__options--nested"});m.append(i),g.append(h),g.append(m)}else this.template(b,c);return a.data(c,"data",b),c},c.prototype.bind=function(b){var c=this,d=b.id+"-results";this.$results.attr("id",d),b.on("results:all",function(a){c.clear(),c.append(a.data),b.isOpen()&&c.setClasses()}),b.on("results:append",function(a){c.append(a.data),b.isOpen()&&c.setClasses()}),b.on("query",function(a){c.showLoading(a)}),b.on("select",function(){b.isOpen()&&c.setClasses()}),b.on("unselect",function(){b.isOpen()&&c.setClasses()}),b.on("open",function(){c.$results.attr("aria-expanded","true"),c.$results.attr("aria-hidden","false"),c.setClasses(),c.ensureHighlightVisible()}),b.on("close",function(){c.$results.attr("aria-expanded","false"),c.$results.attr("aria-hidden","true"),c.$results.removeAttr("aria-activedescendant")}),b.on("results:toggle",function(){var a=c.getHighlightedResults();0!==a.length&&a.trigger("mouseup")}),b.on("results:select",function(){var a=c.getHighlightedResults();if(0!==a.length){var b=a.data("data");"true"==a.attr("aria-selected")?c.trigger("close"):c.trigger("select",{data:b})}}),b.on("results:previous",function(){var a=c.getHighlightedResults(),b=c.$results.find("[aria-selected]"),d=b.index(a);if(0!==d){var e=d-1;0===a.length&&(e=0);var f=b.eq(e);f.trigger("mouseenter");var g=c.$results.offset().top,h=f.offset().top,i=c.$results.scrollTop()+(h-g);0===e?c.$results.scrollTop(0):0>h-g&&c.$results.scrollTop(i)}}),b.on("results:next",function(){var a=c.getHighlightedResults(),b=c.$results.find("[aria-selected]"),d=b.index(a),e=d+1;if(!(e>=b.length)){var f=b.eq(e);f.trigger("mouseenter");var g=c.$results.offset().top+c.$results.outerHeight(!1),h=f.offset().top+f.outerHeight(!1),i=c.$results.scrollTop()+h-g;0===e?c.$results.scrollTop(0):h>g&&c.$results.scrollTop(i)}}),b.on("results:focus",function(a){a.element.addClass("select2-results__option--highlighted")}),b.on("results:message",function(a){c.displayMessage(a)}),a.fn.mousewheel&&this.$results.on("mousewheel",function(a){var b=c.$results.scrollTop(),d=c.$results.get(0).scrollHeight-c.$results.scrollTop()+a.deltaY,e=a.deltaY>0&&b-a.deltaY<=0,f=a.deltaY<0&&d<=c.$results.height();e?(c.$results.scrollTop(0),a.preventDefault(),a.stopPropagation()):f&&(c.$results.scrollTop(c.$results.get(0).scrollHeight-c.$results.height()),a.preventDefault(),a.stopPropagation())}),this.$results.on("mouseup",".select2-results__option[aria-selected]",function(b){var d=a(this),e=d.data("data");return"true"===d.attr("aria-selected")?void(c.options.get("multiple")?c.trigger("unselect",{originalEvent:b,data:e}):c.trigger("close")):void c.trigger("select",{originalEvent:b,data:e})}),this.$results.on("mouseenter",".select2-results__option[aria-selected]",function(){var b=a(this).data("data");c.getHighlightedResults().removeClass("select2-results__option--highlighted"),c.trigger("results:focus",{data:b,element:a(this)})})},c.prototype.getHighlightedResults=function(){var a=this.$results.find(".select2-results__option--highlighted");return a},c.prototype.destroy=function(){this.$results.remove()},c.prototype.ensureHighlightVisible=function(){var a=this.getHighlightedResults();if(0!==a.length){var b=this.$results.find("[aria-selected]"),c=b.index(a),d=this.$results.offset().top,e=a.offset().top,f=this.$results.scrollTop()+(e-d),g=e-d;f-=2*a.outerHeight(!1),2>=c?this.$results.scrollTop(0):(g>this.$results.outerHeight()||0>g)&&this.$results.scrollTop(f)}},c.prototype.template=function(b,c){var d=this.options.get("templateResult"),e=this.options.get("escapeMarkup"),f=d(b);null==f?c.style.display="none":"string"==typeof f?c.innerHTML=e(f):a(c).append(f)},c}),b.define("select2/keys",[],function(){var a={BACKSPACE:8,TAB:9,ENTER:13,SHIFT:16,CTRL:17,ALT:18,ESC:27,SPACE:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,LEFT:37,UP:38,RIGHT:39,DOWN:40,DELETE:46};return a}),b.define("select2/selection/base",["jquery","../utils","../keys"],function(a,b,c){function d(a,b){this.$element=a,this.options=b,d.__super__.constructor.call(this)}return b.Extend(d,b.Observable),d.prototype.render=function(){var b=a('<span class="select2-selection" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"></span>');return this._tabindex=0,null!=this.$element.data("old-tabindex")?this._tabindex=this.$element.data("old-tabindex"):null!=this.$element.attr("tabindex")&&(this._tabindex=this.$element.attr("tabindex")),b.attr("title",this.$element.attr("title")),b.attr("tabindex",this._tabindex),this.$selection=b,b},d.prototype.bind=function(a){var b=this,d=(a.id+"-container",a.id+"-results");this.container=a,this.$selection.on("focus",function(a){b.trigger("focus",a)}),this.$selection.on("blur",function(a){b.trigger("blur",a)}),this.$selection.on("keydown",function(a){b.trigger("keypress",a),a.which===c.SPACE&&a.preventDefault()}),a.on("results:focus",function(a){b.$selection.attr("aria-activedescendant",a.data._resultId)}),a.on("selection:update",function(a){b.update(a.data)}),a.on("open",function(){b.$selection.attr("aria-expanded","true"),b.$selection.attr("aria-owns",d),b._attachCloseHandler(a)}),a.on("close",function(){b.$selection.attr("aria-expanded","false"),b.$selection.removeAttr("aria-activedescendant"),b.$selection.removeAttr("aria-owns"),b.$selection.focus(),b._detachCloseHandler(a)}),a.on("enable",function(){b.$selection.attr("tabindex",b._tabindex)}),a.on("disable",function(){b.$selection.attr("tabindex","-1")})},d.prototype._attachCloseHandler=function(b){a(document.body).on("mousedown.select2."+b.id,function(b){var c=a(b.target),d=c.closest(".select2"),e=a(".select2.select2-container--open");e.each(function(){var b=a(this);if(this!=d[0]){var c=b.data("element");c.select2("close")}})})},d.prototype._detachCloseHandler=function(b){a(document.body).off("mousedown.select2."+b.id)},d.prototype.position=function(a,b){var c=b.find(".selection");c.append(a)},d.prototype.destroy=function(){this._detachCloseHandler(this.container)},d.prototype.update=function(){throw new Error("The `update` method must be defined in child classes.")},d}),b.define("select2/selection/single",["jquery","./base","../utils","../keys"],function(a,b,c){function d(){d.__super__.constructor.apply(this,arguments)}return c.Extend(d,b),d.prototype.render=function(){var a=d.__super__.render.call(this);return a.addClass("select2-selection--single"),a.html('<span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'),a},d.prototype.bind=function(a){var b=this;d.__super__.bind.apply(this,arguments);var c=a.id+"-container";this.$selection.find(".select2-selection__rendered").attr("id",c),this.$selection.attr("aria-labelledby",c),this.$selection.on("mousedown",function(a){1===a.which&&b.trigger("toggle",{originalEvent:a})}),this.$selection.on("focus",function(){}),this.$selection.on("blur",function(){}),a.on("selection:update",function(a){b.update(a.data)})},d.prototype.clear=function(){this.$selection.find(".select2-selection__rendered").empty()},d.prototype.display=function(a){var b=this.options.get("templateSelection"),c=this.options.get("escapeMarkup");return c(b(a))},d.prototype.selectionContainer=function(){return a("<span></span>")},d.prototype.update=function(a){if(0===a.length)return void this.clear();var b=a[0],c=this.display(b),d=this.$selection.find(".select2-selection__rendered");d.empty().append(c),d.prop("title",b.title||b.text)},d}),b.define("select2/selection/multiple",["jquery","./base","../utils"],function(a,b,c){function d(){d.__super__.constructor.apply(this,arguments)}return c.Extend(d,b),d.prototype.render=function(){var a=d.__super__.render.call(this);return a.addClass("select2-selection--multiple"),a.html('<ul class="select2-selection__rendered"></ul>'),a},d.prototype.bind=function(){var b=this;d.__super__.bind.apply(this,arguments),this.$selection.on("click",function(a){b.trigger("toggle",{originalEvent:a})}),this.$selection.on("click",".select2-selection__choice__remove",function(c){var d=a(this),e=d.parent(),f=e.data("data");b.trigger("unselect",{originalEvent:c,data:f})})},d.prototype.clear=function(){this.$selection.find(".select2-selection__rendered").empty()},d.prototype.display=function(a){var b=this.options.get("templateSelection"),c=this.options.get("escapeMarkup");return c(b(a))},d.prototype.selectionContainer=function(){var b=a('<li class="select2-selection__choice"><span class="select2-selection__choice__remove" role="presentation">&times;</span></li>');return b},d.prototype.update=function(b){if(this.clear(),0!==b.length){for(var c=a(),d=0;d<b.length;d++){var e=b[d],f=this.display(e),g=this.selectionContainer();g.append(f),g.prop("title",e.title||e.text),g.data("data",e),c=c.add(g)}this.$selection.find(".select2-selection__rendered").append(c)}},d}),b.define("select2/selection/placeholder",["../utils"],function(){function a(a,b,c){this.placeholder=this.normalizePlaceholder(c.get("placeholder")),a.call(this,b,c)}return a.prototype.normalizePlaceholder=function(a,b){return"string"==typeof b&&(b={id:"",text:b}),b},a.prototype.createPlaceholder=function(a,b){var c=this.selectionContainer();return c.html(this.display(b)),c.addClass("select2-selection__placeholder").removeClass("select2-selection__choice"),c},a.prototype.update=function(a,b){var c=1==b.length&&b[0].id!=this.placeholder.id,d=b.length>1;if(d||c)return a.call(this,b);this.clear();var e=this.createPlaceholder(this.placeholder);this.$selection.find(".select2-selection__rendered").append(e)},a}),b.define("select2/selection/allowClear",["jquery"],function(a){function b(){}return b.prototype.bind=function(b,c,d){var e=this;b.call(this,c,d),null==e.placeholder&&e.options.get("debug")&&window.console&&console.error&&console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option."),this.$selection.on("mousedown",".select2-selection__clear",function(b){if(!e.options.get("disabled")){b.stopPropagation();for(var c=a(this).data("data"),d=0;d<c.length;d++){var f={data:c[d]};if(e.trigger("unselect",f),f.prevented)return}e.$element.val(e.placeholder.id).trigger("change"),e.trigger("toggle")}})},b.prototype.update=function(b,c){if(b.call(this,c),!(this.$selection.find(".select2-selection__placeholder").length>0||0===c.length)){var d=a('<span class="select2-selection__clear">&times;</span>');d.data("data",c),this.$selection.find(".select2-selection__rendered").prepend(d)}},b}),b.define("select2/selection/search",["jquery","../utils","../keys"],function(a,b,c){function d(a,b,c){a.call(this,b,c)}return d.prototype.render=function(b){var c=a('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" /></li>');this.$searchContainer=c,this.$search=c.find("input");var d=b.call(this);return d},d.prototype.bind=function(a,b,d){var e=this;a.call(this,b,d),b.on("open",function(){e.$search.attr("tabindex",0),e.$search.focus()}),b.on("close",function(){e.$search.attr("tabindex",-1),e.$search.val(""),e.$search.focus()}),b.on("enable",function(){e.$search.prop("disabled",!1)}),b.on("disable",function(){e.$search.prop("disabled",!0)}),this.$selection.on("focusin",".select2-search--inline",function(a){e.trigger("focus",a)}),this.$selection.on("focusout",".select2-search--inline",function(a){e.trigger("blur",a)}),this.$selection.on("keydown",".select2-search--inline",function(a){a.stopPropagation(),e.trigger("keypress",a),e._keyUpPrevented=a.isDefaultPrevented();var b=a.which;if(b===c.BACKSPACE&&""===e.$search.val()){var d=e.$searchContainer.prev(".select2-selection__choice");if(d.length>0){var f=d.data("data");e.searchRemoveChoice(f)}}}),this.$selection.on("input",".select2-search--inline",function(){e.$selection.off("keyup.search")}),this.$selection.on("keyup.search input",".select2-search--inline",function(a){e.handleSearch(a)})},d.prototype.createPlaceholder=function(a,b){this.$search.attr("placeholder",b.text)},d.prototype.update=function(a,b){this.$search.attr("placeholder",""),a.call(this,b),this.$selection.find(".select2-selection__rendered").append(this.$searchContainer),this.resizeSearch()},d.prototype.handleSearch=function(){if(this.resizeSearch(),!this._keyUpPrevented){var a=this.$search.val();this.trigger("query",{term:a})}this._keyUpPrevented=!1},d.prototype.searchRemoveChoice=function(a,b){this.trigger("unselect",{data:b}),this.trigger("open"),this.$search.val(b.text+" ")},d.prototype.resizeSearch=function(){this.$search.css("width","25px");var a="";if(""!==this.$search.attr("placeholder"))a=this.$selection.find(".select2-selection__rendered").innerWidth();else{var b=this.$search.val().length+1;a=.75*b+"em"}this.$search.css("width",a)},d}),b.define("select2/selection/eventRelay",["jquery"],function(a){function b(){}return b.prototype.bind=function(b,c,d){var e=this,f=["open","opening","close","closing","select","selecting","unselect","unselecting"],g=["opening","closing","selecting","unselecting"];b.call(this,c,d),c.on("*",function(b,c){if(-1!==a.inArray(b,f)){c=c||{};var d=a.Event("select2:"+b,{params:c});e.$element.trigger(d),-1!==a.inArray(b,g)&&(c.prevented=d.isDefaultPrevented())}})},b}),b.define("select2/translation",["jquery","require"],function(a,b){function c(a){this.dict=a||{}}return c.prototype.all=function(){return this.dict},c.prototype.get=function(a){return this.dict[a]},c.prototype.extend=function(b){this.dict=a.extend({},b.all(),this.dict)},c._cache={},c.loadPath=function(a){if(!(a in c._cache)){var d=b(a);c._cache[a]=d}return new c(c._cache[a])},c}),b.define("select2/diacritics",[],function(){var a={"Ⓐ":"A","Ａ":"A","À":"A","Á":"A","Â":"A","Ầ":"A","Ấ":"A","Ẫ":"A","Ẩ":"A","Ã":"A","Ā":"A","Ă":"A","Ằ":"A","Ắ":"A","Ẵ":"A","Ẳ":"A","Ȧ":"A","Ǡ":"A","Ä":"A","Ǟ":"A","Ả":"A","Å":"A","Ǻ":"A","Ǎ":"A","Ȁ":"A","Ȃ":"A","Ạ":"A","Ậ":"A","Ặ":"A","Ḁ":"A","Ą":"A","Ⱥ":"A","Ɐ":"A","Ꜳ":"AA","Æ":"AE","Ǽ":"AE","Ǣ":"AE","Ꜵ":"AO","Ꜷ":"AU","Ꜹ":"AV","Ꜻ":"AV","Ꜽ":"AY","Ⓑ":"B","Ｂ":"B","Ḃ":"B","Ḅ":"B","Ḇ":"B","Ƀ":"B","Ƃ":"B","Ɓ":"B","Ⓒ":"C","Ｃ":"C","Ć":"C","Ĉ":"C","Ċ":"C","Č":"C","Ç":"C","Ḉ":"C","Ƈ":"C","Ȼ":"C","Ꜿ":"C","Ⓓ":"D","Ｄ":"D","Ḋ":"D","Ď":"D","Ḍ":"D","Ḑ":"D","Ḓ":"D","Ḏ":"D","Đ":"D","Ƌ":"D","Ɗ":"D","Ɖ":"D","Ꝺ":"D","Ǳ":"DZ","Ǆ":"DZ","ǲ":"Dz","ǅ":"Dz","Ⓔ":"E","Ｅ":"E","È":"E","É":"E","Ê":"E","Ề":"E","Ế":"E","Ễ":"E","Ể":"E","Ẽ":"E","Ē":"E","Ḕ":"E","Ḗ":"E","Ĕ":"E","Ė":"E","Ë":"E","Ẻ":"E","Ě":"E","Ȅ":"E","Ȇ":"E","Ẹ":"E","Ệ":"E","Ȩ":"E","Ḝ":"E","Ę":"E","Ḙ":"E","Ḛ":"E","Ɛ":"E","Ǝ":"E","Ⓕ":"F","Ｆ":"F","Ḟ":"F","Ƒ":"F","Ꝼ":"F","Ⓖ":"G","Ｇ":"G","Ǵ":"G","Ĝ":"G","Ḡ":"G","Ğ":"G","Ġ":"G","Ǧ":"G","Ģ":"G","Ǥ":"G","Ɠ":"G","Ꞡ":"G","Ᵹ":"G","Ꝿ":"G","Ⓗ":"H","Ｈ":"H","Ĥ":"H","Ḣ":"H","Ḧ":"H","Ȟ":"H","Ḥ":"H","Ḩ":"H","Ḫ":"H","Ħ":"H","Ⱨ":"H","Ⱶ":"H","Ɥ":"H","Ⓘ":"I","Ｉ":"I","Ì":"I","Í":"I","Î":"I","Ĩ":"I","Ī":"I","Ĭ":"I","İ":"I","Ï":"I","Ḯ":"I","Ỉ":"I","Ǐ":"I","Ȉ":"I","Ȋ":"I","Ị":"I","Į":"I","Ḭ":"I","Ɨ":"I","Ⓙ":"J","Ｊ":"J","Ĵ":"J","Ɉ":"J","Ⓚ":"K","Ｋ":"K","Ḱ":"K","Ǩ":"K","Ḳ":"K","Ķ":"K","Ḵ":"K","Ƙ":"K","Ⱪ":"K","Ꝁ":"K","Ꝃ":"K","Ꝅ":"K","Ꞣ":"K","Ⓛ":"L","Ｌ":"L","Ŀ":"L","Ĺ":"L","Ľ":"L","Ḷ":"L","Ḹ":"L","Ļ":"L","Ḽ":"L","Ḻ":"L","Ł":"L","Ƚ":"L","Ɫ":"L","Ⱡ":"L","Ꝉ":"L","Ꝇ":"L","Ꞁ":"L","Ǉ":"LJ","ǈ":"Lj","Ⓜ":"M","Ｍ":"M","Ḿ":"M","Ṁ":"M","Ṃ":"M","Ɱ":"M","Ɯ":"M","Ⓝ":"N","Ｎ":"N","Ǹ":"N","Ń":"N","Ñ":"N","Ṅ":"N","Ň":"N","Ṇ":"N","Ņ":"N","Ṋ":"N","Ṉ":"N","Ƞ":"N","Ɲ":"N","Ꞑ":"N","Ꞥ":"N","Ǌ":"NJ","ǋ":"Nj","Ⓞ":"O","Ｏ":"O","Ò":"O","Ó":"O","Ô":"O","Ồ":"O","Ố":"O","Ỗ":"O","Ổ":"O","Õ":"O","Ṍ":"O","Ȭ":"O","Ṏ":"O","Ō":"O","Ṑ":"O","Ṓ":"O","Ŏ":"O","Ȯ":"O","Ȱ":"O","Ö":"O","Ȫ":"O","Ỏ":"O","Ő":"O","Ǒ":"O","Ȍ":"O","Ȏ":"O","Ơ":"O","Ờ":"O","Ớ":"O","Ỡ":"O","Ở":"O","Ợ":"O","Ọ":"O","Ộ":"O","Ǫ":"O","Ǭ":"O","Ø":"O","Ǿ":"O","Ɔ":"O","Ɵ":"O","Ꝋ":"O","Ꝍ":"O","Ƣ":"OI","Ꝏ":"OO","Ȣ":"OU","Ⓟ":"P","Ｐ":"P","Ṕ":"P","Ṗ":"P","Ƥ":"P","Ᵽ":"P","Ꝑ":"P","Ꝓ":"P","Ꝕ":"P","Ⓠ":"Q","Ｑ":"Q","Ꝗ":"Q","Ꝙ":"Q","Ɋ":"Q","Ⓡ":"R","Ｒ":"R","Ŕ":"R","Ṙ":"R","Ř":"R","Ȑ":"R","Ȓ":"R","Ṛ":"R","Ṝ":"R","Ŗ":"R","Ṟ":"R","Ɍ":"R","Ɽ":"R","Ꝛ":"R","Ꞧ":"R","Ꞃ":"R","Ⓢ":"S","Ｓ":"S","ẞ":"S","Ś":"S","Ṥ":"S","Ŝ":"S","Ṡ":"S","Š":"S","Ṧ":"S","Ṣ":"S","Ṩ":"S","Ș":"S","Ş":"S","Ȿ":"S","Ꞩ":"S","Ꞅ":"S","Ⓣ":"T","Ｔ":"T","Ṫ":"T","Ť":"T","Ṭ":"T","Ț":"T","Ţ":"T","Ṱ":"T","Ṯ":"T","Ŧ":"T","Ƭ":"T","Ʈ":"T","Ⱦ":"T","Ꞇ":"T","Ꜩ":"TZ","Ⓤ":"U","Ｕ":"U","Ù":"U","Ú":"U","Û":"U","Ũ":"U","Ṹ":"U","Ū":"U","Ṻ":"U","Ŭ":"U","Ü":"U","Ǜ":"U","Ǘ":"U","Ǖ":"U","Ǚ":"U","Ủ":"U","Ů":"U","Ű":"U","Ǔ":"U","Ȕ":"U","Ȗ":"U","Ư":"U","Ừ":"U","Ứ":"U","Ữ":"U","Ử":"U","Ự":"U","Ụ":"U","Ṳ":"U","Ų":"U","Ṷ":"U","Ṵ":"U","Ʉ":"U","Ⓥ":"V","Ｖ":"V","Ṽ":"V","Ṿ":"V","Ʋ":"V","Ꝟ":"V","Ʌ":"V","Ꝡ":"VY","Ⓦ":"W","Ｗ":"W","Ẁ":"W","Ẃ":"W","Ŵ":"W","Ẇ":"W","Ẅ":"W","Ẉ":"W","Ⱳ":"W","Ⓧ":"X","Ｘ":"X","Ẋ":"X","Ẍ":"X","Ⓨ":"Y","Ｙ":"Y","Ỳ":"Y","Ý":"Y","Ŷ":"Y","Ỹ":"Y","Ȳ":"Y","Ẏ":"Y","Ÿ":"Y","Ỷ":"Y","Ỵ":"Y","Ƴ":"Y","Ɏ":"Y","Ỿ":"Y","Ⓩ":"Z","Ｚ":"Z","Ź":"Z","Ẑ":"Z","Ż":"Z","Ž":"Z","Ẓ":"Z","Ẕ":"Z","Ƶ":"Z","Ȥ":"Z","Ɀ":"Z","Ⱬ":"Z","Ꝣ":"Z","ⓐ":"a","ａ":"a","ẚ":"a","à":"a","á":"a","â":"a","ầ":"a","ấ":"a","ẫ":"a","ẩ":"a","ã":"a","ā":"a","ă":"a","ằ":"a","ắ":"a","ẵ":"a","ẳ":"a","ȧ":"a","ǡ":"a","ä":"a","ǟ":"a","ả":"a","å":"a","ǻ":"a","ǎ":"a","ȁ":"a","ȃ":"a","ạ":"a","ậ":"a","ặ":"a","ḁ":"a","ą":"a","ⱥ":"a","ɐ":"a","ꜳ":"aa","æ":"ae","ǽ":"ae","ǣ":"ae","ꜵ":"ao","ꜷ":"au","ꜹ":"av","ꜻ":"av","ꜽ":"ay","ⓑ":"b","ｂ":"b","ḃ":"b","ḅ":"b","ḇ":"b","ƀ":"b","ƃ":"b","ɓ":"b","ⓒ":"c","ｃ":"c","ć":"c","ĉ":"c","ċ":"c","č":"c","ç":"c","ḉ":"c","ƈ":"c","ȼ":"c","ꜿ":"c","ↄ":"c","ⓓ":"d","ｄ":"d","ḋ":"d","ď":"d","ḍ":"d","ḑ":"d","ḓ":"d","ḏ":"d","đ":"d","ƌ":"d","ɖ":"d","ɗ":"d","ꝺ":"d","ǳ":"dz","ǆ":"dz","ⓔ":"e","ｅ":"e","è":"e","é":"e","ê":"e","ề":"e","ế":"e","ễ":"e","ể":"e","ẽ":"e","ē":"e","ḕ":"e","ḗ":"e","ĕ":"e","ė":"e","ë":"e","ẻ":"e","ě":"e","ȅ":"e","ȇ":"e","ẹ":"e","ệ":"e","ȩ":"e","ḝ":"e","ę":"e","ḙ":"e","ḛ":"e","ɇ":"e","ɛ":"e","ǝ":"e","ⓕ":"f","ｆ":"f","ḟ":"f","ƒ":"f","ꝼ":"f","ⓖ":"g","ｇ":"g","ǵ":"g","ĝ":"g","ḡ":"g","ğ":"g","ġ":"g","ǧ":"g","ģ":"g","ǥ":"g","ɠ":"g","ꞡ":"g","ᵹ":"g","ꝿ":"g","ⓗ":"h","ｈ":"h","ĥ":"h","ḣ":"h","ḧ":"h","ȟ":"h","ḥ":"h","ḩ":"h","ḫ":"h","ẖ":"h","ħ":"h","ⱨ":"h","ⱶ":"h","ɥ":"h","ƕ":"hv","ⓘ":"i","ｉ":"i","ì":"i","í":"i","î":"i","ĩ":"i","ī":"i","ĭ":"i","ï":"i","ḯ":"i","ỉ":"i","ǐ":"i","ȉ":"i","ȋ":"i","ị":"i","į":"i","ḭ":"i","ɨ":"i","ı":"i","ⓙ":"j","ｊ":"j","ĵ":"j","ǰ":"j","ɉ":"j","ⓚ":"k","ｋ":"k","ḱ":"k","ǩ":"k","ḳ":"k","ķ":"k","ḵ":"k","ƙ":"k","ⱪ":"k","ꝁ":"k","ꝃ":"k","ꝅ":"k","ꞣ":"k","ⓛ":"l","ｌ":"l","ŀ":"l","ĺ":"l","ľ":"l","ḷ":"l","ḹ":"l","ļ":"l","ḽ":"l","ḻ":"l","ſ":"l","ł":"l","ƚ":"l","ɫ":"l","ⱡ":"l","ꝉ":"l","ꞁ":"l","ꝇ":"l","ǉ":"lj","ⓜ":"m","ｍ":"m","ḿ":"m","ṁ":"m","ṃ":"m","ɱ":"m","ɯ":"m","ⓝ":"n","ｎ":"n","ǹ":"n","ń":"n","ñ":"n","ṅ":"n","ň":"n","ṇ":"n","ņ":"n","ṋ":"n","ṉ":"n","ƞ":"n","ɲ":"n","ŉ":"n","ꞑ":"n","ꞥ":"n","ǌ":"nj","ⓞ":"o","ｏ":"o","ò":"o","ó":"o","ô":"o","ồ":"o","ố":"o","ỗ":"o","ổ":"o","õ":"o","ṍ":"o","ȭ":"o","ṏ":"o","ō":"o","ṑ":"o","ṓ":"o","ŏ":"o","ȯ":"o","ȱ":"o","ö":"o","ȫ":"o","ỏ":"o","ő":"o","ǒ":"o","ȍ":"o","ȏ":"o","ơ":"o","ờ":"o","ớ":"o","ỡ":"o","ở":"o","ợ":"o","ọ":"o","ộ":"o","ǫ":"o","ǭ":"o","ø":"o","ǿ":"o","ɔ":"o","ꝋ":"o","ꝍ":"o","ɵ":"o","ƣ":"oi","ȣ":"ou","ꝏ":"oo","ⓟ":"p","ｐ":"p","ṕ":"p","ṗ":"p","ƥ":"p","ᵽ":"p","ꝑ":"p","ꝓ":"p","ꝕ":"p","ⓠ":"q","ｑ":"q","ɋ":"q","ꝗ":"q","ꝙ":"q","ⓡ":"r","ｒ":"r","ŕ":"r","ṙ":"r","ř":"r","ȑ":"r","ȓ":"r","ṛ":"r","ṝ":"r","ŗ":"r","ṟ":"r","ɍ":"r","ɽ":"r","ꝛ":"r","ꞧ":"r","ꞃ":"r","ⓢ":"s","ｓ":"s","ß":"s","ś":"s","ṥ":"s","ŝ":"s","ṡ":"s","š":"s","ṧ":"s","ṣ":"s","ṩ":"s","ș":"s","ş":"s","ȿ":"s","ꞩ":"s","ꞅ":"s","ẛ":"s","ⓣ":"t","ｔ":"t","ṫ":"t","ẗ":"t","ť":"t","ṭ":"t","ț":"t","ţ":"t","ṱ":"t","ṯ":"t","ŧ":"t","ƭ":"t","ʈ":"t","ⱦ":"t","ꞇ":"t","ꜩ":"tz","ⓤ":"u","ｕ":"u","ù":"u","ú":"u","û":"u","ũ":"u","ṹ":"u","ū":"u","ṻ":"u","ŭ":"u","ü":"u","ǜ":"u","ǘ":"u","ǖ":"u","ǚ":"u","ủ":"u","ů":"u","ű":"u","ǔ":"u","ȕ":"u","ȗ":"u","ư":"u","ừ":"u","ứ":"u","ữ":"u","ử":"u","ự":"u","ụ":"u","ṳ":"u","ų":"u","ṷ":"u","ṵ":"u","ʉ":"u","ⓥ":"v","ｖ":"v","ṽ":"v","ṿ":"v","ʋ":"v","ꝟ":"v","ʌ":"v","ꝡ":"vy","ⓦ":"w","ｗ":"w","ẁ":"w","ẃ":"w","ŵ":"w","ẇ":"w","ẅ":"w","ẘ":"w","ẉ":"w","ⱳ":"w","ⓧ":"x","ｘ":"x","ẋ":"x","ẍ":"x","ⓨ":"y","ｙ":"y","ỳ":"y","ý":"y","ŷ":"y","ỹ":"y","ȳ":"y","ẏ":"y","ÿ":"y","ỷ":"y","ẙ":"y","ỵ":"y","ƴ":"y","ɏ":"y","ỿ":"y","ⓩ":"z","ｚ":"z","ź":"z","ẑ":"z","ż":"z","ž":"z","ẓ":"z","ẕ":"z","ƶ":"z","ȥ":"z","ɀ":"z","ⱬ":"z","ꝣ":"z","Ά":"Α","Έ":"Ε","Ή":"Η","Ί":"Ι","Ϊ":"Ι","Ό":"Ο","Ύ":"Υ","Ϋ":"Υ","Ώ":"Ω","ά":"α","έ":"ε","ή":"η","ί":"ι","ϊ":"ι","ΐ":"ι","ό":"ο","ύ":"υ","ϋ":"υ","ΰ":"υ","ω":"ω","ς":"σ"};return a}),b.define("select2/data/base",["../utils"],function(a){function b(){b.__super__.constructor.call(this)}return a.Extend(b,a.Observable),b.prototype.current=function(){throw new Error("The `current` method must be defined in child classes.")},b.prototype.query=function(){throw new Error("The `query` method must be defined in child classes.")},b.prototype.bind=function(){},b.prototype.destroy=function(){},b.prototype.generateResultId=function(b,c){var d=b.id+"-result-";return d+=a.generateChars(4),d+=null!=c.id?"-"+c.id.toString():"-"+a.generateChars(4)},b}),b.define("select2/data/select",["./base","../utils","jquery"],function(a,b,c){function d(a,b){this.$element=a,this.options=b,d.__super__.constructor.call(this)}return b.Extend(d,a),d.prototype.current=function(a){var b=[],d=this;this.$element.find(":selected").each(function(){var a=c(this),e=d.item(a);b.push(e)}),a(b)},d.prototype.select=function(a){var b=this;if(c(a.element).is("option"))return a.element.selected=!0,void this.$element.trigger("change");if(this.$element.prop("multiple"))this.current(function(d){var e=[];a=[a],a.push.apply(a,d);for(var f=0;f<a.length;f++){var g=a[f].id;-1===c.inArray(g,e)&&e.push(g)}b.$element.val(e),b.$element.trigger("change")});else{var d=a.id;this.$element.val(d),this.$element.trigger("change")}},d.prototype.unselect=function(a){var b=this;if(this.$element.prop("multiple"))return c(a.element).is("option")?(a.element.selected=!1,void this.$element.trigger("change")):void this.current(function(d){for(var e=[],f=0;f<d.length;f++){var g=d[f].id;g!==a.id&&-1===c.inArray(g,e)&&e.push(g)}b.$element.val(e),b.$element.trigger("change")})},d.prototype.bind=function(a){var b=this;this.container=a,a.on("select",function(a){b.select(a.data)}),a.on("unselect",function(a){b.unselect(a.data)})},d.prototype.destroy=function(){this.$element.find("*").each(function(){c.removeData(this,"data")})},d.prototype.query=function(a,b){var d=[],e=this,f=this.$element.children();f.each(function(){var b=c(this);if(b.is("option")||b.is("optgroup")){var f=e.item(b),g=e.matches(a,f);null!==g&&d.push(g)}}),b({results:d})},d.prototype.addOptions=function(a){this.$element.append(a)},d.prototype.option=function(a){var b;a.children?(b=document.createElement("optgroup"),b.label=a.text):(b=document.createElement("option"),void 0!==b.textContent?b.textContent=a.text:b.innerText=a.text),a.id&&(b.value=a.id),a.disabled&&(b.disabled=!0),a.selected&&(b.selected=!0),a.title&&(b.title=a.title);var d=c(b),e=this._normalizeItem(a);return e.element=b,c.data(b,"data",e),d},d.prototype.item=function(a){var b={};if(b=c.data(a[0],"data"),null!=b)return b;if(a.is("option"))b={id:a.val(),text:a.text(),disabled:a.prop("disabled"),selected:a.prop("selected"),title:a.prop("title")};else if(a.is("optgroup")){b={text:a.prop("label"),children:[],title:a.prop("title")};for(var d=a.children("option"),e=[],f=0;f<d.length;f++){var g=c(d[f]),h=this.item(g);e.push(h)}b.children=e}return b=this._normalizeItem(b),b.element=a[0],c.data(a[0],"data",b),b},d.prototype._normalizeItem=function(a){c.isPlainObject(a)||(a={id:a,text:a}),a=c.extend({},{text:""},a);var b={selected:!1,disabled:!1};return null!=a.id&&(a.id=a.id.toString()),null!=a.text&&(a.text=a.text.toString()),null==a._resultId&&a.id&&null!=this.container&&(a._resultId=this.generateResultId(this.container,a)),c.extend({},b,a)
},d.prototype.matches=function(a,b){var c=this.options.get("matcher");return c(a,b)},d}),b.define("select2/data/array",["./select","../utils","jquery"],function(a,b,c){function d(a,b){var c=b.get("data")||[];d.__super__.constructor.call(this,a,b),this.addOptions(this.convertToOptions(c))}return b.Extend(d,a),d.prototype.select=function(a){var b=this.$element.find('option[value="'+a.id+'"]');0===b.length&&(b=this.option(a),this.addOptions(b)),d.__super__.select.call(this,a)},d.prototype.convertToOptions=function(a){function b(a){return function(){return c(this).val()==a.id}}for(var d=this,e=this.$element.find("option"),f=e.map(function(){return d.item(c(this)).id}).get(),g=c(),h=0;h<a.length;h++){var i=this._normalizeItem(a[h]);if(c.inArray(i.id,f)>=0){var j=e.filter(b(i)),k=this.item(j),l=(c.extend(!0,{},k,i),this.option(k));j.replaceWith(l)}else{var m=this.option(i);if(i.children){var n=this.convertToOptions(i.children);m.append(n)}g=g.add(m)}}return g},d}),b.define("select2/data/ajax",["./array","../utils","jquery"],function(a,b,c){function d(b,c){this.ajaxOptions=this._applyDefaults(c.get("ajax")),null!=this.ajaxOptions.processResults&&(this.processResults=this.ajaxOptions.processResults),a.__super__.constructor.call(this,b,c)}return b.Extend(d,a),d.prototype._applyDefaults=function(a){var b={data:function(a){return{q:a.term}},transport:function(a,b,d){var e=c.ajax(a);return e.then(b),e.fail(d),e}};return c.extend({},b,a,!0)},d.prototype.processResults=function(a){return a},d.prototype.query=function(a,b){function d(){var d=f.transport(f,function(d){var f=e.processResults(d,a);e.options.get("debug")&&window.console&&console.error&&(f&&f.results&&c.isArray(f.results)||console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")),b(f)},function(){});e._request=d}var e=this;this._request&&(this._request.abort(),this._request=null);var f=c.extend({type:"GET"},this.ajaxOptions);"function"==typeof f.url&&(f.url=f.url(a)),"function"==typeof f.data&&(f.data=f.data(a)),this.ajaxOptions.delay&&""!==a.term?(this._queryTimeout&&window.clearTimeout(this._queryTimeout),this._queryTimeout=window.setTimeout(d,this.ajaxOptions.delay)):d()},d}),b.define("select2/data/tags",["jquery"],function(a){function b(b,c,d){var e=d.get("tags"),f=d.get("createTag");if(void 0!==f&&(this.createTag=f),b.call(this,c,d),a.isArray(e))for(var g=0;g<e.length;g++){var h=e[g],i=this._normalizeItem(h),j=this.option(i);this.$element.append(j)}}return b.prototype.query=function(a,b,c){function d(a,f){for(var g=a.results,h=0;h<g.length;h++){var i=g[h],j=null!=i.children&&!d({results:i.children},!0),k=i.text===b.term;if(k||j)return f?!1:(a.data=g,void c(a))}if(f)return!0;var l=e.createTag(b);if(null!=l){var m=e.option(l);m.attr("data-select2-tag",!0),e.addOptions(m),e.insertTag(g,l)}a.results=g,c(a)}var e=this;return this._removeOldTags(),null==b.term||null!=b.page?void a.call(this,b,c):void a.call(this,b,d)},b.prototype.createTag=function(b,c){var d=a.trim(c.term);return""===d?null:{id:d,text:d}},b.prototype.insertTag=function(a,b,c){b.unshift(c)},b.prototype._removeOldTags=function(){var b=(this._lastTag,this.$element.find("option[data-select2-tag]"));b.each(function(){this.selected||a(this).remove()})},b}),b.define("select2/data/tokenizer",["jquery"],function(a){function b(a,b,c){var d=c.get("tokenizer");void 0!==d&&(this.tokenizer=d),a.call(this,b,c)}return b.prototype.bind=function(a,b,c){a.call(this,b,c),this.$search=b.dropdown.$search||b.selection.$search||c.find(".select2-search__field")},b.prototype.query=function(a,b,c){function d(a){e.select(a)}var e=this;b.term=b.term||"";var f=this.tokenizer(b,this.options,d);f.term!==b.term&&(this.$search.length&&(this.$search.val(f.term),this.$search.focus()),b.term=f.term),a.call(this,b,c)},b.prototype.tokenizer=function(b,c,d,e){for(var f=d.get("tokenSeparators")||[],g=c.term,h=0,i=this.createTag||function(a){return{id:a.term,text:a.term}};h<g.length;){var j=g[h];if(-1!==a.inArray(j,f)){var k=g.substr(0,h),l=a.extend({},c,{term:k}),m=i(l);e(m),g=g.substr(h+1)||"",h=0}else h++}return{term:g}},b}),b.define("select2/data/minimumInputLength",[],function(){function a(a,b,c){this.minimumInputLength=c.get("minimumInputLength"),a.call(this,b,c)}return a.prototype.query=function(a,b,c){return b.term=b.term||"",b.term.length<this.minimumInputLength?void this.trigger("results:message",{message:"inputTooShort",args:{minimum:this.minimumInputLength,input:b.term,params:b}}):void a.call(this,b,c)},a}),b.define("select2/data/maximumInputLength",[],function(){function a(a,b,c){this.maximumInputLength=c.get("maximumInputLength"),a.call(this,b,c)}return a.prototype.query=function(a,b,c){return b.term=b.term||"",this.maximumInputLength>0&&b.term.length>this.maximumInputLength?void this.trigger("results:message",{message:"inputTooLong",args:{maximum:this.maximumInputLength,input:b.term,params:b}}):void a.call(this,b,c)},a}),b.define("select2/data/maximumSelectionLength",[],function(){function a(a,b,c){this.maximumSelectionLength=c.get("maximumSelectionLength"),a.call(this,b,c)}return a.prototype.query=function(a,b,c){var d=this;this.current(function(e){var f=null!=e?e.length:0;return d.maximumSelectionLength>0&&f>=d.maximumSelectionLength?void d.trigger("results:message",{message:"maximumSelected",args:{maximum:d.maximumSelectionLength}}):void a.call(d,b,c)})},a}),b.define("select2/dropdown",["jquery","./utils"],function(a,b){function c(a,b){this.$element=a,this.options=b,c.__super__.constructor.call(this)}return b.Extend(c,b.Observable),c.prototype.render=function(){var b=a('<span class="select2-dropdown"><span class="select2-results"></span></span>');return b.attr("dir",this.options.get("dir")),this.$dropdown=b,b},c.prototype.position=function(){},c.prototype.destroy=function(){this.$dropdown.remove()},c}),b.define("select2/dropdown/search",["jquery","../utils"],function(a){function b(){}return b.prototype.render=function(b){var c=b.call(this),d=a('<span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" /></span>');return this.$searchContainer=d,this.$search=d.find("input"),c.prepend(d),c},b.prototype.bind=function(b,c,d){var e=this;b.call(this,c,d),this.$search.on("keydown",function(a){e.trigger("keypress",a),e._keyUpPrevented=a.isDefaultPrevented()}),this.$search.on("input",function(){a(this).off("keyup")}),this.$search.on("keyup input",function(a){e.handleSearch(a)}),c.on("open",function(){e.$search.attr("tabindex",0),e.$search.focus(),window.setTimeout(function(){e.$search.focus()},0)}),c.on("close",function(){e.$search.attr("tabindex",-1),e.$search.val("")}),c.on("results:all",function(a){if(null==a.query.term||""===a.query.term){var b=e.showSearch(a);b?e.$searchContainer.removeClass("select2-search--hide"):e.$searchContainer.addClass("select2-search--hide")}})},b.prototype.handleSearch=function(){if(!this._keyUpPrevented){var a=this.$search.val();this.trigger("query",{term:a})}this._keyUpPrevented=!1},b.prototype.showSearch=function(){return!0},b}),b.define("select2/dropdown/hidePlaceholder",[],function(){function a(a,b,c,d){this.placeholder=this.normalizePlaceholder(c.get("placeholder")),a.call(this,b,c,d)}return a.prototype.append=function(a,b){b.results=this.removePlaceholder(b.results),a.call(this,b)},a.prototype.normalizePlaceholder=function(a,b){return"string"==typeof b&&(b={id:"",text:b}),b},a.prototype.removePlaceholder=function(a,b){for(var c=b.slice(0),d=b.length-1;d>=0;d--){var e=b[d];this.placeholder.id===e.id&&c.splice(d,1)}return c},a}),b.define("select2/dropdown/infiniteScroll",["jquery"],function(a){function b(a,b,c,d){this.lastParams={},a.call(this,b,c,d),this.$loadingMore=this.createLoadingMore(),this.loading=!1}return b.prototype.append=function(a,b){this.$loadingMore.remove(),this.loading=!1,a.call(this,b),this.showLoadingMore(b)&&this.$results.append(this.$loadingMore)},b.prototype.bind=function(b,c,d){var e=this;b.call(this,c,d),c.on("query",function(a){e.lastParams=a,e.loading=!0}),c.on("query:append",function(a){e.lastParams=a,e.loading=!0}),this.$results.on("scroll",function(){var b=a.contains(document.documentElement,e.$loadingMore[0]);if(!e.loading&&b){var c=e.$results.offset().top+e.$results.outerHeight(!1),d=e.$loadingMore.offset().top+e.$loadingMore.outerHeight(!1);c+50>=d&&e.loadMore()}})},b.prototype.loadMore=function(){this.loading=!0;var b=a.extend({},{page:1},this.lastParams);b.page++,this.trigger("query:append",b)},b.prototype.showLoadingMore=function(a,b){return b.pagination&&b.pagination.more},b.prototype.createLoadingMore=function(){var b=a('<li class="option load-more" role="treeitem"></li>'),c=this.options.get("translations").get("loadingMore");return b.html(c(this.lastParams)),b},b}),b.define("select2/dropdown/attachBody",["jquery","../utils"],function(a,b){function c(a,b,c){this.$dropdownParent=c.get("dropdownParent")||document.body,a.call(this,b,c)}return c.prototype.bind=function(a,b,c){var d=this,e=!1;a.call(this,b,c),b.on("open",function(){d._showDropdown(),d._attachPositioningHandler(b),e||(e=!0,b.on("results:all",function(){d._positionDropdown(),d._resizeDropdown()}),b.on("results:append",function(){d._positionDropdown(),d._resizeDropdown()}))}),b.on("close",function(){d._hideDropdown(),d._detachPositioningHandler(b)}),this.$dropdownContainer.on("mousedown",function(a){a.stopPropagation()})},c.prototype.position=function(a,b,c){b.attr("class",c.attr("class")),b.removeClass("select2"),b.addClass("select2-container--open"),b.css({position:"absolute",top:-999999}),this.$container=c},c.prototype.render=function(b){var c=a("<span></span>"),d=b.call(this);return c.append(d),this.$dropdownContainer=c,c},c.prototype._hideDropdown=function(){this.$dropdownContainer.detach()},c.prototype._attachPositioningHandler=function(c){var d=this,e="scroll.select2."+c.id,f="resize.select2."+c.id,g="orientationchange.select2."+c.id,h=this.$container.parents().filter(b.hasScroll);h.each(function(){a(this).data("select2-scroll-position",{x:a(this).scrollLeft(),y:a(this).scrollTop()})}),h.on(e,function(){var b=a(this).data("select2-scroll-position");a(this).scrollTop(b.y)}),a(window).on(e+" "+f+" "+g,function(){d._positionDropdown(),d._resizeDropdown()})},c.prototype._detachPositioningHandler=function(c){var d="scroll.select2."+c.id,e="resize.select2."+c.id,f="orientationchange.select2."+c.id,g=this.$container.parents().filter(b.hasScroll);g.off(d),a(window).off(d+" "+e+" "+f)},c.prototype._positionDropdown=function(){var b=a(window),c=this.$dropdown.hasClass("select2-dropdown--above"),d=this.$dropdown.hasClass("select2-dropdown--below"),e=null,f=(this.$container.position(),this.$container.offset());f.bottom=f.top+this.$container.outerHeight(!1);var g={height:this.$container.outerHeight(!1)};g.top=f.top,g.bottom=f.top+g.height;var h={height:this.$dropdown.outerHeight(!1)},i={top:b.scrollTop(),bottom:b.scrollTop()+b.height()},j=i.top<f.top-h.height,k=i.bottom>f.bottom+h.height,l={left:f.left,top:g.bottom};c||d||(e="below"),k||!j||c?!j&&k&&c&&(e="below"):e="above",("above"==e||c&&"below"!==e)&&(l.top=g.top-h.height),null!=e&&(this.$dropdown.removeClass("select2-dropdown--below select2-dropdown--above").addClass("select2-dropdown--"+e),this.$container.removeClass("select2-container--below select2-container--above").addClass("select2-container--"+e)),this.$dropdownContainer.css(l)},c.prototype._resizeDropdown=function(){this.$dropdownContainer.width(),this.$dropdown.css({width:this.$container.outerWidth(!1)+"px"})},c.prototype._showDropdown=function(){this.$dropdownContainer.appendTo(this.$dropdownParent),this._positionDropdown(),this._resizeDropdown()},c}),b.define("select2/dropdown/minimumResultsForSearch",[],function(){function a(b){for(var c=0,d=0;d<b.length;d++){var e=b[d];e.children?c+=a(e.children):c++}return c}function b(a,b,c,d){this.minimumResultsForSearch=c.get("minimumResultsForSearch"),this.minimumResultsForSearch<0&&(this.minimumResultsForSearch=1/0),a.call(this,b,c,d)}return b.prototype.showSearch=function(b,c){return a(c.data.results)<this.minimumResultsForSearch?!1:b.call(this,c)},b}),b.define("select2/dropdown/selectOnClose",[],function(){function a(){}return a.prototype.bind=function(a,b,c){var d=this;a.call(this,b,c),b.on("close",function(){d._handleSelectOnClose()})},a.prototype._handleSelectOnClose=function(){var a=this.getHighlightedResults();a.length<1||a.trigger("mouseup")},a}),b.define("select2/dropdown/closeOnSelect",[],function(){function a(){}return a.prototype.bind=function(a,b,c){var d=this;a.call(this,b,c),b.on("select",function(a){d._selectTriggered(a)}),b.on("unselect",function(a){d._selectTriggered(a)})},a.prototype._selectTriggered=function(a,b){var c=b.originalEvent;c&&c.ctrlKey||this.trigger("close")},a}),b.define("select2/i18n/en",[],function(){return{errorLoading:function(){return"The results could not be loaded."},inputTooLong:function(a){var b=a.input.length-a.maximum,c="Please delete "+b+" character";return 1!=b&&(c+="s"),c},inputTooShort:function(a){var b=a.minimum-a.input.length,c="Please enter "+b+" or more characters";return c},loadingMore:function(){return"Loading more results…"},maximumSelected:function(a){var b="You can only select "+a.maximum+" item";return 1!=a.maximum&&(b+="s"),b},noResults:function(){return"No results found"},searching:function(){return"Searching…"}}}),b.define("select2/defaults",["jquery","require","./results","./selection/single","./selection/multiple","./selection/placeholder","./selection/allowClear","./selection/search","./selection/eventRelay","./utils","./translation","./diacritics","./data/select","./data/array","./data/ajax","./data/tags","./data/tokenizer","./data/minimumInputLength","./data/maximumInputLength","./data/maximumSelectionLength","./dropdown","./dropdown/search","./dropdown/hidePlaceholder","./dropdown/infiniteScroll","./dropdown/attachBody","./dropdown/minimumResultsForSearch","./dropdown/selectOnClose","./dropdown/closeOnSelect","./i18n/en"],function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C){function D(){this.reset()}D.prototype.apply=function(l){if(l=a.extend({},this.defaults,l),null==l.dataAdapter){if(l.dataAdapter=null!=l.ajax?o:null!=l.data?n:m,l.minimumInputLength>0&&(l.dataAdapter=j.Decorate(l.dataAdapter,r)),l.maximumInputLength>0&&(l.dataAdapter=j.Decorate(l.dataAdapter,s)),l.maximumSelectionLength>0&&(l.dataAdapter=j.Decorate(l.dataAdapter,t)),l.tags&&(l.dataAdapter=j.Decorate(l.dataAdapter,p)),(null!=l.tokenSeparators||null!=l.tokenizer)&&(l.dataAdapter=j.Decorate(l.dataAdapter,q)),null!=l.query){var C=b(l.amdBase+"compat/query");l.dataAdapter=j.Decorate(l.dataAdapter,C)}if(null!=l.initSelection){var D=b(l.amdBase+"compat/initSelection");l.dataAdapter=j.Decorate(l.dataAdapter,D)}}if(null==l.resultsAdapter&&(l.resultsAdapter=c,null!=l.ajax&&(l.resultsAdapter=j.Decorate(l.resultsAdapter,x)),null!=l.placeholder&&(l.resultsAdapter=j.Decorate(l.resultsAdapter,w)),l.selectOnClose&&(l.resultsAdapter=j.Decorate(l.resultsAdapter,A))),null==l.dropdownAdapter){if(l.multiple)l.dropdownAdapter=u;else{var E=j.Decorate(u,v);l.dropdownAdapter=E}0!==l.minimumResultsForSearch&&(l.dropdownAdapter=j.Decorate(l.dropdownAdapter,z)),l.closeOnSelect&&(l.dropdownAdapter=j.Decorate(l.dropdownAdapter,B)),l.dropdownAdapter=j.Decorate(l.dropdownAdapter,y)}if(null==l.selectionAdapter&&(l.selectionAdapter=l.multiple?e:d,null!=l.placeholder&&(l.selectionAdapter=j.Decorate(l.selectionAdapter,f)),l.allowClear&&(l.selectionAdapter=j.Decorate(l.selectionAdapter,g)),l.multiple&&(l.selectionAdapter=j.Decorate(l.selectionAdapter,h)),l.selectionAdapter=j.Decorate(l.selectionAdapter,i)),"string"==typeof l.language)if(l.language.indexOf("-")>0){var F=l.language.split("-"),G=F[0];l.language=[l.language,G]}else l.language=[l.language];if(a.isArray(l.language)){var H=new k;l.language.push("en");for(var I=l.language,J=0;J<I.length;J++){var K=I[J],L={};try{L=k.loadPath(K)}catch(M){try{K=this.defaults.amdLanguageBase+K,L=k.loadPath(K)}catch(N){l.debug&&window.console&&console.warn&&console.warn('Select2: The language file for "'+K+'" could not be automatically loaded. A fallback will be used instead.');continue}}H.extend(L)}l.translations=H}else l.translations=new k(l.language);return l},D.prototype.reset=function(){function b(a){function b(a){return l[a]||a}return a.replace(/[^\u0000-\u007E]/g,b)}function c(d,e){if(""===a.trim(d.term))return e;if(e.children&&e.children.length>0){for(var f=a.extend(!0,{},e),g=e.children.length-1;g>=0;g--){var h=e.children[g],i=c(d,h);null==i&&f.children.splice(g,1)}return f.children.length>0?f:c(d,f)}var j=b(e.text).toUpperCase(),k=b(d.term).toUpperCase();return j.indexOf(k)>-1?e:null}this.defaults={amdBase:"./",amdLanguageBase:"./i18n/",closeOnSelect:!0,debug:!1,escapeMarkup:j.escapeMarkup,language:C,matcher:c,minimumInputLength:0,maximumInputLength:0,maximumSelectionLength:0,minimumResultsForSearch:0,selectOnClose:!1,sorter:function(a){return a},templateResult:function(a){return a.text},templateSelection:function(a){return a.text},theme:"default",width:"resolve"}},D.prototype.set=function(b,c){var d=a.camelCase(b),e={};e[d]=c;var f=j._convertData(e);a.extend(this.defaults,f)};var E=new D;return E}),b.define("select2/options",["jquery","./defaults","./utils"],function(a,b,c){function d(a,d){if(this.options=a,null!=d&&this.fromElement(d),this.options=b.apply(this.options),d&&d.is("input")){var e=require(this.get("amdBase")+"compat/inputData");this.options.dataAdapter=c.Decorate(this.options.dataAdapter,e)}}return d.prototype.fromElement=function(b){var d=["select2"];null==this.options.multiple&&(this.options.multiple=b.prop("multiple")),null==this.options.disabled&&(this.options.disabled=b.prop("disabled")),null==this.options.language&&(b.prop("lang")?this.options.language=b.prop("lang").toLowerCase():b.closest("[lang]").prop("lang")&&(this.options.language=b.closest("[lang]").prop("lang"))),null==this.options.dir&&(this.options.dir=b.prop("dir")?b.prop("dir"):b.closest("[dir]").prop("dir")?b.closest("[dir]").prop("dir"):"ltr"),b.prop("disabled",this.options.disabled),b.prop("multiple",this.options.multiple),b.data("select2Tags")&&(this.options.debug&&window.console&&console.warn&&console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags="true"` attributes and will be removed in future versions of Select2.'),b.data("data",b.data("select2Tags")),b.data("tags",!0)),b.data("ajaxUrl")&&(this.options.debug&&window.console&&console.warn&&console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."),b.attr("ajax--url",b.data("ajaxUrl")),b.data("ajax--url",b.data("ajaxUrl")));var e={};e=a.fn.jquery&&"1."==a.fn.jquery.substr(0,2)&&b[0].dataset?a.extend(!0,{},b[0].dataset,b.data()):b.data();var f=a.extend(!0,{},e);f=c._convertData(f);for(var g in f)a.inArray(g,d)>-1||(a.isPlainObject(this.options[g])?a.extend(this.options[g],f[g]):this.options[g]=f[g]);return this},d.prototype.get=function(a){return this.options[a]},d.prototype.set=function(a,b){this.options[a]=b},d}),b.define("select2/core",["jquery","./options","./utils","./keys"],function(a,b,c,d){var e=function(a,c){null!=a.data("select2")&&a.data("select2").destroy(),this.$element=a,this.id=this._generateId(a),c=c||{},this.options=new b(c,a),e.__super__.constructor.call(this);var d=a.attr("tabindex")||0;a.data("old-tabindex",d),a.attr("tabindex","-1");var f=this.options.get("dataAdapter");this.dataAdapter=new f(a,this.options);var g=this.render();this._placeContainer(g);var h=this.options.get("selectionAdapter");this.selection=new h(a,this.options),this.$selection=this.selection.render(),this.selection.position(this.$selection,g);var i=this.options.get("dropdownAdapter");this.dropdown=new i(a,this.options),this.$dropdown=this.dropdown.render(),this.dropdown.position(this.$dropdown,g);var j=this.options.get("resultsAdapter");this.results=new j(a,this.options,this.dataAdapter),this.$results=this.results.render(),this.results.position(this.$results,this.$dropdown);var k=this;this._bindAdapters(),this._registerDomEvents(),this._registerDataEvents(),this._registerSelectionEvents(),this._registerDropdownEvents(),this._registerResultsEvents(),this._registerEvents(),this.dataAdapter.current(function(a){k.trigger("selection:update",{data:a})}),a.hide(),this._syncAttributes(),a.data("select2",this)};return c.Extend(e,c.Observable),e.prototype._generateId=function(a){var b="";return b=null!=a.attr("id")?a.attr("id"):null!=a.attr("name")?a.attr("name")+"-"+c.generateChars(2):c.generateChars(4),b="select2-"+b},e.prototype._placeContainer=function(a){a.insertAfter(this.$element);var b=this._resolveWidth(this.$element,this.options.get("width"));null!=b&&a.css("width",b)},e.prototype._resolveWidth=function(a,b){var c=/^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;if("resolve"==b){var d=this._resolveWidth(a,"style");return null!=d?d:this._resolveWidth(a,"element")}if("element"==b){var e=a.outerWidth(!1);return 0>=e?"auto":e+"px"}if("style"==b){var f=a.attr("style");if("string"!=typeof f)return null;for(var g=f.split(";"),h=0,i=g.length;i>h;h+=1){var j=g[h].replace(/\s/g,""),k=j.match(c);if(null!==k&&k.length>=1)return k[1]}return null}return b},e.prototype._bindAdapters=function(){this.dataAdapter.bind(this,this.$container),this.selection.bind(this,this.$container),this.dropdown.bind(this,this.$container),this.results.bind(this,this.$container)},e.prototype._registerDomEvents=function(){var b=this;this.$element.on("change.select2",function(){b.dataAdapter.current(function(a){b.trigger("selection:update",{data:a})})}),this._sync=c.bind(this._syncAttributes,this),this.$element[0].attachEvent&&this.$element[0].attachEvent("onpropertychange",this._sync);var d=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver;null!=d?(this._observer=new d(function(c){a.each(c,b._sync)}),this._observer.observe(this.$element[0],{attributes:!0,subtree:!1})):this.$element[0].addEventListener&&this.$element[0].addEventListener("DOMAttrModified",b._sync,!1)},e.prototype._registerDataEvents=function(){var a=this;this.dataAdapter.on("*",function(b,c){a.trigger(b,c)})},e.prototype._registerSelectionEvents=function(){var b=this,c=["toggle"];this.selection.on("toggle",function(){b.toggleDropdown()}),this.selection.on("*",function(d,e){-1===a.inArray(d,c)&&b.trigger(d,e)})},e.prototype._registerDropdownEvents=function(){var a=this;this.dropdown.on("*",function(b,c){a.trigger(b,c)})},e.prototype._registerResultsEvents=function(){var a=this;this.results.on("*",function(b,c){a.trigger(b,c)})},e.prototype._registerEvents=function(){var a=this;this.on("open",function(){a.$container.addClass("select2-container--open")}),this.on("close",function(){a.$container.removeClass("select2-container--open")}),this.on("enable",function(){a.$container.removeClass("select2-container--disabled")}),this.on("disable",function(){a.$container.addClass("select2-container--disabled")}),this.on("focus",function(){a.$container.addClass("select2-container--focus")}),this.on("blur",function(){a.$container.removeClass("select2-container--focus")}),this.on("query",function(b){a.isOpen()||a.trigger("open"),this.dataAdapter.query(b,function(c){a.trigger("results:all",{data:c,query:b})})}),this.on("query:append",function(b){this.dataAdapter.query(b,function(c){a.trigger("results:append",{data:c,query:b})})}),this.on("keypress",function(b){var c=b.which;a.isOpen()?c===d.ENTER?(a.trigger("results:select"),b.preventDefault()):c===d.SPACE&&b.ctrlKey?(a.trigger("results:toggle"),b.preventDefault()):c===d.UP?(a.trigger("results:previous"),b.preventDefault()):c===d.DOWN?(a.trigger("results:next"),b.preventDefault()):(c===d.ESC||c===d.TAB)&&(a.close(),b.preventDefault()):(c===d.ENTER||c===d.SPACE||(c===d.DOWN||c===d.UP)&&b.altKey)&&(a.open(),b.preventDefault())})},e.prototype._syncAttributes=function(){this.options.set("disabled",this.$element.prop("disabled")),this.options.get("disabled")?(this.isOpen()&&this.close(),this.trigger("disable")):this.trigger("enable")},e.prototype.trigger=function(a,b){var c=e.__super__.trigger,d={open:"opening",close:"closing",select:"selecting",unselect:"unselecting"};if(a in d){var f=d[a],g={prevented:!1,name:a,args:b};if(c.call(this,f,g),g.prevented)return void(b.prevented=!0)}c.call(this,a,b)},e.prototype.toggleDropdown=function(){this.options.get("disabled")||(this.isOpen()?this.close():this.open())},e.prototype.open=function(){this.isOpen()||(this.trigger("query",{}),this.trigger("open"))},e.prototype.close=function(){this.isOpen()&&this.trigger("close")},e.prototype.isOpen=function(){return this.$container.hasClass("select2-container--open")},e.prototype.enable=function(a){this.options.get("debug")&&window.console&&console.warn&&console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'),(null==a||0===a.length)&&(a=[!0]);var b=!a[0];this.$element.prop("disabled",b)},e.prototype.data=function(){this.options.get("debug")&&arguments.length>0&&window.console&&console.warn&&console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.');var a=[];return this.dataAdapter.current(function(b){a=b}),a},e.prototype.val=function(b){if(this.options.get("debug")&&window.console&&console.warn&&console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'),null==b||0===b.length)return this.$element.val();var c=b[0];a.isArray(c)&&(c=a.map(c,function(a){return a.toString()})),this.$element.val(c).trigger("change")},e.prototype.destroy=function(){this.$container.remove(),this.$element[0].detachEvent&&this.$element[0].detachEvent("onpropertychange",this._sync),null!=this._observer?(this._observer.disconnect(),this._observer=null):this.$element[0].removeEventListener&&this.$element[0].removeEventListener("DOMAttrModified",this._sync,!1),this._sync=null,this.$element.off(".select2"),this.$element.attr("tabindex",this.$element.data("old-tabindex")),this.$element.show(),this.$element.removeData("select2"),this.dataAdapter.destroy(),this.selection.destroy(),this.dropdown.destroy(),this.results.destroy(),this.dataAdapter=null,this.selection=null,this.dropdown=null,this.results=null},e.prototype.render=function(){var b=a('<span class="select2 select2-container"><span class="selection"></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>');return b.attr("dir",this.options.get("dir")),this.$container=b,this.$container.addClass("select2-container--"+this.options.get("theme")),b.data("element",this.$element),b},e}),b.define("jquery.select2",["jquery","./select2/core","./select2/defaults"],function(a,b,c){try{require("jquery.mousewheel")}catch(d){}return null==a.fn.select2&&(a.fn.select2=function(c){if(c=c||{},"object"==typeof c)return this.each(function(){{var d=a.extend({},c,!0);new b(a(this),d)}}),this;if("string"==typeof c){var d=this.data("select2"),e=Array.prototype.slice.call(arguments,1);return d[c](e)}throw new Error("Invalid arguments for Select2: "+c)}),null==a.fn.select2.defaults&&(a.fn.select2.defaults=c),b}),{define:b.define,require:b.require}}(),c=b.require("jquery.select2");return $.fn.select2.amd=b,c});
/*! DataTables 1.10.7
 * ©2008-2015 SpryMedia Ltd - datatables.net/license
 */
(function(Ea,Q,k){var P=function(h){function W(a){var b,c,e={};h.each(a,function(d){if((b=d.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(b[1]+" "))c=d.replace(b[0],b[2].toLowerCase()),e[c]=d,"o"===b[1]&&W(a[d])});a._hungarianMap=e}function H(a,b,c){a._hungarianMap||W(a);var e;h.each(b,function(d){e=a._hungarianMap[d];if(e!==k&&(c||b[e]===k))"o"===e.charAt(0)?(b[e]||(b[e]={}),h.extend(!0,b[e],b[d]),H(a[e],b[e],c)):b[e]=b[d]})}function P(a){var b=m.defaults.oLanguage,c=a.sZeroRecords;
!a.sEmptyTable&&(c&&"No data available in table"===b.sEmptyTable)&&E(a,a,"sZeroRecords","sEmptyTable");!a.sLoadingRecords&&(c&&"Loading..."===b.sLoadingRecords)&&E(a,a,"sZeroRecords","sLoadingRecords");a.sInfoThousands&&(a.sThousands=a.sInfoThousands);(a=a.sDecimal)&&db(a)}function eb(a){A(a,"ordering","bSort");A(a,"orderMulti","bSortMulti");A(a,"orderClasses","bSortClasses");A(a,"orderCellsTop","bSortCellsTop");A(a,"order","aaSorting");A(a,"orderFixed","aaSortingFixed");A(a,"paging","bPaginate");
A(a,"pagingType","sPaginationType");A(a,"pageLength","iDisplayLength");A(a,"searching","bFilter");if(a=a.aoSearchCols)for(var b=0,c=a.length;b<c;b++)a[b]&&H(m.models.oSearch,a[b])}function fb(a){A(a,"orderable","bSortable");A(a,"orderData","aDataSort");A(a,"orderSequence","asSorting");A(a,"orderDataType","sortDataType");var b=a.aDataSort;b&&!h.isArray(b)&&(a.aDataSort=[b])}function gb(a){var a=a.oBrowser,b=h("<div/>").css({position:"absolute",top:0,left:0,height:1,width:1,overflow:"hidden"}).append(h("<div/>").css({position:"absolute",
top:1,left:1,width:100,overflow:"scroll"}).append(h('<div class="test"/>').css({width:"100%",height:10}))).appendTo("body"),c=b.find(".test");a.bScrollOversize=100===c[0].offsetWidth;a.bScrollbarLeft=1!==Math.round(c.offset().left);b.remove()}function hb(a,b,c,e,d,f){var g,j=!1;c!==k&&(g=c,j=!0);for(;e!==d;)a.hasOwnProperty(e)&&(g=j?b(g,a[e],e,a):a[e],j=!0,e+=f);return g}function Fa(a,b){var c=m.defaults.column,e=a.aoColumns.length,c=h.extend({},m.models.oColumn,c,{nTh:b?b:Q.createElement("th"),sTitle:c.sTitle?
c.sTitle:b?b.innerHTML:"",aDataSort:c.aDataSort?c.aDataSort:[e],mData:c.mData?c.mData:e,idx:e});a.aoColumns.push(c);c=a.aoPreSearchCols;c[e]=h.extend({},m.models.oSearch,c[e]);ka(a,e,h(b).data())}function ka(a,b,c){var b=a.aoColumns[b],e=a.oClasses,d=h(b.nTh);if(!b.sWidthOrig){b.sWidthOrig=d.attr("width")||null;var f=(d.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/);f&&(b.sWidthOrig=f[1])}c!==k&&null!==c&&(fb(c),H(m.defaults.column,c),c.mDataProp!==k&&!c.mData&&(c.mData=c.mDataProp),c.sType&&
(b._sManualType=c.sType),c.className&&!c.sClass&&(c.sClass=c.className),h.extend(b,c),E(b,c,"sWidth","sWidthOrig"),c.iDataSort!==k&&(b.aDataSort=[c.iDataSort]),E(b,c,"aDataSort"));var g=b.mData,j=R(g),i=b.mRender?R(b.mRender):null,c=function(a){return"string"===typeof a&&-1!==a.indexOf("@")};b._bAttrSrc=h.isPlainObject(g)&&(c(g.sort)||c(g.type)||c(g.filter));b.fnGetData=function(a,b,c){var e=j(a,b,k,c);return i&&b?i(e,b,a,c):e};b.fnSetData=function(a,b,c){return S(g)(a,b,c)};"number"!==typeof g&&
(a._rowReadObject=!0);a.oFeatures.bSort||(b.bSortable=!1,d.addClass(e.sSortableNone));a=-1!==h.inArray("asc",b.asSorting);c=-1!==h.inArray("desc",b.asSorting);!b.bSortable||!a&&!c?(b.sSortingClass=e.sSortableNone,b.sSortingClassJUI=""):a&&!c?(b.sSortingClass=e.sSortableAsc,b.sSortingClassJUI=e.sSortJUIAscAllowed):!a&&c?(b.sSortingClass=e.sSortableDesc,b.sSortingClassJUI=e.sSortJUIDescAllowed):(b.sSortingClass=e.sSortable,b.sSortingClassJUI=e.sSortJUI)}function X(a){if(!1!==a.oFeatures.bAutoWidth){var b=
a.aoColumns;Ga(a);for(var c=0,e=b.length;c<e;c++)b[c].nTh.style.width=b[c].sWidth}b=a.oScroll;(""!==b.sY||""!==b.sX)&&Y(a);w(a,null,"column-sizing",[a])}function la(a,b){var c=Z(a,"bVisible");return"number"===typeof c[b]?c[b]:null}function $(a,b){var c=Z(a,"bVisible"),c=h.inArray(b,c);return-1!==c?c:null}function aa(a){return Z(a,"bVisible").length}function Z(a,b){var c=[];h.map(a.aoColumns,function(a,d){a[b]&&c.push(d)});return c}function Ha(a){var b=a.aoColumns,c=a.aoData,e=m.ext.type.detect,d,
f,g,j,i,h,l,q,n;d=0;for(f=b.length;d<f;d++)if(l=b[d],n=[],!l.sType&&l._sManualType)l.sType=l._sManualType;else if(!l.sType){g=0;for(j=e.length;g<j;g++){i=0;for(h=c.length;i<h;i++){n[i]===k&&(n[i]=x(a,i,d,"type"));q=e[g](n[i],a);if(!q&&g!==e.length-1)break;if("html"===q)break}if(q){l.sType=q;break}}l.sType||(l.sType="string")}}function ib(a,b,c,e){var d,f,g,j,i,o,l=a.aoColumns;if(b)for(d=b.length-1;0<=d;d--){o=b[d];var q=o.targets!==k?o.targets:o.aTargets;h.isArray(q)||(q=[q]);f=0;for(g=q.length;f<
g;f++)if("number"===typeof q[f]&&0<=q[f]){for(;l.length<=q[f];)Fa(a);e(q[f],o)}else if("number"===typeof q[f]&&0>q[f])e(l.length+q[f],o);else if("string"===typeof q[f]){j=0;for(i=l.length;j<i;j++)("_all"==q[f]||h(l[j].nTh).hasClass(q[f]))&&e(j,o)}}if(c){d=0;for(a=c.length;d<a;d++)e(d,c[d])}}function K(a,b,c,e){var d=a.aoData.length,f=h.extend(!0,{},m.models.oRow,{src:c?"dom":"data"});f._aData=b;a.aoData.push(f);for(var b=a.aoColumns,f=0,g=b.length;f<g;f++)c&&Ia(a,d,f,x(a,d,f)),b[f].sType=null;a.aiDisplayMaster.push(d);
(c||!a.oFeatures.bDeferRender)&&Ja(a,d,c,e);return d}function ma(a,b){var c;b instanceof h||(b=h(b));return b.map(function(b,d){c=na(a,d);return K(a,c.data,d,c.cells)})}function x(a,b,c,e){var d=a.iDraw,f=a.aoColumns[c],g=a.aoData[b]._aData,j=f.sDefaultContent,c=f.fnGetData(g,e,{settings:a,row:b,col:c});if(c===k)return a.iDrawError!=d&&null===j&&(I(a,0,"Requested unknown parameter "+("function"==typeof f.mData?"{function}":"'"+f.mData+"'")+" for row "+b,4),a.iDrawError=d),j;if((c===g||null===c)&&
null!==j)c=j;else if("function"===typeof c)return c.call(g);return null===c&&"display"==e?"":c}function Ia(a,b,c,e){a.aoColumns[c].fnSetData(a.aoData[b]._aData,e,{settings:a,row:b,col:c})}function Ka(a){return h.map(a.match(/(\\.|[^\.])+/g),function(a){return a.replace(/\\./g,".")})}function R(a){if(h.isPlainObject(a)){var b={};h.each(a,function(a,c){c&&(b[a]=R(c))});return function(a,c,f,g){var j=b[c]||b._;return j!==k?j(a,c,f,g):a}}if(null===a)return function(a){return a};if("function"===typeof a)return function(b,
c,f,g){return a(b,c,f,g)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var c=function(a,b,f){var g,j;if(""!==f){j=Ka(f);for(var i=0,h=j.length;i<h;i++){f=j[i].match(ba);g=j[i].match(T);if(f){j[i]=j[i].replace(ba,"");""!==j[i]&&(a=a[j[i]]);g=[];j.splice(0,i+1);j=j.join(".");i=0;for(h=a.length;i<h;i++)g.push(c(a[i],b,j));a=f[0].substring(1,f[0].length-1);a=""===a?g:g.join(a);break}else if(g){j[i]=j[i].replace(T,"");a=a[j[i]]();continue}if(null===a||a[j[i]]===
k)return k;a=a[j[i]]}}return a};return function(b,d){return c(b,d,a)}}return function(b){return b[a]}}function S(a){if(h.isPlainObject(a))return S(a._);if(null===a)return function(){};if("function"===typeof a)return function(b,e,d){a(b,"set",e,d)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var b=function(a,e,d){var d=Ka(d),f;f=d[d.length-1];for(var g,j,i=0,h=d.length-1;i<h;i++){g=d[i].match(ba);j=d[i].match(T);if(g){d[i]=d[i].replace(ba,"");a[d[i]]=[];
f=d.slice();f.splice(0,i+1);g=f.join(".");j=0;for(h=e.length;j<h;j++)f={},b(f,e[j],g),a[d[i]].push(f);return}j&&(d[i]=d[i].replace(T,""),a=a[d[i]](e));if(null===a[d[i]]||a[d[i]]===k)a[d[i]]={};a=a[d[i]]}if(f.match(T))a[f.replace(T,"")](e);else a[f.replace(ba,"")]=e};return function(c,e){return b(c,e,a)}}return function(b,e){b[a]=e}}function La(a){return D(a.aoData,"_aData")}function oa(a){a.aoData.length=0;a.aiDisplayMaster.length=0;a.aiDisplay.length=0}function pa(a,b,c){for(var e=-1,d=0,f=a.length;d<
f;d++)a[d]==b?e=d:a[d]>b&&a[d]--; -1!=e&&c===k&&a.splice(e,1)}function ca(a,b,c,e){var d=a.aoData[b],f,g=function(c,f){for(;c.childNodes.length;)c.removeChild(c.firstChild);c.innerHTML=x(a,b,f,"display")};if("dom"===c||(!c||"auto"===c)&&"dom"===d.src)d._aData=na(a,d,e,e===k?k:d._aData).data;else{var j=d.anCells;if(j)if(e!==k)g(j[e],e);else{c=0;for(f=j.length;c<f;c++)g(j[c],c)}}d._aSortData=null;d._aFilterData=null;g=a.aoColumns;if(e!==k)g[e].sType=null;else{c=0;for(f=g.length;c<f;c++)g[c].sType=null;
Ma(d)}}function na(a,b,c,e){var d=[],f=b.firstChild,g,j=0,i,o=a.aoColumns,l=a._rowReadObject,e=e||l?{}:[],q=function(a,b){if("string"===typeof a){var c=a.indexOf("@");-1!==c&&(c=a.substring(c+1),S(a)(e,b.getAttribute(c)))}},a=function(a){if(c===k||c===j)g=o[j],i=h.trim(a.innerHTML),g&&g._bAttrSrc?(S(g.mData._)(e,i),q(g.mData.sort,a),q(g.mData.type,a),q(g.mData.filter,a)):l?(g._setter||(g._setter=S(g.mData)),g._setter(e,i)):e[j]=i;j++};if(f)for(;f;){b=f.nodeName.toUpperCase();if("TD"==b||"TH"==b)a(f),
d.push(f);f=f.nextSibling}else{d=b.anCells;f=0;for(b=d.length;f<b;f++)a(d[f])}return{data:e,cells:d}}function Ja(a,b,c,e){var d=a.aoData[b],f=d._aData,g=[],j,i,h,l,q;if(null===d.nTr){j=c||Q.createElement("tr");d.nTr=j;d.anCells=g;j._DT_RowIndex=b;Ma(d);l=0;for(q=a.aoColumns.length;l<q;l++){h=a.aoColumns[l];i=c?e[l]:Q.createElement(h.sCellType);g.push(i);if(!c||h.mRender||h.mData!==l)i.innerHTML=x(a,b,l,"display");h.sClass&&(i.className+=" "+h.sClass);h.bVisible&&!c?j.appendChild(i):!h.bVisible&&c&&
i.parentNode.removeChild(i);h.fnCreatedCell&&h.fnCreatedCell.call(a.oInstance,i,x(a,b,l),f,b,l)}w(a,"aoRowCreatedCallback",null,[j,f,b])}d.nTr.setAttribute("role","row")}function Ma(a){var b=a.nTr,c=a._aData;if(b){c.DT_RowId&&(b.id=c.DT_RowId);if(c.DT_RowClass){var e=c.DT_RowClass.split(" ");a.__rowc=a.__rowc?Na(a.__rowc.concat(e)):e;h(b).removeClass(a.__rowc.join(" ")).addClass(c.DT_RowClass)}c.DT_RowAttr&&h(b).attr(c.DT_RowAttr);c.DT_RowData&&h(b).data(c.DT_RowData)}}function jb(a){var b,c,e,d,
f,g=a.nTHead,j=a.nTFoot,i=0===h("th, td",g).length,o=a.oClasses,l=a.aoColumns;i&&(d=h("<tr/>").appendTo(g));b=0;for(c=l.length;b<c;b++)f=l[b],e=h(f.nTh).addClass(f.sClass),i&&e.appendTo(d),a.oFeatures.bSort&&(e.addClass(f.sSortingClass),!1!==f.bSortable&&(e.attr("tabindex",a.iTabIndex).attr("aria-controls",a.sTableId),Oa(a,f.nTh,b))),f.sTitle!=e.html()&&e.html(f.sTitle),Pa(a,"header")(a,e,f,o);i&&da(a.aoHeader,g);h(g).find(">tr").attr("role","row");h(g).find(">tr>th, >tr>td").addClass(o.sHeaderTH);
h(j).find(">tr>th, >tr>td").addClass(o.sFooterTH);if(null!==j){a=a.aoFooter[0];b=0;for(c=a.length;b<c;b++)f=l[b],f.nTf=a[b].cell,f.sClass&&h(f.nTf).addClass(f.sClass)}}function ea(a,b,c){var e,d,f,g=[],j=[],i=a.aoColumns.length,o;if(b){c===k&&(c=!1);e=0;for(d=b.length;e<d;e++){g[e]=b[e].slice();g[e].nTr=b[e].nTr;for(f=i-1;0<=f;f--)!a.aoColumns[f].bVisible&&!c&&g[e].splice(f,1);j.push([])}e=0;for(d=g.length;e<d;e++){if(a=g[e].nTr)for(;f=a.firstChild;)a.removeChild(f);f=0;for(b=g[e].length;f<b;f++)if(o=
i=1,j[e][f]===k){a.appendChild(g[e][f].cell);for(j[e][f]=1;g[e+i]!==k&&g[e][f].cell==g[e+i][f].cell;)j[e+i][f]=1,i++;for(;g[e][f+o]!==k&&g[e][f].cell==g[e][f+o].cell;){for(c=0;c<i;c++)j[e+c][f+o]=1;o++}h(g[e][f].cell).attr("rowspan",i).attr("colspan",o)}}}}function M(a){var b=w(a,"aoPreDrawCallback","preDraw",[a]);if(-1!==h.inArray(!1,b))C(a,!1);else{var b=[],c=0,e=a.asStripeClasses,d=e.length,f=a.oLanguage,g=a.iInitDisplayStart,j="ssp"==B(a),i=a.aiDisplay;a.bDrawing=!0;g!==k&&-1!==g&&(a._iDisplayStart=
j?g:g>=a.fnRecordsDisplay()?0:g,a.iInitDisplayStart=-1);var g=a._iDisplayStart,o=a.fnDisplayEnd();if(a.bDeferLoading)a.bDeferLoading=!1,a.iDraw++,C(a,!1);else if(j){if(!a.bDestroying&&!kb(a))return}else a.iDraw++;if(0!==i.length){f=j?a.aoData.length:o;for(j=j?0:g;j<f;j++){var l=i[j],q=a.aoData[l];null===q.nTr&&Ja(a,l);l=q.nTr;if(0!==d){var n=e[c%d];q._sRowStripe!=n&&(h(l).removeClass(q._sRowStripe).addClass(n),q._sRowStripe=n)}w(a,"aoRowCallback",null,[l,q._aData,c,j]);b.push(l);c++}}else c=f.sZeroRecords,
1==a.iDraw&&"ajax"==B(a)?c=f.sLoadingRecords:f.sEmptyTable&&0===a.fnRecordsTotal()&&(c=f.sEmptyTable),b[0]=h("<tr/>",{"class":d?e[0]:""}).append(h("<td />",{valign:"top",colSpan:aa(a),"class":a.oClasses.sRowEmpty}).html(c))[0];w(a,"aoHeaderCallback","header",[h(a.nTHead).children("tr")[0],La(a),g,o,i]);w(a,"aoFooterCallback","footer",[h(a.nTFoot).children("tr")[0],La(a),g,o,i]);e=h(a.nTBody);e.children().detach();e.append(h(b));w(a,"aoDrawCallback","draw",[a]);a.bSorted=!1;a.bFiltered=!1;a.bDrawing=
!1}}function N(a,b){var c=a.oFeatures,e=c.bFilter;c.bSort&&lb(a);e?fa(a,a.oPreviousSearch):a.aiDisplay=a.aiDisplayMaster.slice();!0!==b&&(a._iDisplayStart=0);a._drawHold=b;M(a);a._drawHold=!1}function mb(a){var b=a.oClasses,c=h(a.nTable),c=h("<div/>").insertBefore(c),e=a.oFeatures,d=h("<div/>",{id:a.sTableId+"_wrapper","class":b.sWrapper+(a.nTFoot?"":" "+b.sNoFooter)});a.nHolding=c[0];a.nTableWrapper=d[0];a.nTableReinsertBefore=a.nTable.nextSibling;for(var f=a.sDom.split(""),g,j,i,o,l,q,n=0;n<f.length;n++){g=
null;j=f[n];if("<"==j){i=h("<div/>")[0];o=f[n+1];if("'"==o||'"'==o){l="";for(q=2;f[n+q]!=o;)l+=f[n+q],q++;"H"==l?l=b.sJUIHeader:"F"==l&&(l=b.sJUIFooter);-1!=l.indexOf(".")?(o=l.split("."),i.id=o[0].substr(1,o[0].length-1),i.className=o[1]):"#"==l.charAt(0)?i.id=l.substr(1,l.length-1):i.className=l;n+=q}d.append(i);d=h(i)}else if(">"==j)d=d.parent();else if("l"==j&&e.bPaginate&&e.bLengthChange)g=nb(a);else if("f"==j&&e.bFilter)g=ob(a);else if("r"==j&&e.bProcessing)g=pb(a);else if("t"==j)g=qb(a);else if("i"==
j&&e.bInfo)g=rb(a);else if("p"==j&&e.bPaginate)g=sb(a);else if(0!==m.ext.feature.length){i=m.ext.feature;q=0;for(o=i.length;q<o;q++)if(j==i[q].cFeature){g=i[q].fnInit(a);break}}g&&(i=a.aanFeatures,i[j]||(i[j]=[]),i[j].push(g),d.append(g))}c.replaceWith(d)}function da(a,b){var c=h(b).children("tr"),e,d,f,g,j,i,o,l,q,n;a.splice(0,a.length);f=0;for(i=c.length;f<i;f++)a.push([]);f=0;for(i=c.length;f<i;f++){e=c[f];for(d=e.firstChild;d;){if("TD"==d.nodeName.toUpperCase()||"TH"==d.nodeName.toUpperCase()){l=
1*d.getAttribute("colspan");q=1*d.getAttribute("rowspan");l=!l||0===l||1===l?1:l;q=!q||0===q||1===q?1:q;g=0;for(j=a[f];j[g];)g++;o=g;n=1===l?!0:!1;for(j=0;j<l;j++)for(g=0;g<q;g++)a[f+g][o+j]={cell:d,unique:n},a[f+g].nTr=e}d=d.nextSibling}}}function qa(a,b,c){var e=[];c||(c=a.aoHeader,b&&(c=[],da(c,b)));for(var b=0,d=c.length;b<d;b++)for(var f=0,g=c[b].length;f<g;f++)if(c[b][f].unique&&(!e[f]||!a.bSortCellsTop))e[f]=c[b][f].cell;return e}function ra(a,b,c){w(a,"aoServerParams","serverParams",[b]);
if(b&&h.isArray(b)){var e={},d=/(.*?)\[\]$/;h.each(b,function(a,b){var c=b.name.match(d);c?(c=c[0],e[c]||(e[c]=[]),e[c].push(b.value)):e[b.name]=b.value});b=e}var f,g=a.ajax,j=a.oInstance,i=function(b){w(a,null,"xhr",[a,b,a.jqXHR]);c(b)};if(h.isPlainObject(g)&&g.data){f=g.data;var o=h.isFunction(f)?f(b,a):f,b=h.isFunction(f)&&o?o:h.extend(!0,b,o);delete g.data}o={data:b,success:function(b){var c=b.error||b.sError;c&&I(a,0,c);a.json=b;i(b)},dataType:"json",cache:!1,type:a.sServerMethod,error:function(b,
c){var f=w(a,null,"xhr",[a,null,a.jqXHR]);-1===h.inArray(!0,f)&&("parsererror"==c?I(a,0,"Invalid JSON response",1):4===b.readyState&&I(a,0,"Ajax error",7));C(a,!1)}};a.oAjaxData=b;w(a,null,"preXhr",[a,b]);a.fnServerData?a.fnServerData.call(j,a.sAjaxSource,h.map(b,function(a,b){return{name:b,value:a}}),i,a):a.sAjaxSource||"string"===typeof g?a.jqXHR=h.ajax(h.extend(o,{url:g||a.sAjaxSource})):h.isFunction(g)?a.jqXHR=g.call(j,b,i,a):(a.jqXHR=h.ajax(h.extend(o,g)),g.data=f)}function kb(a){return a.bAjaxDataGet?
(a.iDraw++,C(a,!0),ra(a,tb(a),function(b){ub(a,b)}),!1):!0}function tb(a){var b=a.aoColumns,c=b.length,e=a.oFeatures,d=a.oPreviousSearch,f=a.aoPreSearchCols,g,j=[],i,o,l,q=U(a);g=a._iDisplayStart;i=!1!==e.bPaginate?a._iDisplayLength:-1;var n=function(a,b){j.push({name:a,value:b})};n("sEcho",a.iDraw);n("iColumns",c);n("sColumns",D(b,"sName").join(","));n("iDisplayStart",g);n("iDisplayLength",i);var k={draw:a.iDraw,columns:[],order:[],start:g,length:i,search:{value:d.sSearch,regex:d.bRegex}};for(g=
0;g<c;g++)o=b[g],l=f[g],i="function"==typeof o.mData?"function":o.mData,k.columns.push({data:i,name:o.sName,searchable:o.bSearchable,orderable:o.bSortable,search:{value:l.sSearch,regex:l.bRegex}}),n("mDataProp_"+g,i),e.bFilter&&(n("sSearch_"+g,l.sSearch),n("bRegex_"+g,l.bRegex),n("bSearchable_"+g,o.bSearchable)),e.bSort&&n("bSortable_"+g,o.bSortable);e.bFilter&&(n("sSearch",d.sSearch),n("bRegex",d.bRegex));e.bSort&&(h.each(q,function(a,b){k.order.push({column:b.col,dir:b.dir});n("iSortCol_"+a,b.col);
n("sSortDir_"+a,b.dir)}),n("iSortingCols",q.length));b=m.ext.legacy.ajax;return null===b?a.sAjaxSource?j:k:b?j:k}function ub(a,b){var c=sa(a,b),e=b.sEcho!==k?b.sEcho:b.draw,d=b.iTotalRecords!==k?b.iTotalRecords:b.recordsTotal,f=b.iTotalDisplayRecords!==k?b.iTotalDisplayRecords:b.recordsFiltered;if(e){if(1*e<a.iDraw)return;a.iDraw=1*e}oa(a);a._iRecordsTotal=parseInt(d,10);a._iRecordsDisplay=parseInt(f,10);e=0;for(d=c.length;e<d;e++)K(a,c[e]);a.aiDisplay=a.aiDisplayMaster.slice();a.bAjaxDataGet=!1;
M(a);a._bInitComplete||ta(a,b);a.bAjaxDataGet=!0;C(a,!1)}function sa(a,b){var c=h.isPlainObject(a.ajax)&&a.ajax.dataSrc!==k?a.ajax.dataSrc:a.sAjaxDataProp;return"data"===c?b.aaData||b[c]:""!==c?R(c)(b):b}function ob(a){var b=a.oClasses,c=a.sTableId,e=a.oLanguage,d=a.oPreviousSearch,f=a.aanFeatures,g='<input type="search" class="'+b.sFilterInput+'"/>',j=e.sSearch,j=j.match(/_INPUT_/)?j.replace("_INPUT_",g):j+g,b=h("<div/>",{id:!f.f?c+"_filter":null,"class":b.sFilter}).append(h("<label/>").append(j)),
f=function(){var b=!this.value?"":this.value;b!=d.sSearch&&(fa(a,{sSearch:b,bRegex:d.bRegex,bSmart:d.bSmart,bCaseInsensitive:d.bCaseInsensitive}),a._iDisplayStart=0,M(a))},g=null!==a.searchDelay?a.searchDelay:"ssp"===B(a)?400:0,i=h("input",b).val(d.sSearch).attr("placeholder",e.sSearchPlaceholder).bind("keyup.DT search.DT input.DT paste.DT cut.DT",g?ua(f,g):f).bind("keypress.DT",function(a){if(13==a.keyCode)return!1}).attr("aria-controls",c);h(a.nTable).on("search.dt.DT",function(b,c){if(a===c)try{i[0]!==
Q.activeElement&&i.val(d.sSearch)}catch(f){}});return b[0]}function fa(a,b,c){var e=a.oPreviousSearch,d=a.aoPreSearchCols,f=function(a){e.sSearch=a.sSearch;e.bRegex=a.bRegex;e.bSmart=a.bSmart;e.bCaseInsensitive=a.bCaseInsensitive};Ha(a);if("ssp"!=B(a)){vb(a,b.sSearch,c,b.bEscapeRegex!==k?!b.bEscapeRegex:b.bRegex,b.bSmart,b.bCaseInsensitive);f(b);for(b=0;b<d.length;b++)wb(a,d[b].sSearch,b,d[b].bEscapeRegex!==k?!d[b].bEscapeRegex:d[b].bRegex,d[b].bSmart,d[b].bCaseInsensitive);xb(a)}else f(b);a.bFiltered=
!0;w(a,null,"search",[a])}function xb(a){for(var b=m.ext.search,c=a.aiDisplay,e,d,f=0,g=b.length;f<g;f++){for(var j=[],i=0,h=c.length;i<h;i++)d=c[i],e=a.aoData[d],b[f](a,e._aFilterData,d,e._aData,i)&&j.push(d);c.length=0;c.push.apply(c,j)}}function wb(a,b,c,e,d,f){if(""!==b)for(var g=a.aiDisplay,e=Qa(b,e,d,f),d=g.length-1;0<=d;d--)b=a.aoData[g[d]]._aFilterData[c],e.test(b)||g.splice(d,1)}function vb(a,b,c,e,d,f){var e=Qa(b,e,d,f),d=a.oPreviousSearch.sSearch,f=a.aiDisplayMaster,g;0!==m.ext.search.length&&
(c=!0);g=yb(a);if(0>=b.length)a.aiDisplay=f.slice();else{if(g||c||d.length>b.length||0!==b.indexOf(d)||a.bSorted)a.aiDisplay=f.slice();b=a.aiDisplay;for(c=b.length-1;0<=c;c--)e.test(a.aoData[b[c]]._sFilterRow)||b.splice(c,1)}}function Qa(a,b,c,e){a=b?a:va(a);c&&(a="^(?=.*?"+h.map(a.match(/"[^"]+"|[^ ]+/g)||[""],function(a){if('"'===a.charAt(0))var b=a.match(/^"(.*)"$/),a=b?b[1]:a;return a.replace('"',"")}).join(")(?=.*?")+").*$");return RegExp(a,e?"i":"")}function va(a){return a.replace(Yb,"\\$1")}
function yb(a){var b=a.aoColumns,c,e,d,f,g,j,i,h,l=m.ext.type.search;c=!1;e=0;for(f=a.aoData.length;e<f;e++)if(h=a.aoData[e],!h._aFilterData){j=[];d=0;for(g=b.length;d<g;d++)c=b[d],c.bSearchable?(i=x(a,e,d,"filter"),l[c.sType]&&(i=l[c.sType](i)),null===i&&(i=""),"string"!==typeof i&&i.toString&&(i=i.toString())):i="",i.indexOf&&-1!==i.indexOf("&")&&(wa.innerHTML=i,i=Zb?wa.textContent:wa.innerText),i.replace&&(i=i.replace(/[\r\n]/g,"")),j.push(i);h._aFilterData=j;h._sFilterRow=j.join("  ");c=!0}return c}
function zb(a){return{search:a.sSearch,smart:a.bSmart,regex:a.bRegex,caseInsensitive:a.bCaseInsensitive}}function Ab(a){return{sSearch:a.search,bSmart:a.smart,bRegex:a.regex,bCaseInsensitive:a.caseInsensitive}}function rb(a){var b=a.sTableId,c=a.aanFeatures.i,e=h("<div/>",{"class":a.oClasses.sInfo,id:!c?b+"_info":null});c||(a.aoDrawCallback.push({fn:Bb,sName:"information"}),e.attr("role","status").attr("aria-live","polite"),h(a.nTable).attr("aria-describedby",b+"_info"));return e[0]}function Bb(a){var b=
a.aanFeatures.i;if(0!==b.length){var c=a.oLanguage,e=a._iDisplayStart+1,d=a.fnDisplayEnd(),f=a.fnRecordsTotal(),g=a.fnRecordsDisplay(),j=g?c.sInfo:c.sInfoEmpty;g!==f&&(j+=" "+c.sInfoFiltered);j+=c.sInfoPostFix;j=Cb(a,j);c=c.fnInfoCallback;null!==c&&(j=c.call(a.oInstance,a,e,d,f,g,j));h(b).html(j)}}function Cb(a,b){var c=a.fnFormatNumber,e=a._iDisplayStart+1,d=a._iDisplayLength,f=a.fnRecordsDisplay(),g=-1===d;return b.replace(/_START_/g,c.call(a,e)).replace(/_END_/g,c.call(a,a.fnDisplayEnd())).replace(/_MAX_/g,
c.call(a,a.fnRecordsTotal())).replace(/_TOTAL_/g,c.call(a,f)).replace(/_PAGE_/g,c.call(a,g?1:Math.ceil(e/d))).replace(/_PAGES_/g,c.call(a,g?1:Math.ceil(f/d)))}function ga(a){var b,c,e=a.iInitDisplayStart,d=a.aoColumns,f;c=a.oFeatures;if(a.bInitialised){mb(a);jb(a);ea(a,a.aoHeader);ea(a,a.aoFooter);C(a,!0);c.bAutoWidth&&Ga(a);b=0;for(c=d.length;b<c;b++)f=d[b],f.sWidth&&(f.nTh.style.width=s(f.sWidth));N(a);d=B(a);"ssp"!=d&&("ajax"==d?ra(a,[],function(c){var f=sa(a,c);for(b=0;b<f.length;b++)K(a,f[b]);
a.iInitDisplayStart=e;N(a);C(a,!1);ta(a,c)},a):(C(a,!1),ta(a)))}else setTimeout(function(){ga(a)},200)}function ta(a,b){a._bInitComplete=!0;b&&X(a);w(a,"aoInitComplete","init",[a,b])}function Ra(a,b){var c=parseInt(b,10);a._iDisplayLength=c;Sa(a);w(a,null,"length",[a,c])}function nb(a){for(var b=a.oClasses,c=a.sTableId,e=a.aLengthMenu,d=h.isArray(e[0]),f=d?e[0]:e,e=d?e[1]:e,d=h("<select/>",{name:c+"_length","aria-controls":c,"class":b.sLengthSelect}),g=0,j=f.length;g<j;g++)d[0][g]=new Option(e[g],
f[g]);var i=h("<div><label/></div>").addClass(b.sLength);a.aanFeatures.l||(i[0].id=c+"_length");i.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",d[0].outerHTML));h("select",i).val(a._iDisplayLength).bind("change.DT",function(){Ra(a,h(this).val());M(a)});h(a.nTable).bind("length.dt.DT",function(b,c,f){a===c&&h("select",i).val(f)});return i[0]}function sb(a){var b=a.sPaginationType,c=m.ext.pager[b],e="function"===typeof c,d=function(a){M(a)},b=h("<div/>").addClass(a.oClasses.sPaging+b)[0],
f=a.aanFeatures;e||c.fnInit(a,b,d);f.p||(b.id=a.sTableId+"_paginate",a.aoDrawCallback.push({fn:function(a){if(e){var b=a._iDisplayStart,i=a._iDisplayLength,h=a.fnRecordsDisplay(),l=-1===i,b=l?0:Math.ceil(b/i),i=l?1:Math.ceil(h/i),h=c(b,i),q,l=0;for(q=f.p.length;l<q;l++)Pa(a,"pageButton")(a,f.p[l],l,h,b,i)}else c.fnUpdate(a,d)},sName:"pagination"}));return b}function Ta(a,b,c){var e=a._iDisplayStart,d=a._iDisplayLength,f=a.fnRecordsDisplay();0===f||-1===d?e=0:"number"===typeof b?(e=b*d,e>f&&(e=0)):
"first"==b?e=0:"previous"==b?(e=0<=d?e-d:0,0>e&&(e=0)):"next"==b?e+d<f&&(e+=d):"last"==b?e=Math.floor((f-1)/d)*d:I(a,0,"Unknown paging action: "+b,5);b=a._iDisplayStart!==e;a._iDisplayStart=e;b&&(w(a,null,"page",[a]),c&&M(a));return b}function pb(a){return h("<div/>",{id:!a.aanFeatures.r?a.sTableId+"_processing":null,"class":a.oClasses.sProcessing}).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]}function C(a,b){a.oFeatures.bProcessing&&h(a.aanFeatures.r).css("display",b?"block":"none");w(a,
null,"processing",[a,b])}function qb(a){var b=h(a.nTable);b.attr("role","grid");var c=a.oScroll;if(""===c.sX&&""===c.sY)return a.nTable;var e=c.sX,d=c.sY,f=a.oClasses,g=b.children("caption"),j=g.length?g[0]._captionSide:null,i=h(b[0].cloneNode(!1)),o=h(b[0].cloneNode(!1)),l=b.children("tfoot");c.sX&&"100%"===b.attr("width")&&b.removeAttr("width");l.length||(l=null);c=h("<div/>",{"class":f.sScrollWrapper}).append(h("<div/>",{"class":f.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,
width:e?!e?null:s(e):"100%"}).append(h("<div/>",{"class":f.sScrollHeadInner}).css({"box-sizing":"content-box",width:c.sXInner||"100%"}).append(i.removeAttr("id").css("margin-left",0).append("top"===j?g:null).append(b.children("thead"))))).append(h("<div/>",{"class":f.sScrollBody}).css({overflow:"auto",height:!d?null:s(d),width:!e?null:s(e)}).append(b));l&&c.append(h("<div/>",{"class":f.sScrollFoot}).css({overflow:"hidden",border:0,width:e?!e?null:s(e):"100%"}).append(h("<div/>",{"class":f.sScrollFootInner}).append(o.removeAttr("id").css("margin-left",
0).append("bottom"===j?g:null).append(b.children("tfoot")))));var b=c.children(),q=b[0],f=b[1],n=l?b[2]:null;if(e)h(f).on("scroll.DT",function(){var a=this.scrollLeft;q.scrollLeft=a;l&&(n.scrollLeft=a)});a.nScrollHead=q;a.nScrollBody=f;a.nScrollFoot=n;a.aoDrawCallback.push({fn:Y,sName:"scrolling"});return c[0]}function Y(a){var b=a.oScroll,c=b.sX,e=b.sXInner,d=b.sY,f=b.iBarWidth,g=h(a.nScrollHead),j=g[0].style,i=g.children("div"),o=i[0].style,l=i.children("table"),i=a.nScrollBody,q=h(i),n=i.style,
k=h(a.nScrollFoot).children("div"),p=k.children("table"),m=h(a.nTHead),r=h(a.nTable),t=r[0],O=t.style,L=a.nTFoot?h(a.nTFoot):null,ha=a.oBrowser,w=ha.bScrollOversize,v,u,y,x,z,A=[],B=[],C=[],D,E=function(a){a=a.style;a.paddingTop="0";a.paddingBottom="0";a.borderTopWidth="0";a.borderBottomWidth="0";a.height=0};r.children("thead, tfoot").remove();z=m.clone().prependTo(r);v=m.find("tr");y=z.find("tr");z.find("th, td").removeAttr("tabindex");L&&(x=L.clone().prependTo(r),u=L.find("tr"),x=x.find("tr"));
c||(n.width="100%",g[0].style.width="100%");h.each(qa(a,z),function(b,c){D=la(a,b);c.style.width=a.aoColumns[D].sWidth});L&&G(function(a){a.style.width=""},x);b.bCollapse&&""!==d&&(n.height=q[0].offsetHeight+m[0].offsetHeight+"px");g=r.outerWidth();if(""===c){if(O.width="100%",w&&(r.find("tbody").height()>i.offsetHeight||"scroll"==q.css("overflow-y")))O.width=s(r.outerWidth()-f)}else""!==e?O.width=s(e):g==q.width()&&q.height()<r.height()?(O.width=s(g-f),r.outerWidth()>g-f&&(O.width=s(g))):O.width=
s(g);g=r.outerWidth();G(E,y);G(function(a){C.push(a.innerHTML);A.push(s(h(a).css("width")))},y);G(function(a,b){a.style.width=A[b]},v);h(y).height(0);L&&(G(E,x),G(function(a){B.push(s(h(a).css("width")))},x),G(function(a,b){a.style.width=B[b]},u),h(x).height(0));G(function(a,b){a.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+C[b]+"</div>";a.style.width=A[b]},y);L&&G(function(a,b){a.innerHTML="";a.style.width=B[b]},x);if(r.outerWidth()<g){u=i.scrollHeight>i.offsetHeight||
"scroll"==q.css("overflow-y")?g+f:g;if(w&&(i.scrollHeight>i.offsetHeight||"scroll"==q.css("overflow-y")))O.width=s(u-f);(""===c||""!==e)&&I(a,1,"Possible column misalignment",6)}else u="100%";n.width=s(u);j.width=s(u);L&&(a.nScrollFoot.style.width=s(u));!d&&w&&(n.height=s(t.offsetHeight+f));d&&b.bCollapse&&(n.height=s(d),b=c&&t.offsetWidth>i.offsetWidth?f:0,t.offsetHeight<i.offsetHeight&&(n.height=s(t.offsetHeight+b)));b=r.outerWidth();l[0].style.width=s(b);o.width=s(b);l=r.height()>i.clientHeight||
"scroll"==q.css("overflow-y");ha="padding"+(ha.bScrollbarLeft?"Left":"Right");o[ha]=l?f+"px":"0px";L&&(p[0].style.width=s(b),k[0].style.width=s(b),k[0].style[ha]=l?f+"px":"0px");q.scroll();if((a.bSorted||a.bFiltered)&&!a._drawHold)i.scrollTop=0}function G(a,b,c){for(var e=0,d=0,f=b.length,g,j;d<f;){g=b[d].firstChild;for(j=c?c[d].firstChild:null;g;)1===g.nodeType&&(c?a(g,j,e):a(g,e),e++),g=g.nextSibling,j=c?j.nextSibling:null;d++}}function Ga(a){var b=a.nTable,c=a.aoColumns,e=a.oScroll,d=e.sY,f=e.sX,
g=e.sXInner,j=c.length,e=Z(a,"bVisible"),i=h("th",a.nTHead),o=b.getAttribute("width"),l=b.parentNode,k=!1,n,m;(n=b.style.width)&&-1!==n.indexOf("%")&&(o=n);for(n=0;n<e.length;n++)m=c[e[n]],null!==m.sWidth&&(m.sWidth=Db(m.sWidthOrig,l),k=!0);if(!k&&!f&&!d&&j==aa(a)&&j==i.length)for(n=0;n<j;n++)c[n].sWidth=s(i.eq(n).width());else{j=h(b).clone().css("visibility","hidden").removeAttr("id");j.find("tbody tr").remove();var p=h("<tr/>").appendTo(j.find("tbody"));j.find("tfoot th, tfoot td").css("width",
"");i=qa(a,j.find("thead")[0]);for(n=0;n<e.length;n++)m=c[e[n]],i[n].style.width=null!==m.sWidthOrig&&""!==m.sWidthOrig?s(m.sWidthOrig):"";if(a.aoData.length)for(n=0;n<e.length;n++)k=e[n],m=c[k],h(Eb(a,k)).clone(!1).append(m.sContentPadding).appendTo(p);j.appendTo(l);f&&g?j.width(g):f?(j.css("width","auto"),j.width()<l.offsetWidth&&j.width(l.offsetWidth)):d?j.width(l.offsetWidth):o&&j.width(o);Fb(a,j[0]);if(f){for(n=g=0;n<e.length;n++)m=c[e[n]],d=h(i[n]).outerWidth(),g+=null===m.sWidthOrig?d:parseInt(m.sWidth,
10)+d-h(i[n]).width();j.width(s(g));b.style.width=s(g)}for(n=0;n<e.length;n++)if(m=c[e[n]],d=h(i[n]).width())m.sWidth=s(d);b.style.width=s(j.css("width"));j.remove()}o&&(b.style.width=s(o));if((o||f)&&!a._reszEvt)b=function(){h(Ea).bind("resize.DT-"+a.sInstance,ua(function(){X(a)}))},a.oBrowser.bScrollOversize?setTimeout(b,1E3):b(),a._reszEvt=!0}function ua(a,b){var c=b!==k?b:200,e,d;return function(){var b=this,g=+new Date,j=arguments;e&&g<e+c?(clearTimeout(d),d=setTimeout(function(){e=k;a.apply(b,
j)},c)):(e=g,a.apply(b,j))}}function Db(a,b){if(!a)return 0;var c=h("<div/>").css("width",s(a)).appendTo(b||Q.body),e=c[0].offsetWidth;c.remove();return e}function Fb(a,b){var c=a.oScroll;if(c.sX||c.sY)c=!c.sX?c.iBarWidth:0,b.style.width=s(h(b).outerWidth()-c)}function Eb(a,b){var c=Gb(a,b);if(0>c)return null;var e=a.aoData[c];return!e.nTr?h("<td/>").html(x(a,c,b,"display"))[0]:e.anCells[b]}function Gb(a,b){for(var c,e=-1,d=-1,f=0,g=a.aoData.length;f<g;f++)c=x(a,f,b,"display")+"",c=c.replace($b,""),
c.length>e&&(e=c.length,d=f);return d}function s(a){return null===a?"0px":"number"==typeof a?0>a?"0px":a+"px":a.match(/\d$/)?a+"px":a}function Hb(){var a=m.__scrollbarWidth;if(a===k){var b=h("<p/>").css({position:"absolute",top:0,left:0,width:"100%",height:150,padding:0,overflow:"scroll",visibility:"hidden"}).appendTo("body"),a=b[0].offsetWidth-b[0].clientWidth;m.__scrollbarWidth=a;b.remove()}return a}function U(a){var b,c,e=[],d=a.aoColumns,f,g,j,i;b=a.aaSortingFixed;c=h.isPlainObject(b);var o=[];
f=function(a){a.length&&!h.isArray(a[0])?o.push(a):o.push.apply(o,a)};h.isArray(b)&&f(b);c&&b.pre&&f(b.pre);f(a.aaSorting);c&&b.post&&f(b.post);for(a=0;a<o.length;a++){i=o[a][0];f=d[i].aDataSort;b=0;for(c=f.length;b<c;b++)g=f[b],j=d[g].sType||"string",o[a]._idx===k&&(o[a]._idx=h.inArray(o[a][1],d[g].asSorting)),e.push({src:i,col:g,dir:o[a][1],index:o[a]._idx,type:j,formatter:m.ext.type.order[j+"-pre"]})}return e}function lb(a){var b,c,e=[],d=m.ext.type.order,f=a.aoData,g=0,j,i=a.aiDisplayMaster,h;
Ha(a);h=U(a);b=0;for(c=h.length;b<c;b++)j=h[b],j.formatter&&g++,Ib(a,j.col);if("ssp"!=B(a)&&0!==h.length){b=0;for(c=i.length;b<c;b++)e[i[b]]=b;g===h.length?i.sort(function(a,b){var c,d,g,j,i=h.length,k=f[a]._aSortData,m=f[b]._aSortData;for(g=0;g<i;g++)if(j=h[g],c=k[j.col],d=m[j.col],c=c<d?-1:c>d?1:0,0!==c)return"asc"===j.dir?c:-c;c=e[a];d=e[b];return c<d?-1:c>d?1:0}):i.sort(function(a,b){var c,g,j,i,k=h.length,m=f[a]._aSortData,r=f[b]._aSortData;for(j=0;j<k;j++)if(i=h[j],c=m[i.col],g=r[i.col],i=d[i.type+
"-"+i.dir]||d["string-"+i.dir],c=i(c,g),0!==c)return c;c=e[a];g=e[b];return c<g?-1:c>g?1:0})}a.bSorted=!0}function Jb(a){for(var b,c,e=a.aoColumns,d=U(a),a=a.oLanguage.oAria,f=0,g=e.length;f<g;f++){c=e[f];var j=c.asSorting;b=c.sTitle.replace(/<.*?>/g,"");var i=c.nTh;i.removeAttribute("aria-sort");c.bSortable&&(0<d.length&&d[0].col==f?(i.setAttribute("aria-sort","asc"==d[0].dir?"ascending":"descending"),c=j[d[0].index+1]||j[0]):c=j[0],b+="asc"===c?a.sSortAscending:a.sSortDescending);i.setAttribute("aria-label",
b)}}function Ua(a,b,c,e){var d=a.aaSorting,f=a.aoColumns[b].asSorting,g=function(a,b){var c=a._idx;c===k&&(c=h.inArray(a[1],f));return c+1<f.length?c+1:b?null:0};"number"===typeof d[0]&&(d=a.aaSorting=[d]);c&&a.oFeatures.bSortMulti?(c=h.inArray(b,D(d,"0")),-1!==c?(b=g(d[c],!0),null===b&&1===d.length&&(b=0),null===b?d.splice(c,1):(d[c][1]=f[b],d[c]._idx=b)):(d.push([b,f[0],0]),d[d.length-1]._idx=0)):d.length&&d[0][0]==b?(b=g(d[0]),d.length=1,d[0][1]=f[b],d[0]._idx=b):(d.length=0,d.push([b,f[0]]),d[0]._idx=
0);N(a);"function"==typeof e&&e(a)}function Oa(a,b,c,e){var d=a.aoColumns[c];Va(b,{},function(b){!1!==d.bSortable&&(a.oFeatures.bProcessing?(C(a,!0),setTimeout(function(){Ua(a,c,b.shiftKey,e);"ssp"!==B(a)&&C(a,!1)},0)):Ua(a,c,b.shiftKey,e))})}function xa(a){var b=a.aLastSort,c=a.oClasses.sSortColumn,e=U(a),d=a.oFeatures,f,g;if(d.bSort&&d.bSortClasses){d=0;for(f=b.length;d<f;d++)g=b[d].src,h(D(a.aoData,"anCells",g)).removeClass(c+(2>d?d+1:3));d=0;for(f=e.length;d<f;d++)g=e[d].src,h(D(a.aoData,"anCells",
g)).addClass(c+(2>d?d+1:3))}a.aLastSort=e}function Ib(a,b){var c=a.aoColumns[b],e=m.ext.order[c.sSortDataType],d;e&&(d=e.call(a.oInstance,a,b,$(a,b)));for(var f,g=m.ext.type.order[c.sType+"-pre"],j=0,i=a.aoData.length;j<i;j++)if(c=a.aoData[j],c._aSortData||(c._aSortData=[]),!c._aSortData[b]||e)f=e?d[j]:x(a,j,b,"sort"),c._aSortData[b]=g?g(f):f}function ya(a){if(a.oFeatures.bStateSave&&!a.bDestroying){var b={time:+new Date,start:a._iDisplayStart,length:a._iDisplayLength,order:h.extend(!0,[],a.aaSorting),
search:zb(a.oPreviousSearch),columns:h.map(a.aoColumns,function(b,e){return{visible:b.bVisible,search:zb(a.aoPreSearchCols[e])}})};w(a,"aoStateSaveParams","stateSaveParams",[a,b]);a.oSavedState=b;a.fnStateSaveCallback.call(a.oInstance,a,b)}}function Kb(a){var b,c,e=a.aoColumns;if(a.oFeatures.bStateSave){var d=a.fnStateLoadCallback.call(a.oInstance,a);if(d&&d.time&&(b=w(a,"aoStateLoadParams","stateLoadParams",[a,d]),-1===h.inArray(!1,b)&&(b=a.iStateDuration,!(0<b&&d.time<+new Date-1E3*b)&&e.length===
d.columns.length))){a.oLoadedState=h.extend(!0,{},d);d.start!==k&&(a._iDisplayStart=d.start,a.iInitDisplayStart=d.start);d.length!==k&&(a._iDisplayLength=d.length);d.order!==k&&(a.aaSorting=[],h.each(d.order,function(b,c){a.aaSorting.push(c[0]>=e.length?[0,c[1]]:c)}));d.search!==k&&h.extend(a.oPreviousSearch,Ab(d.search));b=0;for(c=d.columns.length;b<c;b++){var f=d.columns[b];f.visible!==k&&(e[b].bVisible=f.visible);f.search!==k&&h.extend(a.aoPreSearchCols[b],Ab(f.search))}w(a,"aoStateLoaded","stateLoaded",
[a,d])}}}function za(a){var b=m.settings,a=h.inArray(a,D(b,"nTable"));return-1!==a?b[a]:null}function I(a,b,c,e){c="DataTables warning: "+(null!==a?"table id="+a.sTableId+" - ":"")+c;e&&(c+=". For more information about this error, please see http://datatables.net/tn/"+e);if(b)Ea.console&&console.log&&console.log(c);else if(b=m.ext,b=b.sErrMode||b.errMode,w(a,null,"error",[a,e,c]),"alert"==b)alert(c);else{if("throw"==b)throw Error(c);"function"==typeof b&&b(a,e,c)}}function E(a,b,c,e){h.isArray(c)?
h.each(c,function(c,f){h.isArray(f)?E(a,b,f[0],f[1]):E(a,b,f)}):(e===k&&(e=c),b[c]!==k&&(a[e]=b[c]))}function Lb(a,b,c){var e,d;for(d in b)b.hasOwnProperty(d)&&(e=b[d],h.isPlainObject(e)?(h.isPlainObject(a[d])||(a[d]={}),h.extend(!0,a[d],e)):a[d]=c&&"data"!==d&&"aaData"!==d&&h.isArray(e)?e.slice():e);return a}function Va(a,b,c){h(a).bind("click.DT",b,function(b){a.blur();c(b)}).bind("keypress.DT",b,function(a){13===a.which&&(a.preventDefault(),c(a))}).bind("selectstart.DT",function(){return!1})}function z(a,
b,c,e){c&&a[b].push({fn:c,sName:e})}function w(a,b,c,e){var d=[];b&&(d=h.map(a[b].slice().reverse(),function(b){return b.fn.apply(a.oInstance,e)}));null!==c&&(b=h.Event(c+".dt"),h(a.nTable).trigger(b,e),d.push(b.result));return d}function Sa(a){var b=a._iDisplayStart,c=a.fnDisplayEnd(),e=a._iDisplayLength;b>=c&&(b=c-e);b-=b%e;if(-1===e||0>b)b=0;a._iDisplayStart=b}function Pa(a,b){var c=a.renderer,e=m.ext.renderer[b];return h.isPlainObject(c)&&c[b]?e[c[b]]||e._:"string"===typeof c?e[c]||e._:e._}function B(a){return a.oFeatures.bServerSide?
"ssp":a.ajax||a.sAjaxSource?"ajax":"dom"}function Wa(a,b){var c=[],c=Mb.numbers_length,e=Math.floor(c/2);b<=c?c=V(0,b):a<=e?(c=V(0,c-2),c.push("ellipsis"),c.push(b-1)):(a>=b-1-e?c=V(b-(c-2),b):(c=V(a-e+2,a+e-1),c.push("ellipsis"),c.push(b-1)),c.splice(0,0,"ellipsis"),c.splice(0,0,0));c.DT_el="span";return c}function db(a){h.each({num:function(b){return Aa(b,a)},"num-fmt":function(b){return Aa(b,a,Xa)},"html-num":function(b){return Aa(b,a,Ba)},"html-num-fmt":function(b){return Aa(b,a,Ba,Xa)}},function(b,
c){u.type.order[b+a+"-pre"]=c;b.match(/^html\-/)&&(u.type.search[b+a]=u.type.search.html)})}function Nb(a){return function(){var b=[za(this[m.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return m.ext.internal[a].apply(this,b)}}var m,u,t,r,v,Ya={},Ob=/[\r\n]/g,Ba=/<.*?>/g,ac=/^[\w\+\-]/,bc=/[\w\+\-]$/,Yb=RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)","g"),Xa=/[',$\u00a3\u20ac\u00a5%\u2009\u202F\u20BD\u20a9\u20BArfk]/gi,J=function(a){return!a||!0===a||
"-"===a?!0:!1},Pb=function(a){var b=parseInt(a,10);return!isNaN(b)&&isFinite(a)?b:null},Qb=function(a,b){Ya[b]||(Ya[b]=RegExp(va(b),"g"));return"string"===typeof a&&"."!==b?a.replace(/\./g,"").replace(Ya[b],"."):a},Za=function(a,b,c){var e="string"===typeof a;if(J(a))return!0;b&&e&&(a=Qb(a,b));c&&e&&(a=a.replace(Xa,""));return!isNaN(parseFloat(a))&&isFinite(a)},Rb=function(a,b,c){return J(a)?!0:!(J(a)||"string"===typeof a)?null:Za(a.replace(Ba,""),b,c)?!0:null},D=function(a,b,c){var e=[],d=0,f=a.length;
if(c!==k)for(;d<f;d++)a[d]&&a[d][b]&&e.push(a[d][b][c]);else for(;d<f;d++)a[d]&&e.push(a[d][b]);return e},ia=function(a,b,c,e){var d=[],f=0,g=b.length;if(e!==k)for(;f<g;f++)a[b[f]][c]&&d.push(a[b[f]][c][e]);else for(;f<g;f++)d.push(a[b[f]][c]);return d},V=function(a,b){var c=[],e;b===k?(b=0,e=a):(e=b,b=a);for(var d=b;d<e;d++)c.push(d);return c},Sb=function(a){for(var b=[],c=0,e=a.length;c<e;c++)a[c]&&b.push(a[c]);return b},Na=function(a){var b=[],c,e,d=a.length,f,g=0;e=0;a:for(;e<d;e++){c=a[e];for(f=
0;f<g;f++)if(b[f]===c)continue a;b.push(c);g++}return b},A=function(a,b,c){a[b]!==k&&(a[c]=a[b])},ba=/\[.*?\]$/,T=/\(\)$/,wa=h("<div>")[0],Zb=wa.textContent!==k,$b=/<.*?>/g;m=function(a){this.$=function(a,b){return this.api(!0).$(a,b)};this._=function(a,b){return this.api(!0).rows(a,b).data()};this.api=function(a){return a?new t(za(this[u.iApiIndex])):new t(this)};this.fnAddData=function(a,b){var c=this.api(!0),e=h.isArray(a)&&(h.isArray(a[0])||h.isPlainObject(a[0]))?c.rows.add(a):c.row.add(a);(b===
k||b)&&c.draw();return e.flatten().toArray()};this.fnAdjustColumnSizing=function(a){var b=this.api(!0).columns.adjust(),c=b.settings()[0],e=c.oScroll;a===k||a?b.draw(!1):(""!==e.sX||""!==e.sY)&&Y(c)};this.fnClearTable=function(a){var b=this.api(!0).clear();(a===k||a)&&b.draw()};this.fnClose=function(a){this.api(!0).row(a).child.hide()};this.fnDeleteRow=function(a,b,c){var e=this.api(!0),a=e.rows(a),d=a.settings()[0],h=d.aoData[a[0][0]];a.remove();b&&b.call(this,d,h);(c===k||c)&&e.draw();return h};
this.fnDestroy=function(a){this.api(!0).destroy(a)};this.fnDraw=function(a){this.api(!0).draw(a)};this.fnFilter=function(a,b,c,e,d,h){d=this.api(!0);null===b||b===k?d.search(a,c,e,h):d.column(b).search(a,c,e,h);d.draw()};this.fnGetData=function(a,b){var c=this.api(!0);if(a!==k){var e=a.nodeName?a.nodeName.toLowerCase():"";return b!==k||"td"==e||"th"==e?c.cell(a,b).data():c.row(a).data()||null}return c.data().toArray()};this.fnGetNodes=function(a){var b=this.api(!0);return a!==k?b.row(a).node():b.rows().nodes().flatten().toArray()};
this.fnGetPosition=function(a){var b=this.api(!0),c=a.nodeName.toUpperCase();return"TR"==c?b.row(a).index():"TD"==c||"TH"==c?(a=b.cell(a).index(),[a.row,a.columnVisible,a.column]):null};this.fnIsOpen=function(a){return this.api(!0).row(a).child.isShown()};this.fnOpen=function(a,b,c){return this.api(!0).row(a).child(b,c).show().child()[0]};this.fnPageChange=function(a,b){var c=this.api(!0).page(a);(b===k||b)&&c.draw(!1)};this.fnSetColumnVis=function(a,b,c){a=this.api(!0).column(a).visible(b);(c===
k||c)&&a.columns.adjust().draw()};this.fnSettings=function(){return za(this[u.iApiIndex])};this.fnSort=function(a){this.api(!0).order(a).draw()};this.fnSortListener=function(a,b,c){this.api(!0).order.listener(a,b,c)};this.fnUpdate=function(a,b,c,e,d){var h=this.api(!0);c===k||null===c?h.row(b).data(a):h.cell(b,c).data(a);(d===k||d)&&h.columns.adjust();(e===k||e)&&h.draw();return 0};this.fnVersionCheck=u.fnVersionCheck;var b=this,c=a===k,e=this.length;c&&(a={});this.oApi=this.internal=u.internal;for(var d in m.ext.internal)d&&
(this[d]=Nb(d));this.each(function(){var d={},d=1<e?Lb(d,a,!0):a,g=0,j,i=this.getAttribute("id"),o=!1,l=m.defaults,q=h(this);if("table"!=this.nodeName.toLowerCase())I(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{eb(l);fb(l.column);H(l,l,!0);H(l.column,l.column,!0);H(l,h.extend(d,q.data()));var n=m.settings,g=0;for(j=n.length;g<j;g++){var r=n[g];if(r.nTable==this||r.nTHead.parentNode==this||r.nTFoot&&r.nTFoot.parentNode==this){g=d.bRetrieve!==k?d.bRetrieve:l.bRetrieve;if(c||g)return r.oInstance;
if(d.bDestroy!==k?d.bDestroy:l.bDestroy){r.oInstance.fnDestroy();break}else{I(r,0,"Cannot reinitialise DataTable",3);return}}if(r.sTableId==this.id){n.splice(g,1);break}}if(null===i||""===i)this.id=i="DataTables_Table_"+m.ext._unique++;var p=h.extend(!0,{},m.models.oSettings,{sDestroyWidth:q[0].style.width,sInstance:i,sTableId:i});p.nTable=this;p.oApi=b.internal;p.oInit=d;n.push(p);p.oInstance=1===b.length?b:q.dataTable();eb(d);d.oLanguage&&P(d.oLanguage);d.aLengthMenu&&!d.iDisplayLength&&(d.iDisplayLength=
h.isArray(d.aLengthMenu[0])?d.aLengthMenu[0][0]:d.aLengthMenu[0]);d=Lb(h.extend(!0,{},l),d);E(p.oFeatures,d,"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));E(p,d,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback",
"renderer","searchDelay",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"],["bJQueryUI","bJUI"]]);E(p.oScroll,d,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);E(p.oLanguage,d,"fnInfoCallback");z(p,"aoDrawCallback",d.fnDrawCallback,"user");z(p,"aoServerParams",d.fnServerParams,"user");z(p,"aoStateSaveParams",d.fnStateSaveParams,"user");z(p,"aoStateLoadParams",
d.fnStateLoadParams,"user");z(p,"aoStateLoaded",d.fnStateLoaded,"user");z(p,"aoRowCallback",d.fnRowCallback,"user");z(p,"aoRowCreatedCallback",d.fnCreatedRow,"user");z(p,"aoHeaderCallback",d.fnHeaderCallback,"user");z(p,"aoFooterCallback",d.fnFooterCallback,"user");z(p,"aoInitComplete",d.fnInitComplete,"user");z(p,"aoPreDrawCallback",d.fnPreDrawCallback,"user");i=p.oClasses;d.bJQueryUI?(h.extend(i,m.ext.oJUIClasses,d.oClasses),d.sDom===l.sDom&&"lfrtip"===l.sDom&&(p.sDom='<"H"lfr>t<"F"ip>'),p.renderer)?
h.isPlainObject(p.renderer)&&!p.renderer.header&&(p.renderer.header="jqueryui"):p.renderer="jqueryui":h.extend(i,m.ext.classes,d.oClasses);q.addClass(i.sTable);if(""!==p.oScroll.sX||""!==p.oScroll.sY)p.oScroll.iBarWidth=Hb();!0===p.oScroll.sX&&(p.oScroll.sX="100%");p.iInitDisplayStart===k&&(p.iInitDisplayStart=d.iDisplayStart,p._iDisplayStart=d.iDisplayStart);null!==d.iDeferLoading&&(p.bDeferLoading=!0,g=h.isArray(d.iDeferLoading),p._iRecordsDisplay=g?d.iDeferLoading[0]:d.iDeferLoading,p._iRecordsTotal=
g?d.iDeferLoading[1]:d.iDeferLoading);var t=p.oLanguage;h.extend(!0,t,d.oLanguage);""!==t.sUrl&&(h.ajax({dataType:"json",url:t.sUrl,success:function(a){P(a);H(l.oLanguage,a);h.extend(true,t,a);ga(p)},error:function(){ga(p)}}),o=!0);null===d.asStripeClasses&&(p.asStripeClasses=[i.sStripeOdd,i.sStripeEven]);var g=p.asStripeClasses,s=q.children("tbody").find("tr").eq(0);-1!==h.inArray(!0,h.map(g,function(a){return s.hasClass(a)}))&&(h("tbody tr",this).removeClass(g.join(" ")),p.asDestroyStripes=g.slice());
n=[];g=this.getElementsByTagName("thead");0!==g.length&&(da(p.aoHeader,g[0]),n=qa(p));if(null===d.aoColumns){r=[];g=0;for(j=n.length;g<j;g++)r.push(null)}else r=d.aoColumns;g=0;for(j=r.length;g<j;g++)Fa(p,n?n[g]:null);ib(p,d.aoColumnDefs,r,function(a,b){ka(p,a,b)});if(s.length){var u=function(a,b){return a.getAttribute("data-"+b)!==null?b:null};h.each(na(p,s[0]).cells,function(a,b){var c=p.aoColumns[a];if(c.mData===a){var d=u(b,"sort")||u(b,"order"),e=u(b,"filter")||u(b,"search");if(d!==null||e!==
null){c.mData={_:a+".display",sort:d!==null?a+".@data-"+d:k,type:d!==null?a+".@data-"+d:k,filter:e!==null?a+".@data-"+e:k};ka(p,a)}}})}var v=p.oFeatures;d.bStateSave&&(v.bStateSave=!0,Kb(p,d),z(p,"aoDrawCallback",ya,"state_save"));if(d.aaSorting===k){n=p.aaSorting;g=0;for(j=n.length;g<j;g++)n[g][1]=p.aoColumns[g].asSorting[0]}xa(p);v.bSort&&z(p,"aoDrawCallback",function(){if(p.bSorted){var a=U(p),b={};h.each(a,function(a,c){b[c.src]=c.dir});w(p,null,"order",[p,a,b]);Jb(p)}});z(p,"aoDrawCallback",
function(){(p.bSorted||B(p)==="ssp"||v.bDeferRender)&&xa(p)},"sc");gb(p);g=q.children("caption").each(function(){this._captionSide=q.css("caption-side")});j=q.children("thead");0===j.length&&(j=h("<thead/>").appendTo(this));p.nTHead=j[0];j=q.children("tbody");0===j.length&&(j=h("<tbody/>").appendTo(this));p.nTBody=j[0];j=q.children("tfoot");if(0===j.length&&0<g.length&&(""!==p.oScroll.sX||""!==p.oScroll.sY))j=h("<tfoot/>").appendTo(this);0===j.length||0===j.children().length?q.addClass(i.sNoFooter):
0<j.length&&(p.nTFoot=j[0],da(p.aoFooter,p.nTFoot));if(d.aaData)for(g=0;g<d.aaData.length;g++)K(p,d.aaData[g]);else(p.bDeferLoading||"dom"==B(p))&&ma(p,h(p.nTBody).children("tr"));p.aiDisplay=p.aiDisplayMaster.slice();p.bInitialised=!0;!1===o&&ga(p)}});b=null;return this};var Tb=[],y=Array.prototype,cc=function(a){var b,c,e=m.settings,d=h.map(e,function(a){return a.nTable});if(a){if(a.nTable&&a.oApi)return[a];if(a.nodeName&&"table"===a.nodeName.toLowerCase())return b=h.inArray(a,d),-1!==b?[e[b]]:
null;if(a&&"function"===typeof a.settings)return a.settings().toArray();"string"===typeof a?c=h(a):a instanceof h&&(c=a)}else return[];if(c)return c.map(function(){b=h.inArray(this,d);return-1!==b?e[b]:null}).toArray()};t=function(a,b){if(!(this instanceof t))return new t(a,b);var c=[],e=function(a){(a=cc(a))&&c.push.apply(c,a)};if(h.isArray(a))for(var d=0,f=a.length;d<f;d++)e(a[d]);else e(a);this.context=Na(c);b&&this.push.apply(this,b.toArray?b.toArray():b);this.selector={rows:null,cols:null,opts:null};
t.extend(this,this,Tb)};m.Api=t;t.prototype={any:function(){return 0!==this.flatten().length},concat:y.concat,context:[],each:function(a){for(var b=0,c=this.length;b<c;b++)a.call(this,this[b],b,this);return this},eq:function(a){var b=this.context;return b.length>a?new t(b[a],this[a]):null},filter:function(a){var b=[];if(y.filter)b=y.filter.call(this,a,this);else for(var c=0,e=this.length;c<e;c++)a.call(this,this[c],c,this)&&b.push(this[c]);return new t(this.context,b)},flatten:function(){var a=[];
return new t(this.context,a.concat.apply(a,this.toArray()))},join:y.join,indexOf:y.indexOf||function(a,b){for(var c=b||0,e=this.length;c<e;c++)if(this[c]===a)return c;return-1},iterator:function(a,b,c,e){var d=[],f,g,h,i,o,l=this.context,q,n,m=this.selector;"string"===typeof a&&(e=c,c=b,b=a,a=!1);g=0;for(h=l.length;g<h;g++){var p=new t(l[g]);if("table"===b)f=c.call(p,l[g],g),f!==k&&d.push(f);else if("columns"===b||"rows"===b)f=c.call(p,l[g],this[g],g),f!==k&&d.push(f);else if("column"===b||"column-rows"===
b||"row"===b||"cell"===b){n=this[g];"column-rows"===b&&(q=Ca(l[g],m.opts));i=0;for(o=n.length;i<o;i++)f=n[i],f="cell"===b?c.call(p,l[g],f.row,f.column,g,i):c.call(p,l[g],f,g,i,q),f!==k&&d.push(f)}}return d.length||e?(a=new t(l,a?d.concat.apply([],d):d),b=a.selector,b.rows=m.rows,b.cols=m.cols,b.opts=m.opts,a):this},lastIndexOf:y.lastIndexOf||function(a,b){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(a){var b=[];if(y.map)b=y.map.call(this,a,this);else for(var c=
0,e=this.length;c<e;c++)b.push(a.call(this,this[c],c));return new t(this.context,b)},pluck:function(a){return this.map(function(b){return b[a]})},pop:y.pop,push:y.push,reduce:y.reduce||function(a,b){return hb(this,a,b,0,this.length,1)},reduceRight:y.reduceRight||function(a,b){return hb(this,a,b,this.length-1,-1,-1)},reverse:y.reverse,selector:null,shift:y.shift,sort:y.sort,splice:y.splice,toArray:function(){return y.slice.call(this)},to$:function(){return h(this)},toJQuery:function(){return h(this)},
unique:function(){return new t(this.context,Na(this))},unshift:y.unshift};t.extend=function(a,b,c){if(c.length&&b&&(b instanceof t||b.__dt_wrapper)){var e,d,f,g=function(a,b,c){return function(){var d=b.apply(a,arguments);t.extend(d,d,c.methodExt);return d}};e=0;for(d=c.length;e<d;e++)f=c[e],b[f.name]="function"===typeof f.val?g(a,f.val,f):h.isPlainObject(f.val)?{}:f.val,b[f.name].__dt_wrapper=!0,t.extend(a,b[f.name],f.propExt)}};t.register=r=function(a,b){if(h.isArray(a))for(var c=0,e=a.length;c<
e;c++)t.register(a[c],b);else for(var d=a.split("."),f=Tb,g,j,c=0,e=d.length;c<e;c++){g=(j=-1!==d[c].indexOf("()"))?d[c].replace("()",""):d[c];var i;a:{i=0;for(var o=f.length;i<o;i++)if(f[i].name===g){i=f[i];break a}i=null}i||(i={name:g,val:{},methodExt:[],propExt:[]},f.push(i));c===e-1?i.val=b:f=j?i.methodExt:i.propExt}};t.registerPlural=v=function(a,b,c){t.register(a,c);t.register(b,function(){var a=c.apply(this,arguments);return a===this?this:a instanceof t?a.length?h.isArray(a[0])?new t(a.context,
a[0]):a[0]:k:a})};r("tables()",function(a){var b;if(a){b=t;var c=this.context;if("number"===typeof a)a=[c[a]];else var e=h.map(c,function(a){return a.nTable}),a=h(e).filter(a).map(function(){var a=h.inArray(this,e);return c[a]}).toArray();b=new b(a)}else b=this;return b});r("table()",function(a){var a=this.tables(a),b=a.context;return b.length?new t(b[0]):a});v("tables().nodes()","table().node()",function(){return this.iterator("table",function(a){return a.nTable},1)});v("tables().body()","table().body()",
function(){return this.iterator("table",function(a){return a.nTBody},1)});v("tables().header()","table().header()",function(){return this.iterator("table",function(a){return a.nTHead},1)});v("tables().footer()","table().footer()",function(){return this.iterator("table",function(a){return a.nTFoot},1)});v("tables().containers()","table().container()",function(){return this.iterator("table",function(a){return a.nTableWrapper},1)});r("draw()",function(a){return this.iterator("table",function(b){N(b,
!1===a)})});r("page()",function(a){return a===k?this.page.info().page:this.iterator("table",function(b){Ta(b,a)})});r("page.info()",function(){if(0===this.context.length)return k;var a=this.context[0],b=a._iDisplayStart,c=a._iDisplayLength,e=a.fnRecordsDisplay(),d=-1===c;return{page:d?0:Math.floor(b/c),pages:d?1:Math.ceil(e/c),start:b,end:a.fnDisplayEnd(),length:c,recordsTotal:a.fnRecordsTotal(),recordsDisplay:e}});r("page.len()",function(a){return a===k?0!==this.context.length?this.context[0]._iDisplayLength:
k:this.iterator("table",function(b){Ra(b,a)})});var Ub=function(a,b,c){if(c){var e=new t(a);e.one("draw",function(){c(e.ajax.json())})}"ssp"==B(a)?N(a,b):(C(a,!0),ra(a,[],function(c){oa(a);for(var c=sa(a,c),e=0,g=c.length;e<g;e++)K(a,c[e]);N(a,b);C(a,!1)}))};r("ajax.json()",function(){var a=this.context;if(0<a.length)return a[0].json});r("ajax.params()",function(){var a=this.context;if(0<a.length)return a[0].oAjaxData});r("ajax.reload()",function(a,b){return this.iterator("table",function(c){Ub(c,
!1===b,a)})});r("ajax.url()",function(a){var b=this.context;if(a===k){if(0===b.length)return k;b=b[0];return b.ajax?h.isPlainObject(b.ajax)?b.ajax.url:b.ajax:b.sAjaxSource}return this.iterator("table",function(b){h.isPlainObject(b.ajax)?b.ajax.url=a:b.ajax=a})});r("ajax.url().load()",function(a,b){return this.iterator("table",function(c){Ub(c,!1===b,a)})});var $a=function(a,b,c,e,d){var f=[],g,j,i,o,l,q;i=typeof b;if(!b||"string"===i||"function"===i||b.length===k)b=[b];i=0;for(o=b.length;i<o;i++){j=
b[i]&&b[i].split?b[i].split(","):[b[i]];l=0;for(q=j.length;l<q;l++)(g=c("string"===typeof j[l]?h.trim(j[l]):j[l]))&&g.length&&f.push.apply(f,g)}a=u.selector[a];if(a.length){i=0;for(o=a.length;i<o;i++)f=a[i](e,d,f)}return f},ab=function(a){a||(a={});a.filter&&a.search===k&&(a.search=a.filter);return h.extend({search:"none",order:"current",page:"all"},a)},bb=function(a){for(var b=0,c=a.length;b<c;b++)if(0<a[b].length)return a[0]=a[b],a[0].length=1,a.length=1,a.context=[a.context[b]],a;a.length=0;return a},
Ca=function(a,b){var c,e,d,f=[],g=a.aiDisplay;c=a.aiDisplayMaster;var j=b.search;e=b.order;d=b.page;if("ssp"==B(a))return"removed"===j?[]:V(0,c.length);if("current"==d){c=a._iDisplayStart;for(e=a.fnDisplayEnd();c<e;c++)f.push(g[c])}else if("current"==e||"applied"==e)f="none"==j?c.slice():"applied"==j?g.slice():h.map(c,function(a){return-1===h.inArray(a,g)?a:null});else if("index"==e||"original"==e){c=0;for(e=a.aoData.length;c<e;c++)"none"==j?f.push(c):(d=h.inArray(c,g),(-1===d&&"removed"==j||0<=d&&
"applied"==j)&&f.push(c))}return f};r("rows()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=ab(b),c=this.iterator("table",function(c){var d=b;return $a("row",a,function(a){var b=Pb(a);if(b!==null&&!d)return[b];var j=Ca(c,d);if(b!==null&&h.inArray(b,j)!==-1)return[b];if(!a)return j;if(typeof a==="function")return h.map(j,function(b){var d=c.aoData[b];return a(b,d._aData,d.nTr)?b:null});b=Sb(ia(c.aoData,j,"nTr"));return a.nodeName&&h.inArray(a,b)!==-1?[a._DT_RowIndex]:h(b).filter(a).map(function(){return this._DT_RowIndex}).toArray()},
c,d)},1);c.selector.rows=a;c.selector.opts=b;return c});r("rows().nodes()",function(){return this.iterator("row",function(a,b){return a.aoData[b].nTr||k},1)});r("rows().data()",function(){return this.iterator(!0,"rows",function(a,b){return ia(a.aoData,b,"_aData")},1)});v("rows().cache()","row().cache()",function(a){return this.iterator("row",function(b,c){var e=b.aoData[c];return"search"===a?e._aFilterData:e._aSortData},1)});v("rows().invalidate()","row().invalidate()",function(a){return this.iterator("row",
function(b,c){ca(b,c,a)})});v("rows().indexes()","row().index()",function(){return this.iterator("row",function(a,b){return b},1)});v("rows().remove()","row().remove()",function(){var a=this;return this.iterator("row",function(b,c,e){var d=b.aoData;d.splice(c,1);for(var f=0,g=d.length;f<g;f++)null!==d[f].nTr&&(d[f].nTr._DT_RowIndex=f);h.inArray(c,b.aiDisplay);pa(b.aiDisplayMaster,c);pa(b.aiDisplay,c);pa(a[e],c,!1);Sa(b)})});r("rows.add()",function(a){var b=this.iterator("table",function(b){var c,
f,g,h=[];f=0;for(g=a.length;f<g;f++)c=a[f],c.nodeName&&"TR"===c.nodeName.toUpperCase()?h.push(ma(b,c)[0]):h.push(K(b,c));return h},1),c=this.rows(-1);c.pop();c.push.apply(c,b.toArray());return c});r("row()",function(a,b){return bb(this.rows(a,b))});r("row().data()",function(a){var b=this.context;if(a===k)return b.length&&this.length?b[0].aoData[this[0]]._aData:k;b[0].aoData[this[0]]._aData=a;ca(b[0],this[0],"data");return this});r("row().node()",function(){var a=this.context;return a.length&&this.length?
a[0].aoData[this[0]].nTr||null:null});r("row.add()",function(a){a instanceof h&&a.length&&(a=a[0]);var b=this.iterator("table",function(b){return a.nodeName&&"TR"===a.nodeName.toUpperCase()?ma(b,a)[0]:K(b,a)});return this.row(b[0])});var cb=function(a,b){var c=a.context;c.length&&(c=c[0].aoData[b!==k?b:a[0]],c._details&&(c._details.remove(),c._detailsShow=k,c._details=k))},Vb=function(a,b){var c=a.context;if(c.length&&a.length){var e=c[0].aoData[a[0]];if(e._details){(e._detailsShow=b)?e._details.insertAfter(e.nTr):
e._details.detach();var d=c[0],f=new t(d),g=d.aoData;f.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");0<D(g,"_details").length&&(f.on("draw.dt.DT_details",function(a,b){d===b&&f.rows({page:"current"}).eq(0).each(function(a){a=g[a];a._detailsShow&&a._details.insertAfter(a.nTr)})}),f.on("column-visibility.dt.DT_details",function(a,b){if(d===b)for(var c,e=aa(b),f=0,h=g.length;f<h;f++)c=g[f],c._details&&c._details.children("td[colspan]").attr("colspan",e)}),f.on("destroy.dt.DT_details",
function(a,b){if(d===b)for(var c=0,e=g.length;c<e;c++)g[c]._details&&cb(f,c)}))}}};r("row().child()",function(a,b){var c=this.context;if(a===k)return c.length&&this.length?c[0].aoData[this[0]]._details:k;if(!0===a)this.child.show();else if(!1===a)cb(this);else if(c.length&&this.length){var e=c[0],c=c[0].aoData[this[0]],d=[],f=function(a,b){if(h.isArray(a)||a instanceof h)for(var c=0,k=a.length;c<k;c++)f(a[c],b);else a.nodeName&&"tr"===a.nodeName.toLowerCase()?d.push(a):(c=h("<tr><td/></tr>").addClass(b),
h("td",c).addClass(b).html(a)[0].colSpan=aa(e),d.push(c[0]))};f(a,b);c._details&&c._details.remove();c._details=h(d);c._detailsShow&&c._details.insertAfter(c.nTr)}return this});r(["row().child.show()","row().child().show()"],function(){Vb(this,!0);return this});r(["row().child.hide()","row().child().hide()"],function(){Vb(this,!1);return this});r(["row().child.remove()","row().child().remove()"],function(){cb(this);return this});r("row().child.isShown()",function(){var a=this.context;return a.length&&
this.length?a[0].aoData[this[0]]._detailsShow||!1:!1});var dc=/^(.+):(name|visIdx|visible)$/,Wb=function(a,b,c,e,d){for(var c=[],e=0,f=d.length;e<f;e++)c.push(x(a,d[e],b));return c};r("columns()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=ab(b),c=this.iterator("table",function(c){var d=a,f=b,g=c.aoColumns,j=D(g,"sName"),i=D(g,"nTh");return $a("column",d,function(a){var b=Pb(a);if(a==="")return V(g.length);if(b!==null)return[b>=0?b:g.length+b];if(typeof a==="function"){var d=Ca(c,
f);return h.map(g,function(b,f){return a(f,Wb(c,f,0,0,d),i[f])?f:null})}var k=typeof a==="string"?a.match(dc):"";if(k)switch(k[2]){case "visIdx":case "visible":b=parseInt(k[1],10);if(b<0){var m=h.map(g,function(a,b){return a.bVisible?b:null});return[m[m.length+b]]}return[la(c,b)];case "name":return h.map(j,function(a,b){return a===k[1]?b:null})}else return h(i).filter(a).map(function(){return h.inArray(this,i)}).toArray()},c,f)},1);c.selector.cols=a;c.selector.opts=b;return c});v("columns().header()",
"column().header()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTh},1)});v("columns().footer()","column().footer()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTf},1)});v("columns().data()","column().data()",function(){return this.iterator("column-rows",Wb,1)});v("columns().dataSrc()","column().dataSrc()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].mData},1)});v("columns().cache()","column().cache()",
function(a){return this.iterator("column-rows",function(b,c,e,d,f){return ia(b.aoData,f,"search"===a?"_aFilterData":"_aSortData",c)},1)});v("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(a,b,c,e,d){return ia(a.aoData,d,"anCells",b)},1)});v("columns().visible()","column().visible()",function(a,b){return this.iterator("column",function(c,e){if(a===k)return c.aoColumns[e].bVisible;var d=c.aoColumns,f=d[e],g=c.aoData,j,i,m;if(a!==k&&f.bVisible!==a){if(a){var l=
h.inArray(!0,D(d,"bVisible"),e+1);j=0;for(i=g.length;j<i;j++)m=g[j].nTr,d=g[j].anCells,m&&m.insertBefore(d[e],d[l]||null)}else h(D(c.aoData,"anCells",e)).detach();f.bVisible=a;ea(c,c.aoHeader);ea(c,c.aoFooter);if(b===k||b)X(c),(c.oScroll.sX||c.oScroll.sY)&&Y(c);w(c,null,"column-visibility",[c,e,a]);ya(c)}})});v("columns().indexes()","column().index()",function(a){return this.iterator("column",function(b,c){return"visible"===a?$(b,c):c},1)});r("columns.adjust()",function(){return this.iterator("table",
function(a){X(a)},1)});r("column.index()",function(a,b){if(0!==this.context.length){var c=this.context[0];if("fromVisible"===a||"toData"===a)return la(c,b);if("fromData"===a||"toVisible"===a)return $(c,b)}});r("column()",function(a,b){return bb(this.columns(a,b))});r("cells()",function(a,b,c){h.isPlainObject(a)&&(a.row===k?(c=a,a=null):(c=b,b=null));h.isPlainObject(b)&&(c=b,b=null);if(null===b||b===k)return this.iterator("table",function(b){var d=a,e=ab(c),f=b.aoData,g=Ca(b,e),i=Sb(ia(f,g,"anCells")),
j=h([].concat.apply([],i)),l,m=b.aoColumns.length,o,r,t,s,u,v;return $a("cell",d,function(a){var c=typeof a==="function";if(a===null||a===k||c){o=[];r=0;for(t=g.length;r<t;r++){l=g[r];for(s=0;s<m;s++){u={row:l,column:s};if(c){v=b.aoData[l];a(u,x(b,l,s),v.anCells?v.anCells[s]:null)&&o.push(u)}else o.push(u)}}return o}return h.isPlainObject(a)?[a]:j.filter(a).map(function(a,b){l=b.parentNode._DT_RowIndex;return{row:l,column:h.inArray(b,f[l].anCells)}}).toArray()},b,e)});var e=this.columns(b,c),d=this.rows(a,
c),f,g,j,i,m,l=this.iterator("table",function(a,b){f=[];g=0;for(j=d[b].length;g<j;g++){i=0;for(m=e[b].length;i<m;i++)f.push({row:d[b][g],column:e[b][i]})}return f},1);h.extend(l.selector,{cols:b,rows:a,opts:c});return l});v("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(a,b,c){return(a=a.aoData[b].anCells)?a[c]:k},1)});r("cells().data()",function(){return this.iterator("cell",function(a,b,c){return x(a,b,c)},1)});v("cells().cache()","cell().cache()",function(a){a=
"search"===a?"_aFilterData":"_aSortData";return this.iterator("cell",function(b,c,e){return b.aoData[c][a][e]},1)});v("cells().render()","cell().render()",function(a){return this.iterator("cell",function(b,c,e){return x(b,c,e,a)},1)});v("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(a,b,c){return{row:b,column:c,columnVisible:$(a,c)}},1)});v("cells().invalidate()","cell().invalidate()",function(a){return this.iterator("cell",function(b,c,e){ca(b,c,a,e)})});r("cell()",
function(a,b,c){return bb(this.cells(a,b,c))});r("cell().data()",function(a){var b=this.context,c=this[0];if(a===k)return b.length&&c.length?x(b[0],c[0].row,c[0].column):k;Ia(b[0],c[0].row,c[0].column,a);ca(b[0],c[0].row,"data",c[0].column);return this});r("order()",function(a,b){var c=this.context;if(a===k)return 0!==c.length?c[0].aaSorting:k;"number"===typeof a?a=[[a,b]]:h.isArray(a[0])||(a=Array.prototype.slice.call(arguments));return this.iterator("table",function(b){b.aaSorting=a.slice()})});
r("order.listener()",function(a,b,c){return this.iterator("table",function(e){Oa(e,a,b,c)})});r(["columns().order()","column().order()"],function(a){var b=this;return this.iterator("table",function(c,e){var d=[];h.each(b[e],function(b,c){d.push([c,a])});c.aaSorting=d})});r("search()",function(a,b,c,e){var d=this.context;return a===k?0!==d.length?d[0].oPreviousSearch.sSearch:k:this.iterator("table",function(d){d.oFeatures.bFilter&&fa(d,h.extend({},d.oPreviousSearch,{sSearch:a+"",bRegex:null===b?!1:
b,bSmart:null===c?!0:c,bCaseInsensitive:null===e?!0:e}),1)})});v("columns().search()","column().search()",function(a,b,c,e){return this.iterator("column",function(d,f){var g=d.aoPreSearchCols;if(a===k)return g[f].sSearch;d.oFeatures.bFilter&&(h.extend(g[f],{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===e?!0:e}),fa(d,d.oPreviousSearch,1))})});r("state()",function(){return this.context.length?this.context[0].oSavedState:null});r("state.clear()",function(){return this.iterator("table",
function(a){a.fnStateSaveCallback.call(a.oInstance,a,{})})});r("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null});r("state.save()",function(){return this.iterator("table",function(a){ya(a)})});m.versionCheck=m.fnVersionCheck=function(a){for(var b=m.version.split("."),a=a.split("."),c,e,d=0,f=a.length;d<f;d++)if(c=parseInt(b[d],10)||0,e=parseInt(a[d],10)||0,c!==e)return c>e;return!0};m.isDataTable=m.fnIsDataTable=function(a){var b=h(a).get(0),c=!1;h.each(m.settings,
function(a,d){var f=d.nScrollHead?h("table",d.nScrollHead)[0]:null,g=d.nScrollFoot?h("table",d.nScrollFoot)[0]:null;if(d.nTable===b||f===b||g===b)c=!0});return c};m.tables=m.fnTables=function(a){return h.map(m.settings,function(b){if(!a||a&&h(b.nTable).is(":visible"))return b.nTable})};m.util={throttle:ua,escapeRegex:va};m.camelToHungarian=H;r("$()",function(a,b){var c=this.rows(b).nodes(),c=h(c);return h([].concat(c.filter(a).toArray(),c.find(a).toArray()))});h.each(["on","one","off"],function(a,
b){r(b+"()",function(){var a=Array.prototype.slice.call(arguments);a[0].match(/\.dt\b/)||(a[0]+=".dt");var e=h(this.tables().nodes());e[b].apply(e,a);return this})});r("clear()",function(){return this.iterator("table",function(a){oa(a)})});r("settings()",function(){return new t(this.context,this.context)});r("init()",function(){var a=this.context;return a.length?a[0].oInit:null});r("data()",function(){return this.iterator("table",function(a){return D(a.aoData,"_aData")}).flatten()});r("destroy()",
function(a){a=a||!1;return this.iterator("table",function(b){var c=b.nTableWrapper.parentNode,e=b.oClasses,d=b.nTable,f=b.nTBody,g=b.nTHead,j=b.nTFoot,i=h(d),f=h(f),k=h(b.nTableWrapper),l=h.map(b.aoData,function(a){return a.nTr}),q;b.bDestroying=!0;w(b,"aoDestroyCallback","destroy",[b]);a||(new t(b)).columns().visible(!0);k.unbind(".DT").find(":not(tbody *)").unbind(".DT");h(Ea).unbind(".DT-"+b.sInstance);d!=g.parentNode&&(i.children("thead").detach(),i.append(g));j&&d!=j.parentNode&&(i.children("tfoot").detach(),
i.append(j));i.detach();k.detach();b.aaSorting=[];b.aaSortingFixed=[];xa(b);h(l).removeClass(b.asStripeClasses.join(" "));h("th, td",g).removeClass(e.sSortable+" "+e.sSortableAsc+" "+e.sSortableDesc+" "+e.sSortableNone);b.bJUI&&(h("th span."+e.sSortIcon+", td span."+e.sSortIcon,g).detach(),h("th, td",g).each(function(){var a=h("div."+e.sSortJUIWrapper,this);h(this).append(a.contents());a.detach()}));!a&&c&&c.insertBefore(d,b.nTableReinsertBefore);f.children().detach();f.append(l);i.css("width",b.sDestroyWidth).removeClass(e.sTable);
(q=b.asDestroyStripes.length)&&f.children().each(function(a){h(this).addClass(b.asDestroyStripes[a%q])});c=h.inArray(b,m.settings);-1!==c&&m.settings.splice(c,1)})});h.each(["column","row","cell"],function(a,b){r(b+"s().every()",function(a){return this.iterator(b,function(e,d,f){a.call((new t(e))[b](d,f))})})});r("i18n()",function(a,b,c){var e=this.context[0],a=R(a)(e.oLanguage);a===k&&(a=b);c!==k&&h.isPlainObject(a)&&(a=a[c]!==k?a[c]:a._);return a.replace("%d",c)});m.version="1.10.7";m.settings=
[];m.models={};m.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0};m.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null};m.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",
sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null};m.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bJQueryUI:!1,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,
fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(a){return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(a){try{return JSON.parse((-1===a.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+a.sInstance+"_"+location.pathname))}catch(b){}},fnStateLoadParams:null,
fnStateLoaded:null,fnStateSaveCallback:function(a,b){try{(-1===a.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+a.sInstance+"_"+location.pathname,JSON.stringify(b))}catch(c){}},fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",sSortDescending:": activate to sort column descending"},oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},
sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"Processing...",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},oSearch:h.extend({},m.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",searchDelay:null,
sPaginationType:"simple_numbers",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null};W(m.defaults);m.defaults.column={aDataSort:null,iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null};W(m.defaults.column);m.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,
bInfo:null,bLengthChange:null,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],
sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,searchDelay:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,
bAjaxDataGet:!0,jqXHR:null,json:k,oAjaxData:k,fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,bJUI:null,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==B(this)?1*this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==B(this)?1*this._iRecordsDisplay:
this.aiDisplay.length},fnDisplayEnd:function(){var a=this._iDisplayLength,b=this._iDisplayStart,c=b+a,e=this.aiDisplay.length,d=this.oFeatures,f=d.bPaginate;return d.bServerSide?!1===f||-1===a?b+e:Math.min(b+a,this._iRecordsDisplay):!f||c>e||-1===a?e:c},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{}};m.ext=u={buttons:{},classes:{},errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},
header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:m.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:m.version};h.extend(u,{afnFiltering:u.search,aTypes:u.type.detect,ofnSearch:u.type.search,oSort:u.type.order,afnSortData:u.order,aoFeatures:u.feature,oApi:u.internal,oStdClasses:u.classes,oPagination:u.pager});h.extend(m.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",sPageButtonDisabled:"disabled",sStripeOdd:"odd",
sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",sSortable:"sorting",sSortableAsc:"sorting_asc_disabled",sSortableDesc:"sorting_desc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",
sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""});var Da="",Da="",F=Da+"ui-state-default",ja=Da+"css_right ui-icon ui-icon-",Xb=Da+"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix";h.extend(m.ext.oJUIClasses,
m.ext.classes,{sPageButton:"fg-button ui-button "+F,sPageButtonActive:"ui-state-disabled",sPageButtonDisabled:"ui-state-disabled",sPaging:"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",sSortAsc:F+" sorting_asc",sSortDesc:F+" sorting_desc",sSortable:F+" sorting",sSortableAsc:F+" sorting_asc_disabled",sSortableDesc:F+" sorting_desc_disabled",sSortableNone:F+" sorting_disabled",sSortJUIAsc:ja+"triangle-1-n",sSortJUIDesc:ja+"triangle-1-s",sSortJUI:ja+"carat-2-n-s",
sSortJUIAscAllowed:ja+"carat-1-n",sSortJUIDescAllowed:ja+"carat-1-s",sSortJUIWrapper:"DataTables_sort_wrapper",sSortIcon:"DataTables_sort_icon",sScrollHead:"dataTables_scrollHead "+F,sScrollFoot:"dataTables_scrollFoot "+F,sHeaderTH:F,sFooterTH:F,sJUIHeader:Xb+" ui-corner-tl ui-corner-tr",sJUIFooter:Xb+" ui-corner-bl ui-corner-br"});var Mb=m.ext.pager;h.extend(Mb,{simple:function(){return["previous","next"]},full:function(){return["first","previous","next","last"]},simple_numbers:function(a,b){return["previous",
Wa(a,b),"next"]},full_numbers:function(a,b){return["first","previous",Wa(a,b),"next","last"]},_numbers:Wa,numbers_length:7});h.extend(!0,m.ext.renderer,{pageButton:{_:function(a,b,c,e,d,f){var g=a.oClasses,j=a.oLanguage.oPaginate,i,k,l=0,m=function(b,e){var n,r,t,s,u=function(b){Ta(a,b.data.action,true)};n=0;for(r=e.length;n<r;n++){s=e[n];if(h.isArray(s)){t=h("<"+(s.DT_el||"div")+"/>").appendTo(b);m(t,s)}else{k=i="";switch(s){case "ellipsis":b.append('<span class="ellipsis">&#x2026;</span>');break;
case "first":i=j.sFirst;k=s+(d>0?"":" "+g.sPageButtonDisabled);break;case "previous":i=j.sPrevious;k=s+(d>0?"":" "+g.sPageButtonDisabled);break;case "next":i=j.sNext;k=s+(d<f-1?"":" "+g.sPageButtonDisabled);break;case "last":i=j.sLast;k=s+(d<f-1?"":" "+g.sPageButtonDisabled);break;default:i=s+1;k=d===s?g.sPageButtonActive:""}if(i){t=h("<a>",{"class":g.sPageButton+" "+k,"aria-controls":a.sTableId,"data-dt-idx":l,tabindex:a.iTabIndex,id:c===0&&typeof s==="string"?a.sTableId+"_"+s:null}).html(i).appendTo(b);
Va(t,{action:s},u);l++}}}},n;try{n=h(Q.activeElement).data("dt-idx")}catch(r){}m(h(b).empty(),e);n&&h(b).find("[data-dt-idx="+n+"]").focus()}}});h.extend(m.ext.type.detect,[function(a,b){var c=b.oLanguage.sDecimal;return Za(a,c)?"num"+c:null},function(a){if(a&&!(a instanceof Date)&&(!ac.test(a)||!bc.test(a)))return null;var b=Date.parse(a);return null!==b&&!isNaN(b)||J(a)?"date":null},function(a,b){var c=b.oLanguage.sDecimal;return Za(a,c,!0)?"num-fmt"+c:null},function(a,b){var c=b.oLanguage.sDecimal;
return Rb(a,c)?"html-num"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Rb(a,c,!0)?"html-num-fmt"+c:null},function(a){return J(a)||"string"===typeof a&&-1!==a.indexOf("<")?"html":null}]);h.extend(m.ext.type.search,{html:function(a){return J(a)?a:"string"===typeof a?a.replace(Ob," ").replace(Ba,""):""},string:function(a){return J(a)?a:"string"===typeof a?a.replace(Ob," "):a}});var Aa=function(a,b,c,e){if(0!==a&&(!a||"-"===a))return-Infinity;b&&(a=Qb(a,b));a.replace&&(c&&(a=a.replace(c,"")),
e&&(a=a.replace(e,"")));return 1*a};h.extend(u.type.order,{"date-pre":function(a){return Date.parse(a)||0},"html-pre":function(a){return J(a)?"":a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+""},"string-pre":function(a){return J(a)?"":"string"===typeof a?a.toLowerCase():!a.toString?"":a.toString()},"string-asc":function(a,b){return a<b?-1:a>b?1:0},"string-desc":function(a,b){return a<b?1:a>b?-1:0}});db("");h.extend(!0,m.ext.renderer,{header:{_:function(a,b,c,e){h(a.nTable).on("order.dt.DT",function(d,
f,g,h){if(a===f){d=c.idx;b.removeClass(c.sSortingClass+" "+e.sSortAsc+" "+e.sSortDesc).addClass(h[d]=="asc"?e.sSortAsc:h[d]=="desc"?e.sSortDesc:c.sSortingClass)}})},jqueryui:function(a,b,c,e){h("<div/>").addClass(e.sSortJUIWrapper).append(b.contents()).append(h("<span/>").addClass(e.sSortIcon+" "+c.sSortingClassJUI)).appendTo(b);h(a.nTable).on("order.dt.DT",function(d,f,g,h){if(a===f){d=c.idx;b.removeClass(e.sSortAsc+" "+e.sSortDesc).addClass(h[d]=="asc"?e.sSortAsc:h[d]=="desc"?e.sSortDesc:c.sSortingClass);
b.find("span."+e.sSortIcon).removeClass(e.sSortJUIAsc+" "+e.sSortJUIDesc+" "+e.sSortJUI+" "+e.sSortJUIAscAllowed+" "+e.sSortJUIDescAllowed).addClass(h[d]=="asc"?e.sSortJUIAsc:h[d]=="desc"?e.sSortJUIDesc:c.sSortingClassJUI)}})}}});m.render={number:function(a,b,c,e){return{display:function(d){if("number"!==typeof d&&"string"!==typeof d)return d;var f=0>d?"-":"",d=Math.abs(parseFloat(d)),g=parseInt(d,10),d=c?b+(d-g).toFixed(c).substring(2):"";return f+(e||"")+g.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
a)+d}}}};h.extend(m.ext.internal,{_fnExternApiFunc:Nb,_fnBuildAjax:ra,_fnAjaxUpdate:kb,_fnAjaxParameters:tb,_fnAjaxUpdateDraw:ub,_fnAjaxDataSrc:sa,_fnAddColumn:Fa,_fnColumnOptions:ka,_fnAdjustColumnSizing:X,_fnVisibleToColumnIndex:la,_fnColumnIndexToVisible:$,_fnVisbleColumns:aa,_fnGetColumns:Z,_fnColumnTypes:Ha,_fnApplyColumnDefs:ib,_fnHungarianMap:W,_fnCamelToHungarian:H,_fnLanguageCompat:P,_fnBrowserDetect:gb,_fnAddData:K,_fnAddTr:ma,_fnNodeToDataIndex:function(a,b){return b._DT_RowIndex!==k?b._DT_RowIndex:
null},_fnNodeToColumnIndex:function(a,b,c){return h.inArray(c,a.aoData[b].anCells)},_fnGetCellData:x,_fnSetCellData:Ia,_fnSplitObjNotation:Ka,_fnGetObjectDataFn:R,_fnSetObjectDataFn:S,_fnGetDataMaster:La,_fnClearTable:oa,_fnDeleteIndex:pa,_fnInvalidate:ca,_fnGetRowElements:na,_fnCreateTr:Ja,_fnBuildHead:jb,_fnDrawHead:ea,_fnDraw:M,_fnReDraw:N,_fnAddOptionsHtml:mb,_fnDetectHeader:da,_fnGetUniqueThs:qa,_fnFeatureHtmlFilter:ob,_fnFilterComplete:fa,_fnFilterCustom:xb,_fnFilterColumn:wb,_fnFilter:vb,_fnFilterCreateSearch:Qa,
_fnEscapeRegex:va,_fnFilterData:yb,_fnFeatureHtmlInfo:rb,_fnUpdateInfo:Bb,_fnInfoMacros:Cb,_fnInitialise:ga,_fnInitComplete:ta,_fnLengthChange:Ra,_fnFeatureHtmlLength:nb,_fnFeatureHtmlPaginate:sb,_fnPageChange:Ta,_fnFeatureHtmlProcessing:pb,_fnProcessingDisplay:C,_fnFeatureHtmlTable:qb,_fnScrollDraw:Y,_fnApplyToChildren:G,_fnCalculateColumnWidths:Ga,_fnThrottle:ua,_fnConvertToWidth:Db,_fnScrollingWidthAdjust:Fb,_fnGetWidestNode:Eb,_fnGetMaxLenString:Gb,_fnStringToCss:s,_fnScrollBarWidth:Hb,_fnSortFlatten:U,
_fnSort:lb,_fnSortAria:Jb,_fnSortListener:Ua,_fnSortAttachListener:Oa,_fnSortingClasses:xa,_fnSortData:Ib,_fnSaveState:ya,_fnLoadState:Kb,_fnSettingsFromNode:za,_fnLog:I,_fnMap:E,_fnBindAction:Va,_fnCallbackReg:z,_fnCallbackFire:w,_fnLengthOverflow:Sa,_fnRenderer:Pa,_fnDataSource:B,_fnRowAttributes:Ma,_fnCalculateEnd:function(){}});h.fn.dataTable=m;h.fn.dataTableSettings=m.settings;h.fn.dataTableExt=m.ext;h.fn.DataTable=function(a){return h(this).dataTable(a).api()};h.each(m,function(a,b){h.fn.DataTable[a]=
b});return h.fn.dataTable};"function"===typeof define&&define.amd?define("datatables",["jquery"],P):"object"===typeof exports?module.exports=P(require("jquery")):jQuery&&!jQuery.fn.dataTable&&P(jQuery)})(window,document);

/*!
 Buttons for DataTables 1.2.3
 ©2016 SpryMedia Ltd - datatables.net/license
*/
(function(d){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(n){return d(n,window,document)}):"object"===typeof exports?module.exports=function(n,o){n||(n=window);if(!o||!o.fn.dataTable)o=require("datatables.net")(n,o).$;return d(o,n,n.document)}:d(jQuery,window,document)})(function(d,n,o,m){var i=d.fn.dataTable,u=0,v=0,j=i.ext.buttons,l=function(a,b){!0===b&&(b={});d.isArray(b)&&(b={buttons:b});this.c=d.extend(!0,{},l.defaults,b);b.buttons&&(this.c.buttons=b.buttons);
this.s={dt:new i.Api(a),buttons:[],listenKeys:"",namespace:"dtb"+u++};this.dom={container:d("<"+this.c.dom.container.tag+"/>").addClass(this.c.dom.container.className)};this._constructor()};d.extend(l.prototype,{action:function(a,b){var c=this._nodeToButton(a);if(b===m)return c.conf.action;c.conf.action=b;return this},active:function(a,b){var c=this._nodeToButton(a),e=this.c.dom.button.active,c=d(c.node);if(b===m)return c.hasClass(e);c.toggleClass(e,b===m?!0:b);return this},add:function(a,b){var c=
this.s.buttons;if("string"===typeof b){for(var e=b.split("-"),c=this.s,d=0,h=e.length-1;d<h;d++)c=c.buttons[1*e[d]];c=c.buttons;b=1*e[e.length-1]}this._expandButton(c,a,!1,b);this._draw();return this},container:function(){return this.dom.container},disable:function(a){a=this._nodeToButton(a);d(a.node).addClass(this.c.dom.button.disabled);return this},destroy:function(){d("body").off("keyup."+this.s.namespace);var a=this.s.buttons.slice(),b,c;b=0;for(c=a.length;b<c;b++)this.remove(a[b].node);this.dom.container.remove();
a=this.s.dt.settings()[0];b=0;for(c=a.length;b<c;b++)if(a.inst===this){a.splice(b,1);break}return this},enable:function(a,b){if(!1===b)return this.disable(a);var c=this._nodeToButton(a);d(c.node).removeClass(this.c.dom.button.disabled);return this},name:function(){return this.c.name},node:function(a){a=this._nodeToButton(a);return d(a.node)},remove:function(a){var b=this._nodeToButton(a),c=this._nodeToHost(a),e=this.s.dt;if(b.buttons.length)for(var g=b.buttons.length-1;0<=g;g--)this.remove(b.buttons[g].node);
b.conf.destroy&&b.conf.destroy.call(e.button(a),e,d(a),b.conf);this._removeKey(b.conf);d(b.node).remove();a=d.inArray(b,c);c.splice(a,1);return this},text:function(a,b){var c=this._nodeToButton(a),e=this.c.dom.collection.buttonLiner,e=c.inCollection&&e&&e.tag?e.tag:this.c.dom.buttonLiner.tag,g=this.s.dt,h=d(c.node),f=function(a){return"function"===typeof a?a(g,h,c.conf):a};if(b===m)return f(c.conf.text);c.conf.text=b;e?h.children(e).html(f(b)):h.html(f(b));return this},_constructor:function(){var a=
this,b=this.s.dt,c=b.settings()[0],e=this.c.buttons;c._buttons||(c._buttons=[]);c._buttons.push({inst:this,name:this.c.name});for(var c=0,g=e.length;c<g;c++)this.add(e[c]);b.on("destroy",function(){a.destroy()});d("body").on("keyup."+this.s.namespace,function(b){if(!o.activeElement||o.activeElement===o.body){var c=String.fromCharCode(b.keyCode).toLowerCase();a.s.listenKeys.toLowerCase().indexOf(c)!==-1&&a._keypress(c,b)}})},_addKey:function(a){a.key&&(this.s.listenKeys+=d.isPlainObject(a.key)?a.key.key:
a.key)},_draw:function(a,b){a||(a=this.dom.container,b=this.s.buttons);a.children().detach();for(var c=0,e=b.length;c<e;c++)a.append(b[c].inserter),b[c].buttons&&b[c].buttons.length&&this._draw(b[c].collection,b[c].buttons)},_expandButton:function(a,b,c,e){for(var g=this.s.dt,h=0,b=!d.isArray(b)?[b]:b,f=0,r=b.length;f<r;f++){var k=this._resolveExtends(b[f]);if(k)if(d.isArray(k))this._expandButton(a,k,c,e);else{var p=this._buildButton(k,c);if(p){e!==m?(a.splice(e,0,p),e++):a.push(p);if(p.conf.buttons){var s=
this.c.dom.collection;p.collection=d("<"+s.tag+"/>").addClass(s.className);p.conf._collection=p.collection;this._expandButton(p.buttons,p.conf.buttons,!0,e)}k.init&&k.init.call(g.button(p.node),g,d(p.node),k);h++}}}},_buildButton:function(a,b){var c=this.c.dom.button,e=this.c.dom.buttonLiner,g=this.c.dom.collection,h=this.s.dt,f=function(b){return"function"===typeof b?b(h,k,a):b};b&&g.button&&(c=g.button);b&&g.buttonLiner&&(e=g.buttonLiner);if(a.available&&!a.available(h,a))return!1;var r=function(a,
b,c,e){e.action.call(b.button(c),a,b,c,e);d(b.table().node()).triggerHandler("buttons-action.dt",[b.button(c),b,c,e])},k=d("<"+c.tag+"/>").addClass(c.className).attr("tabindex",this.s.dt.settings()[0].iTabIndex).attr("aria-controls",this.s.dt.table().node().id).on("click.dtb",function(b){b.preventDefault();!k.hasClass(c.disabled)&&a.action&&r(b,h,k,a);k.blur()}).on("keyup.dtb",function(b){b.keyCode===13&&!k.hasClass(c.disabled)&&a.action&&r(b,h,k,a)});"a"===c.tag.toLowerCase()&&k.attr("href","#");
e.tag?(g=d("<"+e.tag+"/>").html(f(a.text)).addClass(e.className),"a"===e.tag.toLowerCase()&&g.attr("href","#"),k.append(g)):k.html(f(a.text));!1===a.enabled&&k.addClass(c.disabled);a.className&&k.addClass(a.className);a.titleAttr&&k.attr("title",a.titleAttr);a.namespace||(a.namespace=".dt-button-"+v++);e=(e=this.c.dom.buttonContainer)&&e.tag?d("<"+e.tag+"/>").addClass(e.className).append(k):k;this._addKey(a);return{conf:a,node:k.get(0),inserter:e,buttons:[],inCollection:b,collection:null}},_nodeToButton:function(a,
b){b||(b=this.s.buttons);for(var c=0,e=b.length;c<e;c++){if(b[c].node===a)return b[c];if(b[c].buttons.length){var d=this._nodeToButton(a,b[c].buttons);if(d)return d}}},_nodeToHost:function(a,b){b||(b=this.s.buttons);for(var c=0,e=b.length;c<e;c++){if(b[c].node===a)return b;if(b[c].buttons.length){var d=this._nodeToHost(a,b[c].buttons);if(d)return d}}},_keypress:function(a,b){var c=function(e){for(var g=0,h=e.length;g<h;g++){var f=e[g].conf,r=e[g].node;if(f.key)if(f.key===a)d(r).click();else if(d.isPlainObject(f.key)&&
f.key.key===a&&(!f.key.shiftKey||b.shiftKey))if(!f.key.altKey||b.altKey)if(!f.key.ctrlKey||b.ctrlKey)(!f.key.metaKey||b.metaKey)&&d(r).click();e[g].buttons.length&&c(e[g].buttons)}};c(this.s.buttons)},_removeKey:function(a){if(a.key){var b=d.isPlainObject(a.key)?a.key.key:a.key,a=this.s.listenKeys.split(""),b=d.inArray(b,a);a.splice(b,1);this.s.listenKeys=a.join("")}},_resolveExtends:function(a){for(var b=this.s.dt,c,e,g=function(c){for(var e=0;!d.isPlainObject(c)&&!d.isArray(c);){if(c===m)return;
if("function"===typeof c){if(c=c(b,a),!c)return!1}else if("string"===typeof c){if(!j[c])throw"Unknown button type: "+c;c=j[c]}e++;if(30<e)throw"Buttons: Too many iterations";}return d.isArray(c)?c:d.extend({},c)},a=g(a);a&&a.extend;){if(!j[a.extend])throw"Cannot extend unknown button type: "+a.extend;var h=g(j[a.extend]);if(d.isArray(h))return h;if(!h)return!1;c=h.className;a=d.extend({},h,a);c&&a.className!==c&&(a.className=c+" "+a.className);var f=a.postfixButtons;if(f){a.buttons||(a.buttons=[]);
c=0;for(e=f.length;c<e;c++)a.buttons.push(f[c]);a.postfixButtons=null}if(f=a.prefixButtons){a.buttons||(a.buttons=[]);c=0;for(e=f.length;c<e;c++)a.buttons.splice(c,0,f[c]);a.prefixButtons=null}a.extend=h.extend}return a}});l.background=function(a,b,c){c===m&&(c=400);a?d("<div/>").addClass(b).css("display","none").appendTo("body").fadeIn(c):d("body > div."+b).fadeOut(c,function(){d(this).removeClass(b).remove()})};l.instanceSelector=function(a,b){if(!a)return d.map(b,function(a){return a.inst});var c=
[],e=d.map(b,function(a){return a.name}),g=function(a){if(d.isArray(a))for(var f=0,r=a.length;f<r;f++)g(a[f]);else"string"===typeof a?-1!==a.indexOf(",")?g(a.split(",")):(a=d.inArray(d.trim(a),e),-1!==a&&c.push(b[a].inst)):"number"===typeof a&&c.push(b[a].inst)};g(a);return c};l.buttonSelector=function(a,b){for(var c=[],e=function(a,b,c){for(var d,g,f=0,h=b.length;f<h;f++)if(d=b[f])g=c!==m?c+f:f+"",a.push({node:d.node,name:d.conf.name,idx:g}),d.buttons&&e(a,d.buttons,g+"-")},g=function(a,b){var f,
h,i=[];e(i,b.s.buttons);f=d.map(i,function(a){return a.node});if(d.isArray(a)||a instanceof d){f=0;for(h=a.length;f<h;f++)g(a[f],b)}else if(null===a||a===m||"*"===a){f=0;for(h=i.length;f<h;f++)c.push({inst:b,node:i[f].node})}else if("number"===typeof a)c.push({inst:b,node:b.s.buttons[a].node});else if("string"===typeof a)if(-1!==a.indexOf(",")){i=a.split(",");f=0;for(h=i.length;f<h;f++)g(d.trim(i[f]),b)}else if(a.match(/^\d+(\-\d+)*$/))f=d.map(i,function(a){return a.idx}),c.push({inst:b,node:i[d.inArray(a,
f)].node});else if(-1!==a.indexOf(":name")){var j=a.replace(":name","");f=0;for(h=i.length;f<h;f++)i[f].name===j&&c.push({inst:b,node:i[f].node})}else d(f).filter(a).each(function(){c.push({inst:b,node:this})});else"object"===typeof a&&a.nodeName&&(i=d.inArray(a,f),-1!==i&&c.push({inst:b,node:f[i]}))},h=0,f=a.length;h<f;h++)g(b,a[h]);return c};l.defaults={buttons:["copy","excel","csv","pdf","print"],name:"main",tabIndex:0,dom:{container:{tag:"div",className:"dt-buttons"},collection:{tag:"div",className:"dt-button-collection"},
button:{tag:"a",className:"dt-button",active:"active",disabled:"disabled"},buttonLiner:{tag:"span",className:""}}};l.version="1.2.3";d.extend(j,{collection:{text:function(a){return a.i18n("buttons.collection","Collection")},className:"buttons-collection",action:function(a,b,c,e){var a=c.offset(),g=d(b.table().container()),h=!1;d("div.dt-button-background").length&&(h=d(".dt-button-collection").offset(),d("body").trigger("click.dtb-collection"));e._collection.addClass(e.collectionLayout).css("display",
"none").appendTo("body").fadeIn(e.fade);var f=e._collection.css("position");h&&"absolute"===f?e._collection.css({top:h.top,left:h.left}):"absolute"===f?(e._collection.css({top:a.top+c.outerHeight(),left:a.left}),c=a.left+e._collection.outerWidth(),g=g.offset().left+g.width(),c>g&&e._collection.css("left",a.left-(c-g))):(a=e._collection.height()/2,a>d(n).height()/2&&(a=d(n).height()/2),e._collection.css("marginTop",-1*a));e.background&&l.background(!0,e.backgroundClassName,e.fade);setTimeout(function(){d("div.dt-button-background").on("click.dtb-collection",
function(){});d("body").on("click.dtb-collection",function(a){var c=d.fn.addBack?"addBack":"andSelf";if(!d(a.target).parents()[c]().filter(e._collection).length){e._collection.fadeOut(e.fade,function(){e._collection.detach()});d("div.dt-button-background").off("click.dtb-collection");l.background(false,e.backgroundClassName,e.fade);d("body").off("click.dtb-collection");b.off("buttons-action.b-internal")}})},10);if(e.autoClose)b.on("buttons-action.b-internal",function(){d("div.dt-button-background").click()})},
background:!0,collectionLayout:"",backgroundClassName:"dt-button-background",autoClose:!1,fade:400},copy:function(a,b){if(j.copyHtml5)return"copyHtml5";if(j.copyFlash&&j.copyFlash.available(a,b))return"copyFlash"},csv:function(a,b){if(j.csvHtml5&&j.csvHtml5.available(a,b))return"csvHtml5";if(j.csvFlash&&j.csvFlash.available(a,b))return"csvFlash"},excel:function(a,b){if(j.excelHtml5&&j.excelHtml5.available(a,b))return"excelHtml5";if(j.excelFlash&&j.excelFlash.available(a,b))return"excelFlash"},pdf:function(a,
b){if(j.pdfHtml5&&j.pdfHtml5.available(a,b))return"pdfHtml5";if(j.pdfFlash&&j.pdfFlash.available(a,b))return"pdfFlash"},pageLength:function(a){var a=a.settings()[0].aLengthMenu,b=d.isArray(a[0])?a[0]:a,c=d.isArray(a[0])?a[1]:a,e=function(a){return a.i18n("buttons.pageLength",{"-1":"Show all rows",_:"Show %d rows"},a.page.len())};return{extend:"collection",text:e,className:"buttons-page-length",autoClose:!0,buttons:d.map(b,function(a,b){return{text:c[b],className:"button-page-length",action:function(b,
c){c.page.len(a).draw()},init:function(b,c,e){var d=this,c=function(){d.active(b.page.len()===a)};b.on("length.dt"+e.namespace,c);c()},destroy:function(a,b,c){a.off("length.dt"+c.namespace)}}}),init:function(a,b,c){var d=this;a.on("length.dt"+c.namespace,function(){d.text(e(a))})},destroy:function(a,b,c){a.off("length.dt"+c.namespace)}}}});i.Api.register("buttons()",function(a,b){b===m&&(b=a,a=m);this.selector.buttonGroup=a;var c=this.iterator(!0,"table",function(c){if(c._buttons)return l.buttonSelector(l.instanceSelector(a,
c._buttons),b)},!0);c._groupSelector=a;return c});i.Api.register("button()",function(a,b){var c=this.buttons(a,b);1<c.length&&c.splice(1,c.length);return c});i.Api.registerPlural("buttons().active()","button().active()",function(a){return a===m?this.map(function(a){return a.inst.active(a.node)}):this.each(function(b){b.inst.active(b.node,a)})});i.Api.registerPlural("buttons().action()","button().action()",function(a){return a===m?this.map(function(a){return a.inst.action(a.node)}):this.each(function(b){b.inst.action(b.node,
a)})});i.Api.register(["buttons().enable()","button().enable()"],function(a){return this.each(function(b){b.inst.enable(b.node,a)})});i.Api.register(["buttons().disable()","button().disable()"],function(){return this.each(function(a){a.inst.disable(a.node)})});i.Api.registerPlural("buttons().nodes()","button().node()",function(){var a=d();d(this.each(function(b){a=a.add(b.inst.node(b.node))}));return a});i.Api.registerPlural("buttons().text()","button().text()",function(a){return a===m?this.map(function(a){return a.inst.text(a.node)}):
this.each(function(b){b.inst.text(b.node,a)})});i.Api.registerPlural("buttons().trigger()","button().trigger()",function(){return this.each(function(a){a.inst.node(a.node).trigger("click")})});i.Api.registerPlural("buttons().containers()","buttons().container()",function(){var a=d(),b=this._groupSelector;this.iterator(!0,"table",function(c){if(c._buttons)for(var c=l.instanceSelector(b,c._buttons),d=0,g=c.length;d<g;d++)a=a.add(c[d].container())});return a});i.Api.register("button().add()",function(a,
b){var c=this.context;c.length&&(c=l.instanceSelector(this._groupSelector,c[0]._buttons),c.length&&c[0].add(b,a));return this.button(this._groupSelector,a)});i.Api.register("buttons().destroy()",function(){this.pluck("inst").unique().each(function(a){a.destroy()});return this});i.Api.registerPlural("buttons().remove()","buttons().remove()",function(){this.each(function(a){a.inst.remove(a.node)});return this});var q;i.Api.register("buttons.info()",function(a,b,c){var e=this;if(!1===a)return d("#datatables_buttons_info").fadeOut(function(){d(this).remove()}),
clearTimeout(q),q=null,this;q&&clearTimeout(q);d("#datatables_buttons_info").length&&d("#datatables_buttons_info").remove();d('<div id="datatables_buttons_info" class="dt-button-info"/>').html(a?"<h2>"+a+"</h2>":"").append(d("<div/>")["string"===typeof b?"html":"append"](b)).css("display","none").appendTo("body").fadeIn();c!==m&&0!==c&&(q=setTimeout(function(){e.buttons.info(!1)},c));return this});i.Api.register("buttons.exportData()",function(a){if(this.context.length){for(var b=new i.Api(this.context[0]),
c=d.extend(!0,{},{rows:null,columns:"",modifier:{search:"applied",order:"applied"},orthogonal:"display",stripHtml:!0,stripNewlines:!0,decodeEntities:!0,trim:!0,format:{header:function(a){return e(a)},footer:function(a){return e(a)},body:function(a){return e(a)}}},a),e=function(a){if("string"!==typeof a)return a;c.stripHtml&&(a=a.replace(/<[^>]*>/g,""));c.trim&&(a=a.replace(/^\s+|\s+$/g,""));c.stripNewlines&&(a=a.replace(/\n/g," "));c.decodeEntities&&(t.innerHTML=a,a=t.value);return a},a=b.columns(c.columns).indexes().map(function(a){var d=
b.column(a).header();return c.format.header(d.innerHTML,a,d)}).toArray(),g=b.table().footer()?b.columns(c.columns).indexes().map(function(a){var d=b.column(a).footer();return c.format.footer(d?d.innerHTML:"",a,d)}).toArray():null,h=b.cells(c.rows,c.columns,c.modifier),f=h.render(c.orthogonal).toArray(),h=h.nodes().toArray(),j=a.length,k=0<j?f.length/j:0,l=Array(k),m=0,n=0;n<k;n++){for(var o=Array(j),q=0;q<j;q++)o[q]=c.format.body(f[m],n,q,h[m]),m++;l[n]=o}return{header:a,footer:g,body:l}}});var t=
d("<textarea/>")[0];d.fn.dataTable.Buttons=l;d.fn.DataTable.Buttons=l;d(o).on("init.dt plugin-init.dt",function(a,b){if("dt"===a.namespace){var c=b.oInit.buttons||i.defaults.buttons;c&&!b._buttons&&(new l(b,c)).container()}});i.ext.feature.push({fnInit:function(a){var a=new i.Api(a),b=a.init().buttons||i.defaults.buttons;return(new l(a,b)).container()},cFeature:"B"});return l});

(function(g){"function"===typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(d){return g(d,window,document)}):"object"===typeof exports?module.exports=function(d,e){d||(d=window);if(!e||!e.fn.dataTable)e=require("datatables.net")(d,e).$;e.fn.dataTable.Buttons||require("datatables.net-buttons")(d,e);return g(e,d,d.document)}:g(jQuery,window,document)})(function(g,d,e,h){d=g.fn.dataTable;g.extend(d.ext.buttons,{colvis:function(a,b){return{extend:"collection",
text:function(a){return a.i18n("buttons.colvis","Column visibility")},className:"buttons-colvis",buttons:[{extend:"columnsToggle",columns:b.columns}]}},columnsToggle:function(a,b){return a.columns(b.columns).indexes().map(function(a){return{extend:"columnToggle",columns:a}}).toArray()},columnToggle:function(a,b){return{extend:"columnVisibility",columns:b.columns}},columnsVisibility:function(a,b){return a.columns(b.columns).indexes().map(function(a){return{extend:"columnVisibility",columns:a,visibility:b.visibility}}).toArray()},
columnVisibility:{columns:h,text:function(a,b,c){return c._columnText(a,c.columns)},className:"buttons-columnVisibility",action:function(a,b,c,f){a=b.columns(f.columns);b=a.visible();a.visible(f.visibility!==h?f.visibility:!(b.length&&b[0]))},init:function(a,b,c){var f=this;a.on("column-visibility.dt"+c.namespace,function(b,d){d.bDestroying||f.active(a.column(c.columns).visible())}).on("column-reorder.dt"+c.namespace,function(b,d,e){1===a.columns(c.columns).count()&&("number"===typeof c.columns&&
(c.columns=e.mapping[c.columns]),b=a.column(c.columns),f.text(c._columnText(a,c.columns)),f.active(b.visible()))});this.active(a.column(c.columns).visible())},destroy:function(a,b,c){a.off("column-visibility.dt"+c.namespace).off("column-reorder.dt"+c.namespace)},_columnText:function(a,b){var c=a.column(b).index();return a.settings()[0].aoColumns[c].sTitle.replace(/\n/g," ").replace(/<.*?>/g,"").replace(/^\s+|\s+$/g,"")}},colvisRestore:{className:"buttons-colvisRestore",text:function(a){return a.i18n("buttons.colvisRestore",
"Restore visibility")},init:function(a,b,c){c._visOriginal=a.columns().indexes().map(function(b){return a.column(b).visible()}).toArray()},action:function(a,b,c,d){b.columns().every(function(a){a=b.colReorder&&b.colReorder.transpose?b.colReorder.transpose(a,"toOriginal"):a;this.visible(d._visOriginal[a])})}},colvisGroup:{className:"buttons-colvisGroup",action:function(a,b,c,d){b.columns(d.show).visible(!0,!1);b.columns(d.hide).visible(!1,!1);b.columns.adjust()},show:[],hide:[]}});return d.Buttons});

/**
* @license Input Mask plugin for jquery
* http://github.com/RobinHerbots/jquery.inputmask
* Copyright (c) 2010 - 2014 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 0.0.0
*/

(function ($) {
    if ($.fn.inputmask === undefined) {
        //helper functions    
        function isInputEventSupported(eventName) {
            var el = document.createElement('input'),
            eventName = 'on' + eventName,
            isSupported = (eventName in el);
            if (!isSupported) {
                el.setAttribute(eventName, 'return;');
                isSupported = typeof el[eventName] == 'function';
            }
            el = null;
            return isSupported;
        }
        function resolveAlias(aliasStr, options, opts) {
            var aliasDefinition = opts.aliases[aliasStr];
            if (aliasDefinition) {
                if (aliasDefinition.alias) resolveAlias(aliasDefinition.alias, undefined, opts); //alias is another alias
                $.extend(true, opts, aliasDefinition);  //merge alias definition in the options
                $.extend(true, opts, options);  //reapply extra given options
                return true;
            }
            return false;
        }
        function generateMaskSets(opts) {
            var ms = [];
            var genmasks = []; //used to keep track of the masks that where processed, to avoid duplicates
            function getMaskTemplate(mask) {
                if (opts.numericInput) {
                    mask = mask.split('').reverse().join('');
                }
                var escaped = false, outCount = 0, greedy = opts.greedy, repeat = opts.repeat;
                if (repeat == "*") greedy = false;
                //if (greedy == true && opts.placeholder == "") opts.placeholder = " ";
                if (mask.length == 1 && greedy == false && repeat != 0) { opts.placeholder = ""; } //hide placeholder with single non-greedy mask
                var singleMask = $.map(mask.split(""), function (element, index) {
                    var outElem = [];
                    if (element == opts.escapeChar) {
                        escaped = true;
                    }
                    else if ((element != opts.optionalmarker.start && element != opts.optionalmarker.end) || escaped) {
                        var maskdef = opts.definitions[element];
                        if (maskdef && !escaped) {
                            for (var i = 0; i < maskdef.cardinality; i++) {
                                outElem.push(opts.placeholder.charAt((outCount + i) % opts.placeholder.length));
                            }
                        } else {
                            outElem.push(element);
                            escaped = false;
                        }
                        outCount += outElem.length;
                        return outElem;
                    }
                });

                //allocate repetitions
                var repeatedMask = singleMask.slice();
                for (var i = 1; i < repeat && greedy; i++) {
                    repeatedMask = repeatedMask.concat(singleMask.slice());
                }

                return { "mask": repeatedMask, "repeat": repeat, "greedy": greedy };
            }
            //test definition => {fn: RegExp/function, cardinality: int, optionality: bool, newBlockMarker: bool, offset: int, casing: null/upper/lower, def: definitionSymbol}
            function getTestingChain(mask) {
                if (opts.numericInput) {
                    mask = mask.split('').reverse().join('');
                }
                var isOptional = false, escaped = false;
                var newBlockMarker = false; //indicates wheter the begin/ending of a block should be indicated

                return $.map(mask.split(""), function (element, index) {
                    var outElem = [];

                    if (element == opts.escapeChar) {
                        escaped = true;
                    } else if (element == opts.optionalmarker.start && !escaped) {
                        isOptional = true;
                        newBlockMarker = true;
                    }
                    else if (element == opts.optionalmarker.end && !escaped) {
                        isOptional = false;
                        newBlockMarker = true;
                    }
                    else {
                        var maskdef = opts.definitions[element];
                        if (maskdef && !escaped) {
                            var prevalidators = maskdef["prevalidator"], prevalidatorsL = prevalidators ? prevalidators.length : 0;
                            for (var i = 1; i < maskdef.cardinality; i++) {
                                var prevalidator = prevalidatorsL >= i ? prevalidators[i - 1] : [], validator = prevalidator["validator"], cardinality = prevalidator["cardinality"];
                                outElem.push({ fn: validator ? typeof validator == 'string' ? new RegExp(validator) : new function () { this.test = validator; } : new RegExp("."), cardinality: cardinality ? cardinality : 1, optionality: isOptional, newBlockMarker: isOptional == true ? newBlockMarker : false, offset: 0, casing: maskdef["casing"], def: maskdef["definitionSymbol"] || element });
                                if (isOptional == true) //reset newBlockMarker
                                    newBlockMarker = false;
                            }
                            outElem.push({ fn: maskdef.validator ? typeof maskdef.validator == 'string' ? new RegExp(maskdef.validator) : new function () { this.test = maskdef.validator; } : new RegExp("."), cardinality: maskdef.cardinality, optionality: isOptional, newBlockMarker: newBlockMarker, offset: 0, casing: maskdef["casing"], def: maskdef["definitionSymbol"] || element });
                        } else {
                            outElem.push({ fn: null, cardinality: 0, optionality: isOptional, newBlockMarker: newBlockMarker, offset: 0, casing: null, def: element });
                            escaped = false;
                        }
                        //reset newBlockMarker
                        newBlockMarker = false;
                        return outElem;
                    }
                });
            }
            function markOptional(maskPart) { //needed for the clearOptionalTail functionality
                return opts.optionalmarker.start + maskPart + opts.optionalmarker.end;
            }
            function splitFirstOptionalEndPart(maskPart) {
                var optionalStartMarkers = 0, optionalEndMarkers = 0, mpl = maskPart.length;
                for (var i = 0; i < mpl; i++) {
                    if (maskPart.charAt(i) == opts.optionalmarker.start) {
                        optionalStartMarkers++;
                    }
                    if (maskPart.charAt(i) == opts.optionalmarker.end) {
                        optionalEndMarkers++;
                    }
                    if (optionalStartMarkers > 0 && optionalStartMarkers == optionalEndMarkers)
                        break;
                }
                var maskParts = [maskPart.substring(0, i)];
                if (i < mpl) {
                    maskParts.push(maskPart.substring(i + 1, mpl));
                }
                return maskParts;
            }
            function splitFirstOptionalStartPart(maskPart) {
                var mpl = maskPart.length;
                for (var i = 0; i < mpl; i++) {
                    if (maskPart.charAt(i) == opts.optionalmarker.start) {
                        break;
                    }
                }
                var maskParts = [maskPart.substring(0, i)];
                if (i < mpl) {
                    maskParts.push(maskPart.substring(i + 1, mpl));
                }
                return maskParts;
            }
            function generateMask(maskPrefix, maskPart, metadata) {
                var maskParts = splitFirstOptionalEndPart(maskPart);
                var newMask, maskTemplate;

                var masks = splitFirstOptionalStartPart(maskParts[0]);
                if (masks.length > 1) {
                    newMask = maskPrefix + masks[0] + markOptional(masks[1]) + (maskParts.length > 1 ? maskParts[1] : "");
                    if ($.inArray(newMask, genmasks) == -1 && newMask != "") {
                        genmasks.push(newMask);
                        maskTemplate = getMaskTemplate(newMask);
                        ms.push({
                            "mask": newMask,
                            "_buffer": maskTemplate["mask"],
                            "buffer": maskTemplate["mask"].slice(),
                            "tests": getTestingChain(newMask),
                            "lastValidPosition": -1,
                            "greedy": maskTemplate["greedy"],
                            "repeat": maskTemplate["repeat"],
                            "metadata": metadata
                        });
                    }
                    newMask = maskPrefix + masks[0] + (maskParts.length > 1 ? maskParts[1] : "");
                    if ($.inArray(newMask, genmasks) == -1 && newMask != "") {
                        genmasks.push(newMask);
                        maskTemplate = getMaskTemplate(newMask);
                        ms.push({
                            "mask": newMask,
                            "_buffer": maskTemplate["mask"],
                            "buffer": maskTemplate["mask"].slice(),
                            "tests": getTestingChain(newMask),
                            "lastValidPosition": -1,
                            "greedy": maskTemplate["greedy"],
                            "repeat": maskTemplate["repeat"],
                            "metadata": metadata
                        });
                    }
                    if (splitFirstOptionalStartPart(masks[1]).length > 1) { //optional contains another optional
                        generateMask(maskPrefix + masks[0], masks[1] + maskParts[1], metadata);
                    }
                    if (maskParts.length > 1 && splitFirstOptionalStartPart(maskParts[1]).length > 1) {
                        generateMask(maskPrefix + masks[0] + markOptional(masks[1]), maskParts[1], metadata);
                        generateMask(maskPrefix + masks[0], maskParts[1], metadata);
                    }
                }
                else {
                    newMask = maskPrefix + maskParts;
                    if ($.inArray(newMask, genmasks) == -1 && newMask != "") {
                        genmasks.push(newMask);
                        maskTemplate = getMaskTemplate(newMask);
                        ms.push({
                            "mask": newMask,
                            "_buffer": maskTemplate["mask"],
                            "buffer": maskTemplate["mask"].slice(),
                            "tests": getTestingChain(newMask),
                            "lastValidPosition": -1,
                            "greedy": maskTemplate["greedy"],
                            "repeat": maskTemplate["repeat"],
                            "metadata": metadata
                        });
                    }
                }

            }

            if ($.isFunction(opts.mask)) { //allow mask to be a preprocessing fn - should return a valid mask
                opts.mask = opts.mask.call(this, opts);
            }
            if ($.isArray(opts.mask)) {
                $.each(opts.mask, function (ndx, msk) {
                    if (msk["mask"] != undefined) {
                        generateMask("", msk["mask"].toString(), msk);
                    } else
                        generateMask("", msk.toString());
                });
            } else generateMask("", opts.mask.toString());

            return opts.greedy ? ms : ms.sort(function (a, b) { return a["mask"].length - b["mask"].length; });
        }

        var msie10 = navigator.userAgent.match(new RegExp("msie 10", "i")) !== null,
            iphone = navigator.userAgent.match(new RegExp("iphone", "i")) !== null,
            android = navigator.userAgent.match(new RegExp("android.*safari.*", "i")) !== null,
            androidchrome = navigator.userAgent.match(new RegExp("android.*chrome.*", "i")) !== null,
            pasteEvent = isInputEventSupported('paste') ? 'paste' : isInputEventSupported('input') ? 'input' : "propertychange";


        //masking scope
        //actionObj definition see below
        function maskScope(masksets, activeMasksetIndex, opts, actionObj) {
            var isRTL = false,
                valueOnFocus = getActiveBuffer().join(''),
                $el, chromeValueOnInput,
                skipKeyPressEvent = false, //Safari 5.1.x - modal dialog fires keypress twice workaround
                skipInputEvent = false, //skip when triggered from within inputmask
                ignorable = false;


            //maskset helperfunctions

            function getActiveMaskSet() {
                return masksets[activeMasksetIndex];
            }

            function getActiveTests() {
                return getActiveMaskSet()['tests'];
            }

            function getActiveBufferTemplate() {
                return getActiveMaskSet()['_buffer'];
            }

            function getActiveBuffer() {
                return getActiveMaskSet()['buffer'];
            }

            function isValid(pos, c, strict) { //strict true ~ no correction or autofill
                strict = strict === true; //always set a value to strict to prevent possible strange behavior in the extensions 

                function _isValid(position, activeMaskset, c, strict) {
                    var testPos = determineTestPosition(position), loopend = c ? 1 : 0, chrs = '', buffer = activeMaskset["buffer"];
                    for (var i = activeMaskset['tests'][testPos].cardinality; i > loopend; i--) {
                        chrs += getBufferElement(buffer, testPos - (i - 1));
                    }

                    if (c) {
                        chrs += c;
                    }

                    //return is false or a json object => { pos: ??, c: ??} or true
                    return activeMaskset['tests'][testPos].fn != null ?
                        activeMaskset['tests'][testPos].fn.test(chrs, buffer, position, strict, opts)
                        : (c == getBufferElement(activeMaskset['_buffer'], position, true) || c == opts.skipOptionalPartCharacter) ?
                            { "refresh": true, c: getBufferElement(activeMaskset['_buffer'], position, true), pos: position }
                            : false;
                }

                function PostProcessResults(maskForwards, results) {
                    var hasValidActual = false;
                    $.each(results, function (ndx, rslt) {
                        hasValidActual = $.inArray(rslt["activeMasksetIndex"], maskForwards) == -1 && rslt["result"] !== false;
                        if (hasValidActual) return false;
                    });
                    if (hasValidActual) { //strip maskforwards
                        results = $.map(results, function (rslt, ndx) {
                            if ($.inArray(rslt["activeMasksetIndex"], maskForwards) == -1) {
                                return rslt;
                            } else {
                                masksets[rslt["activeMasksetIndex"]]["lastValidPosition"] = actualLVP;
                            }
                        });
                    } else { //keep maskforwards with the least forward
                        var lowestPos = -1, lowestIndex = -1, rsltValid;
                        $.each(results, function (ndx, rslt) {
                            if ($.inArray(rslt["activeMasksetIndex"], maskForwards) != -1 && rslt["result"] !== false & (lowestPos == -1 || lowestPos > rslt["result"]["pos"])) {
                                lowestPos = rslt["result"]["pos"];
                                lowestIndex = rslt["activeMasksetIndex"];
                            }
                        });
                        results = $.map(results, function (rslt, ndx) {
                            if ($.inArray(rslt["activeMasksetIndex"], maskForwards) != -1) {
                                if (rslt["result"]["pos"] == lowestPos) {
                                    return rslt;
                                } else if (rslt["result"] !== false) {
                                    for (var i = pos; i < lowestPos; i++) {
                                        rsltValid = _isValid(i, masksets[rslt["activeMasksetIndex"]], masksets[lowestIndex]["buffer"][i], true);
                                        if (rsltValid === false) {
                                            masksets[rslt["activeMasksetIndex"]]["lastValidPosition"] = lowestPos - 1;
                                            break;
                                        } else {
                                            setBufferElement(masksets[rslt["activeMasksetIndex"]]["buffer"], i, masksets[lowestIndex]["buffer"][i], true);
                                            masksets[rslt["activeMasksetIndex"]]["lastValidPosition"] = i;
                                        }
                                    }
                                    //also check check for the lowestpos with the new input
                                    rsltValid = _isValid(lowestPos, masksets[rslt["activeMasksetIndex"]], c, true);
                                    if (rsltValid !== false) {
                                        setBufferElement(masksets[rslt["activeMasksetIndex"]]["buffer"], lowestPos, c, true);
                                        masksets[rslt["activeMasksetIndex"]]["lastValidPosition"] = lowestPos;
                                    }
                                    //console.log("ndx " + rslt["activeMasksetIndex"] + " validate " + masksets[rslt["activeMasksetIndex"]]["buffer"].join('') + " lv " + masksets[rslt["activeMasksetIndex"]]['lastValidPosition']);
                                    return rslt;
                                }
                            }
                        });
                    }
                    return results;
                }

                if (strict) {
                    var result = _isValid(pos, getActiveMaskSet(), c, strict); //only check validity in current mask when validating strict
                    if (result === true) {
                        result = { "pos": pos }; //always take a possible corrected maskposition into account
                    }
                    return result;
                }

                var results = [], result = false, currentActiveMasksetIndex = activeMasksetIndex,
                    actualBuffer = getActiveBuffer().slice(), actualLVP = getActiveMaskSet()["lastValidPosition"],
                    actualPrevious = seekPrevious(pos),
                    maskForwards = [];
                $.each(masksets, function (index, value) {
                    if (typeof (value) == "object") {
                        activeMasksetIndex = index;

                        var maskPos = pos;
                        var lvp = getActiveMaskSet()['lastValidPosition'],
                            rsltValid;
                        if (lvp == actualLVP) {
                            if ((maskPos - actualLVP) > 1) {
                                for (var i = lvp == -1 ? 0 : lvp; i < maskPos; i++) {
                                    rsltValid = _isValid(i, getActiveMaskSet(), actualBuffer[i], true);
                                    if (rsltValid === false) {
                                        break;
                                    } else {
                                        setBufferElement(getActiveBuffer(), i, actualBuffer[i], true);
                                        if (rsltValid === true) {
                                            rsltValid = { "pos": i }; //always take a possible corrected maskposition into account
                                        }
                                        var newValidPosition = rsltValid.pos || i;
                                        if (getActiveMaskSet()['lastValidPosition'] < newValidPosition)
                                            getActiveMaskSet()['lastValidPosition'] = newValidPosition; //set new position from isValid
                                    }
                                }
                            }
                            //does the input match on a further position?
                            if (!isMask(maskPos) && !_isValid(maskPos, getActiveMaskSet(), c, strict)) {
                                var maxForward = seekNext(maskPos) - maskPos;
                                for (var fw = 0; fw < maxForward; fw++) {
                                    if (_isValid(++maskPos, getActiveMaskSet(), c, strict) !== false)
                                        break;
                                }
                                maskForwards.push(activeMasksetIndex);
                                //console.log('maskforward ' + activeMasksetIndex + " pos " + pos + " maskPos " + maskPos);
                            }
                        }

                        if (getActiveMaskSet()['lastValidPosition'] >= actualLVP || activeMasksetIndex == currentActiveMasksetIndex) {
                            if (maskPos >= 0 && maskPos < getMaskLength()) {
                                result = _isValid(maskPos, getActiveMaskSet(), c, strict);
                                if (result !== false) {
                                    if (result === true) {
                                        result = { "pos": maskPos }; //always take a possible corrected maskposition into account
                                    }
                                    var newValidPosition = result.pos || maskPos;
                                    if (getActiveMaskSet()['lastValidPosition'] < newValidPosition)
                                        getActiveMaskSet()['lastValidPosition'] = newValidPosition; //set new position from isValid
                                }
                                //console.log("pos " + pos + " ndx " + activeMasksetIndex + " validate " + getActiveBuffer().join('') + " lv " + getActiveMaskSet()['lastValidPosition']);
                                results.push({ "activeMasksetIndex": index, "result": result });
                            }
                        }
                    }
                });
                activeMasksetIndex = currentActiveMasksetIndex; //reset activeMasksetIndex

                return PostProcessResults(maskForwards, results); //return results of the multiple mask validations
            }

            function determineActiveMasksetIndex() {
                var currentMasksetIndex = activeMasksetIndex,
                    highestValid = { "activeMasksetIndex": 0, "lastValidPosition": -1, "next": -1 };
                $.each(masksets, function (index, value) {
                    if (typeof (value) == "object") {
                        activeMasksetIndex = index;
                        if (getActiveMaskSet()['lastValidPosition'] > highestValid['lastValidPosition']) {
                            highestValid["activeMasksetIndex"] = index;
                            highestValid["lastValidPosition"] = getActiveMaskSet()['lastValidPosition'];
                            highestValid["next"] = seekNext(getActiveMaskSet()['lastValidPosition']);
                        } else if (getActiveMaskSet()['lastValidPosition'] == highestValid['lastValidPosition'] &&
                            (highestValid['next'] == -1 || highestValid['next'] > seekNext(getActiveMaskSet()['lastValidPosition']))) {
                            highestValid["activeMasksetIndex"] = index;
                            highestValid["lastValidPosition"] = getActiveMaskSet()['lastValidPosition'];
                            highestValid["next"] = seekNext(getActiveMaskSet()['lastValidPosition']);
                        }
                    }
                });

                activeMasksetIndex = highestValid["lastValidPosition"] != -1 && masksets[currentMasksetIndex]["lastValidPosition"] == highestValid["lastValidPosition"] ? currentMasksetIndex : highestValid["activeMasksetIndex"];
                if (currentMasksetIndex != activeMasksetIndex) {
                    clearBuffer(getActiveBuffer(), seekNext(highestValid["lastValidPosition"]), getMaskLength());
                    getActiveMaskSet()["writeOutBuffer"] = true;
                }
                $el.data('_inputmask')['activeMasksetIndex'] = activeMasksetIndex; //store the activeMasksetIndex
            }

            function isMask(pos) {
                var testPos = determineTestPosition(pos);
                var test = getActiveTests()[testPos];

                return test != undefined ? test.fn : false;
            }

            function determineTestPosition(pos) {
                return pos % getActiveTests().length;
            }

            function getMaskLength() {
                return opts.getMaskLength(getActiveBufferTemplate(), getActiveMaskSet()['greedy'], getActiveMaskSet()['repeat'], getActiveBuffer(), opts);
            }

            //pos: from position

            function seekNext(pos) {
                var maskL = getMaskLength();
                if (pos >= maskL) return maskL;
                var position = pos;
                while (++position < maskL && !isMask(position)) {
                }
                return position;
            }

            //pos: from position

            function seekPrevious(pos) {
                var position = pos;
                if (position <= 0) return 0;

                while (--position > 0 && !isMask(position)) {
                }
                return position;
            }

            function setBufferElement(buffer, position, element, autoPrepare) {
                if (autoPrepare) position = prepareBuffer(buffer, position);

                var test = getActiveTests()[determineTestPosition(position)];
                var elem = element;
                if (elem != undefined && test != undefined) {
                    switch (test.casing) {
                        case "upper":
                            elem = element.toUpperCase();
                            break;
                        case "lower":
                            elem = element.toLowerCase();
                            break;
                    }
                }

                buffer[position] = elem;
            }

            function getBufferElement(buffer, position, autoPrepare) {
                if (autoPrepare) position = prepareBuffer(buffer, position);
                return buffer[position];
            }

            //needed to handle the non-greedy mask repetitions

            function prepareBuffer(buffer, position) {
                var j;
                while (buffer[position] == undefined && buffer.length < getMaskLength()) {
                    j = 0;
                    while (getActiveBufferTemplate()[j] !== undefined) { //add a new buffer
                        buffer.push(getActiveBufferTemplate()[j++]);
                    }
                }

                return position;
            }

            function writeBuffer(input, buffer, caretPos) {
                input._valueSet(buffer.join(''));
                if (caretPos != undefined) {
                    caret(input, caretPos);
                }
            }

            function clearBuffer(buffer, start, end, stripNomasks) {
                for (var i = start, maskL = getMaskLength() ; i < end && i < maskL; i++) {
                    if (stripNomasks === true) {
                        if (!isMask(i))
                            setBufferElement(buffer, i, "");
                    } else
                        setBufferElement(buffer, i, getBufferElement(getActiveBufferTemplate().slice(), i, true));
                }
            }

            function setReTargetPlaceHolder(buffer, pos) {
                var testPos = determineTestPosition(pos);
                setBufferElement(buffer, pos, getBufferElement(getActiveBufferTemplate(), testPos));
            }

            function getPlaceHolder(pos) {
                return opts.placeholder.charAt(pos % opts.placeholder.length);
            }

            function checkVal(input, writeOut, strict, nptvl, intelliCheck) {
                var inputValue = nptvl != undefined ? nptvl.slice() : truncateInput(input._valueGet()).split('');

                $.each(masksets, function (ndx, ms) {
                    if (typeof (ms) == "object") {
                        ms["buffer"] = ms["_buffer"].slice();
                        ms["lastValidPosition"] = -1;
                        ms["p"] = -1;
                    }
                });
                if (strict !== true) activeMasksetIndex = 0;
                if (writeOut) input._valueSet(""); //initial clear
                var ml = getMaskLength();
                $.each(inputValue, function (ndx, charCode) {
                    if (intelliCheck === true) {
                        var p = getActiveMaskSet()["p"], lvp = p == -1 ? p : seekPrevious(p),
                            pos = lvp == -1 ? ndx : seekNext(lvp);
                        if ($.inArray(charCode, getActiveBufferTemplate().slice(lvp + 1, pos)) == -1) {
                            keypressEvent.call(input, undefined, true, charCode.charCodeAt(0), writeOut, strict, ndx);
                        }
                    } else {
                        keypressEvent.call(input, undefined, true, charCode.charCodeAt(0), writeOut, strict, ndx);
                    }
                });

                if (strict === true && getActiveMaskSet()["p"] != -1) {
                    getActiveMaskSet()["lastValidPosition"] = seekPrevious(getActiveMaskSet()["p"]);
                }
            }

            function escapeRegex(str) {
                return $.inputmask.escapeRegex.call(this, str);
            }

            function truncateInput(inputValue) {
                return inputValue.replace(new RegExp("(" + escapeRegex(getActiveBufferTemplate().join('')) + ")*$"), "");
            }

            function clearOptionalTail(input) {
                var buffer = getActiveBuffer(), tmpBuffer = buffer.slice(), testPos, pos;
                for (var pos = tmpBuffer.length - 1; pos >= 0; pos--) {
                    var testPos = determineTestPosition(pos);
                    if (getActiveTests()[testPos].optionality) {
                        if (!isMask(pos) || !isValid(pos, buffer[pos], true))
                            tmpBuffer.pop();
                        else break;
                    } else break;
                }
                writeBuffer(input, tmpBuffer);
            }

            function unmaskedvalue($input, skipDatepickerCheck) {
                if (getActiveTests() && (skipDatepickerCheck === true || !$input.hasClass('hasDatepicker'))) {
                    //checkVal(input, false, true);
                    var umValue = $.map(getActiveBuffer(), function (element, index) {
                        return isMask(index) && isValid(index, element, true) ? element : null;
                    });
                    var unmaskedValue = (isRTL ? umValue.reverse() : umValue).join('');
                    return opts.onUnMask != undefined ? opts.onUnMask.call(this, getActiveBuffer().join(''), unmaskedValue) : unmaskedValue;
                } else {
                    return $input[0]._valueGet();
                }
            }

            function TranslatePosition(pos) {
                if (isRTL && typeof pos == 'number' && (!opts.greedy || opts.placeholder != "")) {
                    var bffrLght = getActiveBuffer().length;
                    pos = bffrLght - pos;
                }
                return pos;
            }

            function caret(input, begin, end) {
                var npt = input.jquery && input.length > 0 ? input[0] : input, range;
                if (typeof begin == 'number') {
                    begin = TranslatePosition(begin);
                    end = TranslatePosition(end);
                    if (!$(input).is(':visible')) {
                        return;
                    }
                    end = (typeof end == 'number') ? end : begin;
                    npt.scrollLeft = npt.scrollWidth;
                    if (opts.insertMode == false && begin == end) end++; //set visualization for insert/overwrite mode
                    if (npt.setSelectionRange) {
                        npt.selectionStart = begin;
                        npt.selectionEnd = android ? begin : end;

                    } else if (npt.createTextRange) {
                        range = npt.createTextRange();
                        range.collapse(true);
                        range.moveEnd('character', end);
                        range.moveStart('character', begin);
                        range.select();
                    }
                } else {
                    if (!$(input).is(':visible')) {
                        return { "begin": 0, "end": 0 };
                    }
                    if (npt.setSelectionRange) {
                        begin = npt.selectionStart;
                        end = npt.selectionEnd;
                    } else if (document.selection && document.selection.createRange) {
                        range = document.selection.createRange();
                        begin = 0 - range.duplicate().moveStart('character', -100000);
                        end = begin + range.text.length;
                    }
                    begin = TranslatePosition(begin);
                    end = TranslatePosition(end);
                    return { "begin": begin, "end": end };
                }
            }

            function isComplete(buffer) { //return true / false / undefined (repeat *)
                if (opts.repeat == "*") return undefined;
                var complete = false, highestValidPosition = 0, currentActiveMasksetIndex = activeMasksetIndex;
                $.each(masksets, function (ndx, ms) {
                    if (typeof (ms) == "object") {
                        activeMasksetIndex = ndx;
                        var aml = seekPrevious(getMaskLength());
                        if (ms["lastValidPosition"] >= highestValidPosition && ms["lastValidPosition"] == aml) {
                            var msComplete = true;
                            for (var i = 0; i <= aml; i++) {
                                var mask = isMask(i), testPos = determineTestPosition(i);
                                if ((mask && (buffer[i] == undefined || buffer[i] == getPlaceHolder(i))) || (!mask && buffer[i] != getActiveBufferTemplate()[testPos])) {
                                    msComplete = false;
                                    break;
                                }
                            }
                            complete = complete || msComplete;
                            if (complete) //break loop
                                return false;
                        }
                        highestValidPosition = ms["lastValidPosition"];
                    }
                });
                activeMasksetIndex = currentActiveMasksetIndex; //reset activeMaskset
                return complete;
            }

            function isSelection(begin, end) {
                return isRTL ? (begin - end) > 1 || ((begin - end) == 1 && opts.insertMode) :
                    (end - begin) > 1 || ((end - begin) == 1 && opts.insertMode);
            }


            //private functions
            function installEventRuler(npt) {
                var events = $._data(npt).events;

                $.each(events, function (eventType, eventHandlers) {
                    $.each(eventHandlers, function (ndx, eventHandler) {
                        if (eventHandler.namespace == "inputmask") {
                            if (eventHandler.type != "setvalue") {
                                var handler = eventHandler.handler;
                                eventHandler.handler = function (e) {
                                    if (this.readOnly || this.disabled)
                                        e.preventDefault;
                                    else
                                        return handler.apply(this, arguments);
                                };
                            }
                        }
                    });
                });
            }

            function patchValueProperty(npt) {
                var valueProperty;
                if (Object.getOwnPropertyDescriptor)
                    valueProperty = Object.getOwnPropertyDescriptor(npt, "value");
                if (valueProperty && valueProperty.get) {
                    if (!npt._valueGet) {
                        var valueGet = valueProperty.get;
                        var valueSet = valueProperty.set;
                        npt._valueGet = function () {
                            return isRTL ? valueGet.call(this).split('').reverse().join('') : valueGet.call(this);
                        };
                        npt._valueSet = function (value) {
                            valueSet.call(this, isRTL ? value.split('').reverse().join('') : value);
                        };

                        Object.defineProperty(npt, "value", {
                            get: function () {
                                var $self = $(this), inputData = $(this).data('_inputmask'), masksets = inputData['masksets'],
                                    activeMasksetIndex = inputData['activeMasksetIndex'];
                                return inputData && inputData['opts'].autoUnmask ? $self.inputmask('unmaskedvalue') : valueGet.call(this) != masksets[activeMasksetIndex]['_buffer'].join('') ? valueGet.call(this) : '';
                            },
                            set: function (value) {
                                valueSet.call(this, value);
                                $(this).triggerHandler('setvalue.inputmask');
                            }
                        });
                    }
                } else if (document.__lookupGetter__ && npt.__lookupGetter__("value")) {
                    if (!npt._valueGet) {
                        var valueGet = npt.__lookupGetter__("value");
                        var valueSet = npt.__lookupSetter__("value");
                        npt._valueGet = function () {
                            return isRTL ? valueGet.call(this).split('').reverse().join('') : valueGet.call(this);
                        };
                        npt._valueSet = function (value) {
                            valueSet.call(this, isRTL ? value.split('').reverse().join('') : value);
                        };

                        npt.__defineGetter__("value", function () {
                            var $self = $(this), inputData = $(this).data('_inputmask'), masksets = inputData['masksets'],
                                activeMasksetIndex = inputData['activeMasksetIndex'];
                            return inputData && inputData['opts'].autoUnmask ? $self.inputmask('unmaskedvalue') : valueGet.call(this) != masksets[activeMasksetIndex]['_buffer'].join('') ? valueGet.call(this) : '';
                        });
                        npt.__defineSetter__("value", function (value) {
                            valueSet.call(this, value);
                            $(this).triggerHandler('setvalue.inputmask');
                        });
                    }
                } else {
                    if (!npt._valueGet) {
                        npt._valueGet = function () { return isRTL ? this.value.split('').reverse().join('') : this.value; };
                        npt._valueSet = function (value) { this.value = isRTL ? value.split('').reverse().join('') : value; };
                    }
                    if ($.valHooks.text == undefined || $.valHooks.text.inputmaskpatch != true) {
                        var valueGet = $.valHooks.text && $.valHooks.text.get ? $.valHooks.text.get : function (elem) { return elem.value; };
                        var valueSet = $.valHooks.text && $.valHooks.text.set ? $.valHooks.text.set : function (elem, value) {
                            elem.value = value;
                            return elem;
                        };

                        jQuery.extend($.valHooks, {
                            text: {
                                get: function (elem) {
                                    var $elem = $(elem);
                                    if ($elem.data('_inputmask')) {
                                        if ($elem.data('_inputmask')['opts'].autoUnmask)
                                            return $elem.inputmask('unmaskedvalue');
                                        else {
                                            var result = valueGet(elem),
                                                inputData = $elem.data('_inputmask'), masksets = inputData['masksets'],
                                                activeMasksetIndex = inputData['activeMasksetIndex'];
                                            return result != masksets[activeMasksetIndex]['_buffer'].join('') ? result : '';
                                        }
                                    } else return valueGet(elem);
                                },
                                set: function (elem, value) {
                                    var $elem = $(elem);
                                    var result = valueSet(elem, value);
                                    if ($elem.data('_inputmask')) $elem.triggerHandler('setvalue.inputmask');
                                    return result;
                                },
                                inputmaskpatch: true
                            }
                        });
                    }
                }
            }

            //shift chars to left from start to end and put c at end position if defined

            function shiftL(start, end, c, maskJumps) {
                var buffer = getActiveBuffer();
                if (maskJumps !== false) //jumping over nonmask position
                    while (!isMask(start) && start - 1 >= 0) start--;
                for (var i = start; i < end && i < getMaskLength() ; i++) {
                    if (isMask(i)) {
                        setReTargetPlaceHolder(buffer, i);
                        var j = seekNext(i);
                        var p = getBufferElement(buffer, j);
                        if (p != getPlaceHolder(j)) {
                            if (j < getMaskLength() && isValid(i, p, true) !== false && getActiveTests()[determineTestPosition(i)].def == getActiveTests()[determineTestPosition(j)].def) {
                                setBufferElement(buffer, i, p, true);
                            } else {
                                if (isMask(i))
                                    break;
                            }
                        }
                    } else {
                        setReTargetPlaceHolder(buffer, i);
                    }
                }
                if (c != undefined)
                    setBufferElement(buffer, seekPrevious(end), c);

                if (getActiveMaskSet()["greedy"] == false) {
                    var trbuffer = truncateInput(buffer.join('')).split('');
                    buffer.length = trbuffer.length;
                    for (var i = 0, bl = buffer.length; i < bl; i++) {
                        buffer[i] = trbuffer[i];
                    }
                    if (buffer.length == 0) getActiveMaskSet()["buffer"] = getActiveBufferTemplate().slice();
                }
                return start; //return the used start position
            }

            function shiftR(start, end, c) {
                var buffer = getActiveBuffer();
                if (getBufferElement(buffer, start, true) != getPlaceHolder(start)) {
                    for (var i = seekPrevious(end) ; i > start && i >= 0; i--) {
                        if (isMask(i)) {
                            var j = seekPrevious(i);
                            var t = getBufferElement(buffer, j);
                            if (t != getPlaceHolder(j)) {
                                if (isValid(j, t, true) !== false && getActiveTests()[determineTestPosition(i)].def == getActiveTests()[determineTestPosition(j)].def) {
                                    setBufferElement(buffer, i, t, true);
                                    setReTargetPlaceHolder(buffer, j);
                                } //else break;
                            }
                        } else
                            setReTargetPlaceHolder(buffer, i);
                    }
                }
                if (c != undefined && getBufferElement(buffer, start) == getPlaceHolder(start))
                    setBufferElement(buffer, start, c);
                var lengthBefore = buffer.length;
                if (getActiveMaskSet()["greedy"] == false) {
                    var trbuffer = truncateInput(buffer.join('')).split('');
                    buffer.length = trbuffer.length;
                    for (var i = 0, bl = buffer.length; i < bl; i++) {
                        buffer[i] = trbuffer[i];
                    }
                    if (buffer.length == 0) getActiveMaskSet()["buffer"] = getActiveBufferTemplate().slice();
                }
                return end - (lengthBefore - buffer.length); //return new start position
            }

            function HandleRemove(input, k, pos) {
                if (opts.numericInput || isRTL) {
                    switch (k) {
                        case opts.keyCode.BACKSPACE:
                            k = opts.keyCode.DELETE;
                            break;
                        case opts.keyCode.DELETE:
                            k = opts.keyCode.BACKSPACE;
                            break;
                    }
                    if (isRTL) {
                        var pend = pos.end;
                        pos.end = pos.begin;
                        pos.begin = pend;
                    }
                }

                var isSelection = true;
                if (pos.begin == pos.end) {
                    var posBegin = k == opts.keyCode.BACKSPACE ? pos.begin - 1 : pos.begin;
                    if (opts.isNumeric && opts.radixPoint != "" && getActiveBuffer()[posBegin] == opts.radixPoint) {
                        pos.begin = (getActiveBuffer().length - 1 == posBegin) /* radixPoint is latest? delete it */ ? pos.begin : k == opts.keyCode.BACKSPACE ? posBegin : seekNext(posBegin);
                        pos.end = pos.begin;
                    }
                    isSelection = false;
                    if (k == opts.keyCode.BACKSPACE)
                        pos.begin--;
                    else if (k == opts.keyCode.DELETE)
                        pos.end++;
                } else if (pos.end - pos.begin == 1 && !opts.insertMode) {
                    isSelection = false;
                    if (k == opts.keyCode.BACKSPACE)
                        pos.begin--;
                }

                clearBuffer(getActiveBuffer(), pos.begin, pos.end);

                var ml = getMaskLength();
                if (opts.greedy == false) {
                    shiftL(pos.begin, ml, undefined, !isRTL && (k == opts.keyCode.BACKSPACE && !isSelection));
                } else {
                    var newpos = pos.begin;
                    for (var i = pos.begin; i < pos.end; i++) { //seeknext to skip placeholders at start in selection
                        if (isMask(i) || !isSelection)
                            newpos = shiftL(pos.begin, ml, undefined, !isRTL && (k == opts.keyCode.BACKSPACE && !isSelection));
                    }
                    if (!isSelection) pos.begin = newpos;
                }
                var firstMaskPos = seekNext(-1);
                clearBuffer(getActiveBuffer(), pos.begin, pos.end, true);
                checkVal(input, false, masksets[1] == undefined || firstMaskPos >= pos.end, getActiveBuffer());
                if (getActiveMaskSet()['lastValidPosition'] < firstMaskPos) {
                    getActiveMaskSet()["lastValidPosition"] = -1;
                    getActiveMaskSet()["p"] = firstMaskPos;
                } else {
                    getActiveMaskSet()["p"] = pos.begin;
                }
            }

            function keydownEvent(e) {
                //Safari 5.1.x - modal dialog fires keypress twice workaround
                skipKeyPressEvent = false;
                var input = this, $input = $(input), k = e.keyCode, pos = caret(input);

                //backspace, delete, and escape get special treatment
                if (k == opts.keyCode.BACKSPACE || k == opts.keyCode.DELETE || (iphone && k == 127) || e.ctrlKey && k == 88) { //backspace/delete
                    e.preventDefault(); //stop default action but allow propagation
                    if (k == 88) valueOnFocus = getActiveBuffer().join('');
                    HandleRemove(input, k, pos);
                    determineActiveMasksetIndex();
                    writeBuffer(input, getActiveBuffer(), getActiveMaskSet()["p"]);
                    if (input._valueGet() == getActiveBufferTemplate().join(''))
                        $input.trigger('cleared');

                    if (opts.showTooltip) { //update tooltip
                        $input.prop("title", getActiveMaskSet()["mask"]);
                    }
                } else if (k == opts.keyCode.END || k == opts.keyCode.PAGE_DOWN) { //when END or PAGE_DOWN pressed set position at lastmatch
                    setTimeout(function () {
                        var caretPos = seekNext(getActiveMaskSet()["lastValidPosition"]);
                        if (!opts.insertMode && caretPos == getMaskLength() && !e.shiftKey) caretPos--;
                        caret(input, e.shiftKey ? pos.begin : caretPos, caretPos);
                    }, 0);
                } else if ((k == opts.keyCode.HOME && !e.shiftKey) || k == opts.keyCode.PAGE_UP) { //Home or page_up
                    caret(input, 0, e.shiftKey ? pos.begin : 0);
                } else if (k == opts.keyCode.ESCAPE || (k == 90 && e.ctrlKey)) { //escape && undo
                    checkVal(input, true, false, valueOnFocus.split(''));
                    $input.click();
                } else if (k == opts.keyCode.INSERT && !(e.shiftKey || e.ctrlKey)) { //insert
                    opts.insertMode = !opts.insertMode;
                    caret(input, !opts.insertMode && pos.begin == getMaskLength() ? pos.begin - 1 : pos.begin);
                } else if (opts.insertMode == false && !e.shiftKey) {
                    if (k == opts.keyCode.RIGHT) {
                        setTimeout(function () {
                            var caretPos = caret(input);
                            caret(input, caretPos.begin);
                        }, 0);
                    } else if (k == opts.keyCode.LEFT) {
                        setTimeout(function () {
                            var caretPos = caret(input);
                            caret(input, caretPos.begin - 1);
                        }, 0);
                    }
                }

                var currentCaretPos = caret(input);
                if (opts.onKeyDown.call(this, e, getActiveBuffer(), opts) === true) //extra stuff to execute on keydown
                    caret(input, currentCaretPos.begin, currentCaretPos.end);
                ignorable = $.inArray(k, opts.ignorables) != -1;
            }


            function keypressEvent(e, checkval, k, writeOut, strict, ndx) {
                //Safari 5.1.x - modal dialog fires keypress twice workaround
                if (k == undefined && skipKeyPressEvent) return false;
                skipKeyPressEvent = true;

                var input = this, $input = $(input);

                e = e || window.event;
                var k = checkval ? k : (e.which || e.charCode || e.keyCode);

                if (checkval !== true && (!(e.ctrlKey && e.altKey) && (e.ctrlKey || e.metaKey || ignorable))) {
                    return true;
                } else {
                    if (k) {
                        //special treat the decimal separator
                        if (checkval !== true && k == 46 && e.shiftKey == false && opts.radixPoint == ",") k = 44;

                        var pos, results, result, c = String.fromCharCode(k);
                        if (checkval) {
                            var pcaret = strict ? ndx : getActiveMaskSet()["lastValidPosition"] + 1;
                            pos = { begin: pcaret, end: pcaret };
                        } else {
                            pos = caret(input);
                        }

                        //should we clear a possible selection??
                        var isSlctn = isSelection(pos.begin, pos.end), redetermineLVP = false,
                            initialIndex = activeMasksetIndex;
                        if (isSlctn) {
                            activeMasksetIndex = initialIndex;
                            $.each(masksets, function (ndx, lmnt) { //init undobuffer for recovery when not valid
                                if (typeof (lmnt) == "object") {
                                    activeMasksetIndex = ndx;
                                    getActiveMaskSet()["undoBuffer"] = getActiveBuffer().join('');
                                }
                            });
                            HandleRemove(input, opts.keyCode.DELETE, pos);
                            if (!opts.insertMode) { //preserve some space
                                $.each(masksets, function (ndx, lmnt) {
                                    if (typeof (lmnt) == "object") {
                                        activeMasksetIndex = ndx;
                                        shiftR(pos.begin, getMaskLength());
                                        getActiveMaskSet()["lastValidPosition"] = seekNext(getActiveMaskSet()["lastValidPosition"]);
                                    }
                                });
                            }
                            activeMasksetIndex = initialIndex; //restore index
                        }

                        var radixPosition = getActiveBuffer().join('').indexOf(opts.radixPoint);
                        if (opts.isNumeric && checkval !== true && radixPosition != -1) {
                            if (opts.greedy && pos.begin <= radixPosition) {
                                pos.begin = seekPrevious(pos.begin);
                                pos.end = pos.begin;
                            } else if (c == opts.radixPoint) {
                                pos.begin = radixPosition;
                                pos.end = pos.begin;
                            }
                        }


                        var p = pos.begin;
                        results = isValid(p, c, strict);
                        if (strict === true) results = [{ "activeMasksetIndex": activeMasksetIndex, "result": results }];
                        var minimalForwardPosition = -1;
                        $.each(results, function (index, result) {
                            activeMasksetIndex = result["activeMasksetIndex"];
                            getActiveMaskSet()["writeOutBuffer"] = true;
                            var np = result["result"];
                            if (np !== false) {
                                var refresh = false, buffer = getActiveBuffer();
                                if (np !== true) {
                                    refresh = np["refresh"]; //only rewrite buffer from isValid
                                    p = np.pos != undefined ? np.pos : p; //set new position from isValid
                                    c = np.c != undefined ? np.c : c; //set new char from isValid
                                }
                                if (refresh !== true) {
                                    if (opts.insertMode == true) {
                                        var lastUnmaskedPosition = getMaskLength();
                                        var bfrClone = buffer.slice();
                                        while (getBufferElement(bfrClone, lastUnmaskedPosition, true) != getPlaceHolder(lastUnmaskedPosition) && lastUnmaskedPosition >= p) {
                                            lastUnmaskedPosition = lastUnmaskedPosition == 0 ? -1 : seekPrevious(lastUnmaskedPosition);
                                        }
                                        if (lastUnmaskedPosition >= p) {
                                            shiftR(p, getMaskLength(), c);
                                            //shift the lvp if needed
                                            var lvp = getActiveMaskSet()["lastValidPosition"], nlvp = seekNext(lvp);
                                            if (nlvp != getMaskLength() && lvp >= p && (getBufferElement(getActiveBuffer(), nlvp, true) != getPlaceHolder(nlvp))) {
                                                getActiveMaskSet()["lastValidPosition"] = nlvp;
                                            }
                                        } else getActiveMaskSet()["writeOutBuffer"] = false;
                                    } else setBufferElement(buffer, p, c, true);
                                    if (minimalForwardPosition == -1 || minimalForwardPosition > seekNext(p)) {
                                        minimalForwardPosition = seekNext(p);
                                    }
                                } else if (!strict) {
                                    var nextPos = p < getMaskLength() ? p + 1 : p;
                                    if (minimalForwardPosition == -1 || minimalForwardPosition > nextPos) {
                                        minimalForwardPosition = nextPos;
                                    }
                                }
                                if (minimalForwardPosition > getActiveMaskSet()["p"])
                                    getActiveMaskSet()["p"] = minimalForwardPosition; //needed for checkval strict 
                            }
                        });

                        if (strict !== true) {
                            activeMasksetIndex = initialIndex;
                            determineActiveMasksetIndex();
                        }
                        if (writeOut !== false) {
                            $.each(results, function (ndx, rslt) {
                                if (rslt["activeMasksetIndex"] == activeMasksetIndex) {
                                    result = rslt;
                                    return false;
                                }
                            });
                            if (result != undefined) {
                                var self = this;
                                setTimeout(function () { opts.onKeyValidation.call(self, result["result"], opts); }, 0);
                                if (getActiveMaskSet()["writeOutBuffer"] && result["result"] !== false) {
                                    var buffer = getActiveBuffer();

                                    var newCaretPosition;
                                    if (checkval) {
                                        newCaretPosition = undefined;
                                    } else if (opts.numericInput) {
                                        if (p > radixPosition) {
                                            newCaretPosition = seekPrevious(minimalForwardPosition);
                                        } else if (c == opts.radixPoint) {
                                            newCaretPosition = minimalForwardPosition - 1;
                                        } else newCaretPosition = seekPrevious(minimalForwardPosition - 1);
                                    } else {
                                        newCaretPosition = minimalForwardPosition;
                                    }

                                    writeBuffer(input, buffer, newCaretPosition);
                                    if (checkval !== true) {
                                        setTimeout(function () { //timeout needed for IE
                                            if (isComplete(buffer) === true)
                                                $input.trigger("complete");
                                            skipInputEvent = true;
                                            $input.trigger("input");
                                        }, 0);
                                    }
                                } else if (isSlctn) {
                                    getActiveMaskSet()["buffer"] = getActiveMaskSet()["undoBuffer"].split('');
                                }
                            }
                        }

                        if (opts.showTooltip) { //update tooltip
                            $input.prop("title", getActiveMaskSet()["mask"]);
                        }

                        //needed for IE8 and below
                        if (e) e.preventDefault ? e.preventDefault() : e.returnValue = false;
                    }
                }
            }

            function keyupEvent(e) {
                var $input = $(this), input = this, k = e.keyCode, buffer = getActiveBuffer();

                if (androidchrome && k == opts.keyCode.BACKSPACE) {
                    if (chromeValueOnInput == input._valueGet())
                        keydownEvent.call(this, e);
                }

                opts.onKeyUp.call(this, e, buffer, opts); //extra stuff to execute on keyup
                if (k == opts.keyCode.TAB && opts.showMaskOnFocus) {
                    if ($input.hasClass('focus.inputmask') && input._valueGet().length == 0) {
                        buffer = getActiveBufferTemplate().slice();
                        writeBuffer(input, buffer);
                        caret(input, 0);
                        valueOnFocus = getActiveBuffer().join('');
                    } else {
                        writeBuffer(input, buffer);
                        if (buffer.join('') == getActiveBufferTemplate().join('') && $.inArray(opts.radixPoint, buffer) != -1) {
                            caret(input, TranslatePosition(0));
                            $input.click();
                        } else
                            caret(input, TranslatePosition(0), TranslatePosition(getMaskLength()));
                    }
                }
            }

            function inputEvent(e) {
                if (skipInputEvent === true) {
                    skipInputEvent = false;
                    return true;
                }
                var input = this, $input = $(input);

                chromeValueOnInput = getActiveBuffer().join('');
                checkVal(input, false, false);
                writeBuffer(input, getActiveBuffer());
                if (isComplete(getActiveBuffer()) === true)
                    $input.trigger("complete");
                $input.click();
            }

            function mask(el) {
                $el = $(el);
                if ($el.is(":input")) {
                    //store tests & original buffer in the input element - used to get the unmasked value
                    $el.data('_inputmask', {
                        'masksets': masksets,
                        'activeMasksetIndex': activeMasksetIndex,
                        'opts': opts,
                        'isRTL': false
                    });

                    //show tooltip
                    if (opts.showTooltip) {
                        $el.prop("title", getActiveMaskSet()["mask"]);
                    }

                    //correct greedy setting if needed
                    getActiveMaskSet()['greedy'] = getActiveMaskSet()['greedy'] ? getActiveMaskSet()['greedy'] : getActiveMaskSet()['repeat'] == 0;

                    //handle maxlength attribute
                    if ($el.attr("maxLength") != null) //only when the attribute is set
                    {
                        var maxLength = $el.prop('maxLength');
                        if (maxLength > -1) { //handle *-repeat
                            $.each(masksets, function (ndx, ms) {
                                if (typeof (ms) == "object") {
                                    if (ms["repeat"] == "*") {
                                        ms["repeat"] = maxLength;
                                    }
                                }
                            });
                        }
                        if (getMaskLength() >= maxLength && maxLength > -1) { //FF sets no defined max length to -1 
                            if (maxLength < getActiveBufferTemplate().length) getActiveBufferTemplate().length = maxLength;
                            if (getActiveMaskSet()['greedy'] == false) {
                                getActiveMaskSet()['repeat'] = Math.round(maxLength / getActiveBufferTemplate().length);
                            }
                            $el.prop('maxLength', getMaskLength() * 2);
                        }
                    }

                    patchValueProperty(el);

                    if (opts.numericInput) opts.isNumeric = opts.numericInput;
                    if (el.dir == "rtl" || (opts.numericInput && opts.rightAlignNumerics) || (opts.isNumeric && opts.rightAlignNumerics))
                        $el.css("text-align", "right");

                    if (el.dir == "rtl" || opts.numericInput) {
                        el.dir = "ltr";
                        $el.removeAttr("dir");
                        var inputData = $el.data('_inputmask');
                        inputData['isRTL'] = true;
                        $el.data('_inputmask', inputData);
                        isRTL = true;
                    }

                    //unbind all events - to make sure that no other mask will interfere when re-masking
                    $el.unbind(".inputmask");
                    $el.removeClass('focus.inputmask');
                    //bind events
                    $el.closest('form').bind("submit", function () { //trigger change on submit if any
                        if (valueOnFocus != getActiveBuffer().join('')) {
                            $el.change();
                        }
                    }).bind('reset', function () {
                        setTimeout(function () {
                            $el.trigger("setvalue");
                        }, 0);
                    });
                    $el.bind("mouseenter.inputmask", function () {
                        var $input = $(this), input = this;
                        if (!$input.hasClass('focus.inputmask') && opts.showMaskOnHover) {
                            if (input._valueGet() != getActiveBuffer().join('')) {
                                writeBuffer(input, getActiveBuffer());
                            }
                        }
                    }).bind("blur.inputmask", function () {
                        var $input = $(this), input = this, nptValue = input._valueGet(), buffer = getActiveBuffer();
                        $input.removeClass('focus.inputmask');
                        if (valueOnFocus != getActiveBuffer().join('')) {
                            $input.change();
                        }
                        if (opts.clearMaskOnLostFocus && nptValue != '') {
                            if (nptValue == getActiveBufferTemplate().join(''))
                                input._valueSet('');
                            else { //clearout optional tail of the mask
                                clearOptionalTail(input);
                            }
                        }
                        if (isComplete(buffer) === false) {
                            $input.trigger("incomplete");
                            if (opts.clearIncomplete) {
                                $.each(masksets, function (ndx, ms) {
                                    if (typeof (ms) == "object") {
                                        ms["buffer"] = ms["_buffer"].slice();
                                        ms["lastValidPosition"] = -1;
                                    }
                                });
                                activeMasksetIndex = 0;
                                if (opts.clearMaskOnLostFocus)
                                    input._valueSet('');
                                else {
                                    buffer = getActiveBufferTemplate().slice();
                                    writeBuffer(input, buffer);
                                }
                            }
                        }
                    }).bind("focus.inputmask", function () {
                        var $input = $(this), input = this, nptValue = input._valueGet();
                        if (opts.showMaskOnFocus && !$input.hasClass('focus.inputmask') && (!opts.showMaskOnHover || (opts.showMaskOnHover && nptValue == ''))) {
                            if (input._valueGet() != getActiveBuffer().join('')) {
                                writeBuffer(input, getActiveBuffer(), seekNext(getActiveMaskSet()["lastValidPosition"]));
                            }
                        }
                        $input.addClass('focus.inputmask');
                        valueOnFocus = getActiveBuffer().join('');
                    }).bind("mouseleave.inputmask", function () {
                        var $input = $(this), input = this;
                        if (opts.clearMaskOnLostFocus) {
                            if (!$input.hasClass('focus.inputmask') && input._valueGet() != $input.attr("placeholder")) {
                                if (input._valueGet() == getActiveBufferTemplate().join('') || input._valueGet() == '')
                                    input._valueSet('');
                                else { //clearout optional tail of the mask
                                    clearOptionalTail(input);
                                }
                            }
                        }
                    }).bind("click.inputmask", function () {
                        var input = this;
                        setTimeout(function () {
                            var selectedCaret = caret(input), buffer = getActiveBuffer();
                            if (selectedCaret.begin == selectedCaret.end) {
                                var clickPosition = isRTL ? TranslatePosition(selectedCaret.begin) : selectedCaret.begin,
                                    lvp = getActiveMaskSet()["lastValidPosition"],
                                    lastPosition;
                                if (opts.isNumeric) {
                                    lastPosition = opts.skipRadixDance === false && opts.radixPoint != "" && $.inArray(opts.radixPoint, buffer) != -1 ?
                                        (opts.numericInput ? seekNext($.inArray(opts.radixPoint, buffer)) : $.inArray(opts.radixPoint, buffer)) :
                                        seekNext(lvp);
                                } else {
                                    lastPosition = seekNext(lvp);
                                }
                                if (clickPosition < lastPosition) {
                                    if (isMask(clickPosition))
                                        caret(input, clickPosition);
                                    else caret(input, seekNext(clickPosition));
                                } else
                                    caret(input, lastPosition);
                            }
                        }, 0);
                    }).bind('dblclick.inputmask', function () {
                        var input = this;
                        setTimeout(function () {
                            caret(input, 0, seekNext(getActiveMaskSet()["lastValidPosition"]));
                        }, 0);
                    }).bind(pasteEvent + ".inputmask dragdrop.inputmask drop.inputmask", function (e) {
                        if (skipInputEvent === true) {
                            skipInputEvent = false;
                            return true;
                        }
                        var input = this, $input = $(input);

                        //paste event for IE8 and lower I guess ;-)
                        if (e.type == "propertychange" && input._valueGet().length <= getMaskLength()) {
                            return true;
                        }
                        setTimeout(function () {
                            var pasteValue = opts.onBeforePaste != undefined ? opts.onBeforePaste.call(this, input._valueGet()) : input._valueGet();
                            checkVal(input, true, false, pasteValue.split(''), true);
                            if (isComplete(getActiveBuffer()) === true)
                                $input.trigger("complete");
                            $input.click();
                        }, 0);
                    }).bind('setvalue.inputmask', function () {
                        var input = this;
                        checkVal(input, true);
                        valueOnFocus = getActiveBuffer().join('');
                        if (input._valueGet() == getActiveBufferTemplate().join(''))
                            input._valueSet('');
                    }).bind('complete.inputmask', opts.oncomplete
                    ).bind('incomplete.inputmask', opts.onincomplete
                    ).bind('cleared.inputmask', opts.oncleared
                    ).bind("keyup.inputmask", keyupEvent);

                    if (androidchrome) {
                        $el.bind("input.inputmask", inputEvent);
                    } else {
                        $el.bind("keydown.inputmask", keydownEvent
                        ).bind("keypress.inputmask", keypressEvent);
                    }

                    if (msie10)
                        $el.bind("input.inputmask", inputEvent);

                    //apply mask
                    checkVal(el, true, false);
                    valueOnFocus = getActiveBuffer().join('');
                    // Wrap document.activeElement in a try/catch block since IE9 throw "Unspecified error" if document.activeElement is undefined when we are in an IFrame.
                    var activeElement;
                    try {
                        activeElement = document.activeElement;
                    } catch (e) {
                    }
                    if (activeElement === el) { //position the caret when in focus
                        $el.addClass('focus.inputmask');
                        caret(el, seekNext(getActiveMaskSet()["lastValidPosition"]));
                    } else if (opts.clearMaskOnLostFocus) {
                        if (getActiveBuffer().join('') == getActiveBufferTemplate().join('')) {
                            el._valueSet('');
                        } else {
                            clearOptionalTail(el);
                        }
                    } else {
                        writeBuffer(el, getActiveBuffer());
                    }

                    installEventRuler(el);
                }
            }

            //action object
            if (actionObj != undefined) {
                switch (actionObj["action"]) {
                    case "isComplete":
                        return isComplete(actionObj["buffer"]);
                    case "unmaskedvalue":
                        isRTL = actionObj["$input"].data('_inputmask')['isRTL'];
                        return unmaskedvalue(actionObj["$input"], actionObj["skipDatepickerCheck"]);
                    case "mask":
                        mask(actionObj["el"]);
                        break;
                    case "format":
                        $el = $({});
                        $el.data('_inputmask', {
                            'masksets': masksets,
                            'activeMasksetIndex': activeMasksetIndex,
                            'opts': opts,
                            'isRTL': opts.numericInput
                        });
                        if (opts.numericInput) {
                            opts.isNumeric = opts.numericInput;
                            isRTL = true;
                        }

                        checkVal($el, false, false, actionObj["value"].split(''), true);
                        return getActiveBuffer().join('');
                }
            }
        }
        $.inputmask = {
            //options default
            defaults: {
                placeholder: "_",
                optionalmarker: { start: "[", end: "]" },
                quantifiermarker: { start: "{", end: "}" },
                groupmarker: { start: "(", end: ")" },
                escapeChar: "\\",
                mask: null,
                oncomplete: $.noop, //executes when the mask is complete
                onincomplete: $.noop, //executes when the mask is incomplete and focus is lost
                oncleared: $.noop, //executes when the mask is cleared
                repeat: 0, //repetitions of the mask: * ~ forever, otherwise specify an integer
                greedy: true, //true: allocated buffer for the mask and repetitions - false: allocate only if needed
                autoUnmask: false, //automatically unmask when retrieving the value with $.fn.val or value if the browser supports __lookupGetter__ or getOwnPropertyDescriptor
                clearMaskOnLostFocus: true,
                insertMode: true, //insert the input or overwrite the input
                clearIncomplete: false, //clear the incomplete input on blur
                aliases: {}, //aliases definitions => see jquery.inputmask.extensions.js
                onKeyUp: $.noop, //override to implement autocomplete on certain keys for example
                onKeyDown: $.noop, //override to implement autocomplete on certain keys for example
                onBeforePaste: undefined, //executes before masking the pasted value to allow preprocessing of the pasted value.  args => pastedValue => return processedValue
                onUnMask: undefined, //executes after unmasking to allow postprocessing of the unmaskedvalue.  args => maskedValue, unmaskedValue
                showMaskOnFocus: true, //show the mask-placeholder when the input has focus
                showMaskOnHover: true, //show the mask-placeholder when hovering the empty input
                onKeyValidation: $.noop, //executes on every key-press with the result of isValid. Params: result, opts
                skipOptionalPartCharacter: " ", //a character which can be used to skip an optional part of a mask
                showTooltip: false, //show the activemask as tooltip
                numericInput: false, //numericInput input direction style (input shifts to the left while holding the caret position)
                //numeric basic properties
                isNumeric: false, //enable numeric features
                radixPoint: "", //".", // | ","
                skipRadixDance: false, //disable radixpoint caret positioning
                rightAlignNumerics: true, //align numerics to the right
                //numeric basic properties
                definitions: {
                    '9': {
                        validator: "[0-9]",
                        cardinality: 1
                    },
                    'a': {
                        validator: "[A-Za-z\u0410-\u044F\u0401\u0451]",
                        cardinality: 1
                    },
                    '*': {
                        validator: "[A-Za-z\u0410-\u044F\u0401\u04510-9]",
                        cardinality: 1
                    }
                },
                keyCode: {
                    ALT: 18, BACKSPACE: 8, CAPS_LOCK: 20, COMMA: 188, COMMAND: 91, COMMAND_LEFT: 91, COMMAND_RIGHT: 93, CONTROL: 17, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, INSERT: 45, LEFT: 37, MENU: 93, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108,
                    NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SHIFT: 16, SPACE: 32, TAB: 9, UP: 38, WINDOWS: 91
                },
                //specify keycodes which should not be considered in the keypress event, otherwise the preventDefault will stop their default behavior especially in FF
                ignorables: [8, 9, 13, 19, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123],
                getMaskLength: function (buffer, greedy, repeat, currentBuffer, opts) {
                    var calculatedLength = buffer.length;
                    if (!greedy) {
                        if (repeat == "*") {
                            calculatedLength = currentBuffer.length + 1;
                        } else if (repeat > 1) {
                            calculatedLength += (buffer.length * (repeat - 1));
                        }
                    }
                    return calculatedLength;
                }
            },
            escapeRegex: function (str) {
                var specials = ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'];
                return str.replace(new RegExp('(\\' + specials.join('|\\') + ')', 'gim'), '\\$1');
            },
            format: function (value, options) {
                var opts = $.extend(true, {}, $.inputmask.defaults, options);
                resolveAlias(opts.alias, options, opts);
                return maskScope(generateMaskSets(opts), 0, opts, { "action": "format", "value": value });
            }
        };

        $.fn.inputmask = function (fn, options) {
            var opts = $.extend(true, {}, $.inputmask.defaults, options),
                masksets,
                activeMasksetIndex = 0;

            if (typeof fn === "string") {
                switch (fn) {
                    case "mask":
                        //resolve possible aliases given by options
                        resolveAlias(opts.alias, options, opts);
                        masksets = generateMaskSets(opts);
                        if (masksets.length == 0) { return this; }

                        return this.each(function () {
                            maskScope($.extend(true, {}, masksets), 0, opts, { "action": "mask", "el": this });
                        });
                    case "unmaskedvalue":
                        var $input = $(this), input = this;
                        if ($input.data('_inputmask')) {
                            masksets = $input.data('_inputmask')['masksets'];
                            activeMasksetIndex = $input.data('_inputmask')['activeMasksetIndex'];
                            opts = $input.data('_inputmask')['opts'];
                            return maskScope(masksets, activeMasksetIndex, opts, { "action": "unmaskedvalue", "$input": $input });
                        } else return $input.val();
                    case "remove":
                        return this.each(function () {
                            var $input = $(this), input = this;
                            if ($input.data('_inputmask')) {
                                masksets = $input.data('_inputmask')['masksets'];
                                activeMasksetIndex = $input.data('_inputmask')['activeMasksetIndex'];
                                opts = $input.data('_inputmask')['opts'];
                                //writeout the unmaskedvalue
                                input._valueSet(maskScope(masksets, activeMasksetIndex, opts, { "action": "unmaskedvalue", "$input": $input, "skipDatepickerCheck": true }));
                                //clear data
                                $input.removeData('_inputmask');
                                //unbind all events
                                $input.unbind(".inputmask");
                                $input.removeClass('focus.inputmask');
                                //restore the value property
                                var valueProperty;
                                if (Object.getOwnPropertyDescriptor)
                                    valueProperty = Object.getOwnPropertyDescriptor(input, "value");
                                if (valueProperty && valueProperty.get) {
                                    if (input._valueGet) {
                                        Object.defineProperty(input, "value", {
                                            get: input._valueGet,
                                            set: input._valueSet
                                        });
                                    }
                                } else if (document.__lookupGetter__ && input.__lookupGetter__("value")) {
                                    if (input._valueGet) {
                                        input.__defineGetter__("value", input._valueGet);
                                        input.__defineSetter__("value", input._valueSet);
                                    }
                                }
                                try { //try catch needed for IE7 as it does not supports deleting fns
                                    delete input._valueGet;
                                    delete input._valueSet;
                                } catch (e) {
                                    input._valueGet = undefined;
                                    input._valueSet = undefined;

                                }
                            }
                        });
                        break;
                    case "getemptymask": //return the default (empty) mask value, usefull for setting the default value in validation
                        if (this.data('_inputmask')) {
                            masksets = this.data('_inputmask')['masksets'];
                            activeMasksetIndex = this.data('_inputmask')['activeMasksetIndex'];
                            return masksets[activeMasksetIndex]['_buffer'].join('');
                        }
                        else return "";
                    case "hasMaskedValue": //check wheter the returned value is masked or not; currently only works reliable when using jquery.val fn to retrieve the value 
                        return this.data('_inputmask') ? !this.data('_inputmask')['opts'].autoUnmask : false;
                    case "isComplete":
                        masksets = this.data('_inputmask')['masksets'];
                        activeMasksetIndex = this.data('_inputmask')['activeMasksetIndex'];
                        opts = this.data('_inputmask')['opts'];
                        return maskScope(masksets, activeMasksetIndex, opts, { "action": "isComplete", "buffer": this[0]._valueGet().split('') });
                    case "getmetadata": //return mask metadata if exists
                        if (this.data('_inputmask')) {
                            masksets = this.data('_inputmask')['masksets'];
                            activeMasksetIndex = this.data('_inputmask')['activeMasksetIndex'];
                            return masksets[activeMasksetIndex]['metadata'];
                        }
                        else return undefined;
                    default:
                        //check if the fn is an alias
                        if (!resolveAlias(fn, options, opts)) {
                            //maybe fn is a mask so we try
                            //set mask
                            opts.mask = fn;
                        }
                        masksets = generateMaskSets(opts);
                        if (masksets.length == 0) { return this; }
                        return this.each(function () {
                            maskScope($.extend(true, {}, masksets), activeMasksetIndex, opts, { "action": "mask", "el": this });
                        });

                        break;
                }
            } else if (typeof fn == "object") {
                opts = $.extend(true, {}, $.inputmask.defaults, fn);

                resolveAlias(opts.alias, fn, opts); //resolve aliases
                masksets = generateMaskSets(opts);
                if (masksets.length == 0) { return this; }
                return this.each(function () {
                    maskScope($.extend(true, {}, masksets), activeMasksetIndex, opts, { "action": "mask", "el": this });
                });
            } else if (fn == undefined) {
                //look for data-inputmask atribute - the attribute should only contain optipns
                return this.each(function () {
                    var attrOptions = $(this).attr("data-inputmask");
                    if (attrOptions && attrOptions != "") {
                        try {
                            attrOptions = attrOptions.replace(new RegExp("'", "g"), '"');
                            var dataoptions = $.parseJSON("{" + attrOptions + "}");
                            $.extend(true, dataoptions, options);
                            opts = $.extend(true, {}, $.inputmask.defaults, dataoptions);
                            resolveAlias(opts.alias, dataoptions, opts);
                            opts.alias = undefined;
                            $(this).inputmask(opts);
                        } catch (ex) { } //need a more relax parseJSON
                    }
                });
            }
        };
    }
})(jQuery);

/*
Input Mask plugin extensions
http://github.com/RobinHerbots/jquery.inputmask
Copyright (c) 2010 - 2014 Robin Herbots
Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
Version: 0.0.0

Optional extensions on the jquery.inputmask base
*/
(function ($) {
    //date & time aliases
    $.extend($.inputmask.defaults.definitions, {
        'h': { //hours
            validator: "[01][0-9]|2[0-3]",
            cardinality: 2,
            prevalidator: [{ validator: "[0-2]", cardinality: 1 }]
        },
        's': { //seconds || minutes
            validator: "[0-5][0-9]",
            cardinality: 2,
            prevalidator: [{ validator: "[0-5]", cardinality: 1 }]
        },
        'd': { //basic day
            validator: "0[1-9]|[12][0-9]|3[01]",
            cardinality: 2,
            prevalidator: [{ validator: "[0-3]", cardinality: 1 }]
        },
        'm': { //basic month
            validator: "0[1-9]|1[012]",
            cardinality: 2,
            prevalidator: [{ validator: "[01]", cardinality: 1 }]
        },
        'y': { //basic year
            validator: "(19|20)\\d{2}",
            cardinality: 4,
            prevalidator: [
                        { validator: "[12]", cardinality: 1 },
                        { validator: "(19|20)", cardinality: 2 },
                        { validator: "(19|20)\\d", cardinality: 3 }
            ]
        }
    });
    $.extend($.inputmask.defaults.aliases, {
        'dd/mm/yyyy': {
            mask: "1/2/y",
            placeholder: "dd/mm/yyyy",
            regex: {
                val1pre: new RegExp("[0-3]"), //daypre
                val1: new RegExp("0[1-9]|[12][0-9]|3[01]"), //day
                val2pre: function (separator) { var escapedSeparator = $.inputmask.escapeRegex.call(this, separator); return new RegExp("((0[1-9]|[12][0-9]|3[01])" + escapedSeparator + "[01])"); }, //monthpre
                val2: function (separator) { var escapedSeparator = $.inputmask.escapeRegex.call(this, separator); return new RegExp("((0[1-9]|[12][0-9])" + escapedSeparator + "(0[1-9]|1[012]))|(30" + escapedSeparator + "(0[13-9]|1[012]))|(31" + escapedSeparator + "(0[13578]|1[02]))"); }//month
            },
            leapday: "29/02/",
            separator: '/',
            yearrange: { minyear: 1900, maxyear: 2099 },
            isInYearRange: function (chrs, minyear, maxyear) {
                var enteredyear = parseInt(chrs.concat(minyear.toString().slice(chrs.length)));
                var enteredyear2 = parseInt(chrs.concat(maxyear.toString().slice(chrs.length)));
                return (enteredyear != NaN ? minyear <= enteredyear && enteredyear <= maxyear : false) ||
            		   (enteredyear2 != NaN ? minyear <= enteredyear2 && enteredyear2 <= maxyear : false);
            },
            determinebaseyear: function (minyear, maxyear, hint) {
                var currentyear = (new Date()).getFullYear();
                if (minyear > currentyear) return minyear;
                if (maxyear < currentyear) {
                    var maxYearPrefix = maxyear.toString().slice(0, 2);
                    var maxYearPostfix = maxyear.toString().slice(2, 4);
                    while (maxyear < maxYearPrefix + hint) {
                        maxYearPrefix--;
                    }
                    var maxxYear = maxYearPrefix + maxYearPostfix;
                    return minyear > maxxYear ? minyear : maxxYear;
                }

                return currentyear;
            },
            onKeyUp: function (e, buffer, opts) {
                var $input = $(this);
                if (e.ctrlKey && e.keyCode == opts.keyCode.RIGHT) {
                    var today = new Date();
                    $input.val(today.getDate().toString() + (today.getMonth() + 1).toString() + today.getFullYear().toString());
                }
            },
            definitions: {
                '1': { //val1 ~ day or month
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var isValid = opts.regex.val1.test(chrs);
                        if (!strict && !isValid) {
                            if (chrs.charAt(1) == opts.separator || "-./".indexOf(chrs.charAt(1)) != -1) {
                                isValid = opts.regex.val1.test("0" + chrs.charAt(0));
                                if (isValid) {
                                    buffer[pos - 1] = "0";
                                    return { "pos": pos, "c": chrs.charAt(0) };
                                }
                            }
                        }
                        return isValid;
                    },
                    cardinality: 2,
                    prevalidator: [{
                        validator: function (chrs, buffer, pos, strict, opts) {
                            var isValid = opts.regex.val1pre.test(chrs);
                            if (!strict && !isValid) {
                                isValid = opts.regex.val1.test("0" + chrs);
                                if (isValid) {
                                    buffer[pos] = "0";
                                    pos++;
                                    return { "pos": pos };
                                }
                            }
                            return isValid;
                        }, cardinality: 1
                    }]
                },
                '2': { //val2 ~ day or month
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var frontValue = buffer.join('').substr(0, 3);
                        if (frontValue.indexOf(opts.placeholder[0]) != -1) frontValue = "01" + opts.separator;
                        var isValid = opts.regex.val2(opts.separator).test(frontValue + chrs);
                        if (!strict && !isValid) {
                            if (chrs.charAt(1) == opts.separator || "-./".indexOf(chrs.charAt(1)) != -1) {
                                isValid = opts.regex.val2(opts.separator).test(frontValue + "0" + chrs.charAt(0));
                                if (isValid) {
                                    buffer[pos - 1] = "0";
                                    return { "pos": pos, "c": chrs.charAt(0) };
                                }
                            }
                        }
                        return isValid;
                    },
                    cardinality: 2,
                    prevalidator: [{
                        validator: function (chrs, buffer, pos, strict, opts) {
                            var frontValue = buffer.join('').substr(0, 3);
                            if (frontValue.indexOf(opts.placeholder[0]) != -1) frontValue = "01" + opts.separator;
                            var isValid = opts.regex.val2pre(opts.separator).test(frontValue + chrs);
                            if (!strict && !isValid) {
                                isValid = opts.regex.val2(opts.separator).test(frontValue + "0" + chrs);
                                if (isValid) {
                                    buffer[pos] = "0";
                                    pos++;
                                    return { "pos": pos };
                                }
                            }
                            return isValid;
                        }, cardinality: 1
                    }]
                },
                'y': { //year
                    validator: function (chrs, buffer, pos, strict, opts) {
                        if (opts.isInYearRange(chrs, opts.yearrange.minyear, opts.yearrange.maxyear)) {
                            var dayMonthValue = buffer.join('').substr(0, 6);
                            if (dayMonthValue != opts.leapday)
                                return true;
                            else {
                                var year = parseInt(chrs, 10);//detect leap year
                                if (year % 4 === 0)
                                    if (year % 100 === 0)
                                        if (year % 400 === 0)
                                            return true;
                                        else return false;
                                    else return true;
                                else return false;
                            }
                        } else return false;
                    },
                    cardinality: 4,
                    prevalidator: [
                {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var isValid = opts.isInYearRange(chrs, opts.yearrange.minyear, opts.yearrange.maxyear);
                        if (!strict && !isValid) {
                            var yearPrefix = opts.determinebaseyear(opts.yearrange.minyear, opts.yearrange.maxyear, chrs + "0").toString().slice(0, 1);

                            isValid = opts.isInYearRange(yearPrefix + chrs, opts.yearrange.minyear, opts.yearrange.maxyear);
                            if (isValid) {
                                buffer[pos++] = yearPrefix[0];
                                return { "pos": pos };
                            }
                            yearPrefix = opts.determinebaseyear(opts.yearrange.minyear, opts.yearrange.maxyear, chrs + "0").toString().slice(0, 2);

                            isValid = opts.isInYearRange(yearPrefix + chrs, opts.yearrange.minyear, opts.yearrange.maxyear);
                            if (isValid) {
                                buffer[pos++] = yearPrefix[0];
                                buffer[pos++] = yearPrefix[1];
                                return { "pos": pos };
                            }
                        }
                        return isValid;
                    },
                    cardinality: 1
                },
                {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var isValid = opts.isInYearRange(chrs, opts.yearrange.minyear, opts.yearrange.maxyear);
                        if (!strict && !isValid) {
                            var yearPrefix = opts.determinebaseyear(opts.yearrange.minyear, opts.yearrange.maxyear, chrs).toString().slice(0, 2);

                            isValid = opts.isInYearRange(chrs[0] + yearPrefix[1] + chrs[1], opts.yearrange.minyear, opts.yearrange.maxyear);
                            if (isValid) {
                                buffer[pos++] = yearPrefix[1];
                                return { "pos": pos };
                            }

                            yearPrefix = opts.determinebaseyear(opts.yearrange.minyear, opts.yearrange.maxyear, chrs).toString().slice(0, 2);
                            if (opts.isInYearRange(yearPrefix + chrs, opts.yearrange.minyear, opts.yearrange.maxyear)) {
                                var dayMonthValue = buffer.join('').substr(0, 6);
                                if (dayMonthValue != opts.leapday)
                                    isValid = true;
                                else {
                                    var year = parseInt(chrs, 10);//detect leap year
                                    if (year % 4 === 0)
                                        if (year % 100 === 0)
                                            if (year % 400 === 0)
                                                isValid = true;
                                            else isValid = false;
                                        else isValid = true;
                                    else isValid = false;
                                }
                            } else isValid = false;
                            if (isValid) {
                                buffer[pos - 1] = yearPrefix[0];
                                buffer[pos++] = yearPrefix[1];
                                buffer[pos++] = chrs[0];
                                return { "pos": pos };
                            }
                        }
                        return isValid;
                    }, cardinality: 2
                },
                {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        return opts.isInYearRange(chrs, opts.yearrange.minyear, opts.yearrange.maxyear);
                    }, cardinality: 3
                }
                    ]
                }
            },
            insertMode: false,
            autoUnmask: false
        },
        'mm/dd/yyyy': {
            placeholder: "mm/dd/yyyy",
            alias: "dd/mm/yyyy", //reuse functionality of dd/mm/yyyy alias
            regex: {
                val2pre: function (separator) { var escapedSeparator = $.inputmask.escapeRegex.call(this, separator); return new RegExp("((0[13-9]|1[012])" + escapedSeparator + "[0-3])|(02" + escapedSeparator + "[0-2])"); }, //daypre
                val2: function (separator) { var escapedSeparator = $.inputmask.escapeRegex.call(this, separator); return new RegExp("((0[1-9]|1[012])" + escapedSeparator + "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" + escapedSeparator + "30)|((0[13578]|1[02])" + escapedSeparator + "31)"); }, //day
                val1pre: new RegExp("[01]"), //monthpre
                val1: new RegExp("0[1-9]|1[012]") //month
            },
            leapday: "02/29/",
            onKeyUp: function (e, buffer, opts) {
                var $input = $(this);
                if (e.ctrlKey && e.keyCode == opts.keyCode.RIGHT) {
                    var today = new Date();
                    $input.val((today.getMonth() + 1).toString() + today.getDate().toString() + today.getFullYear().toString());
                }
            }
        },
        'yyyy/mm/dd': {
            mask: "y/1/2",
            placeholder: "yyyy/mm/dd",
            alias: "mm/dd/yyyy",
            leapday: "/02/29",
            onKeyUp: function (e, buffer, opts) {
                var $input = $(this);
                if (e.ctrlKey && e.keyCode == opts.keyCode.RIGHT) {
                    var today = new Date();
                    $input.val(today.getFullYear().toString() + (today.getMonth() + 1).toString() + today.getDate().toString());
                }
            },
            definitions: {
                '2': { //val2 ~ day or month
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var frontValue = buffer.join('').substr(5, 3);
                        if (frontValue.indexOf(opts.placeholder[5]) != -1) frontValue = "01" + opts.separator;
                        var isValid = opts.regex.val2(opts.separator).test(frontValue + chrs);
                        if (!strict && !isValid) {
                            if (chrs.charAt(1) == opts.separator || "-./".indexOf(chrs.charAt(1)) != -1) {
                                isValid = opts.regex.val2(opts.separator).test(frontValue + "0" + chrs.charAt(0));
                                if (isValid) {
                                    buffer[pos - 1] = "0";
                                    return { "pos": pos, "c": chrs.charAt(0) };
                                }
                            }
                        }

                        //check leap yeap
                        if (isValid) {
                            var dayMonthValue = buffer.join('').substr(4, 4) + chrs;
                            if (dayMonthValue != opts.leapday)
                                return true;
                            else {
                                var year = parseInt(buffer.join('').substr(0, 4), 10);  //detect leap year
                                if (year % 4 === 0)
                                    if (year % 100 === 0)
                                        if (year % 400 === 0)
                                            return true;
                                        else return false;
                                    else return true;
                                else return false;
                            }
                        }

                        return isValid;
                    },
                    cardinality: 2,
                    prevalidator: [{
                        validator: function (chrs, buffer, pos, strict, opts) {
                            var frontValue = buffer.join('').substr(5, 3);
                            if (frontValue.indexOf(opts.placeholder[5]) != -1) frontValue = "01" + opts.separator;
                            var isValid = opts.regex.val2pre(opts.separator).test(frontValue + chrs);
                            if (!strict && !isValid) {
                                isValid = opts.regex.val2(opts.separator).test(frontValue + "0" + chrs);
                                if (isValid) {
                                    buffer[pos] = "0";
                                    pos++;
                                    return { "pos": pos };
                                }
                            }
                            return isValid;
                        }, cardinality: 1
                    }]
                }
            }
        },
        'dd.mm.yyyy': {
            mask: "1.2.y",
            placeholder: "dd.mm.yyyy",
            leapday: "29.02.",
            separator: '.',
            alias: "dd/mm/yyyy"
        },
        'dd-mm-yyyy': {
            mask: "1-2-y",
            placeholder: "dd-mm-yyyy",
            leapday: "29-02-",
            separator: '-',
            alias: "dd/mm/yyyy"
        },
        'mm.dd.yyyy': {
            mask: "1.2.y",
            placeholder: "mm.dd.yyyy",
            leapday: "02.29.",
            separator: '.',
            alias: "mm/dd/yyyy"
        },
        'mm-dd-yyyy': {
            mask: "1-2-y",
            placeholder: "mm-dd-yyyy",
            leapday: "02-29-",
            separator: '-',
            alias: "mm/dd/yyyy"
        },
        'yyyy.mm.dd': {
            mask: "y.1.2",
            placeholder: "yyyy.mm.dd",
            leapday: ".02.29",
            separator: '.',
            alias: "yyyy/mm/dd"
        },
        'yyyy-mm-dd': {
            mask: "y-1-2",
            placeholder: "yyyy-mm-dd",
            leapday: "-02-29",
            separator: '-',
            alias: "yyyy/mm/dd"
        },
        'datetime': {
            mask: "1/2/y h:s",
            placeholder: "dd/mm/yyyy hh:mm",
            alias: "dd/mm/yyyy",
            regex: {
                hrspre: new RegExp("[012]"), //hours pre
                hrs24: new RegExp("2[0-9]|1[3-9]"),
                hrs: new RegExp("[01][0-9]|2[0-3]"), //hours
                ampm: new RegExp("^[a|p|A|P][m|M]")
            },
            timeseparator: ':',
            hourFormat: "24", // or 12
            definitions: {
                'h': { //hours
                    validator: function (chrs, buffer, pos, strict, opts) {
                        var isValid = opts.regex.hrs.test(chrs);
                        if (!strict && !isValid) {
                            if (chrs.charAt(1) == opts.timeseparator || "-.:".indexOf(chrs.charAt(1)) != -1) {
                                isValid = opts.regex.hrs.test("0" + chrs.charAt(0));
                                if (isValid) {
                                    buffer[pos - 1] = "0";
                                    buffer[pos] = chrs.charAt(0);
                                    pos++;
                                    return { "pos": pos };
                                }
                            }
                        }

                        if (isValid && opts.hourFormat !== "24" && opts.regex.hrs24.test(chrs)) {

                            var tmp = parseInt(chrs, 10);

                            if (tmp == 24) {
                                buffer[pos + 5] = "a";
                                buffer[pos + 6] = "m";
                            } else {
                                buffer[pos + 5] = "p";
                                buffer[pos + 6] = "m";
                            }

                            tmp = tmp - 12;

                            if (tmp < 10) {
                                buffer[pos] = tmp.toString();
                                buffer[pos - 1] = "0";
                            } else {
                                buffer[pos] = tmp.toString().charAt(1);
                                buffer[pos - 1] = tmp.toString().charAt(0);
                            }

                            return { "pos": pos, "c": buffer[pos] };
                        }

                        return isValid;
                    },
                    cardinality: 2,
                    prevalidator: [{
                        validator: function (chrs, buffer, pos, strict, opts) {
                            var isValid = opts.regex.hrspre.test(chrs);
                            if (!strict && !isValid) {
                                isValid = opts.regex.hrs.test("0" + chrs);
                                if (isValid) {
                                    buffer[pos] = "0";
                                    pos++;
                                    return { "pos": pos };
                                }
                            }
                            return isValid;
                        }, cardinality: 1
                    }]
                },
                't': { //am/pm
                    validator: function (chrs, buffer, pos, strict, opts) {
                        return opts.regex.ampm.test(chrs + "m");
                    },
                    casing: "lower",
                    cardinality: 1
                }
            },
            insertMode: false,
            autoUnmask: false
        },
        'datetime12': {
            mask: "1/2/y h:s t\\m",
            placeholder: "dd/mm/yyyy hh:mm xm",
            alias: "datetime",
            hourFormat: "12"
        },
        'hh:mm t': {
            mask: "h:s t\\m",
            placeholder: "hh:mm xm",
            alias: "datetime",
            hourFormat: "12"
        },
        'h:s t': {
            mask: "h:s t\\m",
            placeholder: "hh:mm xm",
            alias: "datetime",
            hourFormat: "12"
        },
        'hh:mm:ss': {
            mask: "h:s:s",
            autoUnmask: false
        },
        'hh:mm': {
            mask: "h:s",
            autoUnmask: false
        },
        'date': {
            alias: "dd/mm/yyyy" // "mm/dd/yyyy"
        },
        'mm/yyyy': {
            mask: "1/y",
            placeholder: "mm/yyyy",
            leapday: "donotuse",
            separator: '/',
            alias: "mm/dd/yyyy"
        }
    });
})(jQuery);

/*
Input Mask plugin extensions
http://github.com/RobinHerbots/jquery.inputmask
Copyright (c) 2010 - 2014 Robin Herbots
Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
Version: 0.0.0

Optional extensions on the jquery.inputmask base
*/
(function ($) {
    //extra definitions
    $.extend($.inputmask.defaults.definitions, {
        'A': {
            validator: "[A-Za-z]",
            cardinality: 1,
            casing: "upper" //auto uppercasing
        },
        '#': {
            validator: "[A-Za-z\u0410-\u044F\u0401\u04510-9]",
            cardinality: 1,
            casing: "upper"
        }
    });
    $.extend($.inputmask.defaults.aliases, {
        'url': {
            mask: "ir",
            placeholder: "",
            separator: "",
            defaultPrefix: "http://",
            regex: {
                urlpre1: new RegExp("[fh]"),
                urlpre2: new RegExp("(ft|ht)"),
                urlpre3: new RegExp("(ftp|htt)"),
                urlpre4: new RegExp("(ftp:|http|ftps)"),
                urlpre5: new RegExp("(ftp:/|ftps:|http:|https)"),
                urlpre6: new RegExp("(ftp://|ftps:/|http:/|https:)"),
                urlpre7: new RegExp("(ftp://|ftps://|http://|https:/)"),
                urlpre8: new RegExp("(ftp://|ftps://|http://|https://)")
            },
            definitions: {
                'i': {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        return true;
                    },
                    cardinality: 8,
                    prevalidator: (function () {
                        var result = [], prefixLimit = 8;
                        for (var i = 0; i < prefixLimit; i++) {
                            result[i] = (function () {
                                var j = i;
                                return {
                                    validator: function (chrs, buffer, pos, strict, opts) {
                                        if (opts.regex["urlpre" + (j + 1)]) {
                                            var tmp = chrs, k;
                                            if (((j + 1) - chrs.length) > 0) {
                                                tmp = buffer.join('').substring(0, ((j + 1) - chrs.length)) + "" + tmp;
                                            }
                                            var isValid = opts.regex["urlpre" + (j + 1)].test(tmp);
                                            if (!strict && !isValid) {
                                                pos = pos - j;
                                                for (k = 0; k < opts.defaultPrefix.length; k++) {
                                                    buffer[pos] = opts.defaultPrefix[k]; pos++;
                                                }
                                                for (k = 0; k < tmp.length - 1; k++) {
                                                    buffer[pos] = tmp[k]; pos++;
                                                }
                                                return { "pos": pos };
                                            }
                                            return isValid;
                                        } else {
                                            return false;
                                        }
                                    }, cardinality: j
                                };
                            })();
                        }
                        return result;
                    })()
                },
                "r": {
                    validator: ".",
                    cardinality: 50
                }
            },
            insertMode: false,
            autoUnmask: false
        },
        "ip": { //ip-address mask
            mask: ["[[x]y]z.[[x]y]z.[[x]y]z.x[yz]", "[[x]y]z.[[x]y]z.[[x]y]z.[[x]y][z]"],
            definitions: {
                'x': {
                    validator: "[012]",
                    cardinality: 1,
                    definitionSymbol: "i"
                },
                'y': {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        if (pos - 1 > -1 && buffer[pos - 1] != ".")
                            chrs = buffer[pos - 1] + chrs;
                        else chrs = "0" + chrs;
                        return new RegExp("2[0-5]|[01][0-9]").test(chrs);
                    },
                    cardinality: 1,
                    definitionSymbol: "i"
                },
                'z': {
                    validator: function (chrs, buffer, pos, strict, opts) {
                        if (pos - 1 > -1 && buffer[pos - 1] != ".") {
                            chrs = buffer[pos - 1] + chrs;
                            if (pos - 2 > -1 && buffer[pos - 2] != ".") {
                                chrs = buffer[pos - 2] + chrs;
                            } else chrs = "0" + chrs;
                        } else chrs = "00" + chrs;
                        return new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(chrs);
                    },
                    cardinality: 1,
                    definitionSymbol: "i"
                }
            }
        }
    });
})(jQuery);
