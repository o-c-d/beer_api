FROM mysql:latest

COPY .infra/docker/mysql /docker-entrypoint-initdb.d/
RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/
RUN chown -R mysql:mysql /var/lib/mysql /var/run/mysqld

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci", "--mysql-native-password=ON"]
