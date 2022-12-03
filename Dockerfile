FROM ulsmith/alpine-apache-php7
MAINTAINER You admin@bgkalendar.com

# Just Utility for easier troubleshooting.
RUN apk add vim openjdk9
ENV APACHE_SERVER_NAME=bgkalendar.com
ENV JAVA_HOME=/usr/lib/jvm/java-9-openjdk
ADD /phpsite /app/public
ADD /java /app/public/java
WORKDIR /app/public/java
#RUN chmod a+x /app/public/java/gradlew && /app/public/java/gradlew javadoc && cp -r /app/public/java/build/docs/javadoc /app/public/javadoc
RUN echo "Wallet Address May Be Specified In /app/public/bitcoinwallet.php" > /app/public/bitcoinwallet.php

RUN chown -R apache:apache /app
