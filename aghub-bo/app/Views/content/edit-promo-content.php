<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3 mb-3">
            <a class="btn btn-danger bg-gradient shadow" href="<?=base_url('settings/promotion');?>"><?=lang('Nav.b2promo');?></a>
        </div>

        <article class="card-text p-3">
            <?=form_open('',['class'=>'form-validation modifyPromoReadOnlyForm', 'id'=>'modifyPromoForm', 'novalidate'=>'novalidate']);?>
            <div class="mb-3">
                <label class="w-100"><?=lang('Input.status');?></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status_true" value="true">
                    <label class="form-check-label" for="status_true"><?=lang('Label.active');?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status_false" value="false">
                    <label class="form-check-label" for="status_false"><?=lang('Label.inactive');?></label>
                </div>
            </div>
            <div class="mb-3">
                <label>Content ID</label>
                <input type="text" class="form-control" value="<?=$contentid?>" readOnly>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEN" aria-expanded="false" aria-controls="collapseEN"><?=lang('Input.content');?> - ENGLISH</button>
                    <article class="card-body collapse show p-0" id="collapseEN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleEN" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgEN" required>
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                        </div>
                        <textarea class="form-control" name="contentEN" id="contentEN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMY" aria-expanded="false" aria-controls="collapseMY"><?=lang('Input.content');?> - BAHASA</button>
                    <article class="card-body collapse p-0" id="collapseMY">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleMY"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgMY">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                        </div>
                        <textarea class="form-control" name="contentMY" id="contentMY"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCN" aria-expanded="false" aria-controls="collapseCN"><?=lang('Input.content');?> - 简体中文</button>
                    <article class="card-body collapse p-0" id="collapseCN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleCN"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgCN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                        </div>
                        <textarea class="form-control" name="contentCN" id="contentCN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTH" aria-expanded="false" aria-controls="collapseTH"><?=lang('Input.content');?> - ไทย</button>
                    <article class="card-body collapse p-0" id="collapseTH">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleTH"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgTH">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                        </div>
                        <textarea class="form-control" name="contentTH" id="contentTH"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVN" aria-expanded="false" aria-controls="collapseVN"><?=lang('Input.content');?> - TIẾNG VIỆT</button>
                    <article class="card-body collapse p-0" id="collapseVN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleVN"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgVN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                        </div>
                        <textarea class="form-control" name="contentVN" id="contentVN"></textarea>
                    </article>
                </div>
            </div>
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

    $('.modifyPromoReadOnlyForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['id'] = '<?=$id;?>';
                params['contentid'] = '<?=$contentid;?>';
            });

            $.post('/promotion/read-only/content/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success");
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modifyPromoReadOnlyForm').removeClass('was-validated');
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
    params['id'] = '<?=$id;?>';

    $.post('/content/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            obj.data[0].status==true ? $('.modifyPromoReadOnlyForm [name=status]#status_true').prop('checked',true) : $('.modifyPromoReadOnlyForm [name=status]#status_false').prop('checked',true);

            $('.modifyPromoReadOnlyForm [name=titleEN]').val(obj.data[0].title.EN);
            $('.modifyPromoReadOnlyForm [name=titleMY]').val(obj.data[0].title.MY);
            $('.modifyPromoReadOnlyForm [name=titleCN]').val(obj.data[0].title.CN);
            $('.modifyPromoReadOnlyForm [name=titleTH]').val(obj.data[0].title.TH);
            $('.modifyPromoReadOnlyForm [name=titleVN]').val(obj.data[0].title.VN);

            $('.modifyPromoReadOnlyForm [name=imgEN]').val(obj.data[0].thumbnail.EN);
            $('.modifyPromoReadOnlyForm [name=imgMY]').val(obj.data[0].thumbnail.MY);
            $('.modifyPromoReadOnlyForm [name=imgCN]').val(obj.data[0].thumbnail.CN);
            $('.modifyPromoReadOnlyForm [name=imgTH]').val(obj.data[0].thumbnail.TH);
            $('.modifyPromoReadOnlyForm [name=imgVN]').val(obj.data[0].thumbnail.VN);

            obj.data[0].content.EN==null ? editorEN.data.set('') : editorEN.data.set(obj.data[0].content.EN);
            obj.data[0].content.MY==null ? editorMY.data.set('') : editorMY.data.set(obj.data[0].content.MY);
            obj.data[0].content.CN==null ? editorCN.data.set('') : editorCN.data.set(obj.data[0].content.CN);
            obj.data[0].content.TH==null ? editorTH.data.set('') : editorTH.data.set(obj.data[0].content.TH);
            obj.data[0].content.VN==null ? editorVN.data.set('') : editorVN.data.set(obj.data[0].content.VN);
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

let editorEN, editorMY, editorCN, editorTH, editorVN, editorBGL, editorBUR;
ClassicEditor.create(document.querySelector('#contentEN'), {
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

ClassicEditor.create(document.querySelector('#contentMY'), {
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
    editorMY = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#contentCN'), {
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
    language: 'cn',
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
    editorCN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#contentTH'), {
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

ClassicEditor.create(document.querySelector('#contentVN'), {
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