(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_checkout_form_js"],{

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/@mantine/hooks/esm/use-form/use-form.js":
/*!**************************************************************!*\
  !*** ./node_modules/@mantine/hooks/esm/use-form/use-form.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useForm": () => (/* binding */ useForm)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _use_input_state_use_input_state_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../use-input-state/use-input-state.js */ "./node_modules/@mantine/hooks/esm/use-input-state/use-input-state.js");



var __defProp = Object.defineProperty;
var __defProps = Object.defineProperties;
var __getOwnPropDescs = Object.getOwnPropertyDescriptors;
var __getOwnPropSymbols = Object.getOwnPropertySymbols;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __propIsEnum = Object.prototype.propertyIsEnumerable;
var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
var __spreadValues = (a, b) => {
  for (var prop in b || (b = {}))
    if (__hasOwnProp.call(b, prop))
      __defNormalProp(a, prop, b[prop]);
  if (__getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(b)) {
      if (__propIsEnum.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    }
  return a;
};
var __spreadProps = (a, b) => __defProps(a, __getOwnPropDescs(b));
function useForm({
  initialValues,
  validationRules = {},
  errorMessages = {}
}) {
  const initialErrors = Object.keys(initialValues).reduce((acc, field) => {
    acc[field] = null;
    return acc;
  }, {});
  const [errors, setErrors] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(initialErrors);
  const [values, setValues] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(initialValues);
  const resetErrors = () => setErrors(initialErrors);
  const reset = () => {
    setValues(initialValues);
    resetErrors();
  };
  const validate = () => {
    let isValid = true;
    const validationErrors = Object.keys(values).reduce((acc, field) => {
      if (validationRules && typeof validationRules[field] === "function" && !validationRules[field](values[field], values)) {
        acc[field] = errorMessages[field] || true;
        isValid = false;
      } else {
        acc[field] = null;
      }
      return acc;
    }, {});
    setErrors(validationErrors);
    return isValid;
  };
  const validateField = (field) => setErrors((currentErrors) => __spreadProps(__spreadValues({}, currentErrors), {
    [field]: typeof validationRules[field] === "function" ? validationRules[field](values[field], values) ? null : errorMessages[field] || true : null
  }));
  const setFieldError = (field, error) => setErrors((currentErrors) => __spreadProps(__spreadValues({}, currentErrors), { [field]: error }));
  const setFieldValue = (field, value) => {
    setValues((currentValues) => __spreadProps(__spreadValues({}, currentValues), { [field]: value }));
    setFieldError(field, null);
  };
  const onSubmit = (handleSubmit) => (event) => {
    event && event.preventDefault();
    validate() && handleSubmit(values);
  };
  const getInputProps = (field, options) => ({
    [(options == null ? void 0 : options.type) === "checkbox" ? "checked" : "value"]: values[field],
    onChange: (0,_use_input_state_use_input_state_js__WEBPACK_IMPORTED_MODULE_1__.getInputOnChange)((val) => setFieldValue(field, val)),
    error: errors[field] || void 0
  });
  return {
    values,
    errors,
    validate,
    reset,
    setErrors,
    setValues,
    setFieldValue,
    setFieldError,
    validateField,
    resetErrors,
    onSubmit,
    getInputProps
  };
}


//# sourceMappingURL=use-form.js.map


/***/ }),

/***/ "./node_modules/@mantine/hooks/esm/use-input-state/use-input-state.js":
/*!****************************************************************************!*\
  !*** ./node_modules/@mantine/hooks/esm/use-input-state/use-input-state.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getInputOnChange": () => (/* binding */ getInputOnChange),
/* harmony export */   "useInputState": () => (/* binding */ useInputState)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


function getInputOnChange(setValue) {
  return (val) => {
    if (!val) {
      setValue(val);
    } else if (typeof val === "function") {
      setValue(val);
    } else if (typeof val === "object" && "nativeEvent" in val) {
      const { currentTarget } = val;
      if (currentTarget.type === "checkbox") {
        setValue(currentTarget.checked);
      } else {
        setValue(currentTarget.value);
      }
    } else {
      setValue(val);
    }
  };
}
function useInputState(initialState) {
  const [value, setValue] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(initialState);
  return [value, getInputOnChange(setValue)];
}


//# sourceMappingURL=use-input-state.js.map


/***/ }),

/***/ "./node_modules/@stripe/stripe-js/dist/pure.js":
/*!*****************************************************!*\
  !*** ./node_modules/@stripe/stripe-js/dist/pure.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({ value: true }));

function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    _typeof = function (obj) {
      return typeof obj;
    };
  } else {
    _typeof = function (obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

var V3_URL = 'https://js.stripe.com/v3';
var V3_URL_REGEX = /^https:\/\/js\.stripe\.com\/v3\/?(\?.*)?$/;
var EXISTING_SCRIPT_MESSAGE = 'loadStripe.setLoadParameters was called but an existing Stripe.js script already exists in the document; existing script parameters will be used';
var findScript = function findScript() {
  var scripts = document.querySelectorAll("script[src^=\"".concat(V3_URL, "\"]"));

  for (var i = 0; i < scripts.length; i++) {
    var script = scripts[i];

    if (!V3_URL_REGEX.test(script.src)) {
      continue;
    }

    return script;
  }

  return null;
};

var injectScript = function injectScript(params) {
  var queryString = params && !params.advancedFraudSignals ? '?advancedFraudSignals=false' : '';
  var script = document.createElement('script');
  script.src = "".concat(V3_URL).concat(queryString);
  var headOrBody = document.head || document.body;

  if (!headOrBody) {
    throw new Error('Expected document.body not to be null. Stripe.js requires a <body> element.');
  }

  headOrBody.appendChild(script);
  return script;
};

var registerWrapper = function registerWrapper(stripe, startTime) {
  if (!stripe || !stripe._registerWrapper) {
    return;
  }

  stripe._registerWrapper({
    name: 'stripe-js',
    version: "1.22.0",
    startTime: startTime
  });
};

var stripePromise = null;
var loadScript = function loadScript(params) {
  // Ensure that we only attempt to load Stripe.js at most once
  if (stripePromise !== null) {
    return stripePromise;
  }

  stripePromise = new Promise(function (resolve, reject) {
    if (typeof window === 'undefined') {
      // Resolve to null when imported server side. This makes the module
      // safe to import in an isomorphic code base.
      resolve(null);
      return;
    }

    if (window.Stripe && params) {
      console.warn(EXISTING_SCRIPT_MESSAGE);
    }

    if (window.Stripe) {
      resolve(window.Stripe);
      return;
    }

    try {
      var script = findScript();

      if (script && params) {
        console.warn(EXISTING_SCRIPT_MESSAGE);
      } else if (!script) {
        script = injectScript(params);
      }

      script.addEventListener('load', function () {
        if (window.Stripe) {
          resolve(window.Stripe);
        } else {
          reject(new Error('Stripe.js not available'));
        }
      });
      script.addEventListener('error', function () {
        reject(new Error('Failed to load Stripe.js'));
      });
    } catch (error) {
      reject(error);
      return;
    }
  });
  return stripePromise;
};
var initStripe = function initStripe(maybeStripe, args, startTime) {
  if (maybeStripe === null) {
    return null;
  }

  var stripe = maybeStripe.apply(undefined, args);
  registerWrapper(stripe, startTime);
  return stripe;
};
var validateLoadParams = function validateLoadParams(params) {
  var errorMessage = "invalid load parameters; expected object of shape\n\n    {advancedFraudSignals: boolean}\n\nbut received\n\n    ".concat(JSON.stringify(params), "\n");

  if (params === null || _typeof(params) !== 'object') {
    throw new Error(errorMessage);
  }

  if (Object.keys(params).length === 1 && typeof params.advancedFraudSignals === 'boolean') {
    return params;
  }

  throw new Error(errorMessage);
};

var loadParams;
var loadStripeCalled = false;
var loadStripe = function loadStripe() {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  loadStripeCalled = true;
  var startTime = Date.now();
  return loadScript(loadParams).then(function (maybeStripe) {
    return initStripe(maybeStripe, args, startTime);
  });
};

loadStripe.setLoadParameters = function (params) {
  if (loadStripeCalled) {
    throw new Error('You cannot change load parameters after calling loadStripe');
  }

  loadParams = validateLoadParams(params);
};

exports.loadStripe = loadStripe;


/***/ }),

