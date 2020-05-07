/**
 * Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// This file contains style definitions that can be used by CKEditor plugins.
//
// The most common use for it is the "stylescombo" plugin, which shows a combo
// in the editor toolbar, containing all styles. Other plugins instead, like
// the div plugin, use a subset of the styles on their feature.
//
// If you don't have plugins that depend on this file, you can simply ignore it.
// Otherwise it is strongly recommended to customize this file to match your
// website requirements and design properly.

CKEDITOR.stylesSet.add( 'default', [
	/* Block Styles */

	// These styles are already available in the "Format" combo ("format" plugin),
	// so they are not needed here by default. You may enable them to avoid
	// placing the "Format" combo in the toolbar, maintaining the same features.
	/*
	{ name: 'Paragraph',		element: 'p' },
	{ name: 'Heading 1',		element: 'h1' },
	{ name: 'Heading 2',		element: 'h2' },
	{ name: 'Heading 3',		element: 'h3' },
	{ name: 'Heading 4',		element: 'h4' },
	{ name: 'Heading 5',		element: 'h5' },
	{ name: 'Heading 6',		element: 'h6' },
	{ name: 'Preformatted Text',element: 'pre' },
	{ name: 'Address',			element: 'address' },
	*/
	
	{ name: 'font-weight 100',			element: 'span', styles: { 'font-weight': '100'} },
	{ name: 'font-weight 200',			element: 'span', styles: { 'font-weight': '200'} },
	{ name: 'font-weight 300',			element: 'span', styles: { 'font-weight': '300'} },
	{ name: 'font-weight 400',			element: 'span', styles: { 'font-weight': '400'} },
	{ name: 'font-weight 500',			element: 'span', styles: { 'font-weight': '500'} },
	{ name: 'font-weight 600',			element: 'span', styles: { 'font-weight': '600'} },
	{ name: 'font-weight 700',			element: 'span', styles: { 'font-weight': '700'} },
	{ name: 'font-weight 800',			element: 'span', styles: { 'font-weight': '800'} },
	{ name: 'font-weight 900',			element: 'span', styles: { 'font-weight': '900'} },
	{ name: 'font-weight bold',			element: 'span', styles: { 'font-weight': 'bold'} },
	{ name: 'italic',			        element: 'span', styles: { 'font-style': 'italic'} },
	
	{ name: 'word spacing closer',			element: 'span', styles: { 'word-spacing': '-2px'} },
	{ name: 'word spacing close',			element: 'span', styles: { 'word-spacing': '-1px'} },
	{ name: 'word spacing normal',			element: 'span', styles: { 'word-spacing': '0px'} },
	{ name: 'word spacing far',			    element: 'span', styles: { 'word-spacing': '1px'} },
	{ name: 'word spacing further',			element: 'span', styles: { 'word-spacing': '2px'} },
	
	{ name: 'letter spacing closer',			element: 'span', styles: { 'letter-spacing': '-2px'} },
	{ name: 'letter spacing close',			    element: 'span', styles: { 'letter-spacing': '-1px'} },
	{ name: 'letter spacing normal',			element: 'span', styles: { 'letter-spacing': '0px'} },
	{ name: 'letter spacing far',			    element: 'span', styles: { 'letter-spacing': '1px'} },
	{ name: 'letter spacing further',			element: 'span', styles: { 'letter-spacing': '2px'} },
	
	{ name: 'line height 12px',			element: 'span', styles: { 'line-height': '12px'} },
	{ name: 'line height 16px',			    element: 'span', styles: { 'line-height': '16px'} },
	{ name: 'line height 24px',			element: 'span', styles: { 'line-height': '24px'} },
	{ name: 'line height 28px',			    element: 'span', styles: { 'line-height': '28px'} },
	{ name: 'line height 32px',			element: 'span', styles: { 'line-height': '32px'} },
	
	//{ name: 'why us - subtitle',  element: 'h4', styles: { 'display': 'inline-block', 'padding-bottom': '10px', 'border-bottom': '5px solid #555', 'color': '#555', 'font-weight': '300', 'font-size': '30px' } },

	//{ name: 'Italic Title',		element: 'h2', styles: { 'font-style': 'italic' } },
	//{ name: 'Subtitle',			element: 'h3', styles: { 'color': '#aaa', 'font-style': 'italic' } },
	
	//{
	//	name: 'Special Container',
	//	element: 'div',
	//	styles: {
	//		padding: '5px 10px',
	//		background: '#eee',
	//		border: '1px solid #ccc'
	//	}
	//},

	/* Inline Styles */

	// These are core styles available as toolbar buttons. You may opt enabling
	// some of them in the Styles combo, removing them from the toolbar.
	// (This requires the "stylescombo" plugin)
	/*
	{ name: 'Strong',			element: 'strong', overrides: 'b' },
	{ name: 'Emphasis',			element: 'em'	, overrides: 'i' },
	{ name: 'Underline',		element: 'u' },
	{ name: 'Strikethrough',	element: 'strike' },
	{ name: 'Subscript',		element: 'sub' },
	{ name: 'Superscript',		element: 'sup' },
	*/

	//{ name: 'Marker',			element: 'span', attributes: { 'class': 'marker' } },

	//{ name: 'Big',				element: 'big' },
	//{ name: 'Small',			element: 'small' },
	//{ name: 'Typewriter',		element: 'tt' },

	//{ name: 'Computer Code',	element: 'code' },
	//{ name: 'Keyboard Phrase',	element: 'kbd' },
	//{ name: 'Sample Text',		element: 'samp' },
	//{ name: 'Variable',			element: 'var' },

	//{ name: 'Deleted Text',		element: 'del' },
	//{ name: 'Inserted Text',	element: 'ins' },

	//{ name: 'Cited Work',		element: 'cite' },
	//{ name: 'Inline Quotation',	element: 'q' },

	//{ name: 'Language: RTL',	element: 'span', attributes: { 'dir': 'rtl' } },
	//{ name: 'Language: LTR',	element: 'span', attributes: { 'dir': 'ltr' } },

	/* Object Styles */

	//{
	//	name: 'Styled image (left)',
	//	element: 'img',
	//	attributes: { 'class': 'left' }
	//},

	//{
	//	name: 'Styled image (right)',
	//	element: 'img',
	//	attributes: { 'class': 'right' }
	//},

	//{
	//	name: 'Compact table',
	//	element: 'table',
	//	attributes: {
	//		cellpadding: '5',
	//		cellspacing: '0',
	//		border: '1',
	//		bordercolor: '#ccc'
	//	},
	//	styles: {
	//		'border-collapse': 'collapse'
	//	}
	//},

	//{ name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
	//{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } }
] );

