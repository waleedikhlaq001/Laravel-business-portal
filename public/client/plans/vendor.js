/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@emotion/cache/dist/emotion-cache.browser.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@emotion/cache/dist/emotion-cache.browser.esm.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ createCache)
/* harmony export */ });
/* harmony import */ var _emotion_sheet__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @emotion/sheet */ "./node_modules/@emotion/sheet/dist/emotion-sheet.browser.esm.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Tokenizer.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Utility.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Enum.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Serializer.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Middleware.js");
/* harmony import */ var stylis__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! stylis */ "./node_modules/stylis/src/Parser.js");
/* harmony import */ var _emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/weak-memoize */ "./node_modules/@emotion/weak-memoize/dist/emotion-weak-memoize.esm.js");
/* harmony import */ var _emotion_memoize__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/memoize */ "./node_modules/@emotion/cache/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js");





var identifierWithPointTracking = function identifierWithPointTracking(begin, points, index) {
  var previous = 0;
  var character = 0;

  while (true) {
    previous = character;
    character = (0,stylis__WEBPACK_IMPORTED_MODULE_3__.peek)(); // &\f

    if (previous === 38 && character === 12) {
      points[index] = 1;
    }

    if ((0,stylis__WEBPACK_IMPORTED_MODULE_3__.token)(character)) {
      break;
    }

    (0,stylis__WEBPACK_IMPORTED_MODULE_3__.next)();
  }

  return (0,stylis__WEBPACK_IMPORTED_MODULE_3__.slice)(begin, stylis__WEBPACK_IMPORTED_MODULE_3__.position);
};

var toRules = function toRules(parsed, points) {
  // pretend we've started with a comma
  var index = -1;
  var character = 44;

  do {
    switch ((0,stylis__WEBPACK_IMPORTED_MODULE_3__.token)(character)) {
      case 0:
        // &\f
        if (character === 38 && (0,stylis__WEBPACK_IMPORTED_MODULE_3__.peek)() === 12) {
          // this is not 100% correct, we don't account for literal sequences here - like for example quoted strings
          // stylis inserts \f after & to know when & where it should replace this sequence with the context selector
          // and when it should just concatenate the outer and inner selectors
          // it's very unlikely for this sequence to actually appear in a different context, so we just leverage this fact here
          points[index] = 1;
        }

        parsed[index] += identifierWithPointTracking(stylis__WEBPACK_IMPORTED_MODULE_3__.position - 1, points, index);
        break;

      case 2:
        parsed[index] += (0,stylis__WEBPACK_IMPORTED_MODULE_3__.delimit)(character);
        break;

      case 4:
        // comma
        if (character === 44) {
          // colon
          parsed[++index] = (0,stylis__WEBPACK_IMPORTED_MODULE_3__.peek)() === 58 ? '&\f' : '';
          points[index] = parsed[index].length;
          break;
        }

      // fallthrough

      default:
        parsed[index] += (0,stylis__WEBPACK_IMPORTED_MODULE_4__.from)(character);
    }
  } while (character = (0,stylis__WEBPACK_IMPORTED_MODULE_3__.next)());

  return parsed;
};

var getRules = function getRules(value, points) {
  return (0,stylis__WEBPACK_IMPORTED_MODULE_3__.dealloc)(toRules((0,stylis__WEBPACK_IMPORTED_MODULE_3__.alloc)(value), points));
}; // WeakSet would be more appropriate, but only WeakMap is supported in IE11


var fixedElements = /* #__PURE__ */new WeakMap();
var compat = function compat(element) {
  if (element.type !== 'rule' || !element.parent || // positive .length indicates that this rule contains pseudo
  // negative .length indicates that this rule has been already prefixed
  element.length < 1) {
    return;
  }

  var value = element.value,
      parent = element.parent;
  var isImplicitRule = element.column === parent.column && element.line === parent.line;

  while (parent.type !== 'rule') {
    parent = parent.parent;
    if (!parent) return;
  } // short-circuit for the simplest case


  if (element.props.length === 1 && value.charCodeAt(0) !== 58
  /* colon */
  && !fixedElements.get(parent)) {
    return;
  } // if this is an implicitly inserted rule (the one eagerly inserted at the each new nested level)
  // then the props has already been manipulated beforehand as they that array is shared between it and its "rule parent"


  if (isImplicitRule) {
    return;
  }

  fixedElements.set(element, true);
  var points = [];
  var rules = getRules(value, points);
  var parentRules = parent.props;

  for (var i = 0, k = 0; i < rules.length; i++) {
    for (var j = 0; j < parentRules.length; j++, k++) {
      element.props[k] = points[i] ? rules[i].replace(/&\f/g, parentRules[j]) : parentRules[j] + " " + rules[i];
    }
  }
};
var removeLabel = function removeLabel(element) {
  if (element.type === 'decl') {
    var value = element.value;

    if ( // charcode for l
    value.charCodeAt(0) === 108 && // charcode for b
    value.charCodeAt(2) === 98) {
      // this ignores label
      element["return"] = '';
      element.value = '';
    }
  }
};
var ignoreFlag = 'emotion-disable-server-rendering-unsafe-selector-warning-please-do-not-use-this-the-warning-exists-for-a-reason';

var isIgnoringComment = function isIgnoringComment(element) {
  return element.type === 'comm' && element.children.indexOf(ignoreFlag) > -1;
};

var createUnsafeSelectorsAlarm = function createUnsafeSelectorsAlarm(cache) {
  return function (element, index, children) {
    if (element.type !== 'rule' || cache.compat) return;
    var unsafePseudoClasses = element.value.match(/(:first|:nth|:nth-last)-child/g);

    if (unsafePseudoClasses) {
      var isNested = !!element.parent; // in nested rules comments become children of the "auto-inserted" rule and that's always the `element.parent`
      //
      // considering this input:
      // .a {
      //   .b /* comm */ {}
      //   color: hotpink;
      // }
      // we get output corresponding to this:
      // .a {
      //   & {
      //     /* comm */
      //     color: hotpink;
      //   }
      //   .b {}
      // }

      var commentContainer = isNested ? element.parent.children : // global rule at the root level
      children;

      for (var i = commentContainer.length - 1; i >= 0; i--) {
        var node = commentContainer[i];

        if (node.line < element.line) {
          break;
        } // it is quite weird but comments are *usually* put at `column: element.column - 1`
        // so we seek *from the end* for the node that is earlier than the rule's `element` and check that
        // this will also match inputs like this:
        // .a {
        //   /* comm */
        //   .b {}
        // }
        //
        // but that is fine
        //
        // it would be the easiest to change the placement of the comment to be the first child of the rule:
        // .a {
        //   .b { /* comm */ }
        // }
        // with such inputs we wouldn't have to search for the comment at all
        // TODO: consider changing this comment placement in the next major version


        if (node.column < element.column) {
          if (isIgnoringComment(node)) {
            return;
          }

          break;
        }
      }

      unsafePseudoClasses.forEach(function (unsafePseudoClass) {
        console.error("The pseudo class \"" + unsafePseudoClass + "\" is potentially unsafe when doing server-side rendering. Try changing it to \"" + unsafePseudoClass.split('-child')[0] + "-of-type\".");
      });
    }
  };
};

var isImportRule = function isImportRule(element) {
  return element.type.charCodeAt(1) === 105 && element.type.charCodeAt(0) === 64;
};

var isPrependedWithRegularRules = function isPrependedWithRegularRules(index, children) {
  for (var i = index - 1; i >= 0; i--) {
    if (!isImportRule(children[i])) {
      return true;
    }
  }

  return false;
}; // use this to remove incorrect elements from further processing
// so they don't get handed to the `sheet` (or anything else)
// as that could potentially lead to additional logs which in turn could be overhelming to the user


var nullifyElement = function nullifyElement(element) {
  element.type = '';
  element.value = '';
  element["return"] = '';
  element.children = '';
  element.props = '';
};

var incorrectImportAlarm = function incorrectImportAlarm(element, index, children) {
  if (!isImportRule(element)) {
    return;
  }

  if (element.parent) {
    console.error("`@import` rules can't be nested inside other rules. Please move it to the top level and put it before regular rules. Keep in mind that they can only be used within global styles.");
    nullifyElement(element);
  } else if (isPrependedWithRegularRules(index, children)) {
    console.error("`@import` rules can't be after other rules. Please put your `@import` rules before your other rules.");
    nullifyElement(element);
  }
};

/* eslint-disable no-fallthrough */

function prefix(value, length) {
  switch ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.hash)(value, length)) {
    // color-adjust
    case 5103:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + 'print-' + value + value;
    // animation, animation-(delay|direction|duration|fill-mode|iteration-count|name|play-state|timing-function)

    case 5737:
    case 4201:
    case 3177:
    case 3433:
    case 1641:
    case 4457:
    case 2921: // text-decoration, filter, clip-path, backface-visibility, column, box-decoration-break

    case 5572:
    case 6356:
    case 5844:
    case 3191:
    case 6645:
    case 3005: // mask, mask-image, mask-(mode|clip|size), mask-(repeat|origin), mask-position, mask-composite,

    case 6391:
    case 5879:
    case 5623:
    case 6135:
    case 4599:
    case 4855: // background-clip, columns, column-(count|fill|gap|rule|rule-color|rule-style|rule-width|span|width)

    case 4215:
    case 6389:
    case 5109:
    case 5365:
    case 5621:
    case 3829:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + value;
    // appearance, user-select, transform, hyphens, text-size-adjust

    case 5349:
    case 4246:
    case 4810:
    case 6968:
    case 2756:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MOZ + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + value + value;
    // flex, flex-direction

    case 6828:
    case 4268:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + value + value;
    // order

    case 6165:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'flex-' + value + value;
    // align-items

    case 5187:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(\w+).+(:[^]+)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + 'box-$1$2' + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'flex-$1$2') + value;
    // align-self

    case 5443:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'flex-item-' + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /flex-|-self/, '') + value;
    // align-content

    case 4675:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'flex-line-pack' + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /align-content|flex-|-self/, '') + value;
    // flex-shrink

    case 5548:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, 'shrink', 'negative') + value;
    // flex-basis

    case 5292:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, 'basis', 'preferred-size') + value;
    // flex-grow

    case 6060:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + 'box-' + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, '-grow', '') + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, 'grow', 'positive') + value;
    // transition

    case 4554:
      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /([^-])(transform)/g, '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$2') + value;
    // cursor

    case 6187:
      return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)((0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)((0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(zoom-|grab)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$1'), /(image-set)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$1'), value, '') + value;
    // background, background-image

    case 5495:
    case 3959:
      return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(image-set\([^]*)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$1' + '$`$1');
    // justify-content

    case 4968:
      return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)((0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(.+:)(flex-)?(.*)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + 'box-pack:$3' + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'flex-pack:$3'), /s.+-b[^;]+/, 'justify') + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + value;
    // (margin|padding)-inline-(start|end)

    case 4095:
    case 3583:
    case 4068:
    case 2532:
      return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(.+)-inline(.+)/, stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$1$2') + value;
    // (min|max)?(width|height|inline-size|block-size)

    case 8116:
    case 7059:
    case 5753:
    case 5535:
    case 5445:
    case 5701:
    case 4933:
    case 4677:
    case 5533:
    case 5789:
    case 5021:
    case 4765:
      // stretch, max-content, min-content, fill-available
      if ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.strlen)(value) - 1 - length > 6) switch ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, length + 1)) {
        // (m)ax-content, (m)in-content
        case 109:
          // -
          if ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, length + 4) !== 45) break;
        // (f)ill-available, (f)it-content

        case 102:
          return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(.+:)(.+)-([^]+)/, '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$2-$3' + '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.MOZ + ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, length + 3) == 108 ? '$3' : '$2-$3')) + value;
        // (s)tretch

        case 115:
          return ~(0,stylis__WEBPACK_IMPORTED_MODULE_4__.indexof)(value, 'stretch') ? prefix((0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, 'stretch', 'fill-available'), length) + value : value;
      }
      break;
    // position: sticky

    case 4949:
      // (s)ticky?
      if ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, length + 1) !== 115) break;
    // display: (flex|inline-flex)

    case 6444:
      switch ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, (0,stylis__WEBPACK_IMPORTED_MODULE_4__.strlen)(value) - 3 - (~(0,stylis__WEBPACK_IMPORTED_MODULE_4__.indexof)(value, '!important') && 10))) {
        // stic(k)y
        case 107:
          return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, ':', ':' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT) + value;
        // (inline-)?fl(e)x

        case 101:
          return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /(.+:)([^;!]+)(;|!.+)?/, '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, 14) === 45 ? 'inline-' : '') + 'box$3' + '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + '$2$3' + '$1' + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + '$2box$3') + value;
      }

      break;
    // writing-mode

    case 5936:
      switch ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.charat)(value, length + 11)) {
        // vertical-l(r)
        case 114:
          return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /[svh]\w+-[tblr]{2}/, 'tb') + value;
        // vertical-r(l)

        case 108:
          return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /[svh]\w+-[tblr]{2}/, 'tb-rl') + value;
        // horizontal(-)tb

        case 45:
          return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /[svh]\w+-[tblr]{2}/, 'lr') + value;
      }

      return stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + value + stylis__WEBPACK_IMPORTED_MODULE_5__.MS + value + value;
  }

  return value;
}

var prefixer = function prefixer(element, index, children, callback) {
  if (element.length > -1) if (!element["return"]) switch (element.type) {
    case stylis__WEBPACK_IMPORTED_MODULE_5__.DECLARATION:
      element["return"] = prefix(element.value, element.length);
      break;

    case stylis__WEBPACK_IMPORTED_MODULE_5__.KEYFRAMES:
      return (0,stylis__WEBPACK_IMPORTED_MODULE_6__.serialize)([(0,stylis__WEBPACK_IMPORTED_MODULE_3__.copy)(element, {
        value: (0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(element.value, '@', '@' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT)
      })], callback);

    case stylis__WEBPACK_IMPORTED_MODULE_5__.RULESET:
      if (element.length) return (0,stylis__WEBPACK_IMPORTED_MODULE_4__.combine)(element.props, function (value) {
        switch ((0,stylis__WEBPACK_IMPORTED_MODULE_4__.match)(value, /(::plac\w+|:read-\w+)/)) {
          // :read-(only|write)
          case ':read-only':
          case ':read-write':
            return (0,stylis__WEBPACK_IMPORTED_MODULE_6__.serialize)([(0,stylis__WEBPACK_IMPORTED_MODULE_3__.copy)(element, {
              props: [(0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /:(read-\w+)/, ':' + stylis__WEBPACK_IMPORTED_MODULE_5__.MOZ + '$1')]
            })], callback);
          // :placeholder

          case '::placeholder':
            return (0,stylis__WEBPACK_IMPORTED_MODULE_6__.serialize)([(0,stylis__WEBPACK_IMPORTED_MODULE_3__.copy)(element, {
              props: [(0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /:(plac\w+)/, ':' + stylis__WEBPACK_IMPORTED_MODULE_5__.WEBKIT + 'input-$1')]
            }), (0,stylis__WEBPACK_IMPORTED_MODULE_3__.copy)(element, {
              props: [(0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /:(plac\w+)/, ':' + stylis__WEBPACK_IMPORTED_MODULE_5__.MOZ + '$1')]
            }), (0,stylis__WEBPACK_IMPORTED_MODULE_3__.copy)(element, {
              props: [(0,stylis__WEBPACK_IMPORTED_MODULE_4__.replace)(value, /:(plac\w+)/, stylis__WEBPACK_IMPORTED_MODULE_5__.MS + 'input-$1')]
            })], callback);
        }

        return '';
      });
  }
};

var defaultStylisPlugins = [prefixer];

var createCache = function createCache(options) {
  var key = options.key;

  if ( true && !key) {
    throw new Error("You have to configure `key` for your cache. Please make sure it's unique (and not equal to 'css') as it's used for linking styles to your cache.\n" + "If multiple caches share the same key they might \"fight\" for each other's style elements.");
  }

  if (key === 'css') {
    var ssrStyles = document.querySelectorAll("style[data-emotion]:not([data-s])"); // get SSRed styles out of the way of React's hydration
    // document.head is a safe place to move them to(though note document.head is not necessarily the last place they will be)
    // note this very very intentionally targets all style elements regardless of the key to ensure
    // that creating a cache works inside of render of a React component

    Array.prototype.forEach.call(ssrStyles, function (node) {
      // we want to only move elements which have a space in the data-emotion attribute value
      // because that indicates that it is an Emotion 11 server-side rendered style elements
      // while we will already ignore Emotion 11 client-side inserted styles because of the :not([data-s]) part in the selector
      // Emotion 10 client-side inserted styles did not have data-s (but importantly did not have a space in their data-emotion attributes)
      // so checking for the space ensures that loading Emotion 11 after Emotion 10 has inserted some styles
      // will not result in the Emotion 10 styles being destroyed
      var dataEmotionAttribute = node.getAttribute('data-emotion');

      if (dataEmotionAttribute.indexOf(' ') === -1) {
        return;
      }
      document.head.appendChild(node);
      node.setAttribute('data-s', '');
    });
  }

  var stylisPlugins = options.stylisPlugins || defaultStylisPlugins;

  if (true) {
    // $FlowFixMe
    if (/[^a-z-]/.test(key)) {
      throw new Error("Emotion key must only contain lower case alphabetical characters and - but \"" + key + "\" was passed");
    }
  }

  var inserted = {};
  var container;
  var nodesToHydrate = [];

  {
    container = options.container || document.head;
    Array.prototype.forEach.call( // this means we will ignore elements which don't have a space in them which
    // means that the style elements we're looking at are only Emotion 11 server-rendered style elements
    document.querySelectorAll("style[data-emotion^=\"" + key + " \"]"), function (node) {
      var attrib = node.getAttribute("data-emotion").split(' '); // $FlowFixMe

      for (var i = 1; i < attrib.length; i++) {
        inserted[attrib[i]] = true;
      }

      nodesToHydrate.push(node);
    });
  }

  var _insert;

  var omnipresentPlugins = [compat, removeLabel];

  if (true) {
    omnipresentPlugins.push(createUnsafeSelectorsAlarm({
      get compat() {
        return cache.compat;
      }

    }), incorrectImportAlarm);
  }

  {
    var currentSheet;
    var finalizingPlugins = [stylis__WEBPACK_IMPORTED_MODULE_6__.stringify,  true ? function (element) {
      if (!element.root) {
        if (element["return"]) {
          currentSheet.insert(element["return"]);
        } else if (element.value && element.type !== stylis__WEBPACK_IMPORTED_MODULE_5__.COMMENT) {
          // insert empty rule in non-production environments
          // so @emotion/jest can grab `key` from the (JS)DOM for caches without any rules inserted yet
          currentSheet.insert(element.value + "{}");
        }
      }
    } : 0];
    var serializer = (0,stylis__WEBPACK_IMPORTED_MODULE_7__.middleware)(omnipresentPlugins.concat(stylisPlugins, finalizingPlugins));

    var stylis = function stylis(styles) {
      return (0,stylis__WEBPACK_IMPORTED_MODULE_6__.serialize)((0,stylis__WEBPACK_IMPORTED_MODULE_8__.compile)(styles), serializer);
    };

    _insert = function insert(selector, serialized, sheet, shouldCache) {
      currentSheet = sheet;

      if ( true && serialized.map !== undefined) {
        currentSheet = {
          insert: function insert(rule) {
            sheet.insert(rule + serialized.map);
          }
        };
      }

      stylis(selector ? selector + "{" + serialized.styles + "}" : serialized.styles);

      if (shouldCache) {
        cache.inserted[serialized.name] = true;
      }
    };
  }

  var cache = {
    key: key,
    sheet: new _emotion_sheet__WEBPACK_IMPORTED_MODULE_0__.StyleSheet({
      key: key,
      container: container,
      nonce: options.nonce,
      speedy: options.speedy,
      prepend: options.prepend,
      insertionPoint: options.insertionPoint
    }),
    nonce: options.nonce,
    inserted: inserted,
    registered: {},
    insert: _insert
  };
  cache.sheet.hydrate(nodesToHydrate);
  return cache;
};




/***/ }),

/***/ "./node_modules/@emotion/cache/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js":
/*!***********************************************************************************************!*\
  !*** ./node_modules/@emotion/cache/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ memoize)
/* harmony export */ });
function memoize(fn) {
  var cache = Object.create(null);
  return function (arg) {
    if (cache[arg] === undefined) cache[arg] = fn(arg);
    return cache[arg];
  };
}




/***/ }),

/***/ "./node_modules/@emotion/hash/dist/emotion-hash.esm.js":
/*!*************************************************************!*\
  !*** ./node_modules/@emotion/hash/dist/emotion-hash.esm.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ murmur2)
/* harmony export */ });
/* eslint-disable */
// Inspired by https://github.com/garycourt/murmurhash-js
// Ported from https://github.com/aappleby/smhasher/blob/61a0530f28277f2e850bfc39600ce61d02b518de/src/MurmurHash2.cpp#L37-L86
function murmur2(str) {
  // 'm' and 'r' are mixing constants generated offline.
  // They're not really 'magic', they just happen to work well.
  // const m = 0x5bd1e995;
  // const r = 24;
  // Initialize the hash
  var h = 0; // Mix 4 bytes at a time into the hash

  var k,
      i = 0,
      len = str.length;

  for (; len >= 4; ++i, len -= 4) {
    k = str.charCodeAt(i) & 0xff | (str.charCodeAt(++i) & 0xff) << 8 | (str.charCodeAt(++i) & 0xff) << 16 | (str.charCodeAt(++i) & 0xff) << 24;
    k =
    /* Math.imul(k, m): */
    (k & 0xffff) * 0x5bd1e995 + ((k >>> 16) * 0xe995 << 16);
    k ^=
    /* k >>> r: */
    k >>> 24;
    h =
    /* Math.imul(k, m): */
    (k & 0xffff) * 0x5bd1e995 + ((k >>> 16) * 0xe995 << 16) ^
    /* Math.imul(h, m): */
    (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  } // Handle the last few bytes of the input array


  switch (len) {
    case 3:
      h ^= (str.charCodeAt(i + 2) & 0xff) << 16;

    case 2:
      h ^= (str.charCodeAt(i + 1) & 0xff) << 8;

    case 1:
      h ^= str.charCodeAt(i) & 0xff;
      h =
      /* Math.imul(h, m): */
      (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  } // Do a few final mixes of the hash to ensure the last few
  // bytes are well-incorporated.


  h ^= h >>> 13;
  h =
  /* Math.imul(h, m): */
  (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  return ((h ^ h >>> 15) >>> 0).toString(36);
}




/***/ }),

/***/ "./node_modules/@emotion/react/_isolated-hnrs/dist/emotion-react-_isolated-hnrs.browser.esm.js":
/*!*****************************************************************************************************!*\
  !*** ./node_modules/@emotion/react/_isolated-hnrs/dist/emotion-react-_isolated-hnrs.browser.esm.js ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ hoistNonReactStatics)
/* harmony export */ });
/* harmony import */ var hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! hoist-non-react-statics */ "./node_modules/hoist-non-react-statics/dist/hoist-non-react-statics.cjs.js");
/* harmony import */ var hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_0__);


// this file isolates this package that is not tree-shakeable
// and if this module doesn't actually contain any logic of its own
// then Rollup just use 'hoist-non-react-statics' directly in other chunks

var hoistNonReactStatics = (function (targetComponent, sourceComponent) {
  return hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_0___default()(targetComponent, sourceComponent);
});




/***/ }),

/***/ "./node_modules/@emotion/react/dist/emotion-element-c39617d8.browser.esm.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/@emotion/react/dist/emotion-element-c39617d8.browser.esm.js ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "C": () => (/* binding */ CacheProvider),
/* harmony export */   "E": () => (/* binding */ Emotion$1),
/* harmony export */   "T": () => (/* binding */ ThemeContext),
/* harmony export */   "_": () => (/* binding */ __unsafe_useEmotionCache),
/* harmony export */   "a": () => (/* binding */ ThemeProvider),
/* harmony export */   "b": () => (/* binding */ withTheme),
/* harmony export */   "c": () => (/* binding */ createEmotionProps),
/* harmony export */   "h": () => (/* binding */ hasOwnProperty),
/* harmony export */   "i": () => (/* binding */ isBrowser),
/* harmony export */   "u": () => (/* binding */ useTheme),
/* harmony export */   "w": () => (/* binding */ withEmotionCache)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _emotion_cache__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/cache */ "./node_modules/@emotion/cache/dist/emotion-cache.browser.esm.js");
/* harmony import */ var _babel_runtime_helpers_esm_extends__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/esm/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @emotion/weak-memoize */ "./node_modules/@emotion/weak-memoize/dist/emotion-weak-memoize.esm.js");
/* harmony import */ var _isolated_hnrs_dist_emotion_react_isolated_hnrs_browser_esm_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../_isolated-hnrs/dist/emotion-react-_isolated-hnrs.browser.esm.js */ "./node_modules/@emotion/react/_isolated-hnrs/dist/emotion-react-_isolated-hnrs.browser.esm.js");
/* harmony import */ var _emotion_utils__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @emotion/utils */ "./node_modules/@emotion/utils/dist/emotion-utils.browser.esm.js");
/* harmony import */ var _emotion_serialize__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @emotion/serialize */ "./node_modules/@emotion/serialize/dist/emotion-serialize.browser.esm.js");
/* harmony import */ var _emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @emotion/use-insertion-effect-with-fallbacks */ "./node_modules/@emotion/use-insertion-effect-with-fallbacks/dist/emotion-use-insertion-effect-with-fallbacks.browser.esm.js");










var isBrowser = "object" !== 'undefined';
var hasOwnProperty = {}.hasOwnProperty;

var EmotionCacheContext = /* #__PURE__ */react__WEBPACK_IMPORTED_MODULE_0__.createContext( // we're doing this to avoid preconstruct's dead code elimination in this one case
// because this module is primarily intended for the browser and node
// but it's also required in react native and similar environments sometimes
// and we could have a special build just for that
// but this is much easier and the native packages
// might use a different theme context in the future anyway
typeof HTMLElement !== 'undefined' ? /* #__PURE__ */(0,_emotion_cache__WEBPACK_IMPORTED_MODULE_1__["default"])({
  key: 'css'
}) : null);

if (true) {
  EmotionCacheContext.displayName = 'EmotionCacheContext';
}

var CacheProvider = EmotionCacheContext.Provider;
var __unsafe_useEmotionCache = function useEmotionCache() {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(EmotionCacheContext);
};

var withEmotionCache = function withEmotionCache(func) {
  // $FlowFixMe
  return /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)(function (props, ref) {
    // the cache will never be null in the browser
    var cache = (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(EmotionCacheContext);
    return func(props, cache, ref);
  });
};

if (!isBrowser) {
  withEmotionCache = function withEmotionCache(func) {
    return function (props) {
      var cache = (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(EmotionCacheContext);

      if (cache === null) {
        // yes, we're potentially creating this on every render
        // it doesn't actually matter though since it's only on the server
        // so there will only every be a single render
        // that could change in the future because of suspense and etc. but for now,
        // this works and i don't want to optimise for a future thing that we aren't sure about
        cache = (0,_emotion_cache__WEBPACK_IMPORTED_MODULE_1__["default"])({
          key: 'css'
        });
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(EmotionCacheContext.Provider, {
          value: cache
        }, func(props, cache));
      } else {
        return func(props, cache);
      }
    };
  };
}

var ThemeContext = /* #__PURE__ */react__WEBPACK_IMPORTED_MODULE_0__.createContext({});

if (true) {
  ThemeContext.displayName = 'EmotionThemeContext';
}

var useTheme = function useTheme() {
  return react__WEBPACK_IMPORTED_MODULE_0__.useContext(ThemeContext);
};

var getTheme = function getTheme(outerTheme, theme) {
  if (typeof theme === 'function') {
    var mergedTheme = theme(outerTheme);

    if ( true && (mergedTheme == null || typeof mergedTheme !== 'object' || Array.isArray(mergedTheme))) {
      throw new Error('[ThemeProvider] Please return an object from your theme function, i.e. theme={() => ({})}!');
    }

    return mergedTheme;
  }

  if ( true && (theme == null || typeof theme !== 'object' || Array.isArray(theme))) {
    throw new Error('[ThemeProvider] Please make your theme prop a plain object');
  }

  return (0,_babel_runtime_helpers_esm_extends__WEBPACK_IMPORTED_MODULE_2__["default"])({}, outerTheme, theme);
};

var createCacheWithTheme = /* #__PURE__ */(0,_emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_3__["default"])(function (outerTheme) {
  return (0,_emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_3__["default"])(function (theme) {
    return getTheme(outerTheme, theme);
  });
});
var ThemeProvider = function ThemeProvider(props) {
  var theme = react__WEBPACK_IMPORTED_MODULE_0__.useContext(ThemeContext);

  if (props.theme !== theme) {
    theme = createCacheWithTheme(theme)(props.theme);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(ThemeContext.Provider, {
    value: theme
  }, props.children);
};
function withTheme(Component) {
  var componentName = Component.displayName || Component.name || 'Component';

  var render = function render(props, ref) {
    var theme = react__WEBPACK_IMPORTED_MODULE_0__.useContext(ThemeContext);
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Component, (0,_babel_runtime_helpers_esm_extends__WEBPACK_IMPORTED_MODULE_2__["default"])({
      theme: theme,
      ref: ref
    }, props));
  }; // $FlowFixMe


  var WithTheme = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.forwardRef(render);
  WithTheme.displayName = "WithTheme(" + componentName + ")";
  return (0,_isolated_hnrs_dist_emotion_react_isolated_hnrs_browser_esm_js__WEBPACK_IMPORTED_MODULE_7__["default"])(WithTheme, Component);
}

var getLastPart = function getLastPart(functionName) {
  // The match may be something like 'Object.createEmotionProps' or
  // 'Loader.prototype.render'
  var parts = functionName.split('.');
  return parts[parts.length - 1];
};

var getFunctionNameFromStackTraceLine = function getFunctionNameFromStackTraceLine(line) {
  // V8
  var match = /^\s+at\s+([A-Za-z0-9$.]+)\s/.exec(line);
  if (match) return getLastPart(match[1]); // Safari / Firefox

  match = /^([A-Za-z0-9$.]+)@/.exec(line);
  if (match) return getLastPart(match[1]);
  return undefined;
};

var internalReactFunctionNames = /* #__PURE__ */new Set(['renderWithHooks', 'processChild', 'finishClassComponent', 'renderToString']); // These identifiers come from error stacks, so they have to be valid JS
// identifiers, thus we only need to replace what is a valid character for JS,
// but not for CSS.

var sanitizeIdentifier = function sanitizeIdentifier(identifier) {
  return identifier.replace(/\$/g, '-');
};

var getLabelFromStackTrace = function getLabelFromStackTrace(stackTrace) {
  if (!stackTrace) return undefined;
  var lines = stackTrace.split('\n');

  for (var i = 0; i < lines.length; i++) {
    var functionName = getFunctionNameFromStackTraceLine(lines[i]); // The first line of V8 stack traces is just "Error"

    if (!functionName) continue; // If we reach one of these, we have gone too far and should quit

    if (internalReactFunctionNames.has(functionName)) break; // The component name is the first function in the stack that starts with an
    // uppercase letter

    if (/^[A-Z]/.test(functionName)) return sanitizeIdentifier(functionName);
  }

  return undefined;
};

var typePropName = '__EMOTION_TYPE_PLEASE_DO_NOT_USE__';
var labelPropName = '__EMOTION_LABEL_PLEASE_DO_NOT_USE__';
var createEmotionProps = function createEmotionProps(type, props) {
  if ( true && typeof props.css === 'string' && // check if there is a css declaration
  props.css.indexOf(':') !== -1) {
    throw new Error("Strings are not allowed as css prop values, please wrap it in a css template literal from '@emotion/react' like this: css`" + props.css + "`");
  }

  var newProps = {};

  for (var key in props) {
    if (hasOwnProperty.call(props, key)) {
      newProps[key] = props[key];
    }
  }

  newProps[typePropName] = type; // For performance, only call getLabelFromStackTrace in development and when
  // the label hasn't already been computed

  if ( true && !!props.css && (typeof props.css !== 'object' || typeof props.css.name !== 'string' || props.css.name.indexOf('-') === -1)) {
    var label = getLabelFromStackTrace(new Error().stack);
    if (label) newProps[labelPropName] = label;
  }

  return newProps;
};

var Insertion = function Insertion(_ref) {
  var cache = _ref.cache,
      serialized = _ref.serialized,
      isStringTag = _ref.isStringTag;
  (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_4__.registerStyles)(cache, serialized, isStringTag);
  (0,_emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_6__.useInsertionEffectAlwaysWithSyncFallback)(function () {
    return (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_4__.insertStyles)(cache, serialized, isStringTag);
  });

  return null;
};

var Emotion = /* #__PURE__ */withEmotionCache(function (props, cache, ref) {
  var cssProp = props.css; // so that using `css` from `emotion` and passing the result to the css prop works
  // not passing the registered cache to serializeStyles because it would
  // make certain babel optimisations not possible

  if (typeof cssProp === 'string' && cache.registered[cssProp] !== undefined) {
    cssProp = cache.registered[cssProp];
  }

  var WrappedComponent = props[typePropName];
  var registeredStyles = [cssProp];
  var className = '';

  if (typeof props.className === 'string') {
    className = (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_4__.getRegisteredStyles)(cache.registered, registeredStyles, props.className);
  } else if (props.className != null) {
    className = props.className + " ";
  }

  var serialized = (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_5__.serializeStyles)(registeredStyles, undefined, react__WEBPACK_IMPORTED_MODULE_0__.useContext(ThemeContext));

  if ( true && serialized.name.indexOf('-') === -1) {
    var labelFromStack = props[labelPropName];

    if (labelFromStack) {
      serialized = (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_5__.serializeStyles)([serialized, 'label:' + labelFromStack + ';']);
    }
  }

  className += cache.key + "-" + serialized.name;
  var newProps = {};

  for (var key in props) {
    if (hasOwnProperty.call(props, key) && key !== 'css' && key !== typePropName && ( false || key !== labelPropName)) {
      newProps[key] = props[key];
    }
  }

  newProps.ref = ref;
  newProps.className = className;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(Insertion, {
    cache: cache,
    serialized: serialized,
    isStringTag: typeof WrappedComponent === 'string'
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement(WrappedComponent, newProps));
});

if (true) {
  Emotion.displayName = 'EmotionCssPropInternal';
}

var Emotion$1 = Emotion;




/***/ }),

/***/ "./node_modules/@emotion/react/dist/emotion-react.browser.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@emotion/react/dist/emotion-react.browser.esm.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CacheProvider": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.C),
/* harmony export */   "ThemeContext": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.T),
/* harmony export */   "ThemeProvider": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.a),
/* harmony export */   "__unsafe_useEmotionCache": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__._),
/* harmony export */   "useTheme": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.u),
/* harmony export */   "withEmotionCache": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.w),
/* harmony export */   "withTheme": () => (/* reexport safe */ _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.b),
/* harmony export */   "ClassNames": () => (/* binding */ ClassNames),
/* harmony export */   "Global": () => (/* binding */ Global),
/* harmony export */   "createElement": () => (/* binding */ jsx),
/* harmony export */   "css": () => (/* binding */ css),
/* harmony export */   "jsx": () => (/* binding */ jsx),
/* harmony export */   "keyframes": () => (/* binding */ keyframes)
/* harmony export */ });
/* harmony import */ var _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./emotion-element-c39617d8.browser.esm.js */ "./node_modules/@emotion/react/dist/emotion-element-c39617d8.browser.esm.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _emotion_utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/utils */ "./node_modules/@emotion/utils/dist/emotion-utils.browser.esm.js");
/* harmony import */ var _emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @emotion/use-insertion-effect-with-fallbacks */ "./node_modules/@emotion/use-insertion-effect-with-fallbacks/dist/emotion-use-insertion-effect-with-fallbacks.browser.esm.js");
/* harmony import */ var _emotion_serialize__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @emotion/serialize */ "./node_modules/@emotion/serialize/dist/emotion-serialize.browser.esm.js");
/* harmony import */ var _emotion_cache__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @emotion/cache */ "./node_modules/@emotion/cache/dist/emotion-cache.browser.esm.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @emotion/weak-memoize */ "./node_modules/@emotion/weak-memoize/dist/emotion-weak-memoize.esm.js");
/* harmony import */ var hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! hoist-non-react-statics */ "./node_modules/hoist-non-react-statics/dist/hoist-non-react-statics.cjs.js");
/* harmony import */ var hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(hoist_non_react_statics__WEBPACK_IMPORTED_MODULE_8__);












var pkg = {
	name: "@emotion/react",
	version: "11.11.1",
	main: "dist/emotion-react.cjs.js",
	module: "dist/emotion-react.esm.js",
	browser: {
		"./dist/emotion-react.esm.js": "./dist/emotion-react.browser.esm.js"
	},
	exports: {
		".": {
			module: {
				worker: "./dist/emotion-react.worker.esm.js",
				browser: "./dist/emotion-react.browser.esm.js",
				"default": "./dist/emotion-react.esm.js"
			},
			"import": "./dist/emotion-react.cjs.mjs",
			"default": "./dist/emotion-react.cjs.js"
		},
		"./jsx-runtime": {
			module: {
				worker: "./jsx-runtime/dist/emotion-react-jsx-runtime.worker.esm.js",
				browser: "./jsx-runtime/dist/emotion-react-jsx-runtime.browser.esm.js",
				"default": "./jsx-runtime/dist/emotion-react-jsx-runtime.esm.js"
			},
			"import": "./jsx-runtime/dist/emotion-react-jsx-runtime.cjs.mjs",
			"default": "./jsx-runtime/dist/emotion-react-jsx-runtime.cjs.js"
		},
		"./_isolated-hnrs": {
			module: {
				worker: "./_isolated-hnrs/dist/emotion-react-_isolated-hnrs.worker.esm.js",
				browser: "./_isolated-hnrs/dist/emotion-react-_isolated-hnrs.browser.esm.js",
				"default": "./_isolated-hnrs/dist/emotion-react-_isolated-hnrs.esm.js"
			},
			"import": "./_isolated-hnrs/dist/emotion-react-_isolated-hnrs.cjs.mjs",
			"default": "./_isolated-hnrs/dist/emotion-react-_isolated-hnrs.cjs.js"
		},
		"./jsx-dev-runtime": {
			module: {
				worker: "./jsx-dev-runtime/dist/emotion-react-jsx-dev-runtime.worker.esm.js",
				browser: "./jsx-dev-runtime/dist/emotion-react-jsx-dev-runtime.browser.esm.js",
				"default": "./jsx-dev-runtime/dist/emotion-react-jsx-dev-runtime.esm.js"
			},
			"import": "./jsx-dev-runtime/dist/emotion-react-jsx-dev-runtime.cjs.mjs",
			"default": "./jsx-dev-runtime/dist/emotion-react-jsx-dev-runtime.cjs.js"
		},
		"./package.json": "./package.json",
		"./types/css-prop": "./types/css-prop.d.ts",
		"./macro": {
			types: {
				"import": "./macro.d.mts",
				"default": "./macro.d.ts"
			},
			"default": "./macro.js"
		}
	},
	types: "types/index.d.ts",
	files: [
		"src",
		"dist",
		"jsx-runtime",
		"jsx-dev-runtime",
		"_isolated-hnrs",
		"types/*.d.ts",
		"macro.*"
	],
	sideEffects: false,
	author: "Emotion Contributors",
	license: "MIT",
	scripts: {
		"test:typescript": "dtslint types"
	},
	dependencies: {
		"@babel/runtime": "^7.18.3",
		"@emotion/babel-plugin": "^11.11.0",
		"@emotion/cache": "^11.11.0",
		"@emotion/serialize": "^1.1.2",
		"@emotion/use-insertion-effect-with-fallbacks": "^1.0.1",
		"@emotion/utils": "^1.2.1",
		"@emotion/weak-memoize": "^0.3.1",
		"hoist-non-react-statics": "^3.3.1"
	},
	peerDependencies: {
		react: ">=16.8.0"
	},
	peerDependenciesMeta: {
		"@types/react": {
			optional: true
		}
	},
	devDependencies: {
		"@definitelytyped/dtslint": "0.0.112",
		"@emotion/css": "11.11.0",
		"@emotion/css-prettifier": "1.1.3",
		"@emotion/server": "11.11.0",
		"@emotion/styled": "11.11.0",
		"html-tag-names": "^1.1.2",
		react: "16.14.0",
		"svg-tag-names": "^1.1.1",
		typescript: "^4.5.5"
	},
	repository: "https://github.com/emotion-js/emotion/tree/main/packages/react",
	publishConfig: {
		access: "public"
	},
	"umd:main": "dist/emotion-react.umd.min.js",
	preconstruct: {
		entrypoints: [
			"./index.js",
			"./jsx-runtime.js",
			"./jsx-dev-runtime.js",
			"./_isolated-hnrs.js"
		],
		umdName: "emotionReact",
		exports: {
			envConditions: [
				"browser",
				"worker"
			],
			extra: {
				"./types/css-prop": "./types/css-prop.d.ts",
				"./macro": {
					types: {
						"import": "./macro.d.mts",
						"default": "./macro.d.ts"
					},
					"default": "./macro.js"
				}
			}
		}
	}
};

var jsx = function jsx(type, props) {
  var args = arguments;

  if (props == null || !_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.h.call(props, 'css')) {
    // $FlowFixMe
    return react__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(undefined, args);
  }

  var argsLength = args.length;
  var createElementArgArray = new Array(argsLength);
  createElementArgArray[0] = _emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.E;
  createElementArgArray[1] = (0,_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.c)(type, props);

  for (var i = 2; i < argsLength; i++) {
    createElementArgArray[i] = args[i];
  } // $FlowFixMe


  return react__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(null, createElementArgArray);
};

var warnedAboutCssPropForGlobal = false; // maintain place over rerenders.
// initial render from browser, insertBefore context.sheet.tags[0] or if a style hasn't been inserted there yet, appendChild
// initial client-side render from SSR, use place of hydrating tag

var Global = /* #__PURE__ */(0,_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.w)(function (props, cache) {
  if ( true && !warnedAboutCssPropForGlobal && ( // check for className as well since the user is
  // probably using the custom createElement which
  // means it will be turned into a className prop
  // $FlowFixMe I don't really want to add it to the type since it shouldn't be used
  props.className || props.css)) {
    console.error("It looks like you're using the css prop on Global, did you mean to use the styles prop instead?");
    warnedAboutCssPropForGlobal = true;
  }

  var styles = props.styles;
  var serialized = (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_4__.serializeStyles)([styles], undefined, react__WEBPACK_IMPORTED_MODULE_1__.useContext(_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.T));

  if (!_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.i) {
    var _ref;

    var serializedNames = serialized.name;
    var serializedStyles = serialized.styles;
    var next = serialized.next;

    while (next !== undefined) {
      serializedNames += ' ' + next.name;
      serializedStyles += next.styles;
      next = next.next;
    }

    var shouldCache = cache.compat === true;
    var rules = cache.insert("", {
      name: serializedNames,
      styles: serializedStyles
    }, cache.sheet, shouldCache);

    if (shouldCache) {
      return null;
    }

    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1__.createElement("style", (_ref = {}, _ref["data-emotion"] = cache.key + "-global " + serializedNames, _ref.dangerouslySetInnerHTML = {
      __html: rules
    }, _ref.nonce = cache.sheet.nonce, _ref));
  } // yes, i know these hooks are used conditionally
  // but it is based on a constant that will never change at runtime
  // it's effectively like having two implementations and switching them out
  // so it's not actually breaking anything


  var sheetRef = react__WEBPACK_IMPORTED_MODULE_1__.useRef();
  (0,_emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_3__.useInsertionEffectWithLayoutFallback)(function () {
    var key = cache.key + "-global"; // use case of https://github.com/emotion-js/emotion/issues/2675

    var sheet = new cache.sheet.constructor({
      key: key,
      nonce: cache.sheet.nonce,
      container: cache.sheet.container,
      speedy: cache.sheet.isSpeedy
    });
    var rehydrating = false; // $FlowFixMe

    var node = document.querySelector("style[data-emotion=\"" + key + " " + serialized.name + "\"]");

    if (cache.sheet.tags.length) {
      sheet.before = cache.sheet.tags[0];
    }

    if (node !== null) {
      rehydrating = true; // clear the hash so this node won't be recognizable as rehydratable by other <Global/>s

      node.setAttribute('data-emotion', key);
      sheet.hydrate([node]);
    }

    sheetRef.current = [sheet, rehydrating];
    return function () {
      sheet.flush();
    };
  }, [cache]);
  (0,_emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_3__.useInsertionEffectWithLayoutFallback)(function () {
    var sheetRefCurrent = sheetRef.current;
    var sheet = sheetRefCurrent[0],
        rehydrating = sheetRefCurrent[1];

    if (rehydrating) {
      sheetRefCurrent[1] = false;
      return;
    }

    if (serialized.next !== undefined) {
      // insert keyframes
      (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.insertStyles)(cache, serialized.next, true);
    }

    if (sheet.tags.length) {
      // if this doesn't exist then it will be null so the style element will be appended
      var element = sheet.tags[sheet.tags.length - 1].nextElementSibling;
      sheet.before = element;
      sheet.flush();
    }

    cache.insert("", serialized, sheet, false);
  }, [cache, serialized.name]);
  return null;
});

if (true) {
  Global.displayName = 'EmotionGlobal';
}

function css() {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  return (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_4__.serializeStyles)(args);
}

var keyframes = function keyframes() {
  var insertable = css.apply(void 0, arguments);
  var name = "animation-" + insertable.name; // $FlowFixMe

  return {
    name: name,
    styles: "@keyframes " + name + "{" + insertable.styles + "}",
    anim: 1,
    toString: function toString() {
      return "_EMO_" + this.name + "_" + this.styles + "_EMO_";
    }
  };
};

var classnames = function classnames(args) {
  var len = args.length;
  var i = 0;
  var cls = '';

  for (; i < len; i++) {
    var arg = args[i];
    if (arg == null) continue;
    var toAdd = void 0;

    switch (typeof arg) {
      case 'boolean':
        break;

      case 'object':
        {
          if (Array.isArray(arg)) {
            toAdd = classnames(arg);
          } else {
            if ( true && arg.styles !== undefined && arg.name !== undefined) {
              console.error('You have passed styles created with `css` from `@emotion/react` package to the `cx`.\n' + '`cx` is meant to compose class names (strings) so you should convert those styles to a class name by passing them to the `css` received from <ClassNames/> component.');
            }

            toAdd = '';

            for (var k in arg) {
              if (arg[k] && k) {
                toAdd && (toAdd += ' ');
                toAdd += k;
              }
            }
          }

          break;
        }

      default:
        {
          toAdd = arg;
        }
    }

    if (toAdd) {
      cls && (cls += ' ');
      cls += toAdd;
    }
  }

  return cls;
};

function merge(registered, css, className) {
  var registeredStyles = [];
  var rawClassName = (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.getRegisteredStyles)(registered, registeredStyles, className);

  if (registeredStyles.length < 2) {
    return className;
  }

  return rawClassName + css(registeredStyles);
}

var Insertion = function Insertion(_ref) {
  var cache = _ref.cache,
      serializedArr = _ref.serializedArr;
  (0,_emotion_use_insertion_effect_with_fallbacks__WEBPACK_IMPORTED_MODULE_3__.useInsertionEffectAlwaysWithSyncFallback)(function () {

    for (var i = 0; i < serializedArr.length; i++) {
      (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.insertStyles)(cache, serializedArr[i], false);
    }
  });

  return null;
};

var ClassNames = /* #__PURE__ */(0,_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.w)(function (props, cache) {
  var hasRendered = false;
  var serializedArr = [];

  var css = function css() {
    if (hasRendered && "development" !== 'production') {
      throw new Error('css can only be used during render');
    }

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var serialized = (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_4__.serializeStyles)(args, cache.registered);
    serializedArr.push(serialized); // registration has to happen here as the result of this might get consumed by `cx`

    (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.registerStyles)(cache, serialized, false);
    return cache.key + "-" + serialized.name;
  };

  var cx = function cx() {
    if (hasRendered && "development" !== 'production') {
      throw new Error('cx can only be used during render');
    }

    for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args[_key2] = arguments[_key2];
    }

    return merge(cache.registered, css, classnames(args));
  };

  var content = {
    css: css,
    cx: cx,
    theme: react__WEBPACK_IMPORTED_MODULE_1__.useContext(_emotion_element_c39617d8_browser_esm_js__WEBPACK_IMPORTED_MODULE_0__.T)
  };
  var ele = props.children(content);
  hasRendered = true;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1__.createElement(react__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1__.createElement(Insertion, {
    cache: cache,
    serializedArr: serializedArr
  }), ele);
});

if (true) {
  ClassNames.displayName = 'EmotionClassNames';
}

if (true) {
  var isBrowser = "object" !== 'undefined'; // #1727, #2905 for some reason Jest and Vitest evaluate modules twice if some consuming module gets mocked

  var isTestEnv = typeof jest !== 'undefined' || typeof vi !== 'undefined';

  if (isBrowser && !isTestEnv) {
    // globalThis has wide browser support - https://caniuse.com/?search=globalThis, Node.js 12 and later
    var globalContext = // $FlowIgnore
    typeof globalThis !== 'undefined' ? globalThis // eslint-disable-line no-undef
    : isBrowser ? window : __webpack_require__.g;
    var globalKey = "__EMOTION_REACT_" + pkg.version.split('.')[0] + "__";

    if (globalContext[globalKey]) {
      console.warn('You are loading @emotion/react when it is already loaded. Running ' + 'multiple instances may cause problems. This can happen if multiple ' + 'versions are used, or if multiple builds of the same version are ' + 'used.');
    }

    globalContext[globalKey] = true;
  }
}




/***/ }),

/***/ "./node_modules/@emotion/serialize/dist/emotion-serialize.browser.esm.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@emotion/serialize/dist/emotion-serialize.browser.esm.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "serializeStyles": () => (/* binding */ serializeStyles)
/* harmony export */ });
/* harmony import */ var _emotion_hash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @emotion/hash */ "./node_modules/@emotion/hash/dist/emotion-hash.esm.js");
/* harmony import */ var _emotion_unitless__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/unitless */ "./node_modules/@emotion/unitless/dist/emotion-unitless.esm.js");
/* harmony import */ var _emotion_memoize__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/memoize */ "./node_modules/@emotion/serialize/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js");




var ILLEGAL_ESCAPE_SEQUENCE_ERROR = "You have illegal escape sequence in your template literal, most likely inside content's property value.\nBecause you write your CSS inside a JavaScript string you actually have to do double escaping, so for example \"content: '\\00d7';\" should become \"content: '\\\\00d7';\".\nYou can read more about this here:\nhttps://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals#ES2018_revision_of_illegal_escape_sequences";
var UNDEFINED_AS_OBJECT_KEY_ERROR = "You have passed in falsy value as style object's key (can happen when in example you pass unexported component as computed key).";
var hyphenateRegex = /[A-Z]|^ms/g;
var animationRegex = /_EMO_([^_]+?)_([^]*?)_EMO_/g;

var isCustomProperty = function isCustomProperty(property) {
  return property.charCodeAt(1) === 45;
};

var isProcessableValue = function isProcessableValue(value) {
  return value != null && typeof value !== 'boolean';
};

var processStyleName = /* #__PURE__ */(0,_emotion_memoize__WEBPACK_IMPORTED_MODULE_2__["default"])(function (styleName) {
  return isCustomProperty(styleName) ? styleName : styleName.replace(hyphenateRegex, '-$&').toLowerCase();
});

var processStyleValue = function processStyleValue(key, value) {
  switch (key) {
    case 'animation':
    case 'animationName':
      {
        if (typeof value === 'string') {
          return value.replace(animationRegex, function (match, p1, p2) {
            cursor = {
              name: p1,
              styles: p2,
              next: cursor
            };
            return p1;
          });
        }
      }
  }

  if (_emotion_unitless__WEBPACK_IMPORTED_MODULE_1__["default"][key] !== 1 && !isCustomProperty(key) && typeof value === 'number' && value !== 0) {
    return value + 'px';
  }

  return value;
};

if (true) {
  var contentValuePattern = /(var|attr|counters?|url|element|(((repeating-)?(linear|radial))|conic)-gradient)\(|(no-)?(open|close)-quote/;
  var contentValues = ['normal', 'none', 'initial', 'inherit', 'unset'];
  var oldProcessStyleValue = processStyleValue;
  var msPattern = /^-ms-/;
  var hyphenPattern = /-(.)/g;
  var hyphenatedCache = {};

  processStyleValue = function processStyleValue(key, value) {
    if (key === 'content') {
      if (typeof value !== 'string' || contentValues.indexOf(value) === -1 && !contentValuePattern.test(value) && (value.charAt(0) !== value.charAt(value.length - 1) || value.charAt(0) !== '"' && value.charAt(0) !== "'")) {
        throw new Error("You seem to be using a value for 'content' without quotes, try replacing it with `content: '\"" + value + "\"'`");
      }
    }

    var processed = oldProcessStyleValue(key, value);

    if (processed !== '' && !isCustomProperty(key) && key.indexOf('-') !== -1 && hyphenatedCache[key] === undefined) {
      hyphenatedCache[key] = true;
      console.error("Using kebab-case for css properties in objects is not supported. Did you mean " + key.replace(msPattern, 'ms-').replace(hyphenPattern, function (str, _char) {
        return _char.toUpperCase();
      }) + "?");
    }

    return processed;
  };
}

var noComponentSelectorMessage = 'Component selectors can only be used in conjunction with ' + '@emotion/babel-plugin, the swc Emotion plugin, or another Emotion-aware ' + 'compiler transform.';

function handleInterpolation(mergedProps, registered, interpolation) {
  if (interpolation == null) {
    return '';
  }

  if (interpolation.__emotion_styles !== undefined) {
    if ( true && interpolation.toString() === 'NO_COMPONENT_SELECTOR') {
      throw new Error(noComponentSelectorMessage);
    }

    return interpolation;
  }

  switch (typeof interpolation) {
    case 'boolean':
      {
        return '';
      }

    case 'object':
      {
        if (interpolation.anim === 1) {
          cursor = {
            name: interpolation.name,
            styles: interpolation.styles,
            next: cursor
          };
          return interpolation.name;
        }

        if (interpolation.styles !== undefined) {
          var next = interpolation.next;

          if (next !== undefined) {
            // not the most efficient thing ever but this is a pretty rare case
            // and there will be very few iterations of this generally
            while (next !== undefined) {
              cursor = {
                name: next.name,
                styles: next.styles,
                next: cursor
              };
              next = next.next;
            }
          }

          var styles = interpolation.styles + ";";

          if ( true && interpolation.map !== undefined) {
            styles += interpolation.map;
          }

          return styles;
        }

        return createStringFromObject(mergedProps, registered, interpolation);
      }

    case 'function':
      {
        if (mergedProps !== undefined) {
          var previousCursor = cursor;
          var result = interpolation(mergedProps);
          cursor = previousCursor;
          return handleInterpolation(mergedProps, registered, result);
        } else if (true) {
          console.error('Functions that are interpolated in css calls will be stringified.\n' + 'If you want to have a css call based on props, create a function that returns a css call like this\n' + 'let dynamicStyle = (props) => css`color: ${props.color}`\n' + 'It can be called directly with props or interpolated in a styled call like this\n' + "let SomeComponent = styled('div')`${dynamicStyle}`");
        }

        break;
      }

    case 'string':
      if (true) {
        var matched = [];
        var replaced = interpolation.replace(animationRegex, function (match, p1, p2) {
          var fakeVarName = "animation" + matched.length;
          matched.push("const " + fakeVarName + " = keyframes`" + p2.replace(/^@keyframes animation-\w+/, '') + "`");
          return "${" + fakeVarName + "}";
        });

        if (matched.length) {
          console.error('`keyframes` output got interpolated into plain string, please wrap it with `css`.\n\n' + 'Instead of doing this:\n\n' + [].concat(matched, ["`" + replaced + "`"]).join('\n') + '\n\nYou should wrap it with `css` like this:\n\n' + ("css`" + replaced + "`"));
        }
      }

      break;
  } // finalize string values (regular strings and functions interpolated into css calls)


  if (registered == null) {
    return interpolation;
  }

  var cached = registered[interpolation];
  return cached !== undefined ? cached : interpolation;
}

function createStringFromObject(mergedProps, registered, obj) {
  var string = '';

  if (Array.isArray(obj)) {
    for (var i = 0; i < obj.length; i++) {
      string += handleInterpolation(mergedProps, registered, obj[i]) + ";";
    }
  } else {
    for (var _key in obj) {
      var value = obj[_key];

      if (typeof value !== 'object') {
        if (registered != null && registered[value] !== undefined) {
          string += _key + "{" + registered[value] + "}";
        } else if (isProcessableValue(value)) {
          string += processStyleName(_key) + ":" + processStyleValue(_key, value) + ";";
        }
      } else {
        if (_key === 'NO_COMPONENT_SELECTOR' && "development" !== 'production') {
          throw new Error(noComponentSelectorMessage);
        }

        if (Array.isArray(value) && typeof value[0] === 'string' && (registered == null || registered[value[0]] === undefined)) {
          for (var _i = 0; _i < value.length; _i++) {
            if (isProcessableValue(value[_i])) {
              string += processStyleName(_key) + ":" + processStyleValue(_key, value[_i]) + ";";
            }
          }
        } else {
          var interpolated = handleInterpolation(mergedProps, registered, value);

          switch (_key) {
            case 'animation':
            case 'animationName':
              {
                string += processStyleName(_key) + ":" + interpolated + ";";
                break;
              }

            default:
              {
                if ( true && _key === 'undefined') {
                  console.error(UNDEFINED_AS_OBJECT_KEY_ERROR);
                }

                string += _key + "{" + interpolated + "}";
              }
          }
        }
      }
    }
  }

  return string;
}

var labelPattern = /label:\s*([^\s;\n{]+)\s*(;|$)/g;
var sourceMapPattern;

if (true) {
  sourceMapPattern = /\/\*#\ssourceMappingURL=data:application\/json;\S+\s+\*\//g;
} // this is the cursor for keyframes
// keyframes are stored on the SerializedStyles object as a linked list


var cursor;
var serializeStyles = function serializeStyles(args, registered, mergedProps) {
  if (args.length === 1 && typeof args[0] === 'object' && args[0] !== null && args[0].styles !== undefined) {
    return args[0];
  }

  var stringMode = true;
  var styles = '';
  cursor = undefined;
  var strings = args[0];

  if (strings == null || strings.raw === undefined) {
    stringMode = false;
    styles += handleInterpolation(mergedProps, registered, strings);
  } else {
    if ( true && strings[0] === undefined) {
      console.error(ILLEGAL_ESCAPE_SEQUENCE_ERROR);
    }

    styles += strings[0];
  } // we start at 1 since we've already handled the first arg


  for (var i = 1; i < args.length; i++) {
    styles += handleInterpolation(mergedProps, registered, args[i]);

    if (stringMode) {
      if ( true && strings[i] === undefined) {
        console.error(ILLEGAL_ESCAPE_SEQUENCE_ERROR);
      }

      styles += strings[i];
    }
  }

  var sourceMap;

  if (true) {
    styles = styles.replace(sourceMapPattern, function (match) {
      sourceMap = match;
      return '';
    });
  } // using a global regex with .exec is stateful so lastIndex has to be reset each time


  labelPattern.lastIndex = 0;
  var identifierName = '';
  var match; // https://esbench.com/bench/5b809c2cf2949800a0f61fb5

  while ((match = labelPattern.exec(styles)) !== null) {
    identifierName += '-' + // $FlowFixMe we know it's not null
    match[1];
  }

  var name = (0,_emotion_hash__WEBPACK_IMPORTED_MODULE_0__["default"])(styles) + identifierName;

  if (true) {
    // $FlowFixMe SerializedStyles type doesn't have toString property (and we don't want to add it)
    return {
      name: name,
      styles: styles,
      map: sourceMap,
      next: cursor,
      toString: function toString() {
        return "You have tried to stringify object returned from `css` function. It isn't supposed to be used directly (e.g. as value of the `className` prop), but rather handed to emotion so it can handle it (e.g. as value of `css` prop).";
      }
    };
  }

  return {
    name: name,
    styles: styles,
    next: cursor
  };
};




/***/ }),

/***/ "./node_modules/@emotion/serialize/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js":
/*!***************************************************************************************************!*\
  !*** ./node_modules/@emotion/serialize/node_modules/@emotion/memoize/dist/emotion-memoize.esm.js ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ memoize)
/* harmony export */ });
function memoize(fn) {
  var cache = Object.create(null);
  return function (arg) {
    if (cache[arg] === undefined) cache[arg] = fn(arg);
    return cache[arg];
  };
}




/***/ }),

/***/ "./node_modules/@emotion/sheet/dist/emotion-sheet.browser.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@emotion/sheet/dist/emotion-sheet.browser.esm.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "StyleSheet": () => (/* binding */ StyleSheet)
/* harmony export */ });
/*

Based off glamor's StyleSheet, thanks Sunil ❤️

high performance StyleSheet for css-in-js systems

- uses multiple style tags behind the scenes for millions of rules
- uses `insertRule` for appending in production for *much* faster performance

// usage

import { StyleSheet } from '@emotion/sheet'

let styleSheet = new StyleSheet({ key: '', container: document.head })

styleSheet.insert('#box { border: 1px solid red; }')
- appends a css rule into the stylesheet

styleSheet.flush()
- empties the stylesheet of all its contents

*/
// $FlowFixMe
function sheetForTag(tag) {
  if (tag.sheet) {
    // $FlowFixMe
    return tag.sheet;
  } // this weirdness brought to you by firefox

  /* istanbul ignore next */


  for (var i = 0; i < document.styleSheets.length; i++) {
    if (document.styleSheets[i].ownerNode === tag) {
      // $FlowFixMe
      return document.styleSheets[i];
    }
  }
}

function createStyleElement(options) {
  var tag = document.createElement('style');
  tag.setAttribute('data-emotion', options.key);

  if (options.nonce !== undefined) {
    tag.setAttribute('nonce', options.nonce);
  }

  tag.appendChild(document.createTextNode(''));
  tag.setAttribute('data-s', '');
  return tag;
}

var StyleSheet = /*#__PURE__*/function () {
  // Using Node instead of HTMLElement since container may be a ShadowRoot
  function StyleSheet(options) {
    var _this = this;

    this._insertTag = function (tag) {
      var before;

      if (_this.tags.length === 0) {
        if (_this.insertionPoint) {
          before = _this.insertionPoint.nextSibling;
        } else if (_this.prepend) {
          before = _this.container.firstChild;
        } else {
          before = _this.before;
        }
      } else {
        before = _this.tags[_this.tags.length - 1].nextSibling;
      }

      _this.container.insertBefore(tag, before);

      _this.tags.push(tag);
    };

    this.isSpeedy = options.speedy === undefined ? "development" === 'production' : options.speedy;
    this.tags = [];
    this.ctr = 0;
    this.nonce = options.nonce; // key is the value of the data-emotion attribute, it's used to identify different sheets

    this.key = options.key;
    this.container = options.container;
    this.prepend = options.prepend;
    this.insertionPoint = options.insertionPoint;
    this.before = null;
  }

  var _proto = StyleSheet.prototype;

  _proto.hydrate = function hydrate(nodes) {
    nodes.forEach(this._insertTag);
  };

  _proto.insert = function insert(rule) {
    // the max length is how many rules we have per style tag, it's 65000 in speedy mode
    // it's 1 in dev because we insert source maps that map a single rule to a location
    // and you can only have one source map per style tag
    if (this.ctr % (this.isSpeedy ? 65000 : 1) === 0) {
      this._insertTag(createStyleElement(this));
    }

    var tag = this.tags[this.tags.length - 1];

    if (true) {
      var isImportRule = rule.charCodeAt(0) === 64 && rule.charCodeAt(1) === 105;

      if (isImportRule && this._alreadyInsertedOrderInsensitiveRule) {
        // this would only cause problem in speedy mode
        // but we don't want enabling speedy to affect the observable behavior
        // so we report this error at all times
        console.error("You're attempting to insert the following rule:\n" + rule + '\n\n`@import` rules must be before all other types of rules in a stylesheet but other rules have already been inserted. Please ensure that `@import` rules are before all other rules.');
      }
      this._alreadyInsertedOrderInsensitiveRule = this._alreadyInsertedOrderInsensitiveRule || !isImportRule;
    }

    if (this.isSpeedy) {
      var sheet = sheetForTag(tag);

      try {
        // this is the ultrafast version, works across browsers
        // the big drawback is that the css won't be editable in devtools
        sheet.insertRule(rule, sheet.cssRules.length);
      } catch (e) {
        if ( true && !/:(-moz-placeholder|-moz-focus-inner|-moz-focusring|-ms-input-placeholder|-moz-read-write|-moz-read-only|-ms-clear|-ms-expand|-ms-reveal){/.test(rule)) {
          console.error("There was a problem inserting the following rule: \"" + rule + "\"", e);
        }
      }
    } else {
      tag.appendChild(document.createTextNode(rule));
    }

    this.ctr++;
  };

  _proto.flush = function flush() {
    // $FlowFixMe
    this.tags.forEach(function (tag) {
      return tag.parentNode && tag.parentNode.removeChild(tag);
    });
    this.tags = [];
    this.ctr = 0;

    if (true) {
      this._alreadyInsertedOrderInsensitiveRule = false;
    }
  };

  return StyleSheet;
}();




/***/ }),

/***/ "./node_modules/@emotion/unitless/dist/emotion-unitless.esm.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@emotion/unitless/dist/emotion-unitless.esm.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ unitlessKeys)
/* harmony export */ });
var unitlessKeys = {
  animationIterationCount: 1,
  aspectRatio: 1,
  borderImageOutset: 1,
  borderImageSlice: 1,
  borderImageWidth: 1,
  boxFlex: 1,
  boxFlexGroup: 1,
  boxOrdinalGroup: 1,
  columnCount: 1,
  columns: 1,
  flex: 1,
  flexGrow: 1,
  flexPositive: 1,
  flexShrink: 1,
  flexNegative: 1,
  flexOrder: 1,
  gridRow: 1,
  gridRowEnd: 1,
  gridRowSpan: 1,
  gridRowStart: 1,
  gridColumn: 1,
  gridColumnEnd: 1,
  gridColumnSpan: 1,
  gridColumnStart: 1,
  msGridRow: 1,
  msGridRowSpan: 1,
  msGridColumn: 1,
  msGridColumnSpan: 1,
  fontWeight: 1,
  lineHeight: 1,
  opacity: 1,
  order: 1,
  orphans: 1,
  tabSize: 1,
  widows: 1,
  zIndex: 1,
  zoom: 1,
  WebkitLineClamp: 1,
  // SVG-related properties
  fillOpacity: 1,
  floodOpacity: 1,
  stopOpacity: 1,
  strokeDasharray: 1,
  strokeDashoffset: 1,
  strokeMiterlimit: 1,
  strokeOpacity: 1,
  strokeWidth: 1
};




/***/ }),

/***/ "./node_modules/@emotion/use-insertion-effect-with-fallbacks/dist/emotion-use-insertion-effect-with-fallbacks.browser.esm.js":
/*!***********************************************************************************************************************************!*\
  !*** ./node_modules/@emotion/use-insertion-effect-with-fallbacks/dist/emotion-use-insertion-effect-with-fallbacks.browser.esm.js ***!
  \***********************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

var react__WEBPACK_IMPORTED_MODULE_0___namespace_cache;
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useInsertionEffectAlwaysWithSyncFallback": () => (/* binding */ useInsertionEffectAlwaysWithSyncFallback),
/* harmony export */   "useInsertionEffectWithLayoutFallback": () => (/* binding */ useInsertionEffectWithLayoutFallback)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


var syncFallback = function syncFallback(create) {
  return create();
};

var useInsertionEffect = /*#__PURE__*/ (react__WEBPACK_IMPORTED_MODULE_0___namespace_cache || (react__WEBPACK_IMPORTED_MODULE_0___namespace_cache = __webpack_require__.t(react__WEBPACK_IMPORTED_MODULE_0__, 2)))['useInsertion' + 'Effect'] ? /*#__PURE__*/ (react__WEBPACK_IMPORTED_MODULE_0___namespace_cache || (react__WEBPACK_IMPORTED_MODULE_0___namespace_cache = __webpack_require__.t(react__WEBPACK_IMPORTED_MODULE_0__, 2)))['useInsertion' + 'Effect'] : false;
var useInsertionEffectAlwaysWithSyncFallback = useInsertionEffect || syncFallback;
var useInsertionEffectWithLayoutFallback = useInsertionEffect || react__WEBPACK_IMPORTED_MODULE_0__.useLayoutEffect;




/***/ }),

/***/ "./node_modules/@emotion/utils/dist/emotion-utils.browser.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@emotion/utils/dist/emotion-utils.browser.esm.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getRegisteredStyles": () => (/* binding */ getRegisteredStyles),
/* harmony export */   "insertStyles": () => (/* binding */ insertStyles),
/* harmony export */   "registerStyles": () => (/* binding */ registerStyles)
/* harmony export */ });
var isBrowser = "object" !== 'undefined';
function getRegisteredStyles(registered, registeredStyles, classNames) {
  var rawClassName = '';
  classNames.split(' ').forEach(function (className) {
    if (registered[className] !== undefined) {
      registeredStyles.push(registered[className] + ";");
    } else {
      rawClassName += className + " ";
    }
  });
  return rawClassName;
}
var registerStyles = function registerStyles(cache, serialized, isStringTag) {
  var className = cache.key + "-" + serialized.name;

  if ( // we only need to add the styles to the registered cache if the
  // class name could be used further down
  // the tree but if it's a string tag, we know it won't
  // so we don't have to add it to registered cache.
  // this improves memory usage since we can avoid storing the whole style string
  (isStringTag === false || // we need to always store it if we're in compat mode and
  // in node since emotion-server relies on whether a style is in
  // the registered cache to know whether a style is global or not
  // also, note that this check will be dead code eliminated in the browser
  isBrowser === false ) && cache.registered[className] === undefined) {
    cache.registered[className] = serialized.styles;
  }
};
var insertStyles = function insertStyles(cache, serialized, isStringTag) {
  registerStyles(cache, serialized, isStringTag);
  var className = cache.key + "-" + serialized.name;

  if (cache.inserted[serialized.name] === undefined) {
    var current = serialized;

    do {
      cache.insert(serialized === current ? "." + className : '', current, cache.sheet, true);

      current = current.next;
    } while (current !== undefined);
  }
};




/***/ }),

/***/ "./node_modules/@emotion/weak-memoize/dist/emotion-weak-memoize.esm.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@emotion/weak-memoize/dist/emotion-weak-memoize.esm.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ weakMemoize)
/* harmony export */ });
var weakMemoize = function weakMemoize(func) {
  // $FlowFixMe flow doesn't include all non-primitive types as allowed for weakmaps
  var cache = new WeakMap();
  return function (arg) {
    if (cache.has(arg)) {
      // $FlowFixMe
      return cache.get(arg);
    }

    var ret = func(arg);
    cache.set(arg, ret);
    return ret;
  };
};




/***/ }),

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

/***/ "./node_modules/@mantine/core/esm/components/List/List.js":
/*!****************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/List/List.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "List": () => (/* binding */ List)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _ListItem_ListItem_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ListItem/ListItem.js */ "./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.js");
/* harmony import */ var _List_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./List.styles.js */ "./node_modules/@mantine/core/esm/components/List/List.styles.js");





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
function List(_a) {
  var _b = _a, {
    children,
    type = "unordered",
    size = "md",
    listStyleType,
    withPadding = false,
    center = false,
    spacing = 0,
    icon,
    className,
    style,
    styles,
    classNames,
    sx
  } = _b, others = __objRest(_b, [
    "children",
    "type",
    "size",
    "listStyleType",
    "withPadding",
    "center",
    "spacing",
    "icon",
    "className",
    "style",
    "styles",
    "classNames",
    "sx"
  ]);
  const { classes, cx } = (0,_List_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({ withPadding, size, listStyleType }, { sx, classNames, styles, name: "List" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.useExtractedMargins)({ others, style });
  const Element = type === "unordered" ? "ul" : "ol";
  const items = react__WEBPACK_IMPORTED_MODULE_0__.Children.toArray(children).filter((item) => item.type === _ListItem_ListItem_js__WEBPACK_IMPORTED_MODULE_3__.ListItem).map((item) => {
    var _a2;
    return react__WEBPACK_IMPORTED_MODULE_0__.cloneElement(item, {
      classNames,
      styles,
      spacing,
      center,
      icon: ((_a2 = item.props) == null ? void 0 : _a2.icon) || icon
    });
  });
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(Element, __spreadValues({
    className: cx(classes.root, className),
    style: mergedStyles
  }, rest), items);
}
List.Item = _ListItem_ListItem_js__WEBPACK_IMPORTED_MODULE_3__.ListItem;
List.displayName = "@mantine/core/List";


//# sourceMappingURL=List.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/List/List.styles.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/List/List.styles.js ***!
  \***********************************************************************/
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
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { withPadding, size, listStyleType }) => ({
  root: __spreadProps(__spreadValues({}, theme.fn.fontStyles()), {
    listStyleType,
    color: theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black,
    fontSize: theme.fn.size({ size, sizes: theme.fontSizes }),
    lineHeight: theme.lineHeight,
    margin: 0,
    paddingLeft: withPadding ? theme.spacing.xl : 0,
    listStylePosition: "inside"
  })
}));

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=List.styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ListItem": () => (/* binding */ ListItem)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-sx/use-sx.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _ListItem_styles_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ListItem.styles.js */ "./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.styles.js");




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
function ListItem(_a) {
  var _b = _a, {
    className,
    style,
    children,
    icon,
    classNames,
    styles,
    spacing,
    center,
    sx
  } = _b, others = __objRest(_b, [
    "className",
    "style",
    "children",
    "icon",
    "classNames",
    "styles",
    "spacing",
    "center",
    "sx"
  ]);
  const { sxClassName } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.useSx)({ sx });
  const { classes, cx } = (0,_ListItem_styles_js__WEBPACK_IMPORTED_MODULE_2__["default"])({ spacing, center }, { classNames, styles, name: "List" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_3__.useExtractedMargins)({ others, style });
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("li", __spreadValues({
    className: cx(classes.item, { [classes.withIcon]: icon }, sxClassName, className),
    style: mergedStyles
  }, rest), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", {
    className: classes.itemWrapper
  }, icon && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", {
    className: classes.itemIcon
  }, icon), /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("span", null, children)));
}
ListItem.displayName = "@mantine/core/ListItem";


//# sourceMappingURL=ListItem.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.styles.js":
/*!************************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/List/ListItem/ListItem.styles.js ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/tss/create-styles.js");


var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { spacing, center }, getRef) => {
  const itemWrapper = {
    ref: getRef("itemWrapper"),
    display: "inline"
  };
  return {
    itemWrapper,
    item: {
      lineHeight: center ? 1 : theme.lineHeight,
      "&:not(:first-of-type)": {
        marginTop: theme.fn.size({ size: spacing, sizes: theme.spacing })
      }
    },
    withIcon: {
      listStyle: "none",
      [`& .${itemWrapper.ref}`]: {
        display: "inline-flex",
        alignItems: center ? "center" : "flex-start"
      }
    },
    itemIcon: {
      display: "inline-block",
      verticalAlign: "middle",
      marginRight: theme.spacing.sm
    }
  };
});

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);
//# sourceMappingURL=ListItem.styles.js.map


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

/***/ "./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ThemeIcon": () => (/* binding */ ThemeIcon)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_styles__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/styles */ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js");
/* harmony import */ var _ThemeIcon_styles_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ThemeIcon.styles.js */ "./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.styles.js");




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
const ThemeIcon = (0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)((_a, ref) => {
  var _b = _a, {
    className,
    size = "md",
    radius = "sm",
    variant = "filled",
    color,
    children,
    gradient = { from: "blue", to: "cyan", deg: 45 },
    style,
    sx
  } = _b, others = __objRest(_b, [
    "className",
    "size",
    "radius",
    "variant",
    "color",
    "children",
    "gradient",
    "style",
    "sx"
  ]);
  const { classes, cx } = (0,_ThemeIcon_styles_js__WEBPACK_IMPORTED_MODULE_1__["default"])({
    variant,
    radius,
    color,
    size,
    gradientFrom: gradient.from,
    gradientTo: gradient.to,
    gradientDeg: gradient.deg
  }, { sx, name: "ThemeIcon" });
  const { mergedStyles, rest } = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_2__.useExtractedMargins)({ others, style });
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement("div", __spreadValues({
    className: cx(classes.root, className),
    style: mergedStyles,
    ref
  }, rest), children);
});
ThemeIcon.displayName = "@mantine/core/ThemeIcon";


//# sourceMappingURL=ThemeIcon.js.map


/***/ }),

/***/ "./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.styles.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.styles.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "sizes": () => (/* binding */ sizes)
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
const sizes = {
  xs: 16,
  sm: 20,
  md: 26,
  lg: 32,
  xl: 40
};
var useStyles = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_0__.createStyles)((theme, { color, size, radius, gradientFrom, gradientTo, gradientDeg, variant }) => {
  const colors = (0,_mantine_styles__WEBPACK_IMPORTED_MODULE_1__.getSharedColorScheme)({
    theme,
    color,
    variant,
    gradient: { from: gradientFrom, to: gradientTo, deg: gradientDeg }
  });
  const iconSize = theme.fn.size({ size, sizes });
  return {
    root: __spreadProps(__spreadValues({}, theme.fn.fontStyles()), {
      display: "inline-flex",
      alignItems: "center",
      justifyContent: "center",
      boxSizing: "border-box",
      width: iconSize,
      height: iconSize,
      minWidth: iconSize,
      minHeight: iconSize,
      borderRadius: theme.fn.size({ size: radius, sizes: theme.radius }),
      backgroundColor: colors.background,
      color: colors.color,
      backgroundImage: variant === "gradient" ? colors.background : null
    })
  };
});

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (useStyles);

//# sourceMappingURL=ThemeIcon.styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/MantineProvider.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "MantineProvider": () => (/* binding */ MantineProvider),
/* harmony export */   "useMantineEmotionOptions": () => (/* binding */ useMantineEmotionOptions),
/* harmony export */   "useMantineTheme": () => (/* binding */ useMantineTheme),
/* harmony export */   "useMantineThemeStyles": () => (/* binding */ useMantineThemeStyles)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _emotion_react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/react */ "./node_modules/@emotion/react/dist/emotion-react.browser.esm.js");
/* harmony import */ var _default_theme_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./default-theme.js */ "./node_modules/@mantine/styles/esm/theme/default-theme.js");
/* harmony import */ var _utils_merge_theme_merge_theme_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./utils/merge-theme/merge-theme.js */ "./node_modules/@mantine/styles/esm/theme/utils/merge-theme/merge-theme.js");
/* harmony import */ var _NormalizeCSS_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./NormalizeCSS.js */ "./node_modules/@mantine/styles/esm/theme/NormalizeCSS.js");






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
const MantineThemeContext = (0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)({
  theme: _default_theme_js__WEBPACK_IMPORTED_MODULE_1__.DEFAULT_THEME,
  styles: {},
  emotionOptions: { key: "mantine", prepend: true }
});
function useMantineTheme() {
  var _a;
  return ((_a = (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(MantineThemeContext)) == null ? void 0 : _a.theme) || _default_theme_js__WEBPACK_IMPORTED_MODULE_1__.DEFAULT_THEME;
}
function useMantineThemeStyles() {
  var _a;
  return ((_a = (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(MantineThemeContext)) == null ? void 0 : _a.styles) || {};
}
function useMantineEmotionOptions() {
  var _a;
  return ((_a = (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(MantineThemeContext)) == null ? void 0 : _a.emotionOptions) || { key: "mantine", prepend: true };
}
function GlobalStyles() {
  const theme = useMantineTheme();
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(_emotion_react__WEBPACK_IMPORTED_MODULE_2__.Global, {
    styles: {
      "*, *::before, *::after": {
        boxSizing: "border-box"
      },
      body: __spreadProps(__spreadValues({}, theme.fn.fontStyles()), {
        backgroundColor: theme.colorScheme === "dark" ? theme.colors.dark[7] : theme.white,
        color: theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.black,
        lineHeight: theme.lineHeight,
        fontSizes: theme.fontSizes.md
      })
    }
  });
}
function MantineProvider({
  theme,
  styles = {},
  emotionOptions,
  withNormalizeCSS = false,
  withGlobalStyles = false,
  children
}) {
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(MantineThemeContext.Provider, {
    value: { theme: (0,_utils_merge_theme_merge_theme_js__WEBPACK_IMPORTED_MODULE_3__.mergeTheme)(_default_theme_js__WEBPACK_IMPORTED_MODULE_1__.DEFAULT_THEME, theme), styles, emotionOptions }
  }, withNormalizeCSS && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(_NormalizeCSS_js__WEBPACK_IMPORTED_MODULE_4__.NormalizeCSS, null), withGlobalStyles && /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(GlobalStyles, null), children);
}
MantineProvider.displayName = "@mantine/core/MantineProvider";


//# sourceMappingURL=MantineProvider.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/NormalizeCSS.js":
/*!****************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/NormalizeCSS.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "NormalizeCSS": () => (/* binding */ NormalizeCSS)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _emotion_react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/react */ "./node_modules/@emotion/react/dist/emotion-react.browser.esm.js");



const styles = {
  html: {
    fontFamily: "sans-serif",
    lineHeight: "1.15",
    textSizeAdjust: "100%"
  },
  body: {
    margin: 0
  },
  "article, aside, footer, header, nav, section, figcaption, figure, main": {
    display: "block"
  },
  h1: {
    fontSize: "2em"
  },
  hr: {
    boxSizing: "content-box",
    height: 0,
    overflow: "visible"
  },
  pre: {
    fontFamily: "monospace, monospace",
    fontSize: "1em"
  },
  a: {
    background: "transparent",
    textDecorationSkip: "objects"
  },
  "a:active, a:hover": {
    outlineWidth: 0
  },
  "abbr[title]": {
    borderBottom: "none",
    textDecoration: "underline"
  },
  "b, strong": {
    fontWeight: "bolder"
  },
  "code, kbp, samp": {
    fontFamily: "monospace, monospace",
    fontSize: "1em"
  },
  dfn: {
    fontStyle: "italic"
  },
  mark: {
    backgroundColor: "#ff0",
    color: "#000"
  },
  small: {
    fontSize: "80%"
  },
  "sub, sup": {
    fontSize: "75%",
    lineHeight: 0,
    position: "relative",
    verticalAlign: "baseline"
  },
  sup: {
    top: "-0.5em"
  },
  sub: {
    bottom: "-0.25em"
  },
  "audio, video": {
    display: "inline-block"
  },
  "audio:not([controls])": {
    display: "none",
    height: 0
  },
  img: {
    borderStyle: "none",
    verticalAlign: "middle"
  },
  "svg:not(:root)": {
    overflow: "hidden"
  },
  "button, input, optgroup, select, textarea": {
    fontFamily: "sans-serif",
    fontSize: "100%",
    lineHeight: "1.15",
    margin: 0
  },
  "button, input": {
    overflow: "visible"
  },
  "button, select": {
    textTransform: "none"
  },
  "button, [type=reset], [type=submit]": {
    WebkitAppearance: "button"
  },
  "button::-moz-focus-inner, [type=button]::-moz-focus-inner, [type=reset]::-moz-focus-inner, [type=submit]::-moz-focus-inner": {
    borderStyle: "none",
    padding: 0
  },
  "button:-moz-focusring, [type=button]:-moz-focusring, [type=reset]:-moz-focusring, [type=submit]:-moz-focusring": {
    outline: "1px dotted ButtonText"
  },
  legend: {
    boxSizing: "border-box",
    color: "inherit",
    display: "table",
    maxWidth: "100%",
    padding: 0,
    whiteSpace: "normal"
  },
  progress: {
    display: "inline-block",
    verticalAlign: "baseline"
  },
  textarea: {
    overflow: "auto"
  },
  "[type=checkbox], [type=radio]": {
    boxSizing: "border-box",
    padding: 0
  },
  "[type=number]::-webkit-inner-spin-button, [type=number]::-webkit-outer-spin-button": {
    height: "auto"
  },
  "[type=search]": {
    appearance: "textfield",
    outlineOffset: "-2px"
  },
  "[type=search]::-webkit-search-cancel-button, [type=search]::-webkit-search-decoration": {
    appearance: "none"
  },
  "::-webkit-file-upload-button": {
    appearance: "button",
    font: "inherit"
  },
  "details, menu": {
    display: "block"
  },
  summary: {
    display: "list-item"
  },
  canvas: {
    display: "inline-block"
  },
  template: {
    display: "none"
  },
  "[hidden]": {
    display: "none"
  }
};
function NormalizeCSS() {
  return /* @__PURE__ */ react__WEBPACK_IMPORTED_MODULE_0__.createElement(_emotion_react__WEBPACK_IMPORTED_MODULE_1__.Global, {
    styles
  });
}


//# sourceMappingURL=NormalizeCSS.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/default-colors.js":
/*!******************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/default-colors.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DEFAULT_COLORS": () => (/* binding */ DEFAULT_COLORS)
/* harmony export */ });
const DEFAULT_COLORS = {
  dark: [
    "#C1C2C5",
    "#A6A7AB",
    "#909296",
    "#5c5f66",
    "#373A40",
    "#2C2E33",
    "#25262b",
    "#1A1B1E",
    "#141517",
    "#101113"
  ],
  gray: [
    "#f8f9fa",
    "#f1f3f5",
    "#e9ecef",
    "#dee2e6",
    "#ced4da",
    "#adb5bd",
    "#868e96",
    "#495057",
    "#343a40",
    "#212529"
  ],
  red: [
    "#fff5f5",
    "#ffe3e3",
    "#ffc9c9",
    "#ffa8a8",
    "#ff8787",
    "#ff6b6b",
    "#fa5252",
    "#f03e3e",
    "#e03131",
    "#c92a2a"
  ],
  pink: [
    "#fff0f6",
    "#ffdeeb",
    "#fcc2d7",
    "#faa2c1",
    "#f783ac",
    "#f06595",
    "#e64980",
    "#d6336c",
    "#c2255c",
    "#a61e4d"
  ],
  grape: [
    "#f8f0fc",
    "#f3d9fa",
    "#eebefa",
    "#e599f7",
    "#da77f2",
    "#cc5de8",
    "#be4bdb",
    "#ae3ec9",
    "#9c36b5",
    "#862e9c"
  ],
  violet: [
    "#f3f0ff",
    "#e5dbff",
    "#d0bfff",
    "#b197fc",
    "#9775fa",
    "#845ef7",
    "#7950f2",
    "#7048e8",
    "#6741d9",
    "#5f3dc4"
  ],
  indigo: [
    "#edf2ff",
    "#dbe4ff",
    "#bac8ff",
    "#91a7ff",
    "#748ffc",
    "#5c7cfa",
    "#4c6ef5",
    "#4263eb",
    "#3b5bdb",
    "#364fc7"
  ],
  blue: [
    "#e7f5ff",
    "#d0ebff",
    "#a5d8ff",
    "#74c0fc",
    "#4dabf7",
    "#339af0",
    "#228be6",
    "#1c7ed6",
    "#1971c2",
    "#1864ab"
  ],
  cyan: [
    "#e3fafc",
    "#c5f6fa",
    "#99e9f2",
    "#66d9e8",
    "#3bc9db",
    "#22b8cf",
    "#15aabf",
    "#1098ad",
    "#0c8599",
    "#0b7285"
  ],
  teal: [
    "#e6fcf5",
    "#c3fae8",
    "#96f2d7",
    "#63e6be",
    "#38d9a9",
    "#20c997",
    "#12b886",
    "#0ca678",
    "#099268",
    "#087f5b"
  ],
  green: [
    "#ebfbee",
    "#d3f9d8",
    "#b2f2bb",
    "#8ce99a",
    "#69db7c",
    "#51cf66",
    "#40c057",
    "#37b24d",
    "#2f9e44",
    "#2b8a3e"
  ],
  lime: [
    "#f4fce3",
    "#e9fac8",
    "#d8f5a2",
    "#c0eb75",
    "#a9e34b",
    "#94d82d",
    "#82c91e",
    "#74b816",
    "#66a80f",
    "#5c940d"
  ],
  yellow: [
    "#fff9db",
    "#fff3bf",
    "#ffec99",
    "#ffe066",
    "#ffd43b",
    "#fcc419",
    "#fab005",
    "#f59f00",
    "#f08c00",
    "#e67700"
  ],
  orange: [
    "#fff4e6",
    "#ffe8cc",
    "#ffd8a8",
    "#ffc078",
    "#ffa94d",
    "#ff922b",
    "#fd7e14",
    "#f76707",
    "#e8590c",
    "#d9480f"
  ]
};


//# sourceMappingURL=default-colors.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/default-theme.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/default-theme.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DEFAULT_THEME": () => (/* binding */ DEFAULT_THEME),
/* harmony export */   "MANTINE_COLORS": () => (/* binding */ MANTINE_COLORS),
/* harmony export */   "MANTINE_SIZES": () => (/* binding */ MANTINE_SIZES),
/* harmony export */   "_DEFAULT_THEME": () => (/* binding */ _DEFAULT_THEME)
/* harmony export */ });
/* harmony import */ var _default_colors_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./default-colors.js */ "./node_modules/@mantine/styles/esm/theme/default-colors.js");
/* harmony import */ var _functions_attach_functions_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./functions/attach-functions.js */ "./node_modules/@mantine/styles/esm/theme/functions/attach-functions.js");



const MANTINE_COLORS = Object.keys(_default_colors_js__WEBPACK_IMPORTED_MODULE_0__.DEFAULT_COLORS);
const MANTINE_SIZES = ["xs", "sm", "md", "lg", "xl"];
const _DEFAULT_THEME = {
  loader: "oval",
  dateFormat: "MMMM D, YYYY",
  colorScheme: "light",
  white: "#fff",
  black: "#000",
  transitionTimingFunction: "cubic-bezier(.51,.3,0,1.21)",
  colors: _default_colors_js__WEBPACK_IMPORTED_MODULE_0__.DEFAULT_COLORS,
  lineHeight: 1.55,
  fontFamily: "-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji",
  fontFamilyMonospace: "ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace",
  primaryColor: "blue",
  shadows: {
    xs: "0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.1)",
    sm: "0 1px 3px rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) 0px 10px 15px -5px, rgba(0, 0, 0, 0.04) 0px 7px 7px -5px",
    md: "0 1px 3px rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px",
    lg: "0 1px 3px rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) 0px 28px 23px -7px, rgba(0, 0, 0, 0.04) 0px 12px 12px -7px",
    xl: "0 1px 3px rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) 0px 36px 28px -7px, rgba(0, 0, 0, 0.04) 0px 17px 17px -7px"
  },
  fontSizes: {
    xs: 12,
    sm: 14,
    md: 16,
    lg: 18,
    xl: 20
  },
  radius: {
    xs: 2,
    sm: 4,
    md: 8,
    lg: 16,
    xl: 32
  },
  spacing: {
    xs: 10,
    sm: 12,
    md: 16,
    lg: 20,
    xl: 24
  },
  breakpoints: {
    xs: 576,
    sm: 768,
    md: 992,
    lg: 1200,
    xl: 1400
  },
  headings: {
    fontFamily: "-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji",
    fontWeight: 700,
    sizes: {
      h1: { fontSize: 34, lineHeight: 1.3 },
      h2: { fontSize: 26, lineHeight: 1.35 },
      h3: { fontSize: 22, lineHeight: 1.4 },
      h4: { fontSize: 18, lineHeight: 1.45 },
      h5: { fontSize: 16, lineHeight: 1.5 },
      h6: { fontSize: 14, lineHeight: 1.5 }
    }
  },
  other: {},
  datesLocale: "en"
};
const DEFAULT_THEME = (0,_functions_attach_functions_js__WEBPACK_IMPORTED_MODULE_1__.attachFunctions)(_DEFAULT_THEME);


//# sourceMappingURL=default-theme.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/attach-functions.js":
/*!******************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/attach-functions.js ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "attachFunctions": () => (/* binding */ attachFunctions)
/* harmony export */ });
/* harmony import */ var _fns_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./fns/index.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/index.js");


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
function attachFunctions(themeBase) {
  return __spreadProps(__spreadValues({}, themeBase), {
    fn: {
      fontStyles: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.fontStyles(themeBase),
      themeColor: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.themeColor(themeBase),
      focusStyles: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.focusStyles(themeBase),
      largerThan: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.largerThan(themeBase),
      smallerThan: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.smallerThan(themeBase),
      radialGradient: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.radialGradient,
      linearGradient: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.linearGradient,
      rgba: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.rgba,
      size: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.size,
      cover: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.cover,
      lighten: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.lighten,
      darken: _fns_index_js__WEBPACK_IMPORTED_MODULE_0__.fns.darken
    }
  });
}


//# sourceMappingURL=attach-functions.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/breakpoints/breakpoints.js":
/*!*****************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/breakpoints/breakpoints.js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "largerThan": () => (/* binding */ largerThan),
/* harmony export */   "smallerThan": () => (/* binding */ smallerThan)
/* harmony export */ });
/* harmony import */ var _size_size_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../size/size.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/size/size.js");


function largerThan(theme) {
  return (breakpoint) => `@media (min-width: ${(0,_size_size_js__WEBPACK_IMPORTED_MODULE_0__.size)({ size: breakpoint, sizes: theme.breakpoints }) + 1}px)`;
}
function smallerThan(theme) {
  return (breakpoint) => `@media (max-width: ${(0,_size_size_js__WEBPACK_IMPORTED_MODULE_0__.size)({ size: breakpoint, sizes: theme.breakpoints })}px)`;
}


//# sourceMappingURL=breakpoints.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/cover/cover.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/cover/cover.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "cover": () => (/* binding */ cover)
/* harmony export */ });
function cover(offset = 0) {
  return {
    position: "absolute",
    top: offset,
    right: offset,
    left: offset,
    bottom: offset
  };
}


//# sourceMappingURL=cover.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/darken/darken.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/darken/darken.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "darken": () => (/* binding */ darken)
/* harmony export */ });
/* harmony import */ var _utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/to-rgba/to-rgba.js */ "./node_modules/@mantine/styles/esm/theme/utils/to-rgba/to-rgba.js");


function darken(color, alpha) {
  const { r, g, b, a } = (0,_utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__.toRgba)(color);
  const f = 1 - alpha;
  const dark = (input) => Math.round(input * f);
  return `rgba(${dark(r)}, ${dark(g)}, ${dark(b)}, ${a})`;
}


//# sourceMappingURL=darken.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/focus-styles/focus-styles.js":
/*!*******************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/focus-styles/focus-styles.js ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "focusStyles": () => (/* binding */ focusStyles)
/* harmony export */ });
function focusStyles(theme) {
  return () => ({
    WebkitTapHighlightColor: "transparent",
    "&:focus": {
      outline: "none",
      boxShadow: `0 0 0 2px ${theme.colorScheme === "dark" ? theme.colors.dark[9] : theme.white}, 0 0 0 4px ${theme.colors[theme.primaryColor][theme.colorScheme === "dark" ? 7 : 5]}`
    },
    "&:focus:not(:focus-visible)": {
      boxShadow: "none"
    }
  });
}


//# sourceMappingURL=focus-styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/font-styles/font-styles.js":
/*!*****************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/font-styles/font-styles.js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "fontStyles": () => (/* binding */ fontStyles)
/* harmony export */ });
function fontStyles(theme) {
  return () => ({
    WebkitFontSmoothing: "antialiased",
    MozOsxFontSmoothing: "grayscale",
    fontFamily: theme.fontFamily || "sans-serif"
  });
}


//# sourceMappingURL=font-styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/index.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/index.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "fns": () => (/* binding */ fns)
/* harmony export */ });
/* harmony import */ var _font_styles_font_styles_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./font-styles/font-styles.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/font-styles/font-styles.js");
/* harmony import */ var _focus_styles_focus_styles_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./focus-styles/focus-styles.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/focus-styles/focus-styles.js");
/* harmony import */ var _theme_color_theme_color_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./theme-color/theme-color.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/theme-color/theme-color.js");
/* harmony import */ var _linear_gradient_linear_gradient_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./linear-gradient/linear-gradient.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/linear-gradient/linear-gradient.js");
/* harmony import */ var _radial_gradient_radial_gradient_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./radial-gradient/radial-gradient.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/radial-gradient/radial-gradient.js");
/* harmony import */ var _breakpoints_breakpoints_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./breakpoints/breakpoints.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/breakpoints/breakpoints.js");
/* harmony import */ var _rgba_rgba_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./rgba/rgba.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/rgba/rgba.js");
/* harmony import */ var _size_size_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./size/size.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/size/size.js");
/* harmony import */ var _cover_cover_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./cover/cover.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/cover/cover.js");
/* harmony import */ var _darken_darken_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./darken/darken.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/darken/darken.js");
/* harmony import */ var _lighten_lighten_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./lighten/lighten.js */ "./node_modules/@mantine/styles/esm/theme/functions/fns/lighten/lighten.js");












const fns = {
  fontStyles: _font_styles_font_styles_js__WEBPACK_IMPORTED_MODULE_0__.fontStyles,
  themeColor: _theme_color_theme_color_js__WEBPACK_IMPORTED_MODULE_1__.themeColor,
  focusStyles: _focus_styles_focus_styles_js__WEBPACK_IMPORTED_MODULE_2__.focusStyles,
  linearGradient: _linear_gradient_linear_gradient_js__WEBPACK_IMPORTED_MODULE_3__.linearGradient,
  radialGradient: _radial_gradient_radial_gradient_js__WEBPACK_IMPORTED_MODULE_4__.radialGradient,
  smallerThan: _breakpoints_breakpoints_js__WEBPACK_IMPORTED_MODULE_5__.smallerThan,
  largerThan: _breakpoints_breakpoints_js__WEBPACK_IMPORTED_MODULE_5__.largerThan,
  rgba: _rgba_rgba_js__WEBPACK_IMPORTED_MODULE_6__.rgba,
  size: _size_size_js__WEBPACK_IMPORTED_MODULE_7__.size,
  cover: _cover_cover_js__WEBPACK_IMPORTED_MODULE_8__.cover,
  darken: _darken_darken_js__WEBPACK_IMPORTED_MODULE_9__.darken,
  lighten: _lighten_lighten_js__WEBPACK_IMPORTED_MODULE_10__.lighten
};


//# sourceMappingURL=index.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/lighten/lighten.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/lighten/lighten.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "lighten": () => (/* binding */ lighten)
/* harmony export */ });
/* harmony import */ var _utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/to-rgba/to-rgba.js */ "./node_modules/@mantine/styles/esm/theme/utils/to-rgba/to-rgba.js");


function lighten(color, alpha) {
  const { r, g, b, a } = (0,_utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__.toRgba)(color);
  const light = (input) => Math.round(input + (255 - input) * alpha);
  return `rgba(${light(r)}, ${light(g)}, ${light(b)}, ${a})`;
}


//# sourceMappingURL=lighten.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/linear-gradient/linear-gradient.js":
/*!*************************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/linear-gradient/linear-gradient.js ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "linearGradient": () => (/* binding */ linearGradient)
/* harmony export */ });
function linearGradient(deg, ...colors) {
  let stops = "";
  for (let i = 1; i < colors.length - 1; i += 1) {
    stops += `${colors[i]} ${i / (colors.length - 1) * 100}%, `;
  }
  return `linear-gradient(${deg}deg, ${colors[0]} 0%, ${stops}${colors[colors.length - 1]} 100%)`;
}


//# sourceMappingURL=linear-gradient.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/radial-gradient/radial-gradient.js":
/*!*************************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/radial-gradient/radial-gradient.js ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "radialGradient": () => (/* binding */ radialGradient)
/* harmony export */ });
function radialGradient(...colors) {
  let stops = "";
  for (let i = 1; i < colors.length - 1; i += 1) {
    stops += `${colors[i]} ${i / (colors.length - 1) * 100}%, `;
  }
  return `radial-gradient(circle, ${colors[0]} 0%, ${stops}${colors[colors.length - 1]} 100%)`;
}


//# sourceMappingURL=radial-gradient.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/rgba/rgba.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/rgba/rgba.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "rgba": () => (/* binding */ rgba)
/* harmony export */ });
/* harmony import */ var _utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/to-rgba/to-rgba.js */ "./node_modules/@mantine/styles/esm/theme/utils/to-rgba/to-rgba.js");


function rgba(color, alpha) {
  if (typeof color !== "string" || alpha > 1 || alpha < 0) {
    return "rgba(0, 0, 0, 1)";
  }
  const { r, g, b } = (0,_utils_to_rgba_to_rgba_js__WEBPACK_IMPORTED_MODULE_0__.toRgba)(color);
  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}


//# sourceMappingURL=rgba.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/size/size.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/size/size.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "size": () => (/* binding */ size)
/* harmony export */ });
function size(props) {
  if (typeof props.size === "number") {
    return props.size;
  }
  return props.sizes[props.size] || props.size || props.sizes.md;
}


//# sourceMappingURL=size.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/functions/fns/theme-color/theme-color.js":
/*!*****************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/functions/fns/theme-color/theme-color.js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "themeColor": () => (/* binding */ themeColor)
/* harmony export */ });
function themeColor(theme) {
  return (color, shade) => {
    const primaryShades = theme.colors[theme.primaryColor];
    return color in theme.colors ? theme.colors[color][shade] : primaryShades[shade];
  };
}


//# sourceMappingURL=theme-color.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/utils/get-shared-color-scheme/get-shared-color-scheme.js":
/*!*********************************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/utils/get-shared-color-scheme/get-shared-color-scheme.js ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getSharedColorScheme": () => (/* binding */ getSharedColorScheme)
/* harmony export */ });
const DEFAULT_GRADIENT = {
  from: "indigo",
  to: "cyan",
  deg: 45
};
function getSharedColorScheme({ color, theme, variant, gradient }) {
  if (variant === "light") {
    return {
      border: "transparent",
      background: theme.fn.rgba(theme.fn.themeColor(color, theme.colorScheme === "dark" ? 8 : 0), theme.colorScheme === "dark" ? 0.35 : 1),
      color: color === "dark" ? theme.colorScheme === "dark" ? theme.colors.dark[0] : theme.colors.dark[9] : theme.fn.themeColor(color, theme.colorScheme === "dark" ? 2 : 6),
      hover: theme.fn.rgba(theme.fn.themeColor(color, theme.colorScheme === "dark" ? 7 : 1), theme.colorScheme === "dark" ? 0.45 : 0.65)
    };
  }
  if (variant === "default") {
    return {
      border: theme.colorScheme === "dark" ? theme.colors.dark[5] : theme.colors.gray[4],
      background: theme.colorScheme === "dark" ? theme.colors.dark[5] : theme.white,
      color: theme.colorScheme === "dark" ? theme.white : theme.black,
      hover: theme.colorScheme === "dark" ? theme.colors.dark[4] : theme.colors.gray[0]
    };
  }
  if (variant === "white") {
    return {
      border: "transparent",
      background: theme.white,
      color: theme.fn.themeColor(color, 7),
      hover: null
    };
  }
  if (variant === "outline") {
    return {
      border: theme.fn.rgba(theme.fn.themeColor(color, theme.colorScheme === "dark" ? 4 : 7), 0.75),
      background: "transparent",
      color: theme.fn.themeColor(color, theme.colorScheme === "dark" ? 4 : 7),
      hover: theme.colorScheme === "dark" ? theme.fn.rgba(theme.fn.themeColor(color, 4), 0.05) : theme.fn.rgba(theme.fn.themeColor(color, 0), 0.35)
    };
  }
  if (variant === "gradient") {
    const merged = {
      from: (gradient == null ? void 0 : gradient.from) || DEFAULT_GRADIENT.from,
      to: (gradient == null ? void 0 : gradient.to) || DEFAULT_GRADIENT.to,
      deg: (gradient == null ? void 0 : gradient.deg) || DEFAULT_GRADIENT.deg
    };
    return {
      background: `linear-gradient(${merged.deg}deg, ${theme.fn.themeColor(merged.from, 6)} 0%, ${theme.fn.themeColor(merged.to, 6)} 100%)`,
      color: theme.white,
      border: "transparent",
      hover: null
    };
  }
  return {
    border: "transparent",
    background: theme.fn.themeColor(color, theme.colorScheme === "dark" ? 8 : 6),
    color: theme.white,
    hover: theme.fn.themeColor(color, 7)
  };
}


//# sourceMappingURL=get-shared-color-scheme.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/utils/merge-theme/merge-theme.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/utils/merge-theme/merge-theme.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "mergeTheme": () => (/* binding */ mergeTheme)
/* harmony export */ });
/* harmony import */ var _functions_attach_functions_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../functions/attach-functions.js */ "./node_modules/@mantine/styles/esm/theme/functions/attach-functions.js");


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
function mergeTheme(currentTheme, themeOverride) {
  if (!themeOverride) {
    return (0,_functions_attach_functions_js__WEBPACK_IMPORTED_MODULE_0__.attachFunctions)(currentTheme);
  }
  return (0,_functions_attach_functions_js__WEBPACK_IMPORTED_MODULE_0__.attachFunctions)(Object.keys(currentTheme).reduce((acc, key) => {
    if (key === "headings" && themeOverride.headings) {
      const sizes = themeOverride.headings.sizes ? Object.keys(currentTheme.headings.sizes).reduce((headingsAcc, h) => {
        headingsAcc[h] = __spreadValues(__spreadValues({}, currentTheme.headings.sizes[h]), themeOverride.headings.sizes[h]);
        return headingsAcc;
      }, {}) : currentTheme.headings.sizes;
      return __spreadProps(__spreadValues({}, acc), {
        headings: __spreadProps(__spreadValues(__spreadValues({}, currentTheme.headings), themeOverride.headings), {
          sizes
        })
      });
    }
    acc[key] = typeof themeOverride[key] === "object" ? __spreadValues(__spreadValues({}, currentTheme[key]), themeOverride[key]) : themeOverride[key] || currentTheme[key];
    return acc;
  }, {}));
}


//# sourceMappingURL=merge-theme.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/utils/to-rgba/to-rgba.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/utils/to-rgba/to-rgba.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "toRgba": () => (/* binding */ toRgba)
/* harmony export */ });
function isHexColor(hex) {
  const replaced = hex.replace("#", "");
  return typeof replaced === "string" && replaced.length === 6 && !Number.isNaN(Number(`0x${replaced}`));
}
function hexToRgba(color) {
  const replaced = color.replace("#", "");
  const parsed = parseInt(replaced, 16);
  const r = parsed >> 16 & 255;
  const g = parsed >> 8 & 255;
  const b = parsed & 255;
  return {
    r,
    g,
    b,
    a: 1
  };
}
function rgbStringToRgba(color) {
  const [r, g, b, a] = color.replace(/[^0-9,.]/g, "").split(",").map(Number);
  return { r, g, b, a: a || 1 };
}
function toRgba(color) {
  if (isHexColor(color)) {
    return hexToRgba(color);
  }
  if (color.startsWith("rgb")) {
    return rgbStringToRgba(color);
  }
  return {
    r: 0,
    g: 0,
    b: 0,
    a: 1
  };
}


//# sourceMappingURL=to-rgba.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js":
/*!*****************************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/theme/utils/use-extracted-margins/use-extracted-margins.js ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useExtractedMargins": () => (/* binding */ useExtractedMargins)
/* harmony export */ });
/* harmony import */ var _MantineProvider_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../MantineProvider.js */ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js");


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
function isValidMargin(margin) {
  return typeof margin === "string" || typeof margin === "number";
}
const margins = {
  m: "margin",
  mt: "marginTop",
  mb: "marginBottom",
  ml: "marginLeft",
  mr: "marginRight"
};
function useExtractedMargins({ others, style }) {
  const theme = (0,_MantineProvider_js__WEBPACK_IMPORTED_MODULE_0__.useMantineTheme)();
  const mergedStyles = __spreadValues({}, style);
  if (isValidMargin(others.my)) {
    const margin = theme.fn.size({ size: others.my, sizes: theme.spacing });
    mergedStyles.marginTop = margin;
    mergedStyles.marginBottom = margin;
  }
  if (isValidMargin(others.mx)) {
    const margin = theme.fn.size({ size: others.mx, sizes: theme.spacing });
    mergedStyles.marginLeft = margin;
    mergedStyles.marginRight = margin;
  }
  Object.keys(margins).forEach((margin) => {
    if (isValidMargin(others[margin])) {
      mergedStyles[margins[margin]] = theme.fn.size({ size: others[margin], sizes: theme.spacing });
    }
  });
  const rest = __spreadValues({}, others);
  delete rest.m;
  delete rest.mx;
  delete rest.my;
  delete rest.mt;
  delete rest.ml;
  delete rest.mb;
  delete rest.mr;
  return { mergedStyles, rest };
}


//# sourceMappingURL=use-extracted-margins.js.map


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

/***/ "./node_modules/@mantine/styles/esm/tss/CacheProvider.js":
/*!***************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/CacheProvider.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getCache": () => (/* binding */ getCache),
/* harmony export */   "useCache": () => (/* binding */ useCache)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _emotion_cache__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/cache */ "./node_modules/@emotion/cache/dist/emotion-cache.browser.esm.js");
/* harmony import */ var _theme_MantineProvider_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../theme/MantineProvider.js */ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js");




const { getCache } = (() => {
  let cache;
  function _getCache(options) {
    if (cache === void 0) {
      cache = (0,_emotion_cache__WEBPACK_IMPORTED_MODULE_1__["default"])(options || { key: "mantine", prepend: true });
    }
    return cache;
  }
  return { getCache: _getCache };
})();
const context = (0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(void 0);
function useCache() {
  const options = (0,_theme_MantineProvider_js__WEBPACK_IMPORTED_MODULE_2__.useMantineEmotionOptions)();
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(context) || getCache(options);
}


//# sourceMappingURL=CacheProvider.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/tss/create-styles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/create-styles.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "createStyles": () => (/* binding */ createStyles)
/* harmony export */ });
/* harmony import */ var _utils_from_entries_from_entries_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils/from-entries/from-entries.js */ "./node_modules/@mantine/styles/esm/tss/utils/from-entries/from-entries.js");
/* harmony import */ var _use_css_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-css.js */ "./node_modules/@mantine/styles/esm/tss/use-css.js");
/* harmony import */ var _theme_MantineProvider_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../theme/MantineProvider.js */ "./node_modules/@mantine/styles/esm/theme/MantineProvider.js");
/* harmony import */ var _utils_merge_class_names_merge_class_names_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./utils/merge-class-names/merge-class-names.js */ "./node_modules/@mantine/styles/esm/tss/utils/merge-class-names/merge-class-names.js");





function createStyles(getCssObjectOrCssObject) {
  const getCssObject = typeof getCssObjectOrCssObject === "function" ? getCssObjectOrCssObject : () => getCssObjectOrCssObject;
  function useStyles(params, options) {
    const theme = (0,_theme_MantineProvider_js__WEBPACK_IMPORTED_MODULE_0__.useMantineTheme)();
    const themeStyles = (0,_theme_MantineProvider_js__WEBPACK_IMPORTED_MODULE_0__.useMantineThemeStyles)()[options == null ? void 0 : options.name];
    const { css, cx } = (0,_use_css_js__WEBPACK_IMPORTED_MODULE_1__.useCss)();
    let count = 0;
    function createRef(refName) {
      count += 1;
      return `mantine-ref_${refName || ""}_${count}`;
    }
    const cssObject = getCssObject(theme, params, createRef);
    const _styles = typeof (options == null ? void 0 : options.styles) === "function" ? options == null ? void 0 : options.styles(theme) : (options == null ? void 0 : options.styles) || {};
    const _themeStyles = typeof themeStyles === "function" ? themeStyles(theme) : themeStyles || {};
    const _sx = typeof (options == null ? void 0 : options.sx) === "function" ? options.sx(theme) : options == null ? void 0 : options.sx;
    const classes = (0,_utils_from_entries_from_entries_js__WEBPACK_IMPORTED_MODULE_2__.fromEntries)(Object.keys(cssObject).map((key) => {
      const _mergedStyles = cx(css(cssObject[key]), css(_themeStyles[key]), css(_styles[key]));
      const mergedStyles = key === "root" ? cx(_mergedStyles, css(_sx)) : _mergedStyles;
      return [key, mergedStyles];
    }));
    return { classes: (0,_utils_merge_class_names_merge_class_names_js__WEBPACK_IMPORTED_MODULE_3__.mergeClassNames)(cx, classes, options == null ? void 0 : options.classNames, options == null ? void 0 : options.name), cx, theme };
  }
  return useStyles;
}


//# sourceMappingURL=create-styles.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/tss/use-css.js":
/*!*********************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/use-css.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "cssFactory": () => (/* binding */ cssFactory),
/* harmony export */   "useCss": () => (/* binding */ useCss)
/* harmony export */ });
/* harmony import */ var clsx__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! clsx */ "./node_modules/clsx/dist/clsx.m.js");
/* harmony import */ var _emotion_serialize__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/serialize */ "./node_modules/@emotion/serialize/dist/emotion-serialize.browser.esm.js");
/* harmony import */ var _emotion_utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/utils */ "./node_modules/@emotion/utils/dist/emotion-utils.browser.esm.js");
/* harmony import */ var _utils_use_guaranteed_memo_use_guaranteed_memo_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./utils/use-guaranteed-memo/use-guaranteed-memo.js */ "./node_modules/@mantine/styles/esm/tss/utils/use-guaranteed-memo/use-guaranteed-memo.js");
/* harmony import */ var _CacheProvider_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./CacheProvider.js */ "./node_modules/@mantine/styles/esm/tss/CacheProvider.js");






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
const refPropertyName = "ref";
function getRef(args) {
  let ref;
  if (args.length !== 1) {
    return { args, ref };
  }
  const [arg] = args;
  if (!(arg instanceof Object)) {
    return { args, ref };
  }
  if (!(refPropertyName in arg)) {
    return { args, ref };
  }
  ref = arg[refPropertyName];
  const argCopy = __spreadValues({}, arg);
  delete argCopy[refPropertyName];
  return { args: [argCopy], ref };
}
const { cssFactory } = (() => {
  function merge(registered, css, className) {
    const registeredStyles = [];
    const rawClassName = (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.getRegisteredStyles)(registered, registeredStyles, className);
    if (registeredStyles.length < 2) {
      return className;
    }
    return rawClassName + css(registeredStyles);
  }
  function _cssFactory(params) {
    const { cache } = params;
    const css = (...styles) => {
      const { ref, args } = getRef(styles);
      const serialized = (0,_emotion_serialize__WEBPACK_IMPORTED_MODULE_1__.serializeStyles)(args, cache.registered);
      (0,_emotion_utils__WEBPACK_IMPORTED_MODULE_2__.insertStyles)(cache, serialized, false);
      return `${cache.key}-${serialized.name}${ref === void 0 ? "" : ` ${ref}`}`;
    };
    const cx = (...args) => merge(cache.registered, css, (0,clsx__WEBPACK_IMPORTED_MODULE_0__["default"])(args));
    return { css, cx };
  }
  return { cssFactory: _cssFactory };
})();
function useCss() {
  const cache = (0,_CacheProvider_js__WEBPACK_IMPORTED_MODULE_3__.useCache)();
  return (0,_utils_use_guaranteed_memo_use_guaranteed_memo_js__WEBPACK_IMPORTED_MODULE_4__.useGuaranteedMemo)(() => cssFactory({ cache }), [cache]);
}


//# sourceMappingURL=use-css.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/tss/utils/from-entries/from-entries.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/utils/from-entries/from-entries.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "fromEntries": () => (/* binding */ fromEntries)
/* harmony export */ });
function fromEntries(entries) {
  const o = {};
  Object.keys(entries).forEach((key) => {
    const [k, v] = entries[key];
    o[k] = v;
  });
  return o;
}


//# sourceMappingURL=from-entries.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/tss/utils/merge-class-names/merge-class-names.js":
/*!*******************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/utils/merge-class-names/merge-class-names.js ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "mergeClassNames": () => (/* binding */ mergeClassNames)
/* harmony export */ });
function mergeClassNames(cx, classes, classNames, name) {
  return Object.keys(classes).reduce((acc, className) => {
    acc[className] = cx(classes[className], classNames != null && classNames[className], name ? `mantine-${name}-${className}` : null);
    return acc;
  }, {});
}


//# sourceMappingURL=merge-class-names.js.map


/***/ }),

/***/ "./node_modules/@mantine/styles/esm/tss/utils/use-guaranteed-memo/use-guaranteed-memo.js":
/*!***********************************************************************************************!*\
  !*** ./node_modules/@mantine/styles/esm/tss/utils/use-guaranteed-memo/use-guaranteed-memo.js ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useGuaranteedMemo": () => (/* binding */ useGuaranteedMemo)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


function useGuaranteedMemo(fn, deps) {
  const ref = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)();
  if (!ref.current || deps.length !== ref.current.prevDeps.length || ref.current.prevDeps.map((v, i) => v === deps[i]).indexOf(false) >= 0) {
    ref.current = {
      v: fn(),
      prevDeps: [...deps]
    };
  }
  return ref.current.v;
}


//# sourceMappingURL=use-guaranteed-memo.js.map


/***/ }),

/***/ "./node_modules/@primer/octicons-react/dist/index.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@primer/octicons-react/dist/index.esm.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "AlertIcon": () => (/* binding */ AlertIcon),
/* harmony export */   "AlertFillIcon": () => (/* binding */ AlertFillIcon),
/* harmony export */   "ArchiveIcon": () => (/* binding */ ArchiveIcon),
/* harmony export */   "ArrowBothIcon": () => (/* binding */ ArrowBothIcon),
/* harmony export */   "ArrowDownIcon": () => (/* binding */ ArrowDownIcon),
/* harmony export */   "ArrowDownLeftIcon": () => (/* binding */ ArrowDownLeftIcon),
/* harmony export */   "ArrowDownRightIcon": () => (/* binding */ ArrowDownRightIcon),
/* harmony export */   "ArrowLeftIcon": () => (/* binding */ ArrowLeftIcon),
/* harmony export */   "ArrowRightIcon": () => (/* binding */ ArrowRightIcon),
/* harmony export */   "ArrowSwitchIcon": () => (/* binding */ ArrowSwitchIcon),
/* harmony export */   "ArrowUpIcon": () => (/* binding */ ArrowUpIcon),
/* harmony export */   "ArrowUpLeftIcon": () => (/* binding */ ArrowUpLeftIcon),
/* harmony export */   "ArrowUpRightIcon": () => (/* binding */ ArrowUpRightIcon),
/* harmony export */   "BeakerIcon": () => (/* binding */ BeakerIcon),
/* harmony export */   "BellIcon": () => (/* binding */ BellIcon),
/* harmony export */   "BellFillIcon": () => (/* binding */ BellFillIcon),
/* harmony export */   "BellSlashIcon": () => (/* binding */ BellSlashIcon),
/* harmony export */   "BlockedIcon": () => (/* binding */ BlockedIcon),
/* harmony export */   "BoldIcon": () => (/* binding */ BoldIcon),
/* harmony export */   "BookIcon": () => (/* binding */ BookIcon),
/* harmony export */   "BookmarkIcon": () => (/* binding */ BookmarkIcon),
/* harmony export */   "BookmarkFillIcon": () => (/* binding */ BookmarkFillIcon),
/* harmony export */   "BookmarkSlashIcon": () => (/* binding */ BookmarkSlashIcon),
/* harmony export */   "BookmarkSlashFillIcon": () => (/* binding */ BookmarkSlashFillIcon),
/* harmony export */   "BriefcaseIcon": () => (/* binding */ BriefcaseIcon),
/* harmony export */   "BroadcastIcon": () => (/* binding */ BroadcastIcon),
/* harmony export */   "BrowserIcon": () => (/* binding */ BrowserIcon),
/* harmony export */   "BugIcon": () => (/* binding */ BugIcon),
/* harmony export */   "CalendarIcon": () => (/* binding */ CalendarIcon),
/* harmony export */   "CheckIcon": () => (/* binding */ CheckIcon),
/* harmony export */   "CheckCircleIcon": () => (/* binding */ CheckCircleIcon),
/* harmony export */   "CheckCircleFillIcon": () => (/* binding */ CheckCircleFillIcon),
/* harmony export */   "ChecklistIcon": () => (/* binding */ ChecklistIcon),
/* harmony export */   "ChevronDownIcon": () => (/* binding */ ChevronDownIcon),
/* harmony export */   "ChevronLeftIcon": () => (/* binding */ ChevronLeftIcon),
/* harmony export */   "ChevronRightIcon": () => (/* binding */ ChevronRightIcon),
/* harmony export */   "ChevronUpIcon": () => (/* binding */ ChevronUpIcon),
/* harmony export */   "CircleIcon": () => (/* binding */ CircleIcon),
/* harmony export */   "CircleSlashIcon": () => (/* binding */ CircleSlashIcon),
/* harmony export */   "ClockIcon": () => (/* binding */ ClockIcon),
/* harmony export */   "CodeIcon": () => (/* binding */ CodeIcon),
/* harmony export */   "CodeReviewIcon": () => (/* binding */ CodeReviewIcon),
/* harmony export */   "CodeSquareIcon": () => (/* binding */ CodeSquareIcon),
/* harmony export */   "CodescanIcon": () => (/* binding */ CodescanIcon),
/* harmony export */   "CodescanCheckmarkIcon": () => (/* binding */ CodescanCheckmarkIcon),
/* harmony export */   "CodespacesIcon": () => (/* binding */ CodespacesIcon),
/* harmony export */   "ColumnsIcon": () => (/* binding */ ColumnsIcon),
/* harmony export */   "CommentIcon": () => (/* binding */ CommentIcon),
/* harmony export */   "CommentDiscussionIcon": () => (/* binding */ CommentDiscussionIcon),
/* harmony export */   "CommitIcon": () => (/* binding */ CommitIcon),
/* harmony export */   "ContainerIcon": () => (/* binding */ ContainerIcon),
/* harmony export */   "CopyIcon": () => (/* binding */ CopyIcon),
/* harmony export */   "CpuIcon": () => (/* binding */ CpuIcon),
/* harmony export */   "CreditCardIcon": () => (/* binding */ CreditCardIcon),
/* harmony export */   "CrossReferenceIcon": () => (/* binding */ CrossReferenceIcon),
/* harmony export */   "DashIcon": () => (/* binding */ DashIcon),
/* harmony export */   "DatabaseIcon": () => (/* binding */ DatabaseIcon),
/* harmony export */   "DependabotIcon": () => (/* binding */ DependabotIcon),
/* harmony export */   "DesktopDownloadIcon": () => (/* binding */ DesktopDownloadIcon),
/* harmony export */   "DeviceCameraIcon": () => (/* binding */ DeviceCameraIcon),
/* harmony export */   "DeviceCameraVideoIcon": () => (/* binding */ DeviceCameraVideoIcon),
/* harmony export */   "DeviceDesktopIcon": () => (/* binding */ DeviceDesktopIcon),
/* harmony export */   "DeviceMobileIcon": () => (/* binding */ DeviceMobileIcon),
/* harmony export */   "DiamondIcon": () => (/* binding */ DiamondIcon),
/* harmony export */   "DiffIcon": () => (/* binding */ DiffIcon),
/* harmony export */   "DiffAddedIcon": () => (/* binding */ DiffAddedIcon),
/* harmony export */   "DiffIgnoredIcon": () => (/* binding */ DiffIgnoredIcon),
/* harmony export */   "DiffModifiedIcon": () => (/* binding */ DiffModifiedIcon),
/* harmony export */   "DiffRemovedIcon": () => (/* binding */ DiffRemovedIcon),
/* harmony export */   "DiffRenamedIcon": () => (/* binding */ DiffRenamedIcon),
/* harmony export */   "DotIcon": () => (/* binding */ DotIcon),
/* harmony export */   "DotFillIcon": () => (/* binding */ DotFillIcon),
/* harmony export */   "DownloadIcon": () => (/* binding */ DownloadIcon),
/* harmony export */   "DuplicateIcon": () => (/* binding */ DuplicateIcon),
/* harmony export */   "EllipsisIcon": () => (/* binding */ EllipsisIcon),
/* harmony export */   "EyeIcon": () => (/* binding */ EyeIcon),
/* harmony export */   "EyeClosedIcon": () => (/* binding */ EyeClosedIcon),
/* harmony export */   "FileIcon": () => (/* binding */ FileIcon),
/* harmony export */   "FileBadgeIcon": () => (/* binding */ FileBadgeIcon),
/* harmony export */   "FileBinaryIcon": () => (/* binding */ FileBinaryIcon),
/* harmony export */   "FileCodeIcon": () => (/* binding */ FileCodeIcon),
/* harmony export */   "FileDiffIcon": () => (/* binding */ FileDiffIcon),
/* harmony export */   "FileDirectoryIcon": () => (/* binding */ FileDirectoryIcon),
/* harmony export */   "FileDirectoryFillIcon": () => (/* binding */ FileDirectoryFillIcon),
/* harmony export */   "FileMediaIcon": () => (/* binding */ FileMediaIcon),
/* harmony export */   "FileSubmoduleIcon": () => (/* binding */ FileSubmoduleIcon),
/* harmony export */   "FileSymlinkFileIcon": () => (/* binding */ FileSymlinkFileIcon),
/* harmony export */   "FileZipIcon": () => (/* binding */ FileZipIcon),
/* harmony export */   "FilterIcon": () => (/* binding */ FilterIcon),
/* harmony export */   "FlameIcon": () => (/* binding */ FlameIcon),
/* harmony export */   "FoldIcon": () => (/* binding */ FoldIcon),
/* harmony export */   "FoldDownIcon": () => (/* binding */ FoldDownIcon),
/* harmony export */   "FoldUpIcon": () => (/* binding */ FoldUpIcon),
/* harmony export */   "GearIcon": () => (/* binding */ GearIcon),
/* harmony export */   "GiftIcon": () => (/* binding */ GiftIcon),
/* harmony export */   "GitBranchIcon": () => (/* binding */ GitBranchIcon),
/* harmony export */   "GitCommitIcon": () => (/* binding */ GitCommitIcon),
/* harmony export */   "GitCompareIcon": () => (/* binding */ GitCompareIcon),
/* harmony export */   "GitMergeIcon": () => (/* binding */ GitMergeIcon),
/* harmony export */   "GitPullRequestIcon": () => (/* binding */ GitPullRequestIcon),
/* harmony export */   "GitPullRequestClosedIcon": () => (/* binding */ GitPullRequestClosedIcon),
/* harmony export */   "GitPullRequestDraftIcon": () => (/* binding */ GitPullRequestDraftIcon),
/* harmony export */   "GlobeIcon": () => (/* binding */ GlobeIcon),
/* harmony export */   "GrabberIcon": () => (/* binding */ GrabberIcon),
/* harmony export */   "GraphIcon": () => (/* binding */ GraphIcon),
/* harmony export */   "HashIcon": () => (/* binding */ HashIcon),
/* harmony export */   "HeadingIcon": () => (/* binding */ HeadingIcon),
/* harmony export */   "HeartIcon": () => (/* binding */ HeartIcon),
/* harmony export */   "HeartFillIcon": () => (/* binding */ HeartFillIcon),
/* harmony export */   "HistoryIcon": () => (/* binding */ HistoryIcon),
/* harmony export */   "HomeIcon": () => (/* binding */ HomeIcon),
/* harmony export */   "HomeFillIcon": () => (/* binding */ HomeFillIcon),
/* harmony export */   "HorizontalRuleIcon": () => (/* binding */ HorizontalRuleIcon),
/* harmony export */   "HourglassIcon": () => (/* binding */ HourglassIcon),
/* harmony export */   "HubotIcon": () => (/* binding */ HubotIcon),
/* harmony export */   "ImageIcon": () => (/* binding */ ImageIcon),
/* harmony export */   "InboxIcon": () => (/* binding */ InboxIcon),
/* harmony export */   "InfinityIcon": () => (/* binding */ InfinityIcon),
/* harmony export */   "InfoIcon": () => (/* binding */ InfoIcon),
/* harmony export */   "IssueClosedIcon": () => (/* binding */ IssueClosedIcon),
/* harmony export */   "IssueDraftIcon": () => (/* binding */ IssueDraftIcon),
/* harmony export */   "IssueOpenedIcon": () => (/* binding */ IssueOpenedIcon),
/* harmony export */   "IssueReopenedIcon": () => (/* binding */ IssueReopenedIcon),
/* harmony export */   "ItalicIcon": () => (/* binding */ ItalicIcon),
/* harmony export */   "IterationsIcon": () => (/* binding */ IterationsIcon),
/* harmony export */   "KebabHorizontalIcon": () => (/* binding */ KebabHorizontalIcon),
/* harmony export */   "KeyIcon": () => (/* binding */ KeyIcon),
/* harmony export */   "KeyAsteriskIcon": () => (/* binding */ KeyAsteriskIcon),
/* harmony export */   "LawIcon": () => (/* binding */ LawIcon),
/* harmony export */   "LightBulbIcon": () => (/* binding */ LightBulbIcon),
/* harmony export */   "LinkIcon": () => (/* binding */ LinkIcon),
/* harmony export */   "LinkExternalIcon": () => (/* binding */ LinkExternalIcon),
/* harmony export */   "ListOrderedIcon": () => (/* binding */ ListOrderedIcon),
/* harmony export */   "ListUnorderedIcon": () => (/* binding */ ListUnorderedIcon),
/* harmony export */   "LocationIcon": () => (/* binding */ LocationIcon),
/* harmony export */   "LockIcon": () => (/* binding */ LockIcon),
/* harmony export */   "LogoGistIcon": () => (/* binding */ LogoGistIcon),
/* harmony export */   "LogoGithubIcon": () => (/* binding */ LogoGithubIcon),
/* harmony export */   "MailIcon": () => (/* binding */ MailIcon),
/* harmony export */   "MarkGithubIcon": () => (/* binding */ MarkGithubIcon),
/* harmony export */   "MarkdownIcon": () => (/* binding */ MarkdownIcon),
/* harmony export */   "MegaphoneIcon": () => (/* binding */ MegaphoneIcon),
/* harmony export */   "MentionIcon": () => (/* binding */ MentionIcon),
/* harmony export */   "MeterIcon": () => (/* binding */ MeterIcon),
/* harmony export */   "MilestoneIcon": () => (/* binding */ MilestoneIcon),
/* harmony export */   "MirrorIcon": () => (/* binding */ MirrorIcon),
/* harmony export */   "MoonIcon": () => (/* binding */ MoonIcon),
/* harmony export */   "MortarBoardIcon": () => (/* binding */ MortarBoardIcon),
/* harmony export */   "MultiSelectIcon": () => (/* binding */ MultiSelectIcon),
/* harmony export */   "MuteIcon": () => (/* binding */ MuteIcon),
/* harmony export */   "NoEntryIcon": () => (/* binding */ NoEntryIcon),
/* harmony export */   "NoEntryFillIcon": () => (/* binding */ NoEntryFillIcon),
/* harmony export */   "NorthStarIcon": () => (/* binding */ NorthStarIcon),
/* harmony export */   "NoteIcon": () => (/* binding */ NoteIcon),
/* harmony export */   "NumberIcon": () => (/* binding */ NumberIcon),
/* harmony export */   "OrganizationIcon": () => (/* binding */ OrganizationIcon),
/* harmony export */   "PackageIcon": () => (/* binding */ PackageIcon),
/* harmony export */   "PackageDependenciesIcon": () => (/* binding */ PackageDependenciesIcon),
/* harmony export */   "PackageDependentsIcon": () => (/* binding */ PackageDependentsIcon),
/* harmony export */   "PaintbrushIcon": () => (/* binding */ PaintbrushIcon),
/* harmony export */   "PaperAirplaneIcon": () => (/* binding */ PaperAirplaneIcon),
/* harmony export */   "PasteIcon": () => (/* binding */ PasteIcon),
/* harmony export */   "PencilIcon": () => (/* binding */ PencilIcon),
/* harmony export */   "PeopleIcon": () => (/* binding */ PeopleIcon),
/* harmony export */   "PersonIcon": () => (/* binding */ PersonIcon),
/* harmony export */   "PersonAddIcon": () => (/* binding */ PersonAddIcon),
/* harmony export */   "PersonFillIcon": () => (/* binding */ PersonFillIcon),
/* harmony export */   "PinIcon": () => (/* binding */ PinIcon),
/* harmony export */   "PlayIcon": () => (/* binding */ PlayIcon),
/* harmony export */   "PlugIcon": () => (/* binding */ PlugIcon),
/* harmony export */   "PlusIcon": () => (/* binding */ PlusIcon),
/* harmony export */   "PlusCircleIcon": () => (/* binding */ PlusCircleIcon),
/* harmony export */   "ProjectIcon": () => (/* binding */ ProjectIcon),
/* harmony export */   "PulseIcon": () => (/* binding */ PulseIcon),
/* harmony export */   "QuestionIcon": () => (/* binding */ QuestionIcon),
/* harmony export */   "QuoteIcon": () => (/* binding */ QuoteIcon),
/* harmony export */   "ReplyIcon": () => (/* binding */ ReplyIcon),
/* harmony export */   "RepoIcon": () => (/* binding */ RepoIcon),
/* harmony export */   "RepoCloneIcon": () => (/* binding */ RepoCloneIcon),
/* harmony export */   "RepoForkedIcon": () => (/* binding */ RepoForkedIcon),
/* harmony export */   "RepoPullIcon": () => (/* binding */ RepoPullIcon),
/* harmony export */   "RepoPushIcon": () => (/* binding */ RepoPushIcon),
/* harmony export */   "RepoTemplateIcon": () => (/* binding */ RepoTemplateIcon),
/* harmony export */   "ReportIcon": () => (/* binding */ ReportIcon),
/* harmony export */   "RocketIcon": () => (/* binding */ RocketIcon),
/* harmony export */   "RowsIcon": () => (/* binding */ RowsIcon),
/* harmony export */   "RssIcon": () => (/* binding */ RssIcon),
/* harmony export */   "RubyIcon": () => (/* binding */ RubyIcon),
/* harmony export */   "ScreenFullIcon": () => (/* binding */ ScreenFullIcon),
/* harmony export */   "ScreenNormalIcon": () => (/* binding */ ScreenNormalIcon),
/* harmony export */   "SearchIcon": () => (/* binding */ SearchIcon),
/* harmony export */   "ServerIcon": () => (/* binding */ ServerIcon),
/* harmony export */   "ShareIcon": () => (/* binding */ ShareIcon),
/* harmony export */   "ShareAndroidIcon": () => (/* binding */ ShareAndroidIcon),
/* harmony export */   "ShieldIcon": () => (/* binding */ ShieldIcon),
/* harmony export */   "ShieldCheckIcon": () => (/* binding */ ShieldCheckIcon),
/* harmony export */   "ShieldLockIcon": () => (/* binding */ ShieldLockIcon),
/* harmony export */   "ShieldXIcon": () => (/* binding */ ShieldXIcon),
/* harmony export */   "SidebarCollapseIcon": () => (/* binding */ SidebarCollapseIcon),
/* harmony export */   "SidebarExpandIcon": () => (/* binding */ SidebarExpandIcon),
/* harmony export */   "SignInIcon": () => (/* binding */ SignInIcon),
/* harmony export */   "SignOutIcon": () => (/* binding */ SignOutIcon),
/* harmony export */   "SingleSelectIcon": () => (/* binding */ SingleSelectIcon),
/* harmony export */   "SkipIcon": () => (/* binding */ SkipIcon),
/* harmony export */   "SmileyIcon": () => (/* binding */ SmileyIcon),
/* harmony export */   "SortAscIcon": () => (/* binding */ SortAscIcon),
/* harmony export */   "SortDescIcon": () => (/* binding */ SortDescIcon),
/* harmony export */   "SquareIcon": () => (/* binding */ SquareIcon),
/* harmony export */   "SquareFillIcon": () => (/* binding */ SquareFillIcon),
/* harmony export */   "SquirrelIcon": () => (/* binding */ SquirrelIcon),
/* harmony export */   "StackIcon": () => (/* binding */ StackIcon),
/* harmony export */   "StarIcon": () => (/* binding */ StarIcon),
/* harmony export */   "StarFillIcon": () => (/* binding */ StarFillIcon),
/* harmony export */   "StopIcon": () => (/* binding */ StopIcon),
/* harmony export */   "StopwatchIcon": () => (/* binding */ StopwatchIcon),
/* harmony export */   "StrikethroughIcon": () => (/* binding */ StrikethroughIcon),
/* harmony export */   "SunIcon": () => (/* binding */ SunIcon),
/* harmony export */   "SyncIcon": () => (/* binding */ SyncIcon),
/* harmony export */   "TabIcon": () => (/* binding */ TabIcon),
/* harmony export */   "TableIcon": () => (/* binding */ TableIcon),
/* harmony export */   "TagIcon": () => (/* binding */ TagIcon),
/* harmony export */   "TasklistIcon": () => (/* binding */ TasklistIcon),
/* harmony export */   "TelescopeIcon": () => (/* binding */ TelescopeIcon),
/* harmony export */   "TelescopeFillIcon": () => (/* binding */ TelescopeFillIcon),
/* harmony export */   "TerminalIcon": () => (/* binding */ TerminalIcon),
/* harmony export */   "ThreeBarsIcon": () => (/* binding */ ThreeBarsIcon),
/* harmony export */   "ThumbsdownIcon": () => (/* binding */ ThumbsdownIcon),
/* harmony export */   "ThumbsupIcon": () => (/* binding */ ThumbsupIcon),
/* harmony export */   "ToolsIcon": () => (/* binding */ ToolsIcon),
/* harmony export */   "TrashIcon": () => (/* binding */ TrashIcon),
/* harmony export */   "TriangleDownIcon": () => (/* binding */ TriangleDownIcon),
/* harmony export */   "TriangleLeftIcon": () => (/* binding */ TriangleLeftIcon),
/* harmony export */   "TriangleRightIcon": () => (/* binding */ TriangleRightIcon),
/* harmony export */   "TriangleUpIcon": () => (/* binding */ TriangleUpIcon),
/* harmony export */   "TypographyIcon": () => (/* binding */ TypographyIcon),
/* harmony export */   "UnfoldIcon": () => (/* binding */ UnfoldIcon),
/* harmony export */   "UnlockIcon": () => (/* binding */ UnlockIcon),
/* harmony export */   "UnmuteIcon": () => (/* binding */ UnmuteIcon),
/* harmony export */   "UnverifiedIcon": () => (/* binding */ UnverifiedIcon),
/* harmony export */   "UploadIcon": () => (/* binding */ UploadIcon),
/* harmony export */   "VerifiedIcon": () => (/* binding */ VerifiedIcon),
/* harmony export */   "VersionsIcon": () => (/* binding */ VersionsIcon),
/* harmony export */   "VideoIcon": () => (/* binding */ VideoIcon),
/* harmony export */   "WorkflowIcon": () => (/* binding */ WorkflowIcon),
/* harmony export */   "XIcon": () => (/* binding */ XIcon),
/* harmony export */   "XCircleIcon": () => (/* binding */ XCircleIcon),
/* harmony export */   "XCircleFillIcon": () => (/* binding */ XCircleFillIcon),
/* harmony export */   "ZapIcon": () => (/* binding */ ZapIcon)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");


var sizeMap = {
  small: 16,
  medium: 32,
  large: 64
};

function getSvgProps(_ref) {
  var ariaLabel = _ref['aria-label'],
      className = _ref.className,
      _ref$fill = _ref.fill,
      fill = _ref$fill === undefined ? 'currentColor' : _ref$fill,
      size = _ref.size,
      verticalAlign = _ref.verticalAlign,
      svgDataByHeight = _ref.svgDataByHeight;

  var height = sizeMap[size] || size;
  var naturalHeight = closestNaturalHeight(Object.keys(svgDataByHeight), height);
  var naturalWidth = svgDataByHeight[naturalHeight].width;
  var width = height * (naturalWidth / naturalHeight);
  var path = svgDataByHeight[naturalHeight].path;

  return {
    'aria-hidden': ariaLabel ? 'false' : 'true',
    'aria-label': ariaLabel,
    role: 'img',
    className: className,
    viewBox: '0 0 ' + naturalWidth + ' ' + naturalHeight,
    width: width,
    height: height,
    fill: fill,
    style: {
      display: 'inline-block',
      userSelect: 'none',
      verticalAlign: verticalAlign,
      overflow: 'visible'
    },
    dangerouslySetInnerHTML: { __html: path }
  };
}

function closestNaturalHeight(naturalHeights, height) {
  return naturalHeights.map(function (naturalHeight) {
    return parseInt(naturalHeight, 10);
  }).reduce(function (acc, naturalHeight) {
    return naturalHeight <= height ? naturalHeight : acc;
  }, naturalHeights[0]);
}

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

function AlertIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M13 17.5a1 1 0 11-2 0 1 1 0 012 0zm-.25-8.25a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0v-4.5z\"></path><path fill-rule=\"evenodd\" d=\"M9.836 3.244c.963-1.665 3.365-1.665 4.328 0l8.967 15.504c.963 1.667-.24 3.752-2.165 3.752H3.034c-1.926 0-3.128-2.085-2.165-3.752L9.836 3.244zm3.03.751a1 1 0 00-1.732 0L2.168 19.499A1 1 0 003.034 21h17.932a1 1 0 00.866-1.5L12.866 3.994z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

AlertIcon.defaultProps = {
  className: 'octicon octicon-alert',
  size: 16,
  verticalAlign: 'text-bottom'
};

function AlertFillIcon(props) {
  var svgDataByHeight = { "12": { "width": 12, "path": "<path fill-rule=\"evenodd\" d=\"M4.855.708c.5-.896 1.79-.896 2.29 0l4.675 8.351a1.312 1.312 0 01-1.146 1.954H1.33A1.312 1.312 0 01.183 9.058L4.855.708zM7 7V3H5v4h2zm-1 3a1 1 0 100-2 1 1 0 000 2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

AlertFillIcon.defaultProps = {
  className: 'octicon octicon-alert-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArchiveIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2.5a.25.25 0 00-.25.25v1.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-1.5a.25.25 0 00-.25-.25H1.75zM0 2.75C0 1.784.784 1 1.75 1h12.5c.966 0 1.75.784 1.75 1.75v1.5A1.75 1.75 0 0114.25 6H1.75A1.75 1.75 0 010 4.25v-1.5zM1.75 7a.75.75 0 01.75.75v5.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25v-5.5a.75.75 0 111.5 0v5.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25v-5.5A.75.75 0 011.75 7zm4.5 1a.75.75 0 000 1.5h3.5a.75.75 0 100-1.5h-3.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2A1.75 1.75 0 001 3.75v3.5C1 8.216 1.784 9 2.75 9h18.5A1.75 1.75 0 0023 7.25v-3.5A1.75 1.75 0 0021.25 2H2.75zm18.5 1.5H2.75a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25z\"></path><path d=\"M2.75 10a.75.75 0 01.75.75v9.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25v-9.5a.75.75 0 011.5 0v9.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25v-9.5a.75.75 0 01.75-.75z\"></path><path d=\"M9.75 11.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArchiveIcon.defaultProps = {
  className: 'octicon octicon-archive',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowBothIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.72 3.72a.75.75 0 011.06 1.06L2.56 7h10.88l-2.22-2.22a.75.75 0 011.06-1.06l3.5 3.5a.75.75 0 010 1.06l-3.5 3.5a.75.75 0 11-1.06-1.06l2.22-2.22H2.56l2.22 2.22a.75.75 0 11-1.06 1.06l-3.5-3.5a.75.75 0 010-1.06l3.5-3.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.78 5.97a.75.75 0 00-1.06 0l-5.25 5.25a.75.75 0 000 1.06l5.25 5.25a.75.75 0 001.06-1.06L3.81 12.5h16.38l-3.97 3.97a.75.75 0 101.06 1.06l5.25-5.25a.75.75 0 000-1.06l-5.25-5.25a.75.75 0 10-1.06 1.06L20.19 11H3.81l3.97-3.97a.75.75 0 000-1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowBothIcon.defaultProps = {
  className: 'octicon octicon-arrow-both',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowDownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13.03 8.22a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06 0L3.47 9.28a.75.75 0 011.06-1.06l2.97 2.97V3.75a.75.75 0 011.5 0v7.44l2.97-2.97a.75.75 0 011.06 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.97 13.22a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 10-1.06-1.06l-4.97 4.97V3.75a.75.75 0 00-1.5 0v14.44l-4.97-4.97a.75.75 0 00-1.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowDownIcon.defaultProps = {
  className: 'octicon octicon-arrow-down',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowDownLeftIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 8.5a.75.75 0 00-.75.75v9c0 .414.336.75.75.75h9a.75.75 0 000-1.5H7.56L17.78 7.28a.75.75 0 00-1.06-1.06L6.5 16.44V9.25a.75.75 0 00-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowDownLeftIcon.defaultProps = {
  className: 'octicon octicon-arrow-down-left',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowDownRightIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M18.25 8.5a.75.75 0 01.75.75v9a.75.75 0 01-.75.75h-9a.75.75 0 010-1.5h7.19L6.22 7.28a.75.75 0 011.06-1.06L17.5 16.44V9.25a.75.75 0 01.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowDownRightIcon.defaultProps = {
  className: 'octicon octicon-arrow-down-right',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowLeftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.78 12.53a.75.75 0 01-1.06 0L2.47 8.28a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 1.06L4.81 7h7.44a.75.75 0 010 1.5H4.81l2.97 2.97a.75.75 0 010 1.06z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10.78 19.03a.75.75 0 01-1.06 0l-6.25-6.25a.75.75 0 010-1.06l6.25-6.25a.75.75 0 111.06 1.06L5.81 11.5h14.44a.75.75 0 010 1.5H5.81l4.97 4.97a.75.75 0 010 1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowLeftIcon.defaultProps = {
  className: 'octicon octicon-arrow-left',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowRightIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.22 2.97a.75.75 0 011.06 0l4.25 4.25a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06-1.06l2.97-2.97H3.75a.75.75 0 010-1.5h7.44L8.22 4.03a.75.75 0 010-1.06z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M13.22 19.03a.75.75 0 001.06 0l6.25-6.25a.75.75 0 000-1.06l-6.25-6.25a.75.75 0 10-1.06 1.06l4.97 4.97H3.75a.75.75 0 000 1.5h14.44l-4.97 4.97a.75.75 0 000 1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowRightIcon.defaultProps = {
  className: 'octicon octicon-arrow-right',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowSwitchIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M5.22 14.78a.75.75 0 001.06-1.06L4.56 12h8.69a.75.75 0 000-1.5H4.56l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3a.75.75 0 000 1.06l3 3zm5.56-6.5a.75.75 0 11-1.06-1.06l1.72-1.72H2.75a.75.75 0 010-1.5h8.69L9.72 2.28a.75.75 0 011.06-1.06l3 3a.75.75 0 010 1.06l-3 3z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.72 21.78a.75.75 0 001.06-1.06L5.56 17.5h14.69a.75.75 0 000-1.5H5.56l3.22-3.22a.75.75 0 10-1.06-1.06l-4.5 4.5a.75.75 0 000 1.06l4.5 4.5zm8.56-9.5a.75.75 0 11-1.06-1.06L18.44 8H3.75a.75.75 0 010-1.5h14.69l-3.22-3.22a.75.75 0 011.06-1.06l4.5 4.5a.75.75 0 010 1.06l-4.5 4.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowSwitchIcon.defaultProps = {
  className: 'octicon octicon-arrow-switch',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowUpIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.47 7.78a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0l4.25 4.25a.75.75 0 01-1.06 1.06L9 4.81v7.44a.75.75 0 01-1.5 0V4.81L4.53 7.78a.75.75 0 01-1.06 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M18.655 10.405a.75.75 0 000-1.06l-6.25-6.25a.75.75 0 00-1.06 0l-6.25 6.25a.75.75 0 101.06 1.06l4.97-4.97v14.44a.75.75 0 001.5 0V5.435l4.97 4.97a.75.75 0 001.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowUpIcon.defaultProps = {
  className: 'octicon octicon-arrow-up',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowUpLeftIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 15.5a.75.75 0 01-.75-.75v-9A.75.75 0 015.75 5h9a.75.75 0 010 1.5H7.56l10.22 10.22a.75.75 0 11-1.06 1.06L6.5 7.56v7.19a.75.75 0 01-.75.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowUpLeftIcon.defaultProps = {
  className: 'octicon octicon-arrow-up-left',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ArrowUpRightIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M18.25 15.5a.75.75 0 00.75-.75v-9a.75.75 0 00-.75-.75h-9a.75.75 0 000 1.5h7.19L6.22 16.72a.75.75 0 101.06 1.06L17.5 7.56v7.19c0 .414.336.75.75.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ArrowUpRightIcon.defaultProps = {
  className: 'octicon octicon-arrow-up-right',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BeakerIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5 5.782V2.5h-.25a.75.75 0 010-1.5h6.5a.75.75 0 010 1.5H11v3.282l3.666 5.76C15.619 13.04 14.543 15 12.767 15H3.233c-1.776 0-2.852-1.96-1.899-3.458L5 5.782zM9.5 2.5h-3V6a.75.75 0 01-.117.403L4.73 9h6.54L9.617 6.403A.75.75 0 019.5 6V2.5zm-6.9 9.847L3.775 10.5h8.45l1.175 1.847a.75.75 0 01-.633 1.153H3.233a.75.75 0 01-.633-1.153z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8 8.807V3.5h-.563a.75.75 0 010-1.5h9.125a.75.75 0 010 1.5H16v5.307l5.125 9.301c.964 1.75-.302 3.892-2.299 3.892H5.174c-1.998 0-3.263-2.142-2.3-3.892L8 8.807zM14.5 3.5h-5V9a.75.75 0 01-.093.362L7.127 13.5h9.746l-2.28-4.138A.75.75 0 0114.5 9V3.5zM4.189 18.832L6.3 15h11.4l2.111 3.832a1.125 1.125 0 01-.985 1.668H5.174a1.125 1.125 0 01-.985-1.668z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BeakerIcon.defaultProps = {
  className: 'octicon octicon-beaker',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BellIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8 16a2 2 0 001.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 008 16z\"></path><path fill-rule=\"evenodd\" d=\"M8 1.5A3.5 3.5 0 004.5 5v2.947c0 .346-.102.683-.294.97l-1.703 2.556a.018.018 0 00-.003.01l.001.006c0 .002.002.004.004.006a.017.017 0 00.006.004l.007.001h10.964l.007-.001a.016.016 0 00.006-.004.016.016 0 00.004-.006l.001-.007a.017.017 0 00-.003-.01l-1.703-2.554a1.75 1.75 0 01-.294-.97V5A3.5 3.5 0 008 1.5zM3 5a5 5 0 0110 0v2.947c0 .05.015.098.042.139l1.703 2.555A1.518 1.518 0 0113.482 13H2.518a1.518 1.518 0 01-1.263-2.36l1.703-2.554A.25.25 0 003 7.947V5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 1C8.318 1 5 3.565 5 7v4.539a3.25 3.25 0 01-.546 1.803l-2.2 3.299A1.518 1.518 0 003.519 19H8.5a3.5 3.5 0 107 0h4.982a1.518 1.518 0 001.263-2.36l-2.2-3.298A3.25 3.25 0 0119 11.539V7c0-3.435-3.319-6-7-6zM6.5 7c0-2.364 2.383-4.5 5.5-4.5s5.5 2.136 5.5 4.5v4.539c0 .938.278 1.854.798 2.635l2.199 3.299a.017.017 0 01.003.01l-.001.006-.004.006-.006.004-.007.001H3.518l-.007-.001-.006-.004-.004-.006-.001-.007.003-.01 2.2-3.298a4.75 4.75 0 00.797-2.635V7zM14 19h-4a2 2 0 104 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BellIcon.defaultProps = {
  className: 'octicon octicon-bell',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BellFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8 16c.9 0 1.7-.6 1.9-1.5.1-.3-.1-.5-.4-.5h-3c-.3 0-.5.2-.4.5.2.9 1 1.5 1.9 1.5zM3 5c0-2.8 2.2-5 5-5s5 2.2 5 5v3l1.7 2.6c.2.2.3.5.3.8 0 .8-.7 1.5-1.5 1.5h-11c-.8.1-1.5-.6-1.5-1.4 0-.3.1-.6.3-.8L3 8.1V5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6 8a6 6 0 1112 0v2.917c0 .703.228 1.387.65 1.95L20.7 15.6a1.5 1.5 0 01-1.2 2.4h-15a1.5 1.5 0 01-1.2-2.4l2.05-2.733a3.25 3.25 0 00.65-1.95V8zm6 13.5A3.502 3.502 0 018.645 19h6.71A3.502 3.502 0 0112 21.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BellFillIcon.defaultProps = {
  className: 'octicon octicon-bell-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BellSlashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5c-.997 0-1.895.416-2.534 1.086A.75.75 0 014.38 1.55 5 5 0 0113 5v2.373a.75.75 0 01-1.5 0V5A3.5 3.5 0 008 1.5zM4.182 4.31L1.19 2.143a.75.75 0 10-.88 1.214L3 5.305v2.642a.25.25 0 01-.042.139L1.255 10.64A1.518 1.518 0 002.518 13h11.108l1.184.857a.75.75 0 10.88-1.214l-1.375-.996a1.196 1.196 0 00-.013-.01L4.198 4.321a.733.733 0 00-.016-.011zm7.373 7.19L4.5 6.391v1.556c0 .346-.102.683-.294.97l-1.703 2.556a.018.018 0 00-.003.01.015.015 0 00.005.012.017.017 0 00.006.004l.007.001h9.037zM8 16a2 2 0 001.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 008 16z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.22 1.22a.75.75 0 011.06 0l20.5 20.5a.75.75 0 11-1.06 1.06L17.94 19H15.5a3.5 3.5 0 11-7 0H3.518a1.518 1.518 0 01-1.263-2.36l2.2-3.298A3.25 3.25 0 005 11.539V7c0-.294.025-.583.073-.866L1.22 2.28a.75.75 0 010-1.06zM10 19a2 2 0 104 0h-4zM6.5 7.56l9.94 9.94H3.517l-.007-.001-.006-.004-.004-.006-.001-.007.003-.01 2.2-3.298a4.75 4.75 0 00.797-2.635V7.56z\"></path><path d=\"M12 2.5c-1.463 0-2.8.485-3.788 1.257l-.04.032a.75.75 0 11-.935-1.173l.05-.04C8.548 1.59 10.212 1 12 1c3.681 0 7 2.565 7 6v4.539c0 .642.19 1.269.546 1.803l1.328 1.992a.75.75 0 11-1.248.832l-1.328-1.992a4.75 4.75 0 01-.798-2.635V7c0-2.364-2.383-4.5-5.5-4.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BellSlashIcon.defaultProps = {
  className: 'octicon octicon-bell-slash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BlockedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.467.22a.75.75 0 01.53-.22h6.006a.75.75 0 01.53.22l4.247 4.247c.141.14.22.331.22.53v6.006a.75.75 0 01-.22.53l-4.247 4.247a.75.75 0 01-.53.22H4.997a.75.75 0 01-.53-.22L.22 11.533a.75.75 0 01-.22-.53V4.997a.75.75 0 01.22-.53L4.467.22zm.84 1.28L1.5 5.308v5.384L5.308 14.5h5.384l3.808-3.808V5.308L10.692 1.5H5.308zM4 7.75A.75.75 0 014.75 7h6.5a.75.75 0 010 1.5h-6.5A.75.75 0 014 7.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.638 2.22a.75.75 0 01.53-.22h7.664a.75.75 0 01.53.22l5.418 5.418c.141.14.22.332.22.53v7.664a.75.75 0 01-.22.53l-5.418 5.418a.75.75 0 01-.53.22H8.168a.75.75 0 01-.53-.22l-5.42-5.418a.75.75 0 01-.219-.53V8.168a.75.75 0 01.22-.53l5.418-5.42zM8.48 3.5L3.5 8.48v7.04l4.98 4.98h7.04l4.98-4.98V8.48L15.52 3.5H8.48zM7 11.75a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BlockedIcon.defaultProps = {
  className: 'octicon octicon-blocked',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BoldIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4 2a1 1 0 00-1 1v10a1 1 0 001 1h5.5a3.5 3.5 0 001.852-6.47A3.5 3.5 0 008.5 2H4zm4.5 5a1.5 1.5 0 100-3H5v3h3.5zM5 9v3h4.5a1.5 1.5 0 000-3H5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6 4.75c0-.69.56-1.25 1.25-1.25h5a4.75 4.75 0 013.888 7.479A5 5 0 0114 20.5H7.25c-.69 0-1.25-.56-1.25-1.25V4.75zM8.5 13v5H14a2.5 2.5 0 000-5H8.5zm0-2.5h3.751A2.25 2.25 0 0012.25 6H8.5v4.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BoldIcon.defaultProps = {
  className: 'octicon octicon-bold',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BookIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 1.75A.75.75 0 01.75 1h4.253c1.227 0 2.317.59 3 1.501A3.744 3.744 0 0111.006 1h4.245a.75.75 0 01.75.75v10.5a.75.75 0 01-.75.75h-4.507a2.25 2.25 0 00-1.591.659l-.622.621a.75.75 0 01-1.06 0l-.622-.621A2.25 2.25 0 005.258 13H.75a.75.75 0 01-.75-.75V1.75zm8.755 3a2.25 2.25 0 012.25-2.25H14.5v9h-3.757c-.71 0-1.4.201-1.992.572l.004-7.322zm-1.504 7.324l.004-5.073-.002-2.253A2.25 2.25 0 005.003 2.5H1.5v9h3.757a3.75 3.75 0 011.994.574z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BookIcon.defaultProps = {
  className: 'octicon octicon-book',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BookmarkIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 2.5a.25.25 0 00-.25.25v9.91l3.023-2.489a.75.75 0 01.954 0l3.023 2.49V2.75a.25.25 0 00-.25-.25h-6.5zM3 2.75C3 1.784 3.784 1 4.75 1h6.5c.966 0 1.75.784 1.75 1.75v11.5a.75.75 0 01-1.227.579L8 11.722l-3.773 3.107A.75.75 0 013 14.25V2.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5 3.75C5 2.784 5.784 2 6.75 2h10.5c.966 0 1.75.784 1.75 1.75v17.5a.75.75 0 01-1.218.586L12 17.21l-5.781 4.625A.75.75 0 015 21.25V3.75zm1.75-.25a.25.25 0 00-.25.25v15.94l5.031-4.026a.75.75 0 01.938 0L17.5 19.69V3.75a.25.25 0 00-.25-.25H6.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BookmarkIcon.defaultProps = {
  className: 'octicon octicon-bookmark',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BookmarkFillIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6.69 2a1.75 1.75 0 00-1.75 1.756L5 21.253a.75.75 0 001.219.583L12 17.21l5.782 4.625A.75.75 0 0019 21.25V3.75A1.75 1.75 0 0017.25 2H6.69z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BookmarkFillIcon.defaultProps = {
  className: 'octicon octicon-bookmark-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BookmarkSlashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.19 1.143a.75.75 0 10-.88 1.214L3 4.305v9.945a.75.75 0 001.206.596L8 11.944l3.794 2.902A.75.75 0 0013 14.25v-2.703l1.81 1.31a.75.75 0 10.88-1.214l-2.994-2.168a1.09 1.09 0 00-.014-.01L4.196 3.32a.712.712 0 00-.014-.01L1.19 1.143zM4.5 5.39v7.341l3.044-2.328a.75.75 0 01.912 0l3.044 2.328V10.46l-7-5.07zM5.865 1a.75.75 0 000 1.5h5.385a.25.25 0 01.25.25v3.624a.75.75 0 001.5 0V2.75A1.75 1.75 0 0011.25 1H5.865z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.565 2.018a.75.75 0 00-.88 1.214L5 6.357v14.902a.75.75 0 001.219.585L12 17.21l5.781 4.633A.75.75 0 0019 21.259v-4.764l3.435 2.487a.75.75 0 10.88-1.215L1.565 2.017zM17.5 15.408l-11-7.965v12.254l5.031-4.032a.75.75 0 01.938 0l5.031 4.032v-4.288z\"></path><path d=\"M7.25 2a.75.75 0 000 1.5h10a.25.25 0 01.25.25v6.5a.75.75 0 001.5 0v-6.5A1.75 1.75 0 0017.25 2h-10z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BookmarkSlashIcon.defaultProps = {
  className: 'octicon octicon-bookmark-slash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BookmarkSlashFillIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.232 2.175a.75.75 0 10-.964 1.15l2.679 2.244L5 21.253a.75.75 0 001.219.583L12 17.21l5.782 4.625A.75.75 0 0019 21.25v-3.907l1.768 1.482a.75.75 0 10.964-1.15l-18.5-15.5zM7.422 2a.75.75 0 00-.482 1.325l10.828 9.073A.75.75 0 0019 11.823V3.75A1.75 1.75 0 0017.25 2H7.421h.001z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BookmarkSlashFillIcon.defaultProps = {
  className: 'octicon octicon-bookmark-slash-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BriefcaseIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.75 0A1.75 1.75 0 005 1.75V3H1.75A1.75 1.75 0 000 4.75v8.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25v-8.5A1.75 1.75 0 0014.25 3H11V1.75A1.75 1.75 0 009.25 0h-2.5zM9.5 3V1.75a.25.25 0 00-.25-.25h-2.5a.25.25 0 00-.25.25V3h3zM5 4.5H1.75a.25.25 0 00-.25.25V6a2 2 0 002 2h9a2 2 0 002-2V4.75a.25.25 0 00-.25-.25H5zm-1.5 5a3.484 3.484 0 01-2-.627v4.377c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V8.873a3.484 3.484 0 01-2 .627h-9z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.5 1.75C7.5.784 8.284 0 9.25 0h5.5c.966 0 1.75.784 1.75 1.75V4h4.75c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0121.25 22H2.75A1.75 1.75 0 011 20.25V5.75C1 4.784 1.784 4 2.75 4H7.5V1.75zm-5 10.24v8.26c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-8.26A4.233 4.233 0 0118.75 13H5.25a4.233 4.233 0 01-2.75-1.01zm19-3.24a2.75 2.75 0 01-2.75 2.75H5.25A2.75 2.75 0 012.5 8.75v-3a.25.25 0 01.25-.25h18.5a.25.25 0 01.25.25v3zm-6.5-7V4H9V1.75a.25.25 0 01.25-.25h5.5a.25.25 0 01.25.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BriefcaseIcon.defaultProps = {
  className: 'octicon octicon-briefcase',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BroadcastIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.267 1.457c.3.286.312.76.026 1.06A6.475 6.475 0 001.5 7a6.472 6.472 0 001.793 4.483.75.75 0 01-1.086 1.034 8.89 8.89 0 01-.276-.304l.569-.49-.569.49A7.971 7.971 0 010 7c0-2.139.84-4.083 2.207-5.517a.75.75 0 011.06-.026zm9.466 0a.75.75 0 011.06.026A7.975 7.975 0 0116 7c0 2.139-.84 4.083-2.207 5.517a.75.75 0 11-1.086-1.034A6.475 6.475 0 0014.5 7a6.475 6.475 0 00-1.793-4.483.75.75 0 01.026-1.06zM8.75 8.582a1.75 1.75 0 10-1.5 0v5.668a.75.75 0 001.5 0V8.582zM5.331 4.736a.75.75 0 10-1.143-.972A4.983 4.983 0 003 7c0 1.227.443 2.352 1.177 3.222a.75.75 0 001.146-.967A3.483 3.483 0 014.5 7c0-.864.312-1.654.831-2.264zm6.492-.958a.75.75 0 00-1.146.967c.514.61.823 1.395.823 2.255 0 .86-.31 1.646-.823 2.255a.75.75 0 101.146.967A4.983 4.983 0 0013 7a4.983 4.983 0 00-1.177-3.222z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M20.485 2.515a.75.75 0 00-1.06 1.06A10.465 10.465 0 0122.5 11c0 2.9-1.174 5.523-3.075 7.424a.75.75 0 001.06 1.061A11.965 11.965 0 0024 11c0-3.314-1.344-6.315-3.515-8.485zm-15.91 1.06a.75.75 0 00-1.06-1.06A11.965 11.965 0 000 11c0 3.313 1.344 6.314 3.515 8.485a.75.75 0 001.06-1.06A10.465 10.465 0 011.5 11c0-2.9 1.174-5.524 3.075-7.425zM8.11 7.11a.75.75 0 00-1.06-1.06A6.98 6.98 0 005 11a6.98 6.98 0 002.05 4.95.75.75 0 001.06-1.061 5.48 5.48 0 01-1.61-3.89 5.48 5.48 0 011.61-3.888zm8.84-1.06a.75.75 0 10-1.06 1.06A5.48 5.48 0 0117.5 11a5.48 5.48 0 01-1.61 3.889.75.75 0 101.06 1.06A6.98 6.98 0 0019 11a6.98 6.98 0 00-2.05-4.949zM14 11a2 2 0 01-1.25 1.855v8.395a.75.75 0 01-1.5 0v-8.395A2 2 0 1114 11z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BroadcastIcon.defaultProps = {
  className: 'octicon octicon-broadcast',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BrowserIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 2.75C0 1.784.784 1 1.75 1h12.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0114.25 15H1.75A1.75 1.75 0 010 13.25V2.75zm1.75-.25a.25.25 0 00-.25.25V4.5h2v-2H1.75zM5 2.5v2h2v-2H5zm3.5 0v2h6V2.75a.25.25 0 00-.25-.25H8.5zm6 3.5h-13v7.25c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V6z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M0 3.75C0 2.784.784 2 1.75 2h20.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0122.25 22H1.75A1.75 1.75 0 010 20.25V3.75zm1.75-.25a.25.25 0 00-.25.25V5.5h4v-2H1.75zM7 3.5v2h4v-2H7zm5.5 0v2h10V3.75a.25.25 0 00-.25-.25H12.5zm10 3.5h-21v13.25c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V7z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BrowserIcon.defaultProps = {
  className: 'octicon octicon-browser',
  size: 16,
  verticalAlign: 'text-bottom'
};

function BugIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.72.22a.75.75 0 011.06 0l1 .999a3.492 3.492 0 012.441 0l.999-1a.75.75 0 111.06 1.061l-.775.776c.616.63.995 1.493.995 2.444v.327c0 .1-.009.197-.025.292.408.14.764.392 1.029.722l1.968-.787a.75.75 0 01.556 1.392L13 7.258V9h2.25a.75.75 0 010 1.5H13v.5c0 .409-.049.806-.141 1.186l2.17.868a.75.75 0 01-.557 1.392l-2.184-.873A4.997 4.997 0 018 16a4.997 4.997 0 01-4.288-2.427l-2.183.873a.75.75 0 01-.558-1.392l2.17-.868A5.013 5.013 0 013 11v-.5H.75a.75.75 0 010-1.5H3V7.258L.971 6.446a.75.75 0 01.558-1.392l1.967.787c.265-.33.62-.583 1.03-.722a1.684 1.684 0 01-.026-.292V4.5c0-.951.38-1.814.995-2.444L4.72 1.28a.75.75 0 010-1.06zM6.173 5h3.654A.173.173 0 0010 4.827V4.5a2 2 0 10-4 0v.327c0 .096.077.173.173.173zM5.25 6.5a.75.75 0 00-.75.75V11a3.5 3.5 0 107 0V7.25a.75.75 0 00-.75-.75h-5.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.72.22a.75.75 0 011.06 0l1.204 1.203A4.983 4.983 0 0112 1c.717 0 1.4.151 2.016.423L15.22.22a.75.75 0 011.06 1.06l-.971.972A4.988 4.988 0 0117 6v1.104a2.755 2.755 0 011.917 1.974l1.998-.999a.75.75 0 01.67 1.342L19 10.714V13.5l3.25.003a.75.75 0 110 1.5L19 15.001V16a7.02 7.02 0 01-.204 1.686.833.833 0 01.04.018l2.75 1.375a.75.75 0 11-.671 1.342l-2.638-1.319A7 7 0 0112 23a7 7 0 01-6.197-3.742l-2.758 1.181a.75.75 0 11-.59-1.378l2.795-1.199A7.007 7.007 0 015 16v-.996H1.75a.75.75 0 010-1.5H5v-2.79L2.415 9.42a.75.75 0 01.67-1.342l1.998.999A2.755 2.755 0 017 7.104V6a4.99 4.99 0 011.69-3.748l-.97-.972a.75.75 0 010-1.06zM8.5 7h7V6a3.5 3.5 0 10-7 0v1zm-2 3.266V9.75c0-.69.56-1.25 1.25-1.25h8.5c.69 0 1.25.56 1.25 1.25V16a5.5 5.5 0 01-11 0v-5.734z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

BugIcon.defaultProps = {
  className: 'octicon octicon-bug',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CalendarIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 0a.75.75 0 01.75.75V2h5V.75a.75.75 0 011.5 0V2h1.25c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 16H2.75A1.75 1.75 0 011 14.25V3.75C1 2.784 1.784 2 2.75 2H4V.75A.75.75 0 014.75 0zm0 3.5h8.5a.25.25 0 01.25.25V6h-11V3.75a.25.25 0 01.25-.25h2zm-2.25 4v6.75c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V7.5h-11z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6.75 0a.75.75 0 01.75.75V3h9V.75a.75.75 0 011.5 0V3h2.75c.966 0 1.75.784 1.75 1.75v16a1.75 1.75 0 01-1.75 1.75H3.25a1.75 1.75 0 01-1.75-1.75v-16C1.5 3.784 2.284 3 3.25 3H6V.75A.75.75 0 016.75 0zm-3.5 4.5a.25.25 0 00-.25.25V8h18V4.75a.25.25 0 00-.25-.25H3.25zM21 9.5H3v11.25c0 .138.112.25.25.25h17.5a.25.25 0 00.25-.25V9.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CalendarIcon.defaultProps = {
  className: 'octicon octicon-calendar',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CheckIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M21.03 5.72a.75.75 0 010 1.06l-11.5 11.5a.75.75 0 01-1.072-.012l-5.5-5.75a.75.75 0 111.084-1.036l4.97 5.195L19.97 5.72a.75.75 0 011.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CheckIcon.defaultProps = {
  className: 'octicon octicon-check',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CheckCircleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM0 8a8 8 0 1116 0A8 8 0 010 8zm11.78-1.72a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.28 9.28a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CheckCircleIcon.defaultProps = {
  className: 'octicon octicon-check-circle',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CheckCircleFillIcon(props) {
  var svgDataByHeight = { "12": { "width": 12, "path": "<path fill-rule=\"evenodd\" d=\"M6 0a6 6 0 100 12A6 6 0 006 0zm-.705 8.737L9.63 4.403 8.392 3.166 5.295 6.263l-1.7-1.702L2.356 5.8l2.938 2.938z\"></path>" }, "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 16A8 8 0 108 0a8 8 0 000 16zm3.78-9.72a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm16.28-2.72a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CheckCircleFillIcon.defaultProps = {
  className: 'octicon octicon-check-circle-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ChecklistIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 1.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v7.736a.75.75 0 101.5 0V1.75A1.75 1.75 0 0011.25 0h-8.5A1.75 1.75 0 001 1.75v11.5c0 .966.784 1.75 1.75 1.75h3.17a.75.75 0 000-1.5H2.75a.25.25 0 01-.25-.25V1.75zM4.75 4a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zM4 7.75A.75.75 0 014.75 7h2a.75.75 0 010 1.5h-2A.75.75 0 014 7.75zm11.774 3.537a.75.75 0 00-1.048-1.074L10.7 14.145 9.281 12.72a.75.75 0 00-1.062 1.058l1.943 1.95a.75.75 0 001.055.008l4.557-4.45z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z\"></path><path d=\"M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ChecklistIcon.defaultProps = {
  className: 'octicon octicon-checklist',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ChevronDownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M12.78 6.22a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06 0L3.22 7.28a.75.75 0 011.06-1.06L8 9.94l3.72-3.72a.75.75 0 011.06 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ChevronDownIcon.defaultProps = {
  className: 'octicon octicon-chevron-down',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ChevronLeftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M9.78 12.78a.75.75 0 01-1.06 0L4.47 8.53a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 1.06L6.06 8l3.72 3.72a.75.75 0 010 1.06z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M15.28 5.22a.75.75 0 00-1.06 0l-6.25 6.25a.75.75 0 000 1.06l6.25 6.25a.75.75 0 101.06-1.06L9.56 12l5.72-5.72a.75.75 0 000-1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ChevronLeftIcon.defaultProps = {
  className: 'octicon octicon-chevron-left',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ChevronRightIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.22 3.22a.75.75 0 011.06 0l4.25 4.25a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06-1.06L9.94 8 6.22 4.28a.75.75 0 010-1.06z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.72 18.78a.75.75 0 001.06 0l6.25-6.25a.75.75 0 000-1.06L9.78 5.22a.75.75 0 00-1.06 1.06L14.44 12l-5.72 5.72a.75.75 0 000 1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ChevronRightIcon.defaultProps = {
  className: 'octicon octicon-chevron-right',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ChevronUpIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.22 9.78a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0l4.25 4.25a.75.75 0 01-1.06 1.06L8 6.06 4.28 9.78a.75.75 0 01-1.06 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M18.78 15.28a.75.75 0 000-1.06l-6.25-6.25a.75.75 0 00-1.06 0l-6.25 6.25a.75.75 0 101.06 1.06L12 9.56l5.72 5.72a.75.75 0 001.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ChevronUpIcon.defaultProps = {
  className: 'octicon octicon-chevron-up',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CircleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 2.5a9.5 9.5 0 100 19 9.5 9.5 0 000-19zM1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CircleIcon.defaultProps = {
  className: 'octicon octicon-circle',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CircleSlashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 0110.535-5.096l-9.131 9.131A6.472 6.472 0 011.5 8zm2.465 5.096a6.5 6.5 0 009.131-9.131l-9.131 9.131zM8 0a8 8 0 100 16A8 8 0 008 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12A9.5 9.5 0 0112 2.5c2.353 0 4.507.856 6.166 2.273L4.773 18.166A9.462 9.462 0 012.5 12zm3.334 7.227A9.462 9.462 0 0012 21.5a9.5 9.5 0 009.5-9.5 9.462 9.462 0 00-2.273-6.166L5.834 19.227z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CircleSlashIcon.defaultProps = {
  className: 'octicon octicon-circle-slash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ClockIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.5 4.75a.75.75 0 00-1.5 0v3.5a.75.75 0 00.471.696l2.5 1a.75.75 0 00.557-1.392L8.5 7.742V4.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12.5 7.25a.75.75 0 00-1.5 0v5.5c0 .27.144.518.378.651l3.5 2a.75.75 0 00.744-1.302L12.5 12.315V7.25z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ClockIcon.defaultProps = {
  className: 'octicon octicon-clock',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.72 3.22a.75.75 0 011.06 1.06L2.06 8l3.72 3.72a.75.75 0 11-1.06 1.06L.47 8.53a.75.75 0 010-1.06l4.25-4.25zm6.56 0a.75.75 0 10-1.06 1.06L13.94 8l-3.72 3.72a.75.75 0 101.06 1.06l4.25-4.25a.75.75 0 000-1.06l-4.25-4.25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.78 4.97a.75.75 0 010 1.06L2.81 12l5.97 5.97a.75.75 0 11-1.06 1.06l-6.5-6.5a.75.75 0 010-1.06l6.5-6.5a.75.75 0 011.06 0zm6.44 0a.75.75 0 000 1.06L21.19 12l-5.97 5.97a.75.75 0 101.06 1.06l6.5-6.5a.75.75 0 000-1.06l-6.5-6.5a.75.75 0 00-1.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodeIcon.defaultProps = {
  className: 'octicon octicon-code',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodeReviewIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 2.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v8.5a.25.25 0 01-.25.25h-6.5a.75.75 0 00-.53.22L4.5 14.44v-2.19a.75.75 0 00-.75-.75h-2a.25.25 0 01-.25-.25v-8.5zM1.75 1A1.75 1.75 0 000 2.75v8.5C0 12.216.784 13 1.75 13H3v1.543a1.457 1.457 0 002.487 1.03L8.061 13h6.189A1.75 1.75 0 0016 11.25v-8.5A1.75 1.75 0 0014.25 1H1.75zm5.03 3.47a.75.75 0 010 1.06L5.31 7l1.47 1.47a.75.75 0 01-1.06 1.06l-2-2a.75.75 0 010-1.06l2-2a.75.75 0 011.06 0zm2.44 0a.75.75 0 000 1.06L10.69 7 9.22 8.47a.75.75 0 001.06 1.06l2-2a.75.75 0 000-1.06l-2-2a.75.75 0 00-1.06 0z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.3 6.74a.75.75 0 01-.04 1.06l-2.908 2.7 2.908 2.7a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 011.06.04zm3.44 1.06a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.908-2.7-2.908-2.7z\"></path><path fill-rule=\"evenodd\" d=\"M1.5 4.25c0-.966.784-1.75 1.75-1.75h17.5c.966 0 1.75.784 1.75 1.75v12.5a1.75 1.75 0 01-1.75 1.75h-9.69l-3.573 3.573A1.457 1.457 0 015 21.043V18.5H3.25a1.75 1.75 0 01-1.75-1.75V4.25zM3.25 4a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h2.5a.75.75 0 01.75.75v3.19l3.72-3.72a.75.75 0 01.53-.22h10a.25.25 0 00.25-.25V4.25a.25.25 0 00-.25-.25H3.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodeReviewIcon.defaultProps = {
  className: 'octicon octicon-code-review',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodeSquareIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 1.5a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V1.75a.25.25 0 00-.25-.25H1.75zM0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v12.5A1.75 1.75 0 0114.25 16H1.75A1.75 1.75 0 010 14.25V1.75zm9.22 3.72a.75.75 0 000 1.06L10.69 8 9.22 9.47a.75.75 0 101.06 1.06l2-2a.75.75 0 000-1.06l-2-2a.75.75 0 00-1.06 0zM6.78 6.53a.75.75 0 00-1.06-1.06l-2 2a.75.75 0 000 1.06l2 2a.75.75 0 101.06-1.06L5.31 8l1.47-1.47z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.3 8.24a.75.75 0 01-.04 1.06L7.352 12l2.908 2.7a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 011.06.04zm3.44 1.06a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.908-2.7-2.908-2.7z\"></path><path fill-rule=\"evenodd\" d=\"M2 3.75C2 2.784 2.784 2 3.75 2h16.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25V3.75zm1.75-.25a.25.25 0 00-.25.25v16.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25H3.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodeSquareIcon.defaultProps = {
  className: 'octicon octicon-code-square',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodescanIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8.47 4.97a.75.75 0 000 1.06L9.94 7.5 8.47 8.97a.75.75 0 101.06 1.06l2-2a.75.75 0 000-1.06l-2-2a.75.75 0 00-1.06 0zM6.53 6.03a.75.75 0 00-1.06-1.06l-2 2a.75.75 0 000 1.06l2 2a.75.75 0 101.06-1.06L5.06 7.5l1.47-1.47z\"></path><path fill-rule=\"evenodd\" d=\"M12.246 13.307a7.5 7.5 0 111.06-1.06l2.474 2.473a.75.75 0 11-1.06 1.06l-2.474-2.473zM1.5 7.5a6 6 0 1110.386 4.094.75.75 0 00-.292.293A6 6 0 011.5 7.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M11.97 6.97a.75.75 0 000 1.06l2.47 2.47-2.47 2.47a.75.75 0 101.06 1.06l3-3a.75.75 0 000-1.06l-3-3a.75.75 0 00-1.06 0zM9.03 8.03a.75.75 0 00-1.06-1.06l-3 3a.75.75 0 000 1.06l3 3a.75.75 0 001.06-1.06L6.56 10.5l2.47-2.47z\"></path><path fill-rule=\"evenodd\" d=\"M10.5 0C4.701 0 0 4.701 0 10.5S4.701 21 10.5 21c2.63 0 5.033-.967 6.875-2.564l4.345 4.344a.75.75 0 101.06-1.06l-4.344-4.345A10.459 10.459 0 0021 10.5C21 4.701 16.299 0 10.5 0zm-9 10.5a9 9 0 1118 0 9 9 0 01-18 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodescanIcon.defaultProps = {
  className: 'octicon octicon-codescan',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodescanCheckmarkIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M10.28 6.28a.75.75 0 10-1.06-1.06L6.25 8.19l-.97-.97a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.06 0l3.5-3.5z\"></path><path fill-rule=\"evenodd\" d=\"M7.5 15a7.469 7.469 0 004.746-1.693l2.474 2.473a.75.75 0 101.06-1.06l-2.473-2.474A7.5 7.5 0 107.5 15zm0-13.5a6 6 0 104.094 10.386.75.75 0 01.293-.292A6 6 0 007.5 1.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M15.03 8.28a.75.75 0 00-1.06-1.06l-5.22 5.22-2.22-2.22a.75.75 0 10-1.06 1.06l2.75 2.75a.75.75 0 001.06 0l5.75-5.75z\"></path><path fill-rule=\"evenodd\" d=\"M0 10.5C0 4.701 4.701 0 10.5 0S21 4.701 21 10.5c0 2.63-.967 5.033-2.564 6.875l4.344 4.345a.75.75 0 11-1.06 1.06l-4.345-4.344A10.459 10.459 0 0110.5 21C4.701 21 0 16.299 0 10.5zm10.5-9a9 9 0 100 18 9 9 0 000-18z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodescanCheckmarkIcon.defaultProps = {
  className: 'octicon octicon-codescan-checkmark',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CodespacesIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 1.75C2 .784 2.784 0 3.75 0h8.5C13.216 0 14 .784 14 1.75v5a1.75 1.75 0 01-1.75 1.75h-8.5A1.75 1.75 0 012 6.75v-5zm1.75-.25a.25.25 0 00-.25.25v5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25v-5a.25.25 0 00-.25-.25h-8.5zM0 11.25c0-.966.784-1.75 1.75-1.75h12.5c.966 0 1.75.784 1.75 1.75v3A1.75 1.75 0 0114.25 16H1.75A1.75 1.75 0 010 14.25v-3zM1.75 11a.25.25 0 00-.25.25v3c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-3a.25.25 0 00-.25-.25H1.75z\"></path><path fill-rule=\"evenodd\" d=\"M3 12.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zm4 0a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.5 3.75C3.5 2.784 4.284 2 5.25 2h13.5c.966 0 1.75.784 1.75 1.75v7.5A1.75 1.75 0 0118.75 13H5.25a1.75 1.75 0 01-1.75-1.75v-7.5zm1.75-.25a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h13.5a.25.25 0 00.25-.25v-7.5a.25.25 0 00-.25-.25H5.25zM1.5 15.75c0-.966.784-1.75 1.75-1.75h17.5c.966 0 1.75.784 1.75 1.75v4a1.75 1.75 0 01-1.75 1.75H3.25a1.75 1.75 0 01-1.75-1.75v-4zm1.75-.25a.25.25 0 00-.25.25v4c0 .138.112.25.25.25h17.5a.25.25 0 00.25-.25v-4a.25.25 0 00-.25-.25H3.25z\"></path><path fill-rule=\"evenodd\" d=\"M10 17.75a.75.75 0 01.75-.75h6.5a.75.75 0 010 1.5h-6.5a.75.75 0 01-.75-.75zm-4 0a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CodespacesIcon.defaultProps = {
  className: 'octicon octicon-codespaces',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ColumnsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 0A1.75 1.75 0 001 1.75v12.5c0 .966.784 1.75 1.75 1.75h2.5A1.75 1.75 0 007 14.25V1.75A1.75 1.75 0 005.25 0h-2.5zM2.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25h-2.5a.25.25 0 01-.25-.25V1.75zM10.75 0A1.75 1.75 0 009 1.75v12.5c0 .966.784 1.75 1.75 1.75h2.5A1.75 1.75 0 0015 14.25V1.75A1.75 1.75 0 0013.25 0h-2.5zm-.25 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25h-2.5a.25.25 0 01-.25-.25V1.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h5.5A1.75 1.75 0 0011 20.25V3.75A1.75 1.75 0 009.25 2h-5.5zM3.5 3.75a.25.25 0 01.25-.25h5.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25h-5.5a.25.25 0 01-.25-.25V3.75zM14.75 2A1.75 1.75 0 0013 3.75v16.5c0 .966.784 1.75 1.75 1.75h5.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2h-5.5zm-.25 1.75a.25.25 0 01.25-.25h5.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25h-5.5a.25.25 0 01-.25-.25V3.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ColumnsIcon.defaultProps = {
  className: 'octicon octicon-columns',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CommentIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h2a.75.75 0 01.75.75v2.19l2.72-2.72a.75.75 0 01.53-.22h4.5a.25.25 0 00.25-.25v-7.5a.25.25 0 00-.25-.25H2.75zM1 2.75C1 1.784 1.784 1 2.75 1h10.5c.966 0 1.75.784 1.75 1.75v7.5A1.75 1.75 0 0113.25 12H9.06l-2.573 2.573A1.457 1.457 0 014 13.543V12H2.75A1.75 1.75 0 011 10.25v-7.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.25 4a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h2.5a.75.75 0 01.75.75v3.19l3.72-3.72a.75.75 0 01.53-.22h10a.25.25 0 00.25-.25V4.25a.25.25 0 00-.25-.25H3.25zm-1.75.25c0-.966.784-1.75 1.75-1.75h17.5c.966 0 1.75.784 1.75 1.75v12.5a1.75 1.75 0 01-1.75 1.75h-9.69l-3.573 3.573A1.457 1.457 0 015 21.043V18.5H3.25a1.75 1.75 0 01-1.75-1.75V4.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CommentIcon.defaultProps = {
  className: 'octicon octicon-comment',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CommentDiscussionIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 2.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v5.5a.25.25 0 01-.25.25h-3.5a.75.75 0 00-.53.22L3.5 11.44V9.25a.75.75 0 00-.75-.75h-1a.25.25 0 01-.25-.25v-5.5zM1.75 1A1.75 1.75 0 000 2.75v5.5C0 9.216.784 10 1.75 10H2v1.543a1.457 1.457 0 002.487 1.03L7.061 10h3.189A1.75 1.75 0 0012 8.25v-5.5A1.75 1.75 0 0010.25 1h-8.5zM14.5 4.75a.25.25 0 00-.25-.25h-.5a.75.75 0 110-1.5h.5c.966 0 1.75.784 1.75 1.75v5.5A1.75 1.75 0 0114.25 12H14v1.543a1.457 1.457 0 01-2.487 1.03L9.22 12.28a.75.75 0 111.06-1.06l2.22 2.22v-2.19a.75.75 0 01.75-.75h1a.25.25 0 00.25-.25v-5.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 1A1.75 1.75 0 000 2.75v9.5C0 13.216.784 14 1.75 14H3v1.543a1.457 1.457 0 002.487 1.03L8.061 14h6.189A1.75 1.75 0 0016 12.25v-9.5A1.75 1.75 0 0014.25 1H1.75zM1.5 2.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v9.5a.25.25 0 01-.25.25h-6.5a.75.75 0 00-.53.22L4.5 15.44v-2.19a.75.75 0 00-.75-.75h-2a.25.25 0 01-.25-.25v-9.5z\"></path><path d=\"M22.5 8.75a.25.25 0 00-.25-.25h-3.5a.75.75 0 010-1.5h3.5c.966 0 1.75.784 1.75 1.75v9.5A1.75 1.75 0 0122.25 20H21v1.543a1.457 1.457 0 01-2.487 1.03L15.939 20H10.75A1.75 1.75 0 019 18.25v-1.465a.75.75 0 011.5 0v1.465c0 .138.112.25.25.25h5.5a.75.75 0 01.53.22l2.72 2.72v-2.19a.75.75 0 01.75-.75h2a.25.25 0 00.25-.25v-9.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CommentDiscussionIcon.defaultProps = {
  className: 'octicon octicon-comment-discussion',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CommitIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M17.5 11.75a.75.75 0 01.75-.75h5a.75.75 0 010 1.5h-5a.75.75 0 01-.75-.75zm-17.5 0A.75.75 0 01.75 11h5a.75.75 0 010 1.5h-5a.75.75 0 01-.75-.75z\"></path><path fill-rule=\"evenodd\" d=\"M12 16.25a4.5 4.5 0 100-9 4.5 4.5 0 000 9zm0 1.5a6 6 0 100-12 6 6 0 000 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CommitIcon.defaultProps = {
  className: 'octicon octicon-commit',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ContainerIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.41.24l4.711 2.774A1.767 1.767 0 0116 4.54v5.01a1.77 1.77 0 01-.88 1.53l-7.753 4.521-.002.001a1.767 1.767 0 01-1.774 0H5.59L.873 12.85A1.762 1.762 0 010 11.327V6.292c0-.304.078-.598.22-.855l.004-.005.01-.019c.15-.262.369-.486.64-.643L8.641.239a1.75 1.75 0 011.765 0l.002.001zM9.397 1.534a.25.25 0 01.252 0l4.115 2.422-7.152 4.148a.267.267 0 01-.269 0L2.227 5.716l7.17-4.182zM7.365 9.402L8.73 8.61v4.46l-1.5.875V9.473a1.77 1.77 0 00.136-.071zm2.864 2.794V7.741l1.521-.882v4.45l-1.521.887zm3.021-1.762l1.115-.65h.002a.268.268 0 00.133-.232V5.264l-1.25.725v4.445zm-11.621 1.12l4.1 2.393V9.474a1.77 1.77 0 01-.138-.072L1.5 7.029v4.298c0 .095.05.181.129.227z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ContainerIcon.defaultProps = {
  className: 'octicon octicon-container',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CopyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 010 1.5h-1.5a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 00.25-.25v-1.5a.75.75 0 011.5 0v1.5A1.75 1.75 0 019.25 16h-7.5A1.75 1.75 0 010 14.25v-7.5z\"></path><path fill-rule=\"evenodd\" d=\"M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0114.25 11h-7.5A1.75 1.75 0 015 9.25v-7.5zm1.75-.25a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 00.25-.25v-7.5a.25.25 0 00-.25-.25h-7.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.024 3.75c0-.966.784-1.75 1.75-1.75H20.25c.966 0 1.75.784 1.75 1.75v11.498a1.75 1.75 0 01-1.75 1.75H8.774a1.75 1.75 0 01-1.75-1.75V3.75zm1.75-.25a.25.25 0 00-.25.25v11.498c0 .139.112.25.25.25H20.25a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25H8.774z\"></path><path d=\"M1.995 10.749a1.75 1.75 0 011.75-1.751H5.25a.75.75 0 110 1.5H3.745a.25.25 0 00-.25.25L3.5 20.25c0 .138.111.25.25.25h9.5a.25.25 0 00.25-.25v-1.51a.75.75 0 111.5 0v1.51A1.75 1.75 0 0113.25 22h-9.5A1.75 1.75 0 012 20.25l-.005-9.501z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CopyIcon.defaultProps = {
  className: 'octicon octicon-copy',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CpuIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.5.75a.75.75 0 00-1.5 0V2H3.75A1.75 1.75 0 002 3.75V5H.75a.75.75 0 000 1.5H2v3H.75a.75.75 0 000 1.5H2v1.25c0 .966.784 1.75 1.75 1.75H5v1.25a.75.75 0 001.5 0V14h3v1.25a.75.75 0 001.5 0V14h1.25A1.75 1.75 0 0014 12.25V11h1.25a.75.75 0 000-1.5H14v-3h1.25a.75.75 0 000-1.5H14V3.75A1.75 1.75 0 0012.25 2H11V.75a.75.75 0 00-1.5 0V2h-3V.75zm5.75 11.75h-8.5a.25.25 0 01-.25-.25v-8.5a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v8.5a.25.25 0 01-.25.25zM5.75 5a.75.75 0 00-.75.75v4.5c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-4.5a.75.75 0 00-.75-.75h-4.5zm.75 4.5v-3h3v3h-3z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.75 8a.75.75 0 00-.75.75v6.5c0 .414.336.75.75.75h6.5a.75.75 0 00.75-.75v-6.5a.75.75 0 00-.75-.75h-6.5zm.75 6.5v-5h5v5h-5z\"></path><path fill-rule=\"evenodd\" d=\"M15.25 1a.75.75 0 01.75.75V4h2.25c.966 0 1.75.784 1.75 1.75V8h2.25a.75.75 0 010 1.5H20v5h2.25a.75.75 0 010 1.5H20v2.25A1.75 1.75 0 0118.25 20H16v2.25a.75.75 0 01-1.5 0V20h-5v2.25a.75.75 0 01-1.5 0V20H5.75A1.75 1.75 0 014 18.25V16H1.75a.75.75 0 010-1.5H4v-5H1.75a.75.75 0 010-1.5H4V5.75C4 4.784 4.784 4 5.75 4H8V1.75a.75.75 0 011.5 0V4h5V1.75a.75.75 0 01.75-.75zm3 17.5a.25.25 0 00.25-.25V5.75a.25.25 0 00-.25-.25H5.75a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h12.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CpuIcon.defaultProps = {
  className: 'octicon octicon-cpu',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CreditCardIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M10.75 9a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5h-1.5z\"></path><path fill-rule=\"evenodd\" d=\"M0 3.75C0 2.784.784 2 1.75 2h12.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0114.25 14H1.75A1.75 1.75 0 010 12.25v-8.5zm14.5 0V5h-13V3.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25zm0 2.75h-13v5.75c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V6.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M15.25 14a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z\"></path><path fill-rule=\"evenodd\" d=\"M1.75 3A1.75 1.75 0 000 4.75v14.5C0 20.216.784 21 1.75 21h20.5A1.75 1.75 0 0024 19.25V4.75A1.75 1.75 0 0022.25 3H1.75zM1.5 4.75a.25.25 0 01.25-.25h20.5a.25.25 0 01.25.25V8.5h-21V4.75zm0 5.25v9.25c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V10h-21z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CreditCardIcon.defaultProps = {
  className: 'octicon octicon-credit-card',
  size: 16,
  verticalAlign: 'text-bottom'
};

function CrossReferenceIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M16 1.25v4.146a.25.25 0 01-.427.177L14.03 4.03l-3.75 3.75a.75.75 0 11-1.06-1.06l3.75-3.75-1.543-1.543A.25.25 0 0111.604 1h4.146a.25.25 0 01.25.25zM2.75 3.5a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h2a.75.75 0 01.75.75v2.19l2.72-2.72a.75.75 0 01.53-.22h4.5a.25.25 0 00.25-.25v-2.5a.75.75 0 111.5 0v2.5A1.75 1.75 0 0113.25 13H9.06l-2.573 2.573A1.457 1.457 0 014 14.543V13H2.75A1.75 1.75 0 011 11.25v-7.5C1 2.784 1.784 2 2.75 2h5.5a.75.75 0 010 1.5h-5.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M16.5 2.25a.75.75 0 01.75-.75h5.5a.75.75 0 01.75.75v5.5a.75.75 0 01-1.5 0V4.06l-6.22 6.22a.75.75 0 11-1.06-1.06L20.94 3h-3.69a.75.75 0 01-.75-.75z\"></path><path d=\"M3.25 4a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h2.5a.75.75 0 01.75.75v3.19l3.72-3.72a.75.75 0 01.53-.22h10a.25.25 0 00.25-.25v-6a.75.75 0 011.5 0v6a1.75 1.75 0 01-1.75 1.75h-9.69l-3.573 3.573A1.457 1.457 0 015 21.043V18.5H3.25a1.75 1.75 0 01-1.75-1.75V4.25c0-.966.784-1.75 1.75-1.75h11a.75.75 0 010 1.5h-11z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

CrossReferenceIcon.defaultProps = {
  className: 'octicon octicon-cross-reference',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 7.75A.75.75 0 012.75 7h10a.75.75 0 010 1.5h-10A.75.75 0 012 7.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.5 12.75a.75.75 0 01.75-.75h13.5a.75.75 0 010 1.5H5.25a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DashIcon.defaultProps = {
  className: 'octicon octicon-dash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DatabaseIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 3.5c0-.133.058-.318.282-.55.227-.237.592-.484 1.1-.708C4.899 1.795 6.354 1.5 8 1.5c1.647 0 3.102.295 4.117.742.51.224.874.47 1.101.707.224.233.282.418.282.551 0 .133-.058.318-.282.55-.227.237-.592.484-1.1.708C11.101 5.205 9.646 5.5 8 5.5c-1.647 0-3.102-.295-4.117-.742-.51-.224-.874-.47-1.101-.707-.224-.233-.282-.418-.282-.551zM1 3.5c0-.626.292-1.165.7-1.59.406-.422.956-.767 1.579-1.041C4.525.32 6.195 0 8 0c1.805 0 3.475.32 4.722.869.622.274 1.172.62 1.578 1.04.408.426.7.965.7 1.591v9c0 .626-.292 1.165-.7 1.59-.406.422-.956.767-1.579 1.041C11.476 15.68 9.806 16 8 16c-1.805 0-3.475-.32-4.721-.869-.623-.274-1.173-.62-1.579-1.04-.408-.426-.7-.965-.7-1.591v-9zM2.5 8V5.724c.241.15.503.286.779.407C4.525 6.68 6.195 7 8 7c1.805 0 3.475-.32 4.722-.869.275-.121.537-.257.778-.407V8c0 .133-.058.318-.282.55-.227.237-.592.484-1.1.708C11.101 9.705 9.646 10 8 10c-1.647 0-3.102-.295-4.117-.742-.51-.224-.874-.47-1.101-.707C2.558 8.318 2.5 8.133 2.5 8zm0 2.225V12.5c0 .133.058.318.282.55.227.237.592.484 1.1.708 1.016.447 2.471.742 4.118.742 1.647 0 3.102-.295 4.117-.742.51-.224.874-.47 1.101-.707.224-.233.282-.418.282-.551v-2.275c-.241.15-.503.285-.778.406-1.247.549-2.917.869-4.722.869-1.805 0-3.475-.32-4.721-.869a6.236 6.236 0 01-.779-.406z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 1.25c-2.487 0-4.774.402-6.466 1.079-.844.337-1.577.758-2.112 1.264C2.886 4.1 2.5 4.744 2.5 5.5v12.987l.026.013H2.5c0 .756.386 1.4.922 1.907.535.506 1.268.927 2.112 1.264 1.692.677 3.979 1.079 6.466 1.079s4.773-.402 6.466-1.079c.844-.337 1.577-.758 2.112-1.264.536-.507.922-1.151.922-1.907h-.026l.026-.013V5.5c0-.756-.386-1.4-.922-1.907-.535-.506-1.268-.927-2.112-1.264C16.773 1.652 14.487 1.25 12 1.25zM4 5.5c0-.21.104-.487.453-.817.35-.332.899-.666 1.638-.962C7.566 3.131 9.655 2.75 12 2.75c2.345 0 4.434.382 5.909.971.74.296 1.287.63 1.638.962.35.33.453.606.453.817 0 .21-.104.487-.453.817-.35.332-.899.666-1.638.962-1.475.59-3.564.971-5.909.971-2.345 0-4.434-.382-5.909-.971-.74-.296-1.287-.63-1.638-.962C4.103 5.987 4 5.711 4 5.5zM20 12V7.871a7.842 7.842 0 01-1.534.8C16.773 9.348 14.487 9.75 12 9.75s-4.774-.402-6.466-1.079A7.843 7.843 0 014 7.871V12c0 .21.104.487.453.817.35.332.899.666 1.638.961 1.475.59 3.564.972 5.909.972 2.345 0 4.434-.382 5.909-.972.74-.295 1.287-.629 1.638-.96.35-.33.453-.607.453-.818zM4 14.371c.443.305.963.572 1.534.8 1.692.677 3.979 1.079 6.466 1.079s4.773-.402 6.466-1.079a7.842 7.842 0 001.534-.8v4.116l.013.013H20c0 .21-.104.487-.453.817-.35.332-.899.666-1.638.962-1.475.59-3.564.971-5.909.971-2.345 0-4.434-.382-5.909-.971-.74-.296-1.287-.63-1.638-.962-.35-.33-.453-.606-.453-.817h-.013L4 18.487V14.37z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DatabaseIcon.defaultProps = {
  className: 'octicon octicon-database',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DependabotIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M5.75 7.5a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5a.75.75 0 01.75-.75zm5.25.75a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z\"></path><path fill-rule=\"evenodd\" d=\"M6.25 0a.75.75 0 000 1.5H7.5v2H3.75A2.25 2.25 0 001.5 5.75V8H.75a.75.75 0 000 1.5h.75v2.75a2.25 2.25 0 002.25 2.25h8.5a2.25 2.25 0 002.25-2.25V9.5h.75a.75.75 0 000-1.5h-.75V5.75a2.25 2.25 0 00-2.25-2.25H9V.75A.75.75 0 008.25 0h-2zM3 5.75A.75.75 0 013.75 5h8.5a.75.75 0 01.75.75v6.5a.75.75 0 01-.75.75h-8.5a.75.75 0 01-.75-.75v-6.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M8.75 11a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5a.75.75 0 01.75-.75zm7.25.75a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z\"></path><path fill-rule=\"evenodd\" d=\"M9.813 1a.75.75 0 000 1.5H11.5V5H4.25A2.25 2.25 0 002 7.25v5.25H.75a.75.75 0 000 1.5H2v5.75A2.25 2.25 0 004.25 22h15.5A2.25 2.25 0 0022 19.75V14h1.25a.75.75 0 000-1.5H22V7.25A2.25 2.25 0 0019.75 5H13V1.75a.75.75 0 00-.75-.75H9.812zM3.5 7.25a.75.75 0 01.75-.75h15.5a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75H4.25a.75.75 0 01-.75-.75V7.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DependabotIcon.defaultProps = {
  className: 'octicon octicon-dependabot',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DesktopDownloadIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M4.927 5.427l2.896 2.896a.25.25 0 00.354 0l2.896-2.896A.25.25 0 0010.896 5H8.75V.75a.75.75 0 10-1.5 0V5H5.104a.25.25 0 00-.177.427z\"></path><path d=\"M1.573 2.573a.25.25 0 00-.073.177v7.5a.25.25 0 00.25.25h12.5a.25.25 0 00.25-.25v-7.5a.25.25 0 00-.25-.25h-3a.75.75 0 110-1.5h3A1.75 1.75 0 0116 2.75v7.5A1.75 1.75 0 0114.25 12h-3.727c.099 1.041.52 1.872 1.292 2.757A.75.75 0 0111.25 16h-6.5a.75.75 0 01-.565-1.243c.772-.885 1.192-1.716 1.292-2.757H1.75A1.75 1.75 0 010 10.25v-7.5A1.75 1.75 0 011.75 1h3a.75.75 0 010 1.5h-3a.25.25 0 00-.177.073zM6.982 12a5.72 5.72 0 01-.765 2.5h3.566a5.72 5.72 0 01-.765-2.5H6.982z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M11.25 9.331V.75a.75.75 0 011.5 0v8.58l1.949-2.11A.75.75 0 1115.8 8.237l-3.25 3.52a.75.75 0 01-1.102 0l-3.25-3.52A.75.75 0 119.3 7.22l1.949 2.111z\"></path><path fill-rule=\"evenodd\" d=\"M2.5 3.75a.25.25 0 01.25-.25h5.5a.75.75 0 100-1.5h-5.5A1.75 1.75 0 001 3.75v11.5c0 .966.784 1.75 1.75 1.75h6.204c-.171 1.375-.805 2.652-1.77 3.757A.75.75 0 007.75 22h8.5a.75.75 0 00.565-1.243c-.964-1.105-1.598-2.382-1.769-3.757h6.204A1.75 1.75 0 0023 15.25V3.75A1.75 1.75 0 0021.25 2h-5.5a.75.75 0 000 1.5h5.5a.25.25 0 01.25.25v11.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V3.75zM10.463 17c-.126 1.266-.564 2.445-1.223 3.5h5.52c-.66-1.055-1.098-2.234-1.223-3.5h-3.074z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DesktopDownloadIcon.defaultProps = {
  className: 'octicon octicon-desktop-download',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DeviceCameraIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M15 3H7c0-.55-.45-1-1-1H2c-.55 0-1 .45-1 1-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h14c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM6 5H2V4h4v1zm4.5 7C8.56 12 7 10.44 7 8.5S8.56 5 10.5 5 14 6.56 14 8.5 12.44 12 10.5 12zM13 8.5c0 1.38-1.13 2.5-2.5 2.5S8 9.87 8 8.5 9.13 6 10.5 6 13 7.13 13 8.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DeviceCameraIcon.defaultProps = {
  className: 'octicon octicon-device-camera',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DeviceCameraVideoIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M16 3.75a.75.75 0 00-1.136-.643L11 5.425V4.75A1.75 1.75 0 009.25 3h-7.5A1.75 1.75 0 000 4.75v6.5C0 12.216.784 13 1.75 13h7.5A1.75 1.75 0 0011 11.25v-.675l3.864 2.318A.75.75 0 0016 12.25v-8.5zm-5 5.075l3.5 2.1v-5.85l-3.5 2.1v1.65zM9.5 6.75v-2a.25.25 0 00-.25-.25h-7.5a.25.25 0 00-.25.25v6.5c0 .138.112.25.25.25h7.5a.25.25 0 00.25-.25v-4.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M24 5.25a.75.75 0 00-1.136-.643L16.5 8.425V6.25a1.75 1.75 0 00-1.75-1.75h-13A1.75 1.75 0 000 6.25v11C0 18.216.784 19 1.75 19h13a1.75 1.75 0 001.75-1.75v-2.175l6.364 3.818A.75.75 0 0024 18.25v-13zm-7.5 8.075l6 3.6V6.575l-6 3.6v3.15zM15 9.75v-3.5a.25.25 0 00-.25-.25h-13a.25.25 0 00-.25.25v11c0 .138.112.25.25.25h13a.25.25 0 00.25-.25v-7.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DeviceCameraVideoIcon.defaultProps = {
  className: 'octicon octicon-device-camera-video',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DeviceDesktopIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2.5h12.5a.25.25 0 01.25.25v7.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25v-7.5a.25.25 0 01.25-.25zM14.25 1H1.75A1.75 1.75 0 000 2.75v7.5C0 11.216.784 12 1.75 12h3.727c-.1 1.041-.52 1.872-1.292 2.757A.75.75 0 004.75 16h6.5a.75.75 0 00.565-1.243c-.772-.885-1.193-1.716-1.292-2.757h3.727A1.75 1.75 0 0016 10.25v-7.5A1.75 1.75 0 0014.25 1zM9.018 12H6.982a5.72 5.72 0 01-.765 2.5h3.566a5.72 5.72 0 01-.765-2.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.954 17H2.75A1.75 1.75 0 011 15.25V3.75C1 2.784 1.784 2 2.75 2h18.5c.966 0 1.75.784 1.75 1.75v11.5A1.75 1.75 0 0121.25 17h-6.204c.171 1.375.805 2.652 1.769 3.757A.75.75 0 0116.25 22h-8.5a.75.75 0 01-.565-1.243c.964-1.105 1.598-2.382 1.769-3.757zM21.5 3.75v11.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V3.75a.25.25 0 01.25-.25h18.5a.25.25 0 01.25.25zM13.537 17c.125 1.266.564 2.445 1.223 3.5H9.24c.659-1.055 1.097-2.234 1.223-3.5h3.074z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DeviceDesktopIcon.defaultProps = {
  className: 'octicon octicon-device-desktop',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DeviceMobileIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 0A1.75 1.75 0 002 1.75v12.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 14.25V1.75A1.75 1.75 0 0012.25 0h-8.5zM3.5 1.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25V1.75zM8 13a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.25 5.25A.75.75 0 0111 4.5h2A.75.75 0 0113 6h-2a.75.75 0 01-.75-.75zM12 19.5a1 1 0 100-2 1 1 0 000 2z\"></path><path fill-rule=\"evenodd\" d=\"M4 2.75C4 1.784 4.784 1 5.75 1h12.5c.966 0 1.75.784 1.75 1.75v18.5A1.75 1.75 0 0118.25 23H5.75A1.75 1.75 0 014 21.25V2.75zm1.75-.25a.25.25 0 00-.25.25v18.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25H5.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DeviceMobileIcon.defaultProps = {
  className: 'octicon octicon-device-mobile',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiamondIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M.527 9.237a1.75 1.75 0 010-2.474L6.777.512a1.75 1.75 0 012.475 0l6.251 6.25a1.751 1.751 0 010 2.475l-6.25 6.251a1.751 1.751 0 01-2.475 0L.527 9.238v-.001zm1.06-1.414a.25.25 0 000 .354l6.251 6.25a.25.25 0 00.354 0l6.25-6.25a.25.25 0 000-.354l-6.25-6.25a.25.25 0 00-.354 0l-6.25 6.25h-.001z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.527 13.237a1.75 1.75 0 010-2.474l9.272-9.273a1.75 1.75 0 012.475 0l9.272 9.273a1.75 1.75 0 010 2.474l-9.272 9.272a1.75 1.75 0 01-2.475 0l-9.272-9.272zm1.06-1.414a.25.25 0 000 .354l9.273 9.272a.25.25 0 00.353 0l9.272-9.272a.25.25 0 000-.354l-9.272-9.272a.25.25 0 00-.353 0l-9.273 9.272z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiamondIcon.defaultProps = {
  className: 'octicon octicon-diamond',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.75 1.75a.75.75 0 00-1.5 0V5H4a.75.75 0 000 1.5h3.25v3.25a.75.75 0 001.5 0V6.5H12A.75.75 0 0012 5H8.75V1.75zM4 13a.75.75 0 000 1.5h8a.75.75 0 100-1.5H4z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.25 3.5a.75.75 0 01.75.75V8.5h4.25a.75.75 0 010 1.5H13v4.25a.75.75 0 01-1.5 0V10H7.25a.75.75 0 010-1.5h4.25V4.25a.75.75 0 01.75-.75zM6.562 19.25a.75.75 0 01.75-.75h9.938a.75.75 0 010 1.5H7.312a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffIcon.defaultProps = {
  className: 'octicon octicon-diff',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffAddedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13.25 2.5H2.75a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25zM2.75 1h10.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25V2.75C1 1.784 1.784 1 2.75 1zM8 4a.75.75 0 01.75.75v2.5h2.5a.75.75 0 010 1.5h-2.5v2.5a.75.75 0 01-1.5 0v-2.5h-2.5a.75.75 0 010-1.5h2.5v-2.5A.75.75 0 018 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffAddedIcon.defaultProps = {
  className: 'octicon octicon-diff-added',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffIgnoredIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5h10.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V2.75a.25.25 0 01.25-.25zM13.25 1H2.75A1.75 1.75 0 001 2.75v10.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 13.25V2.75A1.75 1.75 0 0013.25 1zm-1.97 4.78a.75.75 0 00-1.06-1.06l-5.5 5.5a.75.75 0 101.06 1.06l5.5-5.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffIgnoredIcon.defaultProps = {
  className: 'octicon octicon-diff-ignored',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffModifiedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5h10.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V2.75a.25.25 0 01.25-.25zM13.25 1H2.75A1.75 1.75 0 001 2.75v10.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 13.25V2.75A1.75 1.75 0 0013.25 1zM8 10a2 2 0 100-4 2 2 0 000 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffModifiedIcon.defaultProps = {
  className: 'octicon octicon-diff-modified',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffRemovedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5h10.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V2.75a.25.25 0 01.25-.25zM13.25 1H2.75A1.75 1.75 0 001 2.75v10.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 13.25V2.75A1.75 1.75 0 0013.25 1zm-2 7.75a.75.75 0 000-1.5h-6.5a.75.75 0 000 1.5h6.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffRemovedIcon.defaultProps = {
  className: 'octicon octicon-diff-removed',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DiffRenamedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5h10.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V2.75a.25.25 0 01.25-.25zM13.25 1H2.75A1.75 1.75 0 001 2.75v10.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 13.25V2.75A1.75 1.75 0 0013.25 1zm-1.47 7.53a.75.75 0 000-1.06L8.53 4.22a.75.75 0 00-1.06 1.06l1.97 1.97H4.75a.75.75 0 000 1.5h4.69l-1.97 1.97a.75.75 0 101.06 1.06l3.25-3.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DiffRenamedIcon.defaultProps = {
  className: 'octicon octicon-diff-renamed',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DotIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4 8a4 4 0 118 0 4 4 0 01-8 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 16.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9zm0 1.5a6 6 0 100-12 6 6 0 000 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DotIcon.defaultProps = {
  className: 'octicon octicon-dot',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DotFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 4a4 4 0 100 8 4 4 0 000-8z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12 18a6 6 0 100-12 6 6 0 000 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DotFillIcon.defaultProps = {
  className: 'octicon octicon-dot-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DownloadIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.47 10.78a.75.75 0 001.06 0l3.75-3.75a.75.75 0 00-1.06-1.06L8.75 8.44V1.75a.75.75 0 00-1.5 0v6.69L4.78 5.97a.75.75 0 00-1.06 1.06l3.75 3.75zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M4.97 11.03a.75.75 0 111.06-1.06L11 14.94V2.75a.75.75 0 011.5 0v12.19l4.97-4.97a.75.75 0 111.06 1.06l-6.25 6.25a.75.75 0 01-1.06 0l-6.25-6.25zm-.22 9.47a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H4.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DownloadIcon.defaultProps = {
  className: 'octicon octicon-download',
  size: 16,
  verticalAlign: 'text-bottom'
};

function DuplicateIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M10.5 3a.75.75 0 01.75.75v1h1a.75.75 0 010 1.5h-1v1a.75.75 0 01-1.5 0v-1h-1a.75.75 0 010-1.5h1v-1A.75.75 0 0110.5 3z\"></path><path fill-rule=\"evenodd\" d=\"M6.75 0A1.75 1.75 0 005 1.75v7.5c0 .966.784 1.75 1.75 1.75h7.5A1.75 1.75 0 0016 9.25v-7.5A1.75 1.75 0 0014.25 0h-7.5zM6.5 1.75a.25.25 0 01.25-.25h7.5a.25.25 0 01.25.25v7.5a.25.25 0 01-.25.25h-7.5a.25.25 0 01-.25-.25v-7.5z\"></path><path d=\"M1.75 5A1.75 1.75 0 000 6.75v7.5C0 15.216.784 16 1.75 16h7.5A1.75 1.75 0 0011 14.25v-1.5a.75.75 0 00-1.5 0v1.5a.25.25 0 01-.25.25h-7.5a.25.25 0 01-.25-.25v-7.5a.25.25 0 01.25-.25h1.5a.75.75 0 000-1.5h-1.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M14.513 6a.75.75 0 01.75.75v2h1.987a.75.75 0 010 1.5h-1.987v2a.75.75 0 11-1.5 0v-2H11.75a.75.75 0 010-1.5h2.013v-2a.75.75 0 01.75-.75z\"></path><path fill-rule=\"evenodd\" d=\"M7.024 3.75c0-.966.784-1.75 1.75-1.75H20.25c.966 0 1.75.784 1.75 1.75v11.498a1.75 1.75 0 01-1.75 1.75H8.774a1.75 1.75 0 01-1.75-1.75V3.75zm1.75-.25a.25.25 0 00-.25.25v11.498c0 .139.112.25.25.25H20.25a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25H8.774z\"></path><path d=\"M1.995 10.749a1.75 1.75 0 011.75-1.751H5.25a.75.75 0 110 1.5H3.745a.25.25 0 00-.25.25L3.5 20.25c0 .138.111.25.25.25h9.5a.25.25 0 00.25-.25v-1.51a.75.75 0 111.5 0v1.51A1.75 1.75 0 0113.25 22h-9.5A1.75 1.75 0 012 20.25l-.005-9.501z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

DuplicateIcon.defaultProps = {
  className: 'octicon octicon-duplicate',
  size: 16,
  verticalAlign: 'text-bottom'
};

function EllipsisIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 5.75C0 4.784.784 4 1.75 4h12.5c.966 0 1.75.784 1.75 1.75v4.5A1.75 1.75 0 0114.25 12H1.75A1.75 1.75 0 010 10.25v-4.5zM4 7a1 1 0 100 2 1 1 0 000-2zm3 1a1 1 0 112 0 1 1 0 01-2 0zm5-1a1 1 0 100 2 1 1 0 000-2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

EllipsisIcon.defaultProps = {
  className: 'octicon octicon-ellipsis',
  size: 16,
  verticalAlign: 'text-bottom'
};

function EyeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M15.5 12a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z\"></path><path fill-rule=\"evenodd\" d=\"M12 3.5c-3.432 0-6.125 1.534-8.054 3.24C2.02 8.445.814 10.352.33 11.202a1.6 1.6 0 000 1.598c.484.85 1.69 2.758 3.616 4.46C5.876 18.966 8.568 20.5 12 20.5c3.432 0 6.125-1.534 8.054-3.24 1.926-1.704 3.132-3.611 3.616-4.461a1.6 1.6 0 000-1.598c-.484-.85-1.69-2.757-3.616-4.46C18.124 5.034 15.432 3.5 12 3.5zM1.633 11.945c.441-.774 1.551-2.528 3.307-4.08C6.69 6.314 9.045 5 12 5c2.955 0 5.309 1.315 7.06 2.864 1.756 1.553 2.866 3.307 3.307 4.08a.111.111 0 01.017.056.111.111 0 01-.017.056c-.441.774-1.551 2.527-3.307 4.08C17.31 17.685 14.955 19 12 19c-2.955 0-5.309-1.315-7.06-2.864-1.756-1.553-2.866-3.306-3.307-4.08A.11.11 0 011.616 12a.11.11 0 01.017-.055z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

EyeIcon.defaultProps = {
  className: 'octicon octicon-eye',
  size: 16,
  verticalAlign: 'text-bottom'
};

function EyeClosedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M.143 2.31a.75.75 0 011.047-.167l14.5 10.5a.75.75 0 11-.88 1.214l-2.248-1.628C11.346 13.19 9.792 14 8 14c-1.981 0-3.67-.992-4.933-2.078C1.797 10.832.88 9.577.43 8.9a1.618 1.618 0 010-1.797c.353-.533.995-1.42 1.868-2.305L.31 3.357A.75.75 0 01.143 2.31zm3.386 3.378a14.21 14.21 0 00-1.85 2.244.12.12 0 00-.022.068c0 .021.006.045.022.068.412.621 1.242 1.75 2.366 2.717C5.175 11.758 6.527 12.5 8 12.5c1.195 0 2.31-.488 3.29-1.191L9.063 9.695A2 2 0 016.058 7.52l-2.53-1.832zM8 3.5c-.516 0-1.017.09-1.499.251a.75.75 0 11-.473-1.423A6.23 6.23 0 018 2c1.981 0 3.67.992 4.933 2.078 1.27 1.091 2.187 2.345 2.637 3.023a1.619 1.619 0 010 1.798c-.11.166-.248.365-.41.587a.75.75 0 11-1.21-.887c.148-.201.272-.382.371-.53a.119.119 0 000-.137c-.412-.621-1.242-1.75-2.366-2.717C10.825 4.242 9.473 3.5 8 3.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M8.052 5.837A9.715 9.715 0 0112 5c2.955 0 5.309 1.315 7.06 2.864 1.756 1.553 2.866 3.307 3.307 4.08a.11.11 0 01.016.055.122.122 0 01-.017.06 16.766 16.766 0 01-1.53 2.218.75.75 0 101.163.946 18.253 18.253 0 001.67-2.42 1.607 1.607 0 00.001-1.602c-.485-.85-1.69-2.757-3.616-4.46C18.124 5.034 15.432 3.5 12 3.5c-1.695 0-3.215.374-4.552.963a.75.75 0 00.604 1.373z\"></path><path fill-rule=\"evenodd\" d=\"M19.166 17.987C17.328 19.38 14.933 20.5 12 20.5c-3.432 0-6.125-1.534-8.054-3.24C2.02 15.556.814 13.648.33 12.798a1.606 1.606 0 01.001-1.6A18.305 18.305 0 013.648 7.01L1.317 5.362a.75.75 0 11.866-1.224l20.5 14.5a.75.75 0 11-.866 1.224l-2.651-1.875zM4.902 7.898c-1.73 1.541-2.828 3.273-3.268 4.044a.118.118 0 00-.017.059c0 .015.003.034.016.055.441.774 1.551 2.527 3.307 4.08C6.69 17.685 9.045 19 12 19c2.334 0 4.29-.82 5.874-1.927l-3.516-2.487a3.5 3.5 0 01-5.583-3.949L4.902 7.899z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

EyeClosedIcon.defaultProps = {
  className: 'octicon octicon-eye-closed',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75zm5.75.56v2.19c0 .138.112.25.25.25h2.19L9.5 2.06zM2 1.75C2 .784 2.784 0 3.75 0h5.086c.464 0 .909.184 1.237.513l3.414 3.414c.329.328.513.773.513 1.237v8.086A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25V1.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5 2.5a.5.5 0 00-.5.5v18a.5.5 0 00.5.5h14a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5zm10 0v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zM3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H5a2 2 0 01-2-2V3z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileIcon.defaultProps = {
  className: 'octicon octicon-file',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileBadgeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M2.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h3.5a.75.75 0 010 1.5h-3.5A1.75 1.75 0 011 13.25V1.75C1 .784 1.784 0 2.75 0h8a1.75 1.75 0 011.508.862.75.75 0 11-1.289.768.25.25 0 00-.219-.13h-8z\"></path><path fill-rule=\"evenodd\" d=\"M8 7a4 4 0 116.49 3.13l.995 4.973a.75.75 0 01-.991.852l-2.409-.876a.25.25 0 00-.17 0l-2.409.876a.75.75 0 01-.991-.852l.994-4.973A3.993 3.993 0 018 7zm4-2.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zm0 6.5a4 4 0 001.104-.154l.649 3.243-1.155-.42c-.386-.14-.81-.14-1.196 0l-1.155.42.649-3.243A4 4 0 0012 11z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileBadgeIcon.defaultProps = {
  className: 'octicon octicon-file-badge',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileBinaryIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4 1.75C4 .784 4.784 0 5.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0114.25 15h-9a.75.75 0 010-1.5h9a.25.25 0 00.25-.25V6h-2.75A1.75 1.75 0 0110 4.25V1.5H5.75a.25.25 0 00-.25.25v2a.75.75 0 01-1.5 0v-2zm7.5-.188V4.25c0 .138.112.25.25.25h2.688a.252.252 0 00-.011-.013l-2.914-2.914a.272.272 0 00-.013-.011zM0 7.75C0 6.784.784 6 1.75 6h1.5C4.216 6 5 6.784 5 7.75v2.5A1.75 1.75 0 013.25 12h-1.5A1.75 1.75 0 010 10.25v-2.5zm1.75-.25a.25.25 0 00-.25.25v2.5c0 .138.112.25.25.25h1.5a.25.25 0 00.25-.25v-2.5a.25.25 0 00-.25-.25h-1.5zm5-1.5a.75.75 0 000 1.5h.75v3h-.75a.75.75 0 000 1.5h3a.75.75 0 000-1.5H9V6.75A.75.75 0 008.25 6h-1.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5z\"></path><path fill-rule=\"evenodd\" d=\"M0 13.75C0 12.784.784 12 1.75 12h3c.966 0 1.75.784 1.75 1.75v4a1.75 1.75 0 01-1.75 1.75h-3A1.75 1.75 0 010 17.75v-4zm1.75-.25a.25.25 0 00-.25.25v4c0 .138.112.25.25.25h3a.25.25 0 00.25-.25v-4a.25.25 0 00-.25-.25h-3z\"></path><path d=\"M9 12a.75.75 0 000 1.5h1.5V18H9a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5H12v-5.25a.75.75 0 00-.75-.75H9z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileBinaryIcon.defaultProps = {
  className: 'octicon octicon-file-binary',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileCodeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4 1.75C4 .784 4.784 0 5.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0114.25 15h-9a.75.75 0 010-1.5h9a.25.25 0 00.25-.25V6h-2.75A1.75 1.75 0 0110 4.25V1.5H5.75a.25.25 0 00-.25.25v2.5a.75.75 0 01-1.5 0v-2.5zm7.5-.188V4.25c0 .138.112.25.25.25h2.688a.252.252 0 00-.011-.013l-2.914-2.914a.272.272 0 00-.013-.011zM5.72 6.72a.75.75 0 000 1.06l1.47 1.47-1.47 1.47a.75.75 0 101.06 1.06l2-2a.75.75 0 000-1.06l-2-2a.75.75 0 00-1.06 0zM3.28 7.78a.75.75 0 00-1.06-1.06l-2 2a.75.75 0 000 1.06l2 2a.75.75 0 001.06-1.06L1.81 9.25l1.47-1.47z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5z\"></path><path d=\"M4.53 12.24a.75.75 0 01-.039 1.06l-2.639 2.45 2.64 2.45a.75.75 0 11-1.022 1.1l-3.23-3a.75.75 0 010-1.1l3.23-3a.75.75 0 011.06.04zm3.979 1.06a.75.75 0 111.02-1.1l3.231 3a.75.75 0 010 1.1l-3.23 3a.75.75 0 11-1.021-1.1l2.639-2.45-2.64-2.45z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileCodeIcon.defaultProps = {
  className: 'octicon octicon-file-code',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileDiffIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 1.5a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V4.664a.25.25 0 00-.073-.177l-2.914-2.914a.25.25 0 00-.177-.073H2.75zM1 1.75C1 .784 1.784 0 2.75 0h7.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v9.586A1.75 1.75 0 0113.25 16H2.75A1.75 1.75 0 011 14.25V1.75zm7 1.5a.75.75 0 01.75.75v1.5h1.5a.75.75 0 010 1.5h-1.5v1.5a.75.75 0 01-1.5 0V7h-1.5a.75.75 0 010-1.5h1.5V4A.75.75 0 018 3.25zm-3 8a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12.5 6.75a.75.75 0 00-1.5 0V9H8.75a.75.75 0 000 1.5H11v2.25a.75.75 0 001.5 0V10.5h2.25a.75.75 0 000-1.5H12.5V6.75zM8.75 16a.75.75 0 000 1.5h6a.75.75 0 000-1.5h-6z\"></path><path fill-rule=\"evenodd\" d=\"M5 1a2 2 0 00-2 2v18a2 2 0 002 2h14a2 2 0 002-2V7.018a2 2 0 00-.586-1.414l-4.018-4.018A2 2 0 0014.982 1H5zm-.5 2a.5.5 0 01.5-.5h9.982a.5.5 0 01.354.146l4.018 4.018a.5.5 0 01.146.354V21a.5.5 0 01-.5.5H5a.5.5 0 01-.5-.5V3z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileDiffIcon.defaultProps = {
  className: 'octicon octicon-file-diff',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileDirectoryIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 1A1.75 1.75 0 000 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25v-8.5A1.75 1.75 0 0014.25 3h-6.5a.25.25 0 01-.2-.1l-.9-1.2c-.33-.44-.85-.7-1.4-.7h-3.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 4.5a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25V7.687a.25.25 0 00-.25-.25h-8.471a1.75 1.75 0 01-1.447-.765L8.928 4.61a.25.25 0 00-.208-.11H3.75zM2 4.75C2 3.784 2.784 3 3.75 3h4.971c.58 0 1.12.286 1.447.765l1.404 2.063a.25.25 0 00.207.11h8.471c.966 0 1.75.783 1.75 1.75V19.25A1.75 1.75 0 0120.25 21H3.75A1.75 1.75 0 012 19.25V4.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileDirectoryIcon.defaultProps = {
  className: 'octicon octicon-file-directory',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileDirectoryFillIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2 4.75C2 3.784 2.784 3 3.75 3h4.971c.58 0 1.12.286 1.447.765l1.404 2.063a.25.25 0 00.207.11h8.471c.966 0 1.75.783 1.75 1.75V19.25A1.75 1.75 0 0120.25 21H3.75A1.75 1.75 0 012 19.25V4.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileDirectoryFillIcon.defaultProps = {
  className: 'octicon octicon-file-directory-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileMediaIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileMediaIcon.defaultProps = {
  className: 'octicon octicon-file-media',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileSubmoduleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 2.75C0 1.784.784 1 1.75 1H5c.55 0 1.07.26 1.4.7l.9 1.2a.25.25 0 00.2.1h6.75c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0114.25 15H1.75A1.75 1.75 0 010 13.25V2.75zm9.42 9.36l2.883-2.677a.25.25 0 000-.366L9.42 6.39a.25.25 0 00-.42.183V8.5H4.75a.75.75 0 100 1.5H9v1.927c0 .218.26.331.42.183z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2 4.75C2 3.784 2.784 3 3.75 3h4.965a1.75 1.75 0 011.456.78l1.406 2.109a.25.25 0 00.208.111h8.465c.966 0 1.75.784 1.75 1.75v11.5A1.75 1.75 0 0120.25 21H3.75A1.75 1.75 0 012 19.25V4.75zm12.78 4.97a.75.75 0 10-1.06 1.06l1.72 1.72H6.75a.75.75 0 000 1.5h8.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3a.75.75 0 000-1.06l-3-3z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileSubmoduleIcon.defaultProps = {
  className: 'octicon octicon-file-submodule',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileSymlinkFileIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 1.75C2 .784 2.784 0 3.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0112.25 15h-7a.75.75 0 010-1.5h7a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75a.25.25 0 00-.25.25V4.5a.75.75 0 01-1.5 0V1.75zm7.5-.188V4.25c0 .138.112.25.25.25h2.688a.252.252 0 00-.011-.013L9.513 1.573a.248.248 0 00-.013-.011zm-8 10.675a2.25 2.25 0 012.262-2.25L4 9.99v1.938c0 .218.26.331.42.183l2.883-2.677a.25.25 0 000-.366L4.42 6.39a.25.25 0 00-.42.183V8.49l-.23-.001A3.75 3.75 0 000 12.238v1.012a.75.75 0 001.5 0v-1.013z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zm-5.692 12l-2.104-2.236a.75.75 0 111.092-1.028l3.294 3.5a.75.75 0 010 1.028l-3.294 3.5a.75.75 0 11-1.092-1.028L9.308 16H4.09a2.59 2.59 0 00-2.59 2.59v3.16a.75.75 0 01-1.5 0v-3.16a4.09 4.09 0 014.09-4.09h5.218z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileSymlinkFileIcon.defaultProps = {
  className: 'octicon octicon-file-symlink-file',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FileZipIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.5 1.75a.25.25 0 01.25-.25h3a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h2.086a.25.25 0 01.177.073l2.914 2.914a.25.25 0 01.073.177v8.586a.25.25 0 01-.25.25h-.5a.75.75 0 000 1.5h.5A1.75 1.75 0 0014 13.25V4.664c0-.464-.184-.909-.513-1.237L10.573.513A1.75 1.75 0 009.336 0H3.75A1.75 1.75 0 002 1.75v11.5c0 .649.353 1.214.874 1.515a.75.75 0 10.752-1.298.25.25 0 01-.126-.217V1.75zM8.75 3a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM6 5.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5A.75.75 0 016 5.25zm2 1.5A.75.75 0 018.75 6h.5a.75.75 0 010 1.5h-.5A.75.75 0 018 6.75zm-1.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM8 9.75A.75.75 0 018.75 9h.5a.75.75 0 010 1.5h-.5A.75.75 0 018 9.75zm-.75.75a1.75 1.75 0 00-1.75 1.75v3c0 .414.336.75.75.75h2.5a.75.75 0 00.75-.75v-3a1.75 1.75 0 00-1.75-1.75h-.5zM7 12.25a.25.25 0 01.25-.25h.5a.25.25 0 01.25.25v2.25H7v-2.25z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M5 2.5a.5.5 0 00-.5.5v18a.5.5 0 00.5.5h1.75a.75.75 0 010 1.5H5a2 2 0 01-2-2V3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2h-2.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V7.018a.5.5 0 00-.146-.354l-4.018-4.018a.5.5 0 00-.354-.146H5z\"></path><path d=\"M11.5 15.75a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm.75-3.75a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zm-.75-2.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zM12.25 6a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zm-.75-2.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zM9.75 13.5a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zM9 11.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm.75-3.75a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zM9 5.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1A.75.75 0 019 5.25z\"></path><path fill-rule=\"evenodd\" d=\"M11 17a2 2 0 00-2 2v4.25c0 .414.336.75.75.75h3.5a.75.75 0 00.75-.75V19a2 2 0 00-2-2h-1zm-.5 2a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v3.5h-2V19z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FileZipIcon.defaultProps = {
  className: 'octicon octicon-file-zip',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FilterIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M.75 3a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H.75zM3 7.75A.75.75 0 013.75 7h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 013 7.75zm3 4a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M2.75 6a.75.75 0 000 1.5h18.5a.75.75 0 000-1.5H2.75zM6 11.75a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75a.75.75 0 01-.75-.75zm4 4.938a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FilterIcon.defaultProps = {
  className: 'octicon octicon-filter',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FlameIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.998 14.5c2.832 0 5-1.98 5-4.5 0-1.463-.68-2.19-1.879-3.383l-.036-.037c-1.013-1.008-2.3-2.29-2.834-4.434-.322.256-.63.579-.864.953-.432.696-.621 1.58-.046 2.73.473.947.67 2.284-.278 3.232-.61.61-1.545.84-2.403.633a2.788 2.788 0 01-1.436-.874A3.21 3.21 0 003 10c0 2.53 2.164 4.5 4.998 4.5zM9.533.753C9.496.34 9.16.009 8.77.146 7.035.75 4.34 3.187 5.997 6.5c.344.689.285 1.218.003 1.5-.419.419-1.54.487-2.04-.832-.173-.454-.659-.762-1.035-.454C2.036 7.44 1.5 8.702 1.5 10c0 3.512 2.998 6 6.498 6s6.5-2.5 6.5-6c0-2.137-1.128-3.26-2.312-4.438-1.19-1.184-2.436-2.425-2.653-4.81z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.185 21.5c4.059 0 7.065-2.84 7.065-6.75 0-2.337-1.093-3.489-2.678-5.158l-.021-.023c-1.44-1.517-3.139-3.351-3.649-6.557a6.14 6.14 0 00-1.911 1.76c-.787 1.144-1.147 2.633-.216 4.495.603 1.205.777 2.74-.277 3.794-.657.657-1.762 1.1-2.956.586-.752-.324-1.353-.955-1.838-1.79-.567.706-.954 1.74-.954 2.893 0 3.847 3.288 6.75 7.435 6.75zm2.08-19.873c-.017-.345-.296-.625-.632-.543-2.337.575-6.605 4.042-4.2 8.854.474.946.392 1.675.004 2.062-.64.64-1.874.684-2.875-1.815-.131-.327-.498-.509-.803-.334-1.547.888-2.509 2.86-2.509 4.899 0 4.829 4.122 8.25 8.935 8.25 4.812 0 8.565-3.438 8.565-8.25 0-2.939-1.466-4.482-3.006-6.102-1.61-1.694-3.479-3.476-3.479-7.021z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FlameIcon.defaultProps = {
  className: 'octicon octicon-flame',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FoldIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M10.896 2H8.75V.75a.75.75 0 00-1.5 0V2H5.104a.25.25 0 00-.177.427l2.896 2.896a.25.25 0 00.354 0l2.896-2.896A.25.25 0 0010.896 2zM8.75 15.25a.75.75 0 01-1.5 0V14H5.104a.25.25 0 01-.177-.427l2.896-2.896a.25.25 0 01.354 0l2.896 2.896a.25.25 0 01-.177.427H8.75v1.25zm-6.5-6.5a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM6 8a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5A.75.75 0 016 8zm2.25.75a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM12 8a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5A.75.75 0 0112 8zm2.25.75a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 15a.75.75 0 01.53.22l3.25 3.25a.75.75 0 11-1.06 1.06L12 16.81l-2.72 2.72a.75.75 0 01-1.06-1.06l3.25-3.25A.75.75 0 0112 15z\"></path><path fill-rule=\"evenodd\" d=\"M12 15.75a.75.75 0 01.75.75v5.75a.75.75 0 01-1.5 0V16.5a.75.75 0 01.75-.75zm.53-6.97a.75.75 0 01-1.06 0L8.22 5.53a.75.75 0 011.06-1.06L12 7.19l2.72-2.72a.75.75 0 111.06 1.06l-3.25 3.25z\"></path><path fill-rule=\"evenodd\" d=\"M12 8.5a.75.75 0 01-.75-.75v-6a.75.75 0 011.5 0v6a.75.75 0 01-.75.75zM10.75 12a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FoldIcon.defaultProps = {
  className: 'octicon octicon-fold',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FoldDownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8.177 14.323l2.896-2.896a.25.25 0 00-.177-.427H8.75V7.764a.75.75 0 10-1.5 0V11H5.104a.25.25 0 00-.177.427l2.896 2.896a.25.25 0 00.354 0zM2.25 5a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM6 4.25a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5a.75.75 0 01.75.75zM8.25 5a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM12 4.25a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5a.75.75 0 01.75.75zm2.25.75a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 19a.75.75 0 01-.53-.22l-3.25-3.25a.75.75 0 111.06-1.06L12 17.19l2.72-2.72a.75.75 0 111.06 1.06l-3.25 3.25A.75.75 0 0112 19z\"></path><path fill-rule=\"evenodd\" d=\"M12 18a.75.75 0 01-.75-.75v-7.5a.75.75 0 011.5 0v7.5A.75.75 0 0112 18zM10.75 6a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1A.75.75 0 012.75 6zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1A.75.75 0 016.75 6zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FoldDownIcon.defaultProps = {
  className: 'octicon octicon-fold-down',
  size: 16,
  verticalAlign: 'text-bottom'
};

function FoldUpIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M7.823 1.677L4.927 4.573A.25.25 0 005.104 5H7.25v3.236a.75.75 0 101.5 0V5h2.146a.25.25 0 00.177-.427L8.177 1.677a.25.25 0 00-.354 0zM13.75 11a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zm-3.75.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM7.75 11a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM4 11.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM1.75 11a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.47 5.22a.75.75 0 011.06 0l3.25 3.25a.75.75 0 01-1.06 1.06L12 6.81 9.28 9.53a.75.75 0 01-1.06-1.06l3.25-3.25z\"></path><path fill-rule=\"evenodd\" d=\"M12 5.5a.75.75 0 01.75.75v8a.75.75 0 01-1.5 0v-8A.75.75 0 0112 5.5zM10.75 18a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

FoldUpIcon.defaultProps = {
  className: 'octicon octicon-fold-up',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GearIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.429 1.525a6.593 6.593 0 011.142 0c.036.003.108.036.137.146l.289 1.105c.147.56.55.967.997 1.189.174.086.341.183.501.29.417.278.97.423 1.53.27l1.102-.303c.11-.03.175.016.195.046.219.31.41.641.573.989.014.031.022.11-.059.19l-.815.806c-.411.406-.562.957-.53 1.456a4.588 4.588 0 010 .582c-.032.499.119 1.05.53 1.456l.815.806c.08.08.073.159.059.19a6.494 6.494 0 01-.573.99c-.02.029-.086.074-.195.045l-1.103-.303c-.559-.153-1.112-.008-1.529.27-.16.107-.327.204-.5.29-.449.222-.851.628-.998 1.189l-.289 1.105c-.029.11-.101.143-.137.146a6.613 6.613 0 01-1.142 0c-.036-.003-.108-.037-.137-.146l-.289-1.105c-.147-.56-.55-.967-.997-1.189a4.502 4.502 0 01-.501-.29c-.417-.278-.97-.423-1.53-.27l-1.102.303c-.11.03-.175-.016-.195-.046a6.492 6.492 0 01-.573-.989c-.014-.031-.022-.11.059-.19l.815-.806c.411-.406.562-.957.53-1.456a4.587 4.587 0 010-.582c.032-.499-.119-1.05-.53-1.456l-.815-.806c-.08-.08-.073-.159-.059-.19a6.44 6.44 0 01.573-.99c.02-.029.086-.075.195-.045l1.103.303c.559.153 1.112.008 1.529-.27.16-.107.327-.204.5-.29.449-.222.851-.628.998-1.189l.289-1.105c.029-.11.101-.143.137-.146zM8 0c-.236 0-.47.01-.701.03-.743.065-1.29.615-1.458 1.261l-.29 1.106c-.017.066-.078.158-.211.224a5.994 5.994 0 00-.668.386c-.123.082-.233.09-.3.071L3.27 2.776c-.644-.177-1.392.02-1.82.63a7.977 7.977 0 00-.704 1.217c-.315.675-.111 1.422.363 1.891l.815.806c.05.048.098.147.088.294a6.084 6.084 0 000 .772c.01.147-.038.246-.088.294l-.815.806c-.474.469-.678 1.216-.363 1.891.2.428.436.835.704 1.218.428.609 1.176.806 1.82.63l1.103-.303c.066-.019.176-.011.299.071.213.143.436.272.668.386.133.066.194.158.212.224l.289 1.106c.169.646.715 1.196 1.458 1.26a8.094 8.094 0 001.402 0c.743-.064 1.29-.614 1.458-1.26l.29-1.106c.017-.066.078-.158.211-.224a5.98 5.98 0 00.668-.386c.123-.082.233-.09.3-.071l1.102.302c.644.177 1.392-.02 1.82-.63.268-.382.505-.789.704-1.217.315-.675.111-1.422-.364-1.891l-.814-.806c-.05-.048-.098-.147-.088-.294a6.1 6.1 0 000-.772c-.01-.147.039-.246.088-.294l.814-.806c.475-.469.679-1.216.364-1.891a7.992 7.992 0 00-.704-1.218c-.428-.609-1.176-.806-1.82-.63l-1.103.303c-.066.019-.176.011-.299-.071a5.991 5.991 0 00-.668-.386c-.133-.066-.194-.158-.212-.224L10.16 1.29C9.99.645 9.444.095 8.701.031A8.094 8.094 0 008 0zm1.5 8a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM11 8a3 3 0 11-6 0 3 3 0 016 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M16 12a4 4 0 11-8 0 4 4 0 018 0zm-1.5 0a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z\"></path><path fill-rule=\"evenodd\" d=\"M12 1c-.268 0-.534.01-.797.028-.763.055-1.345.617-1.512 1.304l-.352 1.45c-.02.078-.09.172-.225.22a8.45 8.45 0 00-.728.303c-.13.06-.246.044-.315.002l-1.274-.776c-.604-.368-1.412-.354-1.99.147-.403.348-.78.726-1.129 1.128-.5.579-.515 1.387-.147 1.99l.776 1.275c.042.069.059.185-.002.315-.112.237-.213.48-.302.728-.05.135-.143.206-.221.225l-1.45.352c-.687.167-1.249.749-1.304 1.512a11.149 11.149 0 000 1.594c.055.763.617 1.345 1.304 1.512l1.45.352c.078.02.172.09.22.225.09.248.191.491.303.729.06.129.044.245.002.314l-.776 1.274c-.368.604-.354 1.412.147 1.99.348.403.726.78 1.128 1.129.579.5 1.387.515 1.99.147l1.275-.776c.069-.042.185-.059.315.002.237.112.48.213.728.302.135.05.206.143.225.221l.352 1.45c.167.687.749 1.249 1.512 1.303a11.125 11.125 0 001.594 0c.763-.054 1.345-.616 1.512-1.303l.352-1.45c.02-.078.09-.172.225-.22.248-.09.491-.191.729-.303.129-.06.245-.044.314-.002l1.274.776c.604.368 1.412.354 1.99-.147.403-.348.78-.726 1.129-1.128.5-.579.515-1.387.147-1.99l-.776-1.275c-.042-.069-.059-.185.002-.315.112-.237.213-.48.302-.728.05-.135.143-.206.221-.225l1.45-.352c.687-.167 1.249-.749 1.303-1.512a11.125 11.125 0 000-1.594c-.054-.763-.616-1.345-1.303-1.512l-1.45-.352c-.078-.02-.172-.09-.22-.225a8.469 8.469 0 00-.303-.728c-.06-.13-.044-.246-.002-.315l.776-1.274c.368-.604.354-1.412-.147-1.99-.348-.403-.726-.78-1.128-1.129-.579-.5-1.387-.515-1.99-.147l-1.275.776c-.069.042-.185.059-.315-.002a8.465 8.465 0 00-.728-.302c-.135-.05-.206-.143-.225-.221l-.352-1.45c-.167-.687-.749-1.249-1.512-1.304A11.149 11.149 0 0012 1zm-.69 1.525a9.648 9.648 0 011.38 0c.055.004.135.05.162.16l.351 1.45c.153.628.626 1.08 1.173 1.278.205.074.405.157.6.249a1.832 1.832 0 001.733-.074l1.275-.776c.097-.06.186-.036.228 0 .348.302.674.628.976.976.036.042.06.13 0 .228l-.776 1.274a1.832 1.832 0 00-.074 1.734c.092.195.175.395.248.6.198.547.652 1.02 1.278 1.172l1.45.353c.111.026.157.106.161.161a9.653 9.653 0 010 1.38c-.004.055-.05.135-.16.162l-1.45.351a1.833 1.833 0 00-1.278 1.173 6.926 6.926 0 01-.25.6 1.832 1.832 0 00.075 1.733l.776 1.275c.06.097.036.186 0 .228a9.555 9.555 0 01-.976.976c-.042.036-.13.06-.228 0l-1.275-.776a1.832 1.832 0 00-1.733-.074 6.926 6.926 0 01-.6.248 1.833 1.833 0 00-1.172 1.278l-.353 1.45c-.026.111-.106.157-.161.161a9.653 9.653 0 01-1.38 0c-.055-.004-.135-.05-.162-.16l-.351-1.45a1.833 1.833 0 00-1.173-1.278 6.928 6.928 0 01-.6-.25 1.832 1.832 0 00-1.734.075l-1.274.776c-.097.06-.186.036-.228 0a9.56 9.56 0 01-.976-.976c-.036-.042-.06-.13 0-.228l.776-1.275a1.832 1.832 0 00.074-1.733 6.948 6.948 0 01-.249-.6 1.833 1.833 0 00-1.277-1.172l-1.45-.353c-.111-.026-.157-.106-.161-.161a9.648 9.648 0 010-1.38c.004-.055.05-.135.16-.162l1.45-.351a1.833 1.833 0 001.278-1.173 6.95 6.95 0 01.249-.6 1.832 1.832 0 00-.074-1.734l-.776-1.274c-.06-.097-.036-.186 0-.228.302-.348.628-.674.976-.976.042-.036.13-.06.228 0l1.274.776a1.832 1.832 0 001.734.074 6.95 6.95 0 01.6-.249 1.833 1.833 0 001.172-1.277l.353-1.45c.026-.111.106-.157.161-.161z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GearIcon.defaultProps = {
  className: 'octicon octicon-gear',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GiftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 1.5a1.25 1.25 0 100 2.5h2.309c-.233-.818-.542-1.401-.878-1.793-.43-.502-.915-.707-1.431-.707zM2 2.75c0 .45.108.875.3 1.25h-.55A1.75 1.75 0 000 5.75v2c0 .698.409 1.3 1 1.582v4.918c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 14.25V9.332c.591-.281 1-.884 1-1.582v-2A1.75 1.75 0 0014.25 4h-.55a2.75 2.75 0 00-2.45-4c-.984 0-1.874.42-2.57 1.23A5.086 5.086 0 008 2.274a5.086 5.086 0 00-.68-1.042C6.623.42 5.733 0 4.75 0A2.75 2.75 0 002 2.75zM8.941 4h2.309a1.25 1.25 0 100-2.5c-.516 0-1 .205-1.43.707-.337.392-.646.975-.879 1.793zm-1.84 1.5H1.75a.25.25 0 00-.25.25v2c0 .138.112.25.25.25h5.5V5.5h-.149zm1.649 0V8h5.5a.25.25 0 00.25-.25v-2a.25.25 0 00-.25-.25h-5.5zm0 4h4.75v4.75a.25.25 0 01-.25.25h-4.5v-5zm-1.5 0v5h-4.5a.25.25 0 01-.25-.25V9.5h4.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 3.75c0 .844.279 1.623.75 2.25H2.75A1.75 1.75 0 001 7.75v2.5c0 .698.409 1.3 1 1.582v8.418c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25v-8.418c.591-.281 1-.884 1-1.582v-2.5A1.75 1.75 0 0021.25 6H19.5a3.75 3.75 0 00-3-6c-1.456 0-3.436.901-4.5 3.11C10.936.901 8.955 0 7.5 0a3.75 3.75 0 00-3.75 3.75zM11.22 6c-.287-3.493-2.57-4.5-3.72-4.5a2.25 2.25 0 000 4.5h3.72zm9.28 6v8.25a.25.25 0 01-.25.25h-7.5V12h7.75zm-9.25 8.5V12H3.5v8.25c0 .138.112.25.25.25h7.5zm10-10a.25.25 0 00.25-.25v-2.5a.25.25 0 00-.25-.25h-8.5v3h8.5zm-18.5 0h8.5v-3h-8.5a.25.25 0 00-.25.25v2.5c0 .138.112.25.25.25zm16-6.75A2.25 2.25 0 0116.5 6h-3.72c.287-3.493 2.57-4.5 3.72-4.5a2.25 2.25 0 012.25 2.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GiftIcon.defaultProps = {
  className: 'octicon octicon-gift',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitBranchIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M11.75 2.5a.75.75 0 100 1.5.75.75 0 000-1.5zm-2.25.75a2.25 2.25 0 113 2.122V6A2.5 2.5 0 0110 8.5H6a1 1 0 00-1 1v1.128a2.251 2.251 0 11-1.5 0V5.372a2.25 2.25 0 111.5 0v1.836A2.492 2.492 0 016 7h4a1 1 0 001-1v-.628A2.25 2.25 0 019.5 3.25zM4.25 12a.75.75 0 100 1.5.75.75 0 000-1.5zM3.5 3.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 21a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM2.5 19.25a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zM5.75 6.5a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM2.5 4.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zM18.25 6.5a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM15 4.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M5.75 16.75A.75.75 0 006.5 16V8A.75.75 0 005 8v8c0 .414.336.75.75.75z\"></path><path fill-rule=\"evenodd\" d=\"M17.5 8.75v-1H19v1a3.75 3.75 0 01-3.75 3.75h-7a1.75 1.75 0 00-1.75 1.75H5A3.25 3.25 0 018.25 11h7a2.25 2.25 0 002.25-2.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitBranchIcon.defaultProps = {
  className: 'octicon octicon-git-branch',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitCommitIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.5 7.75a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zm1.43.75a4.002 4.002 0 01-7.86 0H.75a.75.75 0 110-1.5h3.32a4.001 4.001 0 017.86 0h3.32a.75.75 0 110 1.5h-3.32z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M15.5 11.75a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0zm1.444-.75a5.001 5.001 0 00-9.888 0H2.75a.75.75 0 100 1.5h4.306a5.001 5.001 0 009.888 0h4.306a.75.75 0 100-1.5h-4.306z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitCommitIcon.defaultProps = {
  className: 'octicon octicon-git-commit',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitCompareIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M9.573.677L7.177 3.073a.25.25 0 000 .354l2.396 2.396A.25.25 0 0010 5.646V4h1a1 1 0 011 1v5.628a2.251 2.251 0 101.5 0V5A2.5 2.5 0 0011 2.5h-1V.854a.25.25 0 00-.427-.177zM6 12v-1.646a.25.25 0 01.427-.177l2.396 2.396a.25.25 0 010 .354l-2.396 2.396A.25.25 0 016 15.146V13.5H5A2.5 2.5 0 012.5 11V5.372a2.25 2.25 0 111.5 0V11a1 1 0 001 1h1zm6.75 0a.75.75 0 100 1.5.75.75 0 000-1.5zM4 3.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M19.75 17.5a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5zm-3.25 1.75a3.25 3.25 0 116.5 0 3.25 3.25 0 01-6.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M13.905 1.72a.75.75 0 010 1.06L12.685 4h4.065a3.75 3.75 0 013.75 3.75v8.75a.75.75 0 01-1.5 0V7.75a2.25 2.25 0 00-2.25-2.25h-4.064l1.22 1.22a.75.75 0 01-1.061 1.06l-2.5-2.5a.75.75 0 010-1.06l2.5-2.5a.75.75 0 011.06 0zM4.25 6.5a1.75 1.75 0 100-3.5 1.75 1.75 0 000 3.5zM7.5 4.75a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M10.095 22.28a.75.75 0 010-1.06l1.22-1.22H7.25a3.75 3.75 0 01-3.75-3.75V7.5a.75.75 0 011.5 0v8.75a2.25 2.25 0 002.25 2.25h4.064l-1.22-1.22a.75.75 0 111.061-1.06l2.5 2.5a.75.75 0 010 1.06l-2.5 2.5a.75.75 0 01-1.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitCompareIcon.defaultProps = {
  className: 'octicon octicon-git-compare',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitMergeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5 3.254V3.25v.005a.75.75 0 110-.005v.004zm.45 1.9a2.25 2.25 0 10-1.95.218v5.256a2.25 2.25 0 101.5 0V7.123A5.735 5.735 0 009.25 9h1.378a2.251 2.251 0 100-1.5H9.25a4.25 4.25 0 01-3.8-2.346zM12.75 9a.75.75 0 100-1.5.75.75 0 000 1.5zm-8.5 4.5a.75.75 0 100-1.5.75.75 0 000 1.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 21a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM2.5 19.25a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zM5.75 6.5a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM2.5 4.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zM18.25 15a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM15 13.25a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M6.5 7.25c0 2.9 2.35 5.25 5.25 5.25h4.5V14h-4.5A6.75 6.75 0 015 7.25h1.5z\"></path><path fill-rule=\"evenodd\" d=\"M5.75 16.75A.75.75 0 006.5 16V8A.75.75 0 005 8v8c0 .414.336.75.75.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitMergeIcon.defaultProps = {
  className: 'octicon octicon-git-merge',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitPullRequestIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.177 3.073L9.573.677A.25.25 0 0110 .854v4.792a.25.25 0 01-.427.177L7.177 3.427a.25.25 0 010-.354zM3.75 2.5a.75.75 0 100 1.5.75.75 0 000-1.5zm-2.25.75a2.25 2.25 0 113 2.122v5.256a2.251 2.251 0 11-1.5 0V5.372A2.25 2.25 0 011.5 3.25zM11 2.5h-1V4h1a1 1 0 011 1v5.628a2.251 2.251 0 101.5 0V5A2.5 2.5 0 0011 2.5zm1 10.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0zM3.75 12a.75.75 0 100 1.5.75.75 0 000-1.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 3a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5zM1.5 4.75a3.25 3.25 0 116.5 0 3.25 3.25 0 01-6.5 0zM4.75 17.5a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5zM1.5 19.25a3.25 3.25 0 116.5 0 3.25 3.25 0 01-6.5 0zm17.75-1.75a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5zM16 19.25a3.25 3.25 0 116.5 0 3.25 3.25 0 01-6.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M4.75 7.25A.75.75 0 015.5 8v8A.75.75 0 014 16V8a.75.75 0 01.75-.75zm8.655-5.53a.75.75 0 010 1.06L12.185 4h4.065A3.75 3.75 0 0120 7.75v8.75a.75.75 0 01-1.5 0V7.75a2.25 2.25 0 00-2.25-2.25h-4.064l1.22 1.22a.75.75 0 01-1.061 1.06l-2.5-2.5a.75.75 0 010-1.06l2.5-2.5a.75.75 0 011.06 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitPullRequestIcon.defaultProps = {
  className: 'octicon octicon-git-pull-request',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitPullRequestClosedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.72 1.227a.75.75 0 011.06 0l.97.97.97-.97a.75.75 0 111.06 1.061l-.97.97.97.97a.75.75 0 01-1.06 1.06l-.97-.97-.97.97a.75.75 0 11-1.06-1.06l.97-.97-.97-.97a.75.75 0 010-1.06zM12.75 6.5a.75.75 0 00-.75.75v3.378a2.251 2.251 0 101.5 0V7.25a.75.75 0 00-.75-.75zm0 5.5a.75.75 0 100 1.5.75.75 0 000-1.5zM2.5 3.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0zM3.25 1a2.25 2.25 0 00-.75 4.372v5.256a2.251 2.251 0 101.5 0V5.372A2.25 2.25 0 003.25 1zm0 11a.75.75 0 100 1.5.75.75 0 000-1.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M22.266 2.711a.75.75 0 10-1.061-1.06l-1.983 1.983-1.984-1.983a.75.75 0 10-1.06 1.06l1.983 1.983-1.983 1.984a.75.75 0 001.06 1.06l1.984-1.983 1.983 1.983a.75.75 0 001.06-1.06l-1.983-1.984 1.984-1.983z\"></path><path fill-rule=\"evenodd\" d=\"M4.75 1.5a3.25 3.25 0 00-.745 6.414A.758.758 0 004 8v8a.81.81 0 00.005.086A3.251 3.251 0 004.75 22.5a3.25 3.25 0 00.745-6.414A.758.758 0 005.5 16V8a.758.758 0 00-.005-.086A3.251 3.251 0 004.75 1.5zM3 4.75a1.75 1.75 0 113.5 0 1.75 1.75 0 01-3.5 0zm0 14.5a1.75 1.75 0 113.5 0 1.75 1.75 0 01-3.5 0zm13 0a3.251 3.251 0 012.5-3.163V9.625a.75.75 0 011.5 0v6.462a3.251 3.251 0 01-.75 6.413A3.25 3.25 0 0116 19.25zm3.25-1.75a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitPullRequestClosedIcon.defaultProps = {
  className: 'octicon octicon-git-pull-request-closed',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GitPullRequestDraftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 3.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0zM3.25 1a2.25 2.25 0 00-.75 4.372v5.256a2.251 2.251 0 101.5 0V5.372A2.25 2.25 0 003.25 1zm0 11a.75.75 0 100 1.5.75.75 0 000-1.5zm9.5 3a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5zm0-3a.75.75 0 100 1.5.75.75 0 000-1.5z\"></path><path d=\"M14 7.5a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zm0-4.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 1.5a3.25 3.25 0 00-.745 6.414A.758.758 0 004 8v8a.81.81 0 00.005.086A3.251 3.251 0 004.75 22.5a3.25 3.25 0 00.745-6.414A.757.757 0 005.5 16V8a.758.758 0 00-.005-.086A3.251 3.251 0 004.75 1.5zM3 4.75a1.75 1.75 0 113.5 0 1.75 1.75 0 01-3.5 0zm0 14.5a1.75 1.75 0 113.5 0 1.75 1.75 0 01-3.5 0zm13 0a3.25 3.25 0 116.5 0 3.25 3.25 0 01-6.5 0zm3.25-1.75a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5z\"></path><path d=\"M19.25 6a1.75 1.75 0 100-3.5 1.75 1.75 0 000 3.5zM21 11.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GitPullRequestDraftIcon.defaultProps = {
  className: 'octicon octicon-git-pull-request-draft',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GlobeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.543 7.25h2.733c.144-2.074.866-3.756 1.58-4.948.12-.197.237-.381.353-.552a6.506 6.506 0 00-4.666 5.5zm2.733 1.5H1.543a6.506 6.506 0 004.666 5.5 11.13 11.13 0 01-.352-.552c-.715-1.192-1.437-2.874-1.581-4.948zm1.504 0h4.44a9.637 9.637 0 01-1.363 4.177c-.306.51-.612.919-.857 1.215a9.978 9.978 0 01-.857-1.215A9.637 9.637 0 015.78 8.75zm4.44-1.5H5.78a9.637 9.637 0 011.363-4.177c.306-.51.612-.919.857-1.215.245.296.55.705.857 1.215A9.638 9.638 0 0110.22 7.25zm1.504 1.5c-.144 2.074-.866 3.756-1.58 4.948-.12.197-.237.381-.353.552a6.506 6.506 0 004.666-5.5h-2.733zm2.733-1.5h-2.733c-.144-2.074-.866-3.756-1.58-4.948a11.738 11.738 0 00-.353-.552 6.506 6.506 0 014.666 5.5zM8 0a8 8 0 100 16A8 8 0 008 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.513 11.5h4.745c.1-3.037 1.1-5.49 2.093-7.204.39-.672.78-1.233 1.119-1.673C6.11 3.329 2.746 7 2.513 11.5zm4.77 1.5H2.552a9.505 9.505 0 007.918 8.377 15.698 15.698 0 01-1.119-1.673C8.413 18.085 7.47 15.807 7.283 13zm1.504 0h6.426c-.183 2.48-1.02 4.5-1.862 5.951-.476.82-.95 1.455-1.304 1.88L12 20.89l-.047-.057a13.888 13.888 0 01-1.304-1.88C9.807 17.5 8.969 15.478 8.787 13zm6.454-1.5H8.759c.1-2.708.992-4.904 1.89-6.451.476-.82.95-1.455 1.304-1.88L12 3.11l.047.057c.353.426.828 1.06 1.304 1.88.898 1.548 1.79 3.744 1.89 6.452zm1.476 1.5c-.186 2.807-1.13 5.085-2.068 6.704-.39.672-.78 1.233-1.118 1.673A9.505 9.505 0 0021.447 13h-4.731zm4.77-1.5h-4.745c-.1-3.037-1.1-5.49-2.093-7.204-.39-.672-.78-1.233-1.119-1.673 4.36.706 7.724 4.377 7.957 8.877z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GlobeIcon.defaultProps = {
  className: 'octicon octicon-globe',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GrabberIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10 13a1 1 0 100-2 1 1 0 000 2zm-4 0a1 1 0 100-2 1 1 0 000 2zm1-5a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2zm1-5a1 1 0 11-2 0 1 1 0 012 0zM6 5a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M15 18a1 1 0 100-2 1 1 0 000 2zm1-6a1 1 0 11-2 0 1 1 0 012 0zm-7 6a1 1 0 100-2 1 1 0 000 2zm0-5a1 1 0 100-2 1 1 0 000 2zm7-6a1 1 0 11-2 0 1 1 0 012 0zM9 8a1 1 0 100-2 1 1 0 000 2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GrabberIcon.defaultProps = {
  className: 'octicon octicon-grabber',
  size: 16,
  verticalAlign: 'text-bottom'
};

function GraphIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 1.75a.75.75 0 00-1.5 0v12.5c0 .414.336.75.75.75h14.5a.75.75 0 000-1.5H1.5V1.75zm14.28 2.53a.75.75 0 00-1.06-1.06L10 7.94 7.53 5.47a.75.75 0 00-1.06 0L3.22 8.72a.75.75 0 001.06 1.06L7 7.06l2.47 2.47a.75.75 0 001.06 0l5.25-5.25z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M2.5 2.75a.75.75 0 00-1.5 0v18.5c0 .414.336.75.75.75H20a.75.75 0 000-1.5H2.5V2.75z\"></path><path d=\"M22.28 7.78a.75.75 0 00-1.06-1.06l-5.72 5.72-3.72-3.72a.75.75 0 00-1.06 0l-6 6a.75.75 0 101.06 1.06l5.47-5.47 3.72 3.72a.75.75 0 001.06 0l6.25-6.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

GraphIcon.defaultProps = {
  className: 'octicon octicon-graph',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.368 1.01a.75.75 0 01.623.859L6.57 4.5h3.98l.46-2.868a.75.75 0 011.48.237L12.07 4.5h2.18a.75.75 0 010 1.5h-2.42l-.64 4h2.56a.75.75 0 010 1.5h-2.8l-.46 2.869a.75.75 0 01-1.48-.237l.42-2.632H5.45l-.46 2.869a.75.75 0 01-1.48-.237l.42-2.632H1.75a.75.75 0 010-1.5h2.42l.64-4H2.25a.75.75 0 010-1.5h2.8l.46-2.868a.75.75 0 01.858-.622zM9.67 10l.64-4H6.33l-.64 4h3.98z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M9.618 1.76a.75.75 0 01.623.859L9.46 7.5h6.48l.82-5.118a.75.75 0 011.48.237L17.46 7.5h3.79a.75.75 0 010 1.5h-4.03l-.96 6h3.99a.75.75 0 110 1.5h-4.23l-.78 4.869a.75.75 0 01-1.48-.237l.74-4.632H8.02l-.78 4.869a.75.75 0 01-1.48-.237L6.5 16.5H2.745a.75.75 0 010-1.5H6.74l.96-6H3.75a.75.75 0 010-1.5h4.19l.82-5.118a.75.75 0 01.858-.622zM14.741 15l.96-6H9.22l-.96 6h6.48z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HashIcon.defaultProps = {
  className: 'octicon octicon-hash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HeadingIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 2a.75.75 0 01.75.75V7h7V2.75a.75.75 0 011.5 0v10.5a.75.75 0 01-1.5 0V8.5h-7v4.75a.75.75 0 01-1.5 0V2.75A.75.75 0 013.75 2z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6.25 4a.75.75 0 01.75.75V11h10V4.75a.75.75 0 011.5 0v14.5a.75.75 0 01-1.5 0V12.5H7v6.75a.75.75 0 01-1.5 0V4.75A.75.75 0 016.25 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HeadingIcon.defaultProps = {
  className: 'octicon octicon-heading',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HeartIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.25 2.5c-1.336 0-2.75 1.164-2.75 3 0 2.15 1.58 4.144 3.365 5.682A20.565 20.565 0 008 13.393a20.561 20.561 0 003.135-2.211C12.92 9.644 14.5 7.65 14.5 5.5c0-1.836-1.414-3-2.75-3-1.373 0-2.609.986-3.029 2.456a.75.75 0 01-1.442 0C6.859 3.486 5.623 2.5 4.25 2.5zM8 14.25l-.345.666-.002-.001-.006-.003-.018-.01a7.643 7.643 0 01-.31-.17 22.075 22.075 0 01-3.434-2.414C2.045 10.731 0 8.35 0 5.5 0 2.836 2.086 1 4.25 1 5.797 1 7.153 1.802 8 3.02 8.847 1.802 10.203 1 11.75 1 13.914 1 16 2.836 16 5.5c0 2.85-2.045 5.231-3.885 6.818a22.08 22.08 0 01-3.744 2.584l-.018.01-.006.003h-.002L8 14.25zm0 0l.345.666a.752.752 0 01-.69 0L8 14.25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6.736 4C4.657 4 2.5 5.88 2.5 8.514c0 3.107 2.324 5.96 4.861 8.12a29.66 29.66 0 004.566 3.175l.073.041.073-.04c.271-.153.661-.38 1.13-.674.94-.588 2.19-1.441 3.436-2.502 2.537-2.16 4.861-5.013 4.861-8.12C21.5 5.88 19.343 4 17.264 4c-2.106 0-3.801 1.389-4.553 3.643a.75.75 0 01-1.422 0C10.537 5.389 8.841 4 6.736 4zM12 20.703l.343.667a.75.75 0 01-.686 0l.343-.667zM1 8.513C1 5.053 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262a31.146 31.146 0 01-5.233 3.576l-.025.013-.007.003-.002.001-.344-.666-.343.667-.003-.002-.007-.003-.025-.013A29.308 29.308 0 0110 20.408a31.147 31.147 0 01-3.611-2.632C3.8 15.573 1 12.332 1 8.514z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HeartIcon.defaultProps = {
  className: 'octicon octicon-heart',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HeartFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.655 14.916L8 14.25l.345.666a.752.752 0 01-.69 0zm0 0L8 14.25l.345.666.002-.001.006-.003.018-.01a7.643 7.643 0 00.31-.17 22.08 22.08 0 003.433-2.414C13.956 10.731 16 8.35 16 5.5 16 2.836 13.914 1 11.75 1 10.203 1 8.847 1.802 8 3.02 7.153 1.802 5.797 1 4.25 1 2.086 1 0 2.836 0 5.5c0 2.85 2.045 5.231 3.885 6.818a22.075 22.075 0 003.744 2.584l.018.01.006.003h.002z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M14 20.408c-.492.308-.903.546-1.192.709-.153.086-.308.17-.463.252h-.002a.75.75 0 01-.686 0 16.709 16.709 0 01-.465-.252 31.147 31.147 0 01-4.803-3.34C3.8 15.572 1 12.331 1 8.513 1 5.052 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262A31.146 31.146 0 0114 20.408z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HeartFillIcon.defaultProps = {
  className: 'octicon octicon-heart-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HistoryIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.643 3.143L.427 1.927A.25.25 0 000 2.104V5.75c0 .138.112.25.25.25h3.646a.25.25 0 00.177-.427L2.715 4.215a6.5 6.5 0 11-1.18 4.458.75.75 0 10-1.493.154 8.001 8.001 0 101.6-5.684zM7.75 4a.75.75 0 01.75.75v2.992l2.028.812a.75.75 0 01-.557 1.392l-2.5-1A.75.75 0 017 8.25v-3.5A.75.75 0 017.75 4z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M11.998 2.5A9.503 9.503 0 003.378 8H5.75a.75.75 0 010 1.5H2a1 1 0 01-1-1V4.75a.75.75 0 011.5 0v1.697A10.997 10.997 0 0111.998 1C18.074 1 23 5.925 23 12s-4.926 11-11.002 11C6.014 23 1.146 18.223 1 12.275a.75.75 0 011.5-.037 9.5 9.5 0 009.498 9.262c5.248 0 9.502-4.253 9.502-9.5s-4.254-9.5-9.502-9.5z\"></path><path d=\"M12.5 7.25a.75.75 0 00-1.5 0v5.5c0 .27.144.518.378.651l3.5 2a.75.75 0 00.744-1.302L12.5 12.315V7.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HistoryIcon.defaultProps = {
  className: 'octicon octicon-history',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HomeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.156 1.835a.25.25 0 00-.312 0l-5.25 4.2a.25.25 0 00-.094.196v7.019c0 .138.112.25.25.25H5.5V8.25a.75.75 0 01.75-.75h3.5a.75.75 0 01.75.75v5.25h2.75a.25.25 0 00.25-.25V6.23a.25.25 0 00-.094-.195l-5.25-4.2zM6.906.664a1.75 1.75 0 012.187 0l5.25 4.2c.415.332.657.835.657 1.367v7.019A1.75 1.75 0 0113.25 15h-3.5a.75.75 0 01-.75-.75V9H7v5.25a.75.75 0 01-.75.75h-3.5A1.75 1.75 0 011 13.25V6.23c0-.531.242-1.034.657-1.366l5.25-4.2h-.001z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.03 2.59a1.5 1.5 0 011.94 0l7.5 6.363a1.5 1.5 0 01.53 1.144V19.5a1.5 1.5 0 01-1.5 1.5h-5.75a.75.75 0 01-.75-.75V14h-2v6.25a.75.75 0 01-.75.75H4.5A1.5 1.5 0 013 19.5v-9.403c0-.44.194-.859.53-1.144l7.5-6.363zM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 01.75-.75h3.5a.75.75 0 01.75.75v6.25h5v-9.403L12 3.734z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HomeIcon.defaultProps = {
  className: 'octicon octicon-home',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HomeFillIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path d=\"M12.97 2.59a1.5 1.5 0 00-1.94 0l-7.5 6.363A1.5 1.5 0 003 10.097V19.5A1.5 1.5 0 004.5 21h4.75a.75.75 0 00.75-.75V14h4v6.25c0 .414.336.75.75.75h4.75a1.5 1.5 0 001.5-1.5v-9.403a1.5 1.5 0 00-.53-1.144l-7.5-6.363z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HomeFillIcon.defaultProps = {
  className: 'octicon octicon-home-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HorizontalRuleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 7.75A.75.75 0 01.75 7h14.5a.75.75 0 010 1.5H.75A.75.75 0 010 7.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2 12.75a.75.75 0 01.75-.75h18.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HorizontalRuleIcon.defaultProps = {
  className: 'octicon octicon-horizontal-rule',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HourglassIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 1a.75.75 0 000 1.5h.75v1.25a4.75 4.75 0 001.9 3.8l.333.25c.134.1.134.3 0 .4l-.333.25a4.75 4.75 0 00-1.9 3.8v1.25h-.75a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5h-.75v-1.25a4.75 4.75 0 00-1.9-3.8l-.333-.25a.25.25 0 010-.4l.333-.25a4.75 4.75 0 001.9-3.8V2.5h.75a.75.75 0 000-1.5H2.75zM11 2.5H5v1.25a3.25 3.25 0 001.3 2.6l.333.25c.934.7.934 2.1 0 2.8l-.333.25a3.25 3.25 0 00-1.3 2.6v1.25h6v-1.25a3.25 3.25 0 00-1.3-2.6l-.333-.25a1.75 1.75 0 010-2.8l.333-.25a3.25 3.25 0 001.3-2.6V2.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 2a.75.75 0 000 1.5h.75v2.982a4.75 4.75 0 002.215 4.017l2.044 1.29a.25.25 0 010 .422l-2.044 1.29A4.75 4.75 0 005.5 17.518V20.5h-.75a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5h-.75v-2.982a4.75 4.75 0 00-2.215-4.017l-2.044-1.29a.25.25 0 010-.422l2.044-1.29A4.75 4.75 0 0018.5 6.482V3.5h.75a.75.75 0 000-1.5H4.75zM17 3.5H7v2.982A3.25 3.25 0 008.516 9.23l2.044 1.29a1.75 1.75 0 010 2.96l-2.044 1.29A3.25 3.25 0 007 17.518V20.5h10v-2.982a3.25 3.25 0 00-1.516-2.748l-2.044-1.29a1.75 1.75 0 010-2.96l2.044-1.29A3.25 3.25 0 0017 6.482V3.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HourglassIcon.defaultProps = {
  className: 'octicon octicon-hourglass',
  size: 16,
  verticalAlign: 'text-bottom'
};

function HubotIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 8a8 8 0 1116 0v5.25a.75.75 0 01-1.5 0V8a6.5 6.5 0 10-13 0v5.25a.75.75 0 01-1.5 0V8zm5.5 4.25a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75zM3 6.75C3 5.784 3.784 5 4.75 5h6.5c.966 0 1.75.784 1.75 1.75v1.5A1.75 1.75 0 0111.25 10h-6.5A1.75 1.75 0 013 8.25v-1.5zm1.47-.53a.75.75 0 011.06 0l.97.97.97-.97a.75.75 0 011.06 0l.97.97.97-.97a.75.75 0 111.06 1.06l-1.5 1.5a.75.75 0 01-1.06 0L8 7.81l-.97.97a.75.75 0 01-1.06 0l-1.5-1.5a.75.75 0 010-1.06z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M0 13C0 6.373 5.373 1 12 1s12 5.373 12 12v8.657a.75.75 0 01-1.5 0V13c0-5.799-4.701-10.5-10.5-10.5S1.5 7.201 1.5 13v8.657a.75.75 0 01-1.5 0V13z\"></path><path d=\"M8 19.75a.75.75 0 01.75-.75h6.5a.75.75 0 010 1.5h-6.5a.75.75 0 01-.75-.75z\"></path><path fill-rule=\"evenodd\" d=\"M5.25 9.5a1.75 1.75 0 00-1.75 1.75v3.5c0 .966.784 1.75 1.75 1.75h13.5a1.75 1.75 0 001.75-1.75v-3.5a1.75 1.75 0 00-1.75-1.75H5.25zm.22 1.47a.75.75 0 011.06 0L9 13.44l2.47-2.47a.75.75 0 011.06 0L15 13.44l2.47-2.47a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0L12 12.56l-2.47 2.47a.75.75 0 01-1.06 0l-3-3a.75.75 0 010-1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

HubotIcon.defaultProps = {
  className: 'octicon octicon-hubot',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ImageIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h.94a.76.76 0 01.03-.03l6.077-6.078a1.75 1.75 0 012.412-.06L14.5 10.31V2.75a.25.25 0 00-.25-.25H1.75zm12.5 11H4.81l5.048-5.047a.25.25 0 01.344-.009l4.298 3.889v.917a.25.25 0 01-.25.25zm1.75-.25V2.75A1.75 1.75 0 0014.25 1H1.75A1.75 1.75 0 000 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25zM5.5 6a.5.5 0 11-1 0 .5.5 0 011 0zM7 6a2 2 0 11-4 0 2 2 0 014 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M19.25 4.5H4.75a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h.19l9.823-9.823a1.75 1.75 0 012.475 0l2.262 2.262V4.75a.25.25 0 00-.25-.25zm.25 9.56l-3.323-3.323a.25.25 0 00-.354 0L7.061 19.5H19.25a.25.25 0 00.25-.25v-5.19zM4.75 3A1.75 1.75 0 003 4.75v14.5c0 .966.784 1.75 1.75 1.75h14.5A1.75 1.75 0 0021 19.25V4.75A1.75 1.75 0 0019.25 3H4.75zM8.5 9.5a1 1 0 100-2 1 1 0 000 2zm0 1.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ImageIcon.defaultProps = {
  className: 'octicon octicon-image',
  size: 16,
  verticalAlign: 'text-bottom'
};

function InboxIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.8 2.06A1.75 1.75 0 014.41 1h7.18c.7 0 1.333.417 1.61 1.06l2.74 6.395a.75.75 0 01.06.295v4.5A1.75 1.75 0 0114.25 15H1.75A1.75 1.75 0 010 13.25v-4.5a.75.75 0 01.06-.295L2.8 2.06zm1.61.44a.25.25 0 00-.23.152L1.887 8H4.75a.75.75 0 01.6.3L6.625 10h2.75l1.275-1.7a.75.75 0 01.6-.3h2.863L11.82 2.652a.25.25 0 00-.23-.152H4.41zm10.09 7h-2.875l-1.275 1.7a.75.75 0 01-.6.3h-3.5a.75.75 0 01-.6-.3L4.375 9.5H1.5v3.75c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V9.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.801 3.57A1.75 1.75 0 016.414 2.5h11.174c.702 0 1.337.42 1.611 1.067l3.741 8.828c.04.092.06.192.06.293v7.562A1.75 1.75 0 0121.25 22H2.75A1.75 1.75 0 011 20.25v-7.5c0-.1.02-.199.059-.291L4.8 3.571zM6.414 4a.25.25 0 00-.23.153L2.88 12H8a.75.75 0 01.648.372L10.18 15h3.638l1.533-2.628a.75.75 0 01.64-.372l5.13-.051-3.304-7.797a.25.25 0 00-.23-.152H6.414zM21.5 13.445l-5.067.05-1.535 2.633a.75.75 0 01-.648.372h-4.5a.75.75 0 01-.648-.372L7.57 13.5H2.5v6.75c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-6.805z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

InboxIcon.defaultProps = {
  className: 'octicon octicon-inbox',
  size: 16,
  verticalAlign: 'text-bottom'
};

function InfinityIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.5 6c-1.086 0-2 .914-2 2 0 1.086.914 2 2 2 .525 0 1.122-.244 1.825-.727.51-.35 1.025-.79 1.561-1.273-.536-.483-1.052-.922-1.56-1.273C4.621 6.244 4.025 6 3.5 6zm4.5.984c-.59-.533-1.204-1.066-1.825-1.493-.797-.548-1.7-.991-2.675-.991C1.586 4.5 0 6.086 0 8s1.586 3.5 3.5 3.5c.975 0 1.878-.444 2.675-.991.621-.427 1.235-.96 1.825-1.493.59.533 1.204 1.066 1.825 1.493.797.547 1.7.991 2.675.991 1.914 0 3.5-1.586 3.5-3.5s-1.586-3.5-3.5-3.5c-.975 0-1.878.443-2.675.991-.621.427-1.235.96-1.825 1.493zM9.114 8c.536.483 1.052.922 1.56 1.273.704.483 1.3.727 1.826.727 1.086 0 2-.914 2-2 0-1.086-.914-2-2-2-.525 0-1.122.244-1.825.727-.51.35-1.025.79-1.561 1.273z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.25 8.5c-2.032 0-3.75 1.895-3.75 3.75S3.218 16 5.25 16c1.017 0 2.014-.457 3.062-1.253.89-.678 1.758-1.554 2.655-2.497-.897-.943-1.765-1.82-2.655-2.497C7.264 8.957 6.267 8.5 5.25 8.5zM12 11.16c-.887-.933-1.813-1.865-2.78-2.6C8.048 7.667 6.733 7 5.25 7 2.343 7 0 9.615 0 12.25s2.343 5.25 5.25 5.25c1.483 0 2.798-.668 3.97-1.56.967-.735 1.893-1.667 2.78-2.6.887.933 1.813 1.865 2.78 2.6 1.172.892 2.487 1.56 3.97 1.56 2.907 0 5.25-2.615 5.25-5.25S21.657 7 18.75 7c-1.483 0-2.798.668-3.97 1.56-.967.735-1.893 1.667-2.78 2.6zm1.033 1.09c.897.943 1.765 1.82 2.655 2.497C16.736 15.543 17.733 16 18.75 16c2.032 0 3.75-1.895 3.75-3.75S20.782 8.5 18.75 8.5c-1.017 0-2.014.457-3.062 1.253-.89.678-1.758 1.554-2.655 2.497z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

InfinityIcon.defaultProps = {
  className: 'octicon octicon-infinity',
  size: 16,
  verticalAlign: 'text-bottom'
};

function InfoIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8zm6.5-.25A.75.75 0 017.25 7h1a.75.75 0 01.75.75v2.75h.25a.75.75 0 010 1.5h-2a.75.75 0 010-1.5h.25v-2h-.25a.75.75 0 01-.75-.75zM8 6a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M13 7.5a1 1 0 11-2 0 1 1 0 012 0zm-3 3.75a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v4.25h.75a.75.75 0 010 1.5h-3a.75.75 0 010-1.5h.75V12h-.75a.75.75 0 01-.75-.75z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

InfoIcon.defaultProps = {
  className: 'octicon octicon-info',
  size: 16,
  verticalAlign: 'text-bottom'
};

function IssueClosedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M11.28 6.78a.75.75 0 00-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l3.5-3.5z\"></path><path fill-rule=\"evenodd\" d=\"M16 8A8 8 0 110 8a8 8 0 0116 0zm-1.5 0a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.28 9.28a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

IssueClosedIcon.defaultProps = {
  className: 'octicon octicon-issue-closed',
  size: 16,
  verticalAlign: 'text-bottom'
};

function IssueDraftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.749.097a8.054 8.054 0 012.502 0 .75.75 0 11-.233 1.482 6.554 6.554 0 00-2.036 0A.75.75 0 016.749.097zM4.345 1.693A.75.75 0 014.18 2.74a6.542 6.542 0 00-1.44 1.44.75.75 0 01-1.212-.883 8.042 8.042 0 011.769-1.77.75.75 0 011.048.166zm7.31 0a.75.75 0 011.048-.165 8.04 8.04 0 011.77 1.769.75.75 0 11-1.214.883 6.542 6.542 0 00-1.439-1.44.75.75 0 01-.165-1.047zM.955 6.125a.75.75 0 01.624.857 6.554 6.554 0 000 2.036.75.75 0 01-1.482.233 8.054 8.054 0 010-2.502.75.75 0 01.858-.624zm14.09 0a.75.75 0 01.858.624 8.057 8.057 0 010 2.502.75.75 0 01-1.482-.233 6.55 6.55 0 000-2.036.75.75 0 01.624-.857zm-13.352 5.53a.75.75 0 011.048.165 6.542 6.542 0 001.439 1.44.75.75 0 01-.883 1.212 8.04 8.04 0 01-1.77-1.769.75.75 0 01.166-1.048zm12.614 0a.75.75 0 01.165 1.048 8.038 8.038 0 01-1.769 1.77.75.75 0 11-.883-1.214 6.543 6.543 0 001.44-1.439.75.75 0 011.047-.165zm-8.182 3.39a.75.75 0 01.857-.624 6.55 6.55 0 002.036 0 .75.75 0 01.233 1.482 8.057 8.057 0 01-2.502 0 .75.75 0 01-.624-.858z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10.157 1.154a11.07 11.07 0 013.686 0 .75.75 0 01-.25 1.479 9.568 9.568 0 00-3.186 0 .75.75 0 01-.25-1.48zM6.68 3.205a.75.75 0 01-.177 1.046A9.558 9.558 0 004.25 6.503a.75.75 0 01-1.223-.87 11.058 11.058 0 012.606-2.605.75.75 0 011.046.177zm10.64 0a.75.75 0 011.046-.177 11.058 11.058 0 012.605 2.606.75.75 0 11-1.222.869 9.558 9.558 0 00-2.252-2.252.75.75 0 01-.177-1.046zM2.018 9.543a.75.75 0 01.615.864 9.568 9.568 0 000 3.186.75.75 0 01-1.48.25 11.07 11.07 0 010-3.686.75.75 0 01.865-.614zm19.964 0a.75.75 0 01.864.614 11.066 11.066 0 010 3.686.75.75 0 01-1.479-.25 9.56 9.56 0 000-3.186.75.75 0 01.615-.864zM3.205 17.32a.75.75 0 011.046.177 9.558 9.558 0 002.252 2.252.75.75 0 11-.87 1.223 11.058 11.058 0 01-2.605-2.606.75.75 0 01.177-1.046zm17.59 0a.75.75 0 01.176 1.046 11.057 11.057 0 01-2.605 2.605.75.75 0 11-.869-1.222 9.558 9.558 0 002.252-2.252.75.75 0 011.046-.177zM9.543 21.982a.75.75 0 01.864-.615 9.56 9.56 0 003.186 0 .75.75 0 01.25 1.48 11.066 11.066 0 01-3.686 0 .75.75 0 01-.614-.865z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

IssueDraftIcon.defaultProps = {
  className: 'octicon octicon-issue-draft',
  size: 16,
  verticalAlign: 'text-bottom'
};

function IssueOpenedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8 9.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z\"></path><path fill-rule=\"evenodd\" d=\"M8 0a8 8 0 100 16A8 8 0 008 0zM1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0zM12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zm0 13a2 2 0 100-4 2 2 0 000 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

IssueOpenedIcon.defaultProps = {
  className: 'octicon octicon-issue-opened',
  size: 16,
  verticalAlign: 'text-bottom'
};

function IssueReopenedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M5.029 2.217a6.5 6.5 0 019.437 5.11.75.75 0 101.492-.154 8 8 0 00-14.315-4.03L.427 1.927A.25.25 0 000 2.104V5.75A.25.25 0 00.25 6h3.646a.25.25 0 00.177-.427L2.715 4.215a6.491 6.491 0 012.314-1.998zM1.262 8.169a.75.75 0 00-1.22.658 8.001 8.001 0 0014.315 4.03l1.216 1.216a.25.25 0 00.427-.177V10.25a.25.25 0 00-.25-.25h-3.646a.25.25 0 00-.177.427l1.358 1.358a6.501 6.501 0 01-11.751-3.11.75.75 0 00-.272-.506z\"></path><path d=\"M9.06 9.06a1.5 1.5 0 11-2.12-2.12 1.5 1.5 0 012.12 2.12z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M3.38 8A9.502 9.502 0 0112 2.5a9.502 9.502 0 019.215 7.182.75.75 0 101.456-.364C21.473 4.539 17.15 1 12 1a10.995 10.995 0 00-9.5 5.452V4.75a.75.75 0 00-1.5 0V8.5a1 1 0 001 1h3.75a.75.75 0 000-1.5H3.38zm-.595 6.318a.75.75 0 00-1.455.364C2.527 19.461 6.85 23 12 23c4.052 0 7.592-2.191 9.5-5.451v1.701a.75.75 0 001.5 0V15.5a1 1 0 00-1-1h-3.75a.75.75 0 000 1.5h2.37A9.502 9.502 0 0112 21.5c-4.446 0-8.181-3.055-9.215-7.182z\"></path><path d=\"M13.414 13.414a2 2 0 11-2.828-2.828 2 2 0 012.828 2.828z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

IssueReopenedIcon.defaultProps = {
  className: 'octicon octicon-issue-reopened',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ItalicIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6 2.75A.75.75 0 016.75 2h6.5a.75.75 0 010 1.5h-2.505l-3.858 9H9.25a.75.75 0 010 1.5h-6.5a.75.75 0 010-1.5h2.505l3.858-9H6.75A.75.75 0 016 2.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10 4.75a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-3.514l-5.828 13h3.342a.75.75 0 010 1.5h-8.5a.75.75 0 010-1.5h3.514l5.828-13H10.75a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ItalicIcon.defaultProps = {
  className: 'octicon octicon-italic',
  size: 16,
  verticalAlign: 'text-bottom'
};

function IterationsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M2.5 7.25a4.75 4.75 0 019.5 0 .75.75 0 001.5 0 6.25 6.25 0 10-6.25 6.25H12v2.146c0 .223.27.335.427.177l2.896-2.896a.25.25 0 000-.354l-2.896-2.896a.25.25 0 00-.427.177V12H7.25A4.75 4.75 0 012.5 7.25z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M2.5 10.5a8 8 0 1116 0 .75.75 0 001.5 0 9.5 9.5 0 10-9.5 9.5h10.94l-2.72 2.72a.75.75 0 101.06 1.06l3.735-3.735c.44-.439.44-1.151 0-1.59L19.78 14.72a.75.75 0 00-1.06 1.06l2.72 2.72H10.5a8 8 0 01-8-8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

IterationsIcon.defaultProps = {
  className: 'octicon octicon-iterations',
  size: 16,
  verticalAlign: 'text-bottom'
};

function KebabHorizontalIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM1.5 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm13 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6 12a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 11-4 0 2 2 0 014 0zm6 2a2 2 0 100-4 2 2 0 000 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

KebabHorizontalIcon.defaultProps = {
  className: 'octicon octicon-kebab-horizontal',
  size: 16,
  verticalAlign: 'text-bottom'
};

function KeyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.5 5.5a4 4 0 112.731 3.795.75.75 0 00-.768.18L7.44 10.5H6.25a.75.75 0 00-.75.75v1.19l-.06.06H4.25a.75.75 0 00-.75.75v1.19l-.06.06H1.75a.25.25 0 01-.25-.25v-1.69l5.024-5.023a.75.75 0 00.181-.768A3.995 3.995 0 016.5 5.5zm4-5.5a5.5 5.5 0 00-5.348 6.788L.22 11.72a.75.75 0 00-.22.53v2C0 15.216.784 16 1.75 16h2a.75.75 0 00.53-.22l.5-.5a.75.75 0 00.22-.53V14h.75a.75.75 0 00.53-.22l.5-.5a.75.75 0 00.22-.53V12h.75a.75.75 0 00.53-.22l.932-.932A5.5 5.5 0 1010.5 0zm.5 6a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M16.75 8.5a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z\"></path><path fill-rule=\"evenodd\" d=\"M15.75 0a8.25 8.25 0 00-7.851 10.79L.513 18.178A1.75 1.75 0 000 19.414v2.836C0 23.217.784 24 1.75 24h1.5A1.75 1.75 0 005 22.25v-1a.25.25 0 01.25-.25h2.735a.75.75 0 00.545-.22l.214-.213A.875.875 0 009 19.948V18.5a.25.25 0 01.25-.25h1.086c.464 0 .91-.184 1.237-.513l1.636-1.636A8.25 8.25 0 1015.75 0zM9 8.25a6.75 6.75 0 114.288 6.287.75.75 0 00-.804.168l-1.971 1.972a.25.25 0 01-.177.073H9.25A1.75 1.75 0 007.5 18.5v1H5.25a1.75 1.75 0 00-1.75 1.75v1a.25.25 0 01-.25.25h-1.5a.25.25 0 01-.25-.25v-2.836a.25.25 0 01.073-.177l7.722-7.721a.75.75 0 00.168-.804A6.73 6.73 0 019 8.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

KeyIcon.defaultProps = {
  className: 'octicon octicon-key',
  size: 16,
  verticalAlign: 'text-bottom'
};

function KeyAsteriskIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 2.75A2.75 2.75 0 012.75 0h10.5A2.75 2.75 0 0116 2.75v10.5A2.75 2.75 0 0113.25 16H2.75A2.75 2.75 0 010 13.25V2.75zM2.75 1.5c-.69 0-1.25.56-1.25 1.25v10.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25V2.75c0-.69-.56-1.25-1.25-1.25H2.75z\"></path><path d=\"M8 4a.75.75 0 01.75.75V6.7l1.69-.975a.75.75 0 01.75 1.3L9.5 8l1.69.976a.75.75 0 01-.75 1.298L8.75 9.3v1.951a.75.75 0 01-1.5 0V9.299l-1.69.976a.75.75 0 01-.75-1.3L6.5 8l-1.69-.975a.75.75 0 01.75-1.3l1.69.976V4.75A.75.75 0 018 4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

KeyAsteriskIcon.defaultProps = {
  className: 'octicon octicon-key-asterisk',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LawIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.75.75a.75.75 0 00-1.5 0V2h-.984c-.305 0-.604.08-.869.23l-1.288.737A.25.25 0 013.984 3H1.75a.75.75 0 000 1.5h.428L.066 9.192a.75.75 0 00.154.838l.53-.53-.53.53v.001l.002.002.002.002.006.006.016.015.045.04a3.514 3.514 0 00.686.45A4.492 4.492 0 003 11c.88 0 1.556-.22 2.023-.454a3.515 3.515 0 00.686-.45l.045-.04.016-.015.006-.006.002-.002.001-.002L5.25 9.5l.53.53a.75.75 0 00.154-.838L3.822 4.5h.162c.305 0 .604-.08.869-.23l1.289-.737a.25.25 0 01.124-.033h.984V13h-2.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-2.5V3.5h.984a.25.25 0 01.124.033l1.29.736c.264.152.563.231.868.231h.162l-2.112 4.692a.75.75 0 00.154.838l.53-.53-.53.53v.001l.002.002.002.002.006.006.016.015.045.04a3.517 3.517 0 00.686.45A4.492 4.492 0 0013 11c.88 0 1.556-.22 2.023-.454a3.512 3.512 0 00.686-.45l.045-.04.01-.01.006-.005.006-.006.002-.002.001-.002-.529-.531.53.53a.75.75 0 00.154-.838L13.823 4.5h.427a.75.75 0 000-1.5h-2.234a.25.25 0 01-.124-.033l-1.29-.736A1.75 1.75 0 009.735 2H8.75V.75zM1.695 9.227c.285.135.718.273 1.305.273s1.02-.138 1.305-.273L3 6.327l-1.305 2.9zm10 0c.285.135.718.273 1.305.273s1.02-.138 1.305-.273L13 6.327l-1.305 2.9z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.75 2.75a.75.75 0 00-1.5 0V4.5H9.276a1.75 1.75 0 00-.985.303L6.596 5.957A.25.25 0 016.455 6H2.353a.75.75 0 100 1.5H3.93L.563 15.18a.762.762 0 00.21.88c.08.064.161.125.309.221.186.121.452.278.792.433.68.311 1.662.62 2.876.62a6.919 6.919 0 002.876-.62c.34-.155.606-.312.792-.433.15-.097.23-.158.31-.223a.75.75 0 00.209-.878L5.569 7.5h.886c.351 0 .694-.106.984-.303l1.696-1.154A.25.25 0 019.275 6h1.975v14.5H6.763a.75.75 0 000 1.5h10.474a.75.75 0 000-1.5H12.75V6h1.974c.05 0 .1.015.14.043l1.697 1.154c.29.197.633.303.984.303h.886l-3.368 7.68a.75.75 0 00.23.896c.012.009 0 0 .002 0a3.154 3.154 0 00.31.206c.185.112.45.256.79.4a7.343 7.343 0 002.855.568 7.343 7.343 0 002.856-.569c.338-.143.604-.287.79-.399a3.5 3.5 0 00.31-.206.75.75 0 00.23-.896L20.07 7.5h1.578a.75.75 0 000-1.5h-4.102a.25.25 0 01-.14-.043l-1.697-1.154a1.75 1.75 0 00-.984-.303H12.75V2.75zM2.193 15.198a5.418 5.418 0 002.557.635 5.418 5.418 0 002.557-.635L4.75 9.368l-2.557 5.83zm14.51-.024c.082.04.174.083.275.126.53.223 1.305.45 2.272.45a5.846 5.846 0 002.547-.576L19.25 9.367l-2.547 5.807z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LawIcon.defaultProps = {
  className: 'octicon octicon-law',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LightBulbIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5c-2.363 0-4 1.69-4 3.75 0 .984.424 1.625.984 2.304l.214.253c.223.264.47.556.673.848.284.411.537.896.621 1.49a.75.75 0 01-1.484.211c-.04-.282-.163-.547-.37-.847a8.695 8.695 0 00-.542-.68c-.084-.1-.173-.205-.268-.32C3.201 7.75 2.5 6.766 2.5 5.25 2.5 2.31 4.863 0 8 0s5.5 2.31 5.5 5.25c0 1.516-.701 2.5-1.328 3.259-.095.115-.184.22-.268.319-.207.245-.383.453-.541.681-.208.3-.33.565-.37.847a.75.75 0 01-1.485-.212c.084-.593.337-1.078.621-1.489.203-.292.45-.584.673-.848.075-.088.147-.173.213-.253.561-.679.985-1.32.985-2.304 0-2.06-1.637-3.75-4-3.75zM6 15.25a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zM5.75 12a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 2.5c-3.81 0-6.5 2.743-6.5 6.119 0 1.536.632 2.572 1.425 3.56.172.215.347.422.527.635l.096.112c.21.25.427.508.63.774.404.531.783 1.128.995 1.834a.75.75 0 01-1.436.432c-.138-.46-.397-.89-.753-1.357a18.354 18.354 0 00-.582-.714l-.092-.11c-.18-.212-.37-.436-.555-.667C4.87 12.016 4 10.651 4 8.618 4 4.363 7.415 1 12 1s8 3.362 8 7.619c0 2.032-.87 3.397-1.755 4.5-.185.23-.375.454-.555.667l-.092.109c-.21.248-.405.481-.582.714-.356.467-.615.898-.753 1.357a.75.75 0 01-1.437-.432c.213-.706.592-1.303.997-1.834.202-.266.419-.524.63-.774l.095-.112c.18-.213.355-.42.527-.634.793-.99 1.425-2.025 1.425-3.561C18.5 5.243 15.81 2.5 12 2.5zM9.5 21.75a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75zM8.75 18a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LightBulbIcon.defaultProps = {
  className: 'octicon octicon-light-bulb',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LinkIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M14.78 3.653a3.936 3.936 0 115.567 5.567l-3.627 3.627a3.936 3.936 0 01-5.88-.353.75.75 0 00-1.18.928 5.436 5.436 0 008.12.486l3.628-3.628a5.436 5.436 0 10-7.688-7.688l-3 3a.75.75 0 001.06 1.061l3-3z\"></path><path d=\"M7.28 11.153a3.936 3.936 0 015.88.353.75.75 0 001.18-.928 5.436 5.436 0 00-8.12-.486L2.592 13.72a5.436 5.436 0 107.688 7.688l3-3a.75.75 0 10-1.06-1.06l-3 3a3.936 3.936 0 01-5.567-5.568l3.627-3.627z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LinkIcon.defaultProps = {
  className: 'octicon octicon-link',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LinkExternalIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.604 1h4.146a.25.25 0 01.25.25v4.146a.25.25 0 01-.427.177L13.03 4.03 9.28 7.78a.75.75 0 01-1.06-1.06l3.75-3.75-1.543-1.543A.25.25 0 0110.604 1zM3.75 2A1.75 1.75 0 002 3.75v8.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 12.25v-3.5a.75.75 0 00-1.5 0v3.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-8.5a.25.25 0 01.25-.25h3.5a.75.75 0 000-1.5h-3.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M15.5 2.25a.75.75 0 01.75-.75h5.5a.75.75 0 01.75.75v5.5a.75.75 0 01-1.5 0V4.06l-6.22 6.22a.75.75 0 11-1.06-1.06L19.94 3h-3.69a.75.75 0 01-.75-.75z\"></path><path d=\"M2.5 4.25c0-.966.784-1.75 1.75-1.75h8.5a.75.75 0 010 1.5h-8.5a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h15.5a.25.25 0 00.25-.25v-8.5a.75.75 0 011.5 0v8.5a1.75 1.75 0 01-1.75 1.75H4.25a1.75 1.75 0 01-1.75-1.75V4.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LinkExternalIcon.defaultProps = {
  className: 'octicon octicon-link-external',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ListOrderedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.003 2.5a.5.5 0 00-.723-.447l-1.003.5a.5.5 0 00.446.895l.28-.14V6H.5a.5.5 0 000 1h2.006a.5.5 0 100-1h-.503V2.5zM5 3.25a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 015 3.25zm0 5a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 015 8.25zm0 5a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5a.75.75 0 01-.75-.75zM.924 10.32l.003-.004a.851.851 0 01.144-.153A.66.66 0 011.5 10c.195 0 .306.068.374.146a.57.57 0 01.128.376c0 .453-.269.682-.8 1.078l-.035.025C.692 11.98 0 12.495 0 13.5a.5.5 0 00.5.5h2.003a.5.5 0 000-1H1.146c.132-.197.351-.372.654-.597l.047-.035c.47-.35 1.156-.858 1.156-1.845 0-.365-.118-.744-.377-1.038-.268-.303-.658-.484-1.126-.484-.48 0-.84.202-1.068.392a1.858 1.858 0 00-.348.384l-.007.011-.002.004-.001.002-.001.001a.5.5 0 00.851.525zM.5 10.055l-.427-.26.427.26z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ListOrderedIcon.defaultProps = {
  className: 'octicon octicon-list-ordered',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ListUnorderedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 4a1 1 0 100-2 1 1 0 000 2zm3.75-1.5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm0 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm0 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zM3 8a1 1 0 11-2 0 1 1 0 012 0zm-1 6a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4 7a1 1 0 100-2 1 1 0 000 2zm4.75-1.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5 12a1 1 0 11-2 0 1 1 0 012 0zm-1 7a1 1 0 100-2 1 1 0 000 2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ListUnorderedIcon.defaultProps = {
  className: 'octicon octicon-list-unordered',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LocationIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M11.536 3.464a5 5 0 010 7.072L8 14.07l-3.536-3.535a5 5 0 117.072-7.072v.001zm1.06 8.132a6.5 6.5 0 10-9.192 0l3.535 3.536a1.5 1.5 0 002.122 0l3.535-3.536zM8 9a2 2 0 100-4 2 2 0 000 4z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12 13.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z\"></path><path fill-rule=\"evenodd\" d=\"M19.071 3.429C15.166-.476 8.834-.476 4.93 3.429c-3.905 3.905-3.905 10.237 0 14.142l.028.028 5.375 5.375a2.359 2.359 0 003.336 0l5.403-5.403c3.905-3.905 3.905-10.237 0-14.142zM5.99 4.489A8.5 8.5 0 0118.01 16.51l-5.403 5.404a.859.859 0 01-1.214 0l-5.378-5.378-.002-.002-.023-.024a8.5 8.5 0 010-12.02z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LocationIcon.defaultProps = {
  className: 'octicon octicon-location',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LockIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4 4v2h-.25A1.75 1.75 0 002 7.75v5.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-5.5A1.75 1.75 0 0012.25 6H12V4a4 4 0 10-8 0zm6.5 2V4a2.5 2.5 0 00-5 0v2h5zM12 7.5h.25a.25.25 0 01.25.25v5.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-5.5a.25.25 0 01.25-.25H12z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6 9V7.25C6 3.845 8.503 1 12 1s6 2.845 6 6.25V9h.5a2.5 2.5 0 012.5 2.5v8a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 19.5v-8A2.5 2.5 0 015.5 9H6zm1.5-1.75C7.5 4.58 9.422 2.5 12 2.5c2.578 0 4.5 2.08 4.5 4.75V9h-9V7.25zm-3 4.25a1 1 0 011-1h13a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1v-8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LockIcon.defaultProps = {
  className: 'octicon octicon-lock',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LogoGistIcon(props) {
  var svgDataByHeight = { "16": { "width": 25, "path": "<path fill-rule=\"evenodd\" d=\"M4.7 8.73h2.45v4.02c-.55.27-1.64.34-2.53.34-2.56 0-3.47-2.2-3.47-5.05 0-2.85.91-5.06 3.48-5.06 1.28 0 2.06.23 3.28.73V2.66C7.27 2.33 6.25 2 4.63 2 1.13 2 0 4.69 0 8.03c0 3.34 1.11 6.03 4.63 6.03 1.64 0 2.81-.27 3.59-.64V7.73H4.7v1zm6.39 3.72V6.06h-1.05v6.28c0 1.25.58 1.72 1.72 1.72v-.89c-.48 0-.67-.16-.67-.7v-.02zm.25-8.72c0-.44-.33-.78-.78-.78s-.77.34-.77.78.33.78.77.78.78-.34.78-.78zm4.34 5.69c-1.5-.13-1.78-.48-1.78-1.17 0-.77.33-1.34 1.88-1.34 1.05 0 1.66.16 2.27.36v-.94c-.69-.3-1.52-.39-2.25-.39-2.2 0-2.92 1.2-2.92 2.31 0 1.08.47 1.88 2.73 2.08 1.55.13 1.77.63 1.77 1.34 0 .73-.44 1.42-2.06 1.42-1.11 0-1.86-.19-2.33-.36v.94c.5.2 1.58.39 2.33.39 2.38 0 3.14-1.2 3.14-2.41 0-1.28-.53-2.03-2.75-2.23h-.03zm8.58-2.47v-.86h-2.42v-2.5l-1.08.31v2.11l-1.56.44v.48h1.56v5c0 1.53 1.19 2.13 2.5 2.13.19 0 .52-.02.69-.05v-.89c-.19.03-.41.03-.61.03-.97 0-1.5-.39-1.5-1.34V6.94h2.42v.02-.01z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LogoGistIcon.defaultProps = {
  className: 'octicon octicon-logo-gist',
  size: 16,
  verticalAlign: 'text-bottom'
};

function LogoGithubIcon(props) {
  var svgDataByHeight = { "16": { "width": 45, "path": "<path fill-rule=\"evenodd\" d=\"M18.53 12.03h-.02c.009 0 .015.01.024.011h.006l-.01-.01zm.004.011c-.093.001-.327.05-.574.05-.78 0-1.05-.36-1.05-.83V8.13h1.59c.09 0 .16-.08.16-.19v-1.7c0-.09-.08-.17-.16-.17h-1.59V3.96c0-.08-.05-.13-.14-.13h-2.16c-.09 0-.14.05-.14.13v2.17s-1.09.27-1.16.28c-.08.02-.13.09-.13.17v1.36c0 .11.08.19.17.19h1.11v3.28c0 2.44 1.7 2.69 2.86 2.69.53 0 1.17-.17 1.27-.22.06-.02.09-.09.09-.16v-1.5a.177.177 0 00-.146-.18zM42.23 9.84c0-1.81-.73-2.05-1.5-1.97-.6.04-1.08.34-1.08.34v3.52s.49.34 1.22.36c1.03.03 1.36-.34 1.36-2.25zm2.43-.16c0 3.43-1.11 4.41-3.05 4.41-1.64 0-2.52-.83-2.52-.83s-.04.46-.09.52c-.03.06-.08.08-.14.08h-1.48c-.1 0-.19-.08-.19-.17l.02-11.11c0-.09.08-.17.17-.17h2.13c.09 0 .17.08.17.17v3.77s.82-.53 2.02-.53l-.01-.02c1.2 0 2.97.45 2.97 3.88zm-8.72-3.61h-2.1c-.11 0-.17.08-.17.19v5.44s-.55.39-1.3.39-.97-.34-.97-1.09V6.25c0-.09-.08-.17-.17-.17h-2.14c-.09 0-.17.08-.17.17v5.11c0 2.2 1.23 2.75 2.92 2.75 1.39 0 2.52-.77 2.52-.77s.05.39.08.45c.02.05.09.09.16.09h1.34c.11 0 .17-.08.17-.17l.02-7.47c0-.09-.08-.17-.19-.17zm-23.7-.01h-2.13c-.09 0-.17.09-.17.2v7.34c0 .2.13.27.3.27h1.92c.2 0 .25-.09.25-.27V6.23c0-.09-.08-.17-.17-.17zm-1.05-3.38c-.77 0-1.38.61-1.38 1.38 0 .77.61 1.38 1.38 1.38.75 0 1.36-.61 1.36-1.38 0-.77-.61-1.38-1.36-1.38zm16.49-.25h-2.11c-.09 0-.17.08-.17.17v4.09h-3.31V2.6c0-.09-.08-.17-.17-.17h-2.13c-.09 0-.17.08-.17.17v11.11c0 .09.09.17.17.17h2.13c.09 0 .17-.08.17-.17V8.96h3.31l-.02 4.75c0 .09.08.17.17.17h2.13c.09 0 .17-.08.17-.17V2.6c0-.09-.08-.17-.17-.17zM8.81 7.35v5.74c0 .04-.01.11-.06.13 0 0-1.25.89-3.31.89-2.49 0-5.44-.78-5.44-5.92S2.58 1.99 5.1 2c2.18 0 3.06.49 3.2.58.04.05.06.09.06.14L7.94 4.5c0 .09-.09.2-.2.17-.36-.11-.9-.33-2.17-.33-1.47 0-3.05.42-3.05 3.73s1.5 3.7 2.58 3.7c.92 0 1.25-.11 1.25-.11v-2.3H4.88c-.11 0-.19-.08-.19-.17V7.35c0-.09.08-.17.19-.17h3.74c.11 0 .19.08.19.17z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

LogoGithubIcon.defaultProps = {
  className: 'octicon octicon-logo-github',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MailIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2A1.75 1.75 0 000 3.75v.736a.75.75 0 000 .027v7.737C0 13.216.784 14 1.75 14h12.5A1.75 1.75 0 0016 12.25v-8.5A1.75 1.75 0 0014.25 2H1.75zM14.5 4.07v-.32a.25.25 0 00-.25-.25H1.75a.25.25 0 00-.25.25v.32L8 7.88l6.5-3.81zm-13 1.74v6.441c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V5.809L8.38 9.397a.75.75 0 01-.76 0L1.5 5.809z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 3A1.75 1.75 0 000 4.75v14c0 .966.784 1.75 1.75 1.75h20.5A1.75 1.75 0 0024 18.75v-14A1.75 1.75 0 0022.25 3H1.75zM1.5 4.75a.25.25 0 01.25-.25h20.5a.25.25 0 01.25.25v.852l-10.36 7a.25.25 0 01-.28 0l-10.36-7V4.75zm0 2.662V18.75c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V7.412l-9.52 6.433c-.592.4-1.368.4-1.96 0L1.5 7.412z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MailIcon.defaultProps = {
  className: 'octicon octicon-mail',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MarkGithubIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MarkGithubIcon.defaultProps = {
  className: 'octicon octicon-mark-github',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MarkdownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M14.85 3H1.15C.52 3 0 3.52 0 4.15v7.69C0 12.48.52 13 1.15 13h13.69c.64 0 1.15-.52 1.15-1.15v-7.7C16 3.52 15.48 3 14.85 3zM9 11H7V8L5.5 9.92 4 8v3H2V5h2l1.5 2L7 5h2v6zm2.99.5L9.5 8H11V5h2v3h1.5l-2.51 3.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MarkdownIcon.defaultProps = {
  className: 'octicon octicon-markdown',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MegaphoneIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<g fill-rule=\"evenodd\"><path d=\"M3.25 9a.75.75 0 01.75.75c0 2.142.456 3.828.733 4.653a.121.121 0 00.05.064.207.207 0 00.117.033h1.31c.085 0 .18-.042.258-.152a.448.448 0 00.075-.366A16.74 16.74 0 016 9.75a.75.75 0 011.5 0c0 1.588.25 2.926.494 3.85.293 1.113-.504 2.4-1.783 2.4H4.9c-.686 0-1.35-.41-1.589-1.12A16.42 16.42 0 012.5 9.75.75.75 0 013.25 9z\"></path><path d=\"M0 6a4 4 0 014-4h2.75a.75.75 0 01.75.75v6.5a.75.75 0 01-.75.75H4a4 4 0 01-4-4zm4-2.5a2.5 2.5 0 000 5h2v-5H4z\"></path><path d=\"M15.59.082A.75.75 0 0116 .75v10.5a.75.75 0 01-1.189.608l-.002-.001h.001l-.014-.01a5.829 5.829 0 00-.422-.25 10.58 10.58 0 00-1.469-.64C11.576 10.484 9.536 10 6.75 10a.75.75 0 110-1.5c2.964 0 5.174.516 6.658 1.043.423.151.787.302 1.092.443V2.014c-.305.14-.669.292-1.092.443C11.924 2.984 9.713 3.5 6.75 3.5a.75.75 0 110-1.5c2.786 0 4.826-.484 6.155-.957.665-.236 1.154-.47 1.47-.64a5.82 5.82 0 00.421-.25l.014-.01a.75.75 0 01.78-.061zm-.78.06zm.44 11.108l-.44.607.44-.607z\"></path></g>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M22 1.75a.75.75 0 00-1.161-.627c-.047.03-.094.057-.142.085a9.15 9.15 0 01-.49.262c-.441.22-1.11.519-2.002.82-1.78.6-4.45 1.21-7.955 1.21H6.5A5.5 5.5 0 005 14.293v.457c0 3.061.684 5.505 1.061 6.621.24.709.904 1.129 1.6 1.129h2.013c1.294 0 2.1-1.322 1.732-2.453-.412-1.268-.906-3.268-.906-5.547 0-.03-.002-.06-.005-.088 3.382.028 5.965.644 7.703 1.251.89.312 1.559.62 2 .849.084.043.171.096.261.15.357.214.757.455 1.142.25A.75.75 0 0022 16.25V1.75zM10.5 12.912c3.564.029 6.313.678 8.193 1.335.737.258 1.34.517 1.807.74V2.993c-.467.216-1.073.467-1.815.718-1.878.634-4.624 1.26-8.185 1.288v7.913zm-4 1.838v-.25H9c0 2.486.537 4.648.98 6.01a.398.398 0 01-.057.343c-.07.104-.162.147-.249.147H7.661c-.105 0-.161-.058-.179-.109-.344-1.018-.982-3.294-.982-6.141zM6.5 5H9v8H6.5a4 4 0 010-8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MegaphoneIcon.defaultProps = {
  className: 'octicon octicon-megaphone',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MentionIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 2.37a6.5 6.5 0 006.5 11.26.75.75 0 01.75 1.298 8 8 0 113.994-7.273.754.754 0 01.006.095v1.5a2.75 2.75 0 01-5.072 1.475A4 4 0 1112 8v1.25a1.25 1.25 0 002.5 0V7.867a6.5 6.5 0 00-9.75-5.496V2.37zM10.5 8a2.5 2.5 0 10-5 0 2.5 2.5 0 005 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M20.226 7.25a9.498 9.498 0 10-3.477 12.976.75.75 0 01.75 1.299c-5.26 3.037-11.987 1.235-15.024-4.026C-.562 12.24 1.24 5.512 6.501 2.475 11.76-.562 18.488 1.24 21.525 6.501a10.956 10.956 0 011.455 4.826c.013.056.02.113.02.173v2.25a3.5 3.5 0 01-6.623 1.581 5.5 5.5 0 111.112-3.682.76.76 0 01.011.129v1.972a2 2 0 104 0v-1.766a9.452 9.452 0 00-1.274-4.733zM16 12a4 4 0 10-8 0 4 4 0 008 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MentionIcon.defaultProps = {
  className: 'octicon octicon-mention',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MeterIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5a6.5 6.5 0 106.016 4.035.75.75 0 011.388-.57 8 8 0 11-4.37-4.37.75.75 0 01-.569 1.389A6.479 6.479 0 008 1.5zm6.28.22a.75.75 0 010 1.06l-4.063 4.064a2.5 2.5 0 11-1.06-1.06L13.22 1.72a.75.75 0 011.06 0zM7 8a1 1 0 112 0 1 1 0 01-2 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MeterIcon.defaultProps = {
  className: 'octicon octicon-meter',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MilestoneIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.75 0a.75.75 0 01.75.75V3h3.634c.414 0 .814.147 1.13.414l2.07 1.75a1.75 1.75 0 010 2.672l-2.07 1.75a1.75 1.75 0 01-1.13.414H8.5v5.25a.75.75 0 11-1.5 0V10H2.75A1.75 1.75 0 011 8.25v-3.5C1 3.784 1.784 3 2.75 3H7V.75A.75.75 0 017.75 0zm0 8.5h4.384a.25.25 0 00.161-.06l2.07-1.75a.25.25 0 000-.38l-2.07-1.75a.25.25 0 00-.161-.06H2.75a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.75 1a.75.75 0 01.75.75V4h6.532c.42 0 .826.15 1.143.425l3.187 2.75a1.75 1.75 0 010 2.65l-3.187 2.75a1.75 1.75 0 01-1.143.425H12.5v9.25a.75.75 0 01-1.5 0V13H3.75A1.75 1.75 0 012 11.25v-5.5C2 4.783 2.784 4 3.75 4H11V1.75a.75.75 0 01.75-.75zm0 4.5h7.282a.25.25 0 01.163.06l3.188 2.75a.25.25 0 010 .38l-3.188 2.75a.25.25 0 01-.163.06H3.75a.25.25 0 01-.25-.25v-5.5a.25.25 0 01.25-.25h8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MilestoneIcon.defaultProps = {
  className: 'octicon octicon-milestone',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MirrorIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.75 1.75a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM8 4a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 018 4zm.75 3.75a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM8 10a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 018 10zm0 3a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 018 13zm7.547-9.939A.75.75 0 0116 3.75v8.5a.75.75 0 01-1.265.545l-4.5-4.25a.75.75 0 010-1.09l4.5-4.25a.75.75 0 01.812-.144zM11.842 8l2.658 2.51V5.49L11.842 8zM0 12.25a.75.75 0 001.265.545l4.5-4.25a.75.75 0 000-1.09l-4.5-4.25A.75.75 0 000 3.75v8.5zm1.5-6.76L4.158 8 1.5 10.51V5.49z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 10.75a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm0 4a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm0 4a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm0-12a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm0-4a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm9.553 3.314A.75.75 0 0122 6.75v10.5a.75.75 0 01-1.256.554l-5.75-5.25a.75.75 0 010-1.108l5.75-5.25a.75.75 0 01.809-.132zM16.613 12l3.887 3.55v-7.1L16.612 12zM2.447 17.936A.75.75 0 012 17.25V6.75a.75.75 0 011.256-.554l5.75 5.25a.75.75 0 010 1.108l-5.75 5.25a.75.75 0 01-.809.132zM7.387 12L3.5 8.45v7.1L7.388 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MirrorIcon.defaultProps = {
  className: 'octicon octicon-mirror',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MoonIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M9.598 1.591a.75.75 0 01.785-.175 7 7 0 11-8.967 8.967.75.75 0 01.961-.96 5.5 5.5 0 007.046-7.046.75.75 0 01.175-.786zm1.616 1.945a7 7 0 01-7.678 7.678 5.5 5.5 0 107.678-7.678z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M16.5 6c0 5.799-4.701 10.5-10.5 10.5-.426 0-.847-.026-1.26-.075A8.5 8.5 0 1016.425 4.74c.05.413.075.833.075 1.259zm-1.732-2.04A9.08 9.08 0 0114.999 6a9 9 0 01-11.04 8.768l-.004-.002a9.367 9.367 0 01-.78-.218c-.393-.13-.8.21-.67.602a9.938 9.938 0 00.329.855l.004.01A10.002 10.002 0 0012 22a10.002 10.002 0 004.015-19.16l-.01-.005a9.745 9.745 0 00-.855-.328c-.392-.13-.732.276-.602.67a8.934 8.934 0 01.218.779l.002.005z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MoonIcon.defaultProps = {
  className: 'octicon octicon-moon',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MortarBoardIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.693 1.066a.75.75 0 01.614 0l7.25 3.25a.75.75 0 010 1.368L13 6.831v2.794c0 1.024-.81 1.749-1.66 2.173-.893.447-2.075.702-3.34.702-.278 0-.55-.012-.816-.036a.75.75 0 01.133-1.494c.22.02.45.03.683.03 1.082 0 2.025-.221 2.67-.543.69-.345.83-.682.83-.832V7.503L8.307 8.934a.75.75 0 01-.614 0L4 7.28v1.663c.296.105.575.275.812.512.438.438.688 1.059.688 1.796v3a.75.75 0 01-.75.75h-3a.75.75 0 01-.75-.75v-3c0-.737.25-1.358.688-1.796.237-.237.516-.407.812-.512V6.606L.443 5.684a.75.75 0 010-1.368l7.25-3.25zM2.583 5L8 7.428 13.416 5 8 2.572 2.583 5zM2.5 11.25c0-.388.125-.611.25-.735a.704.704 0 01.5-.203c.19 0 .37.071.5.203.125.124.25.347.25.735v2.25H2.5v-2.25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.292 2.06a.75.75 0 00-.584 0L.458 6.81a.75.75 0 000 1.38L4.25 9.793v3.803a2.901 2.901 0 00-1.327.757c-.579.58-.923 1.41-.923 2.43v4.5c0 .248.128.486.335.624.06.04.117.073.22.124.124.062.297.138.52.213.448.149 1.09.288 1.925.288s1.477-.14 1.925-.288c.223-.075.396-.15.52-.213a2.11 2.11 0 00.21-.117A.762.762 0 008 21.28v-4.5c0-1.018-.344-1.85-.923-2.428a2.9 2.9 0 00-1.327-.758v-3.17l5.958 2.516a.75.75 0 00.584 0l5.208-2.2v4.003a2.552 2.552 0 01-.079.085 4.057 4.057 0 01-.849.65c-.826.488-2.255 1.021-4.572 1.021-.612 0-1.162-.037-1.654-.1a.75.75 0 00-.192 1.487c.56.072 1.173.113 1.846.113 2.558 0 4.254-.592 5.334-1.23.538-.316.914-.64 1.163-.896a2.84 2.84 0 00.392-.482h.001A.75.75 0 0019 15v-4.892l4.542-1.917a.75.75 0 000-1.382l-11.25-4.75zM5 15c-.377 0-.745.141-1.017.413-.265.265-.483.7-.483 1.368v4.022c.299.105.797.228 1.5.228s1.201-.123 1.5-.228V16.78c0-.669-.218-1.103-.483-1.368A1.431 1.431 0 005 15zm7-3.564L2.678 7.5 12 3.564 21.322 7.5 12 11.436z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MortarBoardIcon.defaultProps = {
  className: 'octicon octicon-mortar-board',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MultiSelectIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm4 5a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5h-7.5zm0 5a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5h-7.5zM3 8a1 1 0 11-2 0 1 1 0 012 0zm-1 6a1 1 0 100-2 1 1 0 000 2z\"></path><path d=\"M13.314 4.918L11.07 2.417A.25.25 0 0111.256 2h4.488a.25.25 0 01.186.417l-2.244 2.5a.25.25 0 01-.372 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.75 5.5a.75.75 0 000 1.5h10a.75.75 0 000-1.5h-10zm5 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5 12a1 1 0 11-2 0 1 1 0 012 0zm-1 7a1 1 0 100-2 1 1 0 000 2z\"></path><path d=\"M19.309 7.918l-2.245-2.501A.25.25 0 0117.25 5h4.49a.25.25 0 01.185.417l-2.244 2.5a.25.25 0 01-.372 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MultiSelectIcon.defaultProps = {
  className: 'octicon octicon-multi-select',
  size: 16,
  verticalAlign: 'text-bottom'
};

function MuteIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 2.75a.75.75 0 00-1.238-.57L3.472 5H1.75A1.75 1.75 0 000 6.75v2.5C0 10.216.784 11 1.75 11h1.723l3.289 2.82A.75.75 0 008 13.25V2.75zM4.238 6.32L6.5 4.38v7.24L4.238 9.68a.75.75 0 00-.488-.18h-2a.25.25 0 01-.25-.25v-2.5a.25.25 0 01.25-.25h2a.75.75 0 00.488-.18zm7.042-1.1a.75.75 0 10-1.06 1.06L11.94 8l-1.72 1.72a.75.75 0 101.06 1.06L13 9.06l1.72 1.72a.75.75 0 101.06-1.06L14.06 8l1.72-1.72a.75.75 0 00-1.06-1.06L13 6.94l-1.72-1.72z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 3.75a.75.75 0 00-1.255-.555L5.46 8H2.75A1.75 1.75 0 001 9.75v4.5c0 .966.784 1.75 1.75 1.75h2.71l5.285 4.805A.75.75 0 0012 20.25V3.75zM6.255 9.305l4.245-3.86v13.11l-4.245-3.86a.75.75 0 00-.505-.195h-3a.25.25 0 01-.25-.25v-4.5a.25.25 0 01.25-.25h3a.75.75 0 00.505-.195z\"></path><path d=\"M16.28 8.22a.75.75 0 10-1.06 1.06L17.94 12l-2.72 2.72a.75.75 0 101.06 1.06L19 13.06l2.72 2.72a.75.75 0 101.06-1.06L20.06 12l2.72-2.72a.75.75 0 00-1.06-1.06L19 10.94l-2.72-2.72z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

MuteIcon.defaultProps = {
  className: 'octicon octicon-mute',
  size: 16,
  verticalAlign: 'text-bottom'
};

function NoEntryIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M4.25 7.25a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5h-7.5z\"></path><path fill-rule=\"evenodd\" d=\"M16 8A8 8 0 110 8a8 8 0 0116 0zm-1.5 0a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0zM12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zm6.25 11.75a.75.75 0 000-1.5H5.75a.75.75 0 000 1.5h12.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

NoEntryIcon.defaultProps = {
  className: 'octicon octicon-no-entry',
  size: 16,
  verticalAlign: 'text-bottom'
};

function NoEntryFillIcon(props) {
  var svgDataByHeight = { "12": { "width": 12, "path": "<path fill-rule=\"evenodd\" d=\"M6 0a6 6 0 100 12A6 6 0 006 0zm3 5H3v2h6V5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

NoEntryFillIcon.defaultProps = {
  className: 'octicon octicon-no-entry-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function NorthStarIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8.5.75a.75.75 0 00-1.5 0v5.19L4.391 3.33a.75.75 0 10-1.06 1.061L5.939 7H.75a.75.75 0 000 1.5h5.19l-2.61 2.609a.75.75 0 101.061 1.06L7 9.561v5.189a.75.75 0 001.5 0V9.56l2.609 2.61a.75.75 0 101.06-1.061L9.561 8.5h5.189a.75.75 0 000-1.5H9.56l2.61-2.609a.75.75 0 00-1.061-1.06L8.5 5.939V.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12.5 1.25a.75.75 0 00-1.5 0v8.69L6.447 5.385a.75.75 0 10-1.061 1.06L9.94 11H1.25a.75.75 0 000 1.5h8.69l-4.554 4.553a.75.75 0 001.06 1.061L11 13.561v8.689a.75.75 0 001.5 0v-8.69l4.553 4.554a.75.75 0 001.061-1.06L13.561 12.5h8.689a.75.75 0 000-1.5h-8.69l4.554-4.553a.75.75 0 10-1.06-1.061L12.5 9.939V1.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

NorthStarIcon.defaultProps = {
  className: 'octicon octicon-north-star',
  size: 16,
  verticalAlign: 'text-bottom'
};

function NoteIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 3.75C0 2.784.784 2 1.75 2h12.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0114.25 14H1.75A1.75 1.75 0 010 12.25v-8.5zm1.75-.25a.25.25 0 00-.25.25v8.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-8.5a.25.25 0 00-.25-.25H1.75zM3.5 6.25a.75.75 0 01.75-.75h7a.75.75 0 010 1.5h-7a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h4a.75.75 0 000-1.5h-4z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M0 4.75C0 3.784.784 3 1.75 3h20.5c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0122.25 21H1.75A1.75 1.75 0 010 19.25V4.75zm1.75-.25a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V4.75a.25.25 0 00-.25-.25H1.75z\"></path><path fill-rule=\"evenodd\" d=\"M5 8.75A.75.75 0 015.75 8h11.5a.75.75 0 010 1.5H5.75A.75.75 0 015 8.75zm0 4a.75.75 0 01.75-.75h5.5a.75.75 0 010 1.5h-5.5a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

NoteIcon.defaultProps = {
  className: 'octicon octicon-note',
  size: 16,
  verticalAlign: 'text-bottom'
};

function NumberIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.604.089A.75.75 0 016 .75v4.77h.711a.75.75 0 110 1.5H3.759a.75.75 0 110-1.5H4.5V2.15l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM9 4.75A.75.75 0 019.75 4h4a.75.75 0 01.53 1.28l-1.89 1.892c.312.076.604.18.867.319.742.391 1.244 1.063 1.244 2.005 0 .653-.231 1.208-.629 1.627-.386.408-.894.653-1.408.777-1.01.243-2.225.063-3.124-.527a.75.75 0 01.822-1.254c.534.35 1.32.474 1.951.322.306-.073.53-.201.67-.349.129-.136.218-.32.218-.596 0-.308-.123-.509-.444-.678-.373-.197-.98-.318-1.806-.318a.75.75 0 01-.53-1.28l1.72-1.72H9.75A.75.75 0 019 4.75zm-3.587 5.763c-.35-.05-.77.113-.983.572a.75.75 0 11-1.36-.632c.508-1.094 1.589-1.565 2.558-1.425 1 .145 1.872.945 1.872 2.222 0 1.433-1.088 2.192-1.79 2.681-.308.216-.571.397-.772.573H7a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75c0-.69.3-1.211.67-1.61.348-.372.8-.676 1.15-.92.8-.56 1.18-.904 1.18-1.474 0-.473-.267-.69-.587-.737z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.114 2.094a.75.75 0 01.386.656V9h1.252a.75.75 0 110 1.5H5.75a.75.75 0 010-1.5H7V4.103l-.853.533a.75.75 0 01-.795-1.272l2-1.25a.75.75 0 01.762-.02zm4.889 5.66a.75.75 0 01.75-.75h5.232a.75.75 0 01.53 1.28l-2.776 2.777c.55.097 1.057.253 1.492.483.905.477 1.504 1.284 1.504 2.418 0 .966-.471 1.75-1.172 2.27-.687.511-1.587.77-2.521.77-1.367 0-2.274-.528-2.667-.756a.75.75 0 01.755-1.297c.331.193.953.553 1.912.553.673 0 1.243-.188 1.627-.473.37-.275.566-.635.566-1.067 0-.5-.219-.836-.703-1.091-.538-.284-1.375-.443-2.471-.443a.75.75 0 01-.53-1.28l2.643-2.644h-3.421a.75.75 0 01-.75-.75zM7.88 15.215a1.4 1.4 0 00-1.446.83.75.75 0 01-1.37-.61 2.9 2.9 0 012.986-1.71 2.565 2.565 0 011.557.743c.434.446.685 1.058.685 1.778 0 1.641-1.254 2.437-2.12 2.986-.538.341-1.18.694-1.495 1.273H9.75a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75c0-1.799 1.337-2.63 2.243-3.21 1.032-.659 1.55-1.031 1.55-1.8 0-.355-.116-.584-.26-.732a1.068 1.068 0 00-.652-.298z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

NumberIcon.defaultProps = {
  className: 'octicon octicon-number',
  size: 16,
  verticalAlign: 'text-bottom'
};

function OrganizationIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 14.25c0 .138.112.25.25.25H4v-1.25a.75.75 0 01.75-.75h2.5a.75.75 0 01.75.75v1.25h2.25a.25.25 0 00.25-.25V1.75a.25.25 0 00-.25-.25h-8.5a.25.25 0 00-.25.25v12.5zM1.75 16A1.75 1.75 0 010 14.25V1.75C0 .784.784 0 1.75 0h8.5C11.216 0 12 .784 12 1.75v12.5c0 .085-.006.168-.018.25h2.268a.25.25 0 00.25-.25V8.285a.25.25 0 00-.111-.208l-1.055-.703a.75.75 0 11.832-1.248l1.055.703c.487.325.779.871.779 1.456v5.965A1.75 1.75 0 0114.25 16h-3.5a.75.75 0 01-.197-.026c-.099.017-.2.026-.303.026h-3a.75.75 0 01-.75-.75V14h-1v1.25a.75.75 0 01-.75.75h-3zM3 3.75A.75.75 0 013.75 3h.5a.75.75 0 010 1.5h-.5A.75.75 0 013 3.75zM3.75 6a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM3 9.75A.75.75 0 013.75 9h.5a.75.75 0 010 1.5h-.5A.75.75 0 013 9.75zM7.75 9a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM7 6.75A.75.75 0 017.75 6h.5a.75.75 0 010 1.5h-.5A.75.75 0 017 6.75zM7.75 3a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM6.5 9.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM7.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 12.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zm.75-4.25a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 5.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zm-.75-2.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z\"></path><path fill-rule=\"evenodd\" d=\"M3 20a2 2 0 002 2h3.75a.75.75 0 00.75-.75V19h3v2.25c0 .414.336.75.75.75H17c.092 0 .183-.006.272-.018a.758.758 0 00.166.018H21.5a2 2 0 002-2v-7.625a2 2 0 00-.8-1.6l-1-.75a.75.75 0 10-.9 1.2l1 .75a.5.5 0 01.2.4V20a.5.5 0 01-.5.5h-2.563c.041-.16.063-.327.063-.5V3a2 2 0 00-2-2H5a2 2 0 00-2 2v17zm2 .5a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h12a.5.5 0 01.5.5v17a.5.5 0 01-.5.5h-3v-2.25a.75.75 0 00-.75-.75h-4.5a.75.75 0 00-.75.75v2.25H5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

OrganizationIcon.defaultProps = {
  className: 'octicon octicon-organization',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PackageIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.878.392a1.75 1.75 0 00-1.756 0l-5.25 3.045A1.75 1.75 0 001 4.951v6.098c0 .624.332 1.2.872 1.514l5.25 3.045a1.75 1.75 0 001.756 0l5.25-3.045c.54-.313.872-.89.872-1.514V4.951c0-.624-.332-1.2-.872-1.514L8.878.392zM7.875 1.69a.25.25 0 01.25 0l4.63 2.685L8 7.133 3.245 4.375l4.63-2.685zM2.5 5.677v5.372c0 .09.047.171.125.216l4.625 2.683V8.432L2.5 5.677zm6.25 8.271l4.625-2.683a.25.25 0 00.125-.216V5.677L8.75 8.432v5.516z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.876.64a1.75 1.75 0 00-1.75 0l-8.25 4.762a1.75 1.75 0 00-.875 1.515v9.525c0 .625.334 1.203.875 1.515l8.25 4.763a1.75 1.75 0 001.75 0l8.25-4.762a1.75 1.75 0 00.875-1.516V6.917a1.75 1.75 0 00-.875-1.515L12.876.639zm-1 1.298a.25.25 0 01.25 0l7.625 4.402-7.75 4.474-7.75-4.474 7.625-4.402zM3.501 7.64v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947L3.501 7.64zm9.25 13.421l7.625-4.402a.25.25 0 00.125-.216V7.639l-7.75 4.474v8.947z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PackageIcon.defaultProps = {
  className: 'octicon octicon-package',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PackageDependenciesIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.122.392a1.75 1.75 0 011.756 0l5.25 3.045c.54.313.872.89.872 1.514V7.25a.75.75 0 01-1.5 0V5.677L7.75 8.432v6.384a1 1 0 01-1.502.865L.872 12.563A1.75 1.75 0 010 11.049V4.951c0-.624.332-1.2.872-1.514L6.122.392zM7.125 1.69l4.63 2.685L7 7.133 2.245 4.375l4.63-2.685a.25.25 0 01.25 0zM1.5 11.049V5.677l4.75 2.755v5.516l-4.625-2.683a.25.25 0 01-.125-.216zm11.672-.282a.75.75 0 10-1.087-1.034l-2.378 2.5a.75.75 0 000 1.034l2.378 2.5a.75.75 0 101.087-1.034L11.999 13.5h3.251a.75.75 0 000-1.5h-3.251l1.173-1.233z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M9.126.64a1.75 1.75 0 011.75 0l8.25 4.762c.103.06.199.128.286.206a.748.748 0 01.554.96c.023.113.035.23.035.35v3.332a.75.75 0 01-1.5 0V7.64l-7.75 4.474V22.36a.75.75 0 01-1.125.65l-8.75-5.052a1.75 1.75 0 01-.875-1.515V6.917c0-.119.012-.236.035-.35a.748.748 0 01.554-.96 1.75 1.75 0 01.286-.205L9.126.639zM1.501 7.638v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947l-7.75-4.474zm8.5 3.175L2.251 6.34l7.625-4.402a.25.25 0 01.25 0l7.625 4.402-7.75 4.474z\"></path><path d=\"M16.617 17.5l2.895-2.702a.75.75 0 00-1.024-1.096l-4.285 4a.75.75 0 000 1.096l4.285 4a.75.75 0 101.024-1.096L16.617 19h6.633a.75.75 0 000-1.5h-6.633z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PackageDependenciesIcon.defaultProps = {
  className: 'octicon octicon-package-dependencies',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PackageDependentsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.122.392a1.75 1.75 0 011.756 0l5.25 3.045c.54.313.872.89.872 1.514V7.25a.75.75 0 01-1.5 0V5.677L7.75 8.432v6.384a1 1 0 01-1.502.865L.872 12.563A1.75 1.75 0 010 11.049V4.951c0-.624.332-1.2.872-1.514L6.122.392zM7.125 1.69l4.63 2.685L7 7.133 2.245 4.375l4.63-2.685a.25.25 0 01.25 0zM1.5 11.049V5.677l4.75 2.755v5.516l-4.625-2.683a.25.25 0 01-.125-.216zm10.828 3.684a.75.75 0 101.087 1.034l2.378-2.5a.75.75 0 000-1.034l-2.378-2.5a.75.75 0 00-1.087 1.034L13.501 12H10.25a.75.75 0 000 1.5h3.251l-1.173 1.233z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M9.126.64a1.75 1.75 0 011.75 0l8.25 4.762c.103.06.199.128.286.206a.748.748 0 01.554.96c.023.113.035.23.035.35v3.332a.75.75 0 01-1.5 0V7.64l-7.75 4.474V22.36a.75.75 0 01-1.125.65l-8.75-5.052a1.75 1.75 0 01-.875-1.515V6.917c0-.119.012-.236.035-.35a.748.748 0 01.554-.96 1.75 1.75 0 01.286-.205L9.126.639zM1.501 7.638v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947l-7.75-4.474zm8.5 3.175L2.251 6.34l7.625-4.402a.25.25 0 01.25 0l7.625 4.402-7.75 4.474z\"></path><path d=\"M21.347 17.5l-2.894-2.702a.75.75 0 111.023-1.096l4.286 4a.75.75 0 010 1.096l-4.286 4a.75.75 0 11-1.023-1.096L21.347 19h-6.633a.75.75 0 010-1.5h6.633z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PackageDependentsIcon.defaultProps = {
  className: 'octicon octicon-package-dependents',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PaintbrushIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M11.134 1.535C9.722 2.562 8.16 4.057 6.889 5.312 5.8 6.387 5.041 7.401 4.575 8.294a3.745 3.745 0 00-3.227 1.054c-.43.431-.69 1.066-.86 1.657a11.982 11.982 0 00-.358 1.914A21.263 21.263 0 000 15.203v.054l.75-.007-.007.75h.054a14.404 14.404 0 00.654-.012 21.243 21.243 0 001.63-.118c.62-.07 1.3-.18 1.914-.357.592-.17 1.226-.43 1.657-.861a3.745 3.745 0 001.055-3.217c.908-.461 1.942-1.216 3.04-2.3 1.279-1.262 2.764-2.825 3.775-4.249.501-.706.923-1.428 1.125-2.096.2-.659.235-1.469-.368-2.07-.606-.607-1.42-.55-2.069-.34-.66.213-1.376.646-2.076 1.155zm-3.95 8.48a3.76 3.76 0 00-1.19-1.192 9.758 9.758 0 011.161-1.607l1.658 1.658a9.853 9.853 0 01-1.63 1.142zM.742 16l.007-.75-.75.008A.75.75 0 00.743 16zM12.016 2.749c-1.224.89-2.605 2.189-3.822 3.384l1.718 1.718c1.21-1.205 2.51-2.597 3.387-3.833.47-.662.78-1.227.912-1.662.134-.444.032-.551.009-.575h-.001V1.78c-.014-.014-.112-.113-.548.027-.432.14-.995.462-1.655.942zM1.62 13.089a19.56 19.56 0 00-.104 1.395 19.55 19.55 0 001.396-.104 10.528 10.528 0 001.668-.309c.526-.151.856-.325 1.011-.48a2.25 2.25 0 00-3.182-3.182c-.155.155-.329.485-.48 1.01a10.515 10.515 0 00-.309 1.67z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PaintbrushIcon.defaultProps = {
  className: 'octicon octicon-paintbrush',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PaperAirplaneIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.592 2.712L2.38 7.25h4.87a.75.75 0 110 1.5H2.38l-.788 4.538L13.929 8 1.592 2.712zM.989 8L.064 2.68a1.341 1.341 0 011.85-1.462l13.402 5.744a1.13 1.13 0 010 2.076L1.913 14.782a1.341 1.341 0 01-1.85-1.463L.99 8z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.513 1.96a1.374 1.374 0 011.499-.21l19.335 9.215a1.146 1.146 0 010 2.07L3.012 22.25a1.374 1.374 0 01-1.947-1.46L2.49 12 1.065 3.21a1.374 1.374 0 01.448-1.25zm2.375 10.79l-1.304 8.042L21.031 12 2.584 3.208l1.304 8.042h7.362a.75.75 0 010 1.5H3.888z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PaperAirplaneIcon.defaultProps = {
  className: 'octicon octicon-paper-airplane',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PasteIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.962 2.513a.75.75 0 01-.475.949l-.816.272a.25.25 0 00-.171.237V21.25c0 .138.112.25.25.25h14.5a.25.25 0 00.25-.25V3.97a.25.25 0 00-.17-.236l-.817-.272a.75.75 0 01.474-1.424l.816.273A1.75 1.75 0 0121 3.97v17.28A1.75 1.75 0 0119.25 23H4.75A1.75 1.75 0 013 21.25V3.97a1.75 1.75 0 011.197-1.66l.816-.272a.75.75 0 01.949.475z\"></path><path fill-rule=\"evenodd\" d=\"M7 1.75C7 .784 7.784 0 8.75 0h6.5C16.216 0 17 .784 17 1.75v1.5A1.75 1.75 0 0115.25 5h-6.5A1.75 1.75 0 017 3.25v-1.5zm1.75-.25a.25.25 0 00-.25.25v1.5c0 .138.112.25.25.25h6.5a.25.25 0 00.25-.25v-1.5a.25.25 0 00-.25-.25h-6.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PasteIcon.defaultProps = {
  className: 'octicon octicon-paste',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PencilIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M17.263 2.177a1.75 1.75 0 012.474 0l2.586 2.586a1.75 1.75 0 010 2.474L19.53 10.03l-.012.013L8.69 20.378a1.75 1.75 0 01-.699.409l-5.523 1.68a.75.75 0 01-.935-.935l1.673-5.5a1.75 1.75 0 01.466-.756L14.476 4.963l2.787-2.786zm-2.275 4.371l-10.28 9.813a.25.25 0 00-.067.108l-1.264 4.154 4.177-1.271a.25.25 0 00.1-.059l10.273-9.806-2.94-2.939zM19 8.44l2.263-2.262a.25.25 0 000-.354l-2.586-2.586a.25.25 0 00-.354 0L16.061 5.5 19 8.44z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PencilIcon.defaultProps = {
  className: 'octicon octicon-pencil',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PeopleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.5 3.5a2 2 0 100 4 2 2 0 000-4zM2 5.5a3.5 3.5 0 115.898 2.549 5.507 5.507 0 013.034 4.084.75.75 0 11-1.482.235 4.001 4.001 0 00-7.9 0 .75.75 0 01-1.482-.236A5.507 5.507 0 013.102 8.05 3.49 3.49 0 012 5.5zM11 4a.75.75 0 100 1.5 1.5 1.5 0 01.666 2.844.75.75 0 00-.416.672v.352a.75.75 0 00.574.73c1.2.289 2.162 1.2 2.522 2.372a.75.75 0 101.434-.44 5.01 5.01 0 00-2.56-3.012A3 3 0 0011 4z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z\"></path><path d=\"M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PeopleIcon.defaultProps = {
  className: 'octicon octicon-people',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PersonIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.5 5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zm.061 3.073a4 4 0 10-5.123 0 6.004 6.004 0 00-3.431 5.142.75.75 0 001.498.07 4.5 4.5 0 018.99 0 .75.75 0 101.498-.07 6.005 6.005 0 00-3.432-5.142z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 2.5a5.5 5.5 0 00-3.096 10.047 9.005 9.005 0 00-5.9 8.18.75.75 0 001.5.045 7.5 7.5 0 0114.993 0 .75.75 0 101.499-.044 9.005 9.005 0 00-5.9-8.181A5.5 5.5 0 0012 2.5zM8 8a4 4 0 118 0 4 4 0 01-8 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PersonIcon.defaultProps = {
  className: 'octicon octicon-person',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PersonAddIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13.25 0a.75.75 0 01.75.75V2h1.25a.75.75 0 010 1.5H14v1.25a.75.75 0 01-1.5 0V3.5h-1.25a.75.75 0 010-1.5h1.25V.75a.75.75 0 01.75-.75zM5.5 4a2 2 0 100 4 2 2 0 000-4zm2.4 4.548a3.5 3.5 0 10-4.799 0 5.527 5.527 0 00-3.1 4.66.75.75 0 101.498.085A4.01 4.01 0 015.5 9.5a4.01 4.01 0 014.001 3.793.75.75 0 101.498-.086 5.527 5.527 0 00-3.1-4.659z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M19.25 1a.75.75 0 01.75.75V4h2.25a.75.75 0 010 1.5H20v2.25a.75.75 0 01-1.5 0V5.5h-2.25a.75.75 0 010-1.5h2.25V1.75a.75.75 0 01.75-.75zM9 6a3.5 3.5 0 100 7 3.5 3.5 0 000-7zM4 9.5a5 5 0 117.916 4.062 7.973 7.973 0 015.018 7.166.75.75 0 11-1.499.044 6.469 6.469 0 00-12.932 0 .75.75 0 01-1.499-.044 7.973 7.973 0 015.059-7.181A4.993 4.993 0 014 9.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PersonAddIcon.defaultProps = {
  className: 'octicon octicon-person-add',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PersonFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M4.243 4.757a3.757 3.757 0 115.851 3.119 6.006 6.006 0 013.9 5.339.75.75 0 01-.715.784H2.721a.75.75 0 01-.714-.784 6.006 6.006 0 013.9-5.34 3.753 3.753 0 01-1.664-3.118z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12 2.5a5.25 5.25 0 00-2.519 9.857 9.005 9.005 0 00-6.477 8.37.75.75 0 00.727.773H20.27a.75.75 0 00.727-.772 9.005 9.005 0 00-6.477-8.37A5.25 5.25 0 0012 2.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PersonFillIcon.defaultProps = {
  className: 'octicon octicon-person-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PinIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.456.734a1.75 1.75 0 012.826.504l.613 1.327a3.081 3.081 0 002.084 1.707l2.454.584c1.332.317 1.8 1.972.832 2.94L11.06 10l3.72 3.72a.75.75 0 11-1.061 1.06L10 11.06l-2.204 2.205c-.968.968-2.623.5-2.94-.832l-.584-2.454a3.081 3.081 0 00-1.707-2.084l-1.327-.613a1.75 1.75 0 01-.504-2.826L4.456.734zM5.92 1.866a.25.25 0 00-.404-.072L1.794 5.516a.25.25 0 00.072.404l1.328.613A4.582 4.582 0 015.73 9.63l.584 2.454a.25.25 0 00.42.12l5.47-5.47a.25.25 0 00-.12-.42L9.63 5.73a4.581 4.581 0 01-3.098-2.537L5.92 1.866z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.886 1.553a1.75 1.75 0 012.869.604l.633 1.629a5.666 5.666 0 003.725 3.395l3.959 1.131a1.75 1.75 0 01.757 2.92L16.06 15l5.594 5.595a.75.75 0 11-1.06 1.06L15 16.061l-3.768 3.768a1.75 1.75 0 01-2.92-.757l-1.131-3.96a5.667 5.667 0 00-3.395-3.724l-1.63-.633a1.75 1.75 0 01-.603-2.869l6.333-6.333zm6.589 12.912l-.005.005-.005.005-4.294 4.293a.25.25 0 01-.417-.108l-1.13-3.96A7.166 7.166 0 004.33 9.99L2.7 9.356a.25.25 0 01-.086-.41l6.333-6.332a.25.25 0 01.41.086l.633 1.63a7.167 7.167 0 004.71 4.293l3.96 1.131a.25.25 0 01.108.417l-4.293 4.294z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PinIcon.defaultProps = {
  className: 'octicon octicon-pin',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PlayIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zM6.379 5.227A.25.25 0 006 5.442v5.117a.25.25 0 00.379.214l4.264-2.559a.25.25 0 000-.428L6.379 5.227z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M9.5 15.584V8.416a.5.5 0 01.77-.42l5.576 3.583a.5.5 0 010 .842l-5.576 3.584a.5.5 0 01-.77-.42z\"></path><path fill-rule=\"evenodd\" d=\"M12 2.5a9.5 9.5 0 100 19 9.5 9.5 0 000-19zM1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PlayIcon.defaultProps = {
  className: 'octicon octicon-play',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PlugIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.276 3.09a.25.25 0 01.192-.09h.782a.25.25 0 01.25.25v8.5a.25.25 0 01-.25.25h-.782a.25.25 0 01-.192-.09l-.95-1.14a.75.75 0 00-.483-.264l-3.124-.39a.25.25 0 01-.219-.249V5.133a.25.25 0 01.219-.248l3.124-.39a.75.75 0 00.483-.265l.95-1.14zM4 8v1.867a1.75 1.75 0 001.533 1.737l2.83.354.761.912c.332.4.825.63 1.344.63h.782A1.75 1.75 0 0013 11.75V11h2.25a.75.75 0 000-1.5H13v-4h2.25a.75.75 0 000-1.5H13v-.75a1.75 1.75 0 00-1.75-1.75h-.782c-.519 0-1.012.23-1.344.63l-.76.913-2.831.353A1.75 1.75 0 004 5.133V6.5H2.5A2.5 2.5 0 000 9v5.25a.75.75 0 001.5 0V9a1 1 0 011-1H4z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7 11.5v3.848a1.75 1.75 0 001.57 1.74l6.055.627 1.006 1.174a1.75 1.75 0 001.329.611h1.29A1.75 1.75 0 0020 17.75V15.5h3.25a.75.75 0 000-1.5H20V7.5h3.25a.75.75 0 000-1.5H20V3.75A1.75 1.75 0 0018.25 2h-1.29c-.51 0-.996.223-1.329.611l-1.006 1.174-6.055.626A1.75 1.75 0 007 6.151V10H2.937A2.938 2.938 0 000 12.938v8.312a.75.75 0 001.5 0v-8.313c0-.793.644-1.437 1.438-1.437H7zm9.77-7.913a.25.25 0 01.19-.087h1.29a.25.25 0 01.25.25v14a.25.25 0 01-.25.25h-1.29a.25.25 0 01-.19-.087l-1.2-1.401a.75.75 0 00-.493-.258l-6.353-.657a.25.25 0 01-.224-.249V6.152a.25.25 0 01.224-.249l6.353-.657a.75.75 0 00.492-.258l1.201-1.4z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PlugIcon.defaultProps = {
  className: 'octicon octicon-plug',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PlusIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.75 2a.75.75 0 01.75.75V7h4.25a.75.75 0 110 1.5H8.5v4.25a.75.75 0 11-1.5 0V8.5H2.75a.75.75 0 010-1.5H7V2.75A.75.75 0 017.75 2z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.75 4.5a.75.75 0 01.75.75V11h5.75a.75.75 0 010 1.5H12.5v5.75a.75.75 0 01-1.5 0V12.5H5.25a.75.75 0 010-1.5H11V5.25a.75.75 0 01.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PlusIcon.defaultProps = {
  className: 'octicon octicon-plus',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PlusCircleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12.75 7.75a.75.75 0 00-1.5 0v3.5h-3.5a.75.75 0 000 1.5h3.5v3.5a.75.75 0 001.5 0v-3.5h3.5a.75.75 0 000-1.5h-3.5v-3.5z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PlusCircleIcon.defaultProps = {
  className: 'octicon octicon-plus-circle',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ProjectIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 0A1.75 1.75 0 000 1.75v12.5C0 15.216.784 16 1.75 16h12.5A1.75 1.75 0 0016 14.25V1.75A1.75 1.75 0 0014.25 0H1.75zM1.5 1.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25V1.75zM11.75 3a.75.75 0 00-.75.75v7.5a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75zm-8.25.75a.75.75 0 011.5 0v5.5a.75.75 0 01-1.5 0v-5.5zM8 3a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5A.75.75 0 008 3z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.25 6a.75.75 0 00-.75.75v7.5a.75.75 0 001.5 0v-7.5A.75.75 0 007.25 6zM12 6a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-4.5A.75.75 0 0012 6zm4 .75a.75.75 0 011.5 0v9.5a.75.75 0 01-1.5 0v-9.5z\"></path><path fill-rule=\"evenodd\" d=\"M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25h16.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25V3.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ProjectIcon.defaultProps = {
  className: 'octicon octicon-project',
  size: 16,
  verticalAlign: 'text-bottom'
};

function PulseIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6 2a.75.75 0 01.696.471L10 10.731l1.304-3.26A.75.75 0 0112 7h3.25a.75.75 0 010 1.5h-2.742l-1.812 4.528a.75.75 0 01-1.392 0L6 4.77 4.696 8.03A.75.75 0 014 8.5H.75a.75.75 0 010-1.5h2.742l1.812-4.529A.75.75 0 016 2z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M9.002 2.5a.75.75 0 01.691.464l6.302 15.305 2.56-6.301a.75.75 0 01.695-.468h4a.75.75 0 010 1.5h-3.495l-3.06 7.532a.75.75 0 01-1.389.004L8.997 5.21l-3.054 7.329A.75.75 0 015.25 13H.75a.75.75 0 010-1.5h4l3.558-8.538a.75.75 0 01.694-.462z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

PulseIcon.defaultProps = {
  className: 'octicon octicon-pulse',
  size: 16,
  verticalAlign: 'text-bottom'
};

function QuestionIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8zm9 3a1 1 0 11-2 0 1 1 0 012 0zM6.92 6.085c.081-.16.19-.299.34-.398.145-.097.371-.187.74-.187.28 0 .553.087.738.225A.613.613 0 019 6.25c0 .177-.04.264-.077.318a.956.956 0 01-.277.245c-.076.051-.158.1-.258.161l-.007.004a7.728 7.728 0 00-.313.195 2.416 2.416 0 00-.692.661.75.75 0 001.248.832.956.956 0 01.276-.245 6.3 6.3 0 01.26-.16l.006-.004c.093-.057.204-.123.313-.195.222-.149.487-.355.692-.662.214-.32.329-.702.329-1.15 0-.76-.36-1.348-.863-1.725A2.76 2.76 0 008 4c-.631 0-1.155.16-1.572.438-.413.276-.68.638-.849.977a.75.75 0 101.342.67z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.97 8.265a1.45 1.45 0 00-.487.57.75.75 0 01-1.341-.67c.2-.402.513-.826.997-1.148C10.627 6.69 11.244 6.5 12 6.5c.658 0 1.369.195 1.934.619a2.45 2.45 0 011.004 2.006c0 1.033-.513 1.72-1.027 2.215-.19.183-.399.358-.579.508l-.147.123a4.329 4.329 0 00-.435.409v1.37a.75.75 0 11-1.5 0v-1.473c0-.237.067-.504.247-.736.22-.28.486-.517.718-.714l.183-.153.001-.001c.172-.143.324-.27.47-.412.368-.355.569-.676.569-1.136a.953.953 0 00-.404-.806C12.766 8.118 12.384 8 12 8c-.494 0-.814.121-1.03.265zM13 17a1 1 0 11-2 0 1 1 0 012 0z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

QuestionIcon.defaultProps = {
  className: 'octicon octicon-question',
  size: 16,
  verticalAlign: 'text-bottom'
};

function QuoteIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 2.5a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H1.75zm4 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm0 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zM2.5 7.75a.75.75 0 00-1.5 0v6a.75.75 0 001.5 0v-6z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 6.25a.75.75 0 01.75-.75h13.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.25zM3.75 11a.75.75 0 01.75.75v7a.75.75 0 01-1.5 0v-7a.75.75 0 01.75-.75zM8 12.313a.75.75 0 01.75-.75h11.5a.75.75 0 010 1.5H8.75a.75.75 0 01-.75-.75zm0 5.937a.75.75 0 01.75-.75h11.5a.75.75 0 010 1.5H8.75a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

QuoteIcon.defaultProps = {
  className: 'octicon octicon-quote',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ReplyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.78 1.97a.75.75 0 010 1.06L3.81 6h6.44A4.75 4.75 0 0115 10.75v2.5a.75.75 0 01-1.5 0v-2.5a3.25 3.25 0 00-3.25-3.25H3.81l2.97 2.97a.75.75 0 11-1.06 1.06L1.47 7.28a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.53 5.03a.75.75 0 10-1.06-1.06l-6.25 6.25a.75.75 0 000 1.06l6.25 6.25a.75.75 0 101.06-1.06L5.56 11.5H17a3.248 3.248 0 013.25 3.248v4.502a.75.75 0 001.5 0v-4.502A4.748 4.748 0 0017 10H5.56l4.97-4.97z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ReplyIcon.defaultProps = {
  className: 'octicon octicon-reply',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 2.75A2.75 2.75 0 015.75 0h14.5a.75.75 0 01.75.75v20.5a.75.75 0 01-.75.75h-6a.75.75 0 010-1.5h5.25v-4H6A1.5 1.5 0 004.5 18v.75c0 .716.43 1.334 1.05 1.605a.75.75 0 01-.6 1.374A3.25 3.25 0 013 18.75v-16zM19.5 1.5V15H6c-.546 0-1.059.146-1.5.401V2.75c0-.69.56-1.25 1.25-1.25H19.5z\"></path><path d=\"M7 18.25a.25.25 0 01.25-.25h5a.25.25 0 01.25.25v5.01a.25.25 0 01-.397.201l-2.206-1.604a.25.25 0 00-.294 0L7.397 23.46a.25.25 0 01-.397-.2v-5.01z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoIcon.defaultProps = {
  className: 'octicon octicon-repo',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoCloneIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M15 0H9v7c0 .55.45 1 1 1h1v1h1V8h3c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1zm-4 7h-1V6h1v1zm4 0h-3V6h3v1zm0-2h-4V1h4v4zM4 5H3V4h1v1zm0-2H3V2h1v1zM2 1h6V0H1C.45 0 0 .45 0 1v12c0 .55.45 1 1 1h2v2l1.5-1.5L6 16v-2h5c.55 0 1-.45 1-1v-3H2V1zm9 10v2H6v-1H3v1H1v-2h10zM3 8h1v1H3V8zm1-1H3V6h1v1z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoCloneIcon.defaultProps = {
  className: 'octicon octicon-repo-clone',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoForkedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5 3.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm0 2.122a2.25 2.25 0 10-1.5 0v.878A2.25 2.25 0 005.75 8.5h1.5v2.128a2.251 2.251 0 101.5 0V8.5h1.5a2.25 2.25 0 002.25-2.25v-.878a2.25 2.25 0 10-1.5 0v.878a.75.75 0 01-.75.75h-4.5A.75.75 0 015 6.25v-.878zm3.75 7.378a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm3-8.75a.75.75 0 100-1.5.75.75 0 000 1.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 21a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zm-3.25-1.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zm-3-12.75a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM2.5 4.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zM18.25 6.5a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM15 4.75a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0z\"></path><path fill-rule=\"evenodd\" d=\"M6.5 7.75v1A2.25 2.25 0 008.75 11h6.5a2.25 2.25 0 002.25-2.25v-1H19v1a3.75 3.75 0 01-3.75 3.75h-6.5A3.75 3.75 0 015 8.75v-1h1.5z\"></path><path fill-rule=\"evenodd\" d=\"M11.25 16.25v-5h1.5v5h-1.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoForkedIcon.defaultProps = {
  className: 'octicon octicon-repo-forked',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoPullIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13 8V6H7V4h6V2l3 3-3 3zM4 2H3v1h1V2zm7 5h1v6c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1v2h-1V1H2v9h9V7zm0 4H1v2h2v-1h3v1h5v-2zM4 6H3v1h1V6zm0-2H3v1h1V4zM3 9h1V8H3v1z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoPullIcon.defaultProps = {
  className: 'octicon octicon-repo-pull',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoPushIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1 2.5A2.5 2.5 0 013.5 0h8.75a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0V1.5h-8a1 1 0 00-1 1v6.708A2.492 2.492 0 013.5 9h3.25a.75.75 0 010 1.5H3.5a1 1 0 100 2h5.75a.75.75 0 010 1.5H3.5A2.5 2.5 0 011 11.5v-9zm13.23 7.79a.75.75 0 001.06-1.06l-2.505-2.505a.75.75 0 00-1.06 0L9.22 9.229a.75.75 0 001.06 1.061l1.225-1.224v6.184a.75.75 0 001.5 0V9.066l1.224 1.224z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M4.75 0A2.75 2.75 0 002 2.75v16.5A2.75 2.75 0 004.75 22h11a.75.75 0 000-1.5h-11c-.69 0-1.25-.56-1.25-1.25V18A1.5 1.5 0 015 16.5h7.25a.75.75 0 000-1.5H5c-.546 0-1.059.146-1.5.401V2.75c0-.69.56-1.25 1.25-1.25H18.5v7a.75.75 0 001.5 0V.75a.75.75 0 00-.75-.75H4.75z\"></path><path d=\"M20 13.903l2.202 2.359a.75.75 0 001.096-1.024l-3.5-3.75a.75.75 0 00-1.096 0l-3.5 3.75a.75.75 0 101.096 1.024l2.202-2.36v9.348a.75.75 0 001.5 0v-9.347z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoPushIcon.defaultProps = {
  className: 'octicon octicon-repo-push',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RepoTemplateIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6 .75A.75.75 0 016.75 0h2.5a.75.75 0 010 1.5h-2.5A.75.75 0 016 .75zm5 0a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V1.5h-.75A.75.75 0 0111 .75zM4.992.662a.75.75 0 01-.636.848c-.436.063-.783.41-.846.846a.75.75 0 01-1.485-.212A2.501 2.501 0 014.144.025a.75.75 0 01.848.637zM2.75 4a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 012.75 4zm10.5 0a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5a.75.75 0 01.75-.75zM2.75 8a.75.75 0 01.75.75v.268A1.72 1.72 0 013.75 9h.5a.75.75 0 010 1.5h-.5a.25.25 0 00-.25.25v.75c0 .28.114.532.3.714a.75.75 0 01-1.05 1.072A2.495 2.495 0 012 11.5V8.75A.75.75 0 012.75 8zm10.5 0a.75.75 0 01.75.75v4.5a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5h1.75v-2h-.75a.75.75 0 010-1.5h.75v-.25a.75.75 0 01.75-.75zM6 9.75A.75.75 0 016.75 9h2.5a.75.75 0 010 1.5h-2.5A.75.75 0 016 9.75zm-1 2.5v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M5.75 0A2.75 2.75 0 003 2.75v1a.75.75 0 001.5 0v-1c0-.69.56-1.25 1.25-1.25h1a.75.75 0 000-1.5h-1zm4 0a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zm7.5 0a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-3a.75.75 0 00-.75-.75h-3zM4.5 6.5a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V6.5zm16.5 0a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V6.5zM4.5 13.25a.75.75 0 00-1.5 0v5.5a3.25 3.25 0 001.95 2.98.75.75 0 10.6-1.375A1.75 1.75 0 014.5 18.75V18A1.5 1.5 0 016 16.5h.75a.75.75 0 000-1.5H6c-.546 0-1.059.146-1.5.401V13.25zm16.5 0a.75.75 0 00-1.5 0V15h-2.25a.75.75 0 000 1.5h2.25v4h-5.25a.75.75 0 000 1.5h6a.75.75 0 00.75-.75v-8zM9.75 15a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zm-2.353 8.461A.25.25 0 017 23.26v-5.01a.25.25 0 01.25-.25h5a.25.25 0 01.25.25v5.01a.25.25 0 01-.397.201l-2.206-1.604a.25.25 0 00-.294 0L7.397 23.46z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RepoTemplateIcon.defaultProps = {
  className: 'octicon octicon-repo-template',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ReportIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 1.5a.25.25 0 00-.25.25v9.5c0 .138.112.25.25.25h2a.75.75 0 01.75.75v2.19l2.72-2.72a.75.75 0 01.53-.22h6.5a.25.25 0 00.25-.25v-9.5a.25.25 0 00-.25-.25H1.75zM0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v9.5A1.75 1.75 0 0114.25 13H8.06l-2.573 2.573A1.457 1.457 0 013 14.543V13H1.75A1.75 1.75 0 010 11.25v-9.5zM9 9a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.25 4a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h2.5a.75.75 0 01.75.75v3.19l3.427-3.427A1.75 1.75 0 0111.164 17h9.586a.25.25 0 00.25-.25V4.25a.25.25 0 00-.25-.25H3.25zm-1.75.25c0-.966.784-1.75 1.75-1.75h17.5c.966 0 1.75.784 1.75 1.75v12.5a1.75 1.75 0 01-1.75 1.75h-9.586a.25.25 0 00-.177.073l-3.5 3.5A1.457 1.457 0 015 21.043V18.5H3.25a1.75 1.75 0 01-1.75-1.75V4.25zM12 6a.75.75 0 01.75.75v4a.75.75 0 01-1.5 0v-4A.75.75 0 0112 6zm0 9a1 1 0 100-2 1 1 0 000 2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ReportIcon.defaultProps = {
  className: 'octicon octicon-report',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RocketIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M14.064 0a8.75 8.75 0 00-6.187 2.563l-.459.458c-.314.314-.616.641-.904.979H3.31a1.75 1.75 0 00-1.49.833L.11 7.607a.75.75 0 00.418 1.11l3.102.954c.037.051.079.1.124.145l2.429 2.428c.046.046.094.088.145.125l.954 3.102a.75.75 0 001.11.418l2.774-1.707a1.75 1.75 0 00.833-1.49V9.485c.338-.288.665-.59.979-.904l.458-.459A8.75 8.75 0 0016 1.936V1.75A1.75 1.75 0 0014.25 0h-.186zM10.5 10.625c-.088.06-.177.118-.266.175l-2.35 1.521.548 1.783 1.949-1.2a.25.25 0 00.119-.213v-2.066zM3.678 8.116L5.2 5.766c.058-.09.117-.178.176-.266H3.309a.25.25 0 00-.213.119l-1.2 1.95 1.782.547zm5.26-4.493A7.25 7.25 0 0114.063 1.5h.186a.25.25 0 01.25.25v.186a7.25 7.25 0 01-2.123 5.127l-.459.458a15.21 15.21 0 01-2.499 2.02l-2.317 1.5-2.143-2.143 1.5-2.317a15.25 15.25 0 012.02-2.5l.458-.458h.002zM12 5a1 1 0 11-2 0 1 1 0 012 0zm-8.44 9.56a1.5 1.5 0 10-2.12-2.12c-.734.73-1.047 2.332-1.15 3.003a.23.23 0 00.265.265c.671-.103 2.273-.416 3.005-1.148z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M20.322.75a10.75 10.75 0 00-7.373 2.926l-1.304 1.23A23.743 23.743 0 0010.103 6.5H5.066a1.75 1.75 0 00-1.5.85l-2.71 4.514a.75.75 0 00.49 1.12l4.571.963c.039.049.082.096.129.14L8.04 15.96l1.872 1.994c.044.047.091.09.14.129l.963 4.572a.75.75 0 001.12.488l4.514-2.709a1.75 1.75 0 00.85-1.5v-5.038a23.741 23.741 0 001.596-1.542l1.228-1.304a10.75 10.75 0 002.925-7.374V2.499A1.75 1.75 0 0021.498.75h-1.177zM16 15.112c-.333.248-.672.487-1.018.718l-3.393 2.262.678 3.223 3.612-2.167a.25.25 0 00.121-.214v-3.822zm-10.092-2.7L8.17 9.017c.23-.346.47-.685.717-1.017H5.066a.25.25 0 00-.214.121l-2.167 3.612 3.223.679zm8.07-7.644a9.25 9.25 0 016.344-2.518h1.177a.25.25 0 01.25.25v1.176a9.25 9.25 0 01-2.517 6.346l-1.228 1.303a22.248 22.248 0 01-3.854 3.257l-3.288 2.192-1.743-1.858a.764.764 0 00-.034-.034l-1.859-1.744 2.193-3.29a22.248 22.248 0 013.255-3.851l1.304-1.23zM17.5 8a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-11 13c.9-.9.9-2.6 0-3.5-.9-.9-2.6-.9-3.5 0-1.209 1.209-1.445 3.901-1.49 4.743a.232.232 0 00.247.247c.842-.045 3.534-.281 4.743-1.49z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RocketIcon.defaultProps = {
  className: 'octicon octicon-rocket',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RowsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M16 2.75A1.75 1.75 0 0014.25 1H1.75A1.75 1.75 0 000 2.75v2.5A1.75 1.75 0 001.75 7h12.5A1.75 1.75 0 0016 5.25v-2.5zm-1.75-.25a.25.25 0 01.25.25v2.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25v-2.5a.25.25 0 01.25-.25h12.5zM16 10.75A1.75 1.75 0 0014.25 9H1.75A1.75 1.75 0 000 10.75v2.5A1.75 1.75 0 001.75 15h12.5A1.75 1.75 0 0016 13.25v-2.5zm-1.75-.25a.25.25 0 01.25.25v2.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25v-2.5a.25.25 0 01.25-.25h12.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M22 3.75A1.75 1.75 0 0020.25 2H3.75A1.75 1.75 0 002 3.75v5.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 9.25v-5.5zm-1.75-.25a.25.25 0 01.25.25v5.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25v-5.5a.25.25 0 01.25-.25h16.5zM22 14.75A1.75 1.75 0 0020.25 13H3.75A1.75 1.75 0 002 14.75v5.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25v-5.5zm-1.75-.25a.25.25 0 01.25.25v5.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25v-5.5a.25.25 0 01.25-.25h16.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RowsIcon.defaultProps = {
  className: 'octicon octicon-rows',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RssIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.002 2.725a.75.75 0 01.797-.699C8.79 2.42 13.58 7.21 13.974 13.201a.75.75 0 11-1.497.098 10.502 10.502 0 00-9.776-9.776.75.75 0 01-.7-.798zM2 13a1 1 0 112 0 1 1 0 01-2 0zm.84-5.95a.75.75 0 00-.179 1.489c2.509.3 4.5 2.291 4.8 4.8a.75.75 0 101.49-.178A7.003 7.003 0 002.838 7.05z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3.5 3.25a.75.75 0 01.75-.75C14.053 2.5 22 10.447 22 20.25a.75.75 0 01-1.5 0C20.5 11.275 13.225 4 4.25 4a.75.75 0 01-.75-.75zM3.5 19a2 2 0 114 0 2 2 0 01-4 0zm.75-9.5a.75.75 0 000 1.5 9.25 9.25 0 019.25 9.25.75.75 0 001.5 0C15 14.313 10.187 9.5 4.25 9.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RssIcon.defaultProps = {
  className: 'octicon octicon-rss',
  size: 16,
  verticalAlign: 'text-bottom'
};

function RubyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.637 2.291A.75.75 0 014.23 2h7.54a.75.75 0 01.593.291l3.48 4.5a.75.75 0 01-.072.999l-7.25 7a.75.75 0 01-1.042 0l-7.25-7a.75.75 0 01-.072-.999l3.48-4.5zM4.598 3.5L1.754 7.177 8 13.207l6.246-6.03L11.402 3.5H4.598z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.873 3.26A.75.75 0 016.44 3h11.31a.75.75 0 01.576.27l5 6a.75.75 0 01-.028.992l-10.75 11.5a.75.75 0 01-1.096 0l-10.75-11.5a.75.75 0 01-.02-1.003l5.19-6zm.91 1.24L2.258 9.73 12 20.153l9.75-10.43L17.399 4.5H6.783z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

RubyIcon.defaultProps = {
  className: 'octicon octicon-ruby',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ScreenFullIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.75 2.5a.25.25 0 00-.25.25v2.5a.75.75 0 01-1.5 0v-2.5C1 1.784 1.784 1 2.75 1h2.5a.75.75 0 010 1.5h-2.5zM10 1.75a.75.75 0 01.75-.75h2.5c.966 0 1.75.784 1.75 1.75v2.5a.75.75 0 01-1.5 0v-2.5a.25.25 0 00-.25-.25h-2.5a.75.75 0 01-.75-.75zM1.75 10a.75.75 0 01.75.75v2.5c0 .138.112.25.25.25h2.5a.75.75 0 010 1.5h-2.5A1.75 1.75 0 011 13.25v-2.5a.75.75 0 01.75-.75zm12.5 0a.75.75 0 01.75.75v2.5A1.75 1.75 0 0113.25 15h-2.5a.75.75 0 010-1.5h2.5a.25.25 0 00.25-.25v-2.5a.75.75 0 01.75-.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M4.75 4.5a.25.25 0 00-.25.25v3.5a.75.75 0 01-1.5 0v-3.5C3 3.784 3.784 3 4.75 3h3.5a.75.75 0 010 1.5h-3.5zM15 3.75a.75.75 0 01.75-.75h3.5c.966 0 1.75.784 1.75 1.75v3.5a.75.75 0 01-1.5 0v-3.5a.25.25 0 00-.25-.25h-3.5a.75.75 0 01-.75-.75zM3.75 15a.75.75 0 01.75.75v3.5c0 .138.112.25.25.25h3.5a.75.75 0 010 1.5h-3.5A1.75 1.75 0 013 19.25v-3.5a.75.75 0 01.75-.75zm16.5 0a.75.75 0 01.75.75v3.5A1.75 1.75 0 0119.25 21h-3.5a.75.75 0 010-1.5h3.5a.25.25 0 00.25-.25v-3.5a.75.75 0 01.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ScreenFullIcon.defaultProps = {
  className: 'octicon octicon-screen-full',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ScreenNormalIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.25 1a.75.75 0 01.75.75v2.5A1.75 1.75 0 014.25 6h-2.5a.75.75 0 010-1.5h2.5a.25.25 0 00.25-.25v-2.5A.75.75 0 015.25 1zm5.5 0a.75.75 0 01.75.75v2.5c0 .138.112.25.25.25h2.5a.75.75 0 010 1.5h-2.5A1.75 1.75 0 0110 4.25v-2.5a.75.75 0 01.75-.75zM1 10.75a.75.75 0 01.75-.75h2.5c.966 0 1.75.784 1.75 1.75v2.5a.75.75 0 01-1.5 0v-2.5a.25.25 0 00-.25-.25h-2.5a.75.75 0 01-.75-.75zm9 1c0-.966.784-1.75 1.75-1.75h2.5a.75.75 0 010 1.5h-2.5a.25.25 0 00-.25.25v2.5a.75.75 0 01-1.5 0v-2.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M8.25 3a.75.75 0 01.75.75v3.5A1.75 1.75 0 017.25 9h-3.5a.75.75 0 010-1.5h3.5a.25.25 0 00.25-.25v-3.5A.75.75 0 018.25 3zm7.5 0a.75.75 0 01.75.75v3.5c0 .138.112.25.25.25h3.5a.75.75 0 010 1.5h-3.5A1.75 1.75 0 0115 7.25v-3.5a.75.75 0 01.75-.75zM3 15.75a.75.75 0 01.75-.75h3.5c.966 0 1.75.784 1.75 1.75v3.5a.75.75 0 01-1.5 0v-3.5a.25.25 0 00-.25-.25h-3.5a.75.75 0 01-.75-.75zm12 1c0-.966.784-1.75 1.75-1.75h3.5a.75.75 0 010 1.5h-3.5a.25.25 0 00-.25.25v3.5a.75.75 0 01-1.5 0v-3.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ScreenNormalIcon.defaultProps = {
  className: 'octicon octicon-screen-normal',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SearchIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M14.53 15.59a8.25 8.25 0 111.06-1.06l5.69 5.69a.75.75 0 11-1.06 1.06l-5.69-5.69zM2.5 9.25a6.75 6.75 0 1111.74 4.547.746.746 0 00-.443.442A6.75 6.75 0 012.5 9.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SearchIcon.defaultProps = {
  className: 'octicon octicon-search',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ServerIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 1A1.75 1.75 0 000 2.75v4c0 .372.116.717.314 1a1.742 1.742 0 00-.314 1v4c0 .966.784 1.75 1.75 1.75h12.5A1.75 1.75 0 0016 12.75v-4c0-.372-.116-.717-.314-1 .198-.283.314-.628.314-1v-4A1.75 1.75 0 0014.25 1H1.75zm0 7.5a.25.25 0 00-.25.25v4c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-4a.25.25 0 00-.25-.25H1.75zM1.5 2.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v4a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25v-4zm5.5 2A.75.75 0 017.75 4h4.5a.75.75 0 010 1.5h-4.5A.75.75 0 017 4.75zM7.75 10a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zM3 4.75A.75.75 0 013.75 4h.5a.75.75 0 010 1.5h-.5A.75.75 0 013 4.75zM3.75 10a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M10.75 6.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zM6 7.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5A.75.75 0 016 7.25zm4 9a.75.75 0 01.75-.75h6.5a.75.75 0 010 1.5h-6.5a.75.75 0 01-.75-.75zm-3.25-.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z\"></path><path fill-rule=\"evenodd\" d=\"M3.25 2A1.75 1.75 0 001.5 3.75v7c0 .372.116.716.314 1a1.742 1.742 0 00-.314 1v7c0 .966.784 1.75 1.75 1.75h17.5a1.75 1.75 0 001.75-1.75v-7c0-.372-.116-.716-.314-1 .198-.284.314-.628.314-1v-7A1.75 1.75 0 0020.75 2H3.25zm0 9h17.5a.25.25 0 00.25-.25v-7a.25.25 0 00-.25-.25H3.25a.25.25 0 00-.25.25v7c0 .138.112.25.25.25zm0 1.5a.25.25 0 00-.25.25v7c0 .138.112.25.25.25h17.5a.25.25 0 00.25-.25v-7a.25.25 0 00-.25-.25H3.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ServerIcon.defaultProps = {
  className: 'octicon octicon-server',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShareIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.823.177L4.927 3.073a.25.25 0 00.177.427H7.25v5.75a.75.75 0 001.5 0V3.5h2.146a.25.25 0 00.177-.427L8.177.177a.25.25 0 00-.354 0zM3.75 6.5a.25.25 0 00-.25.25v6.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25v-6.5a.25.25 0 00-.25-.25h-1a.75.75 0 010-1.5h1c.966 0 1.75.784 1.75 1.75v6.5A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25v-6.5C2 5.784 2.784 5 3.75 5h1a.75.75 0 110 1.5h-1z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.53 1.22a.75.75 0 00-1.06 0L8.22 4.47a.75.75 0 001.06 1.06l1.97-1.97v10.69a.75.75 0 001.5 0V3.56l1.97 1.97a.75.75 0 101.06-1.06l-3.25-3.25zM5.5 9.75a.25.25 0 01.25-.25h2.5a.75.75 0 000-1.5h-2.5A1.75 1.75 0 004 9.75v10.5c0 .966.784 1.75 1.75 1.75h12.5A1.75 1.75 0 0020 20.25V9.75A1.75 1.75 0 0018.25 8h-2.5a.75.75 0 000 1.5h2.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H5.75a.25.25 0 01-.25-.25V9.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShareIcon.defaultProps = {
  className: 'octicon octicon-share',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShareAndroidIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M13.5 3a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 3a3 3 0 01-5.175 2.066l-3.92 2.179a3.005 3.005 0 010 1.51l3.92 2.179a3 3 0 11-.73 1.31l-3.92-2.178a3 3 0 110-4.133l3.92-2.178A3 3 0 1115 3zm-1.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-9-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M20 5.5a3.5 3.5 0 01-6.062 2.385l-5.112 3.021a3.497 3.497 0 010 2.188l5.112 3.021a3.5 3.5 0 11-.764 1.29l-5.112-3.02a3.5 3.5 0 110-4.77l5.112-3.021v.001A3.5 3.5 0 1120 5.5zm-1.5 0a2 2 0 11-4 0 2 2 0 014 0zM5.5 14a2 2 0 100-4 2 2 0 000 4zm13 4.5a2 2 0 11-4 0 2 2 0 014 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShareAndroidIcon.defaultProps = {
  className: 'octicon octicon-share-android',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShieldIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.467.133a1.75 1.75 0 011.066 0l5.25 1.68A1.75 1.75 0 0115 3.48V7c0 1.566-.32 3.182-1.303 4.682-.983 1.498-2.585 2.813-5.032 3.855a1.7 1.7 0 01-1.33 0c-2.447-1.042-4.049-2.357-5.032-3.855C1.32 10.182 1 8.566 1 7V3.48a1.75 1.75 0 011.217-1.667l5.25-1.68zm.61 1.429a.25.25 0 00-.153 0l-5.25 1.68a.25.25 0 00-.174.238V7c0 1.358.275 2.666 1.057 3.86.784 1.194 2.121 2.34 4.366 3.297a.2.2 0 00.154 0c2.245-.956 3.582-2.104 4.366-3.298C13.225 9.666 13.5 8.36 13.5 7V3.48a.25.25 0 00-.174-.237l-5.25-1.68zM9 10.5a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.75a.75.75 0 10-1.5 0v3a.75.75 0 001.5 0v-3z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M13 15.5a1 1 0 11-2 0 1 1 0 012 0zm-.25-8.25a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0v-4.5z\"></path><path fill-rule=\"evenodd\" d=\"M11.46.637a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 4.976V10c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 20.704 2 16.19 2 10V4.976c0-.76.49-1.43 1.21-1.664L11.46.637zm.617 1.426a.25.25 0 00-.154 0L3.673 4.74a.249.249 0 00-.173.237V10c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0C17.22 19.483 20.5 15.46 20.5 10V4.976a.25.25 0 00-.173-.237l-8.25-2.676z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShieldIcon.defaultProps = {
  className: 'octicon octicon-shield',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShieldCheckIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.533.133a1.75 1.75 0 00-1.066 0l-5.25 1.68A1.75 1.75 0 001 3.48V7c0 1.566.32 3.182 1.303 4.682.983 1.498 2.585 2.813 5.032 3.855a1.7 1.7 0 001.33 0c2.447-1.042 4.049-2.357 5.032-3.855C14.68 10.182 15 8.566 15 7V3.48a1.75 1.75 0 00-1.217-1.667L8.533.133zm-.61 1.429a.25.25 0 01.153 0l5.25 1.68a.25.25 0 01.174.238V7c0 1.358-.275 2.666-1.057 3.86-.784 1.194-2.121 2.34-4.366 3.297a.2.2 0 01-.154 0c-2.245-.956-3.582-2.104-4.366-3.298C2.775 9.666 2.5 8.36 2.5 7V3.48a.25.25 0 01.174-.237l5.25-1.68zM11.28 6.28a.75.75 0 00-1.06-1.06L7.25 8.19l-.97-.97a.75.75 0 10-1.06 1.06l1.5 1.5a.75.75 0 001.06 0l3.5-3.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M16.53 9.78a.75.75 0 00-1.06-1.06L11 13.19l-1.97-1.97a.75.75 0 00-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5-5z\"></path><path fill-rule=\"evenodd\" d=\"M12.54.637a1.75 1.75 0 00-1.08 0L3.21 3.312A1.75 1.75 0 002 4.976V10c0 6.19 3.77 10.705 9.401 12.83.386.145.812.145 1.198 0C18.229 20.704 22 16.19 22 10V4.976c0-.759-.49-1.43-1.21-1.664L12.54.637zm-.617 1.426a.25.25 0 01.154 0l8.25 2.676a.25.25 0 01.173.237V10c0 5.461-3.28 9.483-8.43 11.426a.2.2 0 01-.14 0C6.78 19.483 3.5 15.46 3.5 10V4.976c0-.108.069-.203.173-.237l8.25-2.676z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShieldCheckIcon.defaultProps = {
  className: 'octicon octicon-shield-check',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShieldLockIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.533.133a1.75 1.75 0 00-1.066 0l-5.25 1.68A1.75 1.75 0 001 3.48V7c0 1.566.32 3.182 1.303 4.682.983 1.498 2.585 2.813 5.032 3.855a1.7 1.7 0 001.33 0c2.447-1.042 4.049-2.357 5.032-3.855C14.68 10.182 15 8.566 15 7V3.48a1.75 1.75 0 00-1.217-1.667L8.533.133zm-.61 1.429a.25.25 0 01.153 0l5.25 1.68a.25.25 0 01.174.238V7c0 1.358-.275 2.666-1.057 3.86-.784 1.194-2.121 2.34-4.366 3.297a.2.2 0 01-.154 0c-2.245-.956-3.582-2.104-4.366-3.298C2.775 9.666 2.5 8.36 2.5 7V3.48a.25.25 0 01.174-.237l5.25-1.68zM9.5 6.5a1.5 1.5 0 01-.75 1.3v2.45a.75.75 0 01-1.5 0V7.8A1.5 1.5 0 119.5 6.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShieldLockIcon.defaultProps = {
  className: 'octicon octicon-shield-lock',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ShieldXIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.533.133a1.75 1.75 0 00-1.066 0l-5.25 1.68A1.75 1.75 0 001 3.48V7c0 1.566.32 3.182 1.303 4.682.983 1.498 2.585 2.813 5.032 3.855a1.7 1.7 0 001.33 0c2.447-1.042 4.049-2.357 5.032-3.855C14.68 10.182 15 8.566 15 7V3.48a1.75 1.75 0 00-1.217-1.667L8.533.133zm-.61 1.429a.25.25 0 01.153 0l5.25 1.68a.25.25 0 01.174.238V7c0 1.358-.275 2.666-1.057 3.86-.784 1.194-2.121 2.34-4.366 3.297a.2.2 0 01-.154 0c-2.245-.956-3.582-2.104-4.366-3.298C2.775 9.666 2.5 8.36 2.5 7V3.48a.25.25 0 01.174-.237l5.25-1.68zM6.78 5.22a.75.75 0 10-1.06 1.06L6.94 7.5 5.72 8.72a.75.75 0 001.06 1.06L8 8.56l1.22 1.22a.75.75 0 101.06-1.06L9.06 7.5l1.22-1.22a.75.75 0 10-1.06-1.06L8 6.44 6.78 5.22z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M9.28 7.72a.75.75 0 00-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 101.06 1.06L12 12.56l2.72 2.72a.75.75 0 101.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 00-1.06-1.06L12 10.44 9.28 7.72z\"></path><path fill-rule=\"evenodd\" d=\"M12.54.637a1.75 1.75 0 00-1.08 0L3.21 3.312A1.75 1.75 0 002 4.976V10c0 6.19 3.77 10.705 9.401 12.83.386.145.812.145 1.198 0C18.229 20.704 22 16.19 22 10V4.976c0-.759-.49-1.43-1.21-1.664L12.54.637zm-.617 1.426a.25.25 0 01.154 0l8.25 2.676a.25.25 0 01.173.237V10c0 5.461-3.28 9.483-8.43 11.426a.2.2 0 01-.14 0C6.78 19.483 3.5 15.46 3.5 10V4.976c0-.108.069-.203.173-.237l8.25-2.676z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ShieldXIcon.defaultProps = {
  className: 'octicon octicon-shield-x',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SidebarCollapseIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.823 7.823L4.427 5.427A.25.25 0 004 5.604v4.792c0 .223.27.335.427.177l2.396-2.396a.25.25 0 000-.354z\"></path><path fill-rule=\"evenodd\" d=\"M1.75 0A1.75 1.75 0 000 1.75v12.5C0 15.216.784 16 1.75 16h12.5A1.75 1.75 0 0016 14.25V1.75A1.75 1.75 0 0014.25 0H1.75zM1.5 1.75a.25.25 0 01.25-.25H9.5v13H1.75a.25.25 0 01-.25-.25V1.75zM11 14.5v-13h3.25a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25H11z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.22 14.47L9.69 12 7.22 9.53a.75.75 0 111.06-1.06l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 01-1.06-1.06z\"></path><path fill-rule=\"evenodd\" d=\"M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25H15v17H3.75a.25.25 0 01-.25-.25V3.75zm13 16.75v-17h3.75a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H16.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SidebarCollapseIcon.defaultProps = {
  className: 'octicon octicon-sidebar-collapse',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SidebarExpandIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.177 7.823l2.396-2.396A.25.25 0 017 5.604v4.792a.25.25 0 01-.427.177L4.177 8.177a.25.25 0 010-.354z\"></path><path fill-rule=\"evenodd\" d=\"M0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v12.5A1.75 1.75 0 0114.25 16H1.75A1.75 1.75 0 010 14.25V1.75zm1.75-.25a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25H9.5v-13H1.75zm12.5 13H11v-13h3.25a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.28 9.53L8.81 12l2.47 2.47a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 111.06 1.06z\"></path><path fill-rule=\"evenodd\" d=\"M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25H15v17H3.75a.25.25 0 01-.25-.25V3.75zm13 16.75v-17h3.75a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H16.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SidebarExpandIcon.defaultProps = {
  className: 'octicon octicon-sidebar-expand',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SignInIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 2.75C2 1.784 2.784 1 3.75 1h2.5a.75.75 0 010 1.5h-2.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h2.5a.75.75 0 010 1.5h-2.5A1.75 1.75 0 012 13.25V2.75zm6.56 4.5l1.97-1.97a.75.75 0 10-1.06-1.06L6.22 7.47a.75.75 0 000 1.06l3.25 3.25a.75.75 0 101.06-1.06L8.56 8.75h5.69a.75.75 0 000-1.5H8.56z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 3.25c0-.966.784-1.75 1.75-1.75h5.5a.75.75 0 010 1.5h-5.5a.25.25 0 00-.25.25v17.5c0 .138.112.25.25.25h5.5a.75.75 0 010 1.5h-5.5A1.75 1.75 0 013 20.75V3.25zm9.994 9.5l3.3 3.484a.75.75 0 01-1.088 1.032l-4.5-4.75a.75.75 0 010-1.032l4.5-4.75a.75.75 0 011.088 1.032l-3.3 3.484h8.256a.75.75 0 010 1.5h-8.256z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SignInIcon.defaultProps = {
  className: 'octicon octicon-sign-in',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SignOutIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2 2.75C2 1.784 2.784 1 3.75 1h2.5a.75.75 0 010 1.5h-2.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h2.5a.75.75 0 010 1.5h-2.5A1.75 1.75 0 012 13.25V2.75zm10.44 4.5H6.75a.75.75 0 000 1.5h5.69l-1.97 1.97a.75.75 0 101.06 1.06l3.25-3.25a.75.75 0 000-1.06l-3.25-3.25a.75.75 0 10-1.06 1.06l1.97 1.97z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M3 3.25c0-.966.784-1.75 1.75-1.75h5.5a.75.75 0 010 1.5h-5.5a.25.25 0 00-.25.25v17.5c0 .138.112.25.25.25h5.5a.75.75 0 010 1.5h-5.5A1.75 1.75 0 013 20.75V3.25zm16.006 9.5l-3.3 3.484a.75.75 0 001.088 1.032l4.5-4.75a.75.75 0 000-1.032l-4.5-4.75a.75.75 0 00-1.088 1.032l3.3 3.484H10.75a.75.75 0 000 1.5h8.256z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SignOutIcon.defaultProps = {
  className: 'octicon octicon-sign-out',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SingleSelectIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M5.06 7.356l2.795 2.833c.08.081.21.081.29 0l2.794-2.833c.13-.131.038-.356-.145-.356H5.206c-.183 0-.275.225-.145.356z\"></path><path fill-rule=\"evenodd\" d=\"M1 2.75C1 1.784 1.784 1 2.75 1h10.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0113.25 15H2.75A1.75 1.75 0 011 13.25V2.75zm1.75-.25a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25H2.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.854 10.854l3.792 3.792a.5.5 0 00.708 0l3.793-3.792a.5.5 0 00-.354-.854H8.207a.5.5 0 00-.353.854z\"></path><path fill-rule=\"evenodd\" d=\"M2 3.75C2 2.784 2.784 2 3.75 2h16.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25V3.75zm1.75-.25a.25.25 0 00-.25.25v16.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25H3.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SingleSelectIcon.defaultProps = {
  className: 'octicon octicon-single-select',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SkipIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm3.28 5.78a.75.75 0 00-1.06-1.06l-5.5 5.5a.75.75 0 101.06 1.06l5.5-5.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.28 7.78a.75.75 0 00-1.06-1.06l-9.5 9.5a.75.75 0 101.06 1.06l9.5-9.5z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SkipIcon.defaultProps = {
  className: 'octicon octicon-skip',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SmileyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zM5 8a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zM5.32 9.636a.75.75 0 011.038.175l.007.009c.103.118.22.222.35.31.264.178.683.37 1.285.37.602 0 1.02-.192 1.285-.371.13-.088.247-.192.35-.31l.007-.008a.75.75 0 111.222.87l-.614-.431c.614.43.614.431.613.431v.001l-.001.002-.002.003-.005.007-.014.019a1.984 1.984 0 01-.184.213c-.16.166-.338.316-.53.445-.63.418-1.37.638-2.127.629-.946 0-1.652-.308-2.126-.63a3.32 3.32 0 01-.715-.657l-.014-.02-.005-.006-.002-.003v-.002h-.001l.613-.432-.614.43a.75.75 0 01.183-1.044h.001z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M8.456 14.494a.75.75 0 011.068.17 3.08 3.08 0 00.572.492A3.381 3.381 0 0012 15.72c.855 0 1.487-.283 1.904-.562a3.081 3.081 0 00.572-.492l.021-.026a.75.75 0 011.197.905l-.027.034c-.013.016-.03.038-.052.063-.044.05-.105.119-.184.198a4.569 4.569 0 01-.695.566A4.88 4.88 0 0112 17.22a4.88 4.88 0 01-2.736-.814 4.57 4.57 0 01-.695-.566 3.253 3.253 0 01-.236-.261c-.259-.332-.223-.824.123-1.084z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path><path d=\"M9 10.75a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zM16.25 12a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SmileyIcon.defaultProps = {
  className: 'octicon octicon-smiley',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SortAscIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 4.25a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5H.75A.75.75 0 010 4.25zm0 4a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5H.75A.75.75 0 010 8.25zm0 4a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H.75a.75.75 0 01-.75-.75zm12.927-9.677a.25.25 0 00-.354 0l-3 3A.25.25 0 009.75 6H12v6.75a.75.75 0 001.5 0V6h2.25a.25.25 0 00.177-.427l-3-3z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M18.5 17.25a.75.75 0 01-1.5 0V7.56l-2.22 2.22a.75.75 0 11-1.06-1.06l3.5-3.5a.75.75 0 011.06 0l3.5 3.5a.75.75 0 01-1.06 1.06L18.5 7.56v9.69zm-15.75.25a.75.75 0 010-1.5h9.5a.75.75 0 010 1.5h-9.5zm0-5a.75.75 0 010-1.5h5.5a.75.75 0 010 1.5h-5.5zm0-5a.75.75 0 010-1.5h3.5a.75.75 0 010 1.5h-3.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SortAscIcon.defaultProps = {
  className: 'octicon octicon-sort-asc',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SortDescIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 4.25a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H.75A.75.75 0 010 4.25zm0 4a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5H.75A.75.75 0 010 8.25zm0 4a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5H.75a.75.75 0 01-.75-.75z\"></path><path d=\"M13.5 10h2.25a.25.25 0 01.177.427l-3 3a.25.25 0 01-.354 0l-3-3A.25.25 0 019.75 10H12V3.75a.75.75 0 011.5 0V10z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M18.5 16.44V6.75a.75.75 0 00-1.5 0v9.69l-2.22-2.22a.75.75 0 10-1.06 1.06l3.5 3.5a.75.75 0 001.06 0l3.5-3.5a.75.75 0 10-1.06-1.06l-2.22 2.22zM2 7.25a.75.75 0 01.75-.75h9.5a.75.75 0 010 1.5h-9.5A.75.75 0 012 7.25zm0 5a.75.75 0 01.75-.75h5.5a.75.75 0 010 1.5h-5.5a.75.75 0 01-.75-.75zm0 5a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SortDescIcon.defaultProps = {
  className: 'octicon octicon-sort-desc',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SquareIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4 5.75C4 4.784 4.784 4 5.75 4h4.5c.966 0 1.75.784 1.75 1.75v4.5A1.75 1.75 0 0110.25 12h-4.5A1.75 1.75 0 014 10.25v-4.5zm1.75-.25a.25.25 0 00-.25.25v4.5c0 .138.112.25.25.25h4.5a.25.25 0 00.25-.25v-4.5a.25.25 0 00-.25-.25h-4.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M6 7.75C6 6.784 6.784 6 7.75 6h8.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0116.25 18h-8.5A1.75 1.75 0 016 16.25v-8.5zm1.75-.25a.25.25 0 00-.25.25v8.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25v-8.5a.25.25 0 00-.25-.25h-8.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SquareIcon.defaultProps = {
  className: 'octicon octicon-square',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SquareFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.75 4A1.75 1.75 0 004 5.75v4.5c0 .966.784 1.75 1.75 1.75h4.5A1.75 1.75 0 0012 10.25v-4.5A1.75 1.75 0 0010.25 4h-4.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.75 6A1.75 1.75 0 006 7.75v8.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0018 16.25v-8.5A1.75 1.75 0 0016.25 6h-8.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SquareFillIcon.defaultProps = {
  className: 'octicon octicon-square-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SquirrelIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.499.75a.75.75 0 011.5 0v.996C5.9 2.903 6.793 3.65 7.662 4.376l.24.202c-.036-.694.055-1.422.426-2.163C9.1.873 10.794-.045 12.622.26 14.408.558 16 1.94 16 4.25c0 1.278-.954 2.575-2.44 2.734l.146.508.065.22c.203.701.412 1.455.476 2.226.142 1.707-.4 3.03-1.487 3.898C11.714 14.671 10.27 15 8.75 15h-6a.75.75 0 010-1.5h1.376a4.489 4.489 0 01-.563-1.191 3.833 3.833 0 01-.05-2.063 4.636 4.636 0 01-2.025-.293.75.75 0 11.525-1.406c1.357.507 2.376-.006 2.698-.318l.009-.01a.748.748 0 011.06 0 .75.75 0 01-.012 1.074c-.912.92-.992 1.835-.768 2.586.221.74.745 1.337 1.196 1.621H8.75c1.343 0 2.398-.296 3.074-.836.635-.507 1.036-1.31.928-2.602-.05-.603-.216-1.224-.422-1.93l-.064-.221c-.12-.407-.246-.84-.353-1.29a2.404 2.404 0 01-.507-.441 3.063 3.063 0 01-.633-1.248.75.75 0 011.455-.364c.046.185.144.436.31.627.146.168.353.305.712.305.738 0 1.25-.615 1.25-1.25 0-1.47-.95-2.315-2.123-2.51-1.172-.196-2.227.387-2.706 1.345-.46.92-.27 1.774.019 3.062l.042.19a.753.753 0 01.01.05c.348.443.666.949.94 1.553a.75.75 0 11-1.365.62c-.553-1.217-1.32-1.94-2.3-2.768a85.08 85.08 0 00-.317-.265c-.814-.68-1.75-1.462-2.692-2.619a3.74 3.74 0 00-1.023.88c-.406.495-.663 1.036-.722 1.508.116.122.306.21.591.239.388.038.797-.06 1.032-.19a.75.75 0 01.728 1.31c-.515.287-1.23.439-1.906.373-.682-.067-1.473-.38-1.879-1.193L.75 5.677V5.5c0-.984.48-1.94 1.077-2.664.46-.559 1.05-1.055 1.673-1.353V.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M18.377 3.49c-1.862-.31-3.718.62-4.456 2.095-.428.857-.691 1.624-.728 2.361-.035.71.138 1.444.67 2.252.644.854 1.199 1.913 1.608 3.346a.75.75 0 11-1.442.412c-.353-1.236-.82-2.135-1.372-2.865l-.008-.01c-.53-.698-1.14-1.242-1.807-1.778a50.724 50.724 0 00-.667-.524C9.024 7.884 7.71 6.863 6.471 5.16c-.59.287-1.248.798-1.806 1.454-.665.78-1.097 1.66-1.158 2.446.246.36.685.61 1.246.715.643.12 1.278.015 1.633-.182a.75.75 0 11.728 1.311c-.723.402-1.728.516-2.637.346-.916-.172-1.898-.667-2.398-1.666L2 9.427V9.25c0-1.323.678-2.615 1.523-3.607.7-.824 1.59-1.528 2.477-1.917V2.75a.75.75 0 111.5 0v1.27c1.154 1.67 2.363 2.612 3.568 3.551.207.162.415.323.621.489.001-.063.003-.126.006-.188.052-1.034.414-2.017.884-2.958 1.06-2.118 3.594-3.313 6.044-2.904 1.225.204 2.329.795 3.125 1.748C22.546 4.713 23 5.988 23 7.5c0 1.496-.913 3.255-2.688 3.652.838 1.699 1.438 3.768 1.181 5.697-.269 2.017-1.04 3.615-2.582 4.675C17.409 22.558 15.288 23 12.5 23H4.75a.75.75 0 010-1.5h2.322c-.58-.701-.998-1.578-1.223-2.471-.327-1.3-.297-2.786.265-4.131-.92.091-1.985-.02-3.126-.445a.75.75 0 11.524-1.406c1.964.733 3.428.266 4.045-.19.068-.06.137-.12.208-.18a.745.745 0 01.861-.076.746.746 0 01.32.368.752.752 0 01-.173.819c-.077.076-.16.15-.252.221-1.322 1.234-1.62 3.055-1.218 4.654.438 1.737 1.574 2.833 2.69 2.837H12.5c2.674 0 4.429-.433 5.56-1.212 1.094-.752 1.715-1.904 1.946-3.637.236-1.768-.445-3.845-1.407-5.529a.576.576 0 01-.012-.02 3.557 3.557 0 01-1.553-.94c-.556-.565-.89-1.243-1.012-1.73a.75.75 0 011.456-.364c.057.231.26.67.626 1.043.35.357.822.623 1.443.623 1.172 0 1.953-1.058 1.953-2.234 0-1.205-.357-2.127-.903-2.78-.547-.654-1.318-1.08-2.22-1.23z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SquirrelIcon.defaultProps = {
  className: 'octicon octicon-squirrel',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StackIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.122.392a1.75 1.75 0 011.756 0l5.003 2.902c.83.481.83 1.68 0 2.162L8.878 8.358a1.75 1.75 0 01-1.756 0L2.119 5.456a1.25 1.25 0 010-2.162L7.122.392zM8.125 1.69a.25.25 0 00-.25 0l-4.63 2.685 4.63 2.685a.25.25 0 00.25 0l4.63-2.685-4.63-2.685zM1.601 7.789a.75.75 0 011.025-.273l5.249 3.044a.25.25 0 00.25 0l5.249-3.044a.75.75 0 01.752 1.298l-5.248 3.044a1.75 1.75 0 01-1.756 0L1.874 8.814A.75.75 0 011.6 7.789zm0 3.5a.75.75 0 011.025-.273l5.249 3.044a.25.25 0 00.25 0l5.249-3.044a.75.75 0 01.752 1.298l-5.248 3.044a1.75 1.75 0 01-1.756 0l-5.248-3.044a.75.75 0 01-.273-1.025z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.063 1.456a1.75 1.75 0 011.874 0l8.383 5.316a1.75 1.75 0 010 2.956l-8.383 5.316a1.75 1.75 0 01-1.874 0L2.68 9.728a1.75 1.75 0 010-2.956l8.383-5.316zm1.071 1.267a.25.25 0 00-.268 0L3.483 8.039a.25.25 0 000 .422l8.383 5.316a.25.25 0 00.268 0l8.383-5.316a.25.25 0 000-.422l-8.383-5.316z\"></path><path fill-rule=\"evenodd\" d=\"M1.867 12.324a.75.75 0 011.035-.232l8.964 5.685a.25.25 0 00.268 0l8.964-5.685a.75.75 0 01.804 1.267l-8.965 5.685a1.75 1.75 0 01-1.874 0l-8.965-5.685a.75.75 0 01-.231-1.035z\"></path><path fill-rule=\"evenodd\" d=\"M1.867 16.324a.75.75 0 011.035-.232l8.964 5.685a.25.25 0 00.268 0l8.964-5.685a.75.75 0 01.804 1.267l-8.965 5.685a1.75 1.75 0 01-1.874 0l-8.965-5.685a.75.75 0 01-.231-1.035z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StackIcon.defaultProps = {
  className: 'octicon octicon-stack',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StarIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 .25a.75.75 0 01.673.418l3.058 6.197 6.839.994a.75.75 0 01.415 1.279l-4.948 4.823 1.168 6.811a.75.75 0 01-1.088.791L12 18.347l-6.117 3.216a.75.75 0 01-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 01.416-1.28l6.838-.993L11.328.668A.75.75 0 0112 .25zm0 2.445L9.44 7.882a.75.75 0 01-.565.41l-5.725.832 4.143 4.038a.75.75 0 01.215.664l-.978 5.702 5.121-2.692a.75.75 0 01.698 0l5.12 2.692-.977-5.702a.75.75 0 01.215-.664l4.143-4.038-5.725-.831a.75.75 0 01-.565-.41L12 2.694z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StarIcon.defaultProps = {
  className: 'octicon octicon-star',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StarFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.672.668a.75.75 0 00-1.345 0L8.27 6.865l-6.838.994a.75.75 0 00-.416 1.279l4.948 4.823-1.168 6.811a.75.75 0 001.088.791L12 18.347l6.117 3.216a.75.75 0 001.088-.79l-1.168-6.812 4.948-4.823a.75.75 0 00-.416-1.28l-6.838-.993L12.672.668z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StarFillIcon.defaultProps = {
  className: 'octicon octicon-star-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StopIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M4.47.22A.75.75 0 015 0h6a.75.75 0 01.53.22l4.25 4.25c.141.14.22.331.22.53v6a.75.75 0 01-.22.53l-4.25 4.25A.75.75 0 0111 16H5a.75.75 0 01-.53-.22L.22 11.53A.75.75 0 010 11V5a.75.75 0 01.22-.53L4.47.22zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5H5.31zM8 4a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 018 4zm0 8a1 1 0 100-2 1 1 0 000 2z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12 7a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0112 7zm0 10a1 1 0 100-2 1 1 0 000 2z\"></path><path fill-rule=\"evenodd\" d=\"M7.328 1.47a.75.75 0 01.53-.22h8.284a.75.75 0 01.53.22l5.858 5.858c.141.14.22.33.22.53v8.284a.75.75 0 01-.22.53l-5.858 5.858a.75.75 0 01-.53.22H7.858a.75.75 0 01-.53-.22L1.47 16.672a.75.75 0 01-.22-.53V7.858a.75.75 0 01.22-.53L7.328 1.47zm.84 1.28L2.75 8.169v7.662l5.419 5.419h7.662l5.419-5.418V8.168L15.832 2.75H8.168z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StopIcon.defaultProps = {
  className: 'octicon octicon-stop',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StopwatchIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.75.75A.75.75 0 016.5 0h3a.75.75 0 010 1.5h-.75v1l-.001.041a6.718 6.718 0 013.464 1.435l.007-.006.75-.75a.75.75 0 111.06 1.06l-.75.75-.006.007a6.75 6.75 0 11-10.548 0L2.72 5.03l-.75-.75a.75.75 0 011.06-1.06l.75.75.007.006A6.718 6.718 0 017.25 2.541a.756.756 0 010-.041v-1H6.5a.75.75 0 01-.75-.75zM8 14.5A5.25 5.25 0 108 4a5.25 5.25 0 000 10.5zm.389-6.7l1.33-1.33a.75.75 0 111.061 1.06L9.45 8.861A1.502 1.502 0 018 10.75a1.5 1.5 0 11.389-2.95z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10.25 0a.75.75 0 000 1.5h1v1.278a9.955 9.955 0 00-5.635 2.276L4.28 3.72a.75.75 0 00-1.06 1.06l1.315 1.316A9.962 9.962 0 002 12.75c0 5.523 4.477 10 10 10s10-4.477 10-10a9.962 9.962 0 00-2.535-6.654L20.78 4.78a.75.75 0 00-1.06-1.06l-1.334 1.334a9.955 9.955 0 00-5.636-2.276V1.5h1a.75.75 0 000-1.5h-3.5zM12 21.25a8.5 8.5 0 100-17 8.5 8.5 0 000 17zm4.03-12.53a.75.75 0 010 1.06l-2.381 2.382a1.75 1.75 0 11-1.06-1.06l2.38-2.382a.75.75 0 011.061 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StopwatchIcon.defaultProps = {
  className: 'octicon octicon-stopwatch',
  size: 16,
  verticalAlign: 'text-bottom'
};

function StrikethroughIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.581 3.25c-2.036 0-2.778 1.082-2.778 1.786 0 .055.002.107.006.157a.75.75 0 01-1.496.114 3.56 3.56 0 01-.01-.271c0-1.832 1.75-3.286 4.278-3.286 1.418 0 2.721.58 3.514 1.093a.75.75 0 11-.814 1.26c-.64-.414-1.662-.853-2.7-.853zm3.474 5.25h3.195a.75.75 0 000-1.5H1.75a.75.75 0 000 1.5h6.018c.835.187 1.503.464 1.951.81.439.34.647.725.647 1.197 0 .428-.159.895-.594 1.267-.444.38-1.254.726-2.676.726-1.373 0-2.38-.493-2.86-.956a.75.75 0 00-1.042 1.079C3.992 13.393 5.39 14 7.096 14c1.652 0 2.852-.403 3.65-1.085a3.134 3.134 0 001.12-2.408 2.85 2.85 0 00-.811-2.007z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.36 5C9.37 5 8.105 6.613 8.105 7.848c0 .411.072.744.193 1.02a.75.75 0 01-1.373.603 3.993 3.993 0 01-.32-1.623c0-2.363 2.271-4.348 5.755-4.348 1.931 0 3.722.794 4.814 1.5a.75.75 0 11-.814 1.26c-.94-.607-2.448-1.26-4-1.26zm4.173 7.5h3.717a.75.75 0 000-1.5H3.75a.75.75 0 000 1.5h9.136c1.162.28 2.111.688 2.76 1.211.642.518.979 1.134.979 1.898a2.63 2.63 0 01-.954 2.036c-.703.601-1.934 1.105-3.999 1.105-2.018 0-3.529-.723-4.276-1.445a.75.75 0 10-1.042 1.08c1.066 1.028 2.968 1.865 5.318 1.865 2.295 0 3.916-.56 4.974-1.464a4.131 4.131 0 001.479-3.177c0-1.296-.608-2.316-1.538-3.066a5.77 5.77 0 00-.054-.043z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

StrikethroughIcon.defaultProps = {
  className: 'octicon octicon-strikethrough',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SunIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 10.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM8 12a4 4 0 100-8 4 4 0 000 8zM8 0a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V.75A.75.75 0 018 0zm0 13a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 018 13zM2.343 2.343a.75.75 0 011.061 0l1.06 1.061a.75.75 0 01-1.06 1.06l-1.06-1.06a.75.75 0 010-1.06zm9.193 9.193a.75.75 0 011.06 0l1.061 1.06a.75.75 0 01-1.06 1.061l-1.061-1.06a.75.75 0 010-1.061zM16 8a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 0116 8zM3 8a.75.75 0 01-.75.75H.75a.75.75 0 010-1.5h1.5A.75.75 0 013 8zm10.657-5.657a.75.75 0 010 1.061l-1.061 1.06a.75.75 0 11-1.06-1.06l1.06-1.06a.75.75 0 011.06 0zm-9.193 9.193a.75.75 0 010 1.06l-1.06 1.061a.75.75 0 11-1.061-1.06l1.06-1.061a.75.75 0 011.061 0z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 17.5a5.5 5.5 0 100-11 5.5 5.5 0 000 11zm0 1.5a7 7 0 100-14 7 7 0 000 14zm12-7a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5h2.5A.75.75 0 0124 12zM4 12a.75.75 0 01-.75.75H.75a.75.75 0 010-1.5h2.5A.75.75 0 014 12zm16.485-8.485a.75.75 0 010 1.06l-1.768 1.768a.75.75 0 01-1.06-1.06l1.767-1.768a.75.75 0 011.061 0zM6.343 17.657a.75.75 0 010 1.06l-1.768 1.768a.75.75 0 11-1.06-1.06l1.767-1.768a.75.75 0 011.061 0zM12 0a.75.75 0 01.75.75v2.5a.75.75 0 01-1.5 0V.75A.75.75 0 0112 0zm0 20a.75.75 0 01.75.75v2.5a.75.75 0 01-1.5 0v-2.5A.75.75 0 0112 20zM3.515 3.515a.75.75 0 011.06 0l1.768 1.768a.75.75 0 11-1.06 1.06L3.515 4.575a.75.75 0 010-1.06zm14.142 14.142a.75.75 0 011.06 0l1.768 1.768a.75.75 0 01-1.06 1.06l-1.768-1.767a.75.75 0 010-1.061z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SunIcon.defaultProps = {
  className: 'octicon octicon-sun',
  size: 16,
  verticalAlign: 'text-bottom'
};

function SyncIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M3.38 8A9.502 9.502 0 0112 2.5a9.502 9.502 0 019.215 7.182.75.75 0 101.456-.364C21.473 4.539 17.15 1 12 1a10.995 10.995 0 00-9.5 5.452V4.75a.75.75 0 00-1.5 0V8.5a1 1 0 001 1h3.75a.75.75 0 000-1.5H3.38zm-.595 6.318a.75.75 0 00-1.455.364C2.527 19.461 6.85 23 12 23c4.052 0 7.592-2.191 9.5-5.451v1.701a.75.75 0 001.5 0V15.5a1 1 0 00-1-1h-3.75a.75.75 0 000 1.5h2.37A9.502 9.502 0 0112 21.5c-4.446 0-8.181-3.055-9.215-7.182z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

SyncIcon.defaultProps = {
  className: 'octicon octicon-sync',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TabIcon(props) {
  var svgDataByHeight = { "24": { "width": 24, "path": "<path d=\"M22 4.25a.75.75 0 00-1.5 0v15a.75.75 0 001.5 0v-15zm-9.72 14.28a.75.75 0 11-1.06-1.06l4.97-4.97H1.75a.75.75 0 010-1.5h14.44l-4.97-4.97a.75.75 0 011.06-1.06l6.25 6.25a.75.75 0 010 1.06l-6.25 6.25z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TabIcon.defaultProps = {
  className: 'octicon octicon-tab',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TableIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v3.585a.746.746 0 010 .83v8.085A1.75 1.75 0 0114.25 16H6.309a.748.748 0 01-1.118 0H1.75A1.75 1.75 0 010 14.25V6.165a.746.746 0 010-.83V1.75zM1.5 6.5v7.75c0 .138.112.25.25.25H5v-8H1.5zM5 5H1.5V1.75a.25.25 0 01.25-.25H5V5zm1.5 1.5v8h7.75a.25.25 0 00.25-.25V6.5h-8zm8-1.5h-8V1.5h7.75a.25.25 0 01.25.25V5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M2 3.75C2 2.784 2.784 2 3.75 2h16.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25V3.75zM3.5 9v11.25c0 .138.112.25.25.25H7.5V9h-4zm4-1.5h-4V3.75a.25.25 0 01.25-.25H7.5v4zM9 9v11.5h11.25a.25.25 0 00.25-.25V9H9zm11.5-1.5H9v-4h11.25a.25.25 0 01.25.25V7.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TableIcon.defaultProps = {
  className: 'octicon octicon-table',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TagIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 7.775V2.75a.25.25 0 01.25-.25h5.025a.25.25 0 01.177.073l6.25 6.25a.25.25 0 010 .354l-5.025 5.025a.25.25 0 01-.354 0l-6.25-6.25a.25.25 0 01-.073-.177zm-1.5 0V2.75C1 1.784 1.784 1 2.75 1h5.025c.464 0 .91.184 1.238.513l6.25 6.25a1.75 1.75 0 010 2.474l-5.026 5.026a1.75 1.75 0 01-2.474 0l-6.25-6.25A1.75 1.75 0 011 7.775zM6 5a1 1 0 100 2 1 1 0 000-2z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M7.75 6.5a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z\"></path><path fill-rule=\"evenodd\" d=\"M2.5 1A1.5 1.5 0 001 2.5v8.44c0 .397.158.779.44 1.06l10.25 10.25a1.5 1.5 0 002.12 0l8.44-8.44a1.5 1.5 0 000-2.12L12 1.44A1.5 1.5 0 0010.94 1H2.5zm0 1.5h8.44l10.25 10.25-8.44 8.44L2.5 10.94V2.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TagIcon.defaultProps = {
  className: 'octicon octicon-tag',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TasklistIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.5 2.75a.25.25 0 01.25-.25h10.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V2.75zM2.75 1A1.75 1.75 0 001 2.75v10.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0015 13.25V2.75A1.75 1.75 0 0013.25 1H2.75zm9.03 5.28a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.28 9.28a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z\"></path><path fill-rule=\"evenodd\" d=\"M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25h16.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25V3.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TasklistIcon.defaultProps = {
  className: 'octicon octicon-tasklist',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TelescopeIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M14.184 1.143a1.75 1.75 0 00-2.502-.57L.912 7.916a1.75 1.75 0 00-.53 2.32l.447.775a1.75 1.75 0 002.275.702l11.745-5.656a1.75 1.75 0 00.757-2.451l-1.422-2.464zm-1.657.669a.25.25 0 01.358.081l1.422 2.464a.25.25 0 01-.108.35l-2.016.97-1.505-2.605 1.85-1.26zM9.436 3.92l1.391 2.41-5.42 2.61-.942-1.63 4.97-3.39zM3.222 8.157l-1.466 1a.25.25 0 00-.075.33l.447.775a.25.25 0 00.325.1l1.598-.769-.83-1.436zm6.253 2.306a.75.75 0 00-.944-.252l-1.809.87a.75.75 0 00-.293.253L4.38 14.326a.75.75 0 101.238.848l1.881-2.75v2.826a.75.75 0 001.5 0v-2.826l1.881 2.75a.75.75 0 001.238-.848l-2.644-3.863z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M.408 15.13a2 2 0 01.59-2.642L17.038 1.33a2 2 0 012.85.602l2.828 4.644a2 2 0 01-.851 2.847l-17.762 8.43a2 2 0 01-2.59-.807L.408 15.13zm5.263-4.066l7.842-5.455 2.857 4.76-8.712 4.135-1.987-3.44zm-1.235.86L1.854 13.72a.5.5 0 00-.147.66l1.105 1.915a.5.5 0 00.648.201l2.838-1.347-1.862-3.225zm13.295-2.2L14.747 4.75l3.148-2.19a.5.5 0 01.713.151l2.826 4.644a.5.5 0 01-.212.712l-3.49 1.656z\"></path><path d=\"M17.155 22.87a.75.75 0 00.226-1.036l-4-6.239a.75.75 0 00-.941-.278l-2.75 1.25a.75.75 0 00-.318.274l-3.25 4.989a.75.75 0 001.256.819l3.131-4.806.51-.232v5.64a.75.75 0 101.5 0v-6.22l3.6 5.613a.75.75 0 001.036.226z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TelescopeIcon.defaultProps = {
  className: 'octicon octicon-telescope',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TelescopeFillIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.531 10.21a.75.75 0 01.944.253l2.644 3.864a.75.75 0 11-1.238.847L9 12.424v2.826a.75.75 0 01-1.5 0v-2.826l-1.881 2.75a.75.75 0 01-1.238-.848l2.048-2.992a.75.75 0 01.293-.252l1.81-.871zM11.905.42a1.5 1.5 0 012.144.49l1.692 2.93a1.5 1.5 0 01-.649 2.102L2.895 11.815a1.5 1.5 0 01-1.95-.602l-.68-1.176a1.5 1.5 0 01.455-1.99L11.905.422zM3.279 8.119l.835 1.445 1.355-.653-.947-1.64-1.243.848zm7.728-1.874L9.6 3.808l1.243-.848 1.52 2.631-1.356.653z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.155 22.87a.75.75 0 00.226-1.036l-4-6.239a.75.75 0 00-.941-.277l-2.75 1.25a.75.75 0 00-.318.273l-3.25 4.989a.75.75 0 001.256.819l3.131-4.806.51-.232v5.64a.75.75 0 101.5 0v-6.22l3.6 5.613a.75.75 0 001.036.226z\"></path><path fill-rule=\"evenodd\" d=\"M.408 15.13a2 2 0 01.59-2.642L17.038 1.33a2 2 0 012.85.602l2.828 4.644a2 2 0 01-.851 2.847l-17.762 8.43a2 2 0 01-2.59-.807L.408 15.13zm5.263-4.066l1.987 3.44-1.36.645-1.862-3.225 1.235-.86zm7.842-5.455l2.857 4.76 1.361-.646-2.984-4.973-1.234.859z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TelescopeFillIcon.defaultProps = {
  className: 'octicon octicon-telescope-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TerminalIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 2.75C0 1.784.784 1 1.75 1h12.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0114.25 15H1.75A1.75 1.75 0 010 13.25V2.75zm1.75-.25a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25H1.75zM7.25 8a.75.75 0 01-.22.53l-2.25 2.25a.75.75 0 11-1.06-1.06L5.44 8 3.72 6.28a.75.75 0 111.06-1.06l2.25 2.25c.141.14.22.331.22.53zm1.5 1.5a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M9.25 12a.75.75 0 01-.22.53l-2.75 2.75a.75.75 0 01-1.06-1.06L7.44 12 5.22 9.78a.75.75 0 111.06-1.06l2.75 2.75c.141.14.22.331.22.53zm2 2a.75.75 0 000 1.5h5a.75.75 0 000-1.5h-5z\"></path><path fill-rule=\"evenodd\" d=\"M0 4.75C0 3.784.784 3 1.75 3h20.5c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0122.25 21H1.75A1.75 1.75 0 010 19.25V4.75zm1.75-.25a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V4.75a.25.25 0 00-.25-.25H1.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TerminalIcon.defaultProps = {
  className: 'octicon octicon-terminal',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ThreeBarsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1 2.75A.75.75 0 011.75 2h12.5a.75.75 0 110 1.5H1.75A.75.75 0 011 2.75zm0 5A.75.75 0 011.75 7h12.5a.75.75 0 110 1.5H1.75A.75.75 0 011 7.75zM1.75 12a.75.75 0 100 1.5h12.5a.75.75 0 100-1.5H1.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ThreeBarsIcon.defaultProps = {
  className: 'octicon octicon-three-bars',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ThumbsdownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.083 15.986c1.34.153 2.334-.982 2.334-2.183v-.5c0-1.329.646-2.123 1.317-2.614.329-.24.66-.403.919-.508a1.75 1.75 0 001.514.872h1a1.75 1.75 0 001.75-1.75v-7.5a1.75 1.75 0 00-1.75-1.75h-1a1.75 1.75 0 00-1.662 1.2c-.525-.074-1.068-.228-1.726-.415L9.305.705C8.151.385 6.765.053 4.917.053c-1.706 0-2.97.152-3.722 1.139-.353.463-.537 1.042-.669 1.672C.41 3.424.32 4.108.214 4.897l-.04.306c-.25 1.869-.266 3.318.188 4.316.244.537.622.943 1.136 1.2.495.248 1.066.334 1.669.334h1.422l-.015.112c-.07.518-.157 1.17-.157 1.638 0 .921.151 1.718.655 2.299.512.589 1.248.797 2.011.884zm4.334-13.232c-.706-.089-1.39-.284-2.072-.479a63.914 63.914 0 00-.441-.125c-1.096-.304-2.335-.597-3.987-.597-1.794 0-2.28.222-2.529.548-.147.193-.275.505-.393 1.07-.105.502-.188 1.124-.295 1.93l-.04.3c-.25 1.882-.19 2.933.067 3.497a.921.921 0 00.443.48c.208.104.52.175.997.175h1.75c.685 0 1.295.577 1.205 1.335-.022.192-.049.39-.075.586-.066.488-.13.97-.13 1.329 0 .808.144 1.15.288 1.316.137.157.401.303 1.048.377.307.035.664-.237.664-.693v-.5c0-1.922.978-3.127 1.932-3.825a5.862 5.862 0 011.568-.809V2.754zm1.75 6.798a.25.25 0 01-.25-.25v-7.5a.25.25 0 01.25-.25h1a.25.25 0 01.25.25v7.5a.25.25 0 01-.25.25h-1z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.596 21.957c-1.301.092-2.303-.986-2.303-2.206v-1.053c0-2.666-1.813-3.785-2.774-4.2a1.864 1.864 0 00-.523-.13A1.75 1.75 0 015.25 16h-1.5A1.75 1.75 0 012 14.25V3.75C2 2.784 2.784 2 3.75 2h1.5a1.75 1.75 0 011.742 1.58c.838-.06 1.667-.296 2.69-.586l.602-.17C11.748 2.419 13.497 2 15.828 2c2.188 0 3.693.204 4.583 1.372.422.554.65 1.255.816 2.05.148.708.262 1.57.396 2.58l.051.39c.319 2.386.328 4.18-.223 5.394-.293.644-.743 1.125-1.355 1.431-.59.296-1.284.404-2.036.404h-2.05l.056.429c.025.18.05.372.076.572.06.483.117 1.006.117 1.438 0 1.245-.222 2.253-.92 2.942-.684.674-1.668.879-2.743.955zM7 5.082c1.059-.064 2.079-.355 3.118-.651.188-.054.377-.108.568-.16 1.406-.392 3.006-.771 5.142-.771 2.277 0 3.004.274 3.39.781.216.283.388.718.54 1.448.136.65.242 1.45.379 2.477l.05.385c.32 2.398.253 3.794-.102 4.574-.16.352-.375.569-.66.711-.305.153-.74.245-1.365.245h-2.37c-.681 0-1.293.57-1.211 1.328.026.244.065.537.105.834l.07.527c.06.482.105.922.105 1.25 0 1.125-.213 1.617-.473 1.873-.275.27-.774.456-1.795.528-.351.024-.698-.274-.698-.71v-1.053c0-3.55-2.488-5.063-3.68-5.577A3.485 3.485 0 007 12.861V5.08zM3.75 3.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h1.5a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25h-1.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ThumbsdownIcon.defaultProps = {
  className: 'octicon octicon-thumbsdown',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ThumbsupIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.834.066C7.494-.087 6.5 1.048 6.5 2.25v.5c0 1.329-.647 2.124-1.318 2.614-.328.24-.66.403-.918.508A1.75 1.75 0 002.75 5h-1A1.75 1.75 0 000 6.75v7.5C0 15.216.784 16 1.75 16h1a1.75 1.75 0 001.662-1.201c.525.075 1.067.229 1.725.415.152.043.31.088.475.133 1.154.32 2.54.653 4.388.653 1.706 0 2.97-.153 3.722-1.14.353-.463.537-1.042.668-1.672.118-.56.208-1.243.313-2.033l.04-.306c.25-1.869.265-3.318-.188-4.316a2.418 2.418 0 00-1.137-1.2C13.924 5.085 13.353 5 12.75 5h-1.422l.015-.113c.07-.518.157-1.17.157-1.637 0-.922-.151-1.719-.656-2.3-.51-.589-1.247-.797-2.01-.884zM4.5 13.3c.705.088 1.39.284 2.072.478l.441.125c1.096.305 2.334.598 3.987.598 1.794 0 2.28-.223 2.528-.549.147-.193.276-.505.394-1.07.105-.502.188-1.124.295-1.93l.04-.3c.25-1.882.189-2.933-.068-3.497a.922.922 0 00-.442-.48c-.208-.104-.52-.174-.997-.174H11c-.686 0-1.295-.577-1.206-1.336.023-.192.05-.39.076-.586.065-.488.13-.97.13-1.328 0-.809-.144-1.15-.288-1.316-.137-.158-.402-.304-1.048-.378C8.357 1.521 8 1.793 8 2.25v.5c0 1.922-.978 3.128-1.933 3.825a5.861 5.861 0 01-1.567.81V13.3zM2.75 6.5a.25.25 0 01.25.25v7.5a.25.25 0 01-.25.25h-1a.25.25 0 01-.25-.25v-7.5a.25.25 0 01.25-.25h1z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12.596 2.043c-1.301-.092-2.303.986-2.303 2.206v1.053c0 2.666-1.813 3.785-2.774 4.2a1.866 1.866 0 01-.523.131A1.75 1.75 0 005.25 8h-1.5A1.75 1.75 0 002 9.75v10.5c0 .967.784 1.75 1.75 1.75h1.5a1.75 1.75 0 001.742-1.58c.838.06 1.667.296 2.69.586l.602.17c1.464.406 3.213.824 5.544.824 2.188 0 3.693-.204 4.583-1.372.422-.554.65-1.255.816-2.05.148-.708.262-1.57.396-2.58l.051-.39c.319-2.386.328-4.18-.223-5.394-.293-.644-.743-1.125-1.355-1.431-.59-.296-1.284-.404-2.036-.404h-2.05l.056-.429c.025-.18.05-.372.076-.572.06-.483.117-1.006.117-1.438 0-1.245-.222-2.253-.92-2.941-.684-.675-1.668-.88-2.743-.956zM7 18.918c1.059.064 2.079.355 3.118.652l.568.16c1.406.39 3.006.77 5.142.77 2.277 0 3.004-.274 3.39-.781.216-.283.388-.718.54-1.448.136-.65.242-1.45.379-2.477l.05-.384c.32-2.4.253-3.795-.102-4.575-.16-.352-.375-.568-.66-.711-.305-.153-.74-.245-1.365-.245h-2.37c-.681 0-1.293-.57-1.211-1.328.026-.243.065-.537.105-.834l.07-.527c.06-.482.105-.921.105-1.25 0-1.125-.213-1.617-.473-1.873-.275-.27-.774-.455-1.795-.528-.351-.024-.698.274-.698.71v1.053c0 3.55-2.488 5.063-3.68 5.577-.372.16-.754.232-1.113.26v7.78zM3.75 20.5a.25.25 0 01-.25-.25V9.75a.25.25 0 01.25-.25h1.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25h-1.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ThumbsupIcon.defaultProps = {
  className: 'octicon octicon-thumbsup',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ToolsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.433 2.304A4.494 4.494 0 003.5 6c0 1.598.832 3.002 2.09 3.802.518.328.929.923.902 1.64v.008l-.164 3.337a.75.75 0 11-1.498-.073l.163-3.33c.002-.085-.05-.216-.207-.316A5.996 5.996 0 012 6a5.994 5.994 0 012.567-4.92 1.482 1.482 0 011.673-.04c.462.296.76.827.76 1.423v2.82c0 .082.041.16.11.206l.75.51a.25.25 0 00.28 0l.75-.51A.25.25 0 009 5.282V2.463c0-.596.298-1.127.76-1.423a1.482 1.482 0 011.673.04A5.994 5.994 0 0114 6a5.996 5.996 0 01-2.786 5.068c-.157.1-.209.23-.207.315l.163 3.33a.75.75 0 11-1.498.074l-.164-3.345c-.027-.717.384-1.312.902-1.64A4.496 4.496 0 0012.5 6a4.494 4.494 0 00-1.933-3.696c-.024.017-.067.067-.067.16v2.818a1.75 1.75 0 01-.767 1.448l-.75.51a1.75 1.75 0 01-1.966 0l-.75-.51A1.75 1.75 0 015.5 5.282V2.463c0-.092-.043-.142-.067-.159zm.01-.005z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.875 2.292a.125.125 0 00-.032.018A7.24 7.24 0 004.75 8.25a7.247 7.247 0 003.654 6.297c.57.327.982.955.941 1.682v.002l-.317 6.058a.75.75 0 11-1.498-.078l.317-6.062v-.004c.006-.09-.047-.215-.188-.296A8.747 8.747 0 013.25 8.25a8.74 8.74 0 013.732-7.169 1.547 1.547 0 011.709-.064c.484.292.809.835.809 1.46v4.714a.25.25 0 00.119.213l2.25 1.385c.08.05.182.05.262 0l2.25-1.385a.25.25 0 00.119-.213V2.478c0-.626.325-1.169.81-1.461a1.547 1.547 0 011.708.064 8.74 8.74 0 013.732 7.17 8.747 8.747 0 01-4.41 7.598c-.14.081-.193.206-.188.296v.004l.318 6.062a.75.75 0 11-1.498.078l-.317-6.058v-.002c-.041-.727.37-1.355.94-1.682A7.247 7.247 0 0019.25 8.25a7.24 7.24 0 00-3.093-5.94.125.125 0 00-.032-.018l-.01-.001c-.003 0-.014 0-.031.01-.036.022-.084.079-.084.177V7.19a1.75 1.75 0 01-.833 1.49l-2.25 1.385a1.75 1.75 0 01-1.834 0l-2.25-1.384A1.75 1.75 0 018 7.192V2.477c0-.098-.048-.155-.084-.176a.062.062 0 00-.031-.011l-.01.001z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ToolsIcon.defaultProps = {
  className: 'octicon octicon-tools',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TrashIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z\"></path><path d=\"M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z\"></path><path d=\"M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TrashIcon.defaultProps = {
  className: 'octicon octicon-trash',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TriangleDownIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M4.427 7.427l3.396 3.396a.25.25 0 00.354 0l3.396-3.396A.25.25 0 0011.396 7H4.604a.25.25 0 00-.177.427z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M11.646 15.146L5.854 9.354a.5.5 0 01.353-.854h11.586a.5.5 0 01.353.854l-5.793 5.792a.5.5 0 01-.707 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TriangleDownIcon.defaultProps = {
  className: 'octicon octicon-triangle-down',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TriangleLeftIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M9.573 4.427L6.177 7.823a.25.25 0 000 .354l3.396 3.396a.25.25 0 00.427-.177V4.604a.25.25 0 00-.427-.177z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M8.854 11.646l5.792-5.792a.5.5 0 01.854.353v11.586a.5.5 0 01-.854.353l-5.792-5.792a.5.5 0 010-.708z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TriangleLeftIcon.defaultProps = {
  className: 'octicon octicon-triangle-left',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TriangleRightIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M6.427 4.427l3.396 3.396a.25.25 0 010 .354l-3.396 3.396A.25.25 0 016 11.396V4.604a.25.25 0 01.427-.177z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M15.146 12.354l-5.792 5.792a.5.5 0 01-.854-.353V6.207a.5.5 0 01.854-.353l5.792 5.792a.5.5 0 010 .708z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TriangleRightIcon.defaultProps = {
  className: 'octicon octicon-triangle-right',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TriangleUpIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M4.427 9.573l3.396-3.396a.25.25 0 01.354 0l3.396 3.396a.25.25 0 01-.177.427H4.604a.25.25 0 01-.177-.427z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M12.354 8.854l5.792 5.792a.5.5 0 01-.353.854H6.207a.5.5 0 01-.353-.854l5.792-5.792a.5.5 0 01.708 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TriangleUpIcon.defaultProps = {
  className: 'octicon octicon-triangle-up',
  size: 16,
  verticalAlign: 'text-bottom'
};

function TypographyIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.21 8.5L4.574 3.594 2.857 8.5H6.21zm.5 1.5l.829 2.487a.75.75 0 001.423-.474L5.735 2.332a1.216 1.216 0 00-2.302-.018l-3.39 9.688a.75.75 0 001.415.496L2.332 10H6.71zm3.13-4.358C10.53 4.374 11.87 4 13 4c1.5 0 3 .939 3 2.601v5.649a.75.75 0 01-1.448.275C13.995 12.82 13.3 13 12.5 13c-.77 0-1.514-.231-2.078-.709-.577-.488-.922-1.199-.922-2.041 0-.694.265-1.411.887-1.944C11 7.78 11.88 7.5 13 7.5h1.5v-.899c0-.54-.5-1.101-1.5-1.101-.869 0-1.528.282-1.84.858a.75.75 0 11-1.32-.716zM14.5 9H13c-.881 0-1.375.22-1.637.444-.253.217-.363.5-.363.806 0 .408.155.697.39.896.249.21.63.354 1.11.354.732 0 1.26-.209 1.588-.449.35-.257.412-.495.412-.551V9z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10.414 15l1.63 4.505a.75.75 0 001.411-.51l-5.08-14.03a1.463 1.463 0 00-2.75 0l-5.08 14.03a.75.75 0 101.41.51L3.586 15h6.828zm-.544-1.5L7 5.572 4.13 13.5h5.74zm5.076-3.598c.913-1.683 2.703-2.205 4.284-2.205 1.047 0 2.084.312 2.878.885.801.577 1.392 1.455 1.392 2.548v8.12a.75.75 0 01-1.5 0v-.06a3.123 3.123 0 01-.044.025c-.893.52-2.096.785-3.451.785-1.051 0-2.048-.315-2.795-.948-.76-.643-1.217-1.578-1.217-2.702 0-.919.349-1.861 1.168-2.563.81-.694 2-1.087 3.569-1.087H22v-1.57c0-.503-.263-.967-.769-1.332-.513-.37-1.235-.6-2.001-.6-1.319 0-2.429.43-2.966 1.42a.75.75 0 01-1.318-.716zM22 14.2h-2.77c-1.331 0-2.134.333-2.593.726a1.82 1.82 0 00-.644 1.424c0 .689.267 1.203.686 1.557.43.365 1.065.593 1.826.593 1.183 0 2.102-.235 2.697-.581.582-.34.798-.74.798-1.134V14.2z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

TypographyIcon.defaultProps = {
  className: 'octicon octicon-typography',
  size: 16,
  verticalAlign: 'text-bottom'
};

function UnfoldIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path d=\"M8.177.677l2.896 2.896a.25.25 0 01-.177.427H8.75v1.25a.75.75 0 01-1.5 0V4H5.104a.25.25 0 01-.177-.427L7.823.677a.25.25 0 01.354 0zM7.25 10.75a.75.75 0 011.5 0V12h2.146a.25.25 0 01.177.427l-2.896 2.896a.25.25 0 01-.354 0l-2.896-2.896A.25.25 0 015.104 12H7.25v-1.25zm-5-2a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM6 8a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5A.75.75 0 016 8zm2.25.75a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5zM12 8a.75.75 0 01-.75.75h-.5a.75.75 0 010-1.5h.5A.75.75 0 0112 8zm2.25.75a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5h.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M12 23a.75.75 0 01-.53-.22l-3.25-3.25a.75.75 0 111.06-1.06L12 21.19l2.72-2.72a.75.75 0 111.06 1.06l-3.25 3.25A.75.75 0 0112 23z\"></path><path fill-rule=\"evenodd\" d=\"M12 22.25a.75.75 0 01-.75-.75v-5.75a.75.75 0 011.5 0v5.75a.75.75 0 01-.75.75zM10.75 12a.75.75 0 01.75-.75h1a.75.75 0 110 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm-8 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm12 0a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zM11.47 1.22a.75.75 0 011.06 0l3.25 3.25a.75.75 0 01-1.06 1.06L12 2.81 9.28 5.53a.75.75 0 01-1.06-1.06l3.25-3.25z\"></path><path fill-rule=\"evenodd\" d=\"M12 1.5a.75.75 0 01.75.75v6a.75.75 0 01-1.5 0v-6A.75.75 0 0112 1.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

UnfoldIcon.defaultProps = {
  className: 'octicon octicon-unfold',
  size: 16,
  verticalAlign: 'text-bottom'
};

function UnlockIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M5.5 4a2.5 2.5 0 014.607-1.346.75.75 0 101.264-.808A4 4 0 004 4v2h-.501A1.5 1.5 0 002 7.5v6A1.5 1.5 0 003.5 15h9a1.5 1.5 0 001.5-1.5v-6A1.5 1.5 0 0012.5 6h-7V4zm-.75 3.5H3.5v6h9v-6H4.75z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M7.5 7.25C7.5 4.58 9.422 2.5 12 2.5c2.079 0 3.71 1.34 4.282 3.242a.75.75 0 101.436-.432C16.971 2.825 14.792 1 12 1 8.503 1 6 3.845 6 7.25V9h-.5A2.5 2.5 0 003 11.5v8A2.5 2.5 0 005.5 22h13a2.5 2.5 0 002.5-2.5v-8A2.5 2.5 0 0018.5 9h-11V7.25zm-3 4.25a1 1 0 011-1h13a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1v-8z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

UnlockIcon.defaultProps = {
  className: 'octicon octicon-unlock',
  size: 16,
  verticalAlign: 'text-bottom'
};

function UnmuteIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.563 2.069A.75.75 0 018 2.75v10.5a.75.75 0 01-1.238.57L3.472 11H1.75A1.75 1.75 0 010 9.25v-2.5C0 5.784.784 5 1.75 5h1.723l3.289-2.82a.75.75 0 01.801-.111zM6.5 4.38L4.238 6.319a.75.75 0 01-.488.181h-2a.25.25 0 00-.25.25v2.5c0 .138.112.25.25.25h2a.75.75 0 01.488.18L6.5 11.62V4.38zm6.096-2.038a.75.75 0 011.06 0 8 8 0 010 11.314.75.75 0 01-1.06-1.06 6.5 6.5 0 000-9.193.75.75 0 010-1.06v-.001zm-1.06 2.121a.75.75 0 10-1.061 1.061 3.5 3.5 0 010 4.95.75.75 0 101.06 1.06 5 5 0 000-7.07l.001-.001z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M11.553 3.064A.75.75 0 0112 3.75v16.5a.75.75 0 01-1.255.555L5.46 16H2.75A1.75 1.75 0 011 14.25v-4.5C1 8.784 1.784 8 2.75 8h2.71l5.285-4.805a.75.75 0 01.808-.13zM10.5 5.445l-4.245 3.86a.75.75 0 01-.505.195h-3a.25.25 0 00-.25.25v4.5c0 .138.112.25.25.25h3a.75.75 0 01.505.195l4.245 3.86V5.445z\"></path><path d=\"M18.718 4.222a.75.75 0 011.06 0c4.296 4.296 4.296 11.26 0 15.556a.75.75 0 01-1.06-1.06 9.5 9.5 0 000-13.436.75.75 0 010-1.06z\"></path><path d=\"M16.243 7.757a.75.75 0 10-1.061 1.061 4.5 4.5 0 010 6.364.75.75 0 001.06 1.06 6 6 0 000-8.485z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

UnmuteIcon.defaultProps = {
  className: 'octicon octicon-unmute',
  size: 16,
  verticalAlign: 'text-bottom'
};

function UnverifiedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M6.415.52a2.678 2.678 0 013.17 0l.928.68c.153.113.33.186.518.215l1.138.175a2.678 2.678 0 012.241 2.24l.175 1.138c.029.187.102.365.215.518l.68.928a2.678 2.678 0 010 3.17l-.68.928a1.179 1.179 0 00-.215.518l-.175 1.138a2.678 2.678 0 01-2.241 2.241l-1.138.175a1.179 1.179 0 00-.518.215l-.928.68a2.678 2.678 0 01-3.17 0l-.928-.68a1.179 1.179 0 00-.518-.215L3.83 14.41a2.678 2.678 0 01-2.24-2.24l-.175-1.138a1.179 1.179 0 00-.215-.518l-.68-.928a2.678 2.678 0 010-3.17l.68-.928a1.17 1.17 0 00.215-.518l.175-1.14a2.678 2.678 0 012.24-2.24l1.138-.175c.187-.029.365-.102.518-.215l.928-.68zm2.282 1.209a1.178 1.178 0 00-1.394 0l-.928.68a2.678 2.678 0 01-1.18.489l-1.136.174a1.178 1.178 0 00-.987.987l-.174 1.137a2.678 2.678 0 01-.489 1.18l-.68.927c-.305.415-.305.98 0 1.394l.68.928c.256.348.423.752.489 1.18l.174 1.136c.078.51.478.909.987.987l1.137.174c.427.066.831.233 1.18.489l.927.68c.415.305.98.305 1.394 0l.928-.68a2.678 2.678 0 011.18-.489l1.136-.174c.51-.078.909-.478.987-.987l.174-1.137c.066-.427.233-.831.489-1.18l.68-.927c.305-.415.305-.98 0-1.394l-.68-.928a2.678 2.678 0 01-.489-1.18l-.174-1.136a1.178 1.178 0 00-.987-.987l-1.137-.174a2.678 2.678 0 01-1.18-.489l-.927-.68zM9 11a1 1 0 11-2 0 1 1 0 012 0zM6.92 6.085c.081-.16.19-.299.34-.398.145-.097.371-.187.74-.187.28 0 .553.087.738.225A.613.613 0 019 6.25c0 .177-.04.264-.077.318a.956.956 0 01-.277.245c-.076.051-.158.1-.258.161l-.007.004c-.093.056-.204.122-.313.195a2.416 2.416 0 00-.692.661.75.75 0 001.248.832.956.956 0 01.276-.245 6.3 6.3 0 01.26-.16l.006-.004c.093-.057.204-.123.313-.195.222-.149.487-.355.692-.662.214-.32.329-.702.329-1.15 0-.76-.36-1.348-.862-1.725A2.76 2.76 0 008 4c-.631 0-1.154.16-1.572.438-.413.276-.68.638-.849.977a.75.75 0 001.342.67z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M13 16.5a1 1 0 11-2 0 1 1 0 012 0zm-2.517-7.665c.112-.223.268-.424.488-.57C11.186 8.12 11.506 8 12 8c.384 0 .766.118 1.034.319a.953.953 0 01.403.806c0 .48-.218.81-.62 1.186a9.293 9.293 0 01-.409.354 19.8 19.8 0 00-.294.249c-.246.213-.524.474-.738.795l-.126.19V13.5a.75.75 0 001.5 0v-1.12c.09-.1.203-.208.347-.333.063-.055.14-.119.222-.187.166-.14.358-.3.52-.452.536-.5 1.098-1.2 1.098-2.283a2.45 2.45 0 00-1.003-2.006C13.37 6.695 12.658 6.5 12 6.5c-.756 0-1.373.191-1.861.517a2.944 2.944 0 00-.997 1.148.75.75 0 001.341.67z\"></path><path fill-rule=\"evenodd\" d=\"M9.864 1.2a3.61 3.61 0 014.272 0l1.375 1.01c.274.2.593.333.929.384l1.686.259a3.61 3.61 0 013.021 3.02l.259 1.687c.051.336.183.655.384.929l1.01 1.375a3.61 3.61 0 010 4.272l-1.01 1.375a2.11 2.11 0 00-.384.929l-.259 1.686a3.61 3.61 0 01-3.02 3.021l-1.687.259a2.11 2.11 0 00-.929.384l-1.375 1.01a3.61 3.61 0 01-4.272 0l-1.375-1.01a2.11 2.11 0 00-.929-.384l-1.686-.259a3.61 3.61 0 01-3.021-3.02l-.259-1.687a2.11 2.11 0 00-.384-.929L1.2 14.136a3.61 3.61 0 010-4.272l1.01-1.375a2.11 2.11 0 00.384-.929l.259-1.686a3.61 3.61 0 013.02-3.021l1.687-.259a2.11 2.11 0 00.929-.384L9.864 1.2zm3.384 1.209a2.11 2.11 0 00-2.496 0l-1.376 1.01a3.61 3.61 0 01-1.589.658l-1.686.258a2.11 2.11 0 00-1.766 1.766l-.258 1.686a3.61 3.61 0 01-.658 1.59l-1.01 1.375a2.11 2.11 0 000 2.496l1.01 1.376a3.61 3.61 0 01.658 1.589l.258 1.686a2.11 2.11 0 001.766 1.765l1.686.26a3.61 3.61 0 011.59.657l1.375 1.01a2.11 2.11 0 002.496 0l1.376-1.01a3.61 3.61 0 011.589-.658l1.686-.258a2.11 2.11 0 001.765-1.766l.26-1.686a3.61 3.61 0 01.657-1.59l1.01-1.375a2.11 2.11 0 000-2.496l-1.01-1.376a3.61 3.61 0 01-.658-1.589l-.258-1.686a2.11 2.11 0 00-1.766-1.766l-1.686-.258a3.61 3.61 0 01-1.59-.658l-1.375-1.01z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

UnverifiedIcon.defaultProps = {
  className: 'octicon octicon-unverified',
  size: 16,
  verticalAlign: 'text-bottom'
};

function UploadIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M8.53 1.22a.75.75 0 00-1.06 0L3.72 4.97a.75.75 0 001.06 1.06l2.47-2.47v6.69a.75.75 0 001.5 0V3.56l2.47 2.47a.75.75 0 101.06-1.06L8.53 1.22zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M4.97 12.97a.75.75 0 101.06 1.06L11 9.06v12.19a.75.75 0 001.5 0V9.06l4.97 4.97a.75.75 0 101.06-1.06l-6.25-6.25a.75.75 0 00-1.06 0l-6.25 6.25zM4.75 3.5a.75.75 0 010-1.5h14.5a.75.75 0 010 1.5H4.75z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

UploadIcon.defaultProps = {
  className: 'octicon octicon-upload',
  size: 16,
  verticalAlign: 'text-bottom'
};

function VerifiedIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M9.585.52a2.678 2.678 0 00-3.17 0l-.928.68a1.178 1.178 0 01-.518.215L3.83 1.59a2.678 2.678 0 00-2.24 2.24l-.175 1.14a1.178 1.178 0 01-.215.518l-.68.928a2.678 2.678 0 000 3.17l.68.928c.113.153.186.33.215.518l.175 1.138a2.678 2.678 0 002.24 2.24l1.138.175c.187.029.365.102.518.215l.928.68a2.678 2.678 0 003.17 0l.928-.68a1.17 1.17 0 01.518-.215l1.138-.175a2.678 2.678 0 002.241-2.241l.175-1.138c.029-.187.102-.365.215-.518l.68-.928a2.678 2.678 0 000-3.17l-.68-.928a1.179 1.179 0 01-.215-.518L14.41 3.83a2.678 2.678 0 00-2.24-2.24l-1.138-.175a1.179 1.179 0 01-.518-.215L9.585.52zM7.303 1.728c.415-.305.98-.305 1.394 0l.928.68c.348.256.752.423 1.18.489l1.136.174c.51.078.909.478.987.987l.174 1.137c.066.427.233.831.489 1.18l.68.927c.305.415.305.98 0 1.394l-.68.928a2.678 2.678 0 00-.489 1.18l-.174 1.136a1.178 1.178 0 01-.987.987l-1.137.174a2.678 2.678 0 00-1.18.489l-.927.68c-.415.305-.98.305-1.394 0l-.928-.68a2.678 2.678 0 00-1.18-.489l-1.136-.174a1.178 1.178 0 01-.987-.987l-.174-1.137a2.678 2.678 0 00-.489-1.18l-.68-.927a1.178 1.178 0 010-1.394l.68-.928c.256-.348.423-.752.489-1.18l.174-1.136c.078-.51.478-.909.987-.987l1.137-.174a2.678 2.678 0 001.18-.489l.927-.68zM11.28 6.78a.75.75 0 00-1.06-1.06L7 8.94 5.78 7.72a.75.75 0 00-1.06 1.06l1.75 1.75a.75.75 0 001.06 0l3.75-3.75z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M17.03 9.78a.75.75 0 00-1.06-1.06l-5.47 5.47-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6-6z\"></path><path fill-rule=\"evenodd\" d=\"M14.136 1.2a3.61 3.61 0 00-4.272 0L8.489 2.21a2.11 2.11 0 01-.929.384l-1.686.259a3.61 3.61 0 00-3.021 3.02L2.594 7.56a2.11 2.11 0 01-.384.929L1.2 9.864a3.61 3.61 0 000 4.272l1.01 1.375c.2.274.333.593.384.929l.259 1.686a3.61 3.61 0 003.02 3.021l1.687.259c.336.051.655.183.929.384l1.375 1.01a3.61 3.61 0 004.272 0l1.375-1.01a2.11 2.11 0 01.929-.384l1.686-.259a3.61 3.61 0 003.021-3.02l.259-1.687a2.11 2.11 0 01.384-.929l1.01-1.375a3.61 3.61 0 000-4.272l-1.01-1.375a2.11 2.11 0 01-.384-.929l-.259-1.686a3.61 3.61 0 00-3.02-3.021l-1.687-.259a2.11 2.11 0 01-.929-.384L14.136 1.2zm-3.384 1.209a2.11 2.11 0 012.496 0l1.376 1.01a3.61 3.61 0 001.589.658l1.686.258a2.11 2.11 0 011.765 1.766l.26 1.686a3.61 3.61 0 00.657 1.59l1.01 1.375a2.11 2.11 0 010 2.496l-1.01 1.376a3.61 3.61 0 00-.658 1.589l-.258 1.686a2.11 2.11 0 01-1.766 1.765l-1.686.26a3.61 3.61 0 00-1.59.657l-1.375 1.01a2.11 2.11 0 01-2.496 0l-1.376-1.01a3.61 3.61 0 00-1.589-.658l-1.686-.258a2.11 2.11 0 01-1.766-1.766l-.258-1.686a3.61 3.61 0 00-.658-1.59l-1.01-1.375a2.11 2.11 0 010-2.496l1.01-1.376a3.61 3.61 0 00.658-1.589l.258-1.686a2.11 2.11 0 011.766-1.766l1.686-.258a3.61 3.61 0 001.59-.658l1.375-1.01z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

VerifiedIcon.defaultProps = {
  className: 'octicon octicon-verified',
  size: 16,
  verticalAlign: 'text-bottom'
};

function VersionsIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M7.75 14A1.75 1.75 0 016 12.25v-8.5C6 2.784 6.784 2 7.75 2h6.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0114.25 14h-6.5zm-.25-1.75c0 .138.112.25.25.25h6.5a.25.25 0 00.25-.25v-8.5a.25.25 0 00-.25-.25h-6.5a.25.25 0 00-.25.25v8.5zM4.9 3.508a.75.75 0 01-.274 1.025.25.25 0 00-.126.217v6.5a.25.25 0 00.126.217.75.75 0 01-.752 1.298A1.75 1.75 0 013 11.25v-6.5c0-.649.353-1.214.874-1.516a.75.75 0 011.025.274zM1.625 5.533a.75.75 0 10-.752-1.299A1.75 1.75 0 000 5.75v4.5c0 .649.353 1.214.874 1.515a.75.75 0 10.752-1.298.25.25 0 01-.126-.217v-4.5a.25.25 0 01.126-.217z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M10 22a2 2 0 01-2-2V4a2 2 0 012-2h11a2 2 0 012 2v16a2 2 0 01-2 2H10zm-.5-2a.5.5 0 00.5.5h11a.5.5 0 00.5-.5V4a.5.5 0 00-.5-.5H10a.5.5 0 00-.5.5v16zM6.17 4.165a.75.75 0 01-.335 1.006c-.228.114-.295.177-.315.201a.037.037 0 00-.008.016.387.387 0 00-.012.112v13c0 .07.008.102.012.112a.03.03 0 00.008.016c.02.024.087.087.315.201a.75.75 0 11-.67 1.342c-.272-.136-.58-.315-.81-.598C4.1 19.259 4 18.893 4 18.5v-13c0-.393.1-.759.355-1.073.23-.283.538-.462.81-.598a.75.75 0 011.006.336zM2.15 5.624a.75.75 0 01-.274 1.025c-.15.087-.257.17-.32.245C1.5 6.96 1.5 6.99 1.5 7v10c0 .01 0 .04.056.106.063.074.17.158.32.245a.75.75 0 11-.752 1.298C.73 18.421 0 17.907 0 17V7c0-.907.73-1.42 1.124-1.65a.75.75 0 011.025.274z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

VersionsIcon.defaultProps = {
  className: 'octicon octicon-versions',
  size: 16,
  verticalAlign: 'text-bottom'
};

function VideoIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 3.5a.25.25 0 00-.25.25v8.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-8.5a.25.25 0 00-.25-.25H1.75zM0 3.75C0 2.784.784 2 1.75 2h12.5c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0114.25 14H1.75A1.75 1.75 0 010 12.25v-8.5z\"></path><path d=\"M6 10.559V5.442a.25.25 0 01.379-.215l4.264 2.559a.25.25 0 010 .428l-4.264 2.559A.25.25 0 016 10.559z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1.75 4.5a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V4.75a.25.25 0 00-.25-.25H1.75zM0 4.75C0 3.784.784 3 1.75 3h20.5c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0122.25 21H1.75A1.75 1.75 0 010 19.25V4.75z\"></path><path d=\"M9 15.584V8.416a.5.5 0 01.77-.42l5.576 3.583a.5.5 0 010 .842L9.77 16.005a.5.5 0 01-.77-.42z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

VideoIcon.defaultProps = {
  className: 'octicon octicon-video',
  size: 16,
  verticalAlign: 'text-bottom'
};

function WorkflowIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M0 1.75C0 .784.784 0 1.75 0h3.5C6.216 0 7 .784 7 1.75v3.5A1.75 1.75 0 015.25 7H4v4a1 1 0 001 1h4v-1.25C9 9.784 9.784 9 10.75 9h3.5c.966 0 1.75.784 1.75 1.75v3.5A1.75 1.75 0 0114.25 16h-3.5A1.75 1.75 0 019 14.25v-.75H5A2.5 2.5 0 012.5 11V7h-.75A1.75 1.75 0 010 5.25v-3.5zm1.75-.25a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h3.5a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25h-3.5zm9 9a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h3.5a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25h-3.5z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1 3a2 2 0 012-2h6.5a2 2 0 012 2v6.5a2 2 0 01-2 2H7v4.063C7 16.355 7.644 17 8.438 17H12.5v-2.5a2 2 0 012-2H21a2 2 0 012 2V21a2 2 0 01-2 2h-6.5a2 2 0 01-2-2v-2.5H8.437A2.938 2.938 0 015.5 15.562V11.5H3a2 2 0 01-2-2V3zm2-.5a.5.5 0 00-.5.5v6.5a.5.5 0 00.5.5h6.5a.5.5 0 00.5-.5V3a.5.5 0 00-.5-.5H3zM14.5 14a.5.5 0 00-.5.5V21a.5.5 0 00.5.5H21a.5.5 0 00.5-.5v-6.5a.5.5 0 00-.5-.5h-6.5z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

WorkflowIcon.defaultProps = {
  className: 'octicon octicon-workflow',
  size: 16,
  verticalAlign: 'text-bottom'
};

function XIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M5.72 5.72a.75.75 0 011.06 0L12 10.94l5.22-5.22a.75.75 0 111.06 1.06L13.06 12l5.22 5.22a.75.75 0 11-1.06 1.06L12 13.06l-5.22 5.22a.75.75 0 01-1.06-1.06L10.94 12 5.72 6.78a.75.75 0 010-1.06z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

XIcon.defaultProps = {
  className: 'octicon octicon-x',
  size: 16,
  verticalAlign: 'text-bottom'
};

function XCircleIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M3.404 12.596a6.5 6.5 0 119.192-9.192 6.5 6.5 0 01-9.192 9.192zM2.344 2.343a8 8 0 1011.313 11.314A8 8 0 002.343 2.343zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z\"></path>" }, "24": { "width": 24, "path": "<path d=\"M9.036 7.976a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z\"></path><path fill-rule=\"evenodd\" d=\"M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

XCircleIcon.defaultProps = {
  className: 'octicon octicon-x-circle',
  size: 16,
  verticalAlign: 'text-bottom'
};

function XCircleFillIcon(props) {
  var svgDataByHeight = { "12": { "width": 12, "path": "<path fill-rule=\"evenodd\" d=\"M1.757 10.243a6 6 0 118.486-8.486 6 6 0 01-8.486 8.486zM6 4.763l-2-2L2.763 4l2 2-2 2L4 9.237l2-2 2 2L9.237 8l-2-2 2-2L8 2.763l-2 2z\"></path>" }, "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M2.343 13.657A8 8 0 1113.657 2.343 8 8 0 012.343 13.657zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

XCircleFillIcon.defaultProps = {
  className: 'octicon octicon-x-circle-fill',
  size: 16,
  verticalAlign: 'text-bottom'
};

function ZapIcon(props) {
  var svgDataByHeight = { "16": { "width": 16, "path": "<path fill-rule=\"evenodd\" d=\"M10.561 1.5a.016.016 0 00-.01.004L3.286 8.571A.25.25 0 003.462 9H6.75a.75.75 0 01.694 1.034l-1.713 4.188 6.982-6.793A.25.25 0 0012.538 7H9.25a.75.75 0 01-.683-1.06l2.008-4.418.003-.006a.02.02 0 00-.004-.009.02.02 0 00-.006-.006L10.56 1.5zM9.504.43a1.516 1.516 0 012.437 1.713L10.415 5.5h2.123c1.57 0 2.346 1.909 1.22 3.004l-7.34 7.142a1.25 1.25 0 01-.871.354h-.302a1.25 1.25 0 01-1.157-1.723L5.633 10.5H3.462c-1.57 0-2.346-1.909-1.22-3.004L9.503.429z\"></path>" }, "24": { "width": 24, "path": "<path fill-rule=\"evenodd\" d=\"M16.168 2.924L4.51 13.061a.25.25 0 00.164.439h5.45a.75.75 0 01.692 1.041l-2.559 6.066 11.215-9.668a.25.25 0 00-.164-.439H14a.75.75 0 01-.687-1.05l2.855-6.526zm-.452-1.595a1.341 1.341 0 012.109 1.55L15.147 9h4.161c1.623 0 2.372 2.016 1.143 3.075L8.102 22.721a1.149 1.149 0 01-1.81-1.317L8.996 15H4.674c-1.619 0-2.37-2.008-1.148-3.07l12.19-10.6z\"></path>" } };
  return react__WEBPACK_IMPORTED_MODULE_0__.createElement('svg', getSvgProps(_extends({}, props, { svgDataByHeight: svgDataByHeight })));
}

ZapIcon.defaultProps = {
  className: 'octicon octicon-zap',
  size: 16,
  verticalAlign: 'text-bottom'
};

function _objectWithoutProperties(obj, keys) { var target = {}; for (var i in obj) { if (keys.indexOf(i) >= 0) continue; if (!Object.prototype.hasOwnProperty.call(obj, i)) continue; target[i] = obj[i]; } return target; }

function Octicon(_ref) {
  var Icon = _ref.icon,
      children = _ref.children,
      props = _objectWithoutProperties(_ref, ['icon', 'children']);

  // eslint-disable-next-line no-console
  console.warn(
  // eslint-disable-next-line github/unescaped-html-literal
  '<Octicon> is deprecated. Use icon components on their own instead (e.g. <Octicon icon={AlertIcon} /> → <AlertIcon />)');
  return typeof Icon === 'function' ? react__WEBPACK_IMPORTED_MODULE_0__.createElement(Icon, props) : react__WEBPACK_IMPORTED_MODULE_0__.cloneElement(react__WEBPACK_IMPORTED_MODULE_0__.Children.only(children), props);
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Octicon);



/***/ }),

/***/ "./resources/js/client/components/list/index.js":
/*!******************************************************!*\
  !*** ./resources/js/client/components/list/index.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/List/List.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/ThemeIcon/ThemeIcon.js");
/* harmony import */ var _primer_octicons_react__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @primer/octicons-react */ "./node_modules/@primer/octicons-react/dist/index.esm.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
/**
 * External Dependencies
 */





var ListComponent = function ListComponent(_ref) {
  var data = _ref.data;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_2__.List, {
    spacing: "xs",
    size: "sm",
    center: true,
    icon: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.ThemeIcon, {
      color: "teal",
      size: 24,
      radius: "xl",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_primer_octicons_react__WEBPACK_IMPORTED_MODULE_4__.IssueClosedIcon, {
        size: 12
      })
    }),
    children: data != undefined && data.map(function (item, index) {
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_2__.List.Item, {
        children: item.title
      }, index);
    })
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ListComponent);

/***/ }),

/***/ "./node_modules/clsx/dist/clsx.m.js":
/*!******************************************!*\
  !*** ./node_modules/clsx/dist/clsx.m.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* export default binding */ __WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function toVal(mix) {
	var k, y, str='';

	if (typeof mix === 'string' || typeof mix === 'number') {
		str += mix;
	} else if (typeof mix === 'object') {
		if (Array.isArray(mix)) {
			for (k=0; k < mix.length; k++) {
				if (mix[k]) {
					if (y = toVal(mix[k])) {
						str && (str += ' ');
						str += y;
					}
				}
			}
		} else {
			for (k in mix) {
				if (mix[k]) {
					str && (str += ' ');
					str += k;
				}
			}
		}
	}

	return str;
}

/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__() {
	var i=0, tmp, x, str='';
	while (i < arguments.length) {
		if (tmp = arguments[i++]) {
			if (x = toVal(tmp)) {
				str && (str += ' ');
				str += x
			}
		}
	}
	return str;
}


/***/ }),

/***/ "./node_modules/hoist-non-react-statics/dist/hoist-non-react-statics.cjs.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/hoist-non-react-statics/dist/hoist-non-react-statics.cjs.js ***!
  \**********************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



var reactIs = __webpack_require__(/*! react-is */ "./node_modules/hoist-non-react-statics/node_modules/react-is/index.js");

/**
 * Copyright 2015, Yahoo! Inc.
 * Copyrights licensed under the New BSD License. See the accompanying LICENSE file for terms.
 */
var REACT_STATICS = {
  childContextTypes: true,
  contextType: true,
  contextTypes: true,
  defaultProps: true,
  displayName: true,
  getDefaultProps: true,
  getDerivedStateFromError: true,
  getDerivedStateFromProps: true,
  mixins: true,
  propTypes: true,
  type: true
};
var KNOWN_STATICS = {
  name: true,
  length: true,
  prototype: true,
  caller: true,
  callee: true,
  arguments: true,
  arity: true
};
var FORWARD_REF_STATICS = {
  '$$typeof': true,
  render: true,
  defaultProps: true,
  displayName: true,
  propTypes: true
};
var MEMO_STATICS = {
  '$$typeof': true,
  compare: true,
  defaultProps: true,
  displayName: true,
  propTypes: true,
  type: true
};
var TYPE_STATICS = {};
TYPE_STATICS[reactIs.ForwardRef] = FORWARD_REF_STATICS;
TYPE_STATICS[reactIs.Memo] = MEMO_STATICS;

function getStatics(component) {
  // React v16.11 and below
  if (reactIs.isMemo(component)) {
    return MEMO_STATICS;
  } // React v16.12 and above


  return TYPE_STATICS[component['$$typeof']] || REACT_STATICS;
}

var defineProperty = Object.defineProperty;
var getOwnPropertyNames = Object.getOwnPropertyNames;
var getOwnPropertySymbols = Object.getOwnPropertySymbols;
var getOwnPropertyDescriptor = Object.getOwnPropertyDescriptor;
var getPrototypeOf = Object.getPrototypeOf;
var objectPrototype = Object.prototype;
function hoistNonReactStatics(targetComponent, sourceComponent, blacklist) {
  if (typeof sourceComponent !== 'string') {
    // don't hoist over string (html) components
    if (objectPrototype) {
      var inheritedComponent = getPrototypeOf(sourceComponent);

      if (inheritedComponent && inheritedComponent !== objectPrototype) {
        hoistNonReactStatics(targetComponent, inheritedComponent, blacklist);
      }
    }

    var keys = getOwnPropertyNames(sourceComponent);

    if (getOwnPropertySymbols) {
      keys = keys.concat(getOwnPropertySymbols(sourceComponent));
    }

    var targetStatics = getStatics(targetComponent);
    var sourceStatics = getStatics(sourceComponent);

    for (var i = 0; i < keys.length; ++i) {
      var key = keys[i];

      if (!KNOWN_STATICS[key] && !(blacklist && blacklist[key]) && !(sourceStatics && sourceStatics[key]) && !(targetStatics && targetStatics[key])) {
        var descriptor = getOwnPropertyDescriptor(sourceComponent, key);

        try {
          // Avoid failures from read-only properties
          defineProperty(targetComponent, key, descriptor);
        } catch (e) {}
      }
    }
  }

  return targetComponent;
}

module.exports = hoistNonReactStatics;


/***/ }),

/***/ "./node_modules/hoist-non-react-statics/node_modules/react-is/cjs/react-is.development.js":
/*!************************************************************************************************!*\
  !*** ./node_modules/hoist-non-react-statics/node_modules/react-is/cjs/react-is.development.js ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, exports) => {

/** @license React v16.13.1
 * react-is.development.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */





if (true) {
  (function() {
'use strict';

// The Symbol used to tag the ReactElement-like types. If there is no native Symbol
// nor polyfill, then a plain number is used for performance.
var hasSymbol = typeof Symbol === 'function' && Symbol.for;
var REACT_ELEMENT_TYPE = hasSymbol ? Symbol.for('react.element') : 0xeac7;
var REACT_PORTAL_TYPE = hasSymbol ? Symbol.for('react.portal') : 0xeaca;
var REACT_FRAGMENT_TYPE = hasSymbol ? Symbol.for('react.fragment') : 0xeacb;
var REACT_STRICT_MODE_TYPE = hasSymbol ? Symbol.for('react.strict_mode') : 0xeacc;
var REACT_PROFILER_TYPE = hasSymbol ? Symbol.for('react.profiler') : 0xead2;
var REACT_PROVIDER_TYPE = hasSymbol ? Symbol.for('react.provider') : 0xeacd;
var REACT_CONTEXT_TYPE = hasSymbol ? Symbol.for('react.context') : 0xeace; // TODO: We don't use AsyncMode or ConcurrentMode anymore. They were temporary
// (unstable) APIs that have been removed. Can we remove the symbols?

var REACT_ASYNC_MODE_TYPE = hasSymbol ? Symbol.for('react.async_mode') : 0xeacf;
var REACT_CONCURRENT_MODE_TYPE = hasSymbol ? Symbol.for('react.concurrent_mode') : 0xeacf;
var REACT_FORWARD_REF_TYPE = hasSymbol ? Symbol.for('react.forward_ref') : 0xead0;
var REACT_SUSPENSE_TYPE = hasSymbol ? Symbol.for('react.suspense') : 0xead1;
var REACT_SUSPENSE_LIST_TYPE = hasSymbol ? Symbol.for('react.suspense_list') : 0xead8;
var REACT_MEMO_TYPE = hasSymbol ? Symbol.for('react.memo') : 0xead3;
var REACT_LAZY_TYPE = hasSymbol ? Symbol.for('react.lazy') : 0xead4;
var REACT_BLOCK_TYPE = hasSymbol ? Symbol.for('react.block') : 0xead9;
var REACT_FUNDAMENTAL_TYPE = hasSymbol ? Symbol.for('react.fundamental') : 0xead5;
var REACT_RESPONDER_TYPE = hasSymbol ? Symbol.for('react.responder') : 0xead6;
var REACT_SCOPE_TYPE = hasSymbol ? Symbol.for('react.scope') : 0xead7;

function isValidElementType(type) {
  return typeof type === 'string' || typeof type === 'function' || // Note: its typeof might be other than 'symbol' or 'number' if it's a polyfill.
  type === REACT_FRAGMENT_TYPE || type === REACT_CONCURRENT_MODE_TYPE || type === REACT_PROFILER_TYPE || type === REACT_STRICT_MODE_TYPE || type === REACT_SUSPENSE_TYPE || type === REACT_SUSPENSE_LIST_TYPE || typeof type === 'object' && type !== null && (type.$$typeof === REACT_LAZY_TYPE || type.$$typeof === REACT_MEMO_TYPE || type.$$typeof === REACT_PROVIDER_TYPE || type.$$typeof === REACT_CONTEXT_TYPE || type.$$typeof === REACT_FORWARD_REF_TYPE || type.$$typeof === REACT_FUNDAMENTAL_TYPE || type.$$typeof === REACT_RESPONDER_TYPE || type.$$typeof === REACT_SCOPE_TYPE || type.$$typeof === REACT_BLOCK_TYPE);
}

function typeOf(object) {
  if (typeof object === 'object' && object !== null) {
    var $$typeof = object.$$typeof;

    switch ($$typeof) {
      case REACT_ELEMENT_TYPE:
        var type = object.type;

        switch (type) {
          case REACT_ASYNC_MODE_TYPE:
          case REACT_CONCURRENT_MODE_TYPE:
          case REACT_FRAGMENT_TYPE:
          case REACT_PROFILER_TYPE:
          case REACT_STRICT_MODE_TYPE:
          case REACT_SUSPENSE_TYPE:
            return type;

          default:
            var $$typeofType = type && type.$$typeof;

            switch ($$typeofType) {
              case REACT_CONTEXT_TYPE:
              case REACT_FORWARD_REF_TYPE:
              case REACT_LAZY_TYPE:
              case REACT_MEMO_TYPE:
              case REACT_PROVIDER_TYPE:
                return $$typeofType;

              default:
                return $$typeof;
            }

        }

      case REACT_PORTAL_TYPE:
        return $$typeof;
    }
  }

  return undefined;
} // AsyncMode is deprecated along with isAsyncMode

var AsyncMode = REACT_ASYNC_MODE_TYPE;
var ConcurrentMode = REACT_CONCURRENT_MODE_TYPE;
var ContextConsumer = REACT_CONTEXT_TYPE;
var ContextProvider = REACT_PROVIDER_TYPE;
var Element = REACT_ELEMENT_TYPE;
var ForwardRef = REACT_FORWARD_REF_TYPE;
var Fragment = REACT_FRAGMENT_TYPE;
var Lazy = REACT_LAZY_TYPE;
var Memo = REACT_MEMO_TYPE;
var Portal = REACT_PORTAL_TYPE;
var Profiler = REACT_PROFILER_TYPE;
var StrictMode = REACT_STRICT_MODE_TYPE;
var Suspense = REACT_SUSPENSE_TYPE;
var hasWarnedAboutDeprecatedIsAsyncMode = false; // AsyncMode should be deprecated

function isAsyncMode(object) {
  {
    if (!hasWarnedAboutDeprecatedIsAsyncMode) {
      hasWarnedAboutDeprecatedIsAsyncMode = true; // Using console['warn'] to evade Babel and ESLint

      console['warn']('The ReactIs.isAsyncMode() alias has been deprecated, ' + 'and will be removed in React 17+. Update your code to use ' + 'ReactIs.isConcurrentMode() instead. It has the exact same API.');
    }
  }

  return isConcurrentMode(object) || typeOf(object) === REACT_ASYNC_MODE_TYPE;
}
function isConcurrentMode(object) {
  return typeOf(object) === REACT_CONCURRENT_MODE_TYPE;
}
function isContextConsumer(object) {
  return typeOf(object) === REACT_CONTEXT_TYPE;
}
function isContextProvider(object) {
  return typeOf(object) === REACT_PROVIDER_TYPE;
}
function isElement(object) {
  return typeof object === 'object' && object !== null && object.$$typeof === REACT_ELEMENT_TYPE;
}
function isForwardRef(object) {
  return typeOf(object) === REACT_FORWARD_REF_TYPE;
}
function isFragment(object) {
  return typeOf(object) === REACT_FRAGMENT_TYPE;
}
function isLazy(object) {
  return typeOf(object) === REACT_LAZY_TYPE;
}
function isMemo(object) {
  return typeOf(object) === REACT_MEMO_TYPE;
}
function isPortal(object) {
  return typeOf(object) === REACT_PORTAL_TYPE;
}
function isProfiler(object) {
  return typeOf(object) === REACT_PROFILER_TYPE;
}
function isStrictMode(object) {
  return typeOf(object) === REACT_STRICT_MODE_TYPE;
}
function isSuspense(object) {
  return typeOf(object) === REACT_SUSPENSE_TYPE;
}

exports.AsyncMode = AsyncMode;
exports.ConcurrentMode = ConcurrentMode;
exports.ContextConsumer = ContextConsumer;
exports.ContextProvider = ContextProvider;
exports.Element = Element;
exports.ForwardRef = ForwardRef;
exports.Fragment = Fragment;
exports.Lazy = Lazy;
exports.Memo = Memo;
exports.Portal = Portal;
exports.Profiler = Profiler;
exports.StrictMode = StrictMode;
exports.Suspense = Suspense;
exports.isAsyncMode = isAsyncMode;
exports.isConcurrentMode = isConcurrentMode;
exports.isContextConsumer = isContextConsumer;
exports.isContextProvider = isContextProvider;
exports.isElement = isElement;
exports.isForwardRef = isForwardRef;
exports.isFragment = isFragment;
exports.isLazy = isLazy;
exports.isMemo = isMemo;
exports.isPortal = isPortal;
exports.isProfiler = isProfiler;
exports.isStrictMode = isStrictMode;
exports.isSuspense = isSuspense;
exports.isValidElementType = isValidElementType;
exports.typeOf = typeOf;
  })();
}


/***/ }),

/***/ "./node_modules/hoist-non-react-statics/node_modules/react-is/index.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/hoist-non-react-statics/node_modules/react-is/index.js ***!
  \*****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



if (false) {} else {
  module.exports = __webpack_require__(/*! ./cjs/react-is.development.js */ "./node_modules/hoist-non-react-statics/node_modules/react-is/cjs/react-is.development.js");
}


/***/ }),

/***/ "./node_modules/object-assign/index.js":
/*!*********************************************!*\
  !*** ./node_modules/object-assign/index.js ***!
  \*********************************************/
/***/ ((module) => {

/*
object-assign
(c) Sindre Sorhus
@license MIT
*/


/* eslint-disable no-unused-vars */
var getOwnPropertySymbols = Object.getOwnPropertySymbols;
var hasOwnProperty = Object.prototype.hasOwnProperty;
var propIsEnumerable = Object.prototype.propertyIsEnumerable;

function toObject(val) {
	if (val === null || val === undefined) {
		throw new TypeError('Object.assign cannot be called with null or undefined');
	}

	return Object(val);
}

function shouldUseNative() {
	try {
		if (!Object.assign) {
			return false;
		}

		// Detect buggy property enumeration order in older V8 versions.

		// https://bugs.chromium.org/p/v8/issues/detail?id=4118
		var test1 = new String('abc');  // eslint-disable-line no-new-wrappers
		test1[5] = 'de';
		if (Object.getOwnPropertyNames(test1)[0] === '5') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test2 = {};
		for (var i = 0; i < 10; i++) {
			test2['_' + String.fromCharCode(i)] = i;
		}
		var order2 = Object.getOwnPropertyNames(test2).map(function (n) {
			return test2[n];
		});
		if (order2.join('') !== '0123456789') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test3 = {};
		'abcdefghijklmnopqrst'.split('').forEach(function (letter) {
			test3[letter] = letter;
		});
		if (Object.keys(Object.assign({}, test3)).join('') !==
				'abcdefghijklmnopqrst') {
			return false;
		}

		return true;
	} catch (err) {
		// We don't expect any of the above to throw, but better to be safe.
		return false;
	}
}

module.exports = shouldUseNative() ? Object.assign : function (target, source) {
	var from;
	var to = toObject(target);
	var symbols;

	for (var s = 1; s < arguments.length; s++) {
		from = Object(arguments[s]);

		for (var key in from) {
			if (hasOwnProperty.call(from, key)) {
				to[key] = from[key];
			}
		}

		if (getOwnPropertySymbols) {
			symbols = getOwnPropertySymbols(from);
			for (var i = 0; i < symbols.length; i++) {
				if (propIsEnumerable.call(from, symbols[i])) {
					to[symbols[i]] = from[symbols[i]];
				}
			}
		}
	}

	return to;
};


/***/ }),

/***/ "./node_modules/react/cjs/react-jsx-runtime.development.js":
/*!*****************************************************************!*\
  !*** ./node_modules/react/cjs/react-jsx-runtime.development.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

/** @license React v17.0.2
 * react-jsx-runtime.development.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



if (true) {
  (function() {
'use strict';

var React = __webpack_require__(/*! react */ "./node_modules/react/index.js");
var _assign = __webpack_require__(/*! object-assign */ "./node_modules/object-assign/index.js");

// ATTENTION
// When adding new symbols to this file,
// Please consider also adding to 'react-devtools-shared/src/backend/ReactSymbols'
// The Symbol used to tag the ReactElement-like types. If there is no native Symbol
// nor polyfill, then a plain number is used for performance.
var REACT_ELEMENT_TYPE = 0xeac7;
var REACT_PORTAL_TYPE = 0xeaca;
exports.Fragment = 0xeacb;
var REACT_STRICT_MODE_TYPE = 0xeacc;
var REACT_PROFILER_TYPE = 0xead2;
var REACT_PROVIDER_TYPE = 0xeacd;
var REACT_CONTEXT_TYPE = 0xeace;
var REACT_FORWARD_REF_TYPE = 0xead0;
var REACT_SUSPENSE_TYPE = 0xead1;
var REACT_SUSPENSE_LIST_TYPE = 0xead8;
var REACT_MEMO_TYPE = 0xead3;
var REACT_LAZY_TYPE = 0xead4;
var REACT_BLOCK_TYPE = 0xead9;
var REACT_SERVER_BLOCK_TYPE = 0xeada;
var REACT_FUNDAMENTAL_TYPE = 0xead5;
var REACT_SCOPE_TYPE = 0xead7;
var REACT_OPAQUE_ID_TYPE = 0xeae0;
var REACT_DEBUG_TRACING_MODE_TYPE = 0xeae1;
var REACT_OFFSCREEN_TYPE = 0xeae2;
var REACT_LEGACY_HIDDEN_TYPE = 0xeae3;

if (typeof Symbol === 'function' && Symbol.for) {
  var symbolFor = Symbol.for;
  REACT_ELEMENT_TYPE = symbolFor('react.element');
  REACT_PORTAL_TYPE = symbolFor('react.portal');
  exports.Fragment = symbolFor('react.fragment');
  REACT_STRICT_MODE_TYPE = symbolFor('react.strict_mode');
  REACT_PROFILER_TYPE = symbolFor('react.profiler');
  REACT_PROVIDER_TYPE = symbolFor('react.provider');
  REACT_CONTEXT_TYPE = symbolFor('react.context');
  REACT_FORWARD_REF_TYPE = symbolFor('react.forward_ref');
  REACT_SUSPENSE_TYPE = symbolFor('react.suspense');
  REACT_SUSPENSE_LIST_TYPE = symbolFor('react.suspense_list');
  REACT_MEMO_TYPE = symbolFor('react.memo');
  REACT_LAZY_TYPE = symbolFor('react.lazy');
  REACT_BLOCK_TYPE = symbolFor('react.block');
  REACT_SERVER_BLOCK_TYPE = symbolFor('react.server.block');
  REACT_FUNDAMENTAL_TYPE = symbolFor('react.fundamental');
  REACT_SCOPE_TYPE = symbolFor('react.scope');
  REACT_OPAQUE_ID_TYPE = symbolFor('react.opaque.id');
  REACT_DEBUG_TRACING_MODE_TYPE = symbolFor('react.debug_trace_mode');
  REACT_OFFSCREEN_TYPE = symbolFor('react.offscreen');
  REACT_LEGACY_HIDDEN_TYPE = symbolFor('react.legacy_hidden');
}

var MAYBE_ITERATOR_SYMBOL = typeof Symbol === 'function' && Symbol.iterator;
var FAUX_ITERATOR_SYMBOL = '@@iterator';
function getIteratorFn(maybeIterable) {
  if (maybeIterable === null || typeof maybeIterable !== 'object') {
    return null;
  }

  var maybeIterator = MAYBE_ITERATOR_SYMBOL && maybeIterable[MAYBE_ITERATOR_SYMBOL] || maybeIterable[FAUX_ITERATOR_SYMBOL];

  if (typeof maybeIterator === 'function') {
    return maybeIterator;
  }

  return null;
}

var ReactSharedInternals = React.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED;

function error(format) {
  {
    for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
      args[_key2 - 1] = arguments[_key2];
    }

    printWarning('error', format, args);
  }
}

function printWarning(level, format, args) {
  // When changing this logic, you might want to also
  // update consoleWithStackDev.www.js as well.
  {
    var ReactDebugCurrentFrame = ReactSharedInternals.ReactDebugCurrentFrame;
    var stack = ReactDebugCurrentFrame.getStackAddendum();

    if (stack !== '') {
      format += '%s';
      args = args.concat([stack]);
    }

    var argsWithFormat = args.map(function (item) {
      return '' + item;
    }); // Careful: RN currently depends on this prefix

    argsWithFormat.unshift('Warning: ' + format); // We intentionally don't use spread (or .apply) directly because it
    // breaks IE9: https://github.com/facebook/react/issues/13610
    // eslint-disable-next-line react-internal/no-production-logging

    Function.prototype.apply.call(console[level], console, argsWithFormat);
  }
}

// Filter certain DOM attributes (e.g. src, href) if their values are empty strings.

var enableScopeAPI = false; // Experimental Create Event Handle API.

function isValidElementType(type) {
  if (typeof type === 'string' || typeof type === 'function') {
    return true;
  } // Note: typeof might be other than 'symbol' or 'number' (e.g. if it's a polyfill).


  if (type === exports.Fragment || type === REACT_PROFILER_TYPE || type === REACT_DEBUG_TRACING_MODE_TYPE || type === REACT_STRICT_MODE_TYPE || type === REACT_SUSPENSE_TYPE || type === REACT_SUSPENSE_LIST_TYPE || type === REACT_LEGACY_HIDDEN_TYPE || enableScopeAPI ) {
    return true;
  }

  if (typeof type === 'object' && type !== null) {
    if (type.$$typeof === REACT_LAZY_TYPE || type.$$typeof === REACT_MEMO_TYPE || type.$$typeof === REACT_PROVIDER_TYPE || type.$$typeof === REACT_CONTEXT_TYPE || type.$$typeof === REACT_FORWARD_REF_TYPE || type.$$typeof === REACT_FUNDAMENTAL_TYPE || type.$$typeof === REACT_BLOCK_TYPE || type[0] === REACT_SERVER_BLOCK_TYPE) {
      return true;
    }
  }

  return false;
}

function getWrappedName(outerType, innerType, wrapperName) {
  var functionName = innerType.displayName || innerType.name || '';
  return outerType.displayName || (functionName !== '' ? wrapperName + "(" + functionName + ")" : wrapperName);
}

function getContextName(type) {
  return type.displayName || 'Context';
}

function getComponentName(type) {
  if (type == null) {
    // Host root, text node or just invalid type.
    return null;
  }

  {
    if (typeof type.tag === 'number') {
      error('Received an unexpected object in getComponentName(). ' + 'This is likely a bug in React. Please file an issue.');
    }
  }

  if (typeof type === 'function') {
    return type.displayName || type.name || null;
  }

  if (typeof type === 'string') {
    return type;
  }

  switch (type) {
    case exports.Fragment:
      return 'Fragment';

    case REACT_PORTAL_TYPE:
      return 'Portal';

    case REACT_PROFILER_TYPE:
      return 'Profiler';

    case REACT_STRICT_MODE_TYPE:
      return 'StrictMode';

    case REACT_SUSPENSE_TYPE:
      return 'Suspense';

    case REACT_SUSPENSE_LIST_TYPE:
      return 'SuspenseList';
  }

  if (typeof type === 'object') {
    switch (type.$$typeof) {
      case REACT_CONTEXT_TYPE:
        var context = type;
        return getContextName(context) + '.Consumer';

      case REACT_PROVIDER_TYPE:
        var provider = type;
        return getContextName(provider._context) + '.Provider';

      case REACT_FORWARD_REF_TYPE:
        return getWrappedName(type, type.render, 'ForwardRef');

      case REACT_MEMO_TYPE:
        return getComponentName(type.type);

      case REACT_BLOCK_TYPE:
        return getComponentName(type._render);

      case REACT_LAZY_TYPE:
        {
          var lazyComponent = type;
          var payload = lazyComponent._payload;
          var init = lazyComponent._init;

          try {
            return getComponentName(init(payload));
          } catch (x) {
            return null;
          }
        }
    }
  }

  return null;
}

// Helpers to patch console.logs to avoid logging during side-effect free
// replaying on render function. This currently only patches the object
// lazily which won't cover if the log function was extracted eagerly.
// We could also eagerly patch the method.
var disabledDepth = 0;
var prevLog;
var prevInfo;
var prevWarn;
var prevError;
var prevGroup;
var prevGroupCollapsed;
var prevGroupEnd;

function disabledLog() {}

disabledLog.__reactDisabledLog = true;
function disableLogs() {
  {
    if (disabledDepth === 0) {
      /* eslint-disable react-internal/no-production-logging */
      prevLog = console.log;
      prevInfo = console.info;
      prevWarn = console.warn;
      prevError = console.error;
      prevGroup = console.group;
      prevGroupCollapsed = console.groupCollapsed;
      prevGroupEnd = console.groupEnd; // https://github.com/facebook/react/issues/19099

      var props = {
        configurable: true,
        enumerable: true,
        value: disabledLog,
        writable: true
      }; // $FlowFixMe Flow thinks console is immutable.

      Object.defineProperties(console, {
        info: props,
        log: props,
        warn: props,
        error: props,
        group: props,
        groupCollapsed: props,
        groupEnd: props
      });
      /* eslint-enable react-internal/no-production-logging */
    }

    disabledDepth++;
  }
}
function reenableLogs() {
  {
    disabledDepth--;

    if (disabledDepth === 0) {
      /* eslint-disable react-internal/no-production-logging */
      var props = {
        configurable: true,
        enumerable: true,
        writable: true
      }; // $FlowFixMe Flow thinks console is immutable.

      Object.defineProperties(console, {
        log: _assign({}, props, {
          value: prevLog
        }),
        info: _assign({}, props, {
          value: prevInfo
        }),
        warn: _assign({}, props, {
          value: prevWarn
        }),
        error: _assign({}, props, {
          value: prevError
        }),
        group: _assign({}, props, {
          value: prevGroup
        }),
        groupCollapsed: _assign({}, props, {
          value: prevGroupCollapsed
        }),
        groupEnd: _assign({}, props, {
          value: prevGroupEnd
        })
      });
      /* eslint-enable react-internal/no-production-logging */
    }

    if (disabledDepth < 0) {
      error('disabledDepth fell below zero. ' + 'This is a bug in React. Please file an issue.');
    }
  }
}

var ReactCurrentDispatcher = ReactSharedInternals.ReactCurrentDispatcher;
var prefix;
function describeBuiltInComponentFrame(name, source, ownerFn) {
  {
    if (prefix === undefined) {
      // Extract the VM specific prefix used by each line.
      try {
        throw Error();
      } catch (x) {
        var match = x.stack.trim().match(/\n( *(at )?)/);
        prefix = match && match[1] || '';
      }
    } // We use the prefix to ensure our stacks line up with native stack frames.


    return '\n' + prefix + name;
  }
}
var reentry = false;
var componentFrameCache;

{
  var PossiblyWeakMap = typeof WeakMap === 'function' ? WeakMap : Map;
  componentFrameCache = new PossiblyWeakMap();
}

function describeNativeComponentFrame(fn, construct) {
  // If something asked for a stack inside a fake render, it should get ignored.
  if (!fn || reentry) {
    return '';
  }

  {
    var frame = componentFrameCache.get(fn);

    if (frame !== undefined) {
      return frame;
    }
  }

  var control;
  reentry = true;
  var previousPrepareStackTrace = Error.prepareStackTrace; // $FlowFixMe It does accept undefined.

  Error.prepareStackTrace = undefined;
  var previousDispatcher;

  {
    previousDispatcher = ReactCurrentDispatcher.current; // Set the dispatcher in DEV because this might be call in the render function
    // for warnings.

    ReactCurrentDispatcher.current = null;
    disableLogs();
  }

  try {
    // This should throw.
    if (construct) {
      // Something should be setting the props in the constructor.
      var Fake = function () {
        throw Error();
      }; // $FlowFixMe


      Object.defineProperty(Fake.prototype, 'props', {
        set: function () {
          // We use a throwing setter instead of frozen or non-writable props
          // because that won't throw in a non-strict mode function.
          throw Error();
        }
      });

      if (typeof Reflect === 'object' && Reflect.construct) {
        // We construct a different control for this case to include any extra
        // frames added by the construct call.
        try {
          Reflect.construct(Fake, []);
        } catch (x) {
          control = x;
        }

        Reflect.construct(fn, [], Fake);
      } else {
        try {
          Fake.call();
        } catch (x) {
          control = x;
        }

        fn.call(Fake.prototype);
      }
    } else {
      try {
        throw Error();
      } catch (x) {
        control = x;
      }

      fn();
    }
  } catch (sample) {
    // This is inlined manually because closure doesn't do it for us.
    if (sample && control && typeof sample.stack === 'string') {
      // This extracts the first frame from the sample that isn't also in the control.
      // Skipping one frame that we assume is the frame that calls the two.
      var sampleLines = sample.stack.split('\n');
      var controlLines = control.stack.split('\n');
      var s = sampleLines.length - 1;
      var c = controlLines.length - 1;

      while (s >= 1 && c >= 0 && sampleLines[s] !== controlLines[c]) {
        // We expect at least one stack frame to be shared.
        // Typically this will be the root most one. However, stack frames may be
        // cut off due to maximum stack limits. In this case, one maybe cut off
        // earlier than the other. We assume that the sample is longer or the same
        // and there for cut off earlier. So we should find the root most frame in
        // the sample somewhere in the control.
        c--;
      }

      for (; s >= 1 && c >= 0; s--, c--) {
        // Next we find the first one that isn't the same which should be the
        // frame that called our sample function and the control.
        if (sampleLines[s] !== controlLines[c]) {
          // In V8, the first line is describing the message but other VMs don't.
          // If we're about to return the first line, and the control is also on the same
          // line, that's a pretty good indicator that our sample threw at same line as
          // the control. I.e. before we entered the sample frame. So we ignore this result.
          // This can happen if you passed a class to function component, or non-function.
          if (s !== 1 || c !== 1) {
            do {
              s--;
              c--; // We may still have similar intermediate frames from the construct call.
              // The next one that isn't the same should be our match though.

              if (c < 0 || sampleLines[s] !== controlLines[c]) {
                // V8 adds a "new" prefix for native classes. Let's remove it to make it prettier.
                var _frame = '\n' + sampleLines[s].replace(' at new ', ' at ');

                {
                  if (typeof fn === 'function') {
                    componentFrameCache.set(fn, _frame);
                  }
                } // Return the line we found.


                return _frame;
              }
            } while (s >= 1 && c >= 0);
          }

          break;
        }
      }
    }
  } finally {
    reentry = false;

    {
      ReactCurrentDispatcher.current = previousDispatcher;
      reenableLogs();
    }

    Error.prepareStackTrace = previousPrepareStackTrace;
  } // Fallback to just using the name if we couldn't make it throw.


  var name = fn ? fn.displayName || fn.name : '';
  var syntheticFrame = name ? describeBuiltInComponentFrame(name) : '';

  {
    if (typeof fn === 'function') {
      componentFrameCache.set(fn, syntheticFrame);
    }
  }

  return syntheticFrame;
}
function describeFunctionComponentFrame(fn, source, ownerFn) {
  {
    return describeNativeComponentFrame(fn, false);
  }
}

function shouldConstruct(Component) {
  var prototype = Component.prototype;
  return !!(prototype && prototype.isReactComponent);
}

function describeUnknownElementTypeFrameInDEV(type, source, ownerFn) {

  if (type == null) {
    return '';
  }

  if (typeof type === 'function') {
    {
      return describeNativeComponentFrame(type, shouldConstruct(type));
    }
  }

  if (typeof type === 'string') {
    return describeBuiltInComponentFrame(type);
  }

  switch (type) {
    case REACT_SUSPENSE_TYPE:
      return describeBuiltInComponentFrame('Suspense');

    case REACT_SUSPENSE_LIST_TYPE:
      return describeBuiltInComponentFrame('SuspenseList');
  }

  if (typeof type === 'object') {
    switch (type.$$typeof) {
      case REACT_FORWARD_REF_TYPE:
        return describeFunctionComponentFrame(type.render);

      case REACT_MEMO_TYPE:
        // Memo may contain any component type so we recursively resolve it.
        return describeUnknownElementTypeFrameInDEV(type.type, source, ownerFn);

      case REACT_BLOCK_TYPE:
        return describeFunctionComponentFrame(type._render);

      case REACT_LAZY_TYPE:
        {
          var lazyComponent = type;
          var payload = lazyComponent._payload;
          var init = lazyComponent._init;

          try {
            // Lazy may contain any component type so we recursively resolve it.
            return describeUnknownElementTypeFrameInDEV(init(payload), source, ownerFn);
          } catch (x) {}
        }
    }
  }

  return '';
}

var loggedTypeFailures = {};
var ReactDebugCurrentFrame = ReactSharedInternals.ReactDebugCurrentFrame;

function setCurrentlyValidatingElement(element) {
  {
    if (element) {
      var owner = element._owner;
      var stack = describeUnknownElementTypeFrameInDEV(element.type, element._source, owner ? owner.type : null);
      ReactDebugCurrentFrame.setExtraStackFrame(stack);
    } else {
      ReactDebugCurrentFrame.setExtraStackFrame(null);
    }
  }
}

function checkPropTypes(typeSpecs, values, location, componentName, element) {
  {
    // $FlowFixMe This is okay but Flow doesn't know it.
    var has = Function.call.bind(Object.prototype.hasOwnProperty);

    for (var typeSpecName in typeSpecs) {
      if (has(typeSpecs, typeSpecName)) {
        var error$1 = void 0; // Prop type validation may throw. In case they do, we don't want to
        // fail the render phase where it didn't fail before. So we log it.
        // After these have been cleaned up, we'll let them throw.

        try {
          // This is intentionally an invariant that gets caught. It's the same
          // behavior as without this statement except with a better message.
          if (typeof typeSpecs[typeSpecName] !== 'function') {
            var err = Error((componentName || 'React class') + ': ' + location + ' type `' + typeSpecName + '` is invalid; ' + 'it must be a function, usually from the `prop-types` package, but received `' + typeof typeSpecs[typeSpecName] + '`.' + 'This often happens because of typos such as `PropTypes.function` instead of `PropTypes.func`.');
            err.name = 'Invariant Violation';
            throw err;
          }

          error$1 = typeSpecs[typeSpecName](values, typeSpecName, componentName, location, null, 'SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED');
        } catch (ex) {
          error$1 = ex;
        }

        if (error$1 && !(error$1 instanceof Error)) {
          setCurrentlyValidatingElement(element);

          error('%s: type specification of %s' + ' `%s` is invalid; the type checker ' + 'function must return `null` or an `Error` but returned a %s. ' + 'You may have forgotten to pass an argument to the type checker ' + 'creator (arrayOf, instanceOf, objectOf, oneOf, oneOfType, and ' + 'shape all require an argument).', componentName || 'React class', location, typeSpecName, typeof error$1);

          setCurrentlyValidatingElement(null);
        }

        if (error$1 instanceof Error && !(error$1.message in loggedTypeFailures)) {
          // Only monitor this failure once because there tends to be a lot of the
          // same error.
          loggedTypeFailures[error$1.message] = true;
          setCurrentlyValidatingElement(element);

          error('Failed %s type: %s', location, error$1.message);

          setCurrentlyValidatingElement(null);
        }
      }
    }
  }
}

var ReactCurrentOwner = ReactSharedInternals.ReactCurrentOwner;
var hasOwnProperty = Object.prototype.hasOwnProperty;
var RESERVED_PROPS = {
  key: true,
  ref: true,
  __self: true,
  __source: true
};
var specialPropKeyWarningShown;
var specialPropRefWarningShown;
var didWarnAboutStringRefs;

{
  didWarnAboutStringRefs = {};
}

function hasValidRef(config) {
  {
    if (hasOwnProperty.call(config, 'ref')) {
      var getter = Object.getOwnPropertyDescriptor(config, 'ref').get;

      if (getter && getter.isReactWarning) {
        return false;
      }
    }
  }

  return config.ref !== undefined;
}

function hasValidKey(config) {
  {
    if (hasOwnProperty.call(config, 'key')) {
      var getter = Object.getOwnPropertyDescriptor(config, 'key').get;

      if (getter && getter.isReactWarning) {
        return false;
      }
    }
  }

  return config.key !== undefined;
}

function warnIfStringRefCannotBeAutoConverted(config, self) {
  {
    if (typeof config.ref === 'string' && ReactCurrentOwner.current && self && ReactCurrentOwner.current.stateNode !== self) {
      var componentName = getComponentName(ReactCurrentOwner.current.type);

      if (!didWarnAboutStringRefs[componentName]) {
        error('Component "%s" contains the string ref "%s". ' + 'Support for string refs will be removed in a future major release. ' + 'This case cannot be automatically converted to an arrow function. ' + 'We ask you to manually fix this case by using useRef() or createRef() instead. ' + 'Learn more about using refs safely here: ' + 'https://reactjs.org/link/strict-mode-string-ref', getComponentName(ReactCurrentOwner.current.type), config.ref);

        didWarnAboutStringRefs[componentName] = true;
      }
    }
  }
}

function defineKeyPropWarningGetter(props, displayName) {
  {
    var warnAboutAccessingKey = function () {
      if (!specialPropKeyWarningShown) {
        specialPropKeyWarningShown = true;

        error('%s: `key` is not a prop. Trying to access it will result ' + 'in `undefined` being returned. If you need to access the same ' + 'value within the child component, you should pass it as a different ' + 'prop. (https://reactjs.org/link/special-props)', displayName);
      }
    };

    warnAboutAccessingKey.isReactWarning = true;
    Object.defineProperty(props, 'key', {
      get: warnAboutAccessingKey,
      configurable: true
    });
  }
}

function defineRefPropWarningGetter(props, displayName) {
  {
    var warnAboutAccessingRef = function () {
      if (!specialPropRefWarningShown) {
        specialPropRefWarningShown = true;

        error('%s: `ref` is not a prop. Trying to access it will result ' + 'in `undefined` being returned. If you need to access the same ' + 'value within the child component, you should pass it as a different ' + 'prop. (https://reactjs.org/link/special-props)', displayName);
      }
    };

    warnAboutAccessingRef.isReactWarning = true;
    Object.defineProperty(props, 'ref', {
      get: warnAboutAccessingRef,
      configurable: true
    });
  }
}
/**
 * Factory method to create a new React element. This no longer adheres to
 * the class pattern, so do not use new to call it. Also, instanceof check
 * will not work. Instead test $$typeof field against Symbol.for('react.element') to check
 * if something is a React Element.
 *
 * @param {*} type
 * @param {*} props
 * @param {*} key
 * @param {string|object} ref
 * @param {*} owner
 * @param {*} self A *temporary* helper to detect places where `this` is
 * different from the `owner` when React.createElement is called, so that we
 * can warn. We want to get rid of owner and replace string `ref`s with arrow
 * functions, and as long as `this` and owner are the same, there will be no
 * change in behavior.
 * @param {*} source An annotation object (added by a transpiler or otherwise)
 * indicating filename, line number, and/or other information.
 * @internal
 */


var ReactElement = function (type, key, ref, self, source, owner, props) {
  var element = {
    // This tag allows us to uniquely identify this as a React Element
    $$typeof: REACT_ELEMENT_TYPE,
    // Built-in properties that belong on the element
    type: type,
    key: key,
    ref: ref,
    props: props,
    // Record the component responsible for creating this element.
    _owner: owner
  };

  {
    // The validation flag is currently mutative. We put it on
    // an external backing store so that we can freeze the whole object.
    // This can be replaced with a WeakMap once they are implemented in
    // commonly used development environments.
    element._store = {}; // To make comparing ReactElements easier for testing purposes, we make
    // the validation flag non-enumerable (where possible, which should
    // include every environment we run tests in), so the test framework
    // ignores it.

    Object.defineProperty(element._store, 'validated', {
      configurable: false,
      enumerable: false,
      writable: true,
      value: false
    }); // self and source are DEV only properties.

    Object.defineProperty(element, '_self', {
      configurable: false,
      enumerable: false,
      writable: false,
      value: self
    }); // Two elements created in two different places should be considered
    // equal for testing purposes and therefore we hide it from enumeration.

    Object.defineProperty(element, '_source', {
      configurable: false,
      enumerable: false,
      writable: false,
      value: source
    });

    if (Object.freeze) {
      Object.freeze(element.props);
      Object.freeze(element);
    }
  }

  return element;
};
/**
 * https://github.com/reactjs/rfcs/pull/107
 * @param {*} type
 * @param {object} props
 * @param {string} key
 */

function jsxDEV(type, config, maybeKey, source, self) {
  {
    var propName; // Reserved names are extracted

    var props = {};
    var key = null;
    var ref = null; // Currently, key can be spread in as a prop. This causes a potential
    // issue if key is also explicitly declared (ie. <div {...props} key="Hi" />
    // or <div key="Hi" {...props} /> ). We want to deprecate key spread,
    // but as an intermediary step, we will use jsxDEV for everything except
    // <div {...props} key="Hi" />, because we aren't currently able to tell if
    // key is explicitly declared to be undefined or not.

    if (maybeKey !== undefined) {
      key = '' + maybeKey;
    }

    if (hasValidKey(config)) {
      key = '' + config.key;
    }

    if (hasValidRef(config)) {
      ref = config.ref;
      warnIfStringRefCannotBeAutoConverted(config, self);
    } // Remaining properties are added to a new props object


    for (propName in config) {
      if (hasOwnProperty.call(config, propName) && !RESERVED_PROPS.hasOwnProperty(propName)) {
        props[propName] = config[propName];
      }
    } // Resolve default props


    if (type && type.defaultProps) {
      var defaultProps = type.defaultProps;

      for (propName in defaultProps) {
        if (props[propName] === undefined) {
          props[propName] = defaultProps[propName];
        }
      }
    }

    if (key || ref) {
      var displayName = typeof type === 'function' ? type.displayName || type.name || 'Unknown' : type;

      if (key) {
        defineKeyPropWarningGetter(props, displayName);
      }

      if (ref) {
        defineRefPropWarningGetter(props, displayName);
      }
    }

    return ReactElement(type, key, ref, self, source, ReactCurrentOwner.current, props);
  }
}

var ReactCurrentOwner$1 = ReactSharedInternals.ReactCurrentOwner;
var ReactDebugCurrentFrame$1 = ReactSharedInternals.ReactDebugCurrentFrame;

function setCurrentlyValidatingElement$1(element) {
  {
    if (element) {
      var owner = element._owner;
      var stack = describeUnknownElementTypeFrameInDEV(element.type, element._source, owner ? owner.type : null);
      ReactDebugCurrentFrame$1.setExtraStackFrame(stack);
    } else {
      ReactDebugCurrentFrame$1.setExtraStackFrame(null);
    }
  }
}

var propTypesMisspellWarningShown;

{
  propTypesMisspellWarningShown = false;
}
/**
 * Verifies the object is a ReactElement.
 * See https://reactjs.org/docs/react-api.html#isvalidelement
 * @param {?object} object
 * @return {boolean} True if `object` is a ReactElement.
 * @final
 */

function isValidElement(object) {
  {
    return typeof object === 'object' && object !== null && object.$$typeof === REACT_ELEMENT_TYPE;
  }
}

function getDeclarationErrorAddendum() {
  {
    if (ReactCurrentOwner$1.current) {
      var name = getComponentName(ReactCurrentOwner$1.current.type);

      if (name) {
        return '\n\nCheck the render method of `' + name + '`.';
      }
    }

    return '';
  }
}

function getSourceInfoErrorAddendum(source) {
  {
    if (source !== undefined) {
      var fileName = source.fileName.replace(/^.*[\\\/]/, '');
      var lineNumber = source.lineNumber;
      return '\n\nCheck your code at ' + fileName + ':' + lineNumber + '.';
    }

    return '';
  }
}
/**
 * Warn if there's no key explicitly set on dynamic arrays of children or
 * object keys are not valid. This allows us to keep track of children between
 * updates.
 */


var ownerHasKeyUseWarning = {};

function getCurrentComponentErrorInfo(parentType) {
  {
    var info = getDeclarationErrorAddendum();

    if (!info) {
      var parentName = typeof parentType === 'string' ? parentType : parentType.displayName || parentType.name;

      if (parentName) {
        info = "\n\nCheck the top-level render call using <" + parentName + ">.";
      }
    }

    return info;
  }
}
/**
 * Warn if the element doesn't have an explicit key assigned to it.
 * This element is in an array. The array could grow and shrink or be
 * reordered. All children that haven't already been validated are required to
 * have a "key" property assigned to it. Error statuses are cached so a warning
 * will only be shown once.
 *
 * @internal
 * @param {ReactElement} element Element that requires a key.
 * @param {*} parentType element's parent's type.
 */


function validateExplicitKey(element, parentType) {
  {
    if (!element._store || element._store.validated || element.key != null) {
      return;
    }

    element._store.validated = true;
    var currentComponentErrorInfo = getCurrentComponentErrorInfo(parentType);

    if (ownerHasKeyUseWarning[currentComponentErrorInfo]) {
      return;
    }

    ownerHasKeyUseWarning[currentComponentErrorInfo] = true; // Usually the current owner is the offender, but if it accepts children as a
    // property, it may be the creator of the child that's responsible for
    // assigning it a key.

    var childOwner = '';

    if (element && element._owner && element._owner !== ReactCurrentOwner$1.current) {
      // Give the component that originally created this child.
      childOwner = " It was passed a child from " + getComponentName(element._owner.type) + ".";
    }

    setCurrentlyValidatingElement$1(element);

    error('Each child in a list should have a unique "key" prop.' + '%s%s See https://reactjs.org/link/warning-keys for more information.', currentComponentErrorInfo, childOwner);

    setCurrentlyValidatingElement$1(null);
  }
}
/**
 * Ensure that every element either is passed in a static location, in an
 * array with an explicit keys property defined, or in an object literal
 * with valid key property.
 *
 * @internal
 * @param {ReactNode} node Statically passed child of any type.
 * @param {*} parentType node's parent's type.
 */


function validateChildKeys(node, parentType) {
  {
    if (typeof node !== 'object') {
      return;
    }

    if (Array.isArray(node)) {
      for (var i = 0; i < node.length; i++) {
        var child = node[i];

        if (isValidElement(child)) {
          validateExplicitKey(child, parentType);
        }
      }
    } else if (isValidElement(node)) {
      // This element was passed in a valid location.
      if (node._store) {
        node._store.validated = true;
      }
    } else if (node) {
      var iteratorFn = getIteratorFn(node);

      if (typeof iteratorFn === 'function') {
        // Entry iterators used to provide implicit keys,
        // but now we print a separate warning for them later.
        if (iteratorFn !== node.entries) {
          var iterator = iteratorFn.call(node);
          var step;

          while (!(step = iterator.next()).done) {
            if (isValidElement(step.value)) {
              validateExplicitKey(step.value, parentType);
            }
          }
        }
      }
    }
  }
}
/**
 * Given an element, validate that its props follow the propTypes definition,
 * provided by the type.
 *
 * @param {ReactElement} element
 */


function validatePropTypes(element) {
  {
    var type = element.type;

    if (type === null || type === undefined || typeof type === 'string') {
      return;
    }

    var propTypes;

    if (typeof type === 'function') {
      propTypes = type.propTypes;
    } else if (typeof type === 'object' && (type.$$typeof === REACT_FORWARD_REF_TYPE || // Note: Memo only checks outer props here.
    // Inner props are checked in the reconciler.
    type.$$typeof === REACT_MEMO_TYPE)) {
      propTypes = type.propTypes;
    } else {
      return;
    }

    if (propTypes) {
      // Intentionally inside to avoid triggering lazy initializers:
      var name = getComponentName(type);
      checkPropTypes(propTypes, element.props, 'prop', name, element);
    } else if (type.PropTypes !== undefined && !propTypesMisspellWarningShown) {
      propTypesMisspellWarningShown = true; // Intentionally inside to avoid triggering lazy initializers:

      var _name = getComponentName(type);

      error('Component %s declared `PropTypes` instead of `propTypes`. Did you misspell the property assignment?', _name || 'Unknown');
    }

    if (typeof type.getDefaultProps === 'function' && !type.getDefaultProps.isReactClassApproved) {
      error('getDefaultProps is only used on classic React.createClass ' + 'definitions. Use a static property named `defaultProps` instead.');
    }
  }
}
/**
 * Given a fragment, validate that it can only be provided with fragment props
 * @param {ReactElement} fragment
 */


function validateFragmentProps(fragment) {
  {
    var keys = Object.keys(fragment.props);

    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];

      if (key !== 'children' && key !== 'key') {
        setCurrentlyValidatingElement$1(fragment);

        error('Invalid prop `%s` supplied to `React.Fragment`. ' + 'React.Fragment can only have `key` and `children` props.', key);

        setCurrentlyValidatingElement$1(null);
        break;
      }
    }

    if (fragment.ref !== null) {
      setCurrentlyValidatingElement$1(fragment);

      error('Invalid attribute `ref` supplied to `React.Fragment`.');

      setCurrentlyValidatingElement$1(null);
    }
  }
}

function jsxWithValidation(type, props, key, isStaticChildren, source, self) {
  {
    var validType = isValidElementType(type); // We warn in this case but don't throw. We expect the element creation to
    // succeed and there will likely be errors in render.

    if (!validType) {
      var info = '';

      if (type === undefined || typeof type === 'object' && type !== null && Object.keys(type).length === 0) {
        info += ' You likely forgot to export your component from the file ' + "it's defined in, or you might have mixed up default and named imports.";
      }

      var sourceInfo = getSourceInfoErrorAddendum(source);

      if (sourceInfo) {
        info += sourceInfo;
      } else {
        info += getDeclarationErrorAddendum();
      }

      var typeString;

      if (type === null) {
        typeString = 'null';
      } else if (Array.isArray(type)) {
        typeString = 'array';
      } else if (type !== undefined && type.$$typeof === REACT_ELEMENT_TYPE) {
        typeString = "<" + (getComponentName(type.type) || 'Unknown') + " />";
        info = ' Did you accidentally export a JSX literal instead of a component?';
      } else {
        typeString = typeof type;
      }

      error('React.jsx: type is invalid -- expected a string (for ' + 'built-in components) or a class/function (for composite ' + 'components) but got: %s.%s', typeString, info);
    }

    var element = jsxDEV(type, props, key, source, self); // The result can be nullish if a mock or a custom function is used.
    // TODO: Drop this when these are no longer allowed as the type argument.

    if (element == null) {
      return element;
    } // Skip key warning if the type isn't valid since our key validation logic
    // doesn't expect a non-string/function type and can throw confusing errors.
    // We don't want exception behavior to differ between dev and prod.
    // (Rendering will throw with a helpful message and as soon as the type is
    // fixed, the key warnings will appear.)


    if (validType) {
      var children = props.children;

      if (children !== undefined) {
        if (isStaticChildren) {
          if (Array.isArray(children)) {
            for (var i = 0; i < children.length; i++) {
              validateChildKeys(children[i], type);
            }

            if (Object.freeze) {
              Object.freeze(children);
            }
          } else {
            error('React.jsx: Static children should always be an array. ' + 'You are likely explicitly calling React.jsxs or React.jsxDEV. ' + 'Use the Babel transform instead.');
          }
        } else {
          validateChildKeys(children, type);
        }
      }
    }

    if (type === exports.Fragment) {
      validateFragmentProps(element);
    } else {
      validatePropTypes(element);
    }

    return element;
  }
} // These two functions exist to still get child warnings in dev
// even with the prod transform. This means that jsxDEV is purely
// opt-in behavior for better messages but that we won't stop
// giving you warnings if you use production apis.

function jsxWithValidationStatic(type, props, key) {
  {
    return jsxWithValidation(type, props, key, true);
  }
}
function jsxWithValidationDynamic(type, props, key) {
  {
    return jsxWithValidation(type, props, key, false);
  }
}

var jsx =  jsxWithValidationDynamic ; // we may want to special case jsxs internally to take advantage of static children.
// for now we can ship identical prod functions

var jsxs =  jsxWithValidationStatic ;

exports.jsx = jsx;
exports.jsxs = jsxs;
  })();
}


/***/ }),

/***/ "./node_modules/react/cjs/react.development.js":
/*!*****************************************************!*\
  !*** ./node_modules/react/cjs/react.development.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

/** @license React v17.0.2
 * react.development.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



if (true) {
  (function() {
'use strict';

var _assign = __webpack_require__(/*! object-assign */ "./node_modules/object-assign/index.js");

// TODO: this is special because it gets imported during build.
var ReactVersion = '17.0.2';

// ATTENTION
// When adding new symbols to this file,
// Please consider also adding to 'react-devtools-shared/src/backend/ReactSymbols'
// The Symbol used to tag the ReactElement-like types. If there is no native Symbol
// nor polyfill, then a plain number is used for performance.
var REACT_ELEMENT_TYPE = 0xeac7;
var REACT_PORTAL_TYPE = 0xeaca;
exports.Fragment = 0xeacb;
exports.StrictMode = 0xeacc;
exports.Profiler = 0xead2;
var REACT_PROVIDER_TYPE = 0xeacd;
var REACT_CONTEXT_TYPE = 0xeace;
var REACT_FORWARD_REF_TYPE = 0xead0;
exports.Suspense = 0xead1;
var REACT_SUSPENSE_LIST_TYPE = 0xead8;
var REACT_MEMO_TYPE = 0xead3;
var REACT_LAZY_TYPE = 0xead4;
var REACT_BLOCK_TYPE = 0xead9;
var REACT_SERVER_BLOCK_TYPE = 0xeada;
var REACT_FUNDAMENTAL_TYPE = 0xead5;
var REACT_SCOPE_TYPE = 0xead7;
var REACT_OPAQUE_ID_TYPE = 0xeae0;
var REACT_DEBUG_TRACING_MODE_TYPE = 0xeae1;
var REACT_OFFSCREEN_TYPE = 0xeae2;
var REACT_LEGACY_HIDDEN_TYPE = 0xeae3;

if (typeof Symbol === 'function' && Symbol.for) {
  var symbolFor = Symbol.for;
  REACT_ELEMENT_TYPE = symbolFor('react.element');
  REACT_PORTAL_TYPE = symbolFor('react.portal');
  exports.Fragment = symbolFor('react.fragment');
  exports.StrictMode = symbolFor('react.strict_mode');
  exports.Profiler = symbolFor('react.profiler');
  REACT_PROVIDER_TYPE = symbolFor('react.provider');
  REACT_CONTEXT_TYPE = symbolFor('react.context');
  REACT_FORWARD_REF_TYPE = symbolFor('react.forward_ref');
  exports.Suspense = symbolFor('react.suspense');
  REACT_SUSPENSE_LIST_TYPE = symbolFor('react.suspense_list');
  REACT_MEMO_TYPE = symbolFor('react.memo');
  REACT_LAZY_TYPE = symbolFor('react.lazy');
  REACT_BLOCK_TYPE = symbolFor('react.block');
  REACT_SERVER_BLOCK_TYPE = symbolFor('react.server.block');
  REACT_FUNDAMENTAL_TYPE = symbolFor('react.fundamental');
  REACT_SCOPE_TYPE = symbolFor('react.scope');
  REACT_OPAQUE_ID_TYPE = symbolFor('react.opaque.id');
  REACT_DEBUG_TRACING_MODE_TYPE = symbolFor('react.debug_trace_mode');
  REACT_OFFSCREEN_TYPE = symbolFor('react.offscreen');
  REACT_LEGACY_HIDDEN_TYPE = symbolFor('react.legacy_hidden');
}

var MAYBE_ITERATOR_SYMBOL = typeof Symbol === 'function' && Symbol.iterator;
var FAUX_ITERATOR_SYMBOL = '@@iterator';
function getIteratorFn(maybeIterable) {
  if (maybeIterable === null || typeof maybeIterable !== 'object') {
    return null;
  }

  var maybeIterator = MAYBE_ITERATOR_SYMBOL && maybeIterable[MAYBE_ITERATOR_SYMBOL] || maybeIterable[FAUX_ITERATOR_SYMBOL];

  if (typeof maybeIterator === 'function') {
    return maybeIterator;
  }

  return null;
}

/**
 * Keeps track of the current dispatcher.
 */
var ReactCurrentDispatcher = {
  /**
   * @internal
   * @type {ReactComponent}
   */
  current: null
};

/**
 * Keeps track of the current batch's configuration such as how long an update
 * should suspend for if it needs to.
 */
var ReactCurrentBatchConfig = {
  transition: 0
};

/**
 * Keeps track of the current owner.
 *
 * The current owner is the component who should own any components that are
 * currently being constructed.
 */
var ReactCurrentOwner = {
  /**
   * @internal
   * @type {ReactComponent}
   */
  current: null
};

var ReactDebugCurrentFrame = {};
var currentExtraStackFrame = null;
function setExtraStackFrame(stack) {
  {
    currentExtraStackFrame = stack;
  }
}

{
  ReactDebugCurrentFrame.setExtraStackFrame = function (stack) {
    {
      currentExtraStackFrame = stack;
    }
  }; // Stack implementation injected by the current renderer.


  ReactDebugCurrentFrame.getCurrentStack = null;

  ReactDebugCurrentFrame.getStackAddendum = function () {
    var stack = ''; // Add an extra top frame while an element is being validated

    if (currentExtraStackFrame) {
      stack += currentExtraStackFrame;
    } // Delegate to the injected renderer-specific implementation


    var impl = ReactDebugCurrentFrame.getCurrentStack;

    if (impl) {
      stack += impl() || '';
    }

    return stack;
  };
}

/**
 * Used by act() to track whether you're inside an act() scope.
 */
var IsSomeRendererActing = {
  current: false
};

var ReactSharedInternals = {
  ReactCurrentDispatcher: ReactCurrentDispatcher,
  ReactCurrentBatchConfig: ReactCurrentBatchConfig,
  ReactCurrentOwner: ReactCurrentOwner,
  IsSomeRendererActing: IsSomeRendererActing,
  // Used by renderers to avoid bundling object-assign twice in UMD bundles:
  assign: _assign
};

{
  ReactSharedInternals.ReactDebugCurrentFrame = ReactDebugCurrentFrame;
}

// by calls to these methods by a Babel plugin.
//
// In PROD (or in packages without access to React internals),
// they are left as they are instead.

function warn(format) {
  {
    for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    printWarning('warn', format, args);
  }
}
function error(format) {
  {
    for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
      args[_key2 - 1] = arguments[_key2];
    }

    printWarning('error', format, args);
  }
}

function printWarning(level, format, args) {
  // When changing this logic, you might want to also
  // update consoleWithStackDev.www.js as well.
  {
    var ReactDebugCurrentFrame = ReactSharedInternals.ReactDebugCurrentFrame;
    var stack = ReactDebugCurrentFrame.getStackAddendum();

    if (stack !== '') {
      format += '%s';
      args = args.concat([stack]);
    }

    var argsWithFormat = args.map(function (item) {
      return '' + item;
    }); // Careful: RN currently depends on this prefix

    argsWithFormat.unshift('Warning: ' + format); // We intentionally don't use spread (or .apply) directly because it
    // breaks IE9: https://github.com/facebook/react/issues/13610
    // eslint-disable-next-line react-internal/no-production-logging

    Function.prototype.apply.call(console[level], console, argsWithFormat);
  }
}

var didWarnStateUpdateForUnmountedComponent = {};

function warnNoop(publicInstance, callerName) {
  {
    var _constructor = publicInstance.constructor;
    var componentName = _constructor && (_constructor.displayName || _constructor.name) || 'ReactClass';
    var warningKey = componentName + "." + callerName;

    if (didWarnStateUpdateForUnmountedComponent[warningKey]) {
      return;
    }

    error("Can't call %s on a component that is not yet mounted. " + 'This is a no-op, but it might indicate a bug in your application. ' + 'Instead, assign to `this.state` directly or define a `state = {};` ' + 'class property with the desired state in the %s component.', callerName, componentName);

    didWarnStateUpdateForUnmountedComponent[warningKey] = true;
  }
}
/**
 * This is the abstract API for an update queue.
 */


var ReactNoopUpdateQueue = {
  /**
   * Checks whether or not this composite component is mounted.
   * @param {ReactClass} publicInstance The instance we want to test.
   * @return {boolean} True if mounted, false otherwise.
   * @protected
   * @final
   */
  isMounted: function (publicInstance) {
    return false;
  },

  /**
   * Forces an update. This should only be invoked when it is known with
   * certainty that we are **not** in a DOM transaction.
   *
   * You may want to call this when you know that some deeper aspect of the
   * component's state has changed but `setState` was not called.
   *
   * This will not invoke `shouldComponentUpdate`, but it will invoke
   * `componentWillUpdate` and `componentDidUpdate`.
   *
   * @param {ReactClass} publicInstance The instance that should rerender.
   * @param {?function} callback Called after component is updated.
   * @param {?string} callerName name of the calling function in the public API.
   * @internal
   */
  enqueueForceUpdate: function (publicInstance, callback, callerName) {
    warnNoop(publicInstance, 'forceUpdate');
  },

  /**
   * Replaces all of the state. Always use this or `setState` to mutate state.
   * You should treat `this.state` as immutable.
   *
   * There is no guarantee that `this.state` will be immediately updated, so
   * accessing `this.state` after calling this method may return the old value.
   *
   * @param {ReactClass} publicInstance The instance that should rerender.
   * @param {object} completeState Next state.
   * @param {?function} callback Called after component is updated.
   * @param {?string} callerName name of the calling function in the public API.
   * @internal
   */
  enqueueReplaceState: function (publicInstance, completeState, callback, callerName) {
    warnNoop(publicInstance, 'replaceState');
  },

  /**
   * Sets a subset of the state. This only exists because _pendingState is
   * internal. This provides a merging strategy that is not available to deep
   * properties which is confusing. TODO: Expose pendingState or don't use it
   * during the merge.
   *
   * @param {ReactClass} publicInstance The instance that should rerender.
   * @param {object} partialState Next partial state to be merged with state.
   * @param {?function} callback Called after component is updated.
   * @param {?string} Name of the calling function in the public API.
   * @internal
   */
  enqueueSetState: function (publicInstance, partialState, callback, callerName) {
    warnNoop(publicInstance, 'setState');
  }
};

var emptyObject = {};

{
  Object.freeze(emptyObject);
}
/**
 * Base class helpers for the updating state of a component.
 */


function Component(props, context, updater) {
  this.props = props;
  this.context = context; // If a component has string refs, we will assign a different object later.

  this.refs = emptyObject; // We initialize the default updater but the real one gets injected by the
  // renderer.

  this.updater = updater || ReactNoopUpdateQueue;
}

Component.prototype.isReactComponent = {};
/**
 * Sets a subset of the state. Always use this to mutate
 * state. You should treat `this.state` as immutable.
 *
 * There is no guarantee that `this.state` will be immediately updated, so
 * accessing `this.state` after calling this method may return the old value.
 *
 * There is no guarantee that calls to `setState` will run synchronously,
 * as they may eventually be batched together.  You can provide an optional
 * callback that will be executed when the call to setState is actually
 * completed.
 *
 * When a function is provided to setState, it will be called at some point in
 * the future (not synchronously). It will be called with the up to date
 * component arguments (state, props, context). These values can be different
 * from this.* because your function may be called after receiveProps but before
 * shouldComponentUpdate, and this new state, props, and context will not yet be
 * assigned to this.
 *
 * @param {object|function} partialState Next partial state or function to
 *        produce next partial state to be merged with current state.
 * @param {?function} callback Called after state is updated.
 * @final
 * @protected
 */

Component.prototype.setState = function (partialState, callback) {
  if (!(typeof partialState === 'object' || typeof partialState === 'function' || partialState == null)) {
    {
      throw Error( "setState(...): takes an object of state variables to update or a function which returns an object of state variables." );
    }
  }

  this.updater.enqueueSetState(this, partialState, callback, 'setState');
};
/**
 * Forces an update. This should only be invoked when it is known with
 * certainty that we are **not** in a DOM transaction.
 *
 * You may want to call this when you know that some deeper aspect of the
 * component's state has changed but `setState` was not called.
 *
 * This will not invoke `shouldComponentUpdate`, but it will invoke
 * `componentWillUpdate` and `componentDidUpdate`.
 *
 * @param {?function} callback Called after update is complete.
 * @final
 * @protected
 */


Component.prototype.forceUpdate = function (callback) {
  this.updater.enqueueForceUpdate(this, callback, 'forceUpdate');
};
/**
 * Deprecated APIs. These APIs used to exist on classic React classes but since
 * we would like to deprecate them, we're not going to move them over to this
 * modern base class. Instead, we define a getter that warns if it's accessed.
 */


{
  var deprecatedAPIs = {
    isMounted: ['isMounted', 'Instead, make sure to clean up subscriptions and pending requests in ' + 'componentWillUnmount to prevent memory leaks.'],
    replaceState: ['replaceState', 'Refactor your code to use setState instead (see ' + 'https://github.com/facebook/react/issues/3236).']
  };

  var defineDeprecationWarning = function (methodName, info) {
    Object.defineProperty(Component.prototype, methodName, {
      get: function () {
        warn('%s(...) is deprecated in plain JavaScript React classes. %s', info[0], info[1]);

        return undefined;
      }
    });
  };

  for (var fnName in deprecatedAPIs) {
    if (deprecatedAPIs.hasOwnProperty(fnName)) {
      defineDeprecationWarning(fnName, deprecatedAPIs[fnName]);
    }
  }
}

function ComponentDummy() {}

ComponentDummy.prototype = Component.prototype;
/**
 * Convenience component with default shallow equality check for sCU.
 */

function PureComponent(props, context, updater) {
  this.props = props;
  this.context = context; // If a component has string refs, we will assign a different object later.

  this.refs = emptyObject;
  this.updater = updater || ReactNoopUpdateQueue;
}

var pureComponentPrototype = PureComponent.prototype = new ComponentDummy();
pureComponentPrototype.constructor = PureComponent; // Avoid an extra prototype jump for these methods.

_assign(pureComponentPrototype, Component.prototype);

pureComponentPrototype.isPureReactComponent = true;

// an immutable object with a single mutable value
function createRef() {
  var refObject = {
    current: null
  };

  {
    Object.seal(refObject);
  }

  return refObject;
}

function getWrappedName(outerType, innerType, wrapperName) {
  var functionName = innerType.displayName || innerType.name || '';
  return outerType.displayName || (functionName !== '' ? wrapperName + "(" + functionName + ")" : wrapperName);
}

function getContextName(type) {
  return type.displayName || 'Context';
}

function getComponentName(type) {
  if (type == null) {
    // Host root, text node or just invalid type.
    return null;
  }

  {
    if (typeof type.tag === 'number') {
      error('Received an unexpected object in getComponentName(). ' + 'This is likely a bug in React. Please file an issue.');
    }
  }

  if (typeof type === 'function') {
    return type.displayName || type.name || null;
  }

  if (typeof type === 'string') {
    return type;
  }

  switch (type) {
    case exports.Fragment:
      return 'Fragment';

    case REACT_PORTAL_TYPE:
      return 'Portal';

    case exports.Profiler:
      return 'Profiler';

    case exports.StrictMode:
      return 'StrictMode';

    case exports.Suspense:
      return 'Suspense';

    case REACT_SUSPENSE_LIST_TYPE:
      return 'SuspenseList';
  }

  if (typeof type === 'object') {
    switch (type.$$typeof) {
      case REACT_CONTEXT_TYPE:
        var context = type;
        return getContextName(context) + '.Consumer';

      case REACT_PROVIDER_TYPE:
        var provider = type;
        return getContextName(provider._context) + '.Provider';

      case REACT_FORWARD_REF_TYPE:
        return getWrappedName(type, type.render, 'ForwardRef');

      case REACT_MEMO_TYPE:
        return getComponentName(type.type);

      case REACT_BLOCK_TYPE:
        return getComponentName(type._render);

      case REACT_LAZY_TYPE:
        {
          var lazyComponent = type;
          var payload = lazyComponent._payload;
          var init = lazyComponent._init;

          try {
            return getComponentName(init(payload));
          } catch (x) {
            return null;
          }
        }
    }
  }

  return null;
}

var hasOwnProperty = Object.prototype.hasOwnProperty;
var RESERVED_PROPS = {
  key: true,
  ref: true,
  __self: true,
  __source: true
};
var specialPropKeyWarningShown, specialPropRefWarningShown, didWarnAboutStringRefs;

{
  didWarnAboutStringRefs = {};
}

function hasValidRef(config) {
  {
    if (hasOwnProperty.call(config, 'ref')) {
      var getter = Object.getOwnPropertyDescriptor(config, 'ref').get;

      if (getter && getter.isReactWarning) {
        return false;
      }
    }
  }

  return config.ref !== undefined;
}

function hasValidKey(config) {
  {
    if (hasOwnProperty.call(config, 'key')) {
      var getter = Object.getOwnPropertyDescriptor(config, 'key').get;

      if (getter && getter.isReactWarning) {
        return false;
      }
    }
  }

  return config.key !== undefined;
}

function defineKeyPropWarningGetter(props, displayName) {
  var warnAboutAccessingKey = function () {
    {
      if (!specialPropKeyWarningShown) {
        specialPropKeyWarningShown = true;

        error('%s: `key` is not a prop. Trying to access it will result ' + 'in `undefined` being returned. If you need to access the same ' + 'value within the child component, you should pass it as a different ' + 'prop. (https://reactjs.org/link/special-props)', displayName);
      }
    }
  };

  warnAboutAccessingKey.isReactWarning = true;
  Object.defineProperty(props, 'key', {
    get: warnAboutAccessingKey,
    configurable: true
  });
}

function defineRefPropWarningGetter(props, displayName) {
  var warnAboutAccessingRef = function () {
    {
      if (!specialPropRefWarningShown) {
        specialPropRefWarningShown = true;

        error('%s: `ref` is not a prop. Trying to access it will result ' + 'in `undefined` being returned. If you need to access the same ' + 'value within the child component, you should pass it as a different ' + 'prop. (https://reactjs.org/link/special-props)', displayName);
      }
    }
  };

  warnAboutAccessingRef.isReactWarning = true;
  Object.defineProperty(props, 'ref', {
    get: warnAboutAccessingRef,
    configurable: true
  });
}

function warnIfStringRefCannotBeAutoConverted(config) {
  {
    if (typeof config.ref === 'string' && ReactCurrentOwner.current && config.__self && ReactCurrentOwner.current.stateNode !== config.__self) {
      var componentName = getComponentName(ReactCurrentOwner.current.type);

      if (!didWarnAboutStringRefs[componentName]) {
        error('Component "%s" contains the string ref "%s". ' + 'Support for string refs will be removed in a future major release. ' + 'This case cannot be automatically converted to an arrow function. ' + 'We ask you to manually fix this case by using useRef() or createRef() instead. ' + 'Learn more about using refs safely here: ' + 'https://reactjs.org/link/strict-mode-string-ref', componentName, config.ref);

        didWarnAboutStringRefs[componentName] = true;
      }
    }
  }
}
/**
 * Factory method to create a new React element. This no longer adheres to
 * the class pattern, so do not use new to call it. Also, instanceof check
 * will not work. Instead test $$typeof field against Symbol.for('react.element') to check
 * if something is a React Element.
 *
 * @param {*} type
 * @param {*} props
 * @param {*} key
 * @param {string|object} ref
 * @param {*} owner
 * @param {*} self A *temporary* helper to detect places where `this` is
 * different from the `owner` when React.createElement is called, so that we
 * can warn. We want to get rid of owner and replace string `ref`s with arrow
 * functions, and as long as `this` and owner are the same, there will be no
 * change in behavior.
 * @param {*} source An annotation object (added by a transpiler or otherwise)
 * indicating filename, line number, and/or other information.
 * @internal
 */


var ReactElement = function (type, key, ref, self, source, owner, props) {
  var element = {
    // This tag allows us to uniquely identify this as a React Element
    $$typeof: REACT_ELEMENT_TYPE,
    // Built-in properties that belong on the element
    type: type,
    key: key,
    ref: ref,
    props: props,
    // Record the component responsible for creating this element.
    _owner: owner
  };

  {
    // The validation flag is currently mutative. We put it on
    // an external backing store so that we can freeze the whole object.
    // This can be replaced with a WeakMap once they are implemented in
    // commonly used development environments.
    element._store = {}; // To make comparing ReactElements easier for testing purposes, we make
    // the validation flag non-enumerable (where possible, which should
    // include every environment we run tests in), so the test framework
    // ignores it.

    Object.defineProperty(element._store, 'validated', {
      configurable: false,
      enumerable: false,
      writable: true,
      value: false
    }); // self and source are DEV only properties.

    Object.defineProperty(element, '_self', {
      configurable: false,
      enumerable: false,
      writable: false,
      value: self
    }); // Two elements created in two different places should be considered
    // equal for testing purposes and therefore we hide it from enumeration.

    Object.defineProperty(element, '_source', {
      configurable: false,
      enumerable: false,
      writable: false,
      value: source
    });

    if (Object.freeze) {
      Object.freeze(element.props);
      Object.freeze(element);
    }
  }

  return element;
};
/**
 * Create and return a new ReactElement of the given type.
 * See https://reactjs.org/docs/react-api.html#createelement
 */

function createElement(type, config, children) {
  var propName; // Reserved names are extracted

  var props = {};
  var key = null;
  var ref = null;
  var self = null;
  var source = null;

  if (config != null) {
    if (hasValidRef(config)) {
      ref = config.ref;

      {
        warnIfStringRefCannotBeAutoConverted(config);
      }
    }

    if (hasValidKey(config)) {
      key = '' + config.key;
    }

    self = config.__self === undefined ? null : config.__self;
    source = config.__source === undefined ? null : config.__source; // Remaining properties are added to a new props object

    for (propName in config) {
      if (hasOwnProperty.call(config, propName) && !RESERVED_PROPS.hasOwnProperty(propName)) {
        props[propName] = config[propName];
      }
    }
  } // Children can be more than one argument, and those are transferred onto
  // the newly allocated props object.


  var childrenLength = arguments.length - 2;

  if (childrenLength === 1) {
    props.children = children;
  } else if (childrenLength > 1) {
    var childArray = Array(childrenLength);

    for (var i = 0; i < childrenLength; i++) {
      childArray[i] = arguments[i + 2];
    }

    {
      if (Object.freeze) {
        Object.freeze(childArray);
      }
    }

    props.children = childArray;
  } // Resolve default props


  if (type && type.defaultProps) {
    var defaultProps = type.defaultProps;

    for (propName in defaultProps) {
      if (props[propName] === undefined) {
        props[propName] = defaultProps[propName];
      }
    }
  }

  {
    if (key || ref) {
      var displayName = typeof type === 'function' ? type.displayName || type.name || 'Unknown' : type;

      if (key) {
        defineKeyPropWarningGetter(props, displayName);
      }

      if (ref) {
        defineRefPropWarningGetter(props, displayName);
      }
    }
  }

  return ReactElement(type, key, ref, self, source, ReactCurrentOwner.current, props);
}
function cloneAndReplaceKey(oldElement, newKey) {
  var newElement = ReactElement(oldElement.type, newKey, oldElement.ref, oldElement._self, oldElement._source, oldElement._owner, oldElement.props);
  return newElement;
}
/**
 * Clone and return a new ReactElement using element as the starting point.
 * See https://reactjs.org/docs/react-api.html#cloneelement
 */

function cloneElement(element, config, children) {
  if (!!(element === null || element === undefined)) {
    {
      throw Error( "React.cloneElement(...): The argument must be a React element, but you passed " + element + "." );
    }
  }

  var propName; // Original props are copied

  var props = _assign({}, element.props); // Reserved names are extracted


  var key = element.key;
  var ref = element.ref; // Self is preserved since the owner is preserved.

  var self = element._self; // Source is preserved since cloneElement is unlikely to be targeted by a
  // transpiler, and the original source is probably a better indicator of the
  // true owner.

  var source = element._source; // Owner will be preserved, unless ref is overridden

  var owner = element._owner;

  if (config != null) {
    if (hasValidRef(config)) {
      // Silently steal the ref from the parent.
      ref = config.ref;
      owner = ReactCurrentOwner.current;
    }

    if (hasValidKey(config)) {
      key = '' + config.key;
    } // Remaining properties override existing props


    var defaultProps;

    if (element.type && element.type.defaultProps) {
      defaultProps = element.type.defaultProps;
    }

    for (propName in config) {
      if (hasOwnProperty.call(config, propName) && !RESERVED_PROPS.hasOwnProperty(propName)) {
        if (config[propName] === undefined && defaultProps !== undefined) {
          // Resolve default props
          props[propName] = defaultProps[propName];
        } else {
          props[propName] = config[propName];
        }
      }
    }
  } // Children can be more than one argument, and those are transferred onto
  // the newly allocated props object.


  var childrenLength = arguments.length - 2;

  if (childrenLength === 1) {
    props.children = children;
  } else if (childrenLength > 1) {
    var childArray = Array(childrenLength);

    for (var i = 0; i < childrenLength; i++) {
      childArray[i] = arguments[i + 2];
    }

    props.children = childArray;
  }

  return ReactElement(element.type, key, ref, self, source, owner, props);
}
/**
 * Verifies the object is a ReactElement.
 * See https://reactjs.org/docs/react-api.html#isvalidelement
 * @param {?object} object
 * @return {boolean} True if `object` is a ReactElement.
 * @final
 */

function isValidElement(object) {
  return typeof object === 'object' && object !== null && object.$$typeof === REACT_ELEMENT_TYPE;
}

var SEPARATOR = '.';
var SUBSEPARATOR = ':';
/**
 * Escape and wrap key so it is safe to use as a reactid
 *
 * @param {string} key to be escaped.
 * @return {string} the escaped key.
 */

function escape(key) {
  var escapeRegex = /[=:]/g;
  var escaperLookup = {
    '=': '=0',
    ':': '=2'
  };
  var escapedString = key.replace(escapeRegex, function (match) {
    return escaperLookup[match];
  });
  return '$' + escapedString;
}
/**
 * TODO: Test that a single child and an array with one item have the same key
 * pattern.
 */


var didWarnAboutMaps = false;
var userProvidedKeyEscapeRegex = /\/+/g;

function escapeUserProvidedKey(text) {
  return text.replace(userProvidedKeyEscapeRegex, '$&/');
}
/**
 * Generate a key string that identifies a element within a set.
 *
 * @param {*} element A element that could contain a manual key.
 * @param {number} index Index that is used if a manual key is not provided.
 * @return {string}
 */


function getElementKey(element, index) {
  // Do some typechecking here since we call this blindly. We want to ensure
  // that we don't block potential future ES APIs.
  if (typeof element === 'object' && element !== null && element.key != null) {
    // Explicit key
    return escape('' + element.key);
  } // Implicit key determined by the index in the set


  return index.toString(36);
}

function mapIntoArray(children, array, escapedPrefix, nameSoFar, callback) {
  var type = typeof children;

  if (type === 'undefined' || type === 'boolean') {
    // All of the above are perceived as null.
    children = null;
  }

  var invokeCallback = false;

  if (children === null) {
    invokeCallback = true;
  } else {
    switch (type) {
      case 'string':
      case 'number':
        invokeCallback = true;
        break;

      case 'object':
        switch (children.$$typeof) {
          case REACT_ELEMENT_TYPE:
          case REACT_PORTAL_TYPE:
            invokeCallback = true;
        }

    }
  }

  if (invokeCallback) {
    var _child = children;
    var mappedChild = callback(_child); // If it's the only child, treat the name as if it was wrapped in an array
    // so that it's consistent if the number of children grows:

    var childKey = nameSoFar === '' ? SEPARATOR + getElementKey(_child, 0) : nameSoFar;

    if (Array.isArray(mappedChild)) {
      var escapedChildKey = '';

      if (childKey != null) {
        escapedChildKey = escapeUserProvidedKey(childKey) + '/';
      }

      mapIntoArray(mappedChild, array, escapedChildKey, '', function (c) {
        return c;
      });
    } else if (mappedChild != null) {
      if (isValidElement(mappedChild)) {
        mappedChild = cloneAndReplaceKey(mappedChild, // Keep both the (mapped) and old keys if they differ, just as
        // traverseAllChildren used to do for objects as children
        escapedPrefix + ( // $FlowFixMe Flow incorrectly thinks React.Portal doesn't have a key
        mappedChild.key && (!_child || _child.key !== mappedChild.key) ? // $FlowFixMe Flow incorrectly thinks existing element's key can be a number
        escapeUserProvidedKey('' + mappedChild.key) + '/' : '') + childKey);
      }

      array.push(mappedChild);
    }

    return 1;
  }

  var child;
  var nextName;
  var subtreeCount = 0; // Count of children found in the current subtree.

  var nextNamePrefix = nameSoFar === '' ? SEPARATOR : nameSoFar + SUBSEPARATOR;

  if (Array.isArray(children)) {
    for (var i = 0; i < children.length; i++) {
      child = children[i];
      nextName = nextNamePrefix + getElementKey(child, i);
      subtreeCount += mapIntoArray(child, array, escapedPrefix, nextName, callback);
    }
  } else {
    var iteratorFn = getIteratorFn(children);

    if (typeof iteratorFn === 'function') {
      var iterableChildren = children;

      {
        // Warn about using Maps as children
        if (iteratorFn === iterableChildren.entries) {
          if (!didWarnAboutMaps) {
            warn('Using Maps as children is not supported. ' + 'Use an array of keyed ReactElements instead.');
          }

          didWarnAboutMaps = true;
        }
      }

      var iterator = iteratorFn.call(iterableChildren);
      var step;
      var ii = 0;

      while (!(step = iterator.next()).done) {
        child = step.value;
        nextName = nextNamePrefix + getElementKey(child, ii++);
        subtreeCount += mapIntoArray(child, array, escapedPrefix, nextName, callback);
      }
    } else if (type === 'object') {
      var childrenString = '' + children;

      {
        {
          throw Error( "Objects are not valid as a React child (found: " + (childrenString === '[object Object]' ? 'object with keys {' + Object.keys(children).join(', ') + '}' : childrenString) + "). If you meant to render a collection of children, use an array instead." );
        }
      }
    }
  }

  return subtreeCount;
}

/**
 * Maps children that are typically specified as `props.children`.
 *
 * See https://reactjs.org/docs/react-api.html#reactchildrenmap
 *
 * The provided mapFunction(child, index) will be called for each
 * leaf child.
 *
 * @param {?*} children Children tree container.
 * @param {function(*, int)} func The map function.
 * @param {*} context Context for mapFunction.
 * @return {object} Object containing the ordered map of results.
 */
function mapChildren(children, func, context) {
  if (children == null) {
    return children;
  }

  var result = [];
  var count = 0;
  mapIntoArray(children, result, '', '', function (child) {
    return func.call(context, child, count++);
  });
  return result;
}
/**
 * Count the number of children that are typically specified as
 * `props.children`.
 *
 * See https://reactjs.org/docs/react-api.html#reactchildrencount
 *
 * @param {?*} children Children tree container.
 * @return {number} The number of children.
 */


function countChildren(children) {
  var n = 0;
  mapChildren(children, function () {
    n++; // Don't return anything
  });
  return n;
}

/**
 * Iterates through children that are typically specified as `props.children`.
 *
 * See https://reactjs.org/docs/react-api.html#reactchildrenforeach
 *
 * The provided forEachFunc(child, index) will be called for each
 * leaf child.
 *
 * @param {?*} children Children tree container.
 * @param {function(*, int)} forEachFunc
 * @param {*} forEachContext Context for forEachContext.
 */
function forEachChildren(children, forEachFunc, forEachContext) {
  mapChildren(children, function () {
    forEachFunc.apply(this, arguments); // Don't return anything.
  }, forEachContext);
}
/**
 * Flatten a children object (typically specified as `props.children`) and
 * return an array with appropriately re-keyed children.
 *
 * See https://reactjs.org/docs/react-api.html#reactchildrentoarray
 */


function toArray(children) {
  return mapChildren(children, function (child) {
    return child;
  }) || [];
}
/**
 * Returns the first child in a collection of children and verifies that there
 * is only one child in the collection.
 *
 * See https://reactjs.org/docs/react-api.html#reactchildrenonly
 *
 * The current implementation of this function assumes that a single child gets
 * passed without a wrapper, but the purpose of this helper function is to
 * abstract away the particular structure of children.
 *
 * @param {?object} children Child collection structure.
 * @return {ReactElement} The first and only `ReactElement` contained in the
 * structure.
 */


function onlyChild(children) {
  if (!isValidElement(children)) {
    {
      throw Error( "React.Children.only expected to receive a single React element child." );
    }
  }

  return children;
}

function createContext(defaultValue, calculateChangedBits) {
  if (calculateChangedBits === undefined) {
    calculateChangedBits = null;
  } else {
    {
      if (calculateChangedBits !== null && typeof calculateChangedBits !== 'function') {
        error('createContext: Expected the optional second argument to be a ' + 'function. Instead received: %s', calculateChangedBits);
      }
    }
  }

  var context = {
    $$typeof: REACT_CONTEXT_TYPE,
    _calculateChangedBits: calculateChangedBits,
    // As a workaround to support multiple concurrent renderers, we categorize
    // some renderers as primary and others as secondary. We only expect
    // there to be two concurrent renderers at most: React Native (primary) and
    // Fabric (secondary); React DOM (primary) and React ART (secondary).
    // Secondary renderers store their context values on separate fields.
    _currentValue: defaultValue,
    _currentValue2: defaultValue,
    // Used to track how many concurrent renderers this context currently
    // supports within in a single renderer. Such as parallel server rendering.
    _threadCount: 0,
    // These are circular
    Provider: null,
    Consumer: null
  };
  context.Provider = {
    $$typeof: REACT_PROVIDER_TYPE,
    _context: context
  };
  var hasWarnedAboutUsingNestedContextConsumers = false;
  var hasWarnedAboutUsingConsumerProvider = false;
  var hasWarnedAboutDisplayNameOnConsumer = false;

  {
    // A separate object, but proxies back to the original context object for
    // backwards compatibility. It has a different $$typeof, so we can properly
    // warn for the incorrect usage of Context as a Consumer.
    var Consumer = {
      $$typeof: REACT_CONTEXT_TYPE,
      _context: context,
      _calculateChangedBits: context._calculateChangedBits
    }; // $FlowFixMe: Flow complains about not setting a value, which is intentional here

    Object.defineProperties(Consumer, {
      Provider: {
        get: function () {
          if (!hasWarnedAboutUsingConsumerProvider) {
            hasWarnedAboutUsingConsumerProvider = true;

            error('Rendering <Context.Consumer.Provider> is not supported and will be removed in ' + 'a future major release. Did you mean to render <Context.Provider> instead?');
          }

          return context.Provider;
        },
        set: function (_Provider) {
          context.Provider = _Provider;
        }
      },
      _currentValue: {
        get: function () {
          return context._currentValue;
        },
        set: function (_currentValue) {
          context._currentValue = _currentValue;
        }
      },
      _currentValue2: {
        get: function () {
          return context._currentValue2;
        },
        set: function (_currentValue2) {
          context._currentValue2 = _currentValue2;
        }
      },
      _threadCount: {
        get: function () {
          return context._threadCount;
        },
        set: function (_threadCount) {
          context._threadCount = _threadCount;
        }
      },
      Consumer: {
        get: function () {
          if (!hasWarnedAboutUsingNestedContextConsumers) {
            hasWarnedAboutUsingNestedContextConsumers = true;

            error('Rendering <Context.Consumer.Consumer> is not supported and will be removed in ' + 'a future major release. Did you mean to render <Context.Consumer> instead?');
          }

          return context.Consumer;
        }
      },
      displayName: {
        get: function () {
          return context.displayName;
        },
        set: function (displayName) {
          if (!hasWarnedAboutDisplayNameOnConsumer) {
            warn('Setting `displayName` on Context.Consumer has no effect. ' + "You should set it directly on the context with Context.displayName = '%s'.", displayName);

            hasWarnedAboutDisplayNameOnConsumer = true;
          }
        }
      }
    }); // $FlowFixMe: Flow complains about missing properties because it doesn't understand defineProperty

    context.Consumer = Consumer;
  }

  {
    context._currentRenderer = null;
    context._currentRenderer2 = null;
  }

  return context;
}

var Uninitialized = -1;
var Pending = 0;
var Resolved = 1;
var Rejected = 2;

function lazyInitializer(payload) {
  if (payload._status === Uninitialized) {
    var ctor = payload._result;
    var thenable = ctor(); // Transition to the next state.

    var pending = payload;
    pending._status = Pending;
    pending._result = thenable;
    thenable.then(function (moduleObject) {
      if (payload._status === Pending) {
        var defaultExport = moduleObject.default;

        {
          if (defaultExport === undefined) {
            error('lazy: Expected the result of a dynamic import() call. ' + 'Instead received: %s\n\nYour code should look like: \n  ' + // Break up imports to avoid accidentally parsing them as dependencies.
            'const MyComponent = lazy(() => imp' + "ort('./MyComponent'))", moduleObject);
          }
        } // Transition to the next state.


        var resolved = payload;
        resolved._status = Resolved;
        resolved._result = defaultExport;
      }
    }, function (error) {
      if (payload._status === Pending) {
        // Transition to the next state.
        var rejected = payload;
        rejected._status = Rejected;
        rejected._result = error;
      }
    });
  }

  if (payload._status === Resolved) {
    return payload._result;
  } else {
    throw payload._result;
  }
}

function lazy(ctor) {
  var payload = {
    // We use these fields to store the result.
    _status: -1,
    _result: ctor
  };
  var lazyType = {
    $$typeof: REACT_LAZY_TYPE,
    _payload: payload,
    _init: lazyInitializer
  };

  {
    // In production, this would just set it on the object.
    var defaultProps;
    var propTypes; // $FlowFixMe

    Object.defineProperties(lazyType, {
      defaultProps: {
        configurable: true,
        get: function () {
          return defaultProps;
        },
        set: function (newDefaultProps) {
          error('React.lazy(...): It is not supported to assign `defaultProps` to ' + 'a lazy component import. Either specify them where the component ' + 'is defined, or create a wrapping component around it.');

          defaultProps = newDefaultProps; // Match production behavior more closely:
          // $FlowFixMe

          Object.defineProperty(lazyType, 'defaultProps', {
            enumerable: true
          });
        }
      },
      propTypes: {
        configurable: true,
        get: function () {
          return propTypes;
        },
        set: function (newPropTypes) {
          error('React.lazy(...): It is not supported to assign `propTypes` to ' + 'a lazy component import. Either specify them where the component ' + 'is defined, or create a wrapping component around it.');

          propTypes = newPropTypes; // Match production behavior more closely:
          // $FlowFixMe

          Object.defineProperty(lazyType, 'propTypes', {
            enumerable: true
          });
        }
      }
    });
  }

  return lazyType;
}

function forwardRef(render) {
  {
    if (render != null && render.$$typeof === REACT_MEMO_TYPE) {
      error('forwardRef requires a render function but received a `memo` ' + 'component. Instead of forwardRef(memo(...)), use ' + 'memo(forwardRef(...)).');
    } else if (typeof render !== 'function') {
      error('forwardRef requires a render function but was given %s.', render === null ? 'null' : typeof render);
    } else {
      if (render.length !== 0 && render.length !== 2) {
        error('forwardRef render functions accept exactly two parameters: props and ref. %s', render.length === 1 ? 'Did you forget to use the ref parameter?' : 'Any additional parameter will be undefined.');
      }
    }

    if (render != null) {
      if (render.defaultProps != null || render.propTypes != null) {
        error('forwardRef render functions do not support propTypes or defaultProps. ' + 'Did you accidentally pass a React component?');
      }
    }
  }

  var elementType = {
    $$typeof: REACT_FORWARD_REF_TYPE,
    render: render
  };

  {
    var ownName;
    Object.defineProperty(elementType, 'displayName', {
      enumerable: false,
      configurable: true,
      get: function () {
        return ownName;
      },
      set: function (name) {
        ownName = name;

        if (render.displayName == null) {
          render.displayName = name;
        }
      }
    });
  }

  return elementType;
}

// Filter certain DOM attributes (e.g. src, href) if their values are empty strings.

var enableScopeAPI = false; // Experimental Create Event Handle API.

function isValidElementType(type) {
  if (typeof type === 'string' || typeof type === 'function') {
    return true;
  } // Note: typeof might be other than 'symbol' or 'number' (e.g. if it's a polyfill).


  if (type === exports.Fragment || type === exports.Profiler || type === REACT_DEBUG_TRACING_MODE_TYPE || type === exports.StrictMode || type === exports.Suspense || type === REACT_SUSPENSE_LIST_TYPE || type === REACT_LEGACY_HIDDEN_TYPE || enableScopeAPI ) {
    return true;
  }

  if (typeof type === 'object' && type !== null) {
    if (type.$$typeof === REACT_LAZY_TYPE || type.$$typeof === REACT_MEMO_TYPE || type.$$typeof === REACT_PROVIDER_TYPE || type.$$typeof === REACT_CONTEXT_TYPE || type.$$typeof === REACT_FORWARD_REF_TYPE || type.$$typeof === REACT_FUNDAMENTAL_TYPE || type.$$typeof === REACT_BLOCK_TYPE || type[0] === REACT_SERVER_BLOCK_TYPE) {
      return true;
    }
  }

  return false;
}

function memo(type, compare) {
  {
    if (!isValidElementType(type)) {
      error('memo: The first argument must be a component. Instead ' + 'received: %s', type === null ? 'null' : typeof type);
    }
  }

  var elementType = {
    $$typeof: REACT_MEMO_TYPE,
    type: type,
    compare: compare === undefined ? null : compare
  };

  {
    var ownName;
    Object.defineProperty(elementType, 'displayName', {
      enumerable: false,
      configurable: true,
      get: function () {
        return ownName;
      },
      set: function (name) {
        ownName = name;

        if (type.displayName == null) {
          type.displayName = name;
        }
      }
    });
  }

  return elementType;
}

function resolveDispatcher() {
  var dispatcher = ReactCurrentDispatcher.current;

  if (!(dispatcher !== null)) {
    {
      throw Error( "Invalid hook call. Hooks can only be called inside of the body of a function component. This could happen for one of the following reasons:\n1. You might have mismatching versions of React and the renderer (such as React DOM)\n2. You might be breaking the Rules of Hooks\n3. You might have more than one copy of React in the same app\nSee https://reactjs.org/link/invalid-hook-call for tips about how to debug and fix this problem." );
    }
  }

  return dispatcher;
}

function useContext(Context, unstable_observedBits) {
  var dispatcher = resolveDispatcher();

  {
    if (unstable_observedBits !== undefined) {
      error('useContext() second argument is reserved for future ' + 'use in React. Passing it is not supported. ' + 'You passed: %s.%s', unstable_observedBits, typeof unstable_observedBits === 'number' && Array.isArray(arguments[2]) ? '\n\nDid you call array.map(useContext)? ' + 'Calling Hooks inside a loop is not supported. ' + 'Learn more at https://reactjs.org/link/rules-of-hooks' : '');
    } // TODO: add a more generic warning for invalid values.


    if (Context._context !== undefined) {
      var realContext = Context._context; // Don't deduplicate because this legitimately causes bugs
      // and nobody should be using this in existing code.

      if (realContext.Consumer === Context) {
        error('Calling useContext(Context.Consumer) is not supported, may cause bugs, and will be ' + 'removed in a future major release. Did you mean to call useContext(Context) instead?');
      } else if (realContext.Provider === Context) {
        error('Calling useContext(Context.Provider) is not supported. ' + 'Did you mean to call useContext(Context) instead?');
      }
    }
  }

  return dispatcher.useContext(Context, unstable_observedBits);
}
function useState(initialState) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useState(initialState);
}
function useReducer(reducer, initialArg, init) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useReducer(reducer, initialArg, init);
}
function useRef(initialValue) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useRef(initialValue);
}
function useEffect(create, deps) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useEffect(create, deps);
}
function useLayoutEffect(create, deps) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useLayoutEffect(create, deps);
}
function useCallback(callback, deps) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useCallback(callback, deps);
}
function useMemo(create, deps) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useMemo(create, deps);
}
function useImperativeHandle(ref, create, deps) {
  var dispatcher = resolveDispatcher();
  return dispatcher.useImperativeHandle(ref, create, deps);
}
function useDebugValue(value, formatterFn) {
  {
    var dispatcher = resolveDispatcher();
    return dispatcher.useDebugValue(value, formatterFn);
  }
}

// Helpers to patch console.logs to avoid logging during side-effect free
// replaying on render function. This currently only patches the object
// lazily which won't cover if the log function was extracted eagerly.
// We could also eagerly patch the method.
var disabledDepth = 0;
var prevLog;
var prevInfo;
var prevWarn;
var prevError;
var prevGroup;
var prevGroupCollapsed;
var prevGroupEnd;

function disabledLog() {}

disabledLog.__reactDisabledLog = true;
function disableLogs() {
  {
    if (disabledDepth === 0) {
      /* eslint-disable react-internal/no-production-logging */
      prevLog = console.log;
      prevInfo = console.info;
      prevWarn = console.warn;
      prevError = console.error;
      prevGroup = console.group;
      prevGroupCollapsed = console.groupCollapsed;
      prevGroupEnd = console.groupEnd; // https://github.com/facebook/react/issues/19099

      var props = {
        configurable: true,
        enumerable: true,
        value: disabledLog,
        writable: true
      }; // $FlowFixMe Flow thinks console is immutable.

      Object.defineProperties(console, {
        info: props,
        log: props,
        warn: props,
        error: props,
        group: props,
        groupCollapsed: props,
        groupEnd: props
      });
      /* eslint-enable react-internal/no-production-logging */
    }

    disabledDepth++;
  }
}
function reenableLogs() {
  {
    disabledDepth--;

    if (disabledDepth === 0) {
      /* eslint-disable react-internal/no-production-logging */
      var props = {
        configurable: true,
        enumerable: true,
        writable: true
      }; // $FlowFixMe Flow thinks console is immutable.

      Object.defineProperties(console, {
        log: _assign({}, props, {
          value: prevLog
        }),
        info: _assign({}, props, {
          value: prevInfo
        }),
        warn: _assign({}, props, {
          value: prevWarn
        }),
        error: _assign({}, props, {
          value: prevError
        }),
        group: _assign({}, props, {
          value: prevGroup
        }),
        groupCollapsed: _assign({}, props, {
          value: prevGroupCollapsed
        }),
        groupEnd: _assign({}, props, {
          value: prevGroupEnd
        })
      });
      /* eslint-enable react-internal/no-production-logging */
    }

    if (disabledDepth < 0) {
      error('disabledDepth fell below zero. ' + 'This is a bug in React. Please file an issue.');
    }
  }
}

var ReactCurrentDispatcher$1 = ReactSharedInternals.ReactCurrentDispatcher;
var prefix;
function describeBuiltInComponentFrame(name, source, ownerFn) {
  {
    if (prefix === undefined) {
      // Extract the VM specific prefix used by each line.
      try {
        throw Error();
      } catch (x) {
        var match = x.stack.trim().match(/\n( *(at )?)/);
        prefix = match && match[1] || '';
      }
    } // We use the prefix to ensure our stacks line up with native stack frames.


    return '\n' + prefix + name;
  }
}
var reentry = false;
var componentFrameCache;

{
  var PossiblyWeakMap = typeof WeakMap === 'function' ? WeakMap : Map;
  componentFrameCache = new PossiblyWeakMap();
}

function describeNativeComponentFrame(fn, construct) {
  // If something asked for a stack inside a fake render, it should get ignored.
  if (!fn || reentry) {
    return '';
  }

  {
    var frame = componentFrameCache.get(fn);

    if (frame !== undefined) {
      return frame;
    }
  }

  var control;
  reentry = true;
  var previousPrepareStackTrace = Error.prepareStackTrace; // $FlowFixMe It does accept undefined.

  Error.prepareStackTrace = undefined;
  var previousDispatcher;

  {
    previousDispatcher = ReactCurrentDispatcher$1.current; // Set the dispatcher in DEV because this might be call in the render function
    // for warnings.

    ReactCurrentDispatcher$1.current = null;
    disableLogs();
  }

  try {
    // This should throw.
    if (construct) {
      // Something should be setting the props in the constructor.
      var Fake = function () {
        throw Error();
      }; // $FlowFixMe


      Object.defineProperty(Fake.prototype, 'props', {
        set: function () {
          // We use a throwing setter instead of frozen or non-writable props
          // because that won't throw in a non-strict mode function.
          throw Error();
        }
      });

      if (typeof Reflect === 'object' && Reflect.construct) {
        // We construct a different control for this case to include any extra
        // frames added by the construct call.
        try {
          Reflect.construct(Fake, []);
        } catch (x) {
          control = x;
        }

        Reflect.construct(fn, [], Fake);
      } else {
        try {
          Fake.call();
        } catch (x) {
          control = x;
        }

        fn.call(Fake.prototype);
      }
    } else {
      try {
        throw Error();
      } catch (x) {
        control = x;
      }

      fn();
    }
  } catch (sample) {
    // This is inlined manually because closure doesn't do it for us.
    if (sample && control && typeof sample.stack === 'string') {
      // This extracts the first frame from the sample that isn't also in the control.
      // Skipping one frame that we assume is the frame that calls the two.
      var sampleLines = sample.stack.split('\n');
      var controlLines = control.stack.split('\n');
      var s = sampleLines.length - 1;
      var c = controlLines.length - 1;

      while (s >= 1 && c >= 0 && sampleLines[s] !== controlLines[c]) {
        // We expect at least one stack frame to be shared.
        // Typically this will be the root most one. However, stack frames may be
        // cut off due to maximum stack limits. In this case, one maybe cut off
        // earlier than the other. We assume that the sample is longer or the same
        // and there for cut off earlier. So we should find the root most frame in
        // the sample somewhere in the control.
        c--;
      }

      for (; s >= 1 && c >= 0; s--, c--) {
        // Next we find the first one that isn't the same which should be the
        // frame that called our sample function and the control.
        if (sampleLines[s] !== controlLines[c]) {
          // In V8, the first line is describing the message but other VMs don't.
          // If we're about to return the first line, and the control is also on the same
          // line, that's a pretty good indicator that our sample threw at same line as
          // the control. I.e. before we entered the sample frame. So we ignore this result.
          // This can happen if you passed a class to function component, or non-function.
          if (s !== 1 || c !== 1) {
            do {
              s--;
              c--; // We may still have similar intermediate frames from the construct call.
              // The next one that isn't the same should be our match though.

              if (c < 0 || sampleLines[s] !== controlLines[c]) {
                // V8 adds a "new" prefix for native classes. Let's remove it to make it prettier.
                var _frame = '\n' + sampleLines[s].replace(' at new ', ' at ');

                {
                  if (typeof fn === 'function') {
                    componentFrameCache.set(fn, _frame);
                  }
                } // Return the line we found.


                return _frame;
              }
            } while (s >= 1 && c >= 0);
          }

          break;
        }
      }
    }
  } finally {
    reentry = false;

    {
      ReactCurrentDispatcher$1.current = previousDispatcher;
      reenableLogs();
    }

    Error.prepareStackTrace = previousPrepareStackTrace;
  } // Fallback to just using the name if we couldn't make it throw.


  var name = fn ? fn.displayName || fn.name : '';
  var syntheticFrame = name ? describeBuiltInComponentFrame(name) : '';

  {
    if (typeof fn === 'function') {
      componentFrameCache.set(fn, syntheticFrame);
    }
  }

  return syntheticFrame;
}
function describeFunctionComponentFrame(fn, source, ownerFn) {
  {
    return describeNativeComponentFrame(fn, false);
  }
}

function shouldConstruct(Component) {
  var prototype = Component.prototype;
  return !!(prototype && prototype.isReactComponent);
}

function describeUnknownElementTypeFrameInDEV(type, source, ownerFn) {

  if (type == null) {
    return '';
  }

  if (typeof type === 'function') {
    {
      return describeNativeComponentFrame(type, shouldConstruct(type));
    }
  }

  if (typeof type === 'string') {
    return describeBuiltInComponentFrame(type);
  }

  switch (type) {
    case exports.Suspense:
      return describeBuiltInComponentFrame('Suspense');

    case REACT_SUSPENSE_LIST_TYPE:
      return describeBuiltInComponentFrame('SuspenseList');
  }

  if (typeof type === 'object') {
    switch (type.$$typeof) {
      case REACT_FORWARD_REF_TYPE:
        return describeFunctionComponentFrame(type.render);

      case REACT_MEMO_TYPE:
        // Memo may contain any component type so we recursively resolve it.
        return describeUnknownElementTypeFrameInDEV(type.type, source, ownerFn);

      case REACT_BLOCK_TYPE:
        return describeFunctionComponentFrame(type._render);

      case REACT_LAZY_TYPE:
        {
          var lazyComponent = type;
          var payload = lazyComponent._payload;
          var init = lazyComponent._init;

          try {
            // Lazy may contain any component type so we recursively resolve it.
            return describeUnknownElementTypeFrameInDEV(init(payload), source, ownerFn);
          } catch (x) {}
        }
    }
  }

  return '';
}

var loggedTypeFailures = {};
var ReactDebugCurrentFrame$1 = ReactSharedInternals.ReactDebugCurrentFrame;

function setCurrentlyValidatingElement(element) {
  {
    if (element) {
      var owner = element._owner;
      var stack = describeUnknownElementTypeFrameInDEV(element.type, element._source, owner ? owner.type : null);
      ReactDebugCurrentFrame$1.setExtraStackFrame(stack);
    } else {
      ReactDebugCurrentFrame$1.setExtraStackFrame(null);
    }
  }
}

function checkPropTypes(typeSpecs, values, location, componentName, element) {
  {
    // $FlowFixMe This is okay but Flow doesn't know it.
    var has = Function.call.bind(Object.prototype.hasOwnProperty);

    for (var typeSpecName in typeSpecs) {
      if (has(typeSpecs, typeSpecName)) {
        var error$1 = void 0; // Prop type validation may throw. In case they do, we don't want to
        // fail the render phase where it didn't fail before. So we log it.
        // After these have been cleaned up, we'll let them throw.

        try {
          // This is intentionally an invariant that gets caught. It's the same
          // behavior as without this statement except with a better message.
          if (typeof typeSpecs[typeSpecName] !== 'function') {
            var err = Error((componentName || 'React class') + ': ' + location + ' type `' + typeSpecName + '` is invalid; ' + 'it must be a function, usually from the `prop-types` package, but received `' + typeof typeSpecs[typeSpecName] + '`.' + 'This often happens because of typos such as `PropTypes.function` instead of `PropTypes.func`.');
            err.name = 'Invariant Violation';
            throw err;
          }

          error$1 = typeSpecs[typeSpecName](values, typeSpecName, componentName, location, null, 'SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED');
        } catch (ex) {
          error$1 = ex;
        }

        if (error$1 && !(error$1 instanceof Error)) {
          setCurrentlyValidatingElement(element);

          error('%s: type specification of %s' + ' `%s` is invalid; the type checker ' + 'function must return `null` or an `Error` but returned a %s. ' + 'You may have forgotten to pass an argument to the type checker ' + 'creator (arrayOf, instanceOf, objectOf, oneOf, oneOfType, and ' + 'shape all require an argument).', componentName || 'React class', location, typeSpecName, typeof error$1);

          setCurrentlyValidatingElement(null);
        }

        if (error$1 instanceof Error && !(error$1.message in loggedTypeFailures)) {
          // Only monitor this failure once because there tends to be a lot of the
          // same error.
          loggedTypeFailures[error$1.message] = true;
          setCurrentlyValidatingElement(element);

          error('Failed %s type: %s', location, error$1.message);

          setCurrentlyValidatingElement(null);
        }
      }
    }
  }
}

function setCurrentlyValidatingElement$1(element) {
  {
    if (element) {
      var owner = element._owner;
      var stack = describeUnknownElementTypeFrameInDEV(element.type, element._source, owner ? owner.type : null);
      setExtraStackFrame(stack);
    } else {
      setExtraStackFrame(null);
    }
  }
}

var propTypesMisspellWarningShown;

{
  propTypesMisspellWarningShown = false;
}

function getDeclarationErrorAddendum() {
  if (ReactCurrentOwner.current) {
    var name = getComponentName(ReactCurrentOwner.current.type);

    if (name) {
      return '\n\nCheck the render method of `' + name + '`.';
    }
  }

  return '';
}

function getSourceInfoErrorAddendum(source) {
  if (source !== undefined) {
    var fileName = source.fileName.replace(/^.*[\\\/]/, '');
    var lineNumber = source.lineNumber;
    return '\n\nCheck your code at ' + fileName + ':' + lineNumber + '.';
  }

  return '';
}

function getSourceInfoErrorAddendumForProps(elementProps) {
  if (elementProps !== null && elementProps !== undefined) {
    return getSourceInfoErrorAddendum(elementProps.__source);
  }

  return '';
}
/**
 * Warn if there's no key explicitly set on dynamic arrays of children or
 * object keys are not valid. This allows us to keep track of children between
 * updates.
 */


var ownerHasKeyUseWarning = {};

function getCurrentComponentErrorInfo(parentType) {
  var info = getDeclarationErrorAddendum();

  if (!info) {
    var parentName = typeof parentType === 'string' ? parentType : parentType.displayName || parentType.name;

    if (parentName) {
      info = "\n\nCheck the top-level render call using <" + parentName + ">.";
    }
  }

  return info;
}
/**
 * Warn if the element doesn't have an explicit key assigned to it.
 * This element is in an array. The array could grow and shrink or be
 * reordered. All children that haven't already been validated are required to
 * have a "key" property assigned to it. Error statuses are cached so a warning
 * will only be shown once.
 *
 * @internal
 * @param {ReactElement} element Element that requires a key.
 * @param {*} parentType element's parent's type.
 */


function validateExplicitKey(element, parentType) {
  if (!element._store || element._store.validated || element.key != null) {
    return;
  }

  element._store.validated = true;
  var currentComponentErrorInfo = getCurrentComponentErrorInfo(parentType);

  if (ownerHasKeyUseWarning[currentComponentErrorInfo]) {
    return;
  }

  ownerHasKeyUseWarning[currentComponentErrorInfo] = true; // Usually the current owner is the offender, but if it accepts children as a
  // property, it may be the creator of the child that's responsible for
  // assigning it a key.

  var childOwner = '';

  if (element && element._owner && element._owner !== ReactCurrentOwner.current) {
    // Give the component that originally created this child.
    childOwner = " It was passed a child from " + getComponentName(element._owner.type) + ".";
  }

  {
    setCurrentlyValidatingElement$1(element);

    error('Each child in a list should have a unique "key" prop.' + '%s%s See https://reactjs.org/link/warning-keys for more information.', currentComponentErrorInfo, childOwner);

    setCurrentlyValidatingElement$1(null);
  }
}
/**
 * Ensure that every element either is passed in a static location, in an
 * array with an explicit keys property defined, or in an object literal
 * with valid key property.
 *
 * @internal
 * @param {ReactNode} node Statically passed child of any type.
 * @param {*} parentType node's parent's type.
 */


function validateChildKeys(node, parentType) {
  if (typeof node !== 'object') {
    return;
  }

  if (Array.isArray(node)) {
    for (var i = 0; i < node.length; i++) {
      var child = node[i];

      if (isValidElement(child)) {
        validateExplicitKey(child, parentType);
      }
    }
  } else if (isValidElement(node)) {
    // This element was passed in a valid location.
    if (node._store) {
      node._store.validated = true;
    }
  } else if (node) {
    var iteratorFn = getIteratorFn(node);

    if (typeof iteratorFn === 'function') {
      // Entry iterators used to provide implicit keys,
      // but now we print a separate warning for them later.
      if (iteratorFn !== node.entries) {
        var iterator = iteratorFn.call(node);
        var step;

        while (!(step = iterator.next()).done) {
          if (isValidElement(step.value)) {
            validateExplicitKey(step.value, parentType);
          }
        }
      }
    }
  }
}
/**
 * Given an element, validate that its props follow the propTypes definition,
 * provided by the type.
 *
 * @param {ReactElement} element
 */


function validatePropTypes(element) {
  {
    var type = element.type;

    if (type === null || type === undefined || typeof type === 'string') {
      return;
    }

    var propTypes;

    if (typeof type === 'function') {
      propTypes = type.propTypes;
    } else if (typeof type === 'object' && (type.$$typeof === REACT_FORWARD_REF_TYPE || // Note: Memo only checks outer props here.
    // Inner props are checked in the reconciler.
    type.$$typeof === REACT_MEMO_TYPE)) {
      propTypes = type.propTypes;
    } else {
      return;
    }

    if (propTypes) {
      // Intentionally inside to avoid triggering lazy initializers:
      var name = getComponentName(type);
      checkPropTypes(propTypes, element.props, 'prop', name, element);
    } else if (type.PropTypes !== undefined && !propTypesMisspellWarningShown) {
      propTypesMisspellWarningShown = true; // Intentionally inside to avoid triggering lazy initializers:

      var _name = getComponentName(type);

      error('Component %s declared `PropTypes` instead of `propTypes`. Did you misspell the property assignment?', _name || 'Unknown');
    }

    if (typeof type.getDefaultProps === 'function' && !type.getDefaultProps.isReactClassApproved) {
      error('getDefaultProps is only used on classic React.createClass ' + 'definitions. Use a static property named `defaultProps` instead.');
    }
  }
}
/**
 * Given a fragment, validate that it can only be provided with fragment props
 * @param {ReactElement} fragment
 */


function validateFragmentProps(fragment) {
  {
    var keys = Object.keys(fragment.props);

    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];

      if (key !== 'children' && key !== 'key') {
        setCurrentlyValidatingElement$1(fragment);

        error('Invalid prop `%s` supplied to `React.Fragment`. ' + 'React.Fragment can only have `key` and `children` props.', key);

        setCurrentlyValidatingElement$1(null);
        break;
      }
    }

    if (fragment.ref !== null) {
      setCurrentlyValidatingElement$1(fragment);

      error('Invalid attribute `ref` supplied to `React.Fragment`.');

      setCurrentlyValidatingElement$1(null);
    }
  }
}
function createElementWithValidation(type, props, children) {
  var validType = isValidElementType(type); // We warn in this case but don't throw. We expect the element creation to
  // succeed and there will likely be errors in render.

  if (!validType) {
    var info = '';

    if (type === undefined || typeof type === 'object' && type !== null && Object.keys(type).length === 0) {
      info += ' You likely forgot to export your component from the file ' + "it's defined in, or you might have mixed up default and named imports.";
    }

    var sourceInfo = getSourceInfoErrorAddendumForProps(props);

    if (sourceInfo) {
      info += sourceInfo;
    } else {
      info += getDeclarationErrorAddendum();
    }

    var typeString;

    if (type === null) {
      typeString = 'null';
    } else if (Array.isArray(type)) {
      typeString = 'array';
    } else if (type !== undefined && type.$$typeof === REACT_ELEMENT_TYPE) {
      typeString = "<" + (getComponentName(type.type) || 'Unknown') + " />";
      info = ' Did you accidentally export a JSX literal instead of a component?';
    } else {
      typeString = typeof type;
    }

    {
      error('React.createElement: type is invalid -- expected a string (for ' + 'built-in components) or a class/function (for composite ' + 'components) but got: %s.%s', typeString, info);
    }
  }

  var element = createElement.apply(this, arguments); // The result can be nullish if a mock or a custom function is used.
  // TODO: Drop this when these are no longer allowed as the type argument.

  if (element == null) {
    return element;
  } // Skip key warning if the type isn't valid since our key validation logic
  // doesn't expect a non-string/function type and can throw confusing errors.
  // We don't want exception behavior to differ between dev and prod.
  // (Rendering will throw with a helpful message and as soon as the type is
  // fixed, the key warnings will appear.)


  if (validType) {
    for (var i = 2; i < arguments.length; i++) {
      validateChildKeys(arguments[i], type);
    }
  }

  if (type === exports.Fragment) {
    validateFragmentProps(element);
  } else {
    validatePropTypes(element);
  }

  return element;
}
var didWarnAboutDeprecatedCreateFactory = false;
function createFactoryWithValidation(type) {
  var validatedFactory = createElementWithValidation.bind(null, type);
  validatedFactory.type = type;

  {
    if (!didWarnAboutDeprecatedCreateFactory) {
      didWarnAboutDeprecatedCreateFactory = true;

      warn('React.createFactory() is deprecated and will be removed in ' + 'a future major release. Consider using JSX ' + 'or use React.createElement() directly instead.');
    } // Legacy hook: remove it


    Object.defineProperty(validatedFactory, 'type', {
      enumerable: false,
      get: function () {
        warn('Factory.type is deprecated. Access the class directly ' + 'before passing it to createFactory.');

        Object.defineProperty(this, 'type', {
          value: type
        });
        return type;
      }
    });
  }

  return validatedFactory;
}
function cloneElementWithValidation(element, props, children) {
  var newElement = cloneElement.apply(this, arguments);

  for (var i = 2; i < arguments.length; i++) {
    validateChildKeys(arguments[i], newElement.type);
  }

  validatePropTypes(newElement);
  return newElement;
}

{

  try {
    var frozenObject = Object.freeze({});
    /* eslint-disable no-new */

    new Map([[frozenObject, null]]);
    new Set([frozenObject]);
    /* eslint-enable no-new */
  } catch (e) {
  }
}

var createElement$1 =  createElementWithValidation ;
var cloneElement$1 =  cloneElementWithValidation ;
var createFactory =  createFactoryWithValidation ;
var Children = {
  map: mapChildren,
  forEach: forEachChildren,
  count: countChildren,
  toArray: toArray,
  only: onlyChild
};

exports.Children = Children;
exports.Component = Component;
exports.PureComponent = PureComponent;
exports.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED = ReactSharedInternals;
exports.cloneElement = cloneElement$1;
exports.createContext = createContext;
exports.createElement = createElement$1;
exports.createFactory = createFactory;
exports.createRef = createRef;
exports.forwardRef = forwardRef;
exports.isValidElement = isValidElement;
exports.lazy = lazy;
exports.memo = memo;
exports.useCallback = useCallback;
exports.useContext = useContext;
exports.useDebugValue = useDebugValue;
exports.useEffect = useEffect;
exports.useImperativeHandle = useImperativeHandle;
exports.useLayoutEffect = useLayoutEffect;
exports.useMemo = useMemo;
exports.useReducer = useReducer;
exports.useRef = useRef;
exports.useState = useState;
exports.version = ReactVersion;
  })();
}


/***/ }),

/***/ "./node_modules/react/index.js":
/*!*************************************!*\
  !*** ./node_modules/react/index.js ***!
  \*************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



if (false) {} else {
  module.exports = __webpack_require__(/*! ./cjs/react.development.js */ "./node_modules/react/cjs/react.development.js");
}


/***/ }),

/***/ "./node_modules/react/jsx-runtime.js":
/*!*******************************************!*\
  !*** ./node_modules/react/jsx-runtime.js ***!
  \*******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



if (false) {} else {
  module.exports = __webpack_require__(/*! ./cjs/react-jsx-runtime.development.js */ "./node_modules/react/cjs/react-jsx-runtime.development.js");
}


/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/extends.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _extends)
/* harmony export */ });
function _extends() {
  _extends = Object.assign ? Object.assign.bind() : function (target) {
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

/***/ }),

/***/ "./node_modules/stylis/src/Enum.js":
/*!*****************************************!*\
  !*** ./node_modules/stylis/src/Enum.js ***!
  \*****************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "MS": () => (/* binding */ MS),
/* harmony export */   "MOZ": () => (/* binding */ MOZ),
/* harmony export */   "WEBKIT": () => (/* binding */ WEBKIT),
/* harmony export */   "COMMENT": () => (/* binding */ COMMENT),
/* harmony export */   "RULESET": () => (/* binding */ RULESET),
/* harmony export */   "DECLARATION": () => (/* binding */ DECLARATION),
/* harmony export */   "PAGE": () => (/* binding */ PAGE),
/* harmony export */   "MEDIA": () => (/* binding */ MEDIA),
/* harmony export */   "IMPORT": () => (/* binding */ IMPORT),
/* harmony export */   "CHARSET": () => (/* binding */ CHARSET),
/* harmony export */   "VIEWPORT": () => (/* binding */ VIEWPORT),
/* harmony export */   "SUPPORTS": () => (/* binding */ SUPPORTS),
/* harmony export */   "DOCUMENT": () => (/* binding */ DOCUMENT),
/* harmony export */   "NAMESPACE": () => (/* binding */ NAMESPACE),
/* harmony export */   "KEYFRAMES": () => (/* binding */ KEYFRAMES),
/* harmony export */   "FONT_FACE": () => (/* binding */ FONT_FACE),
/* harmony export */   "COUNTER_STYLE": () => (/* binding */ COUNTER_STYLE),
/* harmony export */   "FONT_FEATURE_VALUES": () => (/* binding */ FONT_FEATURE_VALUES),
/* harmony export */   "LAYER": () => (/* binding */ LAYER)
/* harmony export */ });
var MS = '-ms-'
var MOZ = '-moz-'
var WEBKIT = '-webkit-'

var COMMENT = 'comm'
var RULESET = 'rule'
var DECLARATION = 'decl'

var PAGE = '@page'
var MEDIA = '@media'
var IMPORT = '@import'
var CHARSET = '@charset'
var VIEWPORT = '@viewport'
var SUPPORTS = '@supports'
var DOCUMENT = '@document'
var NAMESPACE = '@namespace'
var KEYFRAMES = '@keyframes'
var FONT_FACE = '@font-face'
var COUNTER_STYLE = '@counter-style'
var FONT_FEATURE_VALUES = '@font-feature-values'
var LAYER = '@layer'


/***/ }),

/***/ "./node_modules/stylis/src/Middleware.js":
/*!***********************************************!*\
  !*** ./node_modules/stylis/src/Middleware.js ***!
  \***********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "middleware": () => (/* binding */ middleware),
/* harmony export */   "rulesheet": () => (/* binding */ rulesheet),
/* harmony export */   "prefixer": () => (/* binding */ prefixer),
/* harmony export */   "namespace": () => (/* binding */ namespace)
/* harmony export */ });
/* harmony import */ var _Enum_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Enum.js */ "./node_modules/stylis/src/Enum.js");
/* harmony import */ var _Utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Utility.js */ "./node_modules/stylis/src/Utility.js");
/* harmony import */ var _Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./Tokenizer.js */ "./node_modules/stylis/src/Tokenizer.js");
/* harmony import */ var _Serializer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Serializer.js */ "./node_modules/stylis/src/Serializer.js");
/* harmony import */ var _Prefixer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Prefixer.js */ "./node_modules/stylis/src/Prefixer.js");






/**
 * @param {function[]} collection
 * @return {function}
 */
function middleware (collection) {
	var length = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.sizeof)(collection)

	return function (element, index, children, callback) {
		var output = ''

		for (var i = 0; i < length; i++)
			output += collection[i](element, index, children, callback) || ''

		return output
	}
}

/**
 * @param {function} callback
 * @return {function}
 */
function rulesheet (callback) {
	return function (element) {
		if (!element.root)
			if (element = element.return)
				callback(element)
	}
}

/**
 * @param {object} element
 * @param {number} index
 * @param {object[]} children
 * @param {function} callback
 */
function prefixer (element, index, children, callback) {
	if (element.length > -1)
		if (!element.return)
			switch (element.type) {
				case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.DECLARATION: element.return = (0,_Prefixer_js__WEBPACK_IMPORTED_MODULE_2__.prefix)(element.value, element.length, children)
					return
				case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.KEYFRAMES:
					return (0,_Serializer_js__WEBPACK_IMPORTED_MODULE_3__.serialize)([(0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.copy)(element, {value: (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(element.value, '@', '@' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT)})], callback)
				case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.RULESET:
					if (element.length)
						return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.combine)(element.props, function (value) {
							switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(value, /(::plac\w+|:read-\w+)/)) {
								// :read-(only|write)
								case ':read-only': case ':read-write':
									return (0,_Serializer_js__WEBPACK_IMPORTED_MODULE_3__.serialize)([(0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.copy)(element, {props: [(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /:(read-\w+)/, ':' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MOZ + '$1')]})], callback)
								// :placeholder
								case '::placeholder':
									return (0,_Serializer_js__WEBPACK_IMPORTED_MODULE_3__.serialize)([
										(0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.copy)(element, {props: [(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /:(plac\w+)/, ':' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + 'input-$1')]}),
										(0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.copy)(element, {props: [(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /:(plac\w+)/, ':' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MOZ + '$1')]}),
										(0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.copy)(element, {props: [(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /:(plac\w+)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'input-$1')]})
									], callback)
							}

							return ''
						})
			}
}

/**
 * @param {object} element
 * @param {number} index
 * @param {object[]} children
 */
function namespace (element) {
	switch (element.type) {
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.RULESET:
			element.props = element.props.map(function (value) {
				return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.combine)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_4__.tokenize)(value), function (value, index, children) {
					switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, 0)) {
						// \f
						case 12:
							return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.substr)(value, 1, (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.strlen)(value))
						// \0 ( + > ~
						case 0: case 40: case 43: case 62: case 126:
							return value
						// :
						case 58:
							if (children[++index] === 'global')
								children[index] = '', children[++index] = '\f' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.substr)(children[index], index = 1, -1)
						// \s
						case 32:
							return index === 1 ? '' : value
						default:
							switch (index) {
								case 0: element = value
									return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.sizeof)(children) > 1 ? '' : value
								case index = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.sizeof)(children) - 1: case 2:
									return index === 2 ? value + element + element : value + element
								default:
									return value
							}
					}
				})
			})
	}
}


/***/ }),

/***/ "./node_modules/stylis/src/Parser.js":
/*!*******************************************!*\
  !*** ./node_modules/stylis/src/Parser.js ***!
  \*******************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "compile": () => (/* binding */ compile),
/* harmony export */   "parse": () => (/* binding */ parse),
/* harmony export */   "ruleset": () => (/* binding */ ruleset),
/* harmony export */   "comment": () => (/* binding */ comment),
/* harmony export */   "declaration": () => (/* binding */ declaration)
/* harmony export */ });
/* harmony import */ var _Enum_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Enum.js */ "./node_modules/stylis/src/Enum.js");
/* harmony import */ var _Utility_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Utility.js */ "./node_modules/stylis/src/Utility.js");
/* harmony import */ var _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Tokenizer.js */ "./node_modules/stylis/src/Tokenizer.js");




/**
 * @param {string} value
 * @return {object[]}
 */
function compile (value) {
	return (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.dealloc)(parse('', null, null, null, [''], value = (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.alloc)(value), 0, [0], value))
}

/**
 * @param {string} value
 * @param {object} root
 * @param {object?} parent
 * @param {string[]} rule
 * @param {string[]} rules
 * @param {string[]} rulesets
 * @param {number[]} pseudo
 * @param {number[]} points
 * @param {string[]} declarations
 * @return {object}
 */
function parse (value, root, parent, rule, rules, rulesets, pseudo, points, declarations) {
	var index = 0
	var offset = 0
	var length = pseudo
	var atrule = 0
	var property = 0
	var previous = 0
	var variable = 1
	var scanning = 1
	var ampersand = 1
	var character = 0
	var type = ''
	var props = rules
	var children = rulesets
	var reference = rule
	var characters = type

	while (scanning)
		switch (previous = character, character = (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.next)()) {
			// (
			case 40:
				if (previous != 108 && (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.charat)(characters, length - 1) == 58) {
					if ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.indexof)(characters += (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.replace)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.delimit)(character), '&', '&\f'), '&\f') != -1)
						ampersand = -1
					break
				}
			// " ' [
			case 34: case 39: case 91:
				characters += (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.delimit)(character)
				break
			// \t \n \r \s
			case 9: case 10: case 13: case 32:
				characters += (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.whitespace)(previous)
				break
			// \
			case 92:
				characters += (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.escaping)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.caret)() - 1, 7)
				continue
			// /
			case 47:
				switch ((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.peek)()) {
					case 42: case 47:
						;(0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.append)(comment((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.commenter)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.next)(), (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.caret)()), root, parent), declarations)
						break
					default:
						characters += '/'
				}
				break
			// {
			case 123 * variable:
				points[index++] = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(characters) * ampersand
			// } ; \0
			case 125 * variable: case 59: case 0:
				switch (character) {
					// \0 }
					case 0: case 125: scanning = 0
					// ;
					case 59 + offset: if (ampersand == -1) characters = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.replace)(characters, /\f/g, '')
						if (property > 0 && ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(characters) - length))
							(0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.append)(property > 32 ? declaration(characters + ';', rule, parent, length - 1) : declaration((0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.replace)(characters, ' ', '') + ';', rule, parent, length - 2), declarations)
						break
					// @ ;
					case 59: characters += ';'
					// { rule/at-rule
					default:
						;(0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.append)(reference = ruleset(characters, root, parent, index, offset, rules, points, type, props = [], children = [], length), rulesets)

						if (character === 123)
							if (offset === 0)
								parse(characters, root, reference, reference, props, rulesets, length, points, children)
							else
								switch (atrule === 99 && (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.charat)(characters, 3) === 110 ? 100 : atrule) {
									// d l m s
									case 100: case 108: case 109: case 115:
										parse(value, reference, reference, rule && (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.append)(ruleset(value, reference, reference, 0, 0, rules, points, type, rules, props = [], length), children), rules, children, length, points, rule ? props : children)
										break
									default:
										parse(characters, reference, reference, reference, [''], children, 0, points, children)
								}
				}

				index = offset = property = 0, variable = ampersand = 1, type = characters = '', length = pseudo
				break
			// :
			case 58:
				length = 1 + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(characters), property = previous
			default:
				if (variable < 1)
					if (character == 123)
						--variable
					else if (character == 125 && variable++ == 0 && (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.prev)() == 125)
						continue

				switch (characters += (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.from)(character), character * variable) {
					// &
					case 38:
						ampersand = offset > 0 ? 1 : (characters += '\f', -1)
						break
					// ,
					case 44:
						points[index++] = ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(characters) - 1) * ampersand, ampersand = 1
						break
					// @
					case 64:
						// -
						if ((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.peek)() === 45)
							characters += (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.delimit)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.next)())

						atrule = (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.peek)(), offset = length = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(type = characters += (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.identifier)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.caret)())), character++
						break
					// -
					case 45:
						if (previous === 45 && (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.strlen)(characters) == 2)
							variable = 0
				}
		}

	return rulesets
}

/**
 * @param {string} value
 * @param {object} root
 * @param {object?} parent
 * @param {number} index
 * @param {number} offset
 * @param {string[]} rules
 * @param {number[]} points
 * @param {string} type
 * @param {string[]} props
 * @param {string[]} children
 * @param {number} length
 * @return {object}
 */
function ruleset (value, root, parent, index, offset, rules, points, type, props, children, length) {
	var post = offset - 1
	var rule = offset === 0 ? rules : ['']
	var size = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.sizeof)(rule)

	for (var i = 0, j = 0, k = 0; i < index; ++i)
		for (var x = 0, y = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.substr)(value, post + 1, post = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.abs)(j = points[i])), z = value; x < size; ++x)
			if (z = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.trim)(j > 0 ? rule[x] + ' ' + y : (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.replace)(y, /&\f/g, rule[x])))
				props[k++] = z

	return (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.node)(value, root, parent, offset === 0 ? _Enum_js__WEBPACK_IMPORTED_MODULE_2__.RULESET : type, props, children, length)
}

/**
 * @param {number} value
 * @param {object} root
 * @param {object?} parent
 * @return {object}
 */
function comment (value, root, parent) {
	return (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.node)(value, root, parent, _Enum_js__WEBPACK_IMPORTED_MODULE_2__.COMMENT, (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.from)((0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.char)()), (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.substr)(value, 2, -2), 0)
}

/**
 * @param {string} value
 * @param {object} root
 * @param {object?} parent
 * @param {number} length
 * @return {object}
 */
function declaration (value, root, parent, length) {
	return (0,_Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.node)(value, root, parent, _Enum_js__WEBPACK_IMPORTED_MODULE_2__.DECLARATION, (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.substr)(value, 0, length), (0,_Utility_js__WEBPACK_IMPORTED_MODULE_1__.substr)(value, length + 1, -1), length)
}


/***/ }),

/***/ "./node_modules/stylis/src/Prefixer.js":
/*!*********************************************!*\
  !*** ./node_modules/stylis/src/Prefixer.js ***!
  \*********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "prefix": () => (/* binding */ prefix)
/* harmony export */ });
/* harmony import */ var _Enum_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Enum.js */ "./node_modules/stylis/src/Enum.js");
/* harmony import */ var _Utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Utility.js */ "./node_modules/stylis/src/Utility.js");



/**
 * @param {string} value
 * @param {number} length
 * @param {object[]} children
 * @return {string}
 */
function prefix (value, length, children) {
	switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.hash)(value, length)) {
		// color-adjust
		case 5103:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + 'print-' + value + value
		// animation, animation-(delay|direction|duration|fill-mode|iteration-count|name|play-state|timing-function)
		case 5737: case 4201: case 3177: case 3433: case 1641: case 4457: case 2921:
		// text-decoration, filter, clip-path, backface-visibility, column, box-decoration-break
		case 5572: case 6356: case 5844: case 3191: case 6645: case 3005:
		// mask, mask-image, mask-(mode|clip|size), mask-(repeat|origin), mask-position, mask-composite,
		case 6391: case 5879: case 5623: case 6135: case 4599: case 4855:
		// background-clip, columns, column-(count|fill|gap|rule|rule-color|rule-style|rule-width|span|width)
		case 4215: case 6389: case 5109: case 5365: case 5621: case 3829:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + value
		// tab-size
		case 4789:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MOZ + value + value
		// appearance, user-select, transform, hyphens, text-size-adjust
		case 5349: case 4246: case 4810: case 6968: case 2756:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MOZ + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + value + value
		// writing-mode
		case 5936:
			switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, length + 11)) {
				// vertical-l(r)
				case 114:
					return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /[svh]\w+-[tblr]{2}/, 'tb') + value
				// vertical-r(l)
				case 108:
					return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /[svh]\w+-[tblr]{2}/, 'tb-rl') + value
				// horizontal(-)tb
				case 45:
					return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /[svh]\w+-[tblr]{2}/, 'lr') + value
				// default: fallthrough to below
			}
		// flex, flex-direction, scroll-snap-type, writing-mode
		case 6828: case 4268: case 2903:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + value + value
		// order
		case 6165:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'flex-' + value + value
		// align-items
		case 5187:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(\w+).+(:[^]+)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + 'box-$1$2' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'flex-$1$2') + value
		// align-self
		case 5443:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'flex-item-' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /flex-|-self/g, '') + (!(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(value, /flex-|baseline/) ? _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'grid-row-' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /flex-|-self/g, '') : '') + value
		// align-content
		case 4675:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'flex-line-pack' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /align-content|flex-|-self/g, '') + value
		// flex-shrink
		case 5548:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'shrink', 'negative') + value
		// flex-basis
		case 5292:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'basis', 'preferred-size') + value
		// flex-grow
		case 6060:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + 'box-' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, '-grow', '') + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'grow', 'positive') + value
		// transition
		case 4554:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /([^-])(transform)/g, '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$2') + value
		// cursor
		case 6187:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(zoom-|grab)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$1'), /(image-set)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$1'), value, '') + value
		// background, background-image
		case 5495: case 3959:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(image-set\([^]*)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$1' + '$`$1')
		// justify-content
		case 4968:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(.+:)(flex-)?(.*)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + 'box-pack:$3' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'flex-pack:$3'), /s.+-b[^;]+/, 'justify') + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + value + value
		// justify-self
		case 4200:
			if (!(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(value, /flex-|baseline/)) return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'grid-column-align' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.substr)(value, length) + value
			break
		// grid-template-(columns|rows)
		case 2592: case 3360:
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'template-', '') + value
		// grid-(row|column)-start
		case 4384: case 3616:
			if (children && children.some(function (element, index) { return length = index, (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(element.props, /grid-\w+-end/) })) {
				return ~(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.indexof)(value + (children = children[length].value), 'span') ? value : (_Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, '-start', '') + value + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + 'grid-row-span:' + (~(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.indexof)(children, 'span') ? (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(children, /\d+/) : +(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(children, /\d+/) - +(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(value, /\d+/)) + ';')
			}
			return _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, '-start', '') + value
		// grid-(row|column)-end
		case 4896: case 4128:
			return (children && children.some(function (element) { return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.match)(element.props, /grid-\w+-start/) })) ? value : _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, '-end', '-span'), 'span ', '') + value
		// (margin|padding)-inline-(start|end)
		case 4095: case 3583: case 4068: case 2532:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(.+)-inline(.+)/, _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$1$2') + value
		// (min|max)?(width|height|inline-size|block-size)
		case 8116: case 7059: case 5753: case 5535:
		case 5445: case 5701: case 4933: case 4677:
		case 5533: case 5789: case 5021: case 4765:
			// stretch, max-content, min-content, fill-available
			if ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.strlen)(value) - 1 - length > 6)
				switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, length + 1)) {
					// (m)ax-content, (m)in-content
					case 109:
						// -
						if ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, length + 4) !== 45)
							break
					// (f)ill-available, (f)it-content
					case 102:
						return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(.+:)(.+)-([^]+)/, '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$2-$3' + '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MOZ + ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, length + 3) == 108 ? '$3' : '$2-$3')) + value
					// (s)tretch
					case 115:
						return ~(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.indexof)(value, 'stretch') ? prefix((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'stretch', 'fill-available'), length, children) + value : value
				}
			break
		// grid-(column|row)
		case 5152: case 5920:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(.+?):(\d+)(\s*\/\s*(span)?\s*(\d+))?(.*)/, function (_, a, b, c, d, e, f) { return (_Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + a + ':' + b + f) + (c ? (_Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + a + '-span:' + (d ? e : +e - +b)) + f : '') + value })
		// position: sticky
		case 4949:
			// stick(y)?
			if ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, length + 6) === 121)
				return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, ':', ':' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT) + value
			break
		// display: (flex|inline-flex|grid|inline-grid)
		case 6444:
			switch ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, 14) === 45 ? 18 : 11)) {
				// (inline-)?fle(x)
				case 120:
					return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, /(.+:)([^;\s!]+)(;|(\s+)?!.+)?/, '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + ((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(value, 14) === 45 ? 'inline-' : '') + 'box$3' + '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.WEBKIT + '$2$3' + '$1' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS + '$2box$3') + value
				// (inline-)?gri(d)
				case 100:
					return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, ':', ':' + _Enum_js__WEBPACK_IMPORTED_MODULE_1__.MS) + value
			}
			break
		// scroll-margin, scroll-margin-(top|right|bottom|left)
		case 5719: case 2647: case 2135: case 3927: case 2391:
			return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.replace)(value, 'scroll-', 'scroll-snap-') + value
	}

	return value
}


/***/ }),

/***/ "./node_modules/stylis/src/Serializer.js":
/*!***********************************************!*\
  !*** ./node_modules/stylis/src/Serializer.js ***!
  \***********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "serialize": () => (/* binding */ serialize),
/* harmony export */   "stringify": () => (/* binding */ stringify)
/* harmony export */ });
/* harmony import */ var _Enum_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Enum.js */ "./node_modules/stylis/src/Enum.js");
/* harmony import */ var _Utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Utility.js */ "./node_modules/stylis/src/Utility.js");



/**
 * @param {object[]} children
 * @param {function} callback
 * @return {string}
 */
function serialize (children, callback) {
	var output = ''
	var length = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.sizeof)(children)

	for (var i = 0; i < length; i++)
		output += callback(children[i], i, children, callback) || ''

	return output
}

/**
 * @param {object} element
 * @param {number} index
 * @param {object[]} children
 * @param {function} callback
 * @return {string}
 */
function stringify (element, index, children, callback) {
	switch (element.type) {
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.LAYER: if (element.children.length) break
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.IMPORT: case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.DECLARATION: return element.return = element.return || element.value
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.COMMENT: return ''
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.KEYFRAMES: return element.return = element.value + '{' + serialize(element.children, callback) + '}'
		case _Enum_js__WEBPACK_IMPORTED_MODULE_1__.RULESET: element.value = element.props.join(',')
	}

	return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.strlen)(children = serialize(element.children, callback)) ? element.return = element.value + '{' + children + '}' : ''
}


/***/ }),

/***/ "./node_modules/stylis/src/Tokenizer.js":
/*!**********************************************!*\
  !*** ./node_modules/stylis/src/Tokenizer.js ***!
  \**********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "line": () => (/* binding */ line),
/* harmony export */   "column": () => (/* binding */ column),
/* harmony export */   "length": () => (/* binding */ length),
/* harmony export */   "position": () => (/* binding */ position),
/* harmony export */   "character": () => (/* binding */ character),
/* harmony export */   "characters": () => (/* binding */ characters),
/* harmony export */   "node": () => (/* binding */ node),
/* harmony export */   "copy": () => (/* binding */ copy),
/* harmony export */   "char": () => (/* binding */ char),
/* harmony export */   "prev": () => (/* binding */ prev),
/* harmony export */   "next": () => (/* binding */ next),
/* harmony export */   "peek": () => (/* binding */ peek),
/* harmony export */   "caret": () => (/* binding */ caret),
/* harmony export */   "slice": () => (/* binding */ slice),
/* harmony export */   "token": () => (/* binding */ token),
/* harmony export */   "alloc": () => (/* binding */ alloc),
/* harmony export */   "dealloc": () => (/* binding */ dealloc),
/* harmony export */   "delimit": () => (/* binding */ delimit),
/* harmony export */   "tokenize": () => (/* binding */ tokenize),
/* harmony export */   "whitespace": () => (/* binding */ whitespace),
/* harmony export */   "tokenizer": () => (/* binding */ tokenizer),
/* harmony export */   "escaping": () => (/* binding */ escaping),
/* harmony export */   "delimiter": () => (/* binding */ delimiter),
/* harmony export */   "commenter": () => (/* binding */ commenter),
/* harmony export */   "identifier": () => (/* binding */ identifier)
/* harmony export */ });
/* harmony import */ var _Utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Utility.js */ "./node_modules/stylis/src/Utility.js");


var line = 1
var column = 1
var length = 0
var position = 0
var character = 0
var characters = ''

/**
 * @param {string} value
 * @param {object | null} root
 * @param {object | null} parent
 * @param {string} type
 * @param {string[] | string} props
 * @param {object[] | string} children
 * @param {number} length
 */
function node (value, root, parent, type, props, children, length) {
	return {value: value, root: root, parent: parent, type: type, props: props, children: children, line: line, column: column, length: length, return: ''}
}

/**
 * @param {object} root
 * @param {object} props
 * @return {object}
 */
function copy (root, props) {
	return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.assign)(node('', null, null, '', null, null, 0), root, {length: -root.length}, props)
}

/**
 * @return {number}
 */
function char () {
	return character
}

/**
 * @return {number}
 */
function prev () {
	character = position > 0 ? (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(characters, --position) : 0

	if (column--, character === 10)
		column = 1, line--

	return character
}

/**
 * @return {number}
 */
function next () {
	character = position < length ? (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(characters, position++) : 0

	if (column++, character === 10)
		column = 1, line++

	return character
}

/**
 * @return {number}
 */
function peek () {
	return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.charat)(characters, position)
}

/**
 * @return {number}
 */
function caret () {
	return position
}

/**
 * @param {number} begin
 * @param {number} end
 * @return {string}
 */
function slice (begin, end) {
	return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.substr)(characters, begin, end)
}

/**
 * @param {number} type
 * @return {number}
 */
function token (type) {
	switch (type) {
		// \0 \t \n \r \s whitespace token
		case 0: case 9: case 10: case 13: case 32:
			return 5
		// ! + , / > @ ~ isolate token
		case 33: case 43: case 44: case 47: case 62: case 64: case 126:
		// ; { } breakpoint token
		case 59: case 123: case 125:
			return 4
		// : accompanied token
		case 58:
			return 3
		// " ' ( [ opening delimit token
		case 34: case 39: case 40: case 91:
			return 2
		// ) ] closing delimit token
		case 41: case 93:
			return 1
	}

	return 0
}

/**
 * @param {string} value
 * @return {any[]}
 */
function alloc (value) {
	return line = column = 1, length = (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.strlen)(characters = value), position = 0, []
}

/**
 * @param {any} value
 * @return {any}
 */
function dealloc (value) {
	return characters = '', value
}

/**
 * @param {number} type
 * @return {string}
 */
function delimit (type) {
	return (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.trim)(slice(position - 1, delimiter(type === 91 ? type + 2 : type === 40 ? type + 1 : type)))
}

/**
 * @param {string} value
 * @return {string[]}
 */
function tokenize (value) {
	return dealloc(tokenizer(alloc(value)))
}

/**
 * @param {number} type
 * @return {string}
 */
function whitespace (type) {
	while (character = peek())
		if (character < 33)
			next()
		else
			break

	return token(type) > 2 || token(character) > 3 ? '' : ' '
}

/**
 * @param {string[]} children
 * @return {string[]}
 */
function tokenizer (children) {
	while (next())
		switch (token(character)) {
			case 0: (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.append)(identifier(position - 1), children)
				break
			case 2: ;(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.append)(delimit(character), children)
				break
			default: ;(0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.append)((0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.from)(character), children)
		}

	return children
}

/**
 * @param {number} index
 * @param {number} count
 * @return {string}
 */
function escaping (index, count) {
	while (--count && next())
		// not 0-9 A-F a-f
		if (character < 48 || character > 102 || (character > 57 && character < 65) || (character > 70 && character < 97))
			break

	return slice(index, caret() + (count < 6 && peek() == 32 && next() == 32))
}

/**
 * @param {number} type
 * @return {number}
 */
function delimiter (type) {
	while (next())
		switch (character) {
			// ] ) " '
			case type:
				return position
			// " '
			case 34: case 39:
				if (type !== 34 && type !== 39)
					delimiter(character)
				break
			// (
			case 40:
				if (type === 41)
					delimiter(type)
				break
			// \
			case 92:
				next()
				break
		}

	return position
}

/**
 * @param {number} type
 * @param {number} index
 * @return {number}
 */
function commenter (type, index) {
	while (next())
		// //
		if (type + character === 47 + 10)
			break
		// /*
		else if (type + character === 42 + 42 && peek() === 47)
			break

	return '/*' + slice(index, position - 1) + '*' + (0,_Utility_js__WEBPACK_IMPORTED_MODULE_0__.from)(type === 47 ? type : next())
}

/**
 * @param {number} index
 * @return {string}
 */
function identifier (index) {
	while (!token(peek()))
		next()

	return slice(index, position)
}


/***/ }),

/***/ "./node_modules/stylis/src/Utility.js":
/*!********************************************!*\
  !*** ./node_modules/stylis/src/Utility.js ***!
  \********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "abs": () => (/* binding */ abs),
/* harmony export */   "from": () => (/* binding */ from),
/* harmony export */   "assign": () => (/* binding */ assign),
/* harmony export */   "hash": () => (/* binding */ hash),
/* harmony export */   "trim": () => (/* binding */ trim),
/* harmony export */   "match": () => (/* binding */ match),
/* harmony export */   "replace": () => (/* binding */ replace),
/* harmony export */   "indexof": () => (/* binding */ indexof),
/* harmony export */   "charat": () => (/* binding */ charat),
/* harmony export */   "substr": () => (/* binding */ substr),
/* harmony export */   "strlen": () => (/* binding */ strlen),
/* harmony export */   "sizeof": () => (/* binding */ sizeof),
/* harmony export */   "append": () => (/* binding */ append),
/* harmony export */   "combine": () => (/* binding */ combine)
/* harmony export */ });
/**
 * @param {number}
 * @return {number}
 */
var abs = Math.abs

/**
 * @param {number}
 * @return {string}
 */
var from = String.fromCharCode

/**
 * @param {object}
 * @return {object}
 */
var assign = Object.assign

/**
 * @param {string} value
 * @param {number} length
 * @return {number}
 */
function hash (value, length) {
	return charat(value, 0) ^ 45 ? (((((((length << 2) ^ charat(value, 0)) << 2) ^ charat(value, 1)) << 2) ^ charat(value, 2)) << 2) ^ charat(value, 3) : 0
}

/**
 * @param {string} value
 * @return {string}
 */
function trim (value) {
	return value.trim()
}

/**
 * @param {string} value
 * @param {RegExp} pattern
 * @return {string?}
 */
function match (value, pattern) {
	return (value = pattern.exec(value)) ? value[0] : value
}

/**
 * @param {string} value
 * @param {(string|RegExp)} pattern
 * @param {string} replacement
 * @return {string}
 */
function replace (value, pattern, replacement) {
	return value.replace(pattern, replacement)
}

/**
 * @param {string} value
 * @param {string} search
 * @return {number}
 */
function indexof (value, search) {
	return value.indexOf(search)
}

/**
 * @param {string} value
 * @param {number} index
 * @return {number}
 */
function charat (value, index) {
	return value.charCodeAt(index) | 0
}

/**
 * @param {string} value
 * @param {number} begin
 * @param {number} end
 * @return {string}
 */
function substr (value, begin, end) {
	return value.slice(begin, end)
}

/**
 * @param {string} value
 * @return {number}
 */
function strlen (value) {
	return value.length
}

/**
 * @param {any[]} value
 * @return {number}
 */
function sizeof (value) {
	return value.length
}

/**
 * @param {any} value
 * @param {any[]} array
 * @return {any}
 */
function append (value, array) {
	return array.push(value), value
}

/**
 * @param {string[]} array
 * @param {function} callback
 * @return {string}
 */
function combine (array, callback) {
	return array.map(callback).join('')
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/create fake namespace object */
/******/ 	(() => {
/******/ 		var getProto = Object.getPrototypeOf ? (obj) => (Object.getPrototypeOf(obj)) : (obj) => (obj.__proto__);
/******/ 		var leafPrototypes;
/******/ 		// create a fake namespace object
/******/ 		// mode & 1: value is a module id, require it
/******/ 		// mode & 2: merge all properties of value into the ns
/******/ 		// mode & 4: return value when already ns object
/******/ 		// mode & 16: return value when it's Promise-like
/******/ 		// mode & 8|1: behave like require
/******/ 		__webpack_require__.t = function(value, mode) {
/******/ 			if(mode & 1) value = this(value);
/******/ 			if(mode & 8) return value;
/******/ 			if(typeof value === 'object' && value) {
/******/ 				if((mode & 4) && value.__esModule) return value;
/******/ 				if((mode & 16) && typeof value.then === 'function') return value;
/******/ 			}
/******/ 			var ns = Object.create(null);
/******/ 			__webpack_require__.r(ns);
/******/ 			var def = {};
/******/ 			leafPrototypes = leafPrototypes || [null, getProto({}), getProto([]), getProto(getProto)];
/******/ 			for(var current = mode & 2 && value; typeof current == 'object' && !~leafPrototypes.indexOf(current); current = getProto(current)) {
/******/ 				Object.getOwnPropertyNames(current).forEach((key) => (def[key] = () => (value[key])));
/******/ 			}
/******/ 			def['default'] = () => (value);
/******/ 			__webpack_require__.d(ns, def);
/******/ 			return ns;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************************!*\
  !*** ./resources/js/client/pages/plans/vendor.js ***!
  \***************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Paper/Paper.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Divider/Divider.js");
/* harmony import */ var _mantine_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @mantine/core */ "./node_modules/@mantine/core/esm/components/Button/Button.js");
/* harmony import */ var _components_list__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/list */ "./resources/js/client/components/list/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
/**
 * External dependencies
 */


/**
 *
 * Internal dependencies`
 */






var VendorPlans = function VendorPlans() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      style: {
        paddingTop: "0",
        paddingBottom: "4em",
        width: "100%"
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h1", {
        className: "main-heading text-center",
        children: "Vendors"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        style: {
          display: "flex",
          flexDirection: "row",
          justifyContent: "space-evenly",
          marginTop: "2em",
          gap: "2em"
        },
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Paper, {
          shadow: "lg",
          padding: "xl",
          radius: "md",
          withBorder: true,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Pivotal, {})
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Paper, {
          shadow: "lg",
          padding: "xl",
          radius: "md",
          withBorder: true,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(MovingUp, {})
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_3__.Paper, {
          shadow: "lg",
          padding: "xl",
          radius: "md",
          withBorder: true,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Premium, {})
        })]
      })]
    })
  });
};

var Pivotal = function Pivotal() {
  var pivotal_data = [{
    title: "Create a Vendor Account"
  }, {
    title: "Add/Sell up to 3 products"
  }, {
    title: "Post(Hire up to 2 creatives/month)"
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      style: {
        display: "flex",
        flexDirection: "column",
        padding: "2em",
        alignItems: "center"
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "top-section",
        children: " Pivotal "
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "plan-content",
        style: {
          marginTop: "2em"
        },
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_components_list__WEBPACK_IMPORTED_MODULE_1__["default"], {
          data: pivotal_data
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Divider, {
        size: "sm"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        style: {
          marginTop: "2em",
          fontSize: "1.5rem"
        },
        children: ["$5.99", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
          style: {
            fontSize: "0.8rem",
            color: "#6F408E"
          },
          children: "/month"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Button, {
        style: {
          marginTop: "2em",
          backgroundColor: "#6F408E"
        },
        size: "md",
        children: "Start Now"
      })]
    })
  });
};

var MovingUp = function MovingUp() {
  var moveup_data = [{
    title: "Create a Vendor Account"
  }, {
    title: "Add/Sell up to 6 products"
  }, {
    title: "Post(Hire up to 4 creatives/month)"
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      style: {
        display: "flex",
        flexDirection: "column",
        padding: "2em",
        alignItems: "center"
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "top-section",
        children: " MovingUp"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "plan-content",
        style: {
          marginTop: "2em"
        },
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_components_list__WEBPACK_IMPORTED_MODULE_1__["default"], {
          data: moveup_data
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Divider, {
        size: "sm"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        style: {
          marginTop: "2em",
          fontSize: "1.5rem"
        },
        children: ["$8.99", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
          style: {
            fontSize: "0.8rem",
            color: "#6F408E"
          },
          children: "/month"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Button, {
        style: {
          marginTop: "2em",
          backgroundColor: "#6F408E"
        },
        size: "md",
        children: "Start Now"
      })]
    })
  });
};

var Premium = function Premium() {
  var premium_data = [{
    title: "Create a Vendor Account"
  }, {
    title: "Add/Sell up to 10 products"
  }, {
    title: "Post(Hire up to ꝏ creatives/month)"
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      style: {
        display: "flex",
        flexDirection: "column",
        padding: "2em",
        alignItems: "center"
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "top-section",
        children: " Premium"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "plan-content",
        style: {
          marginTop: "2em"
        },
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_components_list__WEBPACK_IMPORTED_MODULE_1__["default"], {
          data: premium_data
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_4__.Divider, {
        size: "sm"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        style: {
          marginTop: "2em",
          fontSize: "1.5rem"
        },
        children: ["$12.99", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
          style: {
            fontSize: "0.8rem",
            color: "#6F408E"
          },
          children: "/month"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_mantine_core__WEBPACK_IMPORTED_MODULE_5__.Button, {
        style: {
          marginTop: "2em",
          backgroundColor: "#6F408E"
        },
        size: "md",
        children: "Start Now"
      })]
    })
  });
}; // ReactDOM.render(<VendorPlans />, document.getElementById("vendor-plans"));


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (VendorPlans);
})();

/******/ })()
;