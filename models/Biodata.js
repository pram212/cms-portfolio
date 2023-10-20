const mongoose = require('mongoose')
const useMongoDb = require('./../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    nama: { type: String, required: true },
    tgl_lahir: { type: String, required: true },
    tmp_lahir: { type: String, required: true },
    profil: { type: String, required: true },
    tentang: { type: String, required: true },
    lulusan: { type: String, required: true },
    foto: { type: String, required: true },
    // tambahkan properti lain sesuai kebutuhan
})

const Biodata = mongoose.model('biodata', Schema, 'biodata')

module.exports = {
    Biodata
}
