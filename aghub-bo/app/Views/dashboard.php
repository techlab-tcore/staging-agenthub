<!-- Announcement -->
<!-- End Announcement -->

<dl class="row gy-2 gx-3 mb-4">
    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
        <section class="card border-vw mb-4">
            <h4 class="card-header bg-white border-vw"><?=lang('Label.fight');?> & <?=lang('Label.shares');?></h4>
            <div class="card-body">
                <ul class="list-unstyled row gy-2 gx-3 align-items-center">
                    <li class="col-12 d-flex justify-content-between">
                        <label><?=lang('Input.sharesexpenses');?></label>
                        <span class="color-vw"><?=$psExpenses;?></span>
                    </li>
                    <li class="col-12 d-flex justify-content-between">
                        <label><?=lang('Label.shares');?>%</label>
                        <span class="color-vw"><?=$ps;?></span>
                    </li>
                    <!--
                    <hr class="my-2 border-vw">
                    <li class="col-12 d-flex justify-content-between">
                        <label><?//=lang('Input.fightexpenses');?></label>
                        <span class="color-vw"><?=$ptExpenses;?></span>
                    </li>
                    <li class="col-12 d-flex justify-content-between">
                        <label><?//=lang('Label.fight');?>%</label>
                        <span class="color-vw"><?=$ptps;?></span>
                    </li>
                    -->
                </ul>
            </div>
        </section>

        <figure class="m-0" id="loginChart" style="width:100%; height: 300px;"></figure>
    </dd>
    <dd class="col-xl-8 col-lg-8 col-md-8 col-12">
        <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm mb-3', 'novalidate'=>'novalidate']);?>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text"><?=lang('Input.from');?></span>
                <input type="text" class="form-control" name="start4" value="<?=date('Y-m-d', strtotime('monday this week'));?>" readonly>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text"><?=lang('Input.to');?></span>
                <input type="text" class="form-control" name="end4" value="<?=date('Y-m-d', strtotime('sunday this week'));?>" readonly>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i><?=lang('Nav.search');?></button>
        </div>
        <?=form_close();?>

        <figure class="m-0" id="paymentChart" style="width:100%; height: 326px;"></figure>
    </dd>
</dl>

<dl class="row member-stats">
    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
        <section class="card border-white rounded-3">
            <article class="card-body text-muted">
                <i class="las la-user me-1"></i><?=lang('Label.newmember');?>
                <b class="float-end new-member"><?=lang('Label.loading');?>...</b>
            </article>
        </section>
        <section class="card border-white rounded-3 mt-3">
            <article class="card-body text-muted">
                <i class="las la-users me-1"></i><?=lang('Label.totalmember');?>
                <b class="float-end total-member"><?=lang('Label.loading');?>...</b>
            </article>
        </section>
        <section class="card border-white rounded-3 mt-3">
            <article class="card-body text-muted">
                <i class="las la-user-secret me-1"></i><?=lang('Label.totalagent');?>
                <b class="float-end total-agent"><?=lang('Label.loading');?>...</b>
            </article>
        </section>
    </dd>
    <dd class="col-xl-8 col-lg-8 col-md-8 col-12">
        <figure class="m-0" id="memberChart" style="width:100%; height: 220px;"></figure>
    </dd>
</dl>

<section class="modal fade modal-announcement" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-announcement" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.anncs');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="announcemenet">
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url('assets/vendors/echart/dist/echarts.min.js');?>"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    airdatepicker();
    announcementPopList();
    // announcementList();
    companyStatistics();

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();
            companyStatistics();
        }
    });
});

