const mongoose = require('mongoose')
const useMongoDb = require('../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    alamat: { type: String, required: true },
    telepon: { type: String, required: true },
    email: { type: String, required: true },
    linkedin: { type: String, required: false },
    gitlab: { type: String, required: false },
    github: { type: String, required: false },
})

const Kontak = mongoose.model('kontak', Schema, 'kontak')

module.exports = {
    Kontak
}
