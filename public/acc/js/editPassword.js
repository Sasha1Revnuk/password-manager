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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/editPassword.js":
/*!**************************************!*\
  !*** ./resources/js/editPassword.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  //Показати або сховати пароль при доаванні чи редагуванні
  $('.changeTypePassword').on('click', function (event) {
    event.preventDefault();

    if ($($(this).attr('data-input')).attr('type') == 'password') {
      $($(this).attr('data-input')).attr('type', 'text');
      $(this).attr('title', 'Приховати пароль');
      $($(this).attr('data-i')).removeClass('fa-toggle-off');
      $($(this).attr('data-i')).addClass('fa-toggle-on');
    } else {
      $($(this).attr('data-input')).attr('type', 'password');
      $($(this).attr('data-i')).removeClass('fa-toggle-on');
      $($(this).attr('data-i')).addClass('fa-toggle-off');
      $(this).attr('title', 'Показати пароль');
    }
  });
  $('#url').on('focus', function () {
    $(this).attr('readonly', true);
    $(this).removeAttr('readonly');
  }); //Генерація пароля

  $('.generatePassword').click(function () {
    event.preventDefault();
    $.ajax({
      type: 'GET',
      url: '/api/data/' + $('#webs').attr('data-user') + '/webs/generate-password',
      headers: authHeaders,
      data: {
        big: function big() {
          return $('.bigLetters').is(':checked') ? 1 : 0;
        },
        sym: function sym() {
          return $('.symbols').is(':checked') ? 1 : 0;
        },
        count: function count() {
          return $('.passwordLength').val();
        }
      }
    }).then(function (response) {
      $('.passwordModalEdit').focus();
      $('.passwordModalEdit').val(response);
      $('.passwordModalEdit').blur();
    });
  }); //Додавання пароля

  $('#passwordModalEdit').on('keyup focus', function () {
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{8,}).*", "g");

    if (false == enoughRegex.test($(this).val())) {
      $('#passstrength').removeClass().addClass('alert-danger ');
      $('#passstrengthEditResource').removeClass().addClass('alert-danger ');
      $('.passstrengthPolosa').css("width", "15%");
      $('.passstrengthPolosa').attr('aria-valuenow', '15');
      $('.passstrengthSpan').html(' ');
      $('.passstrengthSpan').html('Не меньше 8 символів!');
    } else if (strongRegex.test($(this).val())) {
      $('#passstrength').removeClass().addClass('alert-success');
      $('#passstrengthEditResource').removeClass().addClass('alert-success');
      $('.passstrengthPolosa').css("width", "100%");
      $('.passstrengthPolosa').attr('aria-valuenow', '100');
      $('.passstrengthSpan').html(' ');
      $('.passstrengthSpan').html('Сильний пароль!');
    } else if (mediumRegex.test($(this).val())) {
      $('#passstrength').removeClass().addClass('alert-warning');
      $('#passstrengthEditResource').removeClass().addClass('alert-warning');
      $('.passstrengthPolosa').css("width", '75%');
      $('.passstrengthPolosa').attr('aria-valuenow', '75');
      $('.passstrengthSpan').html(' ');
      $('.passstrengthSpan').html('Средній пароль!');
    } else {
      $('#passstrength').removeClass().addClass('alert-danger');
      $('#passstrengthEditResource').removeClass().addClass('alert-danger');
      $('.passstrengthPolosa').css("width", "45%");
      $('.passstrengthPolosa').attr('aria-valuenow', '45');
      $('.passstrengthSpan').html(' ');
      $('.passstrengthSpan').html('Слабкий пароль!');
    }

    return true;
  });
});

/***/ }),

/***/ 3:
/*!*****************************************!*\
  !*** multi ./resources/js/editPassword ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\Учеба\password-manager\resources\js\editPassword */"./resources/js/editPassword.js");


/***/ })

/******/ });