function signup() {
    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");


    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";

                window.location = "login.php";

            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
            }

        }
    }

    r.open("POST", "../app/signupprocess.php", true);
    r.send(f);
}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    console.log(email.value);

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Signed in successfully"
                }).then(() => {
                    window.location = "../index.php";
                });
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "../app/signinprocess.php", true);
    r.send(f);
}



function signout() {
    Swal.fire({
        title: 'Are you sure you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, log out',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    var t = r.responseText;

                    if (t == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Logged out successfully"
                        }).then(() => {
                            window.location = "./components/login.php";
                        });
                    } else {
                        alert(t);
                    }
                }
            };

            r.open("GET", "./app/signoutProcess.php", true);
            r.send();
        }
    });
}

function signout321() {
    Swal.fire({
        title: 'Are you sure you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, log out',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    var t = r.responseText;

                    if (t == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Logged out successfully"
                        }).then(() => {
                            window.location = "./login.php";
                        });
                    } else {
                        alert(t);
                    }
                }
            };

            r.open("GET", "../app/signoutProcess.php", true);
            r.send();
        }
    });
}

function forgotPassword() {
    Swal.fire({
        title: 'Enter your email',
        input: 'email',
        inputLabel: 'We will send you a verification code',
        inputValue: document.getElementById('email2').value,
        inputAttributes: {
            readonly: true
        },
        showCancelButton: true,
        confirmButtonText: 'Send Verification Code'
    }).then((result) => {
        if (result.isConfirmed) {
            var email = result.value;

            // Step 2: Send the verification code to the user's email
            sendVerificationCode(email).then(() => {
                // Step 3: Ask for the verification code
                Swal.fire({
                    title: 'Enter the verification code',
                    input: 'text',
                    inputLabel: 'We have sent a verification code to your email',
                    inputPlaceholder: 'Enter the verification code',
                    showCancelButton: true,
                    confirmButtonText: 'Verify'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var verificationCode = result.value;

                        // Step 4: Verify the code
                        verifyCode(email, verificationCode).then((isValid) => {
                            if (isValid) {
                                // Step 5: Ask for the new password
                                Swal.fire({
                                    title: 'Enter new password',
                                    html: `<input type="password" id="newPassword" class="swal2-input" placeholder="New password">
                                           <input type="password" id="confirmPassword" class="swal2-input" placeholder="Confirm new password">`,
                                    showCancelButton: true,
                                    confirmButtonText: 'Reset Password',
                                    preConfirm: () => {
                                        const newPassword = document.getElementById('newPassword').value;
                                        const confirmPassword = document.getElementById('confirmPassword').value;

                                        if (newPassword !== confirmPassword) {
                                            Swal.showValidationMessage('Passwords do not match');
                                        } else {
                                            return newPassword;
                                        }
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var newPassword = result.value;
                                        // Step 6: Reset the password
                                        resetPassword(email, newPassword).then((response) => {
                                            if (response === "success") {
                                                Swal.fire(
                                                    'Success!',
                                                    'Your password has been reset successfully.',
                                                    'success'
                                                );
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    response,
                                                    'error'
                                                );
                                            }
                                        });
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Invalid verification code.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        }
    });
}

function sendVerificationCode(email) {
    return new Promise((resolve, reject) => {
        var f = new FormData();
        f.append("email", email);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                resolve();
            }
        }
        r.open("POST", "../app/send-verification-code.php", true);
        r.send(f);
    });
}

function verifyCode(email, code) {
    return new Promise((resolve, reject) => {
        var f = new FormData();
        f.append("email", email);
        f.append("code", code);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                resolve(r.responseText === "valid");
            }
        }
        r.open("POST", "../app/verify-code.php", true);
        r.send(f);
    });
}

function resetPassword(email, newPassword) {
    return new Promise((resolve, reject) => {
        var f = new FormData();
        f.append("email", email);
        f.append("newPassword", newPassword);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                resolve(r.responseText);
            }
        }
        r.open("POST", "../app/reset-password.php", true);
        r.send(f);
    });
}



function showPassword3() {
    var pw = document.getElementById("pw");
    var pwb = document.getElementById("pwb");

    if (pw.type === "password") {
        pw.type = "text";
        pwb.className = "bi bi-eye-slash-fill";
    } else {
        pw.type = "password";
        pwb.className = "bi bi-eye-fill";
    }
}

function updateprofile() {
    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email = document.getElementById("D");
    var address_line1 = document.getElementById("line1");
    var address_line2 = document.getElementById("line2");
    var district = document.getElementById("district");
    var province = document.getElementById("province");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pc");



    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("mn", mobile_no.value);
    f.append("pw", password.value);
    f.append("ea", email.value);
    f.append("al1", address_line1.value);
    f.append("al2", address_line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postal_code.value);



    var r = new XMLHttpRequest()

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                signout();
                window.location = "index.php "
            }
            alert(t);
        }
    }


    r.open("POST", "../app/userprofileupdateprocess.php", true);
    r.send(f);
}



