"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_jobs_list_js"],{

/***/ "./node_modules/@mantine/core/esm/components/Divider/Divider.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Divider/Divider.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Divider": () => (/* binding */ Divider)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _Divider_styles_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Divider.styles.js */ "./node_modules/@mantine/core/esm/components/Divider/Divider.styles.js");
/* harmony import */ var _Text_Text_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../Text/Text.js */ "./node_modules/@mantine/core/esm/components/Text/Text.js");





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
const Divider = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    className,
    style,
    color,
    orientation = "horizontal",
    size = "xs",
    label,
    labelPosition = "left",
    labelProps,
    variant = "solid",
    styles,
    classNames,
    sx
  } = _b, others = __objRest(_b, [
    "className",
    "style",
    "color",
    "orientation",
    "size",
    "label",
    "labelPosition",
    "labelProps",
    "variant",
    "styles",
    "classNames",
    "sx"
  ]);
  const theme = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.useMantineTheme)();
  const _color = color || (theme.colorScheme === "dark" ? "dark" : "gray");
  const { classes, cx } = (0,_Divider_styles_js__WEBPACK_IMPORTED_MODULE_2__["default"])({ color: _color, size, variant }, { classNames, styles, sx, name: "Divider" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_3__.useExtractedMargins)({ others, style });
  const vertical = orientation === "vertical";
  const horizontal = !vertical;
  const withLabel = !!label && horizontal;
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", __spreadValues({
    ref,
    className: cx({
      [classes.vertical]: vertical,
      [classes.horizontal]: horizontal,
      [classes.withLabel]: withLabel
    }, className),
    style: mergedStyles
  }, rest), !!label && horizontal && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(_Text_Text_js__WEBPACK_IMPORTED_MODULE_4__.Text, __spreadProps(__spreadValues({}, labelProps), {
    color: _color,
    size: (labelProps == null ? void 0 : labelProps.size) || "xs",
    style: { marginTop: 2 },
    className: cx(classes.label, classes[labelPosition])
  }), label));
});
Divider.displayName = "@mantine/core/Divider";


//# sourceMappingURL=Divider.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Divider/Divider.styles.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Divider/Divider.styles.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "sizes": () => (/* binding */ sizes)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


const sizes = {
  xs: 1,
  sm: 2,
  md: 3,
  lg: 4,
  xl: 5
};
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { size, variant, color }) => ({
  withLabel: {
    borderTop: "0 !important"
  },
  left: {
    "&::before": {
      display: "none"
    }
  },
  right: {
    "&::after": {
      display: "none"
    }
  },
  label: {
    display: "flex",
    alignItems: "center",
    color: color === "dark" ? theme.colors.dark[1] : theme.fn.themeColor(color, 6),
    "&::before": {
      content: '""',
      flex: 1,
      height: 1,
      borderTop: `1px ${variant} ${theme.fn.themeColor(color, theme.colorScheme === "dark" ? 3 : 4)}`,
      marginRight: theme.spacing.xs
    },
    "&::after": {
      content: '""',
      flex: 1,
      borderTop: `1px ${variant} ${theme.fn.themeColor(color, theme.colorScheme === "dark" ? 3 : 4)}`,
      marginLeft: theme.spacing.xs
    }
  },
  horizontal: {
    border: 0,
    borderTopWidth: theme.fn.size({ size, sizes }),
    borderTopColor: theme.fn.themeColor(color, theme.colorScheme === "dark" ? 3 : 4),
    borderTopStyle: variant,
    margin: 0
  },
  vertical: {
    border: 0,
    alignSelf: "stretch",
    borderLeftWidth: theme.fn.size({ size, sizes }),
    borderLeftColor: theme.fn.themeColor(color, 4),
    borderLeftStyle: variant
  }
}));

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);

