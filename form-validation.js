// Email validation using regular expressions
const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

var Name=0, pass=0, email=0, ph=0, adrs=0;

function nameEntry(name){
    name.addEventListener('keyup', ()=>{
        let cl = name.classList;
        if (name.value.trim() !== ''){
            changeclass(cl,"is-valid",'is-invalid');
            console.log(name.value.trim());
            Name = 1;
        }
        else{
            Name = 0;
            changeclass(cl,'is-invalid','is-valid');
            document.getElementById('FNvalid').className = 'invalid-feedback';
            document.getElementById('FNvalid').innerHTML = 'Enter your name';
        }
        register()
    });
}


function mailEntry(mailid){
    mailid.addEventListener('keyup', ()=>{
        let cl = mailid.classList;
        let mail = mailid.value.trim()
        if (mail !== '' && isValidEmail(mail)){
            changeclass(cl,"is-valid",'is-invalid');
            console.log(mail);
            email = 1;
        }
        else{
            email = 0;
            changeclass(cl,'is-invalid','is-valid');
            document.getElementById('Mailvalid').className = 'invalid-feedback';
            document.getElementById('Mailvalid').innerHTML = 'Enter appropriate mail id';
        }
        register()
    })
}


function passEntry(password, confirmpassword){
    confirmpassword.addEventListener('change', ()=>{
        let cp = confirmpassword.value.trim();
        let p = password.value.trim();
        let clcp = confirmpassword.classList;
        let clp = password.classList;
        
        if(password.value.trim() === ''){
            pass = 0;
            console.log(p)
            changeclass(clp,'is-invalid','is-valid');
            document.querySelector('#Passvalid').className = 'invalid-feedback';
            document.querySelector('#Passvalid').innerHTML = 'Enter a password first!';
        }
        else if (p !== cp){
            pass = 0;
            changeclass(clcp,'is-invalid','is-valid');
            document.querySelector('#Passvalid').className = 'invalid-feedback';
            document.querySelector('#Passvalid').innerHTML = 'Passwords donot match!';
        }
        else{
            pass = 1;
            changeclass(clp,'is-valid','is-invalid');
            changeclass(clcp,'is-valid','is-invalid');
        }
        register()
    })
}




function addressEntry(address){
    address.addEventListener('keyup', ()=>{
        let cl = address.classList;
        if (address.value.trim() !== ''){
            changeclass(cl,"is-valid",'is-invalid');
            adrs = 1;
        }
        else{
            adrs = 0;
            changeclass(cl,'is-invalid','is-valid');
            document.getElementById('Addressvalid').className = 'invalid-feedback';
            document.getElementById('Addressvalid').innerHTML = 'Enter your address for delivery!';
        }
        register()
    });
}



function phoneEntry(phone){
    phone.addEventListener('change', ()=>{
        let cl = phone.classList;
        let phno = phone.value.toString().trim()
        if (phno.length === 10){
            changeclass(cl,"is-valid",'is-invalid');
            ph = 1;
        }
        else{
            ph = 0;
            changeclass(cl,'is-invalid','is-valid');
            document.getElementById('Phnovalid').className = 'invalid-feedback';
            document.getElementById('Phnovalid').innerHTML = 'Phone numbers must contain 10 digits!';
        }
        register()
    })
}

function register(){
    if(Name === 1 && email === 1 && pass===1 && ph===1 && adrs===1){
        console.log(Name,email,pass, ph, adrs);
        document.getElementById('register').removeAttribute('disabled');
    }
}


document.addEventListener('DOMContentLoaded', ()=>{
    const form = document.getElementsByClassName('needs-validation');
    console.log(form)
    const name = document.getElementById('Name');
    // const lastname = document.getElementById('LastName');
    const address = document.getElementById('Address');
    const mailid = document.getElementById('MailId');
    const phone = document.getElementById('PhoneNumber');
    const password = document.getElementById('Password');
    const confirmpassword = document.getElementById('ConfirmPassword');
    

    //Validating Name
    nameEntry(name);

    //Validating MailID
    mailEntry(mailid);

    // Validating Passwords
    passEntry(password,confirmpassword);

    //Validating address
    addressEntry(address);

    //Validating Phone number
    phoneEntry(phone);    

});


function changeclass(classlist, classname, replace){
    if (!classlist.contains(classname)){
        classlist.add(classname);
    }
    else if (classlist.contains(replace) && (replace !== '')){
        classlist.remove(replace);
        classlist.add(classname);
    }
}

