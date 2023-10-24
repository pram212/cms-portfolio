const guest = require('./../middleware/guestMiddleware')

const express = require('express')
const router = express.Router()
const authController = require('./../controllers/authController')

router.get('/login', guest, authController.index)
router.post('/login', guest, authController.login)
router.post('/logout', authController.logout)

module.exports = router
