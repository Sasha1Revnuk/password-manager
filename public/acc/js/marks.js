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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/marks.js":
/*!*******************************!*\
  !*** ./resources/js/marks.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function resetData() {
    $('#editNameUrl').val(' ');
    $('#addNameUrl').val(' ');
  }

  var table = $('#marks').DataTable({
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
      className: "table-text-align-center",
      width: "30%"
    }, {
      name: "site",
      className: "table-text-align-center",
      width: "45%"
    }, {
      name: "actions",
      className: "table-text-align-center",
      width: "25%"
    }],
    ajax: {
      url: '/api/data/' + $('#marks').attr('data-user') + '/marks',
      type: "GET",
      headers: authHeaders
    }
  });
  $('.closeModal').click(function () {
    resetData();
  });
  $('body').on('click', '.delete', function () {
    var _this = this;

    Swal.fire({
      title: 'Ви впевнені?',
      text: 'Ви збираєтесь видалити посилання',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#8b1005',
      cancelButtonColor: '#1b960c',
      confirmButtonText: 'Так, видалити!',
      cancelButtonText: 'Ні, відмінити!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: 'POST',
          url: '/api/data/' + $('#marks').attr('data-user') + '/marks/delete/' + $(_this).attr('data-id'),
          headers: authHeaders
        }).then(function (response) {
          if (response == true) {
            Swal.fire({
              title: 'Посилання видалено',
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
  $('body').on('click', '.edit', function () {
    $('#editNameUrl').val($(this).attr('data-url'));
    $('#editMarkButton').attr('data-id', $(this).attr('data-id'));
  });
  $('#editMarkButton').on('click', function () {
    $.ajax({
      type: 'POST',
      url: '/api/data/' + $('#marks').attr('data-user') + '/marks/edit/' + $(this).attr('data-id'),
      headers: authHeaders,
      data: {
        'url': $('#editNameUrl').val()
      }
    }).then(function (response) {
      if (response) {
        Swal.fire({
          position: 'top-end',
          type: 'success',
          title: 'Закладка збережена',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          title: "\u041F\u043E\u043C\u0438\u043B\u043A\u0430. \u0421\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0449\u0435 \u0440\u0430\u0437"
        });
      }

      table.ajax.reload();
      $('.closeModal').click();
    });
  });
  $('#addMarkButton').on('click', function () {
    $.ajax({
      type: 'POST',
      url: '/api/data/' + $('#marks').attr('data-user') + '/marks/add',
      headers: authHeaders,
      data: {
        'url': $('#addNameUrl').val()
      }
    }).then(function (response) {
      if (response) {
        Swal.fire({
          position: 'top-end',
          type: 'success',
          title: 'Закладка додана',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          title: "\u041F\u043E\u043C\u0438\u043B\u043A\u0430. \u0421\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0449\u0435 \u0440\u0430\u0437"
        });
      }

      table.ajax.reload();
      $('.closeModal').click();
    });
  });
});

/***/ }),

/***/ 6:
/*!**********************************!*\
  !*** multi ./resources/js/marks ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\Учеба\password-manager\resources\js\marks */"./resources/js/marks.js");


/***/ })

/******/ });