/***/ "./node_modules/@stripe/stripe-js/pure.js":
/*!************************************************!*\
  !*** ./node_modules/@stripe/stripe-js/pure.js ***!
  \************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! ./dist/pure.js */ "./node_modules/@stripe/stripe-js/dist/pure.js");


/***/ }),

/***/ "./resources/js/client/constant/index.js":
/*!***********************************************!*\
  !*** ./resources/js/client/constant/index.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PUBLIC_KEY": () => (/* binding */ PUBLIC_KEY)
/* harmony export */ });
// const PUBLIC_KEY = "FLWPUBK-7a7ede7e61dd67ed26bbb398af684006-X";
// export const PUBLIC_KEY = "FLWPUBK-7a7ede7e61dd67ed26bbb398af684006-X";
var PUBLIC_KEY = "FLWPUBK_TEST-647f6289f74aba024f10cc12f71bd6a2-X";

/***/ }),

/***/ "./resources/js/client/pages/checkout/form.js":
/*!****************************************************!*\
  !*** ./resources/js/client/pages/checkout/form.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_hooks__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @mantine/hooks */ "./node_modules/@mantine/hooks/esm/use-form/use-form.js");
/* harmony import */ var interweave__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! interweave */ "./node_modules/interweave/esm/index.js");
/* harmony import */ var react_loading_skeleton__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-loading-skeleton */ "./node_modules/react-loading-skeleton/dist/index.mjs");
/* harmony import */ var react_loading_skeleton_dist_skeleton_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-loading-skeleton/dist/skeleton.css */ "./node_modules/react-loading-skeleton/dist/skeleton.css");
/* harmony import */ var _stripe_stripe_js_pure__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @stripe/stripe-js/pure */ "./node_modules/@stripe/stripe-js/pure.js");
/* harmony import */ var _constant__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../constant */ "./resources/js/client/constant/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }








/**
 * Internal Dependencies
 */




_stripe_stripe_js_pure__WEBPACK_IMPORTED_MODULE_3__.loadStripe.setLoadParameters({
  advancedFraudSignals: false
});

var handleStripePayments = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee(values) {
    var stripe;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return (0,_stripe_stripe_js_pure__WEBPACK_IMPORTED_MODULE_3__.loadStripe)("pk_test_TYooMQauvdEDq54NiTphI7jx");

          case 2:
            stripe = _context.sent;
            stripe.redirectToCheckout({
              items: [{
                sku: "sku_Hkx9gjqXx8XxX",
                quantity: 1
              }],
              successUrl: "https://example.com/success",
              cancelUrl: "https://example.com/cancel"
            });

          case 4:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));

  return function handleStripePayments(_x) {
    return _ref.apply(this, arguments);
  };
}();

var CheckoutForm = function CheckoutForm(_ref2) {
  var countries = _ref2.countries,
      nextStep = _ref2.nextStep;

  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(JSON.parse(localStorage.getItem("cartReact"))),
      _useState2 = _slicedToArray(_useState, 2),
      data = _useState2[0],
      setData = _useState2[1];

  var _useState3 = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)("flutterwave"),
      _useState4 = _slicedToArray(_useState3, 2),
      paymentMethod = _useState4[0],
      setPaymentMethod = _useState4[1];

  var form = (0,_mantine_hooks__WEBPACK_IMPORTED_MODULE_6__.useForm)({
    initialValues: {
      email: "",
      firstname: "",
      lastname: "",
      address: "",
      country: "",
      zip: "",
      state: "",
      companyname: "",
      paymentMethod: "",
      termsOfService: false
    },
    validationRules: {
      email: function email(value) {
        return /^\S+@\S+$/.test(value);
      }
    }
  });
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(react__WEBPACK_IMPORTED_MODULE_1__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("section", {
      className: "pt-5 pb-5",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
        className: "container",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
          className: "row",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("h3", {
            className: "display-5 mb-2 text-center",
            children: "Checkout"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
            className: "col-md-4 order-md-2 mb-4",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("h4", {
              className: "d-flex justify-content-between align-items-center mb-3",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
                className: "text-muted",
                children: "Your cart"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
                className: "badge badge-secondary badge-pill",
                children: data.count
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(react__WEBPACK_IMPORTED_MODULE_1__.Suspense, {
              fallback: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(react_loading_skeleton__WEBPACK_IMPORTED_MODULE_7__["default"], {}),
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("ul", {
                className: "list-group mb-3",
                children: [data.cart.map(function (product) {
                  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("li", {
                    className: "list-group-item d-flex justify-content-between lh-condensed",
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("h6", {
                        className: "my-0",
                        children: product.name
                      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("small", {
                        className: "text-muted",
                        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(interweave__WEBPACK_IMPORTED_MODULE_8__["default"], {
                          content: product.description
                        })
                      })]
                    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("span", {
                      className: "text-muted",
                      children: ["$", product.price]
                    })]
                  }, product.id);
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("li", {
                  className: "list-group-item d-flex justify-content-between",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
                    children: "Total (USD)"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("strong", {
                    children: ["$", data.total]
                  })]
                })]
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("form", {
              className: "card p-2",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "input-group",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
                  type: "text",
                  className: "form-control",
                  placeholder: "Promo code"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                  className: "input-group-append",
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("button", {
                    type: "submit",
                    className: "btn btn-secondary",
                    children: "Redeem"
                  })
                })]
              })
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
            className: "col-md-8 order-md-1",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("h4", {
              className: "mb-3",
              children: "Billing address"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("form", {
              className: "needs-validation",
              noValidate: true,
              onSubmit: form.onSubmit(function (values) {
                values.paymentMethod = paymentMethod;
                console.log(values); //initialize flutterwave payment modal

                if (paymentMethod === "flutterwave") {
                  //flutterwave payment modal
                  var firstname = values.firstname,
                      lastname = values.lastname;
                  var paySettings = {
                    public_key: _constant__WEBPACK_IMPORTED_MODULE_4__.PUBLIC_KEY,
                    tx_ref: "VC-12345" + Date.now(),
                    amount: data.total,
                    currency: "USD",
                    country: "US",
                    payment_options: "card,ussd,account,banktransfer,qr,mobilemoneyghana,paypal",
                    customer: {
                      email: values.email,
                      phonenumber: "07064586146",
                      name: firstname + " " + lastname
                    },
                    callback: function callback(data) {
                      console.log(data);

                      if (data.status === "successful") {
                        fmp.close();
                        nextStep();
                      }
                    },
                    onclose: function onclose() {
                      //do nothing if payment has not been made
                      console.log("close");
                    },
                    customizations: {
                      title: "Payment for vicomma order #3663",
                      description: "Payment for items in cart",
                      logo: "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png"
                    }
                  };
                  var fmp = FlutterwaveCheckout(paySettings);
                } else {
                  handleStripePayments(values);
                }
              }),
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "row",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "col-md-6 mb-3",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    htmlFor: "firstName",
                    children: "First name"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", _objectSpread(_objectSpread({
                    type: "text",
                    className: "form-control",
                    id: "firstName",
                    placeholder: ""
                  }, form.getInputProps("firstname")), {}, {
                    required: true
                  })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                    className: "invalid-feedback",
                    children: "Valid first name is required."
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "col-md-6 mb-3",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    htmlFor: "lastName",
                    children: "Last name"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", _objectSpread(_objectSpread({
                    type: "text",
                    className: "form-control",
                    id: "lastName",
                    placeholder: ""
                  }, form.getInputProps("lastname")), {}, {
                    required: true
                  })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                    className: "invalid-feedback",
                    children: "Valid last name is required."
                  })]
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "mb-3",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("label", {
                  htmlFor: "email",
                  children: ["Email", " "]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", _objectSpread({
                  type: "email",
                  className: "form-control",
                  id: "email",
                  placeholder: "you@example.com"
                }, form.getInputProps("email"))), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                  className: "invalid-feedback",
                  children: "Please enter a valid email address for shipping updates."
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "mb-3",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                  htmlFor: "address",
                  children: "Address"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", _objectSpread(_objectSpread({
                  type: "text",
                  className: "form-control",
                  id: "address",
                  placeholder: "1234 Main St"
                }, form.getInputProps("address")), {}, {
                  required: true
                })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                  className: "invalid-feedback",
                  children: "Please enter your shipping address."
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "mb-3",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("label", {
                  htmlFor: "address2",
                  children: ["Address 2", " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
                    className: "text-muted",
                    children: "(Optional)"
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
                  type: "text",
                  className: "form-control",
                  id: "address2",
                  placeholder: "Apartment or suite"
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "row",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "col-md-5 mb-3",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    htmlFor: "country",
                    children: "Country"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("select", _objectSpread(_objectSpread({
                    className: "custom-select d-block w-100",
                    id: "country"
                  }, form.getInputProps("country")), {}, {
                    required: true,
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("option", {
                      value: "",
                      children: "Choose..."
                    }), countries.map(function (country) {
                      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("option", {
                        value: country.sort,
                        children: country.name
                      }, country.sort);
                    })]
                  })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                    className: "invalid-feedback",
                    children: "Please select a valid country."
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "col-md-4 mb-3",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    htmlFor: "state",
                    children: "State"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("select", _objectSpread(_objectSpread({
                    className: "custom-select d-block w-100",
                    id: "state"
                  }, form.getInputProps("state")), {}, {
                    required: true,
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("option", {
                      value: "",
                      children: "Choose..."
                    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("option", {
                      children: "California"
                    })]
                  })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                    className: "invalid-feedback",
                    children: "Please provide a valid state."
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "col-md-3 mb-3",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    htmlFor: "zip",
                    children: "Zip"
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", _objectSpread(_objectSpread({
                    type: "text",
                    className: "form-control",
                    id: "zip",
                    placeholder: ""
                  }, form.getInputProps("zip")), {}, {
                    required: true
                  })), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
                    className: "invalid-feedback",
                    children: "Zip code required/."
                  })]
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("hr", {
                className: "mb-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "custom-control custom-checkbox",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
                  type: "checkbox",
                  className: "custom-control-input",
                  id: "save-info"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                  className: "custom-control-label",
                  htmlFor: "save-info",
                  children: "Save this information for next time"
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("hr", {
                className: "mb-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("h4", {
                className: "mb-3",
                children: "Payment"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                className: "d-block my-3",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "custom-control custom-radio",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
                    id: "flutterwave",
                    name: "paymentMethod",
                    type: "radio",
                    className: "custom-control-input",
                    onClick: function onClick() {
                      return setPaymentMethod("flutterwave");
                    },
                    required: true
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    className: "custom-control-label",
                    htmlFor: "flutterwave",
                    children: "Flutterwave"
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
                  className: "custom-control custom-radio",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
                    id: "stripe",
                    name: "paymentMethod",
                    type: "radio",
                    className: "custom-control-input",
                    onClick: function onClick() {
                      return setPaymentMethod("stripe");
                    },
                    required: true
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
                    className: "custom-control-label",
                    htmlFor: "stripe",
                    children: "Stripe"
                  })]
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("hr", {
                className: "mb-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("button", {
                className: "btn btn-primary btn-lg btn-block",
                type: "submit",
                children: "Pay Now"
              })]
            })]
          })]
        })
      })
    })
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CheckoutForm);

