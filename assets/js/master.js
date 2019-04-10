/*
    LAZY LOADING IMAGE
*/

const targets = document.querySelectorAll('img[data-lazy]');
const lazyload = target => {
    const io = new IntersectionObserver((entries, observer) => {
        // console.log(entries);
        entries.forEach(entry => {
            // console.log('☺');
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-lazy');

                img.src = src;
                $(img).css({"max-height": $(img.parentElement).innerHeight()});
                img.parentElement.style = '';
                observer.disconnect();
            }
        });
    });
    io.observe(target);
};
targets.forEach(lazyload);

// ======================================================================

/*
    COOKIE FUNCTIONS
*/
function setCookie(cname, cvalue, exsec) {
    let d = new Date();
    d.setTime(d.getTime() + (exsec * 1000 * 60));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
  return null;
}
// =======================================================================

/*
    LOGIN AND REGISTRACTION FORM
*/
$(function() {
    $('#sign-up-form').off('submit').on('submit', function(e) {
        if(!$('#term_agree').prop('checked'))
            e.preventDefault();
    });
    $('#sign-in-form').off('submit').on('submit', function(e) {

        let login_attempt = getCookie('login_attempt');
        if(!login_attempt) {
            login_attempt = 1;
            setCookie('login_attempt', login_attempt, 3);
        } else {
            login_attempt = parseInt(login_attempt);
            setCookie('login_attempt', login_attempt + 1, 3);
        }
        if(login_attempt >= 3) {
            e.preventDefault();
            $('#sign-in-submit').prop('disabled', true);
            alert('Please refresh the page and try again after some time.');
        }
    });
    let login_attempt = getCookie('login_attempt');
    if(login_attempt > 3) {
        $('#sign-in-submit').prop('disabled', true);
    }
});

/*
    MODAL JS
*/

function confirm_action(props) {
    props.btn = props.btn || 'btn-danger';
    props.width = props.width ? 'max-width:'+ props.width : '';
    let modal_id = (new Date()).getTime();
    props.body = props.body || '';
    let body = `<!-- The Modal -->
                    <div class="modal confirm_action_modal" id="confirm-${modal_id}">
                      <div class="modal-dialog" style="${props.width}">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header bg-primary" style="border-bottom: 4px solid #ff5252;">
                            <h4 class="modal-title w-100 text-white text-center my-2">${props.title}</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body p-5">
                                ${props.body}
                          </div>
                        </div>
                      </div>
                    </div>`;

    props.fresh = props.fresh || true;
    if(props.fresh) {
        $('body .confirm_action_modal').remove();
    }
    $('body').append(body);
    if(props.get) {
        $.get(props.get).then(function(response) {
            let modal = $('#confirm-'+ modal_id);
            modal.find('.modal-body').html(response);
            modal.modal('show');
        });
    } else {
        $('#confirm-'+ modal_id).modal('show');
    }
}

function logout() {
    let form = document.createElement('FORM');
    form.action = '/log-out';
    form.method = 'post';
    document.body.appendChild(form);
    form.submit();
}

$('#right-side-bar').on('click', function(e) {
    let target = e.target || e.srcElement;
    if (target !== document.getElementById('right-side-bar')) return;
    $('#right-bar-contents').animate({"width": "0px"}, 200, function() {
        $(target).hide();
    });
});

$('#close-right-side-bar').on('click', function() {
    $('#right-bar-contents').animate({"width": "0px"}, 200, function() {
        $('#right-side-bar').hide();
    });
});

function sidebar({title, icon, url}) {
    $('#right-side-bar').show(0, function() {
        $('#right-bar-contents .title').html(`<i class="fa fa-${icon} w-30 text-orange"></i> ${title}`);
        $('#right-bar-contents').animate({"width": "250px"}, 200);
    });
}

$('#my-notifications').on('click', function() {
    sidebar({
        "title" : "All Notifications",
        "icon" : "bell",
        "url" : '/notifications/right-side-bar'
    });
});

$('#my-settings').on('click', function() {
    sidebar({
        "title" : "Settings",
        "icon" : "cog",
        "url" : '/mails/right-side-bar'
    });
});

/*
admin load side bar page
*/

function load_page(url, content_holder = '#content-wrapper', callback = r => r) {
    sendAjax({url, data: {ajax: true}, loader: true}, function(response) {
        $(content_holder).html(response);
        callback(response);
    });
}

$('.left-side-bar-pages a').on('click', function(e) {
    e.preventDefault();
    load_page(this.href, '#content-wrapper');
    location.hash = $(this).data('slug');
    breadcrumb([$(this).data('slug')]);
    $(this).addClass('active').siblings('a.active').removeClass('active');
});

function sendAjax(props, callback = r => r, error = e => e) {
    callback = props.success || callback;
    error = props.error || error;
    
    props.success = function(resp) {
        props.loader ? removeLoader() : null;
        callback(resp);
    };
    props.error = function(err) {
        props.loader ? removeLoader() : null;
        error(err);
    }

    if(props.loader)
        addLoader();
    
    if (props.hasOwnProperty('formdata')) {
        props.data = props.formdata;
        props.contentType = false;
        props.processData = false;
    }

    $.ajax(props);
}

function breadcrumb(crumbs) {
    let target = $('#wrapper .breadcrumb').empty();
    let content = '<div class="breadcrumb-item"><i class="fa fa-home"></i></div>';
    for(let i = 0; i < crumbs.length; i++) {
        content += `<div class="breadcrumb-item">${crumbs[i]}</div>`;
    }
    target.html(content);
}

function addLoader() {
    $('#section-loader').css('display', 'flex');
}
function removeLoader() {
    $('#section-loader').css('display', 'none');
}