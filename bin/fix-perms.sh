#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

role THIS

set +o errexit

# chmod -R a+rwX $THIS_PATH/app/resources/bot
chmod -R a+rwX $THIS_PATH/app/resources/tmp
chmod -R a+rwX $THIS_PATH/log

# Enable once target allows sudo.
# msg "Fixing permissions on config/logrotate.conf..."
# chmod 0640 $THIS_PATH/config/logrotate.conf
# sudo chown root $THIS_PATH/config/logrotate.conf

# find $THIS_PATH/app/resources/tmp -type f -exec chmod -f 0666 {} \;
# find $THIS_PATH/app/resources/tmp -type d -exec chmod -f 0777 {} \;

