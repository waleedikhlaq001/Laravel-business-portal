"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_client_pages_video_action_js"],{

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

/***/ "./node_modules/@mantine/core/esm/components/Loader/Loader.js":
/*!********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Loader/Loader.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "LOADER_SIZES": () => (/* binding */ LOADER_SIZES),
/* harmony export */   "Loader": () => (/* binding */ Loader)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-sx/use-sx.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _loaders_Bars_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./loaders/Bars.js */ "./node_modules/@mantine/core/esm/components/Loader/loaders/Bars.js");
/* harmony import */ var _loaders_Oval_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./loaders/Oval.js */ "./node_modules/@mantine/core/esm/components/Loader/loaders/Oval.js");
/* harmony import */ var _loaders_Dots_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./loaders/Dots.js */ "./node_modules/@mantine/core/esm/components/Loader/loaders/Dots.js");






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
const LOADERS = {
  bars: _loaders_Bars_js__WEBPACK_IMPORTED_MODULE_1__.Bars,
  oval: _loaders_Oval_js__WEBPACK_IMPORTED_MODULE_2__.Oval,
  dots: _loaders_Dots_js__WEBPACK_IMPORTED_MODULE_3__.Dots
};
const LOADER_SIZES = {
  xs: 18,
  sm: 22,
  md: 36,
  lg: 44,
  xl: 58
};
function Loader(_a) {
  var _b = _a, {
    size = "md",
    color,
    className,
    variant,
    style,
    sx
  } = _b, others = __objRest(_b, [
    "size",
    "color",
    "className",
    "variant",
    "style",
    "sx"
  ]);
  const { sxClassName, theme } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_4__.useSx)({ sx, className });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_5__.useExtractedMargins)({ others, style });
  const defaultLoader = variant in LOADERS ? variant : theme.loader;
  const Component = LOADERS[defaultLoader] || LOADERS.bars;
  const _color = color || theme.primaryColor;
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(Component, __spreadValues({
    size: theme.fn.size({ size, sizes: LOADER_SIZES }),
    style: mergedStyles,
    color: _color in theme.colors ? theme.fn.themeColor(_color, theme.colorScheme === "dark" ? 4 : 6) : color,
    role: "presentation",
    className: sxClassName
  }, rest));
}
Loader.displayName = "@mantine/core/Loader";


