const express = require('express');
const router = express.Router();
const biodataController = require('../controllers/biodataController');

router.get('/', (req, res) => {
    res.render('home', { layout : 'layouts/main-layout' });
})

router.get('/biodata', biodataController.index);

module.exports = router;
