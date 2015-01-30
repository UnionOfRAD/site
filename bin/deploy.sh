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
source $DETA/asset.sh
source $DETA/vcs.sh

role SOURCE
role TARGET

TMP=$(mktemp -d -t deta)
defer rm -rf $TMP

BRANCH=$(git_current_branch)
msgwarn "Selected branch %s!" $BRANCH

dry

msg "Preparing build stage..."

msg "Cloning repository..."
git clone --verbose --single-branch --recursive --branch $BRANCH $SOURCE_REPO $TMP

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

read -p "Optimize? (Y/n) " OPTIMIZE

msg "Changes since %s to-be-deployed:" $REV_DEPLOYED
git --no-pager log --oneline ${REV_DEPLOYED}..
echo
git --no-pager diff --shortstat $REV_DEPLOYED
echo
read -p "Deploy these changes? (Y/n) " CONFIRM
if [[ $CONFIRM == "n" ]]; then
	exit 1
fi

if [[ $INITIAL_DEPLOYMENT != "y" ]]; then
	set +o errexit
	run_ssh $TARGET_USER@$TARGET_HOST <<-SESSION
		cd $TARGET_PATH/bin
		./deta.sh -c ../config/deta check-integrity.sh
	SESSION
	set -o errexit
	read -p "Integrity OK? (Y/n) " PROCEED
	if [[ "$PROCEED" = "n" ]]; then
		exit 1
	fi
fi

#
# Continue build
#
msg "Entering build stage..."

msg "Installing submodules..."
cd $TMP
git submodule update --init --recursive
cd -

msg "Installing composer packages..."
cd $TMP/app
composer --prefer-dist --no-dev install
composer dump-autoload --optimize
cd -

# Version
fill "__PROJECT_VERSION_BUILD__" "$REV_HEAD" $TMP/app/config/bootstrap.php

# Assets pipeline
COMPRESSOR_JS="yuicompressor"
COMPRESSOR_CSS="yuicompressor"

#for FILE in $(find -L $TMP/assets -name "*.css"); do
	# myth $FILE $FILE
	# msgok "Myth processed %s." $FILE
#done
if [[ "$OPTIMIZE" != "n" ]]; then
	for FILE in $(find -L -E $TMP/assets -name "*.js"); do
		compress_js $FILE $FILE
	done

	for FILE in $(find -L $TMP/assets -name "*.css"); do
		compress_css $FILE $FILE
	done

	for FILE in $(find -L $TMP/assets -name "*.png"); do
		compress_img $FILE $FILE
	done
fi

vcs_clear $TMP

msg "Fixing group permissions..."
chmod -R a+rX $TMP
chmod -R ug+rwX $TMP

#
# Transfer
#
msg "Entering transfer stage..."

sync_sanity $TMP/ $TARGET_USER@$TARGET_HOST:$TARGET_PATH "$TARGET_TRANSFER_IGNORE"
set +o errexit
sync $TMP/ $TARGET_USER@$TARGET_HOST:$TARGET_PATH "$TARGET_TRANSFER_IGNORE"
set -o errexit

run_ssh $TARGET_USER@$TARGET_HOST <<-SESSION
	cd $TARGET_PATH/bin
	./deta.sh -c ../config/deta create-config.sh
	./deta.sh -c ../config/deta fix-perms.sh
	./deta.sh -c ../config/deta create-integrity-spec.sh
	echo "Updating supervisor processes..."
	supervisorctl update
	supervisorctl restart ${TARGET_NAME}_irc_bot:*
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

