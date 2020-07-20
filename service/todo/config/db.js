'use strict'
require('dotenv').config()
const mongoose = require('mongoose')
mongoose.Promise = global.Promise
// const users = process.env.MONGO_INITDB_ROOT_USERNAME
// const pass = process.env.MONGO_INITDB_ROOT_PASSWORD
// const dbUrl = 'mongodb://' + users + ':' + pass + '@mongose_services:27017/db_micro_app'
console.log(process.env.MONGO_URI)
const connectWithRetry = () => {
  return mongoose.connect(`${process.env.MONGO_URI}`, {
    useNewUrlParser: true,
    useCreateIndex: true,
    useFindAndModify: false,
    useUnifiedTopology: true
  }, function (err) {
    if (err) {
      console.error(`Failed to connect to mongo on startup - retrying in 5 sec
      ${err}`)
      setTimeout(connectWithRetry(), 5000)
    } else {
      console.log('mongoDB Connected ✅')
    }
  })
}

module.exports = {
  connectWithRetry
}