function wishlist() {
    var pid = document.getElementById("title").innerText;

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {


            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "wishlistprocess.php", true);
    r.send(f);
}


function adminsignin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Signed in successfully"
                });

                setTimeout(function() {
                    window.location = "adminhome.php";
                }, 3000); // Redirect after 3 seconds to match the toast duration
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", " ./adminsigninprocess.php", true);
    r.send(f);
}



function updatebrand() {
    var brnd = document.getElementById("nbrand");

    var f = new FormData();
    f.append("b", brnd.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updatebrandprocess.php", true);
    r.send(f);
}

function updatecategory() {
    var catn = document.getElementById("ncat");

    var f = new FormData();
    f.append("c", catn.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updatecatprocess.php", true);
    r.send(f);
}

function updatecolor() {
    var nclr = document.getElementById("nclr");

    var f = new FormData();
    f.append("cb", nclr.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updateclrprocess.php", true);
    r.send(f);
}

function updateprovince() {
    var nprovince = document.getElementById("nprovince");

    var f = new FormData();
    f.append("prov", nprovince.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updateprovinceprocess.php", true);
    r.send(f);
}

function updatedistrict() {
    var ndistrict = document.getElementById("ndistrict");
    var pvalue = document.getElementById("pvalue");

    var f = new FormData();
    f.append("dis", ndistrict.value);
    f.append("pvalue", pvalue.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updatedistrictprocess.php", true);
    r.send(f);
}

function updatecity() {
    var ndistrict = document.getElementById("ncity");
    var pvalue = document.getElementById("did");

    var f = new FormData();
    f.append("ncity", ndistrict.value);
    f.append("did", pvalue.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updatecityprocess.php", true);
    r.send(f);
}

function delprov() {
    var proname = document.getElementById("proname");
    var f = new FormData();
    f.append("pname", proname.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "deleteprovinceprocess.php", true);
    r.send(f);
}

function deleteprov() {
    var disname = document.getElementById("disname");

    var f = new FormData();
    f.append("disname", disname.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "deletedistrictprocess.php", true);
    r.send(f);
}

function delcity() {
    var cityname = document.getElementById("cityname");

    var f = new FormData();
    f.append("cityname", cityname.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "deletecityprocess.php", true);
    r.send(f);
}


function delbrand() {
    var delbrand = document.getElementById("del-brand-select");



    var f = new FormData();
    f.append("delbrand", delbrand.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "deletebrandprocess.php", true);
    r.send(f);
}

function delcat() {
    var celcat = document.getElementById("del_category_select");


    var f = new FormData();
    f.append("delcat", celcat.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "deletecatprocess.php", true);
    r.send(f);
}
function delcol() {
    var delcol = document.getElementById("del_color_select");


    var f = new FormData();
    f.append("delclr", delcol.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "deleteclrprocess.php", true);
    r.send(f);
}
function delproduct() {
    var delproduct = document.getElementById("del_product_select");



    var f = new FormData();
    f.append("delproduct", delproduct.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "deleteproductprocess.php", true);
    r.send(f);
}

function minas() {
    var valueSpan = document.getElementById("value");
    var currentValue = parseInt(valueSpan.innerText);

    if (currentValue > 1) {
        currentValue -= 1;
        valueSpan.innerText = currentValue;
    } else {
        alert("Minimum amount reached!");
    }
}


function plus() {
    var span = document.getElementById('value');
    var currentValue = parseInt(span.textContent);
    var stock = document.getElementById('stock').textContent;


    if (currentValue == stock) {
        alert("Maximum amount reached!");
    } else {


        var newValue = currentValue + 1;
        span.textContent = newValue;
    }
}



function addtocart() {

    var title = document.getElementById("title").innerText;
    var qty = document.getElementById("value").innerText;



    var f = new FormData();

    f.append("title", title);
    f.append("qty", qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location = "cart.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "../app/addtocartprocess.php", true);

    r.send(f);




}



function minas1(id) {
    var productElement = document.getElementById("value" + id); // Get the element
    var currentText = productElement.textContent; // Get the current text content
    var currentValue = parseInt(currentText);



    if (currentValue > 1) {
        var newValue = currentValue - 1;
        productElement.textContent = newValue;

        var priceElement = document.getElementById("price" + id); // Get the price element
        var priceText = priceElement.textContent;
        var priceValue = parseInt(priceText);


        var gana = document.getElementById("gana" + id);
        var ganaText = gana.textContent;


        var total = newValue * ganaText;


        priceElement.textContent = total;

    } else {
        alert("Minimum amount reached!");
    }


    // Set the new value to the element

}

function delcart(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete the product from the cart?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var f = new FormData();
            f.append("delproductid", id);  // Append the product ID directly to FormData

            var r = new XMLHttpRequest();
            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    var t = r.responseText;

                    if (t == "success") {
                        Swal.fire(
                            'Deleted!',
                            'The product has been removed from your cart.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            t,
                            'error'
                        );
                    }
                }
            }
            r.open("POST", "../app/deletecartprocess.php", true);
            r.send(f);
        }
    });
}


function plus1(id) {
    var productElement = document.getElementById("value" + id); // Get the element
    var currentText = productElement.textContent; // Get the current text content
    var currentValue = parseInt(currentText);
    var newValue = currentValue + 1;
    var plusqtyproductid = document.getElementById("delproductid") + id;



    var f = new FormData();
    var cvalue = f.append("value", newValue);
    var pqtyid = f.append("plusqtyproductid", plusqtyproductid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "../app/addqtyprocess.php", true);
    r.send(f);

    var priceElement = document.getElementById("price" + id); // Get the price element
    var priceText = priceElement.textContent;
    var priceValue = parseInt(priceText);


    var gana = document.getElementById("gana" + id);
    var ganaText = gana.textContent;


    var total = newValue * ganaText;


    priceElement.textContent = total;

    // Set the new value to the element
    productElement.textContent = newValue;
}


function minas1(id) {
    var productElement = document.getElementById("value" + id); // Get the element
    var currentText = productElement.textContent; // Get the current text content
    var currentValue = parseInt(currentText);

    if (currentValue > 1) {
        var newValue = currentValue - 1;
        productElement.textContent = newValue;

        var plusqtyproductid = document.getElementById("delproductid") + id;



        var f = new FormData();
        var cvalue = f.append("value", newValue);
        var pqtyid = f.append("plusqtyproductid", plusqtyproductid);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var t = r.responseText;

                if (t == "success") {
                    location.reload();

                } else {
                    alert(t);
                }

            }
        }
        r.open("POST", "../app/removeqtyprocess.php", true);
        r.send(f);

        var priceElement = document.getElementById("price" + id); // Get the price element
        var priceText = priceElement.textContent;
        var priceValue = parseInt(priceText);


        var gana = document.getElementById("gana" + id);
        var ganaText = gana.textContent;


        var total = newValue * ganaText;


        priceElement.textContent = total;

    } else {
        alert("Minimum amount reached!");
    }


    // Set the new value to the element

}


