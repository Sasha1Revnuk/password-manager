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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/quicks.js":
/*!********************************!*\
  !*** ./resources/js/quicks.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function resetData() {
    $('#passstrength').removeClass();
    $("#addModalForm").trigger("reset");
    $('#passstrengthPolosa').css("width", "0%");
    $('#passstrengthPolosa').attr('aria-valuenow', '0');
    $('#passstrengthSpan').html(' ');
    $('#groupName').val(' ');
  }

  var table = $('#webs').DataTable({
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
      name: "fa",
      className: "table-text-align-center",
      width: "5%"
    }, {
      name: "site",
      className: "table-text-align-center",
      width: "50%"
    }, {
      name: "login",
      className: "table-text-align-center",
      width: "20%"
    }, {
      name: "actions",
      className: "table-text-align-center",
      width: "25%"
    }],
    ajax: {
      url: '/api/data/' + $('#webs').attr('data-user') + '/quick',
      type: "GET",
      data: {
        url: function url() {
          return $('#url').val();
        }
      },
      headers: authHeaders
    }
  });
  $('#url').on('focus', function () {
    $(this).attr('readonly', true);
    $(this).removeAttr('readonly');
  });
  $('#url').focusout(function () {
    $(this).attr('readonly');
    $(this).removeAttr('readonly');
  });
  $('#url').keyup($.debounce(250, function (e) {
    table.ajax.reload();
  }));
  $('.closeModal').click(function () {
    resetData();
  });
  $('body').on('click', '.deleteWeb', function () {
    var _this = this;

    Swal.fire({
      title: 'Ви впевнені?',
      text: 'Ви збираєтесь видалити ресурс',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#8b1005',
      cancelButtonColor: '#1b960c',
      confirmButtonText: 'Так, видалити!',
      cancelButtonText: 'Ні, відмінити!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: 'GET',
          url: '/api/data/' + $('#webs').attr('data-user') + '/webs/delete/' + $(_this).attr('data-id'),
          headers: authHeaders
        }).then(function (response) {
          if (response == true) {
            Swal.fire({
              title: 'Ресурс видалено',
              type: 'info',
              confirmButtonColor: '#22688b',
              confirmButtonText: 'OK'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Відміна',
          text: 'Видалення не відбулось',
          type: 'error',
          confirmButtonColor: '#d33d33',
          confirmButtonText: 'OK'
        });
      }

      table.ajax.reload();
    });
  });
  $('body').on('click', '.deleteObl', function () {
    var _this2 = this;

    Swal.fire({
      title: 'Ви впевнені?',
      text: 'Ви збираєтесь видалити обліковий запис',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#8b1005',
      cancelButtonColor: '#1b960c',
      confirmButtonText: 'Так, видалити!',
      cancelButtonText: 'Ні, відмінити!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: 'GET',
          url: '/api/data/' + $('#webs').attr('data-user') + '/webs/delete-resource/' + $(_this2).attr('data-id'),
          headers: authHeaders
        }).then(function (response) {
          if (response == true) {
            Swal.fire({
              title: 'Обліковий запис видалено',
              type: 'info',
              confirmButtonColor: '#22688b',
              confirmButtonText: 'OK'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Відміна',
          text: 'Видалення не відбулось',
          type: 'error',
          confirmButtonColor: '#d33d33',
          confirmButtonText: 'OK'
        });
      }

      table.ajax.reload();
    });
  });
  $('body').on('click', '.copyPassword', function () {
    var _this3 = this;

    if ($(this).attr('data-method') == 1) {
      Swal.fire({
        title: 'Введіть секретний пароль',
        input: 'password',
        showCancelButton: true,
        confirmButtonText: 'Скопіювати пароль',
        cancelButtonText: 'Відмінити',
        showLoaderOnConfirm: false,
        preConfirm: function preConfirm(secret) {
          return secret;
        },
        allowOutsideClick: function allowOutsideClick() {
          return !Swal.isLoading();
        }
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type: 'GET',
            url: '/api/data/' + $('#webs').attr('data-user') + '/webs/getSavePassword/' + $(_this3).attr('data-id'),
            headers: authHeaders,
            data: {
              'secret': result.value
            }
          }).then(function (response) {
            if (response) {
              var $temp = $("<input>");
              $("body").append($temp);
              $temp.val(response).select();
              document.execCommand("copy");
              $temp.remove();
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Пароль скопійовано',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              Swal.fire({
                type: 'error',
                title: "\u041F\u043E\u043C\u0438\u043B\u043A\u0430. \u0421\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0449\u0435 \u0440\u0430\u0437"
              });
            }
          });
        } else {
          Swal.fire({
            type: 'error',
            title: "\u0412\u0456\u0434\u043C\u0456\u043D\u0430!"
          });
        }
      });
    } else {
      $.ajax({
        type: 'GET',
        url: '/api/data/' + $('#webs').attr('data-user') + '/webs/getSavePassword/' + $(this).attr('data-id'),
        headers: authHeaders
      }).then(function (response) {
        if (response) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(response).select();
          document.execCommand("copy");
          $temp.remove();
          Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Пароль скопійовано',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            type: 'error',
            title: "\u041F\u043E\u043C\u0438\u043B\u043A\u0430. \u0421\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0449\u0435 \u0440\u0430\u0437"
          });
        }
      });
    }
  });
  $('body').on('click', '.addToQuick', function () {
    $.ajax({
      type: 'GET',
      url: '/api/data/' + $('#webs').attr('data-user') + '/webs/add-to-quick/' + $(this).attr('data-id'),
      headers: authHeaders
    }).then(function (response) {
      if (response) {
        Swal.fire({
          position: 'top-end',
          type: 'success',
          title: 'Виконано',
          text: response,
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          title: "\u041F\u043E\u043C\u0438\u043B\u043A\u0430. \u0421\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0449\u0435 \u0440\u0430\u0437"
        });
      }
    });
    table.ajax.reload();
  });
});

/***/ }),

/***/ 5:
/*!***********************************!*\
  !*** multi ./resources/js/quicks ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\Учеба\password-manager\resources\js\quicks */"./resources/js/quicks.js");


/***/ })

/******/ });