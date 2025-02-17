"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_checkout_cart_js"],{

/***/ "./resources/js/client/constants.js":
/*!******************************************!*\
  !*** ./resources/js/client/constants.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ADD_PRODUCT": () => (/* binding */ ADD_PRODUCT),
/* harmony export */   "REMOVE_PRODUCT": () => (/* binding */ REMOVE_PRODUCT),
/* harmony export */   "EMPTY_CART": () => (/* binding */ EMPTY_CART),
/* harmony export */   "UPDATE_CART": () => (/* binding */ UPDATE_CART),
/* harmony export */   "REFRESH_CART": () => (/* binding */ REFRESH_CART),
/* harmony export */   "UPDATE_CART_SUBTOTAL": () => (/* binding */ UPDATE_CART_SUBTOTAL),
/* harmony export */   "UPDATE_PRODUCT_PROPERTY": () => (/* binding */ UPDATE_PRODUCT_PROPERTY),
/* harmony export */   "UPDATE_QTY": () => (/* binding */ UPDATE_QTY)
/* harmony export */ });
//cart action types
var ADD_PRODUCT = "add-product";
var REMOVE_PRODUCT = "remove-product";
var EMPTY_CART = "empty-product";
var UPDATE_CART = "update-cart";
var REFRESH_CART = "refresh-cart";
var UPDATE_CART_SUBTOTAL = "update-subtotal";
var UPDATE_PRODUCT_PROPERTY = "update-product-property";
var UPDATE_QTY = "update-qty";

/***/ }),

/***/ "./resources/js/client/pages/checkout/cart.js":
/*!****************************************************!*\
  !*** ./resources/js/client/pages/checkout/cart.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _context__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./context */ "./resources/js/client/pages/checkout/context.js");
/* harmony import */ var _reducer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./reducer */ "./resources/js/client/pages/checkout/reducer.js");
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../constants */ "./resources/js/client/constants.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

/**
 * External Dependencies
 */

/**
 * Internal Dependencies
 */



 // import data from "./data.json";




var data = JSON.parse(localStorage.getItem("cart")); //old flow

var cartContent = {
  cart: data,
  count: data.length,
  total: 0,
  qty: Array(data.length).fill("1")
};

var Cart = function Cart(_ref) {
  var nextStep = _ref.nextStep;

  var _useReducer = (0,react__WEBPACK_IMPORTED_MODULE_0__.useReducer)(_reducer__WEBPACK_IMPORTED_MODULE_2__["default"], cartContent),
      _useReducer2 = _slicedToArray(_useReducer, 2),
      state = _useReducer2[0],
      dispatch = _useReducer2[1];

  var _React$useState = react__WEBPACK_IMPORTED_MODULE_0__.useState(cartContent.cart),
      _React$useState2 = _slicedToArray(_React$useState, 2),
      products = _React$useState2[0],
      setProducts = _React$useState2[1];

  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    dispatch({
      type: _constants__WEBPACK_IMPORTED_MODULE_3__.UPDATE_CART_SUBTOTAL
    });
  }, [products]);

  var onQtyChange = function onQtyChange(value, index) {
    dispatch({
      type: _constants__WEBPACK_IMPORTED_MODULE_3__.UPDATE_QTY,
      payload: {
        value: value,
        index: index
      }
    });
    dispatch({
      type: _constants__WEBPACK_IMPORTED_MODULE_3__.UPDATE_CART_SUBTOTAL
    });
  };

  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_context__WEBPACK_IMPORTED_MODULE_1__.CartContext.Consumer, {
    children: function children(_ref2) {
      var updateCart = _ref2.updateCart;
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("section", {
          className: "pt-5 pb-5",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
            className: "container",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "row w-100",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                className: "col-lg-12 col-md-12 col-12",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h3", {
                  className: "display-5 mb-2 text-center",
                  children: "Shopping Cart"
                }), state.count == 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
                  className: "mb-5 text-center",
                  children: "Your cart is currently Empty"
                }), state.count > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("p", {
                  className: "mb-5 text-center",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("i", {
                    className: "text-info font-weight-bold",
                    children: state.count
                  }), " ", "items in your cart"]
                }), state.count > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.Fragment, {
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("table", {
                    id: "shoppingCart",
                    className: "table table-condensed table-responsive",
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("thead", {
                      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("tr", {
                        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("th", {
                          style: {
                            width: "60%"
                          },
                          children: "Product"
                        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("th", {
                          style: {
                            width: "12%"
                          },
                          children: "Price"
                        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("th", {
                          style: {
                            width: "10%"
                          },
                          children: "Quantity"
                        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("th", {
                          style: {
                            width: "16%"
                          }
                        })]
                      })
                    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("tbody", {
                      children: products.length > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.Fragment, {
                        children: products.map(function (product, index) {
                          return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("tr", {
                            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("td", {
                              "data-th": "Product",
                              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                                className: "row",
                                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                                  className: "col-md-3 text-left",
                                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("img", {
                                    src: product.image,
                                    alt: "",
                                    className: "img-fluid d-none d-md-block rounded mb-2 shadow "
                                  })
                                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                                  className: "col-md-9 text-left mt-sm-2",
                                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h4", {
                                    children: product.name
                                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
                                    className: "font-weight-light",
                                    children: product.vendor
                                  })]
                                })]
                              })
                            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("td", {
                              "data-th": "Price",
                              children: product.price
                            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("td", {
                              "data-th": "Quantity",
                              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("input", {
                                id: index,
                                type: "number",
                                min: "1",
                                className: "form-control form-control-lg text-center",
                                defaultValue: "1",
                                onChange: function onChange(e) {
                                  return onQtyChange(e.target.value, index);
                                }
                              }, index)
                            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("td", {
                              className: "actions",
                              "data-th": "",
                              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                                className: "text-right",
                                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("button", {
                                  className: "btn btn-white border-secondary bg-white btn-md mb-2",
                                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("i", {
                                    className: "fas fa-sync"
                                  })
                                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("button", {
                                  className: "btn btn-white border-secondary bg-white btn-md mb-2",
                                  onClick: function onClick() {
                                    dispatch({
                                      type: _constants__WEBPACK_IMPORTED_MODULE_3__.REMOVE_PRODUCT,
                                      payload: _objectSpread({}, product)
                                    });
                                    setProducts(products.filter(function (d) {
                                      return d.id != product.id;
                                    }));
                                  },
                                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("i", {
                                    className: "fas fa-trash"
                                  })
                                })]
                              })
                            })]
                          }, index);
                        })
                      })
                    })]
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                    className: "float-right text-right",
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h4", {
                      children: "Subtotal:"
                    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("h1", {
                      children: ["$", state.total]
                    })]
                  })]
                })]
              })
            }), state.count > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
              className: "row mt-4 d-flex align-items-center",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                className: "col-sm-6 order-md-2 text-right",
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("a", {
                  className: "btn btn-primary mb-4 btn-lg pl-5 pr-5",
                  onClick: function onClick() {
                    localStorage.setItem("cartReact", JSON.stringify(state));
                    nextStep();
                  },
                  children: "Checkout"
                })
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                className: "col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left",
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("a", {
                  href: "catalog.html",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("i", {
                    className: "fas fa-arrow-left mr-2"
                  }), " ", "Continue Shopping"]
                })
              })]
            })]
          })
        })
      });
    }
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Cart);

