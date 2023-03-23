const backdrop = document.querySelector(".backdrop")
const closeBtn = document.querySelectorAll(".close-btn")
const addCommentElements = document.querySelectorAll(".comment")
const blur = document.querySelector(".main")
const registerBackDrop = document.querySelector(".register-backdrop")
const register = document.querySelector(".register")




addCommentElements.forEach((item) =>
  item.addEventListener("click", () => {
    backdrop.style.display = "block"
    blur.style.filter = "blur(8px)"
  })
)
//////////////////        LOGOWANIE          /////////////////
const login = document.querySelector(".login")
const loginBackDrop = document.querySelector(".login-backdrop")
login.addEventListener("click", () => {
  loginBackDrop.style.display = "block"
  blur.style.filter = "blur(8px)"
})
/////////////////        USUWANIE        /////////////////


 //////////////////       REJESTRACJA        ////////////////
 register.addEventListener("click", () => {
  registerBackDrop.style.display = "block"
  blur.style.filter = "blur(8px)"
})

 closeBtn.forEach((item) => 
 item.addEventListener("click", (e)=> {
  e.preventDefault()
  backdrop.style.display = "none"
  registerBackDrop.style.display = "none"
  loginBackDrop.style.display = "none"
  
  blur.style.filter = "blur(0px)"
 }))

 const form = document.querySelector(".formRegister");
 const inputNick = form.querySelector("input[name=nick]");
 const inputEmail = form.querySelector("input[name=email]");
 const inputPassoword = form.querySelector("input[name=password]");


form.addEventListener("submit", e => {
    e.preventDefault();

    let formErrors = [];
    let alertError = "Popraw te pola:\n"
    if (inputNick.value.length < 5) {
        formErrors.push("Nie poprawny nick (minimum 5 liter)\n")
    }
    const reg = /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$/;
    if (!reg.test(inputEmail.value)) {
      formErrors.push("Nie poprawny adres email\n");
    }
    if (inputPassoword.value.length <= 8) {
      formErrors.push("Nie poprawne hasło (minimum 8 liter)\n")
  }
    if (!formErrors.length) {
      form.submit();  
    }else {
       for(i = 0; i < formErrors.length; i++){
          alertError = alertError.concat(formErrors[i])
       }
       alert(alertError)
    }
})
/////////////////////////////////////////////








