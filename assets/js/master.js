/*
    LAZY LOADING IMAGE
*/

const targets = document.querySelectorAll('img');
const lazyload = target => {
    const io = new IntersectionObserver((entries, observer) => {
        // console.log(entries);
        entries.forEach(entry => {
            // console.log('☺');
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-lazy');

                img.src = src;
                // img.parentElement.classList.remove('lazyload');
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

    $('.bookCourse').on('click', function(e) {
        let holder = $('#bottomMessage');
        if(holder.is(':visible')) {
            holder.slideUp(function() {
                holder.slideDown();
            });
        } else {
            holder.slideDown();
        }
    });
    $('.bottomMessageClose').on('click', function() {
        $('#bottomMessage').slideUp();
    });
});