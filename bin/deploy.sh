#! /usr/bin/env bash

set -e

get_latest_release() {
  curl --silent "https://api.github.com/repos/$1/releases/latest" | # Get latest release from GitHub api
    grep '"tag_name":' |                                            # Get tag line
    sed -E 's/.*"([^"]+)".*/\1/'                                    # Pluck JSON value
}

echo -e "Deploying Hakama...\n"

# Make templ dir
cd /tmp
TMP_DIR=`mktemp -d tmp.XXXXXXXXXX`
cd $TMP_DIR
pwd

case $1 in
	"staging")
		HOST="kunoichi-staging"
		git clone git@github.com:kuno1/hakama.git
		cd hakama
		bash ./bin/cleanup.sh
		echo -e "Master branch built";;
	"production")
		HOST="kunoichi-production"
		VERSION=`get_latest_release "kuno1/hakama"`
		echo -e "Deploying version $VERSION"
		wget "https://github.com/kuno1/hakama/releases/download/$VERSION/hakama.zip"
		unzip -d hakama hakama.zip
		rm hakama.zip
    cd hakama
		echo -e "Unziped latest release.";;
	*)
		exit "You must specify 'staging' or 'production'";;
esac

rsync -rvct --delete --checksum . nginx@$HOST:/var/web/wp/wp-content/themes/hakama