/***/ }),

/***/ "./node_modules/escape-html/index.js":
/*!*******************************************!*\
  !*** ./node_modules/escape-html/index.js ***!
  \*******************************************/
/***/ ((module) => {

"use strict";
/*!
 * escape-html
 * Copyright(c) 2012-2013 TJ Holowaychuk
 * Copyright(c) 2015 Andreas Lubbe
 * Copyright(c) 2015 Tiancheng "Timothy" Gu
 * MIT Licensed
 */



/**
 * Module variables.
 * @private
 */

var matchHtmlRegExp = /["'&<>]/;

/**
 * Module exports.
 * @public
 */

module.exports = escapeHtml;

/**
 * Escape special characters in the given string of html.
 *
 * @param  {string} string The string to escape for inserting into HTML
 * @return {string}
 * @public
 */

function escapeHtml(string) {
  var str = '' + string;
  var match = matchHtmlRegExp.exec(str);

  if (!match) {
    return str;
  }

  var escape;
  var html = '';
  var index = 0;
  var lastIndex = 0;

  for (index = match.index; index < str.length; index++) {
    switch (str.charCodeAt(index)) {
      case 34: // "
        escape = '&quot;';
        break;
      case 38: // &
        escape = '&amp;';
        break;
      case 39: // '
        escape = '&#39;';
        break;
      case 60: // <
        escape = '&lt;';
        break;
      case 62: // >
        escape = '&gt;';
        break;
      default:
        continue;
    }

    if (lastIndex !== index) {
      html += str.substring(lastIndex, index);
    }

    lastIndex = index + 1;
    html += escape;
  }

  return lastIndex !== index
    ? html + str.substring(lastIndex, index)
    : html;
}


/***/ }),

/***/ "./node_modules/interweave/esm/index.js":
/*!**********************************************!*\
  !*** ./node_modules/interweave/esm/index.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "ALLOWED_TAG_LIST": () => (/* binding */ ALLOWED_TAG_LIST),
/* harmony export */   "ATTRIBUTES": () => (/* binding */ ATTRIBUTES),
/* harmony export */   "ATTRIBUTES_TO_PROPS": () => (/* binding */ ATTRIBUTES_TO_PROPS),
/* harmony export */   "BANNED_TAG_LIST": () => (/* binding */ BANNED_TAG_LIST),
/* harmony export */   "Element": () => (/* binding */ Element),
/* harmony export */   "FILTER_ALLOW": () => (/* binding */ FILTER_ALLOW),
/* harmony export */   "FILTER_CAST_BOOL": () => (/* binding */ FILTER_CAST_BOOL),
/* harmony export */   "FILTER_CAST_NUMBER": () => (/* binding */ FILTER_CAST_NUMBER),
/* harmony export */   "FILTER_DENY": () => (/* binding */ FILTER_DENY),
/* harmony export */   "FILTER_NO_CAST": () => (/* binding */ FILTER_NO_CAST),
/* harmony export */   "Filter": () => (/* binding */ Filter),
/* harmony export */   "Markup": () => (/* binding */ Markup),
/* harmony export */   "Matcher": () => (/* binding */ Matcher),
/* harmony export */   "Parser": () => (/* binding */ Parser),
/* harmony export */   "TAGS": () => (/* binding */ TAGS),
/* harmony export */   "TYPE_EMBEDDED": () => (/* binding */ TYPE_EMBEDDED),
/* harmony export */   "TYPE_FLOW": () => (/* binding */ TYPE_FLOW),
/* harmony export */   "TYPE_HEADING": () => (/* binding */ TYPE_HEADING),
/* harmony export */   "TYPE_INTERACTIVE": () => (/* binding */ TYPE_INTERACTIVE),
/* harmony export */   "TYPE_PALPABLE": () => (/* binding */ TYPE_PALPABLE),
/* harmony export */   "TYPE_PHRASING": () => (/* binding */ TYPE_PHRASING),
/* harmony export */   "TYPE_SECTION": () => (/* binding */ TYPE_SECTION),
/* harmony export */   "match": () => (/* binding */ match)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var escape_html__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! escape-html */ "./node_modules/escape-html/index.js");
/* harmony import */ var escape_html__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(escape_html__WEBPACK_IMPORTED_MODULE_1__);
function _objectWithoutPropertiesLoose(source, excluded) { if (source == null) return {}; var target = {}; var sourceKeys = Object.keys(source); var key, i; for (i = 0; i < sourceKeys.length; i++) { key = sourceKeys[i]; if (excluded.indexOf(key) >= 0) continue; target[key] = source[key]; } return target; }

