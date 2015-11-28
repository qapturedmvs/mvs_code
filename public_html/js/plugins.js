////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ANGULAR PLUGINS
/* ng-infinite-scroll - v1.0.0 - 2013-02-23 */
var mod;mod=angular.module("infinite-scroll",[]),mod.directive("infiniteScroll",["$rootScope","$window","$timeout",function(i,n,e){return{link:function(t,l,o){var r,c,f,a;return n=angular.element(n),f=0,null!=o.infiniteScrollDistance&&t.$watch(o.infiniteScrollDistance,function(i){return f=parseInt(i,10)}),a=!0,r=!1,null!=o.infiniteScrollDisabled&&t.$watch(o.infiniteScrollDisabled,function(i){return a=!i,a&&r?(r=!1,c()):void 0}),c=function(){var e,c,u,d;return d=n.height()+n.scrollTop(),e=l.offset().top+l.height(),c=e-d,u=n.height()*f>=c,u&&a?i.$$phase?t.$eval(o.infiniteScroll):t.$apply(o.infiniteScroll):u?r=!0:void 0},n.on("scroll",c),t.$on("$destroy",function(){return n.off("scroll",c)}),e(function(){return o.infiniteScrollImmediateCheck?t.$eval(o.infiniteScrollImmediateCheck)?c():void 0:c()},0)}}}]);

/* https://github.com/brantwills/Angular-Paging */
angular.module("brantwills.paging",[]).directive("paging",function(){function h(a,c){a.page!=c&&(a.page=c,a.pagingAction({page:a.page,pageSize:a.pageSize,total:a.total}),a.scrollTop&&scrollTo(0,0))}function m(a,c,d){var b,l,f,e,g;if(a.showPrevNext&&!(1>c)){var k;"prev"===d?(k=0>=a.page-1,c=0>=a.page-1?1:a.page-1,d="<<",e="First Page",g=1,b="<",l="Previous Page"):(k=a.page+1>c,d=">",e="Next Page",g=a.page+1>=c?c:a.page+1,b=">>",l="Last Page");f=c;c={value:b,title:l,liClass:k?a.disabledClass:"",action:function(){k||
h(a,f)}};a.List.push({value:d,title:e,liClass:k?a.disabledClass:"",action:function(){k||h(a,g)}});a.List.push(c)}}function e(a,c,d){for(var b=0,b=a;b<=c;b++)d.List.push({value:b,title:"Page "+b,liClass:d.page==b?d.activeClass:"",action:function(){h(d,this.value)}})}function g(a){a.List.push({value:a.dots})}return{restrict:"EA",scope:{page:"=",pageSize:"=",total:"=",dots:"@",hideIfEmpty:"@",ulClass:"@",activeClass:"@",disabledClass:"@",adjacent:"@",scrollTop:"@",showPrevNext:"@",pagingAction:"&"},
template:'<ul ng-hide="Hide" ng-class="ulClass"> <li title="{{Item.title}}" ng-class="Item.liClass" ng-click="Item.action()" ng-repeat="Item in List"> <span ng-bind="Item.value"></span> </li></ul>',link:function(a,c,d){a.$watchCollection("[page,pageSize,total]",function(){if(!a.pageSize||0>=a.pageSize)a.pageSize=1;var b=Math.ceil(a.total/a.pageSize);a.List=[];a.Hide=!1;a.dots=a.dots||"...";a.page=parseInt(a.page)||1;a.total=parseInt(a.total)||0;a.ulClass=a.ulClass||"pagination";a.adjacent=parseInt(a.adjacent)||
2;a.activeClass=a.activeClass||"active";a.disabledClass=a.disabledClass||"disabled";a.scrollTop=a.$eval(d.scrollTop);a.hideIfEmpty=a.$eval(d.hideIfEmpty);a.showPrevNext=a.$eval(d.showPrevNext);a.page>b&&(a.page=b);0>=a.page&&(a.page=1);0>=a.adjacent&&(a.adjacent=2);1>=b&&(a.Hide=a.hideIfEmpty);var c,f;c=2*a.adjacent+2;m(a,b,"prev");if(b<=c+2)e(1,b,a);else if(2>=a.page-a.adjacent)f=1+c,e(1,f,a),f!=b-2&&g(a),e(b-1,b,a);else if(a.page<b-(a.adjacent+2)){c=a.page-a.adjacent;f=a.page+a.adjacent;var h=c;
e(1,2,a);3!=h&&g(a);e(c,f,a);f!=b-2&&g(a);e(b-1,b,a)}else c=b-c,f=b,h=c,e(1,2,a),3!=h&&g(a),e(c,f,a);m(a,b,"next")})}}});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////// JQUERY PLUGINS

/*! Lazy Load 1.9.3 - MIT license - Copyright 2010-2013 Mika Tuupola */
!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);

/*! jQuery Validation Plugin - v1.13.1 - 10/14/2014
 * http://jqueryvalidation.org/
 * Copyright (c) 2014 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){a.extend(a.fn,{validate:function(b){if(!this.length)return void(b&&b.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing."));var c=a.data(this[0],"validator");return c?c:(this.attr("novalidate","novalidate"),c=new a.validator(b,this[0]),a.data(this[0],"validator",c),c.settings.onsubmit&&(this.validateDelegate(":submit","click",function(b){c.settings.submitHandler&&(c.submitButton=b.target),a(b.target).hasClass("cancel")&&(c.cancelSubmit=!0),void 0!==a(b.target).attr("formnovalidate")&&(c.cancelSubmit=!0)}),this.submit(function(b){function d(){var d,e;return c.settings.submitHandler?(c.submitButton&&(d=a("<input type='hidden'/>").attr("name",c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)),e=c.settings.submitHandler.call(c,c.currentForm,b),c.submitButton&&d.remove(),void 0!==e?e:!1):!0}return c.settings.debug&&b.preventDefault(),c.cancelSubmit?(c.cancelSubmit=!1,d()):c.form()?c.pendingRequest?(c.formSubmitted=!0,!1):d():(c.focusInvalid(),!1)})),c)},valid:function(){var b,c;return a(this[0]).is("form")?b=this.validate().form():(b=!0,c=a(this[0].form).validate(),this.each(function(){b=c.element(this)&&b})),b},removeAttrs:function(b){var c={},d=this;return a.each(b.split(/\s/),function(a,b){c[b]=d.attr(b),d.removeAttr(b)}),c},rules:function(b,c){var d,e,f,g,h,i,j=this[0];if(b)switch(d=a.data(j.form,"validator").settings,e=d.rules,f=a.validator.staticRules(j),b){case"add":a.extend(f,a.validator.normalizeRule(c)),delete f.messages,e[j.name]=f,c.messages&&(d.messages[j.name]=a.extend(d.messages[j.name],c.messages));break;case"remove":return c?(i={},a.each(c.split(/\s/),function(b,c){i[c]=f[c],delete f[c],"required"===c&&a(j).removeAttr("aria-required")}),i):(delete e[j.name],f)}return g=a.validator.normalizeRules(a.extend({},a.validator.classRules(j),a.validator.attributeRules(j),a.validator.dataRules(j),a.validator.staticRules(j)),j),g.required&&(h=g.required,delete g.required,g=a.extend({required:h},g),a(j).attr("aria-required","true")),g.remote&&(h=g.remote,delete g.remote,g=a.extend(g,{remote:h})),g}}),a.extend(a.expr[":"],{blank:function(b){return!a.trim(""+a(b).val())},filled:function(b){return!!a.trim(""+a(b).val())},unchecked:function(b){return!a(b).prop("checked")}}),a.validator=function(b,c){this.settings=a.extend(!0,{},a.validator.defaults,b),this.currentForm=c,this.init()},a.validator.format=function(b,c){return 1===arguments.length?function(){var c=a.makeArray(arguments);return c.unshift(b),a.validator.format.apply(this,c)}:(arguments.length>2&&c.constructor!==Array&&(c=a.makeArray(arguments).slice(1)),c.constructor!==Array&&(c=[c]),a.each(c,function(a,c){b=b.replace(new RegExp("\\{"+a+"\\}","g"),function(){return c})}),b)},a.extend(a.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",validClass:"valid",errorElement:"label",focusCleanup:!1,focusInvalid:!0,errorContainer:a([]),errorLabelContainer:a([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(a){this.lastActive=a,this.settings.focusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass),this.hideThese(this.errorsFor(a)))},onfocusout:function(a){this.checkable(a)||!(a.name in this.submitted)&&this.optional(a)||this.element(a)},onkeyup:function(a,b){(9!==b.which||""!==this.elementValue(a))&&(a.name in this.submitted||a===this.lastElement)&&this.element(a)},onclick:function(a){a.name in this.submitted?this.element(a):a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).addClass(c).removeClass(d):a(b).addClass(c).removeClass(d)},unhighlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).removeClass(c).addClass(d):a(b).removeClass(c).addClass(d)}},setDefaults:function(b){a.extend(a.validator.defaults,b)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date ( ISO ).",number:"Please enter a valid number.",digits:"Please enter only digits.",creditcard:"Please enter a valid credit card number.",equalTo:"Please enter the same value again.",maxlength:a.validator.format("Please enter no more than {0} characters."),minlength:a.validator.format("Please enter at least {0} characters."),rangelength:a.validator.format("Please enter a value between {0} and {1} characters long."),range:a.validator.format("Please enter a value between {0} and {1}."),max:a.validator.format("Please enter a value less than or equal to {0}."),min:a.validator.format("Please enter a value greater than or equal to {0}.")},autoCreateRanges:!1,prototype:{init:function(){function b(b){var c=a.data(this[0].form,"validator"),d="on"+b.type.replace(/^validate/,""),e=c.settings;e[d]&&!this.is(e.ignore)&&e[d].call(c,this[0],b)}this.labelContainer=a(this.settings.errorLabelContainer),this.errorContext=this.labelContainer.length&&this.labelContainer||a(this.currentForm),this.containers=a(this.settings.errorContainer).add(this.settings.errorLabelContainer),this.submitted={},this.valueCache={},this.pendingRequest=0,this.pending={},this.invalid={},this.reset();var c,d=this.groups={};a.each(this.settings.groups,function(b,c){"string"==typeof c&&(c=c.split(/\s/)),a.each(c,function(a,c){d[c]=b})}),c=this.settings.rules,a.each(c,function(b,d){c[b]=a.validator.normalizeRule(d)}),a(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']","focusin focusout keyup",b).validateDelegate("select, option, [type='radio'], [type='checkbox']","click",b),this.settings.invalidHandler&&a(this.currentForm).bind("invalid-form.validate",this.settings.invalidHandler),a(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required","true")},form:function(){return this.checkForm(),a.extend(this.submitted,this.errorMap),this.invalid=a.extend({},this.errorMap),this.valid()||a(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(b){var c=this.clean(b),d=this.validationTargetFor(c),e=!0;return this.lastElement=d,void 0===d?delete this.invalid[c.name]:(this.prepareElement(d),this.currentElements=a(d),e=this.check(d)!==!1,e?delete this.invalid[d.name]:this.invalid[d.name]=!0),a(b).attr("aria-invalid",!e),this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),e},showErrors:function(b){if(b){a.extend(this.errorMap,b),this.errorList=[];for(var c in b)this.errorList.push({message:b[c],element:this.findByName(c)[0]});this.successList=a.grep(this.successList,function(a){return!(a.name in b)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){a.fn.resetForm&&a(this.currentForm).resetForm(),this.submitted={},this.lastElement=null,this.prepareForm(),this.hideErrors(),this.elements().removeClass(this.settings.errorClass).removeData("previousValue").removeAttr("aria-invalid")},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b,c=0;for(b in a)c++;return c},hideErrors:function(){this.hideThese(this.toHide)},hideThese:function(a){a.not(this.containers).text(""),this.addWrapper(a).hide()},valid:function(){return 0===this.size()},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{a(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(b){}},findLastActive:function(){var b=this.lastActive;return b&&1===a.grep(this.errorList,function(a){return a.element.name===b.name}).length&&b},elements:function(){var b=this,c={};return a(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled], [readonly]").not(this.settings.ignore).filter(function(){return!this.name&&b.settings.debug&&window.console&&console.error("%o has no name assigned",this),this.name in c||!b.objectLength(a(this).rules())?!1:(c[this.name]=!0,!0)})},clean:function(b){return a(b)[0]},errors:function(){var b=this.settings.errorClass.split(" ").join(".");return a(this.settings.errorElement+"."+b,this.errorContext)},reset:function(){this.successList=[],this.errorList=[],this.errorMap={},this.toShow=a([]),this.toHide=a([]),this.currentElements=a([])},prepareForm:function(){this.reset(),this.toHide=this.errors().add(this.containers)},prepareElement:function(a){this.reset(),this.toHide=this.errorsFor(a)},elementValue:function(b){var c,d=a(b),e=b.type;return"radio"===e||"checkbox"===e?a("input[name='"+b.name+"']:checked").val():"number"===e&&"undefined"!=typeof b.validity?b.validity.badInput?!1:d.val():(c=d.val(),"string"==typeof c?c.replace(/\r/g,""):c)},check:function(b){b=this.validationTargetFor(this.clean(b));var c,d,e,f=a(b).rules(),g=a.map(f,function(a,b){return b}).length,h=!1,i=this.elementValue(b);for(d in f){e={method:d,parameters:f[d]};try{if(c=a.validator.methods[d].call(this,i,b,e.parameters),"dependency-mismatch"===c&&1===g){h=!0;continue}if(h=!1,"pending"===c)return void(this.toHide=this.toHide.not(this.errorsFor(b)));if(!c)return this.formatAndAdd(b,e),!1}catch(j){throw this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+b.id+", check the '"+e.method+"' method.",j),j}}if(!h)return this.objectLength(f)&&this.successList.push(b),!0},customDataMessage:function(b,c){return a(b).data("msg"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase())||a(b).data("msg")},customMessage:function(a,b){var c=this.settings.messages[a];return c&&(c.constructor===String?c:c[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(void 0!==arguments[a])return arguments[a];return void 0},defaultMessage:function(b,c){return this.findDefined(this.customMessage(b.name,c),this.customDataMessage(b,c),!this.settings.ignoreTitle&&b.title||void 0,a.validator.messages[c],"<strong>Warning: No message defined for "+b.name+"</strong>")},formatAndAdd:function(b,c){var d=this.defaultMessage(b,c.method),e=/\$?\{(\d+)\}/g;"function"==typeof d?d=d.call(this,c.parameters,b):e.test(d)&&(d=a.validator.format(d.replace(e,"{$1}"),c.parameters)),this.errorList.push({message:d,element:b,method:c.method}),this.errorMap[b.name]=d,this.submitted[b.name]=d},addWrapper:function(a){return this.settings.wrapper&&(a=a.add(a.parent(this.settings.wrapper))),a},defaultShowErrors:function(){var a,b,c;for(a=0;this.errorList[a];a++)c=this.errorList[a],this.settings.highlight&&this.settings.highlight.call(this,c.element,this.settings.errorClass,this.settings.validClass),this.showLabel(c.element,c.message);if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);if(this.settings.unhighlight)for(a=0,b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow),this.hideErrors(),this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return a(this.errorList).map(function(){return this.element})},showLabel:function(b,c){var d,e,f,g=this.errorsFor(b),h=this.idOrName(b),i=a(b).attr("aria-describedby");g.length?(g.removeClass(this.settings.validClass).addClass(this.settings.errorClass),g.html(c)):(g=a("<"+this.settings.errorElement+">").attr("id",h+"-error").addClass(this.settings.errorClass).html(c||""),d=g,this.settings.wrapper&&(d=g.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.length?this.labelContainer.append(d):this.settings.errorPlacement?this.settings.errorPlacement(d,a(b)):d.insertAfter(b),g.is("label")?g.attr("for",h):0===g.parents("label[for='"+h+"']").length&&(f=g.attr("id").replace(/(:|\.|\[|\])/g,"\\$1"),i?i.match(new RegExp("\\b"+f+"\\b"))||(i+=" "+f):i=f,a(b).attr("aria-describedby",i),e=this.groups[b.name],e&&a.each(this.groups,function(b,c){c===e&&a("[name='"+b+"']",this.currentForm).attr("aria-describedby",g.attr("id"))}))),!c&&this.settings.success&&(g.text(""),"string"==typeof this.settings.success?g.addClass(this.settings.success):this.settings.success(g,b)),this.toShow=this.toShow.add(g)},errorsFor:function(b){var c=this.idOrName(b),d=a(b).attr("aria-describedby"),e="label[for='"+c+"'], label[for='"+c+"'] *";return d&&(e=e+", #"+d.replace(/\s+/g,", #")),this.errors().filter(e)},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(b){return this.checkable(b)&&(b=this.findByName(b.name)),a(b).not(this.settings.ignore)[0]},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(b){return a(this.currentForm).find("[name='"+b+"']")},getLength:function(b,c){switch(c.nodeName.toLowerCase()){case"select":return a("option:selected",c).length;case"input":if(this.checkable(c))return this.findByName(c.name).filter(":checked").length}return b.length},depend:function(a,b){return this.dependTypes[typeof a]?this.dependTypes[typeof a](a,b):!0},dependTypes:{"boolean":function(a){return a},string:function(b,c){return!!a(b,c.form).length},"function":function(a,b){return a(b)}},optional:function(b){var c=this.elementValue(b);return!a.validator.methods.required.call(this,c,b)&&"dependency-mismatch"},startRequest:function(a){this.pending[a.name]||(this.pendingRequest++,this.pending[a.name]=!0)},stopRequest:function(b,c){this.pendingRequest--,this.pendingRequest<0&&(this.pendingRequest=0),delete this.pending[b.name],c&&0===this.pendingRequest&&this.formSubmitted&&this.form()?(a(this.currentForm).submit(),this.formSubmitted=!1):!c&&0===this.pendingRequest&&this.formSubmitted&&(a(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)},previousValue:function(b){return a.data(b,"previousValue")||a.data(b,"previousValue",{old:null,valid:!0,message:this.defaultMessage(b,"remote")})}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(b,c){b.constructor===String?this.classRuleSettings[b]=c:a.extend(this.classRuleSettings,b)},classRules:function(b){var c={},d=a(b).attr("class");return d&&a.each(d.split(" "),function(){this in a.validator.classRuleSettings&&a.extend(c,a.validator.classRuleSettings[this])}),c},attributeRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)"required"===c?(d=b.getAttribute(c),""===d&&(d=!0),d=!!d):d=f.attr(c),/min|max/.test(c)&&(null===g||/number|range|text/.test(g))&&(d=Number(d)),d||0===d?e[c]=d:g===c&&"range"!==g&&(e[c]=!0);return e.maxlength&&/-1|2147483647|524288/.test(e.maxlength)&&delete e.maxlength,e},dataRules:function(b){var c,d,e={},f=a(b);for(c in a.validator.methods)d=f.data("rule"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase()),void 0!==d&&(e[c]=d);return e},staticRules:function(b){var c={},d=a.data(b.form,"validator");return d.settings.rules&&(c=a.validator.normalizeRule(d.settings.rules[b.name])||{}),c},normalizeRules:function(b,c){return a.each(b,function(d,e){if(e===!1)return void delete b[d];if(e.param||e.depends){var f=!0;switch(typeof e.depends){case"string":f=!!a(e.depends,c.form).length;break;case"function":f=e.depends.call(c,c)}f?b[d]=void 0!==e.param?e.param:!0:delete b[d]}}),a.each(b,function(d,e){b[d]=a.isFunction(e)?e(c):e}),a.each(["minlength","maxlength"],function(){b[this]&&(b[this]=Number(b[this]))}),a.each(["rangelength","range"],function(){var c;b[this]&&(a.isArray(b[this])?b[this]=[Number(b[this][0]),Number(b[this][1])]:"string"==typeof b[this]&&(c=b[this].replace(/[\[\]]/g,"").split(/[\s,]+/),b[this]=[Number(c[0]),Number(c[1])]))}),a.validator.autoCreateRanges&&(null!=b.min&&null!=b.max&&(b.range=[b.min,b.max],delete b.min,delete b.max),null!=b.minlength&&null!=b.maxlength&&(b.rangelength=[b.minlength,b.maxlength],delete b.minlength,delete b.maxlength)),b},normalizeRule:function(b){if("string"==typeof b){var c={};a.each(b.split(/\s/),function(){c[this]=!0}),b=c}return b},addMethod:function(b,c,d){a.validator.methods[b]=c,a.validator.messages[b]=void 0!==d?d:a.validator.messages[b],c.length<3&&a.validator.addClassRules(b,a.validator.normalizeRule(b))},methods:{required:function(b,c,d){if(!this.depend(d,c))return"dependency-mismatch";if("select"===c.nodeName.toLowerCase()){var e=a(c).val();return e&&e.length>0}return this.checkable(c)?this.getLength(b,c)>0:a.trim(b).length>0},email:function(a,b){return this.optional(b)||/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)},url:function(a,b){return this.optional(b)||/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)},date:function(a,b){return this.optional(b)||!/Invalid|NaN/.test(new Date(a).toString())},dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)},number:function(a,b){return this.optional(b)||/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},creditcard:function(a,b){if(this.optional(b))return"dependency-mismatch";if(/[^0-9 \-]+/.test(a))return!1;var c,d,e=0,f=0,g=!1;if(a=a.replace(/\D/g,""),a.length<13||a.length>19)return!1;for(c=a.length-1;c>=0;c--)d=a.charAt(c),f=parseInt(d,10),g&&(f*=2)>9&&(f-=9),e+=f,g=!g;return e%10===0},minlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d},maxlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||d>=e},rangelength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d[0]&&e<=d[1]},min:function(a,b,c){return this.optional(b)||a>=c},max:function(a,b,c){return this.optional(b)||c>=a},range:function(a,b,c){return this.optional(b)||a>=c[0]&&a<=c[1]},equalTo:function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.unbind(".validate-equalTo").bind("blur.validate-equalTo",function(){a(c).valid()}),b===e.val()},remote:function(b,c,d){if(this.optional(c))return"dependency-mismatch";var e,f,g=this.previousValue(c);return this.settings.messages[c.name]||(this.settings.messages[c.name]={}),g.originalMessage=this.settings.messages[c.name].remote,this.settings.messages[c.name].remote=g.message,d="string"==typeof d&&{url:d}||d,g.old===b?g.valid:(g.old=b,e=this,this.startRequest(c),f={},f[c.name]=b,a.ajax(a.extend(!0,{url:d,mode:"abort",port:"validate"+c.name,dataType:"json",data:f,context:e.currentForm,success:function(d){var f,h,i,j=d===!0||"true"===d;e.settings.messages[c.name].remote=g.originalMessage,j?(i=e.formSubmitted,e.prepareElement(c),e.formSubmitted=i,e.successList.push(c),delete e.invalid[c.name],e.showErrors()):(f={},h=d||e.defaultMessage(c,"remote"),f[c.name]=g.message=a.isFunction(h)?h(b):h,e.invalid[c.name]=!0,e.showErrors(f)),g.valid=j,e.stopRequest(c,j)}},d)),"pending")}}}),a.format=function(){throw"$.format has been deprecated. Please use $.validator.format instead."};var b,c={};a.ajaxPrefilter?a.ajaxPrefilter(function(a,b,d){var e=a.port;"abort"===a.mode&&(c[e]&&c[e].abort(),c[e]=d)}):(b=a.ajax,a.ajax=function(d){var e=("mode"in d?d:a.ajaxSettings).mode,f=("port"in d?d:a.ajaxSettings).port;return"abort"===e?(c[f]&&c[f].abort(),c[f]=b.apply(this,arguments),c[f]):b.apply(this,arguments)}),a.extend(a.fn,{validateDelegate:function(b,c,d){return this.bind(c,function(c){var e=a(c.target);return e.is(b)?d.apply(e,arguments):void 0})}})});

/* QS Manager v2.5 - 2014 */
var qsManager={hash:window.location.hash,query:window.location.search,url:window.location.href,gdata:function(){return sessionStorage.qs_manager},sdata:function(a){sessionStorage.qs_manager=a},history:function(a){history.pushState({qsManager:!0},"",a)},qto:function(a){var d={};if(""!=a&&null!=a&&void 0!=a){a=a.substring(a.indexOf("?")+1,a.length+1).split("&");for(var b,e,c=0;c<a.length;c++)b=a[c].split("="),e=b[1].split(","),d[b[0]]=e}return d},otq:function(a){var d="";if(""!=a&&null!=a&&void 0!=
a)for(var b in a)a.hasOwnProperty(b)&&(d+=0==d.length?"?"+b+"="+a[b]:"&"+b+"="+a[b]);return d},mput:function(a,d,b,e){var c=this.qto(this.gdata()),f=this.url.replace(this.hash,"");a=a.split("|");d=d.split("|");void 0==b&&(b=!0);for(var g=0;g<a.length;g++)if(void 0!=c[a[g]]){sParam=d[g].split(",");for(var h=0;h<sParam.length;h++)-1!=c[a[g]].indexOf(sParam[h])?(b&&c[a[g]].splice(c[a[g]].indexOf(sParam[h]),1),""==c[a[g]]&&delete c[a[g]]):c[a[g]].push(sParam[h])}else c[a[g]]=d[g];f=""==this.query?f+this.otq(c)+
this.hash:f.replace(this.query,this.otq(c))+this.hash;this.sdata(this.otq(c));e?this.history(f):window.location=f},put:function(a,d,b){var e=this.qto(this.gdata()),c=this.url.replace(this.hash,"");a=a.split("|");d=d.split("|");for(var f=0;f<a.length;f++)void 0!=e[a[f]]&&e[a[f]]==d[f]?delete e[a[f]]:e[a[f]]=d[f];c=""==this.query?c+this.otq(e)+this.hash:c.replace(this.query,this.otq(e))+this.hash;this.sdata(this.otq(e));b?this.history(c):window.location=c},get:function(a,d){var b=void 0==d?this.gdata():
d,b=this.qto(b.substring(b.indexOf("?"),b.length)),e=null;void 0!=b[a]&&(e=b[a].toString());return decodeURIComponent(e)},remove:function(a,d){var b=this.qto(this.gdata()),e=this.url.replace(this.hash,"");a=a.split("|");for(var c=0;c<a.length;c++)void 0!=b[a[c]]&&delete b[a[c]];e=""==this.query?e+this.otq(b)+this.hash:e.replace(this.query,this.otq(b))+this.hash;this.sdata(this.otq(b));d?this.history(e):window.location=e}};qsManager.sdata(qsManager.query);

