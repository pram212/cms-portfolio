const { Kontak } = require('../models/Kontak')

async function index(req, res) {
    await Kontak.findOne()
    .then( data => {
        const message = req.flash('message')
        res.render('kontak/index-kontak', { data, message, layout: 'layouts/main-layout' })
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

    await Kontak.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        req.flash('message', 'Data berhasil diupdate!!')
        res.redirect('/kontak')
    })
    .catch(error => {
        req.flash('success', 'Data gagal diupdate!')
        res.redirect('/kontak')
    })
}

module.exports = {
    index, update
}
