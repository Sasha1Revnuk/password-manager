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
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/acc/panel/programCategories.js":
/*!*****************************************************!*\
  !*** ./resources/js/acc/panel/programCategories.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var table = $('#programCategories').DataTable({
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
      name: "section",
      className: "table-text-align-center"
    }, {
      name: "actions",
      className: "table-text-align-center"
    }],
    ajax: {
      url: '/account/api/object/' + $('#programCategories').attr('data-object') + '/control-panel/program-categories',
      type: "GET",
      data: {
        sections: function sections() {
          return $('#section-filter-btn').attr('data-sections');
        },
        name: function name() {
          return $('#name').val();
        }
      },
      headers: authHeaders
    }
  });
  $('#name').on('change', function () {
    table.ajax.reload();
  }); //SECTIONS_FILTER

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

/***/ 19:
/*!***********************************************************!*\
  !*** multi ./resources/js/acc/panel/programCategories.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\WEB\gym-control\resources\js\acc\panel\programCategories.js */"./resources/js/acc/panel/programCategories.js");


/***/ })

/******/ });