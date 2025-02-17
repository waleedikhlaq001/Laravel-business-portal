"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_checkout_orderComplete_js"],{

/***/ "./node_modules/@mantine/core/esm/components/Button/Button.js":
/*!********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Button/Button.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Button": () => (/* binding */ Button)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/get-shared-color-scheme/get-shared-color-scheme.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _Button_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Button.styles.js */ "./node_modules/@mantine/core/esm/components/Button/Button.styles.js");
/* harmony import */ var _Loader_Loader_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../Loader/Loader.js */ "./node_modules/@mantine/core/esm/components/Loader/Loader.js");





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
const Button = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    className,
    style,
    size = "sm",
    color,
    type = "button",
    disabled = false,
    children,
    leftIcon,
    rightIcon,
    fullWidth = false,
    variant = "filled",
    radius = "sm",
    component,
    uppercase = false,
    compact = false,
    loading = false,
    loaderPosition = "left",
    loaderProps,
    gradient = { from: "blue", to: "cyan", deg: 45 },
    classNames,
    styles,
    sx
  } = _b, others = __objRest(_b, [
    "className",
    "style",
    "size",
    "color",
    "type",
    "disabled",
    "children",
    "leftIcon",
    "rightIcon",
    "fullWidth",
    "variant",
    "radius",
    "component",
    "uppercase",
    "compact",
    "loading",
    "loaderPosition",
    "loaderProps",
    "gradient",
    "classNames",
    "styles",
    "sx"
  ]);
  const { classes, cx, theme } = (0,_Button_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({
    radius,
    color,
    size,
    fullWidth,
    compact,
    gradientFrom: gradient.from,
    gradientTo: gradient.to,
    gradientDeg: gradient.deg
  }, { classNames, styles, sx, name: "Button" });
  const colors = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.getSharedColorScheme)({ color, theme, variant });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_3__.useExtractedMargins)({ others, style });
  const Element = component || "button";
  const loader = /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(_Loader_Loader_js__WEBPACK_IMPORTED_MODULE_4__.Loader, __spreadValues({
    color: colors.color,
    size: theme.fn.size({ size, sizes: _Button_styles_js__WEBPACK_IMPORTED_MODULE_1__.heights }) / 2
  }, loaderProps));
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, __spreadProps(__spreadValues({}, rest), {
    className: cx(classes[variant], { [classes.loading]: loading }, classes.root, className),
    type,
    disabled: disabled || loading,
    ref,
    onTouchStart: () => {
    },
    style: mergedStyles
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", {
    className: classes.inner
  }, (leftIcon || loading && loaderPosition === "left") && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", {
    className: cx(classes.icon, classes.leftIcon)
  }, loading && loaderPosition === "left" ? loader : leftIcon), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", {
    className: classes.label,
    style: { textTransform: uppercase ? "uppercase" : void 0 }
  }, children), (rightIcon || loading && loaderPosition === "right") && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", {
    className: cx(classes.icon, classes.rightIcon)
  }, loading && loaderPosition === "right" ? loader : rightIcon)));
});
Button.displayName = "@mantine/core/Button";


