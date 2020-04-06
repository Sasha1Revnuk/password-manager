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
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/acc/panel/abonementAdd.js":
/*!************************************************!*\
  !*** ./resources/js/acc/panel/abonementAdd.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  var _$$select;

  $('#birthday').datepicker({
    format: 'dd-mm-yyyy',
    language: 'ua'
  });
  $(":input").inputmask();
  $('body').on('click', '#add-visitor-form-button', function () {
    $('#name').val('');
    $('#sur_name').val('');
    $('#father_name').val('');
    $('#email').val('');
    $('#phoneMask').val('');
    $('#birthday').val('');
    $('#alert-modal').empty();
  });
  $('body').on('click', '#addVisitorButton', function () {
    $.ajax({
      type: 'POST',
      url: '/account/api/object/' + $('#add-visitor').attr('data-object') + '/control-panel/abonements/add-visitor/',
      headers: authHeaders,
      data: {
        name: function name() {
          return $('#name').val();
        },
        sur_name: function sur_name() {
          return $('#sur_name').val();
        },
        father_name: function father_name() {
          return $('#father_name').val();
        },
        email: function email() {
          return $('#email').val();
        },
        phone: function phone() {
          return $('#phoneMask').val();
        },
        birthday: function birthday() {
          return $('#birthday').val();
        }
      }
    }).then(function (response) {
      if (!response.error) {
        $('#name').val('');
        $('#sur_name').val('');
        $('#father_name').val('');
        $('#email').val('');
        $('#phoneMask').val('');
        $('#birthday').val('');
        $('#close-modal').click();
        Swal.fire({
          type: 'success',
          title: 'Відвідувача добавлено',
          text: 'Тепер можна вибрати його при створені абонементу'
        });
      } else {
        $.each(response.error, function (key, value) {
          $('#alert-modal').append('<div class="alert alert-danger alert-modal role="alert">' + value + '</div>');
        });
      }
    });
  });
  selectTariffPlan();
  selectCoach();
  selectPromotion();
  $('#sections').on('change', function () {
    $('.card-tariff-plan').html('');
    $('.card-tariff-plan-use').html('');
    $('.card-tariff-plan-visiting').html('');
    $('.card-tariff-plan-visiting-count').html('');
    $('.card-tariff-plan-month').html('');
    $('.card-tariff-plan-month-count').html('');
    $('.card-tariff-plan-price').html('');
    $('.card-coach').html('');
    $('.card-visitor').html('');
    $('#hidden_visitor').val('');
    $('.card-promotion').html('');
    $('.card-promotionText').html('');
    $('.card-promotion-month').html('');
    $('.card-promotion-visiting').html('');
    $('.card-for-sale').html('');
    selectTariffPlan();
    selectCoach();
    selectPromotion();
  });
  $('#tariff_plans').on('change', function () {
    var useFrom = '';
    var useTo = '';
    $('.card-tariff-plan').html($('#tariff_plans option:selected').text());

    if ($('#tariff_plans option:selected').attr('data-use-from')) {
      useFrom += 'з ' + $('#tariff_plans option:selected').attr('data-use-from');
    }

    if ($('#tariff_plans option:selected').attr('data-use-to')) {
      useTo += 'до ' + $('#tariff_plans option:selected').attr('data-use-to');
    }

    $('.card-tariff-plan-use').html(useFrom + '<br />' + useTo);
    $('.card-tariff-plan-visiting').html('');
    $('.card-tariff-plan-visiting-count').html('');
    $('.card-tariff-plan-month').html('');
    $('.card-tariff-plan-month-count').html('');
    $('.card-tariff-plan-price').html('');
    $('.card-promotion').html('');
    $('.card-promotionText').html('');

    if ($('#tariff_plans option:selected').val()) {
      if (!$('#coaches option:selected').val()) {
        if ($('#promotions option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), 0, $('#promotions option:selected').val());
        } else {
          getPrice($('#tariff_plans option:selected').val(), 0, 0);
        }
      } else {
        if ($('#promotions option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), $('#promotions option:selected').val());
        } else {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), 0);
        }
      }
    } else {
      $('.card-tariff-plan').html('');
      $('.card-tariff-plan-use').html('');
      $('.card-tariff-plan-visiting').html('');
      $('.card-tariff-plan-visiting-count').html('');
      $('.card-tariff-plan-month').html('');
      $('.card-tariff-plan-month-count').html('');
      $('.card-tariff-plan-price').html('');
      $('.card-for-sale').html('');
    }
  });
  $('#visitor').on('change', function () {
    $('.card-visitor').html($('.full_name').html());
    $('#hidden_visitor').val($('.full_name').attr('data-id'));
  }); //

  $('#coaches').on('change', function () {
    if (!$('#coaches option:selected').val()) {
      $('.card-coach').html('');

      if ($('#tariff_plans option:selected').val()) {
        if ($('#promotions option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), 0, $('#promotions option:selected').val());
        } else {
          getPrice($('#tariff_plans option:selected').val(), 0, 0);
        }
      } else {
        $('.card-tariff-plan-price').html('');
        $('.card-promotion').html('');
        $('.card-promotionText').html('');
        $('.card-for-sale').html('');
      }
    } else {
      $('.card-coach').html($('#coaches option:selected').text());

      if ($('#tariff_plans option:selected').val()) {
        if ($('#promotions option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), $('#promotions option:selected').val());
        } else {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), 0);
        }
      } else {
        $('.card-tariff-plan-price').html('');
        $('.card-promotion').html('');
        $('.card-promotionText').html('');
        $('.card-for-sale').html('');
      }
    }
  });
  $('#promotions').on('change', function () {
    if ($('#tariff_plans option:selected').val()) {
      if ($('#tariff_plans option:selected').val()) {
        if ($('#coaches option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), $('#promotions').val());
        } else {
          getPrice($('#tariff_plans option:selected').val(), 0, $('#promotions').val());
        }
      } else {
        $('.card-tariff-plan-visiting-count').html('');
        $('.card-tariff-plan-month-count').html('');
        $('.card-tariff-plan-price').html('');
        $('.card-promotion').html('');
        $('.card-promotionText').html('');
        $('.card-promotion-month').html('');
        $('.card-promotion-visiting').html('');
        $('.card-for-sale').html('');
      }
    } else {
      if ($('#tariff_plans option:selected').val()) {
        if ($('#coaches option:selected').val()) {
          getPrice($('#tariff_plans option:selected').val(), $('#coaches option:selected').val(), 0);
        } else {
          getPrice($('#tariff_plans option:selected').val(), 0, 0);
        }
      } else {
        $('.card-tariff-plan-visiting-count').html('');
        $('.card-tariff-plan-month-count').html('');
        $('.card-tariff-plan-price').html('');
        $('.card-promotion').html('');
        $('.card-promotionText').html('');
        $('.card-promotion-month').html('');
        $('.card-promotion-visiting').html('');
        $('.card-for-sale').html('');
      }
    }
  });

  function getPrice(tariffPlan) {
    var coach = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
    var promotion = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;

    if (parseInt(tariffPlan)) {
      $.ajax({
        type: 'GET',
        url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/abonements/get-price/' + parseInt(tariffPlan),
        data: {
          coach: parseInt(coach),
          promotion: parseInt(promotion)
        },
        headers: authHeaders
      }).then(function (data) {
        $('.card-tariff-plan-price').html(data.abonPrice + ' грн');
        $('.card-promotion').html(data.promotion + ' грн');
        $('.card-promotionText').html(data.promotionText);
        $('.card-tariff-plan-visiting').html(data.visiting + ' відв.');
        $('.card-tariff-plan-month').html(data.month);
        $('.card-promotion-month').html(data.promotionMonth);
        $('.card-promotion-visiting').html(data.promotionVisiting);
        $('.card-tariff-plan-visiting-count').html(data.visitingCount + ' відв.');
        $('.card-tariff-plan-month-count').html(data.monthCount);
        $('.card-for-sale').html(data.price + ' грн');
      });
    }
  }

  function selectCoach() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/abonements/get-coaches/' + $('#sections').val(),
      headers: authHeaders
    }).then(function (data) {
      $('#coaches').empty();
      $('#coaches').append('<option value="">-</option>');
      $.each(data, function (key, value) {
        $('#coaches').append('<option value="' + key + '">' + value + '</option>');
      });
      $('#coaches').trigger("chosen:updated");
    });
  }

  function selectTariffPlan() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/abonements/get-tariffPlans/' + $('#sections').val(),
      headers: authHeaders
    }).then(function (response) {
      $('#tariff_plans').empty();
      $('#tariff_plans').append('<option value="">-</option>');
      $.each(response, function (key, value) {
        $('#tariff_plans').append('<option' + ' value="' + value.id + '"' + 'data-price="' + value.price + '"' + 'data-coach-price="' + value.coach_price + '"' + 'data-use-from="' + value.use_from + '"' + 'data-use-to="' + value.use_to + '"' + 'data-visiting="' + value.visiting + '"' + 'data-month="' + value.month + '">' + value.name + '</option>');
      });
      $('#tariff_plans').trigger("chosen:updated");
    });
  }

  function selectPromotion() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/abonements/get-promotion/' + $('#sections').val(),
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
      url: '/account/api/object/' + $('#sections').attr('data-object') + '/control-panel/abonements/get-visitors/',
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
  });
});

/***/ }),

/***/ 27:
/*!******************************************************!*\
  !*** multi ./resources/js/acc/panel/abonementAdd.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\WEB\gym-control\resources\js\acc\panel\abonementAdd.js */"./resources/js/acc/panel/abonementAdd.js");


/***/ })

/******/ });