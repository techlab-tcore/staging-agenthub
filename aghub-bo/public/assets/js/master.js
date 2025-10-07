(function () {
    'use strict';

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl);
    });

    var myToastEl = document.getElementById('liveToast')
    myToastEl.addEventListener('hidden.bs.toast', function () {
        this.classList.remove('bg-danger');
        this.classList.remove('bg-warning');
        this.classList.remove('bg-success');
        this.classList.add('bg-primary');
    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
  
    var forms = document.querySelectorAll('.form-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false);
    });

    $("[name=username], [name=referral]").off().on("keyup", function () {
		if (this.value.match(/[^a-zA-Z0-9 ]/g))
			this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, "");
	});
})();

function winloseStatus()
{
    $.get('/system/settlement/winlose/status', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const ele = obj.data;
            ele.forEach(function(item, index) {
                var node = document.createElement("button");
                // var textnode = document.createTextNode(item.date);
                node.setAttribute('type', 'button');
                if( item.status==true ) {
                    node.innerHTML = '<i class="las la-check me-1"></i>' + item.date;
                    node.classList.add('me-1','btn','btn-sm','bg-gradient','btn-success','mb-2');
                } else {
                    node.innerHTML = '<i class="las la-times-circle me-1"></i>' + item.date;
                    node.classList.add('me-1','btn','btn-sm','bg-gradient','btn-danger','mb-2');
                }
                // node.appendChild(textnode);
                document.getElementById("winloseStatus").appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function refreshProfile()
{
    $.ajax({
        method: 'GET',
        url: '/user/confidential',
        success: function (data,status,xhr) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                var balance;
                if( parseFloat(obj.balance) > 0 ) {
                    balance = '<label class="text-success">' + obj.balance + '</label>';
                } else {
                    balance = '<label class="text-danger">' + obj.balance + '</label>';
                }
                $('.userbalance').html(balance);
            } else {
                forceUserLogout();
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { location.reload(); });
        },
        beforeSend: function(xhr) {
            $('.userbalance').html('---');
        }
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { location.reload(); });
    })
    .done(function(msg) {});
}

function forceUserLogout()
{
    swal.fire({
        title: 'Your account has logged in other device...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    $.get('/user/logout', function(data, status) {
        location.reload();
    })
    .done(function(msg) { swal.close(); });
}

function translation(vlang)
{
    const lang = vlang ? vlang : $(".select-lang").children("option:selected").val();

	$.get("/translate/" + lang, function (data, status) {
		const obj = JSON.parse(data);
		obj.code==1 ? location.reload() : '';
	});
}

function showhidepass(el)
{
    // var input = document.getElementById("password");
    // if (input.type === "password") {
    //     input.type = "text";
    // } else {
    //     input.type = "password";
    // }

    const input = document.getElementById(el);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

function alertToast(option, msg)
{
    var toast = document.getElementById('liveToast');
    toast.classList.remove('bg-primary');
    toast.classList.add(option);
    toast.getElementsByClassName('toast-body')[0].innerHTML = msg;
    var popToast = new bootstrap.Toast(toast);
    popToast.show();
}