function _inheritsLoose(subClass, superClass) { subClass.prototype = Object.create(superClass.prototype); subClass.prototype.constructor = subClass; _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _extends2() { _extends2 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends2.apply(this, arguments); }

// Generated with Packemon: https://packemon.dev
// Platform: browser, Support: stable, Format: esm



function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

function Element(_ref) {
  var _ref$attributes = _ref.attributes,
      attributes = _ref$attributes === void 0 ? {} : _ref$attributes,
      className = _ref.className,
      _ref$children = _ref.children,
      children = _ref$children === void 0 ? null : _ref$children,
      _ref$selfClose = _ref.selfClose,
      selfClose = _ref$selfClose === void 0 ? false : _ref$selfClose,
      tagName = _ref.tagName;
  var Tag = tagName;
  return selfClose ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Tag, _extends({
    className: className
  }, attributes)) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Tag, _extends({
    className: className
  }, attributes), children);
}

var Filter = /*#__PURE__*/function () {
  function Filter() {}

  var _proto = Filter.prototype;

  /**
   * Filter and clean an HTML attribute value.
   */
  _proto.attribute = function attribute(name, value) {
    return value;
  }
  /**
   * Filter and clean an HTML node.
   */
  ;

  _proto.node = function node(name, _node) {
    return _node;
  };

  return Filter;
}();
/* eslint-disable no-bitwise, no-magic-numbers, sort-keys */
// https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Content_categories


var TYPE_FLOW = 1;
var TYPE_SECTION = 1 << 1;
var TYPE_HEADING = 1 << 2;
var TYPE_PHRASING = 1 << 3;
var TYPE_EMBEDDED = 1 << 4;
var TYPE_INTERACTIVE = 1 << 5;
var TYPE_PALPABLE = 1 << 6; // https://developer.mozilla.org/en-US/docs/Web/HTML/Element

var tagConfigs = {
  a: {
    content: TYPE_FLOW | TYPE_PHRASING,
    self: false,
    type: TYPE_FLOW | TYPE_PHRASING | TYPE_INTERACTIVE | TYPE_PALPABLE
  },
  address: {
    invalid: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'address', 'article', 'aside', 'section', 'div', 'header', 'footer'],
    self: false
  },
  audio: {
    children: ['track', 'source']
  },
  br: {
    type: TYPE_FLOW | TYPE_PHRASING,
    void: true
  },
  body: {
    content: TYPE_FLOW | TYPE_SECTION | TYPE_HEADING | TYPE_PHRASING | TYPE_EMBEDDED | TYPE_INTERACTIVE | TYPE_PALPABLE
  },
  button: {
    content: TYPE_PHRASING,
    type: TYPE_FLOW | TYPE_PHRASING | TYPE_INTERACTIVE | TYPE_PALPABLE
  },
  caption: {
    content: TYPE_FLOW,
    parent: ['table']
  },
  col: {
    parent: ['colgroup'],
    void: true
  },
  colgroup: {
    children: ['col'],
    parent: ['table']
  },
  details: {
    children: ['summary'],
    type: TYPE_FLOW | TYPE_INTERACTIVE | TYPE_PALPABLE
  },
  dd: {
    content: TYPE_FLOW,
    parent: ['dl']
  },
  dl: {
    children: ['dt', 'dd'],
    type: TYPE_FLOW
  },
  dt: {
    content: TYPE_FLOW,
    invalid: ['footer', 'header'],
    parent: ['dl']
  },
  figcaption: {
    content: TYPE_FLOW,
    parent: ['figure']
  },
  footer: {
    invalid: ['footer', 'header']
  },
  header: {
    invalid: ['footer', 'header']
  },
  hr: {
    type: TYPE_FLOW,
    void: true
  },
  img: {
    void: true
  },
  li: {
    content: TYPE_FLOW,
    parent: ['ul', 'ol', 'menu']
  },
  main: {
    self: false
  },
  ol: {
    children: ['li'],
    type: TYPE_FLOW
  },
  picture: {
    children: ['source', 'img'],
    type: TYPE_FLOW | TYPE_PHRASING | TYPE_EMBEDDED
  },
  rb: {
    parent: ['ruby', 'rtc']
  },
  rp: {
    parent: ['ruby', 'rtc']
  },
  rt: {
    content: TYPE_PHRASING,
    parent: ['ruby', 'rtc']
  },
  rtc: {
    content: TYPE_PHRASING,
    parent: ['ruby']
  },
  ruby: {
    children: ['rb', 'rp', 'rt', 'rtc']
  },
  source: {
    parent: ['audio', 'video', 'picture'],
    void: true
  },
  summary: {
    content: TYPE_PHRASING,
    parent: ['details']
  },
  table: {
    children: ['caption', 'colgroup', 'thead', 'tbody', 'tfoot', 'tr'],
    type: TYPE_FLOW
  },
  tbody: {
    parent: ['table'],
    children: ['tr']
  },
  td: {
    content: TYPE_FLOW,
    parent: ['tr']
  },
  tfoot: {
    parent: ['table'],
    children: ['tr']
  },
  th: {
    content: TYPE_FLOW,
    parent: ['tr']
  },
  thead: {
    parent: ['table'],
    children: ['tr']
  },
  tr: {
    parent: ['table', 'tbody', 'thead', 'tfoot'],
    children: ['th', 'td']
  },
  track: {
    parent: ['audio', 'video'],
    void: true
  },
  ul: {
    children: ['li'],
    type: TYPE_FLOW
  },
  video: {
    children: ['track', 'source']
  },
  wbr: {
    type: TYPE_FLOW | TYPE_PHRASING,
    void: true
  }
};

function createConfigBuilder(config) {
  return function (tagName) {
    tagConfigs[tagName] = _extends2({}, config, tagConfigs[tagName]);
  };
}

['address', 'main', 'div', 'figure', 'p', 'pre'].forEach(createConfigBuilder({
  content: TYPE_FLOW,
  type: TYPE_FLOW | TYPE_PALPABLE
}));
['abbr', 'b', 'bdi', 'bdo', 'cite', 'code', 'data', 'dfn', 'em', 'i', 'kbd', 'mark', 'q', 'ruby', 'samp', 'strong', 'sub', 'sup', 'time', 'u', 'var'].forEach(createConfigBuilder({
  content: TYPE_PHRASING,
  type: TYPE_FLOW | TYPE_PHRASING | TYPE_PALPABLE
}));
['p', 'pre'].forEach(createConfigBuilder({
  content: TYPE_PHRASING,
  type: TYPE_FLOW | TYPE_PALPABLE
}));
['s', 'small', 'span', 'del', 'ins'].forEach(createConfigBuilder({
  content: TYPE_PHRASING,
  type: TYPE_FLOW | TYPE_PHRASING
}));
['article', 'aside', 'footer', 'header', 'nav', 'section', 'blockquote'].forEach(createConfigBuilder({
  content: TYPE_FLOW,
  type: TYPE_FLOW | TYPE_SECTION | TYPE_PALPABLE
}));
['h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(createConfigBuilder({
  content: TYPE_PHRASING,
  type: TYPE_FLOW | TYPE_HEADING | TYPE_PALPABLE
}));
['audio', 'canvas', 'iframe', 'img', 'video'].forEach(createConfigBuilder({
  type: TYPE_FLOW | TYPE_PHRASING | TYPE_EMBEDDED | TYPE_PALPABLE
})); // Disable this map from being modified

var TAGS = Object.freeze(tagConfigs); // Tags that should never be allowed, even if the allow list is disabled

var BANNED_TAG_LIST = ['applet', 'base', 'body', 'command', 'embed', 'frame', 'frameset', 'head', 'html', 'link', 'meta', 'noscript', 'object', 'script', 'style', 'title'];
var ALLOWED_TAG_LIST = Object.keys(TAGS).filter(function (tag) {
  return tag !== 'canvas' && tag !== 'iframe';
}); // Filters apply to HTML attributes

var FILTER_ALLOW = 1;
var FILTER_DENY = 2;
var FILTER_CAST_NUMBER = 3;
var FILTER_CAST_BOOL = 4;
var FILTER_NO_CAST = 5; // Attributes not listed here will be denied
// https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes

