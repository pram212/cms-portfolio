const express = require('express')
const router = express.Router()
const biodataController = require('../controllers/biodataController')
const multer = require('multer')

// Konfigurasi upload file menggunakan multer
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, 'public/img/') // Tentukan direktori penyimpanan file
  },
  filename: function (req, file, cb) {
    cb(null, Date.now() + '-' + file.originalname) // Tentukan nama file
  }
})

const upload = multer({ storage: storage })

router.get('/', (req, res) => {
    res.render('home', { layout : 'layouts/main-layout' })
})

router.get('/biodata', biodataController.index)
router.post('/biodata/:id', upload.single('foto'), biodataController.update)

module.exports = router