function buynow() {




    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                window.location = "../app/buyprocess.php";



            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "../app/buynowprocess.php", true);
    r.send();


}

function updateaddress() {
    var district = document.getElementById("district");
    var province = document.getElementById("province");
    var city = document.getElementById("city");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");



    var f = new FormData();
    f.append("district", district.value);
    f.append("province", province.value);
    f.append("city", city.value);
    f.append("line1", line1.value);
    f.append("line2", line2.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "updateaddressprocess.php", true);
    r.send(f);








}



function buynow44() {

    

    var pid = document.getElementById("title").textContent;
    var qty = document.getElementById("value").textContent;


    window.location = "../app/buynownowwwprocess.php?pid=" + pid + "&qty=" + qty;




}

function removewish(product_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete the product from the wishlist?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var f = new FormData();
            f.append("product_id", product_id);

            var r = new XMLHttpRequest();
            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    var t = r.responseText;

                    if (t == "success") {
                        Swal.fire(
                            'Deleted!',
                            'The product has been removed from your wishlist.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            t,
                            'error'
                        );
                    }
                }
            }
            r.open("POST", "../app/removewishprocess.php", true);
            r.send(f);
        }
    });
}


function addtocarthome(id) {
    var title = document.getElementById("title") + id;
    
    var f = new FormData();
    f.append("title", title);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                Swal.fire({
                    icon: "success",
                    title: "Product added to the cart",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: t,
                });
            }
        }
    }
    r.open("POST", "/zzzz/app/addtocarthomeprocess.php", true);
    r.send(f);
}


