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

function coordinateProfile(uid)
{
    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });
    
    var params = {};
    params['uid'] = uid;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            var mb = obj.data.contact=='' ? '' : '0'+obj.data.contact;
            $('.modal-modify form [name=contact]').val(mb);
            $('.modal-modify form [name=telegram]').val(obj.data.telegram);
            $('.modal-modify form [name=remark]').val(obj.data.remark);
            $('.modal-modify form [name=fname]').val(obj.data.name);
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

function coordinateProfileHub(uid)
{
    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });
    
    var params = {};
    params['uid'] = uid;

    $.post('/user/profile/hub', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            //var mb = obj.data.contact=='' ? '' : '0'+obj.data.contact;
            //$('.modal-modify form [name=contact]').val(mb);
            $('.modal-modify form [name=contact]').val(obj.data.contact);
            $('.modal-modify form [name=telegram]').val(obj.data.telegram);
            $('.modal-modify form [name=remark]').val(obj.data.remark);
            $('.modal-modify form [name=fname]').val(obj.data.name);
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
