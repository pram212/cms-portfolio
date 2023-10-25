const { Pengalaman } = require('../../models/Pengalaman')

async function index(req, res) {
    await Pengalaman.find()
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