//# sourceMappingURL=Button.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Button/Button.styles.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Button/Button.styles.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "heights": () => (/* binding */ heights)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/get-shared-color-scheme/get-shared-color-scheme.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");
/* harmony import */ var _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Input/Input.styles.js */ "./node_modules/@mantine/core/esm/components/Input/Input.styles.js");



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
const sizes = {
  xs: {
    height: _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__.sizes.xs,
    padding: "0 14px"
  },
  sm: {
    height: _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__.sizes.sm,
    padding: "0 18px"
  },
  md: {
    height: _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__.sizes.md,
    padding: "0 22px"
  },
  lg: {
    height: _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__.sizes.lg,
    padding: "0 26px"
  },
  xl: {
    height: _Input_Input_styles_js__WEBPACK_IMPORTED_MODULE_0__.sizes.xl,
    padding: "0 32px"
  },
  "compact-xs": {
    height: 22,
    padding: "0 7px"
  },
  "compact-sm": {
    height: 26,
    padding: "0 8px"
  },
  "compact-md": {
    height: 30,
    padding: "0 10px"
  },
  "compact-lg": {
    height: 34,
    padding: "0 12px"
  },
  "compact-xl": {
    height: 40,
    padding: "0 14px"
  }
};
const heights = Object.keys(sizes).reduce((acc, size) => {
  acc[size] = sizes[size].height;
  return acc;
}, {});
const getSizeStyles = ({ compact, size }) => {
  if (!compact) {
    return sizes[size];
  }
  return sizes[`compact-${size}`];
};
const getWidthStyles = (fullWidth) => ({
  display: fullWidth ? "block" : "inline-block",
  width: fullWidth ? "100%" : "auto"
});
function getVariantStyles({ variant, theme, color }) {
  const colors = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.getSharedColorScheme)({
    theme,
    color,
    variant
  });
  return {
    border: `1px solid ${colors.border}`,
    backgroundColor: colors.background,
    backgroundImage: colors.background,
    color: colors.color,
    "&:hover": {
      backgroundColor: colors.hover
    }
  };
}
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.createStyles)((theme, {
  color,
  size,
  radius,
  fullWidth,
  compact,
  gradientFrom,
  gradientTo,
  gradientDeg
}, getRef) => {
  const loading = getRef("loading");
  const gradient = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.getSharedColorScheme)({
    theme,
    color,
    variant: "gradient",
    gradient: { from: gradientFrom, to: gradientTo, deg: gradientDeg }
  });
  return {
    loading: {
      ref: loading,
      pointerEvents: "none",
      "&::before": {
        content: '""',
        position: "absolute",
        top: -1,
        left: -1,
        right: -1,
        bottom: -1,
        backgroundColor: theme.colorScheme === "dark" ? theme.fn.rgba(theme.colors.dark[7], 0.5) : "rgba(255, 255, 255, .5)",
        borderRadius: theme.fn.size({ size: radius, sizes: theme.radius }) - 1,
        cursor: "not-allowed"
      }
    },
    outline: getVariantStyles({ variant: "outline", theme, color }),
    filled: getVariantStyles({ variant: "filled", theme, color }),
    light: getVariantStyles({ variant: "light", theme, color }),
    default: getVariantStyles({ variant: "default", theme, color }),
    white: getVariantStyles({ variant: "white", theme, color }),
    gradient: {
      border: 0,
      backgroundImage: gradient.background,
      color: gradient.color,
      "&:hover": {
        backgroundSize: "200%"
      }
    },
    root: __spreadProps(__spreadValues(__spreadValues(__spreadValues(__spreadValues({}, getSizeStyles({ compact, size })), theme.fn.fontStyles()), theme.fn.focusStyles()), getWidthStyles(fullWidth)), {
      borderRadius: theme.fn.size({ size: radius, sizes: theme.radius }),
      fontWeight: 600,
      position: "relative",
      lineHeight: 1,
      fontSize: theme.fn.size({ size, sizes: theme.fontSizes }),
      WebkitTapHighlightColor: "transparent",
      userSelect: "none",
      boxSizing: "border-box",
      textDecoration: "none",
      cursor: "pointer",
      appearance: "none",
      WebkitAppearance: "none",
      "&:not(:disabled):active": {
        transform: "translateY(1px)"
      },
      [`&:not(.${loading}):disabled`]: {
        borderColor: "transparent",
        backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[4] : theme.colors.gray[2],
        color: theme.colorScheme === "dark" ? theme.colors.dark[6] : theme.colors.gray[5],
        cursor: "not-allowed"
      }
    }),
    icon: {
      display: "flex",
      alignItems: "center"
    },
    leftIcon: {
      marginRight: 10
    },
    rightIcon: {
      marginLeft: 10
    },
    inner: {
      display: "flex",
      alignItems: "center",
      justifyContent: "center",
      height: "100%",
      overflow: "visible"
    },
    label: {
      whiteSpace: "nowrap",
      height: "100%",
      overflow: "hidden",
      display: "flex",
      alignItems: "center"
    }
  };
});

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);