/* Minus Dropdown */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// MINUS DROPDOWN
(function($) {
    $.fn.extend({
        qptDropDown: function(options, callback) {
            var defaults = {
                type: "hover",
                customClass: "hover",
                delay: 555,
                openedDelay: 0,
                className: "",
                clicked: "",
                openedControl: "",
                hideDropDown: [],
                attachmentDiv: null,
                isVisible: null,
				overlay: null,
				parents: null,
				toggle: true
            };
            var options = $.extend(defaults, options);
            return this.each(function() {
                
				var holder = $(this),
                    o = options,
                    attachmentDiv = o.attachmentDiv != null ? $(o.attachmentDiv) : null,
                    stm = null,
                    bdy = $('body');
				
				if( holder.hasClass('activePlug') ) return false;
									
                function init() {
                    if (o.type == "hover") {
                        holder.mouseenter(events.mouseenter).mouseleave(events.mouseleave);
                        if (attachmentDiv != null) attachmentDiv.mouseenter(events.mouseenter).mouseleave(events.mouseleave)
                    } 
					else{ 
						$(o.clicked, holder).bind('click', events.clicked);
						$("body, html").bind('click touchstart', events.bodyClicked);
					}
                    
                    holder.addClass('activePlug');
                }
                var animate = {
                    opened: function() {
                        controls();
                        if (attachmentDiv != null) attachmentDiv.addClass(o.customClass);
                        holder.addClass(o.customClass);
						if( o.parents != null ) holder.parents( o.parents ).addClass(o.customClass);
						overlayControls('opened');
						if (callback != undefined) callback("opened")
                    },
                    closed: function() {
                        if (attachmentDiv != null) attachmentDiv.removeClass(o.customClass);
                        holder.removeClass(o.customClass);
						if( o.parents != null ) holder.parents( o.parents ).removeClass(o.customClass);
						overlayControls('closed');
						if (callback != undefined) callback("closed")
                    }
                };
                var events = {
                    mouseenter: function() {
                        if (visibleControls()) return false;
                        if (stm != null) clearTimeout(stm);
                        if (o.openedControl != "") {
                            var ID = o.openedControl;
                            if (ID.html() == "") return false
                        }
                        stm = setTimeout(function() {
                            animate.opened()
                        }, o.openedDelay)
                    },
                    mouseleave: function() {
                        if (visibleControls()) return false;
                        if (stm != null) clearTimeout(stm);
                        stm = setTimeout(function() {
                            animate.closed()
                        }, o.delay)
                    },
                    clicked: function() {
                        if( o.toggle ){
							if (holder.hasClass(o.customClass)) animate.closed();
                     	   	else animate.opened()
						}else
							animate.opened()
                    },
                    bodyClicked: function( e ){
						if( !holder.is( e.target ) && holder.has( e.target ).length === 0 )
							animate.closed();
                    }
                };
				
				function overlayControls( k ){
					if( o.overlay != null ){
						if( k == 'opened' ) bdy.addClass('qptOverlayOpened');
						else bdy.removeClass('qptOverlayOpened');
					}
				}
				
                function visibleControls() {
                    if (o.isVisible != null)
                        if ($(o.isVisible).is(":visible")) return true
                }

                function controls() {
                    if (o.hideDropDown.length > 0)

                        for (var i = 0; i < o.hideDropDown.length; ++i)
                            if (o.hideDropDown[i].length > 0) o.hideDropDown[i][0].closed()
                }
							
                this.opened =
                    function() {
                        animate.opened()
                    };
                this.closed = function() {
                    if (stm != null) clearTimeout(stm);
                    animate.closed()
                };
                this.dispose = function() {
                    if (o.type == "hover") holder.unbind("mouseenter").unbind("mouseleave");
                    else $(o.clicked, holder).unbind("click")
                };
                this.live = function() {
                    if (o.type == "hover") holder.mouseenter(events.mouseenter).mouseleave(events.mouseleave);
                    else $(o.clicked, holder).click(events.clicked)
                };
				
                init();
            })
        }
    })
})(jQuery, window);

/* Minus DropdownMenu */
(function(b){b.fn.extend({minusDropDownMenu:function(g,f){g=b.extend({el:"> li",type:"hover",customClass:"opened",delay:555,className:"",clicked:"",hideDropDown:[],controls:".subMenu > ul > li",isVisible:null},g);return this.each(function(){function k(){if(null!=a.isVisible&&b(a.isVisible).is(":visible"))return!0}var c=b(this),a=g,h="",d=null,e={opened:function(b){if(0<a.hideDropDown.length)for(var c=0;c<a.hideDropDown.length;++c)0<a.hideDropDown[c].length&&a.hideDropDown[c][0].closed();b.addClass(a.customClass);
void 0!=f&&f("opened")},closed:function(){b(a.el,c).removeClass(a.customClass);void 0!=f&&f("closed")}},l=function(){if(k())return!1;null!=d&&clearTimeout(d);e.closed();0<b(a.controls,this).length&&e.opened(b(this))},m=function(){if(k())return!1;null!=d&&clearTimeout(d);d=setTimeout(function(){e.closed()},a.delay)},n=function(){c.hasClass(a.customClass)?e.closed():e.opened()};this.opened=function(){e.opened()};this.closed=function(){null!=d&&clearTimeout(d);e.closed()};this.dispose=function(){"hover"==
a.type?c.unbind("mouseenter").unbind("mouseleave"):b(a.clicked,c).unbind("click")};this.live=function(){"hover"==a.type?c.mouseenter(l).mouseleave(m):b(a.clicked,c).click(n)};"hover"==a.type?b(a.el,c).mouseenter(l).mouseleave(m):b(a.clicked,c).click(n);h=""!=a.className?a.className:c.context.className.split(" ")[0];b("body, html").click(function(d){c.hasClass(a.customClass)&&d.target.className!=h&&1!=b(d.target).parents("."+h).size()&&e.closed()})})}})})(jQuery,window);

/*
 * Nivo Lightbox v1.2.0
 * http://dev7studios.com/nivo-lightbox
 *
 * Copyright 2013, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
(function(a,l,p,q){function m(c,b){this.el=c;this.$el=a(this.el);this.options=a.extend({},n,b);this._defaults=n;this._name="nivoLightbox";this.init()}var n={effect:"fade",theme:"default",keyboardNav:!0,auto:!1,clickOverlayToClose:!0,onInit:function(){},beforeShowLightbox:function(){},afterShowLightbox:function(a){},beforeHideLightbox:function(){},afterHideLightbox:function(){},onPrev:function(a){},onNext:function(a){},errorMessage:"The requested content cannot be loaded. Please try again later."};
m.prototype={init:function(){var c=this;a("html").hasClass("nivo-lightbox-notouch")||a("html").addClass("nivo-lightbox-notouch");"ontouchstart"in p&&a("html").removeClass("nivo-lightbox-notouch");this.$el.on("click",function(a){c.showLightbox(a)});this.options.auto&&c.showLightbox();if(this.options.keyboardNav)a("body").off("keyup").on("keyup",function(b){b=b.keyCode?b.keyCode:b.which;27==b&&c.destructLightbox();37==b&&a(".nivo-lightbox-prev").trigger("click");39==b&&a(".nivo-lightbox-next").trigger("click")});
this.options.onInit.call(this)},showLightbox:function(c){var b=this,e=this.$el;if(this.checkContent(e)){c&&c.preventDefault();this.options.beforeShowLightbox.call(this);var f=this.constructLightbox();if(f){var d=f.find(".nivo-lightbox-content");if(d){a("body").addClass("nivo-lightbox-body-effect-"+this.options.effect);this.processContent(d,e);if(this.$el.attr("data-lightbox-gallery")){var g=a('[data-lightbox-gallery="'+this.$el.attr("data-lightbox-gallery")+'"]');a(".nivo-lightbox-nav").show();a(".nivo-lightbox-prev").off("click").on("click",
function(c){c.preventDefault();c=g.index(e);e=g.eq(c-1);a(e).length||(e=g.last());b.processContent(d,e);b.options.onPrev.call(this,[e])});a(".nivo-lightbox-next").off("click").on("click",function(c){c.preventDefault();c=g.index(e);e=g.eq(c+1);a(e).length||(e=g.first());b.processContent(d,e);b.options.onNext.call(this,[e])})}setTimeout(function(){f.addClass("nivo-lightbox-open");b.options.afterShowLightbox.call(this,[f])},1)}}}},checkContent:function(a){var b=a.attr("href"),e=b.match(/(youtube|youtu|vimeo)\.(com|be)\/(watch\?v=([\w-]+)|([\w-]+))/);
return null!==b.match(/\.(jpeg|jpg|gif|png)$/i)||e||"ajax"==a.attr("data-lightbox-type")||"#"==b.substring(0,1)&&"inline"==a.attr("data-lightbox-type")||"iframe"==a.attr("data-lightbox-type")?!0:!1},processContent:function(c,b){var e=this,f=b.attr("href"),d=f.match(/(youtube|youtu|vimeo)\.(com|be)\/(watch\?v=([\w-]+)|([\w-]+))/);c.html("").addClass("nivo-lightbox-loading");this.isHidpi()&&b.attr("data-lightbox-hidpi")&&(f=b.attr("data-lightbox-hidpi"));if(null!==f.match(/\.(jpeg|jpg|gif|png)$/i)){var g=
a("<img>",{src:f});g.one("load",function(){var b=a('<div class="nivo-lightbox-image" />');b.append(g);c.html(b).removeClass("nivo-lightbox-loading");b.css({"line-height":a(".nivo-lightbox-content").height()+"px",height:a(".nivo-lightbox-content").height()+"px"});a(l).resize(function(){b.css({"line-height":a(".nivo-lightbox-content").height()+"px",height:a(".nivo-lightbox-content").height()+"px"})})}).each(function(){this.complete&&a(this).load()});g.error(function(){var b=a('<div class="nivo-lightbox-error"><p>'+
e.options.errorMessage+"</p></div>");c.html(b).removeClass("nivo-lightbox-loading")})}else if(d){var f="",h="nivo-lightbox-video";"youtube"==d[1]&&(f="http://www.youtube.com/embed/"+d[4],h="nivo-lightbox-youtube");"youtu"==d[1]&&(f="http://www.youtube.com/embed/"+d[3],h="nivo-lightbox-youtube");"vimeo"==d[1]&&(f="http://player.vimeo.com/video/"+d[3],h="nivo-lightbox-vimeo");f&&(d=a("<iframe>",{src:f,"class":h,frameborder:0,vspace:0,hspace:0,scrolling:"auto"}),c.html(d),d.load(function(){c.removeClass("nivo-lightbox-loading")}))}else if("ajax"==
b.attr("data-lightbox-type"))a.ajax({url:f,cache:!1,success:function(b){var d=a('<div class="nivo-lightbox-ajax" />');d.append(b);c.html(d).removeClass("nivo-lightbox-loading");d.outerHeight()<c.height()&&d.css({position:"relative",top:"50%","margin-top":-(d.outerHeight()/2)+"px"});a(l).resize(function(){d.outerHeight()<c.height()&&d.css({position:"relative",top:"50%","margin-top":-(d.outerHeight()/2)+"px"})})},error:function(){var b=a('<div class="nivo-lightbox-error"><p>'+e.options.errorMessage+
"</p></div>");c.html(b).removeClass("nivo-lightbox-loading")}});else if("#"==f.substring(0,1)&&"inline"==b.attr("data-lightbox-type"))if(a(f).length){var k=a('<div class="nivo-lightbox-inline" />');k.append(a(f).clone().show());c.html(k).removeClass("nivo-lightbox-loading");k.outerHeight()<c.height()&&k.css({position:"relative",top:"50%","margin-top":-(k.outerHeight()/2)+"px"});a(l).resize(function(){k.outerHeight()<c.height()&&k.css({position:"relative",top:"50%","margin-top":-(k.outerHeight()/2)+
"px"})})}else d=a('<div class="nivo-lightbox-error"><p>'+e.options.errorMessage+"</p></div>"),c.html(d).removeClass("nivo-lightbox-loading");else if("iframe"==b.attr("data-lightbox-type"))d=a("<iframe>",{src:f,"class":"nivo-lightbox-item",frameborder:0,vspace:0,hspace:0,scrolling:"auto"}),c.html(d),d.load(function(){c.removeClass("nivo-lightbox-loading")});else return!1;b.attr("title")?(d=a("<span>",{"class":"nivo-lightbox-title"}),d.text(b.attr("title")),a(".nivo-lightbox-title-wrap").html(d)):a(".nivo-lightbox-title-wrap").html("")},
constructLightbox:function(){if(a(".nivo-lightbox-overlay").length)return a(".nivo-lightbox-overlay");var c=a("<div>",{"class":"nivo-lightbox-overlay nivo-lightbox-theme-"+this.options.theme+" nivo-lightbox-effect-"+this.options.effect}),b=a("<div>",{"class":"nivo-lightbox-wrap"}),e=a("<div>",{"class":"nivo-lightbox-content"}),f=a('<a href="#" class="nivo-lightbox-nav nivo-lightbox-prev">Previous</a><a href="#" class="nivo-lightbox-nav nivo-lightbox-next">Next</a>'),d=a('<a href="#" class="nivo-lightbox-close" title="Close">Close</a>'),
g=a("<div>",{"class":"nivo-lightbox-title-wrap"});b.append(e);b.append(g);c.append(b);c.append(f);c.append(d);a("body").append(c);var h=this;if(h.options.clickOverlayToClose)c.on("click",function(b){(b.target===this||a(b.target).hasClass("nivo-lightbox-content")||a(b.target).hasClass("nivo-lightbox-image"))&&h.destructLightbox()});d.on("click",function(a){a.preventDefault();h.destructLightbox()});return c},destructLightbox:function(){this.options.beforeHideLightbox.call(this);a(".nivo-lightbox-overlay").removeClass("nivo-lightbox-open");
a(".nivo-lightbox-nav").hide();a("body").removeClass("nivo-lightbox-body-effect-"+this.options.effect);a(".nivo-lightbox-prev").off("click");a(".nivo-lightbox-next").off("click");a(".nivo-lightbox-content").empty();this.options.afterHideLightbox.call(this)},isHidpi:function(){return!1}};a.fn.nivoLightbox=function(c){return this.each(function(){a.data(this,"nivoLightbox")||a.data(this,"nivoLightbox",new m(this,c))})}})(jQuery,window,document);
 
 /*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);
 
 // Profile Submit Changes
function profile_save(data){
	var	modify = JSON.parse(data),
			prf_url = site_url+'user/profile/general/'+modify['prf_nick'],
			userbox = '<div class="usrInfo">'+modify['prf_name']+'</div><div class="userMenu"><ul><li><a href="'+site_url+'user/profile/general/'+modify['prf_nick']+'">Profile</a></li><li><a href="'+site_url+'user/movies/lists/'+modify['prf_nick']+'">My Movie Lists</a></li></ul></div><div class="usrLogout"><a href="'+site_url+'user/logout">logout</a></div>';
	
	$('form.form-profile').attr('action', prf_url);
	$('.userbox').html(userbox);
	
	for(var i in modify)
		$('#'+i).val(modify[i]);

	history.pushState({nick:"modify"}, "", prf_url);
	window.history.forward();
}


/*
* jQuery UI Tag-it!
*
* @version v2.0 (06/2011)
*
* Copyright 2011, Levy Carneiro Jr.
* Released under the MIT license.
* http://aehlke.github.com/tag-it/LICENSE
*
* Homepage:
*   http://aehlke.github.com/tag-it/
*
* Authors:
*   Levy Carneiro Jr.
*   Martin Rehfeld
*   Tobias Schmidt
*   Skylar Challand
*   Alex Ehlke
*
* Maintainer:
*   Alex Ehlke - Twitter: @aehlke
*
* Dependencies:
*   jQuery v1.4+
*   jQuery UI v1.8+
*/
(function($) {

    $.widget('ui.tagit', {
        options: {
            allowDuplicates   : false,
            caseSensitive     : true,
            fieldName         : 'tags',
            placeholderText   : null,   // Sets `placeholder` attr on input field.
            readOnly          : false,  // Disables editing.
            removeConfirmation: false,  // Require confirmation to remove tags.
            tagLimit          : null,   // Max number of tags allowed (null for unlimited).

            // Used for autocomplete, unless you override `autocomplete.source`.
            availableTags     : [],

            // Use to override or add any options to the autocomplete widget.
            //
            // By default, autocomplete.source will map to availableTags,
            // unless overridden.
            autocomplete: {},

            // Shows autocomplete before the user even types anything.
            showAutocompleteOnFocus: false,

            // When enabled, quotes are unneccesary for inputting multi-word tags.
            allowSpaces: false,

            // The below options are for using a single field instead of several
            // for our form values.
            //
            // When enabled, will use a single hidden field for the form,
            // rather than one per tag. It will delimit tags in the field
            // with singleFieldDelimiter.
            //
            // The easiest way to use singleField is to just instantiate tag-it
            // on an INPUT element, in which case singleField is automatically
            // set to true, and singleFieldNode is set to that element. This
            // way, you don't need to fiddle with these options.
            singleField: false,

            // This is just used when preloading data from the field, and for
            // populating the field with delimited tags as the user adds them.
            singleFieldDelimiter: ',',

            // Set this to an input DOM node to use an existing form field.
            // Any text in it will be erased on init. But it will be
            // populated with the text of tags as they are created,
            // delimited by singleFieldDelimiter.
            //
            // If this is not set, we create an input node for it,
            // with the name given in settings.fieldName.
            singleFieldNode: null,

            // Whether to animate tag removals or not.
            animate: true,

            // Optionally set a tabindex attribute on the input that gets
            // created for tag-it.
            tabIndex: null,

            // Event callbacks.
            beforeTagAdded      : null,
            afterTagAdded       : null,

            beforeTagRemoved    : null,
            afterTagRemoved     : null,

            onTagClicked        : null,
            onTagLimitExceeded  : null,


            // DEPRECATED:
            //
            // /!\ These event callbacks are deprecated and WILL BE REMOVED at some
            // point in the future. They're here for backwards-compatibility.
            // Use the above before/after event callbacks instead.
            onTagAdded  : null,
            onTagRemoved: null,
            // `autocomplete.source` is the replacement for tagSource.
            tagSource: null
            // Do not use the above deprecated options.
        },

        _create: function() {
            // for handling static scoping inside callbacks
            var that = this;

            // There are 2 kinds of DOM nodes this widget can be instantiated on:
            //     1. UL, OL, or some element containing either of these.
            //     2. INPUT, in which case 'singleField' is overridden to true,
            //        a UL is created and the INPUT is hidden.
            if (this.element.is('input')) {
                this.tagList = $('<ul></ul>').insertAfter(this.element);
                this.options.singleField = true;
                this.options.singleFieldNode = this.element;
                this.element.addClass('tagit-hidden-field');
            } else {
                this.tagList = this.element.find('ul, ol').andSelf().last();
            }

            this.tagInput = $('<input type="text" />').addClass('ui-widget-content');

            if (this.options.readOnly) this.tagInput.attr('disabled', 'disabled');

            if (this.options.tabIndex) {
                this.tagInput.attr('tabindex', this.options.tabIndex);
            }

            if (this.options.placeholderText) {
                this.tagInput.attr('placeholder', this.options.placeholderText);
            }

            if (!this.options.autocomplete.source) {
                this.options.autocomplete.source = function(search, showChoices) {
                    var filter = search.term.toLowerCase();
                    var choices = $.grep(this.options.availableTags, function(element) {
                        // Only match autocomplete options that begin with the search term.
                        // (Case insensitive.)
                        return (element.toLowerCase().indexOf(filter) === 0);
                    });
                    if (!this.options.allowDuplicates) {
                        choices = this._subtractArray(choices, this.assignedTags());
                    }
                    showChoices(choices);
                };
            }

            if (this.options.showAutocompleteOnFocus) {
                this.tagInput.focus(function(event, ui) {
                    that._showAutocomplete();
                });

                if (typeof this.options.autocomplete.minLength === 'undefined') {
                    this.options.autocomplete.minLength = 0;
                }
            }

            // Bind autocomplete.source callback functions to this context.
            if ($.isFunction(this.options.autocomplete.source)) {
                this.options.autocomplete.source = $.proxy(this.options.autocomplete.source, this);
            }

            // DEPRECATED.
            if ($.isFunction(this.options.tagSource)) {
                this.options.tagSource = $.proxy(this.options.tagSource, this);
            }

         
			this.tagList
                .addClass('tagit')
                .addClass('ui-widget ui-widget-content ui-corner-all')
                // Create the input field.
                .append($('<li class="tagit-new"></li>').append(this.tagInput))
                .click(function(e) {
                    var target = $(e.target);
                    if (target.hasClass('tagit-label')) {
                        var tag = target.closest('.tagit-choice');
                        if (!tag.hasClass('removed')) {
                            that._trigger('onTagClicked', e, {tag: tag, tagLabel: that.tagLabel(tag)});
                        }
                    } else {
                        // Sets the focus() to the input field, if the user
                        // clicks anywhere inside the UL. This is needed
                        // because the input field needs to be of a small size.
                        that.tagInput.focus();
                    }
                });

            // Single field support.
            var addedExistingFromSingleFieldNode = false;
            if (this.options.singleField) {
                if (this.options.singleFieldNode) {
                    // Add existing tags from the input field.
                    var node = $(this.options.singleFieldNode);
                    var tags = node.val().split(this.options.singleFieldDelimiter);
                    node.val('');
                    $.each(tags, function(index, tag) {
                        that.createTag(tag, null, true);
                        addedExistingFromSingleFieldNode = true;
                    });
                } else {
                    // Create our single field input after our list.
                    this.options.singleFieldNode = $('<input type="hidden" style="display:none;" value="" name="' + this.options.fieldName + '" />');
                    this.tagList.after(this.options.singleFieldNode);
                }
            }

            // Add existing tags from the list, if any.
            if (!addedExistingFromSingleFieldNode) {
                this.tagList.children('li').each(function() {
                    if (!$(this).hasClass('tagit-new')) {
                        that.createTag($(this).text(), $(this).attr('class'), true);
                        $(this).remove();
                    }
                });
            }

            // Events.
            this.tagInput
                .keydown(function(event) {
                    // Backspace is not detected within a keypress, so it must use keydown.
                    if (event.which == $.ui.keyCode.BACKSPACE && that.tagInput.val() === '') {
                        var tag = that._lastTag();
                        if (!that.options.removeConfirmation || tag.hasClass('remove')) {
                            // When backspace is pressed, the last tag is deleted.
                            that.removeTag(tag);
                        } else if (that.options.removeConfirmation) {
                            tag.addClass('remove ui-state-highlight');
                        }
                    } else if (that.options.removeConfirmation) {
                        that._lastTag().removeClass('remove ui-state-highlight');
                    }

                    // Comma/Space/Enter are all valid delimiters for new tags,
                    // except when there is an open quote or if setting allowSpaces = true.
                    // Tab will also create a tag, unless the tag input is empty,
                    // in which case it isn't caught.
                    if (
                        (event.which === $.ui.keyCode.COMMA && event.shiftKey === false) ||
                        event.which === $.ui.keyCode.ENTER ||
                        (
                            event.which == $.ui.keyCode.TAB &&
                            that.tagInput.val() !== ''
                        ) ||
                        (
                            event.which == $.ui.keyCode.SPACE &&
                            that.options.allowSpaces !== true &&
                            (
                                $.trim(that.tagInput.val()).replace( /^s*/, '' ).charAt(0) != '"' ||
                                (
                                    $.trim(that.tagInput.val()).charAt(0) == '"' &&
                                    $.trim(that.tagInput.val()).charAt($.trim(that.tagInput.val()).length - 1) == '"' &&
                                    $.trim(that.tagInput.val()).length - 1 !== 0
                                )
                            )
                        )
                    ) {
                        // Enter submits the form if there's no text in the input.
                        if (!(event.which === $.ui.keyCode.ENTER && that.tagInput.val() === '')) {
                            event.preventDefault();
                        }

                        // Autocomplete will create its own tag from a selection and close automatically.
                        if (!(that.options.autocomplete.autoFocus && that.tagInput.data('autocomplete-open'))) {
                            that.tagInput.autocomplete('close');
                            that.createTag(that._cleanedInput());
                        }
                    }
                }).blur(function(e){
                    // Create a tag when the element loses focus.
                    // If autocomplete is enabled and suggestion was clicked, don't add it.
                    if (!that.tagInput.data('autocomplete-open')) {
                        that.createTag(that._cleanedInput());
                    }
                });

            // Autocomplete.
            if (this.options.availableTags || this.options.tagSource || this.options.autocomplete.source) {
                var autocompleteOptions = {
                    select: function(event, ui) {
                        that.createTag(ui.item.value);
                        // Preventing the tag input to be updated with the chosen value.
                        return false;
                    }
                };
                $.extend(autocompleteOptions, this.options.autocomplete);

                // tagSource is deprecated, but takes precedence here since autocomplete.source is set by default,
                // while tagSource is left null by default.
                autocompleteOptions.source = this.options.tagSource || autocompleteOptions.source;

                this.tagInput.autocomplete(autocompleteOptions).bind('autocompleteopen.tagit', function(event, ui) {
                    that.tagInput.data('autocomplete-open', true);
                }).bind('autocompleteclose.tagit', function(event, ui) {
                    that.tagInput.data('autocomplete-open', false);
                });

                this.tagInput.autocomplete('widget').addClass('tagit-autocomplete');
            }
        },

        destroy: function() {
            $.Widget.prototype.destroy.call(this);

            this.element.unbind('.tagit');
            this.tagList.unbind('.tagit');

            this.tagInput.removeData('autocomplete-open');

            this.tagList.removeClass([
                'tagit',
                'ui-widget',
                'ui-widget-content',
                'ui-corner-all',
                'tagit-hidden-field'
            ].join(' '));

            if (this.element.is('input')) {
                this.element.removeClass('tagit-hidden-field');
                this.tagList.remove();
            } else {
                this.element.children('li').each(function() {
                    if ($(this).hasClass('tagit-new')) {
                        $(this).remove();
                    } else {
                        $(this).removeClass([
                            'tagit-choice',
                            'ui-widget-content',
                            'ui-state-default',
                            'ui-state-highlight',
                            'ui-corner-all',
                            'remove',
                            'tagit-choice-editable',
                            'tagit-choice-read-only'
                        ].join(' '));

                        $(this).text($(this).children('.tagit-label').text());
                    }
                });

                if (this.singleFieldNode) {
                    this.singleFieldNode.remove();
                }
            }

            return this;
        },

        _cleanedInput: function() {
            // Returns the contents of the tag input, cleaned and ready to be passed to createTag
            return $.trim(this.tagInput.val().replace(/^"(.*)"$/, '$1'));
        },

        _lastTag: function() {
            return this.tagList.find('.tagit-choice:last:not(.removed)');
        },

        _tags: function() {
            return this.tagList.find('.tagit-choice:not(.removed)');
        },

        assignedTags: function() {
            // Returns an array of tag string values
            var that = this;
            var tags = [];
            if (this.options.singleField) {
                tags = $(this.options.singleFieldNode).val().split(this.options.singleFieldDelimiter);
                if (tags[0] === '') {
                    tags = [];
                }
            } else {
                this._tags().each(function() {
                    tags.push(that.tagLabel(this));
                });
            }
            return tags;
        },

        _updateSingleTagsField: function(tags) {
            // Takes a list of tag string values, updates this.options.singleFieldNode.val to the tags delimited by this.options.singleFieldDelimiter
            $(this.options.singleFieldNode).val(tags.join(this.options.singleFieldDelimiter)).trigger('change');
        },

        _subtractArray: function(a1, a2) {
            var result = [];
            for (var i = 0; i < a1.length; i++) {
                if ($.inArray(a1[i], a2) == -1) {
                    result.push(a1[i]);
                }
            }
            return result;
        },

        tagLabel: function(tag) {
            // Returns the tag's string label.
            if (this.options.singleField) {
                return $(tag).find('.tagit-label:first').text();
            } else {
                return $(tag).find('input:first').val();
            }
        },

        _showAutocomplete: function() {
            this.tagInput.autocomplete('search', '');
        },

        _findTagByLabel: function(name) {
            var that = this;
            var tag = null;
            this._tags().each(function(i) {
                if (that._formatStr(name) == that._formatStr(that.tagLabel(this))) {
                    tag = $(this);
                    return false;
                }
            });
            return tag;
        },

        _isNew: function(name) {
            return !this._findTagByLabel(name);
        },

        _formatStr: function(str) {
            if (this.options.caseSensitive) {
                return str;
            }
            return $.trim(str.toLowerCase());
        },

        _effectExists: function(name) {
            return Boolean($.effects && ($.effects[name] || ($.effects.effect && $.effects.effect[name])));
        },

        createTag: function(value, additionalClass, duringInitialization) {
            var that = this;

            value = $.trim(value);

            if(this.options.preprocessTag) {
                value = this.options.preprocessTag(value);
            }

            if (value === '') {
                return false;
            }

            if (!this.options.allowDuplicates && !this._isNew(value)) {
                var existingTag = this._findTagByLabel(value);
                if (this._trigger('onTagExists', null, {
                    existingTag: existingTag,
                    duringInitialization: duringInitialization
                }) !== false) {
                    if (this._effectExists('highlight')) {
                        existingTag.effect('highlight');
                    }
                }
                return false;
            }

            if (this.options.tagLimit && this._tags().length >= this.options.tagLimit) {
                this._trigger('onTagLimitExceeded', null, {duringInitialization: duringInitialization});
                return false;
            }

            var label = $(this.options.onTagClicked ? '<a class="tagit-label"></a>' : '<span class="tagit-label"></span>').text(value);

            // Create tag.
            var tag = $('<li></li>')
                .addClass('tagit-choice ui-widget-content ui-state-default ui-corner-all')
                .addClass(additionalClass)
                .append(label);

            if (this.options.readOnly){
                tag.addClass('tagit-choice-read-only');
            } else {
                tag.addClass('tagit-choice-editable');
                // Button for removing the tag.
                var removeTagIcon = $('<span></span>')
                    .addClass('ui-icon ui-icon-close');
                var removeTag = $('<a><span class="text-icon">\xd7</span></a>') // \xd7 is an X
                    .addClass('tagit-close')
                    .append(removeTagIcon)
                    .click(function(e) {
                        // Removes a tag when the little 'x' is clicked.
                        that.removeTag(tag);
                    });
                tag.append(removeTag);
            }

            // Unless options.singleField is set, each tag has a hidden input field inline.
            if (!this.options.singleField) {
                var escapedValue = label.html();
                tag.append('<input type="hidden" value="' + escapedValue + '" name="' + this.options.fieldName + '" class="tagit-hidden-field" />');
            }

            if (this._trigger('beforeTagAdded', null, {
                tag: tag,
                tagLabel: this.tagLabel(tag),
                duringInitialization: duringInitialization
            }) === false) {
                return;
            }

            if (this.options.singleField) {
                var tags = this.assignedTags();
                tags.push(value);
                this._updateSingleTagsField(tags);
            }

            // DEPRECATED.
            this._trigger('onTagAdded', null, tag);

            this.tagInput.val('');

            // Insert tag.
            // this.tagInput.parent().before(tag);
			this.tagInput.parent().after(tag); //added brk
			
            this._trigger('afterTagAdded', null, {
                tag: tag,
                tagLabel: this.tagLabel(tag),
                duringInitialization: duringInitialization
            });

            if (this.options.showAutocompleteOnFocus && !duringInitialization) {
                setTimeout(function () { that._showAutocomplete(); }, 0);
            }
        },

        removeTag: function(tag, animate) {
            animate = typeof animate === 'undefined' ? this.options.animate : animate;

            tag = $(tag);

            // DEPRECATED.
            this._trigger('onTagRemoved', null, tag);

            if (this._trigger('beforeTagRemoved', null, {tag: tag, tagLabel: this.tagLabel(tag)}) === false) {
                return;
            }

            if (this.options.singleField) {
                var tags = this.assignedTags();
                var removedTagLabel = this.tagLabel(tag);
                tags = $.grep(tags, function(el){
                    return el != removedTagLabel;
                });
                this._updateSingleTagsField(tags);
            }

            if (animate) {
                tag.addClass('removed'); // Excludes this tag from _tags.
                var hide_args = this._effectExists('blind') ? ['blind', {direction: 'horizontal'}, 'fast'] : ['fast'];

                var thisTag = this;
                hide_args.push(function() {
                    tag.remove();
                    thisTag._trigger('afterTagRemoved', null, {tag: tag, tagLabel: thisTag.tagLabel(tag)});
                });

                tag.fadeOut('fast').hide.apply(tag, hide_args).dequeue();
            } else {
                tag.remove();
                this._trigger('afterTagRemoved', null, {tag: tag, tagLabel: this.tagLabel(tag)});
            }

        },

        removeTagByLabel: function(tagLabel, animate) {
            var toRemove = this._findTagByLabel(tagLabel);
            if (!toRemove) {
                throw "No such tag exists with the name '" + tagLabel + "'";
            }
            this.removeTag(toRemove, animate);
        },

        removeAll: function() {
            // Removes all tags.
            var that = this;
            this._tags().each(function(index, tag) {
                that.removeTag(tag, false);
            });
        }

    });
})(jQuery);

