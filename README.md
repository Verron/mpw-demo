# frontend

Vue SPA application with Typescript, Pinia, Vite, and TailwindCSS

# backend

Symfony API application with PHP 8, Doctrine, and MongoDB

#  Container

## Front

Frontend uses nginx to serve the application. It pre-builds assets then serves static files  from `/srv/public`
Since it is an SPA, all routes are redirected to `index.html` to let Vue handle the routing.

## Backend

Backend uses PHP 8.3 FPM and nginx to serve the application. It uses a custom entrypoint for the purpose of handling both
FPM and nginx within the same container.

## Building

Frontend assets will need to be ran first using `npm ci && npm run build`. The .nvmrc file has the node version needed.

There is a makefile. To build the front end use `make build-fe. To build the backend use `make build-api`. Both can be
built at the same time using `make build`

## Running

The containers have to run separately.

Frontend: `make run-fe`
Backend: `make run-api`

The frontend container is exposed on port 8200 and the backend container is exposed
on 8100. 

.env.production is used for building the frontend.


# Development

## Data Store

MongoDB is used as the data store. It is exposed on port 27017. You can start it via `docker-compose up -d mongo`

To connect via mongo shell, use

```shell
mongosh mongodb://mpw_user:example@127.0.0.1:27017/mpw
```

## Frontend

cd to frontend folder. Since vite is used, you can run `npm run dev` to start the development server.

### Testing

To run tests, use `npm run test:unit`

## Backend

cd to backend folder. Since symfony cli is used, you can run `symfony server:start` to start the development server.