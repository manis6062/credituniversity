/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    if(location.hostname == 'localhost'){

        config.filebrowserBrowseUrl = '/americacpn1.1/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=files';
        config.filebrowserImageBrowseUrl = '/americacpn1.1/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=images';
        config.filebrowserFlashBrowseUrl = '/americacpn1.1/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';
        config.filebrowserUploadUrl = '/americacpn1.1/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=files';
        config.filebrowserImageUploadUrl = '/americacpn1.1/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=images';
        config.filebrowserFlashUploadUrl = '/americacpn1.1/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';
    }
    else{
        config.filebrowserBrowseUrl = '/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=files';
        config.filebrowserImageBrowseUrl = '/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=images';
        config.filebrowserFlashBrowseUrl = '/backend/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';
        config.filebrowserUploadUrl = '/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=files';
        config.filebrowserImageUploadUrl = '/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=images';
        config.filebrowserFlashUploadUrl = '/backend/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';
    }
};