/***/ }),

/***/ "./resources/js/client/pages/checkout/reducer.js":
/*!*******************************************************!*\
  !*** ./resources/js/client/pages/checkout/reducer.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../constants */ "./resources/js/client/constants.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



var reducer = function reducer(state, action) {
  var type = action.type,
      payload = action.payload; // console.log(state);

  switch (type) {
    case _constants__WEBPACK_IMPORTED_MODULE_0__.ADD_PRODUCT:
      var newCart = [].concat(_toConsumableArray(state.cart), [payload]);
      return _objectSpread(_objectSpread({}, state), {}, {
        cart: newCart,
        count: state.count + 1
      }); //add a product to the cart

      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.REMOVE_PRODUCT:
      // console.log(payload);
      var originalCart = state.cart.filter(function (d) {
        return d.id != payload.id;
      });
      var localStorageCart = JSON.parse(localStorage.getItem("cart"));
      var localStorageCartId = JSON.parse(localStorage.getItem("cartIdStore"));
      var localStorageNewCart = localStorageCart.filter(function (d) {
        return d.id != payload.id;
      });
      var localStorageNewCartId = localStorageCartId.filter(function (d) {
        return d != payload.id;
      }); // console.log(localStorageNewCartId);

      localStorage.setItem("cart", JSON.stringify(localStorageNewCart));
      localStorage.setItem("cartIdStore", JSON.stringify(localStorageNewCartId));
      return _objectSpread(_objectSpread({}, state), {}, {
        cart: originalCart,
        count: state.count <= 0 ? 0 : state.count - 1,
        qty: state.qty.filter(function (d, index) {
          return index != payload.id - 1;
        })
      }); //add a product to the cart

      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.EMPTY_CART:
      return _objectSpread(_objectSpread({}, state), {}, {
        cart: [],
        count: 0,
        qty: []
      }); //add a product to the cart

      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.UPDATE_CART:
      console.log(payload);
      return _objectSpread(_objectSpread({}, state), {}, {
        cart: [0],
        count: 0,
        qty: []
      }); //add a product to the cart

      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.UPDATE_PRODUCT_PROPERTY:
      // console.log(payload);
      //add a product to the cart
      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.UPDATE_QTY:
      // console.log(payload);
      var value = payload.value,
          index = payload.index;

      var qtyArray = _toConsumableArray(state.qty);

      qtyArray[index] = value;
      return _objectSpread(_objectSpread({}, state), {}, {
        qty: qtyArray
      }); //add a product to the cart

      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.REFRESH_CART:
      //refresh a product to the cart
      break;

    case _constants__WEBPACK_IMPORTED_MODULE_0__.UPDATE_CART_SUBTOTAL:
      //update a product to the cart
      //paylaod should be the qty
      var priceArray = [];
      var qtyArr = state.qty;
      state.cart.map(function (item, index) {
        priceArray.push(parseInt(item.price) * parseInt(qtyArr[index]));
      });
      var total = priceArray.reduce(function (accumulator, currentValue) {
        return accumulator + currentValue;
      }, 0);
      return _objectSpread(_objectSpread({}, state), {}, {
        total: total
      });
      break;

    default:
      break;
  }
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (reducer);

/***/ })

}]);