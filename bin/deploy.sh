#!/bin/sh

cp resources/js/client/bootstrap.js public/client/
cp resources/js/client/helper.js public/client/
cp resources/js/client/index.js public/client/
git add .
git commit -m "pre Deploy assets"
git push origin master && git pull

git push heroku master
