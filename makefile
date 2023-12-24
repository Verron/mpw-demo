

.PHONY: build-fe
build-fe:
	docker build -t mpw-fe -f frontend/Dockerfile ./frontend

.PHONY: run-fe
run-fe:
	docker run -p 8200:80 -it mpw-fe:latest

.PHONY: run-mongodb
run-mongodb:
	docker-compose up -d mongo

.PHONY: build-api
build-api:
	docker build -t mpw-api -f backend/Dockerfile ./backend

.PHONY: run-api
run-api: run-mongodb
	docker run -p 8100:80 -e MONGODB_URL=mongodb://mpw_user:example@host.docker.internal:27017/mpw -it mpw-api:latest

make build: build-fe build-api
