FROM jenkins/jenkins:latest AS base

USER root

RUN curl -o docker-ce-cli.deb https://download.docker.com/linux/debian/dists/stretch/pool/stable/amd64/docker-ce-cli_19.03.8~3-0~debian-stretch_amd64.deb && \
    dpkg -i docker-ce-cli.deb && \
    rm docker-ce-cli.deb;

RUN touch /var/run/docker.sock && \
    chown jenkins:jenkins /var/run/docker.sock


FROM base AS app

USER jenkins