function companyStatistics()
{
    generalLoading();
    
    var params = {};
    params['start'] = $('.filterForm [name=start4]').val();
    params['end'] = $('.filterForm [name=end4]').val();

    $.post('/statistics/company-self', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const array = obj.data.weekWithdrawal;
            const weekWithdrawal = array.map( v => Math.abs(v) );

            const totalNett = obj.data.totalDeposit + obj.data.totalWithdrawal;

            graphStatistics(obj.data.weekMember, obj.data.weekDeposit, weekWithdrawal, obj.data.loginUser);
            $('.total-member').html(obj.data.totalMember);
            $('.new-member').html(obj.data.newMember);
            $('.total-agent').html(obj.data.totalAgent);
            $('.today-deposit').html(parseFloat(obj.data.totalDeposit).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
            $('.today-withdrawal').html(parseFloat(obj.data.totalWithdrawal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
            $('.today-bonus').html(parseFloat(obj.data.totalPromotion).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            $('.today-dwnett').html(parseFloat(totalNett).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
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

function graphStatistics(member,deposit,withdrawal,login)
{
    const paymentChart = echarts.init(document.getElementById('paymentChart'));
    const option = {
        title: {
            text: '<?=lang('Label.weektrans');?>',
        },
        tooltip: {},
        legend: {
            data:['<?=lang('Label.deposit');?>', '<?=lang('Label.withdrawal');?>']
        },
        xAxis: {
            type: 'category',
            borderWidth: 0,
            axisTick: {show: false},
            data: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]
        },
        yAxis: {},
        series: [{
            name: '<?=lang('Label.deposit');?>',
            type: 'bar',
            barGap: 0.2,
            itemStyle: {
                color: '#b4df5b',
                // borderRadius: [5,5,5,5],
                // shadowColor: 'rgba(81,69,157,.5)',
                // shadowBlur: 10
            },
            data: deposit
        }, {
            name: '<?=lang('Label.withdrawal');?>',
            type: 'bar',
            barGap: 0.2,
            itemStyle: {
                color: '#ff1a00',
                // borderRadius: [5,5,5,5],
                // shadowColor: 'rgba(118,231,242,.175)',
                // shadowBlur: 10
            },
            data: withdrawal
        }],
        media: [{
            query: {
                maxWidth: 400
            },
            option: {
                legend: {
                    right: 'center',
                    bottom: 10,
                    orient: 'horizontal',
                    padding: [0,0,10,0]
                }
            }
        }]
    };
    paymentChart.setOption(option);

    const memberChart = echarts.init(document.getElementById('memberChart'));
    const memberOption = {
        title: {
            text: '<?=lang('Label.weeknewmember');?>',
            // x: 'center'
        },
        tooltip: {},
        legend: {
            data:['<?=lang('Label.member');?>']
        },
        xAxis: {
            type: 'category',
            borderWidth: 0,
            axisTick: {show: false},
            data: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]
        },
        yAxis: {},
        series: [{
            name: '<?=lang('Label.member');?>',
            type: 'line',
            barGap: 0,
            itemStyle: {
                color: '#2AC398',
                shadowColor: 'rgba(81,69,157,.5)',
                shadowBlur: 10
            },
            data: member
        }],
        media: [{
            query: {
                maxWidth: 400
            },
            option: {
                legend: {
                    right: 'center',
                    bottom: 10,
                    orient: 'horizontal',
                    padding: [0,0,10,0]
                }
            }
        }]
    };
    memberChart.setOption(memberOption);

    const loginChart = echarts.init(document.getElementById('loginChart'));
    const loginOption = {
        title: {
            text: '<?=lang('Label.weeklogin');?>',
            // x: 'center'
        },
        tooltip: {},
        legend: {
            data:['<?=lang('Label.member');?>']
        },
        xAxis: {
            type: 'category',
            borderWidth: 0,
            axisTick: {show: false},
            data: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]
        },
        yAxis: {},
        series: [{
            name: '<?=lang('Label.member');?>',
            type: 'bar',
            barGap: 0,
            itemStyle: {
                color: '#2AC398',
                // shadowColor: 'rgba(81,69,157,.5)',
                // shadowBlur: 10
            },
            data: login
        }],
        media: [{
            query: {
                maxWidth: 400
            },
            option: {
                legend: {
                    right: 'center',
                    bottom: 10,
                    orient: 'horizontal',
                    padding: [0,0,10,0]
                }
            }
        }]
    };
    loginChart.setOption(loginOption);
}

function announcementPopList()
{
    const anncEvent = document.getElementById('modal-announcement');
    $.get('/list/announcement/pop/all', function(res, status) {
        const obj = JSON.parse(res);
        // console.log(obj);
        if( obj.code==1 && obj.data!='' ) {
            $('.modal-announcement').modal('toggle');
            // $('.modal-announcement .announcemenet').html(obj.content);
            const msg = obj.data;
            msg.forEach( (item, index) => {
                var node = document.createElement("p");
                var nodeDivider = document.createElement("hr");  
                var textnode = item.content;
                node.innerHTML = textnode;
                node.appendChild(nodeDivider);
                var ele = document.getElementById("announcemenet").appendChild(node);
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function announcementList()
{
    $.get('/list/announcement/all', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            if( obj.data!='' ) {
                const msg = obj.data;
                let lng = '<?=$_SESSION['lang'];?>'.toUpperCase();
                let content;

                msg.forEach( (item, index) => {
                    var shell = document.createElement("dd");
                    var node = document.createElement("blockquote");
                    var nodeCreated = document.createElement("figcaption");
                    var textnode = item.content;
                    var datenode = document.createTextNode(item.date);
                    // node.appendChild(textnode);
                    node.innerHTML = textnode;
                    nodeCreated.appendChild(datenode);
                    shell.appendChild(node);
                    shell.appendChild(nodeCreated);
                    var ele = document.getElementById("annlist").appendChild(shell);
                    node.classList.add('blockquote');
                    nodeCreated.classList.add('blockquote-footer','text-end');
                    ele.classList.add('col-lg-12','col-md-12','col-12','fw-light');
                });
            } else {
                let str = '';
                str = '<dd class="col-lg-12 col-md-12 col-12 fw-light">';
                str += '<blockquote class="blockquote">To keep the confidentiality of the password, we strongly recommend you change password immediately. If any risk happens due to password is not changed, kindly understand the responsibility would not be burdened by official side.</blockquote>';
                str += '<figcaption class="blockquote-footer text-end">MAY 05, 2021</figcaption>';
                str += '</dd>';

                document.getElementById("annlist").innerHTML = str;
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            let str = '';
            str = '<dd class="col-lg-12 col-md-12 col-12 fw-light">';
            str += '<blockquote class="blockquote">To keep the confidentiality of the password, we strongly recommend you change password immediately. If any risk happens due to password is not changed, kindly understand the responsibility would not be burdened by official side.</blockquote>';
            str += '<figcaption class="blockquote-footer text-end">MAY 05, 2021</figcaption>';
            str += '</dd>';

            document.getElementById("annlist").innerHTML = str;
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}
</script>