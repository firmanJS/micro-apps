'use strict'
const mongoose = require('mongoose')
const Schema = mongoose.Schema

const TodoSchema = new Schema({
  name: { type: String, index: true, required: true },
  description: { type: String, index: true }
}, { timestamps: true, usePushEach: true })

module.exports = mongoose.model('Todo', TodoSchema)