//# sourceMappingURL=Button.styles.js.map


/***/ }),

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

/***/ "./node_modules/@mantine/core/esm/components/Input/Input.styles.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Input/Input.styles.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "sizes": () => (/* binding */ sizes)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


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
const sizes = {
  xs: 30,
  sm: 36,
  md: 42,
  lg: 50,
  xl: 60
};
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { size, multiline, radius, variant, invalid }) => {
  const invalidColor = theme.colors.red[theme.colorScheme === "dark" ? 6 : 7];
  const sizeStyles = variant === "default" || variant === "filled" ? {
    minHeight: theme.fn.size({ size, sizes }),
    paddingLeft: theme.fn.size({ size, sizes }) / 3,
    paddingRight: theme.fn.size({ size, sizes }) / 3,
    borderRadius: theme.fn.size({ size: radius, sizes: theme.radius })
  } : null;
  return {
    wrapper: {
      position: "relative"
    },
    input: variant === "headless" ? {} : __spreadProps(__spreadValues(__spreadProps(__spreadValues({}, theme.fn.fontStyles()), {
      height: multiline ? variant === "unstyled" ? void 0 : "auto" : theme.fn.size({ size, sizes }),
      WebkitTapHighlightColor: "transparent",
      lineHeight: multiline ? theme.lineHeight : `${theme.fn.size({ size, sizes }) - 2}px`,
      appearance: "none",
      resize: "none",
      boxSizing: "border-box",
      fontSize: theme.fn.size({ size, sizes: theme.fontSizes }),
      width: "100%",
      color: theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black,
      display: "block",
      textAlign: "left"
    }), sizeStyles), {
      "&:disabled": {
        backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[6] : theme.colors.gray[1],
        color: theme.colors.dark[2],
        opacity: 0.6,
        cursor: "not-allowed",
        "&::placeholder": {
          color: theme.colors.dark[2]
        }
      },
      "&::placeholder": {
        opacity: 1,
        userSelect: "none",
        color: theme.colorScheme === "dark" ? theme.colors.dark[3] : theme.colors.gray[5]
      },
      "&::-webkit-inner-spin-button, &::-webkit-outer-spin-button, &::-webkit-search-decoration, &::-webkit-search-cancel-button, &::-webkit-search-results-button, &::-webkit-search-results-decoration": {
        appearance: "none"
      },
      "&[type=number]": {
        MozAppearance: "textfield"
      }
    }),
    defaultVariant: {
      border: `1px solid ${theme.colorScheme === "dark" ? theme.colors.dark[5] : theme.colors.gray[4]}`,
      backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[8] : theme.white,
      transition: "border-color 100ms ease",
      "&:focus, &:focus-within": {
        outline: "none",
        borderColor: theme.colors[theme.primaryColor][theme.colorScheme === "dark" ? 8 : 5]
      }
    },
    filledVariant: {
      border: "1px solid transparent",
      backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[5] : theme.colors.gray[1],
      "&:focus, &:focus-within": {
        outline: "none",
        borderColor: `${theme.colors[theme.primaryColor][theme.colorScheme === "dark" ? 8 : 5]} !important`
      }
    },
    unstyledVariant: {
      borderWidth: 0,
      color: theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black,
      backgroundColor: "transparent",
      minHeight: 28,
      outline: 0,
      "&:focus, &:focus-within": {
        outline: "none",
        borderColor: "transparent"
      },
      "&:disabled": {
        backgroundColor: "transparent",
        "&:focus, &:focus-within": {
          outline: "none",
          borderColor: "transparent"
        }
      }
    },
    withIcon: {
      paddingLeft: `${theme.fn.size({ size, sizes })}px !important`
    },
    invalid: {
      color: invalidColor,
      borderColor: invalidColor,
      "&::placeholder": {
        opacity: 1,
        color: invalidColor
      }
    },
    disabled: {
      backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[6] : theme.colors.gray[1],
      color: theme.colors.dark[2],
      opacity: 0.6,
      cursor: "not-allowed",
      "&::placeholder": {
        color: theme.colors.dark[2]
      }
    },
    icon: {
      pointerEvents: "none",
      position: "absolute",
      zIndex: 1,
      left: 0,
      top: 0,
      bottom: 0,
      display: "flex",
      alignItems: "center",
      justifyContent: "center",
      width: theme.fn.size({ size, sizes }),
      color: invalid ? theme.colors.red[theme.colorScheme === "dark" ? 6 : 7] : theme.colorScheme === "dark" ? theme.colors.dark[2] : theme.colors.gray[5]
    },
    rightSection: {
      position: "absolute",
      top: 0,
      bottom: 0,
      right: 0,
      display: "flex",
      alignItems: "center",
      justifyContent: "center"
    }
  };
});

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);

