const express = require('express')
const router = express.Router()
const apiBiodataController = require('../controllers/api/apiBiodataController')
const apiKontakController = require('../controllers/api/apiKontakController')
const apiSkillController = require('../controllers/api/apiSkillController')
const apiPengalamanController = require('../controllers/api/apiPengalamanController')
const apiPortfolioController = require('../controllers/api/apiPortfolioController')

router.get('/biodata', apiBiodataController.index)
router.get('/kontak', apiKontakController.index)
router.get('/skill', apiSkillController.index)
router.get('/pengalaman', apiPengalamanController.index)
router.get('/portfolio', apiPortfolioController.index)

router.use( (req, res) => res.json('URL tidak ditemukan', 404) )

module.exports = router
