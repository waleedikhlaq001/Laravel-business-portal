const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js("resources/js/app.js", "public/js/app.js")
    .vue()
    .sass("resources/sass/app.scss", "public/css/app.css");

mix.js("resources/js/client/index.js", "public/client/index.js").react();
mix.js("resources/js/client/helper.js", "public/client/helper.js").react();
mix.js("resources/js/client/bootstrap.js", "public/client/bootstrap.js");
mix.js(
    "resources/js/client/pages/checkout/index.js",
    "public/client/checkout/index.js"
).react();

mix.js(
    "resources/js/client/pages/dispute/index.js",
    "public/client/dispute/index.js"
).react();

mix.js(
    "resources/js/client/pages/chat/index.js",
    "public/client/chat/index.js"
).react();

mix.js(
    "resources/js/client/pages/plans/index.js",
    "public/client/plans/index.js"
).react();
mix.js(
    "resources/js/client/pages/plans/vendor.js",
    "public/client/plans/vendor.js"
).react();
mix.js(
    "resources/js/client/pages/milestones/index.js",
    "public/client/milestones/index.js"
).react();
mix.js(
    "resources/js/client/pages/video/index.js",
    "public/client/video/index.js"
).react();
mix.js(
    "resources/js/client/pages/video/action.js",
    "public/client/video/action.js"
).react();
mix.js(
    "resources/js/client/pages/milestones/final.js",
    "public/client/milestones/final.js"
).react();
mix.js(
    "resources/js/client/pages/video/accept.js",
    "public/client/video/accept.js"
).react();
mix.js(
    "resources/js/client/pages/jobs/index.js",
    "public/client/jobs/index.js"
).react();
mix.js(
    "resources/js/client/pages/categories/index.js",
    "public/client/categories/index.js"
).react();
mix.js(
    "resources/js/client/pages/mall/index.js",
    "public/client/mall/index.js"
).react();
mix.js(
    "resources/js/client/pages/products/index.js",
    "public/client/products/index.js"
).react();
