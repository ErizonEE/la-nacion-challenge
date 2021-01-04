FROM debian

RUN apt-get update && apt-get -y install php7.3 composer php7.3-xml php7.3-mysql

RUN apt-get -y install sqlite php7.3-sqlite3

RUN php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /api

CMD tail -f /dev/null