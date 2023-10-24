const checkSession = (req, res, next) => {
    // Periksa apakah pengguna telah login (gunakan informasi sesi atau token)
    if (req.session.user) {
        console.log('sudah login')
        // Jika pengguna telah login, alihkan mereka ke halaman dashboard
        return res.redirect('/');
    } else {
        // Jika pengguna belum login, lanjutkan ke rute berikutnya
        next();
    }
};

module.exports = checkSession;
