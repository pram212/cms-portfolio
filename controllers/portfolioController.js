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
    const errors = req.flash('errors')
    res.render('portfolio/create-portfolio', { message, errors, layout: 'layouts/main-layout'})
}

async function store(req, res) {
    const newData = req.body

    if(req.files) {
        newImage = []
        req.files.forEach(item => {
            const path = item.destination.replace('public', '') + item.filename
            newImage.push(path)
        });
        newData.image_url = newImage
    }

    await Portfolio.create(newData)
    .then(result => {
        req.flash('message', 'Data berhasil ditambahkan!!')
        res.redirect('back')
    })
    .catch(error => {
        console.log(error)
        if (error.name === 'ValidationError') {
            const validationErrors = {}
            for (const key in error.errors) {
                validationErrors[key] = error.errors[key].message;
            }
            req.flash('errors', validationErrors);
        } else {
            req.flash('message', 'Terjadi kesalahan saat menambahkan data!!');
        }  
        res.redirect('back')
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
    let image_urls = null
    if(req.files.length > 0) {
        newImage = []
        req.files.forEach(item => {
            const path = item.destination.replace('public', '') + item.filename
            newImage.push(path)
        });
        newData.image_url = newImage
    } else {
        const oldData = await Portfolio.findById(idToUpdate)
        newData.image_url = oldData.image_url
    }

    await Portfolio.findByIdAndUpdate(idToUpdate, newData)
    .then( result => {
        req.flash('message', 'Data berhasil diubah!!')
        res.redirect('back')
    })
    .catch(error => {
        req.flash('success', 'Data gagal diubah!')
        res.redirect('back')
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
