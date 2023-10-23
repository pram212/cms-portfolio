const { Skill } = require('../models/Skill')

async function index(req, res) {
    await Skill.find()
    .then( data => {
        const message = req.flash('message')
        res.render('skill/index-skill', { data, message, layout: 'layouts/main-layout' })
    })
    .catch(error => {
        console.error(error)
    })
}

async function create(req, res) {
    const message = req.flash('message')
    res.render('skill/create-skill', { message,  layout: 'layouts/main-layout'})
}

async function store(req, res) {
    const newData = req.body
    await Skill.create(req.body)
    .then(result => {
        req.flash('message', 'Data berhasil ditambahkan!!')
        res.redirect('/skill/create')
    })
    .catch(error => {
        req.flash('message', 'Data gagal ditambahkan!!')
        res.redirect('/skill/create')
    })
}

async function edit(req, res) {
    const message = req.flash('message')
    const idSkill = req.params.id
    await Skill.findById(idSkill)
    .then(data => {
        res.render('skill/edit-skill', { data, message, layout: 'layouts/main-layout'})
    })
}

async function update(req, res) {
    const idToUpdate = req.params.id
    const newData = req.body
    await Skill.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        req.flash('message', 'Data berhasil diubah!!')
        res.redirect('/skill/' + idToUpdate + '/edit')
    })
    .catch(error => {
        req.flash('success', 'Data gagal diubah!')
        res.redirect('/skill/' + idToUpdate + '/edit')
    })
}

async function destroy(req, res) {
    const idSkill = req.params.id
    await Skill.findByIdAndDelete(idSkill)
    .then( result => res.json('Data berhasil di hapus') )
    .catch( error => res.json(error) )
}

module.exports = {
    index, update, create, edit, store, destroy
}