/*! jQRangeSlider 5.7.1 - 2015-01-23 - Copyright (C) Guillaume Gautreau 2012 - MIT and GPLv3 licenses.*/!function(a){"use strict";a.widget("ui.rangeSliderMouseTouch",a.ui.mouse,{enabled:!0,_mouseInit:function(){var b=this;a.ui.mouse.prototype._mouseInit.apply(this),this._mouseDownEvent=!1,this.element.bind("touchstart."+this.widgetName,function(a){return b._touchStart(a)})},_mouseDestroy:function(){a(document).unbind("touchmove."+this.widgetName,this._touchMoveDelegate).unbind("touchend."+this.widgetName,this._touchEndDelegate),a.ui.mouse.prototype._mouseDestroy.apply(this)},enable:function(){this.enabled=!0},disable:function(){this.enabled=!1},destroy:function(){this._mouseDestroy(),a.ui.mouse.prototype.destroy.apply(this),this._mouseInit=null},_touchStart:function(b){if(!this.enabled)return!1;b.which=1,b.preventDefault(),this._fillTouchEvent(b);var c=this,d=this._mouseDownEvent;this._mouseDown(b),d!==this._mouseDownEvent&&(this._touchEndDelegate=function(a){c._touchEnd(a)},this._touchMoveDelegate=function(a){c._touchMove(a)},a(document).bind("touchmove."+this.widgetName,this._touchMoveDelegate).bind("touchend."+this.widgetName,this._touchEndDelegate))},_mouseDown:function(b){return this.enabled?a.ui.mouse.prototype._mouseDown.apply(this,[b]):!1},_touchEnd:function(b){this._fillTouchEvent(b),this._mouseUp(b),a(document).unbind("touchmove."+this.widgetName,this._touchMoveDelegate).unbind("touchend."+this.widgetName,this._touchEndDelegate),this._mouseDownEvent=!1,a(document).trigger("mouseup")},_touchMove:function(a){return a.preventDefault(),this._fillTouchEvent(a),this._mouseMove(a)},_fillTouchEvent:function(a){var b;b="undefined"==typeof a.targetTouches&&"undefined"==typeof a.changedTouches?a.originalEvent.targetTouches[0]||a.originalEvent.changedTouches[0]:a.targetTouches[0]||a.changedTouches[0],a.pageX=b.pageX,a.pageY=b.pageY,a.which=1}})}(jQuery),function(a){"use strict";a.widget("ui.rangeSliderDraggable",a.ui.rangeSliderMouseTouch,{cache:null,options:{containment:null},_create:function(){a.ui.rangeSliderMouseTouch.prototype._create.apply(this),setTimeout(a.proxy(this._initElementIfNotDestroyed,this),10)},destroy:function(){this.cache=null,a.ui.rangeSliderMouseTouch.prototype.destroy.apply(this)},_initElementIfNotDestroyed:function(){this._mouseInit&&this._initElement()},_initElement:function(){this._mouseInit(),this._cache()},_setOption:function(b,c){"containment"===b&&(this.options.containment=null===c||0===a(c).length?null:a(c))},_mouseStart:function(a){return this._cache(),this.cache.click={left:a.pageX,top:a.pageY},this.cache.initialOffset=this.element.offset(),this._triggerMouseEvent("mousestart"),!0},_mouseDrag:function(a){var b=a.pageX-this.cache.click.left;return b=this._constraintPosition(b+this.cache.initialOffset.left),this._applyPosition(b),this._triggerMouseEvent("sliderDrag"),!1},_mouseStop:function(){this._triggerMouseEvent("stop")},_constraintPosition:function(a){return 0!==this.element.parent().length&&null!==this.cache.parent.offset&&(a=Math.min(a,this.cache.parent.offset.left+this.cache.parent.width-this.cache.width.outer),a=Math.max(a,this.cache.parent.offset.left)),a},_applyPosition:function(a){var b={top:this.cache.offset.top,left:a};this.element.offset({left:a}),this.cache.offset=b},_cacheIfNecessary:function(){null===this.cache&&this._cache()},_cache:function(){this.cache={},this._cacheMargins(),this._cacheParent(),this._cacheDimensions(),this.cache.offset=this.element.offset()},_cacheMargins:function(){this.cache.margin={left:this._parsePixels(this.element,"marginLeft"),right:this._parsePixels(this.element,"marginRight"),top:this._parsePixels(this.element,"marginTop"),bottom:this._parsePixels(this.element,"marginBottom")}},_cacheParent:function(){if(null!==this.options.parent){var a=this.element.parent();this.cache.parent={offset:a.offset(),width:a.width()}}else this.cache.parent=null},_cacheDimensions:function(){this.cache.width={outer:this.element.outerWidth(),inner:this.element.width()}},_parsePixels:function(a,b){return parseInt(a.css(b),10)||0},_triggerMouseEvent:function(a){var b=this._prepareEventData();this.element.trigger(a,b)},_prepareEventData:function(){return{element:this.element,offset:this.cache.offset||null}}})}(jQuery),function(a,b){"use strict";a.widget("ui.rangeSlider",{options:{bounds:{min:0,max:100},defaultValues:{min:20,max:50},wheelMode:null,wheelSpeed:4,arrows:!0,valueLabels:"show",formatter:null,durationIn:0,durationOut:400,delayOut:200,range:{min:!1,max:!1},step:!1,scales:!1,enabled:!0,symmetricPositionning:!1},_values:null,_valuesChanged:!1,_initialized:!1,bar:null,leftHandle:null,rightHandle:null,innerBar:null,container:null,arrows:null,labels:null,changing:{min:!1,max:!1},changed:{min:!1,max:!1},ruler:null,_create:function(){this._setDefaultValues(),this.labels={left:null,right:null,leftDisplayed:!0,rightDisplayed:!0},this.arrows={left:null,right:null},this.changing={min:!1,max:!1},this.changed={min:!1,max:!1},this._createElements(),this._bindResize(),setTimeout(a.proxy(this.resize,this),1),setTimeout(a.proxy(this._initValues,this),1)},_setDefaultValues:function(){this._values={min:this.options.defaultValues.min,max:this.options.defaultValues.max}},_bindResize:function(){var b=this;this._resizeProxy=function(a){b.resize(a)},a(window).resize(this._resizeProxy)},_initWidth:function(){this.container.css("width",this.element.width()-this.container.outerWidth(!0)+this.container.width()),this.innerBar.css("width",this.container.width()-this.innerBar.outerWidth(!0)+this.innerBar.width())},_initValues:function(){this._initialized=!0,this.values(this._values.min,this._values.max)},_setOption:function(a,b){this._setWheelOption(a,b),this._setArrowsOption(a,b),this._setLabelsOption(a,b),this._setLabelsDurations(a,b),this._setFormatterOption(a,b),this._setBoundsOption(a,b),this._setRangeOption(a,b),this._setStepOption(a,b),this._setScalesOption(a,b),this._setEnabledOption(a,b),this._setPositionningOption(a,b)},_validProperty:function(a,b,c){return null===a||"undefined"==typeof a[b]?c:a[b]},_setStepOption:function(a,b){"step"===a&&(this.options.step=b,this._leftHandle("option","step",b),this._rightHandle("option","step",b),this._changed(!0))},_setScalesOption:function(a,b){"scales"===a&&(b===!1||null===b?(this.options.scales=!1,this._destroyRuler()):b instanceof Array&&(this.options.scales=b,this._updateRuler()))},_setRangeOption:function(a,b){"range"===a&&(this._bar("option","range",b),this.options.range=this._bar("option","range"),this._changed(!0))},_setBoundsOption:function(a,b){"bounds"===a&&"undefined"!=typeof b.min&&"undefined"!=typeof b.max&&this.bounds(b.min,b.max)},_setWheelOption:function(a,b){("wheelMode"===a||"wheelSpeed"===a)&&(this._bar("option",a,b),this.options[a]=this._bar("option",a))},_setLabelsOption:function(a,b){if("valueLabels"===a){if("hide"!==b&&"show"!==b&&"change"!==b)return;this.options.valueLabels=b,"hide"!==b?(this._createLabels(),this._leftLabel("update"),this._rightLabel("update")):this._destroyLabels()}},_setFormatterOption:function(a,b){"formatter"===a&&null!==b&&"function"==typeof b&&"hide"!==this.options.valueLabels&&(this._leftLabel("option","formatter",b),this.options.formatter=this._rightLabel("option","formatter",b))},_setArrowsOption:function(a,b){"arrows"!==a||b!==!0&&b!==!1||b===this.options.arrows||(b===!0?(this.element.removeClass("ui-rangeSlider-noArrow").addClass("ui-rangeSlider-withArrows"),this.arrows.left.css("display","block"),this.arrows.right.css("display","block"),this.options.arrows=!0):b===!1&&(this.element.addClass("ui-rangeSlider-noArrow").removeClass("ui-rangeSlider-withArrows"),this.arrows.left.css("display","none"),this.arrows.right.css("display","none"),this.options.arrows=!1),this._initWidth())},_setLabelsDurations:function(a,b){if("durationIn"===a||"durationOut"===a||"delayOut"===a){if(parseInt(b,10)!==b)return;null!==this.labels.left&&this._leftLabel("option",a,b),null!==this.labels.right&&this._rightLabel("option",a,b),this.options[a]=b}},_setEnabledOption:function(a,b){"enabled"===a&&this.toggle(b)},_setPositionningOption:function(a,b){"symmetricPositionning"===a&&(this._rightHandle("option",a,b),this.options[a]=this._leftHandle("option",a,b))},_createElements:function(){"absolute"!==this.element.css("position")&&this.element.css("position","relative"),this.element.addClass("ui-rangeSlider"),this.container=a("<div class='ui-rangeSlider-container' />").css("position","absolute").appendTo(this.element),this.innerBar=a("<div class='ui-rangeSlider-innerBar' />").css("position","absolute").css("top",0).css("left",0),this._createHandles(),this._createBar(),this.container.prepend(this.innerBar),this._createArrows(),"hide"!==this.options.valueLabels?this._createLabels():this._destroyLabels(),this._updateRuler(),this.options.enabled||this._toggle(this.options.enabled)},_createHandle:function(b){return a("<div />")[this._handleType()](b).bind("sliderDrag",a.proxy(this._changing,this)).bind("stop",a.proxy(this._changed,this))},_createHandles:function(){this.leftHandle=this._createHandle({isLeft:!0,bounds:this.options.bounds,value:this._values.min,step:this.options.step,symmetricPositionning:this.options.symmetricPositionning}).appendTo(this.container),this.rightHandle=this._createHandle({isLeft:!1,bounds:this.options.bounds,value:this._values.max,step:this.options.step,symmetricPositionning:this.options.symmetricPositionning}).appendTo(this.container)},_createBar:function(){this.bar=a("<div />").prependTo(this.container).bind("sliderDrag scroll zoom",a.proxy(this._changing,this)).bind("stop",a.proxy(this._changed,this)),this._bar({leftHandle:this.leftHandle,rightHandle:this.rightHandle,values:{min:this._values.min,max:this._values.max},type:this._handleType(),range:this.options.range,wheelMode:this.options.wheelMode,wheelSpeed:this.options.wheelSpeed}),this.options.range=this._bar("option","range"),this.options.wheelMode=this._bar("option","wheelMode"),this.options.wheelSpeed=this._bar("option","wheelSpeed")},_createArrows:function(){this.arrows.left=this._createArrow("left"),this.arrows.right=this._createArrow("right"),this.options.arrows?this.element.addClass("ui-rangeSlider-withArrows"):(this.arrows.left.css("display","none"),this.arrows.right.css("display","none"),this.element.addClass("ui-rangeSlider-noArrow"))},_createArrow:function(b){var c,d=a("<div class='ui-rangeSlider-arrow' />").append("<div class='ui-rangeSlider-arrow-inner' />").addClass("ui-rangeSlider-"+b+"Arrow").css("position","absolute").css(b,0).appendTo(this.element);return c="right"===b?a.proxy(this._scrollRightClick,this):a.proxy(this._scrollLeftClick,this),d.bind("mousedown touchstart",c),d},_proxy:function(a,b,c){var d=Array.prototype.slice.call(c);return a&&a[b]?a[b].apply(a,d):null},_handleType:function(){return"rangeSliderHandle"},_barType:function(){return"rangeSliderBar"},_bar:function(){return this._proxy(this.bar,this._barType(),arguments)},_labelType:function(){return"rangeSliderLabel"},_leftLabel:function(){return this._proxy(this.labels.left,this._labelType(),arguments)},_rightLabel:function(){return this._proxy(this.labels.right,this._labelType(),arguments)},_leftHandle:function(){return this._proxy(this.leftHandle,this._handleType(),arguments)},_rightHandle:function(){return this._proxy(this.rightHandle,this._handleType(),arguments)},_getValue:function(a,b){return b===this.rightHandle&&(a-=b.outerWidth()),a*(this.options.bounds.max-this.options.bounds.min)/(this.container.innerWidth()-b.outerWidth(!0))+this.options.bounds.min},_trigger:function(a){var b=this;setTimeout(function(){b.element.trigger(a,{label:b.element,values:b.values()})},1)},_changing:function(){this._updateValues()&&(this._trigger("valuesChanging"),this._valuesChanged=!0)},_deactivateLabels:function(){"change"===this.options.valueLabels&&(this._leftLabel("option","show","hide"),this._rightLabel("option","show","hide"))},_reactivateLabels:function(){"change"===this.options.valueLabels&&(this._leftLabel("option","show","change"),this._rightLabel("option","show","change"))},_changed:function(a){a===!0&&this._deactivateLabels(),(this._updateValues()||this._valuesChanged)&&(this._trigger("valuesChanged"),a!==!0&&this._trigger("userValuesChanged"),this._valuesChanged=!1),a===!0&&this._reactivateLabels()},_updateValues:function(){var a=this._leftHandle("value"),b=this._rightHandle("value"),c=this._min(a,b),d=this._max(a,b),e=c!==this._values.min||d!==this._values.max;return this._values.min=this._min(a,b),this._values.max=this._max(a,b),e},_min:function(a,b){return Math.min(a,b)},_max:function(a,b){return Math.max(a,b)},_createLabel:function(b,c){var d;return null===b?(d=this._getLabelConstructorParameters(b,c),b=a("<div />").appendTo(this.element)[this._labelType()](d)):(d=this._getLabelRefreshParameters(b,c),b[this._labelType()](d)),b},_getLabelConstructorParameters:function(a,b){return{handle:b,handleType:this._handleType(),formatter:this._getFormatter(),show:this.options.valueLabels,durationIn:this.options.durationIn,durationOut:this.options.durationOut,delayOut:this.options.delayOut}},_getLabelRefreshParameters:function(){return{formatter:this._getFormatter(),show:this.options.valueLabels,durationIn:this.options.durationIn,durationOut:this.options.durationOut,delayOut:this.options.delayOut}},_getFormatter:function(){return this.options.formatter===!1||null===this.options.formatter?this._defaultFormatter:this.options.formatter},_defaultFormatter:function(a){return Math.round(a)},_destroyLabel:function(a){return null!==a&&(a[this._labelType()]("destroy"),a.remove(),a=null),a},_createLabels:function(){this.labels.left=this._createLabel(this.labels.left,this.leftHandle),this.labels.right=this._createLabel(this.labels.right,this.rightHandle),this._leftLabel("pair",this.labels.right)},_destroyLabels:function(){this.labels.left=this._destroyLabel(this.labels.left),this.labels.right=this._destroyLabel(this.labels.right)},_stepRatio:function(){return this._leftHandle("stepRatio")},_scrollRightClick:function(a){return this.options.enabled?(a.preventDefault(),this._bar("startScroll"),this._bindStopScroll(),void this._continueScrolling("scrollRight",4*this._stepRatio(),1)):!1},_continueScrolling:function(a,b,c,d){if(!this.options.enabled)return!1;this._bar(a,c),d=d||5,d--;var e=this,f=16,g=Math.max(1,4/this._stepRatio());this._scrollTimeout=setTimeout(function(){0===d&&(b>f?b=Math.max(f,b/1.5):c=Math.min(g,2*c),d=5),e._continueScrolling(a,b,c,d)},b)},_scrollLeftClick:function(a){return this.options.enabled?(a.preventDefault(),this._bar("startScroll"),this._bindStopScroll(),void this._continueScrolling("scrollLeft",4*this._stepRatio(),1)):!1},_bindStopScroll:function(){var b=this;this._stopScrollHandle=function(a){a.preventDefault(),b._stopScroll()},a(document).bind("mouseup touchend",this._stopScrollHandle)},_stopScroll:function(){a(document).unbind("mouseup touchend",this._stopScrollHandle),this._stopScrollHandle=null,this._bar("stopScroll"),clearTimeout(this._scrollTimeout)},_createRuler:function(){this.ruler=a("<div class='ui-rangeSlider-ruler' />").appendTo(this.innerBar)},_setRulerParameters:function(){this.ruler.ruler({min:this.options.bounds.min,max:this.options.bounds.max,scales:this.options.scales})},_destroyRuler:function(){null!==this.ruler&&a.fn.ruler&&(this.ruler.ruler("destroy"),this.ruler.remove(),this.ruler=null)},_updateRuler:function(){this._destroyRuler(),this.options.scales!==!1&&a.fn.ruler&&(this._createRuler(),this._setRulerParameters())},values:function(a,b){var c;if("undefined"!=typeof a&&"undefined"!=typeof b){if(!this._initialized)return this._values.min=a,this._values.max=b,this._values;this._deactivateLabels(),c=this._bar("values",a,b),this._changed(!0),this._reactivateLabels()}else c=this._bar("values",a,b);return c},min:function(a){return this._values.min=this.values(a,this._values.max).min,this._values.min},max:function(a){return this._values.max=this.values(this._values.min,a).max,this._values.max},bounds:function(a,b){return this._isValidValue(a)&&this._isValidValue(b)&&b>a&&(this._setBounds(a,b),this._updateRuler(),this._changed(!0)),this.options.bounds},_isValidValue:function(a){return"undefined"!=typeof a&&parseFloat(a)===a},_setBounds:function(a,b){this.options.bounds={min:a,max:b},this._leftHandle("option","bounds",this.options.bounds),this._rightHandle("option","bounds",this.options.bounds),this._bar("option","bounds",this.options.bounds)},zoomIn:function(a){this._bar("zoomIn",a)},zoomOut:function(a){this._bar("zoomOut",a)},scrollLeft:function(a){this._bar("startScroll"),this._bar("scrollLeft",a),this._bar("stopScroll")},scrollRight:function(a){this._bar("startScroll"),this._bar("scrollRight",a),this._bar("stopScroll")},resize:function(){this._initWidth(),this._leftHandle("update"),this._rightHandle("update"),this._bar("update")},enable:function(){this.toggle(!0)},disable:function(){this.toggle(!1)},toggle:function(a){a===b&&(a=!this.options.enabled),this.options.enabled!==a&&this._toggle(a)},_toggle:function(a){this.options.enabled=a,this.element.toggleClass("ui-rangeSlider-disabled",!a);var b=a?"enable":"disable";this._bar(b),this._leftHandle(b),this._rightHandle(b),this._leftLabel(b),this._rightLabel(b)},destroy:function(){this.element.removeClass("ui-rangeSlider-withArrows ui-rangeSlider-noArrow ui-rangeSlider-disabled"),this._destroyWidgets(),this._destroyElements(),this.element.removeClass("ui-rangeSlider"),this.options=null,a(window).unbind("resize",this._resizeProxy),this._resizeProxy=null,this._bindResize=null,a.Widget.prototype.destroy.apply(this,arguments)},_destroyWidget:function(a){this["_"+a]("destroy"),this[a].remove(),this[a]=null},_destroyWidgets:function(){this._destroyWidget("bar"),this._destroyWidget("leftHandle"),this._destroyWidget("rightHandle"),this._destroyRuler(),this._destroyLabels()},_destroyElements:function(){this.container.remove(),this.container=null,this.innerBar.remove(),this.innerBar=null,this.arrows.left.remove(),this.arrows.right.remove(),this.arrows=null}})}(jQuery),function(a){"use strict";a.widget("ui.rangeSliderHandle",a.ui.rangeSliderDraggable,{currentMove:null,margin:0,parentElement:null,options:{isLeft:!0,bounds:{min:0,max:100},range:!1,value:0,step:!1},_value:0,_left:0,_create:function(){a.ui.rangeSliderDraggable.prototype._create.apply(this),this.element.css("position","absolute").css("top",0).addClass("ui-rangeSlider-handle").toggleClass("ui-rangeSlider-leftHandle",this.options.isLeft).toggleClass("ui-rangeSlider-rightHandle",!this.options.isLeft),this.element.append("<div class='ui-rangeSlider-handle-inner' />"),this._value=this._constraintValue(this.options.value)},destroy:function(){this.element.empty(),a.ui.rangeSliderDraggable.prototype.destroy.apply(this)},_setOption:function(b,c){"isLeft"!==b||c!==!0&&c!==!1||c===this.options.isLeft?"step"===b&&this._checkStep(c)?(this.options.step=c,this.update()):"bounds"===b?(this.options.bounds=c,this.update()):"range"===b&&this._checkRange(c)?(this.options.range=c,this.update()):"symmetricPositionning"===b&&(this.options.symmetricPositionning=c===!0,this.update()):(this.options.isLeft=c,this.element.toggleClass("ui-rangeSlider-leftHandle",this.options.isLeft).toggleClass("ui-rangeSlider-rightHandle",!this.options.isLeft),this._position(this._value),this.element.trigger("switch",this.options.isLeft)),a.ui.rangeSliderDraggable.prototype._setOption.apply(this,[b,c])},_checkRange:function(a){return a===!1||!this._isValidValue(a.min)&&!this._isValidValue(a.max)},_isValidValue:function(a){return"undefined"!=typeof a&&a!==!1&&parseFloat(a)!==a},_checkStep:function(a){return a===!1||parseFloat(a)===a},_initElement:function(){a.ui.rangeSliderDraggable.prototype._initElement.apply(this),0===this.cache.parent.width||null===this.cache.parent.width?setTimeout(a.proxy(this._initElementIfNotDestroyed,this),500):(this._position(this._value),this._triggerMouseEvent("initialize"))},_bounds:function(){return this.options.bounds},_cache:function(){a.ui.rangeSliderDraggable.prototype._cache.apply(this),this._cacheParent()},_cacheParent:function(){var a=this.element.parent();this.cache.parent={element:a,offset:a.offset(),padding:{left:this._parsePixels(a,"paddingLeft")},width:a.width()}},_position:function(a){var b=this._getPositionForValue(a);this._applyPosition(b)},_constraintPosition:function(a){var b=this._getValueForPosition(a);return this._getPositionForValue(b)},_applyPosition:function(b){a.ui.rangeSliderDraggable.prototype._applyPosition.apply(this,[b]),this._left=b,this._setValue(this._getValueForPosition(b)),this._triggerMouseEvent("moving")},_prepareEventData:function(){var b=a.ui.rangeSliderDraggable.prototype._prepareEventData.apply(this);return b.value=this._value,b},_setValue:function(a){a!==this._value&&(this._value=a)},_constraintValue:function(a){if(a=Math.min(a,this._bounds().max),a=Math.max(a,this._bounds().min),a=this._round(a),this.options.range!==!1){var b=this.options.range.min||!1,c=this.options.range.max||!1;b!==!1&&(a=Math.max(a,this._round(b))),c!==!1&&(a=Math.min(a,this._round(c))),a=Math.min(a,this._bounds().max),a=Math.max(a,this._bounds().min)}return a},_round:function(a){return this.options.step!==!1&&this.options.step>0?Math.round(a/this.options.step)*this.options.step:a},_getPositionForValue:function(a){if(!this.cache||!this.cache.parent||null===this.cache.parent.offset)return 0;a=this._constraintValue(a);var b=(a-this.options.bounds.min)/(this.options.bounds.max-this.options.bounds.min),c=this.cache.parent.width,d=this.cache.parent.offset.left,e=this.options.isLeft?0:this.cache.width.outer;return this.options.symmetricPositionning?b*(c-2*this.cache.width.outer)+d+e:b*c+d-e},_getValueForPosition:function(a){var b=this._getRawValueForPositionAndBounds(a,this.options.bounds.min,this.options.bounds.max);return this._constraintValue(b)},_getRawValueForPositionAndBounds:function(a,b,c){var d,e,f=null===this.cache.parent.offset?0:this.cache.parent.offset.left;return this.options.symmetricPositionning?(a-=this.options.isLeft?0:this.cache.width.outer,d=this.cache.parent.width-2*this.cache.width.outer):(a+=this.options.isLeft?0:this.cache.width.outer,d=this.cache.parent.width),0===d?this._value:(e=(a-f)/d,e*(c-b)+b)},value:function(a){return"undefined"!=typeof a&&(this._cache(),a=this._constraintValue(a),this._position(a)),this._value},update:function(){this._cache();var a=this._constraintValue(this._value),b=this._getPositionForValue(a);a!==this._value?(this._triggerMouseEvent("updating"),this._position(a),this._triggerMouseEvent("update")):b!==this.cache.offset.left&&(this._triggerMouseEvent("updating"),this._position(a),this._triggerMouseEvent("update"))},position:function(a){return"undefined"!=typeof a&&(this._cache(),a=this._constraintPosition(a),this._applyPosition(a)),this._left},add:function(a,b){return a+b},substract:function(a,b){return a-b},stepsBetween:function(a,b){return this.options.step===!1?b-a:(b-a)/this.options.step},multiplyStep:function(a,b){return a*b},moveRight:function(a){var b;return this.options.step===!1?(b=this._left,this.position(this._left+a),this._left-b):(b=this._value,this.value(this.add(b,this.multiplyStep(this.options.step,a))),this.stepsBetween(b,this._value))},moveLeft:function(a){return-this.moveRight(-a)},stepRatio:function(){if(this.options.step===!1)return 1;var a=(this.options.bounds.max-this.options.bounds.min)/this.options.step;return this.cache.parent.width/a}})}(jQuery),function(a){"use strict";function b(a,b){return"undefined"==typeof a?b||!1:a}a.widget("ui.rangeSliderBar",a.ui.rangeSliderDraggable,{options:{leftHandle:null,rightHandle:null,bounds:{min:0,max:100},type:"rangeSliderHandle",range:!1,drag:function(){},stop:function(){},values:{min:0,max:20},wheelSpeed:4,wheelMode:null},_values:{min:0,max:20},_waitingToInit:2,_wheelTimeout:!1,_create:function(){a.ui.rangeSliderDraggable.prototype._create.apply(this),this.element.css("position","absolute").css("top",0).addClass("ui-rangeSlider-bar"),this.options.leftHandle.bind("initialize",a.proxy(this._onInitialized,this)).bind("mousestart",a.proxy(this._cache,this)).bind("stop",a.proxy(this._onHandleStop,this)),this.options.rightHandle.bind("initialize",a.proxy(this._onInitialized,this)).bind("mousestart",a.proxy(this._cache,this)).bind("stop",a.proxy(this._onHandleStop,this)),this._bindHandles(),this._values=this.options.values,this._setWheelModeOption(this.options.wheelMode)},destroy:function(){this.options.leftHandle.unbind(".bar"),this.options.rightHandle.unbind(".bar"),this.options=null,a.ui.rangeSliderDraggable.prototype.destroy.apply(this)},_setOption:function(a,b){"range"===a?this._setRangeOption(b):"wheelSpeed"===a?this._setWheelSpeedOption(b):"wheelMode"===a&&this._setWheelModeOption(b)},_setRangeOption:function(a){if(("object"!=typeof a||null===a)&&(a=!1),a!==!1||this.options.range!==!1){if(a!==!1){var c=b(a.min,this.options.range.min),d=b(a.max,this.options.range.max);this.options.range={min:c,max:d}}else this.options.range=!1;this._setLeftRange(),this._setRightRange()}},_setWheelSpeedOption:function(a){"number"==typeof a&&a>0&&(this.options.wheelSpeed=a)},_setWheelModeOption:function(a){(null===a||a===!1||"zoom"===a||"scroll"===a)&&(this.options.wheelMode!==a&&this.element.parent().unbind("mousewheel.bar"),this._bindMouseWheel(a),this.options.wheelMode=a)},_bindMouseWheel:function(b){"zoom"===b?this.element.parent().bind("mousewheel.bar",a.proxy(this._mouseWheelZoom,this)):"scroll"===b&&this.element.parent().bind("mousewheel.bar",a.proxy(this._mouseWheelScroll,this))},_setLeftRange:function(){if(this.options.range===!1)return!1;var a=this._values.max,b={min:!1,max:!1};b.max="undefined"!=typeof this.options.range.min&&this.options.range.min!==!1?this._leftHandle("substract",a,this.options.range.min):!1,b.min="undefined"!=typeof this.options.range.max&&this.options.range.max!==!1?this._leftHandle("substract",a,this.options.range.max):!1,this._leftHandle("option","range",b)},_setRightRange:function(){var a=this._values.min,b={min:!1,max:!1};b.min="undefined"!=typeof this.options.range.min&&this.options.range.min!==!1?this._rightHandle("add",a,this.options.range.min):!1,b.max="undefined"!=typeof this.options.range.max&&this.options.range.max!==!1?this._rightHandle("add",a,this.options.range.max):!1,this._rightHandle("option","range",b)},_deactivateRange:function(){this._leftHandle("option","range",!1),this._rightHandle("option","range",!1)},_reactivateRange:function(){this._setRangeOption(this.options.range)},_onInitialized:function(){this._waitingToInit--,0===this._waitingToInit&&this._initMe()},_initMe:function(){this._cache(),this.min(this._values.min),this.max(this._values.max);var a=this._leftHandle("position"),b=this._rightHandle("position")+this.options.rightHandle.width();this.element.offset({left:a}),this.element.css("width",b-a)},_leftHandle:function(){return this._handleProxy(this.options.leftHandle,arguments)},_rightHandle:function(){return this._handleProxy(this.options.rightHandle,arguments)},_handleProxy:function(a,b){var c=Array.prototype.slice.call(b);return a[this.options.type].apply(a,c)},_cache:function(){a.ui.rangeSliderDraggable.prototype._cache.apply(this),this._cacheHandles()},_cacheHandles:function(){this.cache.rightHandle={},this.cache.rightHandle.width=this.options.rightHandle.width(),this.cache.rightHandle.offset=this.options.rightHandle.offset(),this.cache.leftHandle={},this.cache.leftHandle.offset=this.options.leftHandle.offset()},_mouseStart:function(b){a.ui.rangeSliderDraggable.prototype._mouseStart.apply(this,[b]),this._deactivateRange()},_mouseStop:function(b){a.ui.rangeSliderDraggable.prototype._mouseStop.apply(this,[b]),this._cacheHandles(),this._values.min=this._leftHandle("value"),this._values.max=this._rightHandle("value"),this._reactivateRange(),this._leftHandle().trigger("stop"),this._rightHandle().trigger("stop")},_onDragLeftHandle:function(a,b){if(this._cacheIfNecessary(),b.element[0]===this.options.leftHandle[0]){if(this._switchedValues())return this._switchHandles(),void this._onDragRightHandle(a,b);this._values.min=b.value,this.cache.offset.left=b.offset.left,this.cache.leftHandle.offset=b.offset,this._positionBar()}},_onDragRightHandle:function(a,b){if(this._cacheIfNecessary(),b.element[0]===this.options.rightHandle[0]){if(this._switchedValues())return this._switchHandles(),void this._onDragLeftHandle(a,b);this._values.max=b.value,this.cache.rightHandle.offset=b.offset,this._positionBar()}},_positionBar:function(){var a=this.cache.rightHandle.offset.left+this.cache.rightHandle.width-this.cache.leftHandle.offset.left;this.cache.width.inner=a,this.element.css("width",a).offset({left:this.cache.leftHandle.offset.left})},_onHandleStop:function(){this._setLeftRange(),this._setRightRange()},_switchedValues:function(){if(this.min()>this.max()){var a=this._values.min;return this._values.min=this._values.max,this._values.max=a,!0}return!1},_switchHandles:function(){var a=this.options.leftHandle;this.options.leftHandle=this.options.rightHandle,this.options.rightHandle=a,this._leftHandle("option","isLeft",!0),this._rightHandle("option","isLeft",!1),this._bindHandles(),this._cacheHandles()},_bindHandles:function(){this.options.leftHandle.unbind(".bar").bind("sliderDrag.bar update.bar moving.bar",a.proxy(this._onDragLeftHandle,this)),this.options.rightHandle.unbind(".bar").bind("sliderDrag.bar update.bar moving.bar",a.proxy(this._onDragRightHandle,this))},_constraintPosition:function(b){var c,d={};return d.left=a.ui.rangeSliderDraggable.prototype._constraintPosition.apply(this,[b]),d.left=this._leftHandle("position",d.left),c=this._rightHandle("position",d.left+this.cache.width.outer-this.cache.rightHandle.width),d.width=c-d.left+this.cache.rightHandle.width,d},_applyPosition:function(b){a.ui.rangeSliderDraggable.prototype._applyPosition.apply(this,[b.left]),this.element.width(b.width)},_mouseWheelZoom:function(b,c,d,e){if(!this.enabled)return!1;var f=this._values.min+(this._values.max-this._values.min)/2,g={},h={};return this.options.range===!1||this.options.range.min===!1?(g.max=f,h.min=f):(g.max=f-this.options.range.min/2,h.min=f+this.options.range.min/2),this.options.range!==!1&&this.options.range.max!==!1&&(g.min=f-this.options.range.max/2,h.max=f+this.options.range.max/2),this._leftHandle("option","range",g),this._rightHandle("option","range",h),clearTimeout(this._wheelTimeout),this._wheelTimeout=setTimeout(a.proxy(this._wheelStop,this),200),this.zoomIn(e*this.options.wheelSpeed),!1},_mouseWheelScroll:function(b,c,d,e){return this.enabled?(this._wheelTimeout===!1?this.startScroll():clearTimeout(this._wheelTimeout),this._wheelTimeout=setTimeout(a.proxy(this._wheelStop,this),200),this.scrollLeft(e*this.options.wheelSpeed),!1):!1},_wheelStop:function(){this.stopScroll(),this._wheelTimeout=!1},min:function(a){return this._leftHandle("value",a)},max:function(a){return this._rightHandle("value",a)},startScroll:function(){this._deactivateRange()},stopScroll:function(){this._reactivateRange(),this._triggerMouseEvent("stop"),this._leftHandle().trigger("stop"),this._rightHandle().trigger("stop")},scrollLeft:function(a){return a=a||1,0>a?this.scrollRight(-a):(a=this._leftHandle("moveLeft",a),this._rightHandle("moveLeft",a),this.update(),void this._triggerMouseEvent("scroll"))},scrollRight:function(a){return a=a||1,0>a?this.scrollLeft(-a):(a=this._rightHandle("moveRight",a),this._leftHandle("moveRight",a),this.update(),void this._triggerMouseEvent("scroll"))},zoomIn:function(a){if(a=a||1,0>a)return this.zoomOut(-a);var b=this._rightHandle("moveLeft",a);a>b&&(b/=2,this._rightHandle("moveRight",b)),this._leftHandle("moveRight",b),this.update(),this._triggerMouseEvent("zoom")},zoomOut:function(a){if(a=a||1,0>a)return this.zoomIn(-a);var b=this._rightHandle("moveRight",a);a>b&&(b/=2,this._rightHandle("moveLeft",b)),this._leftHandle("moveLeft",b),this.update(),this._triggerMouseEvent("zoom")},values:function(a,b){if("undefined"!=typeof a&&"undefined"!=typeof b){var c=Math.min(a,b),d=Math.max(a,b);this._deactivateRange(),this.options.leftHandle.unbind(".bar"),this.options.rightHandle.unbind(".bar"),this._values.min=this._leftHandle("value",c),this._values.max=this._rightHandle("value",d),this._bindHandles(),this._reactivateRange(),this.update()
}return{min:this._values.min,max:this._values.max}},update:function(){this._values.min=this.min(),this._values.max=this.max(),this._cache(),this._positionBar()}})}(jQuery),function(a){"use strict";function b(b,c,d,e){this.label1=b,this.label2=c,this.type=d,this.options=e,this.handle1=this.label1[this.type]("option","handle"),this.handle2=this.label2[this.type]("option","handle"),this.cache=null,this.left=b,this.right=c,this.moving=!1,this.initialized=!1,this.updating=!1,this.Init=function(){this.BindHandle(this.handle1),this.BindHandle(this.handle2),"show"===this.options.show?(setTimeout(a.proxy(this.PositionLabels,this),1),this.initialized=!0):setTimeout(a.proxy(this.AfterInit,this),1e3),this._resizeProxy=a.proxy(this.onWindowResize,this),a(window).resize(this._resizeProxy)},this.Destroy=function(){this._resizeProxy&&(a(window).unbind("resize",this._resizeProxy),this._resizeProxy=null,this.handle1.unbind(".positionner"),this.handle1=null,this.handle2.unbind(".positionner"),this.handle2=null,this.label1=null,this.label2=null,this.left=null,this.right=null),this.cache=null},this.AfterInit=function(){this.initialized=!0},this.Cache=function(){"none"!==this.label1.css("display")&&(this.cache={},this.cache.label1={},this.cache.label2={},this.cache.handle1={},this.cache.handle2={},this.cache.offsetParent={},this.CacheElement(this.label1,this.cache.label1),this.CacheElement(this.label2,this.cache.label2),this.CacheElement(this.handle1,this.cache.handle1),this.CacheElement(this.handle2,this.cache.handle2),this.CacheElement(this.label1.offsetParent(),this.cache.offsetParent))},this.CacheIfNecessary=function(){null===this.cache?this.Cache():(this.CacheWidth(this.label1,this.cache.label1),this.CacheWidth(this.label2,this.cache.label2),this.CacheHeight(this.label1,this.cache.label1),this.CacheHeight(this.label2,this.cache.label2),this.CacheWidth(this.label1.offsetParent(),this.cache.offsetParent))},this.CacheElement=function(a,b){this.CacheWidth(a,b),this.CacheHeight(a,b),b.offset=a.offset(),b.margin={left:this.ParsePixels("marginLeft",a),right:this.ParsePixels("marginRight",a)},b.border={left:this.ParsePixels("borderLeftWidth",a),right:this.ParsePixels("borderRightWidth",a)}},this.CacheWidth=function(a,b){b.width=a.width(),b.outerWidth=a.outerWidth()},this.CacheHeight=function(a,b){b.outerHeightMargin=a.outerHeight(!0)},this.ParsePixels=function(a,b){return parseInt(b.css(a),10)||0},this.BindHandle=function(b){b.bind("updating.positionner",a.proxy(this.onHandleUpdating,this)),b.bind("update.positionner",a.proxy(this.onHandleUpdated,this)),b.bind("moving.positionner",a.proxy(this.onHandleMoving,this)),b.bind("stop.positionner",a.proxy(this.onHandleStop,this))},this.PositionLabels=function(){if(this.CacheIfNecessary(),null!==this.cache){var a=this.GetRawPosition(this.cache.label1,this.cache.handle1),b=this.GetRawPosition(this.cache.label2,this.cache.handle2);this.label1[d]("option","isLeft")?this.ConstraintPositions(a,b):this.ConstraintPositions(b,a),this.PositionLabel(this.label1,a.left,this.cache.label1),this.PositionLabel(this.label2,b.left,this.cache.label2)}},this.PositionLabel=function(a,b,c){var d,e,f,g=this.cache.offsetParent.offset.left+this.cache.offsetParent.border.left;g-b>=0?(a.css("right",""),a.offset({left:b})):(d=g+this.cache.offsetParent.width,e=b+c.margin.left+c.outerWidth+c.margin.right,f=d-e,a.css("left",""),a.css("right",f))},this.ConstraintPositions=function(a,b){(a.center<b.center&&a.outerRight>b.outerLeft||a.center>b.center&&b.outerRight>a.outerLeft)&&(a=this.getLeftPosition(a,b),b=this.getRightPosition(a,b))},this.getLeftPosition=function(a,b){var c=(b.center+a.center)/2,d=c-a.cache.outerWidth-a.cache.margin.right+a.cache.border.left;return a.left=d,a},this.getRightPosition=function(a,b){var c=(b.center+a.center)/2;return b.left=c+b.cache.margin.left+b.cache.border.left,b},this.ShowIfNecessary=function(){"show"===this.options.show||this.moving||!this.initialized||this.updating||(this.label1.stop(!0,!0).fadeIn(this.options.durationIn||0),this.label2.stop(!0,!0).fadeIn(this.options.durationIn||0),this.moving=!0)},this.HideIfNeeded=function(){this.moving===!0&&(this.label1.stop(!0,!0).delay(this.options.delayOut||0).fadeOut(this.options.durationOut||0),this.label2.stop(!0,!0).delay(this.options.delayOut||0).fadeOut(this.options.durationOut||0),this.moving=!1)},this.onHandleMoving=function(a,b){this.ShowIfNecessary(),this.CacheIfNecessary(),this.UpdateHandlePosition(b),this.PositionLabels()},this.onHandleUpdating=function(){this.updating=!0},this.onHandleUpdated=function(){this.updating=!1,this.cache=null},this.onHandleStop=function(){this.HideIfNeeded()},this.onWindowResize=function(){this.cache=null},this.UpdateHandlePosition=function(a){null!==this.cache&&(a.element[0]===this.handle1[0]?this.UpdatePosition(a,this.cache.handle1):this.UpdatePosition(a,this.cache.handle2))},this.UpdatePosition=function(a,b){b.offset=a.offset,b.value=a.value},this.GetRawPosition=function(a,b){var c=b.offset.left+b.outerWidth/2,d=c-a.outerWidth/2,e=d+a.outerWidth-a.border.left-a.border.right,f=d-a.margin.left-a.border.left,g=b.offset.top-a.outerHeightMargin;return{left:d,outerLeft:f,top:g,right:e,outerRight:f+a.outerWidth+a.margin.left+a.margin.right,cache:a,center:c}},this.Init()}a.widget("ui.rangeSliderLabel",a.ui.rangeSliderMouseTouch,{options:{handle:null,formatter:!1,handleType:"rangeSliderHandle",show:"show",durationIn:0,durationOut:500,delayOut:500,isLeft:!1},cache:null,_positionner:null,_valueContainer:null,_innerElement:null,_value:null,_create:function(){this.options.isLeft=this._handle("option","isLeft"),this.element.addClass("ui-rangeSlider-label").css("position","absolute").css("display","block"),this._createElements(),this._toggleClass(),this.options.handle.bind("moving.label",a.proxy(this._onMoving,this)).bind("update.label",a.proxy(this._onUpdate,this)).bind("switch.label",a.proxy(this._onSwitch,this)),"show"!==this.options.show&&this.element.hide(),this._mouseInit()},destroy:function(){this.options.handle.unbind(".label"),this.options.handle=null,this._valueContainer=null,this._innerElement=null,this.element.empty(),this._positionner&&(this._positionner.Destroy(),this._positionner=null),a.ui.rangeSliderMouseTouch.prototype.destroy.apply(this)},_createElements:function(){this._valueContainer=a("<div class='ui-rangeSlider-label-value' />").appendTo(this.element),this._innerElement=a("<div class='ui-rangeSlider-label-inner' />").appendTo(this.element)},_handle:function(){var a=Array.prototype.slice.apply(arguments);return this.options.handle[this.options.handleType].apply(this.options.handle,a)},_setOption:function(a,b){"show"===a?this._updateShowOption(b):("durationIn"===a||"durationOut"===a||"delayOut"===a)&&this._updateDurations(a,b),this._setFormatterOption(a,b)},_setFormatterOption:function(a,b){"formatter"===a&&("function"==typeof b||b===!1)&&(this.options.formatter=b,this._display(this._value))},_updateShowOption:function(a){this.options.show=a,"show"!==this.options.show?(this.element.hide(),this._positionner.moving=!1):(this.element.show(),this._display(this.options.handle[this.options.handleType]("value")),this._positionner.PositionLabels()),this._positionner.options.show=this.options.show},_updateDurations:function(a,b){parseInt(b,10)===b&&(this._positionner.options[a]=b,this.options[a]=b)},_display:function(a){this._displayText(this.options.formatter===!1?Math.round(a):this.options.formatter(a)),this._value=a},_displayText:function(a){this._valueContainer.text(a)},_toggleClass:function(){this.element.toggleClass("ui-rangeSlider-leftLabel",this.options.isLeft).toggleClass("ui-rangeSlider-rightLabel",!this.options.isLeft)},_positionLabels:function(){this._positionner.PositionLabels()},_mouseDown:function(a){this.options.handle.trigger(a)},_mouseUp:function(a){this.options.handle.trigger(a)},_mouseMove:function(a){this.options.handle.trigger(a)},_onMoving:function(a,b){this._display(b.value)},_onUpdate:function(){"show"===this.options.show&&this.update()},_onSwitch:function(a,b){this.options.isLeft=b,this._toggleClass(),this._positionLabels()},pair:function(a){null===this._positionner&&(this._positionner=new b(this.element,a,this.widgetName,{show:this.options.show,durationIn:this.options.durationIn,durationOut:this.options.durationOut,delayOut:this.options.delayOut}),a[this.widgetName]("positionner",this._positionner))},positionner:function(a){return"undefined"!=typeof a&&(this._positionner=a),this._positionner},update:function(){this._positionner.cache=null,this._display(this._handle("value")),"show"===this.options.show&&this._positionLabels()}})}(jQuery),function(a){"use strict";a.widget("ui.dateRangeSlider",a.ui.rangeSlider,{options:{bounds:{min:new Date(2010,0,1).valueOf(),max:new Date(2012,0,1).valueOf()},defaultValues:{min:new Date(2010,1,11).valueOf(),max:new Date(2011,1,11).valueOf()}},_create:function(){a.ui.rangeSlider.prototype._create.apply(this),this.element.addClass("ui-dateRangeSlider")},destroy:function(){this.element.removeClass("ui-dateRangeSlider"),a.ui.rangeSlider.prototype.destroy.apply(this)},_setDefaultValues:function(){this._values={min:this.options.defaultValues.min.valueOf(),max:this.options.defaultValues.max.valueOf()}},_setRulerParameters:function(){this.ruler.ruler({min:new Date(this.options.bounds.min.valueOf()),max:new Date(this.options.bounds.max.valueOf()),scales:this.options.scales})},_setOption:function(b,c){("defaultValues"===b||"bounds"===b)&&"undefined"!=typeof c&&null!==c&&this._isValidDate(c.min)&&this._isValidDate(c.max)?a.ui.rangeSlider.prototype._setOption.apply(this,[b,{min:c.min.valueOf(),max:c.max.valueOf()}]):a.ui.rangeSlider.prototype._setOption.apply(this,this._toArray(arguments))},_handleType:function(){return"dateRangeSliderHandle"},option:function(b){if("bounds"===b||"defaultValues"===b){var c=a.ui.rangeSlider.prototype.option.apply(this,arguments);return{min:new Date(c.min),max:new Date(c.max)}}return a.ui.rangeSlider.prototype.option.apply(this,this._toArray(arguments))},_defaultFormatter:function(a){var b=a.getMonth()+1,c=a.getDate();return""+a.getFullYear()+"-"+(10>b?"0"+b:b)+"-"+(10>c?"0"+c:c)},_getFormatter:function(){var a=this.options.formatter;return(this.options.formatter===!1||null===this.options.formatter)&&(a=this._defaultFormatter),function(a){return function(b){return a(new Date(b))}}(a)},values:function(b,c){var d=null;return d=this._isValidDate(b)&&this._isValidDate(c)?a.ui.rangeSlider.prototype.values.apply(this,[b.valueOf(),c.valueOf()]):a.ui.rangeSlider.prototype.values.apply(this,this._toArray(arguments)),{min:new Date(d.min),max:new Date(d.max)}},min:function(b){return new Date(this._isValidDate(b)?a.ui.rangeSlider.prototype.min.apply(this,[b.valueOf()]):a.ui.rangeSlider.prototype.min.apply(this))},max:function(b){return new Date(this._isValidDate(b)?a.ui.rangeSlider.prototype.max.apply(this,[b.valueOf()]):a.ui.rangeSlider.prototype.max.apply(this))},bounds:function(b,c){var d;return d=this._isValidDate(b)&&this._isValidDate(c)?a.ui.rangeSlider.prototype.bounds.apply(this,[b.valueOf(),c.valueOf()]):a.ui.rangeSlider.prototype.bounds.apply(this,this._toArray(arguments)),{min:new Date(d.min),max:new Date(d.max)}},_isValidDate:function(a){return"undefined"!=typeof a&&a instanceof Date},_toArray:function(a){return Array.prototype.slice.call(a)}})}(jQuery),function(a){"use strict";a.widget("ui.dateRangeSliderHandle",a.ui.rangeSliderHandle,{_steps:!1,_boundsValues:{},_create:function(){this._createBoundsValues(),a.ui.rangeSliderHandle.prototype._create.apply(this)},_getValueForPosition:function(a){var b=this._getRawValueForPositionAndBounds(a,this.options.bounds.min.valueOf(),this.options.bounds.max.valueOf());return this._constraintValue(new Date(b))},_setOption:function(b,c){return"step"===b?(this.options.step=c,this._createSteps(),void this.update()):(a.ui.rangeSliderHandle.prototype._setOption.apply(this,[b,c]),void("bounds"===b&&this._createBoundsValues()))},_createBoundsValues:function(){this._boundsValues={min:this.options.bounds.min.valueOf(),max:this.options.bounds.max.valueOf()}},_bounds:function(){return this._boundsValues},_createSteps:function(){if(this.options.step===!1||!this._isValidStep())return void(this._steps=!1);var a=new Date(this.options.bounds.min.valueOf()),b=new Date(this.options.bounds.max.valueOf()),c=a,d=0,e=new Date;for(this._steps=[];b>=c&&(1===d||e.valueOf()!==c.valueOf());)e=c,this._steps.push(c.valueOf()),c=this._addStep(a,d,this.options.step),d++;e.valueOf()===c.valueOf()&&(this._steps=!1)},_isValidStep:function(){return"object"==typeof this.options.step},_addStep:function(a,b,c){var d=new Date(a.valueOf());return d=this._addThing(d,"FullYear",b,c.years),d=this._addThing(d,"Month",b,c.months),d=this._addThing(d,"Date",b,7*c.weeks),d=this._addThing(d,"Date",b,c.days),d=this._addThing(d,"Hours",b,c.hours),d=this._addThing(d,"Minutes",b,c.minutes),d=this._addThing(d,"Seconds",b,c.seconds)},_addThing:function(a,b,c,d){return 0===c||0===(d||0)?a:(a["set"+b](a["get"+b]()+c*(d||0)),a)},_round:function(a){if(this._steps===!1)return a;for(var b,c,d=this.options.bounds.max.valueOf(),e=this.options.bounds.min.valueOf(),f=Math.max(0,(a-e)/(d-e)),g=Math.floor(this._steps.length*f);this._steps[g]>a;)g--;for(;g+1<this._steps.length&&this._steps[g+1]<=a;)g++;return g>=this._steps.length-1?this._steps[this._steps.length-1]:0===g?this._steps[0]:(b=this._steps[g],c=this._steps[g+1],c-a>a-b?b:c)},update:function(){this._createBoundsValues(),this._createSteps(),a.ui.rangeSliderHandle.prototype.update.apply(this)},add:function(a,b){return this._addStep(new Date(a),1,b).valueOf()},substract:function(a,b){return this._addStep(new Date(a),-1,b).valueOf()},stepsBetween:function(a,b){if(this.options.step===!1)return b-a;var c=Math.min(a,b),d=Math.max(a,b),e=0,f=!1,g=a>b;for(this.add(c,this.options.step)-c<0&&(f=!0);d>c;)f?d=this.add(d,this.options.step):c=this.add(c,this.options.step),e++;return g?-e:e},multiplyStep:function(a,b){var c={};for(var d in a)a.hasOwnProperty(d)&&(c[d]=a[d]*b);return c},stepRatio:function(){if(this.options.step===!1)return 1;var a=this._steps.length;return this.cache.parent.width/a}})}(jQuery),function(a){"use strict";a.widget("ui.editRangeSlider",a.ui.rangeSlider,{options:{type:"text",round:1},_create:function(){a.ui.rangeSlider.prototype._create.apply(this),this.element.addClass("ui-editRangeSlider")},destroy:function(){this.element.removeClass("ui-editRangeSlider"),a.ui.rangeSlider.prototype.destroy.apply(this)},_setOption:function(b,c){("type"===b||"step"===b)&&this._setLabelOption(b,c),"type"===b&&(this.options[b]=null===this.labels.left?c:this._leftLabel("option",b)),a.ui.rangeSlider.prototype._setOption.apply(this,[b,c])},_setLabelOption:function(a,b){null!==this.labels.left&&(this._leftLabel("option",a,b),this._rightLabel("option",a,b))},_labelType:function(){return"editRangeSliderLabel"},_createLabel:function(b,c){var d=a.ui.rangeSlider.prototype._createLabel.apply(this,[b,c]);return null===b&&d.bind("valueChange",a.proxy(this._onValueChange,this)),d},_addPropertiesToParameter:function(a){return a.type=this.options.type,a.step=this.options.step,a.id=this.element.attr("id"),a},_getLabelConstructorParameters:function(b,c){var d=a.ui.rangeSlider.prototype._getLabelConstructorParameters.apply(this,[b,c]);return this._addPropertiesToParameter(d)},_getLabelRefreshParameters:function(b,c){var d=a.ui.rangeSlider.prototype._getLabelRefreshParameters.apply(this,[b,c]);return this._addPropertiesToParameter(d)},_onValueChange:function(a,b){var c=!1;c=b.isLeft?this._values.min!==this.min(b.value):this._values.max!==this.max(b.value),c&&this._trigger("userValuesChanged")}})}(jQuery),function(a){"use strict";a.widget("ui.editRangeSliderLabel",a.ui.rangeSliderLabel,{options:{type:"text",step:!1,id:""},_input:null,_text:"",_create:function(){a.ui.rangeSliderLabel.prototype._create.apply(this),this._createInput()},_setOption:function(b,c){"type"===b?this._setTypeOption(c):"step"===b&&this._setStepOption(c),a.ui.rangeSliderLabel.prototype._setOption.apply(this,[b,c])},_createInput:function(){this._input=a("<input type='"+this.options.type+"' />").addClass("ui-editRangeSlider-inputValue").appendTo(this._valueContainer),this._setInputName(),this._input.bind("keyup",a.proxy(this._onKeyUp,this)),this._input.blur(a.proxy(this._onChange,this)),"number"===this.options.type&&(this.options.step!==!1&&this._input.attr("step",this.options.step),this._input.click(a.proxy(this._onChange,this))),this._input.val(this._text)},_setInputName:function(){var a=this.options.isLeft?"left":"right";this._input.attr("name",this.options.id+a)},_onSwitch:function(b,c){a.ui.rangeSliderLabel.prototype._onSwitch.apply(this,[b,c]),this._setInputName()},_destroyInput:function(){this._input.remove(),this._input=null},_onKeyUp:function(a){return 13===a.which?(this._onChange(a),!1):void 0},_onChange:function(){var a=this._returnCheckedValue(this._input.val());a!==!1&&this._triggerValue(a)},_triggerValue:function(a){var b=this.options.handle[this.options.handleType]("option","isLeft");this.element.trigger("valueChange",[{isLeft:b,value:a}])},_returnCheckedValue:function(a){var b=parseFloat(a);return isNaN(b)||isNaN(Number(a))?!1:b},_setTypeOption:function(a){"text"!==a&&"number"!==a||this.options.type===a||(this._destroyInput(),this.options.type=a,this._createInput())},_setStepOption:function(a){this.options.step=a,"number"===this.options.type&&this._input.attr("step",a!==!1?a:"any")},_displayText:function(a){this._input.val(a),this._text=a},enable:function(){a.ui.rangeSliderLabel.prototype.enable.apply(this),this._input.attr("disabled",null)},disable:function(){a.ui.rangeSliderLabel.prototype.disable.apply(this),this._input.attr("disabled","disabled")}})}(jQuery);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// MOBILE DETECT
/*! mobile-detect - v0.4.3 - 2014-12-08
github.com/hgoebl/mobile-detect.js */!function(a,b){a(function(){"use strict";function a(a){for(var b in a)o.call(a,b)&&(a[b]=new RegExp(a[b],"i"))}function c(a,b){for(var c in a)if(o.call(a,c)&&a[c].test(b))return c;return null}function d(a,b){var c,d,e,f,g=m.props;if(o.call(g,a))for(c=g[a],e=c.length,d=0;e>d;++d)if(f=c[d].exec(b),null!==f)return f[1];return null}function e(a,b){var c=d(a,b);return c?f(c):0/0}function f(a){var b;return b=a.split(/[a-z._ \/\-]/i),1===b.length&&(a=b[0]),b.length>1&&(a=b[0]+".",b.shift(),a+=b.join("")),Number(a)}function g(a,b){return null!=a&&null!=b&&a.toLowerCase()===b.toLowerCase()}function h(a){return n.fullPattern.test(a)||n.shortPattern.test(a.substr(0,4))}function i(a,d,e){if(a.mobile===b){var f,g,i;return(g=c(m.tablets,d))?(a.mobile=a.tablet=g,a.phone=null,void 0):(f=c(m.phones,d))?(a.mobile=a.phone=f,a.tablet=null,void 0):(h(d)?(i=k.isPhoneSized(e),i===b?a.mobile=a.tablet=a.phone=r:i?(a.mobile=a.phone=p,a.tablet=null):(a.mobile=a.tablet=q,a.phone=null)):a.mobile=a.tablet=a.phone=null,void 0)}}function j(a){var b=null!==a.mobile();return a.os("iOS")&&a.version("iPad")>=4.3||a.os("iOS")&&a.version("iPhone")>=3.1||a.os("iOS")&&a.version("iPod")>=3.1||a.version("Android")>2.1&&a.is("Webkit")||a.version("Windows Phone OS")>=7||a.is("BlackBerry")&&a.version("BlackBerry")>=6||a.match("Playbook.*Tablet")||a.version("webOS")>=1.4&&a.match("Palm|Pre|Pixi")||a.match("hp.*TouchPad")||a.is("Firefox")&&a.version("Firefox")>=12||a.is("Chrome")&&a.is("AndroidOS")&&a.version("Android")>=4||a.is("Skyfire")&&a.version("Skyfire")>=4.1&&a.is("AndroidOS")&&a.version("Android")>=2.3||a.is("Opera")&&a.version("Opera Mobi")>11&&a.is("AndroidOS")||a.is("MeeGoOS")||a.is("Tizen")||a.is("Dolfin")&&a.version("Bada")>=2||(a.is("UC Browser")||a.is("Dolfin"))&&a.version("Android")>=2.3||a.match("Kindle Fire")||a.is("Kindle")&&a.version("Kindle")>=3||a.is("AndroidOS")&&a.is("NookTablet")||a.version("Chrome")>=11&&!b||a.version("Safari")>=5&&!b||a.version("Firefox")>=4&&!b||a.version("MSIE")>=7&&!b||a.version("Opera")>=10&&!b?"A":a.os("iOS")&&a.version("iPad")<4.3||a.os("iOS")&&a.version("iPhone")<3.1||a.os("iOS")&&a.version("iPod")<3.1||a.is("Blackberry")&&a.version("BlackBerry")>=5&&a.version("BlackBerry")<6||a.version("Opera Mini")>=5&&a.version("Opera Mini")<=6.5&&(a.version("Android")>=2.3||a.is("iOS"))||a.match("NokiaN8|NokiaC7|N97.*Series60|Symbian/3")||a.version("Opera Mobi")>=11&&a.is("SymbianOS")?"B":a.version("BlackBerry")<5||a.match("MSIEMobile|Windows CE.*Mobile")||a.version("Windows Mobile")<=5.2?"C":"C"}function k(a,b){this.ua=a||"",this._cache={},this.maxPhoneWidth=b||650}var l,m={phones:{iPhone:"\\biPhone\\b|\\biPod\\b",BlackBerry:"BlackBerry|\\bBB10\\b|rim[0-9]+",HTC:"HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6400L|ADR6425|001HT|Inspire 4G|Android.*\\bEVO\\b|T-Mobile G1|Z520m",Nexus:"Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile|Nexus 4|Nexus 5|Nexus 6",Dell:"Dell.*Streak|Dell.*Aero|Dell.*Venue|DELL.*Venue Pro|Dell Flash|Dell Smoke|Dell Mini 3iX|XCD28|XCD35|\\b001DL\\b|\\b101DL\\b|\\bGS01\\b",Motorola:"Motorola|DROIDX|DROID BIONIC|\\bDroid\\b.*Build|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|Motorola.*ELECTRIFY|Motorola.*i1|i867|i940|MB200|MB300|MB501|MB502|MB508|MB511|MB520|MB525|MB526|MB611|MB612|MB632|MB810|MB855|MB860|MB861|MB865|MB870|ME501|ME502|ME511|ME525|ME600|ME632|ME722|ME811|ME860|ME863|ME865|MT620|MT710|MT716|MT720|MT810|MT870|MT917|Motorola.*TITANIUM|WX435|WX445|XT300|XT301|XT311|XT316|XT317|XT319|XT320|XT390|XT502|XT530|XT531|XT532|XT535|XT603|XT610|XT611|XT615|XT681|XT701|XT702|XT711|XT720|XT800|XT806|XT860|XT862|XT875|XT882|XT883|XT894|XT901|XT907|XT909|XT910|XT912|XT928|XT926|XT915|XT919|XT925",Samsung:"Samsung|SGH-I337|BGT-S5230|GT-B2100|GT-B2700|GT-B2710|GT-B3210|GT-B3310|GT-B3410|GT-B3730|GT-B3740|GT-B5510|GT-B5512|GT-B5722|GT-B6520|GT-B7300|GT-B7320|GT-B7330|GT-B7350|GT-B7510|GT-B7722|GT-B7800|GT-C3010|GT-C3011|GT-C3060|GT-C3200|GT-C3212|GT-C3212I|GT-C3262|GT-C3222|GT-C3300|GT-C3300K|GT-C3303|GT-C3303K|GT-C3310|GT-C3322|GT-C3330|GT-C3350|GT-C3500|GT-C3510|GT-C3530|GT-C3630|GT-C3780|GT-C5010|GT-C5212|GT-C6620|GT-C6625|GT-C6712|GT-E1050|GT-E1070|GT-E1075|GT-E1080|GT-E1081|GT-E1085|GT-E1087|GT-E1100|GT-E1107|GT-E1110|GT-E1120|GT-E1125|GT-E1130|GT-E1160|GT-E1170|GT-E1175|GT-E1180|GT-E1182|GT-E1200|GT-E1210|GT-E1225|GT-E1230|GT-E1390|GT-E2100|GT-E2120|GT-E2121|GT-E2152|GT-E2220|GT-E2222|GT-E2230|GT-E2232|GT-E2250|GT-E2370|GT-E2550|GT-E2652|GT-E3210|GT-E3213|GT-I5500|GT-I5503|GT-I5700|GT-I5800|GT-I5801|GT-I6410|GT-I6420|GT-I7110|GT-I7410|GT-I7500|GT-I8000|GT-I8150|GT-I8160|GT-I8190|GT-I8320|GT-I8330|GT-I8350|GT-I8530|GT-I8700|GT-I8703|GT-I8910|GT-I9000|GT-I9001|GT-I9003|GT-I9010|GT-I9020|GT-I9023|GT-I9070|GT-I9082|GT-I9100|GT-I9103|GT-I9220|GT-I9250|GT-I9300|GT-I9305|GT-I9500|GT-I9505|GT-M3510|GT-M5650|GT-M7500|GT-M7600|GT-M7603|GT-M8800|GT-M8910|GT-N7000|GT-S3110|GT-S3310|GT-S3350|GT-S3353|GT-S3370|GT-S3650|GT-S3653|GT-S3770|GT-S3850|GT-S5210|GT-S5220|GT-S5229|GT-S5230|GT-S5233|GT-S5250|GT-S5253|GT-S5260|GT-S5263|GT-S5270|GT-S5300|GT-S5330|GT-S5350|GT-S5360|GT-S5363|GT-S5369|GT-S5380|GT-S5380D|GT-S5560|GT-S5570|GT-S5600|GT-S5603|GT-S5610|GT-S5620|GT-S5660|GT-S5670|GT-S5690|GT-S5750|GT-S5780|GT-S5830|GT-S5839|GT-S6102|GT-S6500|GT-S7070|GT-S7200|GT-S7220|GT-S7230|GT-S7233|GT-S7250|GT-S7500|GT-S7530|GT-S7550|GT-S7562|GT-S7710|GT-S8000|GT-S8003|GT-S8500|GT-S8530|GT-S8600|SCH-A310|SCH-A530|SCH-A570|SCH-A610|SCH-A630|SCH-A650|SCH-A790|SCH-A795|SCH-A850|SCH-A870|SCH-A890|SCH-A930|SCH-A950|SCH-A970|SCH-A990|SCH-I100|SCH-I110|SCH-I400|SCH-I405|SCH-I500|SCH-I510|SCH-I515|SCH-I600|SCH-I730|SCH-I760|SCH-I770|SCH-I830|SCH-I910|SCH-I920|SCH-I959|SCH-LC11|SCH-N150|SCH-N300|SCH-R100|SCH-R300|SCH-R351|SCH-R400|SCH-R410|SCH-T300|SCH-U310|SCH-U320|SCH-U350|SCH-U360|SCH-U365|SCH-U370|SCH-U380|SCH-U410|SCH-U430|SCH-U450|SCH-U460|SCH-U470|SCH-U490|SCH-U540|SCH-U550|SCH-U620|SCH-U640|SCH-U650|SCH-U660|SCH-U700|SCH-U740|SCH-U750|SCH-U810|SCH-U820|SCH-U900|SCH-U940|SCH-U960|SCS-26UC|SGH-A107|SGH-A117|SGH-A127|SGH-A137|SGH-A157|SGH-A167|SGH-A177|SGH-A187|SGH-A197|SGH-A227|SGH-A237|SGH-A257|SGH-A437|SGH-A517|SGH-A597|SGH-A637|SGH-A657|SGH-A667|SGH-A687|SGH-A697|SGH-A707|SGH-A717|SGH-A727|SGH-A737|SGH-A747|SGH-A767|SGH-A777|SGH-A797|SGH-A817|SGH-A827|SGH-A837|SGH-A847|SGH-A867|SGH-A877|SGH-A887|SGH-A897|SGH-A927|SGH-B100|SGH-B130|SGH-B200|SGH-B220|SGH-C100|SGH-C110|SGH-C120|SGH-C130|SGH-C140|SGH-C160|SGH-C170|SGH-C180|SGH-C200|SGH-C207|SGH-C210|SGH-C225|SGH-C230|SGH-C417|SGH-C450|SGH-D307|SGH-D347|SGH-D357|SGH-D407|SGH-D415|SGH-D780|SGH-D807|SGH-D980|SGH-E105|SGH-E200|SGH-E315|SGH-E316|SGH-E317|SGH-E335|SGH-E590|SGH-E635|SGH-E715|SGH-E890|SGH-F300|SGH-F480|SGH-I200|SGH-I300|SGH-I320|SGH-I550|SGH-I577|SGH-I600|SGH-I607|SGH-I617|SGH-I627|SGH-I637|SGH-I677|SGH-I700|SGH-I717|SGH-I727|SGH-i747M|SGH-I777|SGH-I780|SGH-I827|SGH-I847|SGH-I857|SGH-I896|SGH-I897|SGH-I900|SGH-I907|SGH-I917|SGH-I927|SGH-I937|SGH-I997|SGH-J150|SGH-J200|SGH-L170|SGH-L700|SGH-M110|SGH-M150|SGH-M200|SGH-N105|SGH-N500|SGH-N600|SGH-N620|SGH-N625|SGH-N700|SGH-N710|SGH-P107|SGH-P207|SGH-P300|SGH-P310|SGH-P520|SGH-P735|SGH-P777|SGH-Q105|SGH-R210|SGH-R220|SGH-R225|SGH-S105|SGH-S307|SGH-T109|SGH-T119|SGH-T139|SGH-T209|SGH-T219|SGH-T229|SGH-T239|SGH-T249|SGH-T259|SGH-T309|SGH-T319|SGH-T329|SGH-T339|SGH-T349|SGH-T359|SGH-T369|SGH-T379|SGH-T409|SGH-T429|SGH-T439|SGH-T459|SGH-T469|SGH-T479|SGH-T499|SGH-T509|SGH-T519|SGH-T539|SGH-T559|SGH-T589|SGH-T609|SGH-T619|SGH-T629|SGH-T639|SGH-T659|SGH-T669|SGH-T679|SGH-T709|SGH-T719|SGH-T729|SGH-T739|SGH-T746|SGH-T749|SGH-T759|SGH-T769|SGH-T809|SGH-T819|SGH-T839|SGH-T919|SGH-T929|SGH-T939|SGH-T959|SGH-T989|SGH-U100|SGH-U200|SGH-U800|SGH-V205|SGH-V206|SGH-X100|SGH-X105|SGH-X120|SGH-X140|SGH-X426|SGH-X427|SGH-X475|SGH-X495|SGH-X497|SGH-X507|SGH-X600|SGH-X610|SGH-X620|SGH-X630|SGH-X700|SGH-X820|SGH-X890|SGH-Z130|SGH-Z150|SGH-Z170|SGH-ZX10|SGH-ZX20|SHW-M110|SPH-A120|SPH-A400|SPH-A420|SPH-A460|SPH-A500|SPH-A560|SPH-A600|SPH-A620|SPH-A660|SPH-A700|SPH-A740|SPH-A760|SPH-A790|SPH-A800|SPH-A820|SPH-A840|SPH-A880|SPH-A900|SPH-A940|SPH-A960|SPH-D600|SPH-D700|SPH-D710|SPH-D720|SPH-I300|SPH-I325|SPH-I330|SPH-I350|SPH-I500|SPH-I600|SPH-I700|SPH-L700|SPH-M100|SPH-M220|SPH-M240|SPH-M300|SPH-M305|SPH-M320|SPH-M330|SPH-M350|SPH-M360|SPH-M370|SPH-M380|SPH-M510|SPH-M540|SPH-M550|SPH-M560|SPH-M570|SPH-M580|SPH-M610|SPH-M620|SPH-M630|SPH-M800|SPH-M810|SPH-M850|SPH-M900|SPH-M910|SPH-M920|SPH-M930|SPH-N100|SPH-N200|SPH-N240|SPH-N300|SPH-N400|SPH-Z400|SWC-E100|SCH-i909|GT-N7100|GT-N7105|SCH-I535|SM-N900A|SGH-I317|SGH-T999L|GT-S5360B|GT-I8262|GT-S6802|GT-S6312|GT-S6310|GT-S5312|GT-S5310|GT-I9105|GT-I8510|GT-S6790N|SM-G7105|SM-N9005|GT-S5301|GT-I9295|GT-I9195|SM-C101|GT-S7392|GT-S7560|GT-B7610|GT-I5510|GT-S7582|GT-S7530E|GT-I8750",LG:"\\bLG\\b;|LG[- ]?(C800|C900|E400|E610|E900|E-900|F160|F180K|F180L|F180S|730|855|L160|LS740|LS840|LS970|LU6200|MS690|MS695|MS770|MS840|MS870|MS910|P500|P700|P705|VM696|AS680|AS695|AX840|C729|E970|GS505|272|C395|E739BK|E960|L55C|L75C|LS696|LS860|P769BK|P350|P500|P509|P870|UN272|US730|VS840|VS950|LN272|LN510|LS670|LS855|LW690|MN270|MN510|P509|P769|P930|UN200|UN270|UN510|UN610|US670|US740|US760|UX265|UX840|VN271|VN530|VS660|VS700|VS740|VS750|VS910|VS920|VS930|VX9200|VX11000|AX840A|LW770|P506|P925|P999|E612|D955|D802)",Sony:"SonyST|SonyLT|SonyEricsson|SonyEricssonLT15iv|LT18i|E10i|LT28h|LT26w|SonyEricssonMT27i|C5303|C6902|C6903|C6906|C6943|D2533",Asus:"Asus.*Galaxy|PadFone.*Mobile",Micromax:"Micromax.*\\b(A210|A92|A88|A72|A111|A110Q|A115|A116|A110|A90S|A26|A51|A35|A54|A25|A27|A89|A68|A65|A57|A90)\\b",Palm:"PalmSource|Palm",Vertu:"Vertu|Vertu.*Ltd|Vertu.*Ascent|Vertu.*Ayxta|Vertu.*Constellation(F|Quest)?|Vertu.*Monika|Vertu.*Signature",Pantech:"PANTECH|IM-A850S|IM-A840S|IM-A830L|IM-A830K|IM-A830S|IM-A820L|IM-A810K|IM-A810S|IM-A800S|IM-T100K|IM-A725L|IM-A780L|IM-A775C|IM-A770K|IM-A760S|IM-A750K|IM-A740S|IM-A730S|IM-A720L|IM-A710K|IM-A690L|IM-A690S|IM-A650S|IM-A630K|IM-A600S|VEGA PTL21|PT003|P8010|ADR910L|P6030|P6020|P9070|P4100|P9060|P5000|CDM8992|TXT8045|ADR8995|IS11PT|P2030|P6010|P8000|PT002|IS06|CDM8999|P9050|PT001|TXT8040|P2020|P9020|P2000|P7040|P7000|C790",Fly:"IQ230|IQ444|IQ450|IQ440|IQ442|IQ441|IQ245|IQ256|IQ236|IQ255|IQ235|IQ245|IQ275|IQ240|IQ285|IQ280|IQ270|IQ260|IQ250",iMobile:"i-mobile (IQ|i-STYLE|idea|ZAA|Hitz)",SimValley:"\\b(SP-80|XT-930|SX-340|XT-930|SX-310|SP-360|SP60|SPT-800|SP-120|SPT-800|SP-140|SPX-5|SPX-8|SP-100|SPX-8|SPX-12)\\b",Wolfgang:"AT-B24D|AT-AS50HD|AT-AS40W|AT-AS55HD|AT-AS45q2|AT-B26D|AT-AS50Q",Alcatel:"Alcatel",Nintendo:"Nintendo 3DS",Amoi:"Amoi",INQ:"INQ",GenericPhone:"Tapatalk|PDA;|SAGEM|\\bmmp\\b|pocket|\\bpsp\\b|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|\\bwap\\b|nokia|Series40|Series60|S60|SonyEricsson|N900|MAUI.*WAP.*Browser"},tablets:{iPad:"iPad|iPad.*Mobile",NexusTablet:"Android.*Nexus[\\s]+(7|9|10)|^.*Android.*Nexus(?:(?!Mobile).)*$",SamsungTablet:"SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|GT-P1000|GT-P1003|GT-P1010|GT-P3105|GT-P6210|GT-P6800|GT-P6810|GT-P7100|GT-P7300|GT-P7310|GT-P7500|GT-P7510|SCH-I800|SCH-I815|SCH-I905|SGH-I957|SGH-I987|SGH-T849|SGH-T859|SGH-T869|SPH-P100|GT-P3100|GT-P3108|GT-P3110|GT-P5100|GT-P5110|GT-P6200|GT-P7320|GT-P7511|GT-N8000|GT-P8510|SGH-I497|SPH-P500|SGH-T779|SCH-I705|SCH-I915|GT-N8013|GT-P3113|GT-P5113|GT-P8110|GT-N8010|GT-N8005|GT-N8020|GT-P1013|GT-P6201|GT-P7501|GT-N5100|GT-N5105|GT-N5110|SHV-E140K|SHV-E140L|SHV-E140S|SHV-E150S|SHV-E230K|SHV-E230L|SHV-E230S|SHW-M180K|SHW-M180L|SHW-M180S|SHW-M180W|SHW-M300W|SHW-M305W|SHW-M380K|SHW-M380S|SHW-M380W|SHW-M430W|SHW-M480K|SHW-M480S|SHW-M480W|SHW-M485W|SHW-M486W|SHW-M500W|GT-I9228|SCH-P739|SCH-I925|GT-I9200|GT-I9205|GT-P5200|GT-P5210|GT-P5210X|SM-T311|SM-T310|SM-T310X|SM-T210|SM-T210R|SM-T211|SM-P600|SM-P601|SM-P605|SM-P900|SM-P901|SM-T217|SM-T217A|SM-T217S|SM-P6000|SM-T3100|SGH-I467|XE500|SM-T110|GT-P5220|GT-I9200X|GT-N5110X|GT-N5120|SM-P905|SM-T111|SM-T2105|SM-T315|SM-T320|SM-T320X|SM-T321|SM-T520|SM-T525|SM-T530NU|SM-T230NU|SM-T330NU|SM-T900|XE500T1C|SM-P605V|SM-P905V|SM-P600X|SM-P900X|SM-T210X|SM-T230|SM-T230X|SM-T325|GT-P7503|SM-T531|SM-T330|SM-T530|SM-T705C|SM-T535|SM-T331|SM-T800|SM-T700|SM-T537|SM-T807|SM-P907A|SM-T337A|SM-T707A|SM-T807A|SM-T237P|SM-T807P|SM-P607T|SM-T217T|SM-T337T",Kindle:"Kindle|Silk.*Accelerated|Android.*\\b(KFOT|KFTT|KFJWI|KFJWA|KFOTE|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|WFJWAE|KFSAWA|KFSAWI|KFASWI)\\b",SurfaceTablet:"Windows NT [0-9.]+; ARM;.*(Tablet|ARMBJS)",HPTablet:"HP Slate (7|8|10)|HP ElitePad 900|hp-tablet|EliteBook.*Touch|HP 8|Slate 21|HP SlateBook 10",AsusTablet:"^.*PadFone((?!Mobile).)*$|Transformer|TF101|TF101G|TF300T|TF300TG|TF300TL|TF700T|TF700KL|TF701T|TF810C|ME171|ME301T|ME302C|ME371MG|ME370T|ME372MG|ME172V|ME173X|ME400C|Slider SL101|\\bK00F\\b|\\bK00C\\b|\\bK00E\\b|\\bK00L\\b|TX201LA|ME176C|ME102A|\\bM80TA\\b|ME372CL|ME560CG|ME372CG",BlackBerryTablet:"PlayBook|RIM Tablet",HTCtablet:"HTC_Flyer_P512|HTC Flyer|HTC Jetstream|HTC-P715a|HTC EVO View 4G|PG41200|PG09410",MotorolaTablet:"xoom|sholest|MZ615|MZ605|MZ505|MZ601|MZ602|MZ603|MZ604|MZ606|MZ607|MZ608|MZ609|MZ615|MZ616|MZ617",NookTablet:"Android.*Nook|NookColor|nook browser|BNRV200|BNRV200A|BNTV250|BNTV250A|BNTV400|BNTV600|LogicPD Zoom2",AcerTablet:"Android.*; \\b(A100|A101|A110|A200|A210|A211|A500|A501|A510|A511|A700|A701|W500|W500P|W501|W501P|W510|W511|W700|G100|G100W|B1-A71|B1-710|B1-711|A1-810|A1-811|A1-830)\\b|W3-810|\\bA3-A10\\b",ToshibaTablet:"Android.*(AT100|AT105|AT200|AT205|AT270|AT275|AT300|AT305|AT1S5|AT500|AT570|AT700|AT830)|TOSHIBA.*FOLIO",LGTablet:"\\bL-06C|LG-V909|LG-V900|LG-V700|LG-V510|LG-V500|LG-V410|LG-V400|LG-VK810\\b",FujitsuTablet:"Android.*\\b(F-01D|F-02F|F-05E|F-10D|M532|Q572)\\b",PrestigioTablet:"PMP3170B|PMP3270B|PMP3470B|PMP7170B|PMP3370B|PMP3570C|PMP5870C|PMP3670B|PMP5570C|PMP5770D|PMP3970B|PMP3870C|PMP5580C|PMP5880D|PMP5780D|PMP5588C|PMP7280C|PMP7280C3G|PMP7280|PMP7880D|PMP5597D|PMP5597|PMP7100D|PER3464|PER3274|PER3574|PER3884|PER5274|PER5474|PMP5097CPRO|PMP5097|PMP7380D|PMP5297C|PMP5297C_QUAD",LenovoTablet:"Idea(Tab|Pad)( A1|A10| K1|)|ThinkPad([ ]+)?Tablet|Lenovo.*(S2109|S2110|S5000|S6000|K3011|A3000|A3500|A1000|A2107|A2109|A1107|A5500|A7600|B6000|B8000|B8080)(-|)(FL|F|HV|H|)",DellTablet:"Venue 11|Venue 8|Venue 7|Dell Streak 10|Dell Streak 7",YarvikTablet:"Android.*\\b(TAB210|TAB211|TAB224|TAB250|TAB260|TAB264|TAB310|TAB360|TAB364|TAB410|TAB411|TAB420|TAB424|TAB450|TAB460|TAB461|TAB464|TAB465|TAB467|TAB468|TAB07-100|TAB07-101|TAB07-150|TAB07-151|TAB07-152|TAB07-200|TAB07-201-3G|TAB07-210|TAB07-211|TAB07-212|TAB07-214|TAB07-220|TAB07-400|TAB07-485|TAB08-150|TAB08-200|TAB08-201-3G|TAB08-201-30|TAB09-100|TAB09-211|TAB09-410|TAB10-150|TAB10-201|TAB10-211|TAB10-400|TAB10-410|TAB13-201|TAB274EUK|TAB275EUK|TAB374EUK|TAB462EUK|TAB474EUK|TAB9-200)\\b",MedionTablet:"Android.*\\bOYO\\b|LIFE.*(P9212|P9514|P9516|S9512)|LIFETAB",ArnovaTablet:"AN10G2|AN7bG3|AN7fG3|AN8G3|AN8cG3|AN7G3|AN9G3|AN7dG3|AN7dG3ST|AN7dG3ChildPad|AN10bG3|AN10bG3DT|AN9G2",IntensoTablet:"INM8002KP|INM1010FP|INM805ND|Intenso Tab|TAB1004",IRUTablet:"M702pro",MegafonTablet:"MegaFon V9|\\bZTE V9\\b|Android.*\\bMT7A\\b",EbodaTablet:"E-Boda (Supreme|Impresspeed|Izzycomm|Essential)",AllViewTablet:"Allview.*(Viva|Alldro|City|Speed|All TV|Frenzy|Quasar|Shine|TX1|AX1|AX2)",ArchosTablet:"\\b(101G9|80G9|A101IT)\\b|Qilive 97R|Archos5|\\bARCHOS (70|79|80|90|97|101|FAMILYPAD|)(b|)(G10| Cobalt| TITANIUM(HD|)| Xenon| Neon|XSK| 2| XS 2| PLATINUM| CARBON|GAMEPAD)\\b",AinolTablet:"NOVO7|NOVO8|NOVO10|Novo7Aurora|Novo7Basic|NOVO7PALADIN|novo9-Spark",SonyTablet:"Sony.*Tablet|Xperia Tablet|Sony Tablet S|SO-03E|SGPT12|SGPT13|SGPT114|SGPT121|SGPT122|SGPT123|SGPT111|SGPT112|SGPT113|SGPT131|SGPT132|SGPT133|SGPT211|SGPT212|SGPT213|SGP311|SGP312|SGP321|EBRD1101|EBRD1102|EBRD1201|SGP351|SGP341|SGP511|SGP512|SGP521|SGP541|SGP551",PhilipsTablet:"\\b(PI2010|PI3000|PI3100|PI3105|PI3110|PI3205|PI3210|PI3900|PI4010|PI7000|PI7100)\\b",CubeTablet:"Android.*(K8GT|U9GT|U10GT|U16GT|U17GT|U18GT|U19GT|U20GT|U23GT|U30GT)|CUBE U8GT",CobyTablet:"MID1042|MID1045|MID1125|MID1126|MID7012|MID7014|MID7015|MID7034|MID7035|MID7036|MID7042|MID7048|MID7127|MID8042|MID8048|MID8127|MID9042|MID9740|MID9742|MID7022|MID7010",MIDTablet:"M9701|M9000|M9100|M806|M1052|M806|T703|MID701|MID713|MID710|MID727|MID760|MID830|MID728|MID933|MID125|MID810|MID732|MID120|MID930|MID800|MID731|MID900|MID100|MID820|MID735|MID980|MID130|MID833|MID737|MID960|MID135|MID860|MID736|MID140|MID930|MID835|MID733",MSITablet:"MSI \\b(Primo 73K|Primo 73L|Primo 81L|Primo 77|Primo 93|Primo 75|Primo 76|Primo 73|Primo 81|Primo 91|Primo 90|Enjoy 71|Enjoy 7|Enjoy 10)\\b",SMiTTablet:"Android.*(\\bMID\\b|MID-560|MTV-T1200|MTV-PND531|MTV-P1101|MTV-PND530)",RockChipTablet:"Android.*(RK2818|RK2808A|RK2918|RK3066)|RK2738|RK2808A",FlyTablet:"IQ310|Fly Vision",bqTablet:"bq.*(Elcano|Curie|Edison|Maxwell|Kepler|Pascal|Tesla|Hypatia|Platon|Newton|Livingstone|Cervantes|Avant)|Maxwell.*Lite|Maxwell.*Plus",HuaweiTablet:"MediaPad|MediaPad 7 Youth|IDEOS S7|S7-201c|S7-202u|S7-101|S7-103|S7-104|S7-105|S7-106|S7-201|S7-Slim",NecTablet:"\\bN-06D|\\bN-08D",PantechTablet:"Pantech.*P4100",BronchoTablet:"Broncho.*(N701|N708|N802|a710)",VersusTablet:"TOUCHPAD.*[78910]|\\bTOUCHTAB\\b",ZyncTablet:"z1000|Z99 2G|z99|z930|z999|z990|z909|Z919|z900",PositivoTablet:"TB07STA|TB10STA|TB07FTA|TB10FTA",NabiTablet:"Android.*\\bNabi",KoboTablet:"Kobo Touch|\\bK080\\b|\\bVox\\b Build|\\bArc\\b Build",DanewTablet:"DSlide.*\\b(700|701R|702|703R|704|802|970|971|972|973|974|1010|1012)\\b",TexetTablet:"NaviPad|TB-772A|TM-7045|TM-7055|TM-9750|TM-7016|TM-7024|TM-7026|TM-7041|TM-7043|TM-7047|TM-8041|TM-9741|TM-9747|TM-9748|TM-9751|TM-7022|TM-7021|TM-7020|TM-7011|TM-7010|TM-7023|TM-7025|TM-7037W|TM-7038W|TM-7027W|TM-9720|TM-9725|TM-9737W|TM-1020|TM-9738W|TM-9740|TM-9743W|TB-807A|TB-771A|TB-727A|TB-725A|TB-719A|TB-823A|TB-805A|TB-723A|TB-715A|TB-707A|TB-705A|TB-709A|TB-711A|TB-890HD|TB-880HD|TB-790HD|TB-780HD|TB-770HD|TB-721HD|TB-710HD|TB-434HD|TB-860HD|TB-840HD|TB-760HD|TB-750HD|TB-740HD|TB-730HD|TB-722HD|TB-720HD|TB-700HD|TB-500HD|TB-470HD|TB-431HD|TB-430HD|TB-506|TB-504|TB-446|TB-436|TB-416|TB-146SE|TB-126SE",PlaystationTablet:"Playstation.*(Portable|Vita)",TrekstorTablet:"ST10416-1|VT10416-1|ST70408-1|ST702xx-1|ST702xx-2|ST80208|ST97216|ST70104-2|VT10416-2|ST10216-2A|SurfTab",PyleAudioTablet:"\\b(PTBL10CEU|PTBL10C|PTBL72BC|PTBL72BCEU|PTBL7CEU|PTBL7C|PTBL92BC|PTBL92BCEU|PTBL9CEU|PTBL9CUK|PTBL9C)\\b",AdvanTablet:"Android.* \\b(E3A|T3X|T5C|T5B|T3E|T3C|T3B|T1J|T1F|T2A|T1H|T1i|E1C|T1-E|T5-A|T4|E1-B|T2Ci|T1-B|T1-D|O1-A|E1-A|T1-A|T3A|T4i)\\b ",DanyTechTablet:"Genius Tab G3|Genius Tab S2|Genius Tab Q3|Genius Tab G4|Genius Tab Q4|Genius Tab G-II|Genius TAB GII|Genius TAB GIII|Genius Tab S1",GalapadTablet:"Android.*\\bG1\\b",MicromaxTablet:"Funbook|Micromax.*\\b(P250|P560|P360|P362|P600|P300|P350|P500|P275)\\b",KarbonnTablet:"Android.*\\b(A39|A37|A34|ST8|ST10|ST7|Smart Tab3|Smart Tab2)\\b",AllFineTablet:"Fine7 Genius|Fine7 Shine|Fine7 Air|Fine8 Style|Fine9 More|Fine10 Joy|Fine11 Wide",PROSCANTablet:"\\b(PEM63|PLT1023G|PLT1041|PLT1044|PLT1044G|PLT1091|PLT4311|PLT4311PL|PLT4315|PLT7030|PLT7033|PLT7033D|PLT7035|PLT7035D|PLT7044K|PLT7045K|PLT7045KB|PLT7071KG|PLT7072|PLT7223G|PLT7225G|PLT7777G|PLT7810K|PLT7849G|PLT7851G|PLT7852G|PLT8015|PLT8031|PLT8034|PLT8036|PLT8080K|PLT8082|PLT8088|PLT8223G|PLT8234G|PLT8235G|PLT8816K|PLT9011|PLT9045K|PLT9233G|PLT9735|PLT9760G|PLT9770G)\\b",YONESTablet:"BQ1078|BC1003|BC1077|RK9702|BC9730|BC9001|IT9001|BC7008|BC7010|BC708|BC728|BC7012|BC7030|BC7027|BC7026",ChangJiaTablet:"TPC7102|TPC7103|TPC7105|TPC7106|TPC7107|TPC7201|TPC7203|TPC7205|TPC7210|TPC7708|TPC7709|TPC7712|TPC7110|TPC8101|TPC8103|TPC8105|TPC8106|TPC8203|TPC8205|TPC8503|TPC9106|TPC9701|TPC97101|TPC97103|TPC97105|TPC97106|TPC97111|TPC97113|TPC97203|TPC97603|TPC97809|TPC97205|TPC10101|TPC10103|TPC10106|TPC10111|TPC10203|TPC10205|TPC10503",GUTablet:"TX-A1301|TX-M9002|Q702|kf026",PointOfViewTablet:"TAB-P506|TAB-navi-7-3G-M|TAB-P517|TAB-P-527|TAB-P701|TAB-P703|TAB-P721|TAB-P731N|TAB-P741|TAB-P825|TAB-P905|TAB-P925|TAB-PR945|TAB-PL1015|TAB-P1025|TAB-PI1045|TAB-P1325|TAB-PROTAB[0-9]+|TAB-PROTAB25|TAB-PROTAB26|TAB-PROTAB27|TAB-PROTAB26XL|TAB-PROTAB2-IPS9|TAB-PROTAB30-IPS9|TAB-PROTAB25XXL|TAB-PROTAB26-IPS10|TAB-PROTAB30-IPS10",OvermaxTablet:"OV-(SteelCore|NewBase|Basecore|Baseone|Exellen|Quattor|EduTab|Solution|ACTION|BasicTab|TeddyTab|MagicTab|Stream|TB-08|TB-09)",HCLTablet:"HCL.*Tablet|Connect-3G-2.0|Connect-2G-2.0|ME Tablet U1|ME Tablet U2|ME Tablet G1|ME Tablet X1|ME Tablet Y2|ME Tablet Sync",DPSTablet:"DPS Dream 9|DPS Dual 7",VistureTablet:"V97 HD|i75 3G|Visture V4( HD)?|Visture V5( HD)?|Visture V10",CrestaTablet:"CTP(-)?810|CTP(-)?818|CTP(-)?828|CTP(-)?838|CTP(-)?888|CTP(-)?978|CTP(-)?980|CTP(-)?987|CTP(-)?988|CTP(-)?989",MediatekTablet:"\\bMT8125|MT8389|MT8135|MT8377\\b",ConcordeTablet:"Concorde([ ]+)?Tab|ConCorde ReadMan",GoCleverTablet:"GOCLEVER TAB|A7GOCLEVER|M1042|M7841|M742|R1042BK|R1041|TAB A975|TAB A7842|TAB A741|TAB A741L|TAB M723G|TAB M721|TAB A1021|TAB I921|TAB R721|TAB I720|TAB T76|TAB R70|TAB R76.2|TAB R106|TAB R83.2|TAB M813G|TAB I721|GCTA722|TAB I70|TAB I71|TAB S73|TAB R73|TAB R74|TAB R93|TAB R75|TAB R76.1|TAB A73|TAB A93|TAB A93.2|TAB T72|TAB R83|TAB R974|TAB R973|TAB A101|TAB A103|TAB A104|TAB A104.2|R105BK|M713G|A972BK|TAB A971|TAB R974.2|TAB R104|TAB R83.3|TAB A1042",ModecomTablet:"FreeTAB 9000|FreeTAB 7.4|FreeTAB 7004|FreeTAB 7800|FreeTAB 2096|FreeTAB 7.5|FreeTAB 1014|FreeTAB 1001 |FreeTAB 8001|FreeTAB 9706|FreeTAB 9702|FreeTAB 7003|FreeTAB 7002|FreeTAB 1002|FreeTAB 7801|FreeTAB 1331|FreeTAB 1004|FreeTAB 8002|FreeTAB 8014|FreeTAB 9704|FreeTAB 1003",VoninoTablet:"\\b(Argus[ _]?S|Diamond[ _]?79HD|Emerald[ _]?78E|Luna[ _]?70C|Onyx[ _]?S|Onyx[ _]?Z|Orin[ _]?HD|Orin[ _]?S|Otis[ _]?S|SpeedStar[ _]?S|Magnet[ _]?M9|Primus[ _]?94[ _]?3G|Primus[ _]?94HD|Primus[ _]?QS|Android.*\\bQ8\\b|Sirius[ _]?EVO[ _]?QS|Sirius[ _]?QS|Spirit[ _]?S)\\b",ECSTablet:"V07OT2|TM105A|S10OT1|TR10CS1",StorexTablet:"eZee[_']?(Tab|Go)[0-9]+|TabLC7|Looney Tunes Tab",VodafoneTablet:"SmartTab([ ]+)?[0-9]+|SmartTabII10|SmartTabII7",EssentielBTablet:"Smart[ ']?TAB[ ]+?[0-9]+|Family[ ']?TAB2",RossMoorTablet:"RM-790|RM-997|RMD-878G|RMD-974R|RMT-705A|RMT-701|RME-601|RMT-501|RMT-711",iMobileTablet:"i-mobile i-note",TolinoTablet:"tolino tab [0-9.]+|tolino shine",AudioSonicTablet:"\\bC-22Q|T7-QC|T-17B|T-17P\\b",AMPETablet:"Android.* A78 ",SkkTablet:"Android.* (SKYPAD|PHOENIX|CYCLOPS)",TecnoTablet:"TECNO P9",JXDTablet:"Android.*\\b(F3000|A3300|JXD5000|JXD3000|JXD2000|JXD300B|JXD300|S5800|S7800|S602b|S5110b|S7300|S5300|S602|S603|S5100|S5110|S601|S7100a|P3000F|P3000s|P101|P200s|P1000m|P200m|P9100|P1000s|S6600b|S908|P1000|P300|S18|S6600|S9100)\\b",iJoyTablet:"Tablet (Spirit 7|Essentia|Galatea|Fusion|Onix 7|Landa|Titan|Scooby|Deox|Stella|Themis|Argon|Unique 7|Sygnus|Hexen|Finity 7|Cream|Cream X2|Jade|Neon 7|Neron 7|Kandy|Scape|Saphyr 7|Rebel|Biox|Rebel|Rebel 8GB|Myst|Draco 7|Myst|Tab7-004|Myst|Tadeo Jones|Tablet Boing|Arrow|Draco Dual Cam|Aurix|Mint|Amity|Revolution|Finity 9|Neon 9|T9w|Amity 4GB Dual Cam|Stone 4GB|Stone 8GB|Andromeda|Silken|X2|Andromeda II|Halley|Flame|Saphyr 9,7|Touch 8|Planet|Triton|Unique 10|Hexen 10|Memphis 4GB|Memphis 8GB|Onix 10)",FX2Tablet:"FX2 PAD7|FX2 PAD10",XoroTablet:"KidsPAD 701|PAD[ ]?712|PAD[ ]?714|PAD[ ]?716|PAD[ ]?717|PAD[ ]?718|PAD[ ]?720|PAD[ ]?721|PAD[ ]?722|PAD[ ]?790|PAD[ ]?792|PAD[ ]?900|PAD[ ]?9715D|PAD[ ]?9716DR|PAD[ ]?9718DR|PAD[ ]?9719QR|PAD[ ]?9720QR|TelePAD1030|Telepad1032|TelePAD730|TelePAD731|TelePAD732|TelePAD735Q|TelePAD830|TelePAD9730|TelePAD795|MegaPAD 1331|MegaPAD 1851|MegaPAD 2151",ViewsonicTablet:"ViewPad 10pi|ViewPad 10e|ViewPad 10s|ViewPad E72|ViewPad7|ViewPad E100|ViewPad 7e|ViewSonic VB733|VB100a",OdysTablet:"LOOX|XENO10|ODYS[ -](Space|EVO|Xpress|NOON)|\\bXELIO\\b|Xelio10Pro|XELIO7PHONETAB|XELIO10EXTREME|XELIOPT2|NEO_QUAD10",CaptivaTablet:"CAPTIVA PAD",IconbitTablet:"NetTAB|NT-3702|NT-3702S|NT-3702S|NT-3603P|NT-3603P|NT-0704S|NT-0704S|NT-3805C|NT-3805C|NT-0806C|NT-0806C|NT-0909T|NT-0909T|NT-0907S|NT-0907S|NT-0902S|NT-0902S",TeclastTablet:"T98 4G|\\bP80\\b|\\bX90HD\\b|X98 Air|X98 Air 3G|\\bX89\\b|P80 3G|\\bX80h\\b|P98 Air|\\bX89HD\\b|P98 3G|\\bP90HD\\b|P89 3G|X98 3G|\\bP70h\\b|P79HD 3G|G18d 3G|\\bP79HD\\b|\\bP89s\\b|\\bA88\\b|\\bP10HD\\b|\\bP19HD\\b|G18 3G|\\bP78HD\\b|\\bA78\\b|\\bP75\\b|G17s 3G|G17h 3G|\\bP85t\\b|\\bP90\\b|\\bP11\\b|\\bP98t\\b|\\bP98HD\\b|\\bG18d\\b|\\bP85s\\b|\\bP11HD\\b|\\bP88s\\b|\\bA80HD\\b|\\bA80se\\b|\\bA10h\\b|\\bP89\\b|\\bP78s\\b|\\bG18\\b|\\bP85\\b|\\bA70h\\b|\\bA70\\b|\\bG17\\b|\\bP18\\b|\\bA80s\\b|\\bA11s\\b|\\bP88HD\\b|\\bA80h\\b|\\bP76s\\b|\\bP76h\\b|\\bP98\\b|\\bA10HD\\b|\\bP78\\b|\\bP88\\b|\\bA11\\b|\\bA10t\\b|\\bP76a\\b|\\bP76t\\b|\\bP76e\\b|\\bP85HD\\b|\\bP85a\\b|\\bP86\\b|\\bP75HD\\b|\\bP76v\\b|\\bA12\\b|\\bP75a\\b|\\bA15\\b|\\bP76Ti\\b|\\bP81HD\\b|\\bA10\\b|\\bT760VE\\b|\\bT720HD\\b|\\bP76\\b|\\bP73\\b|\\bP71\\b|\\bP72\\b|\\bT720SE\\b|\\bC520Ti\\b|\\bT760\\b|\\bT720VE\\b|T720-3GE|T720-WiFi",JaytechTablet:"TPC-PA762",BlaupunktTablet:"Endeavour 800NG|Endeavour 1010",DigmaTablet:"\\b(iDx10|iDx9|iDx8|iDx7|iDxD7|iDxD8|iDsQ8|iDsQ7|iDsQ8|iDsD10|iDnD7|3TS804H|iDsQ11|iDj7|iDs10)\\b",EvolioTablet:"ARIA_Mini_wifi|Aria[ _]Mini|Evolio X10|Evolio X7|Evolio X8|\\bEvotab\\b|\\bNeura\\b",LavaTablet:"QPAD E704|\\bIvoryS\\b|E-TAB IVORY",CelkonTablet:"CT695|CT888|CT[\\s]?910|CT7 Tab|CT9 Tab|CT3 Tab|CT2 Tab|CT1 Tab|C820|C720|\\bCT-1\\b",MiTablet:"\\bMI PAD\\b|\\bHM NOTE 1W\\b",NibiruTablet:"Nibiru M1|Nibiru Jupiter One",NexoTablet:"NEXO NOVA|NEXO 10|NEXO AVIO|NEXO FREE|NEXO GO|NEXO EVO|NEXO 3G|NEXO SMART|NEXO KIDDO|NEXO MOBI",UbislateTablet:"UbiSlate[\\s]?7C",PocketBookTablet:"Pocketbook",Hudl:"Hudl HT7S3",TelstraTablet:"T-Hub2",GenericTablet:"Android.*\\b97D\\b|Tablet(?!.*PC)|BNTV250A|MID-WCDMA|LogicPD Zoom2|\\bA7EB\\b|CatNova8|A1_07|CT704|CT1002|\\bM721\\b|rk30sdk|\\bEVOTAB\\b|M758A|ET904|ALUMIUM10|Smartfren Tab|Endeavour 1010|Tablet-PC-4|Tagi Tab|\\bM6pro\\b|CT1020W|arc 10HD|\\bJolla\\b"},oss:{AndroidOS:"Android",BlackBerryOS:"blackberry|\\bBB10\\b|rim tablet os",PalmOS:"PalmOS|avantgo|blazer|elaine|hiptop|palm|plucker|xiino",SymbianOS:"Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\\bS60\\b",WindowsMobileOS:"Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;",WindowsPhoneOS:"Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7|Windows NT 6.[23]; ARM;",iOS:"\\biPhone.*Mobile|\\biPod|\\biPad",MeeGoOS:"MeeGo",MaemoOS:"Maemo",JavaOS:"J2ME/|\\bMIDP\\b|\\bCLDC\\b",webOS:"webOS|hpwOS",badaOS:"\\bBada\\b",BREWOS:"BREW"},uas:{Chrome:"\\bCrMo\\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?",Dolfin:"\\bDolfin\\b",Opera:"Opera.*Mini|Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+|Coast/[0-9.]+",Skyfire:"Skyfire",IE:"IEMobile|MSIEMobile",Firefox:"fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile",Bolt:"bolt",TeaShark:"teashark",Blazer:"Blazer",Safari:"Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari",Tizen:"Tizen",UCBrowser:"UC.*Browser|UCWEB",baiduboxapp:"baiduboxapp",baidubrowser:"baidubrowser",DiigoBrowser:"DiigoBrowser",Puffin:"Puffin",Mercury:"\\bMercury\\b",ObigoBrowser:"Obigo",NetFront:"NF-Browser",GenericBrowser:"NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|MicroMessenger"},props:{Mobile:"Mobile/[VER]",Build:"Build/[VER]",Version:"Version/[VER]",VendorID:"VendorID/[VER]",iPad:"iPad.*CPU[a-z ]+[VER]",iPhone:"iPhone.*CPU[a-z ]+[VER]",iPod:"iPod.*CPU[a-z ]+[VER]",Kindle:"Kindle/[VER]",Chrome:["Chrome/[VER]","CriOS/[VER]","CrMo/[VER]"],Coast:["Coast/[VER]"],Dolfin:"Dolfin/[VER]",Firefox:"Firefox/[VER]",Fennec:"Fennec/[VER]",IE:["IEMobile/[VER];","IEMobile [VER]","MSIE [VER];"],NetFront:"NetFront/[VER]",NokiaBrowser:"NokiaBrowser/[VER]",Opera:[" OPR/[VER]","Opera Mini/[VER]","Version/[VER]"],"Opera Mini":"Opera Mini/[VER]","Opera Mobi":"Version/[VER]","UC Browser":"UC Browser[VER]",MQQBrowser:"MQQBrowser/[VER]",MicroMessenger:"MicroMessenger/[VER]",baiduboxapp:"baiduboxapp/[VER]",baidubrowser:"baidubrowser/[VER]",Iron:"Iron/[VER]",Safari:["Version/[VER]","Safari/[VER]"],Skyfire:"Skyfire/[VER]",Tizen:"Tizen/[VER]",Webkit:"webkit[ /][VER]",Gecko:"Gecko/[VER]",Trident:"Trident/[VER]",Presto:"Presto/[VER]",iOS:" \\bOS\\b [VER] ",Android:"Android [VER]",BlackBerry:["BlackBerry[\\w]+/[VER]","BlackBerry.*Version/[VER]","Version/[VER]"],BREW:"BREW [VER]",Java:"Java/[VER]","Windows Phone OS":["Windows Phone OS [VER]","Windows Phone [VER]"],"Windows Phone":"Windows Phone [VER]","Windows CE":"Windows CE/[VER]","Windows NT":"Windows NT [VER]",Symbian:["SymbianOS/[VER]","Symbian/[VER]"],webOS:["webOS/[VER]","hpwOS/[VER];"]},utils:{DesktopMode:"WPDesktop",TV:"SonyDTV|HbbTV",WebKit:"(webkit)[ /]([\\w.]+)",Bot:"Googlebot|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit",MobileBot:"Googlebot-Mobile|YahooSeeker/M1A1-R2D2",Console:"\\b(Nintendo|Nintendo WiiU|Nintendo 3DS|PLAYSTATION|Xbox)\\b",Watch:"SM-V700"}},n={fullPattern:/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i,shortPattern:/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i},o=Object.prototype.hasOwnProperty,p="UnknownPhone",q="UnknownTablet",r="UnknownMobile";return l="isArray"in Array?Array.isArray:function(a){return"[object Array]"===Object.prototype.toString.call(a)},function(){var b,c,d,e,f,g;for(b in m.props)if(o.call(m.props,b)){for(c=m.props[b],l(c)||(c=[c]),f=c.length,e=0;f>e;++e)d=c[e],g=d.indexOf("[VER]"),g>=0&&(d=d.substring(0,g)+"([\\w._\\+]+)"+d.substring(g+5)),c[e]=new RegExp(d,"i");m.props[b]=c}a(m.oss),a(m.phones),a(m.tablets),a(m.uas),a(m.utils),m.oss0={WindowsPhoneOS:m.oss.WindowsPhoneOS,WindowsMobileOS:m.oss.WindowsMobileOS}}(),k.prototype={constructor:k,mobile:function(){return i(this._cache,this.ua,this.maxPhoneWidth),this._cache.mobile},phone:function(){return i(this._cache,this.ua,this.maxPhoneWidth),this._cache.phone},tablet:function(){return i(this._cache,this.ua,this.maxPhoneWidth),this._cache.tablet
},userAgent:function(){return this._cache.userAgent===b&&(this._cache.userAgent=c(m.uas,this.ua)),this._cache.userAgent},os:function(){return this._cache.os===b&&(this._cache.os=c(m.oss0,this.ua)||c(m.oss,this.ua)),this._cache.os},version:function(a){return e(a,this.ua)},versionStr:function(a){return d(a,this.ua)},is:function(a){return g(a,this.userAgent())||g(a,this.os())||g(a,this.phone())||g(a,this.tablet())||g(a,c(m.utils,this.ua))},match:function(a){return a instanceof RegExp||(a=new RegExp(a,"i")),a.test(this.ua)},isPhoneSized:function(a){return k.isPhoneSized(a||this.maxPhoneWidth)},mobileGrade:function(){return this._cache.grade===b&&(this._cache.grade=j(this)),this._cache.grade}},k.isPhoneSized="undefined"!=typeof window&&window.screen&&window.screen.width?function(a){if(0>a)return b;var c=window.screen.width,d=window.devicePixelRatio||1,e=c/d;return a>=e}:function(){},k})}(function(){if("function"==typeof define&&define.amd)return define;if("undefined"!=typeof module&&module.exports)return function(a){module.exports=a()};if("undefined"!=typeof window)return function(a){window.MobileDetect=a()};throw new Error("unknown environment")}());

