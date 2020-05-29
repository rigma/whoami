FROM node:latest AS build
WORKDIR /usr/src
COPY public ./public
COPY src ./src
COPY index.html package-lock.json package.json ./
RUN npm install && npm run build

FROM nginx:latest
COPY --from=build /usr/src/dist /usr/share/nginx/html
