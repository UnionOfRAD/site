#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

source $DETA/transfer.sh
source $DETA/invoke.sh
source $DETA/util.sh
source $DETA/g11n.sh
source $DETA/asset.sh
source $DETA/vcs.sh

role THIS
SOURCE_PATH=$(dirname $(pwd)) # we execute in bin/
TMP=$(mktemp -d -t deta.XXXX)
defer rm -rf $TMP

BRANCH=$(git_current_branch)
msgwarn "Selected branch %s!" $BRANCH

msg "Preparing build stage..."

msg "Cloning repository..."
git clone --verbose --single-branch --recursive --branch $BRANCH file://$SOURCE_PATH $TMP

msg "Determing versions...."

REV_HEAD=$(git_rev_for HEAD)
TAG_DEPLOYED="deployed-${BRANCH}"

if [[ $(git_has $TAG_DEPLOYED) == "y" ]]; then
	INITIAL_DEPLOYMENT="n"
	REV_DEPLOYED=$(git_rev_for $TAG_DEPLOYED)

	msgok "Found deployed tag; using %s." $REV_DEPLOYED
else
	INITIAL_DEPLOYMENT="y"
	REV_DEPLOYED=$(git_first_commit)

	msgwarn "Intitial deployment."
	msgwarn "No tag found; using first commit %s." $REV_DEPLOYED
fi

msg "Changes since %s to-be-deployed:" $REV_DEPLOYED
git --no-pager log --oneline ${REV_DEPLOYED}..
echo
git --no-pager diff --shortstat $REV_DEPLOYED
echo

msg "Will enter build stage."
dry

#
# Continue build
#
msg "Entering build stage..."

msg "Installing composer packages..."
cd $TMP/app
composer --prefer-dist --no-dev install
composer dump-autoload --optimize
cd -

# Last preparations before transfer.
# msg "Determing data upgrades..."
# DATA_UPGRADE_FILES=$(git diff-tree --name-only -r ${REV_DEPLOYED}.. -- data/upgrade);

# Version
fill "__VERSION_BUILD__" "$REV_HEAD" $TMP/Envfile
fill "__PROJECT_VERSION_BUILD__" "$REV_HEAD" $TMP/app/config/bootstrap.php

# Assets pipeline
COMPRESSOR_JS="yuicompressor"
COMPRESSOR_CSS="sqwish"

for FILE in $(find $TMP -iregex '.*/assets/.*\.css'); do
	myth $FILE $FILE
	msgok "Myth processed %s." $FILE
done

for FILE in $(find $TMP -iregex '.*/assets/.*\.js'); do
	compress_js $FILE $FILE
done

for FILE in $(find $TMP -iregex '.*/assets/.*\.css'); do
	compress_css $FILE $FILE
done

for FILE in $(find $TMP -iregex '.*/assets/.*\.png'); do
	compress_img $FILE $FILE
done
#	for FILE in $(find $TMP -iregex '.*/assets/.*\.jpg'); do
#		compress_img $FILE $FILE
#	done

vcs_clear $TMP

msg "Fixing group permissions..."
chmod -R a+rX $TMP
chmod -R ug+rwX $TMP

#
# Transfer
#
msg "Entering transfer stage..."
sync_sanity $TMP/ $THIS_USER@$THIS_HOST:$THIS_PATH "$THIS_TRANSFER_IGNORE"
set +o errexit
sync $TMP/ $THIS_USER@$THIS_HOST:$THIS_PATH "$THIS_TRANSFER_IGNORE"
set -o errexit

run_ssh $THIS_USER@$THIS_HOST <<-SESSION
	chmod -R a+rwX $THIS_PATH/app/resources/tmp
	sudo hoictl --project=$THIS_PATH load
SESSION

#
# Post-Deploy
#
msg "Entering post-deploy stage..."

# Finalize
cd $SOURCE_PATH
msg "Tagging revision %s as deployed." $REV_HEAD
git tag -f $TAG_DEPLOYED $REV_HEAD
cd -
