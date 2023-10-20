const { Biodata } = require('../models/Biodata');

async function index(req, res) {
    await Biodata.findOne().then( data => {
        res.render('biodata/index-biodata', { data, layout: 'layouts/main-layout' })
    })
    .catch(error => {
        console.error(error);
    });
}

module.exports = {
    index
}
