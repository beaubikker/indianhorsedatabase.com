#!/bin/bash

cp build/config/* app/config/
cp -R build/tmp app/
chmod -R 777 app/tmp
