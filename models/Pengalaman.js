const mongoose = require('mongoose')
const useMongoDb = require('../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    perusahaan: { type: String, required: true },
    mulai: { type: String, required: true },
    selesai: { type: String, required: true },
    lokasi: { type: String, required: true },
    jobdesk: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }]
})

const Pengalaman = mongoose.model('pengalaman', Schema, 'pengalaman')

module.exports = {
    Pengalaman
}
