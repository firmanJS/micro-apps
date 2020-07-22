const express = require('express')
const app = express()
const routing = require('./config/route')
const dbConfig = require('./config/db')

dbConfig.connectWithRetry() // connect to mongodb
app.use(express.json())
app.use(routing) // routing

app.listen(8081, () => {
  console.log('todo service runnig in port 8081')
})
