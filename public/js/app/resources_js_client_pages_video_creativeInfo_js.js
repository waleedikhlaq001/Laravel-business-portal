"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_video_creativeInfo_js"],{

/***/ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Grid/Col/Col.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Col": () => (/* binding */ Col),
/* harmony export */   "isValidSpan": () => (/* binding */ isValidSpan)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _Col_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Col.styles.js */ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.styles.js");



var __defProp = Object.defineProperty;
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
var __objRest = (source, exclude) => {
  var target = {};
  for (var prop in source)
    if (__hasOwnProp.call(source, prop) && exclude.indexOf(prop) < 0)
      target[prop] = source[prop];
  if (source != null && __getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(source)) {
      if (exclude.indexOf(prop) < 0 && __propIsEnum.call(source, prop))
        target[prop] = source[prop];
    }
  return target;
};
function isValidSpan(span) {
  return typeof span === "number" && span > 0 && span % 1 === 0;
}
function Col(_a) {
  var _b = _a, {
    children,
    span,
    gutter,
    offset = 0,
    offsetXs = 0,
    offsetSm = 0,
    offsetMd = 0,
    offsetLg = 0,
    offsetXl = 0,
    grow,
    xs,
    sm,
    md,
    lg,
    xl,
    columns,
    className,
    classNames,
    styles,
    id,
    sx
  } = _b, others = __objRest(_b, [
    "children",
    "span",
    "gutter",
    "offset",
    "offsetXs",
    "offsetSm",
    "offsetMd",
    "offsetLg",
    "offsetXl",
    "grow",
    "xs",
    "sm",
    "md",
    "lg",
    "xl",
    "columns",
    "className",
    "classNames",
    "styles",
    "id",
    "sx"
  ]);
  const { classes, cx } = (0,_Col_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({
    gutter,
    offset,
    offsetXs,
    offsetSm,
    offsetMd,
    offsetLg,
    offsetXl,
    xs,
    sm,
    md,
    lg,
    xl,
    grow,
    columns,
    span
  }, { sx, classNames, styles, name: "Col" });
  if (!isValidSpan(span) || span > columns) {
    return null;
  }
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", __spreadValues({
    className: cx(classes.root, className)
  }, others), children);
}
Col.displayName = "@mantine/core/Col";


//# sourceMappingURL=Col.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.styles.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Grid/Col/Col.styles.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/default-theme.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


var __defProp = Object.defineProperty;
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
const getColumnWidth = (colSpan, columns) => `${100 / (columns / colSpan)}%`;
const getColumnOffset = (offset, columns) => offset ? `${100 / (columns / offset)}%` : void 0;
function getBreakpointsStyles({
  sizes,
  offsets,
  theme,
  columns,
  grow
}) {
  return _mantine_styles__WEBPACK_IMPORTED_MODULE_0__.MANTINE_SIZES.reduce((acc, size) => {
    if (typeof sizes[size] === "number") {
      acc[`@media (min-width: ${theme.breakpoints[size] + 1}px)`] = {
        flexBasis: getColumnWidth(sizes[size], columns),
        flexShrink: 0,
        maxWidth: grow ? "unset" : getColumnWidth(sizes[size], columns),
        marginLeft: getColumnOffset(offsets[size], columns)
      };
    }
    return acc;
  }, {});
}
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.createStyles)((theme, {
  gutter,
  grow,
  offset,
  offsetXs,
  offsetSm,
  offsetMd,
  offsetLg,
  offsetXl,
  columns,
  span,
  xs,
  sm,
  md,
  lg,
  xl
}) => ({
  root: __spreadValues({
    boxSizing: "border-box",
    flexGrow: grow ? 1 : 0,
    padding: theme.fn.size({ size: gutter, sizes: theme.spacing }) / 2,
    marginLeft: getColumnOffset(offset, columns),
    flexBasis: getColumnWidth(span, columns),
    flexShrink: 0,
    maxWidth: grow ? "unset" : getColumnWidth(span, columns)
  }, getBreakpointsStyles({
    sizes: { xs, sm, md, lg, xl },
    offsets: { xs: offsetXs, sm: offsetSm, md: offsetMd, lg: offsetLg, xl: offsetXl },
    theme,
    columns,
    grow
  }))
}));

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=Col.styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Grid/Grid.js":
/*!****************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Grid/Grid.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Grid": () => (/* binding */ Grid)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _Grid_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Grid.styles.js */ "./node_modules/@mantine/core/esm/components/Grid/Grid.styles.js");




