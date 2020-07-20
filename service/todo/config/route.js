'use strict'
const express = require('express')
const routing = express()
const todo = require('../routes/TodoRoute.js')

routing.use(todo)

module.exports = routing
