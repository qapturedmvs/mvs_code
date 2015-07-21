////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ANGULAR PLUGINS
/* ng-infinite-scroll - v1.0.0 - 2013-02-23 */
var mod;mod=angular.module("infinite-scroll",[]),mod.directive("infiniteScroll",["$rootScope","$window","$timeout",function(i,n,e){return{link:function(t,l,o){var r,c,f,a;return n=angular.element(n),f=0,null!=o.infiniteScrollDistance&&t.$watch(o.infiniteScrollDistance,function(i){return f=parseInt(i,10)}),a=!0,r=!1,null!=o.infiniteScrollDisabled&&t.$watch(o.infiniteScrollDisabled,function(i){return a=!i,a&&r?(r=!1,c()):void 0}),c=function(){var e,c,u,d;return d=n.height()+n.scrollTop(),e=l.offset().top+l.height(),c=e-d,u=n.height()*f>=c,u&&a?i.$$phase?t.$eval(o.infiniteScroll):t.$apply(o.infiniteScroll):u?r=!0:void 0},n.on("scroll",c),t.$on("$destroy",function(){return n.off("scroll",c)}),e(function(){return o.infiniteScrollImmediateCheck?t.$eval(o.infiniteScrollImmediateCheck)?c():void 0:c()},0)}}}]);


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
(function(b){b.fn.extend({minusDropDown:function(h,g){h=b.extend({type:"hover",customClass:"opened",delay:555,openedDelay:0,className:"",clicked:"",openedControl:"",hideDropDown:[],attachmentDiv:null},h);return this.each(function(){var c=b(this),a=h,f=null!=a.attachmentDiv?b(a.attachmentDiv):null,k="",d=null,e={opened:function(){if(0<a.hideDropDown.length)for(var b=0;b<a.hideDropDown.length;++b)0<a.hideDropDown[b].length&&a.hideDropDown[b][0].closed();null!=f&&f.addClass(a.customClass);c.addClass(a.customClass);
void 0!=g&&g("opened")},closed:function(){null!=f&&f.removeClass(a.customClass);c.removeClass(a.customClass);void 0!=g&&g("closed")}},l=function(){null!=d&&clearTimeout(d);if(""!=a.openedControl&&""==a.openedControl.html())return!1;d=setTimeout(function(){e.opened()},a.openedDelay)},m=function(){null!=d&&clearTimeout(d);d=setTimeout(function(){e.closed()},a.delay)},n=function(){c.hasClass(a.customClass)?e.closed():e.opened()};this.opened=function(){e.opened()};this.closed=function(){null!=d&&clearTimeout(d);
e.closed()};this.dispose=function(){"hover"==a.type?c.unbind("mouseenter").unbind("mouseleave"):b(a.clicked,c).unbind("click")};this.live=function(){"hover"==a.type?c.mouseenter(l).mouseleave(m):b(a.clicked,c).click(n)};"hover"==a.type?(c.mouseenter(l).mouseleave(m),null!=f&&f.mouseenter(l).mouseleave(m)):b(a.clicked,c).click(n);k=""!=a.className?a.className:c.context.className.split(" ")[0];b("body, html").click(function(d){c.hasClass(a.customClass)&&d.target.className!=k&&1!=b(d.target).parents("."+
k).size()&&e.closed()})})}})})(jQuery,window);

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


