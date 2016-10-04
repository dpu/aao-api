#!/bin/sh

export LANG=zh_CN.UTF-8

git fetch --all
git reset --hard origin/master

cd /data/wwwroot/
chown -R nginx:nginx dlpu-aao-api.xu42.cn
