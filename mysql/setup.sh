#!/bin/bash
set -e
service mysql start
mysql < /mysql/job_cv.sql
service mysql stop