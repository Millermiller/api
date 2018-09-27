/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserUploadUrl = '/forum/uploadImage';
    config.toolbarGroups = [
        { name: 'clipboard',   groups: [ 'undo', 'clipboard' ] },
      //  { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        '/',
      //  { name: 'forms' },
       // { name: 'tools' },
      //  { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
     //   { name: 'others' },
     //   '/',
     //   { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'align' ] },

        { name: 'styles' },

        { name: 'colors' }
      ]
};
