FROM node:12-alpine

WORKDIR /apps

COPY package.json ./

RUN npm install

COPY . .

CMD ["npm", "start"]