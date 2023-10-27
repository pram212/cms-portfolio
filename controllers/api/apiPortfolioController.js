const { Portfolio } = require('../../models/Portfolio')

async function index(req, res) {
    await Portfolio.find()
    .then( data => res.json(data) )
    .catch( error => res.json(error) )
}

async function show(req, res) {
    await Portfolio.findById(req.params.id)
    .then( data => res.json(data) )
    .catch( error => res.json(error) )
}

module.exports = {
    index, show
}