var md = new MobileDetect(window.navigator.userAgent),
	keys = ['iPad', 'NexusTablet', 'SamsungTablet', 'Kindle', 'SurfaceTablet', 'HPTablet', 'AsusTablet', 'BlackBerryTablet', 'HTCtablet', 'MotorolaTablet', 'NookTablet', 'AcerTablet', 'ToshibaTablet', 'LGTablet', 'FujitsuTablet', 'PrestigioTablet', 'LenovoTablet', 'YarvikTablet', 'MedionTablet', 'ArnovaTablet', 'IntensoTablet', 'IRUTablet', 'MegafonTablet', 'EbodaTablet', 'AllViewTablet', 'ArchosTablet', 'AinolTablet', 'SonyTablet', 'CubeTablet', 'CobyTablet', 'MIDTablet', 'SMiTTablet', 'RockChipTablet', 'FlyTablet', 'bqTablet', 'HuaweiTablet', 'NecTablet', 'PantechTablet', 'BronchoTablet', 'VersusTablet', 'ZyncTablet', 'PositivoTablet', 'NabiTablet', 'KoboTablet', 'DanewTablet', 'TexetTablet', 'PlaystationTablet', 'TrekstorTablet', 'PyleAudioTablet', 'AdvanTablet', 'DanyTechTablet', 'GalapadTablet', 'MicromaxTablet', 'KarbonnTablet', 'AllFineTablet', 'PROSCANTablet', 'YONESTablet', 'ChangJiaTablet', 'GUTablet', 'PointOfViewTablet', 'OvermaxTablet', 'HCLTablet', 'DPSTablet', 'VistureTablet', 'CrestaTablet', 'MediatekTablet', 'ConcordeTablet', 'GoCleverTablet', 'ModecomTablet', 'VoninoTablet', 'ECSTablet', 'StorexTablet', 'VodafoneTablet', 'EssentielBTablet', 'RossMoorTablet', 'iMobileTablet', 'TolinoTablet', 'AudioSonicTablet', 'AMPETablet', 'SkkTablet', 'TecnoTablet', 'JXDTablet', 'iJoyTablet', 'Hudl', 'TelstraTablet', 'GenericTablet', 'iPhone', 'BlackBerry', 'HTC', 'Nexus', 'Dell', 'Motorola', 'Samsung', 'LG', 'Sony', 'Asus', 'Micromax', 'Palm', 'Vertu', 'Pantech', 'Fly', 'iMobile', 'SimValley', 'GenericPhone', 'AndroidOS', 'BlackBerryOS', 'PalmOS', 'SymbianOS', 'WindowsMobileOS', 'WindowsPhoneOS', 'iOS', 'MeeGoOS', 'MaemoOS', 'JavaOS', 'webOS', 'badaOS', 'BREWOS', 'Chrome', 'Dolfin', 'Opera', 'Skyfire', 'IE', 'Firefox', 'Bolt', 'TeaShark', 'Blazer', 'Safari', 'Tizen', 'UCBrowser', 'DiigoBrowser', 'Puffin', 'Mercury', 'GenericBrowser', 'DesktopMode', 'TV', 'WebKit', 'Bot', 'MobileBot', 'Console', 'Watch'],
	versionKeys = ['Mobile', 'Build', 'Version', 'VendorID', 'iPad', 'iPhone', 'iPod', 'Kindle', 'Chrome', 'Coast', 'Dolfin', 'Firefox', 'Fennec', 'IE', 'NetFront', 'NokiaBrowser', 'Opera', 'Opera Mini', 'Opera Mobi', 'UC Browser', 'MQQBrowser', 'MicroMessenger', 'Safari', 'Skyfire', 'Tizen', 'Webkit', 'Gecko', 'Trident', 'Presto', 'iOS', 'Android', 'BlackBerry', 'BREW', 'Java', 'Windows Phone OS', 'Windows Phone', 'Windows CE', 'Windows NT', 'Symbian', 'webOS'];

