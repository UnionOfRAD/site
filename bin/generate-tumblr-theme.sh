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

role THIS

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

fill __STYLES_RESET__ "$(cat /tmp/reset.css)" /tmp/tumblr.html
fill __STYLES_U1M__ "$(cat /tmp/u1m.css)" /tmp/tumblr.html
fill __STYLES_HIGHLIGHT__ "$(cat /tmp/highlight.css)" /tmp/tumblr.html

cat /tmp/tumblr.html