var ATTRIBUTES = Object.freeze({
  alt: FILTER_ALLOW,
  cite: FILTER_ALLOW,
  class: FILTER_ALLOW,
  colspan: FILTER_CAST_NUMBER,
  controls: FILTER_CAST_BOOL,
  datetime: FILTER_ALLOW,
  default: FILTER_CAST_BOOL,
  disabled: FILTER_CAST_BOOL,
  dir: FILTER_ALLOW,
  height: FILTER_ALLOW,
  href: FILTER_ALLOW,
  id: FILTER_ALLOW,
  kind: FILTER_ALLOW,
  label: FILTER_ALLOW,
  lang: FILTER_ALLOW,
  loading: FILTER_ALLOW,
  loop: FILTER_CAST_BOOL,
  media: FILTER_ALLOW,
  muted: FILTER_CAST_BOOL,
  poster: FILTER_ALLOW,
  role: FILTER_ALLOW,
  rowspan: FILTER_CAST_NUMBER,
  scope: FILTER_ALLOW,
  sizes: FILTER_ALLOW,
  span: FILTER_CAST_NUMBER,
  start: FILTER_CAST_NUMBER,
  style: FILTER_NO_CAST,
  src: FILTER_ALLOW,
  srclang: FILTER_ALLOW,
  srcset: FILTER_ALLOW,
  target: FILTER_ALLOW,
  title: FILTER_ALLOW,
  type: FILTER_ALLOW,
  width: FILTER_ALLOW
}); // Attributes to camel case for React props