if( md.tablet() ){
	var mvp=document.getElementById("myViewport");
	if( mvp != undefined ) 
		mvp.setAttribute('content', 'width=device-width, initial-scale=1, maximum-scale=1');
}

/* */
var mobile=function(){return{detect:function(){var uagent=navigator.userAgent.toLowerCase();var list=this.mobiles;var ismobile=false;for(var d=0;d<list.length;d+=1)if(uagent.indexOf(list[d])!=-1)ismobile=true;return ismobile},mobiles:["midp","240x320","blackberry","netfront","nokia","panasonic","portalmmm","sharp","sie-","sonyericsson","symbian","windows ce","benq","mda","mot-","opera mini","philips","pocket pc","sagem","samsung","sda","sgh-","vodafone","xda","palm","iphone","ipod","android","ipad"]}}();
var isMobile = mobile.detect(); 
if( isMobile ) $('html').addClass('mobileVer');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// EASING

jQuery.easing["jswing"]=jQuery.easing["swing"];
jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*(--t*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/
2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,
t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return t==0?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return t==d?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},
easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*0.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*
Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*0.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(0.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-0.5*(a*Math.pow(2,
10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*0.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=1.525)+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+b},easeInBounce:function(x,t,
b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<1/2.75)return c*(7.5625*t*t)+b;else if(t<2/2.75)return c*(7.5625*(t-=1.5/2.75)*t+0.75)+b;else if(t<2.5/2.75)return c*(7.5625*(t-=2.25/2.75)*t+0.9375)+b;else return c*(7.5625*(t-=2.625/2.75)*t+0.984375)+b},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*0.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*0.5+c*0.5+b}});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ISCROLL V.5
(function(g,n,f){function p(a,b,c){this.wrapper="string"==typeof a?n.querySelector(a):a;this.scroller=this.wrapper.children[void 0!=c?c:0];this.scrollerStyle=this.scroller.style;this.options={zoomMin:1,zoomMax:4,startZoom:1,resizeScrollbars:!0,mouseWheelSpeed:20,snapThreshold:.334,startX:0,startY:0,scrollY:!0,directionLockThreshold:5,momentum:!0,bounce:!0,bounceTime:600,bounceEasing:"",preventDefault:!0,preventDefaultException:{tagName:/^(INPUT|TEXTAREA|BUTTON|SELECT)$/},HWCompositing:!0,useTransition:!0,
useTransform:!0};for(var e in b)this.options[e]=b[e];this.translateZ=this.options.HWCompositing&&d.hasPerspective?" translateZ(0)":"";this.options.useTransition=d.hasTransition&&this.options.useTransition;this.options.useTransform=d.hasTransform&&this.options.useTransform;this.options.eventPassthrough=!0===this.options.eventPassthrough?"vertical":this.options.eventPassthrough;this.options.preventDefault=!this.options.eventPassthrough&&this.options.preventDefault;this.options.scrollY="vertical"==this.options.eventPassthrough?
!1:this.options.scrollY;this.options.scrollX="horizontal"==this.options.eventPassthrough?!1:this.options.scrollX;this.options.freeScroll=this.options.freeScroll&&!this.options.eventPassthrough;this.options.directionLockThreshold=this.options.eventPassthrough?0:this.options.directionLockThreshold;this.options.bounceEasing="string"==typeof this.options.bounceEasing?d.ease[this.options.bounceEasing]||d.ease.circular:this.options.bounceEasing;this.options.resizePolling=void 0===this.options.resizePolling?
60:this.options.resizePolling;!0===this.options.tap&&(this.options.tap="tap");"scale"==this.options.shrinkScrollbars&&(this.options.useTransition=!1);this.options.invertWheelDirection=this.options.invertWheelDirection?-1:1;this.directionY=this.directionX=this.y=this.x=0;this._events={};this.scale=f.min(f.max(this.options.startZoom,this.options.zoomMin),this.options.zoomMax);this._init();this.refresh();this.scrollTo(this.options.startX,this.options.startY);this.enable()}function t(a,b,c){var e=n.createElement("div"),
d=n.createElement("div");!0===c&&(e.style.cssText="position:absolute;z-index:9999",d.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px");d.className="iScrollIndicator";"h"==a?(!0===c&&(e.style.cssText+=";height:7px;left:2px;right:2px;bottom:0",d.style.height="100%"),e.className="iScrollHorizontalScrollbar"):(!0===c&&(e.style.cssText+=";width:7px;bottom:2px;top:2px;right:1px",
d.style.width="100%"),e.className="iScrollVerticalScrollbar");e.style.cssText+=";overflow:hidden";b||(e.style.pointerEvents="none");e.appendChild(d);return e}function u(a,b){this.wrapper="string"==typeof b.el?n.querySelector(b.el):b.el;this.wrapperStyle=this.wrapper.style;this.indicator=this.wrapper.children[0];this.indicatorStyle=this.indicator.style;this.scroller=a;this.options={listenX:!0,listenY:!0,interactive:!1,resize:!0,defaultScrollbars:!1,shrink:!1,fade:!1,speedRatioX:0,speedRatioY:0};for(var c in b)this.options[c]=
b[c];this.sizeRatioY=this.sizeRatioX=1;this.maxPosY=this.maxPosX=0;this.options.interactive&&(this.options.disableTouch||(d.addEvent(this.indicator,"touchstart",this),d.addEvent(g,"touchend",this)),this.options.disablePointer||(d.addEvent(this.indicator,d.prefixPointerEvent("pointerdown"),this),d.addEvent(g,d.prefixPointerEvent("pointerup"),this)),this.options.disableMouse||(d.addEvent(this.indicator,"mousedown",this),d.addEvent(g,"mouseup",this)));this.options.fade&&(this.wrapperStyle[d.style.transform]=
this.scroller.translateZ,this.wrapperStyle[d.style.transitionDuration]=d.isBadAndroid?"0.001s":"0ms",this.wrapperStyle.opacity="0")}var v=g.requestAnimationFrame||g.webkitRequestAnimationFrame||g.mozRequestAnimationFrame||g.oRequestAnimationFrame||g.msRequestAnimationFrame||function(a){g.setTimeout(a,1E3/60)},d=function(){function a(a){return!1===e?!1:""===e?a:e+a.charAt(0).toUpperCase()+a.substr(1)}var b={},c=n.createElement("div").style,e=function(){for(var a=["t","webkitT","MozT","msT","OT"],b,
e=0,d=a.length;e<d;e++)if(b=a[e]+"ransform",b in c)return a[e].substr(0,a[e].length-1);return!1}();b.getTime=Date.now||function(){return(new Date).getTime()};b.extend=function(a,b){for(var c in b)a[c]=b[c]};b.addEvent=function(a,b,c,e){a.addEventListener(b,c,!!e)};b.removeEvent=function(a,b,c,e){a.removeEventListener(b,c,!!e)};b.prefixPointerEvent=function(a){return g.MSPointerEvent?"MSPointer"+a.charAt(9).toUpperCase()+a.substr(10):a};b.momentum=function(a,b,c,e,d,k){b=a-b;c=f.abs(b)/c;var g;k=void 0===
k?6E-4:k;g=a+c*c/(2*k)*(0>b?-1:1);k=c/k;g<e?(g=d?e-d/2.5*(c/8):e,b=f.abs(g-a),k=b/c):0<g&&(g=d?d/2.5*(c/8):0,b=f.abs(a)+g,k=b/c);return{destination:f.round(g),duration:k}};var d=a("transform");b.extend(b,{hasTransform:!1!==d,hasPerspective:a("perspective")in c,hasTouch:"ontouchstart"in g,hasPointer:g.PointerEvent||g.MSPointerEvent,hasTransition:a("transition")in c});b.isBadAndroid=/Android /.test(g.navigator.appVersion)&&!/Chrome\/\d/.test(g.navigator.appVersion);b.extend(b.style={},{transform:d,
transitionTimingFunction:a("transitionTimingFunction"),transitionDuration:a("transitionDuration"),transitionDelay:a("transitionDelay"),transformOrigin:a("transformOrigin")});b.hasClass=function(a,b){return(new RegExp("(^|\\s)"+b+"(\\s|$)")).test(a.className)};b.addClass=function(a,c){if(!b.hasClass(a,c)){var e=a.className.split(" ");e.push(c);a.className=e.join(" ")}};b.removeClass=function(a,c){b.hasClass(a,c)&&(a.className=a.className.replace(new RegExp("(^|\\s)"+c+"(\\s|$)","g")," "))};b.offset=
function(a){for(var b=-a.offsetLeft,c=-a.offsetTop;a=a.offsetParent;)b-=a.offsetLeft,c-=a.offsetTop;return{left:b,top:c}};b.preventDefaultException=function(a,b){for(var c in b)if(b[c].test(a[c]))return!0;return!1};b.extend(b.eventType={},{touchstart:1,touchmove:1,touchend:1,mousedown:2,mousemove:2,mouseup:2,pointerdown:3,pointermove:3,pointerup:3,MSPointerDown:3,MSPointerMove:3,MSPointerUp:3});b.extend(b.ease={},{quadratic:{style:"cubic-bezier(0.25, 0.46, 0.45, 0.94)",fn:function(a){return a*(2-
a)}},circular:{style:"cubic-bezier(0.1, 0.57, 0.1, 1)",fn:function(a){return f.sqrt(1- --a*a)}},back:{style:"cubic-bezier(0.175, 0.885, 0.32, 1.275)",fn:function(a){return--a*a*(5*a+4)+1}},bounce:{style:"",fn:function(a){return(a/=1)<1/2.75?7.5625*a*a:a<2/2.75?7.5625*(a-=1.5/2.75)*a+.75:a<2.5/2.75?7.5625*(a-=2.25/2.75)*a+.9375:7.5625*(a-=2.625/2.75)*a+.984375}},elastic:{style:"",fn:function(a){return 0===a?0:1==a?1:.4*f.pow(2,-10*a)*f.sin(2*(a-.055)*f.PI/.22)+1}}});b.tap=function(a,b){var c=n.createEvent("Event");
c.initEvent(b,!0,!0);c.pageX=a.pageX;c.pageY=a.pageY;a.target.dispatchEvent(c)};b.click=function(a){var b=a.target,c;/(SELECT|INPUT|TEXTAREA)/i.test(b.tagName)||(c=n.createEvent("MouseEvents"),c.initMouseEvent("click",!0,!0,a.view,1,b.screenX,b.screenY,b.clientX,b.clientY,a.ctrlKey,a.altKey,a.shiftKey,a.metaKey,0,null),c._constructed=!0,b.dispatchEvent(c))};return b}();p.prototype={version:"5.1.3",_init:function(){this._initEvents();this.options.zoom&&this._initZoom();(this.options.scrollbars||this.options.indicators)&&
this._initIndicators();this.options.mouseWheel&&this._initWheel();this.options.snap&&this._initSnap();this.options.keyBindings&&this._initKeys()},destroy:function(){this._initEvents(!0);this._execEvent("destroy")},_transitionEnd:function(a){a.target==this.scroller&&this.isInTransition&&(this._transitionTime(),this.resetPosition(this.options.bounceTime)||(this.isInTransition=!1,this._execEvent("scrollEnd")))},_start:function(a){if(!(1!=d.eventType[a.type]&&0!==a.button||!this.enabled||this.initiated&&
d.eventType[a.type]!==this.initiated)){!this.options.preventDefault||d.isBadAndroid||d.preventDefaultException(a.target,this.options.preventDefaultException)||a.preventDefault();var b=a.touches?a.touches[0]:a;this.initiated=d.eventType[a.type];this.moved=!1;this.directionLocked=this.directionY=this.directionX=this.distY=this.distX=0;this._transitionTime();this.startTime=d.getTime();this.options.useTransition&&this.isInTransition?(this.isInTransition=!1,a=this.getComputedPosition(),this._translate(f.round(a.x),
f.round(a.y)),this._execEvent("scrollEnd")):!this.options.useTransition&&this.isAnimating&&(this.isAnimating=!1,this._execEvent("scrollEnd"));this.startX=this.x;this.startY=this.y;this.absStartX=this.x;this.absStartY=this.y;this.pointX=b.pageX;this.pointY=b.pageY;this._execEvent("beforeScrollStart")}},_move:function(a){if(this.enabled&&d.eventType[a.type]===this.initiated){this.options.preventDefault&&a.preventDefault();var b=a.touches?a.touches[0]:a,c=b.pageX-this.pointX,e=b.pageY-this.pointY,k=
d.getTime(),h;this.pointX=b.pageX;this.pointY=b.pageY;this.distX+=c;this.distY+=e;b=f.abs(this.distX);h=f.abs(this.distY);if(!(300<k-this.endTime&&10>b&&10>h)){this.directionLocked||this.options.freeScroll||(this.directionLocked=b>h+this.options.directionLockThreshold?"h":h>=b+this.options.directionLockThreshold?"v":"n");if("h"==this.directionLocked){if("vertical"==this.options.eventPassthrough)a.preventDefault();else if("horizontal"==this.options.eventPassthrough){this.initiated=!1;return}e=0}else if("v"==
this.directionLocked){if("horizontal"==this.options.eventPassthrough)a.preventDefault();else if("vertical"==this.options.eventPassthrough){this.initiated=!1;return}c=0}c=this.hasHorizontalScroll?c:0;e=this.hasVerticalScroll?e:0;a=this.x+c;b=this.y+e;if(0<a||a<this.maxScrollX)a=this.options.bounce?this.x+c/3:0<a?0:this.maxScrollX;if(0<b||b<this.maxScrollY)b=this.options.bounce?this.y+e/3:0<b?0:this.maxScrollY;this.directionX=0<c?-1:0>c?1:0;this.directionY=0<e?-1:0>e?1:0;this.moved||this._execEvent("scrollStart");
this.moved=!0;this._translate(a,b);300<k-this.startTime&&(this.startTime=k,this.startX=this.x,this.startY=this.y)}}},_end:function(a){if(this.enabled&&d.eventType[a.type]===this.initiated){this.options.preventDefault&&!d.preventDefaultException(a.target,this.options.preventDefaultException)&&a.preventDefault();var b,c;c=d.getTime()-this.startTime;var e=f.round(this.x),k=f.round(this.y),h=f.abs(e-this.startX),g=f.abs(k-this.startY);b=0;var l="";this.initiated=this.isInTransition=0;this.endTime=d.getTime();
if(!this.resetPosition(this.options.bounceTime))if(this.scrollTo(e,k),this.moved)if(this._events.flick&&200>c&&100>h&&100>g)this._execEvent("flick");else if(this.options.momentum&&300>c&&(b=this.hasHorizontalScroll?d.momentum(this.x,this.startX,c,this.maxScrollX,this.options.bounce?this.wrapperWidth:0,this.options.deceleration):{destination:e,duration:0},c=this.hasVerticalScroll?d.momentum(this.y,this.startY,c,this.maxScrollY,this.options.bounce?this.wrapperHeight:0,this.options.deceleration):{destination:k,
duration:0},e=b.destination,k=c.destination,b=f.max(b.duration,c.duration),this.isInTransition=1),this.options.snap&&(this.currentPage=l=this._nearestSnap(e,k),b=this.options.snapSpeed||f.max(f.max(f.min(f.abs(e-l.x),1E3),f.min(f.abs(k-l.y),1E3)),300),e=l.x,k=l.y,this.directionY=this.directionX=0,l=this.options.bounceEasing),e!=this.x||k!=this.y){if(0<e||e<this.maxScrollX||0<k||k<this.maxScrollY)l=d.ease.quadratic;this.scrollTo(e,k,b,l)}else this._execEvent("scrollEnd");else this.options.tap&&d.tap(a,
this.options.tap),this.options.click&&d.click(a),this._execEvent("scrollCancel")}},_resize:function(){var a=this;clearTimeout(this.resizeTimeout);this.resizeTimeout=setTimeout(function(){a.refresh()},this.options.resizePolling)},resetPosition:function(a){var b=this.x,c=this.y;!this.hasHorizontalScroll||0<this.x?b=0:this.x<this.maxScrollX&&(b=this.maxScrollX);!this.hasVerticalScroll||0<this.y?c=0:this.y<this.maxScrollY&&(c=this.maxScrollY);if(b==this.x&&c==this.y)return!1;this.scrollTo(b,c,a||0,this.options.bounceEasing);
return!0},disable:function(){this.enabled=!1},enable:function(){this.enabled=!0},refresh:function(){this.wrapperWidth=this.wrapper.clientWidth;this.wrapperHeight=this.wrapper.clientHeight;this.scrollerWidth=f.round(this.scroller.offsetWidth*this.scale);this.scrollerHeight=f.round(this.scroller.offsetHeight*this.scale);this.maxScrollX=this.wrapperWidth-this.scrollerWidth;this.maxScrollY=this.wrapperHeight-this.scrollerHeight;this.hasHorizontalScroll=this.options.scrollX&&0>this.maxScrollX;this.hasVerticalScroll=
this.options.scrollY&&0>this.maxScrollY;this.hasHorizontalScroll||(this.maxScrollX=0,this.scrollerWidth=this.wrapperWidth);this.hasVerticalScroll||(this.maxScrollY=0,this.scrollerHeight=this.wrapperHeight);this.directionY=this.directionX=this.endTime=0;this.wrapperOffset=d.offset(this.wrapper);this._execEvent("refresh");this.resetPosition()},on:function(a,b){this._events[a]||(this._events[a]=[]);this._events[a].push(b)},off:function(a,b){if(this._events[a]){var c=this._events[a].indexOf(b);-1<c&&
this._events[a].splice(c,1)}},_execEvent:function(a){if(this._events[a]){var b=0,c=this._events[a].length;if(c)for(;b<c;b++)this._events[a][b].apply(this,[].slice.call(arguments,1))}},scrollBy:function(a,b,c,e){a=this.x+a;b=this.y+b;this.scrollTo(a,b,c||0,e)},scrollTo:function(a,b,c,e){e=e||d.ease.circular;this.isInTransition=this.options.useTransition&&0<c;!c||this.options.useTransition&&e.style?(this._transitionTimingFunction(e.style),this._transitionTime(c),this._translate(a,b)):this._animate(a,
b,c,e.fn)},scrollToElement:function(a,b,c,e,k){if(a=a.nodeType?a:this.scroller.querySelector(a)){var h=d.offset(a);h.left-=this.wrapperOffset.left;h.top-=this.wrapperOffset.top;!0===c&&(c=f.round(a.offsetWidth/2-this.wrapper.offsetWidth/2));!0===e&&(e=f.round(a.offsetHeight/2-this.wrapper.offsetHeight/2));h.left-=c||0;h.top-=e||0;h.left=0<h.left?0:h.left<this.maxScrollX?this.maxScrollX:h.left;h.top=0<h.top?0:h.top<this.maxScrollY?this.maxScrollY:h.top;b=void 0===b||null===b||"auto"===b?f.max(f.abs(this.x-
h.left),f.abs(this.y-h.top)):b;this.scrollTo(h.left,h.top,b,k)}},_transitionTime:function(a){a=a||0;this.scrollerStyle[d.style.transitionDuration]=a+"ms";!a&&d.isBadAndroid&&(this.scrollerStyle[d.style.transitionDuration]="0.001s");if(this.indicators)for(var b=this.indicators.length;b--;)this.indicators[b].transitionTime(a)},_transitionTimingFunction:function(a){this.scrollerStyle[d.style.transitionTimingFunction]=a;if(this.indicators)for(var b=this.indicators.length;b--;)this.indicators[b].transitionTimingFunction(a)},
_translate:function(a,b){this.options.useTransform?this.scrollerStyle[d.style.transform]="translate("+a+"px,"+b+"px) scale("+this.scale+") "+this.translateZ:(a=f.round(a),b=f.round(b),this.scrollerStyle.left=a+"px",this.scrollerStyle.top=b+"px");this.x=a;this.y=b;if(this.indicators)for(var c=this.indicators.length;c--;)this.indicators[c].updatePosition()},_initEvents:function(a){a=a?d.removeEvent:d.addEvent;var b=this.options.bindToWrapper?this.wrapper:g;a(g,"orientationchange",this);a(g,"resize",
this);this.options.click&&a(this.wrapper,"click",this,!0);this.options.disableMouse||(a(this.wrapper,"mousedown",this),a(b,"mousemove",this),a(b,"mousecancel",this),a(b,"mouseup",this));d.hasPointer&&!this.options.disablePointer&&(a(this.wrapper,d.prefixPointerEvent("pointerdown"),this),a(b,d.prefixPointerEvent("pointermove"),this),a(b,d.prefixPointerEvent("pointercancel"),this),a(b,d.prefixPointerEvent("pointerup"),this));d.hasTouch&&!this.options.disableTouch&&(a(this.wrapper,"touchstart",this),
a(b,"touchmove",this),a(b,"touchcancel",this),a(b,"touchend",this));a(this.scroller,"transitionend",this);a(this.scroller,"webkitTransitionEnd",this);a(this.scroller,"oTransitionEnd",this);a(this.scroller,"MSTransitionEnd",this)},getComputedPosition:function(){var a=g.getComputedStyle(this.scroller,null),b;this.options.useTransform?(a=a[d.style.transform].split(")")[0].split(", "),b=+(a[12]||a[4]),a=+(a[13]||a[5])):(b=+a.left.replace(/[^-\d.]/g,""),a=+a.top.replace(/[^-\d.]/g,""));return{x:b,y:a}},
_initIndicators:function(){function a(a){for(var b=f.indicators.length;b--;)a.call(f.indicators[b])}var b=this.options.interactiveScrollbars,c="string"!=typeof this.options.scrollbars,e=[],d,f=this;this.indicators=[];this.options.scrollbars&&(this.options.scrollY&&(d={el:t("v",b,this.options.scrollbars),interactive:b,defaultScrollbars:!0,customStyle:c,resize:this.options.resizeScrollbars,shrink:this.options.shrinkScrollbars,fade:this.options.fadeScrollbars,listenX:!1},this.wrapper.appendChild(d.el),
e.push(d)),this.options.scrollX&&(d={el:t("h",b,this.options.scrollbars),interactive:b,defaultScrollbars:!0,customStyle:c,resize:this.options.resizeScrollbars,shrink:this.options.shrinkScrollbars,fade:this.options.fadeScrollbars,listenY:!1},this.wrapper.appendChild(d.el),e.push(d)));this.options.indicators&&(e=e.concat(this.options.indicators));for(b=e.length;b--;)this.indicators.push(new u(this,e[b]));this.options.fadeScrollbars&&(this.on("scrollEnd",function(){a(function(){this.fade()})}),this.on("scrollCancel",
function(){a(function(){this.fade()})}),this.on("scrollStart",function(){a(function(){this.fade(1)})}),this.on("beforeScrollStart",function(){a(function(){this.fade(1,!0)})}));this.on("refresh",function(){a(function(){this.refresh()})});this.on("destroy",function(){a(function(){this.destroy()});delete this.indicators})},_initZoom:function(){this.scrollerStyle[d.style.transformOrigin]="0 0"},_zoomStart:function(a){var b=f.abs(a.touches[0].pageX-a.touches[1].pageX),c=f.abs(a.touches[0].pageY-a.touches[1].pageY);
this.touchesDistanceStart=f.sqrt(b*b+c*c);this.startScale=this.scale;this.originX=f.abs(a.touches[0].pageX+a.touches[1].pageX)/2+this.wrapperOffset.left-this.x;this.originY=f.abs(a.touches[0].pageY+a.touches[1].pageY)/2+this.wrapperOffset.top-this.y;this._execEvent("zoomStart")},_zoom:function(a){if(this.enabled&&d.eventType[a.type]===this.initiated){this.options.preventDefault&&a.preventDefault();var b=f.abs(a.touches[0].pageX-a.touches[1].pageX);a=f.abs(a.touches[0].pageY-a.touches[1].pageY);var b=
f.sqrt(b*b+a*a),b=1/this.touchesDistanceStart*b*this.startScale,c;this.scaled=!0;b<this.options.zoomMin?b=.5*this.options.zoomMin*f.pow(2,b/this.options.zoomMin):b>this.options.zoomMax&&(b=2*this.options.zoomMax*f.pow(.5,this.options.zoomMax/b));c=b/this.startScale;a=this.originX-this.originX*c+this.startX;c=this.originY-this.originY*c+this.startY;this.scale=b;this.scrollTo(a,c,0)}},_zoomEnd:function(a){if(this.enabled&&d.eventType[a.type]===this.initiated){this.options.preventDefault&&a.preventDefault();
var b;this.initiated=this.isInTransition=0;this.scale>this.options.zoomMax?this.scale=this.options.zoomMax:this.scale<this.options.zoomMin&&(this.scale=this.options.zoomMin);this.refresh();b=this.scale/this.startScale;a=this.originX-this.originX*b+this.startX;b=this.originY-this.originY*b+this.startY;0<a?a=0:a<this.maxScrollX&&(a=this.maxScrollX);0<b?b=0:b<this.maxScrollY&&(b=this.maxScrollY);this.x==a&&this.y==b||this.scrollTo(a,b,this.options.bounceTime);this.scaled=!1;this._execEvent("zoomEnd")}},
zoom:function(a,b,c,e){a<this.options.zoomMin?a=this.options.zoomMin:a>this.options.zoomMax&&(a=this.options.zoomMax);if(a!=this.scale){var d=a/this.scale;b=void 0===b?this.wrapperWidth/2:b;c=void 0===c?this.wrapperHeight/2:c;e=void 0===e?300:e;b=b+this.wrapperOffset.left-this.x;c=c+this.wrapperOffset.top-this.y;b=b-b*d+this.x;c=c-c*d+this.y;this.scale=a;this.refresh();0<b?b=0:b<this.maxScrollX&&(b=this.maxScrollX);0<c?c=0:c<this.maxScrollY&&(c=this.maxScrollY);this.scrollTo(b,c,e)}},_wheelZoom:function(a){var b,
c=this;clearTimeout(this.wheelTimeout);this.wheelTimeout=setTimeout(function(){c._execEvent("zoomEnd")},400);if("deltaX"in a)b=-a.deltaY/f.abs(a.deltaY);else if("wheelDeltaX"in a)b=a.wheelDeltaY/f.abs(a.wheelDeltaY);else if("wheelDelta"in a)b=a.wheelDelta/f.abs(a.wheelDelta);else if("detail"in a)b=-a.detail/f.abs(a.wheelDelta);else return;this.zoom(this.scale+b/5,a.pageX,a.pageY,0)},_initWheel:function(){d.addEvent(this.wrapper,"wheel",this);d.addEvent(this.wrapper,"mousewheel",this);d.addEvent(this.wrapper,
"DOMMouseScroll",this);this.on("destroy",function(){d.removeEvent(this.wrapper,"wheel",this);d.removeEvent(this.wrapper,"mousewheel",this);d.removeEvent(this.wrapper,"DOMMouseScroll",this)})},_wheel:function(a){if(this.enabled){a.preventDefault();a.stopPropagation();var b,c,e,d=this;void 0===this.wheelTimeout&&d._execEvent("scrollStart");clearTimeout(this.wheelTimeout);this.wheelTimeout=setTimeout(function(){d._execEvent("scrollEnd");d.wheelTimeout=void 0},400);if("deltaX"in a)1===a.deltaMode?(b=
-a.deltaX*this.options.mouseWheelSpeed,a=-a.deltaY*this.options.mouseWheelSpeed):(b=-a.deltaX,a=-a.deltaY);else if("wheelDeltaX"in a)b=a.wheelDeltaX/120*this.options.mouseWheelSpeed,a=a.wheelDeltaY/120*this.options.mouseWheelSpeed;else if("wheelDelta"in a)b=a=a.wheelDelta/120*this.options.mouseWheelSpeed;else if("detail"in a)b=a=-a.detail/3*this.options.mouseWheelSpeed;else return;b*=this.options.invertWheelDirection;a*=this.options.invertWheelDirection;this.hasVerticalScroll||(b=a,a=0);this.options.snap?
(c=this.currentPage.pageX,e=this.currentPage.pageY,0<b?c--:0>b&&c++,0<a?e--:0>a&&e++,this.goToPage(c,e)):(c=this.x+f.round(this.hasHorizontalScroll?b:0),e=this.y+f.round(this.hasVerticalScroll?a:0),0<c?c=0:c<this.maxScrollX&&(c=this.maxScrollX),0<e?e=0:e<this.maxScrollY&&(e=this.maxScrollY),this.scrollTo(c,e,0))}},_initSnap:function(){this.currentPage={};"string"==typeof this.options.snap&&(this.options.snap=this.scroller.querySelectorAll(this.options.snap));this.on("refresh",function(){var a=0,b,
c=0,e,d,h,g=0,l;e=this.options.snapStepX||this.wrapperWidth;var m=this.options.snapStepY||this.wrapperHeight;this.pages=[];if(this.wrapperWidth&&this.wrapperHeight&&this.scrollerWidth&&this.scrollerHeight){if(!0===this.options.snap)for(d=f.round(e/2),h=f.round(m/2);g>-this.scrollerWidth;){this.pages[a]=[];for(l=b=0;l>-this.scrollerHeight;)this.pages[a][b]={x:f.max(g,this.maxScrollX),y:f.max(l,this.maxScrollY),width:e,height:m,cx:g-d,cy:l-h},l-=m,b++;g-=e;a++}else for(m=this.options.snap,b=m.length,
e=-1;a<b;a++){if(0===a||m[a].offsetLeft<=m[a-1].offsetLeft)c=0,e++;this.pages[c]||(this.pages[c]=[]);g=f.max(-m[a].offsetLeft,this.maxScrollX);l=f.max(-m[a].offsetTop,this.maxScrollY);d=g-f.round(m[a].offsetWidth/2);h=l-f.round(m[a].offsetHeight/2);this.pages[c][e]={x:g,y:l,width:m[a].offsetWidth,height:m[a].offsetHeight,cx:d,cy:h};g>this.maxScrollX&&c++}this.goToPage(this.currentPage.pageX||0,this.currentPage.pageY||0,0);0===this.options.snapThreshold%1?this.snapThresholdY=this.snapThresholdX=this.options.snapThreshold:
(this.snapThresholdX=f.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width*this.options.snapThreshold),this.snapThresholdY=f.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height*this.options.snapThreshold))}});this.on("flick",function(){var a=this.options.snapSpeed||f.max(f.max(f.min(f.abs(this.x-this.startX),1E3),f.min(f.abs(this.y-this.startY),1E3)),300);this.goToPage(this.currentPage.pageX+this.directionX,this.currentPage.pageY+this.directionY,a)})},_nearestSnap:function(a,
b){if(!this.pages.length)return{x:0,y:0,pageX:0,pageY:0};var c=0,e=this.pages.length,d=0;if(f.abs(a-this.absStartX)<this.snapThresholdX&&f.abs(b-this.absStartY)<this.snapThresholdY)return this.currentPage;0<a?a=0:a<this.maxScrollX&&(a=this.maxScrollX);0<b?b=0:b<this.maxScrollY&&(b=this.maxScrollY);for(;c<e;c++)if(a>=this.pages[c][0].cx){a=this.pages[c][0].x;break}for(e=this.pages[c].length;d<e;d++)if(b>=this.pages[0][d].cy){b=this.pages[0][d].y;break}c==this.currentPage.pageX&&(c+=this.directionX,
0>c?c=0:c>=this.pages.length&&(c=this.pages.length-1),a=this.pages[c][0].x);d==this.currentPage.pageY&&(d+=this.directionY,0>d?d=0:d>=this.pages[0].length&&(d=this.pages[0].length-1),b=this.pages[0][d].y);return{x:a,y:b,pageX:c,pageY:d}},goToPage:function(a,b,c,d){d=d||this.options.bounceEasing;a>=this.pages.length?a=this.pages.length-1:0>a&&(a=0);b>=this.pages[a].length?b=this.pages[a].length-1:0>b&&(b=0);var g=this.pages[a][b].x,h=this.pages[a][b].y;c=void 0===c?this.options.snapSpeed||f.max(f.max(f.min(f.abs(g-
this.x),1E3),f.min(f.abs(h-this.y),1E3)),300):c;this.currentPage={x:g,y:h,pageX:a,pageY:b};this.scrollTo(g,h,c,d)},next:function(a,b){var c=this.currentPage.pageX,d=this.currentPage.pageY;c++;c>=this.pages.length&&this.hasVerticalScroll&&(c=0,d++);this.goToPage(c,d,a,b)},prev:function(a,b){var c=this.currentPage.pageX,d=this.currentPage.pageY;c--;0>c&&this.hasVerticalScroll&&(c=0,d--);this.goToPage(c,d,a,b)},_initKeys:function(a){a={pageUp:33,pageDown:34,end:35,home:36,left:37,up:38,right:39,down:40};
var b;if("object"==typeof this.options.keyBindings)for(b in this.options.keyBindings)"string"==typeof this.options.keyBindings[b]&&(this.options.keyBindings[b]=this.options.keyBindings[b].toUpperCase().charCodeAt(0));else this.options.keyBindings={};for(b in a)this.options.keyBindings[b]=this.options.keyBindings[b]||a[b];d.addEvent(g,"keydown",this);this.on("destroy",function(){d.removeEvent(g,"keydown",this)})},_key:function(a){if(this.enabled){var b=this.options.snap,c=b?this.currentPage.pageX:
this.x,e=b?this.currentPage.pageY:this.y,g=d.getTime(),h=this.keyTime||0,n;this.options.useTransition&&this.isInTransition&&(n=this.getComputedPosition(),this._translate(f.round(n.x),f.round(n.y)),this.isInTransition=!1);this.keyAcceleration=200>g-h?f.min(this.keyAcceleration+.25,50):0;switch(a.keyCode){case this.options.keyBindings.pageUp:this.hasHorizontalScroll&&!this.hasVerticalScroll?c+=b?1:this.wrapperWidth:e+=b?1:this.wrapperHeight;break;case this.options.keyBindings.pageDown:this.hasHorizontalScroll&&
!this.hasVerticalScroll?c-=b?1:this.wrapperWidth:e-=b?1:this.wrapperHeight;break;case this.options.keyBindings.end:c=b?this.pages.length-1:this.maxScrollX;e=b?this.pages[0].length-1:this.maxScrollY;break;case this.options.keyBindings.home:e=c=0;break;case this.options.keyBindings.left:c+=b?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.up:e+=b?1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.right:c-=b?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.down:e-=
b?1:5+this.keyAcceleration>>0;break;default:return}b?this.goToPage(c,e):(0<c?this.keyAcceleration=c=0:c<this.maxScrollX&&(c=this.maxScrollX,this.keyAcceleration=0),0<e?this.keyAcceleration=e=0:e<this.maxScrollY&&(e=this.maxScrollY,this.keyAcceleration=0),this.scrollTo(c,e,0),this.keyTime=g)}},_animate:function(a,b,c,e){function f(){var q=d.getTime(),r;q>=p?(g.isAnimating=!1,g._translate(a,b),g.resetPosition(g.options.bounceTime)||g._execEvent("scrollEnd")):(q=(q-m)/c,r=e(q),q=(a-n)*r+n,r=(b-l)*r+
l,g._translate(q,r),g.isAnimating&&v(f))}var g=this,n=this.x,l=this.y,m=d.getTime(),p=m+c;this.isAnimating=!0;f()},handleEvent:function(a){switch(a.type){case "touchstart":case "pointerdown":case "MSPointerDown":case "mousedown":this._start(a);this.options.zoom&&a.touches&&1<a.touches.length&&this._zoomStart(a);break;case "touchmove":case "pointermove":case "MSPointerMove":case "mousemove":if(this.options.zoom&&a.touches&&a.touches[1]){this._zoom(a);break}this._move(a);break;case "touchend":case "pointerup":case "MSPointerUp":case "mouseup":case "touchcancel":case "pointercancel":case "MSPointerCancel":case "mousecancel":if(this.scaled){this._zoomEnd(a);
break}this._end(a);break;case "orientationchange":case "resize":this._resize();break;case "transitionend":case "webkitTransitionEnd":case "oTransitionEnd":case "MSTransitionEnd":this._transitionEnd(a);break;case "wheel":case "DOMMouseScroll":case "mousewheel":if("zoom"==this.options.wheelAction){this._wheelZoom(a);break}this._wheel(a);break;case "keydown":this._key(a)}}};u.prototype={handleEvent:function(a){switch(a.type){case "touchstart":case "pointerdown":case "MSPointerDown":case "mousedown":this._start(a);
break;case "touchmove":case "pointermove":case "MSPointerMove":case "mousemove":this._move(a);break;case "touchend":case "pointerup":case "MSPointerUp":case "mouseup":case "touchcancel":case "pointercancel":case "MSPointerCancel":case "mousecancel":this._end(a)}},destroy:function(){this.options.interactive&&(d.removeEvent(this.indicator,"touchstart",this),d.removeEvent(this.indicator,d.prefixPointerEvent("pointerdown"),this),d.removeEvent(this.indicator,"mousedown",this),d.removeEvent(g,"touchmove",
this),d.removeEvent(g,d.prefixPointerEvent("pointermove"),this),d.removeEvent(g,"mousemove",this),d.removeEvent(g,"touchend",this),d.removeEvent(g,d.prefixPointerEvent("pointerup"),this),d.removeEvent(g,"mouseup",this));this.options.defaultScrollbars&&this.wrapper.parentNode.removeChild(this.wrapper)},_start:function(a){var b=a.touches?a.touches[0]:a;a.preventDefault();a.stopPropagation();this.transitionTime();this.initiated=!0;this.moved=!1;this.lastPointX=b.pageX;this.lastPointY=b.pageY;this.startTime=
d.getTime();this.options.disableTouch||d.addEvent(g,"touchmove",this);this.options.disablePointer||d.addEvent(g,d.prefixPointerEvent("pointermove"),this);this.options.disableMouse||d.addEvent(g,"mousemove",this);this.scroller._execEvent("beforeScrollStart")},_move:function(a){var b=a.touches?a.touches[0]:a,c,e;d.getTime();this.moved||this.scroller._execEvent("scrollStart");this.moved=!0;c=b.pageX-this.lastPointX;this.lastPointX=b.pageX;e=b.pageY-this.lastPointY;this.lastPointY=b.pageY;this._pos(this.x+
c,this.y+e);a.preventDefault();a.stopPropagation()},_end:function(a){if(this.initiated){this.initiated=!1;a.preventDefault();a.stopPropagation();d.removeEvent(g,"touchmove",this);d.removeEvent(g,d.prefixPointerEvent("pointermove"),this);d.removeEvent(g,"mousemove",this);if(this.scroller.options.snap){a=this.scroller._nearestSnap(this.scroller.x,this.scroller.y);var b=this.options.snapSpeed||f.max(f.max(f.min(f.abs(this.scroller.x-a.x),1E3),f.min(f.abs(this.scroller.y-a.y),1E3)),300);if(this.scroller.x!=
a.x||this.scroller.y!=a.y)this.scroller.directionX=0,this.scroller.directionY=0,this.scroller.currentPage=a,this.scroller.scrollTo(a.x,a.y,b,this.scroller.options.bounceEasing)}this.moved&&this.scroller._execEvent("scrollEnd")}},transitionTime:function(a){a=a||0;this.indicatorStyle[d.style.transitionDuration]=a+"ms";!a&&d.isBadAndroid&&(this.indicatorStyle[d.style.transitionDuration]="0.001s")},transitionTimingFunction:function(a){this.indicatorStyle[d.style.transitionTimingFunction]=a},refresh:function(){this.transitionTime();
this.indicatorStyle.display=this.options.listenX&&!this.options.listenY?this.scroller.hasHorizontalScroll?"block":"none":this.options.listenY&&!this.options.listenX?this.scroller.hasVerticalScroll?"block":"none":this.scroller.hasHorizontalScroll||this.scroller.hasVerticalScroll?"block":"none";this.scroller.hasHorizontalScroll&&this.scroller.hasVerticalScroll?(d.addClass(this.wrapper,"iScrollBothScrollbars"),d.removeClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&
(this.options.listenX?this.wrapper.style.right="8px":this.wrapper.style.bottom="8px")):(d.removeClass(this.wrapper,"iScrollBothScrollbars"),d.addClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&(this.options.listenX?this.wrapper.style.right="2px":this.wrapper.style.bottom="2px"));this.options.listenX&&(this.wrapperWidth=this.wrapper.clientWidth,this.options.resize?(this.indicatorWidth=f.max(f.round(this.wrapperWidth*this.wrapperWidth/(this.scroller.scrollerWidth||
this.wrapperWidth||1)),8),this.indicatorStyle.width=this.indicatorWidth+"px"):this.indicatorWidth=this.indicator.clientWidth,this.maxPosX=this.wrapperWidth-this.indicatorWidth,"clip"==this.options.shrink?(this.minBoundaryX=-this.indicatorWidth+8,this.maxBoundaryX=this.wrapperWidth-8):(this.minBoundaryX=0,this.maxBoundaryX=this.maxPosX),this.sizeRatioX=this.options.speedRatioX||this.scroller.maxScrollX&&this.maxPosX/this.scroller.maxScrollX);this.options.listenY&&(this.wrapperHeight=this.wrapper.clientHeight,
this.options.resize?(this.indicatorHeight=f.max(f.round(this.wrapperHeight*this.wrapperHeight/(this.scroller.scrollerHeight||this.wrapperHeight||1)),8),this.indicatorStyle.height=this.indicatorHeight+"px"):this.indicatorHeight=this.indicator.clientHeight,this.maxPosY=this.wrapperHeight-this.indicatorHeight,"clip"==this.options.shrink?(this.minBoundaryY=-this.indicatorHeight+8,this.maxBoundaryY=this.wrapperHeight-8):(this.minBoundaryY=0,this.maxBoundaryY=this.maxPosY),this.maxPosY=this.wrapperHeight-
this.indicatorHeight,this.sizeRatioY=this.options.speedRatioY||this.scroller.maxScrollY&&this.maxPosY/this.scroller.maxScrollY);this.updatePosition()},updatePosition:function(){var a=this.options.listenX&&f.round(this.sizeRatioX*this.scroller.x)||0,b=this.options.listenY&&f.round(this.sizeRatioY*this.scroller.y)||0;this.options.ignoreBoundaries||(a<this.minBoundaryX?("scale"==this.options.shrink&&(this.width=f.max(this.indicatorWidth+a,8),this.indicatorStyle.width=this.width+"px"),a=this.minBoundaryX):
a>this.maxBoundaryX?"scale"==this.options.shrink?(this.width=f.max(this.indicatorWidth-(a-this.maxPosX),8),this.indicatorStyle.width=this.width+"px",a=this.maxPosX+this.indicatorWidth-this.width):a=this.maxBoundaryX:"scale"==this.options.shrink&&this.width!=this.indicatorWidth&&(this.width=this.indicatorWidth,this.indicatorStyle.width=this.width+"px"),b<this.minBoundaryY?("scale"==this.options.shrink&&(this.height=f.max(this.indicatorHeight+3*b,8),this.indicatorStyle.height=this.height+"px"),b=this.minBoundaryY):
b>this.maxBoundaryY?"scale"==this.options.shrink?(this.height=f.max(this.indicatorHeight-3*(b-this.maxPosY),8),this.indicatorStyle.height=this.height+"px",b=this.maxPosY+this.indicatorHeight-this.height):b=this.maxBoundaryY:"scale"==this.options.shrink&&this.height!=this.indicatorHeight&&(this.height=this.indicatorHeight,this.indicatorStyle.height=this.height+"px"));this.x=a;this.y=b;this.scroller.options.useTransform?this.indicatorStyle[d.style.transform]="translate("+a+"px,"+b+"px)"+this.scroller.translateZ:
(this.indicatorStyle.left=a+"px",this.indicatorStyle.top=b+"px")},_pos:function(a,b){0>a?a=0:a>this.maxPosX&&(a=this.maxPosX);0>b?b=0:b>this.maxPosY&&(b=this.maxPosY);a=this.options.listenX?f.round(a/this.sizeRatioX):this.scroller.x;b=this.options.listenY?f.round(b/this.sizeRatioY):this.scroller.y;this.scroller.scrollTo(a,b)},fade:function(a,b){if(!b||this.visible){clearTimeout(this.fadeTimeout);this.fadeTimeout=null;var c=a?250:500,e=a?0:300;this.wrapperStyle[d.style.transitionDuration]=c+"ms";this.fadeTimeout=
setTimeout(function(a){this.wrapperStyle.opacity=a;this.visible=+a}.bind(this,a?"1":"0"),e)}}};p.utils=d;"undefined"!=typeof module&&module.exports?module.exports=p:g.IScroll=p})(window,document,Math);