/*  jquery.Jcrop.js v0.9.12 */
(function(f){f.Jcrop=function(z,B){function g(a){return Math.round(a)+"px"}function G(a){a=f(a).offset();return[a.left,a.top]}function C(a){return[a.pageX-J[0],a.pageY-J[1]]}function H(b){"object"!==typeof b&&(b={});a=f.extend(a,b);f.each(["onChange","onSelect","onRelease","onDblClick"],function(b,t){"function"!==typeof a[t]&&(a[t]=function(){})})}function ga(a,d,t){J=G(h);F.setCursor("move"===a?a:a+"-resize");if("move"===a)return F.activateHandlers(va(d),aa,t);d=w.getFixed();var f=ha(a),c=w.getCorner(ha(f));
w.setPressed(w.getCorner(f));w.setCurrent(c);F.activateHandlers(wa(a,d),aa,t)}function wa(b,d){return function(t){if(a.aspectRatio)switch(b){case "e":t[1]=d.y+1;break;case "w":t[1]=d.y+1;break;case "n":t[0]=d.x+1;break;case "s":t[0]=d.x+1}else switch(b){case "e":t[1]=d.y2;break;case "w":t[1]=d.y2;break;case "n":t[0]=d.x2;break;case "s":t[0]=d.x2}w.setCurrent(t);m.update()}}function va(a){var d=a;ba.watchKeys();return function(a){w.moveOffset([a[0]-d[0],a[1]-d[1]]);d=a;m.update()}}function ha(a){switch(a){case "n":return"sw";
case "s":return"nw";case "e":return"nw";case "w":return"ne";case "ne":return"sw";case "nw":return"se";case "se":return"nw";case "sw":return"ne"}}function ja(b){return function(d){if(a.disabled||"move"===b&&!a.allowMove)return!1;J=G(h);N=!0;ga(b,C(d));d.stopPropagation();d.preventDefault();return!1}}function ka(a,d,t){var f=a.width(),c=a.height();f>d&&0<d&&(f=d,c=d/a.width()*a.height());c>t&&0<t&&(c=t,f=t/a.height()*a.width());x=a.width()/f;y=a.height()/c;a.width(f).height(c)}function S(a){return{x:a.x*
x,y:a.y*y,x2:a.x2*x,y2:a.y2*y,w:a.w*x,h:a.h*y}}function aa(b){b=w.getFixed();b.w>a.minSelect[0]&&b.h>a.minSelect[1]?(m.enableHandles(),m.done()):m.release();F.setCursor(a.allowSelect?"crosshair":"default")}function la(b){if(a.disabled||!a.allowSelect)return!1;N=!0;J=G(h);m.disableHandles();F.setCursor("crosshair");var d=C(b);w.setPressed(d);m.update();F.activateHandlers(xa,aa,"touch"===b.type.substring(0,5));ba.watchKeys();b.stopPropagation();b.preventDefault();return!1}function xa(a){w.setCurrent(a);
m.update()}function ma(){var b=f("<div></div>").addClass(a.baseClass+"-tracker");na&&b.css({opacity:0,backgroundColor:"white"});return b}function oa(b){pa([b[0]/x,b[1]/y,b[2]/x,b[3]/y]);a.onSelect.call(D,S(w.getFixed()));m.enableHandles()}function pa(a){w.setPressed([a[0],a[1]]);w.setCurrent([a[2],a[3]]);m.update()}function qa(){a.disabled=!0;m.disableHandles();m.setCursor("default");F.setCursor("default")}function ra(){a.disabled=!1;ca()}function da(b,d,t){d=d||a.bgColor;a.bgFade&&f.fx.step.hasOwnProperty("backgroundColor")&&
a.fadeTime&&!t?b.animate({backgroundColor:d},{queue:!1,duration:a.fadeTime}):b.css("backgroundColor",d)}function ca(b){a.allowResize?b?m.enableOnly():m.enableHandles():m.disableHandles();F.setCursor(a.allowSelect?"crosshair":"default");m.setCursor(a.allowMove?"move":"default");a.hasOwnProperty("trueSize")&&(x=a.trueSize[0]/v,y=a.trueSize[1]/u);a.hasOwnProperty("setSelect")&&(oa(a.setSelect),m.done(),delete a.setSelect);K.refresh();a.bgColor!=sa&&(da(a.shade?K.getShades():I,a.shade?a.shadeColor||a.bgColor:
a.bgColor),sa=a.bgColor);T!=a.bgOpacity&&(T=a.bgOpacity,a.shade?K.refresh():m.setBgOpacity(T));U=a.maxSize[0]||0;V=a.maxSize[1]||0;W=a.minSize[0]||0;X=a.minSize[1]||0;a.hasOwnProperty("outerImage")&&(h.attr("src",a.outerImage),delete a.outerImage);m.refresh()}var a=f.extend({},f.Jcrop.defaults),J,O=navigator.userAgent.toLowerCase(),na=/msie/.test(O),ta=/msie [1-6]\./.test(O);"object"!==typeof z&&(z=f(z)[0]);"object"!==typeof B&&(B={});H(B);var O={border:"none",visibility:"visible",margin:0,padding:0,
position:"absolute",top:0,left:0},r=f(z),ua=!0;if("IMG"==z.tagName){if(0!=r[0].width&&0!=r[0].height)r.width(r[0].width),r.height(r[0].height);else{var ea=new Image;ea.src=r[0].src;r.width(ea.width);r.height(ea.height)}var h=r.clone().removeAttr("id").css(O).show();h.width(r.width());h.height(r.height());r.after(h).hide()}else h=r.css(O).show(),ua=!1,null===a.shade&&(a.shade=!0);ka(h,a.boxWidth,a.boxHeight);var v=h.width(),u=h.height(),I=f("<div />").width(v).height(u).addClass(a.baseClass+"-holder").css({position:"relative",
backgroundColor:a.bgColor}).insertAfter(r).append(h);a.addClass&&I.addClass(a.addClass);var L=f("<div />"),Z=f("<div />").width("100%").height("100%").css({zIndex:310,position:"absolute",overflow:"hidden"}),P=f("<div />").width("100%").height("100%").css("zIndex",320),Q=f("<div />").css({position:"absolute",zIndex:600}).dblclick(function(){var b=w.getFixed();a.onDblClick.call(D,b)}).insertBefore(h).append(Z,P);ua&&(L=f("<img />").attr("src",h.attr("src")).css(O).width(v).height(u),Z.append(L));ta&&
Q.css({overflowY:"hidden"});var R=a.boundary,M=ma().width(v+2*R).height(u+2*R).css({position:"absolute",top:g(-R),left:g(-R),zIndex:290}).mousedown(la),sa=a.bgColor,T=a.bgOpacity,U,V,W,X,x,y,N,fa,ya;J=G(h);var E=function(){function b(){var a={},b=["touchstart","touchmove","touchend"],c=document.createElement("div"),e;try{for(e=0;e<b.length;e++){var d=b[e],d="on"+d,k=d in c;k||(c.setAttribute(d,"return;"),k="function"==typeof c[d]);a[b[e]]=k}return a.touchstart&&a.touchend&&a.touchmove}catch(f){return!1}}
var d;d=!0===a.touchSupport||!1===a.touchSupport?a.touchSupport:b();return{createDragger:function(b){return function(d){if(a.disabled||"move"===b&&!a.allowMove)return!1;J=G(h);N=!0;ga(b,C(E.cfilter(d)),!0);d.stopPropagation();d.preventDefault();return!1}},newSelection:function(a){return la(E.cfilter(a))},cfilter:function(a){a.pageX=a.originalEvent.changedTouches[0].pageX;a.pageY=a.originalEvent.changedTouches[0].pageY;return a},isSupported:b,support:d}}(),w=function(){function b(){if(!a.aspectRatio){var p=
n-c,b=k-e;U&&Math.abs(p)>U&&(n=0<p?c+U:c-U);V&&Math.abs(b)>V&&(k=0<b?e+V:e-V);X/y&&Math.abs(b)<X/y&&(k=0<b?e+X/y:e-X/y);W/x&&Math.abs(p)<W/x&&(n=0<p?c+W/x:c-W/x);0>c&&(n-=c,c-=c);0>e&&(k-=e,e-=e);0>n&&(c-=n,n-=n);0>k&&(e-=k,k-=k);n>v&&(p=n-v,c-=p,n-=p);k>u&&(p=k-u,e-=p,k-=p);c>v&&(p=c-u,k-=p,e-=p);e>u&&(p=e-u,k-=p,e-=p);return m(f(c,e,n,k))}var p=a.aspectRatio,b=a.minSize[0]/x,d=a.maxSize[0]/x,h=n-c,g=k-e,q=Math.abs(h),l=Math.abs(g);0===d&&(d=10*v);q/l<p?(q=k,l*=p,l=0>h?c-l:l+c,0>l?(l=0,q=Math.abs((l-
c)/p),q=0>g?e-q:q+e):l>v&&(l=v,q=Math.abs((l-c)/p),q=0>g?e-q:q+e)):(l=n,q/=p,q=0>g?e-q:e+q,0>q?(q=0,l=Math.abs((q-e)*p),l=0>h?c-l:l+c):q>u&&(q=u,l=Math.abs(q-e)*p,l=0>h?c-l:l+c));l>c?(l-c<b?l=c+b:l-c>d&&(l=c+d),q=q>e?e+(l-c)/p:e-(l-c)/p):l<c&&(c-l<b?l=c-b:c-l>d&&(l=c-d),q=q>e?e+(c-l)/p:e-(c-l)/p);0>l?(c-=l,l=0):l>v&&(c-=l-v,l=v);0>q?(e-=q,q=0):q>u&&(e-=q-u,q=u);return m(f(c,e,l,q))}function d(a){0>a[0]&&(a[0]=0);0>a[1]&&(a[1]=0);a[0]>v&&(a[0]=v);a[1]>u&&(a[1]=u);return[Math.round(a[0]),Math.round(a[1])]}
function f(a,b,c,e){var d=a,q=c,l=b,k=e;c<a&&(d=c,q=a);e<b&&(l=e,k=b);return[d,l,q,k]}function m(a){return{x:a[0],y:a[1],x2:a[2],y2:a[3],w:a[2]-a[0],h:a[3]-a[1]}}var c=0,e=0,n=0,k=0,h,g;return{flipCoords:f,setPressed:function(a){a=d(a);n=c=a[0];k=e=a[1]},setCurrent:function(a){a=d(a);h=a[0]-n;g=a[1]-k;n=a[0];k=a[1]},getOffset:function(){return[h,g]},moveOffset:function(a){var b=a[0];a=a[1];0>c+b&&(b-=b+c);0>e+a&&(a-=a+e);u<k+a&&(a+=u-(k+a));v<n+b&&(b+=v-(n+b));c+=b;n+=b;e+=a;k+=a},getCorner:function(a){var c=
b();switch(a){case "ne":return[c.x2,c.y];case "nw":return[c.x,c.y];case "se":return[c.x2,c.y2];case "sw":return[c.x,c.y2]}},getFixed:b}}(),K=function(){function b(){return d(w.getFixed())}function d(a){p.top.css({left:g(a.x),width:g(a.w),height:g(a.y)});p.bottom.css({top:g(a.y2),left:g(a.x),width:g(a.w),height:g(u-a.y2)});p.right.css({left:g(a.x2),width:g(v-a.x2)});p.left.css({width:g(a.x)})}function t(){return f("<div />").css({position:"absolute",backgroundColor:a.shadeColor||a.bgColor}).appendTo(r)}
function ia(){Y||(Y=!0,r.insertBefore(h),b(),m.setBgOpacity(1,0,1),L.hide(),c(a.shadeColor||a.bgColor,1),m.isAwake()?n(a.bgOpacity,1):n(1,1))}function c(a,b){da(k(),a,b)}function e(){Y&&(r.remove(),L.show(),Y=!1,m.isAwake()?m.setBgOpacity(a.bgOpacity,1,1):(m.setBgOpacity(1,1,1),m.disableHandles()),da(I,0,1))}function n(b,c){Y&&(a.bgFade&&!c?r.animate({opacity:1-b},{queue:!1,duration:a.fadeTime}):r.css({opacity:1-b}))}function k(){return r.children()}var Y=!1,r=f("<div />").css({position:"absolute",
zIndex:240,opacity:0}),p={top:t(),left:t().height(u),right:t().height(u),bottom:t()};return{update:b,updateRaw:d,getShades:k,setBgColor:c,enable:ia,disable:e,resize:function(a,b){p.left.css({height:g(b)});p.right.css({height:g(b)})},refresh:function(){a.shade?ia():e();m.isAwake()&&n(a.bgOpacity)},opacity:n}}(),m=function(){function b(a,b){var c=f("<div />").mousedown(ja(a)).css({cursor:a+"-resize",position:"absolute",zIndex:b}).addClass("ord-"+a);E.support&&c.bind("touchstart.jcrop",E.createDragger(a));
P.append(c);return c}function d(a){var c;for(c=0;c<a.length;c++)b(a[c],x++).addClass("jcrop-dragbar")}function t(b){var c,e;for(e=0;e<b.length;e++){switch(b[e]){case "n":c="hline";break;case "s":c="hline bottom";break;case "e":c="vline right";break;case "w":c="vline"}var d=c,d=f("<div />").css({position:"absolute",opacity:a.borderOpacity}).addClass(a.baseClass+"-"+d);Z.append(d)}}function m(c){var e;for(e=0;e<c.length;e++){var d=a.handleSize,k=b(c[e],x++).css({opacity:a.handleOpacity}).addClass(a.baseClass+
"-handle");d&&k.width(d).height(d)}}function c(){var a=w.getFixed();w.setPressed([a.x,a.y]);w.setCurrent([a.x2,a.y2]);e()}function e(a){if(r)return n(a)}function n(c){var b=w.getFixed(),e=b.h;Q.width(Math.round(b.w)).height(Math.round(e));var e=b.x,d=b.y;a.shade||L.css({top:g(-d),left:g(-e)});Q.css({top:g(d),left:g(e)});a.shade&&K.updateRaw(b);r||(Q.show(),a.shade?K.opacity(T):k(T,!0),r=!0);c?a.onSelect.call(D,S(b)):a.onChange.call(D,S(b))}function k(b,c,e){if(r||c)a.bgFade&&!e?h.animate({opacity:b},
{queue:!1,duration:a.fadeTime}):h.css("opacity",b)}function u(){y=!0;if(a.allowResize)return P.show(),!0}function v(){y=!1;P.hide()}function p(a){a?(fa=!0,v()):(fa=!1,u())}var r,x=370,y=!1;a.dragEdges&&f.isArray(a.createDragbars)&&d(a.createDragbars);f.isArray(a.createHandles)&&m(a.createHandles);a.drawBorders&&f.isArray(a.createBorders)&&t(a.createBorders);f(document).bind("touchstart.jcrop-ios",function(a){f(a.currentTarget).hasClass("jcrop-tracker")&&a.stopPropagation()});var A=ma().mousedown(ja("move")).css({cursor:"move",
position:"absolute",zIndex:360});E.support&&A.bind("touchstart.jcrop",E.createDragger("move"));Z.append(A);v();return{updateVisible:e,update:n,release:function(){v();Q.hide();a.shade?K.opacity(1):k(1);r=!1;a.onRelease.call(D)},refresh:c,isAwake:function(){return r},setCursor:function(a){A.css("cursor",a)},enableHandles:u,enableOnly:function(){y=!0},showHandles:function(){y&&P.show()},disableHandles:v,animMode:p,setBgOpacity:k,done:function(){p(!1);c()}}}(),F=function(){function b(a){c(C(a));return!1}
function d(b){b.preventDefault();b.stopPropagation();N&&(N=!1,e(C(b)),m.isAwake()&&a.onSelect.call(D,S(w.getFixed())),M.css({zIndex:290}),f(document).unbind(".jcrop"),c=function(){},e=function(){});return!1}function t(a){c(C(E.cfilter(a)));return!1}function g(a){return d(E.cfilter(a))}var c=function(){},e=function(){},n=a.trackDocument;n||M.mousemove(b).mouseup(d).mouseout(d);h.before(M);return{activateHandlers:function(a,m,h){N=!0;c=a;e=m;M.css({zIndex:450});h?f(document).bind("touchmove.jcrop",
t).bind("touchend.jcrop",g):n&&f(document).bind("mousemove.jcrop",b).bind("mouseup.jcrop",d);return!1},setCursor:function(a){M.css("cursor",a)}}}(),ba=function(){function b(a){g.hide()}function d(b,c,d){a.allowMove&&(w.moveOffset([c,d]),m.updateVisible(!0));b.preventDefault();b.stopPropagation()}function t(b){if(b.ctrlKey||b.metaKey)return!0;var c=(ya=b.shiftKey?!0:!1)?10:1;switch(b.keyCode){case 37:d(b,-c,0);break;case 39:d(b,c,0);break;case 38:d(b,0,-c);break;case 40:d(b,0,c);break;case 27:a.allowSelect&&
m.release();break;case 9:return!0}return!1}var g=f('<input type="radio" />').css({position:"fixed",left:"-120px",width:"12px"}).addClass("jcrop-keymgr"),c=f("<div />").css({position:"absolute",overflow:"hidden"}).append(g);a.keySupport&&(g.keydown(t).blur(b),ta||!a.fixedSupport?(g.css({position:"absolute",left:"-20px"}),c.append(g).insertBefore(h)):g.insertBefore(h));return{watchKeys:function(){a.keySupport&&(g.show(),g.focus())}}}();E.support&&M.bind("touchstart.jcrop",E.newSelection);P.hide();ca(!0);
var D={setImage:function(b,d){m.release();qa();var f=new Image;f.onload=function(){var g=f.height,c=a.boxWidth,e=a.boxHeight;h.width(f.width).height(g);h.attr("src",b);L.attr("src",b);ka(h,c,e);v=h.width();u=h.height();L.width(v).height(u);M.width(v+2*R).height(u+2*R);I.width(v).height(u);K.resize(v,u);ra();"function"===typeof d&&d.call(D)};f.src=b},animateTo:function(b,d){var f=b[0]/x,g=b[1]/y,c=b[2]/x,e=b[3]/y;if(!fa){var n=w.flipCoords(f,g,c,e),k=w.getFixed(),h=[k.x,k.y,k.x2,k.y2],r=a.animationDelay,
p=n[0]-h[0],u=n[1]-h[1],v=n[2]-h[2],z=n[3]-h[3],A=0,q=a.swingSpeed,f=h[0],g=h[1],c=h[2],e=h[3];m.animMode(!0);var l=function(){return function(){A+=(100-A)/q;h[0]=Math.round(f+A/100*p);h[1]=Math.round(g+A/100*u);h[2]=Math.round(c+A/100*v);h[3]=Math.round(e+A/100*z);99.8<=A&&(A=100);100>A?(pa(h),window.setTimeout(l,r)):(m.done(),m.animMode(!1),"function"===typeof d&&d.call(D))}}();window.setTimeout(l,r)}},setSelect:oa,setOptions:function(a){H(a);ca()},tellSelect:function(){return S(w.getFixed())},
tellScaled:function(){return w.getFixed()},setClass:function(b){I.removeClass().addClass(a.baseClass+"-holder").addClass(b)},disable:qa,enable:ra,cancel:function(){m.done();F.activateHandlers(null,null)},release:m.release,destroy:function(){I.remove();r.show();r.css("visibility","visible");f(z).removeData("Jcrop")},focus:ba.watchKeys,getBounds:function(){return[v*x,u*y]},getWidgetSize:function(){return[v,u]},getScaleFactor:function(){return[x,y]},getOptions:function(){return a},ui:{holder:I,selection:Q}};
na&&I.bind("selectstart",function(){return!1});r.data("Jcrop",D);return D};f.fn.Jcrop=function(z,B){var g;this.each(function(){if(f(this).data("Jcrop")){if("api"===z)return f(this).data("Jcrop");f(this).data("Jcrop").setOptions(z)}else"IMG"==this.tagName?f.Jcrop.Loader(this,function(){f(this).css({display:"block",visibility:"hidden"});g=f.Jcrop(this,z);f.isFunction(B)&&B.call(g)}):(f(this).css({display:"block",visibility:"hidden"}),g=f.Jcrop(this,z),f.isFunction(B)&&B.call(g))});return this};f.Jcrop.Loader=
function(z,B,g){function G(){H.complete?(C.unbind(".jcloader"),f.isFunction(B)&&B.call(H)):window.setTimeout(G,50)}var C=f(z),H=C[0];C.bind("load.jcloader",G).bind("error.jcloader",function(z){C.unbind(".jcloader");f.isFunction(g)&&g.call(H)});H.complete&&f.isFunction(B)&&(C.unbind(".jcloader"),B.call(H))};f.Jcrop.defaults={allowSelect:!0,allowMove:!0,allowResize:!0,trackDocument:!0,baseClass:"jcrop",addClass:null,bgColor:"black",bgOpacity:.6,bgFade:!1,borderOpacity:.4,handleOpacity:.5,handleSize:null,
aspectRatio:0,keySupport:!0,createHandles:"n s e w nw ne se sw".split(" "),createDragbars:["n","s","e","w"],createBorders:["n","s","e","w"],drawBorders:!0,dragEdges:!0,fixedSupport:!0,touchSupport:null,shade:null,boxWidth:0,boxHeight:0,boundary:2,fadeTime:400,animationDelay:20,swingSpeed:3,minSelect:[0,0],maxSize:[0,0],minSize:[0,0],onChange:function(){},onSelect:function(){},onDblClick:function(){},onRelease:function(){}}})(jQuery);


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