var ATTRIBUTES_TO_PROPS = Object.freeze({
  class: 'className',
  colspan: 'colSpan',
  datetime: 'dateTime',
  rowspan: 'rowSpan',
  srclang: 'srcLang',
  srcset: 'srcSet'
});
var INVALID_STYLES = /(url|image|image-set)\(/i;

var StyleFilter = /*#__PURE__*/function (_Filter) {
  _inheritsLoose(StyleFilter, _Filter);

  function StyleFilter() {
    return _Filter.apply(this, arguments) || this;
  }

  var _proto2 = StyleFilter.prototype;

  _proto2.attribute = function attribute(name, value) {
    if (name === 'style') {
      Object.keys(value).forEach(function (key) {
        if (String(value[key]).match(INVALID_STYLES)) {
          // eslint-disable-next-line no-param-reassign
          delete value[key];
        }
      });
    }

    return value;
  };

  return StyleFilter;
}(Filter);
/* eslint-disable no-bitwise, no-cond-assign, complexity */


var ELEMENT_NODE = 1;
var TEXT_NODE = 3;
var INVALID_ROOTS = /^<(!doctype|(html|head|body)(\s|>))/i;
var ALLOWED_ATTRS = /^(aria\x2D|data\x2D|[0-9A-Z_a-z\u017F\u212A]+:)/i;
var OPEN_TOKEN = /{{{(\w+)\/?}}}/;

function createDocument() {
  // Maybe SSR? Just do nothing instead of crashing!
  if (typeof window === 'undefined' || typeof document === 'undefined') {
    return undefined;
  }

  return document.implementation.createHTMLDocument('Interweave');
}

var Parser = /*#__PURE__*/function () {
  function Parser(markup, props, matchers, filters) {
    if (props === void 0) {
      props = {};
    }

    if (matchers === void 0) {
      matchers = [];
    }

    if (filters === void 0) {
      filters = [];
    }

    this.allowed = void 0;
    this.banned = void 0;
    this.blocked = void 0;
    this.container = void 0;
    this.content = [];
    this.props = void 0;
    this.matchers = void 0;
    this.filters = void 0;
    this.keyIndex = void 0;

    if (true) {
      if (markup && typeof markup !== 'string') {
        throw new TypeError('Interweave parser requires a valid string.');
      }
    }

    this.props = props;
    this.matchers = matchers;
    this.filters = [].concat(filters, [new StyleFilter()]);
    this.keyIndex = -1;
    this.container = this.createContainer(markup || '');
    this.allowed = new Set(props.allowList || ALLOWED_TAG_LIST);
    this.banned = new Set(BANNED_TAG_LIST);
    this.blocked = new Set(props.blockList);
  }
  /**
   * Loop through and apply all registered attribute filters.
   */


  var _proto3 = Parser.prototype;

  _proto3.applyAttributeFilters = function applyAttributeFilters(name, value) {
    return this.filters.reduce(function (nextValue, filter) {
      return nextValue !== null && typeof filter.attribute === 'function' ? filter.attribute(name, nextValue) : nextValue;
    }, value);
  }
  /**
   * Loop through and apply all registered node filters.
   */
  ;

  _proto3.applyNodeFilters = function applyNodeFilters(name, node) {
    // Allow null to be returned
    return this.filters.reduce(function (nextNode, filter) {
      return nextNode !== null && typeof filter.node === 'function' ? filter.node(name, nextNode) : nextNode;
    }, node);
  }
  /**
   * Loop through and apply all registered matchers to the string.
   * If a match is found, create a React element, and build a new array.
   * This array allows React to interpolate and render accordingly.
   */
  ;

  _proto3.applyMatchers = function applyMatchers(string, parentConfig) {
    var _this = this;

    var elements = {};
    var props = this.props;
    var matchedString = string;
    var elementIndex = 0;
    var parts = null;
    this.matchers.forEach(function (matcher) {
      var tagName = matcher.asTag().toLowerCase();

      var config = _this.getTagConfig(tagName); // Skip matchers that have been disabled from props or are not supported


      if (props[matcher.inverseName] || !_this.isTagAllowed(tagName)) {
        return;
      } // Skip matchers in which the child cannot be rendered


      if (!_this.canRenderChild(parentConfig, config)) {
        return;
      } // Continuously trigger the matcher until no matches are found


      var tokenizedString = '';

      while (matchedString && (parts = matcher.match(matchedString))) {
        var _parts = parts,
            index = _parts.index,
            length = _parts.length,
            _match = _parts.match,
            valid = _parts.valid,
            isVoid = _parts.void,
            partProps = _objectWithoutPropertiesLoose(_parts, ["index", "length", "match", "valid", "void"]);

        var tokenName = matcher.propName + elementIndex; // Piece together a new string with interpolated tokens

        if (index > 0) {
          tokenizedString += matchedString.slice(0, index);
        }

        if (valid) {
          tokenizedString += isVoid ? "{{{" + tokenName + "/}}}" : "{{{" + tokenName + "}}}" + _match + "{{{/" + tokenName + "}}}";
          _this.keyIndex += 1;
          elementIndex += 1;
          elements[tokenName] = {
            children: _match,
            matcher: matcher,
            props: _extends2({}, props, partProps, {
              key: _this.keyIndex
            })
          };
        } else {
          tokenizedString += _match;
        } // Reduce the string being matched against,
        // otherwise we end up in an infinite loop!


        if (matcher.greedy) {
          matchedString = tokenizedString + matchedString.slice(index + length);
          tokenizedString = '';
        } else {
          // eslint-disable-next-line unicorn/explicit-length-check
          matchedString = matchedString.slice(index + (length || _match.length));
        }
      } // Update the matched string with the tokenized string,
      // so that the next matcher can apply to it.


      if (!matcher.greedy) {
        matchedString = tokenizedString + matchedString;
      }
    });

    if (elementIndex === 0) {
      return string;
    }

    return this.replaceTokens(matchedString, elements);
  }
  /**
   * Determine whether the child can be rendered within the parent.
   */
  ;

  _proto3.canRenderChild = function canRenderChild(parentConfig, childConfig) {
    if (!parentConfig.tagName || !childConfig.tagName) {
      return false;
    } // No children


    if (parentConfig.void) {
      return false;
    } // Valid children


    if (parentConfig.children.length > 0) {
      return parentConfig.children.includes(childConfig.tagName);
    }

    if (parentConfig.invalid.length > 0 && parentConfig.invalid.includes(childConfig.tagName)) {
      return false;
    } // Valid parent


    if (childConfig.parent.length > 0) {
      return childConfig.parent.includes(parentConfig.tagName);
    } // Self nesting


    if (!parentConfig.self && parentConfig.tagName === childConfig.tagName) {
      return false;
    } // Content category type


    return Boolean(parentConfig && parentConfig.content & childConfig.type);
  }
  /**
   * Convert line breaks in a string to HTML `<br/>` tags.
   * If the string contains HTML, we should not convert anything,
   * as line breaks should be handled by `<br/>`s in the markup itself.
   */
  ;

  _proto3.convertLineBreaks = function convertLineBreaks(markup) {
    var _this$props = this.props,
        noHtml = _this$props.noHtml,
        disableLineBreaks = _this$props.disableLineBreaks;

    if (noHtml || disableLineBreaks || markup.match(/<((?:\/[ a-z]+)|(?:[ a-z]+\/))>/gi)) {
      return markup;
    } // Replace carriage returns


    var nextMarkup = markup.replace(/\r\n/g, '\n'); // Replace long line feeds

    nextMarkup = nextMarkup.replace(/\n{3,}/g, '\n\n\n'); // Replace line feeds with `<br/>`s

    nextMarkup = nextMarkup.replace(/\n/g, '<br/>');
    return nextMarkup;
  }
  /**
   * Create a detached HTML document that allows for easy HTML
   * parsing while not triggering scripts or loading external
   * resources.
   */
  ;

  _proto3.createContainer = function createContainer(markup) {
    var factory = typeof __webpack_require__.g !== 'undefined' && __webpack_require__.g.INTERWEAVE_SSR_POLYFILL || createDocument;
    var doc = factory();

    if (!doc) {
      return undefined;
    }

    var tag = this.props.containerTagName || 'body';
    var el = tag === 'body' || tag === 'fragment' ? doc.body : doc.createElement(tag);

    if (markup.match(INVALID_ROOTS)) {
      if (true) {
        throw new Error('HTML documents as Interweave content are not supported.');
      }
    } else {
      el.innerHTML = this.convertLineBreaks(this.props.escapeHtml ? escape_html__WEBPACK_IMPORTED_MODULE_1___default()(markup) : markup);
    }

    return el;
  }
  /**
   * Convert an elements attribute map to an object map.
   * Returns null if no attributes are defined.
   */
  ;

  _proto3.extractAttributes = function extractAttributes(node) {
    var _this2 = this;

    var allowAttributes = this.props.allowAttributes;
    var attributes = {};
    var count = 0;

    if (node.nodeType !== ELEMENT_NODE || !node.attributes) {
      return null;
    }

    Array.from(node.attributes).forEach(function (attr) {
      var name = attr.name,
          value = attr.value;
      var newName = name.toLowerCase();
      var filter = ATTRIBUTES[newName] || ATTRIBUTES[name]; // Verify the node is safe from attacks

      if (!_this2.isSafe(node)) {
        return;
      } // Do not allow denied attributes, excluding ARIA attributes
      // Do not allow events or XSS injections


      if (!newName.match(ALLOWED_ATTRS)) {
        if (!allowAttributes && (!filter || filter === FILTER_DENY) || newName.startsWith('on') || value.replace(/(\s|\0|&#x0([9AD]);)/, '').match(/(javascript|vbscript|livescript|xss):/i)) {
          return;
        }
      } // Apply attribute filters


      var newValue = newName === 'style' ? _this2.extractStyleAttribute(node) : value; // Cast to boolean

      if (filter === FILTER_CAST_BOOL) {
        newValue = true; // Cast to number
      } else if (filter === FILTER_CAST_NUMBER) {
        newValue = Number.parseFloat(String(newValue)); // Cast to string
      } else if (filter !== FILTER_NO_CAST) {
        newValue = String(newValue);
      }

      attributes[ATTRIBUTES_TO_PROPS[newName] || newName] = _this2.applyAttributeFilters(newName, newValue);
      count += 1;
    });

    if (count === 0) {
      return null;
    }

    return attributes;
  }
  /**
   * Extract the style attribute as an object and remove values that allow for attack vectors.
   */
  ;

  _proto3.extractStyleAttribute = function extractStyleAttribute(node) {
    var styles = {};
    Array.from(node.style).forEach(function (key) {
      var value = node.style[key];

      if (typeof value === 'string' || typeof value === 'number') {
        styles[key.replace(/-([a-z])/g, function (match, letter) {
          return letter.toUpperCase();
        })] = value;
      }
    });
    return styles;
  }
  /**
   * Return configuration for a specific tag.
   */
  ;

  _proto3.getTagConfig = function getTagConfig(tagName) {
    var common = {
      children: [],
      content: 0,
      invalid: [],
      parent: [],
      self: true,
      tagName: '',
      type: 0,
      void: false
    }; // Only spread when a tag config exists,
    // otherwise we use the empty `tagName`
    // for parent config inheritance.

    if (TAGS[tagName]) {
      return _extends2({}, common, TAGS[tagName], {
        tagName: tagName
      });
    }

    return common;
  }
  /**
   * Verify that a node is safe from XSS and injection attacks.
   */
  ;

  _proto3.isSafe = function isSafe(node) {
    // URLs should only support HTTP, email and phone numbers
    if (typeof HTMLAnchorElement !== 'undefined' && node instanceof HTMLAnchorElement) {
      var href = node.getAttribute('href'); // Fragment protocols start with about:
      // So let's just allow them

      if (href && href.charAt(0) === '#') {
        return true;
      }

      var protocol = node.protocol.toLowerCase();
      return protocol === ':' || protocol === 'http:' || protocol === 'https:' || protocol === 'mailto:' || protocol === 'tel:';
    }

    return true;
  }
  /**
   * Verify that an HTML tag is allowed to render.
   */
  ;

  _proto3.isTagAllowed = function isTagAllowed(tagName) {
    if (this.banned.has(tagName) || this.blocked.has(tagName)) {
      return false;
    }

    return this.props.allowElements || this.allowed.has(tagName);
  }
  /**
   * Parse the markup by injecting it into a detached document,
   * while looping over all child nodes and generating an
   * array to interpolate into JSX.
   */
  ;

  _proto3.parse = function parse() {
    if (!this.container) {
      return [];
    }

    return this.parseNode(this.container, this.getTagConfig(this.container.nodeName.toLowerCase()));
  }
  /**
   * Loop over the nodes children and generate a
   * list of text nodes and React elements.
   */
  ;

  _proto3.parseNode = function parseNode(parentNode, parentConfig) {
    var _this3 = this;

    var _this$props2 = this.props,
        noHtml = _this$props2.noHtml,
        noHtmlExceptMatchers = _this$props2.noHtmlExceptMatchers,
        allowElements = _this$props2.allowElements,
        transform = _this$props2.transform,
        transformOnlyAllowList = _this$props2.transformOnlyAllowList;
    var content = [];
    var mergedText = '';
    Array.from(parentNode.childNodes).forEach(function (node) {
      // Create React elements from HTML elements
      if (node.nodeType === ELEMENT_NODE) {
        var tagName = node.nodeName.toLowerCase();

        var config = _this3.getTagConfig(tagName); // Persist any previous text


        if (mergedText) {
          content.push(mergedText);
          mergedText = '';
        } // Apply node filters first


        var nextNode = _this3.applyNodeFilters(tagName, node);

        if (!nextNode) {
          return;
        } // Apply transformation second


        var children;

        if (transform && !(transformOnlyAllowList && !_this3.isTagAllowed(tagName))) {
          _this3.keyIndex += 1;
          var key = _this3.keyIndex; // Must occur after key is set

          children = _this3.parseNode(nextNode, config);
          var transformed = transform(nextNode, children, config);

          if (transformed === null) {
            return;
          } else if (typeof transformed !== 'undefined') {
            content.push( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.cloneElement(transformed, {
              key: key
            }));
            return;
          } // Reset as we're not using the transformation


          _this3.keyIndex = key - 1;
        } // Never allow these tags (except via a transformer)


        if (_this3.banned.has(tagName)) {
          return;
        } // Only render when the following criteria is met:
        //  - HTML has not been disabled
        //  - Tag is allowed
        //  - Child is valid within the parent


        if (!(noHtml || noHtmlExceptMatchers && tagName !== 'br') && _this3.isTagAllowed(tagName) && (allowElements || _this3.canRenderChild(parentConfig, config))) {
          _this3.keyIndex += 1; // Build the props as it makes it easier to test

          var attributes = _this3.extractAttributes(nextNode);

          var elementProps = {
            tagName: tagName
          };

          if (attributes) {
            elementProps.attributes = attributes;
          }

          if (config.void) {
            elementProps.selfClose = config.void;
          }

          content.push( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, _extends2({}, elementProps, {
            key: _this3.keyIndex
          }), children || _this3.parseNode(nextNode, config))); // Render the children of the current element only.
          // Important: If the current element is not allowed,
          // use the parent element for the next scope.
        } else {
          content = content.concat(_this3.parseNode(nextNode, config.tagName ? config : parentConfig));
        } // Apply matchers if a text node

      } else if (node.nodeType === TEXT_NODE) {
        var text = noHtml && !noHtmlExceptMatchers ? node.textContent : _this3.applyMatchers(node.textContent || '', parentConfig);

        if (Array.isArray(text)) {
          content = content.concat(text);
        } else {
          mergedText += text;
        }
      }
    });

    if (mergedText) {
      content.push(mergedText);
    }

    return content;
  }
  /**
   * Deconstruct the string into an array, by replacing custom tokens with React elements,
   * so that React can render it correctly.
   */
  ;

  _proto3.replaceTokens = function replaceTokens(tokenizedString, elements) {
    if (!tokenizedString.includes('{{{')) {
      return tokenizedString;
    }

    var nodes = [];
    var text = tokenizedString;
    var open = null; // Find an open token tag

    while (open = text.match(OPEN_TOKEN)) {
      var _open = open,
          _match2 = _open[0],
          tokenName = _open[1];
      var startIndex = open.index;

      var isVoid = _match2.includes('/');

      if (true) {
        if (!elements[tokenName]) {
          throw new Error("Token \"" + tokenName + "\" found but no matching element to replace with.");
        }
      } // Extract the previous non-token text


      if (startIndex > 0) {
        nodes.push(text.slice(0, startIndex)); // Reduce text so that the closing tag will be found after the opening

        text = text.slice(startIndex);
      }

      var _elements$tokenName = elements[tokenName],
          children = _elements$tokenName.children,
          matcher = _elements$tokenName.matcher,
          elementProps = _elements$tokenName.props;
      var endIndex = void 0; // Use tag as-is if void

      if (isVoid) {
        endIndex = _match2.length;
        nodes.push(matcher.createElement(children, elementProps)); // Find the closing tag if not void
      } else {
        var close = text.match(new RegExp("{{{/" + tokenName + "}}}"));

        if (true) {
          if (!close) {
            throw new Error("Closing token missing for interpolated element \"" + tokenName + "\".");
          }
        }

        endIndex = close.index + close[0].length;
        nodes.push(matcher.createElement(this.replaceTokens(text.slice(_match2.length, close.index), elements), elementProps));
      } // Reduce text for the next interation


      text = text.slice(endIndex);
    } // Extra the remaining text


    if (text.length > 0) {
      nodes.push(text);
    } // Reduce to a string if possible


    if (nodes.length === 0) {
      return '';
    } else if (nodes.length === 1 && typeof nodes[0] === 'string') {
      return nodes[0];
    }

    return nodes;
  };

  return Parser;
}();
/* eslint-disable react/jsx-fragments */


function Markup(props) {
  var attributes = props.attributes,
      className = props.className,
      containerTagName = props.containerTagName,
      content = props.content,
      emptyContent = props.emptyContent,
      parsedContent = props.parsedContent,
      tagName = props.tagName;
  var tag = containerTagName || tagName || 'span';
  var noWrap = tag === 'fragment' ? true : props.noWrap;
  var mainContent;

  if (parsedContent) {
    mainContent = parsedContent;
  } else {
    var markup = new Parser(content || '', props).parse();

    if (markup.length > 0) {
      mainContent = markup;
    }
  }

  if (!mainContent) {
    mainContent = emptyContent;
  }

  if (noWrap) {
    // eslint-disable-next-line react/jsx-no-useless-fragment
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, mainContent);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, {
    attributes: attributes,
    className: className,
    tagName: tag
  }, mainContent);
}

function Interweave(props) {
  var attributes = props.attributes,
      className = props.className,
      _props$content = props.content,
      content = _props$content === void 0 ? '' : _props$content,
      _props$disableFilters = props.disableFilters,
      disableFilters = _props$disableFilters === void 0 ? false : _props$disableFilters,
      _props$disableMatcher = props.disableMatchers,
      disableMatchers = _props$disableMatcher === void 0 ? false : _props$disableMatcher,
      _props$emptyContent = props.emptyContent,
      emptyContent = _props$emptyContent === void 0 ? null : _props$emptyContent,
      _props$filters = props.filters,
      filters = _props$filters === void 0 ? [] : _props$filters,
      _props$matchers = props.matchers,
      matchers = _props$matchers === void 0 ? [] : _props$matchers,
      _props$onAfterParse = props.onAfterParse,
      onAfterParse = _props$onAfterParse === void 0 ? null : _props$onAfterParse,
      _props$onBeforeParse = props.onBeforeParse,
      onBeforeParse = _props$onBeforeParse === void 0 ? null : _props$onBeforeParse,
      _props$tagName = props.tagName,
      tagName = _props$tagName === void 0 ? 'span' : _props$tagName,
      _props$noWrap = props.noWrap,
      noWrap = _props$noWrap === void 0 ? false : _props$noWrap,
      parserProps = _objectWithoutPropertiesLoose(props, ["attributes", "className", "content", "disableFilters", "disableMatchers", "emptyContent", "filters", "matchers", "onAfterParse", "onBeforeParse", "tagName", "noWrap"]);

  var allMatchers = disableMatchers ? [] : matchers;
  var allFilters = disableFilters ? [] : filters;
  var beforeCallbacks = onBeforeParse ? [onBeforeParse] : [];
  var afterCallbacks = onAfterParse ? [onAfterParse] : []; // Inherit callbacks from matchers

  allMatchers.forEach(function (matcher) {
    if (matcher.onBeforeParse) {
      beforeCallbacks.push(matcher.onBeforeParse.bind(matcher));
    }

    if (matcher.onAfterParse) {
      afterCallbacks.push(matcher.onAfterParse.bind(matcher));
    }
  }); // Trigger before callbacks

  var markup = beforeCallbacks.reduce(function (string, callback) {
    var nextString = callback(string, props);

    if (true) {
      if (typeof nextString !== 'string') {
        throw new TypeError('Interweave `onBeforeParse` must return a valid HTML string.');
      }
    }

    return nextString;
  }, content || ''); // Parse the markup

  var parser = new Parser(markup, parserProps, allMatchers, allFilters); // Trigger after callbacks

  var nodes = afterCallbacks.reduce(function (parserNodes, callback) {
    var nextNodes = callback(parserNodes, props);

    if (true) {
      if (!Array.isArray(nextNodes)) {
        throw new TypeError('Interweave `onAfterParse` must return an array of strings and React elements.');
      }
    }

    return nextNodes;
  }, parser.parse());
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Markup, {
    attributes: attributes,
    className: className,
    containerTagName: props.containerTagName,
    emptyContent: emptyContent,
    tagName: tagName,
    noWrap: noWrap,
    parsedContent: nodes.length === 0 ? undefined : nodes
  });
}
/**
 * Trigger the actual pattern match and package the matched
 * response through a callback.
 */


