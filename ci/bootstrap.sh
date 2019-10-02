#!/usr/bin/env bash

# Delete any migrations etc
rm -Rf tests/App/src/Orm/

./tests/App/bin/console transfer:generate
./tests/App/bin/console propel:install
