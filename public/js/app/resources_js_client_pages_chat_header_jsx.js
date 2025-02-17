"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_chat_header_jsx"],{

/***/ "./resources/js/client/pages/chat/header.jsx":
/*!***************************************************!*\
  !*** ./resources/js/client/pages/chat/header.jsx ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _phone_svg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./phone.svg */ "./resources/js/client/pages/chat/phone.svg");
/* harmony import */ var _close_svg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./close.svg */ "./resources/js/client/pages/chat/close.svg");
/* harmony import */ var _settings_svg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./settings.svg */ "./resources/js/client/pages/chat/settings.svg");
/* harmony import */ var _context__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./context */ "./resources/js/client/pages/chat/context.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");








var Header = function Header() {
  var vendor = "AppifYou";
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_context__WEBPACK_IMPORTED_MODULE_4__["default"].Consumer, {
    children: function children(_ref) {
      var close = _ref.close,
          setClose = _ref.setClose;
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "chat-header",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "chat-header-title",
          children: vendor
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "chat-header-actions",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
            className: "header-actions",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("img", {
              src: _phone_svg__WEBPACK_IMPORTED_MODULE_1__["default"],
              alt: "call"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("img", {
              src: _settings_svg__WEBPACK_IMPORTED_MODULE_3__["default"],
              alt: "settings"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("img", {
              src: _close_svg__WEBPACK_IMPORTED_MODULE_2__["default"],
              alt: "close",
              onClick: function onClick() {
                return setClose(!close);
              }
            })]
          })
        })]
      });
    }
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Header);

/***/ }),

/***/ "./resources/js/client/pages/chat/close.svg":
/*!**************************************************!*\
  !*** ./resources/js/client/pages/chat/close.svg ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/close.svg?0c08479edd7bb8f533b4d66463c27f95");

/***/ }),

/***/ "./resources/js/client/pages/chat/phone.svg":
/*!**************************************************!*\
  !*** ./resources/js/client/pages/chat/phone.svg ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/phone.svg?b27b6b92c48ecaedaecb1ca1923b68b1");

/***/ }),

/***/ "./resources/js/client/pages/chat/settings.svg":
/*!*****************************************************!*\
  !*** ./resources/js/client/pages/chat/settings.svg ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/settings.svg?5f7b4c8109703553e3bbb9327110da95");

/***/ })

}]);