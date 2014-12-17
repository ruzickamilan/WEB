$(document).ready(function () {
    $("#mojePravidla").validate({
        messages: {
            jmeno: {
                required: "Zadej své jméno, případně příjmení!",
                minlength: "Jméno musí mít alespoň 3 znaky!",
                maxlength: "Jméno může mít maximálně 30 znaků!"
            },
            email: {
                required: "Zadej svou emailovou adresu!",
                email: "Zadej platný email!",
                minlength: "Email musí mít alespoň 5 znaků!",
                maxlength: "Email může mít maximálně 50 znaků!"
            },
            heslo: {
                required: "Zadej své heslo!",
                minlength: "Heslo musí mít alespoň 5 znaků!",
                maxlength: "Heslo může mít maximálně 15 znaků!"
            },
            heslo0: {
                required: "Zadej své staré heslo!",
                minlength: "Staré heslo musí mít alespoň 5 znaků!",
                maxlength: "Staré heslo může mít maximálně 15 znaků!"
            },
            heslo1: {
                required: "Zadej heslo!",
                minlength: "Heslo musí mít alespoň 5 znaků!",
                maxlength: "Heslo může mít maximálně 15 znaků!"
            },
            heslo2: {
                required: "Zadej heslo znovu!",
                equalTo: "Hesla se neshodují!"
            },
            text: {
                required: "Zadej nějaký text!",
                minlength: "Text musí mít alespoň 10 znaků!",
                maxlength: "Text může mít maximálně 500 znaků!"
            },
            text_zpravy: {
                required: "Zadej nějaký text!",
                minlength: "Text musí mít alespoň 10 znaků!",
                maxlength: "Text může mít maximálně 1000 znaků!"
            },
            telefon: {
                number: "Zadej své telefonní číslo!",
                minlength: "Telefon musí mít nejméně 9 znaků!",
                maxlength: "Telefon může mít maximálně 9 znaků!",
                digits: "Telefon musí obsahovat jen číslice!"
            },
            predmet: {
                required: "Zadej předmět!",
                minlength: "Předmět musí mít alespoň 3 znaky!",
                maxlength: "Předmět může mít maximálně 30 znaků!"
            }
        },
        rules: {
            jmeno: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            email: {
                required: true,
                email: true,
                minlength: 5,
                maxlength: 50
            },
            heslo: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            heslo0: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            heslo1: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            heslo2: {
                required: true,
                equalTo: "#heslo1"
            },
            text: {
                required: true,
                minlength: 10,
                maxlength: 500
            },
            text_zpravy: {
                required: true,
                minlength: 10,
                maxlength: 1000
            },
            telefon: {
                minlength: 9,
                maxlength: 9,
                digits: true,
                number: true
            },
            predmet: {
                required: true,
                minlength: 3,
                maxlength: 30
            }
        }
    });
    
    $("#reakce").validate({
        messages: {
            text_reakce: {
                required: "Zadej nějaký text!",
                minlength: "Text musí mít alespoň 10 znaků!",
                maxlength: "Text může mít maximálně 500 znaků!"
            },
            text_upravy: {
                required: "Zadej nějaký text!",
                minlength: "Text musí mít alespoň 10 znaků!",
                maxlength: "Text může mít maximálně 500 znaků!"
            }
        },
        rules: {
            text_reakce: {
                required: true,
                minlength: 10,
                maxlength: 500
            },
            text_upravy: {
                required: true,
                minlength: 10,
                maxlength: 500
            }
        }
    });
}); 