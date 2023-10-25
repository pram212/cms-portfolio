const { Kontak } = require('../../models/Kontak')

async function index(req, res) {
    await Kontak.findOne()
    .then( data => {
        res.json(data)
    })
    .catch(error => {
        res.json(error)
    })
}

module.exports = {
    index
}
