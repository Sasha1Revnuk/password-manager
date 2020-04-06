/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/acc/panel/programSalesAdd.js":
/*!***************************************************!*\
  !*** ./resources/js/acc/panel/programSalesAdd.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  var _$$select;

  selectProgram();
  selectCoach();
  selectPromotion();
  $('#sections').on('change', function () {
    selectProgram();
    selectCoach();
    selectPromotion();
    $('#price').val('');
    $('#price-desc').html('');
    $('#card-program').html('');
    $('#card-coach').html('');
  });
  $('#programs').on('change', function () {
    setPrice();
    $('#card-program').html($('#programs option:selected').text());
    $('#hidden_program').val($('#programs option:selected').val());
    console.log($('#programs option:selected'));
  });
  $('#promotions').on('change', function () {
    setPrice();
    $('#card-promotion').html($('#price-desc').html());
  });
  $('#visitor').on('change', function () {
    $('#card-visitor').html($('.full_name').html());
    $('#hidden_visitor').val($('.full_name').attr('data-id'));
  });
  $('#coaches').on('change', function () {
    $('#card-coach').html($('#coaches option:selected').text());
  });

  function setPrice() {
    if (parseInt($('#programs').val())) {
      $.ajax({
        type: 'GET',
        url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/get-price/' + $('#programs').val(),
        data: {
          promotion: function promotion() {
            return $('#promotions').val();
          }
        },
        headers: authHeaders
      }).then(function (data) {
        $('#price').val(data.price);
        $('#price-desc').html(data.desc ? 'Знижка на ' + data.desc + ' грн' : 'Знижка відсутня');
        $('#card-promotion').html(data.desc ? data.desc + ' грн' : 'Знижка відсутня');
        $('#card-program-price').html(data.standart + ' грн');
        $('#card-for-sale').html(data.price + ' грн');
        $('#hidden_price').val(data.price);
      });
    }
  }

  function selectCoach() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/get-coaches/' + $('#sections').val(),
      headers: authHeaders
    }).then(function (data) {
      $('#coaches').empty();
      $('#coaches').append('<option value="">-</option>');
      $.each(data, function (key, value) {
        console.log(value);
        $('#coaches').append('<option value="' + key + '">' + value + '</option>');
      });
      $('#coaches').trigger("chosen:updated");
    });
  }

  function selectProgram() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/get-programs/' + $('#sections').val(),
      headers: authHeaders
    }).then(function (response) {
      $('#programs').empty(); //console.log(response.result);

      $('#programs').select2({
        data: response,
        placeholder: 'Вибір програми',
        language: {
          inputTooShort: function inputTooShort() {
            return "Введіть хоча б один символ";
          },
          errorLoading: function errorLoading() {
            return 'Програми не можуть бути завантажені';
          },
          noResults: function noResults() {
            return 'Програм не знайдено';
          },
          searching: function searching() {
            return 'Пошук…';
          }
        }
      });
      $('#programs').trigger("chosen:updated");
    });
  }

  function selectPromotion() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/get-promotion/' + $('#sections').val(),
      headers: authHeaders
    }).then(function (response) {
      $('#promotions').empty();
      $('#promotions').select2({
        data: response,
        placeholder: 'Вибір акції',
        language: {
          inputTooShort: function inputTooShort() {
            return "Введіть хоча б один символ";
          },
          errorLoading: function errorLoading() {
            return 'Акції не можуть бути завантажені';
          },
          noResults: function noResults() {
            return 'Акцій не знайдено';
          },
          searching: function searching() {
            return 'Пошук…';
          }
        }
      });
      $('#promotions').trigger("chosen:updated");
    });
  }

  function icon(elm) {
    elm.element;
    return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text;
  }

  $("#visitor").select2((_$$select = {
    ajax: {
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/get-users/',
      dataType: 'json',
      delay: 250,
      headers: authHeaders,
      data: function data(params) {
        return {
          q: params.term,
          // search term
          page: params.page
        };
      },
      processResults: function processResults(data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;
        return {
          results: data.items,
          pagination: {
            more: params.page * 30 < data.total_count
          }
        };
      },
      cache: true
    },
    placeholder: 'Search for a repository',
    escapeMarkup: function escapeMarkup(markup) {
      return markup;
    },
    // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  }, _defineProperty(_$$select, "placeholder", 'Введіть ПІП'), _defineProperty(_$$select, "language", {
    inputTooShort: function inputTooShort() {
      return "Введіть хоча б один символ";
    },
    errorLoading: function errorLoading() {
      return 'Відвідувачі не можуть бути завантажені';
    },
    noResults: function noResults() {
      return 'Відвідувачів не знайдено';
    },
    searching: function searching() {
      return 'Пошук…';
    }
  }), _$$select));

  function formatRepo(repo) {
    if (repo.loading) {
      return repo.text;
    }

    var markup = "<div class='select2-result-repository clearfix d-flex'>" + "<div class='select2-result-repository__avatar mr-2'>" + "<div class='select2-result-repository__meta'>" + "<div class='select2-result-repository__title fs-lg fw-500  full_name' data-id='" + repo.id + "'>" + repo.full_name + "</div>";
    email = repo.email ? repo.email : "-";
    phone = repo.phone ? repo.phone : "-";
    birthday = repo.birthday ? repo.birthday : "-";
    markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" + "<div class='select2-result-repository__forks mr-2'><i class='fal fa-mouse-pointer'></i> " + email + "</div>" + "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-phone'></i> " + phone + " </div>" + "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-calendar'></i> " + birthday + "</div>" + "</div>" + "</div></div>";
    return markup;
  }

  function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
  }

  $('#description').summernote({
    height: 200,
    tabsize: 2,
    placeholder: "Додаткові відомості",
    dialogsFade: true,
    toolbar: [['style', ['style']], ['font', ['strikethrough', 'superscript', 'subscript']], ['font', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']][('table', ['table'])], ['insert', ['link']], ['view', ['fullscreen', 'codeview', 'help']]],
    callbacks: {
      onChange: function onChange(contents, $editable) {
        $('#hidden_description').val(contents);
      }
    }
  }); // $('body').on('click', '#sale', function () {
  //     $('#form').submit(function() {
  //         return false;
  //     });
  //     console.log($('.full_name').html());
  //     $.ajax({
  //         type: 'POST',
  //         url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/program-sales/add',
  //         data: {
  //             section: function () {return $('#sections').val()},
  //             program: function () {return $('#programs').val()},
  //             visitor: function () {return $('#visitors:selected').val()},
  //             coach: function () {return $('#coaches').val()},
  //             description: function () {return $('#description').val()},
  //             promotion: function () {return $('#promotions').val()},
  //             price: function () {return $('#price').val()},
  //         },
  //         headers: authHeaders,
  //     }).then((response) => {
  //
  //     });
  // })
});

/***/ }),

/***/ 25:
/*!*********************************************************!*\
  !*** multi ./resources/js/acc/panel/programSalesAdd.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\WEB\gym-control\resources\js\acc\panel\programSalesAdd.js */"./resources/js/acc/panel/programSalesAdd.js");


/***/ })

/******/ });