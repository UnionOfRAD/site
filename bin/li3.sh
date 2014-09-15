#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

role THIS

set +errexit

cd $THIS_PATH/app
$THIS_PHP -f $THIS_PATH/app/libraries/unionofrad/lithium/lithium/console/lithium.php -- "$@"
