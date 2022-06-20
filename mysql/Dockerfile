FROM  mysql:5.6
# Setup the custom configuration
ADD mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf
COPY setup.sh /mysql/setup.sh
COPY job_cv.sql /mysql/job_cv.sql
RUN /mysql/setup.sh