
CKEDITOR.editorConfig = function( config ) {

	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	];

	config.removeButtons = 'Image,Underline,Subscript,Superscript,SpecialChar,HorizontalRule,Blockquote,Strike,Outdent,Indent,Source,ImageButton';

	config.format_tags = 'p;h1;h2;h3;pre';

	config.removePlugins = 'image,pwimage';
	config.removePlugins = 'pwimage';
	config.removePlugins = 'image';
	

	config.removeDialogTabs = 'image:advanced;image:Link,link:upload;image:Upload';



};