//# sourceMappingURL=Input.styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Paper/Paper.js":
/*!******************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Paper/Paper.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Paper": () => (/* binding */ Paper)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _Paper_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Paper.styles.js */ "./node_modules/@mantine/core/esm/components/Paper/Paper.styles.js");




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
const Paper = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    component,
    className,
    children,
    padding = 0,
    radius = "sm",
    withBorder = false,
    shadow,
    style,
    sx
  } = _b, others = __objRest(_b, [
    "component",
    "className",
    "children",
    "padding",
    "radius",
    "withBorder",
    "shadow",
    "style",
    "sx"
  ]);
  const { classes, cx } = (0,_Paper_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({ radius, shadow, padding, withBorder }, { sx, name: "Paper" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.useExtractedMargins)({ others, style });
  const Element = component || "div";
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, __spreadValues({
    className: cx(classes.root, className),
    ref,
    style: mergedStyles
  }, rest), children);
});
Paper.displayName = "@mantine/core/Paper";


//# sourceMappingURL=Paper.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Paper/Paper.styles.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Paper/Paper.styles.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


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
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { radius, shadow, padding, withBorder }) => ({
  root: __spreadProps(__spreadValues({}, theme.fn.focusStyles()), {
    WebkitTapHighlightColor: "transparent",
    display: "block",
    textDecoration: "none",
    color: theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black,
    backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[7] : theme.white,
    boxSizing: "border-box",
    borderRadius: theme.fn.size({ size: radius, sizes: theme.radius }),
    boxShadow: theme.shadows[shadow] || shadow || "none",
    padding: theme.fn.size({ size: padding, sizes: theme.spacing }),
    border: withBorder ? `1px solid ${theme.colorScheme === "dark" ? theme.colors.dark[6] : theme.colors.gray[2]}` : void 0
  })
}));

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=Paper.styles.js.map


/***/ }),

/***/ "./resources/js/client/pages/checkout/orderComplete.js":
/*!*************************************************************!*\
  !*** ./resources/js/client/pages/checkout/orderComplete.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Paper/Paper.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Grid.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Grid/Col/Col.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Button/Button.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");





var OrderComplete = function OrderComplete() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      style: {
        paddingLeft: "3.5em",
        paddingRight: "3.5em"
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h6", {
        className: "text-center",
        children: " Order Complete"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: "order-details-body",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_2__.Paper, {
          shadow: "md",
          padding: "md",
          className: "text-center",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Grid, {
            columns: 12,
            gutter: "lg",
            justify: "space-between",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
              span: 12,
              style: {
                fontSize: "1.5em"
              },
              children: "Thank you or ordering in our Vicomma. You will recieve a confirmation email shortly."
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
              span: 12,
              style: {
                fontSize: "1.5em"
              },
              children: "Now check a Tracker progress with your order."
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Col, {
              span: 12,
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
                className: "text-center align-self-center",
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Button, {
                  color: "green",
                  children: " TRACK NOW"
                })
              })
            })]
          })
        })
      })]
    })
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (OrderComplete);

/***/ })

}]);