#!/bin/bash
#
# Lithium Site
#
# Copyright (c) 2015 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

set +o errexit

DOCS_PATH=$(dirname $(pwd))/tmp

REPOS="lithium manual specs li3_behaviors"
for R in $REPOS; do

	echo "Cleaning up..."
	rm -fr $DOCS_PATH/${R}_*

	echo "Cloning reference repo ${R}..."
	git clone --branch master https://github.com/UnionOfRAD/${R}.git $DOCS_PATH/${R}_master

	echo "Cloning version repos..."
	case $R in
		lithium)
			REFS="1.0 1.1" ;;
		manual)
			REFS="1.x" ;;
		specs)
			REFS="" ;;
		li3_behaviors)
			REFS="v1.1.0 2.0" ;;
	esac

	for REF in $REFS; do
		git clone \
			--reference $DOCS_PATH/${R}_master \
			--branch ${REF} \
			https://github.com/UnionOfRAD/${R}.git $DOCS_PATH/${R}_${REF}
	done
done

./li3.php docs index

