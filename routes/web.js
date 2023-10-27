const express = require('express')
const router = express.Router()
const biodataController = require('../controllers/biodataController')
const skillController = require('../controllers/skillController')
const kontakController = require('../controllers/kontakController')
const pengalamanController = require('../controllers/pengalamanController')
const portfolioController = require('../controllers/portfolioController')

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

router.get('/', (req, res) => res.render('home', { layout : 'layouts/main-layout' }) )
// biodata routes
router.get('/biodata', biodataController.index)
router.post('/biodata/:id', upload.single('foto'), biodataController.update)

// kontak routes
router.get('/kontak', kontakController.index)
router.post('/kontak/:id', kontakController.update)

// skill routes
router.get('/skill', skillController.index)
router.get('/skill/create', skillController.create)
router.post('/skill', skillController.store)
router.get('/skill/:id/edit', skillController.edit)
router.post('/skill/:id/update', skillController.update)
router.delete('/skill/:id', skillController.destroy)

// pengalaman routes
router.get('/pengalaman', pengalamanController.index)
router.get('/pengalaman/create', pengalamanController.create)
router.post('/pengalaman', pengalamanController.store)
router.get('/pengalaman/:id/edit', pengalamanController.edit)
router.post('/pengalaman/:id/update', pengalamanController.update)
router.delete('/pengalaman/:id', pengalamanController.destroy)

// portfolio routes
router.get('/portfolio', portfolioController.index)
router.get('/portfolio/create', portfolioController.create)
router.post('/portfolio', upload.array('gambar'), portfolioController.store)
router.get('/portfolio/:id/edit', portfolioController.edit)
router.post('/portfolio/:id/update', upload.array('gambar'), portfolioController.update)
router.delete('/portfolio/:id', portfolioController.destroy)

router.use( (req, res) => res.render("errors/404", { layout: 'errors/error-layout'}) )

module.exports = router
