$(document).ready(function () {
    if ($('.ck-editor').length) {
        $('.ck-editor').each(function (i) {
            i++;
            let idEditor   = `editor-${i}`;
            let idToolbar  = `toolbar-container-${i}`;
            let idTextarea = 'textarea-' + idEditor;
            $(this).find('textarea').attr('id', idTextarea);

            if (!$('#' + idEditor).length) {
                $(this).find('.editor').attr('id', idEditor);
                $(this).find('.toolbar-container').attr('id', idToolbar);
                createEditor(idEditor, idToolbar, idTextarea);
                $('.modal').modal( {
                    focus: false,
                    show: false
                } );
            }
        });
    }

    function createEditor(idEditor, idToolbar, idTextarea) {
        return DecoupledEditor
            .create( document.getElementById( idEditor ), {
                forcePasteAsPlainText : true,
            })
            .then( editor => {
                const toolbarContainer = document.getElementById( idToolbar );
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                editors[ idEditor ] = editor;
                editor.setData($('#' + idTextarea).val());

                editor.model.schema.addAttributeCheck( ( ctx, attributeName ) => {
                    if ( ctx.startsWith( '$clipboardHolder' ) ) {
                        return false;
                    }
                } );
            })
            .catch( error => {
            });
    }
})