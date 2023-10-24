const { Pengalaman } = require('../models/Pengalaman')

async function index(req, res) {
    await Pengalaman.find()
    .then( data => {
        const message = req.flash('message')
        res.render('pengalaman/index-pengalaman', { data, message, layout: 'layouts/main-layout' })
    })
    .catch(error => {
        console.error(error)
    })
}

async function create(req, res) {
    const message = req.flash('message')
    res.render('pengalaman/create-pengalaman', { message,  layout: 'layouts/main-layout'})
}

async function store(req, res) {
    const newData = req.body
    await Pengalaman.create(req.body)
    .then(result => {
        req.flash('message', 'Data berhasil ditambahkan!!')
        res.redirect('/pengalaman/create')
    })
    .catch(error => {
        req.flash('message', 'Data gagal ditambahkan!!')
        res.redirect('/pengalaman/create')
    })
}

async function edit(req, res) {
    const message = req.flash('message')
    const idPengalaman = req.params.id
    await Pengalaman.findById(idPengalaman)
    .then(data => {
        res.render('pengalaman/edit-pengalaman', { data, message, layout: 'layouts/main-layout'})
    })
}

async function update(req, res) {
    const idToUpdate = req.params.id
    const newData = req.body
    
    await Pengalaman.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        
        req.flash('message', 'Data berhasil diubah!!')
        res.redirect('/pengalaman/' + idToUpdate + '/edit')
    })
    .catch(error => {
        req.flash('success', 'Data gagal diubah!')
        res.redirect('/pengalaman/' + idToUpdate + '/edit')
    })
}

async function destroy(req, res) {
    const idPengalaman = req.params.id
    await Pengalaman.findByIdAndDelete(idPengalaman)
    .then( result => res.json('Data berhasil di hapus') )
    .catch( error => res.json(error) )
}

module.exports = {
    index, update, create, edit, store, destroy
}
