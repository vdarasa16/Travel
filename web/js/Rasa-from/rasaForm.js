(function($){
	$.fn.rasaForm = function(option)
	{
		var defaultOption = [];
		var settings = $.merge(option, defaultOption);
		
		if($(this).length == 0)
			return null;
		else
		{
			var item = new RasaForm(this, settings);
			return item;
		}
	};
	
	$.fn.inputTag = function(setting)
	{
		if($(this).length == 0)
			return null;
		else
		{
			var item = new InputTag(this, setting);
			return item;
		}
	};
	
	$.fn.selectTag = function(validate)
	{
		if($(this).length == 0)
			return null;
		else
		{
			var item = new SelectTag(this, validate);
			return item;
		}
	};
	
	$.fn.textareaTag = function(setting)
	{
		if($(this).length == 0)
			return null;
		else
		{
			var item = new TextareaTag(this, setting);
			return item;
		}
	};
})(jQuery);

function Validate()
{
	this.checkNotNull = function(ele)
	{
		var value = ele.getValue();
		if(value.length != 0 && value != null)
			return true;
		return false;
	}
	
	this.checkNumberOnly = function(ele){
		var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
		var value = ele.getValue();
		if(numberRegex.test(value))
			return true;
		return false;
	}
	
	this.checkIntegerOnly = function(ele){
		var numberRegex = /^[+-]?\d+$/;
		var value = ele.getValue();
		if(numberRegex.test(value))
			return true;
		return false;
	}
	
	this.keyPassNumberOnly = function(ele){
		ele.getRoot().keypress(function(event){
			var value = ele.getValue();
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if ((keycode < 48 || keycode > 57) && keycode != 8 && keycode != 45 && keycode != 46)
				return false;

			if(keycode == 45 && value.length != 0)
				return false;
			
			if(keycode == 46)
			{
				var dot = /^([\-]?[0-9]+)$/;
				if(!dot.test(value))
					return false;
			}
			
			this.onKeyPress = String.fromCharCode(keycode);
		});
		
		this.setKeyToRefresh(ele);
	}
	
	this.keyPassIntegerOnly = function(ele){
		ele.getRoot().keypress(function(event){
			var value = ele.getValue();
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if ((keycode < 48 || keycode > 57) && keycode != 8 && keycode != 45)
				return false;
			
			if(keycode == 45 && value.length != 0)
				return false;
			
			this.onKeyPress = String.fromCharCode(keycode);
		});
		
		this.setKeyToRefresh(ele);
	}
	
	this.keyPassNotIn = function(ele, string){
		var splitString = string.split('');
		var ignorKey = [];
		var validator = this;
		
		$.each(splitString, function(index, value){
			ignorKey.push(value.charCodeAt(0));
		});
		
		ele.getRoot().keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(validator.inArray(keycode, ignorKey))	
				return false;
			
			this.onKeyPress = String.fromCharCode(keycode);
		});
	}
	
	this.setKeyToRefresh = function(ele){
		ele.getRoot().keydown(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if (keycode == 116)
				window.location.reload();
		});
	}
	
	this.inArray = function (needle, haystack) {
		var length = haystack.length;
		for(var i = 0; i < length; i++) {
			if(haystack[i] == needle) 
				return true;
		}
		return false;
	}
}
	
function RasaForm(wrapper, settings)
{
	this._root = $(wrapper);
	this._settings = settings;
	this._id = this._root.attr('id');
	this._inputElements = new Array(),
	this._defaultInputSetValue = {
		id: '', 
		value: ''
	}
	
	this._errorMessage = new Array();
	
	this.setInputElement = function(settings){
		var root = this;
		$.each(settings, function(index, obj){
			var sourceEle = $('#' + obj.id);
			var tagName = sourceEle.prop("tagName");
			var ele = false;
			if(tagName == 'INPUT')
				ele = sourceEle.inputTag(obj);
			else if(tagName == 'SELECT')
				ele = sourceEle.selectTag(obj);
			else if(tagName == 'TEXTAREA')
				ele = sourceEle.textareaTag(obj);
				
			if(ele)
				root._inputElements.push(ele);
		});
	}
	
	this.findInputElement = function(id)
	{
		var inputElements = this._inputElements;
		var result = null;
		$.each(inputElements, function(index, ele){
			if(ele.id == id)
			{
				result = ele;
			}
		});
			
		return result;
	}
	
	this.reset =  function(){
		$.each(this._inputElements, function(index, value){
			value.reset();
		});
	}
	
	this.setValue = function(values){
		var root = this;
		$.each(values, function(index, valueObj){
			valueObj = $.extend(false, root._defaultInputSetValue, valueObj);
			var input = root.findInput(valueObj.id);
			input.setValue(valueObj.value);
		});
	}
	
	this.validate = function(){
		var result = true;
		var errorMessage = new Array();
		$.each(this._inputElements, function(index, value){
			var inputValidate = value.validate();
			if(!inputValidate.result)
				errorMessage = $.merge(errorMessage, inputValidate.errorMessage);
				
			result = result && inputValidate.result;
		});
		
		this.errorMessage = errorMessage;
		return result;
	}
	
	this.getErrors = function(){
		return this._errorMessage;
	}
	
	this.findInput = function(id){
		var result = null;
		$.each(this._inputElements, function(index, input){
			if(input.getId() == id)
				result = input;
		});
	
		return result;
	}
	
	this.serialize = function(){
		var result = [];
		$.each(this._inputElements, function(index, input){
			var str = input.getName() + '=' + input.getValue();
			result.push(str);
		});
		
		return result.join('&');
	}
	
	this.getValue = function(id){
		var input = this.findInput(id);		
		return input.getValue();
	}
	
	this.setContents = function(contents){
		var root = this;
		$.each(contents, function(index, value){
			root.setContent(value.id, value.content);
		});
	}
	
	this.setContent = function(id, content){
		var input = this.findInput(id);
		input.setContent(content);
	}
	
	this.setInputElement(this._settings);
}

