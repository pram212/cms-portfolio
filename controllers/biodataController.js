const flash = require('express-flash')
const { Biodata } = require('../models/Biodata')

async function index(req, res) {
    await Biodata.findOne()
    .then( data => {
        const message = req.flash('message')
        res.render('biodata/index-biodata', { data, message, layout: 'layouts/main-layout' })
    })
    .catch(error => {
        console.error(error)
    })
}

async function update(req, res) {
    const idToUpdate = req.params.id
    const newData = req.body

    if(req.file) {
        newData.foto = req.file.destination.replace('public', '') + req.file.filename
    }

    await Biodata.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        req.flash('message', 'Data berhasil diupdate!!')
        res.redirect('/biodata')
    })
    .catch(error => {
        console.log(error)
        req.flash('success', 'Data gagal diupdate!')
        res.redirect('/biodata')
    })
}

module.exports = {
    index, update
}