function wishlisthome(id) {
    var pid = id;

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t === "Product added to wishlist!") {
                Swal.fire({
                    icon: "success",
                    title: t,
                    showConfirmButton: false,
                    timer: 1500,
                    position: "center"
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: t,
                    position: "center"
                });
            }
        }
    }

    r.open("POST", "./app/wishlisthomeprocess.php", true);
    r.send(f);
}


function wishlisthome2(id) {
    var pid = document.getElementById("title") + id;

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {


            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "../app/wishlisthomeprocess.php", true);
    r.send(f);
}


function wishlisthomeother(id) {
    var pid = document.getElementById("title") + id;

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {


            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "../app/wishlisthomeprocess.php", true);
    r.send(f);
}

function idel1(invoice_id) {
   var invoice_id = invoice_id;

   var f = new FormData();
   f.append("invoice_id", invoice_id);


   var r = new XMLHttpRequest();

   r.onreadystatechange = function () {
       if (r.readyState == 4 && r.status == 200) {
           var t = r.responseText;
           if (t == "success") {
               location.reload();
           } else {
               alert(t);
           }

       }
   }
   r.open("POST", "../app/deleteinvoiceprocess.php", true);
   r.send(f);
}




function idel2(invoice_id) {
    var invoice_id = invoice_id;

   var f = new FormData();
   f.append("invoice_id", invoice_id);


   var r = new XMLHttpRequest();

   r.onreadystatechange = function () {
       if (r.readyState == 4 && r.status == 200) {
           var t = r.responseText;
           if (t == "success") {
               location.reload();
           } else {
               alert(t);
           }

       }
   }
   r.open("POST", "../app/deleteinvoicecartprocess.php", true);
   r.send(f);
}

function buynow1() {



    var totalgana = document.getElementById("totalgana").innerText;
    var delfee = document.getElementById("delfee").innerText;
    var sub_total = document.getElementById("sub_total").innerText;

    var rrthwsdad = sub_total;
    var uihsfiuhi = delfee;
    var iuhiuh = totalgana;



    window.location = "successpage.php?sub_total=" + rrthwsdad + "&delfee=" + uihsfiuhi + "&totalgana=" + iuhiuh;

}



function print(){
    window.print();
}



function buynow2(){
    var delfee = document.getElementById("delfee").innerText;
    var qqty = document.getElementById("qqty").innerText;
    var title = document.getElementById("title").innerText;
    var sub_total = document.getElementById("sub_total").innerText;
    var price = document.getElementById("price").innerText;
    
   

    


    window.location = "../components/cashondelsinglepsuccesspage.php?delfee=" + delfee + "&qqty=" + qqty + "&title=" + title + "&sub_total=" + sub_total + "&price=" + price;
}


function buynow22(){

    var delfee = document.getElementById("delfee").innerHTML;
   
    window.location = "../app/cashondelcartsuccesspage.php?delfee=" + delfee;

    
}


  // Function to handle the delete button click and send the invoice_id to the server
  function del_invoice(button) {
    // Get the invoice_id from the data attribute
    var invoiceId = button.getAttribute("data-invoice-id");
    
    var f = new FormData();
    f.append("invoice_id", invoiceId); // Use 'invoice_id' as the key

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4 && r.status == 200) {
        var t = r.responseText;
        if (t == "success") {
        location.reload();
        }
      }
    };

    r.open("POST", "../app/deleteinvoiceprocess.php", true);
    r.send(f);
  }

  // Add event listeners to all delete buttons
  var deleteButtons = document.querySelectorAll(".btn-danger[data-invoice-id]");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      del_invoice(this);
    });
  });


  function test() {
alert("test");
  }