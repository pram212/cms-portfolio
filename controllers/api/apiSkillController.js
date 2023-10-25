const { Skill } = require('../../models/Skill')

async function index(req, res) {
    await Skill.find()
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
