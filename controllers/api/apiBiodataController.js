const { Biodata } = require('../../models/Biodata')

async function index(req, res) {
    await Biodata.findOne()
    .then( data => {
        res.send(data)
    })
    .catch(error => {
        res.send(error)
    })
}

module.exports = {
    index
}
