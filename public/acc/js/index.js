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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/index.js":
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#changePassword').on('click', function () {
    $.ajax({
      type: 'GET',
      url: '/api/change-password/' + $(this).attr('data-user'),
      headers: authHeaders,
      data: {
        password: function password() {
          return $('#password').val();
        },
        password_confirmation: function password_confirmation() {
          return $('#password_confirmation').val();
        },
        secret: function secret() {
          return $('#secret').val();
        }
      }
    }).then(function (response) {
      $('#password').val('');
      $('#password_confirmation').val('');
      $('#secret').val('');
      $('#closeButton').click();

      if (response == true) {
        Swal.fire({
          title: 'Пароль змінено',
          text: 'Ви успішно змінили пароль',
          type: 'info',
          confirmButtonColor: '#22688b',
          confirmButtonText: 'OK'
        });
      } else {
        Swal.fire({
          title: 'Пароль не змінено',
          text: 'Невдала спроба змінити пароль',
          type: 'error',
          confirmButtonColor: '#d33d33',
          confirmButtonText: 'OK'
        });
      }
    });
  });
  $('#changeSecret').on('click', function () {
    var _this = this;

    Swal.fire({
      title: 'Ви впевнені?',
      text: 'Ви збираєтесь змінити секретний пароль. Всі облікові записи, додані за допомогою попереднього секретного пароля, будуть знищені. Продовжити?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#8b4d04',
      cancelButtonColor: '#1b960c',
      confirmButtonText: 'Так, змінити і видалити!',
      cancelButtonText: 'Ні, я згадаю свій секретний пароль!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          type: 'GET',
          url: '/api/change-password-secret/' + $(_this).attr('data-user'),
          headers: authHeaders
        }).then(function (response) {
          if (response == true) {
            Swal.fire({
              title: 'Секретний пароль змінено',
              text: 'Ви успішно змінили секретний пароль. Перевірте свою поштову скриньку.',
              type: 'info',
              confirmButtonColor: '#22688b',
              confirmButtonText: 'OK'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Секретний пароль не змінено',
          text: 'Невдала спроба змінити секретний пароль',
          type: 'error',
          confirmButtonColor: '#d33d33',
          confirmButtonText: 'OK'
        });
      }
    });
    return false;
  });
});

/***/ }),

/***/ 0:
/*!**********************************!*\
  !*** multi ./resources/js/index ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\Учеба\password-manager\resources\js\index */"./resources/js/index.js");


/***/ })

/******/ });