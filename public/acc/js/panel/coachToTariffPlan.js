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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/acc/panel/coachToTariffPlan.js":
/*!*****************************************************!*\
  !*** ./resources/js/acc/panel/coachToTariffPlan.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var table = $('#coachToTariffPlan').DataTable({
    processing: true,
    serverSide: true,
    lengthMenu: [10, 25, 50],
    searching: false,
    ordering: false,
    language: {
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Ukrainian.json"
    },
    responsive: true,
    columns: [{
      name: "name",
      className: "table-text-align-center"
    }, {
      name: "contacts",
      className: "table-text-align-center"
    }, {
      name: "section",
      className: "table-text-align-center"
    }, {
      name: "status",
      className: "table-text-align-center"
    }],
    ajax: {
      url: '/account/api/object/' + $('#coachToTariffPlan').attr('data-object') + '/control-panel/coaches/get-tariff-plan-prices/' + $('#coachToTariffPlan').attr('data-coach'),
      type: "GET",
      data: {
        sections: function sections() {
          return $('#section-filter-btn').attr('data-sections');
        }
      },
      headers: authHeaders
    }
  });
  $('#addPrice').on('click', function () {
    $('#tariff-plans-modal').val('');
    $('#price-modal').val('');
    $('#add-price-modal').modal();
    getTariffPlans();
    $('#sections-modal').on('change', function () {
      getTariffPlans();
    });
    $('#alert-modal').empty();
  });
  $('body').on('click', '.editPrice', function () {
    $('#price-modal-edit').val($(this).attr('data-price'));
    $('#edit-price-modal').modal();
    $('#alert-modal-edit').empty();
    $('#editPriceButton').removeAttr('data-coach-to-tariff-plan');
    $('#editPriceButton').attr('data-coach-to-tariff-plan', $(this).attr('data-coach-to-tariff-plan'));
  });
  $('body').on('click', '#editPriceButton', function () {
    console.log(1);
    $.ajax({
      type: 'POST',
      url: '/account/api/object/' + $('#sections-modal').attr('data-object') + '/control-panel/coaches/edit-tariff-plan-price/' + $(this).attr('data-coach') + '/' + $(this).attr('data-coach-to-tariff-plan'),
      headers: authHeaders,
      data: {
        price: function price() {
          return $('#price-modal-edit').val();
        }
      }
    }).then(function (response) {
      if (!response.error) {
        $('#price-modal-edit').val('');
        $('#close-edit-alert').click();
        Swal.fire({
          type: 'success',
          title: 'Ціну змінено'
        });
        table.ajax.reload();
      } else {
        $.each(response.error, function (key, value) {
          $('#alert-modal-edit').append('<div class="alert alert-danger alert-modal role="alert">' + value + '</div>');
        });
      }
    });
  });
  $('body').on('click', '#addPriceButton', function () {
    console.log(1);
    $.ajax({
      type: 'POST',
      url: '/account/api/object/' + $('#sections-modal').attr('data-object') + '/control-panel/coaches/add-tariff-plan-price/' + $('#sections-modal').attr('data-coach'),
      headers: authHeaders,
      data: {
        section: function section() {
          return $('#sections-modal').val();
        },
        tariffPlan: function tariffPlan() {
          return $('#tariff-plans-modal').val();
        },
        price: function price() {
          return $('#price-modal').val();
        }
      }
    }).then(function (response) {
      if (!response.error) {
        $('#tariff-plans-modal').val('');
        $('#price-modal').val('');
        $('#close-add-alert').click();
        Swal.fire({
          type: 'success',
          title: 'Нову ціну добавлено',
          text: 'Ціну добавлено. Тепер її можна редагувати або видалити'
        });
        table.ajax.reload();
      } else {
        $.each(response.error, function (key, value) {
          $('#alert-modal').append('<div class="alert alert-danger alert-modal role="alert">' + value + '</div>');
        });
      }
    });
  });
  $('body').on('click', '.deleteCoachToTariffPlan', function () {
    var _this = this;

    Swal.fire({
      title: 'Ви впевнені?',
      text: 'Ви збираєтесь видалити ціну тренера на тарифний план "' + $(this).attr('data-tariff-plan-name') + '" ?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#22688b',
      cancelButtonColor: '#868e96',
      confirmButtonText: 'Так, видалити!',
      cancelButtonText: 'Відмінити!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: 'GET',
          url: '/account/api/object/' + $('#coachToTariffPlan').attr('data-object') + '/control-panel/coaches/delete-tariff-plan-price/' + $('#coachToTariffPlan').attr('data-coach') + '/' + $(_this).attr('data-id'),
          headers: authHeaders
        }).then(function (response) {
          if (response) {
            Swal.fire({
              type: 'success',
              title: 'Ціну тренера видалено',
              text: 'Ви можете добавити її знову в будь-який момент'
            });
          }

          table.ajax.reload();
        });
      }
    });
    return false;
  });

  function getTariffPlans() {
    $.ajax({
      type: 'GET',
      url: '/account/api/object/' + $('#sections-modal').attr('data-object') + '/control-panel/coaches/get-tariff-plans/' + $('#sections-modal').val() + '/' + $('#sections-modal').attr('data-coach'),
      headers: authHeaders
    }).then(function (response) {
      $('#tariff-plans-modal').empty();
      $.each(response, function (key, value) {
        $('#tariff-plans-modal').append('<option value="' + value.id + '">' + value.name + '</option>');
      });
      $('#tariff-plans-modal').trigger("chosen:updated");
    });
  } //SECTIONS_FILTER


  $('body').on('click', '#filter-sections-clear', function () {
    $('#filter-sections').val([]);
    $('#section-filter-btn').removeClass('btn-using');
    $('#section-filter-btn').attr('data-sections', '');
    table.ajax.reload();
  });
  $('body').on('click', '#filter-sections-close', function () {
    $('#section-filter-btn').click();
  });
  $('body').on('click', '#section-filter-btn', function () {
    var sections = $(this).attr('data-sections');

    if (sections) {
      var sectionsArray = sections.split(',');

      for (var i = 0; i < sectionsArray.length; i++) {
        $("#filter-sections [value=" + sectionsArray[i] + "]").attr("selected", "selected");
      }
    }
  });
  $('body').on('change', '#filter-sections', function () {
    if ($('#filter-sections').val()) {
      $('#section-filter-btn').addClass('btn-using');
      $('#section-filter-btn').attr('data-sections', $('#filter-sections').val());
    } else {
      $('#section-filter-btn').removeClass('btn-using');
    }

    table.ajax.reload();
  });
});

/***/ }),

/***/ 11:
/*!***********************************************************!*\
  !*** multi ./resources/js/acc/panel/coachToTariffPlan.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\WEB\gym-control\resources\js\acc\panel\coachToTariffPlan.js */"./resources/js/acc/panel/coachToTariffPlan.js");


/***/ })

/******/ });