var __defProp = Object.defineProperty;
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
var __objRest = (source, exclude) => {
  var target = {};
  for (var prop in source)
    if (__hasOwnProp.call(source, prop) && exclude.indexOf(prop) < 0)
      target[prop] = source[prop];
  if (source != null && __getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(source)) {
      if (exclude.indexOf(prop) < 0 && __propIsEnum.call(source, prop))
        target[prop] = source[prop];
    }
  return target;
};
const Grid = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    gutter = "md",
    children,
    grow = false,
    justify = "flex-start",
    align = "stretch",
    style,
    columns = 12,
    className,
    classNames,
    styles,
    id,
    sx
  } = _b, others = __objRest(_b, [
    "gutter",
    "children",
    "grow",
    "justify",
    "align",
    "style",
    "columns",
    "className",
    "classNames",
    "styles",
    "id",
    "sx"
  ]);
  const { classes, cx } = (0,_Grid_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({ gutter, justify, align }, { sx, classNames, styles, name: "Grid" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.useExtractedMargins)({ others, style });
  const cols = react__WEBPACK_IMPORTED_MODULE_0__.Children.toArray(children).map((col, index) => react__WEBPACK_IMPORTED_MODULE_0__.cloneElement(col, { gutter, grow, columns, key: index }));
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", __spreadValues({
    style: mergedStyles,
    className: cx(classes.root, className),
    ref
  }, rest), cols);
});
Grid.displayName = "@mantine/core/Grid";


//# sourceMappingURL=Grid.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Grid/Grid.styles.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Grid/Grid.styles.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { justify, align, gutter }) => ({
  root: {
    margin: -theme.fn.size({ size: gutter, sizes: theme.spacing }) / 2,
    display: "flex",
    flexWrap: "wrap",
    justifyContent: justify,
    alignItems: align
  }
}));

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=Grid.styles.js.map


/***/ }),

/***/ "./resources/js/client/icons/index.js":
/*!********************************************!*\
  !*** ./resources/js/client/icons/index.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _trash_svg__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./trash.svg */ "./resources/js/client/icons/trash.svg");
/* harmony import */ var _circle_plus_svg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./circle-plus.svg */ "./resources/js/client/icons/circle-plus.svg");
/* harmony import */ var _checkbox_circle_svg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./checkbox-circle.svg */ "./resources/js/client/icons/checkbox-circle.svg");
/* harmony import */ var _x_circle_svg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./x-circle.svg */ "./resources/js/client/icons/x-circle.svg");
/* harmony import */ var _question_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./question.svg */ "./resources/js/client/icons/question.svg");
/* harmony import */ var _user_svg__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./user.svg */ "./resources/js/client/icons/user.svg");






/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  Trash: _trash_svg__WEBPACK_IMPORTED_MODULE_0__["default"],
  circlePlus: _circle_plus_svg__WEBPACK_IMPORTED_MODULE_1__["default"],
  checkboxCircle: _checkbox_circle_svg__WEBPACK_IMPORTED_MODULE_2__["default"],
  close: _x_circle_svg__WEBPACK_IMPORTED_MODULE_3__["default"],
  question: _question_svg__WEBPACK_IMPORTED_MODULE_4__["default"],
  user: _user_svg__WEBPACK_IMPORTED_MODULE_5__["default"]
});

/***/ }),