//# sourceMappingURL=Divider.styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Text/Text.js":
/*!****************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Text/Text.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Text": () => (/* binding */ Text)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _Text_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Text.styles.js */ "./node_modules/@mantine/core/esm/components/Text/Text.styles.js");




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
const Text = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    className,
    component,
    children,
    size = "md",
    weight,
    transform,
    style,
    color,
    align,
    variant = "text",
    lineClamp,
    gradient = { from: "blue", to: "cyan", deg: 45 },
    inline = false,
    inherit = false,
    sx
  } = _b, others = __objRest(_b, [
    "className",
    "component",
    "children",
    "size",
    "weight",
    "transform",
    "style",
    "color",
    "align",
    "variant",
    "lineClamp",
    "gradient",
    "inline",
    "inherit",
    "sx"
  ]);
  const { classes, cx } = (0,_Text_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({
    variant,
    color,
    size,
    lineClamp,
    inline,
    inherit,
    gradientFrom: gradient.from,
    gradientTo: gradient.to,
    gradientDeg: gradient.deg
  }, { sx, name: "Text" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.useExtractedMargins)({ others, style });
  const Element = component || "div";
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, __spreadValues({
    ref,
    className: cx(classes.root, { [classes.gradient]: variant === "gradient" }, className),
    style: __spreadValues({
      fontWeight: inherit ? "inherit" : weight,
      textTransform: transform,
      textAlign: align
    }, mergedStyles)
  }, rest), children);
});
Text.displayName = "@mantine/core/Text";


//# sourceMappingURL=Text.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Text/Text.styles.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Text/Text.styles.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/get-shared-color-scheme/get-shared-color-scheme.js");


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
function getTextColor({ theme, color, variant }) {
  if (color === "dimmed") {
    return theme.colorScheme === "dark" ? theme.colors.dark[2] : theme.colors.gray[6];
  }
  return color in theme.colors ? theme.colors[color][theme.colorScheme === "dark" ? 5 : 7] : variant === "link" ? theme.colors[theme.primaryColor][theme.colorScheme === "dark" ? 5 : 7] : theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black;
}
function getLineClamp(lineClamp) {
  if (typeof lineClamp === "number") {
    return {
      overflow: "hidden",
      textOverflow: "ellipsis",
      display: "-webkit-box",
      WebkitLineClamp: lineClamp,
      WebkitBoxOrient: "vertical"
    };
  }
  return null;
}
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, {
  color,
  variant,
  size,
  lineClamp,
  inline,
  inherit,
  gradientDeg,
  gradientTo,
  gradientFrom
}) => {
  const colors = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.getSharedColorScheme)({
    theme,
    variant: "gradient",
    gradient: { from: gradientFrom, to: gradientTo, deg: gradientDeg }
  });
  return {
    root: __spreadProps(__spreadValues(__spreadValues(__spreadValues({}, theme.fn.fontStyles()), theme.fn.focusStyles()), getLineClamp(lineClamp)), {
      color: getTextColor({ color, theme, variant }),
      fontFamily: inherit ? "inherit" : theme.fontFamily,
      fontSize: inherit ? "inherit" : theme.fontSizes[size],
      lineHeight: inherit ? "inherit" : inline ? 1 : theme.lineHeight,
      textDecoration: "none",
      WebkitTapHighlightColor: "transparent",
      "&:hover": {
        textDecoration: variant === "link" ? "underline" : "none"
      }
    }),
    gradient: {
      backgroundImage: colors.background,
      WebkitBackgroundClip: "text",
      WebkitTextFillColor: "transparent"
    }
  };
});

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=Text.styles.js.map


/***/ }),

/***/ "./resources/js/client/pages/jobs/list.js":
/*!************************************************!*\
  !*** ./resources/js/client/pages/jobs/list.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ List)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Grid.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Divider/Divider.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }






function List(_ref) {
  var jobs = _ref.jobs;
  var AddStyle = {
    borderTopLeftRadius: "5px",
    borderTopRightRadius: "5px"
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      className: "text-left",
      style: _objectSpread({
        backgroundColor: "#6f3c96",
        padding: "0.7rem",
        color: "white"
      }, AddStyle),
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Grid, {
        grow: true,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 4,
          children: "PROJECT/CONTEST"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 2,
          children: "BIDS/ENTRIES"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 4,
          children: "STARTED"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 2,
          children: "PRICE (USD)"
        })]
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Divider, {
      size: "sm"
    }), jobs.forEach(function (job) {
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Grid, {
        grow: true,
        style: {
          backgroundColor: "#f5f5f5",
          padding: "0.7rem",
          borderBottom: "1px solid #ececec"
        },
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 4,
          children: job.projectName
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 2,
          children: job.bids
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 4,
          children: job.createdDate
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
          span: 2,
          children: job.price
        })]
      }, job.id);
    })]
  });
}

/***/ })

}]);