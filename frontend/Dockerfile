FROM nginx:1.22-alpine AS app

RUN apk update
RUN apk upgrade curl
RUN apk upgrade libcurl
RUN apk upgrade zlib

WORKDIR /srv

COPY ./dist /srv/public

#COPY ops/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ops/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R 755 /srv/public

EXPOSE $PORT

COPY ops/entrypoint /usr/local/bin
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]