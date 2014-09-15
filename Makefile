#
# Lithium Site
#
# Copyright (c) 2014 Union of RAD - All rights reserved.
#
# The code is distributed under the terms of the BSD 3-clause 
# License. For the full license text see the LICENSE file.
#

# PREFIX ?= /usr/local
PROJECT_NAME ?= $(shell basename $(CURDIR))

# OS detection
UNAME := $(shell uname)
ifeq ($(UNAME_S),Darwin)
	OS = darwin
else
	OS = linux
endif

install: 
	chmod -R a+rwX $(CURDIR)/log
	chmod -R a+rwX $(CURDIR)/app/resources/tmp
	cp $(CURDIR)/config/deta/dev.conf.default $(CURDIR)/config/deta/dev.conf
	sed -i -e "s|__PROJECT_NAME__|$(PROJECT_NAME)|g" $(CURDIR)/config/deta/dev.conf
	sed -i -e "s|__PROJECT_PATH__|$(CURDIR)|g" $(CURDIR)/config/deta/dev.conf
	sed -i -e "s|__PROJECT_NAME__|$(PROJECT_NAME)|g" $(CURDIR)/app/config/bootstrap.php

	git submodule update --init --recursive
	cd $(CURDIR)/app && composer install

install-deploy:
	ifeq ($(OS),darwin) 
		brew install yuicompressor
		brew install pngcrush
		brew install jpegtran
	endif

.PHONY: install install-deploy
