/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.language = 'en';
	
	config.extraPlugins = 'youtube,qrc,autogrow,wenzgmap,slideshow';
	
	var roxyFileman = '../module/xcrud/plugins/fileman/index.html'; 
	
	config.filebrowserBrowseUrl=roxyFileman;
	config.filebrowserImageBrowseUrl=roxyFileman+'?type=image';
	
};

CKEDITOR.config.allowedContent = true;


//set your custom font here and don't forget to call it in same folder css file 
CKEDITOR.config.font_names = 'Arial, Helvetica, sans-serif;' + 'Open Sans, sans-serif;' + 'FontAwesome;' ;

CKEDITOR.replaceAll('editor-instance');
