function resetForm() {
        var form = document.getElementById('updateForm');
        form.reset();
    }

    let changePasswordVisibilityBtn = document.querySelectorAll('.changePasswordVisibility');

    changePasswordVisibilityBtn.forEach(function(btn) {
        btn.addEventListener('click', function() {
            let passwordInput = this.parentElement.querySelector('.passwordInput');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });


    function showAccountInfo(){
        let profileSettingsBtn = document.getElementById('profileSettingsBtn');
        let rentedCarBtn = document.getElementById('rentedCarBtn');
        console.log("Profile Settings button clicked");
        anime({
            targets: [".rentedCar"],
            opacity: 0,
        });
        anime({
            targets: [".accountInfo"],
            opacity: 1,
        });
        document.querySelector('.accountInfo').style.display = 'block';
        document.querySelector('.rentedCar').style.display = 'none';
        profileSettingsBtn.classList.add('active')
        rentedCarBtn.classList.remove('active');
    }

    function showRentedCar(){
        let profileSettingsBtn = document.getElementById('profileSettingsBtn');
        let rentedCarBtn = document.getElementById('rentedCarBtn');
        console.log("Rented Car button clicked");
        anime({
            targets: [".accountInfo"],
            opacity: 0,
        });
        anime({
            targets: [".rentedCar"],
            opacity: 1,
        });
        document.querySelector('.rentedCar').style.display = 'block';
        document.querySelector('.accountInfo').style.display = 'none'
        rentedCarBtn.classList.add('active')
        profileSettingsBtn.classList.remove('active');
    }
    