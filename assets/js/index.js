
function validateForm(){
    let last_name = document.getElementById('last_name').value;
    let first_name = document.getElementById('first_name').value;
    let s_address = document.getElementById('s_address').value;
    let city = document.getElementById('city').value;
    let country = document.getElementById('country').value;
    let d_state = document.getElementById('d_state').value;
    let postal_code = document.getElementById('postal_code').value;
    let phone_number = document.getElementById('phone_number').value;
    let email = document.getElementById('email').value;
    let p_contact = document.getElementById('p_contact').value;
    let p_payment = document.getElementById('p_payment').value;
    let f_donation = document.getElementById('f_donation').value;
    let amount = document.getElementById('amount').value;
    let comment = document.getElementById('comment').value;



    if(last_name === "") {
        alert("please enter your last name");
        return false;
    }else if(first_name === "") {
        alert("please enter your first name");
        return false;
    }else if(s_address === ""){
        alert("please enter your street address");
        return false;
    } else if(city === "") {
        alert("please enter your city");
        return false;
    }else if(country === ""){
        alert("please enter your country");
        return false;
    }else if(d_state === ""){
        alert("please enter your state/region");
        return false;
    }else if(postal_code === ""){
        alert("please enter your postal code");
        return false;
    }else if(phone_number === ""){
        alert("please enter your phone number");
        return false;
    }else if(email === ""){
        alert("please enter your email");
        return false;
    }else if(p_contact === ""){
        alert("please enter your preferred form of contact");
        return false;
    }else if(p_payment === ""){
        alert("please enter your preferred form of payment");
        return false;
    }else if(f_donation === ""){
        alert("please enter your frequency of donation");
        return false;
    }else if(amount === ""){
        alert("please enter your amount");
        return false;
    }else if(comment === ""){
        alert("please enter your comment");
        return false;
    }
}

