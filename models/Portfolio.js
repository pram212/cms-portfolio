const mongoose = require('mongoose')
const useMongoDb = require('../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    nama: { type: String, required: true },
    klien: { type: String, required: true },
    role: { type: String, required: true },
    deskripsi: { type: String, required: true },
    demo_url: { type: String, required: true },
    demo_info: { type: String, required: true },
    modul: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }],
    teknologi: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }],
})

const Portfolio = mongoose.model('portfolio', Schema, 'portfolio')

module.exports = {
    Portfolio
}