/**
 * HideSeek jQuery plugin
 *
 * @copyright Copyright 2015, Dimitris Krestos
 * @license   Apache License, Version 2.0 (http://www.opensource.org/licenses/apache2.0.php)
 * @link      http://vdw.staytuned.gr
 * @version   v0.6.2
 *
 * Dependencies are include in minified versions at the bottom:
 * 1. Highlight v4 by Johann Burkard
 *
 */

  /* Sample html structure

  <input name="search" placeholder="Start typing here" type="text" data-list=".list">
  <ul class="list">
    <li>item 1</li>
    <li>...</li>
    <li><a href="#">item 2</a></li>
  </ul>

  or

  <input name="search" placeholder="Start typing here" type="text" data-list=".list">
  <div class="list">
    <span>item 1</span>
    <span>...</span>
    <span>item 2</span>
  </div>

  or any similar structure...

  */

!function(e){"use strict";e.fn.hideseek=function(t){var i={list:".hideseek-data",nodata:"",attribute:"text",highlight:!1,ignore:"",navigation:!1,ignore_accents:!1,hidden_mode:!1},t=e.extend(i,t);return this.each(function(){var i=e(this);i.opts=[],e.map(["list","nodata","attribute","highlight","ignore","navigation","ignore_accents","hidden_mode"],function(e){i.opts[e]=i.data(e)||t[e]});var s=e(i.opts.list);i.opts.navigation&&i.attr("autocomplete","off"),i.opts.hidden_mode&&s.children().hide(),i.keyup(function(t){function o(e){return e.children(".selected:visible")}function n(e){return o(e).prevAll(":visible:first")}function a(e){return o(e).nextAll(":visible:first")}if(38!=t.keyCode&&40!=t.keyCode&&13!=t.keyCode){var r=i.val().toLowerCase();s.children(i.opts.ignore.trim()?":not("+i.opts.ignore+")":"").removeClass("selected").each(function(){var t="text"!=i.opts.attribute?e(this).attr(i.opts.attribute).toLowerCase():e(this).text().toLowerCase(),s=-1==t.removeAccents(i.opts.ignore_accents).indexOf(r)||r===(i.opts.hidden_mode?"":!1);s?(e(this).hide(),i.trigger("_after_each")):(i.opts.highlight?e(this).removeHighlight().highlight(r).show():e(this).show(),i.trigger("_after_each"))}),i.opts.nodata&&(s.find(".no-results").remove(),s.children(':not([style*="display: none"])').length||s.children().first().clone().removeHighlight().addClass("no-results").show().prependTo(i.opts.list).text(i.opts.nodata)),i.trigger("_after")}i.opts.navigation&&(38==t.keyCode?o(s).length?(n(s).addClass("selected"),o(s).last().removeClass("selected")):s.children(":visible").last().addClass("selected"):40==t.keyCode?o(s).length?(a(s).addClass("selected"),o(s).first().removeClass("selected")):s.children(":visible").first().addClass("selected"):13==t.keyCode&&(o(s).find("a").length?document.location=o(s).find("a").attr("href"):i.val(o(s).text())))})})},e(document).ready(function(){e('[data-toggle="hideseek"]').hideseek()})}(jQuery);

