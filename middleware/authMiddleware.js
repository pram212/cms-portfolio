const checkSession = (req, res, next) => {
    if (req.session.user) {
        // Pengguna sudah login, lanjutkan ke rute berikutnya
        next();
    } else {
        res.redirect('/auth/login')
    }
};

module.exports = checkSession;