function match(string, pattern, callback, isVoid) {
  if (isVoid === void 0) {
    isVoid = false;
  }

  var matches = string.match(pattern instanceof RegExp ? pattern : new RegExp(pattern, 'i'));

  if (!matches) {
    return null;
  }

  return _extends2({
    match: matches[0],
    void: isVoid
  }, callback(matches), {
    index: matches.index,
    length: matches[0].length,
    valid: true
  });
}

var Matcher = /*#__PURE__*/function () {
  function Matcher(name, options, factory) {
    this.greedy = false;
    this.options = void 0;
    this.propName = void 0;
    this.inverseName = void 0;
    this.factory = void 0;

    if (true) {
      if (!name || name.toLowerCase() === 'html') {
        throw new Error("The matcher name \"" + name + "\" is not allowed.");
      }
    } // @ts-expect-error


    this.options = _extends2({}, options);
    this.propName = name;
    this.inverseName = "no" + (name.charAt(0).toUpperCase() + name.slice(1));
    this.factory = factory || null;
  }
  /**
   * Attempts to create a React element using a custom user provided factory,
   * or the default matcher factory.
   */


  var _proto4 = Matcher.prototype;

  _proto4.createElement = function createElement(children, props) {
    var element = this.factory ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(this.factory, props, children) : this.replaceWith(children, props);

    if (true) {
      if (typeof element !== 'string' && ! /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.isValidElement(element)) {
        throw new Error("Invalid React element created from " + this.constructor.name + ".");
      }
    }

    return element;
  }
  /**
   * Trigger the actual pattern match and package the matched
   * response through a callback.
   */
  ;

  _proto4.doMatch = function doMatch(string, pattern, callback, isVoid) {
    if (isVoid === void 0) {
      isVoid = false;
    }

    return match(string, pattern, callback, isVoid);
  }
  /**
   * Callback triggered before parsing.
   */
  ;

  _proto4.onBeforeParse = function onBeforeParse(content, props) {
    return content;
  }
  /**
   * Callback triggered after parsing.
   */
  ;

  _proto4.onAfterParse = function onAfterParse(content, props) {
    return content;
  }
  /**
   * Replace the match with a React element based on the matched token and optional props.
   */
  ;

  return Matcher;
}();
/**
 * @copyright   2016-2019, Miles Johnson
 * @license     https://opensource.org/licenses/MIT
 */


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Interweave);