/***/ "./resources/js/client/pages/video/creativeInfo.js":
/*!*********************************************************!*\
  !*** ./resources/js/client/pages/video/creativeInfo.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Divider/Divider.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Paper/Paper.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Grid.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.js");
/* harmony import */ var _icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../icons */ "./resources/js/client/icons/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");






var CreativeInfo = function CreativeInfo(_ref) {
  var name = _ref.name,
      projectName = _ref.projectName,
      createdDate = _ref.createdDate,
      email = _ref.email,
      phone = _ref.phone;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h3", {
      className: "pirple-font mt-4",
      children: "Creative Details"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      style: {
        display: "flex",
        flexDirection: "column",
        gap: "1em"
      },
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Divider, {
          color: "green",
          size: "lg"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Paper, {
          shadow: "lg",
          padding: "xl",
          radius: "md",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Grid, {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_6__.Col, {
              span: 4,
              style: {
                display: "flex",
                flexDirection: "row",
                gap: "1em"
              },
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
                src: _icons__WEBPACK_IMPORTED_MODULE_1__["default"].user
              }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: name
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_6__.Col, {
              span: 4,
              style: {
                display: "flex",
                flexDirection: "row",
                gap: "1em"
              },
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
                src: _icons__WEBPACK_IMPORTED_MODULE_1__["default"].user
              }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: projectName
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_6__.Col, {
              span: 4,
              style: {
                display: "flex",
                flexDirection: "row",
                gap: "1em"
              },
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
                src: _icons__WEBPACK_IMPORTED_MODULE_1__["default"].user
              }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
                children: ["Member Since ", createdDate]
              })]
            })]
          })
        })]
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h3", {
      className: "pirple-font mt-4",
      children: "Creative Verification"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      style: {
        display: "flex",
        flexDirection: "column",
        gap: "1em"
      },
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Divider, {
          color: "green",
          size: "lg"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Paper, {
          shadow: "lg",
          padding: "xl",
          radius: "md",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Grid, {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_6__.Col, {
              span: 4,
              style: {
                display: "flex",
                flexDirection: "row",
                gap: "1em"
              },
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
                src: _icons__WEBPACK_IMPORTED_MODULE_1__["default"].user
              }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: email
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_6__.Col, {
              span: 4,
              style: {
                display: "flex",
                flexDirection: "row",
                gap: "1em"
              },
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
                src: _icons__WEBPACK_IMPORTED_MODULE_1__["default"].user
              }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: phone
              })]
            })]
          })
        })]
      })
    })]
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CreativeInfo);

/***/ }),

/***/ "./resources/js/client/icons/checkbox-circle.svg":
/*!*******************************************************!*\
  !*** ./resources/js/client/icons/checkbox-circle.svg ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/checkbox-circle.svg?916493c1f93912a6929380e57aa2b430");

/***/ }),

/***/ "./resources/js/client/icons/circle-plus.svg":
/*!***************************************************!*\
  !*** ./resources/js/client/icons/circle-plus.svg ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/circle-plus.svg?3ccf59bf91b9783e9632d6d815e4e111");

/***/ }),

/***/ "./resources/js/client/icons/question.svg":
/*!************************************************!*\
  !*** ./resources/js/client/icons/question.svg ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/question.svg?4dcd846a85636ec763d394d084605ffa");

/***/ }),

/***/ "./resources/js/client/icons/trash.svg":
/*!*********************************************!*\
  !*** ./resources/js/client/icons/trash.svg ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/trash.svg?c8808c1e90adfd98727e2b55244c79b6");

/***/ }),

/***/ "./resources/js/client/icons/user.svg":
/*!********************************************!*\
  !*** ./resources/js/client/icons/user.svg ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/user.svg?780a52a3688dd2fd0230fe4949982dd5");

/***/ }),

/***/ "./resources/js/client/icons/x-circle.svg":
/*!************************************************!*\
  !*** ./resources/js/client/icons/x-circle.svg ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/x-circle.svg?605614302510ae44b86017eca4440dc7");

/***/ })

}]);