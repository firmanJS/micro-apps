'use strict'
const express = require('express')
const todo = require('../controllers/TodoController')
/* eslint-disable new-cap */
const router = express.Router()

router.get('/api/v1/todo', todo.index)
router.post('/api/v1/todo', todo.store)
router.get('/api/v1/todo/:id', todo.show)
router.put('/api/v1/todo/:id', todo.update)
router.delete('/api/v1/todo/:id', todo.destroy)
module.exports = router
