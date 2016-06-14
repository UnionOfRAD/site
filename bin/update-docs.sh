#
# Lithium Site
#
# Copyright (c) 2015 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

role THIS

set +o errexit

DOCS_PATH=$THIS_PATH/app/resources/docs

rm -fr $DOCS_PATH
mkdir -p $DOCS_PATH

git clone --branch 1.0 https://github.com/UnionOfRAD/lithium.git $DOCS_PATH/lithium_10
git clone --reference $DOCS_PATH/lithium_10 --branch 1.1 https://github.com/UnionOfRAD/lithium.git $DOCS_PATH/lithium_11

git clone --branch 1.x https://github.com/UnionOfRAD/manual.git $DOCS_PATH/manual_1

git clone --branch master https://github.com/UnionOfRAD/specs.git $DOCS_PATH/specs

./li3.php docs index

