#!/usr/bin/env bash

set -e

# Remove unwanted files.
composer install --no-dev --prefer-dist
rm -rf node_modules
rm -rf tests
rm -rf bin
rm -rf .git
rm -rf .github
rm -rf .phpcs.xml.dist
rm -rf .gitignore
rm -rf .browserslistrc
rm -rf .eslintrc
rm -rf tests
rm -rf phpunit.xml.dist
rm -rf work

curl -L https://raw.githubusercontent.com/fumikito/wp-readme/master/wp-readme.php | php
