#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

source $DETA/util.sh

role THIS

cd  $THIS_PATH/config/nginx/includes
for NAME in app assets access; do
	msg "Generating includes configuration from templates for ${NAME}..."

	cp $NAME.conf{.default,}
	fill PROJECT $THIS_PATH ${NAME}.conf
	fill DOMAIN $THIS_DOMAIN ${NAME}.conf
	fill NGINX_FASTCGI_CONFIG $THIS_NGINX_FASTCGI_CONFIG ${NAME}.conf
	fill PHP_FPM_SOCKET $THIS_PHP_FPM_SOCKET ${NAME}.conf
done
cd -

cd $THIS_PATH/config/nginx/servers
for NAME in app; do
	msg "Generating servers configuration from templates for ${NAME}..."

	cp $NAME.conf{.default,}
	fill PROJECT $THIS_PATH ${NAME}.conf
	fill DOMAIN $THIS_DOMAIN ${NAME}.conf
done
cd -

# cd $THIS_PATH/config
# for NAME in crons logrotate.conf; do
# 	msg "Generating configuration from templates for ${NAME}..."
#
# 	cp $NAME{.default,}
# 	fill PROJECT $THIS_PATH $NAME
# 	fill DOMAIN $THIS_DOMAIN $NAME
# 	fill USER $THIS_USER $NAME
# 	fill NGINX_REOPEN_LOGFILES "$THIS_NGINX_REOPEN_LOGFILES" $NAME
# done
# cd -

