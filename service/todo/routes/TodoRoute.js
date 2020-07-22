'use strict'
const express = require('express')
const todo = require('../controllers/TodoController')
const { validateToken } = require('../helpers/validation')
const router = express.Router()

router.get('/api/v1/todo', validateToken, todo.index)
router.post('/api/v1/todo', validateToken, todo.store)
router.get('/api/v1/todo/:id', validateToken, todo.show)
router.put('/api/v1/todo/:id', validateToken, todo.update)
router.delete('/api/v1/todo/:id', validateToken, todo.destroy)
module.exports = router