//# sourceMappingURL=index.js.map


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/react-loading-skeleton/dist/skeleton.css":
/*!************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/react-loading-skeleton/dist/skeleton.css ***!
  \************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "@-webkit-keyframes react-loading-skeleton {\n    100% {\n        -webkit-transform: translateX(100%);\n                transform: translateX(100%);\n    }\n}\n\n@keyframes react-loading-skeleton {\n    100% {\n        -webkit-transform: translateX(100%);\n                transform: translateX(100%);\n    }\n}\n\n.react-loading-skeleton {\n    --base-color: #ebebeb;\n    --highlight-color: #f5f5f5;\n    --animation-duration: 1.5s;\n    --animation-direction: normal;\n    --pseudo-element-display: block; /* Enable animation */\n\n    background-color: var(--base-color);\n\n    width: 100%;\n    border-radius: 0.25rem;\n    display: inline-flex;\n    line-height: 1;\n\n    position: relative;\n    overflow: hidden;\n    z-index: 1; /* Necessary for overflow: hidden to work correctly in Safari */\n}\n\n.react-loading-skeleton::after {\n    content: ' ';\n    display: var(--pseudo-element-display);\n    position: absolute;\n    left: 0;\n    right: 0;\n    height: 100%;\n    background-repeat: no-repeat;\n    background-image: linear-gradient(\n        90deg,\n        var(--base-color),\n        var(--highlight-color),\n        var(--base-color)\n    );\n    -webkit-transform: translateX(-100%);\n            transform: translateX(-100%);\n\n    -webkit-animation-name: react-loading-skeleton;\n\n            animation-name: react-loading-skeleton;\n    -webkit-animation-direction: var(--animation-direction);\n            animation-direction: var(--animation-direction);\n    -webkit-animation-duration: var(--animation-duration);\n            animation-duration: var(--animation-duration);\n    -webkit-animation-timing-function: ease-in-out;\n            animation-timing-function: ease-in-out;\n    -webkit-animation-iteration-count: infinite;\n            animation-iteration-count: infinite;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js":
/*!******************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js ***!
  \******************************************************************************/
/***/ ((module) => {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/***/ ((module) => {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
    return obj[key];
  }
  try {
    // IE 8 has a broken Object.defineProperty that only works on DOM objects.
    define({}, "");
  } catch (err) {
    define = function(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = GeneratorFunctionPrototype;
  define(Gp, "constructor", GeneratorFunctionPrototype);
  define(GeneratorFunctionPrototype, "constructor", GeneratorFunction);
  GeneratorFunction.displayName = define(
    GeneratorFunctionPrototype,
    toStringTagSymbol,
    "GeneratorFunction"
  );

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      define(prototype, method, function(arg) {
        return this._invoke(method, arg);
      });
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      define(genFun, toStringTagSymbol, "GeneratorFunction");
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  });
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  define(Gp, toStringTagSymbol, "Generator");

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  define(Gp, iteratorSymbol, function() {
    return this;
  });

  define(Gp, "toString", function() {
    return "[object Generator]";
  });

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : 0
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, in modern engines
  // we can explicitly access globalThis. In older engines we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ }),

/***/ "./node_modules/react-loading-skeleton/dist/skeleton.css":
/*!***************************************************************!*\
  !*** ./node_modules/react-loading-skeleton/dist/skeleton.css ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_skeleton_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./skeleton.css */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/react-loading-skeleton/dist/skeleton.css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_skeleton_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_skeleton_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./node_modules/react-loading-skeleton/dist/index.mjs":
/*!************************************************************!*\
  !*** ./node_modules/react-loading-skeleton/dist/index.mjs ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SkeletonTheme": () => (/* binding */ SkeletonTheme),
/* harmony export */   "default": () => (/* binding */ Skeleton)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


/**
 * @internal
 */
const SkeletonThemeContext = react__WEBPACK_IMPORTED_MODULE_0__.createContext({});

/* eslint-disable react/no-array-index-key */
const defaultEnableAnimation = true;
// For performance & cleanliness, don't add any inline styles unless we have to
function styleOptionsToCssProperties({ baseColor, highlightColor, width, height, borderRadius, circle, direction, duration, enableAnimation = defaultEnableAnimation, }) {
    const style = {};
    if (direction === 'rtl')
        style['--animation-direction'] = 'reverse';
    if (typeof duration === 'number')
        style['--animation-duration'] = `${duration}s`;
    if (!enableAnimation)
        style['--pseudo-element-display'] = 'none';
    if (typeof width === 'string' || typeof width === 'number')
        style.width = width;
    if (typeof height === 'string' || typeof height === 'number')
        style.height = height;
    if (typeof borderRadius === 'string' || typeof borderRadius === 'number')
        style.borderRadius = borderRadius;
    if (circle)
        style.borderRadius = '50%';
    if (typeof baseColor !== 'undefined')
        style['--base-color'] = baseColor;
    if (typeof highlightColor !== 'undefined')
        style['--highlight-color'] = highlightColor;
    return style;
}
function Skeleton({ count = 1, wrapper: Wrapper, className: customClassName, containerClassName, containerTestId, circle = false, style: styleProp, ...originalPropsStyleOptions }) {
    var _a, _b;
    const contextStyleOptions = react__WEBPACK_IMPORTED_MODULE_0__.useContext(SkeletonThemeContext);
    const propsStyleOptions = { ...originalPropsStyleOptions };
    // DO NOT overwrite style options from the context if `propsStyleOptions`
    // has properties explicity set to undefined
    for (const [key, value] of Object.entries(originalPropsStyleOptions)) {
        if (typeof value === 'undefined') {
            delete propsStyleOptions[key];
        }
    }
    // Props take priority over context
    const styleOptions = {
        ...contextStyleOptions,
        ...propsStyleOptions,
        circle,
    };
    // `styleProp` has the least priority out of everything
    const style = {
        ...styleProp,
        ...styleOptionsToCssProperties(styleOptions),
    };
    let className = 'react-loading-skeleton';
    if (customClassName)
        className += ` ${customClassName}`;
    const inline = (_a = styleOptions.inline) !== null && _a !== void 0 ? _a : false;
    const elements = [];
    // Without the <br />, the skeleton lines will all run together if
    // `width` is specified
    for (let i = 0; i < count; i++) {
        const skeletonSpan = (react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", { className: className, style: style, key: i }, "\u200C"));
        if (inline) {
            elements.push(skeletonSpan);
        }
        else {
            elements.push(react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, { key: i },
                skeletonSpan,
                react__WEBPACK_IMPORTED_MODULE_0__.createElement("br", null)));
        }
    }
    return (react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", { className: containerClassName, "data-testid": containerTestId, "aria-live": "polite", "aria-busy": (_b = styleOptions.enableAnimation) !== null && _b !== void 0 ? _b : defaultEnableAnimation }, Wrapper
        ? elements.map((el, i) => react__WEBPACK_IMPORTED_MODULE_0__.createElement(Wrapper, { key: i }, el))
        : elements));
}

function SkeletonTheme({ children, ...styleOptions }) {
    return (react__WEBPACK_IMPORTED_MODULE_0__.createElement(SkeletonThemeContext.Provider, { value: styleOptions }, children));
}




/***/ })

}]);