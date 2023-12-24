

.PHONY: build-api
build-api:
	docker build -t mpw-api -f backend/Dockerfile ./backend

.PHONY: run-api
run-api:
	docker run -p 8100:80 -e MONGODB_URL=mongodb://mpw_user:example@host.docker.internal:27017/mpw -it mpw-api:latest