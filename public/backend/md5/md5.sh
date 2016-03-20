#!/usr/bin/env bash

APP_NAME=`pwd`
APP_PID=`ps -ef | grep "$APP_NAME" | grep -v grep | awk '{print $2}'`
APP_HOME=$APP_NAME
APP_LIB=$APP_HOME/lib

CLASSPATH=
for file in `ls $APP_LIB`;
do
    CLASSPATH=$APP_HOME/lib/$file:$CLASSPATH
done

CLASSPATH=$APP_HOME/bin:$CLASSPATH
export APP_HOME APP_LIB CLASSPATH
java -cp ":$APP_NAME:$CLASSPATH" tools.util.MD5 "$1" "$2"

