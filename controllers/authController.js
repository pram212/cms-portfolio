
async function index(req, res) {
    const message = req.flash('message')
    res.render('auth/login', { message, layout : 'auth/auth-layout'})
}

async function login(req, res) {
    const { pin } = req.body
    // Lakukan validasi pin, misalnya dengan membandingkan dengan data pengguna di basis data
    if (pin =='45454545') {
        // Simpan informasi pengguna dalam sesi
        req.session.user = { id: 1, username: 'user1' }
        res.redirect('/')
    } else {
        req.flash('message', 'Anda gagal Login!')
        res.redirect('/auth/login')
    }
}

function logout(req, res) {
    try {
        req.session.destroy()
        res.redirect('/auth/login')
    } catch (error) {
        res.status(500).json({ message: 'Error saat logout' })
    }
}

module.exports = { login, index, logout }