function Element(wrapper, setting)
{
	this._root = $(wrapper);
	this._id = this._root.attr('id');
	this._validator = new Validate();
	this._setting = setting;
	this._defaultValue = '';
	this._defaultSetting = {
		id: '', 
		validate: [], 
		defailtValue: ''
	};
	setting = $.extend(false, this._defaultSetting, setting);
		
	if(setting.defaultValue != '')
	{
		this._defaultValue = setting.defaultValue;
	}
	else
		this._defaultValue = this.getValue();
	
	this.getValue = function(){
		return '';
	};
	
	this.setValue = function(value){
		
	}
	
	this.reset =  function(){
		this.setValue(this._defaultValue);
	}
	
	this.validate = function(){
		var obj = this;
		var validate = this._setting.validate;
		var result = true;
		var errorMessage = [];
		$.each(validate, function(index, value){
			var token = true;
			var valueLower = value.toLowerCase();
			if(valueLower == 'not null')
			{
				token = obj._validator.checkNotNull(obj);
				result = result && token;
				if(!token)
					errorMessage.push('Can not be blank.');
			}
			else if(valueLower == 'number')
			{
				token = obj._validator.checkNumberOnly(obj);
				result = result && token;
				if(!token)
					errorMessage.push('Number only.');
			}
			else if(valueLower == 'integer')
			{
				token = obj._validator.checkIntegerOnly(obj);
				result = result && token;
				if(!token)
					errorMessage.push('Integer only.');
			}
		});
		return {
			'result': result, 
			'errorMessage': errorMessage
		};
	}
	
	this.setValidate = function(setting){
		var obj = this;
		$.each(setting, function(index, value){
			var firstChar = value.substring(0, 1);
			var valueLower = value.toLowerCase();
			if(valueLower == 'integer')
			{
				obj._validator.keyPassIntegerOnly(obj);
			}
			else if(valueLower == 'number')
			{
				obj._validator.keyPassNumberOnly(obj);
			}
			else if(firstChar == '!')
			{
				var otherChar = value.substring(1);
				obj._validator.keyPassNotIn(obj, otherChar);
			}
		});
	}
	
	this.getName = function(){
		var name = this._root.attr('name');
		if(typeof(name) == 'undefined')
			return this.getId();
		else
			return name;
	}
	
	this.getId = function(){
		return this._id;
	}
	
	this.getRoot = function(){
		return this._root;
	}
	
	this.setContent = function(content){
		this._root.html(content);
	}
}
	
function InputTag(wrapper, setting)
{
	Element.apply(this, arguments)
	
	this.getValue = function(){
		return this._root.val();
	}
	
	this.setValue = function(value){
		this._root.val(value);
	}
	
	this.setValue(this._setting.defaultValue);
	this.setValidate(this._setting.validate);
}
	
function SelectTag(wrapper, setting)
{
	Element.apply(this, arguments)
	
	this.getValue = function(){
		return this._root.val();
	}
	
	this.setValue = function(value){
		var optionFocus = this._findOptionValue(value);
		var allOption = this._root.find('option');
			
		allOption.removeAttr('selected');
		if(optionFocus !== false)
			optionFocus.attr('selected', true);
	}
	
	this._findOptionValue = function(value){
		var option = this._root.find('option[value="' + value + '"]');
		if(option.length == 1)
			return option;
		else
			return false;
	}
	
	this.setValidate = function(setting){}
	
	this.setValue(this._setting.defaultValue);
	this.setValidate(this._setting.validate);
}
	
function TextareaTag(wrapper, setting)
{
	Element.apply(this, arguments)
	
	this.getValue = function(){
		return this._root.val();
	}
	
	this.setValue = function(value){
		this._root.html(value);
	}
	
	this.setValue(this._setting.defaultValue);
	this.setValidate(this._setting.validate);
}