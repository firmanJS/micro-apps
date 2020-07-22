const jwt = require('jsonwebtoken')

const validateToken = (req, res, next) => {
  const authorizationHeaader = req.headers.authorization
  let result
  if (authorizationHeaader) {
    const token = req.headers.authorization.split(' ')[1]
    try {
      result = jwt.verify(token, process.env.JWT_SECRET)
      next()
    } catch (err) {
      res.status(500).send({
        auth: false,
        message: err
      })
    }
  } else {
    result = {
      error: 'Authentication error. Token required.',
      status: 401
    }
    res.status(401).send(result)
  }
}

module.exports = {
  validateToken
}
