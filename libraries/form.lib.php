<?php

/*
	
	Form creation class

	usage   : Static
	version : 1
	author  : Nick Sheffield

*/

class Form{

	/**
	*	Creates a <form> open tag
	*
	*	@param 	string $action The url for the form to post to
	*	@param 	string $method Either "post" or "get"
	*
	*	@return string $html The completed <form> tag
	*
	**/
	public static function open($action = '', $method = 'post', $extras = ''){
		$html = "<form action='$action' method='$method' $extras>";
		return $html;
	}
	/**
	*	Creates a <form enctype='multipart/form-data'> open tag (for file uploading)
	*
	*	@param 	string $action The url for the form to post to
	*
	*	@return string $html The completed <form enctype='multipart/form-data'> tag
	*
	**/
	public static function open_multipart($action = ''){
		$html = "<form action='$action' method='post' enctype='multipart/form-data'>";
		return $html;
	}
	/**
	*	Creates a </form> close tag
	*
	*	@return string $html The completed </form> tag
	*
	**/
	public static function close(){
		$html = '</form>';
		return $html;
	}
	/**
	*	Creates a <input> tag
	*
	*	@param 	string $type 	The type of input it will be
	*	@param 	string $name 	The name of the input
	*	@param 	string $value 	The value of the input (optional)
	*	@param 	string $extras 	Any extra features (optional)
	*
	*	@return string $html The completed <input> tag
	*
	**/
	public static function input($type, $name, $value = '', $extras = ''){
		$html = "<input type='$type' id='$name' name='$name' value='$value' $extras>";
		return $html;
	}
	/**
	*	Creates a <label> tag
	*
	*	@param 	string $for 	Which named input is the label for
	*	@param 	string $text 	What the label will say
	*
	*	@return string $html The completed <label> tag
	*
	**/
	public static function label($for, $text, $extras = ''){
		$html = "<label for='$for' $extras>$text</label>";
		return $html;
	}
	/**
	*	Creates a <textarea> tag
	*
	*	@param 	string $name 	The name of the textarea
	*	@param 	string $value 	The value of the textarea (optional)
	*
	*	@return string $html The completed <textarea> tag
	*
	**/
	public static function textarea($name, $value = '', $extras = ''){
		$html = "<textarea id='$name' name='$name' $extras>$value</textarea>";
		return $html;
	}
	/**
	*	Creates multiple <option> tags with one selected by default
	*
	*	@param 	string $values 			The values of the options
	*	@param 	string $pre_selected 	The previously selected option
	*
	*	@return string $html The completed <textarea> tag
	*
	**/
	public static function options($values, $pre_selected){
		$html = '';
		foreach($values as $value => $text){
			
			$selected = $pre_selected == $value ? 'selected' : '';
			
			$html .= "<option value='$value' $selected>$text</option>";
		}
		return $html;
	}
	/**
	*	Creates a <select> tag that include the options function
	*
	*	@param 	string $name 			The name of the select
	*	@param 	string $value 			The values of the select (optional)
	*	@param 	string $pre_selected 	The previously selected option
	*
	*	@return string $html The completed <select> tag
	*
	**/
	public static function select($name, $values, $pre_selected, $extras = ''){
		$html = "<select name='$name' id='$name' $extras>";
		$html .= self::options($values, $pre_selected);
		$html .= '</select>';
		return $html;
	}

	/* Shortcut functions for common input types */

	/**
	*	Creates a <input type="hidden"> tag
	*
	*	@param 	string $name	The name of the input
	*	@param 	string $value 	The value of the input
	*
	*	@return string $html The completed <input type="hidden"> tag
	*
	**/
	public static function hidden($name, $value){
		$html = self::input('hidden', $name, $value);
		return $html;
	}
	/**
	*	Creates a <input type="text"> tag
	*
	*	@param 	string $name	The name of the input
	*	@param 	string $value 	The value of the input (optional)
	*
	*	@return string $html The completed <input type="text"> tag
	*
	**/
	public static function text($name, $value = ''){
		$html = self::input('text', $name, $value);
		return $html;
	}
	/**
	*	Creates a <input type="password"> tag
	*
	*	@param 	string $name	The name of the input
	*	@param 	string $value 	The value of the input (optional)
	*
	*	@return string $html The completed <input type="text"> tag
	*
	**/
	public static function password($name, $value = ''){
		$html = self::input('password', $name, $value);
		return $html;
	}
	/**
	*	Creates a <input type="file"> tag that allows for multiple uploads
	*
	*	@param 	string $name	The name of the input, set to 'file' by default
	*	@param 	string $value 	The value of the input (optional)
	*
	*	@return string $html The completed <input type="file"> tag
	*
	**/
	public static function file($name = 'file', $multiple = ''){
		$html = self::input('file', $name.'[]', '', $multiple);
		return $html;
	}
	/**
	*	Creates a <input type="submit"> tag
	*
	*	@param 	string $text The text of the submit button, set to 'Submit' by default
	*
	*	@return string $html The completed <input type="submit"> tag
	*
	**/
	public static function submit($text = 'Submit', $extras = ''){
		$html = self::input('submit', '', $text, $extras);
		return $html;
	}
	/**
	*	Creates a <input type="hidden" name="MAX_FILE_SIZE" value="4194304"> tag
	*
	*	@param 	string $size 	The size of the value, set to '4194304' by default
	*
	*	@return string $html The completed <input type="hidden" name="MAX_FILE_SIZE" value="4194304"> tag
	*
	**/
	public static function max_file_size($size = '4194304'){
		$html = self::hidden('MAX_FILE_SIZE', $size);
		return $html;
	}
	/**
	*	Creates a <input type="number"> tag
	*
	*	@param 	string $name 	The name of the input
	*	@param 	string $value 	The value of the input (optional)
	*	@param 	string $extras 	Any extra features (optional)
	*
	*	@return string $html The completed <input type="number"> tag
	*
	**/
	public static function number($name, $value = '', $extras = ''){
		$html = self::input('number', $name, $value, $extras);
		return $html;
	}

	public function radio($name, $value, $extras = ''){
		$html = self::input('radio', $name, $value, $extras);
		return $html;
	}
}