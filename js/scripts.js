// delete confirmation
function confirmDelete() {
    return confirm('Are you sure you want to delete this?')
}

// toggle password input on register form
function showHidePassword() {
    let password = document.getElementById('password')
    let icon = document.getElementById('showHide')

    // if input type is password, change to text and toggle icon
    if (password.type == 'password') {
        password.type = 'text'
        icon.src = 'img/hide.png'
    }
    else {
        password.type = 'password'
        icon.src = 'img/show.png'
    }
}