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
    f.append("e", email2.value);
    f.append("p", password2.value);
    f.append("r", rememberme.checked);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "../index.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", " ../app/signinprocess.php", true);
    r.send(f);

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                // window.location.reload();
                window.location = "./components/login.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "./app/signoutProcess.php", true);
    r.send();

}

function signout321() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                // window.location.reload();
                window.location = "./login.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "../app/signoutProcess.php", true);
    r.send();

}

function forgotpassword() {


    var email = document.getElementById("email3");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 & r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                var m = document.getElementById("forgotpasswordmodel");
                bm = new bootstrap.Modal(m);
                bm.show();
            }
            alert(t);
        }
    }

    r.open("GET", "forgotpasswordprocess.php?e=" + email.value, true);
    r.send();
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
    var email = document.getElementById("email");
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


    r.open("POST", "userprofileupdateprocess.php", true);
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
    f.append("e", email2.value);
    f.append("p", password2.value);



    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "adminhome.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", " adminsigninprocess.php", true);
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

function addproduct() {
    var pname = document.getElementById("title");
    var price = document.getElementById("price");
    var qty = document.getElementById("qty");
    var description = document.getElementById("description");
    var fee_c = document.getElementById("fee_c");
    var fee_oc = document.getElementById("fee_oc");
    var category = document.getElementById("productCategory");
    var brand = document.getElementById("productBrand");
    var color = document.getElementById("productColor");


    var f = new FormData();
    f.append("title", pname.value);
    f.append("price", price.value);
    f.append("qty", qty.value);
    f.append("description", description.value);
    f.append("fee_c", fee_c.value);
    f.append("fee_oc", fee_oc.value);
    f.append("category", category.value);
    f.append("brand", brand.value);
    f.append("color", color.value);

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

    r.open("POST", "updateproductprocess.php", true);
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
    r.open("POST", "addtocartprocess.php", true);

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
    var delproductid = document.getElementById("delproductid") + id;

    var f = new FormData();
    var pid = f.append("delproductidd", delproductid);



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
    r.open("POST", "../app/deletecartprocess.php", true);
    r.send(f);
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
    r.open("POST", "addqtyprocess.php", true);
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
        r.open("POST", "removeqtyprocess.php", true);
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

function removewish() {

    var ptitle = document.getElementById("titile").innerText;

    var f = new FormData();
    f.append("ptitle", ptitle);

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
    r.open("POST", "removewishprocess.php", true);
    r.send(f);

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

                window.location = "../components/cart.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "/zzzz/app/addtocarthomeprocess.php", true);

    r.send(f);




}

function wishlisthome(id) {
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

    r.open("POST", "wishlisthomeprocess.php", true);
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
    
   

    


    window.location = "../app/cashondelsinglepsuccesspage.php?delfee=" + delfee + "&qqty=" + qqty + "&title=" + title + "&sub_total=" + sub_total + "&price=" + price;
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

    r.open("POST", "deleteinvoiceprocess.php", true);
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