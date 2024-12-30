# Some notes on packaging Self Service Password

## 0 - Version update

Update version in following files:

* htdocs/index.php
* packaging/rpm/SPECS/self-service-password.spec
* packaging/debian/changelog

## 1 - Update dependencies and run tests

From the self-service-password root directory, run:

```
composer update
```

Run tests:

```
XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-text --configuration tests/phpunit.xml
```

After the tests, remove the useless dependencies:

```
composer update --no-dev
```


## 2 - Archive tar.gz

From current directory, do:
```
./makedist.sh VERSION
```

with VERSION the current verion of the package

For example:
```
./makedist 1.7.0
```


## 3 - Debian

From current directory, do:

```
dpkg-buildpackage -b -kLTB
```

If you do not have LTB GPG secret key, do:

```
dpkg-buildpackage -b -us -uc
```

## 4 - RPM (RHEL, CentOS, Fedora,...)

Prepare your build environment, for example in /home/clement/build.

You should have a ~/.rpmmacros like this:

```
%_topdir /home/clement/build
%dist .el5
%distribution .el5
%_signature gpg
%_gpg_name 6D45BFC5
%_gpgbin /usr/bin/gpg
%packager Clement OUDOT <clem.oudot@gmail.com>
%vendor LTB-project
```

Copy packaging files from current directory to build directory:

```
cp -Ra rpm/* /home/clement/build
```

Copy Self Service Archive to SOURCES/:

```
cp ltb-project-self-service-password-VERSION.tar.gz /home/clement/build/SOURCES
```

Go in build directory and build package:

```
cd /home/clement/build
rpmbuild -ba SPECS/self-service-password.spec
```

Sign RPM:

```
rpm --addsign RPMS/noarch/self-service-password*
```

## 5 - Docker

Pre-requisites:

* docker / podman
* if docker: a version with buildkit (included by default in Docker Engine
  as of version 23.0, but can be enabled in previous versions with
  DOCKER_BUILDKIT=1 in build command line)

From "packaging" directory, do:

```
DOCKER_BUILDKIT=1 docker build -t self-service-password -f ./docker/Dockerfile ../
```

For Alpine linux image :

```
DOCKER_BUILDKIT=1 docker build -t self-service-password-alpine -f ./docker/Dockerfile.alpine ../
```


You can also build with podman:

```
podman build --no-cache -t self-service-password -f ./docker/Dockerfile ../
```

Tag the `latest` image with the major and minor version, for example:

```
docker tag self-service-password:latest ltbproject/self-service-password:1.4.4
docker tag self-service-password:latest ltbproject/self-service-password:1.4
docker tag self-service-password:latest ltbproject/self-service-password:latest
```

Tag the `alpine` image:
```
docker tag self-service-password-alpine:latest ltbproject/self-service-password:alpine-1.7.1
docker tag self-service-password-alpine:latest ltbproject/self-service-password:alpine-1.7
docker tag self-service-password-alpine:latest ltbproject/self-service-password:alpine-latest
```
