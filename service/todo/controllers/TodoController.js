'use strict'
const Todos = require('../models/TodoModel')

const index = async (req, res) => {
  try {
    const result = await Todos.find()
    const count = await Todos.estimatedDocumentCount()
    res.json({
      data: result,
      count: count
    }).status(200)
  } catch (error) {
    res.json({
      data: [],
      msg: error
    }).status(422)
  }
}

const store = async (req, res) => {
  try {
    const todo = new Todos(req.body)
    const result = await todo.save()
    res.json({
      data: result
    }).status(200)
  } catch (error) {
    res.json({
      data: [],
      msg: error
    }).status(422)
  }
}

const show = async (req, res) => {
  try {
    const result = await Todos.findById(req.params.id)
    res.json({
      data: result
    }).status(200)
  } catch (error) {
    res.json({
      data: [],
      msg: error
    }).status(422)
  }
}

const update = async (req, res) => {
  try {
    const result = await Todos.findByIdAndUpdate(req.params.id,
      { $set: req.body }, { new: true })
    res.json({
      data: result
    }).status(200)
  } catch (error) {
    res.json({
      data: [],
      msg: error
    }).status(422)
  }
}

const destroy = async (req, res) => {
  try {
    const result = await Todos.findByIdAndRemove(req.params.id)
    res.json({
      data: result
    }).status(200)
  } catch (error) {
    res.json({
      data: [],
      msg: error
    }).status(422)
  }
}

module.exports = {
  index, store, show, update, destroy
}
