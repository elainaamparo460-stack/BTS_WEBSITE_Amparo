<script src="https://kit.fontawesome.com/bdb328743c.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>

/* FADE IN */
document.body.style.opacity = "0";

window.onload = () =>{

    document.body.style.transition = "0.8s ease";
    document.body.style.opacity = "1";

};

/* INPUT EFFECT */
const inputs = document.querySelectorAll(".form-control");

inputs.forEach(input =>{

    input.addEventListener("focus", ()=>{

        input.style.transform = "translateY(-2px)";
        input.style.transition = "0.3s";

    });

    input.addEventListener("blur", ()=>{

        input.style.transform = "translateY(0px)";

    });

});

/* BUTTON HOVER */
const btns = document.querySelectorAll(".btn");

btns.forEach(btn =>{

    btn.addEventListener("mouseenter", ()=>{

        btn.style.transform = "translateY(-3px)";

    });

    btn.addEventListener("mouseleave", ()=>{

        btn.style.transform = "translateY(0px)";

    });

});

</script>