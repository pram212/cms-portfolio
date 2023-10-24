const { Portfolio } = require('../models/Portfolio')

async function index(req, res) {
    await Portfolio.find()
    .then( data => {
        const message = req.flash('message')
        res.render('portfolio/index-portfolio', { data, message, layout: 'layouts/main-layout' })
    })
    .catch(error => {
        console.error(error)
    })
}

async function create(req, res) {
    const message = req.flash('message')
    res.render('portfolio/create-portfolio', { message,  layout: 'layouts/main-layout'})
}

async function store(req, res) {
    const newData = req.body
    await Portfolio.create(req.body)
    .then(result => {
        req.flash('message', 'Data berhasil ditambahkan!!')
        res.redirect('/portfolio/create')
    })
    .catch(error => {
        req.flash('message', 'Data gagal ditambahkan!!')
        res.redirect('/portfolio/create')
    })
}

async function edit(req, res) {
    const message = req.flash('message')
    const idPengalaman = req.params.id
    await Portfolio.findById(idPengalaman)
    .then(data => {
        res.render('portfolio/edit-portfolio', { data, message, layout: 'layouts/main-layout'})
    })
}

async function update(req, res) {
    const idToUpdate = req.params.id
    const newData = req.body
    
    await Portfolio.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        
        req.flash('message', 'Data berhasil diubah!!')
        res.redirect('/portfolio/' + idToUpdate + '/edit')
    })
    .catch(error => {
        req.flash('success', 'Data gagal diubah!')
        res.redirect('/portfolio/' + idToUpdate + '/edit')
    })
}

async function destroy(req, res) {
    const idPortfolio = req.params.id
    await Portfolio.findByIdAndDelete(idPortfolio)
    .then( result => res.json('Data berhasil di hapus') )
    .catch( error => res.json(error) )
}

module.exports = {
    index, update, create, edit, store, destroy
}
