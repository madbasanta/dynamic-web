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
    MODAL JS
*/

function confirm_action(props, callback = '') {
    props.width = props.width ? 'max-width:'+ props.width : '';
    let modal_id = (new Date()).getTime();
    props.body = props.body || '';

    let acitons = '';
    if(props.action) {
        acitons = `<div class="clearfix mt-4">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">No</button>
                <button type="button" class="btn ${props.btn} float-right px-4" id="submit-${modal_id}">${props.action}</button>
            </div>`;
    }


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
                                ${props.body}${acitons}
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
        sendAjax({url : props.get, loader : props.loader}, function(resp) {
            $('#confirm-'+ modal_id +' .modal-body').html(resp).closest('#confirm-'+ modal_id).modal({
                closable: !!props.closable
            }).modal('show');
        });
    } else {
        $('#confirm-'+ modal_id).modal({
                closable: !!props.closable
        }).modal('show');
    }

    if (typeof callback === 'function') {
        $(document).off('click', '#submit-'+ modal_id).on('click', '#submit-'+ modal_id, callback);
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
let styles = {
    "display" : "none",
    "position" : "fixed",
    "bottom" : "70px",
    "right" : "25px",
    "width" : "330px",
    "z-index" : "9999"
};
function toaster(message) {
    let toast_container = document.createElement('div');
    toast_container.className = 'alert alert-dismissible';
    Object.assign(toast_container.style, styles);
    toast_container.innerHTML = `<button type="button" class="close" data-dismiss="alert">×</button>
    <strong class="alert-title"></strong> ${message}`;
    document.body.appendChild(toast_container);
    let hideToaster = function(toaster) {
        setTimeout(function(toast) {
            $(toast).fadeOut();
        }, 5000, toaster);
    };
    let showToaster = function(toaster) {
        $(toaster).fadeIn(function() {
            hideToaster(this);
        });
    };
    return {
        error () {
            toast_container.classList.add('alert-danger');
            toast_container.querySelector('.alert-title').innerHTML = 'Error <br>';
            showToaster(toast_container);
        },
        success () {
            toast_container.classList.add('alert-success');
            toast_container.querySelector('.alert-title').innerHTML = 'Success <br>';
            showToaster(toast_container);
        }
    }; 
}

function p_json(text) {
    try {
        return JSON.parse(text);
    } catch(e) {
        return null;
    }
}

function processFormValidation(err, that = '#no-existence') {
    let form = $(that);
    let errors = p_json(err.responseText);
    if(!errors) return true;
    let msg = '';
    form.find(':input').css('border', '1px solid rgb(206, 212, 218)');
    for (let key in errors) {
        msg += errors[key][0] + '<br>';
        form.find('[name="'+ key +'"]').css('border', '1px solid #e3342f');
    }

    toaster(msg).error();
    return true;
}