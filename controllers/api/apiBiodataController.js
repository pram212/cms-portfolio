const { Biodata } = require('../../models/Biodata')

async function index(req, res) {
    await Biodata.findOne()
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