/*

highlight v4

Highlights arbitrary terms.

<http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>

MIT license.

Johann Burkard
<http://johannburkard.de>
<mailto:jb@eaio.com>

*/
jQuery.fn.highlight=function(t){function e(t,i){var n=0;if(3==t.nodeType){var a=t.data.removeAccents(true).toUpperCase().indexOf(i);if(a>=0){var s=document.createElement("mark");s.className="highlight";var r=t.splitText(a);r.splitText(i.length);var o=r.cloneNode(!0);s.appendChild(o),r.parentNode.replaceChild(s,r),n=1}}else if(1==t.nodeType&&t.childNodes&&!/(script|style)/i.test(t.tagName))for(var h=0;h<t.childNodes.length;++h)h+=e(t.childNodes[h],i);return n}return this.length&&t&&t.length?this.each(function(){e(this,t.toUpperCase())}):this},jQuery.fn.removeHighlight=function(){return this.find("mark.highlight").each(function(){with(this.parentNode.firstChild.nodeName,this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};

// Ignore accents
String.prototype.removeAccents=function(e){return e?this.replace(/[áàãâä]/gi,"a").replace(/[éè¨ê]/gi,"e").replace(/[íìïî]/gi,"i").replace(/[óòöôõ]/gi,"o").replace(/[úùüû]/gi,"u").replace(/[ç]/gi,"c").replace(/[ñ]/gi,"n"):this};


/* Qaptured Cropper */
(function($){
		$.fn.extend({
			
			qptCover : function( options, callback ){
				
				var defaults = {
					wrapper: ''
				};
				
				var options = $.extend( defaults, options );
				
				return this.each(function(){
					
					var o = options,
						main = $( this ),
						q = {
							wrapper: o.wrapper,
							detect: function( k ){
								return k.length > 0 ? true : false;
							},
							plugin: function(){
								var _t = this;
								main.draggable({ 
									axis: 'y', 
									refreshPositions: true,
									drag: function( event, ui ){
										var y1 = $( _t.wrapper ).height(), y2 = $('img', main).height();
										
										if( ui.position.top >= 0 )
											ui.position.top = 0;
										else if(ui.position.top <= y1 - y2)
											ui.position.top = y1 - y2;
									}
								});
							},
							onResize: function(){
								var _t = this, y1 = $( _t.wrapper ).height(), y2 = $('img', main).height(), t = parseFloat( main.css('top') );
								if( t <= y1 - y2 )
									main.css('top', y1 - y2)
							},
							events: function(){
								var _t = this;
								$( window ).resize(function(){ _t.onResize(); });
							},
							init: function(){					
								var _t = this, w = $( _t.wrapper );	
								if( _t.detect( w ) && _t.detect( main ) ){
									_t.plugin();	
									_t.events();
								}
							}	
						};
						
						q.init();
						
						////////////////////////////////// PUBLIC FUNC.
						this.getPosition = function(){
							return main.offset();
						}
				});
			}
		})
	})(jQuery, window);