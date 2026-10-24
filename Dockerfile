FROM eclipse-temurin:21-jdk AS javadoc_builder

WORKDIR /build/java
COPY java/ /build/java
RUN chmod +x ./gradlew \
    && ./gradlew --no-daemon javadoc \
    && mkdir -p /build/java/build/docs/javadoc/resources/fonts \
    && printf "/* Fallback font stylesheet for generated Javadoc */\nbody { font-family: Arial, Helvetica, sans-serif; }\n" > /build/java/build/docs/javadoc/resources/fonts/dejavu.css \
    && printf '<!doctype html><html><head><meta http-equiv="refresh" content="0; url=allclasses-index.html"><title>Redirect</title></head><body><a href="allclasses-index.html">allclasses-index.html</a></body></html>\n' > /build/java/build/docs/javadoc/allclasses-frame.html

FROM php:8.5-apache AS runtime_base
LABEL maintainer="You <admin@bgkalendar.com>"

ENV APACHE_SERVER_NAME=localhost

RUN a2enmod rewrite \
    && echo "ServerName ${APACHE_SERVER_NAME}" > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername \
    && printf '<Directory /var/www/>\n    AllowOverride All\n</Directory>\n' > /etc/apache2/conf-available/bgcalendar-override.conf \
    && a2enconf bgcalendar-override

RUN docker-php-ext-install bcmath

COPY --chown=www-data:www-data phpsite/ /app/public
COPY --chown=www-data:www-data java/ /app/public/java
WORKDIR /app/public/java

RUN chmod +x /app/public/java/gradlew \
    && echo "Wallet Address May Be Specified In /app/public/bitcoinwallet.php" > /app/public/bitcoinwallet.php \
    && rm -rf /var/www/html \
    && ln -s /app/public /var/www/html

FROM runtime_base AS runtime_no_javadoc

FROM runtime_base AS runtime_with_javadoc
COPY --from=javadoc_builder /build/java/build/docs/javadoc /app/public/javadoc
