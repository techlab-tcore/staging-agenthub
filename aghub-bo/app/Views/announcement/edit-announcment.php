<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <a class="btn btn-danger bg-gradient shadow" href="<?=base_url('announcement');?>"><?=lang('Nav.b2annc');?></a>
        </div>

        <article class="card-text p-3">
            <?=form_open('',['class'=>'form-validation editAnncForm', 'novalidate'=>'novalidate']);?>
            <div class="mb-3">
                <label class="d-block"><?=lang('Input.status');?></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="astatus_yes" value="1">
                    <label class="form-check-label" for="astatus_yes"><?=lang('Label.active');?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="astatus_no" value="2" checked>
                    <label class="form-check-label" for="astatus_no"><?=lang('Label.inactive');?></label>
                </div>
            </div>
            <div class="mb-3">
                <label class="d-block"><?=lang('Input.usergroup');?></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="trole" id="role_agent" value="3">
                    <label class="form-check-label" for="role_agent"><?=lang('Label.agent');?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="trole" id="role_subacc" value="5">
                    <label class="form-check-label" for="role_subacc"><?=lang('Label.subacc');?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="trole" id="role_member" value="4">
                    <label class="form-check-label" for="role_member"><?=lang('Label.member');?></label>
                </div>
            </div>
            <div class="mb-3">
                <label class="d-block"><?=lang('Input.popup');?></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="popup" id="pyes2" value="1" checked>
                    <label class="form-check-label" for="pyes2"><?=lang('Label.yes');?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="popup" id="pno2" value="2" disabled>
                    <label class="form-check-label" for="pno2"><?=lang('Label.no');?></label>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEN" aria-expanded="false" aria-controls="collapseEN"><?=lang('Input.content');?> - ENGLISH</button>
                    <article class="card-body collapse show p-0" id="collapseEN">
                        <textarea class="form-control" name="en" id="annEN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMY" aria-expanded="false" aria-controls="collapseMY"><?=lang('Input.content');?> - BAHASA</button>
                    <article class="card-body collapse p-0" id="collapseMY">
                        <textarea class="form-control" name="my" id="annMY"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCN" aria-expanded="false" aria-controls="collapseCN"><?=lang('Input.content');?> - 简体中文</button>
                    <article class="card-body collapse p-0" id="collapseCN">
                        <textarea class="form-control" name="cn" id="annCN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTH" aria-expanded="false" aria-controls="collapseTH"><?=lang('Input.content');?> - ไทย</button>
                    <article class="card-body collapse p-0" id="collapseTH">
                        <textarea class="form-control" name="th" id="annTH"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVN" aria-expanded="false" aria-controls="collapseVN"><?=lang('Input.content');?> - TIẾNG VIỆT</button>
                    <article class="card-body collapse p-0" id="collapseVN">
                        <textarea class="form-control" name="vn" id="annVN"></textarea>
                    </article>
                </div>
            </div>
            <!--
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZH" aria-expanded="false" aria-controls="collapseZH"><?=lang('Input.content');?> - 繁体中文</button>
                    <article class="card-body collapse p-0" id="collapseZH">
                        <textarea class="form-control" name="zh" id="annZH"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBGL" aria-expanded="false" aria-controls="collapseBGL"><?=lang('Input.content');?> - বাংলা</button>
                    <article class="card-body collapse p-0" id="collapseBGL">
                        <textarea class="form-control" name="bgl" id="annBGL"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBUR" aria-expanded="false" aria-controls="collapseBUR"><?=lang('Input.content');?> - BURMESE</button>
                    <article class="card-body collapse p-0" id="collapseBUR">
                        <textarea class="form-control" name="bur" id="annBUR"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIN" aria-expanded="false" aria-controls="collapseIN"><?=lang('Input.content');?> - INDONESIA</button>
                    <article class="card-body collapse p-0" id="collapseIN">
                        <textarea class="form-control" name="in" id="annIN"></textarea>
                    </article>
                </div>
            </div>
            -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
            </div>
            <?=form_close();?>
        </article>
    </div>
</section>

<script src="<?=base_url('assets/vendors/ckeditor5/build/ckeditor.js');?>"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    getPromo();

    $('.editAnncForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            const roles = [];
            $.each($(".editAnncForm [name=trole]:checked"), function() {
                roles.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['id'] = '<?=$anncid;?>';
            });

            $.post('/announcement/modify', {
                params,roles
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { $('#announcementTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                // $('.editAnncForm').trigger('reset');
                // $('.editAnncForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function getPromo()
{
    generalLoading();

    var params = {};
    params['id'] = '<?=$anncid;?>';

    $.post('/announcement/sent/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.editAnncForm [name=id]').val(btoa(obj.data.id));

            obj.data.targetRole.forEach(item => {
                if( item==3 ) { $('.editAnncForm [name=trole]#role_agent').prop('checked', true); }
                if( item==4 ) { $('.editAnncForm [name=trole]#role_member').prop('checked', true); }
                if( item==5 ) { $('.editAnncForm [name=trole]#role_subacc').prop('checked', true); }
            });

            obj.data.popUp==1 ? $('.editAnncForm [name=popup]#pyes').prop('checked', true) : $('.editAnncForm [name=popup]#pno').prop('checked', true);
            obj.data.status==1 ? $('.editAnncForm [name=status]#astatus_yes').prop('checked', true) : $('.editAnncForm [name=status]#astatus_no').prop('checked', true);

            obj.data.content.EN==null ? editorEN.data.set('') : editorEN.data.set(obj.data.content.EN);
            obj.data.content.MY==null ? editorMY.data.set('') : editorMY.data.set(obj.data.content.MY);
            obj.data.content.CN==null ? editorCN.data.set('') : editorCN.data.set(obj.data.content.CN);
            // obj.data.content.ZH==null ? editorZH.data.set('') : editorZH.data.set(obj.data.content.ZH);
            obj.data.content.TH==null ? editorTH.data.set('') : editorTH.data.set(obj.data.content.TH);
            obj.data.content.VN==null ? editorVN.data.set('') : editorVN.data.set(obj.data.content.VN);
            // obj.data.content.BGL==null ? editorBGL.data.set('') : editorBGL.data.set(obj.data.content.BGL);
            // obj.data.content.BUR==null ? editorBUR.data.set('') : editorBUR.data.set(obj.data.content.BUR);
            // obj.data.content.IN==null ? editorIN.data.set('') : editorIN.data.set(obj.data.content.IN);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

let editorEN, editorMY, editorCN, editorZH, editorTH, editorVN, editorBGL, editorBUR, editorIN;
ClassicEditor.create(document.querySelector('#annEN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorEN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#annMY'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorMY = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#annCN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorCN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#annTH'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorTH = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#annVN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorVN = editor;
})
.catch( error => {
    console.error( error );
});
</script>