FROM nginx:stable-alpine
COPY nginx.conf /etc/nginx/conf.d/default.conf
RUN groupmod -g 1000 nginx && usermod -u 1000 -g 1000 nginx
