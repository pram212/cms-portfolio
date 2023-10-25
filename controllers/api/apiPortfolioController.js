const { Portfolio } = require('../../models/Portfolio')

async function index(req, res) {
    await Portfolio.find()
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
