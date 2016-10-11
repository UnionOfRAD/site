#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause
# License. For the full license text see the LICENSE file.
#

source $DETA/util.sh
source $DETA/asset.sh

THIS_PATH=$(dirname $(pwd)) # we execute in bin/

cp $THIS_PATH/blog/tumblr.html /tmp/
cp $THIS_PATH/assets/css/reset.css /tmp/
cp $THIS_PATH/assets/css/u1m.css /tmp/
cp $THIS_PATH/assets/css/highlight.css /tmp/

# Assets pipeline
COMPRESSOR_JS="yuicompressor"
COMPRESSOR_CSS="yuicompressor"

myth /tmp/reset.css /tmp/reset.css
myth /tmp/u1m.css /tmp/u1m.css
myth /tmp/highlight.css /tmp/highlight.css

compress_css /tmp/reset.css /tmp/reset.css
compress_css /tmp/u1m.css /tmp/u1m.css
compress_css /tmp/highlight.css /tmp/highlight.css

fill "../img/bg2.png" "http://static.tumblr.com/5za9i77/x4Inc7ltk/bg2.png" /tmp/u1m.css
fill "../img/bg2dark.png" "http://static.tumblr.com/5za9i77/Qtnnc7lwb/bg2dark.png" /tmp/u1m.css

fill __YEAR__ $(date +%Y) /tmp/tumblr.html

# This is pretty hacky, but I currently see
# no better solution to work arround sed's limitations (escaping).
php -r "echo str_replace('__STYLES_RESET__', file_get_contents('/tmp/reset.css'), file_get_contents('/tmp/tumblr.html'));" > /tmp/tumblr_temp.html
mv -v /tmp/tumblr_temp.html /tmp/tumblr.html
php -r "echo str_replace('__STYLES_U1M__', file_get_contents('/tmp/u1m.css'), file_get_contents('/tmp/tumblr.html'));" > /tmp/tumblr_temp.html
mv -v /tmp/tumblr_temp.html /tmp/tumblr.html
php -r "echo str_replace('__STYLES_HIGHLIGHT__', file_get_contents('/tmp/highlight.css'), file_get_contents('/tmp/tumblr.html'));" > /tmp/tumblr_temp.html
mv -v /tmp/tumblr_temp.html /tmp/tumblr.html

cat /tmp/tumblr.html

