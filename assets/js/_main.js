/* Author: Hugh Guiney */
/*jslint plusplus: true */
/*jshint laxcomma: true, laxbreak: true */
/*global Modernizr: true, hljs: true, window: true, document: true, console: true, XMLHttpRequest: true */
$(document).ready(function docReady() {

// http://stackoverflow.com/a/14696377/214325
$("input.form-control").change(function() {
  var formGroup = $(this).closest('.form-group');

  if ( Boolean( $(this)[0].checkValidity) && (! $(this)[0].checkValidity() ) ) {
    formGroup.removeClass('has-success has-warning').addClass('has-error');
  } else {
    formGroup.removeClass('has-error has-warning has-success');
  }
});

// @todo: change to undo instead: http://alistapart.com/article/neveruseawarning
$('a.reset').on('click', function resetForm(event) {
  event.preventDefault();
  var
    sure = window.confirm("This will reset the entire form. Are you sure you want to proceed?")
  , form
  ;

  if ( sure ) {
    form = $(this).closest('form');
    form.find('input, textarea').val('');
  }
});

});

// https://github.com/twbs/bootstrap/issues/9855#issuecomment-30109204
function measureScrollBar() {
  // david walsh
  var scrollDiv = document.createElement('div');
  scrollDiv.className = 'scrollbar-measure';
  document.body.appendChild(scrollDiv);
  var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
  document.body.removeChild(scrollDiv);
  return scrollbarWidth;
}

$(document.body)
.on('show.bs.modal', function () {
  if (this.clientHeight < window.innerHeight) {
    return;
  }
  var scrollbarWidth = measureScrollBar();
  if (scrollbarWidth) {
    $(document.body).css('padding-right', scrollbarWidth);
  }
})
.on('hidden.bs.modal', function () {
  $(document.body).css('padding-right', 0);
})
.scrollspy()
;

jQuery(document).ready(function($) {
  function runCarousel() {
    $(".carousel").carouFredSel({
      "auto": {
       "play": false
      },
      "prev": {
        "button": ".prev",
        "key": "left"
      },
      "next": {
        "button": ".next",
        "key": "right"
      },
      "swipe": {
        onMouse: true,
        onTouch: true
      },
      "responsive": true,
      "transition": true,
      "width": "100%",
      "height": "variable",
      "items": {
        "visible": 1,
        "width": 1024,
      "height": "variable"
      }
    });
  }
  $(".carousel").imagesLoaded(runCarousel);
});

(function indexJS() {
  "use strict";

  var
    form = document.forms.requestForm
    // Modified from: http://blog.customizedev.com/index.php/serializing-html-form-to-query-string-with-javascript-made-easy/
    , getSelectedOptions = function (el) {
      var rv = [], i = 0;
      for (i; i < el.options.length; ++i) {
        if (el.options[i].selected) {
          rv.push(el.options[i]);
        }
      }
      return rv;
    }
    , serializeToQueryString = function (form) {
      var results = {};
      var rv = '';
      var inputs = form.elements;

      function returnOptValue(opt){
        return opt.value;
      }

      for (var k = 0; k < inputs.length; k++) {
        var el = inputs[k];
        
        if (el === null || el.nodeName === undefined) {
          continue;
        }
        
        var tagName = el.nodeName.toLowerCase();
        if (!(tagName === "input" || tagName === "select" || tagName === "textarea")) {
          continue;
        }
        
        var type = el.type, names =[], name = el.name, current;
        if (!el.name || el.disabled || type === 'submit' || type === 'reset' || type === 'file' || type === 'image') {
          continue;
        }
        
        var value = (tagName === 'select') ? getSelectedOptions(el).map(returnOptValue) : ((type === 'radio' || type === 'checkbox') && !el.checked) ? null : el.value;
        
        if (value !== null) {
          rv = rv + "&" + encodeURIComponent(el.name) + "=" + encodeURIComponent(value);
        }
      }

      return (rv.length > 0) ? rv.substring(1) : rv;
    }
    , contact = document.getElementById('contact')
    , submissionAttempts = 0
    , ajax = new XMLHttpRequest()
    , ajaxMode = document.getElementById('ajax')
    , ajaxSubmit = function (event) {
      var
        form = event.target,
        method = 'GET', //form.method.toUpperCase(),
        url = '?' + serializeToQueryString(form) + '&submit=Submit' + form.getAttribute('action').substr(1)
      ;

      event.preventDefault();

      ajax.onreadystatechange = function onReadyStateChange() {
        if (ajax.readyState === 4) {
          var
            html = ajax.responseText,
            requestFormBody = document.getElementById('request-form-body'),
            requestFormFooter = document.getElementById('request-form-footer'),
            msg = document.getElementById('contact-result')
          ;
          //= document.getElementById('contact-result');
          //msg.parentNode.removeChild(msg);

          if ( ajax.status === 200 ) {
            requestFormBody.innerHTML = html;
            requestFormFooter.parentNode.removeChild(requestFormFooter);
          } else {
            //requestFormBody.insertAdjacentHTML('beforebegin', html);
            msg.innerHTML = html;
            msg.setAttribute('class', 'alert alert-danger');
            window.location.hash = 'contact-result';
            //requestFormBody.innerHTML = html + requestFormBody.innerHTML;
          }

          msg.removeAttribute('hidden');

          ++submissionAttempts;
        }
      };

      ajax.open(method, url, false);
      ajax.send();

      console.log(url);
      console.log(ajax);

      return true;
    }
  ;

  ajaxMode.setAttribute('value', 'true');

  console.log( 'form', form );

  form.addEventListener('submit', ajaxSubmit, false);
}());