//# sourceMappingURL=Loader.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Loader/loaders/Bars.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Loader/loaders/Bars.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Bars": () => (/* binding */ Bars)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


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
function Bars(_a) {
  var _b = _a, { size, color } = _b, others = __objRest(_b, ["size", "color"]);
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("svg", __spreadValues({
    viewBox: "0 0 135 140",
    xmlns: "http://www.w3.org/2000/svg",
    fill: color,
    width: `${size}px`
  }, others), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("rect", {
    y: "10",
    width: "15",
    height: "120",
    rx: "6"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "height",
    begin: "0.5s",
    dur: "1s",
    values: "120;110;100;90;80;70;60;50;40;140;120",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "y",
    begin: "0.5s",
    dur: "1s",
    values: "10;15;20;25;30;35;40;45;50;0;10",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("rect", {
    x: "30",
    y: "10",
    width: "15",
    height: "120",
    rx: "6"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "height",
    begin: "0.25s",
    dur: "1s",
    values: "120;110;100;90;80;70;60;50;40;140;120",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "y",
    begin: "0.25s",
    dur: "1s",
    values: "10;15;20;25;30;35;40;45;50;0;10",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("rect", {
    x: "60",
    width: "15",
    height: "140",
    rx: "6"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "height",
    begin: "0s",
    dur: "1s",
    values: "120;110;100;90;80;70;60;50;40;140;120",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "y",
    begin: "0s",
    dur: "1s",
    values: "10;15;20;25;30;35;40;45;50;0;10",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("rect", {
    x: "90",
    y: "10",
    width: "15",
    height: "120",
    rx: "6"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "height",
    begin: "0.25s",
    dur: "1s",
    values: "120;110;100;90;80;70;60;50;40;140;120",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "y",
    begin: "0.25s",
    dur: "1s",
    values: "10;15;20;25;30;35;40;45;50;0;10",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("rect", {
    x: "120",
    y: "10",
    width: "15",
    height: "120",
    rx: "6"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "height",
    begin: "0.5s",
    dur: "1s",
    values: "120;110;100;90;80;70;60;50;40;140;120",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "y",
    begin: "0.5s",
    dur: "1s",
    values: "10;15;20;25;30;35;40;45;50;0;10",
    calcMode: "linear",
    repeatCount: "indefinite"
  })));
}


//# sourceMappingURL=Bars.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Loader/loaders/Dots.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Loader/loaders/Dots.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Dots": () => (/* binding */ Dots)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


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
function Dots(_a) {
  var _b = _a, { size, color } = _b, others = __objRest(_b, ["size", "color"]);
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("svg", __spreadValues({
    width: `${size}px`,
    height: `${size / 4}px`,
    viewBox: "0 0 120 30",
    xmlns: "http://www.w3.org/2000/svg",
    fill: color
  }, others), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("circle", {
    cx: "15",
    cy: "15",
    r: "15"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "r",
    from: "15",
    to: "15",
    begin: "0s",
    dur: "0.8s",
    values: "15;9;15",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "fill-opacity",
    from: "1",
    to: "1",
    begin: "0s",
    dur: "0.8s",
    values: "1;.5;1",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("circle", {
    cx: "60",
    cy: "15",
    r: "9",
    fillOpacity: "0.3"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "r",
    from: "9",
    to: "9",
    begin: "0s",
    dur: "0.8s",
    values: "9;15;9",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "fill-opacity",
    from: "0.5",
    to: "0.5",
    begin: "0s",
    dur: "0.8s",
    values: ".5;1;.5",
    calcMode: "linear",
    repeatCount: "indefinite"
  })), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("circle", {
    cx: "105",
    cy: "15",
    r: "15"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "r",
    from: "15",
    to: "15",
    begin: "0s",
    dur: "0.8s",
    values: "15;9;15",
    calcMode: "linear",
    repeatCount: "indefinite"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animate", {
    attributeName: "fill-opacity",
    from: "1",
    to: "1",
    begin: "0s",
    dur: "0.8s",
    values: "1;.5;1",
    calcMode: "linear",
    repeatCount: "indefinite"
  })));
}


//# sourceMappingURL=Dots.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/Loader/loaders/Oval.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/Loader/loaders/Oval.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Oval": () => (/* binding */ Oval)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


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
function Oval(_a) {
  var _b = _a, { size, color } = _b, others = __objRest(_b, ["size", "color"]);
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("svg", __spreadValues({
    width: `${size}px`,
    height: `${size}px`,
    viewBox: "0 0 38 38",
    xmlns: "http://www.w3.org/2000/svg",
    stroke: color
  }, others), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("g", {
    fill: "none",
    fillRule: "evenodd"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("g", {
    transform: "translate(2.5 2.5)",
    strokeWidth: "5"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("circle", {
    strokeOpacity: ".5",
    cx: "16",
    cy: "16",
    r: "16"
  }), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("path", {
    d: "M32 16c0-9.94-8.06-16-16-16"
  }, /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("animateTransform", {
    attributeName: "transform",
    type: "rotate",
    from: "0 16 16",
    to: "360 16 16",
    dur: "1s",
    repeatCount: "indefinite"
  })))));
}


//# sourceMappingURL=Oval.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/utils/use-sx/use-sx.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/utils/use-sx/use-sx.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useSx": () => (/* binding */ useSx)
/* harmony export */ });
/* harmony import */ var _MantineProvider_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../MantineProvider.js */ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js");
/* harmony import */ var _tss_use_css_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../tss/use-css.js */ "./node_modules/@mantine/styles/esm/tss/use-css.js");



function useSx({ sx, className }) {
  const { css, cx } = (0,_tss_use_css_js__WEBPACK_IMPORTED_MODULE_0__.useCss)();
  const theme = (0,_MantineProvider_js__WEBPACK_IMPORTED_MODULE_1__.useMantineTheme)();
  const _sx = typeof sx === "function" ? sx(theme) : sx;
  return { sxClassName: cx(css(_sx), className), css, cx, theme };
}


//# sourceMappingURL=use-sx.js.map


/***/ }),

/***/ "./resources/js/client/pages/video/action.js":
/*!***************************************************!*\
  !*** ./resources/js/client/pages/video/action.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Button/Button.js");
/**
 * External dependencies
 */



var VideoAction = function VideoAction() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(_mantine_core__WEBPACK_IMPORTED_MODULE_1__.Button, {
    variant: "outline"
  }, "Submit");
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (VideoAction);

/***/ })

}]);